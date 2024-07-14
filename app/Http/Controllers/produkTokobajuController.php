<?php

namespace App\Http\Controllers;

use App\Services\NFTService;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\kategoriTokobaju;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class produkTokobajuController extends Controller
{
    protected $nftService;

    public function __construct(NFTService $nftService)
    {
        $this->nftService = $nftService;
    }

    public function produkTokobaju()
    {
        $kategoriTokobaju = kategoriTokobaju::all();
        return view('admin.page.TokoBaju.TambahProduk', [
            'kategoriTokobaju' => $kategoriTokobaju,
            'name' => 'Tambah Produk', 
            'title' => 'Tambah Produk',
        ]);
    }

    public function simpanData(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_tokobajus,id',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_produk' => 'required|string',
            'type_produk' => 'required|in:biasa,eksklusif',
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
        $img->insert(public_path('watermark.png'), 'bottom-right', 10, 10);
        $img->save($imagePath);

        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori_id = $request->kategori_id;
        $produk->foto_produk = $imageName;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->type_produk = $request->type_produk;
        $produk->tanggal_masuk = now();
        $produk->save();

        for ($i = 0; $i < count($request->warna_produks); $i++) {
            $foto_produk_modal = $request->file('foto_produk_modals')[$i];
            $imageNameModal = time() . '_foto_produk_modal_' . $i . '.' . $foto_produk_modal->extension();  
            $imagePathModal = public_path('images/' . $imageNameModal);
            $imgModal = Image::make($foto_produk_modal);
            $imgModal->insert(public_path('watermark.png'), 'bottom-right', 10, 10); 
            $imgModal->save($imagePathModal);

            $produk->variasi()->create([
                'warna_produk' => $request->warna_produks[$i],
                'ukuran' => $request->ukurans[$i],
                'harga' => $request->hargas[$i],
                'stock' => $request->stocks[$i],
                'foto_produk_modal' => $imageNameModal,
            ]);
        }

        // Buat NFT untuk foto produk utama
        $tokenURI = url('images/' . $imageName); 
        $fromAddress = '0x1cdEF82ee7B6AD764B3323b352477f5A79984184'; 
        $transactionHash = $this->nftService->createToken($tokenURI, $fromAddress);

        $produk->nft_token_id = $transactionHash; 
        $produk->save();

        return redirect()->route('tokobaju')->with('success', 'Produk berhasil ditambahkan!');
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
