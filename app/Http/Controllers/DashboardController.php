<?php

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Models\Brand;
// use App\Models\Order;
// use App\Models\Product;
// use App\Models\ProductVariations;
// use App\Models\Promo;
// use Illuminate\Http\Request;

// class DashboardController extends Controller
// {
//     public function indexDashboard()
//     {
//         // Ambil produk utama dengan stok rendah (1-15)
//         $lowStockProducts = Product::where('stock_quantity', '>', 0)
//             ->where('stock_quantity', '<=', 15)
//             ->count();

//         // Ambil varian produk dengan stok rendah (1-15)
//         $lowStockVariations = ProductVariations::where('variant_stock', '>', 0)
//             ->where('variant_stock', '<=', 15)
//             ->count();

//         // Hitung total stok rendah
//         $totalLowStock = $lowStockProducts + $lowStockVariations;

//         // Hitung total order dengan status "processing"
//         $totalProcessingOrders = Order::where('status', 'processing')->count();
//         $totalPendingOrders = Order::where('status', 'pending')->count();
//         $totalDeliveryOrders = Order::where('status', 'delivery')->count();

//         // Hitung total promo yang ada
//         $totalPromotions = Promo::count();

//         $brands = Brand::all();
//         $products = Product::all();
//         $totalProducts = $products->count();

//         return view('admin.dashboard.index', compact(
//             'brands',
//             'products',
//             'totalProducts',
//             'lowStockProducts',
//             'lowStockVariations',
//             'totalLowStock',
//             'totalProcessingOrders',
//             'totalPendingOrders', // Tambahkan variabel ini
//             'totalDeliveryOrders', // Tambahkan variabel ini
//             'totalPromotions', // Tambahkan variabel ini
//         ));
//     }

//     // public function getSalesData(Request $request)
//     // {
//     //     // Ambil input dari request atau set default
//     //     $startDate = $request->input('start_date', now()->subDays(6)->format('Y-m-d')); // Default 7 hari terakhir
//     //     $endDate = $request->input('end_date', now()->format('Y-m-d')); // Default hari ini
//     //     $brandId = $request->input('brand_id'); // Brand yang dipilih, default semua brand

//     //     // Data dummy untuk 7 hari terakhir
//     //     $categories = [];
//     //     $salesData = [];

//     //     // Menggunakan CarbonPeriod untuk menghasilkan rentang tanggal
//     //     $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

//     //     foreach ($period as $date) {
//     //         $categories[] = $date->format('Y-m-d');
//     //         $salesData[] = rand(50, 200); // Data acak penjualan antara 50 sampai 200
//     //     }

//     //     // Simulasi brand filtering, jika brand dipilih
//     //     if ($brandId) {
//     //         // Jika ada filter brand, ubah sedikit data dummy (misal untuk brand tertentu)
//     //         $salesData = array_map(function ($value) {
//     //             return $value * rand(1, 2); // Kalikan dengan nilai acak untuk variasi data
//     //         }, $salesData);
//     //     }

//     //     return response()->json([
//     //         'categories' => $categories, // Kategori berupa tanggal
//     //         'data' => $salesData         // Data penjualan untuk setiap tanggal
//     //     ]);
//     // }

//     public function getSalesData(Request $request)
//     {
//         // Ambil input dari request atau set default
//         $startDate = $request->input('start_date', now()->subMonths(3)->format('Y-m-d')); // Default 3 bulan terakhir
//         $endDate = $request->input('end_date', now()->format('Y-m-d')); // Default hari ini
//         $brandId = $request->input('brand_id'); // Brand yang dipilih, default semua brand

//         // Data dummy untuk 3 bulan terakhir
//         $categories = [];
//         $salesData = [];

//         // Menggunakan CarbonPeriod untuk menghasilkan rentang tanggal
//         $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

//         foreach ($period as $date) {
//             $categories[] = $date->format('Y-m-d');
//             $salesData[] = rand(50, 200); // Data acak penjualan antara 50 sampai 200
//         }

//         // Simulasi brand filtering, jika brand dipilih
//         if ($brandId) {
//             // Jika ada filter brand, ubah sedikit data dummy (misal untuk brand tertentu)
//             $salesData = array_map(function ($value) {
//                 return $value * rand(1, 2); // Kalikan dengan nilai acak untuk variasi data
//             }, $salesData);
//         }

//         return response()->json([
//             'categories' => $categories, // Kategori berupa tanggal
//             'data' => $salesData         // Data penjualan untuk setiap tanggal
//         ]);
//     }

//     // data dinamis
//     // public function getSalesData(Request $request)
//     // {
//     //     // Ambil input dari request atau set default
//     //     $startDate = $request->input('start_date', now()->subMonths(3)->format('Y-m-d')); // Default 3 bulan terakhir
//     //     $endDate = $request->input('end_date', now()->format('Y-m-d')); // Default hari ini
//     //     $brandId = $request->input('brand_id'); // Brand yang dipilih, default semua brand

//     //     // Ambil data penjualan dari database
//     //     $salesQuery = DB::table('sales')
//     //         ->select(DB::raw('DATE_FORMAT(date, "%Y-%m") as month'), DB::raw('SUM(amount) as total_sales'))
//     //         ->whereBetween('date', [$startDate, $endDate]);

//     //     // Filter berdasarkan brand jika ada
//     //     if ($brandId) {
//     //         $salesQuery->where('brand_id', $brandId);
//     //     }

