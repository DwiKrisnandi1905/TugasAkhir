<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('pelanggan.page.profile', [
            'name' => 'profile',  
            'title' => 'Profile',   
            'user' => $user,        
        ]);
    }
}
