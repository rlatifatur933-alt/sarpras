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

    public function store(Request $request) {
        Kategori::create(['ket_kategori' => $request->ket_kategori]);
        return redirect()->back()->with('success', 'Kategori baru ditambah!');
    }
}