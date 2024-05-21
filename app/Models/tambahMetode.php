<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tambahMetode extends Model
{
    use HasFactory;

    protected $table = 'metode_transaksi';

    protected $fillable = [
        'nama_bank',
        'no_rekening',
    ];
}
