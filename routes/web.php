<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('checkout_form');
});

Route::get('/payment-success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment-failed', [PaymentController::class, 'failed'])->name('payment.failed');
Route::post('/payment/checkout', [PaymentController::class, 'paymentProcess'])->name('payment.process');
