<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryCoa;
use App\Models\Coa;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ChartofAccountController extends Controller
{
    public function indexChartofAccount()
    {
        $categories = CategoryCoa::all(); // Ambil semua kategori
        $coas = Coa::with('category')->get(); // Ambil semua COA beserta kategori terkait

        return view('accounting.coa.index', compact('categories', 'coas'));
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

    public function deleteChartofAccount() {}


    public function editChartofAccount()
    {
        return view('accounting.coa.edit');
    }

    public function updateChartofAccount() {}


    public function indexCategoryChartofAccount()
    {
        return view('accounting.coa.category.index');
    }
}
