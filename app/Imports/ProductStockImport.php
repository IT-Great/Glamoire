<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductStocks;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductStockImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $collection)
    {
        $successCount = 0;
        $failedCount = 0;
        $failedRows = [];

        DB::transaction(function () use ($collection, &$successCount, &$failedCount, &$failedRows) {
            foreach ($collection as $rowIndex => $row) {
                try {
                    // Cari produk berdasarkan kode produk
                    $product = Product::where('product_code', $row['kode_produk_sku'])->first();

                    if (!$product) {
                        throw new \Exception("Produk dengan Kode Produk {$row['kode_produk_sku']} tidak ditemukan");
                    }

                    // Parsing tanggal dengan format DD/MM/YYYY
                    $dateExpired = is_numeric($row['tanggal_kadaluarsa_yyyy_mm_dd'])
                        ? \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_kadaluarsa_yyyy_mm_dd']))
                        : \Carbon\Carbon::createFromFormat('d/m/Y', $row['tanggal_kadaluarsa_yyyy_mm_dd'])
                        ->format('Y-m-d');

                    // Buat atau update stok produk di tabel product_stocks
                    $productStock = ProductStocks::create([
                        'product_id' => $product->id,
                        'quantity' => $row['jumlah_stok'],
                        'date_expired' => $dateExpired
                    ]);

                    // Update stock_quantity di tabel products
                    $totalStock = ProductStocks::where('product_id', $product->id)->sum('quantity');

                    $product->update([
                        'stock_quantity' => $product->stock_quantity + $row['jumlah_stok']
                    ]);

                    $successCount++;
                } catch (\Exception $e) {
                    $failedCount++;
                    $failedRows[] = [
                        'row' => $rowIndex + 2, // +2 karena header
                        'product_code' => $row['kode_produk_sku'] ?? 'N/A',
                        'error' => $e->getMessage()
                    ];
                }
            }
        });

        // Log summary
        Log::info('Product Stock Import Summary', [
            'total_rows' => $collection->count(),
            'successful_imports' => $successCount,
            'failed_imports' => $failedCount,
            'failed_rows' => $failedRows
        ]);

        // Jika ada baris yang gagal, lempar exception dengan detail
        if (!empty($failedRows)) {
            $errorDetails = array_map(function ($row) {
                return "Baris {$row['row']}: Kode Produk {$row['product_code']} - {$row['error']}";
            }, $failedRows);

            throw new \Exception("Import sebagian gagal:\n" . implode("\n", $errorDetails));
        }
    }

    public function rules(): array
    {
        return [
            'kode_produk_sku' => 'required|exists:products,product_code',
            'jumlah_stok' => 'required|integer|min:0',
            'tanggal_kadaluarsa_yyyy_mm_dd' => [
                'required',
                function ($attribute, $value, $fail) {
                    try {
                        if (is_numeric($value)) {
                            // Format serial Excel, convert to Carbon date
                            $date = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
                        } else {
                            // Format string (DD/MM/YYYY)
                            $date = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
                        }

                        // Pastikan tanggal tidak di masa lalu
                        if ($date->isPast()) {
                            $fail('Tanggal kadaluarsa harus hari ini atau di masa depan.');
                        }
                    } catch (\Exception $e) {
                        $fail('Format tanggal harus dalam format DD/MM/YYYY atau serial Excel.');
                    }
                }
            ]
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kode_produk_sku.exists' => 'Produk dengan Kode Produk :input tidak ditemukan.',
            'jumlah_stok.min' => 'Jumlah stok harus bernilai non-negatif.',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}
