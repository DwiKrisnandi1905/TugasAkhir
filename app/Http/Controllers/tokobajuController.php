<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\VariasiProduk;
use App\Models\kategoriTokobaju;


class tokobajuController extends Controller
{
    public function tokobaju()
    {
        $produks = Produk::all();
        
        return view('admin.page.TokoBaju.Tokobaju', [
            'produks' => $produks, 
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }

    public function detailProdukTokobaju (string $id)
    {
        $produks = Produk::findOrFail($id);
        $variasiProduk = VariasiProduk::where('produk_id', $id)->get();
        return view('admin.page.TokoBaju.DetailProduk',[
            'produks' => $produks,
            'variasiProduk' => $variasiProduk,
            'name' => 'Detail Produk Toko Baju',
            'title' => 'Detail Produk Toko Baju',
        ]);
    }
}
