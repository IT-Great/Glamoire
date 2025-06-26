<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Promo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexDashboard()
    {
        // Ambil produk utama dengan stok rendah (1-15)
        $lowStockProducts = Product::where('stock_quantity', '>', 0)
            ->where('stock_quantity', '<=', 15)
            ->count();

        // Ambil varian produk dengan stok rendah (1-15)
        $lowStockVariations = ProductVariations::where('variant_stock', '>', 0)
            ->where('variant_stock', '<=', 15)
            ->count();

        // Hitung total stok rendah
        $totalLowStock = $lowStockProducts + $lowStockVariations;

        // Hitung total order dengan status "processing"
        $totalProcessingOrders = Order::where('status', 'processing')->count();
        $totalPendingOrders = Order::where('status', 'pending')->count();
        $totalDeliveryOrders = Order::where('status', 'delivery')->count();

        // Hitung total promo yang ada
        $totalPromotions = Promo::count();

        $brands = Brand::all();
        $products = Product::all();
        $totalProducts = $products->count();

        return view('admin.dashboard.index', compact(
            'brands',
            'products',
            'totalProducts',
            'lowStockProducts',
            'lowStockVariations',
            'totalLowStock',
            'totalProcessingOrders',
            'totalPendingOrders', // Tambahkan variabel ini
            'totalDeliveryOrders', // Tambahkan variabel ini
            'totalPromotions', // Tambahkan variabel ini
        ));
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
