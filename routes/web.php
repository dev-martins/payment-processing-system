<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('payment');
});

Route::prefix('payment')->group(function () {
    Route::any('/', [PaymentController::class, 'index'])->name('payment');
    Route::get('/agradecimento', [PaymentController::class, 'confirmation'])->name('confirmation');
});

Route::prefix('billing')->group(function () {
    Route::get('/', function () {
        return view('billing');
    })->name('billingCreate');
});
