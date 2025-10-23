<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BiteshipController extends Controller
{
    public function callback(Request $request)
    {
        try {
            return response('ok', 200)
                    ->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            Log::error('Biteship Callback Error: ' . $e->getMessage());
            return response('error', 500);
        }
}

}
