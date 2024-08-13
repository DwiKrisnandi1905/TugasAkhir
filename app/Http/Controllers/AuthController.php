<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            if ($role == 'admin') {
                return redirect()->intended('/dashboard');
            } elseif ($role == 'user') {
                return redirect()->intended('/home');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang anda masukkan salah',
        ])->withInput($request->only('email'));
    }



    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        event(new Registered($user));

        return redirect()->route('register')->with('status', 'Registrasi berhasil, silahkan cek email untuk melakukan verifikasi aktivasi akun');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'gender' => 'required|string',
            'birthdate' => 'required|date',
            'phone' => 'required|string|max:15',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->gender = $request->input('gender');
        $user->birthdate = $request->input('birthdate');
        $user->phone = $request->input('phone');

        if ($request->hasFile('foto_profile')) {
            $imageName = time() . '_foto_profile.' . $request->foto_profile->extension();
            $request->foto_profile->move(public_path('images/profile'), $imageName);
            $user->foto_profile = $imageName; // Asumsikan Anda menyimpan nama file di kolom 'foto_profile'
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}

