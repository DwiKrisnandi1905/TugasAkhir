<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoriKonveksi;

class produkKonveksiController extends Controller
{
    public function produkKonveksi ()
    {
        $kategoriKonveksi = kategoriKonveksi::all();
        return view('admin.page.Konveksi.TambahProduk', [
            'kategoriKonveksi' => $kategoriKonveksi,
            'name' => 'Tambah Produk', 
            'title' => 'Tambah Produk',
        ]);
    }
}
