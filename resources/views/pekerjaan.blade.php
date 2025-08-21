@extends('layouts.app')

@section('title', 'Manajemen Pekerjaan - GetJobs')
@section('page-title', 'Manajemen Pekerjaan')

@php
    $activePage = 'pekerjaan';
@endphp

@push('styles')
<style>
    /* Pekerjaan page specific styles */


        /* Job Management Table */

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
            border-radius: 12px;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid #e5e7eb;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f5f9;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
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
            gap: 12px;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
        }

        .form-row-with-dropdowns {
            display: flex;
            gap: 20px;
            align-items: flex-end;
            margin-bottom: 8px;
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
            padding: 6px 8px;
            border: none;
            border-radius: 0;
            font-size: 13px;
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
            background-size: 12px;
            padding-right: 24px;
            min-width: 100px;
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
            gap: 3px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 3px;
        }

        .form-group input,
        .form-group textarea {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 13px;
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

        /* Edit form specific styles */
        .edit-job-form .form-group select {
            padding: 6px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 13px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: white;
            cursor: pointer;
            color: #374151;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 6px center;
            background-size: 14px;
            padding-right: 28px;
        }

        .edit-job-form .form-group select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Detail Job Modal Styles */
        .job-detail-content {
            padding: 0;
        }

        .detail-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item.full-width {
            flex-direction: column;
            gap: 8px;
        }

        .detail-label {
            font-weight: 600;
            color: #374151;
            min-width: 120px;
            font-size: 13px;
        }

        .detail-value {
            color: #6b7280;
            font-size: 13px;
            flex: 1;
        }

        .detail-description {
            color: #6b7280;
            font-size: 13px;
            line-height: 1.5;
            background: #f9fafb;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            white-space: pre-wrap;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-badge.draft {
            background: #fef3c7;
            color: #d97706;
        }

        .status-badge.aktif {
            background: #d1fae5;
            color: #059669;
        }

        .status-badge.tutup {
            background: #fee2e2;
            color: #dc2626;
        }

        .detail-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
        }

        /* Close Modal Styles */
        .close-confirmation-content {
            padding: 0;
        }

        .close-warning {
            text-align: center;
            padding: 20px 0;
        }

        .warning-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .close-warning h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .job-title-to-close {
            font-size: 16px;
            font-weight: 600;
            color: #f59e0b;
            background: #fffbeb;
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #fed7aa;
            margin: 12px 0;
            display: inline-block;
        }

        .close-warning-text {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
            margin-top: 12px;
        }

        .close-actions {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-close {
            padding: 10px 20px;
            background: #f59e0b;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-close:hover {
            background: #d97706;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 50px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-cancel {
            padding: 10px 20px;
            background: white;
            color: #6b7280;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .btn-save {
            padding: 10px 20px;
            background: linear-gradient(90deg, #6a879c 0%, #223046 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 13px;
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
            
            /* View Modal Responsive */
            .detail-item {
                flex-direction: column;
                gap: 8px;
            }
            
            .detail-label {
                min-width: auto;
            }
            
            .detail-actions {
                justify-content: center;
            }
        }




        /* Table Header */
        .table-header-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr;
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

        .job-position {
            font-size: 12px;
            color: #374151;
            font-weight: 500;
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

        .action-item.close {
            color: #f59e0b;
        }

        .action-item.detail {
            color: #10b981;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 9999;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            background: #10b981;
        }

        .toast.error {
            background: #ef4444;
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


        /* Responsive Design for Card Layout */
        @media (max-width: 1200px) {
            .table-header-row,
            .job-card-content {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr;
                gap: 16px;
            }
        }

        @media (max-width: 768px) {
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
            
            .job-position,
            .job-status,
            .applicant-count,
            .posting-date {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border-bottom: 1px solid #f3f4f6;
            }
            
            .job-position::before {
                content: "Posisi: ";
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
        }
        .search-input-group {
            position: relative;
            width: 350px;
            max-width: 100%;
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
        }
</style>
@endpush

@section('content')
<!-- Toast Notification Container -->
<div id="toastContainer"></div>


<div class="table-actions-flex">
    <div class="search-input-group">
        <input type="text" class="search-input" placeholder="Cari pekerjaan...">
        <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    </div>
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
                    <div class="header-item">Judul Pekerjaan</div>
                    <div class="header-item">Posisi</div>
                    <div class="header-item">Status</div>
                    <div class="header-item">Pelamar</div>
                    <div class="header-item">Tanggal Posting</div>
                    <div class="header-item">Aksi</div>
                </div>
                
                <div class="job-cards">
                    @forelse($pekerjaan as $job)
                    <div class="job-card">
                        <div class="job-card-content">
                            <div class="job-info">
                                <div class="job-avatar">{{ substr($job->judul_pekerjaan, 0, 2) }}</div>
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
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item detail" onclick="openDetailJobModal({{ $job->id_pekerjaan }}, '{{ $job->judul_pekerjaan }}', '{{ $job->kategori_pekerjaan }}', '{{ $job->deskripsi_pekerjaan }}', '{{ $job->status }}', '{{ $job->created_at->format('d M Y H:i') }}')">Detail</div>
                                    <div class="action-item edit" onclick="openEditJobModal({{ $job->id_pekerjaan }}, '{{ $job->judul_pekerjaan }}', '{{ $job->kategori_pekerjaan }}', '{{ $job->deskripsi_pekerjaan }}', '{{ $job->status }}')">Edit</div>
                                    <div class="action-item close" onclick="closeJob({{ $job->id_pekerjaan }}, '{{ $job->judul_pekerjaan }}')">Tutup</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="no-jobs">
                        <p>Belum ada pekerjaan yang ditambahkan</p>
                    </div>
                    @endforelse
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
    <!-- Add Job Modal -->
    <div id="addJobModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Tambah Lowongan</h2>
            </div>
            
            <form class="job-form" method="POST" action="{{ route('pekerjaan.store') }}" enctype="multipart/form-data">
                @csrf
                
                @if ($errors->any())
                    <div class="alert alert-danger" style="background: #fee; border: 1px solid #fcc; color: #c33; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (session('success'))
                    <div class="alert alert-success" style="background: #efe; border: 1px solid #cfc; color: #3c3; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger" style="background: #fee; border: 1px solid #fcc; color: #c33; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="form-group full-width">
                    <label for="judul_pekerjaan">Nama Pekerjaan</label>
                    <input type="text" id="judul_pekerjaan" name="judul_pekerjaan" value="{{ old('judul_pekerjaan') }}" required>
                </div>
                
                <div class="form-row-with-dropdowns">
                    <div class="form-group">
                        <label for="gaji_pekerjaan">Gaji</label>
                        <input type="text" id="gaji_pekerjaan" name="gaji_pekerjaan" value="{{ old('gaji_pekerjaan') }}" placeholder="Rp 5.000.000" required>
                    </div>
                    <div class="dropdown-item">
                        <label for="lokasi_pekerjaan">Lokasi</label>
                        <select id="lokasi_pekerjaan" name="lokasi_pekerjaan" required>
                            <option value="">Pilih Lokasi</option>
                            <option value="jakarta" {{ old('lokasi_pekerjaan') == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                            <option value="bandung" {{ old('lokasi_pekerjaan') == 'bandung' ? 'selected' : '' }}>Bandung</option>
                            <option value="surabaya" {{ old('lokasi_pekerjaan') == 'surabaya' ? 'selected' : '' }}>Surabaya</option>
                            <option value="yogyakarta" {{ old('lokasi_pekerjaan') == 'yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                            <option value="medan" {{ old('lokasi_pekerjaan') == 'medan' ? 'selected' : '' }}>Medan</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label for="kategori_pekerjaan">Kategori</label>
                        <select id="kategori_pekerjaan" name="kategori_pekerjaan" required>
                            <option value="">Pilih Kategori</option>
                            <option value="technology" {{ old('kategori_pekerjaan') == 'technology' ? 'selected' : '' }}>Technology</option>
                            <option value="design" {{ old('kategori_pekerjaan') == 'design' ? 'selected' : '' }}>Design</option>
                            <option value="marketing" {{ old('kategori_pekerjaan') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="finance" {{ old('kategori_pekerjaan') == 'finance' ? 'selected' : '' }}>Finance</option>
                            <option value="hr" {{ old('kategori_pekerjaan') == 'hr' ? 'selected' : '' }}>Human Resources</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group full-width">
                    <label for="deskripsi_pekerjaan">Detail Pekerjaan</label>
                    <textarea id="deskripsi_pekerjaan" name="deskripsi_pekerjaan" rows="4" placeholder="Masukkan detail pekerjaan..." required>{{ old('deskripsi_pekerjaan') }}</textarea>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeAddJobModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Job Modal -->
    <div id="editJobModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Lowongan</h2>
            </div>
            
            <form class="edit-job-form" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                @if ($errors->any())
                    <div class="alert alert-danger" style="background: #fee; border: 1px solid #fcc; color: #c33; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (session('success'))
                    <div class="alert alert-success" style="background: #efe; border: 1px solid #cfc; color: #3c3; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger" style="background: #fee; border: 1px solid #fcc; color: #c33; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="form-group full-width">
                    <label for="edit_judul_pekerjaan">Nama Pekerjaan</label>
                    <input type="text" id="edit_judul_pekerjaan" name="judul_pekerjaan" value="{{ old('judul_pekerjaan') }}" required>
                </div>
                
                <div class="form-row-with-dropdowns">
                    <div class="form-group">
                        <label for="edit_gaji_pekerjaan">Gaji</label>
                        <input type="text" id="edit_gaji_pekerjaan" name="gaji_pekerjaan" value="{{ old('gaji_pekerjaan') }}" placeholder="Rp 5.000.000" required>
                    </div>
                    <div class="dropdown-item">
                        <label for="edit_lokasi_pekerjaan">Lokasi</label>
                        <select id="edit_lokasi_pekerjaan" name="lokasi_pekerjaan" required>
                            <option value="">Pilih Lokasi</option>
                            <option value="jakarta" {{ old('lokasi_pekerjaan') == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                            <option value="bandung" {{ old('lokasi_pekerjaan') == 'bandung' ? 'selected' : '' }}>Bandung</option>
                            <option value="surabaya" {{ old('lokasi_pekerjaan') == 'surabaya' ? 'selected' : '' }}>Surabaya</option>
                            <option value="yogyakarta" {{ old('lokasi_pekerjaan') == 'yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                            <option value="medan" {{ old('lokasi_pekerjaan') == 'medan' ? 'selected' : '' }}>Medan</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label for="edit_kategori_pekerjaan">Kategori</label>
                        <select id="edit_kategori_pekerjaan" name="kategori_pekerjaan" required>
                            <option value="">Pilih Kategori</option>
                            <option value="technology" {{ old('kategori_pekerjaan') == 'technology' ? 'selected' : '' }}>Technology</option>
                            <option value="design" {{ old('kategori_pekerjaan') == 'design' ? 'selected' : '' }}>Design</option>
                            <option value="marketing" {{ old('kategori_pekerjaan') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="finance" {{ old('kategori_pekerjaan') == 'finance' ? 'selected' : '' }}>Finance</option>
                            <option value="hr" {{ old('kategori_pekerjaan') == 'hr' ? 'selected' : '' }}>Human Resources</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group full-width">
                    <label for="edit_deskripsi_pekerjaan">Detail Pekerjaan</label>
                    <textarea id="edit_deskripsi_pekerjaan" name="deskripsi_pekerjaan" rows="4" placeholder="Masukkan detail pekerjaan..." required>{{ old('deskripsi_pekerjaan') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="edit_status">Status</label>
                    <select id="edit_status" name="status" required>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tutup" {{ old('status') == 'tutup' ? 'selected' : '' }}>Tutup</option>
                    </select>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeEditJobModal()">Batal</button>
                    <button type="submit" class="btn-save">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Detail Job Modal -->
    <div id="detailJobModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Detail Lowongan</h2>
            </div>
            
            <div class="job-detail-content">
                <div class="detail-section">
                    <div class="detail-item">
                        <label class="detail-label">ID Lowongan:</label>
                        <span class="detail-value" id="view_job_id"></span>
                    </div>
                    
                    <div class="detail-item">
                        <label class="detail-label">Judul Pekerjaan:</label>
                        <span class="detail-value" id="view_judul_pekerjaan"></span>
                    </div>
                    
                    <div class="detail-item">
                        <label class="detail-label">Lokasi:</label>
                        <span class="detail-value" id="view_lokasi_pekerjaan"></span>
                    </div>
                    
                    <div class="detail-item">
                        <label class="detail-label">Gaji:</label>
                        <span class="detail-value" id="view_gaji_pekerjaan"></span>
                    </div>
                    
                    <div class="detail-item">
                        <label class="detail-label">Kategori:</label>
                        <span class="detail-value" id="view_kategori_pekerjaan"></span>
                    </div>
                    
                    <div class="detail-item">
                        <label class="detail-label">Status:</label>
                        <span class="detail-value">
                            <span class="status-badge" id="view_status_badge"></span>
                        </span>
                    </div>
                    
                    <div class="detail-item">
                        <label class="detail-label">Tanggal Dibuat:</label>
                        <span class="detail-value" id="view_created_at"></span>
                    </div>
                    
                    <div class="detail-item">
                        <label class="detail-label">Jumlah Pelamar:</label>
                        <span class="detail-value" id="view_applicant_count">0</span>
                    </div>
                    
                    <div class="detail-item full-width">
                        <label class="detail-label">Deskripsi Pekerjaan:</label>
                        <div class="detail-description" id="view_deskripsi_pekerjaan"></div>
                    </div>
                </div>
                
                <div class="detail-actions">
                    <button type="button" class="btn-cancel" onclick="closeDetailJobModal()">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Close Job Modal -->
    <div id="closeJobModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Konfirmasi Tutup Lowongan</h2>
            </div>
            
            <div class="close-confirmation-content">
                <div class="close-warning">
                    <div class="warning-icon">⚠️</div>
                    <h3>Apakah Anda yakin ingin menutup lowongan ini?</h3>
                    <p class="job-title-to-close" id="jobTitleToClose"></p>
                    <p class="close-warning-text">Lowongan akan ditutup dan tidak akan muncul lagi di pencarian. Data pekerjaan tetap tersimpan.</p>
                </div>
                
                <div class="close-actions">
                    <button type="button" class="btn-cancel" onclick="closeCloseJobModal()">Batal</button>
                    <form id="closeJobForm" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="tutup">
                        <button type="submit" class="btn-close">Tutup Lowongan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
        
        function openEditJobModal(id, judul, lokasi, gaji, kategori, deskripsi, status) {
            // Set form action
            const form = document.querySelector('.edit-job-form');
            form.action = `/pekerjaan/${id}`;
            
            // Populate form fields
            document.getElementById('edit_judul_pekerjaan').value = judul;
            document.getElementById('edit_lokasi_pekerjaan').value = lokasi;
            document.getElementById('edit_gaji_pekerjaan').value = gaji;
            document.getElementById('edit_kategori_pekerjaan').value = kategori;
            document.getElementById('edit_deskripsi_pekerjaan').value = deskripsi;
            document.getElementById('edit_status').value = status;
            
            // Show modal
            document.getElementById('editJobModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Close action dropdown
            const dropdowns = document.querySelectorAll('.action-dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
        
        function closeEditJobModal() {
            document.getElementById('editJobModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
                function openDetailJobModal(id, judul, lokasi, gaji, kategori, deskripsi, status, created_at) {
            console.log('openDetailJobModal called with:', { id, judul, lokasi, gaji, kategori, deskripsi, status, created_at });
            
            // Get modal element
            const modal = document.getElementById('detailJobModal');
            if (!modal) {
                console.error('View modal not found');
                alert('Modal tidak ditemukan');
                return;
            }
            
            // Set basic information
            document.getElementById('view_job_id').textContent = '#' + id;
            document.getElementById('view_judul_pekerjaan').textContent = judul || 'Tidak ada judul';
            document.getElementById('view_deskripsi_pekerjaan').textContent = deskripsi || 'Tidak ada deskripsi';
            
            // Set lokasi with icon
            const lokasiText = lokasi ? lokasi.charAt(0).toUpperCase() + lokasi.slice(1) : 'Tidak ada lokasi';
            document.getElementById('view_lokasi_pekerjaan').innerHTML = `📍 ${lokasiText}`;
            
            // Set gaji with icon
            document.getElementById('view_gaji_pekerjaan').innerHTML = `💵 ${gaji || 'Tidak ada gaji'}`;
            
            // Set kategori with icon
            let kategoriIcon = '';
            switch(kategori) {
                case 'technology': kategoriIcon = '💻'; break;
                case 'design': kategoriIcon = '🎨'; break;
                case 'marketing': kategoriIcon = '📢'; break;
                case 'finance': kategoriIcon = '💰'; break;
                case 'hr': kategoriIcon = '👥'; break;
                default: kategoriIcon = '📋'; break;
            }
            const kategoriText = kategori ? kategori.charAt(0).toUpperCase() + kategori.slice(1) : 'Tidak ada kategori';
            document.getElementById('view_kategori_pekerjaan').innerHTML = `${kategoriIcon} ${kategoriText}`;
            
            // Set tanggal with icon
            document.getElementById('view_created_at').innerHTML = `📅 ${created_at || 'Tidak ada tanggal'}`;
            
            // Set jumlah pelamar
            document.getElementById('view_applicant_count').innerHTML = `👥 0 pelamar`;
            
            // Set status badge with icon
            let statusIcon = '';
            switch(status) {
                case 'draft': statusIcon = '📝'; break;
                case 'aktif': statusIcon = '✅'; break;
                case 'tutup': statusIcon = '❌'; break;
                default: statusIcon = '❓'; break;
            }
            const statusText = status ? status.charAt(0).toUpperCase() + status.slice(1) : 'Tidak ada status';
            const statusBadge = document.getElementById('view_status_badge');
            statusBadge.innerHTML = `${statusIcon} ${statusText}`;
            statusBadge.className = `status-badge ${status || 'unknown'}`;
            
            // Show modal
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Close action dropdown
            const dropdowns = document.querySelectorAll('.action-dropdown');
            dropdowns.forEach(dropdown => dropdown.classList.remove('show'));
            
            console.log('Modal opened successfully');
        }
        
        function closeDetailJobModal() {
            document.getElementById('detailJobModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        function closeJob(id, judul) {
            console.log('Closing job:', { id, judul });
            
            // Set job title to close
            document.getElementById('jobTitleToClose').textContent = judul;
            
            // Set form action
            const form = document.getElementById('closeJobForm');
            form.action = `/pekerjaan/${id}`;
            
            // Show modal
            document.getElementById('closeJobModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Close action dropdown
            const dropdowns = document.querySelectorAll('.action-dropdown');
            dropdowns.forEach(dropdown => dropdown.classList.remove('show'));
        }
        
        function closeCloseJobModal() {
            document.getElementById('closeJobModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        

        
        // Close modal when clicking outside
        document.getElementById('addJobModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddJobModal();
            }
        });
        
        document.getElementById('editJobModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditJobModal();
            }
        });
        
        document.getElementById('detailJobModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailJobModal();
            }
        });
        
        document.getElementById('closeJobModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCloseJobModal();
            }
        });
        
        // Handle form submission
        document.querySelector('.job-form').addEventListener('submit', function(e) {
            // Debug: Log form data
            const formData = new FormData(this);
            console.log('Form data being submitted:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }
            
            // Check if all required fields are filled
            const requiredFields = ['judul_pekerjaan', 'lokasi_pekerjaan', 'gaji_pekerjaan', 'kategori_pekerjaan'];
            let isValid = true;
            let missingFields = [];
            
            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element || !element.value.trim()) {
                    console.error('Missing required field:', field);
                    missingFields.push(field);
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showToast('Mohon isi semua field yang diperlukan: ' + missingFields.join(', '), 'error');
                return;
            }
            
            console.log('Form is valid, submitting...');
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Menyimpan...';
            submitBtn.disabled = true;
            
            // Form will be submitted to the server
            // Show success message
            showToast('Menyimpan pekerjaan...', 'success');
            
            // Don't close modal immediately, let the redirect handle it
            setTimeout(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });
        
        // Handle edit form submission
        document.querySelector('.edit-job-form').addEventListener('submit', function(e) {
            // Check if all required fields are filled
            const requiredFields = ['judul_pekerjaan', 'lokasi_pekerjaan', 'gaji_pekerjaan', 'kategori_pekerjaan', 'status'];
            let isValid = true;
            let missingFields = [];
            
            requiredFields.forEach(field => {
                const element = this.querySelector(`[name="${field}"]`);
                if (!element || !element.value.trim()) {
                    console.error('Missing required field:', field);
                    missingFields.push(field);
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showToast('Mohon isi semua field yang diperlukan: ' + missingFields.join(', '), 'error');
                return;
            }
            
            console.log('Edit form is valid, submitting...');
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Mengupdate...';
            submitBtn.disabled = true;
            
            // Form will be submitted to the server
            // Show success message
            showToast('Mengupdate pekerjaan...', 'success');
            
            setTimeout(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });
        
        // Handle close form submission
        document.getElementById('closeJobForm').addEventListener('submit', function(e) {
            console.log('Close form submitted');
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Menutup...';
            submitBtn.disabled = true;
            
            // Show success message
            showToast('Menutup lowongan...', 'success');
            
            // Form will be submitted to the server
            setTimeout(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 3000);
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

        // Toast notification function
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = message;
            
            toastContainer.appendChild(toast);
            
            // Show toast
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toastContainer.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Show toast on page load if there are session messages
        @if (session('success'))
            showToast('{{ session('success') }}', 'success');
        @endif

        @if (session('error'))
            showToast('{{ session('error') }}', 'error');
        @endif
        
        // Debug: Check if all modals exist on page load
        document.addEventListener('DOMContentLoaded', function() {
            const modals = {
                'addJobModal': document.getElementById('addJobModal'),
                'editJobModal': document.getElementById('editJobModal'),
                'detailJobModal': document.getElementById('detailJobModal'),
                'closeJobModal': document.getElementById('closeJobModal')
            };
            
            console.log('Modal check on page load:', modals);
            
            Object.keys(modals).forEach(modalName => {
                if (!modals[modalName]) {
                    console.error(`Modal ${modalName} not found!`);
                } else {
                    console.log(`Modal ${modalName} found successfully`);
                }
            });
        });
    </script>
@endpush