<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CVController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'cv' => 'required|mimes:pdf|max:2048', // hanya PDF max 2MB
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('cv');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan ke storage/app/public/cv
            $file->storeAs('public/cv', $filename);

            // Log informasi lamaran (opsional)
            \Log::info('CV submitted', [
                'job_title' => $request->job_title,
                'company_name' => $request->company_name,
                'filename' => $filename,
                'file_size' => $file->getSize(),
                'submitted_at' => now(),
                'ip_address' => $request->ip(),
            ]);

            return back()->with('success', 'CV berhasil dikirim untuk posisi ' . $request->job_title . ' di ' . $request->company_name . '!');

        } catch (\Exception $e) {
            \Log::error('CV upload failed', [
                'error' => $e->getMessage(),
                'job_title' => $request->job_title,
                'company_name' => $request->company_name,
            ]);

            return back()->with('error', 'Terjadi kesalahan saat mengupload CV. Silakan coba lagi.');
        }
    }
}
