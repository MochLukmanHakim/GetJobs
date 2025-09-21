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
    
    {{-- Page Transition Styles --}}
    <style>
        /* Page Transition Animations */
        .main-content {
            opacity: 0;
            transform: translateY(10px);
            animation: pageEnter 0.6s ease-out forwards;
        }

        @keyframes pageEnter {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Smooth transitions for all interactive elements */
        .main-content * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Page exit animation */
        .page-exit {
            opacity: 1;
            transform: translateY(0);
            animation: pageExit 0.4s ease-in forwards;
        }

        @keyframes pageExit {
            0% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        /* Sidebar exit animation */
        .sidebar-exit {
            transform: translateX(0);
            animation: sidebarExit 0.4s ease-in forwards;
        }

        @keyframes sidebarExit {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }


        .main-content {
            margin-top: 0;
            padding-top: 0;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .dashboard-container .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }



        /* Stagger animation for cards and elements */
        .content-layout > *,
        .metrics-grid > *,
        .job-grid > *,
        .branch-social-layout > * {
            opacity: 0;
            transform: translateY(30px);
            animation: staggerIn 0.6s ease-out forwards;
        }

        .content-layout > *:nth-child(1) { animation-delay: 0.1s; }
        .content-layout > *:nth-child(2) { animation-delay: 0.2s; }
        .content-layout > *:nth-child(3) { animation-delay: 0.3s; }

        .metrics-grid > *:nth-child(1) { animation-delay: 0.1s; }
        .metrics-grid > *:nth-child(2) { animation-delay: 0.2s; }
        .metrics-grid > *:nth-child(3) { animation-delay: 0.3s; }

        .job-grid > *:nth-child(1) { animation-delay: 0.1s; }
        .job-grid > *:nth-child(2) { animation-delay: 0.2s; }
        .job-grid > *:nth-child(3) { animation-delay: 0.3s; }
        .job-grid > *:nth-child(4) { animation-delay: 0.4s; }

        .branch-social-layout > *:nth-child(1) { animation-delay: 0.2s; }
        .branch-social-layout > *:nth-child(2) { animation-delay: 0.3s; }

        @keyframes staggerIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header animation */
        .top-header {
            opacity: 0;
            transform: translateY(-20px);
            animation: headerSlideIn 0.5s ease-out 0.1s forwards;
            background: #ffffff;
            border-bottom: 1px solid #F3F4F6;
            height: 72px;
            margin-top: 0;
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100vw;
            margin-left: calc(-52vw + 50%);
            box-sizing: border-box;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 16px 46px 16px 32px;
            max-width: none;
            margin: 0;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 12px;
        }

        /* Adjust header padding when sidebar is collapsed */
        .sidebar.collapsed ~ .main-content .header-container {
            padding-left: 32px;
        }

        /* Alternative selector for better compatibility */
        .dashboard-container .sidebar.collapsed ~ .main-content .header-container {
            padding-left: 30px;
        }

        /* When sidebar is expanded (default state) */
        .dashboard-container .sidebar:not(.collapsed) ~ .main-content .header-container {
            padding-left: 32px;
            padding-right: 140px;
        }

        .dashboard-container .sidebar:not(.collapsed) ~ .main-content .header-right {
            margin-right: -15px;
        }


        /* When sidebar is collapsed, adjust right padding */
        .dashboard-container .sidebar.collapsed ~ .main-content .header-container {
            padding-left: 32px;
            padding-right: 40px;
        }

        /* Ensure header left is not covered by sidebar when expanded */
        .dashboard-container .sidebar:not(.collapsed) ~ .main-content .header-left {
            padding-left: 160px;
        }

        /* Ensure header left is not covered by sidebar when collapsed */
        .dashboard-container .sidebar.collapsed ~ .main-content .header-left {
            padding-left: 80px;
        }

        .header-left {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-right: auto;
            padding-left: 60px;
        }

        .header-page-title {
            flex-shrink: 0;
        }

        .header-page-title h1 {
            font-size: 24px;
            font-weight: 600;
            color: #111827;
            margin: 0;
            white-space: nowrap;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            margin-left: auto;
            padding-right: 8px;
        }


        /* Header Icon Buttons */
        .header-icon-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: transparent;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        
        @media (max-width: 480px) {
            .header-icon-btn {
                width: 36px;
                height: 36px;
            }
        }

        .header-icon-btn:hover {
            background: #F3F4F6;
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            align-items: center;

            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s ease;
            height: 40px;
            box-sizing: border-box;
            flex-direction: row;
            flex-shrink: 0;
            padding: 4px 8px;
        }

        .profile-section:hover {
            background: #F9FAFB;
        }

        .profile-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-avatar img.company-logo {
            object-fit: contain;
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 50%;
            padding: 3px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            min-width: 0;
            flex: 1;
            gap: 2px;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 500;
            color: #111827;
            line-height: 1.0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
            margin-bottom: 0px;
            transform: translateY(-1px);
        }

        .profile-email {
            font-size: 11px;
            color: #6B7280;
            line-height: 1.0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
            margin-top: 0px;
        }

        @keyframes headerSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Header */
        @media (max-width: 1200px) {
            .header-container {
                padding: 16px 32px 16px 24px;
            }
            
            .header-left {
                gap: 10px;
                padding-left: 48px;
            }
            
            
            .header-right {
                gap: 8px;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                padding: 12px 16px;
                max-width: none;
            }

            .main-content.expanded .header-container {
                padding-left: 16px;
            }

            .header-left {
                gap: 8px;
                padding-left: 36px;
            }

            .header-page-title h1 {
                font-size: 20px;
            }


            .header-right {
                gap: 6px;
            }

            .profile-section {
                flex-direction: row;
                height: auto;
                gap: 6px;
            }
        }

        @media (max-width: 480px) {
            .header-container {
                padding: 12px 12px;
            }
            
            .header-left {
                gap: 6px;
                padding-left: 24px;
            }
            
            .header-page-title h1 {
                font-size: 18px;
            }
            

            .header-right {
                gap: 4px;
            }

            
            .profile-section {
                gap: 4px;
            }
            
            .profile-name {
                font-size: 12px;
                max-width: 80px;
            }
            
            .profile-email {
                font-size: 10px;
                max-width: 80px;
            }
        }

        /* Sidebar entrance animation */
        .sidebar {
            opacity: 0;
            transform: translateX(-20px);
            animation: sidebarEnter 0.6s ease-out forwards;
        }

        @keyframes sidebarEnter {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Smooth hover transitions for all clickable elements */
        a, button, .clickable {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        /* Prevent animation on page load for better performance */
        .preload * {
            animation-duration: 0s !important;
            animation-delay: 0s !important;
            transition-duration: 0s !important;
        }
    </style>
    
    {{-- Page specific styles --}}
    @stack('styles')
</head>
<body class="preload" style="margin: 0; padding: 0; overflow-x: hidden;">

    {{-- Include sidebar drawer functionality --}}
    @include('components.sidebar-drawer')

    <div class="dashboard-container" style="margin-top: 0; padding-top: 0;">
        {{-- Include sidebar component --}}
        @include('components.sidebar', ['activePage' => request()->route()->getName()])

        {{-- Main Content --}}
        <main class="main-content" style="margin-top: 0; padding-top: 0;">
            {{-- Top Header --}}
            <div class="top-header">
                <div class="header-container">
                    <div class="header-left">
                        @hasSection('page-title')
                        <div class="header-page-title">
                            <h1>@yield('page-title')</h1>
                        </div>
                        @endif
                    </div>
                    <div class="header-right">
                        <button class="header-icon-btn notification-icon" onclick="toggleNotificationSidebar()">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 6.66667C15 5.34058 14.4732 4.06881 13.5355 3.13115C12.5979 2.19348 11.3261 1.66667 10 1.66667C8.67392 1.66667 7.40215 2.19348 6.46447 3.13115C5.52678 4.06881 5 5.34058 5 6.66667C5 12.5 2.5 14.1667 2.5 14.1667H17.5C17.5 14.1667 15 12.5 15 6.66667Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.4417 17.5C11.2952 17.7526 11.0849 17.9622 10.8319 18.1079C10.5789 18.2537 10.292 18.3304 10 18.3304C9.70802 18.3304 9.42106 18.2537 9.16809 18.1079C8.91513 17.9622 8.70483 17.7526 8.55835 17.5" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="notification-badge">2</span>
                        </button>
                        <div class="profile-section">
                            <div class="profile-avatar">
                                @php
                                    $user = Auth::user();
                                    $isIndoGroup = $user && $user->email === 'indo@gmail.com';
                                    $hasLogo = $user && !empty($user->logo);
                                @endphp
                                
                                {{-- Force show Indo Group logo --}}
                                @if($isIndoGroup)
                                    <img src="{{ asset('images/indogroup.png') }}" alt="Indo Group" class="company-logo" title="Indo Group Logo">
                                @elseif($hasLogo)
                                    <img src="{{ $user->logo_url }}" alt="{{ $user->name }}" class="company-logo" title="Logo: {{ $user->logo }}">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=3B82F6&color=fff&size=32" alt="Profile" title="Fallback Avatar">
                                @endif
                            </div>
                            <div class="profile-info">
                                <div class="profile-name">{{ Auth::user()->name ?? 'User Name' }}</div>
                                <div class="profile-email">{{ Auth::user()->email ?? 'user@example.com' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Page Actions Section (if needed) --}}
            @hasSection('page-actions')
            <div class="page-actions-section">
                @yield('page-actions')
            </div>
            @endif

            {{-- Page Content --}}
            @yield('content')
        </main>
    </div>

    {{-- Include notification component --}}
    @include('components.notification')

    {{-- Page specific scripts --}}
    @stack('scripts')
    
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Page Transition & Profile dropdown script --}}
    <script>
        // Page transition functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Remove preload class to enable animations
            setTimeout(() => {
                document.body.classList.remove('preload');
            }, 100);

        });

        // Smooth page transitions for navigation links
        function initPageTransitions() {
            const links = document.querySelectorAll('a[href]:not([href^="#"]):not([href^="javascript:"]):not([target="_blank"])');
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // Skip if it's the current page
                    if (href === window.location.pathname) {
                        e.preventDefault();
                        return;
                    }

                    // Skip external links
                    if (href.startsWith('http') && !href.includes(window.location.hostname)) {
                        return;
                    }

                    e.preventDefault();
                    
                    // Add page transitioning class to body
                    document.body.classList.add('page-transitioning');

                    // Close notification sidebar if open
                    const notificationSidebar = document.getElementById('notificationSidebar');
                    const notificationOverlay = document.getElementById('notificationOverlay');
                    if (notificationSidebar && notificationSidebar.classList.contains('show')) {
                        notificationSidebar.classList.remove('show');
                        if (notificationOverlay) {
                            notificationOverlay.classList.remove('show');
                        }
                    }

                    // Add exit animation to main content and sidebar
                    const mainContent = document.querySelector('.main-content');
                    const sidebar = document.querySelector('.sidebar');
                    if (mainContent) {
                        mainContent.classList.add('page-exit');
                    }
                    if (sidebar) {
                        sidebar.classList.add('sidebar-exit');
                    }

                    // Navigate after animation
                    setTimeout(() => {
                        window.location.href = href;
                    }, 400);
                });
            });
        }

        // Initialize transitions when DOM is ready
        document.addEventListener('DOMContentLoaded', initPageTransitions);

        // Reinitialize after any dynamic content changes
        function reinitializeTransitions() {
            initPageTransitions();
        }

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function() {
            // Add page transitioning class to body
            document.body.classList.add('page-transitioning');
            
            // Close notification sidebar if open
            const notificationSidebar = document.getElementById('notificationSidebar');
            const notificationOverlay = document.getElementById('notificationOverlay');
            if (notificationSidebar && notificationSidebar.classList.contains('show')) {
                notificationSidebar.classList.remove('show');
                if (notificationOverlay) {
                    notificationOverlay.classList.remove('show');
                }
            }

            
            setTimeout(() => {
                location.reload();
            }, 200);
        });

        // Profile dropdown functionality
        function toggleProfileDropdown(event) {
            event.stopPropagation();
            var menu = document.getElementById('profileDropdownMenu');
            if (menu) {
                menu.classList.toggle('show');
            }
        }
        
        document.addEventListener('click', function(e) {
            var menu = document.getElementById('profileDropdownMenu');
            if(menu && menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        });

        // Enhanced smooth scrolling for internal links
        document.addEventListener('DOMContentLoaded', function() {
            const internalLinks = document.querySelectorAll('a[href^="#"]');
            internalLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

        });

        // Add loading state to forms
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    // Add page transitioning class to body
                    document.body.classList.add('page-transitioning');
                });
            });
        });
    </script>
</body>
</html>
