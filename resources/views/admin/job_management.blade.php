<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Management - GetJobs Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&display=swap');

        :root {
            --color-primary: #2563eb;
            --color-primary-50: #eff6ff;
            --color-primary-100: #dbeafe;
            --color-primary-700: #1d4ed8;
            --color-accent: #059669;
            --color-accent-50: #ecfdf5;
            --color-accent-100: #d1fae5;
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
            max-width: 1280px;
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

        /* Card */
        .card {
            background-color: var(--color-surface);
            border-radius: 0.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-border-light);
            transition: all 150ms ease;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 150ms ease;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--color-primary-700);
        }

        .btn-success {
            background-color: var(--color-success);
            color: white;
        }

        .btn-success:hover {
            background-color: #065f46;
        }

        .btn-warning {
            background-color: var(--color-warning);
            color: white;
        }

        .btn-warning:hover {
            background-color: #b45309;
        }

        .btn-error {
            background-color: var(--color-error);
            color: white;
        }

        .btn-error:hover {
            background-color: #b91c1c;
        }

        .btn-outline {
            background-color: transparent;
            color: var(--color-text-primary);
            border: 1px solid var(--color-border);
        }

        .btn-outline:hover {
            background-color: var(--color-background);
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-text-primary);
            margin-bottom: 0.5rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--color-border);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: border-color 150ms ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
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

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background-color: var(--color-accent-100);
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
            box-shadow: var(--shadow-md);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem;
            border-bottom: 1px solid var(--color-border);
        }

        .modal-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--color-text-primary);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            padding: 1.5rem;
            border-top: 1px solid var(--color-border);
        }

        /* Grid */
        .grid {
            display: grid;
        }

        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .gap-4 { gap: 1rem; }
        .gap-6 { gap: 1.5rem; }

        /* Flex */
        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .gap-2 { gap: 0.5rem; }
        .gap-4 { gap: 1rem; }

        /* Responsive */
        @media (min-width: 768px) {
            .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }

        @media (min-width: 1024px) {
            .lg\:grid-cols-6 { grid-template-columns: repeat(6, minmax(0, 1fr)); }
        }

        /* Utilities */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-medium { font-weight: 500; }
        .font-semibold { font-weight: 600; }
        .text-sm { font-size: 0.875rem; }
        .text-xs { font-size: 0.75rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .p-6 { padding: 1.5rem; }
        .w-full { width: 100%; }
        .hidden { display: none; }
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
            <!-- Page Header with Actions -->
            <div class="card p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="title">Job Management Log</h2>
                        <p class="subtitle">View job postings, status, and applications</p>
                    </div>
                    <!-- Hapus tombol Add New Job -->
                </div>
                <!-- Filters tetap boleh dipakai untuk log -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="form-label">Category</label>
                        <select class="form-select" id="categoryFilter" onchange="filterJobs()">
                            <option value="">All Categories</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Product Management">Product Management</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Sales">Sales</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Status</label>
                        <select class="form-select" id="statusFilter" onchange="filterJobs()">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Company</label>
                        <select class="form-select" id="companyFilter" onchange="filterJobs()">
                            <option value="">All Companies</option>
                            <option value="TechCorp Inc.">TechCorp Inc.</option>
                            <option value="InnovateLabs">InnovateLabs</option>
                            <option value="StartupHub">StartupHub</option>
                            <option value="GlobalTech Solutions">GlobalTech Solutions</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Search</label>
                        <input type="text" class="form-input" placeholder="Search jobs..." id="searchInput" oninput="filterJobs()">
                    </div>
                </div>
            </div>

            <!-- Jobs Table -->
            <div class="card p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold">Job Listings Log</h3>
                    <!-- Hapus tombol bulk action -->
                </div>

                <div class="table-container">
                    <table class="table" id="jobsTable">
                        <thead>
                            <tr>
                                <!-- Hapus checkbox select all -->
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Category</th>
                                <th>Salary Range</th>
                                <th>Status</th>
                                <th>Created</th>
                                <!-- Hapus kolom Actions -->
                            </tr>
                        </thead>
                        <tbody id="jobsTableBody">
                            <!-- Table rows will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between" style="margin-top: 1.5rem;">
                    <div class="text-sm" style="color: var(--color-text-secondary);">
                        Showing <span id="showingStart">1</span> to <span id="showingEnd">10</span> of <span id="totalJobs">25</span> jobs
                    </div>
                    <div class="flex gap-2">
                        <button class="btn btn-outline" onclick="previousPage()" id="prevBtn">Previous</button>
                        <button class="btn btn-outline" onclick="nextPage()" id="nextBtn">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Hapus modal Add/Edit Job -->
    <!-- <div class="modal" id="jobModal"> ... </div> -->

    <script>
        // Sample job data
        let jobs = [
            {
                id: 1,
                title: 'Senior Software Engineer',
                company: 'TechCorp Inc.',
                category: 'Software Engineering',
                location: 'Remote',
                minSalary: 120000,
                maxSalary: 180000,
                status: 'active',
                created: '2024-08-15',
                description: 'We are looking for a senior software engineer...',
                requirements: 'Bachelor degree in Computer Science...'
            },
            {
                id: 2,
                title: 'Data Scientist - ML',
                company: 'InnovateLabs',
                category: 'Data Science',
                location: 'California',
                minSalary: 140000,
                maxSalary: 200000,
                status: 'active',
                created: '2024-08-14',
                description: 'Join our data science team...',
                requirements: 'PhD in Statistics or related field...'
            },
            {
                id: 3,
                title: 'Product Manager',
                company: 'StartupHub',
                category: 'Product Management',
                location: 'New York',
                minSalary: 110000,
                maxSalary: 160000,
                status: 'pending',
                created: '2024-08-13',
                description: 'Lead product strategy and development...',
                requirements: '5+ years of product management experience...'
            },
            {
                id: 4,
                title: 'Marketing Specialist',
                company: 'GlobalTech Solutions',
                category: 'Marketing',
                location: 'Texas',
                minSalary: 65000,
                maxSalary: 95000,
                status: 'active',
                created: '2024-08-12',
                description: 'Drive marketing campaigns and growth...',
                requirements: 'Bachelor degree in Marketing...'
            },
            {
                id: 5,
                title: 'Full Stack Developer',
                company: 'DataDriven Co.',
                category: 'Software Engineering',
                location: 'Remote',
                minSalary: 90000,
                maxSalary: 130000,
                status: 'inactive',
                created: '2024-08-11',
                description: 'Build end-to-end web applications...',
                requirements: '3+ years of full stack development...'
            }
        ];

        let filteredJobs = [...jobs];
        let currentPage = 1;
        const jobsPerPage = 10;
        let editingJobId = null;

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            updatePagination();
        });

        // Render table (log only, no checkbox, no actions)
        function renderTable() {
            const tbody = document.getElementById('jobsTableBody');
            const start = (currentPage - 1) * jobsPerPage;
            const end = start + jobsPerPage;
            const pageJobs = filteredJobs.slice(start, end);

            tbody.innerHTML = pageJobs.map(job => `
                <tr>
                    <td class="font-medium">${job.title}</td>
                    <td>${job.company}</td>
                    <td>
                        <span class="status-badge" style="background-color: ${getCategoryColor(job.category)}20; color: ${getCategoryColor(job.category)};">
                            ${job.category}
                        </span>
                    </td>
                    <td>$${job.minSalary.toLocaleString()} - $${job.maxSalary.toLocaleString()}</td>
                    <td>
                        <span class="status-badge status-${job.status}">
                            ${job.status.charAt(0).toUpperCase() + job.status.slice(1)}
                        </span>
                    </td>
                    <td>${formatDate(job.created)}</td>
                </tr>
            `).join('');

            updatePagination();
        }

        // Filter jobs
        function filterJobs() {
            const categoryFilter = document.getElementById('categoryFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const companyFilter = document.getElementById('companyFilter').value;
            const searchInput = document.getElementById('searchInput').value.toLowerCase();

            filteredJobs = jobs.filter(job => {
                const matchesCategory = !categoryFilter || job.category === categoryFilter;
                const matchesStatus = !statusFilter || job.status === statusFilter;
                const matchesCompany = !companyFilter || job.company === companyFilter;
                const matchesSearch = !searchInput || 
                    job.title.toLowerCase().includes(searchInput) ||
                    job.company.toLowerCase().includes(searchInput) ||
                    job.category.toLowerCase().includes(searchInput);

                return matchesCategory && matchesStatus && matchesCompany && matchesSearch;
            });

            currentPage = 1;
            renderTable();
        }

        // CRUD Operations
        function saveJob() {
            const form = document.getElementById('jobForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const jobData = {
                title: document.getElementById('jobTitle').value,
                company: document.getElementById('company').value,
                category: document.getElementById('category').value,
                location: document.getElementById('location').value || 'Not specified',
                minSalary: parseInt(document.getElementById('minSalary').value) || 0,
                maxSalary: parseInt(document.getElementById('maxSalary').value) || 0,
                description: document.getElementById('jobDescription').value,
                requirements: document.getElementById('requirements').value,
                status: 'active',
                created: new Date().toISOString().split('T')[0]
            };

            if (editingJobId) {
                // Update existing job
                const jobIndex = jobs.findIndex(j => j.id === editingJobId);
                if (jobIndex !== -1) {
                    jobs[jobIndex] = { ...jobs[jobIndex], ...jobData };
                    alert('Job updated successfully!');
                }
            } else {
                // Add new job
                const newId = Math.max(...jobs.map(j => j.id)) + 1;
                jobs.push({ id: newId, ...jobData });
                alert('Job added successfully!');
            }

            closeModal();
            filterJobs();
        }

        function editJob(jobId) {
            openModal('edit', jobId);
        }

        function deleteJob(jobId) {
            if (confirm('Are you sure you want to delete this job?')) {
                jobs = jobs.filter(j => j.id !== jobId);
                filterJobs();
                alert('Job deleted successfully!');
            }
        }

        function toggleJobStatus(jobId) {
            const job = jobs.find(j => j.id === jobId);
            if (job) {
                job.status = job.status === 'active' ? 'inactive' : 'active';
                renderTable();
                alert(`Job ${job.status === 'active' ? 'activated' : 'deactivated'} successfully!`);
            }
        }

        // Pagination
        function updatePagination() {
            const totalJobs = filteredJobs.length;
            const totalPages = Math.ceil(totalJobs / jobsPerPage);
            const start = (currentPage - 1) * jobsPerPage + 1;
            const end = Math.min(currentPage * jobsPerPage, totalJobs);

            document.getElementById('showingStart').textContent = totalJobs > 0 ? start : 0;
            document.getElementById('showingEnd').textContent = end;
            document.getElementById('totalJobs').textContent = totalJobs;

            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        }

        function nextPage() {
            const totalPages = Math.ceil(filteredJobs.length / jobsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        }

        // Utility functions
        function getCategoryColor(category) {
            const colors = {
                'Software Engineering': '#2563eb',
                'Data Science': '#059669',
                'Product Management': '#d97706',
                'Marketing': '#1e40af',
                'Sales': '#dc2626'
            };
            return colors[category] || '#64748b';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        }

        // Close modal when clicking outside
        document.getElementById('jobModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Handle ESC key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>