<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\kategoriTokobajuController;
use App\Http\Controllers\kategoriKonveksiController;
use App\Http\Controllers\produkTokobajuController;
use App\Http\Controllers\produkKonveksiController;
use App\Http\Controllers\tokobajuController;
use App\Http\Controllers\konveksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Pelanggan\UserController;
use App\Http\Controllers\Pelanggan\TokobajuPelangganController;
use App\Http\Controllers\Pelanggan\KonveksiPelangganController;
use App\Http\Controllers\Pelanggan\CartController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


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

Route::get('/', [Controller::class, 'landingPage'])->name('landingPage')->middleware('guestt');
Route::get('/landingPage', [Controller::class, 'landingPage'])->name('landingPage')->middleware('guestt');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guestt');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guestt');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware(['guestt','guest']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset')->middleware(['guestt','guest']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // admin
    // Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/pelanggan', [Controller::class, 'pelanggan'])->name('pelanggan');

    // ---------------------------------------------------KONVEKSI---------------------------------------------------------------
    Route::get('/konveksi', [konveksiController::class, 'konveksi'])->name('konveksi');
    Route::delete('/konveksi/deleteProdukKonveksi/{id}', [konveksiController::class, 'deleteProdukKonveksi'])->name('deleteProdukKonveksi');

    // kategori Konveksi
    Route::get('/konveksi/kategoriKonveksi', [kategoriKonveksiController::class, 'kategoriKonveksi'])->name('kategoriKonveksi');
    Route::post('/konveksi/storeeKategori', [kategoriKonveksiController::class, 'storee'])->name('storeeKategori');
    Route::delete('/konveksi/deleteeKategori/{id}', [kategoriKonveksiController::class, 'deletee'])->name('deleteeKategori');
    Route::get('/konveksi/editKategoriKonveksi/{id}', [kategoriKonveksiController::class, 'edit'])->name('editKategoriKonveksi');
    Route::put('/konveksi/updateKategoriKonveksi/{id}', [kategoriKonveksiController::class, 'update'])->name('updateKategoriKonveksi');
    // kategori Konveksi end 

    // Tambah produk konveksi
    Route::get('/konveksi/produkKonveksi', [produkKonveksiController::class, 'produkKonveksi'])->name('produkKonveksi');
    Route::post('/konveksi/simpanProdukKonveksi', [produkKonveksiController::class, 'simpanDataKonveksi'])->name('simpanProdukKonveksi');
    // Tambah produk konveksi end

    // Detail Konveksi
    Route::get('/konveksi/detailProdukKonveksi/{id}', [konveksiController::class, 'detailProdukKonveksi'])->name('detailProdukKonveksi');
    Route::get('/konveksi/editProdukKonveksi/{id}', [konveksiController::class, 'editProdukKonveksi'])->name('editProdukKonveksi');
    Route::put('/konveksi/updateProdukKonveksi/{id}', [konveksiController::class, 'updateProdukKonveksi'])->name('updateProdukKonveksi');
    Route::get('/konveksi/searchByDateKonveksi', [konveksiController::class, 'searchByDateKonveksi'])->name('searchByDateKonveksi');
    Route::get('/konveksi/searchKonveksi', [konveksiController::class, 'searchKonveksi'])->name('searchKonveksi');
    //Detail Konveksi end
    // ---------------------------------------------------KONVEKSI---------------------------------------------------------------

    // ---------------------------------------------------TOKOBAJU---------------------------------------------------------------
    Route::get('/tokobaju', [tokobajuController::class, 'tokobaju'])->name('tokobaju');
    Route::delete('/tokobaju/deleteProduk/{id}', [tokobajuController::class, 'deleteProduk'])->name('deleteProduk');

    // kategori tokobaju 
    Route::get('/tokobaju/kategoriTokobaju', [kategoriTokobajuController::class, 'kategoriTokobaju'])->name('kategoriTokobaju');
    Route::post('/tokobaju/storeKategori', [kategoriTokobajuController::class, 'store'])->name('storeKategori');
    Route::delete('/tokobaju/deleteKategori/{id}', [kategoriTokobajuController::class, 'delete'])->name('deleteKategori');
    Route::get('/tokobaju/editKategori/{id}', [kategoriTokobajuController::class, 'edit'])->name('editKategori');
    Route::put('/tokobaju/updateKategori/{id}', [kategoriTokobajuController::class, 'update'])->name('updateKategori');
    // kategori toko baju end

    // Tambah produk toko baju 
    Route::get('/tokobaju/produkTokobaju', [produkTokobajuController::class, 'produkTokobaju'])->name('produkTokobaju');
    Route::post('/tokobaju/simpanProduk', [produkTokobajuController::class, 'simpanData'])->name('simpanProduk');
    //Tambah produk toko baju end

    //Detail Tokobaju
    Route::get('/tokobaju/detailProdukTokobaju/{id}', [tokobajuController::class, 'detailProdukTokobaju'])->name('detailProdukTokobaju');
    Route::get('/tokobaju/editProduk/{id}', [tokobajuController::class, 'editProduk'])->name('editProduk');
    Route::put('/tokobaju/updateProduk/{id}', [tokobajuController::class, 'updateProduk'])->name('updateProduk');
    Route::get('/tokobaju/searchByDate', [tokobajuController::class, 'searchByDate'])->name('searchByDate');
    Route::get('/tokobaju/search', [tokobajuController::class, 'search'])->name('search');
    //Detail Tokobaju
    // ---------------------------------------------------TOKOBAJU---------------------------------------------------------------

    Route::get('/transaksi', [transaksiController::class, 'transaksi'])->name('transaksi');

    //tambah metode transaksi
    Route::get('/transaksi/metodeTransaksi', [transaksiController::class, 'metodeTransaksi'])->name('metodeTransaksi');
    Route::post('/transaksi/tambahMetode', [transaksiController::class, 'tambahMetode'])->name('tambahMetode');
    Route::delete('/transaksi/deleteMetode/{id}', [TransaksiController::class, 'deleteMetode'])->name('deleteMetode');
    Route::get('/transaksi/editMetode/{id}', [transaksiController::class, 'editMetode'])->name('editMetode');
    Route::put('/transaksi/updateMetode/{id}', [transaksiController::class, 'updateMetode'])->name('updateMetode');
    //tambah metode transaksi end

    Route::get('/transaksi/detailTransaksi', [transaksiController::class, 'detailTransaksi'])->name('detailTransaksi');

    Route::get('/history', [Controller::class, 'history'])->name('history');
    Route::get('/notifikasi', [Controller::class, 'notifikasi'])->name('notifikasi');
    Route::get('/setting', [Controller::class, 'setting'])->name('setting');
    //end admin
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/', [UserController::class, 'home'])->name('home');
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/konveksii', [KonveksiPelangganController::class, 'konveksii'])->name('konveksii');
    Route::get('/konveksii/detailKonveksi/{id}', [KonveksiPelangganController::class, 'detailKonveksi'])->name('detailKonveksi');
    Route::get('/tokobajuu', [TokobajuPelangganController::class, 'tokobajuu'])->name('tokobajuu');
    Route::get('/tokobajuu/detailTokobaju/{id}', [TokobajuPelangganController::class, 'detailTokobaju'])->name('detailTokobaju');
});