<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // Tampilkan profil
    public function show()
    {
        $user = auth('pelamar')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        // Ambil data nama, email, dan telepon dari field register
        $foto = $user->foto ?? null;
        $profil = [
            'nama' => $user->nama,
            'email' => $user->email,
            'phone' => $user->phone_number,
            'foto' => $foto,
        ];
        return view('profil', ['profil' => $profil]);
    }

    // Update profil
    public function update(Request $request)
    {
        $user = auth('pelamar')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelamar,email,' . $user->id,
            'phone' => 'required|string|max:20',
        ]);
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'phone_number' => $request->phone,
        ]);
    return redirect()->route('landing')->with('success', 'Profil berhasil diperbarui!');
    }

    // Upload foto profil
    public function updateFoto(Request $request)
    {
        $user = auth('pelamar')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $file = $request->file('foto');
        $folder = storage_path('app/public/profil');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $filename = 'profil_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $filename);
        if (!file_exists($folder . '/' . $filename)) {
            return redirect()->route('profil')->with('error', 'Upload foto gagal, coba lagi.');
        }
        $user->update([
            'foto' => $filename,
        ]);
        return redirect()->route('profil')->with('success', 'Foto profil berhasil diupload!');
    }
}
