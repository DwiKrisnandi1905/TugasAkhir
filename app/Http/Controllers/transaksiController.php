<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tambahMetode;
use App\Models\Pesanan;
use App\Models\PesananKonveksi;
use Barryvdh\DomPDF\Facade\Pdf;

class transaksiController extends Controller
{
    public function transaksi(Request $request)
{
    $rowsPesanan = (int) $request->input('rows_pesanan', 10); 
    $rowsPesananKonveksi = (int) $request->input('rows_pesanan_konveksi', 10); 
    $query = $request->input('query');
    $tgl = $request->input('tgl');

    $pesananPage = $request->input('pesanan_page', 1);
    $pesananKonveksiPage = $request->input('pesanan_konveksi_page', 1);

    $pesanan = Pesanan::query();
    if ($query) {
        $pesanan->where('nama_produk', 'like', '%' . $query . '%')
                ->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                });
    }
    if ($tgl) {
        $pesanan->whereDate('created_at', $tgl);
    }
    $pesanan = $pesanan->paginate($rowsPesanan, ['*'], 'pesanan_page', $pesananPage);

    $pesananKonveksi = PesananKonveksi::query();
    if ($query) {
        $pesananKonveksi->where('nama_produk', 'like', '%' . $query . '%')
                        ->orWhereHas('user', function ($q) use ($query) {
                            $q->where('name', 'like', '%' . $query . '%');
                        });
    }
    if ($tgl) {
        $pesananKonveksi->whereDate('created_at', $tgl);
    }
    $pesananKonveksi = $pesananKonveksi->paginate($rowsPesananKonveksi, ['*'], 'pesanan_konveksi_page', $pesananKonveksiPage);

    return view('admin.page.Transaksi.Transaksi', [
        'name' => 'Transaksi',
        'title' => 'Transaksi',
        'pesanan' => $pesanan,
        'pesananKonveksi' => $pesananKonveksi,
        'rows_pesanan' => $rowsPesanan,
        'rows_pesanan_konveksi' => $rowsPesananKonveksi,
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

    public function metodeTransaksi ()
    {
        $metode_transaksi = TambahMetode::all();
        return view('admin.page.Transaksi.metodeTransaksi',[
            'metode_transaksi' => $metode_transaksi,
            'name' => 'Metode Transaksi',
            'title' => 'Metode Transaksi',
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

    public function deletePesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('transaksi')->with('success', 'Pesanan berhasil dihapus');
    }

    public function deletePesananKonveksi($id)
    {
        $pesananKonveksi = PesananKonveksi::findOrFail($id);
        $pesananKonveksi->delete();

        return redirect()->route('transaksi')->with('success', 'Pesanan Konveksi berhasil dihapus');
    }

    public function history(Request $request)
{
    $query = $request->input('query');
    $tgl = $request->input('tgl');
    $pesananRows = $request->input('pesanan_rows', 10);
    $pesananKonveksiRows = $request->input('pesanan_konveksi_rows', 10);

    // Query for Pesanan Selesai/Dibatalkan
    $queryPesanan = Pesanan::with('user')
        ->where(function ($q) use ($query) {
            if ($query) {
                $q->where('nama_produk', 'like', '%' . $query . '%');
            }
        })
        ->where(function ($q) use ($tgl) {
            if ($tgl) {
                $q->whereDate('created_at', $tgl);
            }
        })
        ->whereIn('status', ['selesai', 'dibatalkan'])
        ->orderBy('created_at', 'desc')
        ->paginate($pesananRows, ['*'], 'pesanan_page');

    $queryPesananKonveksi = PesananKonveksi::with('user')
        ->where(function ($q) use ($query) {
            if ($query) {
                $q->where('nama_produk', 'like', '%' . $query . '%');
            }
        })
        ->where(function ($q) use ($tgl) {
            if ($tgl) {
                $q->whereDate('created_at', $tgl);
            }
        })
        ->whereIn('status', ['selesai', 'dibatalkan'])
        ->orderBy('created_at', 'desc')
        ->paginate($pesananKonveksiRows, ['*'], 'pesanan_konveksi_page');

    return view('admin.page.History', [
        'name' => 'History',
        'title' => 'History',
        'pesananSelesaiDibatalkan' => $queryPesanan,
        'pesananKonveksiSelesaiDibatalkan' => $queryPesananKonveksi,
        'pesananRows' => $pesananRows,
        'pesananKonveksiRows' => $pesananKonveksiRows,
    ]);
}



    public function detailHistory($type, $id)
    {
        if ($type === 'pesanan') {
            $order = Pesanan::findOrFail($id);
        } elseif ($type === 'pesananKonveksi') {
            $order = PesananKonveksi::findOrFail($id);
        } else {
            abort(404);
        }

        return view('admin.page.detailHistory', [
            'name' => 'Detail History',
            'title' => 'Detail History',
            'order' => $order,
            'type' => $type,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $pesanan = Pesanan::query();
        $pesananKonveksi = PesananKonveksi::query();

        // Apply filters (if any)
        $query = $request->input('query');
        $tgl = $request->input('tgl');

        if ($query) {
            $pesanan->where('nama_produk', 'like', '%' . $query . '%')
                    ->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    });
            $pesananKonveksi->where('nama_produk', 'like', '%' . $query . '%')
                            ->orWhereHas('user', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            });
        }
        if ($tgl) {
            $pesanan->whereDate('created_at', $tgl);
            $pesananKonveksi->whereDate('created_at', $tgl);
        }

        // Get all data without pagination
        $pesanan = $pesanan->get();
        $pesananKonveksi = $pesananKonveksi->get();

        // Load the view and pass the data
        $pdf = Pdf::loadView('admin.page.Transaksi.exportPdf', compact('pesanan', 'pesananKonveksi'));

        // Download the PDF
        return $pdf->download('transaksi.pdf');
    }
}
