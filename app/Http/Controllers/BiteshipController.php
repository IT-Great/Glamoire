<?php

// namespace App\Http\Controllers;

// use App\Models\Order;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

// class BiteshipController extends Controller
// {
//     public function callback(Request $request)
//     {
//         try {
//             Log::info('Biteship Webhook orderan:', $request->all());
            
//             if($request->status == 'delivered'){
//                 $order = Order::where('resi', $request->courier_waybill_id)->update([
//                     'status' => 'completed',
//                 ]);

//                 Log::info(['Success update order :' => $order]);
//             }

//             return response('ok', 200)
//                 ->header('Content-Type', 'text/plain');
//         } catch (\Exception $e) {
//             Log::error('Biteship Callback Error: ' . $e->getMessage());
//             return response('error', 500);
//         }
//     }
// }

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BiteshipController extends Controller
{
    public function callback(Request $request)
    {
        try {
            Log::info('Biteship Webhook orderan:', $request->all());
            
            $status = strtolower($request->status);
            $resi = $request->courier_waybill_id;

            // Cari order berdasarkan nomor resi
            $order = Order::with('orderItems')->where('resi', $resi)->first();

            if (!$order) {
                Log::warning("Biteship Webhook: Order dengan resi {$resi} tidak ditemukan.");
                return response('ok', 200)->header('Content-Type', 'text/plain');
            }

            // 1. JIKA STATUS DELIVERED (SELESAI)
            if($status == 'delivered'){
                $order->update(['status' => 'completed']);
                Log::info("Success update order to completed : {$resi}");
            }

            // 2. JIKA STATUS GAGAL PENGIRIMAN (CANCELLED, RETURNED, DISPOSED)
            $failedStatuses = ['cancelled', 'returned', 'disposed'];
            
            if (in_array($status, $failedStatuses)) {
                // Validasi agar stok tidak direstore 2x jika webhook terpanggil berulang kali
                if (!in_array($order->status, $failedStatuses)) {
                    
                    DB::transaction(function () use ($order, $status) {
                        // Restore (Kembalikan) Stok dan Kurangi Jumlah Sale
                        foreach ($order->orderItems as $item) {
                            if ($item->product_variant_id) {
                                $variant = ProductVariations::lockForUpdate()->find($item->product_variant_id);
                                if ($variant) {
                                    $variant->increment('variant_stock', $item->quantity);
                                    $variant->decrement('sale', $item->quantity);
                                }
                            } else {
                                $product = Product::lockForUpdate()->find($item->product_id);
                                if ($product) {
                                    $product->increment('stock_quantity', $item->quantity);
                                    $product->decrement('sale', $item->quantity);
                                }
                            }
                        }

                        // Update status order menjadi sesuai respon biteship (cancelled/returned/disposed)
                        $order->update(['status' => $status]);
                    });

                    Log::info("Order {$resi} status changed to {$status}. Stock has been restored.");
                }
            }

            return response('ok', 200)->header('Content-Type', 'text/plain');
            
        } catch (\Exception $e) {
            Log::error('Biteship Callback Error: ' . $e->getMessage());
            return response('error', 500);
        }
    }
}
