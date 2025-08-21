<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan';
    protected $primaryKey = 'id_pekerjaan';

    protected $fillable = [
        'user_id',
        'judul_pekerjaan',
        'lokasi_pekerjaan',
        'gaji_pekerjaan',
        'kategori_pekerjaan',
        'deskripsi_pekerjaan',
        'batas_waktu_pekerjaan',
        'status',
        'tanggal_dibuat'
    ];

    protected $casts = [
        'batas_waktu_pekerjaan' => 'date',
        'tanggal_dibuat' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
} 