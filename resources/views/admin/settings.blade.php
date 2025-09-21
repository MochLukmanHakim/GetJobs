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
        <h2 class="text-2xl font-semibold mb-6">Settings Log</h2>
        <div class="card p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Recent Settings Changes</h3>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Admin</th>
                            <th>Setting Changed</th>
                            <th>Old Value</th>
                            <th>New Value</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-06-20 14:22</td>
                            <td>John Doe</td>
                            <td>Email Notifications</td>
                            <td>Enabled</td>
                            <td>Disabled</td>
                            <td>Turned off for maintenance</td>
                        </tr>
                        <tr>
                            <td>2024-06-18 09:10</td>
                            <td>Jane Smith</td>
                            <td>User Registration</td>
                            <td>Disabled</td>
                            <td>Enabled</td>
                            <td>Open registration for new users</td>
                        </tr>
                        <tr>
                            <td>2024-06-15 17:45</td>
                            <td>Admin</td>
                            <td>Password Policy</td>
                            <td>Standard</td>
                            <td>Strong</td>
                            <td>Security improvement</td>
                        </tr>
                        <tr>
                            <td>2024-06-12 11:30</td>
                            <td>Mike Chen</td>
                            <td>Session Timeout</td>
                            <td>1 hour</td>
                            <td>30 minutes</td>
                            <td>Compliance update</td>
                        </tr>
                        <tr>
                            <td>2024-06-10 08:05</td>
                            <td>Lisa Chang</td>
                            <td>Auto-approve Job Posts</td>
                            <td>Enabled</td>
                            <td>Disabled</td>
                            <td>Manual review required</td>
                        </tr>
                    </tbody>
                </table>
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