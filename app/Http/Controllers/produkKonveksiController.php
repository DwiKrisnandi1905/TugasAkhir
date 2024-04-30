<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konveksi;
use App\Models\kategoriKonveksi;

class produkKonveksiController extends Controller
{
    public function produkKonveksi()
    {
        $kategoriKonveksi = kategoriKonveksi::all();
        return view('admin.page.Konveksi.TambahProduk', [
            'kategoriKonveksi' => $kategoriKonveksi,
            'name' => 'Tambah Produk Konveksi', 
            'title' => 'Tambah Produk Konveksi',
        ]);
    }
    public function simpanDataKonveksi(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_konveksis,id',
            'jenis' => 'nullable|string',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
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

        $konveksi = new Konveksi();
        $konveksi->nama_produk = $request->nama_produk;
        $konveksi->kategori_id = $request->kategori_id;
        $konveksi->jenis = $request->jenis;
        $konveksi->foto_produk = $imageName;
        $konveksi->deskripsi = $request->deskripsi;
        $konveksi->save();

        for ($i = 0; $i < count($request->warna_produk); $i++) {
            $konveksi->variasi()->create([
                'warna_produk' => $request->warna_produk[$i],
                'ukuran' => $request->ukuran[$i],
                'harga' => $request->harga[$i],
                'stock' => $request->stock[$i],
                'foto_produk_modal' => $imageNameModal,
            ]);
        }

        return redirect()->route('produkKonveksi')->with('success', 'Produk berhasil ditambahkan!');
    }

}

