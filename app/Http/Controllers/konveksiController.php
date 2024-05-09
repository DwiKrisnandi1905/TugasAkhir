<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konveksi;
use App\Models\VariasiProdukKonveksi;
use App\Models\kategoriKonveksi;

class konveksiController extends Controller
{
    public function konveksi()
    {
        $konveksis = Konveksi::all();
        
        return view('admin.page.Konveksi.Konveksi', [
            'konveksis' => $konveksis, 
            'name' => 'Konveksi',
            'title' => 'Konveksi',
        ]);
    }

    public function detailProdukKonveksi(string $id)
    {
        $konveksis = Konveksi::findOrFail($id);
        $variasiProdukKonveksi = VariasiProdukKonveksi::where('konveksi_id', $id)->get();
        return view('admin.page.Konveksi.DetailProduk',[
            'konveksis' => $konveksis,
            'variasiProdukKonveksi' => $variasiProdukKonveksi,
            'name' => 'Detail Produk Konveksi',
            'title' => 'Detail Produk Konveksi',
        ]);
    }
}
