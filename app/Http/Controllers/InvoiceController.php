<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Models\Invoice_Supplier;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Supplier_Data;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function indexInvoice()
    {
        $invoices = Invoice_Supplier::all();

        return view('accounting.invoice.index', [
            'invoices' => $invoices
        ]);
    }

    public function createInvoice()
    {
        $coas = Coa::all();
        $suppliers = Supplier_Data::all();

        return view('accounting.invoice.create', [
            'coas' => $coas,
            'suppliers' => $suppliers
        ]);
    }

    public function storeInvoice(Request $request)
    {
        try {
            $request->validate([
                'no_invoice' => 'required',
                'supplier_id' => 'required',
                'amount' => 'required|numeric',
                // 'kredit_coa_id' => 'required',
                // 'debit_coa_id' => 'required',
                'image_invoice' => 'required',
            ]);

            Invoice_Supplier::create([
                'no_invoice' => $request->no_invoice,
                'supplier_id' => $request->supplier_id,
                'amount' => $request->amount,
                'kredit_coa_id' => $request->kredit_coa_id,
                'debit_coa_id' => $request->debit_coa_id,
                'image_invoice' => $request->image_invoice,
            ]);

            return redirect()->route('index-invoice')->with('success', 'Add Invoice successfully!');
        } catch (\Exception $e) {
            Log::error('Error adding invoice: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Failed to add invoice. Please check the log.');
        }
    }

    public function editInvoice() {}

    public function updateInvoice() {}

    public function deleteInvoice() {}

    public function indexSupplier()
    {
        $suppliers = Supplier_Data::all();
        return view('accounting.invoice.index-supplier', compact('suppliers'));
    }

    public function createSupplier()
    {
        return view('accounting.invoice.create-supplier');
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
        ]);

        Supplier_Data::create([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'post_code' => $request->post_code,
            'description' => $request->description,

        ]);

        return redirect()->route('index-supplier')->with('success', 'Add Supplier successfully!');
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
