<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Promo;
use App\Models\Buynow;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Cart_item;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductStocks;
use App\Models\VoucherNewUser;
use App\Models\Shipping_address;
use App\Models\ProductVariations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class XenditController extends Controller
{
    private $secretKey;
    private $status;
    private $merchant_ref_no;
    private $xendit_id;
    private $order_data;
    private $id_user;
    private $condition;
    private $order_id;

    public function __construct()
    {
        $this->status = config('app.env');
        // Setup via .env: XENDIT_SECRET_KEY=xnd_development_...
        $this->secretKey = config('services.xendit.secret_key');
    }

    // public function submitPayment(Request $request)
    // {
    //     $this->id_user = auth()->id() ?? session('id_user');

    //     if ($request->condition !== "guest") {
    //         $cartId = Cart::where('user_id', $this->id_user)->value('id');
    //         $cartItems = Cart_item::where('cart_id', $cartId)
    //             ->where('is_choose', true)
    //             ->leftJoin('products', 'cart_items.product_id', '=', 'products.id')
    //             ->select(
    //                 'cart_items.product_id as item_code',
    //                 'cart_items.quantity as quantity',
    //                 'cart_items.price as total',
    //                 'products.product_name as item_title'
    //             )
    //             ->get()
    //             ->toArray();
    //     }

    //     $lastInvoice = Invoice::orderBy('id', 'desc')->value('no_invoice');

    //     if ($lastInvoice) {
    //         $lastNoInvoice = (int) substr($lastInvoice, strrpos($lastInvoice, '/') + 1);
    //         $invoiceNumber = $lastNoInvoice + 1;
    //     } else {
    //         $invoiceNumber = 1;
    //     }

    //     $day = date('d');
    //     $month = date('m');
    //     $year = date('Y');
    //     $formattedInvoice = sprintf('INV/%s%s%s/GLM/%s', $day, $month, $year, $invoiceNumber);

    //     // plink_ref_no di-reuse untuk menyimpan ID Invoice dari Xendit agar tidak perlu migrasi database
    //     $invoiceCreate = Invoice::create([
    //         'no_invoice' => $formattedInvoice,
    //         'plink_ref_no' => null,
    //     ]);

    //     $user = User::find($this->id_user);
    //     $username = session('username') ?? ($user->name ?? 'Guest');
    //     $handphone = $user->handphone ?? '080000000000';
    //     $email = $user->email ?? 'customer@glamoire.co.id';
    //     $this->condition = $request->condition;

    //     if ($request->condition == 'buynow') {
    //         session(['productBuyNow' => $request->products]);
    //     }

    //     // Format nomor HP ke standar internasional untuk Xendit
    //     $formattedPhone = str_starts_with($handphone, '0') ? '+62' . substr($handphone, 1) : '+' . ltrim($handphone, '+');
    //     $amount = (int) ($request->total_amount == 0 ? 1 : $request->total_amount);

    //     // --- PAYLOAD XENDIT ---
    //     $payload = [
    //         'external_id' => $formattedInvoice,
    //         'payer_email' => $email,
    //         'description' => 'Pembayaran Pesanan Glamoire - ' . $formattedInvoice,
    //         'amount' => $amount,
    //         'invoice_duration' => 3600, // Waktu kadaluarsa (1 jam)
    //         'customer' => [
    //             'given_names' => $username,
    //             'mobile_number' => $formattedPhone,
    //         ],
    //         // Xendit akan otomatis mengarahkan user kembali ke web setelah sukses/gagal
    //         'success_redirect_url' => route('payment.success', ['invoice' => $formattedInvoice]),
    //         'failure_redirect_url' => route('payment.failed', ['invoice' => $formattedInvoice]),
    //         'currency' => 'IDR',
    //     ];

    //     // --- HIT XENDIT API ---
    //     $response = Http::withBasicAuth($this->secretKey, '')
    //         ->post('https://api.xendit.co/v2/invoices', $payload);

    //     $data = $response->json();

    //     if ($response->successful() && isset($data['invoice_url'])) {

    //         $this->merchant_ref_no = $invoiceCreate->no_invoice;
    //         $this->xendit_id = $data['id']; // Simpan ID Invoice Xendit

    //         $orderId = 'ORDER-' . time() . '-' . Str::random(5);

    //         $orderData = $this->saveData($orderId, $request->total_amount, $request->shipping_address_id, $request->shipping_cost, $request->discount_ongkir, $request->discount_amount, $request->total_item, $request->total_item_price, $request->voucher_promo, $request->voucher_ongkir, $request->destinationArea, $request->originArea, $request->courier, $request->etd, $request->description, $request->destinationPostalCode, $request->products ?? []);

    //         $this->order_data = $orderData;

    //         // BUAT ORDER DI DATABASE
    //         $createdOrder = $this->createNewOrder($this->order_data);

    //         session()->put('payment_url_' . $createdOrder->id, $data['invoice_url']);

    //         // Format deadline sesuai timezone Jakarta
    //         $deadline = Carbon::parse($data['expiry_date'])->timezone('Asia/Jakarta');
    //         $formattedDeadline = $deadline->translatedFormat('l, d F Y - H:i') . ' WIB';

    //         return response()->json([
    //             'success' => true,
    //             'payment_url' => $data['invoice_url'],
    //             'deadline' => $formattedDeadline,
    //         ]);
    //     } else {
    //         Log::error('Xendit Request Failed', [
    //             'status' => $response->status(),
    //             'body' => $response->body(),
    //         ]);

    //         return response()->json(['success' => false, 'message' => 'Gagal membuat tagihan: ' . ($data['message'] ?? 'Hubungi Admin')]);
    //     }
    // }

    public function submitPayment(Request $request)
    {
        $this->id_user = auth()->id() ?? session('id_user');

        $lastInvoice = Invoice::orderBy('id', 'desc')->value('no_invoice');

        if ($lastInvoice) {
            $lastNoInvoice = (int) substr($lastInvoice, strrpos($lastInvoice, '/') + 1);
            $invoiceNumber = $lastNoInvoice + 1;
        } else {
            $invoiceNumber = 1;
        }

        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $formattedInvoice = sprintf('INV/%s%s%s/GLM/%s', $day, $month, $year, $invoiceNumber);

        // plink_ref_no di-reuse untuk menyimpan ID Invoice dari Xendit agar tidak perlu migrasi database
        $invoiceCreate = Invoice::create([
            'no_invoice' => $formattedInvoice,
            'plink_ref_no' => null,
        ]);

        $user = User::find($this->id_user);
        $username = session('username') ?? ($user->name ?? 'Guest');
        $handphone = $user->handphone ?? '080000000000';
        $email = $user->email ?? 'customer@glamoire.co.id';
        $this->condition = $request->condition;

        if ($request->condition == 'buynow') {
            session(['productBuyNow' => $request->products]);
        }

        // ===================================================================
        // 1. MENGAMBIL DATA ITEM UNTUK XENDIT INVOICE UI
        // ===================================================================
        $xenditItems = [];
        $sumItems = 0; // Total harga barang original (tanpa diskon)

        if ($this->condition == 'standard') {
            $cartId = Cart::where('user_id', $this->id_user)->value('id');
            $cartItemsDb = Cart_item::where('cart_id', $cartId)
                ->where('is_choose', true)
                ->with('product')
                ->get();
        } elseif ($this->condition == 'buynow') {
            $cartItemsDb = Buynow::where('user_id', $this->id_user)
                ->where('is_buy', false)
                ->with('product')
                ->get();
        }

        foreach ($cartItemsDb as $item) {
            $productName = $item->product->product_name ?? 'Produk Glamoire';
            $qty = (int) $item->quantity;
            $price = (int) $item->price;

            $xenditItems[] = [
                'name'     => $productName,
                'quantity' => $qty,
                'price'    => $price,
            ];

            // Hitung subtotal original untuk validasi matematis Xendit
            $sumItems += ($qty * $price);
        }

        // ===================================================================
        // 2. MENYUSUN BIAYA & DISKON (FEES) UNTUK XENDIT INVOICE UI
        // ===================================================================
        $xenditFees = [];

        // Ongkos Kirim
        if ($request->shipping_cost > 0) {
            $xenditFees[] = [
                'type'  => 'Ongkos Kirim',
                'value' => (int) $request->shipping_cost,
            ];
        }

        // Diskon Ongkos Kirim (Voucher Ongkir)
        if ($request->discount_ongkir > 0) {
            $xenditFees[] = [
                'type'  => 'Diskon Ongkir',
                'value' => - (int) $request->discount_ongkir, // Nilai minus
            ];
        }

        // Diskon Pembelian (Voucher Promo)
        if ($request->discount_amount > 0) {
            $xenditFees[] = [
                'type'  => 'Diskon Promo',
                'value' => - (int) $request->discount_amount, // Nilai minus
            ];
        }

        // Diskon Bundle/Tier (Kalkulasi perbedaan harga original vs total belanja)
        $totalItemPriceFromRequest = (int) $request->total_item_price;
        $totalDiscountItems = $sumItems - $totalItemPriceFromRequest;

        if ($totalDiscountItems > 0) {
            $xenditFees[] = [
                'type'  => 'Diskon Grosir/Bundle',
                'value' => - (int) $totalDiscountItems, // Nilai minus
            ];
        }

        // Format nomor HP ke standar internasional untuk Xendit
        $formattedPhone = str_starts_with($handphone, '0') ? '+62' . substr($handphone, 1) : '+' . ltrim($handphone, '+');
        $amount = (int) ($request->total_amount == 0 ? 1 : $request->total_amount);

        // ===================================================================
        // 3. PAYLOAD XENDIT
        // ===================================================================
        $payload = [
            'external_id' => $formattedInvoice,
            'payer_email' => $email,
            'description' => 'Pembayaran Pesanan Glamoire - ' . $formattedInvoice,
            'amount' => $amount, // Nilai ini sudah pasti balance dengan Items + Fees
            'invoice_duration' => 3600, // Waktu kadaluarsa (1 jam)
            'customer' => [
                'given_names' => $username,
                'mobile_number' => $formattedPhone,
            ],
            'items' => $xenditItems, // <- Ditambahkan ke payload
            'fees'  => $xenditFees,  // <- Ditambahkan ke payload
            'success_redirect_url' => route('payment.success', ['invoice' => $formattedInvoice]),
            'failure_redirect_url' => route('payment.failed', ['invoice' => $formattedInvoice]),
            'currency' => 'IDR',
        ];

        // --- HIT XENDIT API ---
        $response = Http::withBasicAuth($this->secretKey, '')
            ->post('https://api.xendit.co/v2/invoices', $payload);

        $data = $response->json();

        if ($response->successful() && isset($data['invoice_url'])) {

            $this->merchant_ref_no = $invoiceCreate->no_invoice;
            $this->xendit_id = $data['id']; // Simpan ID Invoice Xendit

            $orderId = 'ORDER-' . time() . '-' . Str::random(5);

            $orderData = $this->saveData($orderId, $request->total_amount, $request->shipping_address_id, $request->shipping_cost, $request->discount_ongkir, $request->discount_amount, $request->total_item, $request->total_item_price, $request->voucher_promo, $request->voucher_ongkir, $request->destinationArea, $request->originArea, $request->courier, $request->etd, $request->description, $request->destinationPostalCode, $request->products ?? []);

            $this->order_data = $orderData;

            // BUAT ORDER DI DATABASE
            $createdOrder = $this->createNewOrder($this->order_data);

            session()->put('payment_url_' . $createdOrder->id, $data['invoice_url']);

            // Format deadline sesuai timezone Jakarta
            $deadline = Carbon::parse($data['expiry_date'])->timezone('Asia/Jakarta');
            $formattedDeadline = $deadline->translatedFormat('l, d F Y - H:i') . ' WIB';

            return response()->json([
                'success' => true,
                'payment_url' => $data['invoice_url'],
                'deadline' => $formattedDeadline,
            ]);
        } else {
            Log::error('Xendit Request Failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json(['success' => false, 'message' => 'Gagal membuat tagihan: ' . ($data['message'] ?? 'Hubungi Admin')]);
        }
    }

    // Fungsi Webhook/Callback untuk Xendit
    public function webhook(Request $request)
    {
        $xenditToken = $request->header('x-callback-token');
        if ($xenditToken !== config('services.xendit.callback_token')) {
            return response()->json(['success' => false, 'message' => 'Invalid Token'], 403);
        }

        $invoiceNum = $request->external_id;
        $status = $request->status; // PAID or EXPIRED

        $invoice = Invoice::where('no_invoice', $invoiceNum)->first();
        if (!$invoice) return response()->json(['success' => false, 'message' => 'Invoice Not Found'], 404);

        $order = Order::where('invoice_id', $invoice->id)->first();
        if (!$order) return response()->json(['success' => false, 'message' => 'Order Not Found'], 404);

        if ($status === 'PAID') {
            $order->update(['status' => 'processing']);
            Payment::where('order_id', $order->id)->update([
                'status' => 'completed',
                'payment_date' => now(),
                'transaction_id' => $request->id // Simpan ID transaksi valid
            ]);
        } elseif ($status === 'EXPIRED') {
            $order->update(['status' => 'failed']);
            Payment::where('order_id', $order->id)->update(['status' => 'failed']);
        }

        return response()->json(['success' => true]);
    }

    private function createNewOrder(array $orderData)
    {
        $getInvoiceId = Invoice::where('no_invoice', $this->merchant_ref_no)->value('id');

        Invoice::where('id', $getInvoiceId)->update([
            'plink_ref_no' => $this->xendit_id,
            'transmission_date_time' => now()->addMinutes(60)->format('Y-m-d H:i:s'),
        ]);

        $order = Order::create([
            'invoice_id' => $getInvoiceId,
            'user_id' => $this->id_user,
            'shipping_address_id' => $orderData['shippingAddressId'],
            'shipping_cost' => $orderData['shippingCost'],
            'discount_amount' => $orderData['discountAmount'] ?? 0,
            'discount_ongkir' => $orderData['discountOngkir'] ?? 0,
            'total_amount' => $orderData['totalAmount'],
            'voucher_promo' => $orderData['voucherPromo'],
            'voucher_ongkir' => $orderData['voucherOngkir'],
            'order_date' => now(),
            'total_item' => $orderData['totalItem'],
            'total_item_price' => $orderData['totalItemPrice'],
            'destination_area' => $orderData['destiantionArea'],
            'origin_area' => $orderData['originArea'],
            'kurir' => $orderData['courier'],
            'etd' => $orderData['etd'],
            'layanan' => $orderData['description'],
            'postal_code_customer' => $orderData['destinationPostalCode'],
            'status' => 'pending',
        ]);

        $this->order_id = $order->id;
        $cartItems = collect();

        if ($this->condition == 'standard') {
            $cartId = Cart::where('user_id', $this->id_user)->value('id');
            $cartItems = Cart_item::where('cart_id', $cartId)
                ->where('is_choose', true)
                ->with(['product.brand'])
                ->get();
        } elseif ($this->condition == 'buynow') {
            $cartItems = Buynow::where('user_id', $this->id_user)
                ->where('is_buy', false)
                ->with(['product.brand'])
                ->get();
        }

        foreach ($cartItems as $item) {
            $item->bundle_price = null;
            if ($item->product && $item->product->promos->where('status', 'Active')) {
                foreach ($item->product->promos->where('status', 'Active') as $promo) {
                    if ($promo->tiers) {
                        foreach ($promo->tiers as $tier) {
                            switch ($tier->discount_type) {
                                case 'percentage':
                                    if ($item->quantity == $tier->min_quantity) {
                                        $item->bundle_price = $item->total * ((100 - $tier->discount_value) / 100);
                                    }
                                    break;
                                case 'nominal':
                                    if ($item->quantity == $tier->min_quantity) {
                                        $item->bundle_price = $item->total - $tier->discount_value;
                                    }
                                    break;
                                case 'package':
                                    if ($item->quantity == $tier->min_quantity) {
                                        $item->bundle_price = $tier->package_price;
                                    }
                                    break;
                            }
                        }
                    }
                }
            }

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'is_tier' => $item->bundle_price !== null ? 1 : 0,
                'subtotal' => $item->bundle_price !== null ? $item->bundle_price : $item->quantity * $item->price,
            ]);
        }

        $payment = Payment::create([
            'user_id'        => $this->id_user,
            'order_id'       => $order->id,
            'payment_method' => "Xendit",
            'transaction_id' => null,
            'status'         => 'pending',
            'amount'         => $orderData['totalAmount'],
        ]);

        $order->update(['payment_id' => $payment->id]);

        $useVoucherNewUser = VoucherNewUser::where('user_id', $this->id_user)->where('code', $orderData['voucherPromo'])->first();
        if ($useVoucherNewUser) {
            $useVoucherNewUser->is_use = 1;
            $useVoucherNewUser->save();
        }

        $voucherUsed = $useVoucherNewUser == NULL ? Promo::where('promo_code', $orderData['voucherPromo'])->first() : NULL;
        $ongkirUsed = $orderData['voucherOngkir'] !== null ? Promo::where('promo_code', $orderData['voucherOngkir'])->first() : null;

        if ($payment->status == "completed" || $payment->status == "pending") {
            if ($voucherUsed !== NULL) $voucherUsed->increment('total_used');
            if ($ongkirUsed !== NULL) $ongkirUsed->increment('total_used');

            $frontendProducts = $orderData['frontendProducts'];

            if (!empty($frontendProducts)) {
                $groupedProducts = collect($frontendProducts)->groupBy(function ($item) {
                    $vid = isset($item['product_variant_id']) ? $item['product_variant_id'] : 'null';
                    if ($vid === 'null' || $vid === '') $vid = 'null';
                    return $item['product_id'] . '_' . $vid;
                })->map(function ($group) {
                    $first = $group->first();
                    $vid = isset($first['product_variant_id']) ? $first['product_variant_id'] : null;
                    if ($vid === 'null' || $vid === '') $vid = null;

                    return [
                        'product_id' => $first['product_id'],
                        'product_variant_id' => $vid,
                        'quantity' => $group->sum('quantity')
                    ];
                });

                foreach ($groupedProducts as $prod) {
                    $this->applyFifoStockDeduction($prod['product_id'], $prod['product_variant_id'], $prod['quantity']);
                }
            }

            if ($this->condition == 'standard') {
                $cartId = Cart::where('user_id', $this->id_user)->value('id');
                Cart_item::where('cart_id', $cartId)->where('is_choose', true)->delete();
            } elseif ($this->condition == 'buynow') {
                Buynow::where('user_id', $this->id_user)->where('is_buy', false)->update(['is_buy' => true]);
            }

            session(['activeTab' => '#my-order']);
        }

        return $order;
    }

    private function saveData($orderId, $totalAmount, $shippingAddressId, $shippingCost, $discountOngkir, $discountAmount, $totalItem, $totalItemPrice, $voucherPromo, $voucherOngkir, $destinationArea, $originArea, $courier, $etd, $description, $destinationPostalCode, $frontendProducts = [])
    {
        return [
            'orderId' => $orderId,
            'totalAmount' => $totalAmount,
            'shippingAddressId' => $shippingAddressId,
            'shippingCost' => $shippingCost,
            'discountAmount' => $discountAmount,
            'discountOngkir' => $discountOngkir,
            'totalItem' => $totalItem,
            'totalItemPrice' => $totalItemPrice,
            'voucherPromo' => $voucherPromo,
            'voucherOngkir' => $voucherOngkir,
            'destiantionArea' => $destinationArea,
            'originArea' => $originArea,
            'courier' => $courier,
            'etd' => $etd,
            'description' => $description,
            'destinationPostalCode' => $destinationPostalCode,
            'frontendProducts' => $frontendProducts
        ];
    }

    private function applyFifoStockDeduction($productId, $variantId, $quantityNeeded)
    {
        DB::transaction(function () use ($productId, $variantId, $quantityNeeded) {
            $remainingNeeded = (int) $quantityNeeded;

            if ($variantId === 'null' || $variantId === '' || $variantId == 0) {
                $variantId = null;
            }

            if ($variantId) {
                $aggregate = ProductVariations::where('id', $variantId)->lockForUpdate()->first();
                $updateBatches = ProductStocks::where('variation_id', $variantId)
                    ->where('quantity', '>', 0)
                    ->lockForUpdate()
                    ->get();
            } else {
                $aggregate = Product::where('id', $productId)->lockForUpdate()->first();
                $updateBatches = ProductStocks::where('product_id', $productId)
                    ->where(function($q) {
                        $q->whereNull('variation_id')->orWhere('variation_id', 0)->orWhere('variation_id', '');
                    })
                    ->where('quantity', '>', 0)
                    ->lockForUpdate()
                    ->get();
            }

            if (!$aggregate) return;

            $currentTotalStock = $variantId ? $aggregate->variant_stock : $aggregate->stock_quantity;
            $trueTotalStockBeforeOrder = (int) $currentTotalStock + $remainingNeeded;

            $rawExpired = $variantId ? $aggregate->variant_expired : $aggregate->date_expired;
            $initialExpired = (!empty($rawExpired) && trim($rawExpired) !== '') ? trim($rawExpired) : '9999-12-31';

            if ($trueTotalStockBeforeOrder < $remainingNeeded) return;

            $totalUpdateStocks = (int) $updateBatches->sum('quantity');
            $initialStockQty = $trueTotalStockBeforeOrder - $totalUpdateStocks;

            $allBatches = collect();

            if ($initialStockQty > 0) {
                $allBatches->push((object)[
                    'type'         => 'initial',
                    'model'        => null,
                    'quantity'     => $initialStockQty,
                    'date_expired' => $initialExpired
                ]);
            }

            foreach ($updateBatches as $ub) {
                $exp = (!empty($ub->date_expired) && trim($ub->date_expired) !== '') ? trim($ub->date_expired) : '9999-12-31';
                $allBatches->push((object)[
                    'type'         => 'update',
                    'model'        => $ub,
                    'quantity'     => (int) $ub->quantity,
                    'date_expired' => $exp
                ]);
            }

            $sortedBatches = $allBatches->sortBy(function ($batch) {
                return strtotime($batch->date_expired);
            })->values();

            foreach ($sortedBatches as $batch) {
                if ($remainingNeeded <= 0) break;

                $deduct = min($batch->quantity, $remainingNeeded);

                if ($batch->type === 'update') {
                    $batch->model->quantity -= $deduct;
                    $batch->model->save();
                }

                $remainingNeeded -= $deduct;
            }
        });
    }
}
