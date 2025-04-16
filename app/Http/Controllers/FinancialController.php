<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Invoice_Supplier;
use App\Models\Supplier_Data;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function indexFinancialIncome(Request $request)
    {
        $query = Coa::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [
                Carbon::parse($request->start_date),
                Carbon::parse($request->end_date)
            ]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $finances = $query->get();
        return view('accounting.financial.index-income', compact('finances'));
    }

    public function indexFinancialExpense(Request $request)
    {
        $invoices = Invoice_Supplier::latest()->get();
        $coas = Invoice_Supplier::latest()->get();
        $suppliers = Supplier_Data::all();

        return view('accounting.financial.index-expense', compact('invoices', 'coas', 'suppliers'));
    }
}
