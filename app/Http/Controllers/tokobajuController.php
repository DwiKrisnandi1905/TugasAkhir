<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\kategoriTokobaju;


class tokobajuController extends Controller
{
    public function tokobaju()
    {
        $produks = Produk::all();
        
        return view('admin.page.TokoBaju.Tokobaju', [
            'produks' => $produks, 
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }
}
