<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'user_id'; // Sesuai gambar
    public $incrementing = false;     // Karena PK-nya foreign key dari users

    protected $fillable = ['user_id', 'username', 'nis', 'kelas'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function inputAspirasi()
    {
        return $this->hasMany(InputAspirasi::class, 'nis', 'nis');
    }
}
