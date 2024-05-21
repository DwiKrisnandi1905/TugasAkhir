<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('Pelanggan.Layout.index' ,[
            'name' => 'Home',
            'title' => 'Home',
        ]);
    }
}
