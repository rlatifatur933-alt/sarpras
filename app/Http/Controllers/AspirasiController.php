<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function dashboard() 
    {
        // Hitung data langsung dari database
        $total = \App\Models\Aspirasi::count();
        $menunggu = \App\Models\Aspirasi::where('status', 'menunggu')->count();
        $proses = \App\Models\Aspirasi::where('status', 'proses')->count();
        $selesai = \App\Models\Aspirasi::where('status', 'selesai')->count();

        // Kirim data ke view
        return view('admin.dashboard', compact('total', 'menunggu', 'proses', 'selesai'));
    }

    public function index() {
        // Ambil semua data aspirasi beserta relasi inputannya
        $data = Aspirasi::with('inputAspirasi.siswa', 'inputAspirasi.kategori')->get();
        return view('admin.aspirasi', compact('data'));
    }

    public function updateFeedback(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'feedback' => 'required',
        ]);

        $aspirasi = \App\Models\Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $request->status,
            'feedback' => $request->feedback,
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
    }

    public function store(Request $request)
    {
        // 1. Validasi inputan siswa
        $request->validate([
            'nis' => 'required|exists:siswa,nis', // Cek apakah NIS ada di tabel siswa
            'kategori_id' => 'required',
            'laporan' => 'required|min:10',
        ], [
            'nis.exists' => 'NIS tidak terdaftar! Silakan hubungi admin.',
        ]);

        // 2. Simpan ke database
        // Sesuaikan dengan nama tabel kamu, misal 'input_aspirasi' atau 'aspirasi'
        \App\Models\Aspirasi::create([
            'nis' => $request->nis,
            'kategori_id' => $request->kategori_id,
            'laporan' => $request->laporan,
            'status' => 'menunggu', // Default status awal
            'tanggal' => now(),
        ]);

        // 3. Balik ke halaman depan dengan pesan sukses
        return redirect('/')->with('success', 'Aspirasi kamu berhasil dikirim!');
    }
}