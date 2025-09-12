<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    protected $table = 'pelamars';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'pekerjaan_id',
        'cv_path',
        'status',
        'catatan'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }
}
