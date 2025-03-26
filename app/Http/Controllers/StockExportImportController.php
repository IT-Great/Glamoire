<?php

namespace App\Http\Controllers;

use App\Exports\ProductStockExport;
use App\Exports\ProductVariantExport;
use App\Exports\ProductVariantStockExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductStockImport;
use App\Imports\ProductStockVariantImport;
use App\Imports\ProductVariantImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException as ValidatorsValidationException;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill as StyleFill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

class StockExportImportController extends Controller
{
    public function exportProductStocks()
    {
        return Excel::download(new ProductStockExport, 'Product_Stock_Export_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function importProductStocks(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            $import = new ProductStockImport();
            Excel::import($import, $request->file('file'));

            return redirect()->back()->with('success', 'Product stocks imported successfully.');
        } catch (ValidatorsValidationException $e) {
            // Detailed error logging
            Log::error('Product Stock Import Validation Error: ' . $e->getMessage());

            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }

            return redirect()->back()->with('error', implode('<br>', $errorMessages));
        } catch (\Exception $e) {
            // Log the full error for debugging
            Log::error('Product Stock Import Error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()->with('error', 'Error importing product stocks: ' . $e->getMessage());
        }
    }


    public function downloadProductStockTemplate()
    {
        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $headers = [
            'Kode Produk / SKU',
            'Jumlah Stok',
            'Tanggal Kadaluarsa (YYYY-MM-DD)',
        ];

        // Write headers with styling
        foreach ($headers as $col => $header) {
            $cell = $sheet->getCellByColumnAndRow($col + 1, 1);
            $cell->setValue($header);

            // Styling header row
            $style = $cell->getStyle();
            $style->getFill()
                ->setFillType(StyleFill::FILL_SOLID)
                ->getStartColor()->setARGB('4287BFF0');

            $style->getFont()
                ->setBold(true)
                ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));

