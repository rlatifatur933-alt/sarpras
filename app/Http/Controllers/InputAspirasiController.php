<?php

namespace App\Http\Controllers;

use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputAspirasiController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'id_kategori' => 'required',
            'ket' => 'required',
            'foto' => 'required|image'
        ]);

        // Upload foto
        $nama_foto = time().'.'.$request->foto->extension();
        $request->foto->move(public_path('uploads'), $nama_foto);

        $laporan = InputAspirasi::create([
            'nis' => Auth::user()->siswa->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
            'foto' => $nama_foto,
        ]);

        // Langsung buatin status awal di tabel Aspirasi
        Aspirasi::create([
            'id_pelaporan' => $laporan->id_pelaporan,
            'status' => 'menunggu',
            'feedback' => '-'
        ]);

        return redirect()->back()->with('success', 'Laporan terkirim!');
    }
}