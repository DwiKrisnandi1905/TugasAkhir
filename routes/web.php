<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;


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
Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');
Route::get('/pelanggan', [Controller::class, 'pelanggan'])->name('pelanggan');
Route::get('/konveksi', [Controller::class, 'konveksi'])->name('konveksi');
Route::get('/tokobaju', [Controller::class, 'tokobaju'])->name('tokobaju');
Route::get('/transaksi', [Controller::class, 'transaksi'])->name('transaksi');
Route::get('/history', [Controller::class, 'history'])->name('history');
Route::get('/notifikasi', [Controller::class, 'notifikasi'])->name('notifikasi');
Route::get('/setting', [Controller::class, 'setting'])->name('setting');
