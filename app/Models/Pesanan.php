<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $fillable = [
        'produk_id',
        'nama_produk',
        'warna',
        'ukuran',
        'kuantitas',
        'harga_satuan',
        'total_harga',
        'image',
        'status',
        'nama_pemilik_rumah',
        'alamat_lengkap',
        'kode_pos',
        'link_lokasi',
        'metode_pembayaran',
        'no_rekening',
        'bukti_pembayaran',
    ];
}
