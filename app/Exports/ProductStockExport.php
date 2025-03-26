<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\ProductStocks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// class ProductStockExport implements FromCollection
// {
//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         // Mengambil data produk dengan fokus pada stok dan kadaluarsa
//         return Product::select('id', 'product_code', 'product_name', 'stock_quantity', 'date_expired')
//             ->where('stock_quantity', '>', 0) // Opsional: hanya produk dengan stok tersedia
//             ->get();
//     }

//     public function headings(): array
//     {
//         return [
//             'ID',
//             'Product Code',
//             'Product Name',
//             'Stock Quantity',
//             'Date Expired'
//         ];
//     }

//     public function map($product): array
//     {
//         return [
//             $product->id,
//             $product->product_code,
//             $product->product_name,
//             $product->stock_quantity,
//             $product->date_expired ?
//                 \Carbon\Carbon::parse($product->date_expired)->format('Y-m-d') :
//                 'N/A'
//         ];
//     }
// }

// bisa
// class ProductStockExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
// {
//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         return Product::select('id', 'product_code', 'product_name', 'stock_quantity', 'date_expired')
//             ->where('stock_quantity', '>', 0)
//             ->get();
//     }

//     /**
//      * @return array
//      */
//     public function headings(): array
//     {
//         return [
//             'ID',
//             'Kode Produk',
//             'Nama Produk',
//             'Jumlah Stok',
//             'Tanggal Kadaluarsa'
//         ];
//     }

//     /**
//      * @param Product $product
//      * @return array
//      */
//     public function map($product): array
//     {
//         return [
//             $product->id,
//             $product->product_code,
//             $product->product_name,
//             $product->stock_quantity,
//             $product->date_expired ?
//                 \Carbon\Carbon::parse($product->date_expired)->format('Y-m-d') :
//                 'N/A'
//         ];
//     }

//     /**
//      * Styling untuk header
//      */
//     public function styles(Worksheet $sheet)
//     {
//         return [
//             // Style header row
//             1 => [
//                 'font' => [
//                     'bold' => true,
//                     'color' => ['argb' => 'FFFFFF'],
//                 ],
//                 'fill' => [
//                     'fillType' => Fill::FILL_SOLID,
//                     'color' => ['argb' => '4287BFF0'],
//                 ],
//                 'alignment' => [
//                     'horizontal' => Alignment::HORIZONTAL_CENTER,
//                     'vertical' => Alignment::VERTICAL_CENTER,
//                 ],
//                 'borders' => [
//                     'allBorders' => [
//                         'borderStyle' => Border::BORDER_THIN,
//                         'color' => ['argb' => '000000'],
//                     ],
//                 ],
//             ],
//         ];
//     }

//     /**
//      * Event untuk mengatur lebar kolom otomatis
//      */
//     public function registerEvents(): array
//     {
//         return [
//             AfterSheet::class => function (AfterSheet $event) {
//                 $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
//                 $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
//                 $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(true);
//                 $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
//                 $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);
//             },
//         ];
//     }
// }

// bisa dan sesuai export semuanya
class ProductStockExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProductStocks::with('product')
            ->whereHas('product', function ($query) {
                $query->where('stock_quantity', '>', 0);
            })
            ->get()
            ->map(function ($productStock) {
                return [
                    'product_code' => $productStock->product->product_code,
                    'product_name' => $productStock->product->product_name,
                    'quantity' => $productStock->quantity,
                    'date_expired' => $productStock->date_expired,
                ];
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode Produk',
            'Nama Produk',
            'Jumlah Stok',
            'Tanggal Kadaluarsa'
        ];
    }

    /**
     * @param array $productStock
     * @return array
     */
    public function map($productStock): array
    {
        return [
            $productStock['product_code'],
            $productStock['product_name'],
            $productStock['quantity'],
            $productStock['date_expired'] ?
                \Carbon\Carbon::parse($productStock['date_expired'])->format('Y-m-d') :
                'N/A'
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
            },
        ];
    }
}


