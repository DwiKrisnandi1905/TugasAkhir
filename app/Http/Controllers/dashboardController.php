<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Konveksi;


class dashboardController extends Controller
{
    public function dashboard ()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalProduk = Produk::count();
        $totalKonveksi = Konveksi::count();
        $totalItems = $totalProduk + $totalKonveksi;

        return view('admin.page.Dashboard',[
            'name' => 'Dashboard',
            'title' => 'Dashboard',
            'totalUsers' => $totalUsers,
            'totalProduk' => $totalProduk,
            'totalKonveksi' => $totalKonveksi,
            'totalItems' => $totalItems,
        ]);
    }
}
