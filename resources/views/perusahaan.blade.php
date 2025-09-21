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
            padding: 20px;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }



        .metric-card:nth-child(1) {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        }

        .metric-card:nth-child(2) {
            background: linear-gradient(135deg, #F3E8FF 0%, #E9D5FF 100%);
        }

        .metric-card:nth-child(3) {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        }

        .metric-card:hover {
            transform: translateY(-1px);
        }

        .metric-title {
            font-size: 12px;
            color: #374151;
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

        /* Job Cards Styling */
        .job-section {
            margin-top: 24px;
        }

        .job-title {
            font-size: 20px;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .job-title::before {
            content: '';
            width: 4px;
            height: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .job-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .job-card {
            background: white;
            border-radius: 16px;
            padding: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .job-card:hover {
            transform: translateY(-1px);
        }

        .job-avatar {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 12px;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(102, 126, 234, 0.25);
        }

        .job-info {
            flex: 1;
            min-width: 0;
        }

        .job-name {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
            line-height: 1.3;
        }

        .job-details {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 0;
            flex-wrap: wrap;
        }



        .job-status {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-left: auto;
        }

        .status-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #10b981;
        }

        .status-text {
            font-size: 10px;
            color: #10b981;
            font-weight: 500;
        }

        /* Graph Card */
        .graph-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .graph-card:hover {
            transform: translateY(-1px);
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
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 28px 18px 18px 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 340px;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-1px);
        }

        /* Profile Header - Logo and Company Name Side by Side */
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 18px;
            width: 100%;
        }

        .profile-logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(37,99,235,0.08);
            background: #ffffff;
            position: relative;
            flex-shrink: 0;
        }

        .profile-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-company-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            text-align: center;
            align-items: center;
        }

        .profile-company-name {
            font-size: 18px;
            font-weight: 700;
            color: #222;
            margin-bottom: 0;
            line-height: 1.2;
        }

        .profile-status {
            font-size: 13px;
            color: #222;
            font-weight: 600;
            margin-bottom: 0;
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
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 16px;
            transition: all 0.3s ease;
        }

        .branch-card:hover {
            transform: translateY(-1px);
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
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 16px;
            transition: all 0.3s ease;
        }

        .social-card:hover {
            transform: translateY(-1px);
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




        /* Company Description Styling */
        .company-description {
            width: 100%;
        }

        .desc-section {
            margin-bottom: 20px;
        }

        .desc-section:last-child {
            margin-bottom: 0;
        }

        .desc-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 12px;
            position: relative;
        }


        .desc-text {
            font-size: 14px;
            line-height: 1.6;
            color: #4b5563;
            margin-bottom: 0;
            text-align: justify;
        }


        .vision-mission {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .vision, .mission {
            background: #f0f9ff;
            padding: 12px;
            border-radius: 6px;
            border-left: 4px solid #0ea5e9;
            font-size: 14px;
            line-height: 1.5;
            color: #0c4a6e;
        }

        .mission {
            background: #f0fdf4;
            border-left-color: #10b981;
            color: #064e3b;
        }

        /* Profile Actions */
        .profile-actions {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }



        .edit-btn, .create-btn {
            background: #000000;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .edit-btn:hover, .create-btn:hover {
            background: #333333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .edit-btn.save-mode {
            background: #10b981;
        }

        .edit-btn.save-mode:hover {
            background: #059669;
        }

        /* Inline Editing Styles */
        .profile-info-value.editable {
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .profile-info-value.editable:hover {
            background: #f8fafc;
            border-color: #e2e8f0;
        }

        /* Hover effects for description and company details */
        .edit-mode-active .profile-info-value.editable:hover {
            background: #f0f9ff;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .profile-info-value.editing {
            background: #f0f9ff;
            border-color: #002746;
        }

        .profile-edit-input {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #002746;
            border-radius: 6px;
            font-size: 15px;
            font-family: inherit;
            background: white;
            transition: all 0.2s ease;
            margin-top: 4px;
        }

        .profile-edit-input:focus {
            outline: none;
            border-color: #003a5c;
            box-shadow: 0 0 0 3px rgba(0, 39, 70, 0.1);
        }

        .profile-edit-input[data-field="alamat_perusahaan"] {
            min-height: 80px;
            resize: vertical;
        }

        .edit-mode-active .profile-info-value.editable {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .save-cancel-buttons {
            display: none;
            gap: 8px;
            margin-top: 20px;
        }

        .save-cancel-buttons.show {
            display: flex;
        }

        .btn-save-inline, .btn-cancel-inline {
            flex: 1;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-save-inline {
            background: #10b981;
            color: white;
        }

        .btn-save-inline:hover {
            background: #059669;
        }


        .btn-cancel-inline {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-cancel-inline:hover {
            background: #e5e7eb;
        }

        /* Responsive layout for smaller screens */
        @media (max-width: 900px) {
            .content-layout {
                flex-direction: column;
            }
            
            .profile-card {
                max-width: 100%;
                margin-bottom: 20px;
            }
            
            .branch-social-layout {
                flex-direction: column;
            }
            
            .branch-card,
            .social-card {
                max-width: 100%;
            }
        }

        /* Mobile responsive for profile header */
        @media (max-width: 480px) {
            .profile-header {
                gap: 12px;
            }
            
            .profile-logo {
                width: 60px;
                height: 60px;
            }
            
            .profile-company-name {
                font-size: 16px;
            }
            
            .profile-status {
                font-size: 12px;
            }
        }

        /* Responsive job grid */
        @media (max-width: 768px) {
            .job-grid {
                grid-template-columns: 1fr;
                gap: 8px;
            }
        }

        @media (max-width: 1024px) and (min-width: 769px) {
            .job-grid {
                grid-template-columns: repeat(2, 1fr);
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
                    <!-- Profile Header with Logo and Company Info Side by Side -->
                    <div class="profile-header">
                        <div class="profile-logo">
                            <img id="logoPreview" src="/images/logo-getjobs2.png" alt="Logo Perusahaan">
                        </div>
                        <div class="profile-company-info">
                            <div class="profile-company-name">{{ Auth::user()->name ?? 'Nama Perusahaan' }}</div>
                            <div class="profile-status">{{ Auth::user()->email ?? 'email@perusahaan.com' }}</div>
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-info-label">Telepon</div>
                        <div class="profile-info-value editable" data-field="no_telp_perusahaan">{{ $perusahaan->no_telp_perusahaan ?? 'Belum diisi' }}</div>
                        <input type="text" class="profile-edit-input" data-field="no_telp_perusahaan" value="{{ $perusahaan->no_telp_perusahaan ?? '' }}" style="display: none;">
                        
                        <div class="profile-info-label">Alamat</div>
                        <div class="profile-info-value editable" data-field="alamat_perusahaan">{{ $perusahaan->alamat_perusahaan ?? 'Belum diisi' }}</div>
                        <textarea class="profile-edit-input" data-field="alamat_perusahaan" style="display: none;">{{ $perusahaan->alamat_perusahaan ?? '' }}</textarea>
                        
                        <div class="profile-info-label">Bidang Industri</div>
                        <div class="profile-info-value editable" data-field="bidang_industri">{{ $perusahaan->bidang_industri ?? 'Belum diisi' }}</div>
                        <input type="text" class="profile-edit-input" data-field="bidang_industri" value="{{ $perusahaan->bidang_industri ?? '' }}" style="display: none;">
                        
                        <!-- Edit Button -->
                        <div class="profile-actions">
                            <button class="edit-btn" onclick="toggleInlineEdit()" id="editToggleBtn">
                                <i class="bi bi-pencil-square"></i>
                                <span id="editBtnText">Edit Profil</span>
                            </button>
                            
                            <!-- Save and Cancel Buttons (Hidden by default) -->
                            <div class="save-cancel-buttons" id="saveCancelButtons">
                                <button class="btn-save-inline" onclick="saveInlineChanges()">
                                    <i class="bi bi-check-lg"></i>
                                    Simpan
                                </button>
                                <button class="btn-cancel-inline" onclick="cancelInlineEdit()">
                                    <i class="bi bi-x-lg"></i>
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
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
                                <div class="branch-item" style="flex-direction: column; align-items: flex-start; gap: 12px;">
                                    <div class="company-description">
                                        <div class="desc-section">
                                            <div class="profile-info-value editable" data-field="deskripsi_perusahaan" style="margin-bottom: 16px; cursor: pointer; padding: 8px; border-radius: 4px; transition: all 0.2s ease; border: 1px solid transparent;">{{ $perusahaan->deskripsi_perusahaan ?? 'PT. Tambang Maju Sejahtera adalah perusahaan tambang batu bara yang beroperasi di Kalimantan Timur. Berdiri sejak tahun 2010, perusahaan kami fokus pada pertambangan batu bara dengan komitmen terhadap keselamatan dan lingkungan.' }}</div>
                                            <textarea class="profile-edit-input" data-field="deskripsi_perusahaan" style="display: none; min-height: 100px; width: 100%; padding: 8px; border: 2px solid #002746; border-radius: 6px; font-size: 14px; font-family: inherit; background: white; transition: all 0.2s ease;">{{ $perusahaan->deskripsi_perusahaan ?? '' }}</textarea>
                                        </div>
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
                                <div class="job-card" style="text-align: center; color: #6b7280; font-style: italic; padding: 40px 20px;">
                                    <div style="font-size: 48px; margin-bottom: 16px;">📋</div>
                                    <div style="font-size: 16px;">Belum ada pekerjaan aktif</div>
                                    <div style="font-size: 14px; margin-top: 8px; color: #9ca3af;">Buat pekerjaan pertama Anda untuk mulai merekrut</div>
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

        // Inline Editing Functionality
        let isEditMode = false;
        let originalValues = {};

        function toggleInlineEdit() {
            const editBtn = document.getElementById('editToggleBtn');
            const editBtnText = document.getElementById('editBtnText');
            const saveCancelButtons = document.getElementById('saveCancelButtons');
            const profileCard = document.querySelector('.profile-card');
            
            if (!isEditMode) {
                // Enter edit mode
                isEditMode = true;
                profileCard.classList.add('edit-mode-active');
                
                // Hide main edit button and show save/cancel buttons
                editBtn.style.display = 'none';
                saveCancelButtons.classList.add('show');
                
                // Store original values
                document.querySelectorAll('.profile-info-value.editable').forEach(element => {
                    const field = element.getAttribute('data-field');
                    originalValues[field] = element.textContent.trim();
                });
                
                // Make fields clickable
                document.querySelectorAll('.profile-info-value.editable').forEach(element => {
                    element.addEventListener('click', editField);
                    element.style.cursor = 'pointer';
                    // Add visual indication for editable fields
                    element.style.border = '1px solid #e2e8f0';
                });
                
            } else {
                // This shouldn't happen anymore since button changes function
                exitEditMode();
            }
        }

        function editField(event) {
            if (!isEditMode) return;
            
            const valueElement = event.target;
            const field = valueElement.getAttribute('data-field');
            const inputElement = document.querySelector(`.profile-edit-input[data-field="${field}"]`);
            
            if (inputElement && valueElement.style.display !== 'none') {
                // Hide value, show input
                valueElement.style.display = 'none';
                inputElement.style.display = 'block';
                inputElement.focus();
                
                // Add blur event to save changes
                inputElement.addEventListener('blur', function() {
                    updateFieldValue(field);
                });
                
                // Add enter key to save changes
                inputElement.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' && inputElement.tagName !== 'TEXTAREA') {
                        updateFieldValue(field);
                    }
                });
            }
        }

        function updateFieldValue(field) {
            const valueElement = document.querySelector(`.profile-info-value[data-field="${field}"]`);
            const inputElement = document.querySelector(`.profile-edit-input[data-field="${field}"]`);
            
            if (valueElement && inputElement) {
                const newValue = inputElement.value.trim();
                valueElement.textContent = newValue || 'Belum diisi';
                
                // Hide input, show value
                inputElement.style.display = 'none';
                valueElement.style.display = 'block';
            }
        }

        function saveInlineChanges() {
            // Collect all changed values
            const formData = new FormData();
            let hasChanges = false;
            
            document.querySelectorAll('.profile-edit-input').forEach(input => {
                const field = input.getAttribute('data-field');
                const newValue = input.value.trim();
                const originalValue = originalValues[field] === 'Belum diisi' ? '' : originalValues[field];
                
                if (newValue !== originalValue) {
                    // Map field names for backend compatibility
                    let backendField = field;
                    if (field === 'tahun_berdiri') backendField = 'tahun_berdiri';
                    if (field === 'lokasi_kantor') backendField = 'lokasi_kantor';
                    if (field === 'bidang_usaha') backendField = 'bidang_usaha';
                    
                    formData.append(backendField, newValue);
                    hasChanges = true;
                }
            });
            
            if (!hasChanges) {
                exitEditMode();
                return;
            }
            
            // Add CSRF token and method
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PUT');
            
            // Show loading state on save button
            const saveBtn = document.querySelector('.btn-save-inline');
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Menyimpan...';
            saveBtn.disabled = true;
            
            // Send AJAX request
            fetch('{{ route("perusahaan.profile.update") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showToast('Profil berhasil diperbarui!', 'success');
                    exitEditMode();
                } else {
                    showToast('Gagal memperbarui profil: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan saat menyimpan perubahan', 'error');
            })
            .finally(() => {
                saveBtn.innerHTML = originalText;
                saveBtn.disabled = false;
            });
        }

        function cancelInlineEdit() {
            // Restore original values
            document.querySelectorAll('.profile-info-value.editable').forEach(element => {
                const field = element.getAttribute('data-field');
                const inputElement = document.querySelector(`.profile-edit-input[data-field="${field}"]`);
                
                if (originalValues[field]) {
                    element.textContent = originalValues[field];
                    if (inputElement) {
                        inputElement.value = originalValues[field] === 'Belum diisi' ? '' : originalValues[field];
                    }
                }
                
                // Hide input, show value
                if (inputElement) {
                    inputElement.style.display = 'none';
                }
                element.style.display = 'block';
                // Remove visual indicators
                element.style.border = '1px solid transparent';
            });
            
            exitEditMode();
        }

        function exitEditMode() {
            isEditMode = false;
            const editBtn = document.getElementById('editToggleBtn');
            const editBtnText = document.getElementById('editBtnText');
            const saveCancelButtons = document.getElementById('saveCancelButtons');
            const profileCard = document.querySelector('.profile-card');
            
            // Show main edit button and hide save/cancel buttons
            profileCard.classList.remove('edit-mode-active');
            editBtn.style.display = 'flex';
            editBtn.classList.remove('save-mode');
            editBtnText.textContent = 'Edit Profil';
            editBtn.querySelector('i').className = 'bi bi-pencil-square';
            
            // Hide save/cancel buttons
            saveCancelButtons.classList.remove('show');
            
            // Remove click listeners and visual indicators
            document.querySelectorAll('.profile-info-value.editable').forEach(element => {
                element.removeEventListener('click', editField);
                element.style.cursor = 'default';
                element.style.border = '1px solid transparent';
            });
            
            // Hide all inputs, show all values
            document.querySelectorAll('.profile-edit-input').forEach(input => {
                input.style.display = 'none';
            });
            document.querySelectorAll('.profile-info-value.editable').forEach(value => {
                value.style.display = 'block';
            });
        }

        function showToast(message, type = 'info') {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : 'error'}`;
            toast.style.position = 'fixed';
            toast.style.top = '20px';
            toast.style.right = '20px';
            toast.style.zIndex = '9999';
            toast.style.minWidth = '300px';
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            // Remove toast after 3 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 3000);
        }
    </script>
    @endpush