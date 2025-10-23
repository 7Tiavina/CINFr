<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ClientController;

Route::middleware(['auth.backend'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
});
