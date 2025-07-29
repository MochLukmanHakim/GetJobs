<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan - GetJobs</title>
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

        /* Notification Drawer */
        .notification-drawer {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .notification-drawer.open {
            right: 0;
        }

        .notification-drawer-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-drawer-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .notification-drawer-close {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        .notification-drawer-close:hover {
            background: #f3f4f6;
        }

        .notification-drawer-content {
            flex: 1;
            overflow-y: auto;
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

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .notification-title {
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            margin-bottom: 4px;
        }

        .notification-time {
            font-size: 12px;
            color: #6b7280;
        }

        .notification-message {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.4;
        }

        .notification-empty {
            padding: 40px 24px;
            text-align: center;
            color: #6b7280;
        }

        .notification-empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            opacity: 0.5;
        }

        /* Overlay */
        .notification-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .notification-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #111827;
        }

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
            font-size: 10px;
            color: #6b7280;
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

        /* Responsive */
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
                    <a href="/statistik" class="nav-link">
                        <span class="nav-icon">📊</span>
                        Statistik
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/account" class="nav-link active">
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
                <h1 class="page-title">Profil Perusahaan</h1>
                <div class="header-right">
                    <button class="notification-icon" onclick="toggleNotificationDrawer()">
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
                                <button type="submit" class="profile-dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Profil dan Metrik -->
            <div class="content-layout">
                <!-- Card Profil Perusahaan -->
                <div class="profile-card">
                    <div class="profile-logo">
                        <img id="logoPreview" src="/images/logo-getjobs2.png" alt="Logo Perusahaan">
                    </div>
                    <div class="profile-company-name">PT. GetJobs Indonesia</div>
                    <div class="profile-status">Verified Company</div>
                    <div class="profile-info">
                        <div class="profile-info-label">Email</div>
                        <div class="profile-info-value">info@getjobs.co.id</div>
                        <div class="profile-info-label">Telepon</div>
                        <div class="profile-info-value">021-12345678</div>
                        <div class="profile-info-label">Alamat</div>
                        <div class="profile-info-value">Jl. Merdeka No. 123, Jakarta</div>
                        <div class="profile-info-label">Deskripsi</div>
                        <div class="profile-info-value">GetJobs adalah platform rekrutmen modern yang menghubungkan perusahaan dengan talenta terbaik di Indonesia.</div>
                    </div>
                </div>
                <!-- Kanan: Metrik dan Info Tambahan -->
                <div class="content-right">
                    <!-- Metrics Grid -->
                    <div class="metrics-grid">
                        <div class="metric-card">
                            <div class="metric-title">Lowongan Aktif</div>
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
                            <div class="metric-title">Lowongan Ditutup</div>
                            <div class="metric-value">3</div>
                            <div class="metric-change positive">
                                <span>↗</span>
                                +15.03%
                            </div>
                        </div>
                    </div>
                    <!-- Cabang Perusahaan dan Media Sosial -->
                    <div class="branch-social-layout">
                        <!-- Cabang Perusahaan -->
                        <div class="branch-card">
                            <h3 class="branch-title">Cabang Perusahaan</h3>
                            <div class="branch-list">
                                <div class="branch-item">
                                    <div class="branch-dot central"></div>
                                    <div>
                                        <div class="branch-name">Kantor Pusat</div>
                                        <div class="branch-location">Jakarta Pusat</div>
                                    </div>
                                </div>
                                <div class="branch-item">
                                    <div class="branch-dot bandung"></div>
                                    <div>
                                        <div class="branch-name">Cabang Bandung</div>
                                        <div class="branch-location">Bandung</div>
                                    </div>
                                </div>
                                <div class="branch-item">
                                    <div class="branch-dot surabaya"></div>
                                    <div>
                                        <div class="branch-name">Cabang Surabaya</div>
                                        <div class="branch-location">Surabaya</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Media Sosial -->
                        <div class="social-card">
                            <h3 class="social-title">Media Sosial</h3>
                            <div class="social-list">
                                <a href="https://instagram.com/getjobs.id" target="_blank" class="social-item">
                                    <div class="social-icon instagram">📷</div>
                                    <div class="social-name">Instagram</div>
                                </a>
                                <a href="https://facebook.com/getjobs.id" target="_blank" class="social-item">
                                    <div class="social-icon facebook">📘</div>
                                    <div class="social-name">Facebook</div>
                                </a>
                                <a href="https://twitter.com/getjobs_id" target="_blank" class="social-item">
                                    <div class="social-icon twitter">🐦</div>
                                    <div class="social-name">Twitter</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Lowongan Aktif -->
                    <div class="job-section">
                        <h3 class="job-title">Lowongan Aktif</h3>
                        <div class="job-grid">
                            <!-- Lowongan 1 -->
                            <div class="job-card">
                                <div class="job-avatar">FD</div>
                                <div class="job-info">
                                    <div class="job-name">Frontend Developer</div>
                                    <div class="job-details">Jakarta • Rp 8.000.000</div>
                                </div>
                                <div class="job-status">
                                    <div class="status-dot"></div>
                                    <span class="status-text">Aktif</span>
                                </div>
                            </div>
                            <!-- Lowongan 2 -->
                            <div class="job-card">
                                <div class="job-avatar">BD</div>
                                <div class="job-info">
                                    <div class="job-name">Backend Developer</div>
                                    <div class="job-details">Bandung • Rp 10.000.000</div>
                                </div>
                                <div class="job-status">
                                    <div class="status-dot"></div>
                                    <span class="status-text">Aktif</span>
                                </div>
                            </div>
                            <!-- Lowongan 3 -->
                            <div class="job-card">
                                <div class="job-avatar">DA</div>
                                <div class="job-info">
                                    <div class="job-name">Data Analyst</div>
                                    <div class="job-details">Medan • Rp 9.000.000</div>
                                </div>
                                <div class="job-status">
                                    <div class="status-dot"></div>
                                    <span class="status-text">Aktif</span>
                                </div>
                            </div>
                            <!-- Lowongan 4 -->
                            <div class="job-card">
                                <div class="job-avatar">MD</div>
                                <div class="job-info">
                                    <div class="job-name">Mobile Developer</div>
                                    <div class="job-details">Surabaya • Rp 12.000.000</div>
                                </div>
                                <div class="job-status">
                                    <div class="status-dot"></div>
                                    <span class="status-text">Aktif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Notification Drawer -->
    <div class="notification-overlay" id="notificationOverlay" onclick="closeNotificationDrawer()"></div>
    <div class="notification-drawer" id="notificationDrawer">
        <div class="notification-drawer-header">
            <h3 class="notification-drawer-title">Notifikasi</h3>
            <button class="notification-drawer-close" onclick="closeNotificationDrawer()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="notification-drawer-content">
            <div class="notification-item unread">
                <div class="notification-header">
                    <div class="notification-title">Pelamar Baru</div>
                    <div class="notification-time">2 menit yang lalu</div>
                </div>
                <div class="notification-message">Ahmad Fadillah telah melamar untuk posisi Frontend Developer</div>
            </div>
            <div class="notification-item unread">
                <div class="notification-header">
                    <div class="notification-title">Lowongan Ditutup</div>
                    <div class="notification-time">1 jam yang lalu</div>
                </div>
                <div class="notification-message">Lowongan Backend Developer telah ditutup dengan 25 pelamar</div>
            </div>
            <div class="notification-item">
                <div class="notification-header">
                    <div class="notification-title">Interview Dijadwalkan</div>
                    <div class="notification-time">3 jam yang lalu</div>
                </div>
                <div class="notification-message">Interview untuk Sarah Johnson dijadwalkan besok jam 10:00 WIB</div>
            </div>
            <div class="notification-item">
                <div class="notification-header">
                    <div class="notification-title">Lowongan Aktif</div>
                    <div class="notification-time">1 hari yang lalu</div>
                </div>
                <div class="notification-message">Lowongan UI/UX Designer telah dipublikasikan</div>
            </div>
            <div class="notification-item">
                <div class="notification-header">
                    <div class="notification-title">Pelamar Diterima</div>
                    <div class="notification-time">2 hari yang lalu</div>
                </div>
                <div class="notification-message">Michael Chen telah diterima untuk posisi Data Analyst</div>
            </div>
        </div>
    </div>

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

        function toggleProfileDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('profileDropdownMenu');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdownMenu');
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });

        // Notification Drawer Functions
        function toggleNotificationDrawer() {
            const drawer = document.getElementById('notificationDrawer');
            const overlay = document.getElementById('notificationOverlay');
            
            if (drawer.classList.contains('open')) {
                closeNotificationDrawer();
            } else {
                openNotificationDrawer();
            }
        }

        function openNotificationDrawer() {
            const drawer = document.getElementById('notificationDrawer');
            const overlay = document.getElementById('notificationOverlay');
            
            drawer.classList.add('open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeNotificationDrawer() {
            const drawer = document.getElementById('notificationDrawer');
            const overlay = document.getElementById('notificationOverlay');
            
            drawer.classList.remove('open');
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        // Close drawer when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeNotificationDrawer();
            }
        });
    </script>
</body>
</html> 