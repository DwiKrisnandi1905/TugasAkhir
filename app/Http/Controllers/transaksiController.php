<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tambahMetode;
use App\Models\Pesanan;
use App\Models\PesananKonveksi;

class transaksiController extends Controller
{
    public function transaksi ()
    {
        $pesanan = Pesanan::all();
        $pesananKonveksi = PesananKonveksi::all();
        return view('admin.page.Transaksi.Transaksi',[
            'name' => 'Transaksi',
            'title' => 'Transaksi',
            'pesanan' => $pesanan,
            'pesananKonveksi' => $pesananKonveksi,
        ]);
    }
    public function metodeTransaksi ()
    {
        $metode_transaksi = TambahMetode::all();
        return view('admin.page.Transaksi.metodeTransaksi',[
            'metode_transaksi' => $metode_transaksi,
            'name' => 'Metode Transaksi',
            'title' => 'Metode Transaksi',
        ]);
    }
    public function detailTransaksi($type, $id)
{
    if ($type === 'pesanan') {
        $order = Pesanan::findOrFail($id);
    } elseif ($type === 'pesananKonveksi') {
        $order = PesananKonveksi::findOrFail($id);
    } else {
        abort(404);
    }

    return view('admin.page.Transaksi.detailTransaksi', [
        'name' => 'Detail Transaksi',
        'title' => 'Detail Transaksi',
        'order' => $order,
        'orderType' => $type,
    ]);
}

public function updateStatus(Request $request, $id, $type)
{
    $request->validate([
        'status' => 'required|string|in:pending,diproses,dikirim,selesai,dibatalkan',
    ]);

    if ($type === 'pesanan') {
        $order = Pesanan::findOrFail($id);
    } elseif ($type === 'pesananKonveksi') {
        $order = PesananKonveksi::findOrFail($id);
    } else {
        abort(404);
    }

    $order->status = $request->status;
    $order->save();

    return redirect()->route('detailTransaksi', ['type' => $type, 'id' => $order->id])->with('success', 'Status berhasil diupdate');
}


    public function tambahMetode(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
        ]);

        TambahMetode::create([
            'nama_bank' => $request->input('nama_bank'),
            'no_rekening' => $request->input('no_rekening'),
        ]);

        return redirect()->route('metodeTransaksi')->with('success', 'Metode transaksi berhasil ditambahkan');
    }

    public function editMetode($id)
    {
        $metode = TambahMetode::findOrFail($id);
        return view('admin.page.Transaksi.editMetode', [
            'name' => 'Edit Metode Transaksi',
            'title' => 'Edit Metode Transaksi',
            'metode' => $metode,
        ]);
    }

    public function updateMetode(Request $request, $id)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
        ]);

        $metode = TambahMetode::findOrFail($id);
        $metode->update([
            'nama_bank' => $request->input('nama_bank'),
            'no_rekening' => $request->input('no_rekening'),
        ]);

        return redirect()->route('metodeTransaksi')->with('success', 'Metode transaksi berhasil diupdate');
    }
    
    public function deleteMetode($id)
    {
        $metode = TambahMetode::findOrFail($id);
        $metode->delete();

        return redirect()->route('metodeTransaksi')->with('success', 'Metode transaksi berhasil dihapus');
    }
}
