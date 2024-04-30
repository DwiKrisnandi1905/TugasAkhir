<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\kategoriTokobaju;
use Illuminate\Support\Facades\Storage;

class produkTokobajuController extends Controller
{
    public function produkTokobaju()
    {
        $kategoriTokobaju = kategoriTokobaju::all();
        return view('admin.page.TokoBaju.TambahProduk', [
            'kategoriTokobaju' => $kategoriTokobaju,
            'name' => 'Tambah Produk', 
            'title' => 'Tambah Produk',
        ]);
    }

    public function simpanData(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_tokobajus,id',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_produk' => 'nullable|string',
            'foto_produk_modal' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna_produk' => 'required|array',
            'ukuran' => 'required|array',
            'harga' => 'required|array',
            'stock' => 'required|array',
            'warna_produk.*' => 'required|string', 
            'ukuran.*' => 'required|string',
            'harga.*' => 'required|numeric',
            'stock.*' => 'required|numeric',
        ]);

        $imageName = time().'.'.$request->foto_produk->extension();  
        $request->foto_produk->move(public_path('images'), $imageName);

        $imageNameModal = time().'.'.$request->foto_produk_modal->extension();  
        $request->foto_produk_modal->move(public_path('images'), $imageNameModal);

        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori_id = $request->kategori_id;
        $produk->foto_produk = $imageName;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->save();

        for ($i = 0; $i < count($request->warna_produk); $i++) {
            $produk->variasi()->create([
                'warna_produk' => $request->warna_produk[$i],
                'ukuran' => $request->ukuran[$i],
                'harga' => $request->harga[$i],
                'stock' => $request->stock[$i],
                'foto_produk_modal' => $imageNameModal,
            ]);
        }

        return redirect()->route('produkTokobaju')->with('success', 'Produk berhasil ditambahkan!');
    }

}
