<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Aspirasi;

class SiswaController extends Controller
{
    public function index() {
        $siswa = \App\Models\Siswa::with('user')->get(); 
        return view('admin.siswa.index', compact('siswa'));
    }

    public function dashboard()
    {
        $userId = auth()->user()->id;
        $siswa = \App\Models\Siswa::where('user_id', $userId)->first();
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

        $laporan_terbaru = Aspirasi::with(['inputAspirasi.siswa']) 
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

    public function detailLaporan($id)
    {
        $laporan = Aspirasi::with(['inputAspirasi.siswa'])->findOrFail($id);

        return view('siswa.detail', compact('laporan'));
    }
}