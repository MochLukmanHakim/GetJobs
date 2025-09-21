@extends('layouts.app')

@section('title', 'Detail Pekerjaan - GetJobs')
@section('page-title', 'Detail Pekerjaan')

@php
    $activePage = 'pekerjaan';
@endphp

@push('styles')
<style>
    /* Job Detail Page - Consistent with GetJobs Design */
    .detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0;
    }


    /* Job Header Card */
    .job-header-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .job-header-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6a879c 0%, #223046 100%);
    }

    .job-title {
        font-size: 32px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 16px;
        line-height: 1.2;
    }

    .job-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 24px;
        margin-top: 24px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .meta-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .meta-icon.location { background: #dbeafe; color: #1d4ed8; }
    .meta-icon.salary { background: #d1fae5; color: #059669; }
    .meta-icon.category { background: #fef3c7; color: #d97706; }
    .meta-icon.applicants { background: #f3e8ff; color: #7c3aed; }

    .meta-content h4 {
        font-size: 12px;
        font-weight: 500;
        color: #6b7280;
        margin: 0 0 4px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .meta-content p {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    /* Main Content Layout */
    .detail-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
    }

    /* Main Content Card */
    .main-content-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        padding: 24px 32px 0 32px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 0;
    }

    .card-header h2 {
        font-size: 20px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 24px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-content {
        padding: 0 32px 32px 32px;
    }

    .description-content {
        font-size: 15px;
        line-height: 1.7;
        color: #374151;
        background: #f9fafb;
        padding: 24px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        white-space: pre-wrap;
        margin: 0;
    }

    /* Sidebar Cards */
    .sidebar-content {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .info-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .info-card-header {
        padding: 20px 24px 0 24px;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-card-header h3 {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 20px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-card-content {
        padding: 0 24px 24px 24px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-item:first-child {
        padding-top: 0;
    }

    .info-label {
        font-weight: 500;
        color: #6b7280;
        font-size: 13px;
    }

    .info-value {
        font-weight: 600;
        color: #111827;
        font-size: 13px;
        text-align: right;
    }

    /* Status Badge - Matching main app style */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: capitalize;
    }


    .status-badge.aktif {
        background: #d1fae5;
        color: #059669;
    }

    .status-badge.tutup {
        background: #fee2e2;
        color: #dc2626;
    }

    /* Progress Bar */
    .progress-container {
        margin-top: 16px;
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: #f3f4f6;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 8px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #6a879c 0%, #223046 100%);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .progress-text {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
        text-align: center;
    }

    /* Status Colors for Applicant Statistics */
    .status-review {
        color: #d97706;
        font-weight: 600;
    }

    .status-accepted {
        color: #059669;
        font-weight: 600;
    }

    .status-rejected {
        color: #dc2626;
        font-weight: 600;
    }

    /* View Applicants Button */
    .view-applicants-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #1e293b;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 6px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
        width: 100%;
        justify-content: center;
    }

    .view-applicants-btn:hover {
        background: #e2e8f0;
        border-color: #cbd5e1;
        color: #0f172a;
        transform: translateY(-1px);
    }

    /* Action Buttons - Matching main app style */
    .action-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 32px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        white-space: nowrap;
    }

    .btn-primary {
        background: #000000;
        color: white;
    }

    .btn-primary:hover {
        background: #333333;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-secondary {
        background: white;
        color: #6b7280;
        border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
        background: #f9fafb;
        border-color: #9ca3af;
        color: #374151;
    }

    .btn-warning {
        background: #f59e0b;
        color: white;
    }

    .btn-warning:hover {
        background: #d97706;
        transform: translateY(-1px);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .detail-container {
            padding: 0 16px;
        }
    }

    @media (max-width: 768px) {
        .job-header-card {
            padding: 24px;
        }

        .job-title {
            font-size: 24px;
        }

        .job-meta {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .detail-content {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .card-header,
        .card-content {
            padding: 20px;
        }

        .card-header {
            padding-bottom: 0;
        }

        .info-card-header,
        .info-card-content {
            padding: 16px 20px;
        }

        .info-card-header {
            padding-bottom: 0;
        }

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .btn {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .job-header-card {
            padding: 20px;
        }

        .meta-item {
            padding: 12px;
        }

        .meta-icon {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }

        .meta-content p {
            font-size: 14px;
        }
    }

    /* Job History Section Styles - Matching Dashboard */
    .job-history-section {
        margin-top: 48px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .history-title {
        font-size: 20px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .history-table-header {
        display: grid;
        grid-template-columns: 2fr 1fr 0.8fr 0.8fr 1fr 0.8fr;
        gap: 16px;
        padding: 16px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        font-weight: 600;
        font-size: 12px;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .history-header-item {
        font-weight: 600;
        color: #374151;
        font-size: 14px;
        text-align: left;
    }

    .history-header-item:nth-child(3) {
        text-align: center;
    }

    .history-header-item:nth-child(5) {
        text-align: center;
    }

    .history-job-cards {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .history-job-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .history-job-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 18px 24px;
        transition: all 0.3s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        cursor: pointer;
    }

    .history-job-link:hover .history-job-card {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-color: #d1d5db;
    }

    .history-job-link:hover .history-job-details h4 {
        color: #3b82f6;
    }

    .history-job-card-content {
        display: grid;
        grid-template-columns: 2fr 1fr 0.8fr 0.8fr 1fr 0.8fr;
        gap: 16px;
        align-items: center;
        padding: 16px 24px;
    }

    .history-job-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .history-job-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 12px;
    }

    .history-job-details h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 2px;
    }

    .history-job-details p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    .history-job-position {
        font-size: 14px;
        color: #374151;
        font-weight: 500;
    }

    .history-applicant-count {
        font-size: 14px;
        color: #3b82f6;
        font-weight: 600;
        text-align: center;
    }

    .history-posting-date {
        font-size: 14px;
        color: #6b7280;
        font-weight: 500;
    }

    .history-job-status {
        display: flex;
        align-items: center;
        gap: 6px;
        justify-content: center;
    }

    .history-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .history-status-dot.aktif {
        background: #10b981;
    }

    .history-status-dot.tutup {
        background: #ef4444;
    }


    .history-status-text {
        font-size: 12px;
        font-weight: 500;
    }

    .history-status-text.aktif {
        color: #059669;
    }

    .history-status-text.tutup {
        color: #dc2626;
    }


    /* Job History Button Section */
    .job-history-button-section {
        margin-top: 32px;
        text-align: center;
        padding: 24px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .history-job-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: white;
        color: #3b82f6;
        border: 2px solid #3b82f6;
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .history-job-btn:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .history-job-btn svg {
        transition: transform 0.2s ease;
    }

    .history-job-btn:hover svg {
        transform: scale(1.1);
    }

    /* Modal Styles */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-content {
        background: white;
        border-radius: 16px;
        width: 100%;
        max-width: 1000px;
        max-height: 80vh;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 24px 32px;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .modal-header h2 {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }

    .close-btn {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }

    .modal-body {
        padding: 0;
        max-height: calc(80vh - 100px);
        overflow-y: auto;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .modal {
            padding: 10px;
        }
        
        .modal-content {
            max-height: 90vh;
        }
        
        .modal-header {
            padding: 20px;
        }
        
        .modal-header h2 {
            font-size: 18px;
        }
        
        .history-job-btn .btn-text {
            display: none;
        }
        
        .job-history-button-section {
            padding: 16px;
        }
        
        .history-table-header {
            display: none;
        }
        
        .history-job-card-content {
            display: block;
            padding: 16px;
        }
        
        .history-job-card-content > div {
            margin-bottom: 8px;
        }
        
        .history-job-card-content > div:before {
            content: attr(data-label);
            font-weight: 600;
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }
        
        .history-job-info:before { content: "Pekerjaan"; }
        .history-job-position:before { content: "Kategori"; }
        .history-applicant-count:before { content: "Pelamar"; }
        .history-accepted-count:before { content: "Diterima"; }
        .history-posting-date:before { content: "Tanggal"; }
        .history-job-status:before { content: "Status"; }
    }

    /* View All Jobs Button */
    .history-view-all {
        margin-top: 24px;
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #f3f4f6;
    }

    .view-all-jobs-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #6a879c;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .view-all-jobs-btn:hover {
        background: linear-gradient(90deg, #6a879c 0%, #223046 100%);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Responsive for Job History */
    @media (max-width: 1200px) {
        .history-table-header,
        .history-job-card-content {
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .job-history-section {
            padding: 24px;
            margin-top: 32px;
        }
        
        .history-table-header {
            display: none;
        }
        
        .history-job-card-content {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .history-job-card {
            padding: 12px 16px;
        }
        
        .history-job-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        
        .history-job-details h4 {
            font-size: 16px;
        }
        
        .history-job-position,
        .history-applicant-count,
        .history-posting-date,
        .history-job-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .history-job-position::before {
            content: "Kategori: ";
            font-weight: 600;
            color: #374151;
        }
        
        .history-applicant-count::before {
            content: "Pelamar: ";
            font-weight: 600;
            color: #374151;
        }
        
        .history-posting-date::before {
            content: "Tanggal: ";
            font-weight: 600;
            color: #374151;
        }
        
        .history-job-status::before {
            content: "Status: ";
            font-weight: 600;
            color: #374151;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">

    <!-- Job Header Card -->
    <div class="job-header-card">
        <h1 class="job-title">{{ $pekerjaan->judul_pekerjaan }}</h1>
        
        <div class="job-meta">
            <div class="meta-item">
                <div class="meta-icon location">📍</div>
                <div class="meta-content">
                    <h4>Lokasi</h4>
                    <p>{{ ucfirst($pekerjaan->lokasi_pekerjaan) }}</p>
                </div>
            </div>
            
            <div class="meta-item">
                <div class="meta-icon salary">💵</div>
                <div class="meta-content">
                    <h4>Gaji</h4>
                    <p>{{ $pekerjaan->gaji_pekerjaan }}</p>
                </div>
            </div>
            
            <div class="meta-item">
                <div class="meta-icon category">📋</div>
                <div class="meta-content">
                    <h4>Kategori</h4>
                    <p>@php
                        $categoryMap = [
                            'technology' => 'Technology',
                            'design' => 'Design',
                            'marketing' => 'Marketing',
                            'finance' => 'Finance',
                            'hr' => 'Human Resources'
                        ];
                        $displayCategory = $categoryMap[$pekerjaan->kategori_pekerjaan] ?? ucfirst($pekerjaan->kategori_pekerjaan);
                    @endphp
                    {{ $displayCategory }}</p>
                </div>
            </div>
            
            <div class="meta-item">
                <div class="meta-icon applicants">👥</div>
                <div class="meta-content">
                    <h4>Pelamar</h4>
                    <p>{{ $pekerjaan->pelamars_count ?? 0 }}/{{ $pekerjaan->jumlah_pelamar_diinginkan }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="detail-content">
        <!-- Main Content -->
        <div class="main-content-card">
            <div class="card-header">
                <h2>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14,2 14,8 20,8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10,9 9,9 8,9"></polyline>
                    </svg>
                    Deskripsi Pekerjaan
                </h2>
            </div>
            <div class="card-content">
                <div class="description-content">{{ $pekerjaan->deskripsi_pekerjaan }}</div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar-content">
            <!-- Job Information -->
            <div class="info-card">
                <div class="info-card-header">
                    <h3>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        Informasi Lowongan
                    </h3>
                </div>
                <div class="info-card-content">
                    <div class="info-item">
                        <span class="info-label">ID Lowongan</span>
                        <span class="info-value">#{{ $pekerjaan->id_pekerjaan }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="status-badge {{ $pekerjaan->status }}">
                            @if($pekerjaan->status === 'aktif')
                                ✅ Aktif
                            @elseif($pekerjaan->status === 'tutup')
                                ❌ Tutup
                            @endif
                        </span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Tanggal Dibuat</span>
                        <span class="info-value">{{ $pekerjaan->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Terakhir Diupdate</span>
                        <span class="info-value">{{ $pekerjaan->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Applicant Statistics -->
            <div class="info-card">
                <div class="info-card-header">
                    <h3>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Statistik Pelamar
                    </h3>
                </div>
                <div class="info-card-content">
                    <div class="info-item">
                        <span class="info-label">Total Pelamar</span>
                        <span class="info-value">{{ $pekerjaan->pelamars_count ?? 0 }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Target Pelamar</span>
                        <span class="info-value">{{ $pekerjaan->jumlah_pelamar_diinginkan }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Sisa Kuota</span>
                        <span class="info-value">{{ max(0, $pekerjaan->jumlah_pelamar_diinginkan - ($pekerjaan->pelamars_count ?? 0)) }}</span>
                    </div>
                    
                    @php
                        $progress = $pekerjaan->jumlah_pelamar_diinginkan > 0 
                            ? min(100, (($pekerjaan->pelamars_count ?? 0) / $pekerjaan->jumlah_pelamar_diinginkan) * 100) 
                            : 0;
                    @endphp
                    <div class="info-item">
                        <span class="info-label">Progress</span>
                        <span class="info-value">{{ number_format($progress, 1) }}%</span>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $progress }}%"></div>
                        </div>
                        <div class="progress-text">{{ number_format($progress, 1) }}% dari target tercapai</div>
                    </div>
                </div>
            </div>

            <!-- Detailed Applicant Status -->
            <div class="info-card">
                <div class="info-card-header">
                    <h3>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <path d="M20 8v6M23 11l-3 3-3-3"></path>
                        </svg>
                        Status Pelamar
                    </h3>
                </div>
                <div class="info-card-content">
                    <div class="info-item">
                        <span class="info-label">Sedang Review</span>
                        <span class="info-value status-review">{{ $pekerjaan->pelamars_review_count ?? 0 }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Diterima</span>
                        <span class="info-value status-accepted">{{ $pekerjaan->pelamars_accepted_count ?? 0 }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Ditolak</span>
                        <span class="info-value status-rejected">{{ $pekerjaan->pelamars_rejected_count ?? 0 }}</span>
                    </div>
                    
                    @if(($pekerjaan->pelamars_count ?? 0) > 0)
                        @php
                            $acceptanceRate = (($pekerjaan->pelamars_accepted_count ?? 0) / $pekerjaan->pelamars_count) * 100;
                        @endphp
                        <div class="info-item">
                            <span class="info-label">Tingkat Penerimaan</span>
                            <span class="info-value">{{ number_format($acceptanceRate, 1) }}%</span>
                        </div>
                        
                        <div class="info-item" style="border-top: 1px solid #f3f4f6; padding-top: 16px; margin-top: 8px;">
                            <a href="{{ route('pelamar.index', ['pekerjaan_id' => $pekerjaan->id_pekerjaan]) }}" class="view-applicants-btn">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <path d="M20 8v6M23 11l-3 3-3-3"></path>
                                </svg>
                                Lihat Semua Pelamar
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('pekerjaan.index') }}" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Kembali
        </a>
        
        <a href="{{ route('pekerjaan.index') }}#edit-{{ $pekerjaan->id_pekerjaan }}" class="btn btn-primary" onclick="event.preventDefault(); window.location.href='{{ route('pekerjaan.index') }}'; setTimeout(() => { openEditJobModal({{ $pekerjaan->id_pekerjaan }}, {{ json_encode($pekerjaan->judul_pekerjaan) }}, {{ json_encode($pekerjaan->lokasi_pekerjaan) }}, {{ json_encode($pekerjaan->gaji_pekerjaan) }}, {{ json_encode($pekerjaan->kategori_pekerjaan) }}, {{ json_encode($pekerjaan->deskripsi_pekerjaan) }}, {{ json_encode($pekerjaan->status) }}, {{ $pekerjaan->jumlah_pelamar_diinginkan ?? 5 }}); }, 500);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            Edit Lowongan
        </a>
    </div>

    <!-- Job History Button -->
    <div class="job-history-button-section">
        <button onclick="openJobHistoryModal()" class="history-job-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                <polyline points="9,22 9,12 15,12 15,22"></polyline>
            </svg>
            <span class="btn-text">Riwayat Pekerjaan</span>
        </button>
    </div>

    <!-- Job History Modal -->
    <div id="jobHistoryModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                        <polyline points="9,22 9,12 15,12 15,22"></polyline>
                    </svg>
                    Riwayat Pekerjaan
                </h2>
                <button class="close-btn" onclick="closeJobHistoryModal()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Table Header -->
                <div class="history-table-header">
                    <div class="history-header-item">Judul Pekerjaan</div>
                    <div class="history-header-item">Kategori</div>
                    <div class="history-header-item">Pelamar</div>
                    <div class="history-header-item">Diterima</div>
                    <div class="history-header-item">Tanggal Posting</div>
                    <div class="history-header-item">Status</div>
                </div>
                
                <div id="historyJobCards" class="history-job-cards">
                    <!-- Content will be loaded by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Job History Modal Functions
function openJobHistoryModal() {
    const modal = document.getElementById('jobHistoryModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    loadJobHistory();
}

function closeJobHistoryModal() {
    const modal = document.getElementById('jobHistoryModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function loadJobHistory() {
    const historyContainer = document.getElementById('historyJobCards');
    if (!historyContainer) return;

    // Show loading state
    historyContainer.innerHTML = '<div style="text-align: center; padding: 40px; color: #6b7280;">Memuat riwayat pekerjaan...</div>';

    // Fetch job history from API
    fetch('/api/job-history')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                // Convert ISO date strings back to Date objects
                const jobsWithDates = data.data.map(job => ({
                    ...job,
                    created_at: new Date(job.created_at),
                    closed_at: new Date(job.closed_at)
                }));
                
                renderJobHistory(jobsWithDates);
            } else {
                // Show dummy data if no real jobs exist
                const dummyJobs = [
                    {
                        id_pekerjaan: 1,
                        judul_pekerjaan: 'UI/UX Designer',
                        kategori_pekerjaan: 'design',
                        pelamars_count: 6,
                        pelamars_accepted_count: 2,
                        jumlah_pelamar_diinginkan: 6,
                        created_at: new Date('2024-01-15'),
                        status: 'tutup'
                    },
                    {
                        id_pekerjaan: 2,
                        judul_pekerjaan: 'Marketing Specialist',
                        kategori_pekerjaan: 'marketing',
                        pelamars_count: 8,
                        pelamars_accepted_count: 3,
                        jumlah_pelamar_diinginkan: 8,
                        created_at: new Date('2024-01-10'),
                        status: 'tutup'
                    },
                    {
                        id_pekerjaan: 3,
                        judul_pekerjaan: 'Senior Backend Developer',
                        kategori_pekerjaan: 'technology',
                        pelamars_count: 12,
                        pelamars_accepted_count: 4,
                        jumlah_pelamar_diinginkan: 10,
                        created_at: new Date('2024-01-05'),
                        status: 'tutup'
                    }
                ];
                renderJobHistory(dummyJobs);
            }
        })
        .catch(error => {
            console.error('Error loading job history:', error);
            historyContainer.innerHTML = '<div style="text-align: center; padding: 40px; color: #dc2626;">Terjadi kesalahan saat memuat data</div>';
        });
}

function renderJobHistory(jobs) {
    const historyContainer = document.getElementById('historyJobCards');
    
    if (jobs.length === 0) {
        historyContainer.innerHTML = '<div class="no-jobs"><p>Belum ada riwayat pekerjaan yang tersedia</p></div>';
        return;
    }

    const categoryMap = {
        'technology': 'Technology',
        'design': 'Design',
        'marketing': 'Marketing',
        'finance': 'Finance',
        'hr': 'Human Resources'
    };

    const jobsHTML = jobs.map(job => {
        const displayCategory = categoryMap[job.kategori_pekerjaan] || job.kategori_pekerjaan.charAt(0).toUpperCase() + job.kategori_pekerjaan.slice(1);
        const jobAvatar = job.judul_pekerjaan.substring(0, 2).toUpperCase();
        const formattedDate = job.created_at.toLocaleDateString('id-ID', { 
            day: 'numeric', 
            month: 'short', 
            year: 'numeric' 
        });

        return `
            <a href="/pekerjaan/${job.id_pekerjaan}" class="history-job-link">
                <div class="history-job-card" data-status="${job.status}">
                    <div class="history-job-card-content">
                        <div class="history-job-info">
                            <div class="history-job-avatar">${jobAvatar}</div>
                            <div class="history-job-details">
                                <h4>${job.judul_pekerjaan}</h4>
                                <p>ID: #${job.id_pekerjaan}</p>
                            </div>
                        </div>
                        <div class="history-job-position">${displayCategory}</div>
                        <div class="history-applicant-count">${job.pelamars_count || 0}/${job.jumlah_pelamar_diinginkan || 5}</div>
                        <div class="history-accepted-count" style="color: #059669; font-weight: 600;">${job.pelamars_accepted_count || 0}</div>
                        <div class="history-posting-date">${formattedDate}</div>
                        <div class="history-job-status">
                            <div class="history-status-dot ${job.status}"></div>
                            <span class="history-status-text ${job.status}">${job.status.charAt(0).toUpperCase() + job.status.slice(1)}</span>
                        </div>
                    </div>
                </div>
            </a>
        `;
    }).join('');

    historyContainer.innerHTML = jobsHTML;
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('jobHistoryModal');
    if (event.target === modal) {
        closeJobHistoryModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeJobHistoryModal();
    }
});
</script>

@endsection
                                            