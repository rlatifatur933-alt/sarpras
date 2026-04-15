<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index() {
        $kategori = Kategori::all();
        return view('admin.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ket_kategori' => 'required|string|max:255',
        ]);
    
        Kategori::create([
            'ket_kategori' => $request->ket_kategori
        ]);
    
        return redirect()->back()->with('success', 'Kategori berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ket_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'ket_kategori' => $request->ket_kategori
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diubah!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
}