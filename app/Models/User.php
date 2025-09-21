<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'logo',
        'role',
        'userType',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the company profile associated with the user.
     */
    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class);
    }

    /**
     * Get the perusahaan profile associated with the user.
     */
    public function perusahaan()
    {
        return $this->hasOne(Perusahaan::class, 'id_user', 'id');
    }

    /**
     * Get the pekerjaan for this user.
     */
    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'user_id', 'id');
    }

    /**
     * Get the logo URL for the user.
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            $url = asset('images/' . $this->logo);
            \Log::info('Logo URL generated', [
                'user_id' => $this->id,
                'user_name' => $this->name,
                'logo' => $this->logo,
                'url' => $url
            ]);
            return $url;
        }
        
        \Log::info('No logo found, using default', [
            'user_id' => $this->id,
            'user_name' => $this->name,
            'logo' => $this->logo
        ]);
        
        // Default company logo if no logo is set
        return asset('images/default-company-logo.png');
    }

    /**
     * Get the logo path for the user.
     */
    public function getLogoPathAttribute()
    {
        return $this->logo ? 'images/' . $this->logo : 'images/default-company-logo.png';
    }
}
