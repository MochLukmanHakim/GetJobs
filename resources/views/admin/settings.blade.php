<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - GetJobs Admin Analytics</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&display=swap');

        :root {
            /* Primary Colors */
            --color-primary: #2563eb;
            --color-primary-50: #eff6ff;
            --color-primary-100: #dbeafe;
            --color-primary-700: #1d4ed8;
            
            /* Secondary Colors */
            --color-secondary: #1e40af;
            --color-secondary-50: #eff6ff;
            
            /* Accent Colors */
            --color-accent: #059669;
            --color-accent-50: #ecfdf5;
            --color-accent-100: #d1fae5;
            
            /* Background Colors */
            --color-background: #f8fafc;
            --color-surface: #ffffff;
            
            /* Text Colors */
            --color-text-primary: #1e293b;
            --color-text-secondary: #64748b;
            
            /* Status Colors */
            --color-success: #047857;
            --color-warning: #d97706;
            --color-error: #dc2626;
            
            /* Border Colors */
            --color-border: #e2e8f0;
            --color-border-light: #f1f5f9;
            
            /* Shadow Colors */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            
            /* Animation Timing */
            --transition-fast: 150ms ease-out;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-background);
            color: var(--color-text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .card {
            background-color: var(--color-surface);
            border-radius: 0.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-border-light);
            transition: all var(--transition-fast);
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all var(--transition-fast);
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background-color: var(--color-primary-700);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--color-text-secondary);
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all var(--transition-fast);
            border: 1px solid var(--color-border);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background-color: var(--color-background);
            color: var(--color-text-primary);
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-success {
            background-color: var(--color-accent-100);
            color: var(--color-success);
        }

        .status-warning {
            background-color: #fef3c7;
            color: var(--color-warning);
        }

        .status-error {
            background-color: #fee2e2;
            color: var(--color-error);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--color-surface);
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .data-table th {
            background-color: var(--color-background);
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--color-text-primary);
            border-bottom: 1px solid var(--color-border);
        }

        .data-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--color-border-light);
            color: var(--color-text-primary);
        }

        .data-table tr:hover {
            background-color: var(--color-background);
            transition: background-color var(--transition-fast);
        }

        /* Layout Classes */
        .container {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .grid {
            display: grid;
            gap: 1.5rem;
        }

        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }

        @media (min-width: 768px) {
            .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }

        @media (min-width: 1024px) {
            .lg\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .lg\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
            .lg\:col-span-2 { grid-column: span 2 / span 2; }
            .lg\:col-span-3 { grid-column: span 3 / span 3; }
        }

        .flex {
            display: flex;
        }

        .items-center { align-items: center; }
        .items-start { align-items: flex-start; }
        .justify-between { justify-content: space-between; }
        .justify-center { justify-content: center; }
        .space-x-2 > * + * { margin-left: 0.5rem; }
        .space-x-3 > * + * { margin-left: 0.75rem; }
        .space-x-4 > * + * { margin-left: 1rem; }
        .space-y-2 > * + * { margin-top: 0.5rem; }
        .space-y-3 > * + * { margin-top: 0.75rem; }
        .space-y-4 > * + * { margin-top: 1rem; }

        .p-4 { padding: 1rem; }
        .p-6 { padding: 1.5rem; }
        .px-3 { padding-left: 0.75rem; padding-right: 0.75rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
        .py-8 { padding-top: 2rem; padding-bottom: 2rem; }

        .mb-2 { margin-bottom: 0.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-8 { margin-bottom: 2rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-4 { margin-top: 1rem; }
        .mr-2 { margin-right: 0.5rem; }
        .mr-3 { margin-right: 0.75rem; }

        .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
        .text-base { font-size: 1rem; line-height: 1.5rem; }
        .text-lg { font-size: 1.125rem; line-height: 1.75rem; }
        .text-xl { font-size: 1.25rem; line-height: 1.75rem; }
        .text-2xl { font-size: 1.5rem; line-height: 2rem; }
        .text-3xl { font-size: 1.875rem; line-height: 2.25rem; }
        .text-xs { font-size: 0.75rem; line-height: 1rem; }

        .font-medium { font-weight: 500; }
        .font-semibold { font-weight: 600; }
        .font-bold { font-weight: 700; }

        .text-primary { color: var(--color-primary); }
        .text-secondary { color: var(--color-text-secondary); }
        .text-success { color: var(--color-success); }
        .text-warning { color: var(--color-warning); }
        .text-error { color: var(--color-error); }

        .bg-primary { background-color: var(--color-primary); }
        .bg-primary-50 { background-color: var(--color-primary-50); }
        .bg-accent-50 { background-color: var(--color-accent-50); }
        .bg-white { background-color: white; }
        .bg-background { background-color: var(--color-background); }

        .border { border: 1px solid var(--color-border); }
        .border-b { border-bottom: 1px solid var(--color-border); }
        .border-primary { border-color: var(--color-primary); }
        .border-transparent { border-color: transparent; }

        .rounded { border-radius: 0.25rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .rounded-full { border-radius: 9999px; }

        .w-full { width: 100%; }
        .w-4 { width: 1rem; }
        .w-5 { width: 1.25rem; }
        .w-6 { width: 1.5rem; }
        .w-8 { width: 2rem; }
        .w-12 { width: 3rem; }
        .w-3 { width: 0.75rem; }
        .w-2 { width: 0.5rem; }

        .h-4 { height: 1rem; }
        .h-5 { height: 1.25rem; }
        .h-6 { height: 1.5rem; }
        .h-8 { height: 2rem; }
        .h-12 { height: 3rem; }
        .h-16 { height: 4rem; }
        .h-3 { height: 0.75rem; }
        .h-2 { height: 0.5rem; }

        .overflow-x-auto { overflow-x: auto; }
        .hidden { display: none; }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            50% { opacity: .5; }
        }

        /* Header Styles */
        .header {
            background-color: var(--color-surface);
            border-bottom: 1px solid var(--color-border);
            box-shadow: var(--shadow-sm);
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 4rem;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            width: 2rem;
            height: 2rem;
            color: var(--color-primary);
        }

        .title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--color-text-primary);
        }

        .subtitle {
            font-size: 0.875rem;
            color: var(--color-text-secondary);
        }

        .nav {
            background: white;
            padding: 0 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
            margin: 0;
            padding: 0;
        }

        .nav li a {
            display: block;
            padding: 15px 0;
            border-bottom: 2px solid transparent;
            text-decoration: none;
            color: black;
            transition: all 0.3s ease;
        }

        .nav li a.active {
            border-bottom-color: #4285f4;
            color: #4285f4;
        }

        .nav li a:hover {
            color: #4285f4;
        }

        .select {
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--color-border);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            background-color: white;
            color: var(--color-text-primary);
        }

        .select:focus {
            outline: 2px solid var(--color-primary);
            outline-offset: 2px;
        }

        /* Custom scrollbar */
        .scroll-area {
            max-height: 20rem;
            overflow-y: auto;
        }

        .scroll-area::-webkit-scrollbar {
            width: 6px;
        }

        .scroll-area::-webkit-scrollbar-track {
            background: var(--color-background);
        }

        .scroll-area::-webkit-scrollbar-thumb {
            background: var(--color-border);
            border-radius: 3px;
        }

        .scroll-area::-webkit-scrollbar-thumb:hover {
            background: var(--color-text-secondary);
        }
    </style>
