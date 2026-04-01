<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = ['status', 'id_pelaporan', 'feedback'];

    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }
}
