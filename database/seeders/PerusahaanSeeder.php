<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perusahaan;
use App\Models\User;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dengan userType 'perusahaan'
        $users = User::where('userType', 'perusahaan')->get();

        foreach ($users as $user) {
            // Cek apakah sudah ada data perusahaan untuk user ini
            $existingPerusahaan = Perusahaan::where('id_user', $user->id)->first();
            
            if (!$existingPerusahaan) {
                Perusahaan::create([
                    'id_user' => $user->id,
                    'nama_perusahaan' => 'PT. ' . $user->name,
                    'deskripsi_perusahaan' => 'Perusahaan ' . $user->name . ' adalah perusahaan yang bergerak di berbagai bidang industri.',
                    'no_telp_perusahaan' => '021-' . rand(10000000, 99999999),
                    'bidang_industri' => 'Teknologi Informasi',
                    'alamat_perusahaan' => 'Jl. ' . $user->name . ' No. ' . rand(1, 999) . ', Jakarta',
                ]);
            }
        }
    }
}
