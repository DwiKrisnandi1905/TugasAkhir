<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konveksi;
use Illuminate\Support\Facades\DB;

class KonveksiPelangganController extends Controller
{
    public function konveksii()
    {
        // Fetch products along with their highest price variation
        $konveksis = Konveksi::with(['variasi' => function ($query) {
            $query->select('konveksi_id', DB::raw('MAX(harga) as highest_price'))
                  ->groupBy('konveksi_id');
        }])->get();

        return view('Pelanggan.Page.Konveksi.Konveksi', [
            'konveksis' => $konveksis,
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

        return view('Pelanggan.Page.Konveksi.detailKonveksi', [
            'konveksis' => $konveksi,
            'variasi' => $variasi,
            'hargaTertinggi' => $hargaTertinggi,
            'hargaTerendah' => $hargaTerendah,
            'name' => 'Detail Konveksi',
            'title' => 'Detail Konveksi',
        ]);
    }
}
