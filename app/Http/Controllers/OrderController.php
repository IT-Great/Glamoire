<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\BerduApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
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



    // start resi sendiri
    public function generateShippingLabel($id)
    {
        try {
            $order = Order::with([
                'user',
                'orderItems.product',
                'shippingAddress',
                'invoice'
            ])->findOrFail($id);

            // Only generate shipping label if status is processing
            if ($order->status !== 'processing') {
                return redirect()->back()->with('error', 'Hanya pesanan dengan status "processing" yang dapat digenerate label pengiriman');
            }

            // Generate resi number if not exists
            if (empty($order->resi)) {
                // Format: SP{ORDER_ID}{CURRENT_DATE}{RANDOM_CHARS}
                $currentDate = date('ymd'); // Format: 240519
                $randomChars = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8));
                $resiNumber = 'SP' . $currentDate . $order->id . $randomChars;

                // Set default courier if not set
                $kurir = $order->kurir ?? 'JNE Express';

                // Update order with resi and kurir
                $order->resi = $resiNumber;
                $order->kurir = $kurir;
                $order->save();
            }

            // Calculate total weight (assume 500g per item as default)
            $totalWeight = 0;
            foreach ($order->orderItems as $item) {
                // Use product weight if available, otherwise default to 500g
                $itemWeight = $item->product->weight ?? 500;
                $totalWeight += ($itemWeight * $item->quantity);
            }

            // Format weight in grams
            $formattedWeight = number_format($totalWeight, 1) . ' gr';

            // Get shipping data
            $shippingData = [
                'order_number' => $order->resi,
                'barcode' => $order->resi,
                'recipient_name' => $order->user->fullname ?? 'Pembeli',
                'recipient_phone' => $order->user->phone_number ?? '-',
                'recipient_address' => $order->shippingAddress ?
                    $order->shippingAddress->address . ', ' .
                    $order->shippingAddress->district . ', ' .
                    $order->shippingAddress->regency . ', ' .
                    $order->shippingAddress->province : 'Alamat tidak tersedia',
                'recipient_city' => $order->shippingAddress->regency ?? 'Kota tidak tersedia',
                'recipient_district' => $order->shippingAddress->district ?? 'Kecamatan tidak tersedia',
                'sender_name' => 'Admin Shop',
                'sender_phone' => '628123456789', // Replace with your shop phone
                'sender_city' => 'JAKARTA SELATAN', // Replace with your shop city
                'sender_address' => 'Alamat Toko Anda', // Replace with your shop address
                'weight' => $formattedWeight,
                'shipping_cost' => $order->shipping_cost ?? 0,
                'cod_amount' => 0, // Assume no COD by default
                'shipping_date' => date('d-m-Y'),
                'items' => $order->orderItems
            ];

            return view('admin.order.shipping-label', compact('order', 'shippingData'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal generate label pengiriman: ' . $e->getMessage());
        }
    }


    public function viewShippingLabel($id)
    {
        try {
            $order = Order::with([
                'user',
                'orderItems.product',
                'shippingAddress',
                'invoice'
            ])->findOrFail($id);

            // Check if resi exists
            if (empty($order->resi)) {
                return redirect()->back()->with('error', 'Label pengiriman belum di-generate untuk pesanan ini');
            }

            // Calculate total weight (assume 500g per item as default)
            $totalWeight = 0;
            foreach ($order->orderItems as $item) {
                // Use product weight if available, otherwise default to 500g
                $itemWeight = $item->product->weight ?? 500;
                $totalWeight += ($itemWeight * $item->quantity);
            }

            // Format weight in grams
            $formattedWeight = number_format($totalWeight, 1) . ' gr';

            // Get shipping data
            $shippingData = [
                'order_number' => $order->resi,
                'barcode' => $order->resi,
                'recipient_name' => $order->user->fullname ?? 'Pembeli',
                'recipient_phone' => $order->user->phone_number ?? '-',
                'recipient_address' => $order->shippingAddress ?
                    $order->shippingAddress->address . ', ' .
                    $order->shippingAddress->district . ', ' .
                    $order->shippingAddress->regency . ', ' .
                    $order->shippingAddress->province : 'Alamat tidak tersedia',
                'recipient_city' => $order->shippingAddress->regency ?? 'Kota tidak tersedia',
                'recipient_district' => $order->shippingAddress->district ?? 'Kecamatan tidak tersedia',
                'sender_name' => 'Admin Shop',
                'sender_phone' => '628123456789', // Replace with your shop phone
                'sender_city' => 'JAKARTA SELATAN', // Replace with your shop city
                'sender_address' => 'Alamat Toko Anda', // Replace with your shop address
                'weight' => $formattedWeight,
                'shipping_cost' => $order->shipping_cost ?? 0,
                'cod_amount' => 0, // Assume no COD by default
                'shipping_date' => date('d-m-Y'),
                'items' => $order->orderItems
            ];

            return view('admin.order.shipping-label', compact('order', 'shippingData'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menampilkan label pengiriman: ' . $e->getMessage());
        }
    }
    // end resi sendiri


    // start berdu agregator
    // public function generateLabel(Request $request)
    // {
    //     $orderId = $request->order_id;

    //     if (!$orderId) {
    //         return redirect()->back()->with('error', 'Order ID is required');
    //     }

    //     $order = Order::with([
    //         'user',
    //         'orderItems.product',
    //         'shippingAddress'
    //     ])->findOrFail($orderId);

    //     // Check if we have a Berdu user ID in session
    //     $berduUserId = Session::get('berdu_user_id');

    //     $berduService = new BerduApiService();

    //     // If we don't have a user ID yet, redirect to auth flow
    //     if (!$berduUserId) {
    //         $redirectUrl = route('admin.berdu-callback');
    //         $authUrl = $berduService->getAuthUrl($redirectUrl);

    //         if (!$authUrl) {
    //             return redirect()->back()->with('error', 'Failed to generate Berdu authentication URL');
    //         }

    //         // Store order ID in session to continue after auth
    //         Session::put('pending_label_order_id', $orderId);

    //         // Redirect to Berdu auth page
    //         return redirect($authUrl);
    //     }

    //     // We have a user ID, so generate the label
    //     $orderData = $berduService->formatOrderData($order);
    //     $labelUrl = $berduService->generateShippingLabel($berduUserId, $orderData);

    //     if (!$labelUrl) {
    //         return redirect()->back()->with('error', 'Failed to generate shipping label');
    //     }

    //     // Update order with courier info if not set
    //     if (empty($order->kurir)) {
    //         $order->kurir = $orderData['courier'];
    //         $order->save();
    //     }

    //     // Redirect to the PDF URL
    //     return redirect($labelUrl);
    // }


    // public function berduCallback(Request $request)
    // {
    //     $code = $request->code;

    //     if (!$code) {
    //         return redirect()->route('index-admin-order-need-sent')
    //             ->with('error', 'Authorization failed - No code received');
    //     }

    //     $berduService = new BerduApiService();
    //     $userId = $berduService->confirmAuth($code);

    //     if (!$userId) {
    //         return redirect()->route('index-admin-order-need-sent')
    //             ->with('error', 'Failed to confirm Berdu authorization');
    //     }

    //     // Store the user ID in session
    //     Session::put('berdu_user_id', $userId);

    //     // Check if we have a pending label generation
    //     $pendingOrderId = Session::get('pending_label_order_id');
    //     Session::forget('pending_label_order_id');

    //     if ($pendingOrderId) {
    //         // Continue with label generation
    //         return redirect()->route('admin.generate-label', ['order_id' => $pendingOrderId])
    //             ->with('success', 'Successfully authenticated with Berdu');
    //     }

    //     return redirect()->route('index-admin-order-need-sent')
    //         ->with('success', 'Successfully connected with Berdu');
    // }


    // public function updateResi(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $order = Order::findOrFail($request->order_id);
    //         $order->resi = $request->resi_number;
    //         $order->status = 'shipping'; // Update status to shipping
    //         $order->save();

    //         DB::commit();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Resi berhasil diperbarui'
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal memperbarui resi: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
    // end berdu agregator




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
