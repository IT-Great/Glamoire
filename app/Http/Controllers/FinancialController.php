<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Invoice_Supplier;
use App\Models\Payment;
use App\Models\Supplier_Data;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function indexFinancialIncome(Request $request)
    {
        $query = Payment::with(['user', 'order', 'order.orderItems', 'order.invoice'])
            ->where('status', 'completed');

        // Date range filtering
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('payment_date', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        // Payment method filtering
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Customer filtering
        if ($request->filled('customer')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        // Amount range filtering
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }

        // Get finances data
        $finances = $query->latest('payment_date')->paginate(15);

        // Calculate summary statistics
        $totalIncome = $query->sum('amount');

        // Payment method breakdown
        $paymentMethodStats = Payment::where('status', 'completed')
            ->selectRaw('payment_method, count(*) as count, sum(amount) as total')
            ->groupBy('payment_method');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $paymentMethodStats->whereBetween('payment_date', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        $paymentMethodStats = $paymentMethodStats->get();

        // Get available payment methods for filter dropdown
        $paymentMethods = Payment::distinct()->pluck('payment_method');

        return view('accounting.financial.index-income', compact(
            'finances',
            'totalIncome',
            'paymentMethodStats',
            'paymentMethods'
        ));
    }

    public function showPayment($id)
    {
        $payment = Payment::with([
            'user',
            'order',
            'order.invoice', // Include the invoice relation
            'order.orderItems',
            'order.orderItems.product' // Assuming you have a product relation in OrderItem
        ])->findOrFail($id);

        return response()->json($payment);
    }



    public function indexFinancialExpense(Request $request)
    {
        $invoices = Invoice_Supplier::latest()->get();
        $coas = Invoice_Supplier::latest()->get();
        $suppliers = Supplier_Data::all();

        return view('accounting.financial.index-expense', compact('invoices', 'coas', 'suppliers'));
    }
}
