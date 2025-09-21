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
        'jumlah_pelamar_diinginkan',
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

    /**
     * Get all applicants for this job
     */
    public function pelamars()
    {
        return $this->hasMany(Pelamar::class, 'pekerjaan_id', 'id_pekerjaan');
    }

    /**
     * Get the count of applicants for this job
     */
    public function getApplicantCountAttribute()
    {
        return $this->pelamars()->count();
    }
} 