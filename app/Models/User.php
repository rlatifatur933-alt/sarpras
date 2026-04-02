<?php

namespace App\Models;

// Pastiin ada baris ini!
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

// Di sini harus Authenticatable, bukan Model
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // Karena tabel kamu namanya 'user' bukan 'users'

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}