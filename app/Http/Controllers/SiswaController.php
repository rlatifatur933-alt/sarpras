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
        $user = \App\Models\User::findOrFail($id);
        
        $userData = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        \App\Models\Siswa::where('user_id', $id)->update([
            'username' => $request->username,
            'nis' => $request->nis,
        ]);

        return redirect()->back()->with('success', 'Data & Password berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $user = \App\Models\User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa'
        ]);

        \App\Models\Siswa::create([
            'user_id' => $user->id, 
            'username' => $request->username,
            'nis' => $request->nis,
            'kelas' => $request->kelas ?? '-'
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan!');
    }

    public function destroy($id)
    {
        \App\Models\Siswa::where('user_id', $id)->delete();
        \App\Models\User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}