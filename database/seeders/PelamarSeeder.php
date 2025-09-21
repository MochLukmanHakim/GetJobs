<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelamar;
use App\Models\Pekerjaan;
use Carbon\Carbon;

class PelamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all available jobs
        $pekerjaans = Pekerjaan::all();
        
        if ($pekerjaans->isEmpty()) {
            $this->command->warn('No jobs found. Please run PekerjaanSeeder first.');
            return;
        }

        $pelamars = [
            [
                'nama' => 'Ahmad Rizki Pratama',
                'email' => 'ahmad.rizki@email.com',
                'telepon' => '081234567890',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'review',
                'pengumuman_status' => 'none',
                'catatan' => null,
                'tanggal_melamar' => Carbon::now()->subDays(2),
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@email.com',
                'telepon' => '081234567891',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'accepted',
                'pengumuman_status' => 'interview',
                'catatan' => 'Interview dijadwalkan untuk Senin, 16 September 2024 pukul 10:00 WIB',
                'tanggal_melamar' => Carbon::now()->subDays(5),
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'telepon' => '081234567892',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'rejected',
                'pengumuman_status' => 'completed',
                'catatan' => 'Terima kasih atas minat Anda. Saat ini posisi sudah terisi.',
                'tanggal_melamar' => Carbon::now()->subDays(7),
            ],
            [
                'nama' => 'Diana Putri',
                'email' => 'diana.putri@email.com',
                'telepon' => '081234567893',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'review',
                'pengumuman_status' => 'test',
                'catatan' => 'Silakan mengerjakan tes online yang telah dikirim ke email Anda',
                'tanggal_melamar' => Carbon::now()->subDays(1),
            ],
            [
                'nama' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@email.com',
                'telepon' => '081234567894',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'accepted',
                'pengumuman_status' => 'document',
                'catatan' => 'Mohon melengkapi dokumen persyaratan yang telah dikirim',
                'tanggal_melamar' => Carbon::now()->subDays(3),
            ],
            [
                'nama' => 'Fitri Handayani',
                'email' => 'fitri.handayani@email.com',
                'telepon' => '081234567895',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'review',
                'pengumuman_status' => 'phone',
                'catatan' => 'Tim HR akan menghubungi Anda untuk wawancara telepon',
                'tanggal_melamar' => Carbon::now()->subDays(4),
            ],
            [
                'nama' => 'Gilang Ramadhan',
                'email' => 'gilang.ramadhan@email.com',
                'telepon' => '081234567896',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'review',
                'pengumuman_status' => 'pending',
                'catatan' => 'Aplikasi sedang dalam tahap review oleh tim teknis',
                'tanggal_melamar' => Carbon::now()->subDays(6),
            ],
            [
                'nama' => 'Hana Safitri',
                'email' => 'hana.safitri@email.com',
                'telepon' => '081234567897',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'accepted',
                'pengumuman_status' => 'completed',
                'catatan' => 'Selamat! Anda diterima sebagai karyawan. Orientasi dimulai Senin depan.',
                'tanggal_melamar' => Carbon::now()->subDays(10),
            ],
            [
                'nama' => 'Ivan Kurniawan',
                'email' => 'ivan.kurniawan@email.com',
                'telepon' => '081234567898',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'review',
                'pengumuman_status' => 'none',
                'catatan' => null,
                'tanggal_melamar' => Carbon::now()->subHours(12),
            ],
            [
                'nama' => 'Julia Maharani',
                'email' => 'julia.maharani@email.com',
                'telepon' => '081234567899',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'rejected',
                'pengumuman_status' => 'completed',
                'catatan' => 'Kualifikasi tidak sesuai dengan kebutuhan posisi saat ini',
                'tanggal_melamar' => Carbon::now()->subDays(8),
            ],
            [
                'nama' => 'Kevin Adiputra',
                'email' => 'kevin.adiputra@email.com',
                'telepon' => '081234567800',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'review',
                'pengumuman_status' => 'interview',
                'catatan' => 'Interview tahap 2 dijadwalkan dengan manager divisi',
                'tanggal_melamar' => Carbon::now()->subDays(9),
            ],
            [
                'nama' => 'Linda Sari',
                'email' => 'linda.sari@email.com',
                'telepon' => '081234567801',
                'cv_path' => 'cv_files/sample-cv.pdf',
                'status' => 'accepted',
                'pengumuman_status' => 'document',
                'catatan' => 'Menunggu verifikasi dokumen dari bagian legal',
                'tanggal_melamar' => Carbon::now()->subDays(11),
            ],
        ];

        // Distribute applicants evenly across all 7 jobs
        $totalJobs = $pekerjaans->count();
        $totalApplicants = count($pelamars);
        
        foreach ($pelamars as $index => $pelamarData) {
            // Distribute evenly by using modulo to cycle through jobs
            $jobIndex = $index % $totalJobs;
            $assignedJob = $pekerjaans->values()[$jobIndex];
            $pelamarData['pekerjaan_id'] = $assignedJob->id_pekerjaan;
            
            Pelamar::create($pelamarData);
        }

        $this->command->info('Pelamar seeder completed successfully!');
    }
}
