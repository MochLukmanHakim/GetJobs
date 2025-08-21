@extends('layouts.app')

@section('title', 'Manajemen Pelamar - GetJobs')
@section('page-title', 'Manajemen Pelamar')

@section('header-actions')
@endsection

@php
    $activePage = 'pelamar';
@endphp

@push('styles')
<style>
    /* Pelamar page specific styles */
    /* Content specific styles */

    /* Page Header */
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
            grid-template-columns: 1.6fr 1.2fr 1fr 1.2fr 80px 1.2fr;
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
            grid-template-columns: 1.6fr 1.2fr 1fr 1.2fr 80px 1.2fr;
            grid-template-areas: 'info email cv date action status';
            gap: 16px;
            align-items: center;
        }

        .applicant-info { grid-area: info; }
        .applicant-email { grid-area: email; }
        .applicant-cv { grid-area: cv; }
        .application-date { grid-area: date; }
        .action-menu { grid-area: action; }
        .applicant-status { grid-area: status; }

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

        .applicant-email {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        .applicant-cv {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #374151;
            font-weight: 500;
        }

        .applicant-cv svg {
            color: #6b7280;
            flex-shrink: 0;
        }

        .applicant-status {
            display: flex;
            align-items: center;
            gap: 6px;
            justify-content: flex-start;
            min-width: 120px;
        }

        .status-text {
            font-size: 11px;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 12px;
            background: #d1fae5;
            color: #059669;
        }

        .status-text.accepted {
            background: #d1fae5;
            color: #059669;
        }

        .status-text.rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-text.review {
            display: none;
        }

        .status-chooser {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .status-btn {
            width: 24px;
            height: 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .status-btn.approve {
            background: #d1fae5;
            color: #059669;
        }

        .status-btn.approve:hover {
            background: #a7f3d0;
            transform: scale(1.1);
        }

        .status-btn.reject {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-btn.reject:hover {
            background: #fecaca;
            transform: scale(1.1);
        }

        .application-date {
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
        }

        /* Action Status Styles */
        .action-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .action-status-badge {
            font-size: 11px;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .action-status-badge.interview { background: #dbeafe; color: #1d4ed8; }
        .action-status-badge.test { background: #f3e8ff; color: #7c3aed; }
        .action-status-badge.document { background: #fef3c7; color: #d97706; }
        .action-status-badge.phone { background: #dcfce7; color: #16a34a; }
        .action-status-badge.none { background: #f3f4f6; color: #6b7280; }
        .action-status-badge.completed { background: #d1fae5; color: #059669; }
        .action-status-badge.pending { background: #fef3c7; color: #d97706; }

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

        /* Announcement Area Styles */
        .announcement-area {
            display: none;
            background: transparent;
            border: none;
            border-left: none;
            border-radius: 0;
            padding: 8px 0 16px 0;
            margin-top: 8px;
            margin-bottom: 16px;
            box-shadow: none;
            animation: slideDown 0.22s ease;
        }

        .announcement-area.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .announcement-title {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 600;
            color: #111827;
        }
        .announcement-title::before { content: none; }

        .close-announcement {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .close-announcement:hover {
            background: #e5e7eb;
            color: #374151;
        }

        .announcement-form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .announcement-input-group {
            flex: 1;
        }

        .announcement-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 4px;
        }

        .announcement-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #ffffff;
        }

        .announcement-input:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.12);
        }

        .announcement-textarea {
            resize: vertical;
            min-height: 90px;
        }

        .announcement-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 8px;
        }
        .send-announcement-btn {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            min-width: 140px;
            justify-content: center;
            align-self: auto;
        }

        .send-announcement-btn:hover {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            transform: translateY(-1px);
        }

        .send-announcement-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        /* Toolbar di dalam form */
        .announcement-toolbar {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .template-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #ffffff;
            font-size: 14px;
        }
        .announcement-meta {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            color: #6b7280;
            font-size: 12px;
        }

        /* Filter Toggle Button */
        .filter-toggle-btn {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #374151;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-toggle-btn:hover {
            background: #e5e7eb;
            border-color: #9ca3af;
        }

        .filter-toggle-btn.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .filter-toggle-btn svg {
            width: 16px;
            height: 16px;
        }

        /* Announcement Status Badge */
        .announcement-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 500;
            padding: 2px 6px;
            border-radius: 10px;
            background: #dbeafe;
            color: #1d4ed8;
        }

        .announcement-status.sent {
            background: #d1fae5;
            color: #059669;
        }

        .announcement-status.pending {
            background: #fef3c7;
            color: #d97706;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .table-header-row,
            .applicant-card-content {
                grid-template-columns: 2fr 1.5fr 1fr 1.2fr 80px 1.2fr;
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
            
            .applicant-email,
            .applicant-cv,
            .applicant-status,
            .application-date {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border-bottom: 1px solid #f3f4f6;
            }
            
            .applicant-email::before {
                content: "Email: ";
                font-weight: 600;
                color: #374151;
            }
            
            .applicant-cv::before {
                content: "CV: ";
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

            /* Responsive announcement area */
            .announcement-form {
                flex-direction: column;
                align-items: stretch;
            }

            .send-announcement-btn {
                align-self: flex-end;
            }

            /* Responsive modal */
            .modal-content {
                margin: 10% auto;
                width: 95%;
                max-width: 400px;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding: 16px;
            }

            .btn {
                padding: 8px 16px;
                font-size: 13px;
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
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 0;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            animation: slideIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .close {
            color: #6b7280;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
        }

        .close:hover {
            color: #374151;
        }

        .modal-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .modal-footer {
            padding: 20px 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .action-menu {
            position: relative;
            display: inline-block;
        }

        /* Announcement two-column layout */
        .announcement-panel {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 16px;
            align-items: start;
        }
        .announcement-history {
            border-right: 1px solid #e5e7eb;
            padding-right: 12px;
        }
        .history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #6b7280;
            font-size: 12px;
            font-weight: 600;
        }
        .history-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .history-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 8px;
            color: #374151;
            background: transparent;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .history-item:hover {
            background: #f3f4f6;
            border-color: #e5e7eb;
        }
        .history-item.active {
            background: #eaf2ff;
            border-color: #bfdbfe;
            color: #1d4ed8;
        }
        .history-item .title {
            font-weight: 600;
            font-size: 13px;
        }
        .history-item .meta {
            font-size: 11px;
            color: #6b7280;
        }
        .new-announcement-btn {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            background: #2563eb;
            color: #fff;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .announcement-content {
            min-height: 160px;
        }
        .announcement-info {
            color: #6b7280;
            font-size: 12px;
        }
        .announcement-readonly { display: none; }
        .readonly-field { margin-bottom: 12px; }
        .readonly-label { font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 6px; display: block; }
        .readonly-box { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px 12px; white-space: pre-wrap; color: #374151; }

        @media (max-width: 900px) {
            .announcement-panel {
                grid-template-columns: 1fr;
            }
            .announcement-history {
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
                padding-bottom: 12px;
            }
        }


        .applicant-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .applicant-details { display: flex; flex-direction: column; }
</style>
@endpush

@section('content')
<div class="table-actions-flex">
    <div class="search-input-group">
        <input type="text" class="search-input" placeholder="Cari pelamar...">
        <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    </div>
    <button class="filter-btn" title="Filter">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 11H17V13H7V11ZM4 7H20V9H4V7ZM10 15H14V17H10V15Z" fill="#9CA3AF"/>
        </svg>
    </button>
            </div>

            <!-- Filter Toggle -->
           

            <!-- Job Filter Tabs -->
            <div class="job-filter-tabs">
                <div class="tab-container">
                    <button class="tab-item active" onclick="filterByJob('Manajemen Keuangan')">Manajemen Keuangan</button>
                    <button class="tab-item" onclick="filterByJob('Admin Medsos')">Admin Medsos</button>
                    <button class="tab-item" onclick="filterByJob('UI UX Designer')">UI UX Designer</button>
                    <button class="tab-item" onclick="filterByJob('Backend Developer')">Backend Developer</button>
                    <button class="tab-item" onclick="filterByJob('Product Manager')">Product Manager</button>
                    <button class="tab-item" onclick="filterByJob('Data Analyst')">Data Analyst</button>
                </div>
            </div>

            <!-- Applicant Management Table -->
            <div class="table-card">
                <div class="table-header"></div>
                
                <!-- Table Header -->
                <div class="table-header-row">
                    <div class="header-item">Nama</div>
                    <div class="header-item">Email</div>
                    <div class="header-item">CV</div>
                    <div class="header-item">Tanggal Lamar</div>
                    <div class="header-item">Aksi</div>
                    <div class="header-item">Status</div>
                </div>
                
                <!-- Manajemen Keuangan Applicants -->
                <div class="applicant-cards" id="Manajemen Keuangan">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card" data-applicant-id="1" data-has-announcement="true">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">JJ</div>
                                <div class="applicant-details">
                                    <h4>Jamal bin</h4>
                                </div>
                            </div>
                            <div class="applicant-email">jamalmaldin@gmail.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Jamal.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-1">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(1, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(1, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">17 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Announcement Area -->
                        <div class="announcement-area" id="announcement-1">
                            <div class="announcement-header">
                                <span class="announcement-title">Pengumuman ke Jamal bin</span>
                                <button class="close-announcement" onclick="closeAnnouncementArea(this)">✕</button>
                            </div>
                            <div class="announcement-form">
                                <div class="announcement-toolbar">
                                    <select class="template-select" onchange="applyAnnouncementTemplate(this, 1)">
                                        <option value="">Pilih tipe pengumuman</option>
                                        <option value="interview">Panggilan Wawancara</option>
                                        <option value="test">Undangan Tes</option>
                                        <option value="accepted">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                        <option value="info">Informasi</option>
                                    </select>
                                    <div class="announcement-meta">
                                        <span id="charCount-1">0</span>/500 karakter
                                    </div>
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Subjek Pengumuman</label>
                                    <input type="text" class="announcement-input" placeholder="Masukkan subjek pengumuman..." value="Informasi Proses Rekrutmen">
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Isi Pengumuman</label>
                                    <textarea class="announcement-input announcement-textarea" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateCharCount(1, this)">Halo Jamal, berikut informasi terkait proses rekrutmen Anda.</textarea>
                                </div>
                                <div class="announcement-actions">
                                    <button class="send-announcement-btn" onclick="sendAnnouncement(1, 'Jamal bin')">
                                        <span>📨</span> Kirim Pengumuman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Applicant Card 2 -->
                    <div class="applicant-card" data-applicant-id="2" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">SA</div>
                                <div class="applicant-details">
                                    <h4>Siti Aminah</h4>
                                </div>
                            </div>
                            <div class="applicant-email">siti.aminah@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Siti.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-2" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(2, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(2, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">16 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Announcement Area -->
                        <div class="announcement-area" id="announcement-2">
                            <div class="announcement-header">
                                <span class="announcement-title">Pengumuman ke Siti Aminah</span>
                                <button class="close-announcement" onclick="closeAnnouncementArea(this)">✕</button>
                            </div>
                            <div class="announcement-form">
                                <div class="announcement-toolbar">
                                    <select class="template-select" onchange="applyAnnouncementTemplate(this, 2)">
                                        <option value="">Pilih tipe pengumuman</option>
                                        <option value="interview">Panggilan Wawancara</option>
                                        <option value="test">Undangan Tes</option>
                                        <option value="accepted">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                        <option value="info">Informasi</option>
                                    </select>
                                    <div class="announcement-meta">
                                        <span id="charCount-2">0</span>/500 karakter
                                    </div>
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Subjek Pengumuman</label>
                                    <input type="text" class="announcement-input" placeholder="Masukkan subjek pengumuman..." value="Informasi Proses Rekrutmen">
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Isi Pengumuman</label>
                                    <textarea class="announcement-input announcement-textarea" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateCharCount(2, this)">Halo Siti, berikut informasi terkait proses rekrutmen Anda.</textarea>
                                </div>
                                <div class="announcement-actions">
                                    <button class="send-announcement-btn" onclick="sendAnnouncement(2, 'Siti Aminah')">
                                        <span>📨</span> Kirim Pengumuman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Card 3 - Additional for Manajemen Keuangan -->
                    <div class="applicant-card" data-applicant-id="15" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">BK</div>
                                <div class="applicant-details">
                                    <h4>Budi Kusuma</h4>
                                </div>
                            </div>
                            <div class="applicant-email">budi.kusuma@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Budi.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-15" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(15, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(15, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">15 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Card 4 - Additional for Manajemen Keuangan -->
                    <div class="applicant-card" data-applicant-id="16" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">AP</div>
                                <div class="applicant-details">
                                    <h4>Andi Pratama</h4>
                                </div>
                            </div>
                            <div class="applicant-email">andi.pratama@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Andi.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-16" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(16, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(16, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">14 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Medsos Applicants -->
                <div class="applicant-cards" id="Admin Medsos" style="display: none;">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card" data-applicant-id="3" data-has-announcement="true">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">RW</div>
                                <div class="applicant-details">
                                    <h4>Rina Wati</h4>
                                </div>
                            </div>
                            <div class="applicant-email">rina.wati@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Rina.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-3" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(3, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(3, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">15 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Announcement Area -->
                        <div class="announcement-area" id="announcement-3">
                            <div class="announcement-header">
                                <span class="announcement-title">Pengumuman ke Rina Wati</span>
                                <button class="close-announcement" onclick="closeAnnouncementArea(this)">✕</button>
                            </div>
                            <div class="announcement-form">
                                <div class="announcement-toolbar">
                                    <select class="template-select" onchange="applyAnnouncementTemplate(this, 3)">
                                        <option value="">Pilih tipe pengumuman</option>
                                        <option value="interview">Panggilan Wawancara</option>
                                        <option value="test">Undangan Tes</option>
                                        <option value="accepted">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                        <option value="info">Informasi</option>
                                    </select>
                                    <div class="announcement-meta">
                                        <span id="charCount-3">0</span>/500 karakter
                                    </div>
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Subjek Pengumuman</label>
                                    <input type="text" class="announcement-input" placeholder="Masukkan subjek pengumuman..." value="Selamat! Anda diterima sebagai Admin Medsos">
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Isi Pengumuman</label>
                                    <textarea class="announcement-input announcement-textarea" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateCharCount(3, this)">Selamat! Kami dengan senang hati mengumumkan bahwa Anda telah diterima untuk posisi Admin Medsos. Silakan hubungi HR kami untuk langkah selanjutnya.</textarea>
                                </div>
                                <div class="announcement-actions">
                                    <button class="send-announcement-btn" onclick="sendAnnouncement(3, 'Rina Wati')">
                                        <span>📨</span> Kirim Pengumuman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Applicant Card 2 -->
                    <div class="applicant-card" data-applicant-id="4" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">DK</div>
                                <div class="applicant-details">
                                    <h4>Dewi Kusuma</h4>
                                </div>
                            </div>
                            <div class="applicant-email">dewi.kusuma@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Dewi.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-4" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(4, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(4, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">14 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>

                    </div>
                        
                        <!-- Announcement Area -->
                        <div class="announcement-area" id="announcement-4">
                            <div class="announcement-header">
                                <span class="announcement-title">Pengumuman ke Dewi Kusuma</span>
                                <button class="close-announcement" onclick="closeAnnouncementArea(this)">✕</button>
                            </div>
                            <div class="announcement-form">
                                <div class="announcement-toolbar">
                                    <select class="template-select" onchange="applyAnnouncementTemplate(this, 4)">
                                        <option value="">Pilih tipe pengumuman</option>
                                        <option value="interview">Panggilan Wawancara</option>
                                        <option value="test">Undangan Tes</option>
                                        <option value="accepted">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                        <option value="info">Informasi</option>
                                    </select>
                                    <div class="announcement-meta">
                                        <span id="charCount-4">0</span>/500 karakter
                                    </div>
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Subjek Pengumuman</label>
                                    <input type="text" class="announcement-input" placeholder="Masukkan subjek pengumuman..." value="Selamat! Anda diterima sebagai Admin Medsos">
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Isi Pengumuman</label>
                                    <textarea class="announcement-input announcement-textarea" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateCharCount(4, this)">Selamat! Kami dengan senang hati mengumumkan bahwa Anda telah diterima untuk posisi Admin Medsos. Silakan hubungi HR kami untuk langkah selanjutnya.</textarea>
                                </div>
                                <div class="announcement-actions">
                                    <button class="send-announcement-btn" onclick="sendAnnouncement(4, 'Dewi Kusuma')">
                                        <span>📨</span> Kirim Pengumuman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UI UX Designer Applicants -->
                <div class="applicant-cards" id="UI UX Designer" style="display: none;">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card" data-applicant-id="5" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">AS</div>
                                <div class="applicant-details">
                                    <h4>Ahmad Suryadi</h4>
                                </div>
                            </div>
                            <div class="applicant-email">ahmad.suryadi@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Ahmad.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-5" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(5, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(5, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">13 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Announcement Area -->
                        <div class="announcement-area" id="announcement-5">
                            <div class="announcement-header">
                                <span class="announcement-title">Pengumuman ke Ahmad Suryadi</span>
                                <button class="close-announcement" onclick="closeAnnouncementArea(this)">✕</button>
                            </div>
                            <div class="announcement-form">
                                <div class="announcement-toolbar">
                                    <select class="template-select" onchange="applyAnnouncementTemplate(this, 5)">
                                        <option value="">Pilih tipe pengumuman</option>
                                        <option value="interview">Panggilan Wawancara</option>
                                        <option value="test">Undangan Tes</option>
                                        <option value="accepted">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                        <option value="info">Informasi</option>
                                    </select>
                                    <div class="announcement-meta">
                                        <span id="charCount-5">0</span>/500 karakter
                                    </div>
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Subjek Pengumuman</label>
                                    <input type="text" class="announcement-input" placeholder="Masukkan subjek pengumuman..." value="Selamat! Anda diterima sebagai UI UX Designer">
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Isi Pengumuman</label>
                                    <textarea class="announcement-input announcement-textarea" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateCharCount(5, this)">Selamat! Kami dengan senang hati mengumumkan bahwa Anda telah diterima untuk posisi UI UX Designer. Silakan hubungi HR kami untuk langkah selanjutnya.</textarea>
                                </div>
                                <div class="announcement-actions">
                                    <button class="send-announcement-btn" onclick="sendAnnouncement(5, 'Ahmad Suryadi')">
                                        <span>📨</span> Kirim Pengumuman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Applicant Card 2 -->
                    <div class="applicant-card" data-applicant-id="6" data-has-announcement="true">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">NP</div>
                                <div class="applicant-details">
                                    <h4>Nina Putri</h4>
                                </div>
                            </div>
                            <div class="applicant-email">nina.putri@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Nina.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-6" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(6, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(6, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">12 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Announcement Area -->
                        <div class="announcement-area" id="announcement-6">
                            <div class="announcement-header">
                                <span class="announcement-title">Pengumuman ke Nina Putri</span>
                                <button class="close-announcement" onclick="closeAnnouncementArea(this)">✕</button>
                            </div>
                            <div class="announcement-form">
                                <div class="announcement-toolbar">
                                    <select class="template-select" onchange="applyAnnouncementTemplate(this, 6)">
                                        <option value="">Pilih tipe pengumuman</option>
                                        <option value="interview">Panggilan Wawancara</option>
                                        <option value="test">Undangan Tes</option>
                                        <option value="accepted">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                        <option value="info">Informasi</option>
                                    </select>
                                    <div class="announcement-meta">
                                        <span id="charCount-6">0</span>/500 karakter
                                    </div>
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Subjek Pengumuman</label>
                                    <input type="text" class="announcement-input" placeholder="Masukkan subjek pengumuman..." value="Selamat! Anda diterima sebagai UI UX Designer">
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Isi Pengumuman</label>
                                    <textarea class="announcement-input announcement-textarea" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateCharCount(6, this)">Selamat! Kami dengan senang hati mengumumkan bahwa Anda telah diterima untuk posisi UI UX Designer. Silakan hubungi HR kami untuk langkah selanjutnya.</textarea>
                                </div>
                                <div class="announcement-actions">
                                    <button class="send-announcement-btn" onclick="sendAnnouncement(6, 'Nina Putri')">
                                        <span>📨</span> Kirim Pengumuman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Backend Developer Applicants -->
                <div class="applicant-cards" id="Backend Developer" style="display: none;">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card" data-applicant-id="7" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">FH</div>
                                <div class="applicant-details">
                                    <h4>Fajar Hidayat</h4>
                                </div>
                            </div>
                            <div class="applicant-email">fajar.hidayat@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Fajar.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-7" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(7, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(7, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">11 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Card 2 -->
                    <div class="applicant-card" data-applicant-id="8" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">RP</div>
                                <div class="applicant-details">
                                    <h4>Rizki Pratama</h4>
                                </div>
                            </div>
                            <div class="applicant-email">rizki.pratama@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Rizki.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text accepted" id="status-label-8">Diterima</span>
                                <span class="status-chooser" style="display:none;">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(8, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(8, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">10 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Manager Applicants -->
                <div class="applicant-cards" id="Product Manager" style="display: none;">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card" data-applicant-id="9" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">LS</div>
                                <div class="applicant-details">
                                    <h4>Linda Sari</h4>
                                </div>
                            </div>
                            <div class="applicant-email">linda.sari@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Linda.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-9" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(9, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(9, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">9 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Card 2 -->
                    <div class="applicant-card" data-applicant-id="10" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">MW</div>
                                <div class="applicant-details">
                                    <h4>Maya Wati</h4>
                                </div>
                            </div>
                            <div class="applicant-email">maya.wati@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Maya.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text rejected" id="status-label-10">Ditolak</span>
                                <span class="status-chooser" style="display:none;">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(10, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(10, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">8 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Analyst Applicants -->
                <div class="applicant-cards" id="Data Analyst" style="display: none;">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card" data-applicant-id="11" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">IA</div>
                                <div class="applicant-details">
                                    <h4>Indra Ardiansyah</h4>
                                </div>
                            </div>
                            <div class="applicant-email">indra.ardiansyah@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Indra.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text accepted" id="status-label-11">Diterima</span>
                                <span class="status-chooser" style="display:none;">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(11, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(11, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">7 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Card 2 -->
                    <div class="applicant-card" data-applicant-id="12" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">SP</div>
                                <div class="applicant-details">
                                    <h4>Sarah Permata</h4>
                                </div>
                            </div>
                            <div class="applicant-email">sarah.permata@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Sarah.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-12" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(12, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(12, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">6 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Card 3 -->
                    <div class="applicant-card" data-applicant-id="13" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">DH</div>
                                <div class="applicant-details">
                                    <h4>Dedi Hermawan</h4>
                                </div>
                            </div>
                            <div class="applicant-email">dedi.hermawan@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Dedi.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text rejected" id="status-label-13">Ditolak</span>
                                <span class="status-chooser" style="display:none;">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(13, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(13, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">5 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                </div>
                <div class="applicant-cards" id="Backend Developer" style="display: none;">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card" data-applicant-id="19" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">RJ</div>
                                <div class="applicant-details">
                                    <h4>Rizki Jaya</h4>
                                </div>
                            </div>
                            <div class="applicant-email">rizki.jaya@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Rizki.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-19" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(19, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(19, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">11 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Card 2 -->
                    <div class="applicant-card" data-applicant-id="6" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">RN</div>
                                <div class="applicant-details">
                                    <h4>Rina Novita</h4>
                                </div>
                            </div>
                            <div class="applicant-email">rina.novita@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Rina.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-6" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(6, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(6, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">12 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>

                    <!-- Applicant Card 3 -->
                    <div class="applicant-card" data-applicant-id="18" data-has-announcement="false">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">AP</div>
                                <div class="applicant-details">
                                    <h4>Andi Pratama</h4>
                                </div>
                            </div>
                            <div class="applicant-email">andi.pratama@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Andi.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text review" id="status-label-18" style="display:none;">Review</span>
                                <span class="status-chooser">
                                    <button type="button" class="status-btn approve" onclick="setApplicantStatus(18, true)" title="Terima">✓</button>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(18, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            <div class="application-date">11 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                    <div class="action-item announcement" onclick="openAnnouncementPanel(this)">Pengumuman</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Manager Applicants -->
                <div class="applicant-cards" id="Product Manager" style="display: none;">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">BK</div>
                                <div class="applicant-details">
                                    <h4>Budi Kusuma</h4>
                                </div>
                            </div>
                            <div class="applicant-email">budi.kusuma@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Budi.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text accepted">Diterima</span>
                            </div>
                            <div class="application-date">10 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Analyst Applicants -->
                <div class="applicant-cards" id="Data Analyst" style="display: none;">
                    <!-- Applicant Card 1 -->
                    <div class="applicant-card">
                        <div class="applicant-card-content">
                            <div class="applicant-info">
                                <div class="applicant-avatar">MW</div>
                                <div class="applicant-details">
                                    <h4>Maya Wati</h4>
                                </div>
                            </div>
                            <div class="applicant-email">maya.wati@email.com</div>
                            <div class="applicant-cv">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>CV_Maya.pdf</span>
                            </div>
                            <div class="applicant-status">
                                <span class="status-text accepted">Diterima</span>
                            </div>
                            <div class="application-date">9 Agustus 2025</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item view">Lihat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Global Announcement Panel -->
                <div id="globalAnnouncementPanel" class="announcement-area" style="display:none;">
                    <div class="announcement-header">
                        <span class="announcement-title" id="globalAnnouncementTitle">Pengumuman</span>
                        <button class="close-announcement" onclick="closeGlobalAnnouncementPanel()">✕</button>
                    </div>
                    <div class="announcement-panel">
                        <div class="announcement-history">
                            <button class="new-announcement-btn" onclick="startNewAnnouncement()">+ Pengumuman Baru</button>
                            <div class="history-header">
                                <span>Histori Pengumuman</span>
                                <span id="historyCount" class="announcement-info">0 item</span>
                            </div>
                            <div id="historyList" class="history-list"></div>
                        </div>

                        <div class="announcement-content">
                            <div id="announcementForm" class="announcement-form">
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Subjek Pengumuman</label>
                                    <input type="text" id="globalAnnouncementSubject" class="announcement-input" placeholder="Masukkan subjek pengumuman...">
                                </div>
                                <div class="announcement-input-group">
                                    <label class="announcement-label">Isi Pengumuman</label>
                                    <textarea id="globalAnnouncementBody" class="announcement-input announcement-textarea" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateGlobalCharCount()"></textarea>
                                </div>
                                <div class="announcement-meta">
                                    <span id="globalCharCount">0</span>/500 karakter
                                </div>
                                <div class="announcement-actions">
                                    <button class="send-announcement-btn" onclick="sendGlobalAnnouncement()">
                                        <span>📨</span> Kirim
                                    </button>
                                </div>
                            </div>

                            <div id="announcementReadonly" class="announcement-readonly">
                                <div class="readonly-field">
                                    <span class="readonly-label">Subjek</span>
                                    <div id="readonlySubject" class="readonly-box"></div>
                                </div>
                                <div class="readonly-field">
                                    <span class="readonly-label">Isi</span>
                                    <div id="readonlyBody" class="readonly-box"></div>
                                </div>
                                <div class="announcement-info" id="readonlyMeta"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="page-btn">‹</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <span class="page-btn">...</span>
                    <button class="page-btn">›</button>
                </div>
            </div>
@endsection

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
            
            // Hide all applicant cards
            document.querySelectorAll('.applicant-cards').forEach(cards => {
                cards.style.display = 'none';
            });

            // Show only the cards for the selected position
            const selectedCards = document.getElementById(position);
            if (selectedCards) {
                selectedCards.style.display = 'flex';
                selectedCards.style.flexDirection = 'column';
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

        // Announcement Functions
        let currentAnnouncementApplicantId = null;
        let currentAnnouncementApplicantName = '';

        // Data histori per pelamar (sementara in-memory)
        const announcementHistory = new Map(); // key: applicantId, value: Array<{id, subject, body, date}>
        let selectedHistoryId = null;

        function getHistory(applicantId) {
            if (!announcementHistory.has(applicantId)) {
                announcementHistory.set(applicantId, []);
            }
            return announcementHistory.get(applicantId);
        }

        function renderHistory(applicantId) {
            const list = document.getElementById('historyList');
            const items = getHistory(applicantId);
            list.innerHTML = '';
            document.getElementById('historyCount').textContent = `${items.length} item`;

            items.slice().reverse().forEach((item) => {
                const el = document.createElement('button');
                el.type = 'button';
                el.className = 'history-item' + (selectedHistoryId === item.id ? ' active' : '');
                el.onclick = () => openHistoryItem(applicantId, item.id);
                el.innerHTML = `
                    <div>
                        <div class="title">${escapeHtml(item.subject || '(Tanpa subjek)')}</div>
                        <div class="meta">${formatDate(item.date)}</div>
                    </div>
                `;
                list.appendChild(el);
            });
        }

        function startNewAnnouncement() {
            selectedHistoryId = null;
            document.getElementById('announcementReadonly').style.display = 'none';
            document.getElementById('announcementForm').style.display = 'flex';
            document.getElementById('globalAnnouncementSubject').value = '';
            document.getElementById('globalAnnouncementBody').value = '';
            updateGlobalCharCount();
        }

        function openHistoryItem(applicantId, historyId) {
            const items = getHistory(applicantId);
            const found = items.find(i => i.id === historyId);
            if (!found) return;
            selectedHistoryId = historyId;
            document.getElementById('announcementForm').style.display = 'none';
            document.getElementById('announcementReadonly').style.display = 'block';
            document.getElementById('readonlySubject').textContent = found.subject || '(Tanpa subjek)';
            document.getElementById('readonlyBody').textContent = found.body || '-';
            document.getElementById('readonlyMeta').textContent = `Dikirim pada ${formatDate(found.date)}`;
            // refresh highlight
            renderHistory(currentAnnouncementApplicantId);
        }

        function openAnnouncementPanel(button) {
            const card = button.closest('.applicant-card');
            currentAnnouncementApplicantId = card.getAttribute('data-applicant-id');
            currentAnnouncementApplicantName = card.querySelector('h4')?.textContent || '';

            const panel = document.getElementById('globalAnnouncementPanel');
            document.getElementById('globalAnnouncementTitle').textContent = `Pengumuman ke ${currentAnnouncementApplicantName}`;
            document.getElementById('globalAnnouncementSubject').value = '';
            document.getElementById('globalAnnouncementBody').value = '';
            document.getElementById('globalCharCount').textContent = '0';

            // Pindahkan panel tepat di bawah baris pelamar yang dipilih
            if (panel && card && card.parentElement) {
                card.insertAdjacentElement('afterend', panel);
            }
            panel.style.display = 'block';

            // render histori & tampilkan form baru default
            renderHistory(currentAnnouncementApplicantId);
            startNewAnnouncement();

            // tutup dropdown aksi
            const dropdown = button.closest('.action-dropdown');
            if (dropdown) dropdown.classList.remove('show');
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function closeGlobalAnnouncementPanel() {
            currentAnnouncementApplicantId = null;
            currentAnnouncementApplicantName = '';
            const panel = document.getElementById('globalAnnouncementPanel');
            panel.style.display = 'none';
        }

        function updateGlobalCharCount() {
            const body = document.getElementById('globalAnnouncementBody');
            document.getElementById('globalCharCount').textContent = String(body.value.length);
        }

        function sendGlobalAnnouncement() {
            if (!currentAnnouncementApplicantId) return;
            const subject = document.getElementById('globalAnnouncementSubject');
            const body = document.getElementById('globalAnnouncementBody');
            const btn = document.querySelector('#globalAnnouncementPanel .send-announcement-btn');

            if (!subject.value.trim() || !body.value.trim()) {
                alert('Harap isi subjek dan isi pengumuman.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span>⌛</span> Mengirim...';

            setTimeout(() => {
                // Simulasi tersimpan ke histori
                const items = getHistory(currentAnnouncementApplicantId);
                const newItem = {
                    id: Date.now(),
                    subject: subject.value.trim(),
                    body: body.value.trim(),
                    date: new Date(),
                };
                items.push(newItem);

                // refresh UI
                renderHistory(currentAnnouncementApplicantId);
                openHistoryItem(currentAnnouncementApplicantId, newItem.id);

                btn.disabled = false;
                btn.innerHTML = '<span>📨</span> Kirim';
                alert(`Pengumuman terkirim ke ${currentAnnouncementApplicantName}!`);
            }, 900);
        }

        // Utils
        function escapeHtml(str) {
            return str.replace(/[&<>"']/g, (c) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'}[c]));
        }
        function formatDate(d) {
            const date = (d instanceof Date) ? d : new Date(d);
            const pad = (n) => String(n).padStart(2,'0');
            return `${pad(date.getDate())}/${pad(date.getMonth()+1)}/${date.getFullYear()} ${pad(date.getHours())}:${pad(date.getMinutes())}`;
        }

        function setApplicantStatus(applicantId, isAccepted) {
            const statusDiv = document.querySelector(`[data-applicant-id="${applicantId}"] .applicant-status`);
            if (!statusDiv) return;
            let label = statusDiv.querySelector('.status-text');
            if (!label) {
                label = document.createElement('span');
                label.className = 'status-text review';
                label.style.display = 'none';
                statusDiv.insertBefore(label, statusDiv.firstChild);
            }
            const chooser = statusDiv.querySelector('.status-chooser');
            if (isAccepted) {
                label.className = 'status-text accepted';
                label.style.display = '';
                label.textContent = 'Diterima';
            } else {
                label.className = 'status-text rejected';
                label.style.display = '';
                label.textContent = 'Ditolak';
            }
            if (chooser) chooser.style.display = 'none';
        }

        // Inject chooser ke semua baris
        function ensureStatusChoosers() {
            document.querySelectorAll('.applicant-status').forEach((statusDiv, idx) => {
                // set label ke Review secara default dan sembunyikan
                const anyLabel = statusDiv.querySelector('.status-text');
                if (anyLabel) {
                    anyLabel.className = 'status-text review';
                    anyLabel.textContent = 'Review';
                    anyLabel.style.display = 'none';
                }
                // jika belum punya chooser, tambahkan
                if (!statusDiv.querySelector('.status-chooser')) {
                    const id = statusDiv.closest('.applicant-card')?.getAttribute('data-applicant-id') || idx + 1;
                    const chooser = document.createElement('span');
                    chooser.className = 'status-chooser';
                    chooser.innerHTML = `
                        <button type=\"button\" class=\"status-btn approve\" title=\"Terima\">✓</button>
                        <button type=\"button\" class=\"status-btn reject\" title=\"Tolak\">✕</button>
                    `;
                    const [approveBtn, rejectBtn] = chooser.querySelectorAll('button');
                    approveBtn.addEventListener('click', () => setApplicantStatus(id, true));
                    rejectBtn.addEventListener('click', () => setApplicantStatus(id, false));
                    statusDiv.appendChild(chooser);
                }
            });
        }

        // jalankan saat load
        document.addEventListener('DOMContentLoaded', ensureStatusChoosers);
    </script>
</body>
</html> 