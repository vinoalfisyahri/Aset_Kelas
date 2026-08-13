<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\KategoriAsetController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MasaEkonomisController;
use App\Http\Controllers\PengajuanController;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenyusutanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('aset', AsetController::class);

Route::resource('kategori-aset', KategoriAsetController::class);
Route::resource('kategori_aset', KategoriAsetController::class);
Route::resource('kelas', KelasController::class);

Route::resource('masa-ekonomis', MasaEkonomisController::class);

Route::resource('barang', BarangController::class);


Route::resource('pengajuan', PengajuanController::class);
Route::resource('pengajuan', PengajuanController::class);
Route::resource('penyusutan', PenyusutanController::class);

