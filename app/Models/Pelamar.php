<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // ⬅️ WAJIB
use Illuminate\Notifications\Notifiable;

class Pelamar extends Authenticatable
{
    use HasFactory, Notifiable;

    // ✅ pastikan nama tabel sesuai
    protected $table = 'pelamar'; // kalau tabel kamu 'pelamar', biarkan. Kalau 'pelamars', ubah ke 'pelamars'

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'phone_number',
        'role',
        'password',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
