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
use App\Models\PaymentHistories;
use App\Models\Supplier_Data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function indexInvoice(Request $request)
    {
        $query = Invoice_Supplier::with('supplier');

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        // Filter by supplier
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by payment method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by invoice number
        if ($request->filled('no_invoice')) {
            $query->where('no_invoice', 'like', '%' . $request->no_invoice . '%');
        }

        // Filter by amount range
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }

        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }

        // Filter by deadline range
        if ($request->filled('start_deadline')) {
            $query->whereDate('deadline_invoice', '>=', $request->start_deadline);
        }

        if ($request->filled('end_deadline')) {
            $query->whereDate('deadline_invoice', '<=', $request->end_deadline);
        }

        // Get all suppliers for the dropdown
        $suppliers = \App\Models\Supplier_Data::orderBy('name')->get();

        // Get COAs for the dropdown if needed
        $coas = \App\Models\Coa::orderBy('name')->get();

        $invoices = $query->latest()->get();

        return view('accounting.invoice.index', compact('invoices', 'suppliers', 'coas'));
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
        $request->validate([
            'no_invoice' => 'required',
            'supplier_id' => 'required',
            'amount' => 'required|numeric',
            'kredit_coa_id' => 'required',
            'debit_coa_id' => 'required',
            'image_invoice' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {

            // Create directory if it doesn't exist
            $path = public_path('storage/invoice_images');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Handle file upload
            $imageName = null;
            if ($request->hasFile('image_invoice')) {
                $image = $request->file('image_invoice');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move($path, $imageName);
            }

            Invoice_Supplier::create([
                'no_invoice' => $request->no_invoice,
                'supplier_id' => $request->supplier_id,
                'amount' => $request->amount,
                'kredit_coa_id' => $request->kredit_coa_id,
                'debit_coa_id' => $request->debit_coa_id,
                'image_invoice' => 'invoice_images/' . $imageName, // Hapus 'storage/' dari sini
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

    public function viewProcessPayment($id)
    {
        $invoice = Invoice_Supplier::with('supplier')->findOrFail($id);
        $coas = Coa::all(); // Assuming you have a Coa model

        return view('accounting.invoice.payment', compact('invoice', 'coas'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoice_suppliers,id',
            'payment_date' => 'required|date',
            'payment_method' => 'required',
            'kredit_coa_id' => 'required|exists:coas,id',
            'debit_coa_id' => 'required|exists:coas,id',
            'amount' => 'required|numeric|min:1',
            'image_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // max:5120 = 5MB
        ]);

        try {
            $invoice = Invoice_Supplier::findOrFail($request->invoice_id);

            // Check if the invoice is already paid
            if ($invoice->payment_status == 'Paid') {
                return redirect()->back()->with('error', 'Invoice is already paid.');
            }

            // Handle payment proof upload if provided
            $proofPath = null;
            if ($request->hasFile('image_proof')) {
                $proofPath = $request->file('image_proof')->store('payment_proofs', 'public');
            }

            // Update invoice details
            $invoice->payment_status = 'Paid';
            $invoice->payment_method = $request->payment_method;
            $invoice->kredit_coa_id = $request->kredit_coa_id;
            $invoice->debit_coa_id = $request->debit_coa_id;
            $invoice->image_proof = $proofPath;
            $invoice->save();

            // Create a payment record in payment_histories table
            $payment = new PaymentHistories([
                'invoice_id' => $invoice->id,
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'reference_number' => $request->reference_number,
                'notes' => $request->payment_notes,
                'processed_by' => auth()->id(),
            ]);
            $payment->save();


            return redirect()->route('index-invoice')->with('success', 'Payment processed successfully!');
        } catch (\Exception $e) {
            Log::error('Payment error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to process payment.');
        }
    }

    public function paymentHistory($invoiceId)
    {
        $invoice = Invoice_Supplier::with(['supplier', 'payments', 'debitCoa', 'kreditCoa'])->findOrFail($invoiceId);

        return view('accounting.invoice.payment-history', compact('invoice'));
    }

    public function getInvoiceDetails($id)
    {
        $invoice = Invoice_Supplier::with(['supplier', 'payments', 'debitCoa', 'kreditCoa'])->findOrFail($id);

        $paymentHistories = $invoice->payments;

        return view('accounting.invoice.detail', compact('invoice', 'paymentHistories'));
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
