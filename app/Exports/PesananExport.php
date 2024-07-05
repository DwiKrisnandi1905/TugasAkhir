<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesananExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pesanan::all()->map(function($order) {
            return [
                'Id' => $order->id,
                'Tgl_Transaksi' => $order->created_at->format('Y-m-d'),
                'Pelanggan' => $order->user->name,
                'Produk_Layanan' => $order->nama_produk,
                'Status_Pengiriman' => $order->status,
                'Total' => $order->total_harga,
                'Jumlah' => $order->kuantitas,
                'Nama_Produk' => $order->nama_produk,
                'Warna' => $order->warna,
                'Ukuran' => $order->ukuran,
                'Harga_Satuan' => $order->harga_satuan,
                'Nama_Pembeli' => $order->nama_pemilik_rumah,
                'Alamat_Lengkap' => $order->alamat_lengkap,
                'Kode_Pos' => $order->kode_pos,
                'Metode_Pembayaran' => $order->metode_pembayaran,
                'No_Rekening' => $order->no_rekening ?? '-',
                'Bukti_Pembayaran' => $order->bukti_pembayaran ? asset('storage/' . $order->bukti_pembayaran) : '-'
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Tgl Transaksi',
            'Pelanggan',
            'Produk/Layanan',
            'Status Pengiriman',
            'Total',
            'Jumlah',
            'Nama Produk',
            'Warna',
            'Ukuran',
            'Harga Satuan',
            'Nama Pembeli',
            'Alamat Lengkap',
            'Kode Pos',
            'Metode Pembayaran',
            'No Rekening',
            'Bukti Pembayaran'
        ];
    }
}

