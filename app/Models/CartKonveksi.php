<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartKonveksi extends Model
{
    use HasFactory;

    protected $table = 'cart_konveksi';
    
    protected $fillable = [
        'konveksi_id',
        'variasi_id',
        'user_id',
        'nama_produk',
        'warna',
        'ukuran',
        'kuantitas',
        'harga_satuan',
        'total_harga',
        'image',
    ];
}
