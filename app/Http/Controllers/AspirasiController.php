<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index() {
        // Ambil semua data aspirasi beserta relasi inputannya
        $data = Aspirasi::with('inputAspirasi.siswa', 'inputAspirasi.kategori')->get();
        return view('admin.aspirasi.', compact('data'));
    }

    public function updateFeedback(Request $request, $id) {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);

        return redirect()->back()->with('success', 'Feedback berhasil dikirim!');
    }
}