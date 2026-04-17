<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/demandedepot', function () {
    return view('landing.demandedepot');
})->name('demandedepot');

Route::post('/payment/initiate', [App\Http\Controllers\PaymentController::class, 'initiatePayment'])->name('payment.initiate');
Route::get('/payment/success', [App\Http\Controllers\PaymentController::class, 'paymentSuccess'])->name('payment.success');

// Route Webhook PayDunya (Doit ignorer la vérification CSRF car appelé par le serveur PayDunya)
Route::post('/payment/ipn', [App\Http\Controllers\PaymentController::class, 'handleIPN'])
    ->name('payment.ipn')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
