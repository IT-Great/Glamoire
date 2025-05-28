<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryCoa;
use App\Models\Coa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ChartofAccountController extends Controller
{
    public function indexChartofAccount()
    {
        $categories = CategoryCoa::all();
        $coas = Coa::with('category')->latest()->get();

        // Data untuk statistik
        $totalCoa = $coas->count();
        $totalDebit = $coas->where('type', 'debit')->sum('amount');
        $totalCredit = $coas->where('type', 'credit')->sum('amount');

        return view('accounting.coa.index', compact(
            'categories',
            'coas',
            'totalCoa',
            'totalDebit',
            'totalCredit'
        ));
    }


    public function createChartofAccount()
    {
        $categories = CategoryCoa::all();
        return view('accounting.coa.create', compact('categories'));
    }

    public function storeChartofAccount(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'name' => 'required',
                'coa_no' => ['required', 'regex:/^\d{3}\.\d{3}$/'], // Validasi format 3 angka di depan dan 3 angka di belakang
                'coa_category_id' => 'required',
            ]);

            Coa::create([
                'name' => $request->name,
                'coa_no' => $request->coa_no,
                'coa_category_id' => $request->coa_category_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            // Redirect ke halaman indeks pengeluaran dengan pesan sukses
            return redirect()->route('index-chartofaccount')->with('success', 'Accountnumber created successfully!');
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->errorInfo[1] == 1062) {
                // Handle the integrity constraint violation error
                $errorMessage = "The account name already exists.";
                return redirect()->back()->withErrors(['name' => $errorMessage]);
            } else {
                // Handle other database errors
                return redirect()->back()->withErrors(['message' => 'Database error occurred. Please try again later.']);
            }
        }
    }

    public function storeCategoryCoa(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:255',
            ]);

            $category = new CategoryCoa();
            $category->category_name = $request->category_name;
            $category->save();

            return redirect()->route('create-chartofaccount')->with('success', 'Category created successfully!');
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->errorInfo[1] == 1062) {
                // Handle the integrity constraint violation error
                $errorMessage = "The category name already exists.";
                return redirect()->back()->withErrors(['category_name' => $errorMessage])->withInput();
            } else {
                // Handle other database errors
                return redirect()->back()->withErrors(['message' => 'Database error occurred. Please try again later.'])->withInput();
            }
        }
    }

    public function editChartofAccount($id)
    {
        try {
            // Cari data COA berdasarkan ID
            $coa = Coa::findOrFail($id);
            $categories = CategoryCoa::all();

            return view('accounting.coa.edit', compact('coa', 'categories'));
        } catch (\Exception $e) {
            // Log error dan kembalikan ke halaman index dengan pesan error
            Log::error('Error loading COA edit page: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'coa_id' => $id,
            ]);

            return redirect()->route('index-coa')->with('error', 'Failed to load chart of account for editing.');
        }
    }

    public function updateChartofAccount(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'name' => 'required',
                'coa_no' => 'required',
                'coa_category_id' => 'required',
            ]);

            $accountNumbers = Coa::findOrFail($id);

            $accountNumbers->update([
                'name' => $request->name,
                'coa_no' => $request->coa_no,
                'coa_category_id' => $request->coa_category_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            return redirect()->route('index-chartofaccount')->with('success', 'Account Updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating Chart of Account: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'coa_id' => $id,
                'user_id' => auth()->id(),
                'url' => request()->fullUrl(),
                'input' => $request->all()
            ]);

            return redirect()->route('index-chartofaccount')->with('error', 'Failed to update Chart of Account.');
        }
    }




    public function deleteChartofAccount($id)
    {

        try {
            $coa = Coa::findOrFail($id);
            $coa->delete();

            return response()->json(['message' => 'COA deleted successfully.'], 200);
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

    public function indexCategoryChartofAccount()
    {
        return view('accounting.coa.category.index');
    }
}
