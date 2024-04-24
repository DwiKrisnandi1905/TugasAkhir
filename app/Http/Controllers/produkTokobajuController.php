<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoriTokobaju;

class produkTokobajuController extends Controller
{
    public function produkTokobaju ()
    {
        $kategoriTokobaju = kategoriTokobaju::all();
        return view('admin.page.TokoBaju.TambahProduk', [
            'kategoriTokobaju' => $kategoriTokobaju,
            'name' => 'Tambah Produk', 
            'title' => 'Tambah Produk',
        ]);
    }
}
