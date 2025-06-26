<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductStocks;
use App\Models\ProductVariations;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

// bisa dan digunakan tapi masih kurang sesuai
// class ProductVariantImport implements ToCollection, WithHeadingRow, WithValidation
// {
//     public function collection(Collection $collection)
//     {
//         $successCount = 0;
//         $failedCount = 0;
//         $failedRows = [];

//         DB::transaction(function () use ($collection, &$successCount, &$failedCount, &$failedRows) {
//             foreach ($collection as $rowIndex => $row) {
//                 try {
//                     // Cari produk varian berdasarkan SKU
//                     $productVariation = ProductVariations::where('sku', $row['kode_produk_variant_sku_variant'])->first();

//                     if (!$productVariation) {
//                         throw new \Exception("SKU {$row['kode_produk_variant_sku_variant']} tidak ditemukan dalam database.");
//                     }

//                     // Debug: Cek nilai tanggal
//                     Log::info('Date value: ' . print_r($row['tanggal_kadaluarsa_yyyy_mm_dd'], true));

//                     // Parsing tanggal dengan format YYYY-MM-DD
//                     $dateExpired = is_numeric($row['tanggal_kadaluarsa_yyyy_mm_dd'])
//                         ? \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_kadaluarsa_yyyy_mm_dd']))
//                         : \Carbon\Carbon::createFromFormat('d/m/Y', $row['tanggal_kadaluarsa_yyyy_mm_dd'])
//                         ->format('Y-m-d');

//                     // Buat atau update stok produk varian di tabel product_stocks
//                     $productStock = ProductStocks::create([
//                         'variation_id' => $productVariation->id,
//                         'quantity' => $row['jumlah_stok'],
//                         'date_expired' => $dateExpired
//                     ]);

//                     // Update stock_quantity di tabel product_variations
//                     $totalStock = ProductStocks::where('variation_id', $productVariation->id)->sum('quantity');

//                     $productVariation->update([
//                         'variant_stock' => ($productVariation->variant_stock ?? 0) + $row['jumlah_stok']
//                     ]);

//                     $successCount++;
//                 } catch (\Exception $e) {
//                     $failedCount++;
//                     $failedRows[] = [
//                         'row' => $rowIndex + 2, // +2 karena header
//                         'sku' => $row['kode_produk_variant_sku_variant'] ?? 'N/A',
//                         'error' => $e->getMessage()
//                     ];
//                 }
//             }
//         });

//         // Log summary
//         Log::info('Product Variant Stock Import Summary', [
//             'total_rows' => $collection->count(),
//             'successful_imports' => $successCount,
//             'failed_imports' => $failedCount,
//             'failed_rows' => $failedRows
//         ]);

//         // Jika ada baris yang gagal, lempar exception dengan detail
//         if (!empty($failedRows)) {
//             $errorDetails = array_map(function ($row) {
//                 return "Baris {$row['row']}: SKU {$row['sku']} - {$row['error']}";
//             }, $failedRows);

//             throw new \Exception("Import sebagian gagal:\n" . implode("\n", $errorDetails));
//         }
//     }

//     public function rules(): array
//     {
//         return [
//             'kode_produk_variant_sku_variant' => 'required|exists:product_variations,sku',
//             'jumlah_stok' => 'required|integer|min:0',
//             'tanggal_kadaluarsa_yyyy_mm_dd' => [
//                 'required',
//                 function ($attribute, $value, $fail) {
//                     try {
//                         if (empty($value)) {
//                             $fail('Tanggal kadaluarsa tidak boleh kosong.');
//                             return;
//                         }

//                         if (is_numeric($value)) {
//                             // Format serial Excel, convert to Carbon date
//                             $date = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
//                         } else {
//                             // Format string (DD/MM/YYYY)
//                             $date = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
//                         }

//                         // Pastikan tanggal tidak di masa lalu
//                         if ($date->isPast()) {
//                             $fail('Tanggal kadaluarsa harus hari ini atau di masa depan.');
//                         }
//                     } catch (\Exception $e) {
//                         $fail('Format tanggal harus dalam format DD/MM/YYYY atau serial Excel.');
//                     }
//                 }
//             ]
//         ];
//     }

