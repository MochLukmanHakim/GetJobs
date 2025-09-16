<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FindJobController extends Controller
{
    public function index()
    {
        // Sementara statis, nanti bisa diambil dari database (Job model)
        $jobs = [
            [
                'title' => 'Admin Operation Cabang Surabaya',
                'company' => 'PT. Operation Cabang Surabaya',
                'location' => 'Jl.Tanimbar No.22, Tanjinan, Malang',
                'category' => 'Business (Administrasi & Dukungan Perkantoran)',
                'salary' => 'Rp 4.000.000 - Rp 4.800.000',
                'type' => 'Full time',
                'posted' => '2 jam yang lalu',
            ],
        ];

        return view('findjob', compact('jobs'));
    }
}
