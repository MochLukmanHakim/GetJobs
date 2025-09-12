<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: #f8f9fa;
        color: #333;
    }

    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }

    /* Left Sidebar */
    .sidebar {
        width: 240px;
        background: white;
        color: #333;
        padding: 0;
        position: fixed;
        height: 100vh;
        overflow-y: auto;
        border-right: 1px solid #e5e7eb;
        z-index: 1000;
    }

    /* Simple sidebar width animation */
    .sidebar {
        transition: width 0.3s ease;
    }

    .sidebar.collapsed {
        width: 70px;
    }

    .sidebar.collapsed .sidebar-header {
        height: 100px;
        padding-top: 20px;
    }

    /* Logo Section Styles */
    .logo-section {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        cursor: pointer;
        width: 100%;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.25, 0.1, 0.25, 1);
    }

    /* Smooth logo section transition */
    .sidebar.collapsed .logo-section {
        padding: 0 5px;
    }

    .logo-image {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    .logo-text {
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        opacity: 1;
    }

    /* Collapsed state styles */
    .sidebar.collapsed .logo-section {
        justify-content: center;
        padding: 20px 15px;
    }

    .sidebar.collapsed .logo-image {
        width: 28px;
        height: 28px;
    }

    .sidebar.collapsed .logo-text {
        opacity: 0;
        transform: translateX(-10px);
        width: 0;
        overflow: hidden;
    }



    /* Natural logo animation */
    .logo-image {
        transition: all 0.4s cubic-bezier(0.25, 0.1, 0.25, 1);
        transform-origin: center;
    }

    /* Logo scaling for natural resize */
    .sidebar:not(.collapsed) .logo-image {
        transform: scale(1);
        opacity: 1;
    }

    .sidebar.collapsed .logo-image {
        transform: scale(0.75);
        opacity: 0.9;
    }

    .sidebar.collapsed .nav-link span:not(.nav-icon) {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar:not(.collapsed) .nav-link span:not(.nav-icon) {
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    .sidebar.collapsed .nav-link {
        justify-content: center;
        padding: 12px 8px;
    }

    /* Animate nav link padding and icon margins only when transitioning */
    .sidebar.transitioning .nav-link {
        transition: padding 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar.collapsed .nav-icon {
        margin: 0;
    }

    .sidebar.transitioning .nav-icon {
        transition: margin 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Tooltip for both collapsed and expanded sidebar */
    .nav-link {
        position: relative;
    }

    .nav-link:hover::after {
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

    .nav-link::after {
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

    .nav-link:hover::after {
        opacity: 1;
    }

    /* Toggle Button */
    .sidebar-toggle {
        position: absolute;
        top: 20px;
        right: -15px;
        width: 30px;
        height: 30px;
        background: #2563eb;
        border: 2px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1001;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .sidebar-toggle:hover {
        background: #1d4ed8;
    }

    .sidebar-toggle svg {
        width: 16px;
        height: 16px;
        color: white;
    }

    .sidebar.collapsed .sidebar-toggle svg {
        transform: rotate(180deg);
    }

    .sidebar-header {
        text-align: left;
        margin-bottom: 20px;
        height: 100px;
        display: flex;
        align-items: flex-end;
        padding-bottom: 0px;
        padding-top: 20px;
    }

    .profile-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 12px;
    }

    .profile-avatar {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .logo-image {
        width: 140px;
        height: auto;
        object-fit: contain;
    }

    /* Logo becomes clickable toggle when collapsed */
    .sidebar.collapsed .profile-avatar {
        cursor: pointer;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 8px;
        margin-bottom: 0;
    }

    .sidebar.collapsed .profile-avatar:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .sidebar.collapsed .logo-image {
        width: 32px;
        height: 32px;
        object-fit: contain;
    }

    /* Responsive layout adjustments when sidebar is collapsed */
    .sidebar.collapsed ~ .main-content {
        margin-left: 70px;
    }


    .nav-menu {
        list-style: none;
        padding: 0 16px;
    }

    .nav-item {
        margin-bottom: 4px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #577C8E;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        font-size: 13px;
        position: relative;
    }

    .nav-link:hover {
        background: #C7E0F6;
        color: #2F4157;
    }
    

    .nav-link.active {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        color: white;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .nav-icon {
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: #577C8E;
    }

    .nav-link.active .nav-icon {
        color: white;
    }

    /* Sidebar Footer & Logout Button */
    .sidebar-footer {
        margin-top: auto;
        padding: 16px;
    }

    .logout-form {
        width: 100%;
    }

    .logout-btn {
        width: 100%;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 8px;
        color: #577C8E;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        
    }

    .logout-btn:hover {
        background: #C7E0F6;
        color: #2F4157;
    }

    .logout-btn .nav-icon {
        color: #ef4444;
        font-size: 16px;
    }

    .logout-btn:hover .nav-icon {
        color: #dc2626;
    }

    /* Collapsed sidebar logout button */
    .sidebar.collapsed .sidebar-footer {
        padding: 16px 10px;
    }

    /* Animate sidebar footer padding only when transitioning */
    .sidebar.transitioning .sidebar-footer {
        transition: padding 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar.collapsed .logout-btn {
        justify-content: center;
        padding: 12px 8px;
    }

    /* Animate logout button only when transitioning */
    .sidebar.transitioning .logout-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar.collapsed .logout-btn span:not(.nav-icon) {
        opacity: 0;
        transform: translateX(-10px);
    }

    /* Animate logout text only when transitioning */
    .sidebar.transitioning .logout-btn span:not(.nav-icon) {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    /* Show logout text with animation when sidebar is expanded */
    .sidebar:not(.collapsed) .logout-btn span:not(.nav-icon) {
        opacity: 1;
        transform: translateX(0);
    }

    /* Hide scrollbar when sidebar is collapsed */
    .sidebar.collapsed {
        overflow: hidden;
    }

    .sidebar.collapsed .nav-menu {
        overflow: hidden;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 240px;
        padding: 24px 32px;
        background: #F9FAFB;
    }

    /* Smooth main content margin animation */
    .main-content {
        transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .main-content.expanded {
        margin-left: 70px;
    }

    /* Top Header */
    .top-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .profile-mini {
        display: flex;
        align-items: center;
        gap: 8px;
        background: none;
        position: relative;
        cursor: pointer;
    }

    .profile-mini-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 15px;
    }

    .profile-mini-name {
        font-size: 14px;
        font-weight: 600;
        color: #2F4157;
    }

    .profile-dropdown-menu {
        display: none;
        position: absolute;
        top: 110%;
        right: 0;
        min-width: 140px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        z-index: 100;
        padding: 8px 0;
    }

    .profile-dropdown-menu.show {
        display: block;
    }

    .profile-dropdown-item {
        padding: 10px 20px;
        font-size: 14px;
        color: #374151;
        cursor: pointer;
        transition: background 0.2s;
        text-align: left;
        background: none;
        border: none;
        width: 100%;
        display: block;
    }

    .profile-dropdown-item:hover {
        background: #f3f4f6;
    }

    /* Notification Icon styling moved to notification-styles.blade.php to avoid conflicts */


    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #111827;
        white-space: nowrap;
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

    /* Responsive */
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

        .top-header {
            flex-direction: column;
            gap: 16px;
            align-items: flex-start;
        }

        .header-right {
            width: 100%;
            justify-content: space-between;
        }

        .mobile-menu-btn {
            display: block;
        }
    }
</style>
