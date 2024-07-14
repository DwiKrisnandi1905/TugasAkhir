<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\kategoriTokobajuController;
use App\Http\Controllers\kategoriKonveksiController;
use App\Http\Controllers\produkTokobajuController;
use App\Http\Controllers\produkKonveksiController;
use App\Http\Controllers\tokobajuController;
use App\Http\Controllers\konveksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Pelanggan\UserController;
use App\Http\Controllers\Pelanggan\ProfileController;
use App\Http\Controllers\Pelanggan\HomeController;
use App\Http\Controllers\Pelanggan\TokobajuPelangganController;
use App\Http\Controllers\Pelanggan\KonveksiPelangganController;
use App\Http\Controllers\Pelanggan\CartController;
use App\Http\Controllers\Pelanggan\CartKonveksiController;
use App\Http\Controllers\Pelanggan\PesananController;
use App\Http\Controllers\Pelanggan\PesananKonveksiController;
use App\Http\Controllers\Pelanggan\StatusPesananController;
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
Route::get('/display_qrcode_data', [tokobajuController::class, 'displayQRCodeData'])->name('displayQRCodeData');
Route::get('/display_qrcode_data_konveksi', [konveksiController::class, 'displayQRCodeDataKonveksi'])->name('displayQRCodeDataKonveksi');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // admin
    // Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/pelanggan', [pelangganController::class, 'pelanggan'])->name('pelanggan');
    Route::get('/pelanggan/detail{id}', [PelangganController::class, 'detailUser'])->name('detailUser');

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
    Route::get('/konveksi/generateQRCodePDF/{id}', [konveksiController::class, 'generateQRCodePDF'])->name('generateQRCodePDFKonveksi');
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
    Route::get('/verify-nft/{transactionHash}', [produkTokobajuController::class, 'verifyNFT'])->name('verify-nft');
    // Route::get('/display_qrcode_data', [tokobajuController::class, 'displayQRCodeData'])->name('displayQRCodeData');
    //Tambah produk toko baju end

    //Detail Tokobaju
    Route::get('/tokobaju/detailProdukTokobaju/{id}', [tokobajuController::class, 'detailProdukTokobaju'])->name('detailProdukTokobaju');
    Route::get('/tokobaju/generateQRCodePDF/{id}', [tokobajuController::class, 'generateQRCodePDF'])->name('generateQRCodePDF');
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
    Route::delete('/transaksi/pesanan/{id}', [transaksiController::class, 'deletePesanan'])->name('deletePesanan');
    Route::delete('/transaksi/pesanan-konveksi/{id}', [transaksiController::class, 'deletePesananKonveksi'])->name('deletePesananKonveksi');
    //tambah metode transaksi end

    Route::get('/transaksi/detailTransaksi/{type}/{id}', [TransaksiController::class, 'detailTransaksi'])->name('detailTransaksi');
    Route::post('/transaksi/update-status/{id}/{type}', [TransaksiController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/transaksi/export-pdf', [transaksiController::class, 'exportPdf'])->name('exportPdf');
    Route::get('/export-pesanan', [transaksiController::class, 'exportPesanan'])->name('exportPesanan');
    Route::get('/export-pesanan-konveksi', [transaksiController::class, 'exportPesananKonveksi'])->name('exportPesananKonveksi');

    Route::get('/history', [TransaksiController::class, 'history'])->name('history');
    Route::get('/history/detailHistory/{type}/{id}', [TransaksiController::class, 'detailHistory'])->name('detailHistory');
    Route::get('/history/export', [TransaksiController::class, 'exportHistory'])->name('exportHistory');
    Route::get('/export-history-pesanan', [TransaksiController::class, 'exportHistoryPesanan'])->name('exportHistoryPesanan');
    Route::get('/export-history-pesanan-konveksi', [TransaksiController::class, 'exportHistoryPesananKonveksi'])->name('exportHistoryPesananKonveksi');
    Route::get('/notifikasi', [Controller::class, 'notifikasi'])->name('notifikasi');
    Route::get('/setting', [Controller::class, 'setting'])->name('setting');
    //end admin
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/', [UserController::class, 'home'])->name('home');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cartKonveksi', [CartKonveksiController::class, 'cartKonveksi'])->name('cartKonveksi');
    Route::post('/cartKonveksi', [CartKonveksiController::class, 'storeKonveksi'])->name('cartKonveksi.store');
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::delete('/cartKonveksi/delete/{id}', [CartKonveksiController::class, 'deleteKonveksi'])->name('cartKonveksi.delete');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::post('/pesananKonveksi', [PesananKonveksiController::class, 'storeKonveksi'])->name('pesananKonveksi.store');
    Route::get('/address', [PesananController::class, 'alamatForm'])->name('alamat.form');
    Route::post('/address', [PesananController::class, 'storeAlamat'])->name('alamat.store');
    Route::post('/pesanan/cancel', [PesananController::class, 'cancel'])->name('pesanan.cancel');
    Route::get('/addressKonveksi', [PesananKonveksiController::class, 'alamatFormKonveksi'])->name('alamatKonveksi.form');
    Route::post('/addressKonveksi', [PesananKonveksiController::class, 'storeAlamatKonveksi'])->name('alamatKonveksi.store');
    Route::post('/pesananKonveksi/cancel', [PesananKonveksiController::class, 'cancel'])->name('pesananKonveksi.cancel');
    Route::get('/payment', [PesananController::class, 'paymentForm'])->name('payment.form');
    Route::post('/payment', [PesananController::class, 'storePayment'])->name('pesanan.storePayment');
    Route::post('/payment/cancel', [PesananController::class, 'paymentCancel'])->name('payment.cancel');
    Route::get('/paymentKonveksi', [PesananKonveksiController::class, 'paymentFormKonveksi'])->name('paymentKonveksi.form');
    Route::post('/paymentKonveksi', [PesananKonveksiController::class, 'storePaymentKonveksi'])->name('pesananKonveksi.storePayment');
    Route::post('/paymentKonveksi/cancel', [PesananKonveksiController::class, 'paymentKonveksiCancel'])->name('paymentKonveksi.cancel');
    Route::get('/konveksii', [KonveksiPelangganController::class, 'konveksii'])->name('konveksii');
    Route::get('/konveksii/detailKonveksi/{id}', [KonveksiPelangganController::class, 'detailKonveksi'])->name('detailKonveksi');
    Route::get('/tokobajuu', [TokobajuPelangganController::class, 'tokobajuu'])->name('tokobajuu');
    Route::get('/tokobajuu/detailTokobaju/{id}', [TokobajuPelangganController::class, 'detailTokobaju'])->name('detailTokobaju');
    Route::get('/statusPesanan', [StatusPesananController::class, 'statusPesanan'])->name('statusPesanan');
    Route::get('/detailStatusPesanan/{type}/{id}', [StatusPesananController::class, 'detailStatusPesanan'])->name('detailStatusPesanan');
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    // Route::get('/display_qrcode_data', [tokobajuController::class, 'displayQRCodeData'])->name('displayQRCodeData');
});