// bisa tapi masih kurang sesuai tmapilan export nya
// class ProductStockExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
// {
//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         // Group products and their stocks
//         $productStocks = ProductStocks::with('product')
//             ->get()
//             ->groupBy('product_id')
//             ->map(function ($stocks) {
//                 $product = $stocks->first()->product;
                
//                 return [
//                     'product_id' => $product->id,
//                     'product_code' => $product->product_code,
//                     'product_name' => $product->product_name,
//                     'current_stock' => $stocks->sum('quantity'), // Total stock from product_stocks table
//                     'stocks' => $stocks->map(function ($stock) {
//                         return [
//                             'quantity' => $stock->quantity,
//                             'date_expired' => $stock->date_expired,
//                         ];
//                     })->sortBy('date_expired')
//                 ];
//             });

//         // Prepare the final collection with formatted output
//         $formattedCollection = collect();
        
//         foreach ($productStocks as $product) {
//             // Add individual stock entries
//             foreach ($product['stocks'] as $stock) {
//                 $formattedCollection->push([
//                     'type' => 'stock_entry',
//                     'product_id' => $product['product_id'],
//                     'product_code' => $product['product_code'],
//                     'product_name' => $product['product_name'],
//                     'quantity' => $stock['quantity'],
//                     'date_expired' => $stock['date_expired']
//                 ]);
//             }

//             // Add total stock line
//             $formattedCollection->push([
//                 'type' => 'total_stock',
//                 'product_id' => $product['product_id'],
//                 'product_code' => $product['product_code'],
//                 'product_name' => $product['product_name'],
//                 'current_stock' => $product['current_stock']
//             ]);
//         }

//         return $formattedCollection;
//     }

//     /**
//      * @return array
//      */
//     public function headings(): array
//     {
//         return [
//             'ID Produk',
//             'Kode Produk',
//             'Nama Produk', 
//             'Jumlah Stok', 
//             'Tanggal Kadaluarsa'
//         ];
//     }

//     /**
//      * @param array $row
//      * @return array
//      */
//     public function map($row): array
//     {
//         if ($row['type'] === 'stock_entry') {
//             return [
//                 $row['product_id'],
//                 $row['product_code'],
//                 $row['product_name'],
//                 $row['quantity'],
//                 $row['date_expired'] ? 
//                     \Carbon\Carbon::parse($row['date_expired'])->format('Y-m-d') : 
//                     ''
//             ];
//         } elseif ($row['type'] === 'total_stock') {
//             return [
//                 $row['product_id'],
//                 $row['product_code'],
//                 $row['product_name'],
//                 "total stock {$row['product_name']} saat ini : {$row['current_stock']}",
//                 ''
//             ];
//         }

//         return [];
//     }

//     /**
//      * Styling for header
//      */
//     public function styles(Worksheet $sheet)
//     {
//         return [
//             1 => [
//                 'font' => [
//                     'bold' => true,
//                     'color' => ['argb' => 'FFFFFF'],
//                 ],
//                 'fill' => [
//                     'fillType' => Fill::FILL_SOLID,
//                     'color' => ['argb' => '4287BFF0'],
//                 ],
//                 'alignment' => [
//                     'horizontal' => Alignment::HORIZONTAL_CENTER,
//                     'vertical' => Alignment::VERTICAL_CENTER,
//                 ],
//                 'borders' => [
//                     'allBorders' => [
//                         'borderStyle' => Border::BORDER_THIN,
//                         'color' => ['argb' => '000000'],
//                     ],
//                 ],
//             ],
//         ];
//     }

//     /**
//      * Auto-size columns
//      */
//     public function registerEvents(): array
//     {
//         return [
//             AfterSheet::class => function (AfterSheet $event) {
//                 $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
//                 $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
//                 $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(true);
//                 $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
//                 $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);
//             },
//         ];
//     }
// }
