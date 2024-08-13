<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Konveksi;
use App\Models\kategoriTokobaju;
use App\Models\kategoriKonveksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home(Request $request)
{
    $kategoriProduk = kategoriTokobaju::all();
    $kategoriKonveksi = kategoriKonveksi::all();

    $type = $request->get('type', 'all'); // Default is 'all'
    $search = $request->get('search', '');

    $produks = collect();
    $konveksis = collect();

    if ($type === 'produk' || $type === 'all') {
        $produks = Produk::with(['variasi' => function ($query) {
            $query->select('produk_id', DB::raw('MAX(harga) as highest_price'))
                  ->groupBy('produk_id');
        }]);

        if ($request->has('kategori')) {
            $produks->where('kategori_id', $request->kategori);
        }

        if ($search) {
            $produks->where(function($query) use ($search) {
                $query->where('nama_produk', 'like', "%$search%")
                      ->orWhereHas('variasi', function ($query) use ($search) {
                          $query->where('harga', 'like', "%$search%");
                      });
            });
        }

        $produks = $produks->get();
    }

    if ($type === 'konveksi' || $type === 'all') {
        $konveksis = Konveksi::with(['variasi' => function ($query) {
            $query->select('konveksi_id', DB::raw('MAX(harga) as highest_price'))
                  ->groupBy('konveksi_id');
        }]);

        if ($request->has('kategori')) {
            $konveksis->where('kategori_id', $request->kategori);
        }

        if ($search) {
            $konveksis->where(function($query) use ($search) {
                $query->where('nama_produk', 'like', "%$search%")
                      ->orWhereHas('variasi', function ($query) use ($search) {
                          $query->where('harga', 'like', "%$search%");
                      });
            });
        }

        $konveksis = $konveksis->get();
    }

    return view('pelanggan.page.home', [
        'produks' => $produks,
        'konveksis' => $konveksis,
        'kategoriProduk' => $kategoriProduk,
        'kategoriKonveksi' => $kategoriKonveksi,
        'name' => 'Home',
        'title' => 'Home',
        'type' => $type,
        'search' => $search,
    ]);
}

}
