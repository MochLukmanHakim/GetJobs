<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pekerjaan;
use App\Models\Pelamar;
use App\Models\User;

class ClosedJobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing company users
        $companies = User::where('role', 'company')->get();
        
        if ($companies->isEmpty()) {
            $this->command->info('No company users found. Please run MultiCompanySeeder first.');
            return;
        }

        foreach ($companies as $company) {
            $this->createClosedJobsForCompany($company);
        }
    }

    private function createClosedJobsForCompany($company)
    {
        // Define job templates based on company type
        $jobTemplates = $this->getJobTemplatesForCompany($company);
        
        foreach ($jobTemplates as $template) {
            // Create the job
            $job = Pekerjaan::create([
                'user_id' => $company->id,
                'judul_pekerjaan' => $template['title'],
                'lokasi_pekerjaan' => $template['location'],
                'gaji_pekerjaan' => $template['salary'],
                'kategori_pekerjaan' => $template['category'],
                'deskripsi_pekerjaan' => $template['description'],
                'jumlah_pelamar_diinginkan' => $template['target_applicants'],
                'status' => 'tutup',
                'tanggal_dibuat' => now()->subDays($template['days_ago']),
                'created_at' => now()->subDays($template['days_ago']),
                'updated_at' => now()->subDays($template['closed_days_ago']),
            ]);

            // Create applicants for this job
            $this->createApplicantsForJob($job, $template);
        }
    }

    private function getJobTemplatesForCompany($company)
    {
        $companyName = strtolower($company->name);
        
        if (strpos($companyName, 'techstart') !== false) {
            return [
                [
                    'title' => 'Senior Full Stack Developer',
                    'location' => 'Jakarta Selatan',
                    'salary' => 'Rp 18.000.000 - Rp 25.000.000',
                    'category' => 'technology',
                    'description' => 'Mengembangkan aplikasi web full stack dengan teknologi modern React, Node.js, dan PostgreSQL.',
                    'target_applicants' => 8,
                    'total_applicants' => 12,
                    'accepted_count' => 3,
                    'days_ago' => 45,
                    'closed_days_ago' => 10,
                ],
                [
                    'title' => 'DevOps Engineer Senior',
                    'location' => 'Jakarta Pusat',
                    'salary' => 'Rp 20.000.000 - Rp 28.000.000',
                    'category' => 'technology',
                    'description' => 'Mengelola infrastruktur cloud, CI/CD pipeline, dan monitoring sistem production.',
                    'target_applicants' => 5,
                    'total_applicants' => 8,
                    'accepted_count' => 2,
                    'days_ago' => 60,
                    'closed_days_ago' => 20,
                ],
                [
                    'title' => 'Mobile App Developer',
                    'location' => 'Jakarta Selatan',
                    'salary' => 'Rp 15.000.000 - Rp 22.000.000',
                    'category' => 'technology',
                    'description' => 'Mengembangkan aplikasi mobile iOS dan Android menggunakan React Native atau Flutter.',
                    'target_applicants' => 6,
                    'total_applicants' => 10,
                    'accepted_count' => 2,
                    'days_ago' => 30,
                    'closed_days_ago' => 5,
                ],
            ];
        } elseif (strpos($companyName, 'creative') !== false) {
            return [
                [
                    'title' => 'Senior UI UX Designer',
                    'location' => 'Bandung',
                    'salary' => 'Rp 12.000.000 - Rp 18.000.000',
                    'category' => 'design',
                    'description' => 'Merancang user interface dan user experience untuk aplikasi web dan mobile dengan pendekatan user-centered design.',
                    'target_applicants' => 6,
                    'total_applicants' => 9,
                    'accepted_count' => 2,
                    'days_ago' => 40,
                    'closed_days_ago' => 8,
                ],
                [
                    'title' => 'Motion Graphics Designer',
                    'location' => 'Bandung',
                    'salary' => 'Rp 10.000.000 - Rp 15.000.000',
                    'category' => 'design',
                    'description' => 'Membuat animasi dan motion graphics untuk konten digital, video promosi, dan presentasi klien.',
                    'target_applicants' => 4,
                    'total_applicants' => 7,
                    'accepted_count' => 2,
                    'days_ago' => 35,
                    'closed_days_ago' => 12,
                ],
                [
                    'title' => 'Brand Identity Designer',
                    'location' => 'Bandung',
                    'salary' => 'Rp 9.000.000 - Rp 14.000.000',
                    'category' => 'design',
                    'description' => 'Mengembangkan identitas visual brand, logo, dan guideline design untuk berbagai klien korporat.',
                    'target_applicants' => 5,
                    'total_applicants' => 8,
                    'accepted_count' => 2,
                    'days_ago' => 50,
                    'closed_days_ago' => 15,
                ],
            ];
        } elseif (strpos($companyName, 'finance') !== false) {
            return [
                [
                    'title' => 'Senior Financial Analyst',
                    'location' => 'Jakarta Pusat',
                    'salary' => 'Rp 15.000.000 - Rp 22.000.000',
                    'category' => 'finance',
                    'description' => 'Melakukan analisis keuangan mendalam, perencanaan budget, dan risk assessment untuk investasi perusahaan.',
                    'target_applicants' => 4,
                    'total_applicants' => 6,
                    'accepted_count' => 2,
                    'days_ago' => 55,
                    'closed_days_ago' => 18,
                ],
                [
                    'title' => 'Portfolio Manager Senior',
                    'location' => 'Jakarta Pusat',
                    'salary' => 'Rp 25.000.000 - Rp 35.000.000',
                    'category' => 'finance',
                    'description' => 'Mengelola portfolio investasi klien, analisis pasar keuangan, dan strategi investasi jangka panjang.',
                    'target_applicants' => 3,
                    'total_applicants' => 5,
                    'accepted_count' => 1,
                    'days_ago' => 70,
                    'closed_days_ago' => 25,
                ],
            ];
        } else {
            // Default untuk perusahaan lain termasuk Grafika Indonesia
            return [
                [
                    'title' => 'Graphic Designer Senior',
                    'location' => 'Jakarta Barat',
                    'salary' => 'Rp 8.000.000 - Rp 12.000.000',
                    'category' => 'design',
                    'description' => 'Membuat desain grafis untuk berbagai media cetak dan digital, termasuk branding, packaging, dan advertising materials.',
                    'target_applicants' => 6,
                    'total_applicants' => 8,
                    'accepted_count' => 2,
                    'days_ago' => 42,
                    'closed_days_ago' => 7,
                ],
                [
                    'title' => 'Creative Director Assistant',
                    'location' => 'Jakarta Barat',
                    'salary' => 'Rp 10.000.000 - Rp 15.000.000',
                    'category' => 'design',
                    'description' => 'Membantu creative director dalam mengembangkan konsep kreatif, koordinasi tim design, dan quality control project.',
                    'target_applicants' => 4,
                    'total_applicants' => 6,
                    'accepted_count' => 1,
                    'days_ago' => 38,
                    'closed_days_ago' => 10,
                ],
                [
                    'title' => 'Print Production Specialist',
                    'location' => 'Jakarta Barat',
                    'salary' => 'Rp 7.000.000 - Rp 10.000.000',
                    'category' => 'design',
                    'description' => 'Mengelola proses produksi cetak, quality control, dan koordinasi dengan vendor printing untuk berbagai project klien.',
                    'target_applicants' => 5,
                    'total_applicants' => 7,
                    'accepted_count' => 2,
                    'days_ago' => 33,
                    'closed_days_ago' => 5,
                ],
            ];
        }
    }

    private function createApplicantsForJob($job, $template)
    {
        $applicantNames = [
            'Andi Pratama', 'Sari Dewi', 'Budi Santoso', 'Maya Sari', 'Dika Pratama',
            'Rizki Maulana', 'Fitri Handayani', 'Joko Widodo', 'Rina Sari', 'Dimas Prasetyo',
            'Lestari Putri', 'Bambang Sutrisno', 'Dewi Kartika', 'Ahmad Rizki', 'Siti Nurhaliza',
            'Indra Gunawan', 'Andi Kurniawan', 'Putri Sari', 'Rudi Hermawan', 'Novi Astuti'
        ];

        $emails = [
            'andi.pratama@email.com', 'sari.dewi@email.com', 'budi.santoso@email.com', 
            'maya.sari@email.com', 'dika.pratama@email.com', 'rizki.maulana@email.com',
            'fitri.handayani@email.com', 'joko.widodo@email.com', 'rina.sari@email.com',
            'dimas.prasetyo@email.com', 'lestari.putri@email.com', 'bambang.sutrisno@email.com',
            'dewi.kartika@email.com', 'ahmad.rizki@email.com', 'siti.nurhaliza@email.com',
            'indra.gunawan@email.com', 'andi.kurniawan@email.com', 'putri.sari@email.com',
            'rudi.hermawan@email.com', 'novi.astuti@email.com'
        ];

        $phones = [
            '081234567890', '081234567891', '081234567892', '081234567893', '081234567894',
            '081234567895', '081234567896', '081234567897', '081234567898', '081234567899',
            '081234567800', '081234567801', '081234567802', '081234567803', '081234567804',
            '081234567805', '081234567806', '081234567807', '081234567808', '081234567809'
        ];

        // Create total applicants
        for ($i = 0; $i < $template['total_applicants']; $i++) {
            $status = 'rejected'; // Default status
            
            // Set accepted status for first N applicants
            if ($i < $template['accepted_count']) {
                $status = 'accepted';
            } elseif ($i < $template['accepted_count'] + 2) {
                $status = 'review'; // Some in review
            }

            $uniqueEmail = str_replace('@email.com', '_' . $job->id_pekerjaan . '_' . $i . '@email.com', $emails[$i % count($emails)]);
            
            Pelamar::create([
                'pekerjaan_id' => $job->id_pekerjaan,
                'nama' => $applicantNames[$i % count($applicantNames)],
                'email' => $uniqueEmail,
                'telepon' => $phones[$i % count($phones)],
                'cv_path' => 'uploads/cv/sample-cv.pdf',
                'status' => $status,
                'tanggal_melamar' => now()->subDays($template['days_ago'] - rand(1, 10)),
                'created_at' => now()->subDays($template['days_ago'] - rand(1, 10)),
                'updated_at' => $status === 'accepted' ? now()->subDays($template['closed_days_ago'] + rand(1, 5)) : now()->subDays(rand(1, $template['closed_days_ago'])),
            ]);
        }

        $this->command->info("Created {$template['total_applicants']} applicants for job: {$template['title']} (Company: {$job->user->name})");
    }
}
