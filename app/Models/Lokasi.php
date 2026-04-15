<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    // Nama tabel di database kamu
    protected $table = 'lokasis';

    // Primary key custom sesuai screenshot phpMyAdmin kamu
    protected $primaryKey = 'id_lokasi';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_lokasi',
    ];
}