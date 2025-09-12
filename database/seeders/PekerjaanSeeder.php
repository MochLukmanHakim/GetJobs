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

        // Create sample pekerjaan - only 3 technology jobs
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
            'judul_pekerjaan' => 'Full Stack Developer',
            'lokasi_pekerjaan' => 'Surabaya',
            'gaji_pekerjaan' => 'Rp 12.000.000',
            'kategori_pekerjaan' => 'technology',
            'deskripsi_pekerjaan' => 'Mengembangkan aplikasi web full stack menggunakan MERN stack',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        // Add some design jobs
        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'UI/UX Designer',
            'lokasi_pekerjaan' => 'Jakarta',
            'gaji_pekerjaan' => 'Rp 7.000.000',
            'kategori_pekerjaan' => 'design',
            'deskripsi_pekerjaan' => 'Mendesain antarmuka pengguna yang menarik dan user-friendly',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Graphic Designer',
            'lokasi_pekerjaan' => 'Bandung',
            'gaji_pekerjaan' => 'Rp 6.000.000',
            'kategori_pekerjaan' => 'design',
            'deskripsi_pekerjaan' => 'Membuat desain grafis untuk berbagai keperluan marketing',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        // Add some management jobs
        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Project Manager',
            'lokasi_pekerjaan' => 'Jakarta',
            'gaji_pekerjaan' => 'Rp 15.000.000',
            'kategori_pekerjaan' => 'management',
            'deskripsi_pekerjaan' => 'Mengelola proyek dari perencanaan hingga implementasi',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

        Pekerjaan::create([
            'user_id' => $user->id,
            'judul_pekerjaan' => 'Product Manager',
            'lokasi_pekerjaan' => 'Surabaya',
            'gaji_pekerjaan' => 'Rp 18.000.000',
            'kategori_pekerjaan' => 'management',
            'deskripsi_pekerjaan' => 'Mengelola pengembangan produk dari konsep hingga peluncuran',
            'status' => 'aktif',
            'tanggal_dibuat' => now(),
        ]);

    }
} 