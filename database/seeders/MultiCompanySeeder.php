<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pekerjaan;
use App\Models\Pelamar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MultiCompanySeeder extends Seeder
{
    public function run(): void
    {
        // Create Company 1: Tech Startup
        $techCompany = User::create([
            'name' => 'TechStart Indonesia',
            'email' => 'hr@techstart.id',
            'password' => Hash::make('password123'),
            'phone' => '081234567890',
            'role' => 'company',
            'userType' => 'perusahaan',
        ]);

        // Create Company 2: Creative Agency
        $creativeCompany = User::create([
            'name' => 'Creative Minds Agency',
            'email' => 'hr@creativeminds.co.id',
            'password' => Hash::make('password123'),
            'phone' => '081234567891',
            'role' => 'company',
            'userType' => 'perusahaan',
        ]);

        // Create Company 3: Finance Corp
        $financeCompany = User::create([
            'name' => 'FinanceCorp Solutions',
            'email' => 'hr@financecorp.id',
            'password' => Hash::make('password123'),
            'phone' => '081234567892',
            'role' => 'company',
            'userType' => 'perusahaan',
        ]);

        // Create Company 4: Grafika Indonesia
        $grafikaCompany = User::create([
            'name' => 'Grafika Indonesia',
            'email' => 'grf@gmail.com',
            'password' => Hash::make('123'),
            'phone' => '081234567893',
            'role' => 'company',
            'userType' => 'perusahaan',
        ]);

        // Jobs for Tech Company
        $techJobs = [
            [
                'judul_pekerjaan' => 'Senior Full Stack Developer',
                'lokasi_pekerjaan' => 'Jakarta Selatan',
                'gaji_pekerjaan' => 'Rp 15.000.000 - Rp 20.000.000',
                'kategori_pekerjaan' => 'technology',
                'deskripsi_pekerjaan' => 'Mengembangkan aplikasi web full stack dengan teknologi modern.',
                'jumlah_pelamar_diinginkan' => 3,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'DevOps Engineer Specialist',
                'lokasi_pekerjaan' => 'Jakarta Pusat',
                'gaji_pekerjaan' => 'Rp 12.000.000 - Rp 18.000.000',
                'kategori_pekerjaan' => 'technology',
                'deskripsi_pekerjaan' => 'Mengelola infrastruktur cloud dan CI/CD pipeline.',
                'jumlah_pelamar_diinginkan' => 2,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'Mobile App Developer',
                'lokasi_pekerjaan' => 'Jakarta Selatan',
                'gaji_pekerjaan' => 'Rp 10.000.000 - Rp 15.000.000',
                'kategori_pekerjaan' => 'technology',
                'deskripsi_pekerjaan' => 'Mengembangkan aplikasi mobile iOS dan Android.',
                'jumlah_pelamar_diinginkan' => 4,
                'status' => 'tutup',
            ],
        ];

        // Jobs for Creative Company
        $creativeJobs = [
            [
                'judul_pekerjaan' => 'Senior UI UX Designer',
                'lokasi_pekerjaan' => 'Bandung',
                'gaji_pekerjaan' => 'Rp 8.000.000 - Rp 12.000.000',
                'kategori_pekerjaan' => 'design',
                'deskripsi_pekerjaan' => 'Merancang user interface dan user experience yang menarik.',
                'jumlah_pelamar_diinginkan' => 2,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'Motion Graphics Designer',
                'lokasi_pekerjaan' => 'Bandung',
                'gaji_pekerjaan' => 'Rp 7.000.000 - Rp 10.000.000',
                'kategori_pekerjaan' => 'design',
                'deskripsi_pekerjaan' => 'Membuat animasi dan motion graphics untuk berbagai media.',
                'jumlah_pelamar_diinginkan' => 3,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'Brand Identity Designer',
                'lokasi_pekerjaan' => 'Bandung',
                'gaji_pekerjaan' => 'Rp 6.000.000 - Rp 9.000.000',
                'kategori_pekerjaan' => 'design',
                'deskripsi_pekerjaan' => 'Merancang identitas visual dan branding untuk klien.',
                'jumlah_pelamar_diinginkan' => 2,
                'status' => 'tutup',
            ],
        ];

        // Jobs for Finance Company
        $financeJobs = [
            [
                'judul_pekerjaan' => 'Senior Financial Analyst',
                'lokasi_pekerjaan' => 'Surabaya',
                'gaji_pekerjaan' => 'Rp 9.000.000 - Rp 13.000.000',
                'kategori_pekerjaan' => 'finance',
                'deskripsi_pekerjaan' => 'Menganalisis data keuangan dan membuat laporan strategis.',
                'jumlah_pelamar_diinginkan' => 2,
                'status' => 'aktif',
            ],
            [
                'judul_pekerjaan' => 'Investment Portfolio Manager',
                'lokasi_pekerjaan' => 'Surabaya',
                'gaji_pekerjaan' => 'Rp 12.000.000 - Rp 18.000.000',
                'kategori_pekerjaan' => 'finance',
                'deskripsi_pekerjaan' => 'Mengelola portofolio investasi klien dengan strategi optimal.',
                'jumlah_pelamar_diinginkan' => 1,
                'status' => 'aktif',
            ],
        ];

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

        // Create jobs for each company
        $techJobIds = [];
        foreach ($techJobs as $jobData) {
            $job = Pekerjaan::create([
                'user_id' => $techCompany->id,
                'tanggal_dibuat' => now(),
                ...$jobData
            ]);
            $techJobIds[] = $job->id_pekerjaan;
        }

        $creativeJobIds = [];
        foreach ($creativeJobs as $jobData) {
            $job = Pekerjaan::create([
                'user_id' => $creativeCompany->id,
                'tanggal_dibuat' => now(),
                ...$jobData
            ]);
            $creativeJobIds[] = $job->id_pekerjaan;
        }

        $financeJobIds = [];
        foreach ($financeJobs as $jobData) {
            $job = Pekerjaan::create([
                'user_id' => $financeCompany->id,
                'tanggal_dibuat' => now(),
                ...$jobData
            ]);
            $financeJobIds[] = $job->id_pekerjaan;
        }

        $grafikaJobIds = [];
        foreach ($grafikaJobs as $jobData) {
            $job = Pekerjaan::create([
                'user_id' => $grafikaCompany->id,
                'tanggal_dibuat' => now(),
                ...$jobData
            ]);
            $grafikaJobIds[] = $job->id_pekerjaan;
        }

        // Create applicants for Tech Company jobs
        $techApplicants = [
            ['nama' => 'Ahmad Rizki Pratama', 'email' => 'ahmad.rizki.tech@email.com', 'telepon' => '081234567001', 'status' => 'review'],
            ['nama' => 'Siti Nurhaliza Dewi', 'email' => 'siti.nurhaliza.tech@email.com', 'telepon' => '081234567002', 'status' => 'accepted'],
            ['nama' => 'Budi Santoso Wijaya', 'email' => 'budi.santoso.tech@email.com', 'telepon' => '081234567003', 'status' => 'review'],
            ['nama' => 'Rina Sari Indah', 'email' => 'rina.sari.tech@email.com', 'telepon' => '081234567004', 'status' => 'accepted'],
            ['nama' => 'Dimas Prasetyo Adi', 'email' => 'dimas.prasetyo.tech@email.com', 'telepon' => '081234567005', 'status' => 'accepted'],
        ];

        foreach ($techApplicants as $index => $applicantData) {
            Pelamar::create([
                'pekerjaan_id' => $techJobIds[$index % count($techJobIds)],
                'cv_path' => 'cv/' . strtolower(str_replace(' ', '_', $applicantData['nama'])) . '_cv.pdf',
                'tanggal_melamar' => now()->subDays(rand(1, 30)),
                ...$applicantData
            ]);
        }

        // Create applicants for Creative Company jobs
        $creativeApplicants = [
            ['nama' => 'Maya Sari Putri', 'email' => 'maya.sari.creative@email.com', 'telepon' => '081234567006', 'status' => 'review'],
            ['nama' => 'Joko Widodo Santoso', 'email' => 'joko.widodo.creative@email.com', 'telepon' => '081234567007', 'status' => 'accepted'],
            ['nama' => 'Fitri Handayani Lestari', 'email' => 'fitri.handayani.creative@email.com', 'telepon' => '081234567008', 'status' => 'review'],
            ['nama' => 'Andi Kurniawan Putra', 'email' => 'andi.kurniawan.creative@email.com', 'telepon' => '081234567009', 'status' => 'accepted'],
        ];

        foreach ($creativeApplicants as $index => $applicantData) {
            Pelamar::create([
                'pekerjaan_id' => $creativeJobIds[$index % count($creativeJobIds)],
                'cv_path' => 'cv/' . strtolower(str_replace(' ', '_', $applicantData['nama'])) . '_cv.pdf',
                'tanggal_melamar' => now()->subDays(rand(1, 30)),
                ...$applicantData
            ]);
        }

        // Create applicants for Finance Company jobs
        $financeApplicants = [
            ['nama' => 'Indra Gunawan Saputra', 'email' => 'indra.gunawan.finance@email.com', 'telepon' => '081234567010', 'status' => 'review'],
            ['nama' => 'Dewi Kartika Sari', 'email' => 'dewi.kartika.finance@email.com', 'telepon' => '081234567011', 'status' => 'accepted'],
            ['nama' => 'Bambang Sutrisno Adi', 'email' => 'bambang.sutrisno.finance@email.com', 'telepon' => '081234567012', 'status' => 'review'],
        ];

        foreach ($financeApplicants as $index => $applicantData) {
            Pelamar::create([
                'pekerjaan_id' => $financeJobIds[$index % count($financeJobIds)],
                'cv_path' => 'cv/' . strtolower(str_replace(' ', '_', $applicantData['nama'])) . '_cv.pdf',
                'tanggal_melamar' => now()->subDays(rand(1, 30)),
                ...$applicantData
            ]);
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

        echo "Multi-company data seeded successfully!\n";
        echo "Companies created:\n";
        echo "1. TechStart Indonesia (ID: {$techCompany->id}) - hr@techstart.id\n";
        echo "2. Creative Minds Agency (ID: {$creativeCompany->id}) - hr@creativeminds.co.id\n";
        echo "3. FinanceCorp Solutions (ID: {$financeCompany->id}) - hr@financecorp.id\n";
        echo "4. Grafika Indonesia (ID: {$grafikaCompany->id}) - grf@gmail.com\n";
        echo "Password: password123 (except Grafika Indonesia: 123)\n";
    }
}
