<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/liste-des-mairies', function () {
    return view('mairies');
})->name('mairies');

Route::get('/pre-demande', function () {
    return view('predemande');
})->name('predemande');