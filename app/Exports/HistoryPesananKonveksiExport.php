<?php

namespace App\Exports;

use App\Models\PesananKonveksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryPesananKonveksiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PesananKonveksi::with('user')->whereIn('status', ['selesai', 'dibatalkan'])->get()->map(function($order) {
            return [
                'Id' => $order->id,
                'Tgl_Transaksi' => $order->created_at->format('Y-m-d'),
                'Pelanggan' => $order->user->name,
                'Produk' => $order->nama_produk,
                'Status' => $order->status,
                'Total' => $order->total_harga,
                'Jumlah' => $order->kuantitas,
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
            'Produk',
            'Status',
            'Total',
            'Jumlah'
        ];
    }
}
