<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Tampilkan halaman form registrasi
     */
    public function showForm()
    {
        return view('register'); // ganti 'register' kalau nama blade beda
    }

    /**
     * Proses registrasi user
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6', 
            'phone'    => 'required|string|max:20',
            'role'     => 'required|in:pelamar,perusahaan',
        ]);

        // Buat user baru
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone'    => $validated['phone'],
            'role'     => $validated['role'],
        ]);

     

        // Redirect ke halaman landing (/)
      // Redirect ke login page
return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');

    }
}
