@extends('layouts.app')

@section('title', 'Manajemen Pelamar - GetJobs')
@section('page-title', 'Manajemen Pelamar')

@php
    $activePage = 'pelamar';
    $pageType = 'pelamar';
@endphp

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            border-bottom: 1px solid #f3f4f6;
        }
        .profile-dropdown-item:last-child {
            border-bottom: none;
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
            grid-template-columns: 1fr 1.5fr 1.2fr 1fr 1fr 120px 20px 80px;
            gap: 12px;
            align-items: center;
            padding: 12px 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
            transition: margin-left 0.3s ease;
        }

        .header-item {
            font-weight: 600;
            color: #374151;
            font-size: 12px;
            text-align: center;
        }

        .header-item:first-child {
            text-align: center;
            padding-left: 0;
        }

        .header-item:last-child {
            text-align: center;
            margin-left: 40px;
        }

        /* Ensure Pengumuman header is centered */
        .header-item:nth-child(6) {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Ensure Status header is centered */
        .header-item:nth-child(7) {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Table with Checkboxes Layout */
        .table-with-checkboxes {
            position: relative;
        }
        
        .checkbox-column {
            position: absolute;
            left: 10px;
            top: 108px; /* Align with first applicant card after header */
            display: flex;
            flex-direction: column;
            gap: 8px; /* Match the gap between applicant cards */
            z-index: 10;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .checkbox-column.show {
            opacity: 1;
            visibility: visible;
        }
        
        .checkbox-item {
            height: 56px; /* Match applicant card content height (padding 16px top + bottom = 32px, content ~24px) */
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            margin-bottom: 8px; /* Match the margin-bottom of applicant cards */
            padding: 16px 0; /* Match applicant card vertical padding */
        }
        
        .table-card {
            transition: margin-left 0.3s ease;
        }
        
        .table-with-checkboxes.show-checkboxes .table-card,
        .table-with-checkboxes.show-checkboxes .applicant-cards {
            margin-left: 50px;
        }
        
        .table-with-checkboxes.show-checkboxes .table-header-row {
            margin-left: 50px;
        }

        /* Card-based Table Design */
        .applicant-cards {
            display: flex;
            flex-direction: column;
            gap: 16px;
            
        }

        .applicant-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px 20px;
            transition: all 0.3s ease, margin-left 0.3s ease;
            margin-bottom: 8px;
        }

        .applicant-card:hover {
            transform: translateY(-1px);
        }

        .applicant-card-content {
            display: grid;
            grid-template-columns: 1fr 1.5fr 1.2fr 1fr 1fr 120px 20px 80px;
            grid-template-areas: 'info email phone cv date action gap status';
            gap: 12px;
            align-items: center;
        }
        
        .applicant-card {
            position: relative;
        }
        
        .applicant-checkbox {
            position: absolute;
            left: -50px;
            top: 50%;
            transform: translateY(-50%);
            display: none;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }
        
        .applicant-info { 
            grid-area: info; 
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
        }
        .applicant-email { 
            grid-area: email; 
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        .applicant-phone { 
            grid-area: phone; 
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 0;
        }
        .applicant-cv { 
            grid-area: cv; 
            text-align: center !important;
            display: flex !important;
            align-items: center;
            justify-content: center !important;
            gap: 6px;
            padding: 0 !important;
            margin: 0;
        }
        .application-date { 
            grid-area: date; 
            text-align: right;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-right: 0;
        }
        .action-menu { 
            grid-area: action; 
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .applicant-status { 
            grid-area: status; 
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .card-view .applicant-details h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #1e293b;
            line-height: 1.3;
        }

        .applicant-email {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        .applicant-job-category {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #002746;
            margin-bottom: 8px;
            background: #f0f4f8;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 500;
        }

        .applicant-job-category svg {
            color: #002746;
        }

        .applicant-phone {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .applicant-phone svg {
            color: #9ca3af;
            flex-shrink: 0;
        }

        .applicant-cv {
            display: flex;
            align-items: center;
            justify-content: center !important;
            gap: 8px;
            font-size: 12px;
            color: #374151;
            font-weight: 500;
            text-align: center !important;
        }

        .applicant-cv svg {
            color: #6b7280;
            flex-shrink: 0;
        }

        .applicant-status {
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 1;
            position: relative;
            justify-content: flex-start;
            min-width: 120px;
        }

        .status-text {
            font-size: 11px;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 12px;
            background: #f3f4f6;
            color: #059669;
            margin-left: -20px;
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
            background: #f3f4f6;
            color: #6b7280;
        }

        .status-chooser {
            display: flex;
            gap: 4px;
            align-items: center;
            margin-left: -17px;
        }

        .status-btn {
            width: 24px;
            height: 24px;
            border: 2px solid rgb(6, 34, 80);
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            background: white;
            color: rgb(6, 34, 80);
        }

        .status-btn.approve {
            background: white;
            color: rgb(6, 34, 80);
            border: 2px solid rgb(6, 34, 80);
        }

        .status-btn.approve:hover {
            background: rgb(6, 34, 80);
            color: white;
            transform: scale(1.1);
        }

        .status-btn.reject {
            background: white;
            color: rgb(6, 34, 80);
            border: 2px solid rgb(6, 34, 80);
        }

        .status-btn.reject:hover {
            background: rgb(6, 34, 80);
            color: white;
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

        .announcement-btn {
            background: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            width: 32px;
            height: 32px;
            z-index: 10;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .announcement-btn:hover {
            background: #e2e8f0;
            color: #334155;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .announcement-btn:active {
            transform: translateY(0);
        }
        
        .card-announcement-btn {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            padding: 6px 8px;
            border-radius: 6px;
            color: #374151;
            width: auto;
            height: auto;
            margin: 0;
        }
        
        .card-announcement-btn:hover {
            background: #e5e7eb;
            color: #1f2937;
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

        /* Controls Container */
        .controls-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 20px;
        }
        
        .select-all-container {
            display: flex !important;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            color: #475569;
            font-weight: 500;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .right-controls {
            display: flex !important;
            align-items: center;
            gap: 12px;
            visibility: visible !important;
        }
        

        /* Job Group Styling */
        .job-group {
            margin-bottom: 32px;
        }
        
        .job-group-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            margin-bottom: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .job-title {
            color: white;
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }
        
        .applicant-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        /* Job Filter Section */
        .job-filter-section {
            width: 100%;
            margin-bottom: 20px;
        }

        /* Job Filter Tabs */
        .job-filter-tabs {
            display: flex;
            gap: 8px;
            margin: 0;
            overflow-x: auto;
            padding: 4px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .job-filter-tab {
            padding: 8px 16px;
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            min-width: fit-content;
        }

        .job-filter-tab:hover {
            background: #e2e8f0;
            color: #475569;
        }

        .job-filter-tab.active {
            background: #3b82f6;
            color: white;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
        }

        .tab-container {
            display: flex;
            background: transparent;
            border: none;
            padding: 0;
            gap: 16px;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            -webkit-overflow-scrolling: touch;
            max-width: calc(5 * 140px + 4 * 16px);
            justify-content: flex-start;
        }

        .tab-container::-webkit-scrollbar {
            display: none;
        }

        .tab-item {
            flex: none;
            min-width: 140px;
            max-width: 140px;
            white-space: nowrap;
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
            overflow: hidden;
            text-overflow: ellipsis;
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

        /* CV Modal Styles */
        .cv-modal {
            display: none;
            position: fixed;
            top: 0;
            left: var(--sidebar-width, 280px);
            width: calc(100% - var(--sidebar-width, 280px));
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(2px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 0;
            box-sizing: border-box;
            transition: left 0.3s ease, width 0.3s ease;
        }

        .cv-modal-content {
            background: transparent;
            border-radius: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            box-shadow: none;
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
            display: flex;
            flex-direction: column;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .cv-modal-header {
            display: none;
        }

        .cv-modal-title {
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .cv-modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: #6b7280;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cv-modal-close:hover {
            background: #e5e7eb;
            color: #374151;
        }

        .cv-modal-body {
            padding: 0;
            overflow: hidden;
            flex: 1;
            display: flex;
            align-items: stretch;
            justify-content: stretch;
            position: relative;
            width: 100%;
            height: 100vh;
        }

        /* Responsive Modal */
        @media (max-width: 768px) {
            .cv-modal {
                left: 0 !important;
                width: 100% !important;
                padding: 0;
            }
            
            .cv-modal-content {
                width: 100%;
                height: 100%;
            }
            
            .cv-modal-header {
                display: none;
            }
            
            .cv-modal-body {
                padding: 0;
            }
            
            .cv-modal-title {
                font-size: 10px;
            }
        }

        /* Announcement Area Styles */
        .announcement-area {
            display: none;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            margin: 12px 0;
            width: 100%;
            position: relative;
            z-index: 1;
            overflow: visible;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        /* Bulk announcement specific positioning */
        #bulk-announcement-area {
            margin-top: 16px;
            margin-bottom: 20px;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            z-index: 10;
        }

        .announcement-area.show {
            display: block;
            animation: slideDownIn 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .announcement-area[style*="display: block"] {
            display: block !important;
            animation: slideDownIn 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .announcement-area.closing {
            animation: slideUpOut 0.3s cubic-bezier(0.55, 0.06, 0.68, 0.19) forwards;
        }

        @keyframes slideDownIn {
            0% {
                opacity: 0;
                transform: translateY(-15px);
                max-height: 0;
            }
            50% {
                opacity: 0.7;
                transform: translateY(-3px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
                max-height: 1000px;
            }
        }

        @keyframes slideUpOut {
            0% {
                opacity: 1;
                transform: translateY(0);
                max-height: 1000px;
            }
            50% {
                opacity: 0.3;
                transform: translateY(-8px);
            }
            100% {
                opacity: 0;
                transform: translateY(-15px);
                max-height: 0;
            }
        }

        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        /* Prevent scrollbars in announcement content */
        .announcement-area * {
            overflow: visible !important;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE/Edge */
        }

        .announcement-area *::-webkit-scrollbar {
            display: none; /* Chrome/Safari/Opera */
        }

        .announcement-area textarea,
        .announcement-area input[type="text"] {
            overflow: visible;
            resize: vertical;
            min-height: auto;
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
            background: #1f2937;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            min-width: 140px;
            justify-content: center;
            align-self: auto;
        }

        .send-announcement-btn:hover {
            background: #374151;
            transform: translateY(-1px);
        }

        .send-announcement-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        /* Toolbar di dalam form */
        .announcement-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .add-announcement-btn {
            background: #002746;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        
        .add-announcement-btn:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }
        
        .form-field {
            margin-bottom: 12px;
        }
        
        .template-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: transparent;
            font-size: 14px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        .announcement-meta {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            color: #6b7280;
            font-size: 12px;
        }

        /* View Toggle Buttons */
        .view-toggle-container {
            display: flex;
            background: #f3f4f6;
            border-radius: 8px;
            padding: 4px;
            gap: 2px;
        }

        .view-toggle-btn {
            background: transparent;
            border: none;
            color: #6b7280;
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

        .view-toggle-btn:hover {
            background: #e5e7eb;
            color: #374151;
        }

        .view-toggle-btn.active {
            background: #ffffff;
            color: #374151;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .view-toggle-btn svg {
            width: 16px;
            height: 16px;
        }

        /* Card View Styles */
        .card-view .applicant-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        /* 4-column layout when sidebar is collapsed */
        .sidebar.collapsed ~ .main-content .card-view .applicant-cards {
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .sidebar.collapsed ~ .main-content .card-view .applicant-card {
            padding: 16px;
        }

        .sidebar.collapsed ~ .main-content .card-view .applicant-avatar {
            width: 56px;
            height: 56px;
            font-size: 18px;
        }

        .sidebar.collapsed ~ .main-content .card-view .applicant-details h4 {
            font-size: 16px;
        }

        .sidebar.collapsed ~ .main-content .card-view .card-field-label,
        .sidebar.collapsed ~ .main-content .card-view .card-field-value {
            font-size: 12px;
        }

        .card-view .applicant-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
            position: relative;
            height: fit-content;
            text-align: center;
        }


        .card-view .applicant-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: #e2e8f0;
        }

        .card-view .applicant-card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
            height: 100%;
        }

        .card-view .applicant-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            width: 100%;
        }

        .card-view .applicant-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #64748b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 18px;
            margin: 0 auto 16px auto;
        }


        .card-view .card-field {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 8px 0;
            margin: 6px 0;
            border-bottom: 1px solid #f8fafc;
        }


        .card-view .card-field:last-of-type {
            border-bottom: none;
            margin-bottom: 16px;
        }

        .card-view .card-field-label {
            font-weight: 500;
            color: #64748b;
            font-size: 13px;
        }

        .card-view .card-field-value {
            font-weight: 500;
            color: #1e293b;
            font-size: 13px;
            text-align: right;
        }

        .card-view .card-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid #f3f4f6;
            width: 100%;
        }

        .card-view .card-actions .applicant-status {
            order: 1;
        }

        .card-view .card-actions .action-menu {
            order: 2;
        }

        .card-view .status-chooser {
            gap: 6px;
            margin-left: 0;
        }

        .card-view .status-btn {
            width: 28px;
            height: 28px;
            font-size: 12px;
            border-radius: 4px;
        }

        .card-view .announcement-btn {
            width: 28px;
            height: 28px;
            border-radius: 4px;
            font-size: 12px;
        }

        .card-view .card-announcement-btn {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-view .card-announcement-btn:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #475569;
        }

        /* Responsive for 3-column layout */
        @media (max-width: 1400px) {
            .sidebar-collapsed .card-view .applicant-cards {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1200px) {
            .card-view .applicant-cards {
                grid-template-columns: repeat(2, 1fr);
            }
            .sidebar-collapsed .card-view .applicant-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .card-view .applicant-cards {
                grid-template-columns: 1fr;
            }
            .sidebar-collapsed .card-view .applicant-cards {
                grid-template-columns: 1fr;
            }
        }

        .card-view .table-header-row {
            display: none;
        }

        /* Table View Styles (default) */
        .table-view .applicant-cards {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .table-view .applicant-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px 20px;
        }

        .table-view .applicant-card-content {
            display: grid;
            grid-template-columns: 1fr 1.5fr 1.2fr 1fr 1fr 120px 20px 80px;
            gap: 12px;
            align-items: center;
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
            .table-header-row {
                grid-template-columns: 1fr 1.5fr 1.2fr 1fr 1fr 120px 20px 80px;
                gap: 12px;
            }
            .applicant-card-content {
                grid-template-columns: 1fr 1.5fr 1.2fr 1fr 1fr 120px 20px 80px;
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
            .applicant-phone,
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
            
            .applicant-phone::before {
                content: "Telepon: ";
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
            
                    /* Ensure announcement area works in card view */
        .announcement-area {
            margin-top: 16px;
            border-top: 1px solid #e5e7eb;
            padding-top: 16px;
        }
        
        /* Card view specific announcement styling */
        .card-view .announcement-area {
            margin-top: 20px;
            border-top: 2px solid #e5e7eb;
            padding-top: 20px;
            background: #f9fafb;
            border-radius: 8px;
            padding: 20px;
            margin-left: 0;
            margin-right: 0;
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .card-view .announcement-area .announcement-header {
            margin-bottom: 20px;
        }
        
        .card-view .announcement-area .announcement-form {
            gap: 16px;
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
            margin-top: 16px;
        }
        
        .announcement-history {
            border-right: 1px solid #e5e7eb;
            padding-right: 16px;
        }
        
        .announcement-history h4 {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
        }
        
        .history-list {
            max-height: 200px;
            overflow-y: auto;
        }
        
        /* Bulk announcement specific history list styling */
        #bulk-announcement-area .history-list {
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 8px;
            background: #fafafa;
            min-height: 60px;
            position: relative;
            box-sizing: border-box;
        }
        
        #bulk-announcement-area .history-list::-webkit-scrollbar {
            width: 8px;
        }
        
        #bulk-announcement-area .history-list::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 4px;
        }
        
        #bulk-announcement-area .history-list::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }
        
        #bulk-announcement-area .history-list::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
        
        /* Force scrollbar to always be visible */
        #bulk-announcement-area .history-list {
            scrollbar-width: thin;
            scrollbar-color: #94a3b8 #e2e8f0;
            overflow-y: scroll !important;
        }
        
        /* Make scrollbar always visible on WebKit browsers */
        #bulk-announcement-area .history-list::-webkit-scrollbar {
            width: 10px;
            display: block !important;
        }
        
        #bulk-announcement-area .history-list::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 5px;
            border: 1px solid #e2e8f0;
        }
        
        #bulk-announcement-area .history-list::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 5px;
            border: 2px solid #f1f5f9;
        }
        
        #bulk-announcement-area .history-list::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
        
        #bulk-announcement-area .history-list::-webkit-scrollbar-corner {
            background: #f1f5f9;
        }
        
        .history-item {
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .history-date {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 4px;
        }
        
        .history-content {
            font-size: 12px;
            color: #374151;
            line-height: 1.4;
        }
        
        .no-history {
            font-size: 12px;
            color: #9ca3af;
            font-style: italic;
            text-align: center;
            padding: 20px 0;
        }
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
        
        /* Ensure bulk announcement history items are properly spaced */
        #bulk-announcement-area .history-item {
            padding: 6px 8px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            margin-bottom: 3px;
            flex-shrink: 0;
        }
        
        #bulk-announcement-area .history-item:last-child {
            margin-bottom: 0;
        }
        
        #bulk-announcement-area .history-item .title {
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }
        
        #bulk-announcement-area .history-item .meta {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }
        
        #bulk-announcement-area .no-history {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 20px;
        }
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
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: #fff;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .new-announcement-btn:hover {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            transform: translateY(-1px);
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

        /* Checkbox Styles */
        .select-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #374151;
            cursor: pointer;
        }

        .select-all-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #374151;
            cursor: pointer;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Bulk Actions */
        .bulk-actions {
            display: none;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .bulk-actions.show {
            display: flex;
        }

        .bulk-actions-text {
            font-size: 12px;
            color: #475569;
            font-weight: 500;
            margin-right: 4px;
        }

        .bulk-action-btn {
            width: 24px;
            height: 24px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .bulk-action-btn.accept {
            background: #10b981;
            color: white;
        }

        .bulk-action-btn.accept:hover {
            background: #059669;
        }

        .bulk-action-btn.reject {
            background: #ef4444;
            color: white;
        }

        .bulk-action-btn.reject:hover {
            background: #dc2626;
        }

        .bulk-actions .announcement-btn {
            width: 32px;
            height: 32px;
            margin: 0;
        }
</style>
@endpush

@section('content')

            <!-- Modern Search and View Controls -->
            <div class="controls-container">
                <!-- Modern Search Component -->
                @include('components.modern-search', [
                    'pageType' => 'pelamar', 
                    'categories' => $jobCategories->pluck('judul_pekerjaan')->toArray()
                ])

                <!-- Right Controls -->
                <div class="right-controls">
                    
                    <!-- Bulk Actions -->
                    <div class="bulk-actions" id="bulk-actions" style="display: none;">
                        <span class="bulk-actions-text" id="selected-count">0 pelamar dipilih</span>
                        <button class="announcement-btn" onclick="bulkAnnouncement()" title="Kirim Pengumuman"><i class="bi bi-pencil"></i></button>
                    </div>
                    
                    <!-- Select All Control -->
                    <div class="select-all-container">
                        <input type="checkbox" class="select-all-checkbox" id="select-all" onchange="toggleSelectAll()">
                        <label for="select-all">Pilih Semua</label>
                    </div>
                </div>
            </div>
            
            <!-- Bulk Announcement Area (moved here from bottom) -->
            <div class="announcement-area" id="bulk-announcement-area" style="display: none; margin-top: 16px; position: relative; z-index: 10;">
                <div class="announcement-header">
                    <span class="announcement-title" id="bulk-announcement-title">Pengumuman ke 0 pelamar</span>
                    <button class="close-announcement" onclick="closeBulkAnnouncementArea()">✕</button>
                </div>
                <div class="announcement-panel">
                    <!-- Left: Selected Applicants List -->
                    <div class="announcement-history" style="flex: 0 0 300px; max-width: 300px;">
                        <h4>Pelamar yang Dipilih</h4>
                        <div class="history-list" id="selected-applicants-list" style="height: 150px; max-height: 150px; overflow-y: auto;">
                            <div class="no-history">Tidak ada pelamar yang dipilih</div>
                        </div>
                    </div>
                    
                    <!-- Right: Form Section -->
                    <div class="announcement-form">
                        <div class="announcement-toolbar">
                            <button type="button" class="add-announcement-btn" onclick="showBulkAnnouncementForm()">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v14m-7-7h14"></path>
                                </svg>
                                Tambah Pengumuman
                            </button>
                            <div class="announcement-meta">
                                <span id="bulk-charCount">0</span>/500 karakter
                            </div>
                        </div>
                        <div class="announcement-input-group" id="bulk-form-fields" style="display: none;">
                            <div class="form-field">
                                <label class="announcement-label">Subjek Pengumuman</label>
                                <input type="text" class="announcement-input" id="bulk-announcement-subject" placeholder="Masukkan subjek pengumuman...">
                            </div>
                            <div class="form-field">
                                <label class="announcement-label">Isi Pengumuman</label>
                                <textarea class="announcement-input announcement-textarea" id="bulk-announcement-text" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateBulkCharCount(this)"></textarea>
                            </div>
                            <div class="announcement-actions">
                                <button class="send-announcement-btn" onclick="sendBulkAnnouncement()">
                                    Kirim Pengumuman
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applicant Management Table -->
            <div class="table-with-checkboxes">
                <div class="table-card">
                    <div class="table-header"></div>
                </div>

                <!-- Table Header -->
                <div class="table-header-row">
                    <div class="header-item">Nama</div>
                    <div class="header-item">Email</div>
                    <div class="header-item">No Telepon</div>
                    <div class="header-item">CV</div>
                    <div class="header-item">Tanggal Lamar</div>
                    <div class="header-item">Pengumuman</div>
                    <div class="header-item">Status</div>
                </div>
                
                <!-- Dynamic Applicant Cards -->
                <div class="applicant-cards">
                    <!-- Checkbox column for main table -->
                    <div class="checkbox-column" id="checkbox-main">
                        @foreach($pelamars as $pelamar)
                        <div class="checkbox-item">
                            <input type="checkbox" class="select-checkbox" data-applicant-id="{{ $pelamar->id }}" onchange="updateSelectionUI()">
                        </div>
                        @endforeach
                    </div>
                    
                    @forelse($pelamars as $pelamar)
                    <div class="applicant-card" data-applicant-id="{{ $pelamar->id }}" data-has-announcement="{{ $pelamar->pengumuman_status !== 'none' ? 'true' : 'false' }}" data-job-category="{{ $pelamar->pekerjaan->judul_pekerjaan ?? 'Unknown' }}">
                        <div class="applicant-card-content">
                            <div class="applicant-checkbox" style="display: none;">
                                <input type="checkbox" class="select-checkbox" data-applicant-id="{{ $pelamar->id }}" onchange="updateSelectionUI()">
                            </div>
                            <div class="applicant-info">
                                <div class="applicant-avatar">{{ $pelamar->initials }}</div>
                                <div class="applicant-details">
                                    <h4>{{ $pelamar->short_name }}</h4>
                                </div>
                            </div>
                            <div class="applicant-email">{{ $pelamar->short_email }}</div>
                            <div class="applicant-phone">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>{{ $pelamar->formatted_phone }}</span>
                            </div>
                            <div class="applicant-cv" onclick="openCVModal()" style="cursor: pointer;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>{{ $pelamar->short_cv_name }}</span>
                            </div>
                            <div class="application-date">{{ $pelamar->tanggal_melamar->format('d M Y') }}</div>
                            <div class="action-menu">
                                <button class="announcement-btn" onclick="openAnnouncementPanel(this)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                            <div class="applicant-status">
                                @if($pelamar->status === 'review')
                                    <span class="status-chooser">
                                        <button type="button" class="status-btn approve" onclick="setApplicantStatus({{ $pelamar->id }}, 'accepted')" title="Terima">✓</button>
                                        <button type="button" class="status-btn reject" onclick="setApplicantStatus({{ $pelamar->id }}, 'rejected')" title="Tolak">✕</button>
                                    </span>
                                @elseif($pelamar->status === 'accepted')
                                    <span class="status-text accepted" id="status-label-{{ $pelamar->id }}">
                                        Diterima
                                    </span>
                                @elseif($pelamar->status === 'rejected')
                                    <span class="status-text rejected" id="status-label-{{ $pelamar->id }}">
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Announcement Area - Moved below card -->
                    </div>
                    
                    <!-- Announcement Area -->
                    <div class="announcement-area" id="announcement-{{ $pelamar->id }}">
                        <div class="announcement-header">
                            <span class="announcement-title">Pengumuman ke {{ $pelamar->short_name }}</span>
                            <button class="close-announcement" onclick="closeAnnouncementArea(this)">✕</button>
                        </div>
                        <div class="announcement-panel">
                            <!-- Left: History Section -->
                            <div class="announcement-history">
                                <h4>Riwayat Pengumuman</h4>
                                <div class="history-list">
                                    @if($pelamar->pengumuman_status !== 'none')
                                        <div class="history-item">
                                            <div class="history-date">{{ $pelamar->updated_at->format('d M Y, H:i') }}</div>
                                            <div class="history-content">{{ $pelamar->catatan ?? 'Pengumuman dikirim' }}</div>
                                        </div>
                                    @else
                                        <div class="no-history">Belum ada pengumuman yang dikirim</div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Right: Form Section -->
                            <div class="announcement-form">
                                <div class="announcement-toolbar">
                                    <button type="button" class="add-announcement-btn" onclick="showAnnouncementForm({{ $pelamar->id }})">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 5v14m-7-7h14"></path>
                                        </svg>
                                        Tambah Pengumuman
                                    </button>
                                    <div class="announcement-meta">
                                        <span id="charCount-{{ $pelamar->id }}">0</span>/500 karakter
                                    </div>
                                </div>
                                <div class="announcement-input-group" id="form-fields-{{ $pelamar->id }}" style="display: none;">
                                    <div class="form-field">
                                        <label class="announcement-label">Subjek Pengumuman</label>
                                        <input type="text" class="announcement-input" id="announcement-subject-{{ $pelamar->id }}" placeholder="Masukkan subjek pengumuman...">
                                    </div>
                                    <div class="form-field">
                                        <label class="announcement-label">Isi Pengumuman</label>
                                        <textarea class="announcement-input announcement-textarea" id="announcement-text-{{ $pelamar->id }}" placeholder="Masukkan isi pengumuman..." maxlength="500" oninput="updateCharCount({{ $pelamar->id }}, this)">{{ $pelamar->catatan ?? '' }}</textarea>
                                    </div>
                                    <div class="announcement-actions">
                                        <button class="send-announcement-btn" onclick="sendAnnouncement({{ $pelamar->id }}, '{{ $pelamar->short_name }}')">
                                            Kirim Pengumuman
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @empty
                    <div class="no-applicants">
                        <div class="no-applicants-icon">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h3>Tidak ada pelamar ditemukan</h3>
                        <p>Belum ada pelamar yang sesuai dengan kriteria pencarian Anda.</p>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>


        <!-- CV Modal -->
        <div id="cvModal" class="cv-modal" style="display: none;">
            <div class="cv-modal-content">
                <button class="cv-modal-close" onclick="closeCVModal()">×</button>
                <div id="cvModalContent"></div>
            </div>
        </div>

        <!-- Accepted Applicants History Modal -->
        
    </div>

    <script>
        // Update modal position when sidebar state changes
        document.addEventListener('DOMContentLoaded', function() {
            updateModalPosition();
            
            // Initialize checkbox columns and table layout - hidden by default
            const tableWithCheckboxes = document.querySelector('.table-with-checkboxes');
            const allApplicantCheckboxes = document.querySelectorAll('.applicant-checkbox');
            
            // Start with all individual checkboxes hidden
            allApplicantCheckboxes.forEach(checkboxDiv => {
                checkboxDiv.style.display = 'none';
            });
            
            // Initialize selection UI
            updateSelectionUI();
            
            // Add event listeners to all checkboxes for real-time updates
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('select-checkbox')) {
                    updateSelectionUI();
                }
            });
            
            // Listen for sidebar toggle events - multiple selectors to catch different toggle buttons
            const toggleSelectors = ['.sidebar-toggle', '.toggle-btn', '[data-toggle="sidebar"]', '.menu-toggle'];
            
            toggleSelectors.forEach(selector => {
                const toggleBtn = document.querySelector(selector);
                if (toggleBtn) {
                    toggleBtn.addEventListener('click', function() {
                        setTimeout(updateModalPosition, 350); // Wait for animation
                    });
                }
            });
            
            // Also listen for window resize events
            window.addEventListener('resize', function() {
                setTimeout(updateModalPosition, 100);
            });
            
            // Use MutationObserver to detect sidebar class changes
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            setTimeout(updateModalPosition, 50);
                        }
                    });
                });
                
                observer.observe(sidebar, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            }
        });


        // Selection functionality
        let selectedApplicants = new Set();
        let selectAllState = 0; // 0: hidden, 1: checked, 2: unchecked
        
        function updateSelectionUI() {
            // Get all checkboxes and currently checked ones
            const allCheckboxes = document.querySelectorAll('.select-checkbox');
            const checkedCheckboxes = document.querySelectorAll('.select-checkbox:checked');
            const selectAllCheckbox = document.getElementById('select-all');
            const bulkActions = document.getElementById('bulk-actions');
            const selectedCountText = document.getElementById('selected-count');
            const allApplicantCheckboxes = document.querySelectorAll('.applicant-checkbox');
            const tableWithCheckboxes = document.querySelector('.table-with-checkboxes');
            
            // Clear and rebuild selected applicants set based on actually checked checkboxes
            selectedApplicants.clear();
            const actuallyCheckedBoxes = document.querySelectorAll('.select-checkbox:checked');
            actuallyCheckedBoxes.forEach(checkbox => {
                if (checkbox.dataset.applicantId) {
                    selectedApplicants.add(checkbox.dataset.applicantId);
                }
            });
            
            // Update select all checkbox state (only if not in manual toggle mode)
            if (selectAllCheckbox && selectAllState !== 2) {
                if (checkedCheckboxes.length === 0 && selectAllState === 0) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                    
                    // Reset state when manually unchecking all
                    selectAllState = 0;
                    
                    // Hide all individual checkboxes when none are selected
                    allApplicantCheckboxes.forEach(checkboxDiv => {
                        checkboxDiv.style.display = 'none';
                    });
                    
                    // Remove show-checkboxes class
                    if (tableWithCheckboxes) {
                        tableWithCheckboxes.classList.remove('show-checkboxes');
                    }
                } else if (checkedCheckboxes.length === allCheckboxes.length && selectAllState === 1) {
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                } else if (checkedCheckboxes.length > 0 && checkedCheckboxes.length < allCheckboxes.length) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = true;
                }
            }
            
            // Update bulk actions display and count based on actually checked checkboxes
            const actualCheckedCount = document.querySelectorAll('.select-checkbox:checked').length;
            
            if (bulkActions && selectedCountText) {
                if (actualCheckedCount > 0) {
                    bulkActions.style.display = 'flex';
                    selectedCountText.textContent = `${actualCheckedCount} pelamar dipilih`;
                } else {
                    bulkActions.style.display = 'none';
                }
            }
        }

        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('select-all');
            if (!selectAllCheckbox) return;
            
            const allCheckboxes = document.querySelectorAll('.select-checkbox');
            const allApplicantCheckboxes = document.querySelectorAll('.applicant-checkbox');
            const tableWithCheckboxes = document.querySelector('.table-with-checkboxes');
            
            // Cycle through three states: hidden -> checked -> unchecked -> hidden
            selectAllState = (selectAllState + 1) % 3;
            
            switch(selectAllState) {
                case 1: // First click: Show and check all
                    // Show all checkboxes
                    allApplicantCheckboxes.forEach(checkboxDiv => {
                        checkboxDiv.style.display = 'flex';
                    });
                    
                    // Add show-checkboxes class to adjust layout
                    if (tableWithCheckboxes) {
                        tableWithCheckboxes.classList.add('show-checkboxes');
                    }
                    
                    // Check all individual checkboxes
                    allCheckboxes.forEach(checkbox => {
                        checkbox.checked = true;
                    });
                    
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                    break;
                    
                case 2: // Second click: Show but uncheck all
                    // Keep checkboxes visible
                    allApplicantCheckboxes.forEach(checkboxDiv => {
                        checkboxDiv.style.display = 'flex';
                    });
                    
                    // Keep show-checkboxes class
                    if (tableWithCheckboxes) {
                        tableWithCheckboxes.classList.add('show-checkboxes');
                    }
                    
                    // Uncheck all individual checkboxes
                    allCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                    break;
                    
                case 0: // Third click: Hide all checkboxes
                    // Hide all checkboxes
                    allApplicantCheckboxes.forEach(checkboxDiv => {
                        checkboxDiv.style.display = 'none';
                    });
                    
                    // Remove show-checkboxes class
                    if (tableWithCheckboxes) {
                        tableWithCheckboxes.classList.remove('show-checkboxes');
                    }
                    
                    // Uncheck all individual checkboxes
                    allCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                    break;
            }
            
            // Update UI
            updateSelectionUI();
        }

        // Bulk actions
        function bulkAccept() {
            const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked'))
                .map(cb => cb.dataset.applicantId);
            
            if (selectedIds.length === 0) {
                alert('Pilih pelamar terlebih dahulu');
                return;
            }
            
            if (confirm(`Terima ${selectedIds.length} pelamar yang dipilih?`)) {
                fetch('{{ route("pelamar.bulkUpdateStatus") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ids: selectedIds,
                        status: 'accepted'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses permintaan');
                });
            }
        }

        function bulkReject() {
            const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked'))
                .map(cb => cb.dataset.applicantId);
            
            if (selectedIds.length === 0) {
                alert('Pilih pelamar terlebih dahulu');
                return;
            }
            
            if (confirm(`Tolak ${selectedIds.length} pelamar yang dipilih?`)) {
                fetch('{{ route("pelamar.bulkUpdateStatus") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ids: selectedIds,
                        status: 'rejected'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses permintaan');
                });
            }
        }

        function bulkAnnouncement() {
            const selectedCheckboxes = document.querySelectorAll('.select-checkbox:checked');
            
            if (selectedCheckboxes.length === 0) {
                alert('Pilih pelamar terlebih dahulu');
                return;
            }
            
            // Close all individual announcement areas
            document.querySelectorAll('.announcement-area').forEach(area => {
                if (area.id !== 'bulk-announcement-area') {
                    area.style.display = 'none';
                }
            });
            
            // Show bulk announcement area
            const bulkArea = document.getElementById('bulk-announcement-area');
            const bulkTitle = document.getElementById('bulk-announcement-title');
            const selectedList = document.getElementById('selected-applicants-list');
            
            if (bulkArea && bulkTitle && selectedList) {
                // Update title with count
                bulkTitle.textContent = `Pengumuman ke ${selectedCheckboxes.length} pelamar`;
                
                // Build selected applicants list
                selectedList.innerHTML = '';
                selectedCheckboxes.forEach(checkbox => {
                    const applicantCard = checkbox.closest('.applicant-card');
                    if (applicantCard) {
                        const nameElement = applicantCard.querySelector('.applicant-details h4');
                        const name = nameElement ? nameElement.textContent : 'Unknown';
                        
                        const listItem = document.createElement('div');
                        listItem.className = 'history-item';
                        listItem.innerHTML = `
                            <div class="title">${name}</div>
                            <div class="meta">ID: ${checkbox.dataset.applicantId}</div>
                        `;
                        selectedList.appendChild(listItem);
                    }
                });
                
                // Show the bulk announcement area
                bulkArea.style.display = 'block';
            }
        }
        
        function closeBulkAnnouncementArea() {
            const bulkArea = document.getElementById('bulk-announcement-area');
            if (bulkArea) {
                bulkArea.style.display = 'none';
                // Clear form
                document.getElementById('bulk-announcement-subject').value = '';
                document.getElementById('bulk-announcement-text').value = '';
                document.getElementById('bulk-form-fields').style.display = 'none';
                updateBulkCharCount(document.getElementById('bulk-announcement-text'));
            }
        }
        
        function showBulkAnnouncementForm() {
            const formFields = document.getElementById('bulk-form-fields');
            const button = document.querySelector('#bulk-announcement-area .add-announcement-btn');
            
            if (formFields.style.display === 'none' || formFields.style.display === '') {
                formFields.style.display = 'block';
                button.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12"></path>
                    </svg>
                    Batal
                `;
            } else {
                formFields.style.display = 'none';
                button.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14m-7-7h14"></path>
                    </svg>
                    Tambah Pengumuman
                `;
                // Clear form fields
                document.getElementById('bulk-announcement-subject').value = '';
                document.getElementById('bulk-announcement-text').value = '';
                updateBulkCharCount(document.getElementById('bulk-announcement-text'));
            }
        }
        
        function updateBulkCharCount(textarea) {
            const charCountElement = document.getElementById('bulk-charCount');
            if (charCountElement) {
                const count = textarea.value.length;
                charCountElement.textContent = count;
                
                if (count > 450) {
                    charCountElement.style.color = '#ef4444';
                } else if (count > 400) {
                    charCountElement.style.color = '#f59e0b';
                } else {
                    charCountElement.style.color = '#6b7280';
                }
            }
        }
        
        function sendBulkAnnouncement() {
            const subjectInput = document.getElementById('bulk-announcement-subject');
            const textarea = document.getElementById('bulk-announcement-text');
            const subject = subjectInput.value.trim();
            const message = textarea.value.trim();
            const selectedCheckboxes = document.querySelectorAll('.select-checkbox:checked');
            
            if (!subject) {
                alert('Silakan masukkan subjek pengumuman terlebih dahulu');
                return;
            }
            
            if (!message) {
                alert('Silakan tulis isi pengumuman terlebih dahulu');
                return;
            }
            
            if (selectedCheckboxes.length === 0) {
                alert('Tidak ada pelamar yang dipilih');
                return;
            }
            
            const selectedIds = Array.from(selectedCheckboxes).map(cb => cb.dataset.applicantId);
            
            if (confirm(`Kirim pengumuman "${subject}" ke ${selectedIds.length} pelamar yang dipilih?`)) {
                fetch(`{{ url('pelamar') }}/bulk-announcement`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        applicant_ids: selectedIds,
                        subject: subject,
                        message: message 
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Pengumuman berhasil dikirim ke ${selectedIds.length} pelamar!`);
                        closeBulkAnnouncementArea();
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim pengumuman');
                });
            }
        }

        // Individual applicant actions
        function setApplicantStatus(applicantId, status) {
            console.log('setApplicantStatus called with:', { applicantId, status });
            
            if (confirm(`Yakin ingin ${status === 'accepted' ? 'menerima' : 'menolak'} pelamar ini?`)) {
                console.log('User confirmed, sending request...');
                
                // Get CSRF token from meta tag or fallback to inline token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                
                const requestData = { status: status };
                console.log('Request data:', requestData);
                
                fetch(`/pelamar/${applicantId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);
                    
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('Error response:', text);
                            throw new Error(`HTTP ${response.status}: ${text}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        alert(`Status berhasil diperbarui ke "${status === 'accepted' ? 'Diterima' : 'Ditolak'}"!`);
                        window.location.reload();
                    } else {
                        console.error('Server error:', data);
                        alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error details:', error);
                    alert('Terjadi kesalahan saat memproses permintaan: ' + error.message);
                });
            }
        }

        // Announcement functionality
        function openAnnouncementPanel(button) {
            const card = button.closest('.applicant-card');
            const applicantId = card.getAttribute('data-applicant-id');
            const announcementArea = document.getElementById(`announcement-${applicantId}`);
            
            // Close all other announcement areas
            document.querySelectorAll('.announcement-area').forEach(area => {
                if (area !== announcementArea) {
                    area.style.display = 'none';
                }
            });
            
            // Toggle current announcement area
            if (announcementArea) {
                announcementArea.style.display = announcementArea.style.display === 'block' ? 'none' : 'block';
            }
        }

        function closeAnnouncementArea(button) {
            const announcementArea = button.closest('.announcement-area');
            announcementArea.style.display = 'none';
        }

        function applyAnnouncementTemplate(select, applicantId) {
            const textarea = document.getElementById(`announcement-text-${applicantId}`);
            const templates = {
                'interview': 'Selamat! Anda telah lolos seleksi awal. Silakan datang untuk wawancara pada tanggal yang akan kami informasikan lebih lanjut.',
                'test': 'Anda telah lolos seleksi dokumen. Silakan mengikuti tes selanjutnya sesuai jadwal yang akan kami kirimkan.',
                'accepted': 'Selamat! Anda telah diterima untuk posisi ini. Silakan hubungi HR kami untuk proses selanjutnya.',
                'rejected': 'Terima kasih atas minat Anda. Mohon maaf, untuk saat ini Anda belum dapat kami terima. Semoga sukses di kesempatan lainnya.'
            };
            
            if (templates[select.value]) {
                textarea.value = templates[select.value];
            }
        }

        function sendAnnouncement(applicantId, applicantName) {
            const subjectInput = document.getElementById(`announcement-subject-${applicantId}`);
            const textarea = document.getElementById(`announcement-text-${applicantId}`);
            const subject = subjectInput ? subjectInput.value.trim() : '';
            const message = textarea ? textarea.value.trim() : '';
            
            if (!subject) {
                alert('Silakan masukkan subjek pengumuman terlebih dahulu');
                return;
            }
            
            if (!message) {
                alert('Silakan tulis isi pengumuman terlebih dahulu');
                return;
            }

            if (confirm(`Kirim pengumuman "${subject}" ke ${applicantName}?`)) {
                fetch(`{{ url('pelamar') }}/${applicantId}/announcement`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        subject: subject,
                        message: message 
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pengumuman berhasil dikirim!');
                        // Clear form and hide it
                        subjectInput.value = '';
                        textarea.value = '';
                        const formFields = document.getElementById(`form-fields-${applicantId}`);
                        const button = document.querySelector(`#announcement-${applicantId} .add-announcement-btn`);
                        
                        formFields.style.display = 'none';
                        button.innerHTML = `
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14m-7-7h14"></path>
                            </svg>
                            Tambah Pengumuman
                        `;
                        
                        // Update character count
                        const charCountElement = document.getElementById(`charCount-${applicantId}`);
                        if (charCountElement) {
                            charCountElement.textContent = '0';
                            charCountElement.style.color = '#6b7280';
                        }
                        
                        // Refresh history section
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim pengumuman');
                });
            }
        }

        function showAnnouncementForm(applicantId) {
            const formFields = document.getElementById(`form-fields-${applicantId}`);
            const button = document.querySelector(`#announcement-${applicantId} .add-announcement-btn`);
            
            if (formFields.style.display === 'none' || formFields.style.display === '') {
                formFields.style.display = 'block';
                button.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12"></path>
                    </svg>
                    Batal
                `;
            } else {
                formFields.style.display = 'none';
                button.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14m-7-7h14"></path>
                    </svg>
                    Tambah Pengumuman
                `;
                // Clear form fields
                document.getElementById(`announcement-subject-${applicantId}`).value = '';
                document.getElementById(`announcement-text-${applicantId}`).value = '';
                const textarea = document.getElementById(`announcement-text-${applicantId}`);
                const charCountElement = document.getElementById(`charCount-${applicantId}`);
                if (charCountElement) {
                    charCountElement.textContent = '0';
                    charCountElement.style.color = '#6b7280';
                }
            }
        }

        // CV Modal functionality - Always show contohcv.pdf
        function openCVModal() {
            const modal = document.getElementById('cvModal');
            const modalContent = document.getElementById('cvModalContent');
            
            updateModalPosition();
            
            // Always display contohcv.pdf
            const pdfPath = '/images/contohcv.pdf';
            
            modalContent.innerHTML = `
                <iframe src="${pdfPath}#view=FitV&zoom=page-width" 
                        style="width: 100%; height: 100vh; border: none; position: absolute; top: 0; left: 0;">
                    <p>Browser Anda tidak mendukung tampilan PDF. 
                       <a href="${pdfPath}" target="_blank">Klik di sini untuk membuka PDF</a>
                    </p>
                </iframe>
            `;
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function updateModalPosition() {
            const modal = document.getElementById('cvModal');
            const sidebar = document.querySelector('.sidebar');
            
            if (modal && sidebar) {
                const isCollapsed = sidebar.classList.contains('collapsed');
                const sidebarWidth = isCollapsed ? 80 : sidebar.offsetWidth;
                
                modal.style.left = sidebarWidth + 'px';
                modal.style.width = `calc(100% - ${sidebarWidth}px)`;
                modal.style.height = '100vh';
                modal.style.top = '0';
                
                // Also update the modal content to fit properly
                const modalContent = document.getElementById('cvModalContent');
                if (modalContent) {
                    modalContent.style.width = '100%';
                    modalContent.style.height = '100%';
                }
            }
        }

        function closeCVModal() {
            const modal = document.getElementById('cvModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('cvModal');
            if (e.target === modal) {
                closeCVModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCVModal();
            }
        });
    </script>
</body>
</html>
                                    <button type="button" class="status-btn reject" onclick="setApplicantStatus(6, false)" title="Tolak">✕</button>
                                </span>
                            </div>
                            
                            <div class="action-menu">
                                <button class="announcement-btn" onclick="openAnnouncementPanel(this)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </div>
                        
                        
                <!-- UI/UX Designer Applicants -->
                <div class="applicant-cards" id="UI/UX Designer" style="display: none;">
                    <!-- Checkbox column for UI/UX Designer -->
                    <div class="checkbox-column" id="checkbox-uiux">
                        @foreach($pelamars->where('pekerjaan.kategori', 'UI/UX Designer') as $pelamar)
                        <div class="checkbox-item">
                            <input type="checkbox" class="select-checkbox" data-applicant-id="{{ $pelamar->id }}" data-category="UI/UX Designer" onchange="updateSelectionUI()">
                        </div>
                        @endforeach
                    </div>
                    
                    @foreach($pelamars->where('pekerjaan.kategori', 'UI/UX Designer') as $pelamar)
                    <div class="applicant-card" data-applicant-id="{{ $pelamar->id }}" data-has-announcement="{{ $pelamar->pengumuman_status ? 'true' : 'false' }}" data-job-category="UI/UX Designer">
                        <div class="applicant-card-content">
                            <div class="applicant-checkbox" style="display: none;">
                                <input type="checkbox" class="select-checkbox" data-applicant-id="{{ $pelamar->id }}" data-category="UI/UX Designer" onchange="updateSelectionUI()">
                            </div>
                            <div class="applicant-info">
                                <div class="applicant-avatar">{{ strtoupper(substr($pelamar->nama, 0, 2)) }}</div>
                                <div class="applicant-details">
                                    <h4>{{ $pelamar->short_name }}</h4>
                                </div>
                            </div>
                            <div class="applicant-email">{{ $pelamar->short_email }}</div>
                            <div class="applicant-phone">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>{{ $pelamar->no_telepon }}</span>
                            </div>
                            <div class="applicant-cv" onclick="openCVModal()" style="cursor: pointer;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>{{ $pelamar->short_cv_name }}</span>
                            </div>
                            <div class="applicant-status">
                                @if($pelamar->status === 'review')
                                    <span class="status-chooser">
                                        <button type="button" class="status-btn approve" onclick="setApplicantStatus({{ $pelamar->id }}, 'accepted')" title="Terima">✓</button>
                                        <button type="button" class="status-btn reject" onclick="setApplicantStatus({{ $pelamar->id }}, 'rejected')" title="Tolak">✕</button>
                                    </span>
                                @elseif($pelamar->status === 'accepted')
                                    <span class="status-text accepted" id="status-label-{{ $pelamar->id }}">
                                        Diterima
                                    </span>
                                @elseif($pelamar->status === 'rejected')
                                    <span class="status-text rejected" id="status-label-{{ $pelamar->id }}">
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                            <div class="application-date">{{ $pelamar->tanggal_melamar->format('d M Y') }}</div>
                            <div class="action-menu">
                                <button class="announcement-btn" onclick="openAnnouncementPanel(this)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Graphic Designer Applicants -->
                <div class="applicant-cards" id="Graphic Designer" style="display: none;">
                    <!-- Checkbox column for Graphic Designer -->
                    <div class="checkbox-column" id="checkbox-graphic">
                        @foreach($pelamars->where('pekerjaan.kategori', 'Graphic Designer') as $pelamar)
                        <div class="checkbox-item">
                            <input type="checkbox" class="select-checkbox" data-applicant-id="{{ $pelamar->id }}" data-category="Graphic Designer" onchange="updateSelectionUI()">
                        </div>
                        @endforeach
                    </div>
                    
                    @foreach($pelamars->where('pekerjaan.kategori', 'Graphic Designer') as $pelamar)
                    <div class="applicant-card" data-applicant-id="{{ $pelamar->id }}" data-has-announcement="{{ $pelamar->pengumuman_status ? 'true' : 'false' }}" data-job-category="Graphic Designer">
                        <div class="applicant-card-content">
                            <div class="applicant-checkbox" style="display: none;">
                                <input type="checkbox" class="select-checkbox" data-applicant-id="{{ $pelamar->id }}" data-category="Graphic Designer" onchange="updateSelectionUI()">
                            </div>
                            <div class="applicant-info">
                                <div class="applicant-avatar">{{ strtoupper(substr($pelamar->nama, 0, 2)) }}</div>
                                <div class="applicant-details">
                                    <h4>{{ $pelamar->short_name }}</h4>
                                </div>
                            </div>
                            <div class="applicant-email">{{ $pelamar->short_email }}</div>
                            <div class="applicant-phone">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>{{ $pelamar->no_telepon }}</span>
                            </div>
                            <div class="applicant-cv" onclick="openCVModal()" style="cursor: pointer;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>{{ $pelamar->short_cv_name }}</span>
                            </div>
                            <div class="applicant-status">
                                @if($pelamar->status === 'review')
                                    <span class="status-chooser">
                                        <button type="button" class="status-btn approve" onclick="setApplicantStatus({{ $pelamar->id }}, 'accepted')" title="Terima">✓</button>
                                        <button type="button" class="status-btn reject" onclick="setApplicantStatus({{ $pelamar->id }}, 'rejected')" title="Tolak">✕</button>
                                    </span>
                                @elseif($pelamar->status === 'accepted')
                                    <span class="status-text accepted" id="status-label-{{ $pelamar->id }}">
                                        Diterima
                                    </span>
                                @elseif($pelamar->status === 'rejected')
                                    <span class="status-text rejected" id="status-label-{{ $pelamar->id }}">
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                            <div class="application-date">{{ $pelamar->tanggal_melamar->format('d M Y') }}</div>
                            <div class="action-menu">
                                <button class="announcement-btn" onclick="openAnnouncementPanel(this)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Project Manager Applicants -->
                <div class="applicant-cards" id="Project Manager" style="display: none;">
                    <!-- Checkbox column for Project Manager -->
                    <div class="checkbox-column" id="checkbox-project">
                        @foreach($pelamars->where('pekerjaan.kategori', 'Project Manager') as $pelamar)
                        <div class="checkbox-item">
                            <input type="checkbox" class="select-checkbox" data-applicant-id="{{ $pelamar->id }}" data-category="Project Manager" onchange="updateSelectionUI()">
                        </div>
                        @endforeach
                    </div>
                    
                    @foreach($pelamars->where('pekerjaan.kategori', 'Project Manager') as $pelamar)
                    <div class="applicant-card" data-applicant-id="{{ $pelamar->id }}" data-has-announcement="{{ $pelamar->pengumuman_status ? 'true' : 'false' }}" data-job-category="Project Manager">
                        <div class="applicant-card-content">
                            <div class="applicant-checkbox" style="display: none;">
                                <input type="checkbox" class="select-checkbox" data-applicant-id="{{ $pelamar->id }}" data-category="Project Manager" onchange="updateSelectionUI()">
                            </div>
                            <div class="applicant-info">
                                <div class="applicant-avatar">{{ strtoupper(substr($pelamar->nama, 0, 2)) }}</div>
                                <div class="applicant-details">
                                    <h4>{{ $pelamar->short_name }}</h4>
                                </div>
                            </div>
                            <div class="applicant-email">{{ $pelamar->short_email }}</div>
                            <div class="applicant-phone">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>{{ $pelamar->no_telepon }}</span>
                            </div>
                            <div class="applicant-cv" onclick="openCVModal()" style="cursor: pointer;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>{{ $pelamar->short_cv_name }}</span>
                            </div>
                            <div class="applicant-status">
                                @if($pelamar->status === 'review')
                                    <span class="status-chooser">
                                        <button type="button" class="status-btn approve" onclick="setApplicantStatus({{ $pelamar->id }}, 'accepted')" title="Terima">✓</button>
                                        <button type="button" class="status-btn reject" onclick="setApplicantStatus({{ $pelamar->id }}, 'rejected')" title="Tolak">✕</button>
                                    </span>
                                @elseif($pelamar->status === 'accepted')
                                    <span class="status-text accepted" id="status-label-{{ $pelamar->id }}">
                                        Diterima
                                    </span>
                                @elseif($pelamar->status === 'rejected')
                                    <span class="status-text rejected" id="status-label-{{ $pelamar->id }}">
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                            <div class="application-date">{{ $pelamar->tanggal_melamar->format('d M Y') }}</div>
                            <div class="action-menu">
                                <button class="announcement-btn" onclick="openAnnouncementPanel(this)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                                        Kirim
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
                </div>
            </div>

            </div>
@endsection

    <!-- CV Modal -->
    <div id="cvModal" class="cv-modal">
        <div class="cv-modal-content">
            <div class="cv-modal-body">
                <div id="cvModalContent">
                    <!-- CV content will be loaded here -->
                </div>
            </div>
            <!-- Close button positioned absolutely -->
            <button class="cv-modal-close" onclick="closeCVModal()" aria-label="Close modal" style="position: absolute; top: 20px; right: 20px; background: rgba(0,0,0,0.7); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; font-size: 20px; cursor: pointer; z-index: 1001;">
                ×
            </button>
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

        // View Toggle Functions
        function switchView(viewType) {
            const tableBtn = document.getElementById('table-view-btn');
            const cardBtn = document.getElementById('card-view-btn');
            const container = document.querySelector('.table-card');
            
            // Update button states
            tableBtn.classList.remove('active');
            cardBtn.classList.remove('active');
            
            if (viewType === 'table') {
                tableBtn.classList.add('active');
                container.className = 'table-card table-view';
            } else {
                cardBtn.classList.add('active');
                container.className = 'table-card card-view';
            }
            
            // Update card layout for current view
            updateCardLayout(viewType);
        }
        
        function updateCardLayout(viewType) {
            const allCards = document.querySelectorAll('.applicant-card');
            
            allCards.forEach(card => {
                const content = card.querySelector('.applicant-card-content');
                
                if (viewType === 'card') {
                    // Store original content for restoration
                    if (!card.hasAttribute('data-original-content')) {
                        card.setAttribute('data-original-content', content.innerHTML);
                    }
                    
                    // Transform to card layout
                    const info = content.querySelector('.applicant-info');
                    const email = content.querySelector('.applicant-email');
                    const phone = content.querySelector('.applicant-phone');
                    const cv = content.querySelector('.applicant-cv');
                    const date = content.querySelector('.application-date');
                    const status = content.querySelector('.applicant-status');
                    const action = content.querySelector('.action-menu');
                    
                    const avatarElement = info.querySelector('.applicant-avatar');
                    const nameElement = info.querySelector('h4');
                    const avatarText = avatarElement.textContent;
                    const nameText = nameElement.textContent;
                    
                    // Get the original data-applicant-id
                    const applicantId = card.getAttribute('data-applicant-id');
                    
                    // Restructure content for card view
                    content.innerHTML = `
                        <div class="applicant-info">
                            <div class="applicant-avatar">${avatarText}</div>
                            <div class="applicant-details">
                                <h4>${nameText}</h4>
                            </div>
                        </div>
                        <div class="card-field">
                            <span class="card-field-label">Email</span>
                            <span class="card-field-value">${email.textContent}</span>
                        </div>
                        <div class="card-field">
                            <span class="card-field-label">Phone</span>
                            <span class="card-field-value">${phone.querySelector('span').textContent}</span>
                        </div>
                        <div class="card-field">
                            <span class="card-field-label">CV</span>
                            <span class="card-field-value">${cv.querySelector('span').textContent}</span>
                        </div>
                        <div class="card-field">
                            <span class="card-field-label">Date</span>
                            <span class="card-field-value">${date.textContent}</span>
                        </div>
                        <div class="card-actions">
                            ${status.outerHTML}
                            <button class="announcement-btn card-announcement-btn" onclick="openAnnouncementPanel(this, '${applicantId}')">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    `;
                    
                    // Ensure the card still has the data-applicant-id attribute
                    card.setAttribute('data-applicant-id', applicantId);
                    
                    // Preserve announcement area if it exists
                    const announcementArea = card.querySelector('.announcement-area');
                    if (announcementArea) {
                        // Move announcement area after the restructured content
                        content.appendChild(announcementArea);
                    }
                } else {
                    // Restore original table layout from stored data
                    const originalContent = card.getAttribute('data-original-content');
                    if (originalContent) {
                        content.innerHTML = originalContent;
                        card.removeAttribute('data-original-content');
                    } else {
                        // Fallback: reload page if no original content stored
                        location.reload();
                    }
                }
            });
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
                const currentView = document.querySelector('.table-card').classList.contains('card-view') ? 'grid' : 'flex';
                selectedCards.style.display = currentView;
                if (currentView === 'flex') {
                    selectedCards.style.flexDirection = 'column';
                }
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

        function openAnnouncementPanel(button, applicantId = null) {
            const card = button.closest('.applicant-card');
            const panel = document.getElementById('globalAnnouncementPanel');
            
            if (!card || !panel) {
                alert('Error: Panel atau card tidak ditemukan');
                return;
            }

            // Use provided applicantId if available, otherwise get from card
            currentAnnouncementApplicantId = applicantId || card.getAttribute('data-applicant-id');
            currentAnnouncementApplicantName = card.querySelector('h4')?.textContent || '';
            
            if (!currentAnnouncementApplicantId) {
                alert('Error: ID pelamar tidak ditemukan');
                return;
            }

            // Check if panel is already visible and belongs to this card
            const isCurrentlyOpen = panel.style.display === 'block' && 
                                  currentAnnouncementApplicantId === card.getAttribute('data-applicant-id');
            
            if (isCurrentlyOpen) {
                closeGlobalAnnouncementPanel();
                return;
            }

            document.getElementById('globalAnnouncementTitle').textContent = `Pengumuman ke ${currentAnnouncementApplicantName}`;
            document.getElementById('globalAnnouncementSubject').value = '';
            document.getElementById('globalAnnouncementBody').value = '';
            document.getElementById('globalCharCount').textContent = '0';

            // Move panel after the card
            card.insertAdjacentElement('afterend', panel);
            panel.style.display = 'block';

            // render histori & tampilkan form baru default
            renderHistory(currentAnnouncementApplicantId);
            startNewAnnouncement();

            // tutup dropdown aksi
            const dropdown = button.closest('.action-dropdown');
            if (dropdown) dropdown.classList.remove('show');
            
            // Scroll to panel
            setTimeout(() => {
                panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }

        function closeGlobalAnnouncementPanel() {
            const panel = document.getElementById('globalAnnouncementPanel');
            
            // Add closing animation
            panel.classList.add('closing');
            
            // Wait for animation to complete before hiding
            setTimeout(() => {
                panel.style.display = 'none';
                panel.classList.remove('closing');
                currentAnnouncementApplicantId = null;
                currentAnnouncementApplicantName = '';
            }, 300); // Match the slideUpOut animation duration
        }

        function updateGlobalCharCount() {
            const body = document.getElementById('globalAnnouncementBody');
            document.getElementById('globalCharCount').textContent = String(body.value.length);
        }

        function sendGlobalAnnouncement() {
            const subject = document.getElementById('globalAnnouncementSubject');
            const body = document.getElementById('globalAnnouncementBody');
            const btn = document.querySelector('#globalAnnouncementPanel .send-announcement-btn');

            if (!subject.value.trim() || !body.value.trim()) {
                alert('Harap isi subjek dan isi pengumuman.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span>⌛</span> Mengirim...';

            // Check if this is bulk announcement or single announcement
            if (window.bulkAnnouncementApplicants && window.bulkAnnouncementApplicants.length > 0) {
                // Bulk announcement
                const applicantIds = window.bulkAnnouncementApplicants;
                let successCount = 0;
                let errorCount = 0;

                const promises = applicantIds.map(applicantId => {
                    return fetch(`{{ url('pelamar') }}/${applicantId}/announcement`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            subject: subject.value.trim(),
                            message: body.value.trim()
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successCount++;
                        } else {
                            errorCount++;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        errorCount++;
                    });
                });

                Promise.all(promises).then(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<span>📨</span> Kirim';
                    
                    if (successCount > 0) {
                        alert(`Pengumuman berhasil dikirim ke ${successCount} pelamar!`);
                        if (errorCount > 0) {
                            alert(`${errorCount} pengumuman gagal dikirim.`);
                        }
                        closeGlobalAnnouncementPanel();
                        clearSelection();
                        location.reload();
                    } else {
                        alert('Semua pengumuman gagal dikirim.');
                    }
                });
            } else if (currentAnnouncementApplicantId) {
                // Single announcement
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


        // Selection functionality
        let selectedApplicants = new Set();
        
        // Initialize page state
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded - initializing...');
            
            // Hide all checkboxes initially
            document.querySelectorAll('.applicant-checkbox').forEach(checkboxDiv => {
                checkboxDiv.style.display = 'none';
            });
            
            // Hide bulk actions initially
            const bulkActions = document.getElementById('bulk-actions');
            if (bulkActions) {
                bulkActions.style.display = 'none';
                bulkActions.classList.remove('show');
            }
            
            // Test select all functionality with timeout to ensure DOM is ready
            setTimeout(() => {
                const selectAllCheckbox = document.getElementById('select-all');
                if (selectAllCheckbox) {
                    console.log('Select all checkbox found');
                    selectAllCheckbox.addEventListener('click', function(e) {
                        console.log('Select all clicked, checked:', this.checked);
                        toggleSelectAll();
                    });
                } else {
                    console.error('Select all checkbox not found!');
                }
            }, 100);
            
            // Add event listeners to show checkboxes when clicked
            document.querySelectorAll('.applicant-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't trigger if clicking on buttons or links
                    if (e.target.closest('button') || e.target.closest('a') || e.target.closest('.announcement-btn')) {
                        return;
                    }
                    
                    // Show all checkboxes
                    document.querySelectorAll('.applicant-checkbox').forEach(checkboxDiv => {
                        checkboxDiv.style.display = 'flex';
                    });
                    
                    const tableWithCheckboxes = document.querySelector('.table-with-checkboxes');
                    if (tableWithCheckboxes) {
                        tableWithCheckboxes.classList.add('show-checkboxes');
                    }
                });
            });
            
            console.log('Page initialized - checkboxes and bulk actions hidden');
        });

        function getCurrentActiveCheckboxColumn() {
            // Check which applicant-cards container is currently visible
            const mainCards = document.querySelector('.applicant-cards:not([id])');
            const uiuxCards = document.getElementById('UI/UX Designer');
            const graphicCards = document.getElementById('Graphic Designer');
            const projectCards = document.getElementById('Project Manager');

            console.log('mainCards:', mainCards);
            console.log('uiuxCards:', uiuxCards);
            console.log('graphicCards:', graphicCards);
            console.log('projectCards:', projectCards);

            // Check visibility using getComputedStyle for more accurate detection
            if (uiuxCards && getComputedStyle(uiuxCards).display !== 'none') {
                console.log('Active: UI/UX Designer');
                return document.getElementById('checkbox-uiux');
            } else if (graphicCards && getComputedStyle(graphicCards).display !== 'none') {
                console.log('Active: Graphic Designer');
                return document.getElementById('checkbox-graphic');
            } else if (projectCards && getComputedStyle(projectCards).display !== 'none') {
                console.log('Active: Project Manager');
                return document.getElementById('checkbox-project');
            } else if (mainCards && getComputedStyle(mainCards).display !== 'none') {
                console.log('Active: Main Cards');
                return document.getElementById('checkbox-main');
            }
            
            console.log('Default: Main checkbox column');
            // Default to main checkbox column (when "Semua" is active)
            return document.getElementById('checkbox-main');
        }

        function updateSelection() {
            const checkboxes = document.querySelectorAll('.select-checkbox');
            selectedApplicants.clear();
            
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedApplicants.add(checkbox.getAttribute('data-applicant-id'));
                }
            });

            updateSelectionUI();
        }

        function updateSelectionUI() {
            // Update selectedApplicants set based on checked checkboxes
            selectedApplicants.clear();
            document.querySelectorAll('.select-checkbox:checked').forEach(checkbox => {
                selectedApplicants.add(checkbox.dataset.applicantId);
            });

            const count = selectedApplicants.size;
            const bulkActions = document.getElementById('bulk-actions');
            const selectedCountText = document.getElementById('selected-count');
            const selectAllCheckbox = document.getElementById('select-all');
            const tableWithCheckboxes = document.querySelector('.table-with-checkboxes');

            console.log('updateSelectionUI called, count:', count);

            // Show bulk actions ONLY when items are selected
            if (count > 0) {
                if (bulkActions) {
                    bulkActions.style.display = 'flex';
                    bulkActions.classList.add('show');
                    console.log('Bulk actions shown for', count, 'selected items');
                }
                if (selectedCountText) {
                    selectedCountText.textContent = `${count} pelamar dipilih`;
                }
                
                // Ensure checkboxes are visible when items are selected
                document.querySelectorAll('.applicant-checkbox').forEach(checkboxDiv => {
                    checkboxDiv.style.display = 'flex';
                });
                
                if (tableWithCheckboxes) {
                    tableWithCheckboxes.classList.add('show-checkboxes');
                }
            } else {
                // Hide bulk actions when nothing is selected
                if (bulkActions) {
                    bulkActions.style.display = 'none';
                    bulkActions.classList.remove('show');
                    console.log('Bulk actions hidden - no items selected');
                }
                
                // Hide checkboxes when nothing is selected
                document.querySelectorAll('.applicant-checkbox').forEach(checkboxDiv => {
                    checkboxDiv.style.display = 'none';
                });
                
                if (tableWithCheckboxes) {
                    tableWithCheckboxes.classList.remove('show-checkboxes');
                }
            }

            // Update select all checkbox state
            const totalCheckboxes = document.querySelectorAll('.select-checkbox').length;
            if (count === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (count === totalCheckboxes) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
                selectAllCheckbox.checked = false;
            }
        }


        function bulkAccept() {
            if (selectedApplicants.size === 0) {
                alert('Pilih pelamar terlebih dahulu');
                return;
            }

            if (confirm(`Terima ${selectedApplicants.size} pelamar yang dipilih?`)) {
                const applicantIds = Array.from(selectedApplicants);
                
                fetch('{{ route("pelamar.bulkUpdateStatus") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        pelamar_ids: applicantIds,
                        status: 'accepted'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`${data.updated_count} pelamar berhasil diterima!`);
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status');
                });
            }
        }

        function bulkReject() {
            if (selectedApplicants.size === 0) {
                alert('Pilih pelamar terlebih dahulu');
                return;
            }

            if (confirm(`Tolak ${selectedApplicants.size} pelamar yang dipilih?`)) {
                const applicantIds = Array.from(selectedApplicants);
                
                fetch('{{ route("pelamar.bulkUpdateStatus") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        pelamar_ids: applicantIds,
                        status: 'rejected'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`${data.updated_count} pelamar berhasil ditolak!`);
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status');
                });
            }
        }

        function bulkAnnouncement() {
            console.log('bulkAnnouncement called');
            console.log('selectedApplicants:', selectedApplicants);
            
            if (selectedApplicants.size === 0) {
                alert('Pilih pelamar terlebih dahulu');
                return;
            }

            const panel = document.getElementById('globalAnnouncementPanel');
            window.bulkAnnouncementApplicants = Array.from(selectedApplicants);
            
            // Show the panel
            panel.style.display = 'block';
            renderHistory(null); // Clear history for bulk announcement
        }

        function clearSelection() {
            selectedApplicants.clear();
            document.querySelectorAll('.select-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });
            document.getElementById('select-all').checked = false;
            updateSelectionUI();
        }

        // Job filtering functionality
        function filterByJob(jobTitle) {
            const tabs = document.querySelectorAll('.job-filter-tab');
            const jobGroups = document.querySelectorAll('.job-group');
            
            // Update active tab
            tabs.forEach(tab => {
                tab.classList.remove('active');
                if (tab.dataset.job === jobTitle) {
                    tab.classList.add('active');
                }
            });
            
            // Show/hide job groups
            if (jobTitle === 'all') {
                jobGroups.forEach(group => {
                    group.style.display = 'block';
                });
            } else {
                jobGroups.forEach(group => {
                    if (group.dataset.jobTitle === jobTitle) {
                        group.style.display = 'block';
                    } else {
                        group.style.display = 'none';
                    }
                });
            }
            
            // Clear selection when filtering
            clearSelection();
        }

        // Search functionality for job titles
        function searchByJobTitle(searchTerm) {
            const jobGroups = document.querySelectorAll('.job-group');
            const tabs = document.querySelectorAll('.job-filter-tab');
            
            if (!searchTerm) {
                // Show all groups if no search term
                jobGroups.forEach(group => {
                    group.style.display = 'block';
                });
                // Reset active tab to "all"
                tabs.forEach(tab => {
                    tab.classList.remove('active');
                    if (tab.dataset.job === 'all') {
                        tab.classList.add('active');
                    }
                });
                return;
            }
            
            searchTerm = searchTerm.toLowerCase();
            let hasVisibleGroups = false;
            
            jobGroups.forEach(group => {
                const jobTitle = group.dataset.jobTitle.toLowerCase();
                if (jobTitle.includes(searchTerm)) {
                    group.style.display = 'block';
                    hasVisibleGroups = true;
                } else {
                    group.style.display = 'none';
                }
            });
            
            // Update tabs - remove active from all
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
        }

        // CV Modal Functions
        function openCVModal(fileName, filePath) {
            const modal = document.getElementById('cvModal');
            const modalContent = document.getElementById('cvModalContent');
            
            // Update modal position based on sidebar state
            updateModalPosition();
            
            const fileExtension = fileName.split('.').pop().toLowerCase();
            
            if (fileExtension === 'pdf') {
                modalContent.innerHTML = `
                    <iframe src="${filePath}#view=FitV&zoom=page-width" 
                            style="width: 100%; height: 100vh; border: none; position: absolute; top: 0; left: 0;">
                        <p>Browser Anda tidak mendukung tampilan PDF. 
                           <a href="${filePath}" target="_blank">Klik di sini untuk membuka PDF</a>
                        </p>
                    </iframe>
                `;
            } else if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileExtension)) {
                modalContent.innerHTML = `
                    <img src="${filePath}" 
                         alt="${fileName}"
                         style="width: 100%; height: 100vh; object-fit: cover;">
                `;
            } else {
                modalContent.innerHTML = `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: #6b7280;">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-bottom: 16px;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14,2 14,8 20,8"></polyline>
                        </svg>
                        <p>File tidak dapat ditampilkan dalam preview</p>
                        <a href="${filePath}" target="_blank" style="color: #3b82f6; text-decoration: none;">
                            Klik untuk mengunduh ${fileName}
                        </a>
                    </div>
                `;
            }
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function updateModalPosition() {
            const modal = document.getElementById('cvModal');
            const sidebar = document.querySelector('.sidebar');
            
            if (modal && sidebar) {
                const isCollapsed = sidebar.classList.contains('collapsed');
                const sidebarWidth = isCollapsed ? 80 : sidebar.offsetWidth;
                
                modal.style.left = sidebarWidth + 'px';
                modal.style.width = `calc(100% - ${sidebarWidth}px)`;
                modal.style.height = '100vh';
                modal.style.top = '0';
                
                // Also update the modal content to fit properly
                const modalContent = document.getElementById('cvModalContent');
                if (modalContent) {
                    modalContent.style.width = '100%';
                    modalContent.style.height = '100%';
                }
            }
        }

        function closeCVModal() {
            const modal = document.getElementById('cvModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('cvModal');
            if (e.target === modal) {
                closeCVModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCVModal();
            }
        });

    </script>
    <script src="{{ asset('js/pelamar_functions.js') }}"></script>
</body>
</html>