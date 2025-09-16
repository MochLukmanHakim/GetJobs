<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah.');
        }

        Auth::login($user);

        // Arahkan berdasarkan jenis pengguna
        if ($user->role === 'pelamar') {
            return redirect()->route('pelamar.dashboard');
        } elseif ($user->role === 'perusahaan') {
            return redirect()->route('perusahaan.dashboard');
        } else {
            return redirect()->route('findjob');
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
