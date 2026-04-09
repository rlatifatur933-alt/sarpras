<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\aspirasi;

class AspirasiController extends Controller
{
    public function dashboard()
    {
        $total = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'menunggu')->count();
        $proses = Aspirasi::where('status', 'proses')->count();
        $selesai = Aspirasi::where('status', 'selesai')->count();
    
        // Hitung Persentase (biar aman dari error pembagian nol)
        $p_menunggu = $total > 0 ? round(($menunggu / $total) * 100) : 0;
        $p_proses = $total > 0 ? round(($proses / $total) * 100) : 0;
        $p_selesai = $total > 0 ? round(($selesai / $total) * 100) : 0;
    
        return view('admin.dashboard', compact('total', 'menunggu', 'proses', 'selesai', 'p_menunggu', 'p_proses', 'p_selesai'));
    }

    public function index() 
    {
        // Ambil statistik untuk kotak di atas (biar gak error undefined variable)
        $total = \App\Models\InputAspirasi::count();
        $menunggu = \App\Models\Aspirasi::where('status', 'menunggu')->count();
        $proses = \App\Models\Aspirasi::where('status', 'proses')->count();
        $selesai = \App\Models\Aspirasi::where('status', 'selesai')->count();

        // Ambil data laporan lengkap dengan relasinya
        $laporan = \App\Models\InputAspirasi::with(['siswa', 'kategori', 'aspirasi'])->latest()->get();

        return view('admin.aspirasi', compact('total', 'menunggu', 'proses', 'selesai', 'laporan'));
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

    public function create()
    {
        // Ambil semua kategori dari database
        $kategori = \App\Models\kategori::all();
        return view('siswa.from_laporan', compact('kategori'));
    }

    public function store(Request $request)
    {
        // 1. Validasi (tambahin 'foto' biar aman)
        $request->validate([
            'nis'         => 'required',
            'id_kategori' => 'required',
            'lokasi'      => 'required',
            'ket'         => 'required',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Tambahkan ini
        ]);

        // Logika Upload Foto
        $nama_foto = 'default.png'; // Nilai awal kalau gak upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_foto = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/aspirasi'), $nama_foto);
        }

        // 2. Simpan ke tabel input_aspirasi
        $simpan = InputAspirasi::create([
            'nis'         => $request->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
            'foto'        => $nama_foto, // Pakai variabel $nama_foto hasil upload tadi
        ]);

        // 3. Simpan ke tabel aspirasi (biar statusnya gak null)
        if ($simpan) {
            aspirasi::create([
                'id_pelaporan' => $simpan->id_pelaporan,
                'status'       => 'menunggu',
                'feedback'     => '-',
            ]);
        }

        return redirect('/history-aspirasi')->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Cari data aspirasi berdasarkan ID (id_pelaporan)
        $aspirasi = \App\Models\Aspirasi::where('id_pelaporan', $id)->first();

        if ($aspirasi) {
            $aspirasi->update([
                'status'   => $request->status,
                'feedback' => $request->feedback ?? '-'
            ]);
            return redirect()->back()->with('success', 'Status berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function history()
    {
        // Ambil username dari user yang login (sekarang isinya '12345')
        $nisSiswa = auth()->user()->username;

        // Ambil data dari tabel Aspirasi yang punya relasi ke InputAspirasi dengan NIS tersebut
        $aspirasi = \App\Models\Aspirasi::whereHas('inputAspirasi', function ($query) use ($nisSiswa) {
            return $query->where('nis', $nisSiswa);
        })
        ->latest()
        ->get();

        // Kirim ke view (variabel nisSiswa tetap dikirim buat jaga-jaga kalau mau ditampilin)
        return view('siswa.history', compact('aspirasi', 'nisSiswa'));
    }

    public function inputAspirasi()
    {
        // Pastikan 'id_pelaporan' adalah foreign key yang menyambungkan kedua tabel
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }
}