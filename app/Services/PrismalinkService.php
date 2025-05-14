<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// bisa tapi datanya masih statis
class PrismalinkService
{
    protected $merchId;
    protected $merchKeyId;
    protected $secretKey;
    protected $baseUrl;
    protected $paymentBaseUrl;
    protected $frontendCallbackUrl;
    protected $backendCallbackUrl;
    protected $apiUrl;

    public function __construct()
    {
        $this->merchId = config('services.prismalink.merch_id', env('PRISMALINK_MERCH_ID'));
        $this->merchKeyId = config('services.prismalink.merch_key_id', env('PRISMALINK_MERCH_KEY_ID'));
        $this->secretKey = config('services.prismalink.secret_key', env('PRISMALINK_SECRET_KEY'));
        $this->baseUrl = config('services.prismalink.base_url', env('PRISMALINK_BASE_URL'));
        $this->paymentBaseUrl = 'https://secure2-staging.plink.co.id'; // Base URL untuk halaman pembayaran
        $this->frontendCallbackUrl = config('services.prismalink.frontend_callback', env('PRISMALINK_FRONTEND_CALLBACK'));
        $this->backendCallbackUrl = config('services.prismalink.backend_callback', env('PRISMALINK_BACKEND_CALLBACK'));
        $this->apiUrl = config('services.prismalink.transaction_api', env('PRISMALINK_TRANSACTION_API'));
    }

