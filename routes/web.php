<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

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



Route::get('/mentions', function () {
    return view('mentions-legales');
})->name('mentions');

Route::get('/remboursement', function () {
    return view('politique-remboursement');
})->name('remboursement');



Route::post('/test', [StripeController::class,'test'])->name('test');
Route::post('/live', [StripeController::class,'live'])->name('live');
Route::get('/success', [StripeController::class,'success'])->name('success');
Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
