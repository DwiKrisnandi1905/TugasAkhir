<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konveksi;
use App\Models\PesananKonveksi;
use App\Models\kategoriKonveksi;
use Illuminate\Support\Facades\DB;

class KonveksiPelangganController extends Controller
{
    public function konveksii(Request $request)
    {

        $kategoris = kategoriKonveksi::all();

        $konveksis = Konveksi::with(['variasi' => function ($query) {
            $query->select('konveksi_id', DB::raw('MAX(harga) as highest_price'))
                  ->groupBy('konveksi_id');
        }]);

        if ($request->has('kategori')) {
            $konveksis->where('kategori_id', $request->kategori);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $konveksis->where(function($query) use ($search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                      ->orWhereHas('variasi', function($q) use ($search) {
                          $q->where('harga', 'like', "%{$search}%");
                      });
            });
        }

        $konveksis = $konveksis->get();

        return view('Pelanggan.Page.Konveksi.Konveksi', [
            'konveksis' => $konveksis,
            'kategoris' => $kategoris,
            'name' => 'Konveksi',
            'title' => 'Konveksi',
        ]);
    }

    public function detailKonveksi($id)
    {
        // Mengambil data produk berdasarkan ID
        $konveksi = Konveksi::findOrFail($id);

        // Mengambil variasi produk berdasarkan ID produk dengan gruping berdasarkan warna_produk
        $variasi = $konveksi->variasi()->select('warna_produk')->groupBy('warna_produk')->get();

        $hargaTertinggi = $konveksi->variasi->max('harga');
        $hargaTerendah = $konveksi->variasi->min('harga');
        $totalTerjual = PesananKonveksi::where('nama_produk', $konveksi->nama_produk)->sum('kuantitas');

        return view('Pelanggan.Page.Konveksi.detailKonveksi', [
            'konveksi' => $konveksi,
            'variasi' => $variasi,
            'hargaTertinggi' => $hargaTertinggi,
            'hargaTerendah' => $hargaTerendah,
            'totalTerjual' => $totalTerjual,
            'name' => 'Detail Konveksi',
            'title' => 'Detail Konveksi',
        ]);
    }
}