//     //     $salesData = $salesQuery->groupBy('month')->get();

//     //     // Persiapkan kategori dan data untuk chart
//     //     $categories = [];
//     //     $totalSales = [];

//     //     foreach ($salesData as $sale) {
//     //         $categories[] = \Carbon\Carbon::parse($sale->month)->format('F Y'); // Format: "September 2024"
//     //         $totalSales[] = $sale->total_sales;
//     //     }

//     //     return response()->json([
//     //         'categories' => $categories, // Kategori berupa bulan dan tahun
//     //         'data' => $totalSales        // Data penjualan untuk setiap bulan
//     //     ]);
//     // }
// }

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB; // Tambahkan facade DB jika diperlukan nanti

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

        // Hitung total order berdasarkan status
        $totalProcessingOrders = Order::where('status', 'processing')->count();
        $totalPendingOrders = Order::where('status', 'pending')->count();
        $totalDeliveryOrders = Order::where('status', 'delivery')->count();

        // FITUR BARU: Hitung pesanan yang dibatalkan
        $totalCancelledOrders = Order::where('status', 'cancelled')->count();

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
            'totalPendingOrders',
            'totalDeliveryOrders',
            'totalCancelledOrders', // Kirim ke blade
            'totalPromotions',
        ));
    }

    // public function getSalesData(Request $request)
    // {
    //     // Ambil input dari request atau set default
    //     $startDate = $request->input('start_date', now()->subMonths(3)->format('Y-m-d')); // Default 3 bulan terakhir
    //     $endDate = $request->input('end_date', now()->format('Y-m-d')); // Default hari ini
    //     $brandId = $request->input('brand_id'); // Brand yang dipilih, default semua brand

    //     // Data dummy untuk 3 bulan terakhir
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
        $startDate = $request->input('start_date', now()->subMonths(3)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        $brandId = $request->input('brand_id');

        $query = Order::query()
            ->select(DB::raw('DATE(order_date) as date'), DB::raw('SUM(total_amount) as total'))
            ->whereBetween('order_date', [$startDate, $endDate])
            ->where('status', 'completed');

        // Jika filter brand dipilih (opsional: asumsi order memiliki relasi orderItems -> product -> brand)
        if ($brandId) {
            $query->whereHas('orderItems.product', function ($q) use ($brandId) {
                $q->where('brand_id', $brandId);
            });
        }

        $salesData = $query->groupBy('date')->orderBy('date', 'ASC')->get();

        return response()->json([
            'categories' => $salesData->pluck('date'),
            'data' => $salesData->pluck('total'),
        ]);
    }

    /**
     * Mendapatkan data Pemasukan Mingguan (7 hari terakhir)
     */
    public function getWeeklyIncome()
    {
        $startDate = Carbon::today()->subDays(6); // 7 hari termasuk hari ini
        $endDate = Carbon::today();

        // Query pendapatan per hari dari order yang 'completed'
        $incomes = Order::select(
                DB::raw('DATE(order_date) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereBetween('order_date', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->where('status', 'completed')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->keyBy('date'); // Jadikan tanggal sebagai key array

        $categories = [];
        $data = [];

        // Looping 7 hari terakhir agar tanggal yang kosong (0 penjualan) tetap tampil
        for ($i = 0; $i < 7; $i++) {
            $dateStr = $startDate->copy()->addDays($i)->format('Y-m-d');
            $dayName = $startDate->copy()->addDays($i)->translatedFormat('l'); // Nama hari (Senin, Selasa, dll)

            $categories[] = $dayName;

            // Jika ada data di tanggal tersebut ambil totalnya, jika tidak 0
            $data[] = isset($incomes[$dateStr]) ? $incomes[$dateStr]->total : 0;
        }

        return response()->json([
            'categories' => $categories,
            'data' => $data
        ]);
    }

    /**
     * Mendapatkan Performa Promo/Diskon
     * Asumsi: Promo memiliki relasi dengan order atau kita bandingkan data order yang menggunakan promo vs tidak
     */
    public function getPromoPerformance(Request $request)
    {
        // Default 14 hari terakhir untuk chart
        $startDate = Carbon::today()->subDays(13);
        $endDate = Carbon::today();

        $categories = [];
        $salesData = [];
        $buyersData = [];

        for ($i = 0; $i < 14; $i++) {
            $dateStr = $startDate->copy()->addDays($i)->format('Y-m-d');
            $displayDate = $startDate->copy()->addDays($i)->format('d/m');
            $categories[] = $displayDate;

            // Hitung total penjualan HANYA dari order yang menggunakan voucher/promo di hari tersebut
            // Asumsi: tabel orders memiliki kolom 'promo_id' atau 'voucher_id' atau 'discount_amount' > 0
            $dailyPromoOrders = Order::whereDate('order_date', $dateStr)
                ->where('status', 'completed')
                ->whereNotNull('promo_id') // Sesuaikan dengan nama kolom promo/voucher Anda di DB
                ->get();

            $salesData[] = $dailyPromoOrders->sum('total_amount');
            $buyersData[] = $dailyPromoOrders->unique('user_id')->count(); // Hitung unique buyer
        }

        return response()->json([
            'categories' => $categories,
            'salesData' => $salesData,
            'buyersData' => $buyersData
        ]);
    }
}
