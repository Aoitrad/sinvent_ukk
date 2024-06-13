<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('kategori/show', [KategoriController::class, 'showAPIKategori']);
Route::get('kategori/show/{kategori_id}', [KategoriController::class, 'showAPIKategoriById']);
Route::post('kategori/edit/{kategori_id}', [KategoriController::class, 'updateAPIKategori']);
Route::post('kategori/create', [KategoriController::class, 'createAPIKategori']);
Route::delete('kategori/delete/{kategori_id}', [KategoriController::class, 'deleteAPIKategori']);