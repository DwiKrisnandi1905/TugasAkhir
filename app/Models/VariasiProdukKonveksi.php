<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariasiProdukKonveksi extends Model
{
    protected $table = 'variations_produk_konveksi'; 

    protected $fillable = ['konveksi_id', 'warna_produk', 'ukuran', 'harga', 'stock', 'foto_produk_modal']; 

    public function konveksi()
    {
        return $this->belongsTo(Konveksi::class, 'konveksi_id');
    }
}

