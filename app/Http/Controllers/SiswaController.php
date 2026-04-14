<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index() {
        $siswa = \App\Models\Siswa::with('user')->get(); 
        return view('admin.siswa.index', compact('siswa'));
    }

    public function update(Request $request, $user_id) {
        $siswa = Siswa::where('user_id', $user_id)->first();
        
        // Update email di tabel users melalui relasi
        $siswa->user->update([
            'email' => $request->email
        ]);
    
        return redirect()->back()->with('success', 'Email siswa berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        // Simpan ke tabel user dulu
        $user = \App\Models\User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa'
        ]);

        // Simpan ke tabel siswa pakai ID user yang barusan dibuat
        \App\Models\Siswa::create([
            'user_id' => $user->id, // Ini yang nyambungin ke tabel user
            'username' => $request->username,
            'nis' => $request->nis,
            'kelas' => $request->kelas ?? '-'
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan!');
    }
}