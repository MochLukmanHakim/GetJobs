<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PelamarController extends Controller
{
    /**
     * Display the pelamar management page
     */
    public function index(Request $request): View
    {
        $userId = auth()->id() ?? 1; // Get current user ID
        
        // Only show applicants from active jobs belonging to the current user
        $query = Pelamar::with('pekerjaan')
            ->whereHas('pekerjaan', function ($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->where('status', '!=', 'tutup'); // Only show applicants from active jobs
            });

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search, $userId) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhereHas('pekerjaan', function($pq) use ($search, $userId) {
                      $pq->where('judul_pekerjaan', 'like', "%{$search}%")
                         ->where('user_id', $userId)
                         ->where('status', '!=', 'tutup');
                  });
            });
        }

        // Filter by job category (only from user's active jobs)
        if ($request->filled('job_filter')) {
            $query->whereHas('pekerjaan', function ($q) use ($request, $userId) {
                $q->where('judul_pekerjaan', $request->job_filter)
                  ->where('user_id', $userId)
                  ->where('status', '!=', 'tutup');
            });
        }

        // Filter by status
        if ($request->filled('status_filter')) {
            $query->where('status', $request->status_filter);
        }

        // Sort by date (newest first by default)
        $query->orderBy('tanggal_melamar', 'desc');

        $pelamars = $query->get();
        
        // Only show job categories from the current user's active jobs (not closed)
        $jobCategories = Pekerjaan::select('judul_pekerjaan')
            ->where('user_id', $userId)
            ->where('status', '!=', 'tutup') // Only show active jobs in dropdown
            ->distinct()
            ->get();

        return view('pelamar', compact('pelamars', 'jobCategories'));
    }

    /**
     * Store a new applicant
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelamars,email',
            'telepon' => 'required|string|max:20',
            'pekerjaan_id' => 'required|exists:pekerjaan,id_pekerjaan',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        $data = $request->only(['nama', 'email', 'telepon', 'pekerjaan_id']);
        $data['tanggal_melamar'] = now();

        // Handle CV file upload
        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('cv_files', $filename, 'public');
            $data['cv_path'] = $path;
        }

        $pelamar = Pelamar::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Pelamar berhasil ditambahkan',
            'data' => $pelamar->load('pekerjaan')
        ]);
    }

    /**
     * Update applicant status
     */
    public function updateStatus(Request $request, $id): JsonResponse
    {
        try {
            // Log incoming request
            \Log::info('Status update request received', [
                'id' => $id,
                'request_data' => $request->all(),
                'method' => $request->method()
            ]);

            // Get and validate status
            $status = $request->input('status');
            \Log::info('Received status value', ['status' => $status, 'type' => gettype($status)]);
            
            if (empty($status) || !in_array($status, ['review', 'accepted', 'rejected'])) {
                \Log::error('Invalid status received', ['status' => $status]);
                return response()->json([
                    'success' => false,
                    'message' => 'Status tidak valid: ' . ($status ?? 'null')
                ], 400);
            }

            $pelamar = Pelamar::findOrFail($id);
            $oldStatus = $pelamar->status;
            
            // Use direct database update instead of model save
            $updated = Pelamar::where('id', $id)->update(['status' => $status]);
            
            if (!$updated) {
                throw new \Exception('Database update failed - no rows affected');
            }

            // Get fresh data from database and verify update
            $updatedPelamar = Pelamar::find($id);
            
            // Double-check the status was actually saved
            if ($updatedPelamar->status !== $status) {
                \Log::error('Status mismatch after update', [
                    'expected' => $status,
                    'actual' => $updatedPelamar->status,
                    'pelamar_id' => $id
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Status gagal disimpan ke database'
                ], 500);
            }

            \Log::info('Status successfully updated', [
                'pelamar_id' => $id,
                'old_status' => $oldStatus,
                'new_status' => $updatedPelamar->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status pelamar berhasil diperbarui dan disimpan',
                'data' => $updatedPelamar,
                'debug' => [
                    'old_status' => $oldStatus,
                    'new_status' => $updatedPelamar->status,
                    'updated_rows' => $updated,
                    'database_confirmed' => true
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Status update failed', [
                'pelamar_id' => $id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update announcement status
     */
    public function updatePengumuman(Request $request, Pelamar $pelamar): JsonResponse
    {
        $request->validate([
            'pengumuman_status' => 'required|in:none,interview,test,document,phone,completed,pending',
            'catatan' => 'nullable|string'
        ]);

        $pelamar->update([
            'pengumuman_status' => $request->pengumuman_status,
            'catatan' => $request->catatan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil dikirim',
            'data' => $pelamar->fresh()
        ]);
    }

    /**
     * Send announcement to applicant
     */
    public function sendAnnouncement(Request $request, Pelamar $pelamar): JsonResponse
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Update the applicant's announcement with subject and message
        $pelamar->update([
            'catatan' => $request->subject . ': ' . $request->message,
            'pengumuman_status' => 'pending' // Set default status
        ]);

        // Here you would typically send an email notification
        // For now, we'll just return success

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil dikirim ke ' . $pelamar->nama,
            'data' => $pelamar->fresh()
        ]);
    }

    /**
     * Delete applicant
     */
    public function destroy(Pelamar $pelamar): JsonResponse
    {
        // Delete CV file if exists
        if ($pelamar->cv_path && Storage::disk('public')->exists($pelamar->cv_path)) {
            Storage::disk('public')->delete($pelamar->cv_path);
        }

        $pelamar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pelamar berhasil dihapus'
        ]);
    }

    /**
     * View CV file
     */
    public function viewCV(Pelamar $pelamar)
    {
        if (!$pelamar->cv_path || !Storage::disk('public')->exists($pelamar->cv_path)) {
            abort(404, 'CV file not found');
        }

        $filePath = Storage::disk('public')->path($pelamar->cv_path);
        $mimeType = Storage::disk('public')->mimeType($pelamar->cv_path);

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($pelamar->cv_path) . '"'
        ]);
    }

    /**
     * Bulk update status for multiple applicants
     */
    public function bulkUpdateStatus(Request $request): JsonResponse
    {
        $request->validate([
            'pelamar_ids' => 'required|array',
            'pelamar_ids.*' => 'exists:pelamars,id',
            'status' => 'required|in:review,accepted,rejected'
        ]);

        $updated = Pelamar::whereIn('id', $request->pelamar_ids)
            ->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => "{$updated} pelamar berhasil diperbarui",
            'updated_count' => $updated
        ]);
    }

    /**
     * Send bulk announcement to multiple applicants
     */
    public function bulkAnnouncement(Request $request): JsonResponse
    {
        $request->validate([
            'applicant_ids' => 'required|array',
            'applicant_ids.*' => 'exists:pelamars,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        try {
            $applicantIds = $request->applicant_ids;
            $subject = $request->subject;
            $message = $request->message;
            $announcementText = $subject . ': ' . $message;

            // Update all selected applicants with the announcement
            $updated = Pelamar::whereIn('id', $applicantIds)
                ->update([
                    'catatan' => $announcementText,
                    'pengumuman_status' => 'pending'
                ]);

            // Get the updated applicants for response
            $applicants = Pelamar::whereIn('id', $applicantIds)->get();
            $applicantNames = $applicants->pluck('nama')->toArray();

            return response()->json([
                'success' => true,
                'message' => "Pengumuman '{$subject}' berhasil dikirim ke {$updated} pelamar",
                'data' => [
                    'updated_count' => $updated,
                    'applicant_names' => $applicantNames,
                    'subject' => $subject,
                    'message' => $message
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Bulk announcement failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get applicant statistics
     */
    public function getStats(): JsonResponse
    {
        $stats = [
            'total' => Pelamar::count(),
            'review' => Pelamar::where('status', 'review')->count(),
            'accepted' => Pelamar::where('status', 'accepted')->count(),
            'rejected' => Pelamar::where('status', 'rejected')->count(),
            'recent' => Pelamar::where('created_at', '>=', now()->subDays(7))->count()
        ];

        return response()->json($stats);
    }
}
