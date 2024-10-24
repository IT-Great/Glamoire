<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;


class InvoiceController extends Controller
{
    public function indexInvoice() {
        return view('accounting.invoice.index');
    }

    public function createInvoice() {
        return view('accounting.invoice.create');
    }

    public function storeInvoice() {

    }

    public function editInvoice() {

    }

    public function updateInvoice() {

    }

    public function deleteInvoice() {

    }

    public function viewInvoiceUser($noInvoice)
    {
        $formattedInvoice = substr_replace($noInvoice, '/', 3, 0);  // Menambahkan slash setelah INV
        $formattedInvoice = substr_replace($formattedInvoice, '/', 12, 0); // Menambahkan slash setelah tanggal
        $formattedInvoice = substr_replace($formattedInvoice, '/', 16, 0); // Menambahkan slash sebelum angka terakhir

        $invoiceId = Invoice::where('no_invoice', $formattedInvoice)->value('id');
        $order = Order::where('invoice_id', $invoiceId)
        ->with(['shippingAddress', 'user'])
        ->first();
        $payment = Payment::where('order_id', $order->id)
        ->where('user_id', $order->user_id)
        ->first();
        $orderItem = OrderItem::where('order_id', $order->id)
        ->with(['product'])
        ->get();

        // dd($orderItem);
        
        // Jika invoice ditemukan, lanjutkan
        return view('invoice', [
            'invoice'   => $formattedInvoice,
            'order'     => $order,
            'payment'   => $payment,
            'orderItem' => $orderItem,
        ]);
    }
}
