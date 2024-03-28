<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard ()
    {
        return view('admin.page.Dashboard',[
            'name' => 'Dashboard',
            'title' => 'Dashboard',
        ]);
    }
    public function pelanggan ()
    {
        return view('admin.page.Pelanggan',[
            'name' => 'Pelanggan',
            'title' => 'Pelanggan',
        ]);
    }
    public function konveksi ()
    {
        return view('admin.page.Konveksi.Konveksi',[
            'name' => 'Konveksi',
            'title' => 'Konveksi',
        ]);
    }
    public function kategoriKonveksi ()
    {
        return view('admin.page.Konveksi.TambahKategori',[
            'name' => 'Tambah Kategori Konveksi',
            'title' => ' Tambah Kategori Konveksi',
        ]);
    }
    public function produkKonveksi ()
    {
        return view('admin.page.Konveksi.TambahProduk',[
            'name' => 'Tambah Produk Konveksi',
            'title' => 'Tambah Produk Konveksi',
        ]);
    }
    public function tokobaju ()
    {
        return view('admin.page.TokoBaju.Tokobaju',[
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }
    public function kategoriTokobaju ()
    {
        return view('admin.page.TokoBaju.TambahKategori',[
            'name' => 'Tambah Kategori Toko Baju',
            'title' => 'Tambah Kategori Toko Baju',
        ]);
    }
    public function produkTokobaju ()
    {
        return view('admin.page.TokoBaju.TambahProduk',[
            'name' => 'Tambah Produk Toko Baju',
            'title' => 'Tambah Produk Toko Baju',
        ]);
    }
    public function transaksi ()
    {
        return view('admin.page.Transaksi.Transaksi',[
            'name' => 'Transaksi',
            'title' => 'Transaksi',
        ]);
    }
    public function metodeTransaksi ()
    {
        return view('admin.page.Transaksi.metodeTransaksi',[
            'name' => 'Metode Transaksi',
            'title' => 'Metode Transaksi',
        ]);
    }
    public function history ()
    {
        return view('admin.page.History',[
            'name' => 'History',
            'title' => 'History',
        ]);
    }
    public function notifikasi ()
    {
        return view('admin.page.Notifikasi',[
            'name' => 'Notifikasi',
            'title' => 'Notifikasi',
        ]);
    }
    public function setting ()
    {
        return view('admin.page.Setting',[
            'name' => 'Setting',
            'title' => 'Setting',
        ]);
    }
}
