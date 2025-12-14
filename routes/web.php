<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AIController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/curriculum', function () {
    return view('curriculum');
})->name('curriculum');



// Halaman Utama
Route::get('/analysis', [AIController::class, 'index'])->name('analysis.index');

// Route POST yang ditembak oleh Javascript (AJAX)
Route::post('/analysis/predict', [AIController::class, 'predict'])->name('analysis.predict');