<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function indexTransaction()
    {
        return view('accounting.transaction.index');
    }

    public function createTransaction()
    {
        $coas = Coa::all();
        return view('accounting.transaction.create', compact('coas'));
    }
}
