<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('perusahaan.profile');
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi_perusahaan' => 'nullable|string',
            'no_telp_perusahaan' => 'nullable|string|max:20',
            'bidang_industri' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update user's name with nama_perusahaan
        Auth::user()->update(['name' => $request->nama_perusahaan]);
        
        $perusahaan = Perusahaan::create([
            'id_user' => Auth::id(),
            'nama_perusahaan' => $request->nama_perusahaan,
            'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
            'no_telp_perusahaan' => $request->no_telp_perusahaan,
            'bidang_industri' => $request->bidang_industri,
            'alamat_perusahaan' => $request->alamat_perusahaan,
        ]);

        return redirect()->route('perusahaan.profile')
            ->with('success', 'Profil perusahaan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('perusahaan.profile');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        
        // Check if user owns this perusahaan
        if ($perusahaan->id_user !== Auth::id()) {
            return redirect()->route('perusahaan.profile')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }
        
        return redirect()->route('perusahaan.profile')->with('showEditModal', true);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        
        // Check if user owns this perusahaan
        if ($perusahaan->id_user !== Auth::id()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk mengedit profil ini.'
                ], 403);
            }
            return redirect()->route('perusahaan.profile')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }

        // For inline editing (AJAX requests), we only validate the fields that are being updated
        if ($request->ajax()) {
            $rules = [];
            if ($request->has('no_telp_perusahaan')) {
                $rules['no_telp_perusahaan'] = 'nullable|string|max:20';
            }
            if ($request->has('bidang_industri')) {
                $rules['bidang_industri'] = 'nullable|string|max:255';
            }
            if ($request->has('alamat_perusahaan')) {
                $rules['alamat_perusahaan'] = 'nullable|string';
            }
            
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // Update only the fields that are provided
            $updateData = [];
            if ($request->has('no_telp_perusahaan')) {
                $updateData['no_telp_perusahaan'] = $request->no_telp_perusahaan;
            }
            if ($request->has('bidang_industri')) {
                $updateData['bidang_industri'] = $request->bidang_industri;
            }
            if ($request->has('alamat_perusahaan')) {
                $updateData['alamat_perusahaan'] = $request->alamat_perusahaan;
            }
            
            if (!empty($updateData)) {
                $perusahaan->update($updateData);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui!'
            ]);
        }

        // For regular form submissions (modal)
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi_perusahaan' => 'nullable|string',
            'no_telp_perusahaan' => 'nullable|string|max:20',
            'bidang_industri' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update user's name with nama_perusahaan
        Auth::user()->update(['name' => $request->nama_perusahaan]);
        
        $perusahaan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
            'no_telp_perusahaan' => $request->no_telp_perusahaan,
            'bidang_industri' => $request->bidang_industri,
            'alamat_perusahaan' => $request->alamat_perusahaan,
        ]);

        return redirect()->route('perusahaan.profile')
            ->with('success', 'Profil perusahaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        
        // Check if user owns this perusahaan
        if ($perusahaan->id_user !== Auth::id()) {
            return redirect()->route('perusahaan.profile')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus profil ini.');
        }

        $perusahaan->delete();

        return redirect()->route('perusahaan.profile')
            ->with('success', 'Profil perusahaan berhasil dihapus!');
    }

    /**
     * Update profile for current user (for inline editing)
     */
    public function updateProfile(Request $request)
    {
        $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
        
        // If no perusahaan record exists, create one first
        if (!$perusahaan) {
            $perusahaan = Perusahaan::create([
                'id_user' => Auth::id(),
                'nama_perusahaan' => Auth::user()->name ?? 'Nama Perusahaan',
                'deskripsi_perusahaan' => null,
                'no_telp_perusahaan' => null,
                'bidang_industri' => null,
                'alamat_perusahaan' => null,
            ]);
        }

        // For inline editing (AJAX requests), we only validate the fields that are being updated
        if ($request->ajax()) {
            $rules = [];
            if ($request->has('no_telp_perusahaan')) {
                $rules['no_telp_perusahaan'] = 'nullable|string|max:20';
            }
            if ($request->has('bidang_industri')) {
                $rules['bidang_industri'] = 'nullable|string|max:255';
            }
            if ($request->has('alamat_perusahaan')) {
                $rules['alamat_perusahaan'] = 'nullable|string';
            }
            if ($request->has('deskripsi_perusahaan')) {
                $rules['deskripsi_perusahaan'] = 'nullable|string';
            }
            
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // Update only the fields that are provided
            $updateData = [];
            if ($request->has('no_telp_perusahaan')) {
                $updateData['no_telp_perusahaan'] = $request->no_telp_perusahaan;
            }
            if ($request->has('bidang_industri')) {
                $updateData['bidang_industri'] = $request->bidang_industri;
            }
            if ($request->has('alamat_perusahaan')) {
                $updateData['alamat_perusahaan'] = $request->alamat_perusahaan;
            }
            if ($request->has('deskripsi_perusahaan')) {
                $updateData['deskripsi_perusahaan'] = $request->deskripsi_perusahaan;
            }
            
            if (!empty($updateData)) {
                $perusahaan->update($updateData);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid request'
        ], 400);
    }

    /**
     * Get perusahaan profile for current user
     */
    public function profile()
    {
        $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
        
        // Fetch active jobs for the current user, maximum 6 jobs
        $activeJobs = Pekerjaan::where('user_id', Auth::id())
            ->where('status', 'aktif')
            ->orderBy('tanggal_dibuat', 'desc')
            ->limit(6)
            ->get();
        
        // If no jobs for current user, show all active jobs (for demo purposes)
        if ($activeJobs->isEmpty()) {
            $activeJobs = Pekerjaan::where('status', 'aktif')
                ->orderBy('tanggal_dibuat', 'desc')
                ->limit(6)
                ->get();
        }
        
        if (!$perusahaan) {
            return view('perusahaan', compact('perusahaan', 'activeJobs'))->with('showCreateModal', true);
        }
        
        return view('perusahaan', compact('perusahaan', 'activeJobs'));
    }
}
