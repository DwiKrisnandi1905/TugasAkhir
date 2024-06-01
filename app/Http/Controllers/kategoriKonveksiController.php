<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoriKonveksi;

class kategoriKonveksiController extends Controller
{
    public function kategoriKonveksi()
    {
        $kategoriKonveksi = kategoriKonveksi::all();
        return view('admin.page.Konveksi.TambahKategori', [
            'kategoriKonveksi' => $kategoriKonveksi,
            'name' => 'Tambah Kategori', 
            'title' => 'Tambah Kategori',
        ]);
    }

    public function storee(Request $request)
    {
        $request->validate([
            'kategoriKonveksi' => 'required|string|max:255',
        ]);

        kategoriKonveksi::create([
            'name' => $request->kategoriKonveksi,
        ]);

        return redirect()->route('kategoriKonveksi')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function deletee($id)
    {
        $kategori = kategoriKonveksi::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategoriKonveksi')->with('success', 'Kategori berhasil dihapus!');
    }

    public function edit($id)
    {
        $kategori = kategoriKonveksi::findOrFail($id);
        return view('admin.page.Konveksi.EditKategori', [
            'kategori' => $kategori,
            'name' => 'Edit Kategori',
            'title' => 'Edit Kategori'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategoriKonveksi' => 'required|string|max:255',
        ]);

        $kategori = kategoriKonveksi::findOrFail($id);
        $kategori->update([
            'name' => $request->kategoriKonveksi,
        ]);

        return redirect()->route('kategoriKonveksi')->with('success', 'Kategori berhasil diperbarui!');
    }
}
