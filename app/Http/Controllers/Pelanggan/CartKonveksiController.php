<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartKonveksi;
use Illuminate\Support\Facades\Auth;

class CartKonveksiController extends Controller
{
    public function cartKonveksi()
    {
        $cart = CartKonveksi::where('user_id', Auth::id())->get();

        return view('pelanggan.page.cartKonveksi', [
            'name' => 'Cart',
            'title' => 'Cart',
            'cart' => $cart,
        ]);
    }

    public function storeKonveksi(Request $request)
    {
        // dd($request);
        $request->validate([
            'konveksi_id' => 'required|integer|min:1',
            'variasi_id' => 'required|integer|min:1',
            'nama_produk' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'image' => 'required|string|max:255',
        ]);
        
        CartKonveksi::create(array_merge($request->only([
            'user_id',
            'konveksi_id',
            'variasi_id',
            'nama_produk',
            'warna', 
            'ukuran', 
            'kuantitas', 
            'harga_satuan', 
            'total_harga',
            'image',
        ]), ['user_id' => Auth::id()]));

        return redirect()->route('cartKonveksi');
    }

    public function deleteKonveksi($id)
    {
        $cartItem = CartKonveksi::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cartKonveksi')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
