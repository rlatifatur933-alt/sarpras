<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = \App\Models\Lokasi::all();

        return view('admin.lokasi', compact('lokasi'));
    }

    public function create()
    {
        $lokasi = \App\Models\Lokasi::all();

        return view('siswa.aspirasi', compact('lokasi')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required'
        ]);

        Lokasi::create($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambah!');
    }

    // Mengupdate data lokasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lokasi' => 'required'
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil diupdate!');
    }

    // Menghapus data lokasi
    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil dihapus!');
    }
}
