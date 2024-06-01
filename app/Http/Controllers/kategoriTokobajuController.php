<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoriTokobaju;

class kategoriTokobajuController extends Controller
{
    public function kategoriTokobaju()
    {
        $kategoriTokobaju = kategoriTokobaju::all();
        return view('admin.page.TokoBaju.TambahKategori', [
            'kategoriTokobaju' => $kategoriTokobaju,
            'name' => 'Tambah Kategori', 
            'title' => 'Tambah Kategori',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategoriTokobaju' => 'required|string|max:255',
        ]);

        kategoriTokobaju::create([
            'name' => $request->kategoriTokobaju,
        ]);

        return redirect()->route('kategoriTokobaju')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function delete($id)
    {
        $kategori = kategoriTokobaju::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategoriTokobaju')->with('success', 'Kategori berhasil dihapus!');
    }

    public function edit($id)
    {
        $kategori = kategoriTokobaju::findOrFail($id);
        return view('admin.page.TokoBaju.EditKategori', [
            'kategori' => $kategori,
            'name' => 'Edit Kategori',
            'title' => 'Edit Kategori'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategoriTokobaju' => 'required|string|max:255',
        ]);

        $kategori = kategoriTokobaju::findOrFail($id);
        $kategori->update([
            'name' => $request->kategoriTokobaju,
        ]);

        return redirect()->route('kategoriTokobaju')->with('success', 'Kategori berhasil diperbarui!');
    }
}