    /**
     * Buat transaksi pembayaran dengan Prismalink
     * 
     * @param array $paymentData Data pembayaran yang diperlukan
     * @return array Respons dari API dalam format array
     */
    public function createTransaction($paymentData)
    {
        // Mempersiapkan data yang akan dikirim ke API
        $body = [
            "merchant_key_id" => $this->merchKeyId,
            "merchant_id" => $this->merchId,
            "merchant_ref_no" => $paymentData['reference_number'],
            "backend_callback_url" => $this->backendCallbackUrl,
            "frontend_callback_url" => $this->frontendCallbackUrl,
            "transaction_date_time" => now()->format('Y-m-d H:i:s.v O'),
            "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
            "transaction_currency" => "IDR",
            "transaction_amount" => $paymentData['amount'],
            "product_details" => json_encode($paymentData['products']),
            "va_name" => $paymentData['customer_name'],
            "user_name" => $paymentData['customer_name'],
            "user_email" => $paymentData['customer_email'],
            "user_phone_number" => $paymentData['customer_phone'],
            "user_id" => $paymentData['customer_id'],
            "remarks" => $paymentData['remarks'] ?? '',
            "user_device_id" => $paymentData['device_id'],
            "user_ip_address" => $paymentData['ip_address'],
            "shipping_details" => json_encode($paymentData['shipping']),
            "payment_method" => $paymentData['payment_method'] ?? '',
            "other_bills" => json_encode($paymentData['other_bills'] ?? []),
            "invoice_number" => $paymentData['invoice_number'],
            "integration_type" => "01",
            "external_id" => $paymentData['external_id'] ?? '',
            "bank_id" => $paymentData['bank_id'] ?? ''
        ];

        // Log the request body for debugging
        Log::info('Prismalink Request Body', $body);

        // Konversi body ke JSON string exact seperti yang akan dikirim ke API
        $jsonBody = json_encode($body);

        // Simpan body stream untuk debugging
        Log::info('Body stream for HMAC calculation', ['body_stream' => $jsonBody]);

        // Generate MAC: hmac256(body stream, merchant secret key)
        $mac = hash_hmac('sha256', $jsonBody, $this->secretKey);

        // Log the generated MAC for debugging
        Log::info('Generated MAC', ['mac' => $mac, 'secret_key' => $this->secretKey]);

        // Panggil endpoint Prismalink
        $response = Http::withHeaders([
            'mac' => $mac,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, $body);

        $responseData = $response->json();

        // Log the response for debugging
        if ($response->successful()) {
            Log::info('Prismalink Response Success', $responseData);

            // Tambahkan URL lengkap untuk payment page jika ada
            if (isset($responseData['payment_page_url'])) {
                $responseData['full_payment_page_url'] = $this->paymentBaseUrl . $responseData['payment_page_url'];
            }
        } else {
            Log::error('Prismalink Response Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }

        return $responseData;
    }

    /**
     * Mendapatkan URL halaman pembayaran lengkap
     * 
     * @param string $paymentPagePath Path halaman pembayaran dari respons API
     * @return string URL lengkap halaman pembayaran
     */
    public function getFullPaymentUrl($paymentPagePath)
    {
        return $this->paymentBaseUrl . $paymentPagePath;
    }
}

// class PrismalinkService
// {
//     protected $merchId;
//     protected $merchKeyId;
//     protected $secretKey;
//     protected $baseUrl;
//     protected $paymentBaseUrl;
//     protected $frontendCallbackUrl;
//     protected $backendCallbackUrl;
//     protected $apiUrl;

//     public function __construct()
//     {
//         $this->merchId = config('services.prismalink.merch_id', env('PRISMALINK_MERCH_ID'));
//         $this->merchKeyId = config('services.prismalink.merch_key_id', env('PRISMALINK_MERCH_KEY_ID'));
//         $this->secretKey = config('services.prismalink.secret_key', env('PRISMALINK_SECRET_KEY'));
//         $this->baseUrl = config('services.prismalink.base_url', env('PRISMALINK_BASE_URL'));
//         $this->paymentBaseUrl = 'https://secure2-staging.plink.co.id'; // Base URL for payment page
//         $this->frontendCallbackUrl = route('prismalink.callback');
//         $this->backendCallbackUrl = route('prismalink.callback');
//         $this->apiUrl = config('services.prismalink.transaction_api', env('PRISMALINK_TRANSACTION_API'));
//     }

//     /**
//      * Create a payment transaction with Prismalink
//      * 
//      * @param array $paymentData Payment data required
//      * @return array Response from API in array format
//      * @throws \Exception When transaction amount is invalid or API error occurs
//      */
//     public function createTransaction($paymentData)
//     {
//         // Validate transaction amount
//         if (!isset($paymentData['amount']) || $paymentData['amount'] <= 0) {
//             throw new \Exception('Transaction amount must be positive');
//         }

//         // Prepare data to be sent to API
//         $body = [
//             "merchant_key_id" => $this->merchKeyId,
//             "merchant_id" => $this->merchId,
//             "merchant_ref_no" => $paymentData['reference_number'],
//             "backend_callback_url" => $this->backendCallbackUrl,
//             "frontend_callback_url" => $this->frontendCallbackUrl,
//             "transaction_date_time" => now()->format('Y-m-d H:i:s.v O'),
//             "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
//             "transaction_currency" => "IDR",
//             "transaction_amount" => $paymentData['amount'],
//             "product_details" => json_encode($paymentData['products']),
//             "va_name" => $paymentData['customer_name'] ?? null,
//             "user_name" => $paymentData['customer_name'] ?? null,
//             "user_email" => $paymentData['customer_email'],
//             "user_phone_number" => $paymentData['customer_phone'] ?? '',
//             "user_id" => $paymentData['customer_id'],
//             "remarks" => $paymentData['remarks'] ?? '',
//             "user_device_id" => $paymentData['device_id'],
//             "user_ip_address" => $paymentData['ip_address'],
//             "shipping_details" => json_encode($paymentData['shipping']),
//             "payment_method" => "",
//             "other_bills" => json_encode($paymentData['other_bills'] ?? []),
//             "invoice_number" => $paymentData['invoice_number'],
//             "integration_type" => "01",
//             "external_id" => $paymentData['external_id'] ?? '',
//             "bank_id" => ""
//         ];

//         // Log the request body for debugging
//         Log::info('Prismalink Request Body', $body);

//         // Convert body to JSON string exactly as will be sent to API
//         $jsonBody = json_encode($body);

//         // Save body stream for debugging
//         Log::info('Body stream for HMAC calculation', ['body_stream' => $jsonBody]);

//         // Generate MAC: hmac256(body stream, merchant secret key)
//         $mac = hash_hmac('sha256', $jsonBody, $this->secretKey);

//         // Log the generated MAC for debugging
//         Log::info('Generated MAC', ['mac' => $mac, 'secret_key' => $this->secretKey]);

//         // Call Prismalink endpoint
//         $response = Http::withHeaders([
//             'mac' => $mac,
//             'Content-Type' => 'application/json',
//         ])->post($this->apiUrl, $body);

//         $responseData = $response->json();

//         // Log the response for debugging
//         if ($response->successful()) {
//             Log::info('Prismalink Response Success', $responseData);

//             // Check for error response codes from Prismalink (they may return 200 OK but with error codes)
//             if (isset($responseData['response_code']) && $responseData['response_code'] !== '0000') {
//                 throw new \Exception(
//                     'Prismalink API Error: ' .
//                         ($responseData['response_message'] ?? 'Unknown error') . ' - ' .
//                         ($responseData['response_description'] ?? 'No description')
//                 );
//             }

//             // Add full URL for payment page if it exists
//             if (isset($responseData['payment_page_url'])) {
//                 $responseData['full_payment_page_url'] = $this->paymentBaseUrl . $responseData['payment_page_url'];
//             } else {
//                 throw new \Exception('Payment page URL not found in response');
//             }
//         } else {
//             Log::error('Prismalink Response Error', [
//                 'status' => $response->status(),
//                 'body' => $response->body(),
//             ]);

//             throw new \Exception(
//                 'Prismalink API Error: ' .
//                     ($responseData['response_message'] ?? 'HTTP Error ' . $response->status())
//             );
//         }

//         return $responseData;
//     }

//     /**
//      * Get full payment page URL
//      * 
//      * @param string $paymentPagePath Payment page path from API response
//      * @return string Full payment page URL
//      */
//     public function getFullPaymentUrl($paymentPagePath)
//     {
//         return $this->paymentBaseUrl . $paymentPagePath;
//     }
// }
