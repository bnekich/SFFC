<?php

use Illuminate\Support\Facades\Route;

# root route

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');