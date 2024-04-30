<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\kategoriTokobajuController;
use App\Http\Controllers\kategoriKonveksiController;
use App\Http\Controllers\produkTokobajuController;
use App\Http\Controllers\produkKonveksiController;
use App\Http\Controllers\tokobajuController;
use App\Http\Controllers\konveksiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// admin
Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');
Route::get('/pelanggan', [Controller::class, 'pelanggan'])->name('pelanggan');

Route::get('/konveksi', [konveksiController::class, 'konveksi'])->name('konveksi');
// kategori Konveksi
Route::get('/konveksi/kategoriKonveksi', [kategoriKonveksiController::class, 'kategoriKonveksi'])->name('kategoriKonveksi');
Route::post('/konveksi/storeeKategori', [kategoriKonveksiController::class, 'storee'])->name('storeeKategori');
Route::delete('/konveksi/deleteeKategori/{id}', [kategoriKonveksiController::class, 'deletee'])->name('deleteeKategori');
// kategori Konveksi end 

// Tambah produk konveksi
Route::get('/konveksi/produkKonveksi', [produkKonveksiController::class, 'produkKonveksi'])->name('produkKonveksi');
Route::post('/konveksi/simpanProdukKonveksi', [produkKonveksiController::class, 'simpanDataKonveksi'])->name('simpanProdukKonveksi');
// Tambah produk konveksi end

Route::get('/konveksi/detailProdukKonveksi', [Controller::class, 'detailProdukKonveksi'])->name('detailProdukKonveksi');

Route::get('/tokobaju', [tokobajuController::class, 'tokobaju'])->name('tokobaju');
// kategori tokobaju 
Route::get('/tokobaju/kategoriTokobaju', [kategoriTokobajuController::class, 'kategoriTokobaju'])->name('kategoriTokobaju');
Route::post('/tokobaju/storeKategori', [kategoriTokobajuController::class, 'store'])->name('storeKategori');
Route::delete('/tokobaju/deleteKategori/{id}', [kategoriTokobajuController::class, 'delete'])->name('deleteKategori');
// kategori toko baju end

// Tambah produk toko baju 
Route::get('/tokobaju/produkTokobaju', [produkTokobajuController::class, 'produkTokobaju'])->name('produkTokobaju');
Route::post('/tokobaju/simpanProduk', [produkTokobajuController::class, 'simpanData'])->name('simpanProduk');
//Tambah produk toko baju end

Route::get('/tokobaju/detailProdukTokobaju', [Controller::class, 'detailProdukTokobaju'])->name('detailProdukTokobaju');

Route::get('/transaksi', [Controller::class, 'transaksi'])->name('transaksi');
Route::get('/transaksi/metodeTransaksi', [Controller::class, 'metodeTransaksi'])->name('metodeTransaksi');
Route::get('/transaksi/detailTransaksi', [Controller::class, 'detailTransaksi'])->name('detailTransaksi');

Route::get('/history', [Controller::class, 'history'])->name('history');
Route::get('/notifikasi', [Controller::class, 'notifikasi'])->name('notifikasi');
Route::get('/setting', [Controller::class, 'setting'])->name('setting');
//end admin
