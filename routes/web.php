<?php

use Illuminate\Support\Facades\Route;
use App\Models\Kategori;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\InputAspirasiController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController; 

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
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');

// Route lokasi
Route::resource('lokasi', LokasiController::class);

// Halaman form untuk siswa
Route::get('/kirim-aspirasi', [AspirasiController::class, 'create'])->name('aspirasi.create');
// Proses simpan data ke database
Route::post('/kirim-aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');

// Route login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);

// Route Dashboard Admin
Route::get('/dashboard', [AspirasiController::class, 'dashboard'])->name('admin.dashboard');

// Route untuk Admin Kasih Feedback & Update Status
Route::get('/admin/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
Route::put('/admin/aspirasi/update/{id}', [AspirasiController::class, 'updateFeedback'])->name('admin.aspirasi.update');
Route::post('/admin/aspirasi/update/{id}', [AspirasiController::class, 'updateStatus'])->name('aspirasi.update');

// Route untuk melihat progres untuk siswa
Route::get('/history-aspirasi', [AspirasiController::class, 'history'])->name('aspirasi.history');

// Route untuk logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Route Tentang
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// Halaman utama data siswa
Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::put('/admin/siswa/{user_id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::post('/admin/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
Route::delete('/admin/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');