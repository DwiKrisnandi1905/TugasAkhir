<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariasiProduk extends Model
{
    protected $table = 'variations_produk'; 

    protected $fillable = ['produk_id', 'warna_produk', 'ukuran', 'harga', 'stock', 'foto_produk_modal']; 

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}

