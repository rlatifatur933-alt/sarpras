<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // TAMBAHKAN BARIS INI
use Illuminate\Database\Eloquent\Model;

class aspirasi extends Model
{
    use HasFactory; // Sekarang baris ini nggak akan error lagi

    // Ganti dari 'input_aspirasi' jadi 'aspirasi'
    protected $table = 'aspirasi';

    protected $fillable = [
        'nis', 
        'kategori_id', 
        'laporan', 
        'status', 
        'tanggal'
    ];
}