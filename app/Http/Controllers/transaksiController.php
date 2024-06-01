<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tambahMetode;

class transaksiController extends Controller
{
    public function transaksi ()
    {
        return view('admin.page.Transaksi.Transaksi',[
            'name' => 'Transaksi',
            'title' => 'Transaksi',
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
    public function detailTransaksi ()
    {
        return view('admin.page.Transaksi.detailTransaksi',[
            'name' => 'Detail Transaksi',
            'title' => 'Detail Transaksi',
        ]);
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
