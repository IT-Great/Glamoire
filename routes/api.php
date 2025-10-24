<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiteshipController;

Route::get('/callback-glamoire-with-biteship', [BiteshipController::class, 'callback']);
