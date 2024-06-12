<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $cart = Cart::where('user_id', Auth::id())->get();

        return view('Pelanggan.Page.cart', [
            'name' => 'Cart',
            'title' => 'Cart',
            'cart' => $cart,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|integer|min:1',
            'nama_produk' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'image' => 'required|string|max:255',
        ]);
        
        Cart::create(array_merge($request->only([
            'produk_id',
            'nama_produk', 
            'warna', 
            'ukuran', 
            'kuantitas', 
            'harga_satuan', 
            'total_harga',
            'image',
        ]), ['user_id' => Auth::id()]));

        return redirect()->route('cart');
    }

    public function delete($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
