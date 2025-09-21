<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetJobs Admin - Job Management Dashboard</title>
    <style>
        :root {
            --color-primary: #4285f4;
            --color-surface: #ffffff;
            --color-border: #e0e0e0;
            --color-text-primary: #1f2937;
            --color-text-secondary: #6b7280;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --color-background: #f9fafb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--color-background);
            color: var(--color-text-primary);
        }

        .container {
            max-width: 1400px;
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
            margin-bottom: 0.125rem;
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
        .main-container {
            padding: 2rem 0;
        }

        /* CRUD Section */
        .crud-section {
            background: var(--color-surface);
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            border: 1px solid var(--color-border);
        }

        .crud-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--color-border);
        }

        .crud-header h2 {
            color: var(--color-text-primary);
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-icon {
            width: 2rem;
            height: 2rem;
            background: var(--color-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            color: white;
            font-size: 1rem;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.625rem 1.125rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            border: 1px solid transparent;
        }

        .btn-primary {
            background: var(--color-primary);
            color: white;
        }

        .btn-primary:hover {
            background: #3367d6;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
            background: white;
            border-radius: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table th,
        .table td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #555;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
        }

        .badge-success {
            background: #28a745;
            color: white;
        }

        .badge-warning {
            background: #ffc107;
            color: #333;
        }

        .badge-secondary {
            background: #6c757d;
            color: white;
        }

        /* Image Preview */
        .img-thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid #dee2e6;
        }

        /* Rating Stars */
        .rating {
            color: #ffc107;
            font-size: 16px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .modal-header h3 {
            color: #333;
            font-size: 20px;
        }

        .close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #999;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close:hover {
            background: #f0f0f0;
            color: #333;
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #4285f4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            border-left: 4px solid;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        /* Search Box */
        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box input {
            width: 300px;
            padding: 10px 40px 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 14px;
        }

        .search-box::after {
            content: '🔍';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }
            
            .nav ul {
                gap: 15px;
                overflow-x: auto;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                width: 95%;
                margin: 10px;
                padding: 20px;
            }
            
            .search-box input {
                width: 100%;
            }

            .btn-group {
                flex-direction: column;
            }

            .crud-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #999;
        }
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

    <!-- Main Container -->
    <div class="main-container">
        <div class="container">
        
        <!-- CRUD Logo Section -->
        <div class="crud-section">
            <div class="crud-header">
                <h2>
                    <div class="section-icon">🏷️</div>
                    CRUD Logo
                </h2>
                <div class="btn-group">
                    <button class="btn btn-primary" onclick="openModal('logo-form')">
                        ➕ Tambah Logo
                    </button>
                    <button class="btn btn-success" onclick="exportData('logo')">
                        📄 Export
                    </button>
                </div>
            </div>
            
            <div class="search-box">
                <input type="text" placeholder="Cari logo..." onkeyup="searchTable('logo-table', this.value)">
            </div>

            <div class="table-responsive">
                <table class="table" id="logo-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Preview</th>
                            <th>Nama Logo</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjNDI4NUY0Ii8+Cjx0ZXh0IHg9IjI1IiB5PSIzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSI+R0o8L3RleHQ+Cjwvc3ZnPg==" class="img-thumbnail" alt="Logo"></td>
                            <td>Logo Utama GetJobs</td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>15 Jan 2024</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editLogo(1)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteLogo(1)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjMjhhNzQ1Ii8+Cjx0ZXh0IHg9IjI1IiB5PSIzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSI+R0pNPC90ZXh0Pgo8L3N2Zz4=" class="img-thumbnail" alt="Logo"></td>
                            <td>Logo Mobile GetJobs</td>
                            <td><span class="badge badge-secondary">Inactive</span></td>
                            <td>10 Jan 2024</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editLogo(2)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteLogo(2)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CRUD Hero Sections -->
        <div class="crud-section">
            <div class="crud-header">
                <h2>
                    <div class="section-icon">🎯</div>
                    CRUD Hero Sections
                </h2>
                <div class="btn-group">
                    <button class="btn btn-primary" onclick="openModal('hero-form')">
                        ➕ Tambah Hero
                    </button>
                    <button class="btn btn-success" onclick="exportData('hero')">
                        📄 Export
                    </button>
                </div>
            </div>

            <div class="search-box">
                <input type="text" placeholder="Cari hero section..." onkeyup="searchTable('hero-table', this.value)">
            </div>

            <div class="table-responsive">
                <table class="table" id="hero-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Preview</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Button Text</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjUwIiB2aWV3Qm94PSIwIDAgMTAwIDUwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjNGY4ZGZmIi8+Cjx0ZXh0IHg9IjUwIiB5PSIzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSI+SGVybyAxPC90ZXh0Pgo8L3N2Zz4=" class="img-thumbnail" alt="Hero"></td>
                            <td>Temukan Pekerjaan Impianmu</td>
                            <td>Ribuan lowongan kerja menanti Anda di platform terpercaya</td>
                            <td>Cari Kerja Sekarang</td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editHero(1)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteHero(1)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjUwIiB2aWV3Qm94PSIwIDAgMTAwIDUwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjMjhhNzQ1Ii8+Cjx0ZXh0IHg9IjUwIiB5PSIzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSI+SGVybyAyPC90ZXh0Pgo8L3N2Zz4=" class="img-thumbnail" alt="Hero"></td>
                            <td>Untuk Perusahaan</td>
                            <td>Posting lowongan dan temukan kandidat terbaik</td>
                            <td>Posting Lowongan</td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editHero(2)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteHero(2)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CRUD Kategori Section -->
        <div class="crud-section">
            <div class="crud-header">
                <h2>
                    <div class="section-icon">📂</div>
                    CRUD Kategori
                </h2>
                <div class="btn-group">
                    <button class="btn btn-primary" onclick="openModal('kategori-form')">
                        ➕ Tambah Kategori
                    </button>
                    <button class="btn btn-success" onclick="exportData('kategori')">
                        📄 Export
                    </button>
                </div>
            </div>

            <div class="search-box">
                <input type="text" placeholder="Cari kategori..." onkeyup="searchTable('kategori-table', this.value)">
            </div>

            <div class="table-responsive">
                <table class="table" id="kategori-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Icon</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Job</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td style="font-size: 24px;">💻</td>
                            <td>IT & Software Development</td>
                            <td>Pengembangan aplikasi, website, dan sistem</td>
                            <td><strong>248 Jobs</strong></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editKategori(1)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteKategori(1)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td style="font-size: 24px;">📊</td>
                            <td>Marketing & Sales</td>
                            <td>Digital marketing, sales, dan promosi</td>
                            <td><strong>156 Jobs</strong></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editKategori(2)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteKategori(2)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td style="font-size: 24px;">🎨</td>
                            <td>Design & Creative</td>
                            <td>UI/UX design, graphic design, branding</td>
                            <td><strong>89 Jobs</strong></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editKategori(3)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteKategori(3)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td style="font-size: 24px;">💼</td>
                            <td>Business & Finance</td>
                            <td>Akuntansi, keuangan, manajemen bisnis</td>
                            <td><strong>127 Jobs</strong></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editKategori(4)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteKategori(4)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CRUD Testimoni Section -->
        <div class="crud-section">
            <div class="crud-header">
                <h2>
                    <div class="section-icon">💬</div>
                    CRUD Testimoni
                </h2>
                <div class="btn-group">
                    <button class="btn btn-primary" onclick="openModal('testimoni-form')">
                        ➕ Tambah Testimoni
                    </button>
                    <button class="btn btn-success" onclick="exportData('testimoni')">
                        📄 Export
                    </button>
                </div>
            </div>

            <div class="search-box">
                <input type="text" placeholder="Cari testimoni..." onkeyup="searchTable('testimoni-table', this.value)">
            </div>

            <div class="table-responsive">
                <table class="table" id="testimoni-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjUiIGN5PSIyNSIgcj0iMjUiIGZpbGw9IiM0Mjg1RjQiLz4KPHRleHQgeD0iMjUiIHk9IjMwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IndoaXRlIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIj5BUzwvdGV4dD4KPC9zdmc+" class="img-thumbnail" alt="User"></td>
                            <td>Ahmad Susanto</td>
                            <td>Frontend Developer</td>
                            <td>PT. Tech Solutions</td>
                            <td><div class="rating">⭐⭐⭐⭐⭐</div></td>
                            <td><span class="badge badge-success">Published</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editTestimoni(1)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTestimoni(1)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjUiIGN5PSIyNSIgcj0iMjUiIGZpbGw9IiMyOGE3NDUiLz4KPHRleHQgeD0iMjUiIHk9IjMwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IndoaXRlIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIj5TRDwvdGV4dD4KPC9zdmc+" class="img-thumbnail" alt="User"></td>
                            <td>Sari Dewi</td>
                            <td>Marketing Manager</td>
                            <td>CV. Digital Marketing</td>
                            <td><div class="rating">⭐⭐⭐⭐⭐</div></td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editTestimoni(2)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTestimoni(2)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjUiIGN5PSIyNSIgcj0iMjUiIGZpbGw9IiNmZmMxMDciLz4KPHRleHQgeD0iMjUiIHk9IjMwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiMzMzMiIHRleHQtYW5jaG9yPSJtaWRkbGUiPkRQPC90ZXh0Pgo8L3N2Zz4=" class="img-thumbnail" alt="User"></td>
                            <td>Dedi Pratama</td>
                            <td>UI/UX Designer</td>
                            <td>PT. Creative Studio</td>
                            <td><div class="rating">⭐⭐⭐⭐</div></td>
                            <td><span class="badge badge-success">Published</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick="editTestimoni(3)">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTestimoni(3)">🗑️ Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Forms -->
    <!-- Logo Form Modal -->
    <div id="logo-form" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>🏷️ Tambah/Edit Logo</h3>
                <button class="close" onclick="closeModal('logo-form')">&times;</button>
            </div>
            <form id="logoForm" onsubmit="saveLogo(event)">
                <div class="form-group">
                    <label for="logo-name">Nama Logo</label>
                    <input type="text" class="form-control" id="logo-name" required placeholder="Masukkan nama logo">
                </div>
                <div class="form-group">
                    <label for="logo-file">Upload Logo</label>
                    <input type="file" class="form-control" id="logo-file" accept="image/*">
                    <small style="color: #666; font-size: 12px;">Format: JPG, PNG, SVG. Max 2MB</small>
                </div>
                <div class="form-group">
                    <label for="logo-status">Status</label>
                    <select class="form-control" id="logo-status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('logo-form')" style="background: #6c757d; color: white;">❌ Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hero Form Modal -->
    <div id="hero-form" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>🎯 Tambah/Edit Hero Section</h3>
                <button class="close" onclick="closeModal('hero-form')">&times;</button>
            </div>
            <form id="heroForm" onsubmit="saveHero(event)">
                <div class="form-group">
                    <label for="hero-title">Judul</label>
                    <input type="text" class="form-control" id="hero-title" required placeholder="Masukkan judul hero">
                </div>
                <div class="form-group">
                    <label for="hero-description">Deskripsi</label>
                    <textarea class="form-control" id="hero-description" rows="4" required placeholder="Masukkan deskripsi hero"></textarea>
                </div>
                <div class="form-group">
                    <label for="hero-image">Upload Image</label>
                    <input type="file" class="form-control" id="hero-image" accept="image/*">
                    <small style="color: #666; font-size: 12px;">Format: JPG, PNG. Recommended: 1200x600px</small>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="hero-button-text">Text Button</label>
                        <input type="text" class="form-control" id="hero-button-text" placeholder="Cari Kerja Sekarang">
                    </div>
                    <div class="form-group">
                        <label for="hero-button-link">Link Button</label>
                        <input type="url" class="form-control" id="hero-button-link" placeholder="https://example.com">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hero-status">Status</label>
                    <select class="form-control" id="hero-status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('hero-form')" style="background: #6c757d; color: white;">❌ Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Kategori Form Modal -->
    <div id="kategori-form" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>📂 Tambah/Edit Kategori</h3>
                <button class="close" onclick="closeModal('kategori-form')">&times;</button>
            </div>
            <form id="kategoriForm" onsubmit="saveKategori(event)">
                <div class="form-group">
                    <label for="kategori-name">Nama Kategori</label>
                    <input type="text" class="form-control" id="kategori-name" required placeholder="IT & Software Development">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="kategori-icon">Icon (Emoji)</label>
                        <input type="text" class="form-control" id="kategori-icon" placeholder="💻" maxlength="2">
                    </div>
                    <div class="form-group">
                        <label for="kategori-color">Warna Tema</label>
                        <input type="color" class="form-control" id="kategori-color" value="#4285f4">
                    </div>
                </div>
                <div class="form-group">
                    <label for="kategori-description">Deskripsi</label>
                    <textarea class="form-control" id="kategori-description" rows="3" placeholder="Deskripsi singkat tentang kategori"></textarea>
                </div>
                <div class="form-group">
                    <label for="kategori-status">Status</label>
                    <select class="form-control" id="kategori-status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('kategori-form')" style="background: #6c757d; color: white;">❌ Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Testimoni Form Modal -->
    <div id="testimoni-form" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>💬 Tambah/Edit Testimoni</h3>
                <button class="close" onclick="closeModal('testimoni-form')">&times;</button>
            </div>
            <form id="testimoniForm" onsubmit="saveTestimoni(event)">
                <div class="form-row">
                    <div class="form-group">
                        <label for="testimoni-name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="testimoni-name" required placeholder="Ahmad Susanto">
                    </div>
                    <div class="form-group">
                        <label for="testimoni-position">Posisi</label>
                        <input type="text" class="form-control" id="testimoni-position" required placeholder="Frontend Developer">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="testimoni-company">Perusahaan</label>
                        <input type="text" class="form-control" id="testimoni-company" required placeholder="PT. Tech Solutions">
                    </div>
                    <div class="form-group">
                        <label for="testimoni-rating">Rating</label>
                        <select class="form-control" id="testimoni-rating" required>
                            <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                            <option value="4">⭐⭐⭐⭐ (4)</option>
                            <option value="3">⭐⭐⭐ (3)</option>
                            <option value="2">⭐⭐ (2)</option>
                            <option value="1">⭐ (1)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="testimoni-photo">Foto Profil</label>
                    <input type="file" class="form-control" id="testimoni-photo" accept="image/*">
                    <small style="color: #666; font-size: 12px;">Format: JPG, PNG. Recommended: 300x300px</small>
                </div>
                <div class="form-group">
                    <label for="testimoni-content">Isi Testimoni</label>
                    <textarea class="form-control" id="testimoni-content" rows="4" required placeholder="Ceritakan pengalaman Anda menggunakan GetJobs..."></textarea>
                </div>
                <div class="form-group">
                    <label for="testimoni-status">Status</label>
                    <select class="form-control" id="testimoni-status">
                        <option value="published">Published</option>
                        <option value="pending">Pending Review</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('testimoni-form')" style="background: #6c757d; color: white;">❌ Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Global variables for data storage
        let logoData = [
            {id: 1, name: 'Logo Utama GetJobs', status: 'active', date: '15 Jan 2024'},
            {id: 2, name: 'Logo Mobile GetJobs', status: 'inactive', date: '10 Jan 2024'}
        ];

        let heroData = [
            {id: 1, title: 'Temukan Pekerjaan Impianmu', description: 'Ribuan lowongan kerja menanti Anda di platform terpercaya', buttonText: 'Cari Kerja Sekarang', status: 'active'},
            {id: 2, title: 'Untuk Perusahaan', description: 'Posting lowongan dan temukan kandidat terbaik', buttonText: 'Posting Lowongan', status: 'active'}
        ];

        let kategoriData = [
            {id: 1, name: 'IT & Software Development', icon: '💻', description: 'Pengembangan aplikasi, website, dan sistem', jobs: 248, status: 'active'},
            {id: 2, name: 'Marketing & Sales', icon: '📊', description: 'Digital marketing, sales, dan promosi', jobs: 156, status: 'active'},
            {id: 3, name: 'Design & Creative', icon: '🎨', description: 'UI/UX design, graphic design, branding', jobs: 89, status: 'active'},
            {id: 4, name: 'Business & Finance', icon: '💼', description: 'Akuntansi, keuangan, manajemen bisnis', jobs: 127, status: 'active'}
        ];

        let testimoniData = [
            {id: 1, name: 'Ahmad Susanto', position: 'Frontend Developer', company: 'PT. Tech Solutions', rating: 5, content: 'Platform GetJobs sangat membantu saya menemukan pekerjaan yang sesuai...', status: 'published'},
            {id: 2, name: 'Sari Dewi', position: 'Marketing Manager', company: 'CV. Digital Marketing', rating: 5, content: 'Proses apply job sangat mudah dan cepat. Dalam 2 hari sudah dapat panggilan interview...', status: 'pending'},
            {id: 3, name: 'Dedi Pratama', position: 'UI/UX Designer', company: 'PT. Creative Studio', rating: 4, content: 'Interface yang user-friendly dan banyak pilihan perusahaan teknologi terkemuka...', status: 'published'}
        ];

        let currentEditId = null;
        let currentEditType = null;

        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
            currentEditId = null;
            currentEditType = modalId.replace('-form', '');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            const form = document.getElementById(modalId).querySelector('form');
            if (form) form.reset();
            currentEditId = null;
            currentEditType = null;
        }

        // Search functionality
        function searchTable(tableId, searchValue) {
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                let row = rows[i];
                let found = false;
                let cells = row.getElementsByTagName('td');
                
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().indexOf(searchValue.toLowerCase()) > -1) {
                        found = true;
                        break;
                    }
                }
                
                row.style.display = found ? '' : 'none';
            }
        }

        // CRUD Operations for Logo
        function saveLogo(event) {
            event.preventDefault();
            
            const name = document.getElementById('logo-name').value;
            const status = document.getElementById('logo-status').value;
            
            if (currentEditId) {
                const index = logoData.findIndex(item => item.id == currentEditId);
                if (index !== -1) {
                    logoData[index].name = name;
                    logoData[index].status = status;
                    showAlert('Logo berhasil diupdate!', 'success');
                }
            } else {
                const newId = Math.max(...logoData.map(item => item.id), 0) + 1;
                logoData.push({
                    id: newId,
                    name: name,
                    status: status,
                    date: new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })
                });
                showAlert('Logo baru berhasil ditambahkan!', 'success');
            }
            
            updateLogoTable();
            closeModal('logo-form');
        }

        function editLogo(id) {
            const logo = logoData.find(item => item.id == id);
            if (logo) {
                currentEditId = id;
                document.getElementById('logo-name').value = logo.name;
                document.getElementById('logo-status').value = logo.status;
                openModal('logo-form');
            }
        }

        function deleteLogo(id) {
            if (confirm('Apakah Anda yakin ingin menghapus logo ini?')) {
                logoData = logoData.filter(item => item.id != id);
                updateLogoTable();
                showAlert('Logo berhasil dihapus!', 'success');
            }
        }

        function updateLogoTable() {
            const tbody = document.querySelector('#logo-table tbody');
            tbody.innerHTML = '';
            
            logoData.forEach(logo => {
                const statusBadge = logo.status === 'active' 
                    ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-secondary">Inactive</span>';
                    
                tbody.innerHTML += `
                    <tr>
                        <td>${logo.id}</td>
                        <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1zbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjNDI4NUY0Ii8+Cjx0ZXh0IHg9IjI1IiB5PSIzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSI+R0o8L3RleHQ+Cjwvc3ZnPg==" class="img-thumbnail" alt="Logo"></td>
                        <td>${logo.name}</td>
                        <td>${statusBadge}</td>
                        <td>${logo.date}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-warning btn-sm" onclick="editLogo(${logo.id})">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteLogo(${logo.id})">🗑️ Delete</button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        // Similar CRUD functions for Hero, Kategori, and Testimoni...
        function saveHero(event) {
            event.preventDefault();
            
            const title = document.getElementById('hero-title').value;
            const description = document.getElementById('hero-description').value;
            const buttonText = document.getElementById('hero-button-text').value;
            const buttonLink = document.getElementById('hero-button-link').value;
            const status = document.getElementById('hero-status').value;
            
            if (currentEditId) {
                const index = heroData.findIndex(item => item.id == currentEditId);
                if (index !== -1) {
                    heroData[index] = {
                        ...heroData[index],
                        title,
                        description,
                        buttonText,
                        buttonLink,
                        status
                    };
                    showAlert('Hero section berhasil diupdate!', 'success');
                }
            } else {
                const newId = Math.max(...heroData.map(item => item.id), 0) + 1;
                heroData.push({
                    id: newId,
                    title,
                    description,
                    buttonText,
                    buttonLink,
                    status
                });
                showAlert('Hero section baru berhasil ditambahkan!', 'success');
            }
            
            updateHeroTable();
            closeModal('hero-form');
        }

        function editHero(id) {
            const hero = heroData.find(item => item.id == id);
            if (hero) {
                currentEditId = id;
                document.getElementById('hero-title').value = hero.title;
                document.getElementById('hero-description').value = hero.description;
                document.getElementById('hero-button-text').value = hero.buttonText || '';
                document.getElementById('hero-button-link').value = hero.buttonLink || '';
                document.getElementById('hero-status').value = hero.status;
                openModal('hero-form');
            }
        }

        function deleteHero(id) {
            if (confirm('Apakah Anda yakin ingin menghapus hero section ini?')) {
                heroData = heroData.filter(item => item.id != id);
                updateHeroTable();
                showAlert('Hero section berhasil dihapus!', 'success');
            }
        }

        function updateHeroTable() {
            const tbody = document.querySelector('#hero-table tbody');
            tbody.innerHTML = '';
            
            heroData.forEach(hero => {
                const statusBadge = hero.status === 'active' 
                    ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-secondary">Inactive</span>';
                    
                tbody.innerHTML += `
                    <tr>
                        <td>${hero.id}</td>
                        <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjUwIiB2aWV3Qm94PSIwIDAgMTAwIDUwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjNGY4ZGZmIi8+Cjx0ZXh0IHg9IjUwIiB5PSIzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSI+SGVybyAke2hlcm8uaWR9PC90ZXh0Pgo8L3N2Zz4=" class="img-thumbnail" alt="Hero"></td>
                        <td>${hero.title}</td>
                        <td>${hero.description.length > 50 ? hero.description.substring(0, 50) + '...' : hero.description}</td>
                        <td>${hero.buttonText || '-'}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-warning btn-sm" onclick="editHero(${hero.id})">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteHero(${hero.id})">🗑️ Delete</button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        // Continue with similar functions for Kategori and Testimoni...
        function saveKategori(event) {
            event.preventDefault();
            
            const name = document.getElementById('kategori-name').value;
            const icon = document.getElementById('kategori-icon').value;
            const color = document.getElementById('kategori-color').value;
            const description = document.getElementById('kategori-description').value;
            const status = document.getElementById('kategori-status').value;
            
            if (currentEditId) {
                const index = kategoriData.findIndex(item => item.id == currentEditId);
                if (index !== -1) {
                    kategoriData[index] = {
                        ...kategoriData[index],
                        name,
                        icon,
                        color,
                        description,
                        status
                    };
                    showAlert('Kategori berhasil diupdate!', 'success');
                }
            } else {
                const newId = Math.max(...kategoriData.map(item => item.id), 0) + 1;
                kategoriData.push({
                    id: newId,
                    name,
                    icon,
                    color,
                    description,
                    jobs: 0,
                    status
                });
                showAlert('Kategori baru berhasil ditambahkan!', 'success');
            }
            updateKategoriTable();
            closeModal('kategori-form');
        }

        function editKategori(id) {
            const kategori = kategoriData.find(item => item.id == id);
            if (kategori) {
                currentEditId = id;
                document.getElementById('kategori-name').value = kategori.name;
                document.getElementById('kategori-icon').value = kategori.icon || '';
                document.getElementById('kategori-color').value = kategori.color || '#4285f4';
                document.getElementById('kategori-description').value = kategori.description || '';
                document.getElementById('kategori-status').value = kategori.status;
                openModal('kategori-form');
            }
        }

        function deleteKategori(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                kategoriData = kategoriData.filter(item => item.id != id);
                updateKategoriTable();
                showAlert('Kategori berhasil dihapus!', 'success');
            }
        }

        function updateKategoriTable() {
            const tbody = document.querySelector('#kategori-table tbody');
            tbody.innerHTML = '';
            kategoriData.forEach(kategori => {
                const statusBadge = kategori.status === 'active'
                    ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-secondary">Inactive</span>';
                tbody.innerHTML += `
                    <tr>
                        <td>${kategori.id}</td>
                        <td style="font-size: 24px;">${kategori.icon || ''}</td>
                        <td>${kategori.name}</td>
                        <td>${kategori.description || '-'}</td>
                        <td><strong>${kategori.jobs || 0} Jobs</strong></td>
                        <td>${statusBadge}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-warning btn-sm" onclick="editKategori(${kategori.id})">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteKategori(${kategori.id})">🗑️ Delete</button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        // CRUD Testimoni
        function saveTestimoni(event) {
            event.preventDefault();
            const name = document.getElementById('testimoni-name').value;
            const position = document.getElementById('testimoni-position').value;
            const company = document.getElementById('testimoni-company').value;
            const rating = parseInt(document.getElementById('testimoni-rating').value);
            const content = document.getElementById('testimoni-content').value;
            const status = document.getElementById('testimoni-status').value;

            if (currentEditId) {
                const index = testimoniData.findIndex(item => item.id == currentEditId);
                if (index !== -1) {
                    testimoniData[index] = {
                        ...testimoniData[index],
                        name,
                        position,
                        company,
                        rating,
                        content,
                        status
                    };
                    showAlert('Testimoni berhasil diupdate!', 'success');
                }
            } else {
                const newId = Math.max(...testimoniData.map(item => item.id), 0) + 1;
                testimoniData.push({
                    id: newId,
                    name,
                    position,
                    company,
                    rating,
                    content,
                    status
                });
                showAlert('Testimoni baru berhasil ditambahkan!', 'success');
            }
            updateTestimoniTable();
            closeModal('testimoni-form');
        }

        function editTestimoni(id) {
            const testimoni = testimoniData.find(item => item.id == id);
            if (testimoni) {
                currentEditId = id;
                document.getElementById('testimoni-name').value = testimoni.name;
                document.getElementById('testimoni-position').value = testimoni.position;
                document.getElementById('testimoni-company').value = testimoni.company;
                document.getElementById('testimoni-rating').value = testimoni.rating;
                document.getElementById('testimoni-content').value = testimoni.content;
                document.getElementById('testimoni-status').value = testimoni.status;
                openModal('testimoni-form');
            }
        }

        function deleteTestimoni(id) {
            if (confirm('Apakah Anda yakin ingin menghapus testimoni ini?')) {
                testimoniData = testimoniData.filter(item => item.id != id);
                updateTestimoniTable();
                showAlert('Testimoni berhasil dihapus!', 'success');
            }
        }

        function updateTestimoniTable() {
            const tbody = document.querySelector('#testimoni-table tbody');
            tbody.innerHTML = '';
            testimoniData.forEach(testimoni => {
                let badgeClass = 'badge-secondary';
                if (testimoni.status === 'published') badgeClass = 'badge-success';
                else if (testimoni.status === 'pending') badgeClass = 'badge-warning';
                const stars = '⭐'.repeat(testimoni.rating);
                tbody.innerHTML += `
                    <tr>
                        <td>${testimoni.id}</td>
                        <td><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1zbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjUiIGN5PSIyNSIgcj0iMjUiIGZpbGw9IiM0Mjg1RjQiLz4KPHRleHQgeD0iMjUiIHk9IjMwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IndoaXRlIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIj5BUzwvdGV4dD4KPC9zdmc+" class="img-thumbnail" alt="User"></td>
                        <td>${testimoni.name}</td>
                        <td>${testimoni.position}</td>
                        <td>${testimoni.company}</td>
                        <td><div class="rating">${stars}</div></td>
                        <td><span class="badge ${badgeClass}">${capitalize(testimoni.status)}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-warning btn-sm" onclick="editTestimoni(${testimoni.id})">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteTestimoni(${testimoni.id})">🗑️ Delete</button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        // Helper
        function capitalize(str) {
            if (!str) return '';
            if (str === 'published') return 'Published';
            if (str === 'pending') return 'Pending';
            if (str === 'draft') return 'Draft';
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        // Alert
        function showAlert(message, type = 'success') {
            let alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.innerText = message;
            document.body.appendChild(alertDiv);
            setTimeout(() => {
                alertDiv.remove();
            }, 2500);
        }

        // Export dummy
        function exportData(type) {
            showAlert('Fitur export belum tersedia.', 'danger');
        }

        // Initial render
        document.addEventListener('DOMContentLoaded', function() {
            updateLogoTable();
            updateHeroTable();
            updateKategoriTable();
            updateTestimoniTable();
        });
    </script>
</body>
</html>