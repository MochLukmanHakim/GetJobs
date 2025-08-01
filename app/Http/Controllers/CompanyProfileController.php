<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyProfiles = CompanyProfile::with('user')->get();
        return view('company-profiles.index', compact('companyProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company-profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alamat_perusahaan' => 'required|string',
            'bidang_industri' => 'required|string',
            'no_telp_perusahaan' => 'required|string',
            'deskripsi' => 'required|string',
            'media_sosial' => 'nullable|array'
        ]);

        $companyProfile = CompanyProfile::create([
            'user_id' => Auth::id(),
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'bidang_industri' => $request->bidang_industri,
            'no_telp_perusahaan' => $request->no_telp_perusahaan,
            'deskripsi' => $request->deskripsi,
            'media_sosial' => $request->media_sosial
        ]);

        return redirect()->route('company-profiles.show', $companyProfile->id)
            ->with('success', 'Profil perusahaan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $companyProfile = CompanyProfile::with('user')->findOrFail($id);
        return view('company-profiles.show', compact('companyProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companyProfile = CompanyProfile::findOrFail($id);
        
        // Pastikan user yang login adalah pemilik profil
        if ($companyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('company-profiles.edit', compact('companyProfile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $companyProfile = CompanyProfile::findOrFail($id);
        
        // Pastikan user yang login adalah pemilik profil
        if ($companyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'alamat_perusahaan' => 'required|string',
            'bidang_industri' => 'required|string',
            'no_telp_perusahaan' => 'required|string',
            'deskripsi' => 'required|string',
            'media_sosial' => 'nullable|array'
        ]);

        $companyProfile->update([
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'bidang_industri' => $request->bidang_industri,
            'no_telp_perusahaan' => $request->no_telp_perusahaan,
            'deskripsi' => $request->deskripsi,
            'media_sosial' => $request->media_sosial
        ]);

        return redirect()->route('company-profiles.show', $companyProfile->id)
            ->with('success', 'Profil perusahaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $companyProfile = CompanyProfile::findOrFail($id);
        
        // Pastikan user yang login adalah pemilik profil
        if ($companyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $companyProfile->delete();

        return redirect()->route('company-profiles.index')
            ->with('success', 'Profil perusahaan berhasil dihapus!');
    }
}
