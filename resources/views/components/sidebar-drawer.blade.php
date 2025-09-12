{{-- Sidebar Drawer Component --}}
{{-- Include this component in the head section of your blade files --}}

<style>
    /* Sidebar Drawer Styles */
    .sidebar {
        z-index: 1000;
    }

    .sidebar.collapsed {
        width: 70px;
    }

    .sidebar.collapsed .sidebar-header {
        padding: 20px 10px;
    }

    .sidebar.collapsed .logo-image {
        width: 50px;
    }

    .sidebar.collapsed .nav-link span:not(.nav-icon) {
        display: none;
    }

    .sidebar.collapsed .nav-link {
        justify-content: center;
        padding: 12px 8px;
    }

    .sidebar.collapsed .nav-icon {
        margin: 0;
    }

    /* Tooltip for collapsed sidebar */
    .sidebar.collapsed .nav-link {
        position: relative;
    }

    .sidebar.collapsed .nav-link:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        background: #1e293b;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 1002;
        margin-left: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .sidebar.collapsed .nav-link::after {
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-right-color: #1e293b;
        margin-left: 5px;
        z-index: 1002;
        opacity: 0;
    }

    .sidebar.collapsed .nav-link:hover::after {
        opacity: 1;
    }

    /* Toggle Button - Hidden by default, only show on mobile */
    .sidebar-toggle {
        display: none;
    }

    /* Main Content */
    .main-content {
    }

    .main-content.expanded {
        margin-left: 70px;
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        display: none;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1002;
        background: #2563eb;
        border: none;
        border-radius: 8px;
        padding: 10px;
        color: white;
        cursor: pointer;
    }

    /* Sidebar Overlay for Mobile */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 999;
    }

    .sidebar-overlay.show {
        display: block;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            width: 240px;
            position: fixed;
            height: 100vh;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar.collapsed {
            width: 240px;
        }

        .main-content {
            margin-left: 0;
            padding: 16px;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .sidebar-toggle {
            right: -15px;
        }

        .mobile-menu-btn {
            display: block;
        }
    }
</style>

<script>
    // Sidebar Toggle Functions
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        const headerContainer = document.querySelector('.header-container');
        
        // Add transitioning class before toggle
        sidebar.classList.add('transitioning');
        mainContent.classList.add('transitioning');
        
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
        
        // Remove transitioning class after animation completes
        setTimeout(() => {
            sidebar.classList.remove('transitioning');
            mainContent.classList.remove('transitioning');
        }, 300);
        
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
            // Temporarily disable transitions during page load
            sidebar.style.transition = 'none';
            mainContent.style.transition = 'none';
            
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            
            // Update header padding for collapsed state
            if (headerContainer) {
                headerContainer.style.paddingLeft = '32px';
                headerContainer.style.paddingRight = '40px';
            }
            
            // Update header left padding for collapsed state
            const headerLeft = document.querySelector('.header-left');
            if (headerLeft) {
                headerLeft.style.paddingLeft = '80px';
            }
            
            // Re-enable transitions after a brief delay
            setTimeout(() => {
                sidebar.style.transition = '';
                mainContent.style.transition = '';
            }, 50);
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
