<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = auth('pelamar')->user();
        Log::info('Session user:', [$user]);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        // Data dummy untuk testing
        $riwayat = [
            (object) [
                'judul'   => 'Junior UI/UX',
                'posisi'  => 'Teknologi',
                'cv'      => 'Moch.pdf',
                'tanggal' => '17 Agustus 2025',
                'status'  => 'Diterima'
            ],
            (object) [
                'judul'   => 'HRD Tambang',
                'posisi'  => 'Bisnis',
                'cv'      => 'Moch.pdf',
                'tanggal' => '17 Agustus 2025',
                'status'  => 'Diterima'
            ],
            (object) [
                'judul'   => 'Chef Dapur',
                'posisi'  => 'Makanan',
                'cv'      => 'Moch.pdf',
                'tanggal' => '17 Agustus 2025',
                'status'  => 'Tidak Lolos'
            ],
        ];

        // kirim data ke view
        return view('riwayat', compact('riwayat'));
    }
}
