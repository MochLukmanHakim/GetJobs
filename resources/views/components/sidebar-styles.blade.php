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
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .sidebar-toggle:hover {
        background: #1d4ed8;
        transform: scale(1.1);
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
        padding: 29px 20px 20px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 20px;
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
        transition: all 0.3s ease;
    }

    /* Logo becomes clickable toggle when collapsed */
    .sidebar.collapsed .profile-avatar {
        cursor: pointer;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 8px;
        margin-bottom: 0;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed .profile-avatar:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.05);
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

    .sidebar.collapsed ~ .main-content .content-layout {
        max-width: calc(100vw - 70px - 64px);
    }

    .sidebar.collapsed ~ .main-content .profile-card {
        flex: 0 0 280px;
        max-width: 280px;
    }

    .sidebar.collapsed ~ .main-content .content-right {
        flex: 1;
        min-width: 250px;
    }

    .sidebar.collapsed ~ .main-content .branch-social-layout {
        flex-direction: column;
        gap: 8px;
    }

    .sidebar.collapsed ~ .main-content .branch-card,
    .sidebar.collapsed ~ .main-content .social-card {
        min-width: 100%;
        flex: 1;
    }

    .sidebar.collapsed ~ .main-content .metrics-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 240px;
        padding: 24px 32px;
        background: #F9FAFB;
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

    .notification-icon {
        position: relative;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        font-size: 14px;
        background: none;
    }

    .notification-icon:hover {
        transform: scale(1.05);
    }

    .notification-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 14px;
        height: 14px;
        background: #ef4444;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        color: white;
        font-weight: 600;
    }

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

    /* Notification Sidebar Styles */
    .notification-sidebar {
        position: fixed;
        top: 0;
        right: -400px;
        width: 400px;
        height: 100vh;
        background: white;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        transition: right 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .notification-sidebar.show {
        right: 0;
    }

    .notification-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        color: white;
    }

    .notification-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .close-notification-btn {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: background 0.2s ease;
    }

    .close-notification-btn:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .notification-content {
        flex: 1;
        overflow-y: auto;
        padding: 0;
    }

    .notification-item {
        padding: 16px 20px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        gap: 12px;
        transition: background 0.2s ease;
        cursor: pointer;
    }

    .notification-item:hover {
        background: #f9fafb;
    }

    .notification-item.unread {
        background: #eff6ff;
        border-left: 3px solid #2563eb;
    }

    .notification-item.unread:hover {
        background: #dbeafe;
    }

    .notification-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notification-details {
        flex: 1;
    }

    .notification-title {
        font-weight: 600;
        font-size: 14px;
        color: #111827;
        margin-bottom: 4px;
    }

    .notification-message {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.4;
        margin-bottom: 4px;
    }

    .notification-time {
        font-size: 12px;
        color: #9ca3af;
    }

    .notification-footer {
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    .mark-all-read-btn {
        width: 100%;
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .mark-all-read-btn:hover {
        background: linear-gradient(135deg, #475569 0%, #334155 100%);
        transform: translateY(-1px);
    }

    .notification-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .notification-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .notification-sidebar {
            width: 100%;
            right: -100%;
        }
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
