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
            'deskripsi_produk' => 'required|string',
            'warna_produks' => 'required|array',
            'ukurans' => 'required|array',
            'hargas' => 'required|array',
            'stocks' => 'required|array',
            'foto_produk_modals' => 'required|array',
            'warna_produks.*' => 'required|string',
            'ukurans.*' => 'required|string',
            'hargas.*' => 'required|numeric',
            'stocks.*' => 'required|numeric',
            'foto_produk_modals.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '_foto_produk.' . $request->foto_produk->extension();  
        $request->foto_produk->move(public_path('images'), $imageName);

        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori_id = $request->kategori_id;
        $produk->foto_produk = $imageName;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->tanggal_masuk = now();
        $produk->save();

        for ($i = 0; $i < count($request->warna_produks); $i++) {
            $foto_produk_modal = $request->file('foto_produk_modals')[$i];
            $imageNameModal = time() . '_foto_produk_modal_' . $i . '.' . $foto_produk_modal->extension();  
            $foto_produk_modal->move(public_path('images'), $imageNameModal);

            $produk->variasi()->create([
                'warna_produk' => $request->warna_produks[$i],
                'ukuran' => $request->ukurans[$i],
                'harga' => $request->hargas[$i],
                'stock' => $request->stocks[$i],
                'foto_produk_modal' => $imageNameModal,
            ]);
        }

        return redirect()->route('tokobaju')->with('success', 'Produk berhasil ditambahkan!');
    }
}
