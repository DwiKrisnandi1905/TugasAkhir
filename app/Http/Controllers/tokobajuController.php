<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\VariasiProduk;
use App\Models\kategoriTokobaju;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;


class tokobajuController extends Controller
{
    public function tokobaju(Request $request)
    {
        $rows = (int) $request->input('rows', 10);

        $produks = Produk::paginate($rows);

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

    public function editProduk($id)
    {
        $produks = Produk::findOrFail($id);
        $kategoriTokobaju = kategoriTokobaju::all();
        
        return view('admin.page.TokoBaju.EditProduk', [
            'produks' => $produks,
            'kategoriTokobaju' => $kategoriTokobaju,
            'name' => 'Edit Produk',
            'title' => 'Edit Produk',
        ]);
    }

    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_tokobajus,id',
            'deskripsi_produk' => 'nullable|string',
            'warna_produk' => 'required|array',
            'ukuran' => 'required|array',
            'harga' => 'required|array',
            'stock' => 'required|array',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori_id = $request->kategori_id;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->save();

        foreach ($produk->variasi as $key => $variasi) {
            $variasi->update([
                'warna_produk' => $request->warna_produk[$key],
                'ukuran' => $request->ukuran[$key],
                'harga' => $request->harga[$key],
                'stock' => $request->stock[$key],
            ]);
        }

        return redirect()->route('detailProdukTokobaju', ['id' => $id])->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProduk($id)
    {
        $produk = Produk::findOrFail($id);
        
        $produk->variasi()->delete();

        $produk->delete();

        return redirect()->route('tokobaju')->with('success', 'Produk berhasil dihapus!');
    }

    public function searchByDate(Request $request)
    {
        $request->validate([
            'tgl' => 'required|date',
        ]);

        $tgl = $request->tgl;
        $rows = (int) $request->input('rows', 10);
        $produks = Produk::whereDate('tanggal_masuk', $tgl)->paginate($rows);

        return view('admin.page.TokoBaju.Tokobaju', [
            'produks' => $produks,
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->input('query');
        $rows = (int) $request->input('rows', 10);
        
        $produks = Produk::where('nama_produk', 'like', '%' . $query . '%')
        ->orWhereHas('kategori', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })
        ->paginate($rows);

        return view('admin.page.TokoBaju.Tokobaju', [
            'produks' => $produks,
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }

    
}
