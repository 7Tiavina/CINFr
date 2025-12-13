<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StripeWebhookController;

use App\Http\Controllers\MairieController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/liste-des-mairies', [MairieController::class, 'index'])->name('mairies');

Route::get('/predemande', function () {
    return view('forms-predemande');
})->name('predemande');

Route::get('/contact', function () {
    return view('forms-contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/mentions', function () {
    return view('mentions-legales');
})->name('mentions');

Route::get('/remboursement', function () {
    return view('politique-remboursement');
})->name('remboursement');



Route::post('/create-checkout-session', [StripeController::class,'createCheckoutSession'])->name('create-checkout-session');
Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');

Route::get('/success', [StripeController::class, 'showSuccessPage'])->name('success'); 
// Le stockage des données est maintenant géré par le webhook.

// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Stripe Webhook Route
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');