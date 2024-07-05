<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konveksi;
use App\Models\VariasiProdukKonveksi;
use App\Models\kategoriKonveksi;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\PDF;


class konveksiController extends Controller
{
    public function konveksi(Request $request)
    {
        $rows = (int) $request->input('rows', 10);

        $konveksis = Konveksi::paginate($rows);
        
        return view('admin.page.Konveksi.Konveksi', [
            'konveksis' => $konveksis, 
            'name' => 'Konveksi',
            'title' => 'Konveksi',
        ]);
    }

    public function detailProdukKonveksi(string $id)
    {
        $konveksis = Konveksi::findOrFail($id);
        $variasiProdukKonveksi = VariasiProdukKonveksi::where('konveksi_id', $id)->get();
        return view('admin.page.Konveksi.DetailProduk',[
            'konveksis' => $konveksis,
            'variasiProdukKonveksi' => $variasiProdukKonveksi,
            'name' => 'Detail Produk Konveksi',
            'title' => 'Detail Produk Konveksi',
        ]);
    }

    public function editProdukKonveksi($id)
    {
        $konveksis = Konveksi::findOrFail($id);
        $kategoriKonveksi = kategoriKonveksi::all();
        
        return view('admin.page.Konveksi.EditProduk', [
            'konveksis' => $konveksis,
            'kategoriKonveksi' => $kategoriKonveksi,
            'name' => 'Edit Produk',
            'title' => 'Edit Produk',
        ]);
    }

    public function updateProdukKonveksi(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_konveksis,id',
            'deskripsi' => 'nullable|string',
            'warna_produk' => 'required|array',
            'ukuran' => 'required|array',
            'harga' => 'required|array',
            'stock' => 'required|array',
        ]);

        $konveksi = Konveksi::findOrFail($id);
        $konveksi->nama_produk = $request->nama_produk;
        $konveksi->kategori_id = $request->kategori_id;
        $konveksi->deskripsi = $request->deskripsi;
        $konveksi->save();

        foreach ($konveksi->variasi as $key => $variasi) {
            $variasi->update([
                'warna_produk' => $request->warna_produk[$key],
                'ukuran' => $request->ukuran[$key],
                'harga' => $request->harga[$key],
                'stock' => $request->stock[$key],
            ]);
        }

        return redirect()->route('detailProdukKonveksi', ['id' => $id])->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProdukKonveksi($id)
    {
        $konveksi = Konveksi::findOrFail($id);
        
        $konveksi->variasi()->delete();

        $konveksi->delete();

        return redirect()->route('konveksi')->with('success', 'Produk berhasil dihapus!');
    }

    public function searchByDateKonveksi(Request $request)
    {
        $request->validate([
            'tgl' => 'required|date',
        ]);

        $tgl = $request->tgl;
        $rows = (int) $request->input('rows', 10);
        $konveksis = Konveksi::whereDate('tanggal_masuk', $tgl)->paginate($rows);

        return view('admin.page.Konveksi.Konveksi', [
            'konveksis' => $konveksis,
            'name' => 'Konveksi',
            'title' => 'Konveksi',
        ]);
    }

    public function searchKonveksi(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->input('query'); 
        $rows = (int) $request->input('rows', 10);

        $konveksis = Konveksi::where('nama_produk', 'like', '%' . $query . '%')
                        ->orWhereHas('kategori', function ($q) use ($query) {
                            $q->where('name', 'like', '%' . $query . '%');
                        })
                        ->paginate($rows);

        return view('admin.page.Konveksi.Konveksi', [
            'konveksis' => $konveksis,
            'name' => 'Konveksi',
            'title' => 'Konveksi',
        ]);
    }

    public function generateQRCodePDF($id)
    {
        $konveksi = Konveksi::findOrFail($id);

        // Generate QR Code
        $qrCode = base64_encode(QrCode::format('svg')->size(200)->generate($konveksi->nft_token_id));

        // Generate PDF
        $pdf = PDF::loadView('pdf.qrcodeKonveksi', ['qrCode' => $qrCode, 'konveksi' => $konveksi]);

        // Download PDF
        return $pdf->download('qrcode_konveksi_' . $konveksi->id . '.pdf');
    }
}
