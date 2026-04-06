<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    
    // Tambahkan ini juga di sini!
    protected $primaryKey = 'id_aspirasi'; // atau apa nama PK di tabel aspirasimu
    
    // Ini WAJIB ada agar id_pelaporan boleh diisi lewat Controller
    protected $fillable = ['id_pelaporan', 'status', 'feedback']; 
}