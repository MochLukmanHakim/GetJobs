<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\User; // aktifkan ini
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function showForm()
    {
        return view('register');
    }

    /**
     * Simpan user baru ke DB getjobs
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone'    => 'required|string|max:20',
            'role'     => 'required|in:pelamar,perusahaan,admin',
        ]);

        // 1. Simpan ke tabel users
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        // 2. Simpan ke tabel pelamar (pakai user_id dari tabel users)
        Pelamar::create([
            'user_id'      => $user->id, // relasi ke users
            'nama'         => $validated['name'],
            'email'        => $validated['email'],
            'password'     => Hash::make($validated['password']),
            'phone_number' => $validated['phone'],
            'role'         => $validated['role'],
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
