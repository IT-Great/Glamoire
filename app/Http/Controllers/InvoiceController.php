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
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    // invoice supplier
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

        $invoices = $query->orderBy('updated_at', 'desc')->get();

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

    public function editInvoice($id)
    {
        try {
            // Get the invoice data
            $invoice = Invoice_Supplier::findOrFail($id);

            // Load required data for the form
            $suppliers = Supplier_Data::all();
            $coas = Coa::all();

            // Check if payment exists for this invoice
            $payment = PaymentHistories::where('invoice_id', $id)->first();

            return view('accounting.invoice.edit', compact('invoice', 'suppliers', 'coas', 'payment'));
        } catch (\Exception $e) {
            Log::error('Error loading invoice edit page: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'invoice_id' => $id,
            ]);

            return redirect()->route('index-invoice')->with('error', 'Failed to load invoice for editing.');
        }
    }

    public function updateInvoice(Request $request)
    {
        try {
            $invoiceId = $request->invoice_id;
            $invoice = Invoice_Supplier::findOrFail($invoiceId);

            // Check if this is a payment update
            if ($request->has('is_payment_update') && $request->is_payment_update == 1) {
                // Validate payment update request
                $request->validate([
                    'invoice_id' => 'required|exists:invoice_suppliers,id',
                    'payment_date' => 'required|date',
                    'payment_method' => 'required',
                    'amount' => 'required|numeric',
                    'debit_coa_id' => 'required',
                    'kredit_coa_id' => 'required',
                    'image_proof' => 'nullable|mimes:jpeg,png,jpg,pdf|max:5120',
                ]);

                // Get or create payment history
                $payment = PaymentHistories::where('invoice_id', $invoiceId)->first();
                if (!$payment) {
                    $payment = new PaymentHistories();
                    $payment->invoice_id = $invoiceId;
                }

                // Update payment details
                $payment->payment_date = $request->payment_date;
                $payment->payment_method = $request->payment_method;
                $payment->reference_number = $request->reference_number;
                $payment->amount = $request->amount;
                $payment->notes = $request->payment_notes;
                $payment->save();

                // Update invoice status if needed
                $invoice->payment_status = 'Paid';
                $invoice->debit_coa_id = $request->debit_coa_id;
                $invoice->kredit_coa_id = $request->kredit_coa_id;

                // Handle payment proof image if provided
                if ($request->hasFile('image_proof')) {
                    if ($invoice->image_proof) {
                        Storage::disk('public')->delete($invoice->image_proof);
                    }
                    $proofPath = $request->file('image_proof')->store('payment_proofs', 'public');
                    $invoice->image_proof = $proofPath;
                }

                $invoice->save();

                return redirect()->route('index-invoice')->with('success', 'Payment information updated successfully!');
            } else {
                // This is a regular invoice update
                $request->validate([
                    'invoice_id' => 'required|exists:invoice_suppliers,id',
                    'no_invoice' => 'required',
                    'supplier_id' => 'required',
                    'amount' => 'required|numeric',
                    'kredit_coa_id' => 'required',
                    'debit_coa_id' => 'required',
                    'image_invoice' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                // Your existing invoice update logic
                if ($request->hasFile('image_invoice')) {
                    // Delete old image if exists
                    if ($invoice->image_invoice) {
                        Storage::disk('public')->delete($invoice->image_invoice);
                    }

                    $path = $request->file('image_invoice')->store('invoice_images', 'public');
                    $invoice->image_invoice = $path;
                }

                // Update invoice details
                $invoice->no_invoice = $request->no_invoice;
                $invoice->supplier_id = $request->supplier_id;
                $invoice->amount = $request->amount;
                $invoice->kredit_coa_id = $request->kredit_coa_id;
                $invoice->debit_coa_id = $request->debit_coa_id;

                // Update optional fields
                if ($request->has('pph_percentage')) {
                    $invoice->pph_percentage = $request->pph_percentage;
                }

                if ($request->has('date')) {
                    $invoice->date = $request->date;
                }

                if ($request->has('deadline_invoice')) {
                    $invoice->deadline_invoice = $request->deadline_invoice;
                }

                if ($request->has('description')) {
                    $invoice->description = $request->description;
                }

                $invoice->save();

                return redirect()->route('index-invoice')->with('success', 'Invoice updated successfully!');
            }
        } catch (\Exception $e) {
            Log::error('Error updating invoice: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return redirect()->back()->withInput()->with('error', 'Failed to update invoice: ' . $e->getMessage());
        }
    }

    public function deleteInvoice($id)
    {
        try {
            // Find the invoice
            $invoice = Invoice_Supplier::findOrFail($id);

            // Delete associated images if they exist
            if ($invoice->image_invoice) {
                Storage::disk('public')->delete($invoice->image_invoice);
            }

            if ($invoice->image_proof) {
                Storage::disk('public')->delete($invoice->image_proof);
            }

            // Delete the invoice record
            $invoice->delete();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Invoice deleted successfully'
            ]);
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete invoice: ' . $e->getMessage()
            ], 500);
        }
    }


    public function indexSupplier()
    {
        $suppliers = Supplier_Data::with('invoices')->latest()->get();
        $invoices = Invoice_Supplier::with('supplier')->latest()->get();

        $totalSupplier = $suppliers->count();
        $totalInvoice = $invoices->count();
        $totalNominal = $invoices->sum('amount');
        $unpaidInvoiceCount = $invoices->where('payment_status', 'Not Yet')->count();
        $supplierWithoutInvoice = $suppliers->filter(fn($s) => $s->invoices->isEmpty())->count();

        $mostUsedBank = $suppliers->groupBy('bank_name')
            ->sortByDesc(fn($group) => $group->count())
            ->keys()
            ->first();

        return view('accounting.invoice.index-supplier', compact(
            'suppliers',
            'invoices',
            'totalSupplier',
            'totalInvoice',
            'totalNominal',
            'unpaidInvoiceCount',
            'supplierWithoutInvoice',
            'mostUsedBank'
        ));
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
            'accountnumber' => $request->accountnumber,
            'bank_name' => $request->bank_name,

        ]);

        return redirect()->route('index-supplier')->with('success', 'Add Supplier successfully!');
    }

    public function getSupplierDetails($id)
    {
        $supplier = Supplier_Data::findOrFail($id);

        return response()->json([
            'name' => $supplier->name,
            'no_telp' => $supplier->no_telp,
            'email' => $supplier->email,
            'address' => $supplier->address,
            'city' => $supplier->city,
            'province' => $supplier->province,
            'post_code' => $supplier->post_code,
            'accountnumber' => $supplier->accountnumber,
            'accountnumber_holders_name' => $supplier->accountnumber_holders_name,
            'bank_name' => $supplier->bank_name,
            'description' => $supplier->description,
        ]);
    }


    public function editSupplier($id)
    {
        try {
            // Cari data supplier berdasarkan ID
            $suppliers = Supplier_Data::findOrFail($id);

            return view('accounting.invoice.edit-supplier', compact('suppliers'));
        } catch (\Exception $e) {
            // Log error dan kembalikan ke halaman index dengan pesan error
            Log::error('Error loading supplier edit page: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'supplier_id' => $id,
            ]);

            return redirect()->route('index-supplier')->with('error', 'Failed to load supplier for editing.');
        }
    }


    public function updateSupplier(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:supplier_data,id',
                'name' => 'required',
                'no_telp' => 'required',
                'email' => 'required',
            ]);

            $supplier = Supplier_Data::findOrFail($request->id);

            $supplier->update([
                'name' => $request->name,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'post_code' => $request->post_code,
                'description' => $request->description,
                'accountnumber' => $request->accountnumber,
                'bank_name' => $request->bank_name,
            ]);

            return redirect()->route('index-supplier')->with('success', 'Supplier updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating supplier: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'supplier_id' => $request->id,
                'user_id' => auth()->id(),
                'url' => request()->fullUrl(),
                'input' => $request->all()
            ]);

            return redirect()->route('index-supplier')->with('error', 'Failed to update supplier.');
        }
    }


    public function deleteSupplier($id)
    {
        try {
            $supplier = Supplier_Data::findOrFail($id);
            $supplier->delete();

            return response()->json(['message' => 'Supplier deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting supplier: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'supplier_id' => $id,
                'user_id' => auth()->id(),
                'url' => request()->fullUrl()
            ]);

            return response()->json(['message' => 'Failed to delete supplier.'], 500);
        }
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
