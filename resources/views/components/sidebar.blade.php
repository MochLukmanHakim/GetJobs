{{-- Sidebar Component --}}
{{-- Usage: @include('components.sidebar', ['activePage' => 'dashboard']) --}}

@php
    $activePage = $activePage ?? 'dashboard';
@endphp

<!-- Mobile Menu Button -->
<button class="mobile-menu-btn" onclick="toggleMobileSidebar()">
    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
    </svg>
</button>

<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" onclick="closeMobileSidebar()"></div>

<!-- Left Sidebar -->
<aside class="sidebar" id="sidebar">

    <div class="sidebar-header">
        <div class="logo-section" onclick="toggleSidebar()" id="logoToggle">
            <img src="/images/logo-getjobs2.png" alt="GetJobs Logo" class="logo-image">
        </div>
    </div>
    
    <nav class="nav-menu">
        <div class="nav-item">
            <a href="/dashboard" class="nav-link {{ $activePage === 'dashboard' ? 'active' : '' }}" data-tooltip="Dashboard">
                <span class="nav-icon">
                    <i class="bi bi-house-door"></i>
                </span>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="/pekerjaan" class="nav-link {{ $activePage === 'pekerjaan.index' ? 'active' : '' }}" data-tooltip="Pekerjaan">
                <span class="nav-icon">
                    <i class="bi bi-briefcase"></i>
                </span>
                <span>Pekerjaan</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="/pelamar" class="nav-link {{ $activePage === 'pelamar.index' ? 'active' : '' }}" data-tooltip="Pelamar">
                <span class="nav-icon">
                    <i class="bi bi-people"></i>
                </span>
                <span>Pelamar</span>
            </a>
        </div>
        <!-- <div class="nav-item">
            <a href="/statistik" class="nav-link {{ $activePage === 'statistik' ? 'active' : '' }}" data-tooltip="Statistik">
                <span class="nav-icon">
                    <i class="bi bi-bar-chart"></i>
                </span>
                <span>Statistik</span>
            </a>
        </div> -->
        <div class="nav-item">
            <a href="/perusahaan" class="nav-link {{ $activePage === 'perusahaan.profile' ? 'active' : '' }}" data-tooltip="Perusahaan">
                <span class="nav-icon">
                    <i class="bi bi-buildings"></i>
                </span>
                <span>Profile</span>
            </a>
        </div>
    </nav>
    
    <!-- Logout Section -->
    <div class="sidebar-footer">
        <div class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="nav-link logout-btn" data-tooltip="Logout">
                    <span class="nav-icon">
                        <i class="bi bi-box-arrow-right"></i>
                    </span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<script>
    // Sidebar Toggle Functions
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        const headerContainer = document.querySelector('.header-container');
        
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
        
        // Update header padding based on sidebar state
        if (headerContainer) {
            if (sidebar.classList.contains('collapsed')) {
                headerContainer.style.paddingLeft = '32px';
                headerContainer.style.paddingRight = '40px';
            } else {
                headerContainer.style.paddingLeft = '32px';
                headerContainer.style.paddingRight = '140px';
            }
        }
        
        // Update header left padding based on sidebar state
        const headerLeft = document.querySelector('.header-left');
        if (headerLeft) {
            if (sidebar.classList.contains('collapsed')) {
                headerLeft.style.paddingLeft = '80px';
            } else {
                headerLeft.style.paddingLeft = '160px';
            }
        }
        
        // Save state to localStorage
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);
    }

    function toggleMobileSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        
        sidebar.classList.add('show');
        overlay.classList.add('show');
    }

    function closeMobileSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }

    // Initialize sidebar state from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        const headerContainer = document.querySelector('.header-container');
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        
        if (isCollapsed && sidebar && mainContent) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            
            // Update header padding for collapsed state
            if (headerContainer) {
                headerContainer.style.paddingLeft = '32px';
                headerContainer.style.paddingRight = '40px';
            }
            
            // Update header left padding for collapsed state
            const headerLeft = document.querySelector('.headerLeft');
            if (headerLeft) {
                headerLeft.style.paddingLeft = '80px';
            }
        } else if (headerContainer) {
            // Ensure header padding is correct for expanded state
            headerContainer.style.paddingLeft = '32px';
            headerContainer.style.paddingRight = '140px';
            
            // Ensure header left padding is correct for expanded state
            const headerLeft = document.querySelector('.header-left');
            if (headerLeft) {
                headerLeft.style.paddingLeft = '160px';
            }
        }
    });

    // Close mobile sidebar when clicking on a link
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    closeMobileSidebar();
                }
            });
        });
    });
</script>
