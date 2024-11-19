<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DokuPaymentController extends Controller
{
    private $clientId;
    private $secretKey;
    private $baseUrl;

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
            $totalAmount = $request->total_amount;

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
                    'callback_url' => route('doku.callback'),
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
                    'Digest' => 'SHA-256=' . $digestValue
                ],
                'json' => $requestBody
            ]);

            $result = json_decode($response->getBody(), true);

            // Store order in database
            $this->createOrder($request, $orderId, $totalAmount);

            return response()->json([
                'success' => true,
                'payment_url' => $result['response']['payment']['url']
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
            Log::info('DOKU Callback received:', [
                'method' => $request->method(),
                'headers' => $request->headers->all(),
                'body' => $request->all()
            ]);

            if ($request->isMethod('get')) {
                // Handle GET request (usually redirect from payment page)
                // $order = Order::where('order_id', $request->get('order_id'))->first();

                $order = Order::where('invoice_id', $request->get('order_id'))->first();

                if (!$order) {
                    throw new \Exception('Order not found');
                }

                // Redirect based on payment status
                if ($request->get('status') === 'SUCCESS') {
                    return redirect()->route('payment.success', ['order_id' => $order->order_id]);
                } else {
                    return redirect()->route('payment.failed', ['order_id' => $order->order_id]);
                }
            }

            // Handle POST request (server notification from DOKU)
            $notificationHeader = $request->header('Signature');
            $notificationBody = $request->getContent();
            $notificationTimestamp = $request->header('Request-Timestamp');
            $notificationRequestId = $request->header('Request-Id');

            // Verify signature only for POST notifications
            if ($request->isMethod('post')) {
                // Build signature component
                $componentToSign = "Client-Id:" . $this->clientId . "\n"
                    . "Request-Id:" . $notificationRequestId . "\n"
                    . "Request-Timestamp:" . $notificationTimestamp . "\n"
                    . "Request-Target:/doku-callback" . "\n"
                    . "Digest:" . base64_encode(hash('sha256', $notificationBody, true));

                // Generate expected signature
                $expectedSignature = 'HMACSHA256=' . base64_encode(
                    hash_hmac('sha256', $componentToSign, $this->secretKey, true)
                );

                // Verify signature
                if ($notificationHeader !== $expectedSignature) {
                    Log::error('Invalid DOKU signature', [
                        'received' => $notificationHeader,
                        'expected' => $expectedSignature
                    ]);
                    throw new \Exception('Invalid signature');
                }
            }

            // Process notification
            $notificationData = json_decode($notificationBody, true);

            // Update order status
            $order = Order::where('order_id', $notificationData['order']['invoice_number'])->first();

            if ($order) {
                $order->status = $notificationData['transaction']['status'];
                $order->save();

                // Log successful update
                Log::info('Order status updated successfully', [
                    'order_id' => $order->order_id,
                    'new_status' => $order->status
                ]);
            } else {
                Log::error('Order not found for update', [
                    'invoice_number' => $notificationData['order']['invoice_number']
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('DOKU Callback Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    private function createOrder($request, $orderId, $totalAmount)
    {
        $order = Order::create([
            'order_id' => $orderId,
            'user_id' => auth()->id(),
            'shipping_address_id' => $request->shipping_address_id,
            'shipping_cost' => $request->shipping_cost,
            'discount_amount' => $request->discount_amount ?? 0,
            'total_amount' => $totalAmount,
            'order_date' => now(),
            // 'status' => 'pending',
            'total_item' => $request->total_item,
            'total_item_price' => $request->total_item_price,
        ]);

        // Create order items
        foreach ($request->products as $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['price'] * $product['quantity']
            ]);
        }

        return $order;
    }
}
