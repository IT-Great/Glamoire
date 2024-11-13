<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DokuService
{
    protected $clientId;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->clientId = config('services.doku.client_id');
        $this->apiKey = config('services.doku.api_key');
        $this->baseUrl = config('services.doku.base_url');
    }

    public function createPayment(array $data)
    {
        $response = Http::withHeaders([
            'Client-Id' => $this->clientId,
            'Request-Id' => uniqid(),
            'Request-Timestamp' => now()->format('Y-m-d\TH:i:s\Z'),
            'Signature' => $this->generateSignature(),
        ])->post("{$this->baseUrl}/v1/payment", $data);

        return $response->json();
    }

    protected function generateSignature()
    {
        $signatureData = "Client-Id={$this->clientId}&Key={$this->apiKey}";
        return hash_hmac('sha256', $signatureData, $this->apiKey);
    }
}