//     public function customValidationMessages()
//     {
//         return [
//             'kode_produk_variant_sku_variant.exists' => 'SKU tidak ditemukan dalam database.',
//             'jumlah_stok.min' => 'Jumlah stok harus bernilai non-negatif.',
//             'tanggal_kadaluarsa_yyyy_mm_dd.required' => 'Tanggal kadaluarsa harus diisi.',
//         ];
//     }

//     public function headingRow(): int
//     {
//         return 1;
//     }
// }

class ProductVariantImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $collection)
    {
        $successCount = 0;
        $failedCount = 0;
        $failedRows = [];

        DB::transaction(function () use ($collection, &$successCount, &$failedCount, &$failedRows) {
            foreach ($collection as $rowIndex => $row) {
                try {
                    // Cari produk varian berdasarkan SKU
                    $productVariation = ProductVariations::where('sku', $row['kode_produk_variant_sku_variant'])->first();

                    if (!$productVariation) {
                        throw new \Exception("SKU {$row['kode_produk_variant_sku_variant']} tidak ditemukan dalam database.");
                    }

                    // Parsing tanggal dengan format YYYY-MM-DD
                    $dateExpired = is_numeric($row['tanggal_kadaluarsa_yyyy_mm_dd'])
                        ? \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_kadaluarsa_yyyy_mm_dd']))
                        : \Carbon\Carbon::createFromFormat('d/m/Y', $row['tanggal_kadaluarsa_yyyy_mm_dd'])
                        ->format('Y-m-d');

                    // Buat atau update stok produk varian di tabel product_stocks
                    $productStock = ProductStocks::create([
                        'variation_id' => $productVariation->id,
                        'quantity' => $row['jumlah_stok'],
                        'date_expired' => $dateExpired
                    ]);

                    // Update stock_quantity dan variant_expired di tabel product_variations
                    $totalStock = ProductStocks::where('variation_id', $productVariation->id)->sum('quantity');

                    $productVariation->update([
                        'variant_stock' => ($productVariation->variant_stock ?? 0) + $row['jumlah_stok'],
                        'variant_expired' => $dateExpired // Tambahkan baris ini untuk menyimpan tanggal kadaluarsa
                    ]);

                    $successCount++;
                } catch (\Exception $e) {
                    $failedCount++;
                    $failedRows[] = [
                        'row' => $rowIndex + 2, // +2 karena header
                        'sku' => $row['kode_produk_variant_sku_variant'] ?? 'N/A',
                        'error' => $e->getMessage()
                    ];
                }
            }
        });

        // Log summary
        Log::info('Product Variant Stock Import Summary', [
            'total_rows' => $collection->count(),
            'successful_imports' => $successCount,
            'failed_imports' => $failedCount,
            'failed_rows' => $failedRows
        ]);

        // Jika ada baris yang gagal, lempar exception dengan detail
        if (!empty($failedRows)) {
            $errorDetails = array_map(function ($row) {
                return "Baris {$row['row']}: SKU {$row['sku']} - {$row['error']}";
            }, $failedRows);

            throw new \Exception("Import sebagian gagal:\n" . implode("\n", $errorDetails));
        }
    }
    
    public function rules(): array
    {
        return [
            'kode_produk_variant_sku_variant' => 'required|exists:product_variations,sku',
            'jumlah_stok' => 'required|integer|min:0',
            'tanggal_kadaluarsa_yyyy_mm_dd' => [
                'required',
                function ($attribute, $value, $fail) {
                    try {
                        if (empty($value)) {
                            $fail('Tanggal kadaluarsa tidak boleh kosong.');
                            return;
                        }

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
            'kode_produk_variant_sku_variant.exists' => 'SKU tidak ditemukan dalam database.',
            'jumlah_stok.min' => 'Jumlah stok harus bernilai non-negatif.',
            'tanggal_kadaluarsa_yyyy_mm_dd.required' => 'Tanggal kadaluarsa harus diisi.',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}
