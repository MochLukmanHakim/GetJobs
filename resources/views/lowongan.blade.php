<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Lowongan - GetJobs</title>
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

        .add-job-btn {
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

        .add-job-btn:hover {
            background: #374151;
        }

        /* Job Management Table */

        .table-header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 32px;
        }

        .table-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
        }

        .table-actions {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 240px;
            width: calc(100% - 240px);
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 24px;
            width: 95%;
            max-width: 830px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid #e5e7eb;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .modal-category {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-category label {
            display: none;
        }

        .modal-category select {
            width: 200px;
            padding: 8px 10px;
            border: none;
            border-radius: 0;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
            background: transparent;
            cursor: pointer;
            color: #6b7280;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 6px center;
            background-size: 14px;
            padding-right: 28px;
        }

        .modal-category select:focus {
            outline: none;
            background: transparent;
            color: #374151;
        }

        .modal-category select option {
            font-weight: 600;
            color: #374151;
            background: white;
            padding: 8px 12px;
        }

        .job-form {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        .form-row-with-dropdowns {
            display: flex;
            gap: 32px;
            align-items: flex-end;
            margin-bottom: 12px;
        }

        .dropdown-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .dropdown-item label {
            display: none;
        }

        .dropdown-item select {
            padding: 8px 10px;
            border: none;
            border-radius: 0;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
            background: transparent;
            cursor: pointer;
            color: #6b7280;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 6px center;
            background-size: 14px;
            padding-right: 28px;
            min-width: 120px;
        }

        .dropdown-item select:focus {
            outline: none;
            background: transparent;
            color: #374151;
        }

        .dropdown-item select option {
            font-weight: 600;
            color: #374151;
            background: white;
            padding: 8px 12px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group select {
            padding: 8px 12px;
            border: none;
            border-radius: 0;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: transparent;
            cursor: pointer;
            color: #9ca3af;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 16px;
            padding-right: 32px;
        }

        .form-group select:focus {
            outline: none;
            background: transparent;
            color: #6b7280;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 60px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-cancel {
            padding: 12px 24px;
            background: white;
            color: #6b7280;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .btn-save {
            padding: 12px 24px;
            background: linear-gradient(90deg, #6a879c 0%, #223046 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: linear-gradient(90deg, #223046 0%, #6a879c 100%);
            color: white;
        }

        /* Responsive Modal */
        @media (max-width: 768px) {
            .modal-overlay {
                left: 0;
                width: 100%;
            }
            
            .modal-content {
                width: 95%;
                padding: 24px;
                margin: 20px;
            }
            
            .modal-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .modal-category {
            width: 100%;
            }
            
            .modal-category select {
                width: 100%;
            }
            
            .form-row,
            .form-row-2 {
                grid-template-columns: 1fr;
                gap: 12px;
            }
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

        /* New Card-based Table Design */
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
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 1fr;
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

        .action-item.edit {
            color: #3b82f6;
        }

        .action-item.delete {
            color: #ef4444;
        }

        .action-item.view {
            color: #10b981;
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

        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
                margin-right: 0;
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
            .table-card {
                padding: 16px;
            }
            .job-table {
                font-size: 12px;
            }
            .job-table th,
            .job-table td {
                padding: 8px 6px;
            }
            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }
        }

        .job-table td:nth-child(6) {
            color: #6b7280;
            font-size: 13px;
            font-weight: 500;
        }

        /* Responsive Design for Card Layout */
        @media (max-width: 1200px) {
            .table-header-row,
            .job-card-content {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 80px;
                gap: 16px;
            }
        }

        @media (max-width: 768px) {
            .table-header-row {
                display: none;
            }
            
            .table-actions {
                flex-direction: column;
                gap: 8px;
                align-items: stretch;
            }
            
            .date-input-group {
                justify-content: center;
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
            
            .action-menu {
                display: flex;
                justify-content: center;
                margin-top: 12px;
            }
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
        @media (max-width: 600px) {
            .table-actions-flex {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }
            .search-input-group {
                width: 100%;
            }
            .add-job-btn {
                width: 100%;
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
                    <a href="/lowongan" class="nav-link active">
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
            <div class="page-header">
                <div class="header-left">
                <h1 class="page-title">Manajemen Lowongan</h1>
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
                    <input type="text" class="search-input" placeholder="Cari lowongan...">
                    <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <button class="add-job-btn" onclick="openAddJobModal()">tambah</button>
                <button class="filter-btn" title="Filter">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 11H17V13H7V11ZM4 7H20V9H4V7ZM10 15H14V17H10V15Z" fill="#9CA3AF"/>
                    </svg>
                </button>
            </div>

            <!-- Job Management Table -->
            <div class="table-card">
                <div class="table-header"></div>
                
                <!-- Table Header -->
                <div class="table-header-row">
                    <div class="header-item">Posisi</div>
                    <div class="header-item">Lokasi</div>
                    <div class="header-item">Gaji</div>
                    <div class="header-item">Status</div>
                    <div class="header-item">Pelamar</div>
                    <div class="header-item">Tanggal Posting</div>
                    <div class="header-item">Aksi</div>
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
                    
                    <!-- Job Card 6 -->
                    <div class="job-card">
                        <div class="job-card-content">
                            <div class="job-info">
                                <div class="job-avatar">MD</div>
                                <div class="job-details">
                                    <h4>Mobile Developer</h4>
                                    <p class="job-id">#2637</p>
                                </div>
                            </div>
                            <div class="job-location">Semarang</div>
                            <div class="job-salary">Rp 11.000.000</div>
                            <div class="job-status">
                                <div class="status-dot pending"></div>
                                <span class="status-text pending">Menunggu</span>
                            </div>
                            <div class="applicant-count">3</div>
                            <div class="posting-date">03 Mar 2024</div>
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

    <!-- Add Job Modal -->
    <div id="addJobModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Tambah Lowongan</h2>
                <div class="modal-category">
                    <label for="category">Kategori</label>
                    <select id="category" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="technology">Technology</option>
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                        <option value="finance">Finance</option>
                        <option value="hr">Human Resources</option>
                    </select>
                </div>
            </div>
            
            <form class="job-form">
                <div class="form-group full-width">
                    <label for="jobName">Nama Pekerjaan</label>
                    <input type="text" id="jobName" name="jobName" required>
                </div>
                
                <div class="form-row-with-dropdowns">
                    <div class="form-group">
                        <label for="salary">Gaji</label>
                        <input type="text" id="salary" name="salary" placeholder="Rp 5.000.000" required>
                    </div>
                    <div class="dropdown-item">
                        <label for="location">Lokasi</label>
                        <select id="location" name="location" required>
                            <option value="">Pilih Lokasi</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="bandung">Bandung</option>
                            <option value="surabaya">Surabaya</option>
                            <option value="yogyakarta">Yogyakarta</option>
                            <option value="medan">Medan</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label for="time">Waktu</label>
                        <select id="time" name="time" required>
                            <option value="">Pilih Waktu</option>
                            <option value="fulltime">Full Time</option>
                            <option value="parttime">Part Time</option>
                            <option value="contract">Contract</option>
                            <option value="internship">Internship</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Pilih Gender</option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                            <option value="any">Laki-laki/Perempuan</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group full-width">
                    <label for="jobDetails">Detail Pekerjaan</label>
                    <textarea id="jobDetails" name="jobDetails" rows="4" placeholder="Masukkan detail pekerjaan..." required></textarea>
                </div>
                
                <div class="form-group full-width">
                    <label for="jobRequirements">Syarat Pekerjaan</label>
                    <textarea id="jobRequirements" name="jobRequirements" rows="4" placeholder="Masukkan syarat pekerjaan..." required></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeAddJobModal()">Batal</button>
                    <button type="submit" class="btn-save">simpan</button>
                </div>
            </form>
        </div>
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
                const jobTitle = event.target.closest('.job-card-row').querySelector('h4').textContent;
                
                console.log(`${action} clicked for job: ${jobTitle}`);
                
                // Close dropdown after action
                const dropdown = event.target.closest('.action-dropdown');
                dropdown.classList.remove('show');
                
                // Here you can add your action logic
                // For example: window.location.href = `/jobs/${jobId}/${action.toLowerCase()}`;
            }
        });

        function openAddJobModal() {
            document.getElementById('addJobModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closeAddJobModal() {
            document.getElementById('addJobModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        document.getElementById('addJobModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddJobModal();
            }
        });
        
        // Handle form submission
        document.querySelector('.job-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Lowongan berhasil ditambahkan!');
            closeAddJobModal();
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
    </script>
</body>
</html> 