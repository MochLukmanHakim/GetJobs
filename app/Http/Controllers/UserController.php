<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\Pekerjaan;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function signup(){
        return view('registration');
    }

    public function logincheck(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(Auth::attempt($credentials)){ 
            return redirect()->route('dashboard');
        }
        
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function registercheck(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Hash password dan set userType
        $validation['password'] = bcrypt($validation['password']);
        $validation['userType'] = 'user';

        $user = User::create($validation);
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function godashboard(){
        if(Auth::check() && Auth::user()->userType== 'admin'){
            return view('admin.dashboard');
        }
        else if(Auth::check() && Auth::user()->userType== 'perusahaan'){
            // Create dummy closed jobs data if no closed jobs exist
            $closedJobs = Pekerjaan::where('status', 'ditutup')->orderBy('created_at', 'desc')->take(5)->get();
            
            if($closedJobs->isEmpty()) {
                $pekerjaan = collect([
                    (object)[
                        'id_pekerjaan' => 1,
                        'judul_pekerjaan' => 'Senior Frontend Developer',
                        'lokasi_pekerjaan' => 'Jakarta Selatan',
                        'gaji_pekerjaan' => 'Rp 12.000.000 - Rp 18.000.000',
                        'kategori_pekerjaan' => 'IT & Software',
                        'deskripsi_pekerjaan' => 'Mencari frontend developer berpengalaman dengan React.js',
                        'batas_waktu_pekerjaan' => now()->subDays(10),
                        'jumlah_pelamar_diinginkan' => 8,
                        'status' => 'ditutup',
                        'created_at' => now()->subDays(15),
                        'tanggal_dibuat' => now()->subDays(15)
                    ],
                    (object)[
                        'id_pekerjaan' => 2,
                        'judul_pekerjaan' => 'UI/UX Designer',
                        'lokasi_pekerjaan' => 'Bandung',
                        'gaji_pekerjaan' => 'Rp 8.000.000 - Rp 12.000.000',
                        'kategori_pekerjaan' => 'Design',
                        'deskripsi_pekerjaan' => 'Desainer UI/UX untuk aplikasi mobile dan web',
                        'batas_waktu_pekerjaan' => now()->subDays(5),
                        'jumlah_pelamar_diinginkan' => 6,
                        'status' => 'ditutup',
                        'created_at' => now()->subDays(12),
                        'tanggal_dibuat' => now()->subDays(12)
                    ],
                    (object)[
                        'id_pekerjaan' => 3,
                        'judul_pekerjaan' => 'Backend Developer',
                        'lokasi_pekerjaan' => 'Jakarta Pusat',
                        'gaji_pekerjaan' => 'Rp 10.000.000 - Rp 15.000.000',
                        'kategori_pekerjaan' => 'IT & Software',
                        'deskripsi_pekerjaan' => 'Developer backend dengan keahlian Node.js dan PostgreSQL',
                        'batas_waktu_pekerjaan' => now()->subDays(8),
                        'jumlah_pelamar_diinginkan' => 10,
                        'status' => 'ditutup',
                        'created_at' => now()->subDays(18),
                        'tanggal_dibuat' => now()->subDays(18)
                    ],
                    (object)[
                        'id_pekerjaan' => 4,
                        'judul_pekerjaan' => 'Data Analyst',
                        'lokasi_pekerjaan' => 'Surabaya',
                        'gaji_pekerjaan' => 'Rp 7.000.000 - Rp 11.000.000',
                        'kategori_pekerjaan' => 'Data & Analytics',
                        'deskripsi_pekerjaan' => 'Analisis data untuk mendukung keputusan bisnis',
                        'batas_waktu_pekerjaan' => now()->subDays(3),
                        'jumlah_pelamar_diinginkan' => 4,
                        'status' => 'ditutup',
                        'created_at' => now()->subDays(20),
                        'tanggal_dibuat' => now()->subDays(20)
                    ],
                    (object)[
                        'id_pekerjaan' => 5,
                        'judul_pekerjaan' => 'DevOps Engineer',
                        'lokasi_pekerjaan' => 'Jakarta Barat',
                        'gaji_pekerjaan' => 'Rp 13.000.000 - Rp 20.000.000',
                        'kategori_pekerjaan' => 'IT & Software',
                        'deskripsi_pekerjaan' => 'Mengelola infrastruktur cloud dan deployment automation',
                        'batas_waktu_pekerjaan' => now()->subDays(7),
                        'jumlah_pelamar_diinginkan' => 7,
                        'status' => 'ditutup',
                        'created_at' => now()->subDays(25),
                        'tanggal_dibuat' => now()->subDays(25)
                    ]
                ]);
            } else {
                $pekerjaan = $closedJobs;
            }
            
            // Create dummy accepted applicants data
            $applicants = collect([
                [
                    'id' => 1,
                    'name' => 'Ahmad Rizki Pratama',
                    'avatar' => 'AR',
                    'status' => 'accepted',
                    'email' => 'ahmad.rizki@email.com',
                    'position' => 'Frontend Developer',
                    'created_at' => now()->subDays(5),
                    'last_announcement' => 'Anda akan interview pada Senin, 16 September 2024 pukul 10:00 WIB'
                ],
                [
                    'id' => 2,
                    'name' => 'Siti Nurhaliza',
                    'avatar' => 'SN',
                    'status' => 'accepted',
                    'email' => 'siti.nurhaliza@email.com',
                    'position' => 'UI/UX Designer',
                    'created_at' => now()->subDays(3),
                    'last_announcement' => 'Selamat! Anda diterima untuk posisi UI/UX Designer'
                ],
                [
                    'id' => 3,
                    'name' => 'Budi Santoso',
                    'avatar' => 'BS',
                    'status' => 'accepted',
                    'email' => 'budi.santoso@email.com',
                    'position' => 'Backend Developer',
                    'created_at' => now()->subDays(2),
                    'last_announcement' => 'Anda akan tes teknis pada Rabu, 18 September 2024 pukul 14:00 WIB'
                ],
                [
                    'id' => 4,
                    'name' => 'Fitri Handayani',
                    'avatar' => 'FH',
                    'status' => 'accepted',
                    'email' => 'fitri.handayani@email.com',
                    'position' => 'Data Analyst',
                    'created_at' => now()->subDays(1),
                    'last_announcement' => 'Anda akan onboarding pada Jumat, 20 September 2024 pukul 09:00 WIB'
                ],
                [
                    'id' => 5,
                    'name' => 'Andi Kurniawan',
                    'avatar' => 'AK',
                    'status' => 'accepted',
                    'email' => 'andi.kurniawan@email.com',
                    'position' => 'DevOps Engineer',
                    'created_at' => now()->subDays(6),
                    'last_announcement' => 'Kontrak kerja telah dikirim ke email Anda'
                ],
                [
                    'id' => 6,
                    'name' => 'Dimas Prasetyo',
                    'avatar' => 'DP',
                    'status' => 'rejected',
                    'email' => 'dimas.prasetyo@email.com',
                    'position' => 'Mobile Developer',
                    'created_at' => now()->subDays(4),
                    'last_announcement' => 'Terima kasih atas partisipasi Anda dalam proses rekrutmen'
                ],
                [
                    'id' => 7,
                    'name' => 'Rina Sari',
                    'avatar' => 'RS',
                    'status' => 'pending',
                    'email' => 'rina.sari@email.com',
                    'position' => 'QA Tester',
                    'created_at' => now()->subHours(12),
                    'last_announcement' => 'Lamaran Anda sedang dalam tahap review'
                ]
            ]);
            
            return view('dashboard', compact('pekerjaan', 'applicants'));
        }
        else if(Auth::check() && Auth::user()->userType== 'user'){
            return view('beranda');
        }
        
        return redirect()->route('login');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
