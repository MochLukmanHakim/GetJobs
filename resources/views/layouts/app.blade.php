<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GetJobs')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    {{-- Include sidebar styles --}}
    @include('components.sidebar-styles')
    
    {{-- Page specific styles --}}
    @stack('styles')
</head>
<body>
    {{-- Include sidebar drawer functionality --}}
    @include('components.sidebar-drawer')

    <div class="dashboard-container">
        {{-- Include sidebar component --}}
        @include('components.sidebar', ['activePage' => request()->route()->getName()])

        {{-- Main Content --}}
        <main class="main-content">
            {{-- Top Header --}}
            <div class="top-header">
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                <div class="header-right">
                    @yield('header-actions')
                    <button class="notification-icon" onclick="toggleNotificationSidebar()">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#clip0_399_2036)">
                            <path d="M13.73 21.5C13.5544 21.8033 13.3021 22.0552 12.9985 22.2302C12.6948 22.4053 12.3505 22.4974 12 22.4974C11.6495 22.4974 11.3052 22.4053 11.0015 22.2302C10.6979 22.0552 10.4456 21.8033 10.27 21.5M18.134 11.5C18.715 16.875 21 18.5 21 18.5H3C3 18.5 6 16.367 6 8.9C6 7.203 6.632 5.575 7.757 4.375C8.883 3.175 10.41 2.5 12 2.5C12.337 2.5 12.672 2.53 13 2.59L18.134 11.5ZM19 8.5C19.7956 8.5 20.5587 8.18393 21.1213 7.62132C21.6839 7.05871 22 6.29565 22 5.5C22 4.70435 21.6839 3.94129 21.1213 3.37868C20.5587 2.81607 19.7956 2.5 19 2.5C18.2044 2.5 17.4413 2.81607 16.8787 3.37868C16.3161 3.94129 16 4.70435 16 5.5C16 6.29565 16.3161 7.05871 16.8787 7.62132C17.4413 8.18393 18.2044 8.5 19 8.5Z" stroke="#282828" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <ellipse cx="5.4" cy="5.4" rx="5.4" ry="5.4" transform="matrix(-1 0 0 1 22.8008 0.5)" fill="url(#paint0_linear_399_2036)"/>
                          </g>
                          <defs>
                            <linearGradient id="paint0_linear_399_2036" x1="0" y1="5.4" x2="10.8" y2="5.4" gradientUnits="userSpaceOnUse">
                              <stop stop-color="#577C8E"/>
                              <stop offset="1" stop-color="#263446"/>
                            </linearGradient>
                            <clipPath id="clip0_399_2036">
                              <rect width="24" height="24" fill="white" transform="translate(0 0.5)"/>
                            </clipPath>
                          </defs>
                        </svg>
                        <div class="notification-badge">3</div>
                    </button>
                    <div class="profile-mini profile-dropdown" id="profileDropdown" onclick="toggleProfileDropdown(event)">
                        <div class="profile-mini-avatar">{{ substr(Auth::user()->name ?? 'U', 0, 2) }}</div>
                        <span class="profile-mini-name">{{ Auth::user()->name ?? 'User' }}</span>
                        <svg style="margin-left:4px;" width="16" height="16" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 6 8 10 12 6"/></svg>
                        <div class="profile-dropdown-menu" id="profileDropdownMenu">
                            <button class="profile-dropdown-item" onclick="window.location.href='/profile';return false;">Profile</button>
                            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                @csrf
                                <button type="submit" class="profile-dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Page Content --}}
            @yield('content')
        </main>
    </div>

    {{-- Notification Sidebar --}}
    <div class="notification-sidebar" id="notificationSidebar">
        <div class="notification-header">
            <h3>Notifikasi</h3>
            <button class="close-notification-btn" onclick="toggleNotificationSidebar()">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="notification-content">
            <div class="notification-item unread">
                <div class="notification-icon">
                    <svg width="16" height="16" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="m19 8 2 2-2 2"></path>
                        <path d="m17 10h6"></path>
                    </svg>
                </div>
                <div class="notification-details">
                    <div class="notification-title">Pelamar Baru</div>
                    <div class="notification-message">Jamal bin telah melamar untuk posisi Manajemen Keuangan</div>
                    <div class="notification-time">2 menit yang lalu</div>
                </div>
            </div>
            <div class="notification-item unread">
                <div class="notification-icon">
                    <svg width="16" height="16" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4"></path>
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                </div>
                <div class="notification-details">
                    <div class="notification-title">Aplikasi Disetujui</div>
                    <div class="notification-message">Rina Wati telah diterima untuk posisi Admin Medsos</div>
                    <div class="notification-time">1 jam yang lalu</div>
                </div>
            </div>
            <div class="notification-item">
                <div class="notification-icon">
                    <svg width="16" height="16" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                    </svg>
                </div>
                <div class="notification-details">
                    <div class="notification-title">Deadline Mendekati</div>
                    <div class="notification-message">Posisi Backend Developer akan ditutup dalam 2 hari</div>
                    <div class="notification-time">3 jam yang lalu</div>
                </div>
            </div>
        </div>
        <div class="notification-footer">
            <button class="mark-all-read-btn">Tandai Semua Dibaca</button>
        </div>
    </div>

    {{-- Notification Overlay --}}
    <div class="notification-overlay" id="notificationOverlay" onclick="toggleNotificationSidebar()"></div>

    {{-- Page specific scripts --}}
    @stack('scripts')
    
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Profile dropdown script --}}
    <script>
        function toggleProfileDropdown(event) {
            event.stopPropagation();
            var menu = document.getElementById('profileDropdownMenu');
            menu.classList.toggle('show');
        }
        
        function toggleNotificationSidebar() {
            var sidebar = document.getElementById('notificationSidebar');
            var overlay = document.getElementById('notificationOverlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
            
            // Close profile dropdown if open
            var profileMenu = document.getElementById('profileDropdownMenu');
            if(profileMenu && profileMenu.classList.contains('show')) {
                profileMenu.classList.remove('show');
            }
        }
        
        document.addEventListener('click', function(e) {
            var menu = document.getElementById('profileDropdownMenu');
            if(menu && menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        });
    </script>
</body>
</html>
