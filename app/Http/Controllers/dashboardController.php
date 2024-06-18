<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class dashboardController extends Controller
{
    public function dashboard ()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();

        return view('admin.page.Dashboard',[
            'name' => 'Dashboard',
            'title' => 'Dashboard',
            'totalUsers' => $totalUsers,
        ]);
    }
}
