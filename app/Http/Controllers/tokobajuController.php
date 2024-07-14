<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\VariasiProduk;
use App\Models\kategoriTokobaju;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;
use App\Models\Pesanan;


class tokobajuController extends Controller
{
    public function tokobaju(Request $request)
    {
        $rows = (int) $request->input('rows', 10);

        $produks = Produk::paginate($rows);

        return view('admin.page.TokoBaju.Tokobaju', [
            'produks' => $produks,
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }

    public function detailProdukTokobaju (string $id)
    {
        $produks = Produk::findOrFail($id);
        $variasiProduk = VariasiProduk::where('produk_id', $id)->get();
        $totalTerjual = Pesanan::where('nama_produk', $produks->nama_produk)->sum('kuantitas');
        $totalVariasiTerjual = Pesanan::sum('kuantitas');
        return view('admin.page.TokoBaju.DetailProduk',[
            'produks' => $produks,
            'variasiProduk' => $variasiProduk,
            'totalTerjual' => $totalTerjual,
            'totalVariasiTerjual' => $totalVariasiTerjual,
            'name' => 'Detail Produk Toko Baju',
            'title' => 'Detail Produk Toko Baju',
        ]);
    } 

    public function editProduk($id)
    {
        $produks = Produk::findOrFail($id);
        $kategoriTokobaju = kategoriTokobaju::all();
        
        return view('admin.page.TokoBaju.EditProduk', [
            'produks' => $produks,
            'kategoriTokobaju' => $kategoriTokobaju,
            'name' => 'Edit Produk',
            'title' => 'Edit Produk',
        ]);
    }

    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_tokobajus,id',
            'deskripsi_produk' => 'nullable|string',
            'warna_produk' => 'required|array',
            'ukuran' => 'required|array',
            'harga' => 'required|array',
            'stock' => 'required|array',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori_id = $request->kategori_id;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->save();

        foreach ($produk->variasi as $key => $variasi) {
            $variasi->update([
                'warna_produk' => $request->warna_produk[$key],
                'ukuran' => $request->ukuran[$key],
                'harga' => $request->harga[$key],
                'stock' => $request->stock[$key],
            ]);
        }

        return redirect()->route('detailProdukTokobaju', ['id' => $id])->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProduk($id)
    {
        $produk = Produk::findOrFail($id);
        
        $produk->variasi()->delete();

        $produk->delete();

        return redirect()->route('tokobaju')->with('success', 'Produk berhasil dihapus!');
    }

    public function searchByDate(Request $request)
    {
        $request->validate([
            'tgl' => 'required|date',
        ]);

        $tgl = $request->tgl;
        $rows = (int) $request->input('rows', 10);
        $produks = Produk::whereDate('tanggal_masuk', $tgl)->paginate($rows);

        return view('admin.page.TokoBaju.Tokobaju', [
            'produks' => $produks,
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->input('query');
        $rows = (int) $request->input('rows', 10);
        
        $produks = Produk::where('nama_produk', 'like', '%' . $query . '%')
        ->orWhereHas('kategori', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })
        ->paginate($rows);

        return view('admin.page.TokoBaju.Tokobaju', [
            'produks' => $produks,
            'name' => 'Toko Baju',
            'title' => 'Toko Baju',
        ]);
    }

    // public function generateQRCodePDF($id)
    // {
    //     $produk = Produk::findOrFail($id);

    //     $qrCode = base64_encode(QrCode::format('svg')->size(200)->generate($produk->nft_token_id));

    //     $pdf = PDF::loadView('pdf.qrcode', ['qrCode' => $qrCode, 'produk' => $produk]);

    //     return $pdf->download('qrcode_' . $produk->id . '.pdf');
    // }

    public function generateQRCodePDF($id)
    {

        ini_set('max_execution_time', 120);

        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $qrData = [
            'judul' => 'Alveen Clothing',
            'nama_produk' => $produk->nama_produk,
            'type_produk' => $produk->type_produk,
            'foto_produk' => asset('images/' . $produk->foto_produk),
            'nft_token_id' => $produk->nft_token_id
        ];
    
        $qrCodeUrl = route('displayQRCodeData', ['data' => json_encode($qrData)]);
    
        $qrCode = base64_encode(QrCode::format('svg')->size(200)->generate($qrCodeUrl));
    
        $pdf = PDF::loadView('pdf.qrcode', ['qrCode' => $qrCode, 'produk' => $produk]);
    
        return $pdf->download('qrcode_' . $produk->id . '.pdf');
    }

    public function displayQRCodeData(Request $request)
    {
        $data = $request->input('data');
        $data = json_decode($data, true);

        // Pastikan data yang diperlukan ada
        if (!isset($data['judul']) || !isset($data['nama_produk']) || !isset($data['type_produk']) || !isset($data['foto_produk']) || !isset($data['nft_token_id'])) {
            return view('errors.produk_not_found');
        }

        // Cari produk berdasarkan token NFT dan data lainnya
        $produk = Produk::where('nft_token_id', $data['nft_token_id'])
                        ->where('nama_produk', $data['nama_produk'])
                        ->where('type_produk', $data['type_produk'])
                        ->where('foto_produk', 'LIKE', '%' . basename($data['foto_produk'])) // Hanya membandingkan nama file foto
                        ->first();

        if (!$produk) {
            return view('errors.produk_not_found');
        }

        // Hitung total pesanan terjual
        $totalPesananTerjual = Pesanan::sum('kuantitas');

        return view('display_qrcode_data', [
            'data' => $data,
            'totalPesananTerjual' => $totalPesananTerjual,
        ]);
    }

}
