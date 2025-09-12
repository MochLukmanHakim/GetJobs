<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaan = Pekerjaan::orderBy('created_at', 'desc')->limit(10)->get();
        
        // Get unique categories from the database - only from jobs that are actually displayed
        $categories = $pekerjaan->pluck('kategori_pekerjaan')
            ->filter(function($category) {
                return !empty($category);
            })
            ->unique()
            ->values()
            ->toArray();
        
        return view('pekerjaan', compact('pekerjaan', 'categories'));
    }

    public function create()
    {
        return view('tambah-pekerjaan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pekerjaan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tipe_pekerjaan' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
            'benefit' => 'nullable|string',
            'batas_lamaran' => 'required|date|after:today',
            'status' => 'required|in:active,inactive,draft',
        ], [
            'judul_pekerjaan.required' => 'Judul pekerjaan wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'tipe_pekerjaan.required' => 'Tipe pekerjaan wajib dipilih.',
            'level.required' => 'Level wajib dipilih.',
            'deskripsi.required' => 'Deskripsi pekerjaan wajib diisi.',
            'persyaratan.required' => 'Persyaratan wajib diisi.',
            'batas_lamaran.required' => 'Batas waktu lamaran wajib diisi.',
            'batas_lamaran.after' => 'Batas waktu lamaran harus setelah hari ini.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        // Format gaji
        $gaji = '';
        if ($request->gaji_min && $request->gaji_max) {
            $gaji = 'Rp ' . number_format($request->gaji_min, 0, ',', '.') . ' - Rp ' . number_format($request->gaji_max, 0, ',', '.');
        } elseif ($request->gaji_min) {
            $gaji = 'Mulai dari Rp ' . number_format($request->gaji_min, 0, ',', '.');
        } else {
            $gaji = 'Negotiable';
        }

        Pekerjaan::create([
            'user_id' => 1, // Temporary user ID
            'judul_pekerjaan' => $request->judul_pekerjaan,
            'lokasi_pekerjaan' => $request->lokasi,
            'gaji_pekerjaan' => $gaji,
            'kategori_pekerjaan' => $request->kategori,
            'deskripsi_pekerjaan' => $request->deskripsi . "\n\nPersyaratan:\n" . $request->persyaratan . 
                                   ($request->benefit ? "\n\nBenefit:\n" . $request->benefit : ''),
            'status' => $request->status,
            'tanggal_dibuat' => now(),
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        
        // Normalize and auto-append category if title only has 2 words
        $title = trim(preg_replace('/\s+/', ' ', $request->input('judul_pekerjaan', '')));
        $kategori = trim(preg_replace('/\s+/', ' ', $request->input('kategori_pekerjaan', '')));
        if ($title !== '') {
            $wordCount = preg_match_all('/\S+/', $title);
            if ($wordCount === 2 && $kategori !== '') {
                $kategoriWord = ucwords(str_replace(['-', '_'], ' ', $kategori));
                $request->merge(['judul_pekerjaan' => $title.' '.$kategoriWord]);
            }
        }

        $request->validate([
            'judul_pekerjaan' => 'required|string|max:255|regex:/(\S+\s+){2,3}\S+$/',
            'lokasi_pekerjaan' => 'required|string|max:255',
            'gaji_pekerjaan' => 'required|string|max:255',
            'kategori_pekerjaan' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'nullable|string',
            'status' => 'required|in:draft,aktif,tutup',
        ], [
            'judul_pekerjaan.required' => 'Judul pekerjaan wajib diisi.',
            'judul_pekerjaan.regex' => 'Judul pekerjaan harus terdiri dari 3-4 kata.',
            'lokasi_pekerjaan.required' => 'Lokasi pekerjaan wajib diisi.',
            'gaji_pekerjaan.required' => 'Gaji pekerjaan wajib diisi.',
            'kategori_pekerjaan.required' => 'Kategori pekerjaan wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus berupa draft, aktif, atau tutup.',
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