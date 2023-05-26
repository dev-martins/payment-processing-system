<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('payment')->group(function () {
    Route::post('/simulate', [PaymentController::class, 'simulatePayment']);
    Route::post('/create', [PaymentController::class, 'boletoPayment']);
    Route::post('/create/billing', [PaymentController::class, 'createBillingPayment']);
    Route::get('/pix', [PaymentController::class, 'getQrCode']);
    Route::post('/pix', [PaymentController::class, 'pixPayment']);
    Route::post('/credit/card', [PaymentController::class, 'cardPayment']);
});

Route::prefix('billing')->group(function () {
    Route::post('/', [BillingController::class, 'createBilling']);
});
