<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('Pelanggan.Page.home' ,[
            'name' => 'Home',
            'title' => 'Home',
        ]);
    }
    public function profile()
    {
        return view('Pelanggan.Page.profile' ,[
            'name' => 'Profile',
            'title' => 'Profile',
        ]);
    }
    // public function cart()
    // {
    //     return view('Pelanggan.Page.cart' ,[
    //         'name' => 'Cart',
    //         'title' => 'Cart',
    //     ]);
    // }
    public function konveksii()
    {
        return view('Pelanggan.Page.Konveksi.Konveksi' ,[
            'name' => 'Konveksi',
            'title' => 'Konveksi',
        ]);
    }
    // public function tokobajuu()
    // {
    //     return view('Pelanggan.Page.Tokobaju.Tokobaju' ,[
    //         'name' => 'Toko Baju',
    //         'title' => 'Toko Baju',
    //     ]);
    // }
    // public function detailTokobaju()
    // {
    //     return view('Pelanggan.Page.Tokobaju.detailTokobaju' ,[
    //         'name' => 'Detail Toko Baju',
    //         'title' => 'Detail Toko Baju',
    //     ]);
    // }
    // public function detailKonveksi()
    // {
    //     return view('Pelanggan.Page.Konveksi.detailKonveksi' ,[
    //         'name' => 'Detail Konveksi',
    //         'title' => 'Detail Konveksi',
    //     ]);
    // }
}
