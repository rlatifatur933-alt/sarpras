<?php

namespace App\Http\Controllers;

use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputAspirasiController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi data (SESUAIKAN DENGAN NAMA DI BLADE)
        $request->validate([
            'id_kategori' => 'required', // Di Blade namanya id_kategori
            'lokasi'      => 'required', // Di Blade namanya lokasi
            'ket'         => 'required', // Di Blade namanya ket
            'foto'        => 'required|image|mimes:jpeg,png,jpg|max:2048', // Di Blade namanya foto
        ]);

        // 2. Simpan data ke database
        Aspirasi::create([
            'user_id'     => auth()->id(),
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'isi_laporan' => $request->ket, // Mapping 'ket' dari form ke kolom 'isi_laporan' (sesuaikan nama kolom DB-mu)
            'foto'        => $request->file('foto')->store('uploads', 'public'), // Contoh simpan foto
            'status'      => 'pending', 
        ]);

        // 3. REDIRECT (Ini baru akan jalan kalau validasi di atas lolos)
        return redirect()->route('aspirasi.history')->with('success', 'Laporan berhasil dikirim!');
    }

}