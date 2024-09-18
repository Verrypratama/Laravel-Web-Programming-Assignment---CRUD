<?php

use App\Http\Controllers\VerryPratamaController;
use App\Models\VerryPratama;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/index', [VerryPratamaController::class, 'index']);

Route::get('/edit/{id}', [VerryPratamaController::class, 'edit']);

Route::get('/add', [VerryPratamaController::class, 'add']);

Route::get('/lokal', [VerryPratamaController::class, 'lokal']);

Route::get('/sesi', [VerryPratamaController:: class, 'masuk']);



// Menambahkan rute untuk menangani permintaan POST saat menambahkan data
Route::post('/addData', [VerryPratamaController::class, 'addData']);

// Menambahkan rute untuk menangani permintaan POST saat mengedit data
Route::post('/editData', [VerryPratamaController::class, 'editData']);

// Menambahkan rute untuk menghapus data
Route::delete('/deleteData/{id}', [VerryPratamaController::class, 'deleteData']);

//fungsi autentifikasi
Route::post('/sesi/login', [VerryPratamaController:: class, 'authenticated']);
