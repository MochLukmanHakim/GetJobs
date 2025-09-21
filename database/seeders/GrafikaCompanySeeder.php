<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pekerjaan;
use App\Models\Pelamar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GrafikaCompanySeeder extends Seeder
{
    public function run(): void
    {
        // Create Company: Grafika Indonesia
        $grafikaCompany = User::create([
            'name' => 'Grafika Indonesia',
            'email' => 'grf@gmail.com',
            'password' => Hash::make('123'),
            'phone' => '081234567893',
            'role' => 'company',
            'userType' => 'perusahaan',
        ]);

        // Jobs for Grafika Indonesia
        $grafikaJobs = [
            [
                'judul_pekerjaan' => 'Graphic Design Specialist',
                'lokasi_pekerjaan' => 'Yogyakarta',
                'gaji_pekerjaan' => 'Rp 5.000.000 - Rp 8.000.000',
                'kategori_pekerjaan' => 'design',
                'deskripsi_pekerjaan' => 'Membuat desain grafis untuk berbagai media cetak dan digital.',
                'jumlah_pelamar_diinginkan' => 3,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'Print Production Manager',
                'lokasi_pekerjaan' => 'Yogyakarta',
                'gaji_pekerjaan' => 'Rp 7.000.000 - Rp 10.000.000',
                'kategori_pekerjaan' => 'production',
                'deskripsi_pekerjaan' => 'Mengelola proses produksi percetakan dari desain hingga finishing.',
                'jumlah_pelamar_diinginkan' => 2,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'Digital Marketing Designer',
                'lokasi_pekerjaan' => 'Yogyakarta',
                'gaji_pekerjaan' => 'Rp 4.500.000 - Rp 7.000.000',
                'kategori_pekerjaan' => 'marketing',
                'deskripsi_pekerjaan' => 'Merancang konten visual untuk media sosial dan kampanye digital.',
                'jumlah_pelamar_diinginkan' => 2,
                'status' => 'tutup',
            ],
        ];

        // Create jobs for Grafika Indonesia
        $grafikaJobIds = [];
        foreach ($grafikaJobs as $jobData) {
            $job = Pekerjaan::create([
                'user_id' => $grafikaCompany->id,
                'tanggal_dibuat' => now(),
                ...$jobData
            ]);
            $grafikaJobIds[] = $job->id_pekerjaan;
        }

        // Create applicants for Grafika Indonesia jobs
        $grafikaApplicants = [
            ['nama' => 'Rina Kartika Sari', 'email' => 'rina.kartika.grafika@email.com', 'telepon' => '081234567013', 'status' => 'review'],
            ['nama' => 'Agus Setiawan Putra', 'email' => 'agus.setiawan.grafika@email.com', 'telepon' => '081234567014', 'status' => 'accepted'],
            ['nama' => 'Lestari Wulandari Dewi', 'email' => 'lestari.wulandari.grafika@email.com', 'telepon' => '081234567015', 'status' => 'review'],
            ['nama' => 'Rudi Hermawan Santoso', 'email' => 'rudi.hermawan.grafika@email.com', 'telepon' => '081234567016', 'status' => 'accepted'],
        ];

        foreach ($grafikaApplicants as $index => $applicantData) {
            Pelamar::create([
                'pekerjaan_id' => $grafikaJobIds[$index % count($grafikaJobIds)],
                'cv_path' => 'cv/' . strtolower(str_replace(' ', '_', $applicantData['nama'])) . '_cv.pdf',
                'tanggal_melamar' => now()->subDays(rand(1, 30)),
                ...$applicantData
            ]);
        }

        echo "Grafika Indonesia company seeded successfully!\n";
        echo "Company created: Grafika Indonesia (ID: {$grafikaCompany->id}) - grf@gmail.com\n";
        echo "Password: 123\n";
        echo "Jobs created: " . count($grafikaJobs) . "\n";
        echo "Applicants created: " . count($grafikaApplicants) . "\n";
    }
}
