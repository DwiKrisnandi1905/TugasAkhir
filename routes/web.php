<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PelangganController;
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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// Guest Routes
Route::get('/', [Controller::class, 'landingPage'])->name('landingPage')->middleware('guestt');
Route::get('/landingPage', [Controller::class, 'landingPage'])->name('landingPage')->middleware('guestt');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guestt');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guestt');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware(['guestt', 'guest']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset')->middleware(['guestt', 'guest']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/display_qrcode_data', [tokobajuController::class, 'displayQRCodeData'])->name('displayQRCodeData');
Route::get('/display_qrcode_data_konveksi', [konveksiController::class, 'displayQRCodeDataKonveksi'])->name('displayQRCodeDataKonveksi');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'Link verifikasi sudah dikirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan');
    Route::get('/pelanggan/detail{id}', [PelangganController::class, 'detailUser'])->name('detailUser');

    // Konveksi Routes
    Route::prefix('konveksi')->group(function () {
        Route::get('/', [konveksiController::class, 'konveksi'])->name('konveksi');
        Route::delete('/deleteProdukKonveksi/{id}', [konveksiController::class, 'deleteProdukKonveksi'])->name('deleteProdukKonveksi');
        
        // Kategori Konveksi
        Route::get('/kategoriKonveksi', [kategoriKonveksiController::class, 'kategoriKonveksi'])->name('kategoriKonveksi');
        Route::post('/storeeKategori', [kategoriKonveksiController::class, 'storee'])->name('storeeKategori');
        Route::delete('/deleteeKategori/{id}', [kategoriKonveksiController::class, 'deletee'])->name('deleteeKategori');
        Route::get('/editKategoriKonveksi/{id}', [kategoriKonveksiController::class, 'edit'])->name('editKategoriKonveksi');
        Route::put('/updateKategoriKonveksi/{id}', [kategoriKonveksiController::class, 'update'])->name('updateKategoriKonveksi');

        // Produk Konveksi
        Route::get('/produkKonveksi', [produkKonveksiController::class, 'produkKonveksi'])->name('produkKonveksi');
        Route::post('/simpanProdukKonveksi', [produkKonveksiController::class, 'simpanDataKonveksi'])->name('simpanProdukKonveksi');
        Route::get('/verify-nft/{transactionHash}', [produkKonveksiController::class, 'verifyNFT'])->name('verify-nft');
        
        // Detail Konveksi
        Route::get('/detailProdukKonveksi/{id}', [konveksiController::class, 'detailProdukKonveksi'])->name('detailProdukKonveksi');
        Route::get('/generateQRCodePDF/{id}', [konveksiController::class, 'generateQRCodePDF'])->name('generateQRCodePDFKonveksi');
        Route::get('/editProdukKonveksi/{id}', [konveksiController::class, 'editProdukKonveksi'])->name('editProdukKonveksi');
        Route::put('/updateProdukKonveksi/{id}', [konveksiController::class, 'updateProdukKonveksi'])->name('updateProdukKonveksi');
        Route::get('/searchByDateKonveksi', [konveksiController::class, 'searchByDateKonveksi'])->name('searchByDateKonveksi');
        Route::get('/searchKonveksi', [konveksiController::class, 'searchKonveksi'])->name('searchKonveksi');
    });

    // Tokobaju Routes
    Route::prefix('tokobaju')->group(function () {
        Route::get('/', [tokobajuController::class, 'tokobaju'])->name('tokobaju');
        Route::delete('/deleteProduk/{id}', [tokobajuController::class, 'deleteProduk'])->name('deleteProduk');

        // Kategori Tokobaju
        Route::get('/kategoriTokobaju', [kategoriTokobajuController::class, 'kategoriTokobaju'])->name('kategoriTokobaju');
        Route::post('/storeKategori', [kategoriTokobajuController::class, 'store'])->name('storeKategori');
        Route::delete('/deleteKategori/{id}', [kategoriTokobajuController::class, 'delete'])->name('deleteKategori');
        Route::get('/editKategori/{id}', [kategoriTokobajuController::class, 'edit'])->name('editKategori');
        Route::put('/updateKategori/{id}', [kategoriTokobajuController::class, 'update'])->name('updateKategori');

        // Produk Tokobaju
        Route::get('/produkTokobaju', [produkTokobajuController::class, 'produkTokobaju'])->name('produkTokobaju');
        Route::post('/simpanProduk', [produkTokobajuController::class, 'simpanData'])->name('simpanProduk');
        Route::get('/verify-nft/{transactionHash}', [produkTokobajuController::class, 'verifyNFT'])->name('verify-nft');
        
        // Detail Tokobaju
        Route::get('/detailProdukTokobaju/{id}', [tokobajuController::class, 'detailProdukTokobaju'])->name('detailProdukTokobaju');
        Route::get('/generateQRCodePDF/{id}', [tokobajuController::class, 'generateQRCodePDF'])->name('generateQRCodePDF');
        Route::get('/editProduk/{id}', [tokobajuController::class, 'editProduk'])->name('editProduk');
        Route::put('/updateProduk/{id}', [tokobajuController::class, 'updateProduk'])->name('updateProduk');
        Route::get('/searchByDate', [tokobajuController::class, 'searchByDate'])->name('searchByDate');
        Route::get('/search', [tokobajuController::class, 'search'])->name('search');
    });

    // Transaksi Routes
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [transaksiController::class, 'transaksi'])->name('transaksi');
        
        // Metode Transaksi
        Route::get('/metodeTransaksi', [transaksiController::class, 'metodeTransaksi'])->name('metodeTransaksi');
        Route::post('/tambahMetode', [transaksiController::class, 'tambahMetode'])->name('tambahMetode');
        Route::delete('/deleteMetode/{id}', [transaksiController::class, 'deleteMetode'])->name('deleteMetode');
        Route::get('/editMetode/{id}', [transaksiController::class, 'editMetode'])->name('editMetode');
        Route::put('/updateMetode/{id}', [transaksiController::class, 'updateMetode'])->name('updateMetode');
        Route::delete('/pesanan/{id}', [transaksiController::class, 'deletePesanan'])->name('deletePesanan');
        Route::delete('/pesanan-konveksi/{id}', [transaksiController::class, 'deletePesananKonveksi'])->name('deletePesananKonveksi');

        // Detail Transaksi
        Route::get('/detailTransaksi/{type}/{id}', [transaksiController::class, 'detailTransaksi'])->name('detailTransaksi');
        Route::post('/update-status/{id}/{type}', [transaksiController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/export-pdf', [transaksiController::class, 'exportPdf'])->name('exportPdf');
        Route::get('/export-pesanan', [transaksiController::class, 'exportPesanan'])->name('exportPesanan');
        Route::get('/export-pesanan-konveksi', [transaksiController::class, 'exportPesananKonveksi'])->name('exportPesananKonveksi');
    });

    // History Routes
    Route::prefix('history')->group(function () {
        Route::get('/', [transaksiController::class, 'history'])->name('history');
        Route::get('/detailHistory/{type}/{id}', [transaksiController::class, 'detailHistory'])->name('detailHistory');
        Route::get('/export', [transaksiController::class, 'exportHistory'])->name('exportHistory');
        Route::get('/export-history-pesanan', [transaksiController::class, 'exportHistoryPesanan'])->name('exportHistoryPesanan');
        Route::get('/export-history-pesanan-konveksi', [transaksiController::class, 'exportHistoryPesananKonveksi'])->name('exportHistoryPesananKonveksi');
    });

    Route::get('/notifikasi', [Controller::class, 'notifikasi'])->name('notifikasi');
    Route::get('/setting', [Controller::class, 'setting'])->name('setting');
});

// User Routes
Route::middleware(['auth', 'role:user', 'verified'])->group(function () {
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
    Route::get('/privacyPolicy', [UserController::class, 'privacyPolicy'])->name('privacyPolicy');
    Route::post('/midtrans/callback', [PesananController::class, 'handleMidtransCallback'])->name('midtrans.callback');
    Route::post('/pesanan/update-status/{order_id}', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
});

?>
