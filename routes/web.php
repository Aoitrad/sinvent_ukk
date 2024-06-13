<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('dashboard');
});

//route resource for products
Route::resource('/products', Controllers\ProductController::class)->middleware('auth');
//route resource for kategori
Route::resource('/kategoris', Controllers\KategoriController::class)->middleware('auth');
//route resource for barang
Route::resource('/barangs', Controllers\BarangController::class)->middleware('auth');
//route resource for barang masuk
Route::resource('/barang_masuks', Controllers\BarangMasukController::class)->middleware('auth');
//route resource for barang Keluar
Route::resource('/barang_keluars', Controllers\BarangKeluarController::class)->middleware('auth');

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);
Route::post('register', [RegisterController::class,'store']);
Route::get('register', [RegisterController::class,'create']);
