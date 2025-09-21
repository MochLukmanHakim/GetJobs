<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelamar extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'cv_path',
        'pekerjaan_id',
        'status',
        'pengumuman_status',
        'catatan',
        'tanggal_melamar'
    ];

    protected $casts = [
        'tanggal_melamar' => 'datetime',
    ];

    /**
     * Get the job that the applicant applied for
     */
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'id_pekerjaan');
    }

    /**
     * Get the applicant's initials for avatar
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->nama);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2);
    }

    /**
     * Get formatted phone number
     */
    public function getFormattedPhoneAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->telepon);
        if (strlen($phone) >= 10) {
            return preg_replace('/(\d{4})(\d{4})(\d{4})/', '$1-$2-$3', $phone);
        }
        return $this->telepon;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'accepted' => 'accepted',
            'rejected' => 'rejected',
            default => 'review'
        };
    }

    /**
     * Get pengumuman status badge class
     */
    public function getPengumumanBadgeClassAttribute(): string
    {
        return match($this->pengumuman_status) {
            'interview' => 'interview',
            'test' => 'test',
            'document' => 'document',
            'phone' => 'phone',
            'completed' => 'completed',
            'pending' => 'pending',
            default => 'none'
        };
    }
}
