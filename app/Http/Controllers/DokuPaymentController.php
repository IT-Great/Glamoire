<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\VoucherNewUser;
use App\Models\ProductVariations;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Payment;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessPaymentStatus;
use PDO;

class DokuPaymentController extends Controller
{
    private $clientId;
    private $secretKey;
    private $baseUrl;
    // protected $currentOrderId;

    private $paymentMethods = [
        // Virtual Account Banks
        'VIRTUAL_ACCOUNT_BCA' => [
            'name' => 'BCA Virtual Account',
            'icon' => 'bca-icon.png'
        ],
        'VIRTUAL_ACCOUNT_BANK_MANDIRI' => [
            'name' => 'Mandiri Virtual Account',
            'icon' => 'mandiri-icon.png'
        ],
        'VIRTUAL_ACCOUNT_BRI' => [
            'name' => 'BRI Virtual Account',
            'icon' => 'bri-icon.png'
        ],
        'VIRTUAL_ACCOUNT_BNI' => [
            'name' => 'BNI Virtual Account',
            'icon' => 'bni-icon.png'
        ],
        'VIRTUAL_ACCOUNT_BANK_PERMATA' => [
            'name' => 'Permata Virtual Account',
            'icon' => 'permata-icon.png'
        ],
        'VIRTUAL_ACCOUNT_BANK_CIMB' => [
            'name' => 'CIMB Virtual Account',
            'icon' => 'cimb-icon.png'
        ],
        'VIRTUAL_ACCOUNT_BANK_DANAMON' => [
            'name' => 'Danamon Virtual Account',
            'icon' => 'danamon-icon.png'
        ],
        'VIRTUAL_ACCOUNT_MAYBANK' => [
            'name' => 'Maybank Virtual Account',
        ],
        'VIRTUAL_ACCOUNT_BNC' => [
            'name' => 'Bank Neo Virtual Account',
            'icon' => 'neo-icon.png'
        ],
        'VIRTUAL_ACCOUNT_BTN' => [
            'name' => 'BTN Virtual Account',
            'icon' => 'btn-icon.png'
        ],
        'VIRTUAL_ACCOUNT_BANK_SYARIAH_MANDIRI' => [
            'name' => 'Bank Syariah Indonesia Virtual Account',
            'icon' => 'bsi-icon.png'
        ],

        // E-Wallets
        'EMONEY_OVO' => [
            'name' => 'OVO',
            'icon' => 'ovo-icon.png'
        ],
        'EMONEY_DOKU' => [
            'name' => 'DOKU Wallet',
            'icon' => 'doku-wallet-icon.png'
        ],
        'EMONEY_LINKAJA' => [
            'name' => 'LinkAja',
            'icon' => 'linkaja-icon.png'
        ],
        'EMONEY_SHOPEE_PAY' => [
            'name' => 'ShopeePay',
            'icon' => 'shopeepay-icon.png'
        ],
        'EMONEY_DANA' => [
            'name' => 'DANA',
            'icon' => 'dana-icon.png'
        ],

        // Other payment methods
        'ONLINE_TO_OFFLINE_ALFA' => [
            'name' => 'Alfa O2O',
            'icon' => 'alfa-icon.png'
        ],
        'ONLINE_TO_OFFLINE_INDOMARET' => [
            'name' => 'Indomaret',
            'icon' => 'indomaret-icon.png'
        ],

        // QRIS
        'QRIS' => [
            'name' => 'QRIS',
            'icon' => 'qris-icon.png'
        ],

        // Credit Card
        'CREDIT_CARD' => [
            'name' => 'Credit Card',
            'icon' => 'credit-card-icon.png'
        ],

        // Buy Now Pay Later
        'PEER_TO_PEER_KREDIVO' => [
            'name' => 'Kredivo',
            'icon' => 'kredivo-icon.png'
        ],
        'PEER_TO_PEER_AKULAKU' => [
            'name' => 'Akulaku',
            'icon' => 'akulaku-icon.png'
        ],
        'PEER_TO_PEER_INDODANA' => [
            'name' => 'Indodana',
            'icon' => 'indodana-icon.png'
        ],

    ];


    public function __construct()
    {
        $this->clientId = config('services.doku.client_id');
        $this->secretKey = config('services.doku.secret_key');
        $this->baseUrl = config('services.doku.environment') === 'sandbox'
            ? 'https://api-sandbox.doku.com'
            : 'https://api.doku.com';
    }

