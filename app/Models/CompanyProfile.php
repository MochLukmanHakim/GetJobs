<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'user_id',
        'alamat_perusahaan',
        'bidang_industri',
        'no_telp_perusahaan',
        'deskripsi',
        'media_sosial'
    ];

    protected $casts = [
        'media_sosial' => 'array'
    ];

    /**
     * Get the user that owns the company profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the company name from the related user.
     */
    public function getNamaPerusahaanAttribute()
    {
        return $this->user->name;
    }

    /**
     * Get the email from the related user.
     */
    public function getEmailAttribute()
    {
        return $this->user->email;
    }
}
