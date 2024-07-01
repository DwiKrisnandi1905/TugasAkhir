<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konveksi;
use App\Models\kategoriKonveksi;
use Illuminate\Support\Facades\Storage;


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
            'jenis' => 'required|string',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
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

        $konveksi = new Konveksi();
        $konveksi->nama_produk = $request->nama_produk;
        $konveksi->kategori_id = $request->kategori_id;
        $konveksi->jenis = $request->jenis;
        $konveksi->foto_produk = $imageName;
        $konveksi->deskripsi = $request->deskripsi;
        $konveksi->tanggal_masuk = now();
        $konveksi->save();

        for ($i = 0; $i < count($request->warna_produks); $i++) {
            $foto_produk_modal = $request->file('foto_produk_modals')[$i];
            $imageNameModal = time() . '_foto_produk_modals_' . $i . '.' . $foto_produk_modal->extension();  
            $foto_produk_modal->move(public_path('images'), $imageNameModal);
            
            $konveksi->variasi()->create([
                'warna_produk' => $request->warna_produks[$i],
                'ukuran' => $request->ukurans[$i],
                'harga' => $request->hargas[$i],
                'stock' => $request->stocks[$i],
                'foto_produk_modal' => $imageNameModal,
            ]);
        }

        return redirect()->route('konveksi')->with('success', 'Produk berhasil ditambahkan!');
    }

}

