@extends('layouts.app')

@section('title', 'Dashboard - GetJobs')
@section('page-title', 'Dashboard')

@php
    $activePage = 'dashboard';
@endphp

@push('styles')
<style>
    /* Dashboard specific styles */



        /* Metric Cards */
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

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
            border-bottom: 1.5px solid #e5e7eb;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }





        /* Chart container */
        #applicantChart {
            width: 100% !important;
            height: 300px !important;
        }

        /* Job Vacancies Table */
        .table-card {
            background: white;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f1f5f9;
            margin-left: 0;

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
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr;
            gap: 16px;
            align-items: center;
            padding: 12px 20px;
            background: white;
            border-radius: 8px;
            margin-top: 32px;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
        }

        .header-item {
            font-weight: 600;
            color: #374151;
            font-size: 12px;
        }

        /* Card-based Table Design */
        .job-cards {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .job-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px 20px;
            transition: all 0.3s ease;
        }

        .job-card:hover {
            transform: translateY(-1px);
        }

        .job-card-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr;
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
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .job-details p {
            font-size: 11px;
            color: #6b7280;
            margin: 0;
        }

        .job-id {
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
        }

        .job-location {
            font-size: 12px;
            color: #374151;
            font-weight: 500;
        }

        .job-salary {
            font-size: 12px;
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
            font-size: 11px;
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
            font-size: 12px;
            font-weight: 600;
            color: #3b82f6;
        }

        .posting-date {
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
        }



        /* Responsive */
        @media (max-width: 1200px) {
            .table-header-row,
            .job-card-content {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr;
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
            gap: 20px;
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
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 16px;
            height: fit-content;
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
        @media (max-width: 1100px) {
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
            <div class="graph-card">
                <div class="graph-header">
                    <h2 class="graph-title">Grafik Pelamar</h2>
                    <div class="graph-legend">
                        <div class="legend-item">
                            <div class="legend-dot this-year"></div>
                            <span>This Year</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot last-year"></div>
                            <span>Last Year</span>
                        </div>
                    </div>
                </div>
                <canvas id="applicantChart"></canvas>
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
                            <div class="applicant-item">
                                <div class="applicant-avatar">AS</div>
                                <div class="applicant-info">
                                    <div class="applicant-name">Alam Walker</div>
                                    <div class="applicant-status status-pending">Menunggu</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Vacancies Table -->
                            <h2 class="graph-title">Daftar Pekerjaan</h2>
            <!-- Table Header -->
            <div class="table-header-row">
                <div class="header-item">Posisi</div>
                <div class="header-item">Lokasi</div>
                <div class="header-item">Gaji</div>
                <div class="header-item">Status</div>
                <div class="header-item">Pelamar</div>
                <div class="header-item">Tanggal Posting</div>
            </div>
            
            <div class="job-cards">
                    <!-- Job Card 1 -->
                    <div class="job-card">
                        <div class="job-card-content">
                            <div class="job-info">
                                <div class="job-avatar">FD</div>
                                <div class="job-details">
                                    <h4>Frontend Developer</h4>
                                    <p class="job-id">#2632</p>
                                </div>
                            </div>
                            <div class="job-location">Jakarta</div>
                            <div class="job-salary">Rp 8.000.000</div>
                            <div class="job-status">
                                <div class="status-dot active"></div>
                                <span class="status-text active">Aktif</span>
                            </div>
                            <div class="applicant-count">12</div>
                            <div class="posting-date">15 Mar 2024</div>
                        </div>
                    </div>
                    
                    <!-- Job Card 2 -->
                    <div class="job-card">
                        <div class="job-card-content">
                            <div class="job-info">
                                <div class="job-avatar">BD</div>
                                <div class="job-details">
                                    <h4>Backend Developer</h4>
                                    <p class="job-id">#2633</p>
                                </div>
                            </div>
                            <div class="job-location">Bandung</div>
                            <div class="job-salary">Rp 10.000.000</div>
                            <div class="job-status">
                                <div class="status-dot active"></div>
                                <span class="status-text active">Aktif</span>
                            </div>
                            <div class="applicant-count">8</div>
                            <div class="posting-date">12 Mar 2024</div>
                        </div>
                    </div>
                    
                    <!-- Job Card 3 -->
                    <div class="job-card">
                        <div class="job-card-content">
                            <div class="job-info">
                                <div class="job-avatar">UX</div>
                                <div class="job-details">
                                    <h4>UI/UX Designer</h4>
                                    <p class="job-id">#2634</p>
                                </div>
                            </div>
                            <div class="job-location">Surabaya</div>
                            <div class="job-salary">Rp 7.500.000</div>
                            <div class="job-status">
                                <div class="status-dot closed"></div>
                                <span class="status-text closed">Ditutup</span>
                            </div>
                            <div class="applicant-count">15</div>
                            <div class="posting-date">10 Mar 2024</div>
                        </div>
                    </div>
                    
                    <!-- Job Card 4 -->
                    <div class="job-card">
                        <div class="job-card-content">
                            <div class="job-info">
                                <div class="job-avatar">PM</div>
                                <div class="job-details">
                                    <h4>Product Manager</h4>
                                    <p class="job-id">#2635</p>
                                </div>
                            </div>
                            <div class="job-location">Yogyakarta</div>
                            <div class="job-salary">Rp 15.000.000</div>
                            <div class="job-status">
                                <div class="status-dot draft"></div>
                                <span class="status-text draft">Draft</span>
                            </div>
                            <div class="applicant-count">0</div>
                            <div class="posting-date">08 Mar 2024</div>
                        </div>
                    </div>
                    
                    <!-- Job Card 5 -->
                    <div class="job-card">
                        <div class="job-card-content">
                            <div class="job-info">
                                <div class="job-avatar">DA</div>
                                <div class="job-details">
                                    <h4>Data Analyst</h4>
                                    <p class="job-id">#2636</p>
                                </div>
                            </div>
                            <div class="job-location">Medan</div>
                            <div class="job-salary">Rp 9.000.000</div>
                            <div class="job-status">
                                <div class="status-dot active"></div>
                                <span class="status-text active">Aktif</span>
                            </div>
                            <div class="applicant-count">6</div>
                            <div class="posting-date">05 Mar 2024</div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('applicantChart').getContext('2d');
        const applicantChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [
                    {
                        label: 'This Year',
                        data: [5, 12, 8, 15, 20, 18, 25],
                        borderColor: '#1F2937',
                        backgroundColor: 'rgba(31, 41, 55, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: '#1F2937',
                        pointBorderColor: '#1F2937',
                        borderWidth: 2
                    },
                    {
                        label: 'Last Year',
                        data: [3, 8, 6, 10, 12, 14, 16],
                        borderColor: '#9CA3AF',
                        backgroundColor: 'transparent',
                        tension: 0.4,
                        fill: false,
                        borderDash: [5, 5],
                        pointRadius: 4,
                        pointBackgroundColor: '#9CA3AF',
                        pointBorderColor: '#9CA3AF',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6B7280'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: 30,
                        ticks: {
                            stepSize: 10,
                            color: '#6B7280'
                        },
                        grid: {
                            color: '#F3F4F6'
                        }
                    }
                }
            }
        });
    </script>
@endpush