<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaan = Pekerjaan::all();
        return view('pekerjaan', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pekerjaan' => 'required|string|max:255',
            'lokasi_pekerjaan' => 'required|string|max:255',
            'gaji_pekerjaan' => 'required|string|max:255',
            'kategori_pekerjaan' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'nullable|string',
        ]);

        Pekerjaan::create([
            'user_id' => 1, // Temporary user ID
            'judul_pekerjaan' => $request->judul_pekerjaan,
            'lokasi_pekerjaan' => $request->lokasi_pekerjaan,
            'gaji_pekerjaan' => $request->gaji_pekerjaan,
            'kategori_pekerjaan' => $request->kategori_pekerjaan,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'status' => 'draft',
            'tanggal_dibuat' => now(),
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        
        $request->validate([
            'judul_pekerjaan' => 'required|string|max:255',
            'lokasi_pekerjaan' => 'required|string|max:255',
            'gaji_pekerjaan' => 'required|string|max:255',
            'kategori_pekerjaan' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'nullable|string',
            'status' => 'required|in:draft,aktif,tutup',
        ]);

        $pekerjaan->update($request->all());

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->delete();

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil dihapus!');
    }
} 