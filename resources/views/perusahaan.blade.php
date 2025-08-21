@extends('layouts.app')

@section('title', 'Profil Perusahaan - GetJobs')
@section('page-title', 'Profil Perusahaan')

@push('styles')
<style>
    /* Perusahaan page specific styles */

        /* Metrics Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 0;
        }

        .metric-card {
            background: white;
            padding: 16px;
            border-radius: 6px;
            border: 1px solid #E5E7EB;
        }

        .metric-title {
            font-size: 12px;
            color: #6B7280;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .metric-value {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }

        .metric-change {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .metric-change.positive {
            color: #059669;
        }

        .metric-change.negative {
            color: #DC2626;
        }

        .metric-change.neutral {
            color: #6B7280;
        }

        /* Graph Card */
        .graph-card {
            background: white;
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #E5E7EB;
        }

        .graph-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .graph-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 24px;
        }

        .graph-legend {
            display: flex;
            gap: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6B7280;
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .legend-dot.this-year {
            background: #1F2937;
        }

        .legend-dot.last-year {
            background: #9CA3AF;
        }

        /* Profile Card */
        .profile-card {
            flex: 0 0 320px;
            max-width: 320px;
            width: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            padding: 28px 18px 18px 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 340px;
            border: 1px solid #e5e7eb;
        }

        .profile-logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(37,99,235,0.08);
            margin-bottom: 18px;
            background: #f3f4f6;
            position: relative;
        }

        .profile-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-company-name {
            font-size: 18px;
            font-weight: 700;
            color: #222;
            margin-bottom: 2px;
        }

        .profile-status {
            font-size: 13px;
            color: #10b981;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .profile-info {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .profile-info-label {
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
        }

        .profile-info-value {
            color: #222;
            font-size: 15px;
        }

        /* Content Layout */
        .content-layout {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .content-right {
            flex: 1;
            min-width: 320px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Branch and Social */
        .branch-social-layout {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .branch-card {
            flex: 1;
            min-width: 200px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            padding: 16px;
            border: 1px solid #e5e7eb;
        }

        .branch-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 12px;
        }

        .branch-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .branch-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .branch-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .branch-dot.central {
            background: #10b981;
        }

        .branch-dot.bandung {
            background: #3b82f6;
        }

        .branch-dot.surabaya {
            background: #f59e0b;
        }

        .branch-name {
            font-size: 12px;
            font-weight: 600;
            color: #111827;
        }

        .branch-location {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.4;
            margin-top: 4px;
        }

        .social-card {
            flex: 0 0 200px;
            max-width: 200px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            padding: 16px;
            border: 1px solid #e5e7eb;
        }

        .social-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 12px;
        }

        .social-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .social-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
        }

        .social-icon.instagram {
            background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
        }

        .social-icon.facebook {
            background: #1877f2;
        }

        .social-icon.twitter {
            background: #1da1f2;
        }

        .social-name {
            font-size: 11px;
            font-weight: 600;
            color: #111827;
        }

        /* Job Listings */

        .job-title {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .job-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .job-card {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: #fff;
            flex: 1;
            min-width: 200px;
        }

        .job-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 12px;
        }

        .job-info {
            flex: 1;
        }

        .job-name {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
        }

        .job-details {
            font-size: 11px;
            color: #6b7280;
        }

        .job-status {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .status-dot {
            width: 5px;
            height: 5px;
            background: #10b981;
            border-radius: 50%;
        }

        .status-text {
            font-size: 10px;
            color: #10b981;
            font-weight: 500;
        }

        /* Profile Actions */
        .profile-actions {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .edit-btn, .create-btn {
            background: linear-gradient(135deg, #577C8E 0%, #263446 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .edit-btn:hover, .create-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(87, 124, 142, 0.3);
        }

        /* Responsive adjustments when sidebar is collapsed */
        @media (min-width: 769px) {
            .sidebar.collapsed ~ .main-content .content-layout {
                max-width: calc(100vw - 70px - 64px);
            }
            
            .sidebar.collapsed ~ .main-content .profile-card {
                flex: 0 0 300px;
                max-width: 300px;
            }
            
            .sidebar.collapsed ~ .main-content .content-right {
                flex: 1;
                min-width: 280px;
            }
            
            .sidebar.collapsed ~ .main-content .branch-social-layout {
                flex-direction: column;
            }
            
            .sidebar.collapsed ~ .main-content .branch-card,
            .sidebar.collapsed ~ .main-content .social-card {
                min-width: 100%;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
        }

        .close:hover {
            color: #000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #577C8E;
            box-shadow: 0 0 0 3px rgba(87, 124, 142, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
        }

        .btn-submit {
            background: linear-gradient(135deg, #577C8E 0%, #263446 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(87, 124, 142, 0.3);
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }

        /* Alert Messages */
        .alert {
            position: relative;
            padding: 12px 16px;
            border-radius: 8px;
            margin: 16px;
            border: 1px solid;
            font-weight: 500;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fca5a5;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border-color: #93c5fd;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 240px;
                position: fixed;
                height: 100vh;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar.collapsed {
                width: 240px;
            }

            .main-content {
                margin-left: 0;
                padding: 16px;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            .sidebar-toggle {
                right: -15px;
            }

            .top-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }

            .header-right {
                width: 100%;
                justify-content: space-between;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
            }

            /* Mobile overlay */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }

            .sidebar-overlay.show {
                display: block;
            }

            /* Mobile menu button */
            .mobile-menu-btn {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1002;
                background: #2563eb;
                border: none;
                border-radius: 8px;
                padding: 10px;
                color: white;
                cursor: pointer;
            }
        }

        .mobile-menu-btn {
            display: none;
        }
</style>
@endpush

@section('content')
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif
    <!-- Card Profil dan Metrik -->
    <div class="content-layout">
                <!-- Card Profil Perusahaan -->
                <div class="profile-card">
                    <div class="profile-logo">
                        <img id="logoPreview" src="/images/logo-getjobs2.png" alt="Logo Perusahaan">
                    </div>
                    <div class="profile-company-name">{{ Auth::user()->name ?? 'Nama Perusahaan' }}</div>
                    <div class="profile-status">{{ $perusahaan ? 'Verified Company' : 'Unverified Company' }}</div>
                    <div class="profile-info">
                        <div class="profile-info-label">Email</div>
                                                 <div class="profile-info-value">{{ Auth::user()->email ?? 'email@perusahaan.com' }}</div>
                        <div class="profile-info-label">Telepon</div>
                        <div class="profile-info-value">{{ $perusahaan->no_telp_perusahaan ?? 'Belum diisi' }}</div>
                        <div class="profile-info-label">Alamat</div>
                        <div class="profile-info-value">{{ $perusahaan->alamat_perusahaan ?? 'Belum diisi' }}</div>
                        <div class="profile-info-label">Bidang Industri</div>
                        <div class="profile-info-value">{{ $perusahaan->bidang_industri ?? 'Belum diisi' }}</div>
                    </div>
                    @if($perusahaan)
                        <div class="profile-actions">
                            <button class="edit-btn" onclick="openEditModal()">Edit Profil</button>
                        </div>
                    @else
                        <div class="profile-actions">
                            <!-- Removed the button -->
                        </div>
                    @endif
                </div>
                <!-- Kanan: Metrik dan Info Tambahan -->
                <div class="content-right">
                    <!-- Metrics Grid -->
                    <div class="metrics-grid">
                        <div class="metric-card">
                            <div class="metric-title">Pekerjaan Aktif</div>
                            <div class="metric-value">6</div>
                            <div class="metric-change positive">
                                <span>↗</span>
                                +11.02%
                            </div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-title">Pelamar Baru</div>
                            <div class="metric-value">25</div>
                            <div class="metric-change negative">
                                <span>↘</span>
                                -0.03%
                            </div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-title">Pekerjaan Ditutup</div>
                            <div class="metric-value">3</div>
                            <div class="metric-change positive">
                                <span>↗</span>
                                +15.03%
                            </div>
                        </div>
                    </div>
                    <!-- Deskripsi Perusahaan dan Media Sosial -->
                    <div class="branch-social-layout">
                        <!-- Deskripsi Perusahaan -->
                        <div class="branch-card">
                            <h3 class="branch-title">Deskripsi Perusahaan</h3>
                            <div class="branch-list">
                                <div class="branch-item" style="flex-direction: column; align-items: flex-start; gap: 8px;">
                                    <div class="branch-location" style="font-size: 13px; line-height: 1.5;">
                                        {{ $perusahaan->deskripsi_perusahaan ?? 'Deskripsi perusahaan belum diisi' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Media Sosial -->
                        <div class="social-card">
                            <h3 class="social-title">Media Sosial</h3>
                            <div class="social-list">
                                <a href="https://instagram.com/getjobs.id" target="_blank" class="social-item">
                                    <div class="social-icon instagram">
                                        <i class="bi bi-instagram"></i>
                                    </div>
                                    <div class="social-name">Instagram</div>
                                </a>
                                <a href="https://facebook.com/getjobs.id" target="_blank" class="social-item">
                                    <div class="social-icon facebook">
                                        <i class="bi bi-facebook"></i>
                                    </div>
                                    <div class="social-name">Facebook</div>
                                </a>
                                <a href="https://twitter.com/getjobs_id" target="_blank" class="social-item">
                                    <div class="social-icon twitter">
                                        <i class="bi bi-twitter"></i>
                                    </div>
                                    <div class="social-name">Twitter</div>
                                </a>
                            </div>
                        </div>
                    </div>
                                         <!-- Pekerjaan Aktif -->
                     <div class="job-section">
                         <h3 class="job-title">Pekerjaan Aktif ({{ $activeJobs->count() }})</h3>
                         

                         
                         <div class="job-grid">
                             @forelse($activeJobs as $job)
                                 <div class="job-card">
                                     <div class="job-avatar">{{ strtoupper(substr($job->judul_pekerjaan, 0, 2)) }}</div>
                                     <div class="job-info">
                                         <div class="job-name">{{ $job->judul_pekerjaan }}</div>
                                         <div class="job-details">{{ $job->lokasi_pekerjaan }} • {{ $job->gaji_pekerjaan }}</div>
                                     </div>
                                     <div class="job-status">
                                         <div class="status-dot"></div>
                                         <span class="status-text">Aktif</span>
                                     </div>
                                 </div>
                             @empty
                                 <div class="job-card" style="justify-content: center; color: #6b7280; font-style: italic;">
                                     Belum ada pekerjaan aktif
                                 </div>
                             @endforelse
                         </div>
                     </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Profil Perusahaan</h2>
                <span class="close" onclick="closeEditModal()">&times;</span>
            </div>
            <form action="{{ route('perusahaan.update', $perusahaan->id_perusahaan ?? 0) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama Perusahaan *</label>
                    <input type="text" name="nama_perusahaan" class="form-input" value="{{ Auth::user()->name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="no_telp_perusahaan" class="form-input" value="{{ $perusahaan->no_telp_perusahaan ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Bidang Industri</label>
                    <input type="text" name="bidang_industri" class="form-input" value="{{ $perusahaan->bidang_industri ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Perusahaan *</label>
                    <textarea name="alamat_perusahaan" class="form-textarea" required>{{ $perusahaan->alamat_perusahaan ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Perusahaan</label>
                    <textarea name="deskripsi_perusahaan" class="form-textarea">{{ $perusahaan->deskripsi_perusahaan ?? '' }}</textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Buat Profil Perusahaan</h2>
                <span class="close" onclick="closeCreateModal()">&times;</span>
            </div>
            <form action="{{ route('perusahaan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Perusahaan *</label>
                    <input type="text" name="nama_perusahaan" class="form-input" value="{{ Auth::user()->name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="no_telp_perusahaan" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Bidang Industri</label>
                    <input type="text" name="bidang_industri" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Perusahaan *</label>
                    <textarea name="alamat_perusahaan" class="form-textarea" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Perusahaan</label>
                    <textarea name="deskripsi_perusahaan" class="form-textarea"></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeCreateModal()">Batal</button>
                    <button type="submit" class="btn-submit">Buat Profil</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
        function previewLogo(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logoPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        // Modal functions
        function openEditModal() {
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function openCreateModal() {
            document.getElementById('createModal').style.display = 'block';
        }

        function closeCreateModal() {
            document.getElementById('createModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const editModal = document.getElementById('editModal');
            const createModal = document.getElementById('createModal');
            if (event.target === editModal) {
                editModal.style.display = 'none';
            }
            if (event.target === createModal) {
                createModal.style.display = 'none';
            }
        }

        // Auto show modal based on session
        @if(session('showCreateModal'))
            document.addEventListener('DOMContentLoaded', function() {
                openCreateModal();
            });
        @endif

        @if(session('showEditModal'))
            document.addEventListener('DOMContentLoaded', function() {
                openEditModal();
            });
        @endif
    </script>
    @endpush