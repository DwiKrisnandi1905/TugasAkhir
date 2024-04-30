<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = ['nama_produk', 'deskripsi_produk', 'kategori_id', 'foto_produk', 'tanggal_masuk'];

    public function variasi()
    {
        return $this->hasMany(VariasiProduk::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriTokobaju::class, 'kategori_id');
    }
}

