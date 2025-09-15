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

    public function store(Request $request)
    {
        // Normalize and auto-append category if title only has 2 words
        $title = trim(preg_replace('/\s+/', ' ', $request->input('judul_pekerjaan', '')));
        $kategori = trim(preg_replace('/\s+/', ' ', $request->input('kategori_pekerjaan', '')));
        if ($title !== '') {
            $wordCount = preg_match_all('/\S+/', $title);
            if ($wordCount === 2 && $kategori !== '') {
                // Make 3 words by appending category (beautify hyphen/underscore)
                $kategoriWord = ucwords(str_replace(['-', '_'], ' ', $kategori));
                $request->merge(['judul_pekerjaan' => $title.' '.$kategoriWord]);
            }
        }

        $request->validate([
            'judul_pekerjaan' => 'required|string|max:255|regex:/(\S+\s+){2,3}\S+$/',
            'lokasi_pekerjaan' => 'required|string|max:255',
            'gaji_pekerjaan' => 'required|string|max:255',
            'kategori_pekerjaan' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
        ], [
            'judul_pekerjaan.required' => 'Judul pekerjaan wajib diisi.',
            'judul_pekerjaan.regex' => 'Judul pekerjaan harus terdiri dari 3-4 kata.',
            'lokasi_pekerjaan.required' => 'Lokasi pekerjaan wajib diisi.',
            'gaji_pekerjaan.required' => 'Gaji pekerjaan wajib diisi.',
            'kategori_pekerjaan.required' => 'Kategori pekerjaan wajib diisi.',
            'deskripsi_pekerjaan.required' => 'Deskripsi pekerjaan wajib diisi.',
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