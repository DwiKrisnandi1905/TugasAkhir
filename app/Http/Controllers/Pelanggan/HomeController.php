<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Konveksi;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    public function home()
    {
        $produks = Produk::with(['variasi' => function ($query) {
            $query->select('produk_id', DB::raw('MAX(harga) as highest_price'))
                  ->groupBy('produk_id');
        }])->get();

        $konveksis = Konveksi::with(['variasi' => function ($query) {
            $query->select('konveksi_id', DB::raw('MAX(harga) as highest_price'))
                  ->groupBy('konveksi_id');
        }])->get();

        return view('Pelanggan.Page.home' ,[
            'produks' => $produks,
            'konveksis' => $konveksis,
            'name' => 'Home',
            'title' => 'Home',
        ]);
    }
}
