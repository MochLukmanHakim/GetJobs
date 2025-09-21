<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pekerjaan;
use App\Models\Pelamar;
use Illuminate\Database\Seeder;

class GrafikaAdditionalJobsSeeder extends Seeder
{
    public function run(): void
    {
        // Find Grafika Indonesia company
        $grafikaCompany = User::where('email', 'grf@gmail.com')->first();
        
        if (!$grafikaCompany) {
            echo "❌ Grafika Indonesia company not found!\n";
            return;
        }

        // Additional 3 jobs for Grafika Indonesia
        $additionalJobs = [
            [
                'judul_pekerjaan' => 'Creative Art Director',
                'lokasi_pekerjaan' => 'Yogyakarta',
                'gaji_pekerjaan' => 'Rp 8.000.000 - Rp 12.000.000',
                'kategori_pekerjaan' => 'design',
                'deskripsi_pekerjaan' => 'Memimpin tim kreatif dan mengawasi konsep visual untuk berbagai proyek klien.',
                'jumlah_pelamar_diinginkan' => 2,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'Web Design Specialist',
                'lokasi_pekerjaan' => 'Yogyakarta',
                'gaji_pekerjaan' => 'Rp 6.000.000 - Rp 9.000.000',
                'kategori_pekerjaan' => 'design',
                'deskripsi_pekerjaan' => 'Merancang dan mengembangkan desain website yang menarik dan user-friendly.',
                'jumlah_pelamar_diinginkan' => 3,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'Packaging Design Manager',
                'lokasi_pekerjaan' => 'Yogyakarta',
                'gaji_pekerjaan' => 'Rp 7.500.000 - Rp 11.000.000',
                'kategori_pekerjaan' => 'design',
                'deskripsi_pekerjaan' => 'Mengelola dan merancang kemasan produk yang inovatif dan menarik konsumen.',
                'jumlah_pelamar_diinginkan' => 2,
                'status' => 'tutup',
            ],
        ];

        // Create the additional jobs
        $jobIds = [];
        foreach ($additionalJobs as $jobData) {
            $job = Pekerjaan::create([
                'user_id' => $grafikaCompany->id,
                'tanggal_dibuat' => now(),
                ...$jobData
            ]);
            $jobIds[] = $job->id_pekerjaan;
            echo "✅ Created job: {$job->judul_pekerjaan} (ID: {$job->id_pekerjaan})\n";
        }

        // Create applicants for the new jobs
        $additionalApplicants = [
            // Applicants for Creative Art Director
            ['nama' => 'Sari Wulandari Putri', 'email' => 'sari.wulandari.grafika2@email.com', 'telepon' => '081234567017', 'status' => 'review', 'job_index' => 0],
            ['nama' => 'Eko Prasetyo Adi', 'email' => 'eko.prasetyo.grafika2@email.com', 'telepon' => '081234567018', 'status' => 'accepted', 'job_index' => 0],
            
            // Applicants for Web Design Specialist
            ['nama' => 'Diana Putri Maharani', 'email' => 'diana.putri.grafika2@email.com', 'telepon' => '081234567019', 'status' => 'review', 'job_index' => 1],
            ['nama' => 'Kevin Adiputra Santoso', 'email' => 'kevin.adiputra.grafika2@email.com', 'telepon' => '081234567020', 'status' => 'accepted', 'job_index' => 1],
            ['nama' => 'Linda Sari Dewi', 'email' => 'linda.sari.grafika2@email.com', 'telepon' => '081234567021', 'status' => 'review', 'job_index' => 1],
            
            // Applicants for Packaging Design Manager (closed job)
            ['nama' => 'Gilang Ramadhan Putra', 'email' => 'gilang.ramadhan.grafika2@email.com', 'telepon' => '081234567022', 'status' => 'accepted', 'job_index' => 2],
            ['nama' => 'Hana Safitri Lestari', 'email' => 'hana.safitri.grafika2@email.com', 'telepon' => '081234567023', 'status' => 'rejected', 'job_index' => 2],
        ];

        foreach ($additionalApplicants as $applicantData) {
            $jobIndex = $applicantData['job_index'];
            unset($applicantData['job_index']);
            
            Pelamar::create([
                'pekerjaan_id' => $jobIds[$jobIndex],
                'cv_path' => 'cv/' . strtolower(str_replace(' ', '_', $applicantData['nama'])) . '_cv.pdf',
                'tanggal_melamar' => now()->subDays(rand(1, 30)),
                ...$applicantData
            ]);
            echo "✅ Created applicant: {$applicantData['nama']} for job ID {$jobIds[$jobIndex]}\n";
        }

        echo "\n🎉 Successfully added 3 additional jobs for Grafika Indonesia!\n";
        echo "Jobs created:\n";
        echo "1. Creative Art Director (Aktif) - 2 applicants\n";
        echo "2. Web Design Specialist (Aktif) - 3 applicants\n";
        echo "3. Packaging Design Manager (Tutup) - 2 applicants\n";
        echo "Total applicants added: " . count($additionalApplicants) . "\n";
        
        // Show updated totals for Grafika
        $totalJobs = Pekerjaan::where('user_id', $grafikaCompany->id)->count();
        $totalApplicants = Pelamar::whereHas('pekerjaan', function($q) use ($grafikaCompany) {
            $q->where('user_id', $grafikaCompany->id);
        })->count();
        
        echo "\nGrafika Indonesia updated totals:\n";
        echo "- Total jobs: {$totalJobs}\n";
        echo "- Total applicants: {$totalApplicants}\n";
    }
}
