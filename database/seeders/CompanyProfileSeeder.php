<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CompanyProfile;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user dengan userType 'perusahaan'
        $companyUsers = User::where('userType', 'perusahaan')->get();

        foreach ($companyUsers as $user) {
            CompanyProfile::create([
                'user_id' => $user->id,
                'alamat_perusahaan' => 'Jl. Contoh No. 123, Jakarta Pusat',
                'bidang_industri' => 'Teknologi Informasi',
                'no_telp_perusahaan' => '+62-21-1234567',
                'deskripsi' => 'Perusahaan teknologi terkemuka yang fokus pada pengembangan solusi digital inovatif.',
                'media_sosial' => [
                    'linkedin' => 'https://linkedin.com/company/contoh',
                    'instagram' => 'https://instagram.com/contohcompany',
                    'twitter' => 'https://twitter.com/contohcompany'
                ]
            ]);
        }
    }
}
