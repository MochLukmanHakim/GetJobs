<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first user or create one
        $user = User::first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Create sample pekerjaan
        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Frontend Developer',
            'lokasi_pekerjaan' => 'Jakarta',
            'gaji_pekerjaan' => 'Rp 8.000.000',
            'kategori_pekerjaan' => 'technology',
            'deskripsi_pekerjaan' => 'Mengembangkan aplikasi web menggunakan React dan Vue.js',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Backend Developer',
            'lokasi_pekerjaan' => 'Bandung',
            'gaji_pekerjaan' => 'Rp 10.000.000',
            'kategori_pekerjaan' => 'technology',
            'deskripsi_pekerjaan' => 'Mengembangkan API menggunakan Laravel dan MySQL',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Backend Developer',
            'lokasi_pekerjaan' => 'Bandung',
            'gaji_pekerjaan' => 'Rp 10.000.000',
            'kategori_pekerjaan' => 'technology',
            'deskripsi_pekerjaan' => 'Mengembangkan API menggunakan Laravel dan MySQL',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Backend Developer',
            'lokasi_pekerjaan' => 'Bandung',
            'gaji_pekerjaan' => 'Rp 10.000.000',
            'kategori_pekerjaan' => 'technology',
            'deskripsi_pekerjaan' => 'Mengembangkan API menggunakan Laravel dan MySQL',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Backend Developer',
            'lokasi_pekerjaan' => 'Bandung',
            'gaji_pekerjaan' => 'Rp 10.000.000',
            'kategori_pekerjaan' => 'technology',
            'deskripsi_pekerjaan' => 'Mengembangkan API menggunakan Laravel dan MySQL',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Backend Developer',
            'lokasi_pekerjaan' => 'Bandung',
            'gaji_pekerjaan' => 'Rp 10.000.000',
            'kategori_pekerjaan' => 'technology',
            'deskripsi_pekerjaan' => 'Mengembangkan API menggunakan Laravel dan MySQL',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);
    }
} 