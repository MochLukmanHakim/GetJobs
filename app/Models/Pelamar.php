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

    /**
     * Get shortened name (first two words)
     */
    public function getShortNameAttribute(): string
    {
        $words = explode(' ', $this->nama);
        return implode(' ', array_slice($words, 0, 2));
    }

    /**
     * Get shortened email (first two words only)
     */
    public function getShortEmailAttribute(): string
    {
        if (strpos($this->email, '@') === false) {
            return $this->email;
        }
        
        $parts = explode('@', $this->email);
        $username = $parts[0];
        $domain = $parts[1] ?? '';
        
        // Get first two words from username (split by dots or underscores)
        $usernameParts = preg_split('/[._]/', $username);
        $shortUsername = implode('.', array_slice($usernameParts, 0, 2));
        
        // Get first two parts from domain (split by dots)
        $domainParts = explode('.', $domain);
        $shortDomain = implode('.', array_slice($domainParts, 0, 2));
        
        return $shortUsername . '@' . $shortDomain;
    }

    /**
     * Get shortened CV name (first two words)
     */
    public function getShortCvNameAttribute(): string
    {
        $filename = basename($this->cv_path ?? 'sample_cv.pdf');
        $nameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
        $words = explode('_', $nameWithoutExt);
        $shortName = implode('_', array_slice($words, 0, 2));
        return $shortName . '.pdf';
    }
}
