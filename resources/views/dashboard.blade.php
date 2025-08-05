<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - GetJobs</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Left Sidebar */
        .sidebar {
            width: 240px;
            background: white;
            color: #333;
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar-header {
            padding: 29px 20px 20px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 20px;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 12px;
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo-image {
            width: 140px;
            height: auto;
            object-fit: contain;
        }





        .nav-menu {
            list-style: none;
            padding: 0 16px;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #577C8E;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 13px;
            position: relative;
        }

        .nav-link:hover {
            background: #C7E0F6;
            color: #2F4157;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .nav-icon {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #577C8E;
        }

        .nav-link.active .nav-icon {
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 240px;
            padding: 24px 32px;
            background: #F9FAFB;
        }

        /* Top Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .profile-mini {
            display: flex;
            align-items: center;
            gap: 8px;
            background: none;
            position: relative;
            cursor: pointer;
        }
        .profile-mini-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 15px;
        }
        .profile-mini-name {
            font-size: 14px;
            font-weight: 600;
            color: #2F4157;
        }
        .profile-dropdown-menu {
            display: none;
            position: absolute;
            top: 110%;
            right: 0;
            min-width: 140px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            z-index: 100;
            padding: 8px 0;
        }
        .profile-dropdown-menu.show {
            display: block;
        }
        .profile-dropdown-item {
            padding: 10px 20px;
            font-size: 14px;
            color: #374151;
            cursor: pointer;
            transition: background 0.2s;
            text-align: left;
            background: none;
            border: none;
            width: 100%;
            display: block;
        }
        .profile-dropdown-item:hover {
            background: #f3f4f6;
        }

        .notification-icon {
            position: relative;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 14px;
            background: none;
        }

        .notification-icon:hover {
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 14px;
            height: 14px;
            background: #ef4444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            color: white;
            font-weight: 600;
        }

        .logout-button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .logout-button:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .logout-link {
            color: #111827;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .logout-link:hover {
            color: #374151;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #111827;
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
                width: 100%;
                position: relative;
                height: auto;
            }
            .main-content {
                margin-left: 0;
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
</head>
<body>
    <div class="dashboard-container">
        <!-- Left Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="profile-section">
                    <div class="profile-avatar">
                        <img src="/images/logo-getjobs2.png" alt="GetJobs Logo" class="logo-image">
                    </div>
                </div>
            </div>
            
            <nav class="nav-menu">
                <div class="nav-item">
                    <a href="/dashboard" class="nav-link active">
                        <span class="nav-icon">🏠</span>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/lowongan" class="nav-link">
                        <span class="nav-icon">💼</span>
                        Lowongan
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/pelamar" class="nav-link">
                        <span class="nav-icon">👥</span>
                        Pelamar
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/statistik" class="nav-link">
                        <span class="nav-icon">📊</span>
                        Statistik
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/account" class="nav-link">
                        <span class="nav-icon">👤</span>
                        Account
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Header -->
            <div class="top-header">
                <h1 class="page-title">Dashboard</h1>
                <div class="header-right">
                    <button class="notification-icon">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#clip0_399_2036)">
                            <path d="M13.73 21.5C13.5544 21.8033 13.3021 22.0552 12.9985 22.2302C12.6948 22.4053 12.3505 22.4974 12 22.4974C11.6495 22.4974 11.3052 22.4053 11.0015 22.2302C10.6979 22.0552 10.4456 21.8033 10.27 21.5M18.134 11.5C18.715 16.875 21 18.5 21 18.5H3C3 18.5 6 16.367 6 8.9C6 7.203 6.632 5.575 7.757 4.375C8.883 3.175 10.41 2.5 12 2.5C12.337 2.5 12.672 2.53 13 2.59L18.134 11.5ZM19 8.5C19.7956 8.5 20.5587 8.18393 21.1213 7.62132C21.6839 7.05871 22 6.29565 22 5.5C22 4.70435 21.6839 3.94129 21.1213 3.37868C20.5587 2.81607 19.7956 2.5 19 2.5C18.2044 2.5 17.4413 2.81607 16.8787 3.37868C16.3161 3.94129 16 4.70435 16 5.5C16 6.29565 16.3161 7.05871 16.8787 7.62132C17.4413 8.18393 18.2044 8.5 19 8.5Z" stroke="#282828" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <ellipse cx="5.4" cy="5.4" rx="5.4" ry="5.4" transform="matrix(-1 0 0 1 22.8008 0.5)" fill="url(#paint0_linear_399_2036)"/>
                          </g>
                          <defs>
                            <linearGradient id="paint0_linear_399_2036" x1="0" y1="5.4" x2="10.8" y2="5.4" gradientUnits="userSpaceOnUse">
                              <stop stop-color="#577C8E"/>
                              <stop offset="1" stop-color="#263446"/>
                            </linearGradient>
                            <clipPath id="clip0_399_2036">
                              <rect width="24" height="24" fill="white" transform="translate(0 0.5)"/>
                            </clipPath>
                          </defs>
                        </svg>
                        <div class="notification-badge">3</div>
                    </button>
                    <div class="profile-mini profile-dropdown" id="profileDropdown" onclick="toggleProfileDropdown(event)">
                        <div class="profile-mini-avatar">LH</div>
                        <span class="profile-mini-name">Lukman Hakim</span>
                        <svg style="margin-left:4px;" width="16" height="16" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 6 8 10 12 6"/></svg>
                        <div class="profile-dropdown-menu" id="profileDropdownMenu">
                            <button class="profile-dropdown-item" onclick="window.location.href='/profile';return false;">Profile</button>
                            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                @csrf
                                <button type="submit" class="profile-dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gabungan Metric, Grafik, dan Daftar Pelamar -->
            <div class="dashboard-row">
                <div class="dashboard-main-col">
            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-title">Lowongan Anda</div>
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
            <h2 class="graph-title">Daftar Lowongan</h2>
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
        </main>


    </div>

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
    <script>
function toggleProfileDropdown(event) {
    event.stopPropagation();
    var menu = document.getElementById('profileDropdownMenu');
    menu.classList.toggle('show');
}
document.addEventListener('click', function(e) {
    var menu = document.getElementById('profileDropdownMenu');
    if(menu && menu.classList.contains('show')) {
        menu.classList.remove('show');
            }
        });
    </script>
</body>
</html>