<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusPesananController extends Controller
{
    public function statusPesanan()
    {
        return view('Pelanggan.Page.statusPesanan' ,[
            'name' => 'Status Pesanan',
            'title' => 'Status Pesanan',
        ]);
    }
}
