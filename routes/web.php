<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarbecueController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::resource('barbecues', BarbecueController::class)->middleware('auth');
Route::resource('guests', GuestController::class);

Route::get('/', function () {
    return view('home');
});

Route::get('/contactus', function () {
    return view('contactus');
});

// Route to handle both login and registration
Route::post('/login-or-register', [AuthController::class, 'loginOrRegister'])->name('login-or-register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route to handle authentication
Route::get('/login', [AuthController::class, 'auth'])->name('login');

Route::get('/barbecue/{id}/invite', [GuestController::class, 'show'])->name('guests.show');
Route::post('/barbecue/{id}/invite', [GuestController::class, 'store'])->name('guests.store');

Route::get('/barbecue/confirmation', function () {
    return view('guests.confirmation');
})->name('guests.confirmation');

Route::post('/barbecues/{id}/create-payment-link', [PaymentController::class, 'create'])->name('barbecues.createPaymentLink')->middleware('auth');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
