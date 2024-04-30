<?php

namespace App\Http\Controllers;
use App\Models\Konveksi;
use App\Models\kategoriKonveksi;

class konveksiController extends Controller
{
    public function konveksi()
    {
        $konveksis = Konveksi::all();
        
        return view('admin.page.Konveksi.Konveksi', [
            'konveksis' => $konveksis, 
            'name' => 'Konveksi',
            'title' => 'Konveksi',
        ]);
    }
}
