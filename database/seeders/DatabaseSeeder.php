<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan Seeder
        $this->call([
            UserSeeder::class,
            PekerjaanSeeder::class,
            PerusahaanSeeder::class,
            PelamarSeeder::class,
            MultiCompanySeeder::class, // Add multi-company data
            ClosedJobsSeeder::class, // Add closed jobs with real applicants data
        ]);
    }
}
