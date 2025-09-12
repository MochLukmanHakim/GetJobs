<style>
    /* Notification Icon in Header */
    .notification-icon {
        position: relative;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background: none;
        border: none;
        outline: none;
        padding: 0;
        margin: 0;
        box-shadow: none;
    }

    .notification-icon:hover {
        transform: scale(1.05);
        background: #e5e7eb !important;
    }

    /* Remove all button default styles */
    .notification-icon:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }

    .notification-icon:active {
        outline: none;
        border: none;
        box-shadow: none;
    }

    .notification-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 11px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
       
    }

    /* Notification Sidebar */
    .notification-sidebar {
        position: fixed;
        top: 0;
        right: -380px;
        width: 380px;
        height: 100vh;
        background: white;
       
        z-index: 1001;
        transition: right 0.3s ease;
        display: flex;
        flex-direction: column;
        border-left: 1px solid #e5e7eb;
    }

    .notification-sidebar.show {
        right: 0;
    }

    .notification-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        color: #111827;
    }

    .notification-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #111827;
    }

    .close-notification-btn {
        background: #f3f4f6;
        border: none;
        color: #6b7280;
        cursor: pointer;
        padding: 8px;
        border-radius: 6px;
        transition: all 0.2s ease;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-notification-btn:hover {
        background: #e5e7eb;
        color: #374151;
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
        align-items: flex-start;
        gap: 12px;
        transition: background 0.2s ease;
        cursor: pointer;
    }

    .notification-item:hover {
        background: #e2e8f0;
    }

    .notification-item.unread {
        background: #eff6ff;
        border-left: 3px solid #3b82f6;
    }

    .notification-item.unread:hover {
        background: #dbeafe;
    }

    .notification-item .notification-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #f3f4f6;
        font-size: 16px;
        color: #6b7280;
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
        background: #577C8E;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .mark-all-read-btn:hover {
        background: #4a6b7a;
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
</style>
