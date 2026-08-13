<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenyusutanController;
use App\Http\Controllers\AsetKelasController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('barang', BarangController::class);
Route::resource('aset-kelas', AsetKelasController::class);
Route::apiResource('penyusutan', PenyusutanController::class);