</head>
<body>
    <!-- Header Section -->
        <header class="header">
            <div class="container">
                <div class="header-content">
                    <div class="logo-section">
                        <svg class="logo" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        <div>
                            <h1 class="title">GetJobs Admin</h1>
                            <p class="subtitle">Job Management Dashboard</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    <!-- Navigation -->
    <nav class="nav">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.user-management') }}" class="{{ request()->routeIs('admin.user-management') ? 'active' : '' }}">User Management</a>
            </li>
            <li>
                <a href="{{ route('admin.job-management') }}" class="{{ request()->routeIs('admin.job-management') ? 'active' : '' }}">Job Management</a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">Settings</a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="container py-8">
        <!-- Admin KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-secondary">Total Users</p>
                        <p class="text-3xl font-bold" id="totalUsers">24,789</p>
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 text-success mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-success font-medium">+8.2%</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-primary-50 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Jobs -->
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-secondary">Active Jobs</p>
                        <p class="text-3xl font-bold" id="activeJobs">8,547</p>
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 text-success mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-success font-medium">+12.5%</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-accent-50 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" style="color: var(--color-accent)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-secondary">Pending Approvals</p>
                        <p class="text-3xl font-bold text-warning" id="pendingApprovals">127</p>
                        <p class="text-xs text-secondary">requires attention</p>
                        <div class="flex items-center mt-2">
                            <div class="w-2 h-2 bg-warning rounded-full animate-pulse mr-2"></div>
                            <span class="text-sm text-warning font-medium">Action Required</span>
                        </div>
                    </div>
                    <div class="w-12 h-12" style="background-color: #fef3c7" class="rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-secondary">System Health</p>
                        <p class="text-3xl font-bold text-success" id="systemHealth">98.7%</p>
                        <p class="text-xs text-secondary">uptime</p>
                        <div class="flex items-center mt-2">
                            <div class="w-2 h-2 bg-success rounded-full animate-pulse mr-2"></div>
                            <span class="text-sm text-success font-medium">Optimal</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-accent-50 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" style="color: var(--color-success)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Admin Area -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- User Management Panel -->
            <div class="lg:col-span-2">
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold">User Management</h3>
                            <p class="text-sm text-secondary">Manage user accounts and permissions</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="btn-secondary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                                </svg>
                                Filter
                            </button>
                            <button class="btn-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add User
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-medium">Sarah Johnson</td>
                                    <td>sarah@example.com</td>
                                    <td>Job Seeker</td>
                                    <td><span class="status-indicator status-success">Active</span></td>
                                    <td>2 hours ago</td>
                                    <td>
                                        <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium">Mike Chen</td>
                                    <td>mike@techcorp.com</td>
                                    <td>Employer</td>
                                    <td><span class="status-indicator status-success">Active</span></td>
                                    <td>5 hours ago</td>
                                    <td>
                                        <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium">Emma Wilson</td>
                                    <td>emma@startup.io</td>
                                    <td>Recruiter</td>
                                    <td><span class="status-indicator status-warning">Pending</span></td>
                                    <td>1 day ago</td>
                                    <td>
                                        <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium">James Rodriguez</td>
                                    <td>james@freelance.com</td>
                                    <td>Job Seeker</td>
                                    <td><span class="status-indicator status-error">Suspended</span></td>
                                    <td>3 days ago</td>
                                    <td>
                                        <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium">Lisa Chang</td>
                                    <td>lisa@designstudio.com</td>
                                    <td>Employer</td>
                                    <td><span class="status-indicator status-success">Active</span></td>
                                    <td>6 hours ago</td>
                                    <td>
                                        <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Admin Actions Panel -->
            <div>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Admin Actions</h3>
                        <button class="text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="space-y-4">
                        <div class="p-3 bg-background rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium">System Maintenance</p>
                                    <p class="text-xs text-secondary">Schedule maintenance window</p>
                                </div>
                                <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Schedule</button>
                            </div>
                        </div>
                        
                        <div class="p-3 bg-background rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium">Bulk Notifications</p>
                                    <p class="text-xs text-secondary">Send system-wide messages</p>
                                </div>
                                <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Send</button>
                            </div>
                        </div>
                        
                        <div class="p-3 bg-background rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium">Data Export</p>
                                    <p class="text-xs text-secondary">Export platform analytics</p>
                                </div>
                                <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Export</button>
                            </div>
                        </div>
                        
                        <div class="p-3 bg-background rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium">Content Moderation</p>
                                    <p class="text-xs text-secondary">Review flagged content</p>
                                </div>
                                <button class="btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Review</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Monitoring & Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Recent Activity Log -->
            <div class="card p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Admin Activity</h3>
                <div class="scroll-area space-y-3">
                    <div class="flex items-start space-x-3 p-3 bg-background rounded-lg">
                        <div class="w-8 h-8 bg-primary-50 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium">User Account Updated</p>
                            <p class="text-xs text-secondary">Modified permissions for sarah@example.com</p>
                            <p class="text-xs text-secondary">5 minutes ago • Admin: John Doe</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3 p-3 bg-background rounded-lg">
                        <div class="w-8 h-8" style="background-color: #fee2e2" class="rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Content Flagged</p>
                            <p class="text-xs text-secondary">Job posting reported for inappropriate content</p>
                            <p class="text-xs text-secondary">12 minutes ago • System Alert</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3 p-3 bg-background rounded-lg">
                        <div class="w-8 h-8 bg-accent-50 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" style="color: var(--color-success)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Company Verified</p>
                            <p class="text-xs text-secondary">TechStartup Inc. completed verification process</p>
                            <p class="text-xs text-secondary">25 minutes ago • System Process</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3 p-3 bg-background rounded-lg">
                        <div class="w-8 h-8" style="background-color: #fef3c7" class="rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium">System Configuration</p>
                            <p class="text-xs text-secondary">Email notification settings updated</p>
                            <p class="text-xs text-secondary">1 hour ago • Admin: Jane Smith</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Platform Statistics -->
            <div class="card p-6">
                <h3 class="text-lg font-semibold mb-4">Platform Statistics</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-background rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-primary rounded-full"></div>
                            <span class="text-sm text-secondary">New Registrations Today</span>
                        </div>
                        <span class="text-lg font-bold">247</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-background rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3" style="background-color: var(--color-accent)" class="rounded-full"></div>
                            <span class="text-sm text-secondary">Jobs Posted This Week</span>
                        </div>
                        <span class="text-lg font-bold">1,834</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-background rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-warning rounded-full"></div>
                            <span class="text-sm text-secondary">Applications This Month</span>
                        </div>
                        <span class="text-lg font-bold">12,547</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-background rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-success rounded-full"></div>
                            <span class="text-sm text-secondary">Successful Placements</span>
                        </div>
                        <span class="text-lg font-bold">892</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-background rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3" style="background-color: var(--color-secondary)" class="rounded-full"></div>
                            <span class="text-sm text-secondary">Revenue This Month</span>
                        </div>
                        <span class="text-lg font-bold">$84,329</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Management Section -->
        <div class="card mb-8">
            <div class="border-b" style="border-color: var(--color-border)">
                <div class="px-6">
                    <div class="flex space-x-8">
                        <button class="border-b-2 border-primary text-primary py-4 px-1 text-sm font-medium" id="contentTab">
                            Content Management
                        </button>
                        <button class="border-b-2 border-transparent text-secondary py-4 px-1 text-sm font-medium" id="reportsTab">
                            Reports & Analytics
                        </button>
                        <button class="border-b-2 border-transparent text-secondary py-4 px-1 text-sm font-medium" id="settingsTab">
                            System Settings
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Management Tab -->
            <div class="p-6" id="contentContent">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Flagged Content Review</h4>
                        <div class="overflow-x-auto">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Reporter</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-medium">Job Post</td>
                                        <td>user_3847</td>
                                        <td>Inappropriate content</td>
                                        <td><span class="status-indicator status-warning">Under Review</span></td>
                                        <td><button class="btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Review</button></td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Profile</td>
                                        <td>user_2905</td>
                                        <td>Fake information</td>
                                        <td><span class="status-indicator status-error">Resolved</span></td>
                                        <td><button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">View</button></td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Comment</td>
                                        <td>user_7291</td>
                                        <td>Harassment</td>
                                        <td><span class="status-indicator status-warning">Pending</span></td>
                                        <td><button class="btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Review</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Featured Content</h4>
                        <div class="space-y-3">
                            <div class="p-3 bg-background rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium">Senior Developer Position</p>
                                        <p class="text-xs text-secondary">TechCorp Inc. • Featured until Dec 15</p>
                                    </div>
                                    <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                                </div>
                            </div>
                            
                            <div class="p-3 bg-background rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium">Marketing Manager Role</p>
                                        <p class="text-xs text-secondary">StartupCo • Featured until Dec 20</p>
                                    </div>
                                    <button class="btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                                </div>
                            </div>
                            
                            <div class="p-3 bg-background rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium">Add New Featured Content</p>
                                        <p class="text-xs text-secondary">Promote jobs or companies</p>
                                    </div>
                                    <button class="btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports & Analytics Tab -->
            <div class="p-6 hidden" id="reportsContent">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <h4 class="text-lg font-semibold mb-4">Generate Reports</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-background rounded-lg">
                                <h5 class="font-medium mb-2">User Activity Report</h5>
                                <p class="text-sm text-secondary mb-3">Detailed user engagement metrics</p>
                                <button class="btn-primary w-full">Generate Report</button>
                            </div>
                            
                            <div class="p-4 bg-background rounded-lg">
                                <h5 class="font-medium mb-2">Financial Summary</h5>
                                <p class="text-sm text-secondary mb-3">Revenue and transaction analysis</p>
                                <button class="btn-primary w-full">Generate Report</button>
                            </div>
                            
                            <div class="p-4 bg-background rounded-lg">
                                <h5 class="font-medium mb-2">Job Performance Metrics</h5>
                                <p class="text-sm text-secondary mb-3">Job posting success rates</p>
                                <button class="btn-primary w-full">Generate Report</button>
                            </div>
                            
                            <div class="p-4 bg-background rounded-lg">
                                <h5 class="font-medium mb-2">Platform Health Report</h5>
                                <p class="text-sm text-secondary mb-3">System performance overview</p>
                                <button class="btn-primary w-full">Generate Report</button>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Recent Reports</h4>
                        <div class="space-y-3">
                            <div class="p-3 bg-background rounded-lg">
                                <p class="text-sm font-medium">Q4 User Report</p>
                                <p class="text-xs text-secondary">Generated 2 days ago</p>
                                <button class="btn-secondary mt-2" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Download</button>
                            </div>
                            
                            <div class="p-3 bg-background rounded-lg">
                                <p class="text-sm font-medium">Monthly Financial</p>
                                <p class="text-xs text-secondary">Generated 5 days ago</p>
                                <button class="btn-secondary mt-2" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Download</button>
                            </div>
                            
                            <div class="p-3 bg-background rounded-lg">
                                <p class="text-sm font-medium">Platform Analytics</p>
                                <p class="text-xs text-secondary">Generated 1 week ago</p>
                                <button class="btn-secondary mt-2" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Download</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Settings Tab -->
            <div class="p-6 hidden" id="settingsContent">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Platform Configuration</h4>
                        <div class="space-y-4">
                            <div class="p-4 bg-background rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium">User Registration</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                                <p class="text-xs text-secondary">Allow new users to register</p>
                            </div>
                            
                            <div class="p-4 bg-background rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium">Auto-approve Job Posts</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                                <p class="text-xs text-secondary">Automatically approve job postings</p>
                            </div>
                            
                            <div class="p-4 bg-background rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium">Email Notifications</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                                <p class="text-xs text-secondary">Send system email notifications</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Security Settings</h4>
                        <div class="space-y-4">
                            <div class="p-4 bg-background rounded-lg">
                                <p class="text-sm font-medium mb-2">Password Requirements</p>
                                <select class="w-full select">
                                    <option>Standard (8+ characters)</option>
                                    <option>Strong (12+ characters + symbols)</option>
                                    <option>Maximum (16+ characters + complexity)</option>
                                </select>
                            </div>
                            
                            <div class="p-4 bg-background rounded-lg">
                                <p class="text-sm font-medium mb-2">Session Timeout</p>
                                <select class="w-full select">
                                    <option>30 minutes</option>
                                    <option>1 hour</option>
                                    <option>4 hours</option>
                                    <option>24 hours</option>
                                </select>
                            </div>
                            
                            <div class="p-4 bg-background rounded-lg">
                                <p class="text-sm font-medium mb-2">Two-Factor Authentication</p>
                                <button class="btn-primary w-full">Configure 2FA</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Footer -->
        <div style="position: fixed; bottom: 1rem; right: 1rem;">
            <div class="flex items-center space-x-2 bg-white border rounded-lg px-3 py-2" style="border-color: var(--color-border); box-shadow: var(--shadow-md);">
                <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                <span class="text-xs text-secondary">Admin Session Active</span>
                <span class="text-xs text-secondary">•</span>
                <span class="text-xs text-secondary">Last sync: 30s ago</span>
            </div>
        </div>
    </main>

    <script>
        // Tab switching functionality
        const tabs = {
            content: { tab: 'contentTab', content: 'contentContent' },
            reports: { tab: 'reportsTab', content: 'reportsContent' },
            settings: { tab: 'settingsTab', content: 'settingsContent' }
        };

        function switchTab(activeTab) {
            Object.keys(tabs).forEach(key => {
                const tab = document.getElementById(tabs[key].tab);
                const content = document.getElementById(tabs[key].content);
                
                if (key === activeTab) {
                    tab.classList.add('border-primary', 'text-primary');
                    tab.classList.remove('border-transparent', 'text-secondary');
                    content.classList.remove('hidden');
                } else {
                    tab.classList.remove('border-primary', 'text-primary');
                    tab.classList.add('border-transparent', 'text-secondary');
                    content.classList.add('hidden');
                }
            });
        }

        // Add event listeners for tabs
        document.getElementById('contentTab').addEventListener('click', () => switchTab('content'));
        document.getElementById('reportsTab').addEventListener('click', () => switchTab('reports'));
        document.getElementById('settingsTab').addEventListener('click', () => switchTab('settings'));

        // Simulate real-time data updates
        function updateDashboardMetrics() {
            const metrics = {
                totalUsers: document.getElementById('totalUsers'),
                activeJobs: document.getElementById('activeJobs'),
                pendingApprovals: document.getElementById('pendingApprovals'),
                systemHealth: document.getElementById('systemHealth')
            };

            // Simulate small changes in metrics
            setInterval(() => {
                const currentUsers = parseInt(metrics.totalUsers.textContent.replace(',', ''));
                const newUsers = currentUsers + Math.floor(Math.random() * 10) - 5;
                metrics.totalUsers.textContent = newUsers.toLocaleString();

                const currentJobs = parseInt(metrics.activeJobs.textContent.replace(',', ''));
                const newJobs = currentJobs + Math.floor(Math.random() * 5) - 2;
                metrics.activeJobs.textContent = newJobs.toLocaleString();

                const currentApprovals = parseInt(metrics.pendingApprovals.textContent);
                const newApprovals = Math.max(0, currentApprovals + Math.floor(Math.random() * 3) - 1);
                metrics.pendingApprovals.textContent = newApprovals;

                // Keep system health stable
                const healthValues = ['98.5%', '98.7%', '98.9%', '99.1%'];
                metrics.systemHealth.textContent = healthValues[Math.floor(Math.random() * healthValues.length)];
            }, 10000); // Update every 10 seconds
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            updateDashboardMetrics();
        });
    </script>
</body>
</html>