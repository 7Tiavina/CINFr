<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/liste-des-mairies', function () {
    return view('liste-des-mairies');
})->name('mairies');

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



Route::post('/test', [StripeController::class,'test'])->name('test');
Route::post('/live', [StripeController::class,'live'])->name('live');
Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');

Route::get('/success', [StripeController::class, 'showSuccessPage'])->name('success'); 
// Stockage des données (POST)  
Route::post('/success', [StripeController::class,'storeSessionData'])->name('success.store');
