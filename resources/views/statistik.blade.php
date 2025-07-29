<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik - GetJobs</title>
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
            font-size: 14px;
            position: relative;
        }

        .nav-link:hover {
            background: #C7E0F6;
            color: #2F4157;
            transform: translateX(4px);
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

        .page-header {
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
        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #111827;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notification-bell {
            position: relative;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            font-size: 14px;
            background: none;
        }
        .notification-bell:hover {
            background: #f3f4f6;
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

        /* Notification Popup */
        .notification-popup {
            position: fixed;
            top: 0;
            right: -400px;
            width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            transition: right 0.3s ease;
            overflow-y: auto;
        }

        .notification-popup.show {
            right: 0;
        }

        .notification-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .close-notification {
            background: none;
            border: none;
            font-size: 20px;
            color: #6b7280;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .close-notification:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .notification-content {
            padding: 0;
        }

        .notification-item {
            padding: 16px 24px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .notification-item:hover {
            background: #f9fafb;
        }

        .notification-item.unread {
            background: #f0f9ff;
        }

        .notification-item.unread:hover {
            background: #e0f2fe;
        }

        .notification-item-header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 8px;
        }

        .notification-avatar {
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

        .notification-info {
            flex: 1;
        }

        .notification-text {
            font-size: 14px;
            color: #374151;
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .notification-time {
            font-size: 12px;
            color: #6b7280;
        }

        .notification-unread-dot {
            width: 8px;
            height: 8px;
            background: #3b82f6;
            border-radius: 50%;
            margin-top: 4px;
        }

        .notification-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .notification-overlay.show {
            opacity: 1;
            visibility: visible;
        }


        /* Metrics Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .metric-card {
            background: white;
            border-radius: 8px;
            padding: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .metric-title {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .metric-value {
            font-size: 24px;
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
            color: #dc2626;
        }

        /* Dashboard Layout */
        .dashboard-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
        }

        .chart-section {
            background: white;
            border-radius: 8px;
            padding: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
        }

        .chart-tabs {
            display: flex;
            gap: 12px;
        }

        .chart-tab {
            padding: 6px 12px;
            border: none;
            background: transparent;
            color: #6b7280;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .chart-tab.active {
            background: #f3f4f6;
            color: #111827;
        }

        .chart-container {
            height: 250px;
            position: relative;
        }

        #applicantChart {
            width: 100% !important;
            height: 100% !important;
        }

        .chart-legend {
            display: flex;
            gap: 16px;
            margin-top: 12px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #6b7280;
        }

        .legend-line {
            width: 20px;
            height: 2px;
        }

        .legend-line.this-year {
            background: #111827;
        }

        .legend-line.last-year {
            background: #3b82f6;
            border-top: 2px dashed #3b82f6;
        }



        /* Job Applicants Chart */
        .job-applicants-chart {
            background: white;
            border-radius: 8px;
            padding: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-top: 16px;
        }

        .bar-chart {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 16px;
        }

        .bar-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bar-label {
            width: 100px;
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
            text-align: left;
        }

        .bar-wrapper {
            flex: 1;
            height: 20px;
            background: #f3f4f6;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .bar {
            height: 100%;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 6px;
            transition: all 0.3s ease;
            position: relative;
        }

        .bar:hover {
            transform: scaleY(1.05);
        }

        .bar-value {
            color: white;
            font-size: 10px;
            font-weight: 600;
        }

        /* Event Cards */
        .events-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .event-card {
            background: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .event-image {
            width: 100%;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .event-content {
            padding: 12px;
        }

        .event-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 3px;
        }

        .event-organizer {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .event-details {
            display: flex;
            flex-direction: column;
            gap: 3px;
            margin-bottom: 12px;
        }

        .event-detail {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: #6b7280;
        }

        .event-attendees {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .attendee-avatar {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            color: #6b7280;
            font-weight: 600;
        }

        .attendee-count {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            color: white;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }
            
            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
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
                padding: 16px;
            }
            .page-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            .metrics-grid {
                grid-template-columns: 1fr;
            }
            
            /* Mobile responsive for bar chart */
            .bar-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .bar-label {
                width: 100%;
                text-align: left;
                font-size: 12px;
            }
            
            .bar-wrapper {
                width: 100%;
                height: 20px;
            }
            
            .bar {
                padding-right: 6px;
            }
            
            .bar-value {
                font-size: 10px;
            }

            /* Mobile responsive for notification popup */
            .notification-popup {
                width: 100%;
                right: -100%;
            }
            
            .notification-header {
                padding: 16px 20px;
            }
            
            .notification-title {
                font-size: 16px;
            }
            
            .notification-item {
                padding: 12px 20px;
            }
            
            .notification-avatar {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }
            
            .notification-text {
                font-size: 13px;
            }
            
            .notification-time {
                font-size: 11px;
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
                    <a href="/dashboard" class="nav-link">
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
                    <a href="/statistik" class="nav-link active">
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
            <div class="page-header">
                <div class="header-left">
                    <h1 class="page-title">Statistik</h1>
                </div>
                <div class="header-right">
                    <button class="notification-bell" onclick="toggleNotificationPopup()">
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
                            <form method="POST" action="/logout" style="margin:0;">
                                <button type="submit" class="profile-dropdown-item">Log out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metrics Grid -->
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
                    <div class="metric-title">New Orders</div>
                    <div class="metric-value">24094</div>
                    <div class="metric-change positive">
                        <span>↗</span>
                        +15.03%
                    </div>
                </div>
            </div>

            <!-- Dashboard Layout -->
            <div class="dashboard-layout">
                <!-- Left Column -->
                <div class="left-column">
                    <!-- Chart Section -->
                    <div class="chart-section">
                        <div class="chart-header">
                            <h2 class="chart-title">Grafik Pelamar</h2>
                            <div class="chart-tabs">
                                <button class="chart-tab active">Bulan Ini</button>
                                <button class="chart-tab">Bulan Lalu</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="applicantChart"></canvas>
                        </div>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <div class="legend-line this-year"></div>
                                <span>Bulan Ini</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-line last-year"></div>
                                <span>Bulan Lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Job Applicants Chart -->
                    <div class="job-applicants-chart">
                        <h2 class="chart-title">Lowongan dengan Pelamar Terbanyak</h2>
                        <div class="chart-container">
                            <div class="bar-chart">
                                <div class="bar-item">
                                    <div class="bar-label">Frontend Developer</div>
                                    <div class="bar-wrapper">
                                        <div class="bar" style="width: 85%; background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%);">
                                            <span class="bar-value">15</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bar-item">
                                    <div class="bar-label">UI/UX Designer</div>
                                    <div class="bar-wrapper">
                                        <div class="bar" style="width: 70%; background: linear-gradient(90deg, #10b981 0%, #059669 100%);">
                                            <span class="bar-value">12</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bar-item">
                                    <div class="bar-label">Backend Developer</div>
                                    <div class="bar-wrapper">
                                        <div class="bar" style="width: 60%; background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);">
                                            <span class="bar-value">10</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bar-item">
                                    <div class="bar-label">Product Manager</div>
                                    <div class="bar-wrapper">
                                        <div class="bar" style="width: 45%; background: linear-gradient(90deg, #8b5cf6 0%, #7c3aed 100%);">
                                            <span class="bar-value">8</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bar-item">
                                    <div class="bar-label">Data Analyst</div>
                                    <div class="bar-wrapper">
                                        <div class="bar" style="width: 35%; background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);">
                                            <span class="bar-value">6</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bar-item">
                                    <div class="bar-label">Mobile Developer</div>
                                    <div class="bar-wrapper">
                                        <div class="bar" style="width: 25%; background: linear-gradient(90deg, #6b7280 0%, #4b5563 100%);">
                                            <span class="bar-value">3</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="right-column">
                    <div class="events-section">
                        <!-- Event Card 1 -->
                        <div class="event-card">
                            <div class="event-image">👥</div>
                            <div class="event-content">
                                <h3 class="event-title">Design Conference</h3>
                                <p class="event-organizer">Zillul Design Agency</p>
                                <div class="event-details">
                                    <div class="event-detail">
                                        <span>🕐</span>
                                        <span>Today 07:19 AM</span>
                                    </div>
                                    <div class="event-detail">
                                        <span>📍</span>
                                        <span>56 Davion Mission Suite 157</span>
                                    </div>
                                </div>
                                <div class="event-attendees">
                                    <div class="attendee-avatar">A</div>
                                    <div class="attendee-avatar">B</div>
                                    <div class="attendee-avatar">C</div>
                                    <div class="attendee-count">+15</div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Card 2 -->
                        <div class="event-card">
                            <div class="event-image">👥</div>
                            <div class="event-content">
                                <h3 class="event-title">Design Conference</h3>
                                <p class="event-organizer">Zillul Design Agency</p>
                                <div class="event-details">
                                    <div class="event-detail">
                                        <span>🕐</span>
                                        <span>Today 07:19 AM</span>
                                    </div>
                                    <div class="event-detail">
                                        <span>📍</span>
                                        <span>56 Davion Mission Suite 157</span>
                                    </div>
                                </div>
                                <div class="event-attendees">
                                    <div class="attendee-avatar">A</div>
                                    <div class="attendee-avatar">B</div>
                                    <div class="attendee-avatar">C</div>
                                    <div class="attendee-count">+15</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Notification Popup -->
    <div class="notification-overlay" id="notificationOverlay" onclick="closeNotificationPopup()"></div>
    <div class="notification-popup" id="notificationPopup">
        <div class="notification-header">
            <h3 class="notification-title">Notifikasi</h3>
            <button class="close-notification" onclick="closeNotificationPopup()">×</button>
        </div>
        <div class="notification-content">
            <div class="notification-item unread">
                <div class="notification-item-header">
                    <div class="notification-avatar">AS</div>
                    <div class="notification-info">
                        <div class="notification-text">
                            <strong>Ahmad Suryadi</strong> melamar untuk posisi Frontend Developer
                        </div>
                        <div class="notification-time">2 menit yang lalu</div>
                    </div>
                    <div class="notification-unread-dot"></div>
                </div>
            </div>
            
            <div class="notification-item unread">
                <div class="notification-item-header">
                    <div class="notification-avatar">SD</div>
                    <div class="notification-info">
                        <div class="notification-text">
                            <strong>Sarah Dewi</strong> melamar untuk posisi UI/UX Designer
                        </div>
                        <div class="notification-time">15 menit yang lalu</div>
                    </div>
                    <div class="notification-unread-dot"></div>
                </div>
            </div>
            
            <div class="notification-item unread">
                <div class="notification-item-header">
                    <div class="notification-avatar">RJ</div>
                    <div class="notification-info">
                        <div class="notification-text">
                            <strong>Rizki Jaya</strong> melamar untuk posisi Backend Developer
                        </div>
                        <div class="notification-time">1 jam yang lalu</div>
                    </div>
                    <div class="notification-unread-dot"></div>
                </div>
            </div>
            
            <div class="notification-item">
                <div class="notification-item-header">
                    <div class="notification-avatar">NP</div>
                    <div class="notification-info">
                        <div class="notification-text">
                            <strong>Nina Putri</strong> melamar untuk posisi Product Manager
                        </div>
                        <div class="notification-time">2 jam yang lalu</div>
                    </div>
                </div>
            </div>
            
            <div class="notification-item">
                <div class="notification-item-header">
                    <div class="notification-avatar">BK</div>
                    <div class="notification-info">
                        <div class="notification-text">
                            <strong>Budi Kusuma</strong> melamar untuk posisi Data Analyst
                        </div>
                        <div class="notification-time">3 jam yang lalu</div>
                    </div>
                </div>
            </div>
            
            <div class="notification-item">
                <div class="notification-item-header">
                    <div class="notification-avatar">MW</div>
                    <div class="notification-info">
                        <div class="notification-text">
                            <strong>Maya Wati</strong> melamar untuk posisi Mobile Developer
                        </div>
                        <div class="notification-time">5 jam yang lalu</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Chart
        const ctx = document.getElementById('applicantChart').getContext('2d');
        const applicantChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [
                    {
                        label: 'Bulan Ini',
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
                        label: 'Bulan Lalu',
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

        // Notification popup functions
        function toggleNotificationPopup() {
            const popup = document.getElementById('notificationPopup');
            const overlay = document.getElementById('notificationOverlay');
            
            if (popup.classList.contains('show')) {
                closeNotificationPopup();
            } else {
                openNotificationPopup();
            }
        }

        function openNotificationPopup() {
            const popup = document.getElementById('notificationPopup');
            const overlay = document.getElementById('notificationOverlay');
            
            popup.classList.add('show');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeNotificationPopup() {
            const popup = document.getElementById('notificationPopup');
            const overlay = document.getElementById('notificationOverlay');
            
            popup.classList.remove('show');
            overlay.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close popup when clicking on notification items
        document.addEventListener('click', function(e) {
            if (e.target.closest('.notification-item')) {
                const item = e.target.closest('.notification-item');
                if (item.classList.contains('unread')) {
                    item.classList.remove('unread');
                    // Update notification badge count
                    const badge = document.querySelector('.notification-badge');
                    const currentCount = parseInt(badge.textContent);
                    if (currentCount > 0) {
                        badge.textContent = currentCount - 1;
                    }
                }
            }
        });

        // Chart tab functionality
        document.querySelectorAll('.chart-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Update chart data based on selected tab
                if (this.textContent === 'Bulan Ini') {
                    applicantChart.data.datasets[0].data = [5, 12, 8, 15, 20, 18, 25];
                    applicantChart.data.datasets[1].data = [3, 8, 6, 10, 12, 14, 16];
                } else if (this.textContent === 'Bulan Lalu') {
                    applicantChart.data.datasets[0].data = [3, 8, 6, 10, 12, 14, 16];
                    applicantChart.data.datasets[1].data = [2, 5, 4, 8, 9, 11, 13];
                }
                applicantChart.update();
            });
        });
    </script>
</body>
</html> 