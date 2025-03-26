<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function indexFinancial() {
        return view('accounting.financial.index');
    }
}
