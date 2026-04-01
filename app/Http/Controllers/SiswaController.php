<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index() {
        $siswa = Siswa::with('user')->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function update(Request $request, $user_id) {
        $siswa = Siswa::where('user_id', $user_id)->first();
        $siswa->update($request->all());
        return redirect()->back()->with('success', 'Data siswa diupdate!');
    }
}