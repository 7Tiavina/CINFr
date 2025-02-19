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