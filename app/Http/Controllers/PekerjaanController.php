<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index()
    {
        // Get current user - if not logged in, show all jobs (for demo purposes)
        $userId = auth()->id() ?? 1; // Default to user ID 1 if not authenticated
        
        // Only show active jobs (status = 'aktif') belonging to the current user
        $pekerjaan = Pekerjaan::withCount('pelamars')
            ->where('user_id', $userId)
            ->where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
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
            'jumlah_pelamar_diinginkan' => 'required|integer|min:1|max:100',
        ], [
            'judul_pekerjaan.required' => 'Judul pekerjaan wajib diisi.',
            'judul_pekerjaan.regex' => 'Judul pekerjaan harus terdiri dari 3-4 kata.',
            'lokasi_pekerjaan.required' => 'Lokasi pekerjaan wajib diisi.',
            'gaji_pekerjaan.required' => 'Gaji pekerjaan wajib diisi.',
            'kategori_pekerjaan.required' => 'Kategori pekerjaan wajib diisi.',
            'deskripsi_pekerjaan.required' => 'Deskripsi pekerjaan wajib diisi.',
            'jumlah_pelamar_diinginkan.required' => 'Jumlah pelamar diinginkan wajib diisi.',
            'jumlah_pelamar_diinginkan.integer' => 'Jumlah pelamar harus berupa angka.',
            'jumlah_pelamar_diinginkan.min' => 'Jumlah pelamar minimal 1.',
            'jumlah_pelamar_diinginkan.max' => 'Jumlah pelamar maksimal 100.',
        ]);

        Pekerjaan::create([
            'user_id' => auth()->id() ?? 1, // Use current user ID or default to 1
            'judul_pekerjaan' => $request->judul_pekerjaan,
            'lokasi_pekerjaan' => $request->lokasi_pekerjaan,
            'gaji_pekerjaan' => $request->gaji_pekerjaan,
            'kategori_pekerjaan' => $request->kategori_pekerjaan,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'jumlah_pelamar_diinginkan' => $request->jumlah_pelamar_diinginkan,
            'status' => 'aktif', // Default status is now 'aktif'
            'tanggal_dibuat' => now(),
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        \Log::info('Update pekerjaan called', [
            'id' => $id,
            'request_data' => $request->all(),
            'user_id' => auth()->id()
        ]);

        $pekerjaan = Pekerjaan::findOrFail($id);
        
        \Log::info('Pekerjaan found', [
            'pekerjaan' => $pekerjaan->toArray()
        ]);

        // If only status is being updated (close job functionality)
        if ($request->has('status') && $request->input('status') === 'tutup') {
            \Log::info('Closing job - status update only');
            
            $request->validate([
                'status' => 'required|in:aktif,tutup',
            ], [
                'status.required' => 'Status wajib dipilih.',
                'status.in' => 'Status harus berupa aktif atau tutup.',
            ]);

            $pekerjaan->update(['status' => 'tutup']);
            
            \Log::info('Job closed successfully', [
                'id' => $id,
                'new_status' => $pekerjaan->fresh()->status
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pekerjaan berhasil ditutup!',
                    'data' => $pekerjaan->fresh()
                ]);
            }

            return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil ditutup!');
        }

        // Full update validation for other cases
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
            'jumlah_pelamar_diinginkan' => 'required|integer|min:1|max:100',
            'status' => 'required|in:aktif,tutup',
        ], [
            'judul_pekerjaan.required' => 'Judul pekerjaan wajib diisi.',
            'judul_pekerjaan.regex' => 'Judul pekerjaan harus terdiri dari 3-4 kata.',
            'lokasi_pekerjaan.required' => 'Lokasi pekerjaan wajib diisi.',
            'gaji_pekerjaan.required' => 'Gaji pekerjaan wajib diisi.',
            'kategori_pekerjaan.required' => 'Kategori pekerjaan wajib diisi.',
            'jumlah_pelamar_diinginkan.required' => 'Jumlah pelamar diinginkan wajib diisi.',
            'jumlah_pelamar_diinginkan.integer' => 'Jumlah pelamar harus berupa angka.',
            'jumlah_pelamar_diinginkan.min' => 'Jumlah pelamar minimal 1.',
            'jumlah_pelamar_diinginkan.max' => 'Jumlah pelamar maksimal 100.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus berupa aktif atau tutup.',
        ]);

        $pekerjaan->update($request->all());

        \Log::info('Pekerjaan updated successfully', [
            'id' => $id,
            'updated_data' => $pekerjaan->fresh()->toArray()
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil diperbarui!');
    }

    public function show($id)
    {
        $userId = auth()->id() ?? 1; // Get current user ID
        
        // Ensure the job belongs to the current user
        $pekerjaan = Pekerjaan::withCount([
            'pelamars',
            'pelamars as pelamars_review_count' => function ($query) {
                $query->where('status', 'review');
            },
            'pelamars as pelamars_accepted_count' => function ($query) {
                $query->where('status', 'accepted');
            },
            'pelamars as pelamars_rejected_count' => function ($query) {
                $query->where('status', 'rejected');
            }
        ])
        ->where('user_id', $userId)
        ->findOrFail($id);
        
        // Get closed job history data with applicant counts (exclude current job, only from same user)
        $riwayatPekerjaan = Pekerjaan::withCount('pelamars')
            ->where('user_id', $userId)
            ->where('id_pekerjaan', '!=', $id)
            ->where('status', 'tutup')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // If no closed jobs exist, create dummy data for closed jobs only
        if($riwayatPekerjaan->isEmpty()) {
            $riwayatPekerjaan = collect([
                (object)[
                    'id_pekerjaan' => 2,
                    'judul_pekerjaan' => 'UI/UX Designer',
                    'lokasi_pekerjaan' => 'Bandung',
                    'gaji_pekerjaan' => 'Rp 8.000.000 - Rp 12.000.000',
                    'kategori_pekerjaan' => 'design',
                    'deskripsi_pekerjaan' => 'Desainer UI/UX untuk aplikasi mobile dan web',
                    'jumlah_pelamar_diinginkan' => 6,
                    'pelamars_count' => 6,
                    'pelamars_accepted_count' => 2,
                    'status' => 'tutup',
                    'created_at' => now()->subDays(12)
                ],
                (object)[
                    'id_pekerjaan' => 6,
                    'judul_pekerjaan' => 'Marketing Specialist',
                    'lokasi_pekerjaan' => 'Jakarta Selatan',
                    'gaji_pekerjaan' => 'Rp 7.000.000 - Rp 10.000.000',
                    'kategori_pekerjaan' => 'marketing',
                    'deskripsi_pekerjaan' => 'Spesialis marketing untuk kampanye digital',
                    'jumlah_pelamar_diinginkan' => 8,
                    'pelamars_count' => 8,
                    'pelamars_accepted_count' => 3,
                    'status' => 'tutup',
                    'created_at' => now()->subDays(30)
                ],
                (object)[
                    'id_pekerjaan' => 7,
                    'judul_pekerjaan' => 'Senior Backend Developer',
                    'lokasi_pekerjaan' => 'Jakarta Pusat',
                    'gaji_pekerjaan' => 'Rp 15.000.000 - Rp 20.000.000',
                    'kategori_pekerjaan' => 'technology',
                    'deskripsi_pekerjaan' => 'Senior backend developer dengan pengalaman microservices',
                    'jumlah_pelamar_diinginkan' => 10,
                    'pelamars_count' => 12,
                    'pelamars_accepted_count' => 4,
                    'status' => 'tutup',
                    'created_at' => now()->subDays(45)
                ],
                (object)[
                    'id_pekerjaan' => 8,
                    'judul_pekerjaan' => 'Financial Analyst',
                    'lokasi_pekerjaan' => 'Surabaya',
                    'gaji_pekerjaan' => 'Rp 8.000.000 - Rp 12.000.000',
                    'kategori_pekerjaan' => 'finance',
                    'deskripsi_pekerjaan' => 'Analisis keuangan dan perencanaan budget',
                    'jumlah_pelamar_diinginkan' => 5,
                    'pelamars_count' => 5,
                    'pelamars_accepted_count' => 2,
                    'status' => 'tutup',
                    'created_at' => now()->subDays(60)
                ],
                (object)[
                    'id_pekerjaan' => 9,
                    'judul_pekerjaan' => 'HR Generalist',
                    'lokasi_pekerjaan' => 'Jakarta Barat',
                    'gaji_pekerjaan' => 'Rp 6.000.000 - Rp 9.000.000',
                    'kategori_pekerjaan' => 'hr',
                    'deskripsi_pekerjaan' => 'Mengelola proses rekrutmen dan employee relations',
                    'jumlah_pelamar_diinginkan' => 6,
                    'pelamars_count' => 7,
                    'pelamars_accepted_count' => 3,
                    'status' => 'tutup',
                    'created_at' => now()->subDays(75)
                ]
            ]);
        }
        
        return view('pekerjaan-detail', compact('pekerjaan', 'riwayatPekerjaan'));
    }

    public function destroy($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->delete();

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil dihapus!');
    }

    public function getJobHistory()
    {
        try {
            $userId = auth()->id();
            
            // If user is not authenticated, return error
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi. Silakan login kembali.',
                    'error' => 'Unauthorized'
                ], 401);
            }
            
            // Get only closed jobs from database with accepted applicants (only from current user)
            $closedJobs = Pekerjaan::with([
                'pelamars' => function ($query) {
                    $query->where('status', 'accepted');
                }
            ])
            ->withCount([
                'pelamars',
                'pelamars as pelamars_accepted_count' => function ($query) {
                    $query->where('status', 'accepted');
                }
            ])
            ->where('user_id', $userId)
            ->where('status', 'tutup')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

            // Transform real data for frontend
            $historyData = $closedJobs->map(function ($job) {
                $acceptedApplicants = $job->pelamars->map(function ($pelamar) use ($job) {
                    return [
                        'name' => $pelamar->nama,
                        'position' => $job->judul_pekerjaan // Use job title as position
                    ];
                });

                return [
                    'id_pekerjaan' => $job->id_pekerjaan,
                    'judul_pekerjaan' => $job->judul_pekerjaan,
                    'kategori_pekerjaan' => $job->kategori_pekerjaan,
                    'pelamars_count' => $job->pelamars_count,
                    'jumlah_pelamar_diinginkan' => $job->jumlah_pelamar_diinginkan,
                    'pelamars_accepted_count' => $job->pelamars_accepted_count,
                    'status' => $job->status,
                    'created_at' => $job->created_at->toISOString(),
                    'closed_at' => $job->updated_at->toISOString(), // Using updated_at as closed_at
                    'accepted_applicants' => $acceptedApplicants
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $historyData,
                'message' => $closedJobs->isEmpty() ? 'Belum ada pekerjaan yang sudah tutup.' : null
            ]);

        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Job History API Error: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat riwayat pekerjaan: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 