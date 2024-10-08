<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\PesananKonveksi;

class StatusPesananController extends Controller
{
    public function statusPesanan()
    {
        $userId = Auth::id();

        $pesananPending = Pesanan::where('user_id', $userId)->where('status', 'pending')->get();
        $pesananDiproses = Pesanan::where('user_id', $userId)->where('status', 'diproses')->get();
        $pesananDikirim = Pesanan::where('user_id', $userId)->where('status', 'dikirim')->get();
        $pesananSelesai = Pesanan::where('user_id', $userId)->where('status', 'selesai')->get();
        $pesananDibatalkan = Pesanan::where('user_id', $userId)->where('status', 'dibatalkan')->get();

        $pesananKonveksiPending = PesananKonveksi::where('user_id', $userId)->where('status', 'pending')->get();
        $pesananKonveksiDiproses = PesananKonveksi::where('user_id', $userId)->where('status', 'diproses')->get();
        $pesananKonveksiDikirim = PesananKonveksi::where('user_id', $userId)->where('status', 'dikirim')->get();
        $pesananKonveksiSelesai = PesananKonveksi::where('user_id', $userId)->where('status', 'selesai')->get();
        $pesananKonveksiDibatalkan = PesananKonveksi::where('user_id', $userId)->where('status', 'dibatalkan')->get();

        return view('pelanggan.page.statusPesanan', [
            'name' => 'Status Pesanan',
            'title' => 'Status Pesanan',
            'pesananPending' => $pesananPending,
            'pesananDiproses' => $pesananDiproses,
            'pesananDikirim' => $pesananDikirim,
            'pesananSelesai' => $pesananSelesai,
            'pesananDibatalkan' => $pesananDibatalkan,
            'pesananKonveksiPending' => $pesananKonveksiPending,
            'pesananKonveksiDiproses' => $pesananKonveksiDiproses,
            'pesananKonveksiDikirim' => $pesananKonveksiDikirim,
            'pesananKonveksiSelesai' => $pesananKonveksiSelesai,
            'pesananKonveksiDibatalkan' => $pesananKonveksiDibatalkan,
        ]);
    }
    public function detailStatusPesanan($type, $id)
{
    if ($type === 'pesanan') {
        $pesanan = Pesanan::findOrFail($id);
    } elseif ($type === 'pesananKonveksi') {
        $pesanan = PesananKonveksi::findOrFail($id);
    } else {
        abort(404);
    }

    return view('pelanggan.page.detailStatusPesanan', [
        'pesanan' => $pesanan,
        'type' => $type,
        'name' => 'Detail Status Pesanan',
        'title' => 'Detail Status Pesanan',
    ]);
}

}
