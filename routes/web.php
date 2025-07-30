<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');
