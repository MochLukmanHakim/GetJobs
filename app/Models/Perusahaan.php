<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    protected $primaryKey = 'id_perusahaan';
    
    protected $fillable = [
        'id_user',
        'nama_perusahaan',
        'deskripsi_perusahaan',
        'no_telp_perusahaan',
        'bidang_industri',
        'alamat_perusahaan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
