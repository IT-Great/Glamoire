<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function indexOrder()
    // {
    //     $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])
    //         ->latest() // Menampilkan data terbaru terlebih dahulu
    //         ->paginate(10);

    //     // Group order items by product for each order
    //     foreach ($orders as $order) {
    //         $groupedItems = collect($order->orderItems)
    //             ->groupBy(function ($item) {
    //                 return $item->product->id;
    //             })
    //             ->map(function ($group) {
    //                 $firstItem = $group->first();
    //                 return [
    //                     'product' => $firstItem->product,
    //                     'total_quantity' => $group->sum('quantity')
    //                 ];
    //             })
    //             ->values();

    //         $order->groupedOrderItems = $groupedItems;
    //     }

    //     return view('admin.order.index', compact('orders'));
    // }

    // public function indexOrder()
    // {
    //     $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])
    //         ->latest() // Menampilkan data terbaru terlebih dahulu
    //         ->paginate(10);

    //     // Group order items by product for each order
    //     foreach ($orders as $order) {
    //         $groupedItems = collect($order->orderItems)
    //             ->filter(function ($item) {
    //                 return $item->product !== null; // Pastikan produk tidak null
    //             })
    //             ->groupBy(function ($item) {
    //                 return $item->product->id; // Sekarang aman mengakses id
    //             })
    //             ->map(function ($group) {
    //                 $firstItem = $group->first();
    //                 return [
    //                     'product' => $firstItem->product,
    //                     'total_quantity' => $group->sum('quantity')
    //                 ];
    //             })
    //             ->values();

    //         $order->groupedOrderItems = $groupedItems;
    //     }

    //     return view('admin.order.index', compact('orders'));
    // }

    public function indexOrder()
    {
        $orders = Order::with([
            'user',
            'orderItems.product.categoryProduct', // Tambahkan categoryProduct
            'payment',
            'shippingAddress'
        ])
            ->latest()
            ->paginate(10);

        // Group order items by product for each order
        foreach ($orders as $order) {
            $groupedItems = [];

            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    $productId = $item->product->id;

                    if (!isset($groupedItems[$productId])) {
                        $groupedItems[$productId] = [
                            'product' => $item->product,
                            'total_quantity' => $item->quantity
                        ];
                    } else {
                        $groupedItems[$productId]['total_quantity'] += $item->quantity;
                    }
                }
            }

            $order->groupedOrderItems = array_values($groupedItems);
        }

        // Debug untuk memeriksa data
        // dd($orders->first()->groupedOrderItems);

        return view('admin.order.index', compact('orders'));
    }


    public function needSentAdmin()
    {
        // $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])->get();
        $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])
            ->paginate(10);

        // Group order items by product for each order
        foreach ($orders as $order) {
            $groupedItems = collect($order->orderItems)
                ->filter(function ($item) {
                    return $item->product !== null; // Pastikan produk tidak null
                })
                ->groupBy(function ($item) {
                    return $item->product->id; // Sekarang aman mengakses id
                })
                ->map(function ($group) {
                    $firstItem = $group->first();
                    return [
                        'product' => $firstItem->product,
                        'total_quantity' => $group->sum('quantity')
                    ];
                })
                ->values();

            $order->groupedOrderItems = $groupedItems;
        }

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
