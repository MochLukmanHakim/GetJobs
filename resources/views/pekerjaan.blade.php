@extends('layouts.app')

@section('title', 'Manajemen Pekerjaan - GetJobs')
@section('page-title', 'Manajemen Pekerjaan')

@php
    $activePage = 'pekerjaan';
@endphp

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('styles')
<style>
    /* Pekerjaan page specific styles */


        /* Job Management Table */

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            display: none;
            backdrop-filter: blur(4px);
            overflow: hidden;
        }

        .modal-overlay.show {
            display: block !important;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 32px;
            width: 100%;
            max-width: 900px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid #e5e7eb;
            margin: 0;
            position: relative;
            transition: all 0.3s ease;
            scroll-behavior: smooth;
            /* Hide scrollbar for all browsers */
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }

        /* Hide scrollbar for webkit browsers */
        .modal-content::-webkit-scrollbar {
            display: none;
        }

        .modal-overlay.show .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: modalSlideIn 0.3s ease-out;
        }


        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }

        .close {
            color: #6b7280;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
            background: none;
            border: none;
            padding: 4px;
        }

        .close:hover {
            color: #374151;
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
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .dropdown-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
        }

        .dropdown-item label {
            display: none;
        }

        .form-row-with-dropdowns .form-group select {
            padding: 8px 12px;
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
            background-position: right 8px center;
            background-size: 14px;
            padding-right: 28px;
            width: 100%;
        }

        .form-row-with-dropdowns .form-group select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-row-with-dropdowns .form-group select option {
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
        .close-job-modal {
            max-width: 480px;
            width: 90%;
            margin: auto;
        }

        .close-confirmation-content {
            padding: 24px;
        }

        .close-warning {
            text-align: center;
        }

        .warning-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            border: 3px solid #f59e0b;
        }

        .warning-icon i {
            font-size: 28px;
            color: #f59e0b;
        }

        .close-warning h3 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .job-title-to-close {
            font-size: 18px;
            font-weight: 700;
            color: #dc2626;
            background: #fef2f2;
            padding: 16px 20px;
            border-radius: 8px;
            border: 2px solid #fecaca;
            margin: 20px 0 24px 0;
            display: block;
            text-align: center;
            max-width: 100%;
            word-break: break-word;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .close-info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            margin: 20px 0 24px 0;
            text-align: left;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 14px;
            color: #4b5563;
            font-weight: 500;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-item i {
            color: #6b7280;
            font-size: 16px;
            width: 18px;
            flex-shrink: 0;
        }

        .close-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn-cancel {
            padding: 12px 20px;
            background: #ffffff;
            color: #6b7280;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 120px;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #374151;
            transform: translateY(-1px);
        }

        .btn-close {
            padding: 12px 20px;
            background: #dc2626;
            color: white;
            border: 1px solid #dc2626;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 140px;
            justify-content: center;
        }

        .btn-close:hover {
            background: #b91c1c;
            border-color: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        /* Toast Notifications */
        #toastContainer {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
        }

        .toast {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 300px;
            max-width: 400px;
        }

        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast.success {
            border-left: 4px solid #10b981;
            color: #065f46;
        }

        .toast.error {
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }

        .toast.info {
            border-left: 4px solid #3b82f6;
            color: #1e40af;
        }

        .toast::before {
            font-family: 'bootstrap-icons';
            font-size: 16px;
        }

        .toast.success::before {
            content: '\F26A'; /* bi-check-circle-fill */
            color: #10b981;
        }

        .toast.error::before {
            content: '\F659'; /* bi-x-circle-fill */
            color: #ef4444;
        }

        .toast.info::before {
            content: '\F431'; /* bi-info-circle-fill */
            color: #3b82f6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        /* Enhanced Form Layout */
        .job-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            align-items: start;
            position: relative;
            z-index: 2;
        }

        .form-section {
            display: contents;
        }

        .form-row-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            grid-column: 1 / -1;
        }

        .form-group {
            position: relative;
            z-index: 2;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #1e293b;
            font-size: 15px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1e293b;
            box-shadow: 0 0 0 3px rgba(30, 41, 59, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Specific styling for description textarea */
        #deskripsi_pekerjaan {
            min-height: 140px;
            line-height: 1.6;
            font-family: inherit;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            grid-column: 1 / -1;
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
            background: #1e293b;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: #0f172a;
        }

        .btn-save:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-save:disabled:hover {
            background: #1e293b;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .btn-loading {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Helper text and validation styling */
        .form-group .helper-text {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
            font-weight: 500;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-group .error-text {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
            padding: 8px 12px;
            background: rgba(254, 226, 226, 0.8);
            border-radius: 8px;
            border-left: 3px solid #dc2626;
        }

        .form-group .success-border {
            border-color: #10b981 !important;
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.1), 0 0 0 3px rgba(16, 185, 129, 0.08) !important;
        }

        .form-group .error-border {
            border-color: #dc2626 !important;
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.1), 0 0 0 3px rgba(220, 38, 38, 0.08) !important;
        }

        /* Character counter styling */
        #char-count {
            font-size: 12px;
            color: #64748b;
            font-weight: 600;
            padding: 4px 8px;
            background: rgba(248, 250, 252, 0.8);
            border-radius: 6px;
            backdrop-filter: blur(10px);
        }

        /* Responsive Modal */
        @media (max-width: 768px) {
            .modal-overlay.show .modal-content {
                width: calc(100vw - 32px);
                max-width: none;
                padding: 28px;
                max-height: calc(100vh - 32px);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 16px;
            }
            
            .modal-header {
                margin-bottom: 20px;
                padding-bottom: 12px;
            }
            
            .modal-title {
                font-size: 22px;
            }
            
            /* Switch to single column on mobile */
            .job-form {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .form-group {
                margin-bottom: 18px;
            }
            
            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 12px 16px;
                font-size: 14px;
            }
            
            .form-actions {
                margin-top: 28px;
                padding-top: 20px;
                flex-direction: column-reverse;
                gap: 12px;
            }
            
            .btn-cancel,
            .btn-save {
                width: 100%;
                justify-content: center;
                padding: 16px 24px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .modal-overlay.show .modal-content {
                width: calc(100vw - 24px);
                padding: 20px;
                border-radius: 12px;
                max-height: calc(100vh - 24px);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            
            .modal-title {
                font-size: 18px;
            }
            
            .form-group label {
                font-size: 12px;
            }
            
            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 10px 12px;
                font-size: 14px;
            }
            
            .btn-cancel,
            .btn-save {
                padding: 12px 16px;
                font-size: 14px;
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
                content: "Kategori: ";
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
            
            /* Responsive tab design */
            .tab-container {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 4px;
            }
            
            .tab-item {
                text-align: left;
                padding: 8px 0;
                min-width: auto;
                flex: none;
            }
        }
        .table-actions-flex {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 32px;
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
        .add-job-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #000000;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }
        .add-job-btn:hover {
            background: #333333;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .add-job-btn svg {
            flex-shrink: 0;
        }

        /* Action Buttons Group */
        .action-buttons-group {
            display: flex;
            gap: 12px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .history-job-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: #6a879c;
            border: 2px solid #6a879c;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            position: relative;
            z-index: 2;
        }

        .history-job-btn:hover {
            background: #6a879c;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(106, 135, 156, 0.25);
        }

        .history-job-btn svg {
            flex-shrink: 0;
        }

        /* Job History Modal Styles */
        .job-history-content {
            padding: 20px;
            max-height: 70vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .history-table-header {
            display: grid;
            grid-template-columns: 2fr 1fr 0.8fr 0.8fr 1fr 0.8fr;
            gap: 16px;
            align-items: center;
            padding: 18px 24px;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
        }

        .history-header-item {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            text-align: left;
        }

        .history-header-item:nth-child(3) {
            text-align: center;
        }

        .history-header-item:nth-child(5) {
            text-align: center;
        }

        .history-job-cards {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
            overflow-y: auto;
            padding-right: 8px;
            min-height: 0;
        }

        /* Custom scrollbar for history cards */
        .history-job-cards::-webkit-scrollbar {
            width: 6px;
        }

        .history-job-cards::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .history-job-cards::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .history-job-cards::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .history-job-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 18px 24px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            cursor: pointer;
        }

        .history-job-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: #d1d5db;
        }

        .history-job-card-content {
            display: grid;
            grid-template-columns: 2fr 1fr 0.8fr 0.8fr 1fr 0.8fr;
            gap: 16px;
            align-items: center;
        }

        .history-job-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .history-job-avatar {
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

        .history-job-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .history-job-details p {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }

        .history-job-position {
            font-size: 14px;
            color: #374151;
            font-weight: 500;
        }

        .history-applicant-count {
            font-size: 14px;
            color: #3b82f6;
            font-weight: 600;
            text-align: center;
        }

        .history-accepted-count {
            font-size: 14px;
            color: #059669;
            font-weight: 600;
            text-align: center;
        }

        .history-posting-date {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
        }

        .history-job-status {
            display: flex;
            align-items: center;
            gap: 6px;
            justify-content: center;
        }

        .history-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .history-status-dot.aktif {
            background: #10b981;
        }

        .history-status-dot.tutup {
            background: #ef4444;
        }


        .history-status-text {
            font-size: 12px;
            font-weight: 500;
        }

        .history-status-text.aktif {
            color: #059669;
        }

        .history-status-text.tutup {
            color: #dc2626;
        }

        
        /* Job Filter Tabs - Matching Applicant Page Design */
        .job-filter-tabs {
            margin: 0;
            overflow: hidden;
            flex: 1;
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
            max-width: calc(3 * 140px + 2 * 16px);
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
                justify-content: center;
            }
            
            .action-buttons-group {
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }
            
            .history-job-btn,
            .add-job-btn {
                width: 100%;
                justify-content: center;
                padding: 12px 16px;
                font-size: 14px;
            }
            
            /* Job History Modal Responsive */
            .history-table-header {
                display: grid;
                grid-template-columns: 1fr;
                gap: 8px;
                padding: 16px;
                background: #f8fafc;
                border-radius: 8px;
                margin-bottom: 12px;
                text-align: center;
            }

            .history-table-header .history-header-item {
                display: none;
            }

            .history-table-header .history-header-item:first-child {
                display: block;
                font-size: 16px;
                font-weight: 700;
                color: #1f2937;
            }

            .history-table-header .history-header-item:first-child::after {
                content: " - Riwayat Pekerjaan Tutup";
                font-weight: 500;
                color: #6b7280;
            }
            
            .history-job-card-content {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .history-job-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .history-job-details h4 {
                font-size: 16px;
            }
            
            .history-job-position,
            .history-applicant-count,
            .history-accepted-count,
            .history-posting-date,
            .history-job-status {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border-bottom: 1px solid #f3f4f6;
            }
            
            .history-job-position::before {
                content: "Kategori: ";
                font-weight: 600;
                color: #374151;
            }
            
            .history-applicant-count::before {
                content: "Pelamar: ";
                font-weight: 600;
                color: #374151;
            }
            
            .history-accepted-count::before {
                content: "Diterima: ";
                font-weight: 600;
                color: #374151;
            }
            
            .history-posting-date::before {
                content: "Tanggal: ";
                font-weight: 600;
                color: #374151;
            }
            
            .history-job-status::before {
                content: "Status: ";
                font-weight: 600;
                color: #374151;
            }
            .job-filter-tabs {
                justify-content: center;
            }
            .tab-container {
                justify-content: center;
                max-width: none;
            }
            .tab-item {
                min-width: auto;
                flex: 1;
                text-align: center;
                padding: 8px 0;
            }
        }

        /* Center alignment for headers and table/card columns */
        .table-header-row .header-item {
            text-align: center;
        }
        .job-card-content > div {
            text-align: center;
        }
        /* EXCEPTION: title column (job-info) should be left-aligned */
        .job-info {
            justify-content: flex-start;
            padding-left: 0px; /* move titles more to the left */
        }
        .job-details,
        .job-details h4,
        .job-details p {
            text-align: left;
        }
        .job-details { padding-left: 2px; }
        .job-details h4 { margin-left: 0; }
        @media (max-width: 600px) {
            .job-info { padding-left: 10px; }
            .job-details { padding-left: 0; }
        }
        .job-position,
        .applicant-count,
        .posting-date {
            justify-self: center;
        }
        .action-menu {
            justify-self: center;
        }
        .job-status {
            justify-content: center;
        }
</style>
@endpush

@section('content')
<!-- Toast Notification Container -->
<div id="toastContainer"></div>


<div class="table-actions-flex">
    <!-- Modern Search Component -->
    @include('components.modern-search', ['pageType' => 'pekerjaan', 'categories' => $categories ?? []])
    
    <div class="action-buttons-group">
        <button class="history-job-btn" onclick="openJobHistoryModal()" title="Riwayat Pekerjaan yang Sudah Tutup">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <polyline points="9,22 9,12 15,12 15,22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Riwayat
        </button>
        
        <button class="add-job-btn" onclick="openAddJobModal()" title="Tambah Pekerjaan">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Tambah
        </button>
    </div>
</div>

            <!-- Job Management Table -->
            <div class="table-card">
                <div class="table-header"></div>
                
                <!-- Table Header -->
                <div class="table-header-row">
                    <div class="header-item">Judul Pekerjaan</div>
                    <div class="header-item">Kategori</div>
                    <div class="header-item">Pelamar</div>
                    <div class="header-item">Tanggal Posting</div>
                    <div class="header-item">Aksi</div>
                    <div class="header-item">Status</div>
                </div>
                
                <div class="job-cards">
                    {{-- Debug: Show job count --}}
                    <script>console.log('Total jobs from server:', {{ count($pekerjaan) }});</script>
                    @forelse($pekerjaan as $job)
                    <div class="job-card" data-status="{{ $job->status }}" data-job-id="{{ $job->id_pekerjaan }}">
                        <div class="job-card-content">
                            <div class="job-info">
                                <div class="job-details">
                                    @php
                                        $rawTitle = trim(preg_replace('/\s+/', ' ', $job->judul_pekerjaan ?? ''));
                                        $words = $rawTitle !== '' ? preg_split('/\s+/', $rawTitle, -1, PREG_SPLIT_NO_EMPTY) : [];
                                        $displayTitle = $rawTitle;
                                        if (count($words) === 2) {
                                            $catText = ucwords(str_replace(['-', '_'], ' ', $job->kategori_pekerjaan ?? ''));
                                            if ($catText !== '') {
                                                $displayTitle = $rawTitle.' '.$catText;
                                            }
                                        }
                                    @endphp
                                    <h4>{{ $displayTitle }}</h4>
                                </div>
                            </div>
                            <div class="job-position">
                                @php
                                    $categoryMap = [
                                        'technology' => 'Technology',
                                        'design' => 'Design',
                                        'marketing' => 'Marketing',
                                        'finance' => 'Finance',
                                        'hr' => 'Human Resources'
                                    ];
                                    $displayCategory = $categoryMap[$job->kategori_pekerjaan] ?? ucfirst($job->kategori_pekerjaan);
                                @endphp
                                {{ $displayCategory }}
                            </div>
                            <div class="applicant-count">{{ $job->pelamars_count ?? 0 }}/{{ $job->jumlah_pelamar_diinginkan ?? 5 }}</div>
                            <div class="posting-date">{{ $job->created_at->format('d M Y') }}</div>
                            <div class="action-menu">
                                <button class="action-toggle" onclick="toggleActionMenu(this)">⋯</button>
                                <div class="action-dropdown">
                                    <div class="action-item detail" onclick="window.location.href='{{ route('pekerjaan.show', $job->id_pekerjaan) }}'">Detail</div>
                                    <div class="action-item edit" onclick="openEditJobModal({{ $job->id_pekerjaan }}, 
                                        {{ json_encode($job->judul_pekerjaan) }}, 
                                        {{ json_encode($job->lokasi_pekerjaan) }}, 
                                        {{ json_encode($job->gaji_pekerjaan) }}, 
                                        {{ json_encode($job->kategori_pekerjaan) }}, 
                                        {{ json_encode($job->deskripsi_pekerjaan) }}, 
                                        {{ json_encode($job->status) }}, 
                                        {{ $job->jumlah_pelamar_diinginkan ?? 5 }})">Edit</div>
                                    <div class="action-item close" onclick="closeJob({{ $job->id_pekerjaan }}, '{{ $job->judul_pekerjaan }}')">Tutup</div>
                                </div>
                            </div>
                            <div class="job-status">
                                <div class="status-dot {{ $job->status }}"></div>
                                <span class="status-text {{ $job->status }}">{{ ucfirst($job->status) }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="no-jobs">
                        <p>Belum ada pekerjaan yang ditambahkan</p>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination removed since we're showing only 10 jobs total --}}
            </div>
    <!-- Job History Modal -->
    <div id="jobHistoryModal" class="modal-overlay">
        <div class="modal-content" style="max-width: 1000px;">
            <div class="modal-header">
                <h2 class="modal-title">Riwayat Pekerjaan yang Sudah Tutup</h2>
                <button class="close" onclick="closeJobHistoryModal()">&times;</button>
            </div>
            <div class="job-history-content">
                <!-- Table Header -->
                <div class="history-table-header">
                    <div class="history-header-item">Judul Pekerjaan</div>
                    <div class="history-header-item">Kategori</div>
                    <div class="history-header-item">Pelamar</div>
                    <div class="history-header-item">Diterima</div>
                    <div class="history-header-item">Tanggal Posting</div>
                    <div class="history-header-item">Status</div>
                </div>
                
                <div class="history-job-cards" id="historyJobCards">
                    <!-- Job history will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Add Job Modal -->
    <div id="addJobModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Tambah Lowongan</h2>
                <button type="button" class="close" onclick="closeAddJobModal()">&times;</button>
            </div>
            
            <form class="job-form" method="POST" action="{{ route('pekerjaan.store') }}" enctype="multipart/form-data" onsubmit="return validateJobForm(this)">
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
                
                <!-- Left Column -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="judul_pekerjaan">Nama Pekerjaan</label>
                        <input type="text" id="judul_pekerjaan" name="judul_pekerjaan" value="{{ old('judul_pekerjaan') }}" 
                               placeholder="Contoh: Senior Software Engineer Backend" required 
                               class="@error('judul_pekerjaan') is-invalid @enderror"
                               oninput="validateJobTitle(this)">
                        <div id="word-count-feedback" style="font-size: 12px; margin-top: 4px; color: #6b7280;">Harus 3-4 kata</div>
                        @error('judul_pekerjaan')
                            <div style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gaji_pekerjaan">Gaji</label>
                        <input type="text" id="gaji_pekerjaan" name="gaji_pekerjaan" value="{{ old('gaji_pekerjaan') }}" 
                               placeholder="Contoh: Rp 5.000.000 - Rp 8.000.000" required
                               class="@error('gaji_pekerjaan') is-invalid @enderror"
                               oninput="formatSalaryInput(this)">
                        <div style="font-size: 11px; color: #6b7280; margin-top: 2px;">Format: Rp X.XXX.XXX atau range gaji</div>
                        @error('gaji_pekerjaan')
                            <div style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lokasi_pekerjaan">Lokasi</label>
                        <select id="lokasi_pekerjaan" name="lokasi_pekerjaan" required
                                class="@error('lokasi_pekerjaan') is-invalid @enderror"
                                onchange="validateSelect(this)">
                            <option value="">Pilih Lokasi</option>
                            <option value="Jakarta" {{ old('lokasi_pekerjaan') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                            <option value="Bandung" {{ old('lokasi_pekerjaan') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                            <option value="Surabaya" {{ old('lokasi_pekerjaan') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                            <option value="Yogyakarta" {{ old('lokasi_pekerjaan') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                            <option value="Medan" {{ old('lokasi_pekerjaan') == 'Medan' ? 'selected' : '' }}>Medan</option>
                            <option value="remote" {{ old('lokasi_pekerjaan') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ old('lokasi_pekerjaan') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('lokasi_pekerjaan')
                            <div style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="kategori_pekerjaan">Kategori</label>
                        <select id="kategori_pekerjaan" name="kategori_pekerjaan" required
                                class="@error('kategori_pekerjaan') is-invalid @enderror"
                                onchange="validateSelect(this)">
                            <option value="">Pilih Kategori</option>
                            <option value="technology" {{ old('kategori_pekerjaan') == 'technology' ? 'selected' : '' }}>Technology</option>
                            <option value="design" {{ old('kategori_pekerjaan') == 'design' ? 'selected' : '' }}>Design</option>
                            <option value="marketing" {{ old('kategori_pekerjaan') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="finance" {{ old('kategori_pekerjaan') == 'finance' ? 'selected' : '' }}>Finance</option>
                            <option value="hr" {{ old('kategori_pekerjaan') == 'hr' ? 'selected' : '' }}>Human Resources</option>
                            <option value="sales" {{ old('kategori_pekerjaan') == 'sales' ? 'selected' : '' }}>Sales</option>
                            <option value="operations" {{ old('kategori_pekerjaan') == 'operations' ? 'selected' : '' }}>Operations</option>
                        </select>
                        @error('kategori_pekerjaan')
                            <div style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_pelamar_diinginkan">Jumlah Pelamar Diinginkan</label>
                        <input type="number" id="jumlah_pelamar_diinginkan" name="jumlah_pelamar_diinginkan" 
                               value="{{ old('jumlah_pelamar_diinginkan', '5') }}" placeholder="5" min="1" max="100" required
                               class="@error('jumlah_pelamar_diinginkan') is-invalid @enderror">
                        <div style="font-size: 11px; color: #6b7280; margin-top: 2px;">Minimal 1, maksimal 100 orang</div>
                        @error('jumlah_pelamar_diinginkan')
                            <div style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group full-width">
                    <label for="deskripsi_pekerjaan">Detail Pekerjaan</label>
                    <textarea id="deskripsi_pekerjaan" name="deskripsi_pekerjaan" rows="6" 
                              placeholder="Contoh:&#10;• Mengembangkan aplikasi web menggunakan Laravel&#10;• Berkolaborasi dengan tim frontend&#10;• Melakukan code review dan testing&#10;• Minimal 2 tahun pengalaman&#10;• Menguasai PHP, MySQL, Git" 
                              required class="@error('deskripsi_pekerjaan') is-invalid @enderror"
                              oninput="updateCharacterCount(this)">{{ old('deskripsi_pekerjaan') }}</textarea>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 4px;">
                        <div style="font-size: 11px; color: #6b7280;">Jelaskan tugas, tanggung jawab, dan kualifikasi yang dibutuhkan</div>
                        <div id="char-count" style="font-size: 11px; color: #6b7280;">0/1000</div>
                    </div>
                    @error('deskripsi_pekerjaan')
                        <div style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeAddJobModal()">Batal</button>
                    <button type="submit" class="btn-save" id="submit-btn">
                        <span class="btn-text">Simpan</span>
                        <span class="btn-loading" style="display: none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite;">
                                <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                <path d="M9 12l2 2 4-4"></path>
                            </svg>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Job Modal -->
    <div id="editJobModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Lowongan</h2>
                <button type="button" class="close" onclick="closeEditJobModal()">&times;</button>
            </div>
            
            <form class="job-form" method="POST" action="" enctype="multipart/form-data" onsubmit="return validateJobForm(this)">
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
                
                <div class="form-group">
                    <label for="edit_judul_pekerjaan">Nama Pekerjaan</label>
                    <input type="text" id="edit_judul_pekerjaan" name="judul_pekerjaan" 
                           placeholder="Contoh: Senior Software Engineer Backend" required
                           oninput="validateJobTitle(this, 'edit')">
                    <div id="edit-word-count-feedback" style="font-size: 12px; margin-top: 4px; color: #6b7280;">Harus 3-4 kata</div>
                </div>
                
                <div class="form-group">
                    <label for="edit_lokasi_pekerjaan">Lokasi</label>
                    <select id="edit_lokasi_pekerjaan" name="lokasi_pekerjaan" required>
                        <option value="">Pilih Lokasi</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Bandung">Bandung</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Medan">Medan</option>
                        <option value="remote">Remote</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="edit_gaji_pekerjaan">Gaji</label>
                    <input type="text" id="edit_gaji_pekerjaan" name="gaji_pekerjaan" placeholder="Rp 5.000.000" required>
                </div>
                
                <div class="form-group">
                    <label for="edit_kategori_pekerjaan">Kategori</label>
                    <select id="edit_kategori_pekerjaan" name="kategori_pekerjaan" required>
                        <option value="">Pilih Kategori</option>
                        <option value="technology">Technology</option>
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                        <option value="finance">Finance</option>
                        <option value="hr">Human Resources</option>
                    </select>
                </div>
                
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="edit_jumlah_pelamar_diinginkan">Jumlah Pelamar</label>
                        <input type="number" id="edit_jumlah_pelamar_diinginkan" name="jumlah_pelamar_diinginkan" 
                               placeholder="5" min="1" max="100" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select id="edit_status" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="tutup">Tutup</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div style="display: flex; align-items: center; height: 100%; color: #6b7280; font-size: 13px;">
                            <span id="char-count">0 karakter</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group full-width">
                    <label for="edit_deskripsi_pekerjaan">Detail Pekerjaan</label>
                    <textarea id="edit_deskripsi_pekerjaan" name="deskripsi_pekerjaan" rows="6" 
                              placeholder="Masukkan detail pekerjaan..." required 
                              oninput="updateCharCount(this, 'char-count')"></textarea>
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
        <div class="modal-content close-job-modal">
            <div class="modal-header">
                <h2 class="modal-title">Konfirmasi Tutup Lowongan</h2>
                <button type="button" class="close" onclick="closeCloseJobModal()">&times;</button>
            </div>
            
            <div class="close-confirmation-content">
                <div class="close-warning">
                    <div class="warning-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h3>Yakin ingin menutup lowongan ini?</h3>
                    <div class="job-title-to-close" id="jobTitleToClose"></div>
                    
                    <div class="close-info-box">
                        <div class="info-item">
                            <i class="bi bi-archive-fill"></i>
                            <span>Dipindahkan ke riwayat</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-eye-slash-fill"></i>
                            <span>Tidak muncul di pencarian</span>
                        </div>
                    </div>
                </div>
                
                <div class="close-actions">
                    <button type="button" class="btn-cancel" onclick="closeCloseJobModal()">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </button>
                    <form id="closeJobForm" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="tutup">
                        <button type="submit" class="btn-close">
                            <i class="bi bi-lock-fill"></i>
                            Tutup Lowongan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
        // Filter Jobs Function
        function filterJobs(status) {
            const jobCards = document.querySelectorAll('.job-card');
            const filterTabs = document.querySelectorAll('.tab-item');
            
            // Update active tab
            filterTabs.forEach(tab => {
                tab.classList.remove('active');
                if (tab.getAttribute('data-filter') === status) {
                    tab.classList.add('active');
                }
            });
            
            // Filter job cards
            jobCards.forEach(card => {
                if (status === 'all') {
                    card.style.display = 'block';
                } else {
                    const cardStatus = card.getAttribute('data-status');
                    if (cardStatus === status) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
            
            // Check if no jobs are visible
            const visibleCards = document.querySelectorAll('.job-card[style="display: block"], .job-card:not([style*="display: none"])');
            const noJobsMessage = document.querySelector('.no-jobs');
            
            if (visibleCards.length === 0 && !noJobsMessage) {
                const jobCardsContainer = document.querySelector('.job-cards');
                const tempMessage = document.createElement('div');
                tempMessage.className = 'no-jobs temp-message';
                tempMessage.innerHTML = '<p>Tidak ada pekerjaan dengan status ' + (status === 'aktif' ? 'aktif' : status === 'tutup' ? 'tutup' : '') + '</p>';
                jobCardsContainer.appendChild(tempMessage);
            } else if (visibleCards.length > 0) {
                const tempMessage = document.querySelector('.temp-message');
                if (tempMessage) {
                    tempMessage.remove();
                }
            }
        }

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
            console.log('openAddJobModal called'); // Debug log
            const modal = document.getElementById('addJobModal');
            if (modal) {
                console.log('Modal found, opening...'); // Debug log
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
                
                // Reset validation feedback
                const feedback = document.getElementById('word-count-feedback');
                if (feedback) {
                    feedback.textContent = 'Harus 3-4 kata';
                    feedback.style.color = '#6b7280';
                }
                const input = document.getElementById('judul_pekerjaan');
                if (input) {
                    input.style.borderColor = '#e5e7eb';
                }
                
                // Reset form
                const form = modal.querySelector('form');
                if (form) {
                    form.reset();
                    // Reset character count
                    const textarea = form.querySelector('#deskripsi_pekerjaan');
                    if (textarea) {
                        updateCharacterCount(textarea);
                    }
                }
            } else {
                console.error('Add job modal not found!'); // Debug log
            }
        }
        
        function closeAddJobModal() {
            const modal = document.getElementById('addJobModal');
            if (modal) {
                modal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        }
        
        function openEditJobModal(id, judul, lokasi, gaji, kategori, deskripsi, status, jumlahPelamar) {
            console.log('Edit modal data:', { id, judul, lokasi, gaji, kategori, deskripsi, status, jumlahPelamar });
            
            // Set form action
            const form = document.querySelector('#editJobModal .job-form');
            form.action = `/pekerjaan/${id}`;
            
            // Populate form fields
            document.getElementById('edit_judul_pekerjaan').value = judul;
            document.getElementById('edit_lokasi_pekerjaan').value = lokasi;
            document.getElementById('edit_gaji_pekerjaan').value = gaji;
            document.getElementById('edit_kategori_pekerjaan').value = kategori;
            document.getElementById('edit_jumlah_pelamar_diinginkan').value = jumlahPelamar;
            document.getElementById('edit_deskripsi_pekerjaan').value = deskripsi;
            document.getElementById('edit_status').value = status;
            
            // Debug: Check if lokasi value exists in select options
            const lokasiSelect = document.getElementById('edit_lokasi_pekerjaan');
            const lokasiOptions = Array.from(lokasiSelect.options).map(opt => opt.value);
            console.log('Available lokasi options:', lokasiOptions);
            console.log('Trying to set lokasi to:', lokasi);
            console.log('Lokasi found in options:', lokasiOptions.includes(lokasi));
            
            // Show modal
            const modal = document.getElementById('editJobModal');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
            
            // Update character count
            updateCharCount(document.getElementById('edit_deskripsi_pekerjaan'), 'char-count');
            
            // Close action dropdown
            const dropdowns = document.querySelectorAll('.action-dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
        
        function closeEditJobModal() {
            const modal = document.getElementById('editJobModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
        
                function openDetailJobModal(id, judul, kategori, deskripsi, status, created_at, applicantCount, lokasi, gaji) {
            console.log('openDetailJobModal called with:', { id, judul, kategori, deskripsi, status, created_at, applicantCount, lokasi, gaji });
            
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
            
            // Map category display names
            const categoryMap = {
                'technology': 'Technology',
                'design': 'Design',
                'marketing': 'Marketing',
                'finance': 'Finance',
                'hr': 'Human Resources'
            };
            const kategoriText = categoryMap[kategori] || (kategori ? kategori.charAt(0).toUpperCase() + kategori.slice(1) : 'Tidak ada kategori');
            document.getElementById('view_kategori_pekerjaan').innerHTML = `${kategoriIcon} ${kategoriText}`;
            
            // Set tanggal with icon
            document.getElementById('view_created_at').innerHTML = `📅 ${created_at || 'Tidak ada tanggal'}`;
            
            // Set jumlah pelamar
            document.getElementById('view_applicant_count').innerHTML = `👥 ${applicantCount || 0} pelamar`;
            
            // Set status badge with icon
            let statusIcon = '';
            switch(status) {
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
            const requiredFields = ['judul_pekerjaan', 'lokasi_pekerjaan', 'gaji_pekerjaan', 'kategori_pekerjaan', 'jumlah_pelamar_diinginkan'];
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
            
            // Validate job title word count (must be 3-4 words) and auto-append category if only 2 words
            let titleInput = document.getElementById('judul_pekerjaan');
            let judulPekerjaan = titleInput.value.trim();
            let words = judulPekerjaan.split(/\s+/).filter(w => w.length > 0);
            let wordCount = words.length;

            if (wordCount === 2) {
                const kategoriSelect = document.getElementById('kategori_pekerjaan');
                const kategoriText = kategoriSelect && kategoriSelect.selectedIndex > 0
                    ? kategoriSelect.options[kategoriSelect.selectedIndex].text.trim()
                    : '';
                if (kategoriText) {
                    judulPekerjaan = judulPekerjaan + ' ' + kategoriText;
                    titleInput.value = judulPekerjaan;
                    words = judulPekerjaan.split(/\s+/).filter(w => w.length > 0);
                    wordCount = words.length;
                }
            }

            if (wordCount < 3 || wordCount > 4) {
                e.preventDefault();
                showToast('Judul pekerjaan harus terdiri dari 3-4 kata', 'error');
                return;
            }
            
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
            const requiredFields = ['judul_pekerjaan', 'lokasi_pekerjaan', 'gaji_pekerjaan', 'kategori_pekerjaan', 'jumlah_pelamar_diinginkan', 'status'];
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
            
            // Validate job title word count (must be 3-4 words) and auto-append category if only 2 words
            let titleInput = this.querySelector('[name="judul_pekerjaan"]');
            let judulPekerjaan = titleInput.value.trim();
            let words = judulPekerjaan.split(/\s+/).filter(w => w.length > 0);
            let wordCount = words.length;

            if (wordCount === 2) {
                const kategoriSelect = document.getElementById('edit_kategori_pekerjaan');
                const kategoriText = kategoriSelect && kategoriSelect.selectedIndex > 0
                    ? kategoriSelect.options[kategoriSelect.selectedIndex].text.trim()
                    : '';
                if (kategoriText) {
                    judulPekerjaan = judulPekerjaan + ' ' + kategoriText;
                    titleInput.value = judulPekerjaan;
                    words = judulPekerjaan.split(/\s+/).filter(w => w.length > 0);
                    wordCount = words.length;
                }
            }

            if (wordCount < 3 || wordCount > 4) {
                e.preventDefault();
                showToast('Judul pekerjaan harus terdiri dari 3-4 kata', 'error');
                return;
            }
            
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
            e.preventDefault(); // Prevent default form submission
            console.log('Close form submitted');
            
            // Get job ID from form action
            const formAction = this.action;
            const jobId = formAction.split('/').pop();
            
            console.log('Form action:', formAction);
            console.log('Job ID:', jobId);
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menutup...';
            submitBtn.disabled = true;
            
            // Show loading toast
            showToast('Menutup lowongan...', 'info');
            
            // Prepare form data
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                             document.querySelector('input[name="_token"]')?.value;
            
            console.log('CSRF Token:', csrfToken);
            console.log('Form data:', Object.fromEntries(formData));
            
            // Submit form via fetch
            fetch(formAction, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(async response => {
                console.log('Response status:', response.status);
                console.log('Response ok:', response.ok);
                
                const responseText = await response.text();
                console.log('Response text:', responseText);
                
                if (response.ok || response.status === 302) {
                    // Success - remove job from active list
                    const jobCard = document.querySelector(`[data-job-id="${jobId}"]`);
                    console.log('Job card found:', jobCard);
                    
                    if (jobCard) {
                        // Add fade out animation
                        jobCard.style.transition = 'all 0.5s ease';
                        jobCard.style.opacity = '0';
                        jobCard.style.transform = 'translateX(-20px)';
                        
                        setTimeout(() => {
                            jobCard.remove();
                            
                            // Check if no jobs left
                            const remainingJobs = document.querySelectorAll('.job-card');
                            if (remainingJobs.length === 0) {
                                const jobCards = document.querySelector('.job-cards');
                                jobCards.innerHTML = `
                                    <div style="text-align: center; padding: 40px; color: #6b7280;">
                                        <div style="font-size: 48px; margin-bottom: 16px;">📋</div>
                                        <h3 style="margin: 0 0 8px 0; color: #374151;">Tidak Ada Pekerjaan Aktif</h3>
                                        <p style="margin: 0; font-size: 14px;">Semua pekerjaan telah ditutup atau belum ada yang dibuat.</p>
                                    </div>
                                `;
                            }
                        }, 500);
                    }
                    
                    // Close modal
                    closeCloseJobModal();
                    
                    // Show success message
                    showToast('Lowongan berhasil ditutup dan dipindahkan ke riwayat!', 'success');
                    
                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                } else {
                    throw new Error(`Server error: ${response.status} - ${responseText}`);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Gagal menutup lowongan. Silakan coba lagi.', 'error');
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
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

        // Function to validate job title in real-time
        function validateJobTitle(input, prefix = '') {
            const value = input.value.trim();
            const words = value.split(/\s+/).filter(word => word.length > 0);
            const wordCount = words.length;
            
            const feedbackId = prefix ? `${prefix}-word-count-feedback` : 'word-count-feedback';
            const feedback = document.getElementById(feedbackId);
            
            if (!feedback) return;
            
            if (wordCount === 0) {
                feedback.textContent = 'Harus 3-4 kata';
                feedback.style.color = '#6b7280';
                input.style.borderColor = '#e5e7eb';
            } else if (wordCount < 3) {
                feedback.textContent = `${wordCount} kata (perlu ${3 - wordCount} kata lagi)`;
                feedback.style.color = '#f59e0b';
                input.style.borderColor = '#f59e0b';
            } else if (wordCount <= 4) {
                feedback.textContent = `${wordCount} kata ✓`;
                feedback.style.color = '#10b981';
                input.style.borderColor = '#10b981';
            } else {
                feedback.textContent = `Maksimal 4 kata (kelebihan ${wordCount - 4})`;
                feedback.style.color = '#dc2626';
                input.style.borderColor = '#dc2626';
            }
        }

        // Function to format salary input
        function formatSalaryInput(input) {
            let value = input.value;
            
            // Remove all non-digit characters except Rp, spaces, dots, and dashes
            value = value.replace(/[^\d\sRp.-]/g, '');
            
            // Basic validation for salary format
            if (value.length > 0) {
                // Check if it starts with Rp
                if (!value.startsWith('Rp')) {
                    if (/^\d/.test(value)) {
                        value = 'Rp ' + value;
                    }
                }
                
                input.style.borderColor = '#10b981';
            } else {
                input.style.borderColor = '#e5e7eb';
            }
            
            input.value = value;
        }

        // Function to update character count for textarea
        function updateCharacterCount(textarea) {
            const maxLength = 1000;
            const currentLength = textarea.value.length;
            const counter = document.getElementById('char-count');
            
            if (counter) {
                counter.textContent = `${currentLength}/${maxLength}`;
                
                if (currentLength > maxLength * 0.9) {
                    counter.style.color = '#f59e0b';
                } else if (currentLength > maxLength) {
                    counter.style.color = '#dc2626';
                    textarea.style.borderColor = '#dc2626';
                } else {
                    counter.style.color = '#6b7280';
                    textarea.style.borderColor = '#e5e7eb';
                }
            }
        }

        // Function to validate select dropdown
        function validateSelect(select) {
            if (select.value !== '') {
                select.style.borderColor = '#10b981';
                select.style.color = '#374151';
            } else {
                select.style.borderColor = '#e5e7eb';
                select.style.color = '#9ca3af';
            }
        }

        // Function to validate job form before submission
        function validateJobForm(form) {
            let isValid = true;
            let errorMessages = [];

            // Validate job title (3-4 words)
            const jobTitle = form.querySelector('#judul_pekerjaan').value.trim();
            const words = jobTitle.split(/\s+/).filter(word => word.length > 0);
            if (words.length < 3 || words.length > 4) {
                isValid = false;
                errorMessages.push('Judul pekerjaan harus terdiri dari 3-4 kata');
            }

            // Validate salary format
            const salary = form.querySelector('#gaji_pekerjaan').value.trim();
            if (!salary.startsWith('Rp') || salary.length < 5) {
                isValid = false;
                errorMessages.push('Format gaji tidak valid (contoh: Rp 5.000.000)');
            }

            // Validate applicant count
            const applicantCount = parseInt(form.querySelector('#jumlah_pelamar_diinginkan').value);
            if (applicantCount < 1 || applicantCount > 100) {
                isValid = false;
                errorMessages.push('Jumlah pelamar harus antara 1-100 orang');
            }

            // Validate description length
            const description = form.querySelector('#deskripsi_pekerjaan').value.trim();
            if (description.length < 50) {
                isValid = false;
                errorMessages.push('Deskripsi pekerjaan minimal 50 karakter');
            } else if (description.length > 1000) {
                isValid = false;
                errorMessages.push('Deskripsi pekerjaan maksimal 1000 karakter');
            }

            // Show errors if any
            if (!isValid) {
                showToast('Mohon perbaiki kesalahan pada form', 'error');
                
                // Create and show error modal instead of alert
                const errorModal = document.createElement('div');
                errorModal.className = 'modal-overlay';
                errorModal.style.display = 'flex';
                errorModal.innerHTML = `
                    <div class="modal-content" style="max-width: 400px;">
                        <div class="modal-header">
                            <h3 style="color: #dc2626; margin: 0;">⚠️ Kesalahan Form</h3>
                            <button type="button" class="close" onclick="this.closest('.modal-overlay').remove()">&times;</button>
                        </div>
                        <div style="padding: 16px 0;">
                            <p style="margin-bottom: 12px; color: #374151;">Mohon perbaiki kesalahan berikut:</p>
                            <ul style="margin: 0; padding-left: 20px; color: #dc2626;">
                                ${errorMessages.map(msg => `<li style="margin-bottom: 4px;">${msg}</li>`).join('')}
                            </ul>
                        </div>
                        <div style="text-align: right; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                            <button type="button" class="btn-cancel" onclick="this.closest('.modal-overlay').remove()">Tutup</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(errorModal);
                
                return false;
            }

            // Show loading state
            const submitBtn = form.querySelector('#submit-btn');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.querySelector('.btn-text').style.display = 'none';
                submitBtn.querySelector('.btn-loading').style.display = 'flex';
            }

            return true;
        }

        // Duplicate function removed - using the main openAddJobModal function above

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('.modal-overlay.show');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.classList.remove('show');
                    document.body.style.overflow = 'auto';
                }
            });
        });

        // Show toast on page load if there are session messages
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    showToast('{{ session('success') }}', 'success');
                }, 500);
            });
        @endif

        @if (session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    showToast('{{ session('error') }}', 'error');
                }, 500);
            });
        @endif
        
        // Job History Modal Functions
        function openJobHistoryModal() {
            const modal = document.getElementById('jobHistoryModal');
            if (modal) {
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
                loadJobHistory();
            }
        }

        function closeJobHistoryModal() {
            const modal = document.getElementById('jobHistoryModal');
            if (modal) {
                modal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        }

        // Store loaded job history data globally
        var loadedJobHistoryData = [];

        function loadJobHistory() {
            const historyContainer = document.getElementById('historyJobCards');
            if (!historyContainer) return;

            // Show loading state
            historyContainer.innerHTML = '<div style="text-align: center; padding: 40px; color: #6b7280;">Memuat riwayat pekerjaan yang sudah tutup...</div>';

            // Fetch real data from API
            fetch('/api/job-history')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('API Response:', data);
                    
                    if (data.success && data.data && data.data.length > 0) {
                        // Use real data from API
                        const jobsWithDates = data.data.map(job => ({
                            ...job,
                            created_at: new Date(job.created_at),
                            closed_at: new Date(job.closed_at)
                        }));
                        
                        loadedJobHistoryData = jobsWithDates;
                        renderJobHistory(jobsWithDates);
                        console.log('Using real data from API');
                    } else {
                        // Show empty state message
                        showEmptyJobHistory();
                    }
                })
                .catch(error => {
                    console.error('Error loading job history from API:', error);
                    
                    // Show error message
                    historyContainer.innerHTML = `
                        <div style="text-align: center; padding: 60px 20px; color: #6b7280;">
                            <div style="font-size: 48px; margin-bottom: 16px;">⚠️</div>
                            <h3 style="margin: 0 0 8px 0; color: #374151; font-size: 18px;">Terjadi Kesalahan</h3>
                            <p style="margin: 0 0 20px 0; color: #6b7280; font-size: 14px;">
                                Tidak dapat memuat riwayat pekerjaan. Silakan coba lagi.
                            </p>
                            <button onclick="loadJobHistory()" style="
                                background: #3b82f6; 
                                color: white; 
                                border: none; 
                                padding: 10px 20px; 
                                border-radius: 6px; 
                                cursor: pointer;
                                font-size: 14px;
                            ">
                                Coba Lagi
                            </button>
                        </div>
                    `;
                });
        }

        function showEmptyJobHistory() {
            const historyContainer = document.getElementById('historyJobCards');
            if (!historyContainer) return;
            
            console.log('No job history data available');
            
            historyContainer.innerHTML = `
                <div style="text-align: center; padding: 60px 20px; color: #6b7280;">
                    <div style="font-size: 48px; margin-bottom: 16px;">📋</div>
                    <h3 style="margin: 0 0 8px 0; color: #374151; font-size: 18px;">Belum Memiliki Riwayat Pekerjaan</h3>
                    <p style="margin: 0; color: #6b7280; font-size: 14px;">
                        Anda belum memiliki pekerjaan yang sudah tutup. Riwayat akan muncul setelah Anda menutup pekerjaan.
                    </p>
                </div>
            `;
            
            // Clear global data
            loadedJobHistoryData = [];
        }

        function renderJobHistory(jobs) {
            const historyContainer = document.getElementById('historyJobCards');
            if (!historyContainer) return;

            const categoryMap = {
                'technology': 'Technology',
                'design': 'Design',
                'marketing': 'Marketing',
                'finance': 'Finance',
                'hr': 'Human Resources'
            };

            if (jobs.length === 0) {
                historyContainer.innerHTML = '<div style="text-align: center; padding: 40px; color: #6b7280;">Belum ada pekerjaan yang sudah tutup</div>';
                return;
            }

            const jobCards = jobs.map(job => {
                const displayCategory = categoryMap[job.kategori_pekerjaan] || job.kategori_pekerjaan.charAt(0).toUpperCase() + job.kategori_pekerjaan.slice(1);
                const formattedDate = job.created_at.toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'short', 
                    year: 'numeric' 
                });
                const avatar = job.judul_pekerjaan.substring(0, 2).toUpperCase();

                return `
                    <div class="history-job-card" onclick="showJobDetails(${job.id_pekerjaan})" data-status="${job.status}">
                        <div class="history-job-card-content">
                            <div class="history-job-info">
                                <div class="history-job-avatar">${avatar}</div>
                                <div class="history-job-details">
                                    <h4>${job.judul_pekerjaan}</h4>
                                    <p>ID: #${job.id_pekerjaan}</p>
                                </div>
                            </div>
                            <div class="history-job-position">${displayCategory}</div>
                            <div class="history-applicant-count">${job.pelamars_count}/${job.jumlah_pelamar_diinginkan}</div>
                            <div class="history-accepted-count" title="Pelamar yang diterima">${job.pelamars_accepted_count || 0}</div>
                            <div class="history-posting-date">${formattedDate}</div>
                            <div class="history-job-status">
                                <div class="history-status-dot ${job.status}"></div>
                                <span class="history-status-text ${job.status}">${job.status.charAt(0).toUpperCase() + job.status.slice(1)}</span>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            historyContainer.innerHTML = jobCards;
        }

        function showJobDetails(jobId) {
            // Find the job data from loaded history data
            const job = loadedJobHistoryData.find(j => j.id_pekerjaan === jobId);

            if (!job) {
                alert('Data pekerjaan tidak ditemukan');
                return;
            }

            // Create modal for job details
            const modal = document.createElement('div');
            modal.className = 'modal-overlay show';
            modal.innerHTML = `
                <div class="modal-content" style="max-width: 600px;">
                    <div class="modal-header">
                        <h2 class="modal-title">${job.judul_pekerjaan} - Pelamar Diterima</h2>
                        <button class="close" onclick="this.closest('.modal-overlay').remove()">&times;</button>
                    </div>
                    <div style="padding: 0;">
                        <div style="margin-bottom: 20px; padding: 16px; background: #f8fafc; border-radius: 8px;">
                            <h3 style="margin: 0 0 8px 0; font-size: 16px; color: #374151;">Ringkasan Pekerjaan</h3>
                            <p style="margin: 0; color: #6b7280; font-size: 14px;">
                                Total Pelamar: <strong>${job.pelamars_count}</strong> | 
                                Target: <strong>${job.jumlah_pelamar_diinginkan}</strong> | 
                                Diterima: <strong style="color: #059669;">${job.pelamars_accepted_count}</strong>
                            </p>
                        </div>
                        
                        <h3 style="margin: 0 0 16px 0; font-size: 16px; color: #374151;">Pelamar yang Diterima (${job.pelamars_accepted_count})</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            ${job.accepted_applicants.map((applicant, index) => `
                                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #059669 0%, #047857 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px;">
                                        ${applicant.name.split(' ').map(n => n[0]).join('').substring(0, 2)}
                                    </div>
                                    <div style="flex: 1;">
                                        <h4 style="margin: 0 0 4px 0; font-size: 14px; font-weight: 600; color: #111827;">${applicant.name}</h4>
                                        <p style="margin: 0; font-size: 12px; color: #6b7280;">${applicant.position}</p>
                                    </div>
                                    <div style="background: #d1fae5; color: #059669; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">
                                        ✓ Diterima
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                        
                        <div style="text-align: center; margin-top: 24px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                            <button type="button" class="btn-cancel" onclick="this.closest('.modal-overlay').remove()">Tutup</button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';
        }

        // Debug: Check if all modals exist on page load
        document.addEventListener('DOMContentLoaded', function() {
            const modals = {
                'addJobModal': document.getElementById('addJobModal'),
                'editJobModal': document.getElementById('editJobModal'),
                'detailJobModal': document.getElementById('detailJobModal'),
                'closeJobModal': document.getElementById('closeJobModal'),
                'jobHistoryModal': document.getElementById('jobHistoryModal')
            };
            
            console.log('Modal check on page load:', modals);
            
            Object.keys(modals).forEach(modalName => {
                if (!modals[modalName]) {
                    console.error(`Modal ${modalName} not found!`);
                } else {
                    console.log(`Modal ${modalName} found successfully`);
                }
            });

            // Initialize character count for existing content
            const textarea = document.getElementById('deskripsi_pekerjaan');
            if (textarea) {
                updateCharacterCount(textarea);
            }

            // Add keyboard shortcuts
            document.addEventListener('keydown', function(event) {
                // ESC to close modals
                if (event.key === 'Escape') {
                    const openModals = document.querySelectorAll('.modal-overlay.show');
                    openModals.forEach(modal => {
                        modal.classList.remove('show');
                        document.body.style.overflow = 'auto';
                    });
                }
                
                // Ctrl+N to open add job modal
                if (event.ctrlKey && event.key === 'n') {
                    event.preventDefault();
                    openAddJobModal();
                }
            });
        });
    </script>
@endpush