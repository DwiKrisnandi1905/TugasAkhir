<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konveksi extends Model
{
    protected $table = 'konveksi';

    protected $fillable = ['nama_produk', 'deskripsi', 'kategori_id', 'jenis', 'foto_produk'];

    public function variasi()
    {
        return $this->hasMany(VariasiProdukKonveksi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriKonveksi::class, 'kategori_id');
    }
}

