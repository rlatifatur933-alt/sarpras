<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\aspirasi;

class AspirasiController extends Controller
{
    public function dashboard()
    {
        $total = \App\Models\InputAspirasi::count(); 
        
        $menunggu = \App\Models\Aspirasi::where('status', 'menunggu')->count();
        $proses = \App\Models\Aspirasi::where('status', 'proses')->count();
        $selesai = \App\Models\Aspirasi::where('status', 'selesai')->count();

        $p_menunggu = $total > 0 ? round(($menunggu / $total) * 100) : 0;
        $p_proses = $total > 0 ? round(($proses / $total) * 100) : 0;
        $p_selesai = $total > 0 ? round(($selesai / $total) * 100) : 0;

        return view('admin.dashboard', compact('total', 'menunggu', 'proses', 'selesai', 'p_menunggu', 'p_proses', 'p_selesai'));
    }

    public function index() 
    {
        $total = \App\Models\InputAspirasi::count();
        $menunggu = \App\Models\Aspirasi::where('status', 'menunggu')->count();
        $proses = \App\Models\Aspirasi::where('status', 'proses')->count();
        $selesai = \App\Models\Aspirasi::where('status', 'selesai')->count();

        
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
        $userId = auth()->user()->id;
        $siswa = \App\Models\Siswa::where('user_id', $userId)->first();

        $kategori = \App\Models\Kategori::all();
        $lokasi = \App\Models\Lokasi::all();

        return view('siswa.from_laporan', compact('kategori', 'lokasi', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'         => 'required',
            'id_kategori' => 'required',
            'lokasi'      => 'required',
            'ket'         => 'required',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $nama_foto = 'default.png'; 
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_foto = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/aspirasi'), $nama_foto);
        }

        $simpan = InputAspirasi::create([
            'nis'         => $request->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
            'foto'        => $nama_foto, 
        ]);

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
        $siswa = \App\Models\Siswa::where('user_id', auth()->user()->id)->first();

        $nisSiswa = $siswa ? $siswa->nis : 'data_tidak_ada';

        $aspirasi = \App\Models\InputAspirasi::with('aspirasi')
                    ->where('nis', $nisSiswa)
                    ->latest()
                    ->get();

        return view('siswa.history', compact('aspirasi', 'nisSiswa'));
    }

    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }

    public function destroy($id)
    {
        $laporan = InputAspirasi::findOrFail($id);
        
        if($laporan->foto && file_exists(public_path('uploads/aspirasi/' . $laporan->foto))) {
            unlink(public_path('uploads/aspirasi/' . $laporan->foto));
        }

        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }
}