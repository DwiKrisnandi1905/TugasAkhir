<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_produk',
        'warna',
        'ukuran',
        'kuantitas',
        'harga_satuan',
        'total_harga',
        'image',
    ];
}
