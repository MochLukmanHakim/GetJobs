<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PelamarController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|string|max:20',
        ]);

        // simpan ke tabel users
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelamar',
        ]);

        // simpan ke tabel pelamar
        Pelamar::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => 'pelamar',
        ]);

        // login langsung setelah daftar
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
}
