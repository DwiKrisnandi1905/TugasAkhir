<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\VariasiProduk;
use App\Models\TambahMetode;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.produk_id' => 'required|integer|min:1',
            'items.*.id' => 'required|integer',
            'items.*.nama' => 'required|string|max:255',
            'items.*.warna' => 'required|string|max:255',
            'items.*.ukuran' => 'required|string|max:255',
            'items.*.kuantitas' => 'required|integer|min:1',
            'items.*.hargaSatuan' => 'required|numeric|min:0',
            'items.*.totalHarga' => 'required|numeric|min:0',
            'items.*.image' => 'required|string|max:255',
        ]);

        foreach ($request->items as $item) {
            Pesanan::create([
                'produk_id' => $item['produk_id'],
                'nama_produk' => $item['nama'],
                'warna' => $item['warna'],
                'ukuran' => $item['ukuran'],
                'kuantitas' => $item['kuantitas'],
                'harga_satuan' => $item['hargaSatuan'],
                'total_harga' => $item['totalHarga'],
                'image' => $item['image'],
            ]);

            $variasi = VariasiProduk::where('produk_id', $item['produk_id'])->first();

            if ($variasi) {
                $variasi->stock -= $item['kuantitas'];
                $variasi->save();
            } else {
                return response()->json(['success' => false, 'message' => 'Variation not found'], 404);
            }

        }

        return response()->json(['success' => true]);
    }

    public function alamatForm()
    {
        return view('Pelanggan.Page.alamat', [
            'name' => 'Alamat',
            'title' => 'Alamat',
        ]);
    }

    public function storeAlamat(Request $request)
    {
        $request->validate([
            'nama_pemilik_rumah' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'link_lokasi' => 'required|url',
        ]);

        // Update all orders with the address details
        Pesanan::whereNull('nama_pemilik_rumah')->update([
            'nama_pemilik_rumah' => $request->nama_pemilik_rumah,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'link_lokasi' => $request->link_lokasi,
        ]);

        return redirect()->route('payment.form');
    }

    public function paymentForm()
    {
        $pesanan = Pesanan::whereNull('metode_pembayaran')->get();
        $total_biaya = $pesanan->sum('total_harga');
        $metode_transaksi = TambahMetode::all();
        return view('Pelanggan.Page.payment', compact('pesanan', 'total_biaya', 'metode_transaksi'), [
            'name' => 'Pembayaran',
            'title' => 'Pembayaran',
        ]);
    }

    public function storePayment(Request $request)
{
    $request->validate([
        'metode_pembayaran' => 'required|string|max:255',
        'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        'pesanan' => 'required|json',
    ]);

    $buktiPembayaranPath = null;
    if ($request->hasFile('bukti_pembayaran')) {
        $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
    }

    $nama_bank = $request->metode_pembayaran;
    $no_rekening = null;

    if ($request->metode_pembayaran !== 'COD') {
        // Assuming the format is "Bank Name - Account Number"
        $parts = explode(' - ', $request->metode_pembayaran);
        if (count($parts) == 2) {
            $nama_bank = $parts[0];
            $no_rekening = $parts[1];
        }
    }

    $pesanan = json_decode($request->input('pesanan'), true);

    // foreach ($pesanan as $item) {
    //     $produk = Produk::where('nama_produk', $item['nama_produk'])->first();

    //     if ($produk) {
    //         $variation = VariasiProduk::where('produk_id', $produk->id)
    //                                   ->where('warna_produk', $item['warna'])
    //                                   ->where('ukuran', $item['ukuran'])
    //                                   ->first();

    //         if ($variation) {
    //             $variation->stock -= $item['kuantitas'];
    //             $variation->save();
    //         }
    //     }
    // }

    // Update all orders with the payment details
    Pesanan::whereNull('metode_pembayaran')->update([
        'metode_pembayaran' => $nama_bank,
        'no_rekening' => $no_rekening,
        'bukti_pembayaran' => $buktiPembayaranPath,
        'status' => 'pending',
    ]);

    return redirect()->route('home')->with('success', 'Pembayaran berhasil disimpan!');
}

    // public function updateStock(Request $request)
    // {
    //     $pesanan = json_decode($request->input('pesanan'), true);

    //     foreach ($pesanan as $item) {
    //         $variation = VariasiProduk::where('nama_produk', $item['nama_produk'])
    //                                   ->where('warna', $item['warna'])
    //                                   ->where('ukuran', $item['ukuran'])
    //                                   ->first();

    //         if ($variation) {
    //             $variation->stock -= $item['kuantitas'];
    //             $variation->save();
    //         }
    //     }
    // }
}
