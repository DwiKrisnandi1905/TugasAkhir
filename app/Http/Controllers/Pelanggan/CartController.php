<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function cart()
    {
        $cart = Cart::all();

        return view('Pelanggan.Page.cart', [
            'name' => 'Cart',
            'title' => 'Cart',
            'cart' => $cart,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'image' => 'required|string|max:255',
        ]);
        
        Cart::create($request->only([
            'nama_produk', 
            'warna', 
            'ukuran', 
            'kuantitas', 
            'harga_satuan', 
            'total_harga',
            'image',
        ]));

        return redirect()->route('cart');
    }
}
