<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Promo;
use App\Models\Shipping_address;
use App\Models\VoucherNewUser;
use App\Models\Buynow;
use App\Services\PrismalinkService;
use Exception;
use Illuminate\Support\Facades\Http;

// bisa tapi datanya masih statis
class PrismalinkController extends Controller
{
    private $merchantKeyId;
    private $merchantId;
    private $backendCallbackUrl;
    private $frontendCallbackUrl;
    private $secretKey;
    private $transactionUrl;
    private $status;

    public function __construct()
    {
        $this->status = config('app.env');
        if($this->status == 'local'){
            $this->merchantKeyId = config('services.prismalink.merch_key_id');
            $this->merchantId = config('services.prismalink.merch_id'); 
            $this->backendCallbackUrl = config('services.prismalink.backend_callback');
            $this->frontendCallbackUrl = config('services.prismalink.frontend_callback');
            $this->secretKey = config('services.prismalink.secret_key');
            $this->transactionUrl = config('services.prismalink.transaction_api');
        }
        else{
            $this->merchantKeyId = config('services.prismalink.merch_key_id');
            $this->merchantId = config('services.prismalink.merch_id'); 
            $this->backendCallbackUrl = config('services.prismalink.backend_callback');
            $this->frontendCallbackUrl = config('services.prismalink.frontend_callback');
            $this->secretKey = config('services.prismalink.secret_key');
            $this->transactionUrl = config('services.prismalink.transaction_api');
        }
    }

    public function viewsSubmitPayment()
    {
        return view('user.component.test-payment');
    }

