<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function indexOrder()
    {
        $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])->get();
        return view('admin.order.index', compact('orders'));
    }

    public function needSentAdmin()
    {
        $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])->get();
        return view('admin.order.need-sent', compact('orders'));
    }
    
    public function sentAdmin()
    {
        $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])->get();
        return view('admin.order.sent', compact('orders'));
    }

    public function detailOrder($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);

        return view('admin.order.detail', compact('order'));
    }
}
