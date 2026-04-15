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
        $request->validate([
            'id_kategori' => 'required', 
            'lokasi'      => 'required', 
            'ket'         => 'required', 
            'foto'        => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);
 
        Aspirasi::create([
            'user_id'     => auth()->id(),
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'isi_laporan' => $request->ket, 
            'foto'        => $request->file('foto')->store('uploads', 'public'), 
            'status'      => 'pending', 
        ]);

        return redirect()->route('aspirasi.history')->with('success', 'Laporan berhasil dikirim!');
    }

}