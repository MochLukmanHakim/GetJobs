<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad.rizki@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'userType' => 'perusahaan',
        ]);
        User::create([
            'name' => 'manmanman',
            'email' => 'man@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'userType' => 'perusahaan',
        ]);
        User::create([
            'name' => 'Lukman Hakim',
            'email' => 'lukman@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'userType' => 'perusahaan',
        ]);
    }
} 