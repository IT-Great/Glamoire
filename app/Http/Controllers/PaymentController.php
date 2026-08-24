<?php

// namespace App\Http\Controllers;

// use App\Models\Order;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

// class PaymentController extends Controller
// {
//     public function paymentSuccess(Request $request)
//     {
//         try {
//             $order = Order::where('order_id', $request->order_id)
//                          ->with(['orderItems.product', 'shippingAddress'])
//                          ->firstOrFail();

//             // Memastikan user hanya bisa melihat order miliknya sendiri
//             if ($order->user_id !== auth()->id()) {
//                 abort(403, 'Unauthorized action.');
//             }

//             return view('payment.success', [
//                 'order' => $order,
//                 'pageTitle' => 'Pembayaran Berhasil'
//             ]);
//         } catch (\Exception $e) {
//             return redirect()->route('checkout')->with('error', 'Order tidak ditemukan.');
//         }
//     }

//     public function paymentFailed(Request $request)
//     {
//         try {
//             $order = Order::where('order_id', $request->order_id)
//                          ->with(['orderItems.product'])
//                          ->firstOrFail();

//             // Memastikan user hanya bisa melihat order miliknya sendiri
//             if ($order->user_id !== auth()->id()) {
//                 abort(403, 'Unauthorized action.');
//             }

//             return view('payment.failed', [
//                 'order' => $order,
//                 'pageTitle' => 'Pembayaran Gagal'
//             ]);
//         } catch (\Exception $e) {
//             return redirect()->route('checkout')->with('error', 'Order tidak ditemukan.');
//         }
//     }
// }

// namespace App\Http\Controllers;

// use App\Models\Order;
// use App\Models\Invoice;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

// class PaymentController extends Controller
// {
//     public function paymentSuccess(Request $request)
//     {
//         try {
//             // Logika pencarian Order melalui nomor Invoice (Karena Xendit mengembalikan query string ?invoice=)
//             if ($request->has('invoice')) {
//                 $invoice = Invoice::where('no_invoice', $request->invoice)->firstOrFail();
//                 $order = Order::where('invoice_id', $invoice->id)->with(['orderItems.product', 'shippingAddress'])->firstOrFail();
//             } else {
//                 // Fallback sistem lama
//                 $order = Order::where('order_id', $request->order_id)->with(['orderItems.product', 'shippingAddress'])->firstOrFail();
//             }

//             // Memastikan user hanya bisa melihat order miliknya sendiri
//             if ($order->user_id !== auth()->id()) {
//                 abort(403, 'Unauthorized action.');
//             }

//             return view('payment.success', [
//                 'order' => $order,
//                 'pageTitle' => 'Pembayaran Berhasil'
//             ]);
//         } catch (\Exception $e) {
//             return redirect()->route('checkout')->with('error', 'Order tidak ditemukan.');
//         }
//     }

//     public function paymentFailed(Request $request)
//     {
//         try {
//             if ($request->has('invoice')) {
//                 $invoice = Invoice::where('no_invoice', $request->invoice)->firstOrFail();
//                 $order = Order::where('invoice_id', $invoice->id)->with(['orderItems.product'])->firstOrFail();
//             } else {
//                 $order = Order::where('order_id', $request->order_id)->with(['orderItems.product'])->firstOrFail();
//             }

//             if ($order->user_id !== auth()->id()) {
//                 abort(403, 'Unauthorized action.');
//             }

//             return view('payment.failed', [
//                 'order' => $order,
//                 'pageTitle' => 'Pembayaran Gagal'
//             ]);
//         } catch (\Exception $e) {
//             return redirect()->route('checkout')->with('error', 'Order tidak ditemukan.');
//         }
//     }
// }

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        try {
            if ($request->has('invoice')) {
                // Decode karakter URL (%2F menjadi /)
                $invoiceNum = urldecode($request->invoice);
                $invoice = Invoice::where('no_invoice', $invoiceNum)->firstOrFail();
                $order = Order::where('invoice_id', $invoice->id)->with(['orderItems.product', 'shippingAddress'])->firstOrFail();
            } else {
                // Fallback sistem lama
                $order = Order::where('order_id', $request->order_id)->with(['orderItems.product', 'shippingAddress'])->firstOrFail();
            }

            // Mendukung login session standar & login manual buatan sendiri
            $currentUserId = auth()->id() ?? session('id_user');
            if ($order->user_id !== $currentUserId) {
                abort(403, 'Unauthorized action.');
            }

            return view('payment.success', [
                'order' => $order,
                'pageTitle' => 'Pembayaran Berhasil'
            ]);
        } catch (\Exception $e) {
            // Jika ada error atau tidak valid, redirect aman ke beranda
            return redirect('/')->with('error', 'Terjadi kesalahan atau pesanan tidak ditemukan.');
        }
    }

    public function paymentFailed(Request $request)
    {
        try {
            if ($request->has('invoice')) {
                $invoiceNum = urldecode($request->invoice);
                $invoice = Invoice::where('no_invoice', $invoiceNum)->firstOrFail();
                $order = Order::where('invoice_id', $invoice->id)->with(['orderItems.product'])->firstOrFail();
            } else {
                $order = Order::where('order_id', $request->order_id)->with(['orderItems.product'])->firstOrFail();
            }

            $currentUserId = auth()->id() ?? session('id_user');
            if ($order->user_id !== $currentUserId) {
                abort(403, 'Unauthorized action.');
            }

            return view('payment.failed', [
                'order' => $order,
                'pageTitle' => 'Pembayaran Gagal'
            ]);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Terjadi kesalahan atau pesanan tidak ditemukan.');
        }
    }
}
