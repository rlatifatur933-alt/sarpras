<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Pastiin nama tabelnya sesuai
    protected $primaryKey = 'id_kategori'; // Karena di view kamu pakai id_kategori

    protected $fillable = [
        'ket_kategori',
    ];
}