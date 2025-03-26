<?php

namespace App\Exports;

use App\Models\ProductStocks;
use App\Models\ProductVariations;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Events\AfterSheet;

// class ProductVariantExport implements FromCollection
// {
//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         // Mengambil data product variations dengan relasi product
//         return ProductVariations::with('product')->get();
//     }

//     public function headings(): array
//     {
//         return [
//             'ID',
//             'Product ID',
//             'Product Name',
//             'SKU',
//             'Variant Type',
//             'Variant Value',
//             'Variant Stock',
//             'Variant Price',
//             'Weight Variant',
//             'Variant Image',
//             'Created At',
//             'Updated At'
//         ];
//     }

//     public function map($variant): array
//     {
//         return [
//             $variant->id,
//             $variant->product_id,
//             $variant->product ? $variant->product->product_name : 'N/A',
//             $variant->sku,
//             $variant->variant_type,
//             $variant->variant_value,
//             $variant->variant_stock,
//             $variant->variant_price,
//             $variant->weight_variant,
//             $variant->variant_image,
//             $variant->created_at,
//             $variant->updated_at
//         ];
//     }
// }


class ProductVariantExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retrieve product variants with stock information
        return ProductVariations::with(['product'])
            ->whereNotNull('variant_stock') // Fokus pada variant yang memiliki stok
            ->where('variant_stock', '>', 0) // Hanya variant dengan stok > 0
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Variant',
            'SKU Variant',
            'Nama Produk',
            'Tipe Variant',
            'Nilai Variant',
            'Jumlah Stok',
            'Harga Variant',    
            'Berat Variant',
            'Tanggal Kadaluarsa'
        ];
    }

    /**
     * @param ProductStocks $stock
     * @return array
     */
    public function map($variant): array
    {
        return [
            $variant->id,
            $variant->sku,
            $variant->product ? $variant->product->product_name : 'N/A',
            $variant->variant_type,
            $variant->variant_value,
            $variant->variant_stock ?? 'N/A',
            $variant->variant_price ?? 'N/A',
            $variant->weight_variant ?? 'N/A',
            $variant->variant_expired ?? 'N/A'
        ];
    }

    /**
     * Styling untuk header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style header row
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['argb' => '4287BFF0'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Event untuk mengatur lebar kolom otomatis
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('H')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('I')->setAutoSize(true);
            },
        ];
    }
}
