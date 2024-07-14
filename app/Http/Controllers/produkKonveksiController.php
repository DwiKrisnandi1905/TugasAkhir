<?php

namespace App\Http\Controllers;

use App\Services\NFTService;
use Illuminate\Http\Request;
use App\Models\Konveksi;
use App\Models\kategoriKonveksi;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class produkKonveksiController extends Controller
{
    protected $nftService;

    public function __construct(NFTService $nftService)
    {
        $this->nftService = $nftService;
    }

    public function produkKonveksi()
    {
        $kategoriKonveksi = kategoriKonveksi::all();
        return view('admin.page.Konveksi.TambahProduk', [
            'kategoriKonveksi' => $kategoriKonveksi,
            'name' => 'Tambah Produk Konveksi', 
            'title' => 'Tambah Produk Konveksi',
        ]);
    }
    public function simpanDataKonveksi(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_konveksis,id',
            'jenis' => 'required|string',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'warna_produks' => 'required|array',
            'ukurans' => 'required|array',
            'hargas' => 'required|array',
            'stocks' => 'required|array',
            'foto_produk_modals' => 'required|array',
            'warna_produks.*' => 'required|string',
            'ukurans.*' => 'required|string',
            'hargas.*' => 'required|numeric',
            'stocks.*' => 'required|numeric',
            'foto_produk_modals.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '_foto_produk.' . $request->foto_produk->extension();  
        $imagePath = public_path('images/' . $imageName);
        $img = Image::make($request->foto_produk);
        $img->insert(public_path('watermark.png'), 'bottom-right', 10, 10); // tambahkan watermark
        $img->save($imagePath);

        $konveksi = new Konveksi();
        $konveksi->nama_produk = $request->nama_produk;
        $konveksi->kategori_id = $request->kategori_id;
        $konveksi->jenis = $request->jenis;
        $konveksi->foto_produk = $imageName;
        $konveksi->deskripsi = $request->deskripsi;
        $konveksi->tanggal_masuk = now();
        $konveksi->save();

        for ($i = 0; $i < count($request->warna_produks); $i++) {
            $foto_produk_modal = $request->file('foto_produk_modals')[$i];
            $imageNameModal = time() . '_foto_produk_modals_' . $i . '.' . $foto_produk_modal->extension();  
            $imagePathModal = public_path('images/' . $imageNameModal);
            $imgModal = Image::make($foto_produk_modal);
            $imgModal->insert(public_path('watermark.png'), 'bottom-right', 10, 10); 
            $imgModal->save($imagePathModal);
            
            $konveksi->variasi()->create([
                'warna_produk' => $request->warna_produks[$i],
                'ukuran' => $request->ukurans[$i],
                'harga' => $request->hargas[$i],
                'stock' => $request->stocks[$i],
                'foto_produk_modal' => $imageNameModal,
            ]);
        }

        // Buat NFT untuk foto produk utama
        $tokenURI = url('images/' . $imageName); // Gunakan URL publik gambar sebagai tokenURI
        $fromAddress = '0x1cdEF82ee7B6AD764B3323b352477f5A79984184'; // Ganti dengan address Ethereum Anda
        $transactionHash = $this->nftService->createToken($tokenURI, $fromAddress);

        // Simpan ID token dan hash transaksi
        $konveksi->nft_token_id = $transactionHash; // Simpan hash transaksi atau ID token jika tersedia
        $konveksi->save();

        return redirect()->route('konveksi')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function verifyNFT($transactionHash)
    {
        try {
            $transactionReceipt = $this->nftService->verifyNFT($transactionHash);

            if ($transactionReceipt) {
                return response()->json([
                    'success' => true,
                    'message' => 'NFT verification successful',
                    'data' => $transactionReceipt,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}