    public function getPaymentMethods()
    {
        return response()->json([
            'success' => true,
            'payment_methods' => $this->paymentMethods
        ]);
    }


    public function initiatePayment(Request $request)
    {
        try {
            // Generate unique order ID
            $orderId = 'ORDER-' . time() . '-' . Str::random(5);

            // Calculate total amount
            $totalAmount = intval($request->total_amount);

            // Prepare request timestamp
            $requestTimestamp = Carbon::now()->utc()->format('Y-m-d\TH:i:s\Z');

            // Get selected payment methods
            $selectedPaymentMethods = $request->payment_methods ?? array_keys($this->paymentMethods);

            // Prepare request body
            $requestBody = [
                'order' => [
                    'amount' => $totalAmount,
                    'invoice_number' => $orderId,
                    'currency' => 'IDR',
                    'callback_url' => route('doku.callback', ['order_id' => $orderId]),
                    // 'callback_url' => 'https://1f14-114-5-223-146.ngrok-free.app/doku-callback',
                    'language' => 'ID',
                    'auto_redirect' => true
                ],
                'payment' => [
                    'payment_due_date' => 60,
                    'payment_method_types' => $selectedPaymentMethods
                ],
                'customer' => [
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email
                ]
            ];

            // Generate digest
            $digestValue = base64_encode(hash('sha256', json_encode($requestBody), true));

            // Prepare signature component
            $signatureComponent = "Client-Id:" . $this->clientId . "\n"
                . "Request-Id:" . $orderId . "\n"
                . "Request-Timestamp:" . $requestTimestamp . "\n"
                . "Request-Target:/checkout/v1/payment" . "\n"
                . "Digest:" . $digestValue;

            // Generate signature
            $signature = base64_encode(hash_hmac('sha256', $signatureComponent, $this->secretKey, true));

            // Make request to DOKU
            $client = new Client();
            $response = $client->post($this->baseUrl . '/checkout/v1/payment', [
                'headers' => [
                    'Client-Id' => $this->clientId,
                    'Request-Id' => $orderId,
                    'Request-Timestamp' => $requestTimestamp,
                    'Signature' => 'HMACSHA256=' . $signature,
                    'Content-Type' => 'application/json',
                    'Digest' => 'SHA-256=' . $digestValue,
                ],
                'json' => $requestBody
            ]);

            $result = json_decode($response->getBody(), true);

            $shippingAddressId = $request->shipping_address_id;
            $shippingCost = $request->shipping_cost;
            $discountAmount = $request->discount_amount;
            $discountOngkir = $request->discount_ongkir;
            $totalAmount = $request->total_amount;
            $totalItem = $request->total_item;
            $totalItemPrice = $request->total_item_price;
            $voucherPromo = $request->voucher_promo;
            $voucherOngkir = $request->voucher_ongkir;


            $orderData = $this->saveData($orderId, $totalAmount, $shippingAddressId, $shippingCost, $discountAmount, $discountOngkir, $totalItem, $totalItemPrice, $voucherOngkir, $voucherPromo, $selectedPaymentMethods);
            session(['order_data' => $orderData]);

            // $this->saveData($orderId, $totalAmount, $shippingAddressId, $shippingCost, $discountAmount, $totalAmount, $totalItem, $totalItemPrice);
            // $this->createNewOrder($request, $orderId, $totalAmount, $payment_url);

            return response()->json([
                'success' => true,
                'payment_url' => $result['response']['payment']['url'],
                'tes' => $result,
            ]);
        } catch (\Exception $e) {
            Log::error('DOKU Payment Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pembayaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                $payment_status = $this->getPaymentStatus($request->order_id);

                Log::info('Payment status setelah callback', [
                    'payment' => $payment_status
                ]);

                if ($payment_status instanceof \Illuminate\Http\RedirectResponse) {
                    return $payment_status; // Redirect ke route checkout
                }

                // Jika payment status tidak ditemukan
                if (is_null($payment_status)) {
                    return redirect()->route('checkout')->with('error', 'Payment status not found.');
                }

                if (isset($payment_status['transaction']['status']) && $payment_status['transaction']['status'] === 'SUCCESS') {
                    $this->createNewOrder(session('order_data'));
                    session()->flash('payment_success');
                    return redirect()->route('account', ['user' => session('id_user')]);
                } elseif (isset($payment_status['transaction']['status']) && $payment_status['transaction']['status'] === 'PENDING') {
                    return redirect()->route('checkout');
                } elseif (isset($payment_status['transaction']['status']) && $payment_status['transaction']['status'] === 'FAILED') {
                    session()->flash('payment_failed');
                    return redirect()->route('checkout');
                } else {
                    return redirect()->route('checkout');
                }
            }

            return redirect()->route('checkout');
        } catch (\Exception $e) {
            Log::error('DOKU Callback Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    private function createNewOrder(array $orderData)
    {
        $lastInvoice = Invoice::orderBy('id', 'desc')->value('no_invoice');

        if ($lastInvoice) {
            // Split the invoice by '/' and take the last part
            $lastNoInvoice = (int) substr($lastInvoice, strrpos($lastInvoice, '/') + 1);

            // Increment the number
            $invoiceNumber = $lastNoInvoice + 1;
        } else {
            // Start from 1 if there is no previous invoice
            $invoiceNumber = 1;
        }

        // Get the current day, month, and year
        $day = date('d');
        $month = date('m');
        $year = date('Y');

        // Format the new invoice number
        $formattedInvoice = sprintf('INV/%s%s%s/GLM/%s', $day, $month, $year, $invoiceNumber);

        // Create a new invoice with the formatted invoice number
        $invoiceCreate = Invoice::create([
            'no_invoice' => $formattedInvoice,
        ]);

        $order = Order::create([
            'doku_order_id' => $orderData['orderId'],
            'invoice_id' => $invoiceCreate->id,
            'user_id' => auth()->id(),
            'shipping_address_id' => $orderData['shippingAddressId'],
            'shipping_cost' => $orderData['shippingCost'],
            'discount_amount' => $orderData['discountAmount'] ?? 0,
            'total_amount' => $orderData['totalAmount'],
            'voucher_promo' => $orderData['voucherPromo'],
            'voucher_ongkir' => $orderData['voucherOngkir'],
            'order_date' => now(),
            'total_item' => $orderData['totalItem'],
            'total_item_price' => $orderData['totalItemPrice'],
        ]);

        $cartId = Cart::where('user_id', session('id_user'))->value('id');
        $cartItems = Cart_item::where('cart_id', $cartId)
            ->where('is_choose', true)
            ->with(['product.brand'])
            ->get();

        foreach ($cartItems as $item) {
            if ($item->product && $item->product->promos) {
                foreach ($item->product->promos as $promo) {
                    if ($promo->tiers) {
                        foreach ($promo->tiers as $tier) {
                            switch ($tier->discount_type) {
                                case 'percentage':
                                    // Contoh logika untuk diskon persentase
                                    if ($item->quantity == $tier->min_quantity) {
                                        $discountedPrice = $item->total * ((100 - $tier->discount_value) / 100);
                                        $item->bundle_price = $discountedPrice;
                                        $item->total = $discountedPrice;
                                    }
                                    break;

                                case 'nominal':
                                    // Contoh logika untuk diskon nominal
                                    if ($item->quantity == $tier->min_quantity) {
                                        $discountedPrice = $item->total - $tier->discount_value;
                                        $item->bundle_price = $discountedPrice;
                                        $item->total = $discountedPrice;
                                    }
                                    break;

                                case 'package':
                                    if ($item->quantity == $tier->min_quantity) {
                                        $item->bundle_price = $tier->package_price; // Tetapkan harga paket
                                        $item->total = $tier->package_price;
                                    }
                                    break;

                                default:
                                    // Logika default jika tidak ada kasus yang cocok
                                    $item->discounted_price = $item->product->price;
                                    break;
                            }
                        }
                    }
                }

                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'is_tier' => $item->bundle_price,
                    'subtotal' => $item->bundle_price !== null ? $item->bundle_price : $item->quantity * $item->price,
                ]);
            }
        }

        $userId = session('id_user');

        $payment_status = $this->getPaymentStatus($orderData['orderId']);

        $statusMap = [
            'SUCCESS' => 'completed',
            'PENDING' => 'pending',
            'FAILED' => 'failed'
        ];

        $payment = Payment::create([
            'user_id'        => $userId,
            'order_id'       => $order->id,
            'payment_method' => $payment_status['acquirer']['name'],
            'transaction_id' => $payment_status['transaction']['original_request_id'],
            'status'         => $statusMap[$payment_status['transaction']['status']] ?? 'pending', // Map the status
            'amount'         => $payment_status['order']['amount'],
            'payment_date'   => now(),
        ]);
        
        // Update status voucher jika digunakan
        $useVoucherNewUser = VoucherNewUser::where('user_id', $userId)
            ->where('code', $orderData['voucherPromo'])
            ->first();

        if ($useVoucherNewUser) {
            $useVoucherNewUser->is_use = 1;
            $useVoucherNewUser->save();
        }

        if ($useVoucherNewUser == NULL) {
            $voucherUsed = Promo::where('promo_code', $orderData['voucherPromo'])->first();
        } else {
            $voucherUsed = NULL;
        }

        if ($orderData['voucherOngkir'] !== null) {
            $ongkirUsed = Promo::where('promo_code', $orderData['voucherOngkir'])->first();
        }

        // Jika pembayaran selesai

        if ($payment->status == "SUCCESS") {
            // Ambil cart berdasarkan user_id sekali di luar loop
            $cartId = Cart::where('user_id', $userId)->value('id');

            if ($voucherUsed !== NULL) {
                $voucherUsed->total_used += 1;
                $voucherUsed->save();
            }

            if ($orderData['voucherOngkir'] !== null) {
                if ($ongkirUsed) {
                    $ongkirUsed->total_used += 1;
                    $ongkirUsed->save();
                }
            }

            foreach ($cartItems as $product) {
                // Temukan produk berdasarkan ID\
                if ($product['product_variant_id'] !== null) {
                    $productVariant = ProductVariations::find($product['product_variant_id']);

                    // Jika produk ditemukan, lakukan update stok
                    if ($productVariant) {
                        $productVariant->variant_stock -= $product['quantity'];
                        $productVariant->sale += $product['quantity'];
                        $productVariant->save();
                    }

                    // Hapus item dari cart berdasarkan cart_id dan product_id
                    Cart_item::where('cart_id', $cartId)
                        ->where('product_variant_id', $product['product_variant_id'])
                        ->delete();
                } else {
                    $products = Product::find($product['product_id']);

                    // Jika produk ditemukan, lakukan update stok
                    if ($products) {
                        $products->stock_quantity -= $product['quantity'];
                        $products->sale += $product['quantity'];
                        $products->save();
                    }

                    // Hapus item dari cart berdasarkan cart_id dan product_id
                    Cart_item::where('cart_id', $cartId)
                        ->where('product_id', $product['product_id'])
                        ->delete();
                }

                session(['activeTab' => '#my-order']);
            }
        }

        return $order;
    }

    private function saveData($orderId, $totalAmount, $shippingAddressId, $shippingCost, $discountOngkir, $discountAmount, $totalItem, $totalItemPrice, $voucherPromo, $voucherOngkir, $selectedPaymentMethods)
    {
        $data = [
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
            'selectedPaymentMethods' => $selectedPaymentMethods,
        ];

        return $data;
    }

    private function getPaymentStatus($orderId)
    {
        try {
            $client = new \GuzzleHttp\Client();

            $requestId = 'REQUEST-' . time() . '-' . Str::random(5);
            $requestTimestamp = Carbon::now()->utc()->format('Y-m-d\TH:i:s\Z');

            // Build signature component
            $componentToSign = "Client-Id:" . $this->clientId . "\n"
                . "Request-Id:" . $requestId . "\n"
                . "Request-Timestamp:" . $requestTimestamp . "\n"
                . "Request-Target:/orders/v1/status/" . $orderId;

            // Generate signature
            $signature = 'HMACSHA256=' . base64_encode(
                hash_hmac('sha256', $componentToSign, $this->secretKey, true)
            );

            // Make GET request to DOKU
            $response = $client->get($this->baseUrl . '/orders/v1/status/' . $orderId, [
                'headers' => [
                    'Client-Id' => $this->clientId,
                    'Request-Id' => $requestId,
                    'Request-Timestamp' => $requestTimestamp,
                    'Signature' => $signature,
                    'Content-Type' => 'application/json',
                ],
            ]);

            $result = json_decode($response->getBody(), true);

            return $result;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            if ($response->getStatusCode() === 404) {
                Log::warning('Payment status not found', [
                    'orderId' => $orderId,
                    'error_message' => 'Invoice Number or Request ID not found',
                ]);
                return redirect()->route('checkout')->with('error', 'Payment status not found.');
            }

            Log::error('Failed to get payment status', [
                'orderId' => $orderId,
                'error' => $e->getMessage(),
            ]);
            throw new \Exception('Unable to fetch payment status');
        } catch (\Exception $e) {
            Log::error('Unexpected error while fetching payment status: ' . $e->getMessage());
            throw new \Exception('Unable to fetch payment status');
        }
    }
}
