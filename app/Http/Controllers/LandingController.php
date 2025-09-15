<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // data dummy – nanti bisa diganti query DB
        $locations = ['Semua Lokasi','Jakarta','Bandung','Surabaya','Yogyakarta','Remote'];
        $categories = ['Semua','IT','Design','Marketing','Finance','HR','Sales','Data'];
        $chips = ['Full-time','Part-time','Internship','Remote','On-site','Hybrid'];

        $jobs = [
            [
                'company_logo' => 'https://dummyimage.com/56x56/ddd/000.png&text=GJ',
                'company' => 'PT Maju Jaya',
                'title' => 'Backend Developer',
                'location' => 'Jakarta',
                'type' => 'On-site',
                'category' => 'IT',
                'salary' => '6–10 jt',
                'posted' => '2 hari lalu'
            ],
            [
                'company_logo' => 'https://dummyimage.com/56x56/ddd/000.png&text=UX',
                'company' => 'Studio Visual',
                'title' => 'UI/UX Designer',
                'location' => 'Remote',
                'type' => 'Remote',
                'category' => 'Design',
                'salary' => '5–9 jt',
                'posted' => '1 hari lalu'
            ],
            [
                'company_logo' => 'https://dummyimage.com/56x56/ddd/000.png&text=MK',
                'company' => 'GrowMore',
                'title' => 'Digital Marketer',
                'location' => 'Bandung',
                'type' => 'Hybrid',
                'category' => 'Marketing',
                'salary' => '4–7 jt',
                'posted' => '3 hari lalu'
            ],
            [
                'company_logo' => 'https://dummyimage.com/56x56/ddd/000.png&text=DA',
                'company' => 'DataSense',
                'title' => 'Data Analyst',
                'location' => 'Remote',
                'type' => 'Remote',
                'category' => 'Data',
                'salary' => '8–14 jt',
                'posted' => 'Hari ini'
            ],
        ];

        $testimonials = [
            ['name'=>'Rani','role'=>'UI Designer','avatar'=>'https://randomuser.me/api/portraits/women/65.jpg','text'=>'Dapet kerja pertama lewat GetJobs! Fiturnya beneran ngebantu.'],
            ['name'=>'Andi','role'=>'Backend Dev','avatar'=>'https://randomuser.me/api/portraits/men/32.jpg','text'=>'Filter & notifikasi lowongannya pas sasaran.'],
            ['name'=>'Sinta','role'=>'HR Recruiter','avatar'=>'https://randomuser.me/api/portraits/women/72.jpg','text'=>'Posting pekerjaan mudah, pelamar rapi dan terorganisir.'],
        ];

        return view('landing', compact('locations','categories','chips','jobs','testimonials'));
    }
}
