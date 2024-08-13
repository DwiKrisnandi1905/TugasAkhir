<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Konveksi;
use App\Models\Pesanan;
use App\Models\PesananKonveksi;


class dashboardController extends Controller
{
    public function dashboard ()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalProduk = Produk::count();
        $totalKonveksi = Konveksi::count();
        $TotalPesananTerjual = Pesanan::count();
        $TotalPesananKonveksiTerjual = PesananKonveksi::count();
        $totalHargaPesanan = Pesanan::where('status', '!=', 'dibatalkan')->sum('total_harga');
        $totalHargaPesananKonveksi = PesananKonveksi::where('status', '!=', 'dibatalkan')->sum('total_harga');
        $totalItems = $totalProduk + $totalKonveksi;
        $totalTerjual = $TotalPesananTerjual + $TotalPesananKonveksiTerjual;
        $totalTransaksi = $totalHargaPesanan + $totalHargaPesananKonveksi;

        return view('admin.page.dashboard',[
            'name' => 'Dashboard',
            'title' => 'Dashboard',
            'totalUsers' => $totalUsers,
            'totalProduk' => $totalProduk,
            'totalKonveksi' => $totalKonveksi,
            'TotalPesananTerjual' => $TotalPesananTerjual,
            'TotalPesananKonveksiTerjual' => $TotalPesananKonveksiTerjual,
            'totalTerjual' => $totalTerjual,
            'totalItems' => $totalItems,
            'totalHargaPesanan' => $totalHargaPesanan,
            'totalHargaPesananKonveksi' => $totalHargaPesananKonveksi,
            'totalTransaksi' => $totalTransaksi,
        ]);
    }
}
