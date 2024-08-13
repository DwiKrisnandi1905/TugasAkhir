<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class pelangganController extends Controller
{
    public function pelanggan(Request $request)
    {
        $search = $request->input('search');

        $rowsPerPage = $request->input('rowsPerPage', 10);

        $query = User::where('role', 'user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->paginate($rowsPerPage);

        return view('admin.page.pelanggan', [
            'name' => 'Pelanggan',
            'title' => 'Pelanggan',
            'users' => $users,
            'search' => $search,
            'rowsPerPage' => $rowsPerPage,
        ]);
    }

    public function detailUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.page.detailPelanggan', [
            'user' => $user,
            'name' => 'Detail Pelanggan',
            'title' => 'Detail Pelanggan',
        ]);
    }
}
