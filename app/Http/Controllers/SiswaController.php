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

    public function update(Request $request, $id)
    {
        // 1. Cari user
        $user = \App\Models\User::findOrFail($id);
        
        // 2. Siapkan data yang mau diupdate untuk tabel 'user'
        $userData = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        // 3. Cek apakah password diisi? Kalau iya, kita enkripsi dan masukkan ke array
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        // 4. Eksekusi update tabel 'user'
        $user->update($userData);

        // 5. Eksekusi update tabel 'siswa'
        \App\Models\Siswa::where('user_id', $id)->update([
            'username' => $request->username,
            'nis' => $request->nis,
        ]);

        return redirect()->back()->with('success', 'Data & Password berhasil diperbarui!');
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

    public function destroy($id)
    {
        // 1. Hapus data di tabel siswa dulu
        \App\Models\Siswa::where('user_id', $id)->delete();

        // 2. Hapus akun di tabel user
        \App\Models\User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}