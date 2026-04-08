<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Fungsi buat nampilin halaman (yang dicari route baris 38)
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        // Validasi input
        $request->validate([
            'login_identity' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah input itu email atau username
        $loginType = filter_var($request->login_identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Susun data untuk dicek ke DB
        $credentials = [
            $loginType => $request->login_identity,
            'password' => $request->password,
        ];

        // Eksekusi Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Tambahin logika ini buat cek role
            if (auth()->user()->role == 'admin') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/history-aspirasi');
            }
        }

        // Kalau gagal, balik ke login dengan pesan error
        return back()->with('error', 'Login gagal! Username atau Password salah.');
    }

    // 3. Fungsi Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}