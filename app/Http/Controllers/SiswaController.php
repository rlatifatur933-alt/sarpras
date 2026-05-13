<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\User;

class SiswaController extends Controller
{
    public function index(Request $request) {
        $cari = $request->cari;
    
        $siswa = \App\Models\Siswa::with('user')
            ->where(function($query) use ($cari) {
                $query->where('username', 'like', "%" . $cari . "%")
                      ->orWhereHas('user', function($q) use ($cari) {
                          $q->where('email', 'like', "%" . $cari . "%");
                      });
            })
            ->get();
    
        return view('admin.siswa.index', compact('siswa'));
    }

    public function dashboard()
    {
        $userId = auth()->user()->id;
        $siswa = Siswa::where('user_id', $userId)->first();
        $nisUser = $siswa ? $siswa->nis : null;

        $total_laporan = Aspirasi::whereHas('inputAspirasi', function($query) use ($nisUser) {
            $query->where('nis', $nisUser); 
        })->count();
        
        $laporan_pending = Aspirasi::where('status', 'Menunggu')
            ->whereHas('inputAspirasi', function($query) use ($nisUser) {
                $query->where('nis', $nisUser);
            })->count();
                            
        $laporan_selesai = Aspirasi::where('status', 'Selesai')
            ->whereHas('inputAspirasi', function($query) use ($nisUser) {
                $query->where('nis', $nisUser);
            })->count();

            $laporan_terbaru = Aspirasi::has('inputAspirasi')
            ->with('inputAspirasi.siswa')
            ->latest() 
            ->take(5)  
            ->get();   

        return view('siswa.dashboard', compact(
            'total_laporan', 
            'laporan_pending', 
            'laporan_selesai', 
            'laporan_terbaru', 
            'siswa'            
        ));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $userData = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        Siswa::where('user_id', $id)->update([
            'username' => $request->username,
            'nis' => $request->nis,
        ]);

        return redirect()->back()->with('success', 'Data & Password berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nis'      => 'required|unique:siswa,nis',
        ], [
            'email.unique' => 'Email sudah terdaftar!',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'siswa'
        ]);

        Siswa::create([
            'user_id'  => $user->id,
            'username' => $request->username,
            'nis'      => $request->nis,
            'kelas'    => $request->kelas ?? '-'
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan!');
    }

    public function destroy($id)
    {
        Siswa::where('user_id', $id)->delete();
        User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function detailLaporan($id)
    {
        $laporan = Aspirasi::with(['inputAspirasi.siswa'])->findOrFail($id);

        return view('siswa.detail', compact('laporan'));
    }
}