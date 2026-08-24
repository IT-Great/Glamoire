<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiteshipController;

Route::post('/callback-glamoire-with-biteship', [BiteshipController::class, 'callback']);

// Tambahkan Endpoint untuk Webhook Xendit
Route::post('/xendit/webhook', [XenditController::class, 'webhook']);
