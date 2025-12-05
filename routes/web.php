<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('cobaai', function () {
    return view('cobaai');
});

Route::get('/curriculum', function () {
    return view('curriculum');
})->name('curriculum');