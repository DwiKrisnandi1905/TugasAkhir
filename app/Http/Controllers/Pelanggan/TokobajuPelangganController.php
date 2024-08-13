<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\kategoriTokobaju;
use Illuminate\Support\Facades\DB;

class TokobajuPelangganController extends Controller
{
    public function tokobajuu(Request $request)
    {
        $kategoris = kategoriTokobaju::all();

        $produks = Produk::with(['variasi' => function ($query) {
            $query->select('produk_id', DB::raw('MAX(harga) as highest_price'))
                  ->groupBy('produk_id');
        }]);

        if ($request->has('kategori')) {
            $produks->where('kategori_id', $request->kategori);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $produks->where(function($query) use ($search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                      ->orWhereHas('variasi', function($q) use ($search) {
                          $q->where('harga', 'like', "%{$search}%");
                      });
            });
        }

        $produks = $produks->get();

        return view('pelanggan.page.tokobaju.tokobaju', [
            'produks' => $produks,
            'kategoris' => $kategoris,
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
        $totalTerjual = Pesanan::where('nama_produk', $produk->nama_produk)->sum('kuantitas');

        return view('pelanggan.page.tokobaju.detailTokobaju', [
            'produk' => $produk,
            'variasi' => $variasi,
            'hargaTertinggi' => $hargaTertinggi,
            'hargaTerendah' => $hargaTerendah,
            'totalTerjual' => $totalTerjual,
            'name' => 'Detail Toko Baju',
            'title' => 'Detail Toko Baju',
        ]);
    }
}
