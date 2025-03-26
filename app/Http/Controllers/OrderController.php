<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress',])
            ->where('status', 'processing')  // Filter berdasarkan status 'processing'
            ->latest()
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

    public function confirmShipping(Request $request, $orderId)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'shipping_method' => 'required|in:counter,pickup',
                'resi_number' => 'required|string|max:255'
            ]);

            // Find the order
            $order = Order::findOrFail($orderId);

            // Update the order with shipping details
            $order->update([
                'kurir' => $validatedData['shipping_method'], // Save shipping method
                'resi' => $validatedData['resi_number'], // Save tracking number (resi)
                'status' => 'delivery' // Update status to delivery
            ]);

            // Return a JSON response
            return response()->json([
                'success' => true,
                'message' => 'Update status order dan simpan nomor resi berhasil!'
            ]);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengkonfirmasi pengiriman: ' . $e->getMessage()
            ], 500);
        }
    }

    public function sentAdmin()
    {
        // $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])->get();
        $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress',])
            ->where('status', 'delivery')  // Filter berdasarkan status 'processing'
            ->latest()
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

        return view('admin.order.sent', compact('orders'));
    }

    public function completeOrder()
    {
        // $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])->get();
        $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress',])
            ->where('status', 'completed')  // Filter berdasarkan status 'processing'
            ->latest()
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

        return view('admin.order.complete-sent', compact('orders'));
    }

    public function changeDeliveryStatusOrder($orderId)
    {
        try {
            // Cari order berdasarkan ID
            $order = Order::findOrFail($orderId);

            // Pastikan status saat ini adalah 'delivery'
            if ($order->status !== 'delivery') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya pesanan dengan status "delivery" yang dapat diselesaikan'
                ], 400);
            }

            // Ubah status menjadi 'completed'
            $order->update([
                'status' => 'completed',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status pesanan berhasil diubah menjadi completed'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyelesaikan pesanan: ' . $e->getMessage()
            ], 500);
        }
    }


    public function detailOrder($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);

        return view('admin.order.detail', compact('order'));
    }

    public function changeOrderStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);

            // Update order status from pending to processing
            $order->status = 'processing';
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Order status successfully changed to Processing'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change order status: ' . $e->getMessage()
            ], 500);
        }
    }
}
