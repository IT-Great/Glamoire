<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Shipping_address;
use App\Services\BerduApiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.biteship.api_key');
        $this->baseUrl = config('services.biteship.base_url');
    }

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

    // public function returnedOrder()
    // {
    //     // Ambil order dengan status yang bermasalah dari kurir
    //     $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])
    //         ->whereIn('status', ['returned', 'cancelled', 'disposed', 'failed'])
    //         ->latest()
    //         ->paginate(10);

    //     // Group order items by product for each order
    //     foreach ($orders as $order) {
    //         $groupedItems = collect($order->orderItems)
    //             ->filter(function ($item) {
    //                 return $item->product !== null;
    //             })
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

    //     // Arahkan ke view return-cancel
    //     return view('admin.order.return-cancel', compact('orders'));
    // }
    // 1. UPDATE FUNGSI INI
    public function returnedOrder()
    {
        // Ambil order dengan status yang bermasalah ATAU yang sedang mengajukan manual return
        $orders = Order::with(['user', 'orderItems.product', 'payment', 'shippingAddress'])
            ->whereIn('status', ['returned', 'cancelled', 'disposed', 'failed'])
            ->orWhereNotNull('return_status') // Tambahan ini
            ->latest()
            ->paginate(10);

        // Group order items by product for each order (SAMA SEPERTI ASLINYA)
        foreach ($orders as $order) {
            $groupedItems = collect($order->orderItems)
                ->filter(function ($item) {
                    return $item->product !== null;
                })
                ->groupBy(function ($item) {
                    return $item->product->id;
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

        return view('admin.order.return-cancel', compact('orders'));
    }

    // 2. TAMBAHKAN FUNGSI BARU INI UNTUK APPROVE RETURN (DAN MENGEMBALIKAN STOK)
    public function approveReturn($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $order = Order::with('orderItems')->findOrFail($id);

                // 1. Kembalikan (Restore) Stok Produk
                foreach ($order->orderItems as $item) {
                    if ($item->product_variant_id) {
                        $variant = \App\Models\ProductVariations::lockForUpdate()->find($item->product_variant_id);
                        if ($variant) {
                            $variant->increment('variant_stock', $item->quantity);
                            $variant->decrement('sale', $item->quantity);
                        }
                    } else {
                        $product = \App\Models\Product::lockForUpdate()->find($item->product_id);
                        if ($product) {
                            $product->increment('stock_quantity', $item->quantity);
                            $product->decrement('sale', $item->quantity);
                        }
                    }
                }

                // 2. Update status
                $order->update([
                    'status' => 'returned', // Ubah status utama menjadi returned
                    'return_status' => 'approved'
                ]);
            });

            return response()->json(['success' => true, 'message' => 'Pengajuan return disetujui. Stok telah dikembalikan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // 3. TAMBAHKAN FUNGSI BARU INI UNTUK REJECT RETURN
    public function rejectReturn($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update(['return_status' => 'rejected']);
            return response()->json(['success' => true, 'message' => 'Pengajuan return ditolak.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
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
        // dd($order->payment);
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



    // CREATE ORDER KE BITESHIP
    public function pickUpBiteship($id)
    {
        try {
            $order = Order::findOrFail($id);
            $orderItems = OrderItem::where('order_id', $order->id)->with('product')->get();

            $user = User::findOrFail($order->user_id);

            $address = Shipping_address::where('user_id', $order->user_id)
                ->where('is_use', 1)
                ->orderBy('is_main', 'DESC')
                ->first();
            $province = Shipping_address::where('user_id', $order->user_id)
                ->where('is_use', 1)
                ->value('province');
            $regency = Shipping_address::where('user_id', $order->user_id)
                ->where('is_use', 1)
                ->value('regency');
            $district = Shipping_address::where('user_id', $order->user_id)
                ->where('is_use', 1)
                ->value('district');
            $subdistrict = Shipping_address::where('user_id', $order->user_id)
                ->where('is_use', 1)
                ->value('subdistrict');
            $postalCodeGCS = Area::where('province', 'LIKE', '%' . "Jawa Timur" . '%')
                ->where('city', 'LIKE', '%' . str_replace(['KOTA ', 'KABUPATEN '], '', 'Surabaya') . '%')
                ->where('district', 'LIKE', '%' . 'Dukuh pakis' . '%')
                ->where('subdistrict', '=', ucwords(strtolower('Pradah kali kendal')))
                ->value('postal_code');
            $getPostalCode = Area::where('province', 'LIKE', '%' . $province . '%')
                ->where('city', 'LIKE', '%' . str_replace(['KOTA ', 'KABUPATEN '], '', $regency) . '%')
                ->where('district', 'LIKE', '%' . $district . '%')
                ->where('subdistrict', '=', ucwords(strtolower($subdistrict)))
                ->value('postal_code');

            $items = $orderItems->map(function ($item) {
                $dimensions = json_decode($item->product->dimensions ?? '{}', true);
                return [
                    "name"        => $item->product->product_name ?? 'Unknown Product',
                    // "description" => $item->product->description ?? '',
                    "value"       => $item->product->regular_price ?? 0,
                    "length"      => isset($dimensions['length']) ? (int) $dimensions['length'] : 0,
                    "width"       => isset($dimensions['width']) ? (int) $dimensions['width'] : 0,
                    "height"      => isset($dimensions['height']) ? (int) $dimensions['height'] : 0,
                    "weight"      => $item->product->weight_product ?? 0,
                    "quantity"    => $item->quantity ?? 1,
                ];
            })->toArray();

            // Log::info('Order Items for Biteship:', $items);
            // Log::info(['Postal Code GCS:', $postalCodeGCS]);
            // Log::info(['Address:', $address['recipient_name'], $address['handphone'], $address['address'], $address['benchmark'], $getPostalCode]);
            // Log::info(['apiKey', $this->apiKey]);

            // ORDER
            $createOrder = Http::withHeaders([
                'Authorization' => $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->post('https://api.biteship.com/v1/orders', [
                "shipper_contact_name" => "",
                "shipper_contact_phone" => "",
                "shipper_contact_email" => "",
                "shipper_organization" => "",
                "origin_contact_name" => "Glamoire", //
                "origin_contact_phone" => "08979243010", //
                "origin_address" => "Jl Wijaya Kusuma no. 57, Surabaya", //
                "origin_note" => "",
                "origin_postal_code" => $postalCodeGCS, // 
                "destination_contact_name" => $address['recipient_name'], //
                "destination_contact_phone" => $address['handphone'], //
                "destination_contact_email" => $address['email'],
                "destination_address" => $address['address'], //
                "destination_postal_code" => $getPostalCode, //
                "destination_note" => $address['benchmark'],
                "courier_company" => $order->kurir, //
                "courier_type" => "reg", //
                "courier_insurance" => "",
                "delivery_type" => "now", //
                "order_note" => "",
                "metadata" => [],
                "items" => $items,
            ]);

            // DRAFT ORDER
            // $createOrder = Http::withHeaders([
            //     'Authorization' => $this->apiKey,
            //     'Content-Type'  => 'application/json',
            // ])->post('https://api.biteship.com/v1/draft_orders', [
            //     "origin_contact_name" => "Glamoire",
            //     "origin_contact_phone" => "08979243010",
            //     "origin_address" => "Jl. Wijaya Kusuma no. 57, Surabaya",
            //     "origin_note" => "",
            //     "origin_postal_code" => $postalCodeGCS,
            //     "destination_contact_name" => $address['recipient_name'], //
            //     "destination_contact_phone" => $address['handphone'], //
            //     "destination_contact_email" => $user['email'],
            //     "destination_address" => $address['address'], //
            //     "destination_postal_code" => $getPostalCode, //
            //     "destination_note" => $address['benchmark'],
            //     "courier_company" => $order['kurir'],
            //     "courier_type" => "reg",
            //     "delivery_type" => "now",
            //     "order_note" => "Tes Draft Order" . $order->id,
            //     "items" => $items,
            // ]);

            // Log::info(['Biteship Request :' => 
            //     [
            //     'origin_contact_name' => "Glamoire",
            //     'origin_contact_phone' => "08979243010",
            //     'origin_address' => "Jl. Wijaya Kusuma no. 57, Surabaya",
            //     'origin_postal_code' => $postalCodeGCS,
            //     'destination_contact_name' => $address['recipient_name'],
            //     'destination_contact_phone' => $address['handphone'],
            //     "destination_contact_email" => $user['email'],
            //     'destination_address' => $address['address'],
            //     'destination_postal_code' => $getPostalCode,
            //     'items' => $items,
            //     ]
            // ]);

            Log::info('Biteship Response:', ['response' => $createOrder->json()]);



            $status = $createOrder->json();


            if ($status['success'] == true) {
                $order->update([
                    'resi' => $status['courier']['waybill_id'],
                    'tracking' => $status['courier']['link'],
                    'status' => 'delivery'
                ]); // Update status to 'delivery'

                return response()->json([
                    'success' => true,
                    'message' => 'Pick Up Biteship initiated successfully!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create order in Biteship: ' . json_encode($createOrder->json())
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change order status: ' . $e->getMessage()
            ], 500);
        }
    }
}