    public function submitPayment(Request $request)
    {
        if ($request->condition !== "guest"){
            $uniq = uniqid();
            $userId = session('id_user');
            $cartId = Cart::where('user_id', session('id_user'))->value('id');
            $cartItems = Cart_item::where('cart_id', $cartId)
                ->where('is_choose', true)
                ->leftJoin('products', 'cart_items.product_id', '=', 'products.id')
                ->select(
                    'cart_items.product_id as item_code',
                    'cart_items.quantity as quantity',
                    'cart_items.price as total',
                    'products.product_name as item_title'
                )
                ->get()
                ->map(function ($item) {
                    $item->currency = 'IDR';
                    return $item;
                })
                ->toArray();
        }

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
            'plink_ref_no' => null,
        ]);

        $username = session('username');
        $handphone = User::where('id', session('id_user'))->value('handphone');
        session(['condition' => $request->condition]);

        if($request->condition == "buynow"){
            $productName = Product::where('id', $request->products[0]['product_id'])->value('product_name');
            session(['productBuyNow' => $request->products]);
            $body = [
                "merchant_key_id" => $this->merchantKeyId,
                "merchant_id" => $this->merchantId,
                "merchant_ref_no" => "$invoiceCreate->no_invoice",
                "backend_callback_url" => $this->backendCallbackUrl,
                "frontend_callback_url" => $this->frontendCallbackUrl,
                "transaction_date_time" => now()->format('Y-m-d H:i:s.v O'),
                "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
                "transaction_currency" => "IDR",
                "transaction_amount" => $request->total_amount,
                "product_details" => json_encode([
                    [
                        "item_code" => $request->products[0]['product_id'],
                        "item_title" => $productName,
                        "quantity" => $request->products[0]['quantity'],
                        "total" => $request->products[0]['price'],
                    ]
                ]),
                "va_name" => "$username",
                "user_name" => "$username",
                "user_email" => "",
                "user_phone_number" => "+$handphone",
                "user_id" => "",
                "remarks" => "",
                "user_device_id" => $request->header('User-Agent'),
                "user_ip_address" => $request->ip(),
                "shipping_details" => '',
                "payment_method" => "",
                "other_bills" => json_encode([
                    [
                        "title" => "Ongkos kirim",
                        "value" => $request->shipping_cost,
                    ]
                ]),
                "invoice_number" => "$invoiceCreate->no_invoice",
                "integration_type" => "01",
                "external_id" => "$invoiceCreate->no_invoice",
                "bank_id" => ""
            ];
        }
        // KERANJANG -> BUY
        elseif($request->condition == "standard"){
            if($request->total_amount == 0){
                $body = [
                    "merchant_key_id" => $this->merchantKeyId,
                    "merchant_id" => $this->merchantId,
                    "merchant_ref_no" => "$invoiceCreate->no_invoice",
                    "backend_callback_url" => $this->backendCallbackUrl,
                    "frontend_callback_url" => $this->frontendCallbackUrl,
                    "transaction_date_time" => now()->format('Y-m-d H:i:s.v O'),
                    "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
                    "transaction_currency" => "IDR",
                    "transaction_amount" => 1,
                    "product_details" => json_encode($cartItems),
                    "va_name" => "$username",
                    "user_name" => "$username",
                    "user_email" => "",
                    "user_phone_number" => "+$handphone",
                    "user_id" => "",
                    "remarks" => "",
                    "user_device_id" => $request->header('User-Agent'),
                    "user_ip_address" => $request->ip(),
                    "shipping_details" => '',
                    "payment_method" => "",
                    // "payment_method" => "DD",
                    "other_bills" => json_encode([
                        [
                            "title" => "Ongkos kirim",
                            "value" => $request->shipping_cost,
                        ]
                    ]),
                    "invoice_number" => "$invoiceCreate->no_invoice",
                    "integration_type" => "01",
                    // "integration_type" => "03",
                    "validity" => now()->addMinutes(60)->format('Y-m-d H:i:s.v O'),
                    "external_id" => "$invoiceCreate->no_invoice",
                    "bank_id" => ""
                    // "bank_id" => "022"
                ];
            }else{
                $body = [
                    "merchant_key_id" => $this->merchantKeyId,
                    "merchant_id" => $this->merchantId,
                    "merchant_ref_no" => "$invoiceCreate->no_invoice",
                    "backend_callback_url" => $this->backendCallbackUrl,
                    "frontend_callback_url" => $this->frontendCallbackUrl,
                    "transaction_date_time" => now()->format('Y-m-d H:i:s.v O'),
                    "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
                    "transaction_currency" => "IDR",
                    "transaction_amount" => $request->total_amount,
                    "product_details" => json_encode($cartItems),
                    "va_name" => "$username",
                    "user_name" => "$username",
                    "user_email" => "",
                    "user_phone_number" => "+$handphone",
                    "user_id" => "",
                    "remarks" => "",
                    "user_device_id" => $request->header('User-Agent'),
                    "user_ip_address" => $request->ip(),
                    "shipping_details" => '',
                    "payment_method" => "",
                    // "payment_method" => "DD",
                    "other_bills" => json_encode([
                        [
                            "title" => "Ongkos kirim",
                            "value" => $request->shipping_cost,
                        ]
                    ]),
                    "invoice_number" => "$invoiceCreate->no_invoice",
                    "integration_type" => "01",
                    // "integration_type" => "03",
                    "validity" => now()->addMinutes(60)->format('Y-m-d H:i:s.v O'),
                    "external_id" => "$invoiceCreate->no_invoice",
                    "bank_id" => ""
                    // "bank_id" => "022"
                ];
                
            }
        }
        // elseif($request->condition == "guest"){
        //    $body = [
        //         "merchant_key_id" => $this->merchantKeyId,
        //         "merchant_id" => $this->merchantId,
        //         "merchant_ref_no" => "$invoiceCreate->no_invoice",
        //         "backend_callback_url" => $this->backendCallbackUrl,
        //         "frontend_callback_url" => $this->frontendCallbackUrl,
        //         "transaction_date_time" => now()->format('Y-m-d H:i:s.v O'),
        //         "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
        //         "transaction_currency" => "IDR",
        //         "transaction_amount" => $request->total_amount,
        //         "product_details" => json_encode($request->products),
        //         "va_name" => "$username",
        //         "user_name" => "$username",
        //         "user_email" => "",
        //         "user_phone_number" => "+$handphone",
        //         "user_id" => "",
        //         "remarks" => "",
        //         "user_device_id" => $request->header('User-Agent'),
        //         "user_ip_address" => $request->ip(),
        //         "shipping_details" => '',
        //         "payment_method" => "",
        //         // "payment_method" => "DD",
        //         "other_bills" => json_encode([
        //             [
        //                 "title" => "Ongkos kirim",
        //                 "value" => $request->shipping_cost,
        //             ]
        //         ]),
        //         "invoice_number" => "$invoiceCreate->no_invoice",
        //         "integration_type" => "01",
        //         // "integration_type" => "03",
        //         "validity" => now()->addMinutes(60)->format('Y-m-d H:i:s.v O'),
        //         "external_id" => "$invoiceCreate->no_invoice",
        //         "bank_id" => ""
        //         // "bank_id" => "022"
        //     ];
        // }

        
        // Konversi body ke JSON string exact seperti yang akan dikirim ke API
        $jsonBody = json_encode($body);

        // Simpan body stream untuk debugging
        // Log::info('Body stream for HMAC calculation', ['body_stream' => $jsonBody]);

        // Menggunakan secret key dari env secara langsung
        $secretKey = $this->secretKey;
        $mac = hash_hmac('sha256', $jsonBody, $secretKey);

        // Log the generated MAC for debugging
        // Log::info('Generated MAC', ['mac' => $mac, 'secret_key' => $secretKey]);

        // Panggil endpoint Prismalink dengan MAC yang dihasilkan secara dinamis
        $url = $this->transactionUrl;   
        
        $response = Http::withHeaders([
            'mac' => $mac,
            'Content-Type' => 'application/json',
        ])->post($url, $body);

        Log::info(['Body :' => $body]);
        // Log::info(['ambil response :' => $response->json()]);

        $status = $response->json();
        
        // Cek apakah response berhasil
        if ($status['response_code'] == "PL000") {
            $data = $response->json();
            // Log::info('Hasil Post Pembayaran :', $data);

            $saveCheckStatus = $this->checkStatus($invoiceCreate->no_invoice, $data['plink_ref_no'], $data['timestamp']);
            
            session(['merchant_ref_no' => $invoiceCreate->no_invoice]);
            session(['plink_ref_no' => $data['plink_ref_no']]);
            session(['transmission_date_time' => $data['validity']]);

            // Log::info('Response Session Setelah Submit Transaksi', session()->all());

            if (isset($data['payment_page_url'])) {
                // Base URL untuk halaman pembayaran Prismalink


                if($this->status == 'local'){
                    $paymentBaseUrl = 'https://secure2-staging.plink.co.id';
                }
                else{
                    $paymentBaseUrl = 'https://secure3.plink.co.id';
                }

                // Dapatkan payment_page_url dari respons
                $paymentPagePath = $data['payment_page_url'];

                // Kombinasikan base URL dengan path untuk mendapatkan URL lengkap
                $fullPaymentPageUrl = $paymentBaseUrl . $paymentPagePath;
                $directDebit = $paymentPagePath;

                // Log URL lengkap untuk debugging
                // Log::info('Full Payment Page URL', ['url' => $fullPaymentPageUrl]);

                // Redirect ke halaman pembayaran
                // return redirect()->away($fullPaymentPageUrl);

                // SIMPAN DATA ORDERAN SEMENTARA
                // Log::info(['Request Data :' => $request]);

                $orderId = 'ORDER-' . time() . '-' . Str::random(5);
                $shippingAddressId = $request->shipping_address_id;
                $shippingCost = $request->shipping_cost;
                $discountAmount = $request->discount_amount;
                $discountOngkir = $request->discount_ongkir;
                $totalAmount = $request->total_amount;
                $totalItem = $request->total_item;
                $totalItemPrice = $request->total_item_price;
                $voucherPromo = $request->voucher_promo;
                $voucherOngkir = $request->voucher_ongkir;
                $destinationArea = $request->destinationArea;
                $originArea = $request->originArea;
                $courier = $request->courier;
                $etd = $request->etd;
                $description = $request->description;
                $destinationPostalCode = $request->destinationPostalCode;
                
                $orderData = $this->saveData($orderId, $totalAmount, $shippingAddressId, $shippingCost, $discountOngkir, $discountAmount, $totalItem, $totalItemPrice, $voucherPromo, $voucherOngkir, $destinationArea, $originArea, $courier, $etd, $description, $destinationPostalCode);
                session(['order_data' => $orderData]);
                
                // Log::info(['Request : ' => $request]);

                $deadline = Carbon::parse($data['validity']);

                // Format dalam Bahasa Indonesia (jika kamu sudah set locale)
                // App::setLocale('id'); // Pastikan ini ditetapkan                
                
                $formattedDeadline = $deadline->translatedFormat('l, d F Y - H:i') . ' WIB';

                Log::info("Request payment | User ID :" . session('id_user') .  "| Payment page :" . $fullPaymentPageUrl . " | Deadline:" . $formattedDeadline);

                return response()->json([
                    'success' => true,
                    'payment_url' => $fullPaymentPageUrl,
                    // 'payment_url' => $directDebit,
                    'deadline' => $formattedDeadline,
                ]);
            }

            // Jika tidak ada payment_page_url
            return back()->with('error', 'Response received, but no payment page URL was found.');
        } else {
            // Log error detail
            Log::error('User', session('id_user'), 'failed request payment, redirecting to payment page :', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            // Log::error('Prismalink Response Error :', [
            //     'status' => $response->status(),
            //     'body' => $response->body(),
            // ]);

            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function callback()
    {
        try {
            $payment_status = $this->getPaymentStatus();

            // Log::info('Payment status setelah callback', [
            // 'payment' => $payment_status
            // ]);

            if ($payment_status instanceof \Illuminate\Http\RedirectResponse) {
                return $payment_status; // Redirect ke route checkout
            }

            if (is_null($payment_status)) {
                return redirect()->route('checkout')->with('error', 'Payment status not found.');
            }

            Log::info("Payment callback received | User ID: " . session('id_user') . " | status:" . $payment_status['transaction_status']);


            // PEMBAYARAN BERHASIL 
            if ($payment_status['transaction_status'] == 'SETLD') {
                $data = $payment_status;
                // Log::info('Callback Success : ', $data);
                
                session(['activeTab' => '#my-order']);
                session()->flash('payment_success');
                // Log::info(['Isi Session Order Data :', session('order_data')]);
                $this->createNewOrder(session('order_data'));
                $orderData = session('order_data');
                $order_id = session('order_id');

                $items = Order::where('id', $order_id)->with('orderItems.product')->first();

                // Log::info('Order Details after Payment Success:', [
                //     'oder_data' => $orderData,
                //     'order_id' => $order_id,
                //     'items' => $items,
                // ]);
                
                // Log::info(['User', session('id_user'), 'success payment for invoice :', session('merchant_ref_no')]);
                Log::info("Successfully Payment Order | User ID: " . session('id_user') . " | invoice:" . session('merchant_ref_no') . " | Order ID: " . $order_id . " | Amount: " . $items->total_amount);
                return redirect()->route('account', ['user' => session('id_user')]);
            } else {
                Invoice::where('no_invoice', session('merchant_ref_no'))->delete();
                Log::info("Payment callback error | User ID: " . session('id_user') . " | invoice:" . session('merchant_ref_no') . " | status:" . $payment_status['transaction_status']);
                // Log::error('Prismalink Response Error :', [
                //     'status' => $payment_status['response_code'],
                // ]);

                return back()->with('error', 'Payment request failed: ' . $payment_status['response_code']);
            }
            
        } catch (\Exception $e) {
            Log::error('Prismalink Callback Error: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'An error occurred during payment processing.');
        }
    }

    public function callbackCreateOrder()
    {
        $this->createNewOrder(session('order_data'));
    }

    private function checkStatus($merchant_ref_no, $plink_ref_no, $transmission_date_time){
        $data = [
            'merchant_ref_no' => $merchant_ref_no,
            'plink_ref_no' => $plink_ref_no,
            'transmission_date_time' => $transmission_date_time,
        ];

        return $data;
    }

    private function createNewOrder(array $orderData)
    {
        // Log::info(['Callback Success : ', $orderData]);
        $getInvoiceId = Invoice::where('no_invoice', session('merchant_ref_no'))->value('id');

        // Update Invoice Saat pembayaran berhasil
        Invoice::where('id', $getInvoiceId)->update([
            'plink_ref_no' => session('plink_ref_no'),
            'transmission_date_time' => session('transmission_date_time'),
        ]);

        if(session('condition') == 'standard'){
            $order = Order::create([
                'invoice_id' => $getInvoiceId,
                'user_id' => auth()->id(), 
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
            ]);

            session(['order_id' => $order->id]);
    
            $cartId = Cart::where('user_id', session('id_user'))->value('id');
            $cartItems = Cart_item::where('cart_id', $cartId)
                ->where('is_choose', true)
                ->with(['product.brand'])
                ->get();
    
            foreach ($cartItems as $item) {
                if ($item->product && $item->product->promos->where('status', 'Active')) {
                    foreach ($item->product->promos->where('status', 'Active') as $promo) {
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
    
                    // Log::info(['Bayar Item Checkout :' => [
                    //     'product_id' => $item->product_id,
                    //     'product_variant_id' => $item->product_variant_id,
                    //     'quantity' => $item->quantity,
                    //     'price' => $item->price,
                    //     'is_tier' => $item->bundle_price,
                    //     'subtotal' => $item->bundle_price !== null ? $item->bundle_price : $item->quantity * $item->price,
                    // ]]);

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $item->product_id,
                        'product_variant_id' => $item->product_variant_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'is_tier' => $item->bundle_price,
                        'subtotal' => $item->bundle_price !== null ? $item->bundle_price : $item->quantity * $item->price,
                    ]);
                }
            }
        }
        elseif(session('condition') == 'buynow'){
            $order = Order::create([
                'invoice_id' => $getInvoiceId,
                'user_id' => auth()->id(), 
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
            ]);

            $cartItems = Buynow::where('user_id', session('id_user'))
                ->where('is_buy', false)
                ->with(['product.brand'])
                ->get();
    
            foreach ($cartItems as $item) {
                if ($item->product && $item->product->promos->where('status', 'Active')) {
                    foreach ($item->product->promos->where('status', 'Active') as $promo) {
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
    
                        // Log::info(['Bayar Item Buy Now :' => [
                        //     'product_id' => $item->product_id,
                        //     'product_variant_id' => $item->product_variant_id,
                        //     'quantity' => $item->quantity,
                        //     'price' => $item->price,
                        //     'is_tier' => $item->bundle_price,
                        //     'subtotal' => $item->bundle_price !== null ? $item->bundle_price : $item->quantity * $item->price,
                        // ]]);

                        OrderItem::create([
                            'order_id'   => $order->id,
                            'product_id' => $item->product_id,
                            'product_variant_id' => $item->product_variant_id,
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                            'is_tier' => $item->bundle_price,
                            'subtotal' => $item->bundle_price !== null ? $item->bundle_price : $item->quantity * $item->price,
                        ]);
                }
            }
        }

        $userId = session('id_user');

        $payment_status = $this->getPaymentStatus();

        $statusMap = [
            'SETLD' => 'completed',
            'REJEC' => 'failed',
            'PNDNG' => 'pending'
        ];

        $payment = Payment::create([
            'user_id'        => $userId,
            'order_id'       => $order->id,
            'payment_method' => $payment_status['payment_method'],
            'transaction_id' => $payment_status['transaction_status'],
            'status'         => $statusMap[$payment_status['transaction_status']],
            'amount'         => $payment_status['transaction_amount'],
            'payment_date'   => now(),
        ]);

        Order::where('id', $order->id)->update([
            'payment_id' => $payment->id,
        ]);

        // Update status voucher jika digunakan
        $useVoucherNewUser = VoucherNewUser::where('user_id', $userId)
            ->where('code', $orderData['voucherPromo'])
            ->first();
        
        if ($useVoucherNewUser) {
            $useVoucherNewUser->is_use = 1;
            $useVoucherNewUser->save();
        }

        if($useVoucherNewUser == NULL){
            $voucherUsed = Promo::where('promo_code', $orderData['voucherPromo'])->first();
        }
        else {
            $voucherUsed = NULL;
        }

        if ($orderData['voucherOngkir'] !== null) {
            $ongkirUsed = Promo::where('promo_code', $orderData['voucherOngkir'])->first();
        }

        // Jika pembayaran selesai
       
        if ($payment->status == "completed") {
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
            
            foreach($cartItems as $product){
                // Temukan produk berdasarkan ID\
                if($product['product_variant_id'] !== null){
                    $productVariant = ProductVariations::find($product['product_variant_id']);
                    $getProductId = ProductVariations::where('id', $product['product_variant_id'])->value('product_id');
                    $productMain = Product::find($getProductId);

                    // Jika produk ditemukan, lakukan update stok
                    if ($productVariant) {
                        $productVariant->variant_stock -= $product['quantity'];
                        $productVariant->save();

                        $productMain->sale += $product['quantity'];
                        $productMain->save();
                    }
        
                    // Hapus item dari cart berdasarkan cart_id dan product_id
                    Cart_item::where('cart_id', $cartId)
                        ->where('product_variant_id', $product['product_variant_id'])
                        ->delete();
                }
                else{
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

    private function saveData($orderId, $totalAmount, $shippingAddressId, $shippingCost, $discountOngkir, $discountAmount, $totalItem, $totalItemPrice, $voucherPromo, $voucherOngkir, $destinationArea, $originArea, $courier, $etd, $description, $destinationPostalCode){
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
            'destiantionArea' => $destinationArea,
            'originArea' => $originArea,
            'courier' => $courier,
            'etd' => $etd,
            'description' => $description,
            'destinationPostalCode' => $destinationPostalCode,
        ];

        return $data;
    }

    private function getPaymentStatus(){
        try{
            $url = 'https://api-staging.plink.co.id/gateway/v2/payment/integration/transaction/api/inquiry-transaction';
    
            $body = [
                "merchant_key_id" => $this->merchantKeyId,
                "merchant_id" => $this->merchantId,
                "merchant_ref_no" => session('merchant_ref_no'),
                "plink_ref_no" => session('plink_ref_no'),
                "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
            ];
    
            $jsonBody = json_encode($body);
            $secretKey = $this->secretKey;
            $mac = hash_hmac('sha256', $jsonBody, $secretKey);
            
            // Log::info('Body Check Status : ', $body);
            $response = Http::withHeaders([
                'mac' => $mac,
                'Content-Type' => 'application/json',
            ])->post($url, $body);
    
            $result = json_decode($response->getBody(), true);
            // Log::info('Hasil Pembayaran : ', $result);
            return $result;
        }
        catch(Exception $err){
            dd($err->getMessage());
            Log::error('Error getPaymentStatus: ' . $err->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error occurred while getting payment status.',
            ]);
        }
    }
}