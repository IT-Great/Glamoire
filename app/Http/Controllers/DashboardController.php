<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexDashboard()
    {
        $brands = Brand::all();
        $products = Product::all();
        return view('admin.dashboard.index', compact('brands', 'products'));
    }

    // public function getSalesData(Request $request)
    // {
    //     // Ambil input dari request atau set default
    //     $startDate = $request->input('start_date', now()->subDays(6)->format('Y-m-d')); // Default 7 hari terakhir
    //     $endDate = $request->input('end_date', now()->format('Y-m-d')); // Default hari ini
    //     $brandId = $request->input('brand_id'); // Brand yang dipilih, default semua brand

    //     // Data dummy untuk 7 hari terakhir
    //     $categories = [];
    //     $salesData = [];

    //     // Menggunakan CarbonPeriod untuk menghasilkan rentang tanggal
    //     $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

    //     foreach ($period as $date) {
    //         $categories[] = $date->format('Y-m-d');
    //         $salesData[] = rand(50, 200); // Data acak penjualan antara 50 sampai 200
    //     }

    //     // Simulasi brand filtering, jika brand dipilih
    //     if ($brandId) {
    //         // Jika ada filter brand, ubah sedikit data dummy (misal untuk brand tertentu)
    //         $salesData = array_map(function ($value) {
    //             return $value * rand(1, 2); // Kalikan dengan nilai acak untuk variasi data
    //         }, $salesData);
    //     }

    //     return response()->json([
    //         'categories' => $categories, // Kategori berupa tanggal
    //         'data' => $salesData         // Data penjualan untuk setiap tanggal
    //     ]);
    // }

    public function getSalesData(Request $request)
    {
        // Ambil input dari request atau set default
        $startDate = $request->input('start_date', now()->subMonths(3)->format('Y-m-d')); // Default 3 bulan terakhir
        $endDate = $request->input('end_date', now()->format('Y-m-d')); // Default hari ini
        $brandId = $request->input('brand_id'); // Brand yang dipilih, default semua brand

        // Data dummy untuk 3 bulan terakhir
        $categories = [];
        $salesData = [];

        // Menggunakan CarbonPeriod untuk menghasilkan rentang tanggal
        $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $categories[] = $date->format('Y-m-d');
            $salesData[] = rand(50, 200); // Data acak penjualan antara 50 sampai 200
        }

        // Simulasi brand filtering, jika brand dipilih
        if ($brandId) {
            // Jika ada filter brand, ubah sedikit data dummy (misal untuk brand tertentu)
            $salesData = array_map(function ($value) {
                return $value * rand(1, 2); // Kalikan dengan nilai acak untuk variasi data
            }, $salesData);
        }

        return response()->json([
            'categories' => $categories, // Kategori berupa tanggal
            'data' => $salesData         // Data penjualan untuk setiap tanggal
        ]);
    }

    // data dinamis
    // public function getSalesData(Request $request)
    // {
    //     // Ambil input dari request atau set default
    //     $startDate = $request->input('start_date', now()->subMonths(3)->format('Y-m-d')); // Default 3 bulan terakhir
    //     $endDate = $request->input('end_date', now()->format('Y-m-d')); // Default hari ini
    //     $brandId = $request->input('brand_id'); // Brand yang dipilih, default semua brand

    //     // Ambil data penjualan dari database
    //     $salesQuery = DB::table('sales')
    //         ->select(DB::raw('DATE_FORMAT(date, "%Y-%m") as month'), DB::raw('SUM(amount) as total_sales'))
    //         ->whereBetween('date', [$startDate, $endDate]);

    //     // Filter berdasarkan brand jika ada
    //     if ($brandId) {
    //         $salesQuery->where('brand_id', $brandId);
    //     }

    //     $salesData = $salesQuery->groupBy('month')->get();

    //     // Persiapkan kategori dan data untuk chart
    //     $categories = [];
    //     $totalSales = [];

    //     foreach ($salesData as $sale) {
    //         $categories[] = \Carbon\Carbon::parse($sale->month)->format('F Y'); // Format: "September 2024"
    //         $totalSales[] = $sale->total_sales;
    //     }

    //     return response()->json([
    //         'categories' => $categories, // Kategori berupa bulan dan tahun
    //         'data' => $totalSales        // Data penjualan untuk setiap bulan
    //     ]);
    // }
}
