<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara agar bisa menemukan pekerjaan sesuai skillku?',
                'answer'   => 'Gunakan filter pencarian di GetJobs berdasarkan kategori, lokasi, level pengalaman, dan kata kunci yang relevan dengan kemampuan Anda.'
            ],
            [
                'question' => 'Bagaimana cara membuat akun di GetJobs?',
                'answer'   => 'Anda dapat membuat akun dengan mendaftar menggunakan email aktif, lalu melengkapi data profil dan CV Anda.'
            ],
            [
                'question' => 'Apakah aku harus mengunggah CV untuk menggunakan GetJobs?',
                'answer'   => 'Tidak wajib, tetapi sangat disarankan agar peluang Anda dilihat perusahaan lebih besar.'
            ],
            [
                'question' => 'Apakah hanya perusahaan yang bisa membagikan lowongan?',
                'answer'   => 'Ya, hanya akun perusahaan yang diverifikasi dapat mengunggah lowongan kerja di platform GetJobs.'
            ],
        ];

        return view('faq', compact('faqs'));
    }
}
