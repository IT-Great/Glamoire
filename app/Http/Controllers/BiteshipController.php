<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class BiteshipController extends Controller
{
    public function callback(Request $request)
    {
        try {
            Log::info('Biteship Webhook orderan:', $request->all());
            
            if($request->status == 'delivered'){
                $order = Order::where('resi', $request->courier_waybill_id)->update([
                    'status' => 'completed',
                ]);

                Log::info(['Success update order :' => $order]);
            }

            return response('ok', 200)
                ->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            Log::error('Biteship Callback Error: ' . $e->getMessage());
            return response('error', 500);
        }
    }
}