<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit()
    {
        return view('profil'); // ini mengarah ke resources/views/profil.blade.php
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
        ]);

        // contoh simpan (kalau ada model User)
        // auth()->user()->update([
        //     'first_name' => $request->first_name,
        //     'last_name'  => $request->last_name,
        //     'email'      => $request->email,
        //     'phone'      => $request->phone,
        // ]);

        return redirect()->route('profil.edit')->with('success', 'Data berhasil disimpan!');
    }
}