            $style->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $style->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->getColor()->setARGB('000000');
        }

        // Add some example data rows (optional)
        $exampleData = [
            ['KIM4970002', 100, '2024-12-31'],
            ['KIM4970001', 50, '2024-06-30']
        ];

        foreach ($exampleData as $rowIndex => $rowData) {
            foreach ($rowData as $colIndex => $cellData) {
                $cell = $sheet->getCellByColumnAndRow($colIndex + 1, $rowIndex + 2);

                // For the date column (index 2), set as date
                if ($colIndex == 2) {
                    $cell->setValue(\PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(strtotime($cellData)));
                } else {
                    $cell->setValue($cellData);
                }
            }
        }

        // Format the date column
        $dateColumn = $sheet->getStyleByColumnAndRow(3, 2, 3, count($exampleData) + 1);
        $dateColumn->getNumberFormat()
            ->setFormatCode('DD/MM/YYYY');

        // Auto-size columns
        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Prepare the file
        $filename = 'Product_Stock_Import_Template_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Redirect output to a client's web browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create Excel file
        $writer = new WriterXlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


    // // Export Product Variants
    // public function exportProductVariants()
    // {
    //     return Excel::download(new ProductVariantExport, 'product_variants.xlsx');
    // }

    public function exportProductVariants()
    {
        return Excel::download(new ProductVariantExport, 'Product_Variant_Stock_Export_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function importProductStockVariants(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            // Import the file
            Excel::import(new ProductVariantImport(), $request->file('file'));

            return redirect()->back()->with('success', 'Product stock variants imported successfully.');
        } catch (ValidatorsValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];

            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }

            return redirect()->back()->with('error', implode('<br>', $errorMessages));
        } catch (\Exception $e) {
            Log::error('Import Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while importing: ' . $e->getMessage());
        }
    }


    // public function downloadProductStockVariantTemplate()
    // {
    //     // Create a new Spreadsheet
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     // Set column headers
    //     $headers = [
    //         'Kode Produk Variant / SKU Variant',
    //         'Jumlah Stok',
    //         'Tanggal Kadaluarsa (YYYY-MM-DD)', // Pastikan ini sesuai
    //     ];

    //     // Write headers with styling
    //     foreach ($headers as $col => $header) {
    //         $cell = $sheet->getCellByColumnAndRow($col + 1, 1);
    //         $cell->setValue($header);

    //         // Styling header row
    //         $style = $cell->getStyle();
    //         $style->getFill()
    //             ->setFillType(StyleFill::FILL_SOLID)
    //             ->getStartColor()->setARGB('4287BFF0');

    //         $style->getFont()
    //             ->setBold(true)
    //             ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));

    //         $style->getAlignment()
    //             ->setHorizontal(Alignment::HORIZONTAL_CENTER)
    //             ->setVertical(Alignment::VERTICAL_CENTER);

    //         $style->getBorders()
    //             ->getOutline()
    //             ->setBorderStyle(Border::BORDER_THIN)
    //             ->getColor()->setARGB('000000');
    //     }

    //     // Add some example data rows (optional)
    //     $exampleData = [
    //         ['KIM4970001-BAH-KAT', 100, '2024-12-31'],
    //         ['ROS5460001-WAR-PUT', 50, '2024-06-30']
    //     ];

    //     foreach ($exampleData as $rowIndex => $rowData) {
    //         foreach ($rowData as $colIndex => $cellData) {
    //             $cell = $sheet->getCellByColumnAndRow($colIndex + 1, $rowIndex + 2);

    //             // For the date column (index 2), set as date
    //             if ($colIndex == 2) {
    //                 $cell->setValue(\PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(strtotime($cellData)));
    //             } else {
    //                 $cell->setValue($cellData);
    //             }
    //         }
    //     }

    //     // Format the date column
    //     $dateColumn = $sheet->getStyleByColumnAndRow(3, 2, 3, count($exampleData) + 1);
    //     $dateColumn->getNumberFormat()
    //         ->setFormatCode('YYYY-MM-DD');

    //     // Auto-size columns
    //     foreach (range('A', 'C') as $columnID) {
    //         $sheet->getColumnDimension($columnID)->setAutoSize(true);
    //     }

    //     // Prepare the file
    //     $filename = 'Product_Stock_Variant_Import_Template_' . date('Y-m-d_H-i-s') . '.xlsx';

    //     // Redirect output to a client's web browser
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');

    //     // Create Excel file
    //     $writer = new WriterXlsx($spreadsheet);
    //     $writer->save('php://output');
    //     exit;
    // }

    public function downloadProductStockVariantTemplate()
    {
        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $headers = [
            'Kode Produk Variant / SKU Variant',
            'Jumlah Stok',
            'Tanggal Kadaluarsa (YYYY-MM-DD)', // Pastikan ini sesuai
        ];

        // Write headers with styling
        foreach ($headers as $col => $header) {
            $cell = $sheet->getCellByColumnAndRow($col + 1, 1);
            $cell->setValue($header);

            // Styling header row
            $style = $cell->getStyle();
            $style->getFill()
                ->setFillType(StyleFill::FILL_SOLID)
                ->getStartColor()->setARGB('4287BFF0');

            $style->getFont()
                ->setBold(true)
                ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));

            $style->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $style->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->getColor()->setARGB('000000');
        }

        // Add some example data rows (optional)
        $exampleData = [
            ['KIM4970001-BAH-KAT', 100, '2024-12-31'],
            ['ROS5460001-WAR-PUT', 50, '2024-06-30']
        ];

        foreach ($exampleData as $rowIndex => $rowData) {
            foreach ($rowData as $colIndex => $cellData) {
                $cell = $sheet->getCellByColumnAndRow($colIndex + 1, $rowIndex + 2);

                // For the date column (index 2), set as date
                if ($colIndex == 2) {
                    $cell->setValue(\PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(strtotime($cellData)));
                } else {
                    $cell->setValue($cellData);
                }
            }
        }

        // Format the date column
        $dateColumn = $sheet->getStyleByColumnAndRow(3, 2, 3, count($exampleData) + 1);
        $dateColumn->getNumberFormat()
            ->setFormatCode('YYYY-MM-DD');

        // Auto-size columns
        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Prepare the file
        $filename = 'Product_Stock_Variant_Import_Template_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Redirect output to a client's web browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create Excel file
        $writer = new WriterXlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
