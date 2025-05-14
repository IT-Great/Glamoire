<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
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
use App\Services\PrismalinkService;
use Illuminate\Support\Facades\Http;

// bisa tapi datanya masih statis
class PrismalinkController extends Controller
{
    public function viewsSubmitPayment()
    {
        return view('user.component.test-payment');
    }

    public function submitPayment(Request $request)
    {
        // Log semua environment variables terkait Prismalink untuk debug
        Log::info('Prismalink ENV Variables', [
            'PRISMALINK_MERCH_ID' => env('PRISMALINK_MERCH_ID'),
            'PRISMALINK_MERCH_KEY_ID' => env('PRISMALINK_MERCH_KEY_ID'),
            'PRISMALINK_SECRET_KEY' => env('PRISMALINK_SECRET_KEY'),
            'PRISMALINK_MAC' => env('PRISMALINK_MAC'),
        ]);

        $body = [
            "merchant_key_id" => env('PRISMALINK_MERCH_KEY_ID', '8f0f43c38c0e456faa3340077b84e42e'),
            "merchant_id" => env('PRISMALINK_MERCH_ID', '001746361612626'),
            "merchant_ref_no" => "ebelanja-testing-paymentpage-900909",
            "backend_callback_url" => env('PRISMALINK_BACKEND_CALLBACK', 'https://prismalink.co.id'),
            "frontend_callback_url" => env('PRISMALINK_FRONTEND_CALLBACK', 'https://prismalink.co.id'),
            "transaction_date_time" => now()->format('Y-m-d H:i:s.v O'),
            "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
            "transaction_currency" => "IDR",
            "transaction_amount" => 42750,
            "product_details" => '[{"item_code":18566,"item_title":"Masker Disposable KF94 Tali Warna Maskit","quantity":1,"total":33750,"currency":"IDR"}]',
            "va_name" => "Alo Jali",
            "user_name" => "Alo Jali",
            "user_email" => "alo@gmail.com",
            "user_phone_number" => "+628993434344",
            "user_id" => "118",
            "remarks" => "3424324322434",
            "user_device_id" => $request->header('User-Agent'),
            "user_ip_address" => $request->ip(),
            "shipping_details" => '{"address":"Alo Jali<br/>Alo.corp<br/>Kunginan setiabudi<br/>Jakarta, Kota DKI Jakarta<br/>DKI Jakarta<br/>2533","telephoneNumber":"+628993434344","handphoneNumber":""}',
            "payment_method" => "",
            "other_bills" => '[{"title":"Pajak","value":0},{"title":"Ongkos kirim","value":9000}]',
            "invoice_number" => "WOOINV-000000070070153-19211",
            "integration_type" => "01",
            "external_id" => "testing123",
            "bank_id" => ""
        ];

        // Log the request body for debugging
        Log::info('Prismalink Request Body', $body);

        // Konversi body ke JSON string exact seperti yang akan dikirim ke API
        $jsonBody = json_encode($body);

        // Simpan body stream untuk debugging
        Log::info('Body stream for HMAC calculation', ['body_stream' => $jsonBody]);

        // Menggunakan secret key dari env secara langsung
        $secretKey = env('PRISMALINK_SECRET_KEY', '21b8b5e7f47f0d53756a6cf7');
        $mac = hash_hmac('sha256', $jsonBody, $secretKey);

        // Log the generated MAC for debugging
        Log::info('Generated MAC', ['mac' => $mac, 'secret_key' => $secretKey]);

        // Panggil endpoint Prismalink dengan MAC yang dihasilkan secara dinamis
        $url = env('PRISMALINK_TRANSACTION_API', 'https://api-staging.plink.co.id/gateway/v2/payment/integration/transaction/api/submit-trx');

        $response = Http::withHeaders([
            'mac' => $mac,
            'Content-Type' => 'application/json',
        ])->post($url, $body);

        // Cek apakah response berhasil
        if ($response->successful()) {
            $data = $response->json();

            Log::info('Prismalink Response Success', $data);

            if (isset($data['payment_page_url'])) {
                // Base URL untuk halaman pembayaran Prismalink
                $paymentBaseUrl = 'https://secure2-staging.plink.co.id';

                // Dapatkan payment_page_url dari respons
                $paymentPagePath = $data['payment_page_url'];

                // Kombinasikan base URL dengan path untuk mendapatkan URL lengkap
                $fullPaymentPageUrl = $paymentBaseUrl . $paymentPagePath;

                // Log URL lengkap untuk debugging
                Log::info('Full Payment Page URL', ['url' => $fullPaymentPageUrl]);

                // Redirect ke halaman pembayaran
                return redirect()->away($fullPaymentPageUrl);
            }

            // Jika tidak ada payment_page_url
            return back()->with('error', 'Response received, but no payment page URL was found.');
        } else {
            // Log error detail
            Log::error('Prismalink Response Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return back()->with('error', 'Payment request failed: ' . $response->body());
        }
    }
}


// class PrismalinkController extends Controller
// {
//     private $prismalinkService;

//     public function __construct(PrismalinkService $prismalinkService)
//     {
//         $this->prismalinkService = $prismalinkService;
//     }

//     public function viewsSubmitPayment()
//     {
//         return view('user.component.test-payment');
//     }

//     public function initiatePayment(Request $request)
//     {
//         try {
//             // Generate unique order/reference number
//             $referenceNumber = 'PRISMA-' . time() . '-' . Str::random(5);

//             // Get user data
//             $user = auth()->user();

//             // Get products from the request
//             $products = json_decode($request->products, true);
//             $formattedProducts = [];

//             // Format products for Prismalink
//             foreach ($products as $product) {
//                 $formattedProducts[] = [
//                     'item_code' => $product['id'],
//                     'item_title' => $product['name'],
//                     'quantity' => $product['quantity'],
//                     'total' => $product['price'] * $product['quantity'],
//                     'currency' => 'IDR'
//                 ];
//             }

//             // Format shipping details
//             $shippingAddress = Shipping_address::find($request->shipping_address_id);
//             if (!$shippingAddress) {
//                 // Handle error or assign default
//                 $shippingDetails = [
//                     'address' => 'Address not found',
//                     'telephoneNumber' => $user->phone_number ?? '',
//                     'handphoneNumber' => ''
//                 ];
//             } else {
//                 $shippingDetails = [
//                     'address' => $user->name . '<br/>' .
//                         ($user->company ?? '') . '<br/>' .
//                         $shippingAddress->address . '<br/>' .
//                         $shippingAddress->city . ', ' . $shippingAddress->state . '<br/>' .
//                         $shippingAddress->province . '<br/>' .
//                         $shippingAddress->postal_code,
//                     'telephoneNumber' => $user->phone_number ?? '',
//                     'handphoneNumber' => ''
//                 ];
//             }


//             // Format additional costs
//             $otherBills = [
//                 ['title' => 'Pajak', 'value' => 0],
//                 ['title' => 'Ongkos kirim', 'value' => (int)$request->shipping_cost]
//             ];

//             // If discount exists, add it to other bills
//             if ($request->discount_amount > 0) {
//                 $otherBills[] = ['title' => 'Diskon', 'value' => -(int)$request->discount_amount];
//             }

//             // If shipping discount exists, adjust shipping cost
//             if ($request->discount_ongkir > 0) {
//                 $otherBills[1]['value'] = (int)$request->shipping_cost - (int)$request->discount_ongkir;
//             }

//             // Prepare payment data for the service
//             $paymentData = [
//                 'reference_number' => $referenceNumber,
//                 'amount' => (int)$request->total_amount,
//                 'products' => $formattedProducts,
//                 'customer_name' => $user->name,
//                 'customer_email' => $user->email,
//                 'customer_phone' => $user->phone_number ?? '',
//                 'customer_id' => $user->id,
//                 'device_id' => $request->header('User-Agent'),
//                 'ip_address' => $request->ip(),
//                 'shipping' => $shippingDetails,
//                 'other_bills' => $otherBills,
//                 'invoice_number' => 'WOOINV-' . time() . '-' . $user->id,
//                 'external_id' => $referenceNumber,
//                 'remarks' => $request->voucher_promo ?? ''
//             ];

//             // Save order data in session for callback processing
//             $orderData = [
//                 'orderId' => $referenceNumber,
//                 'totalAmount' => (int)$request->total_amount,
//                 'shippingAddressId' => $request->shipping_address_id,
//                 'shippingCost' => (int)$request->shipping_cost,
//                 'discountAmount' => (int)$request->discount_amount,
//                 'discountOngkir' => (int)$request->discount_ongkir,
//                 'totalItem' => (int)$request->total_item,
//                 'totalItemPrice' => (int)$request->total_item_price,
//                 'voucherPromo' => $request->voucher_promo,
//                 'voucherOngkir' => $request->voucher_ongkir,
//                 'products' => $products
//             ];

//             session(['prismalink_order_data' => $orderData]);

//             // Create transaction through service
//             $response = $this->prismalinkService->createTransaction($paymentData);

//             if (isset($response['full_payment_page_url'])) {
//                 return response()->json([
//                     'success' => true,
//                     'payment_url' => $response['full_payment_page_url'],
//                     'data' => $response
//                 ]);
//             } else {
//                 // throw new \Exception('Invalid payment URL response');
//             }
//         } catch (\Exception $e) {
//             Log::error('Prismalink Payment Error: ' . $e->getMessage());
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Terjadi kesalahan saat memproses pembayaran',
//                 'error' => $e->getMessage()
//             ], 500);
//         }
//     }

//     public function callback(Request $request)
//     {
//         try {
//             Log::info('Prismalink Callback received', $request->all());

//             // Get order data from session
//             $orderData = session('prismalink_order_data');

//             if (!$orderData) {
//                 Log::error('Order data not found in session');
//                 return redirect()->route('checkout')->with('error', 'Order data not found.');
//             }

//             // Process payment status
//             // This needs to be implemented based on how Prismalink sends the status
//             $paymentStatus = $request->input('status') ?? 'PENDING';

//             $statusMap = [
//                 'SUCCESS' => 'completed',
//                 'PENDING' => 'pending',
//                 'FAILED' => 'failed'
//             ];

//             // Create the order in your database based on status
//             if ($paymentStatus === 'SUCCESS') {
//                 // Call your order creation method (similar to createNewOrder in DokuPaymentController)
//                 // $this->createNewOrder($orderData);
//                 session()->flash('payment_success');
//                 return redirect()->route('account', ['user' => auth()->id()]);
//             } elseif ($paymentStatus === 'PENDING') {
//                 return redirect()->route('checkout')->with('info', 'Your payment is being processed.');
//             } else {
//                 session()->flash('payment_failed');
//                 return redirect()->route('checkout')->with('error', 'Payment failed.');
//             }
//         } catch (\Exception $e) {
//             Log::error('Prismalink Callback Error: ' . $e->getMessage());
//             return redirect()->route('checkout')->with('error', 'An error occurred during payment processing.');
//         }
//     }

//     // Add this method similar to your DokuPaymentController to create the order
//     private function createNewOrder(array $orderData)
//     {
//         // Implementation will be similar to your DokuPaymentController method
//         // This handles creating the invoice, order, order items, and updating inventory
//     }
// }
