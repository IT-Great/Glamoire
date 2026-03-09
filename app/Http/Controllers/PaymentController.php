<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        try {
            $order = Order::where('order_id', $request->order_id)
                         ->with(['orderItems.product', 'shippingAddress'])
                         ->firstOrFail();

            // Memastikan user hanya bisa melihat order miliknya sendiri
            if ($order->user_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }

            return view('payment.success', [
                'order' => $order,
                'pageTitle' => 'Pembayaran Berhasil'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'Order tidak ditemukan.');
        }
    }

    public function paymentFailed(Request $request)
    {
        try {
            $order = Order::where('order_id', $request->order_id)
                         ->with(['orderItems.product'])
                         ->firstOrFail();

            // Memastikan user hanya bisa melihat order miliknya sendiri
            if ($order->user_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }

            return view('payment.failed', [
                'order' => $order,
                'pageTitle' => 'Pembayaran Gagal'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'Order tidak ditemukan.');
        }
    }

}
