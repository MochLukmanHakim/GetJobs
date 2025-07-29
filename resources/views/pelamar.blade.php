<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelamar - GetJobs</title>
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

        .logout-link {
            color: #111827;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .logout-link:hover {
            color: #374151;
        }

        .add-applicant-btn {
            background: #1F2937;
            color: white;
            border: none;
            margin-left: 550px;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .add-applicant-btn:hover {
            background: #374151;
        }

        /* Table Header */
        .table-header-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 1fr;
            gap: 16px;
            align-items: center;
            padding: 12px 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
        }

        .header-item {
            font-weight: 600;
            color: #374151;
            font-size: 12px;
        }

        /* Card-based Table Design */
        .applicant-cards {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .applicant-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px 20px;
            transition: all 0.3s ease;
        }

        .applicant-card:hover {
            transform: translateY(-1px);
        }

        .applicant-card-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 1fr;
            gap: 16px;
            align-items: center;
        }

        .applicant-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .applicant-avatar {
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

        .applicant-details h4 {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .applicant-details p {
            font-size: 11px;
            color: #6b7280;
            margin: 0;
        }

        .applicant-id {
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
        }

        .applicant-position {
            font-size: 12px;
            color: #374151;
            font-weight: 500;
        }

        .applicant-experience {
            font-size: 12px;
            color: #059669;
            font-weight: 600;
        }

        .applicant-status {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-dot.applied {
            background: #3b82f6;
        }

        .status-dot.reviewed {
            background: #f59e0b;
        }

        .status-dot.interviewed {
            background: #8b5cf6;
        }

        .status-dot.accepted {
            background: #10b981;
        }

        .status-dot.rejected {
            background: #ef4444;
        }

        .status-text {
            font-size: 11px;
            font-weight: 500;
        }

        .status-text.applied {
            color: #2563eb;
        }

        .status-text.reviewed {
            color: #d97706;
        }

        .status-text.interviewed {
            color: #7c3aed;
        }

        .status-text.accepted {
            color: #059669;
        }

        .status-text.rejected {
            color: #dc2626;
        }

        .application-date {
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
        }

        .action-menu {
            position: relative;
            display: inline-block;
        }

        .action-toggle {
            background: none;
            border: none;
            font-size: 18px;
            color: #6b7280;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .action-toggle:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .action-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 120px;
            z-index: 10;
            display: none;
        }

        .action-dropdown.show {
            display: block;
        }

        .action-item {
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
            border-bottom: 1px solid #f3f4f6;
        }

        .action-item:last-child {
            border-bottom: none;
        }

        .action-item:hover {
            background: #f9fafb;
        }

        .action-item.view {
            color: #3b82f6;
        }

        .action-item.edit {
            color: #f59e0b;
        }

        .action-item.delete {
            color: #ef4444;
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
            transition: all 0.3s ease;
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

        .table-actions-flex {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            padding-left: 0 !important;
            margin-left: 0 !important;
        }
        .search-input-group {
            position: relative;
            width: 350px;
            max-width: 100%;
            margin-left: 0 !important;
        }
        .search-input {
            width: 100%;
            padding: 9px 12px 9px 36px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
            transition: border 0.2s;
        }
        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
        }
        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #9ca3af;
            pointer-events: none;
        }
        .filter-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            border: 0px solid #e5e7eb;
            background: #fff;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s, border 0.2s;
            margin-left: 8px;
        }
        .filter-btn:hover {
            background: #f3f4f6;
            border-color: #cbd5e1;
        }
        .filter-btn svg {
            display: block;
        }

        /* Job Filter Tabs */
        .job-filter-tabs {
            margin-top: 20px;
            margin-bottom: 24px;
        }

        .tab-container {
            display: flex;
            background: transparent;
            border: none;
            padding: 0;
            gap: 32px;
            flex-wrap: wrap;
        }

        .tab-item {
            flex: none;
            min-width: auto;
            padding: 12px 0;
            border: none;
            background: transparent;
            color: #9ca3af;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 0;
            transition: all 0.3s ease;
            font-family: inherit;
            text-align: left;
            position: relative;
        }

        .tab-item:hover {
            background: transparent;
            color: #6b7280;
        }

        .tab-item.active {
            background: transparent;
            color: #2F4157;
            font-weight: 600;
            box-shadow: none;
        }

        .tab-item.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #2F4157;
            border-radius: 0;
        }

        .tab-item.active:hover {
            background: transparent;
            color: #2F4157;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .table-header-row,
            .applicant-card-content {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 80px;
                gap: 16px;
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
            
            /* Responsive tabs */
            .tab-container {
                flex-direction: column;
                gap: 16px;
            }
            
            .tab-item {
                text-align: left;
                padding: 8px 0;
                min-width: auto;
                flex: none;
            }
            
            .table-header-row {
                display: none;
            }
            
            .table-actions-flex {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }
            
            .applicant-card-content {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .applicant-card {
                padding: 20px;
            }
            
            .applicant-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .applicant-details h4 {
                font-size: 16px;
            }
            
            .applicant-position,
            .applicant-experience,
            .applicant-status,
            .application-date {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border-bottom: 1px solid #f3f4f6;
            }
            
            .applicant-position::before {
                content: "Posisi: ";
                font-weight: 600;
                color: #374151;
            }
            
            .applicant-experience::before {
                content: "Pengalaman: ";
                font-weight: 600;
                color: #374151;
            }
            
            .applicant-status::before {
                content: "Status: ";
                font-weight: 600;
                color: #374151;
            }
            
            .application-date::before {
                content: "Tanggal: ";
                font-weight: 600;
                color: #374151;
            }
            
            .action-menu {
                display: flex;
                justify-content: center;
                margin-top: 12px;
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
                    <a href="/pelamar" class="nav-link active">
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
            <div class="page-header">
                <div class="header-left">
                <h1 class="page-title">Manajemen Pelamar</h1>
                </div>
                <div class="header-right">
                    <button class="notification-bell">
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
            <div class="table-actions-flex">
                <div class="search-input-group">
                    <input type="text" class="search-input" placeholder="Cari pelamar...">
                    <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <button class="add-applicant-btn" onclick="openAddApplicantModal()">tambah</button>
                <button class="filter-btn" title="Filter">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 11H17V13H7V11ZM4 7H20V9H4V7ZM10 15H14V17H10V15Z" fill="#9CA3AF"/>
                    </svg>
                </button>
            </div>

            <!-- Job Filter Tabs -->
            <div class="job-filter-tabs">
                <div class="tab-container">
                    <button class="tab-item active" onclick="filterByJob('all')">Semua Posisi</button>
                    <button class="tab-item" onclick="filterByJob('Frontend Developer')">Frontend Developer</button>
                    <button class="tab-item" onclick="filterByJob('UI/UX Designer')">UI/UX Designer</button>
                    <button class="tab-item" onclick="filterByJob('Backend Developer')">Backend Developer</button>
                    <button class="tab-item" onclick="filterByJob('Product Manager')">Product Manager</button>
                    <button class="tab-item" onclick="filterByJob('Data Analyst')">Data Analyst</button>
                    <button class="tab-item" onclick="filterByJob('Mobile Developer')">Mobile Developer</button>
                </div>
            </div>

            <!-- Applicant Management Table -->
            <div class="table-card">
                <div class="table-header"></div>
                
                <!-- Table Header -->
                <div class="table-header-row">
                    <div class="header-item">Nama</div>
                    <div class="header-item">Posisi</div>
                    <div class="header-item">Pengalaman</div>
                    <div class="header-item">Status</div>
                    <div class="header-item">Skor</div>
                    <div class="header-item">Tanggal Lamar</div>
                    <div class="header-item">Aksi</div>
                </div>
                
                <div class="applicant-cards">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">AS</div>
                                <div class="applicant-details">
                                    <h4>Ahmad Suryadi</h4>
                                    <p class="applicant-id">#APP001</p>
                                </div>
                            </div>
                            <div class="applicant-position">Frontend Developer</div>
                            <div class="applicant-experience">3 tahun</div>
                            <div class="applicant-status">
                                <div class="status-dot interviewed"></div>
                                <span class="status-text interviewed">Interview</span>
                            </div>
                            <div class="applicant-score">85%</div>
                            <div class="application-date">15 Mar 2024</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item edit">Edit</div>
                                    <div class="action-item delete">Hapus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Applicant Card 2 -->
                    <div class="applicant-card">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">SD</div>
                                <div class="applicant-details">
                                    <h4>Sarah Dewi</h4>
                                    <p class="applicant-id">#APP002</p>
                                </div>
                            </div>
                            <div class="applicant-position">UI/UX Designer</div>
                            <div class="applicant-experience">2 tahun</div>
                            <div class="applicant-status">
                                <div class="status-dot applied"></div>
                                <span class="status-text applied">Applied</span>
                            </div>
                            <div class="applicant-score">78%</div>
                            <div class="application-date">14 Mar 2024</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item edit">Edit</div>
                                    <div class="action-item delete">Hapus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Applicant Card 3 -->
                    <div class="applicant-card">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">RJ</div>
                                <div class="applicant-details">
                                    <h4>Rizki Jaya</h4>
                                    <p class="applicant-id">#APP003</p>
                                </div>
                            </div>
                            <div class="applicant-position">Backend Developer</div>
                            <div class="applicant-experience">4 tahun</div>
                            <div class="applicant-status">
                                <div class="status-dot accepted"></div>
                                <span class="status-text accepted">Diterima</span>
                            </div>
                            <div class="applicant-score">92%</div>
                            <div class="application-date">12 Mar 2024</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item edit">Edit</div>
                                    <div class="action-item delete">Hapus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Applicant Card 4 -->
                    <div class="applicant-card">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">NP</div>
                                <div class="applicant-details">
                                    <h4>Nina Putri</h4>
                                    <p class="applicant-id">#APP004</p>
                                </div>
                            </div>
                            <div class="applicant-position">Product Manager</div>
                            <div class="applicant-experience">5 tahun</div>
                            <div class="applicant-status">
                                <div class="status-dot reviewed"></div>
                                <span class="status-text reviewed">Direview</span>
                            </div>
                            <div class="applicant-score">88%</div>
                            <div class="application-date">10 Mar 2024</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item edit">Edit</div>
                                    <div class="action-item delete">Hapus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Applicant Card 5 -->
                    <div class="applicant-card">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">BK</div>
                                <div class="applicant-details">
                                    <h4>Budi Kusuma</h4>
                                    <p class="applicant-id">#APP005</p>
                                </div>
                            </div>
                            <div class="applicant-position">Data Analyst</div>
                            <div class="applicant-experience">2 tahun</div>
                            <div class="applicant-status">
                                <div class="status-dot rejected"></div>
                                <span class="status-text rejected">Ditolak</span>
                            </div>
                            <div class="applicant-score">65%</div>
                            <div class="application-date">08 Mar 2024</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item edit">Edit</div>
                                    <div class="action-item delete">Hapus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Applicant Card 6 -->
                    <div class="applicant-card">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">MW</div>
                                <div class="applicant-details">
                                    <h4>Maya Wati</h4>
                                    <p class="applicant-id">#APP006</p>
                                </div>
                            </div>
                            <div class="applicant-position">Mobile Developer</div>
                            <div class="applicant-experience">3 tahun</div>
                            <div class="applicant-status">
                                <div class="status-dot applied"></div>
                                <span class="status-text applied">Applied</span>
                            </div>
                            <div class="applicant-score">82%</div>
                            <div class="application-date">05 Mar 2024</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item edit">Edit</div>
                                    <div class="action-item delete">Hapus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="page-btn">‹</button>
                    <button class="page-btn">1</button>
                    <button class="page-btn active">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn">›</button>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleActionMenu(button) {
            // Close all other dropdowns first
            const allDropdowns = document.querySelectorAll('.action-dropdown');
            allDropdowns.forEach(dropdown => {
                if (dropdown !== button.nextElementSibling) {
                    dropdown.classList.remove('show');
                }
            });
            
            // Toggle current dropdown
            const dropdown = button.nextElementSibling;
            dropdown.classList.toggle('show');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.action-menu')) {
                const dropdowns = document.querySelectorAll('.action-dropdown');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }
        });

        // Add click handlers for action items
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('action-item')) {
                const action = event.target.textContent;
                const applicantName = event.target.closest('.applicant-card').querySelector('h4').textContent;
                
                console.log(`${action} clicked for applicant: ${applicantName}`);
                
                // Close dropdown after action
                const dropdown = event.target.closest('.action-dropdown');
                dropdown.classList.remove('show');
                
                // Here you can add your action logic
                // For example: window.location.href = `/applicants/${applicantId}/${action.toLowerCase()}`;
            }
        });

        function openAddApplicantModal() {
            // Add modal functionality for adding new applicants
            alert('Fitur tambah pelamar akan segera hadir!');
        }

        function filterByJob(position) {
            // Remove active class from all tabs
            const allTabs = document.querySelectorAll('.tab-item');
            allTabs.forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Add active class to clicked tab
            event.target.classList.add('active');
            
            console.log('Filtering by position:', position);
            
            const applicantCards = document.querySelectorAll('.applicant-card');
            
            if (position === 'all') {
                // Show all applicants
                applicantCards.forEach(card => {
                    card.style.display = 'block';
                });
            } else {
                // Filter by specific position
                applicantCards.forEach(card => {
                    const positionElement = card.querySelector('.applicant-position');
                    const cardPosition = positionElement.textContent.trim();
                    
                    if (cardPosition === position) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        }

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