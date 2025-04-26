<?php

use Illuminate\Support\Facades\Route;

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
