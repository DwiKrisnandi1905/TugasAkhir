<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    // Show the form to request a password reset
    public function showRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Handle the request to reset the password
    public function handleRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Redirect to the reset form with the email parameter
        return redirect()->route('password.reset', ['email' => $request->email]);
    }

    // Show the form to reset the password
    public function showResetForm($email)
    {
        return view('auth.passwords.reset', ['email' => $email]);
    }

    // Handle the password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Find the user and update the password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Password reset successfully. Please login.');
    }
}

