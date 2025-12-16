<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AIController;
use App\Http\Controllers\ChatController;

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

// Rute untuk menampilkan halaman konsultasi/chat
Route::get('/consultation', [ChatController::class, 'showChat']);

// Rute API endpoint untuk memproses chat
Route::post('/chat', [ChatController::class, 'sendMessage']);

// di dalam routes/web.php

// Rute baru untuk halaman tim
Route::get('/team', function () {
    return view('team');
});