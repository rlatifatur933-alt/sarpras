<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa'; // Nama tabel di phpMyAdmin kamu

    protected $fillable = ['user_id', 'username', 'nis', 'kelas'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}