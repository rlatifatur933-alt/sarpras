<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = ['ket_kategori'];

    public function inputAspirasi()
    {
        return $this->hasMany(InputAspirasi::class, 'id_kategori', 'id_kategori');
    }
}
