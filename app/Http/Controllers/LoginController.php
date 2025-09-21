<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelamar;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cari user berdasarkan email
        $pelamar = Pelamar::where('email', $credentials['email'])->first();

        // Jika user tidak ditemukan atau password salah
        if (!$pelamar || !Hash::check($credentials['password'], $pelamar->password)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        // Login pakai guard "pelamar"
        Auth::guard('pelamar')->login($pelamar);
        $request->session()->regenerate();

        // Redirect ke profil setelah login
        return redirect()->route('profil');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
    Auth::guard('pelamar')->logout();

    // Hapus session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('landing');
    }
}
