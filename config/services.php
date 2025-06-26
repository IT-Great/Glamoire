<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'doku' => [
        'client_id' => env('DOKU_CLIENT_ID'),
        'secret_key' => env('DOKU_SECRET_KEY'),
        'environment' => env('DOKU_ENVIRONMENT', 'sandbox'),
    ],

    'prismalink' => [
        'merch_id' => env('PRISMALINK_MERCH_ID'),
        'merch_key_id' => env('PRISMALINK_MERCH_KEY_ID'),
        'secret_key' => env('PRISMALINK_SECRET_KEY'),
        'base_url' => env('PRISMALINK_BASE_URL'),
        'mac' => env('PRISMALINK_MAC'),
        'frontend_callback' => env('PRISMALINK_FRONTEND_CALLBACK'),
        'backend_callback' => env('PRISMALINK_BACKEND_CALLBACK'),
        'transaction_api' => env('PRISMALINK_TRANSACTION_API', 'https://api-staging.plink.co.id/gateway/v2/payment/integration/transaction/api/submit-trx'),
    ],

];
