<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\VariasiProduk;
use App\Models\tambahMetode;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;
use Midtrans\Notification;


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

        $userId = Auth::id();

        foreach ($request->items as $item) {
            Pesanan::create([
                'user_id' => $userId,
                'produk_id' => $item['produk_id'],
                'nama_produk' => $item['nama'],
                'warna' => $item['warna'],
                'ukuran' => $item['ukuran'],
                'kuantitas' => $item['kuantitas'],
                'harga_satuan' => $item['hargaSatuan'],
                'total_harga' => $item['totalHarga'],
                'image' => $item['image'],
            ]);

            // $variasi = VariasiProduk::where('id', $item['produk_id'])->first();

            // if ($variasi) {
            //     $variasi->stock -= $item['kuantitas'];
            //     $variasi->save();
            // } else {
            //     return response()->json(['success' => false, 'message' => 'Variation not found'], 404);
            // }
        }

        return response()->json(['success' => true]);
    }

    public function alamatForm()
    {
        return view('pelanggan.page.alamat', [
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

        $userId = Auth::id();

        // Update all orders with the address details for the authenticated user
        Pesanan::where('user_id', $userId)->whereNull('nama_pemilik_rumah')->update([
            'nama_pemilik_rumah' => $request->nama_pemilik_rumah,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'link_lokasi' => $request->link_lokasi,
        ]);

        return redirect()->route('payment.form');
    }

    public function cancel()
    {
        $userId = Auth::id();

        // Delete the orders and cart items for the authenticated user
        Pesanan::where('user_id', $userId)->whereNull('nama_pemilik_rumah')->delete();

        return response()->json(['success' => true]);
    }

    public function paymentForm()
    {
        $userId = Auth::id();
        $pesanan = Pesanan::where('user_id', $userId)->where('metode_pembayaran', 'COD')->get();
        $total_biaya = $pesanan->sum('total_harga');
        $metode_transaksi = tambahMetode::all();

        return view('pelanggan.page.payment', compact('pesanan', 'total_biaya', 'metode_transaksi'), [
            'name' => 'Pembayaran',
            'title' => 'Pembayaran',
        ]);
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'nullable|string|max:255',
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

        // Decode the pesanan JSON
        $pesanan = json_decode($request->input('pesanan'), true);

        $userId = Auth::id();

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Membuat ID pesanan unik
        $orderId = 'order-' . Str::uuid();

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => collect($pesanan)->sum('total_harga')
        ];

        $itemDetails = [];
        foreach ($pesanan as $item) {
            $itemDetails[] = [
                'id' => $item['produk_id'],
                'price' => $item['harga_satuan'],
                'quantity' => $item['kuantitas'],
                'name' => $item['nama_produk']
            ];
        }

        $customerDetails = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => '081234567890' // Sesuaikan dengan data user
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create transaction. Please try again.']);
        }

        // Update stok produk berdasarkan pesanan
        foreach ($pesanan as $item) {
            $variasi = VariasiProduk::where('id', $item['produk_id'])->first();

            if ($variasi) {
                $variasi->stock -= $item['kuantitas'];
                $variasi->save();
            } else {
                return response()->json(['success' => false, 'message' => 'Variation not found'], 404);
            }
        }

        // Update all orders with the payment details for the authenticated user
        // Pesanan::where('user_id', $userId)->whereNull('metode_pembayaran')->update([
        //     'metode_pembayaran' => $nama_bank,
        //     'no_rekening' => $no_rekening,
        //     'bukti_pembayaran' => $buktiPembayaranPath,
        //     'status' => 'pending',
        // ]);
        Pesanan::where('metode_pembayaran', 'COD')->update([
            'metode_pembayaran' => 'midtrans',
            'no_rekening' => $no_rekening,
            'bukti_pembayaran' => $buktiPembayaranPath,
            'status' => 'pending',
            'status_pembayaran' => 'belum dibayar',
            'order_id' => $orderId,
            'snap_token' => $snapToken,
        ]);

        $selectedItemIds = array_column($pesanan, 'id');
        Cart::where('user_id', Auth::id())->whereIn('id', $selectedItemIds)->delete();

        return redirect()->route('statusPesanan')->with('success', 'Pembayaran berhasil disimpan!');
    }

    public function paymentCancel()
    {
        $userId = Auth::id();

        // Delete the orders and cart items for the authenticated user
        Pesanan::where('user_id', $userId)->where('metode_pembayaran', 'COD')->delete();

        return response()->json(['success' => true]);
    }

    public function handleMidtransCallback(Request $request)
    {
        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $order_id = $notification->order_id;

        $pesanan = Pesanan::where('order_id', $order_id)->first();

        if ($transaction == 'capture') {
            $pesanan->status = 'sudah dibayar';
        } elseif ($transaction == 'settlement') {
            $pesanan->status = 'sudah dibayar';
        } elseif ($transaction == 'pending') {
            $pesanan->status = 'belum dibayar';
        } elseif ($transaction == 'deny') {
            $pesanan->status = 'dibatalkan';
        } elseif ($transaction == 'expire') {
            $pesanan->status = 'kadaluarsa';
        } elseif ($transaction == 'cancel') {
            $pesanan->status = 'dibatalkan';
        }

        $pesanan->save();

        return response()->json(['status' => 'success']);
    }

    public function updateStatus(Request $request, $order_id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,diproses,dikirim,selesai,dibatalkan',
            'status_pembayaran' => 'required|string|in:belum dibayar,sudah dibayar',
        ]);

        // Ambil semua pesanan berdasarkan order_id
        $orders = Pesanan::where('order_id', $order_id)->get();

        // Periksa apakah ada pesanan yang ditemukan
        if ($orders->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan'], 404);
        }

        // Update status untuk setiap pesanan
        foreach ($orders as $order) {
            $order->status = $request->status;
            $order->status_pembayaran = $request->status_pembayaran;
            $order->save();
        }

        return response()->json(['success' => true, 'message' => 'Status berhasil diupdate untuk semua produk']);
    }
}
