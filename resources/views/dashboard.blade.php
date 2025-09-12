@extends('layouts.app')

@section('title', 'Dashboard - GetJobs')
@section('page-title', 'Dashboard')

@php
    $activePage = 'dashboard';
@endphp

@push('styles')
<style>
    /* Dashboard specific styles */
    
    /* Dashboard specific styles - removed forced animation/transition disabling */

    /* Welcome Section Styles */
    .welcome-section {
        background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #1e293b 100%);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        border: none;
        display: flex;
        gap: 32px;
        align-items: flex-start;
        position: relative;
        overflow: hidden;
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(30, 41, 59, 0.95) 0%, rgba(51, 65, 85, 0.95) 50%, rgba(30, 41, 59, 0.95) 100%);
        z-index: 1;
    }

    .welcome-content,
    .notifications-panel {
        position: relative;
        z-index: 2;
    }

    .welcome-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    
    }

    .welcome-greeting {
        display: flex;
        align-items: center;
        gap: 32px;
    }

    .greeting-text h1 {
        font-size: 48px;
        font-weight: 700;
        color: white;
        margin: 0 0 12px 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .greeting-text p {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .greeting-illustration {
        flex-shrink: 0;
    }



    /* Quick Actions */
    .quick-actions {
        display: flex;
        gap: 16px;
        margin-top: 24px;
        justify-content: flex-start;
    }

    .action-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        padding: 16px;
        min-height: 100px;
        width: 180px;
        flex-shrink: 0;
    }

    .action-card:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .action-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .action-card-header h4 {
        font-size: 14px;
        font-weight: 600;
        color: white;
        margin: 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .action-card-content p {
        font-size: 12px;
        line-height: 1.4;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }


    /* Notifications Panel */
    .notifications-panel {
        width: 320px;
        flex-shrink: 0;
    }

    .notifications-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .notifications-header h3 {
        font-size: 18px;
        font-weight: 600;
        color: white;
        margin: 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .see-all {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        font-weight: 500;
        border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    }

    .see-all:hover {
        color: white;
        border-bottom-color: white;
    }

    .notifications-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .notification-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        border: none;
        backdrop-filter: blur(10px);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .notification-item:hover {
        background: rgba(51, 65, 85, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }


    .notification-content {
        flex: 1;
    }

    .notification-content p {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        line-height: 1.4;
    }

    .notification-badge {
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.8);
        flex-shrink: 0;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Responsive Welcome Section */
    @media (max-width: 1024px) {
        .welcome-section {
            flex-direction: column;
            gap: 24px;
        }

        .notifications-panel {
            width: 100%;
        }

        .quick-actions {
            flex-direction: column;
            gap: 12px;
        }
        
        .action-card {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .action-card {
            min-height: 80px;
            padding: 12px;
        }
        
        .action-card-header h4 {
            font-size: 13px;
        }
        
        .action-card-content p {
            font-size: 11px;
        }

        .welcome-section {
            padding: 24px;
        }

        .welcome-greeting {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }
        
        .greeting-text h1 {
            font-size: 36px;
        }
        
        .greeting-text p {
            font-size: 18px;
        }
        
        .professional-character {
            width: 100px;
            height: 100px;
        }

        .greeting-text h1 {
            font-size: 28px;
        }

        .quick-actions {
            justify-content: center;
        }

        .action-item {
            flex-direction: column;
            text-align: center;
            padding: 12px;
            min-width: 80px;
        }

        .notifications-list {
            gap: 8px;
        }

        .notification-item {
            padding: 12px;
        }
    }



        /* Metric Cards */
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
            transition: all 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-1px);
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


        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
            border-bottom: 1.5px solid #e5e7eb;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }






        /* Job Vacancies Table */
        .table-card {
            background: white;
            padding: 32px;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            margin-left: 0;
            transition: all 0.3s ease;
        }

        .table-card:hover {
            transform: translateY(-1px);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }



        .graph-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;

        }

        /* Table Header Row */
        .table-header-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 16px;
            align-items: center;
            padding: 16px 24px;
            background: white;
            border-radius: 12px;
            margin-top: -20px;
            margin-bottom: -10px;
            border: 1px solid #e5e7eb;
        }

        .header-item {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        /* Card-based Table Design */
        .job-cards {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .job-card {
            background: white;
            border-radius: 16px;
            padding: 20px 24px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .job-card:hover {
            transform: translateY(-1px);
        }

        .job-card-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 16px;
            align-items: center;
        }

        .job-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .job-avatar {
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

        .job-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .job-details p {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }

        .job-id {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        .job-position {
            font-size: 14px;
            color: #374151;
            font-weight: 500;
        }

        .job-location {
            font-size: 14px;
            color: #374151;
            font-weight: 500;
        }

        .job-salary {
            font-size: 14px;
            color: #059669;
            font-weight: 600;
        }

        .job-status {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-dot.active {
            background: #10b981;
        }

        .status-dot.closed {
            background: #ef4444;
        }

        .status-dot.draft {
            background: #f59e0b;
        }

        .status-dot.pending {
            background: #f59e0b;
        }

        .status-text {
            font-size: 12px;
            font-weight: 500;
        }

        .status-text.active {
            color: #059669;
        }

        .status-text.closed {
            color: #dc2626;
        }

        .status-text.draft {
            color: #d97706;
        }

        .status-text.pending {
            color: #d97706;
        }

        .applicant-count {
            font-size: 14px;
            font-weight: 600;
            color: #3b82f6;
        }

        .posting-date {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }


        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-top: 32px;
            padding-right: 16px;
        }

        .page-btn {
            padding: 8px 12px;
            border: none;
            background: transparent;
            color: #6B7280;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            min-width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-btn:hover {
            background: #F3F4F6;
            color: #374151;
        }

        .page-btn.active {
            background: #374151;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .page-btn:disabled:hover {
            background: transparent;
            color: #6B7280;
        }

        a.page-btn {
            text-decoration: none;
            color: #6B7280;
        }

        a.page-btn:hover {
            background: #F3F4F6;
            color: #374151;
        }



        /* Responsive */
        @media (max-width: 1200px) {
            .table-header-row,
            .job-card-content {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
                gap: 12px;
            }
        }

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
            
            .table-header-row {
                display: none;
            }
            
            .job-card-content {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .job-card {
                padding: 20px;
            }
            
            .job-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .job-details h4 {
                font-size: 16px;
            }
            
            .job-location,
            .job-salary,
            .job-status,
            .applicant-count,
            .posting-date {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border-bottom: 1px solid #f3f4f6;
            }
            
            .job-location::before {
                content: "Lokasi: ";
                font-weight: 600;
                color: #374151;
            }
            
            .job-salary::before {
                content: "Gaji: ";
                font-weight: 600;
                color: #374151;
            }
            
            .job-status::before {
                content: "Status: ";
                font-weight: 600;
                color: #374151;
            }
            
            .applicant-count::before {
                content: "Pelamar: ";
                font-weight: 600;
                color: #374151;
            }
            
            .posting-date::before {
                content: "Tanggal: ";
                font-weight: 600;
                color: #374151;
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

        /* Applicant Content */
        .dashboard-row {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 32px;
        }
        .dashboard-main-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        .applicant-content {
            width: 240px;
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 24px;
            height: fit-content;
            transition: all 0.3s ease;
        }

        .applicant-content:hover {
            transform: translateY(-1px);
        }
        .applicant-section {
            margin-bottom: 18px;
        }
        .applicant-section-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 25px;
        }
        .applicant-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .applicant-item {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
        }
        .applicant-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 16px;
            top: 32px;
            width: 1px;
            height: 12px;
            background: #e5e7eb;
        }
        .applicant-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 12px;
            flex-shrink: 0;
        }
        .applicant-info {
            flex: 1;
        }
        .applicant-name {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }
        .applicant-status {
            font-size: 11px;
            font-weight: 500;
        }
        .status-rejected {
            color: #dc2626;
        }
        .status-accepted {
            color: #059669;
        }
        .status-pending {
            color: #d97706;
        }
        @media (max-width: 900px) {
            .dashboard-row {
                flex-direction: column;
            }
            .applicant-content {
                width: 100%;
                margin-top: 24px;
            }
        }
        @media (max-width: 768px) {
            .dashboard-row {
                flex-direction: column;
            }
            .applicant-content {
                width: 100%;
                margin-top: 24px;
            }
        }


</style>
@endpush

@section('content')

<!-- Welcome Section -->
<div class="welcome-section">
    <div class="welcome-content">
        <div class="welcome-greeting">
            <div class="greeting-text">
                <h1>Hi, {{ Auth::user()->name ?? 'User' }}!</h1>
                <p>Apa yang akan anda lakukan hari ini?</p>
            </div>
        </div>
        <div class="quick-actions">
            <div class="action-card">
                <div class="action-card-header">
                    <h4>Kelola Pekerjaan</h4>
                </div>
                <div class="action-card-content">
                    <p>Kelola lowongan</p>
                </div>
            </div>
            <div class="action-card">
                <div class="action-card-header">
                    <h4>Kelola Pelamar</h4>
                </div>
                <div class="action-card-content">
                    <p>Review aplikasi</p>
                </div>
            </div>
            <div class="action-card">
                <div class="action-card-header">
                    <h4>Kelola Perusahaan</h4>
                </div>
                <div class="action-card-content">
                    <p>Atur profil</p>
                </div>
            </div>
        </div>
    </div>
    <div class="notifications-panel">
        <div class="notifications-header">
            <h3>Notifications</h3>
            <a href="#" class="see-all">See all</a>
        </div>
        <div class="notifications-list">
            <div class="notification-item">
                <div class="notification-content">
                    <p>Lowongan Backend Developer ditambahkan.</p>
                </div>
            </div>
            <div class="notification-item">
                <div class="notification-content">
                    <p>Pelamar baru untuk Frontend Developer.</p>
                </div>
                
            </div>
            <div class="notification-item">
                <div class="notification-content">
                    <p>Deadline UI/UX Designer dalam 2 hari.</p>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- Gabungan Metric, Grafik, dan Daftar Pelamar -->
            <div class="dashboard-row">
                <div class="dashboard-main-col">
            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-title">Pekerjaan Anda</div>
                    <div class="metric-value">6</div>
                    <div class="metric-change positive">
                        <span>↗</span>
                        +11.02%
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-title">Pelamar Anda</div>
                    <div class="metric-value">25</div>
                    <div class="metric-change negative">
                        <span>↘</span>
                        -0.03%
                    </div>
                </div>
                <div class="metric-card">
                    <div class="metric-title">Pelamar dipanggil</div>
                    <div class="metric-value">10</div>
                    <div class="metric-change positive">
                        <span>↗</span>
                        +15.03%
                    </div>
                </div>
            </div>
            
            <!-- Job Vacancies Table -->
            <h2 class="graph-title">Daftar Pekerjaan</h2>
            <!-- Table Header -->
            <div class="table-header-row">
                <div class="header-item">Judul Pekerjaan</div>
                <div class="header-item">Posisi</div>
                <div class="header-item">Status</div>
                <div class="header-item">Pelamar</div>
                <div class="header-item">Tanggal Posting</div>
            </div>
            
            <div class="job-cards">
                @forelse($pekerjaan as $job)
                <div class="job-card">
                    <div class="job-card-content">
                        <div class="job-info">
                            <div class="job-details">
                                <h4>{{ $job->judul_pekerjaan }}</h4>
                                <p class="job-id">#{{ $job->id_pekerjaan }}</p>
                            </div>
                        </div>
                        <div class="job-position">{{ $job->kategori_pekerjaan }}</div>
                        <div class="job-status">
                            <div class="status-dot {{ $job->status }}"></div>
                            <span class="status-text {{ $job->status }}">{{ ucfirst($job->status) }}</span>
                        </div>
                        <div class="applicant-count">0</div>
                        <div class="posting-date">{{ $job->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                @empty
                <div class="no-jobs">
                    <p>Belum ada pekerjaan yang ditambahkan</p>
                </div>
                @endforelse
            </div>
                </div>
                <div class="applicant-content">
                    <!-- Daftar Pelamar -->
                    <div class="applicant-section">
                        <h3 class="applicant-section-title">Daftar pelamar</h3>
                        <div class="applicant-list">
                            <div class="applicant-item">
                                <div class="applicant-avatar">AG</div>
                        <div class="applicant-info">
                            <div class="applicant-name">Aziz Gagap</div>
                            <div class="applicant-status status-rejected">Ditolak</div>
                        </div>
                            </div>
                            <div class="applicant-item">
                                <div class="applicant-avatar">DS</div>
                        <div class="applicant-info">
                            <div class="applicant-name">Deny Sumargo</div>
                            <div class="applicant-status status-rejected">Ditolak</div>
                        </div>
                            </div>
                            <div class="applicant-item">
                                <div class="applicant-avatar">JJ</div>
                        <div class="applicant-info">
                            <div class="applicant-name">Jamal bin Jamil</div>
                            <div class="applicant-status status-rejected">Ditolak</div>
                        </div>
                            </div>
                            <div class="applicant-item">
                                <div class="applicant-avatar">LC</div>
                        <div class="applicant-info">
                            <div class="applicant-name">Lionel Cristiano</div>
                            <div class="applicant-status status-accepted">Diterima</div>
                        </div>
                            </div>
                            <div class="applicant-item">
                                <div class="applicant-avatar">DY</div>
                        <div class="applicant-info">
                            <div class="applicant-name">Dio YusufTzy</div>
                            <div class="applicant-status status-accepted">Diterima</div>
                        </div>
                            </div>
                            <div class="applicant-item">
                                <div class="applicant-avatar">DY</div>
                        <div class="applicant-info">
                                    <div class="applicant-name">Calmboy Sigma</div>
                                    <div class="applicant-status status-accepted">Diterima</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Menunggu Status -->
                    <div class="applicant-section">
                        <h3 class="applicant-section-title">Menunggu status</h3>
                        <div class="applicant-list">
                            <div class="applicant-item">
                                <div class="applicant-avatar">CS</div>
                                <div class="applicant-info">
                                    <div class="applicant-name">Tulang Beton</div>
                            <div class="applicant-status status-pending">Menunggu</div>
                        </div>
            </div>
                            <div class="applicant-item">
                                <div class="applicant-avatar">AS</div>
                                <div class="applicant-info">
                                    <div class="applicant-name">Kak Gem Elite</div>
                                    <div class="applicant-status status-pending">Menunggu</div>
                                </div>
                            </div>
                            <div class="applicant-item">
                                <div class="applicant-avatar">AS</div>
                                <div class="applicant-info">
                                    <div class="applicant-name">Kim Jong Un</div>
                                    <div class="applicant-status status-pending">Menunggu</div>
                                </div>
                            </div>
                            <!-- <div class="applicant-item">
                                <div class="applicant-avatar">AS</div>
                                <div class="applicant-info">
                                    <div class="applicant-name">Alam Walker</div>
                                    <div class="applicant-status status-pending">Menunggu</div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>


            </div>
@endsection

@push('scripts')
    <script>

        // Action menu functionality removed
    </script>
@endpush