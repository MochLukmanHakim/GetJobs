<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabelController extends Controller
{
    public function index()
    {
        // Data dummy untuk testing
        $lamarans = [
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
                'status'  => 'Diterima'
            ],
        ];

        // arahkan ke resources/views/tabel.blade.php
        return view('tabel', compact('lamarans'));
    }
}
