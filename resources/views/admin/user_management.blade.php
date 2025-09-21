<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin GetJobs</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&display=swap');

        :root {
            --color-primary: #2563eb;
            --color-primary-50: #eff6ff;
            --color-primary-100: #dbeafe;
            --color-primary-700: #1d4ed8;
            --color-background: #f8fafc;
            --color-surface: #ffffff;
            --color-text-primary: #1e293b;
            --color-text-secondary: #64748b;
            --color-success: #047857;
            --color-warning: #d97706;
            --color-error: #dc2626;
            --color-border: #e2e8f0;
            --color-border-light: #f1f5f9;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-background);
            color: var(--color-text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header */
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

        /* Navigation */
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

        /* Main Content */
        .main {
            padding: 2rem 0;
        }

        .section {
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--color-text-primary);
        }

        /* Cards */
        .card {
            background-color: var(--color-surface);
            border-radius: 0.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-border-light);
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 150ms ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--color-primary-700);
        }

        .btn-secondary {
            background-color: var(--color-surface);
            color: var(--color-text-primary);
            border: 1px solid var(--color-border);
        }

        .btn-secondary:hover {
            background-color: var(--color-background);
        }

        .btn-danger {
            background-color: var(--color-error);
            color: white;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: var(--color-text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--color-border);
            border-radius: 0.375rem;
            font-size: 0.875rem;
            transition: border-color 150ms ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--color-border);
            border-radius: 0.375rem;
            background-color: var(--color-surface);
            font-size: 0.875rem;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            border-radius: 0.5rem;
            border: 1px solid var(--color-border-light);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--color-surface);
        }

        .table th {
            background-color: var(--color-background);
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--color-text-primary);
            border-bottom: 1px solid var(--color-border);
            font-size: 0.875rem;
        }

        .table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--color-border-light);
            color: var(--color-text-primary);
            font-size: 0.875rem;
        }

        .table tr:hover {
            background-color: var(--color-background);
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background-color: #d1fae5;
            color: var(--color-success);
        }

        .status-inactive {
            background-color: #fee2e2;
            color: var(--color-error);
        }

        .status-pending {
            background-color: #fef3c7;
            color: var(--color-warning);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: var(--color-surface);
            border-radius: 0.5rem;
            padding: 1.5rem;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .modal-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--color-text-primary);
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--color-text-secondary);
            padding: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-btn:hover {
            color: var(--color-text-primary);
        }

        /* Search and Filter */
        .search-filter {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 200px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        /* Grid Layout */
        .grid {
            display: grid;
            gap: 1.5rem;
        }

        .grid-cols-1 {
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .grid-cols-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Utilities */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .hidden { display: none; }
        .mt-4 { margin-top: 1rem; }
        .mb-4 { margin-bottom: 1rem; }
    </style>
</head>
<body>
    <!-- Header -->
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
    <main class="main">
        <div class="container">
            <!-- User Management Tab -->
            <div id="users-tab" class="tab-content">
                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">User Management Log</h2>
                    </div>

                    <div class="card">
                        <div class="search-filter">
                            <input type="text" class="form-input search-input" placeholder="Search users..." id="userSearch">
                            <select class="form-select" id="userStatusFilter">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>

                        <div class="table-container">
                            <table class="table" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Peran</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>001</td>
                                        <td>John Doe</td>
                                        <td>john.doe@email.com</td>
                                        <td>Job Seeker</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>2024-08-15</td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>Jane Smith</td>
                                        <td>jane.smith@email.com</td>
                                        <td>Employer</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>2024-08-10</td>
                                    </tr>
                                    <tr>
                                        <td>003</td>
                                        <td>Mike Johnson</td>
                                        <td>mike.johnson@email.com</td>
                                        <td>Job Seeker</td>
                                        <td><span class="status-badge status-pending">Pending</span></td>
                                        <td>2024-08-12</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Management Tab -->
            <div id="jobs-tab" class="tab-content hidden">
                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">Job Management</h2>
                        <button class="btn btn-primary" onclick="openModal('jobModal')">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Pekerjaan Baru
                        </button>
                    </div>

                    <div class="card">
                        <div class="search-filter">
                            <input type="text" class="form-input search-input" placeholder="Search jobs..." id="jobSearch">
                            <select class="form-select" id="jobCategoryFilter">
                                <option value="">All Categories</option>
                                <option value="engineering">Engineering</option>
                                <option value="marketing">Marketing</option>
                                <option value="sales">Sales</option>
                            </select>
                        </div>

                        <div class="table-container">
                            <table class="table" id="jobsTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Perusahaan</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Aplikasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>JOB001</td>
                                        <td>Senior Software Engineer</td>
                                        <td>TechCorp Inc.</td>
                                        <td>Engineering</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>24</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-secondary btn-sm" onclick="editJob(1)">Edit</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteJob(1)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>JOB002</td>
                                        <td>Marketing Manager</td>
                                        <td>InnovateLabs</td>
                                        <td>Marketing</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>18</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-secondary btn-sm" onclick="editJob(2)">Edit</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteJob(2)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Management Tab -->
            <div id="companies-tab" class="tab-content hidden">
                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">Company Management</h2>
                        <button class="btn btn-primary" onclick="openModal('companyModal')">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4"/>
                            </svg>
                            Add New Company
                        </button>
                    </div>

                    <div class="card">
                        <div class="search-filter">
                            <input type="text" class="form-input search-input" placeholder="Search companies..." id="companySearch">
                            <select class="form-select" id="companyTypeFilter">
                                <option value="">All Types</option>
                                <option value="startup">Startup</option>
                                <option value="enterprise">Enterprise</option>
                                <option value="midsize">Mid-size</option>
                            </select>
                        </div>

                        <div class="table-container">
                            <table class="table" id="companiesTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Industri</th>
                                        <th>Ukuran</th>
                                        <th>Pekerjaan Aktif</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>COMP001</td>
                                        <td>TechCorp Inc.</td>
                                        <td>Technology</td>
                                        <td>500-1000</td>
                                        <td>12</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-secondary btn-sm" onclick="editCompany(1)">Edit</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteCompany(1)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>COMP002</td>
                                        <td>InnovateLabs</td>
                                        <td>Technology</td>
                                        <td>50-100</td>
                                        <td>8</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-secondary btn-sm" onclick="editCompany(2)">Edit</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteCompany(2)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications Tab -->
            <div id="applications-tab" class="tab-content hidden">
                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">Application Management</h2>
                    </div>

                    <div class="card">
                        <div class="search-filter">
                            <input type="text" class="form-input search-input" placeholder="Search applications..." id="applicationSearch">
                            <select class="form-select" id="applicationStatusFilter">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="reviewed">Reviewed</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="table-container">
                            <table class="table" id="applicationsTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Peserta</th>
                                        <th>Judul Pekerjaan</th>
                                        <th>Perusahaan</th>
                                        <th>Tanggal Aplikasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>APP001</td>
                                        <td>Alice Brown</td>
                                        <td>Senior Software Engineer</td>
                                        <td>TechCorp Inc.</td>
                                        <td>2024-08-20</td>
                                        <td><span class="status-badge status-pending">Pending</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-secondary btn-sm" onclick="reviewApplication(1)">Review</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteApplication(1)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>APP002</td>
                                        <td>Bob Wilson</td>
                                        <td>Marketing Manager</td>
                                        <td>InnovateLabs</td>
                                        <td>2024-08-19</td>
                                        <td><span class="status-badge status-active">Reviewed</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-secondary btn-sm" onclick="reviewApplication(2)">Review</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteApplication(2)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Job Modal -->
    <div id="jobModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add/Edit Job</h3>
                <button class="close-btn" onclick="closeModal('jobModal')">&times;</button>
            </div>
            <form id="jobForm">
                <div class="form-group">
                    <label class="form-label">Job Title</label>
                    <input type="text" class="form-input" id="jobTitle" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Company</label>
                    <select class="form-select" id="jobCompany" required>
                        <option value="">Select Company</option>
                        <option value="techcorp">TechCorp Inc.</option>
                        <option value="innovatelabs">InnovateLabs</option>
                        <option value="datadriven">DataDriven Co.</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select class="form-select" id="jobCategory" required>
                        <option value="">Select Category</option>
                        <option value="engineering">Engineering</option>
                        <option value="marketing">Marketing</option>
                        <option value="sales">Sales</option>
                        <option value="design">Design</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-input" id="jobDescription" rows="4" placeholder="Job description..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Salary Range</label>
                    <input type="text" class="form-input" id="jobSalary" placeholder="e.g., $50,000 - $80,000">
                </div>
                <div class="action-buttons mt-4">
                    <button type="submit" class="btn btn-primary">Save Job</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('jobModal')">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Company Modal -->
    <div id="companyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add/Edit Company</h3>
                <button class="close-btn" onclick="closeModal('companyModal')">&times;</button>
            </div>
            <form id="companyForm">
                <div class="form-group">
                    <label class="form-label">Company Name</label>
                    <input type="text" class="form-input" id="companyName" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Industry</label>
                    <select class="form-select" id="companyIndustry" required>
                        <option value="">Select Industry</option>
                        <option value="technology">Technology</option>
                        <option value="finance">Finance</option>
                        <option value="healthcare">Healthcare</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Company Size</label>
                    <select class="form-select" id="companySize" required>
                        <option value="">Select Size</option>
                        <option value="small">Small (1-50)</option>
                        <option value="medium">Medium (51-500)</option>
                        <option value="large">Large (501-1000)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="companyStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="action-buttons mt-4">
                    <button type="submit" class="btn btn-primary">Save Company</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('companyModal')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>