<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class TokobajuPelangganController extends Controller
{
    public function tokobajuu()
    {
        // Fetch products along with their highest price variation
        $produks = Produk::with(['variasi' => function ($query) {
            $query->select('produk_id', DB::raw('MAX(harga) as highest_price'))
                  ->groupBy('produk_id');
        }])->get();

        return view('Pelanggan.Page.Tokobaju.Tokobaju', [
            'produks' => $produks,
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }

    public function detailTokobaju($id)
    {
        // Mengambil data produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Mengambil variasi produk berdasarkan ID produk dengan gruping berdasarkan warna_produk
        $variasi = $produk->variasi()->select('warna_produk')->groupBy('warna_produk')->get();

        $hargaTertinggi = $produk->variasi->max('harga');
        $hargaTerendah = $produk->variasi->min('harga');

        return view('Pelanggan.Page.Tokobaju.detailTokobaju', [
            'produk' => $produk,
            'variasi' => $variasi,
            'hargaTertinggi' => $hargaTertinggi,
            'hargaTerendah' => $hargaTerendah,
            'name' => 'Detail Toko Baju',
            'title' => 'Detail Toko Baju',
        ]);
    }
}
