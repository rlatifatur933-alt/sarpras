<?php

use Illuminate\Support\Facades\Route;
use App\Models\Kategori;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\InputAspirasiController;
use App\Http\Controllers\AspirasiController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk Management User & Siswa (Biasanya Admin)
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::put('/siswa/update/{user_id}', [SiswaController::class, 'update'])->name('siswa.update');

// Route Master Kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');

// Route untuk Siswa Input Aspirasi
Route::get('/aspirasi/tambah', function () {
    $kategori = Kategori::all(); // Ambil semua data kategori dari database
    return view('siswa.create', compact('kategori')); // Kirim variabel $kategori ke view
})->name('aspirasi.create');

Route::post('/aspirasi/simpan', [InputAspirasiController::class, 'store'])->name('aspirasi.store');

// Route untuk Admin Kasih Feedback & Update Status
Route::get('/admin/aspirasi', [AspirasiController::class, 'index'])->name('admin.aspirasi.index');
Route::put('/admin/aspirasi/update/{id}', [AspirasiController::class, 'updateFeedback'])->name('admin.aspirasi.update');