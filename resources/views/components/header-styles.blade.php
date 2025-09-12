<style>
        /* Header animation */
        .top-header {
            opacity: 0;
            transform: translateY(-20px);
            animation: headerSlideIn 0.5s ease-out 0.1s forwards;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background: #ffffff;
            border-bottom: 1px solid #F3F4F6;
            height: 72px;
            margin-top: 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            flex-shrink: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }


        /* Header Icon Buttons */
        .header-icon-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .header-icon-btn:hover {
            background: #F3F4F6;
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            cursor: pointer;
            padding: 6px 8px 2px 8px;
            border-radius: 8px;
            transition: all 0.2s ease;
            height: 40px;
            box-sizing: border-box;
            flex-direction: row;
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

        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            min-width: 0;
            flex: 1;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 500;
            color: #111827;
            line-height: 1.1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
        }

        .profile-email {
            font-size: 11px;
            color: #6B7280;
            line-height: 1.1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
            margin-top: 2px;
        }

        /* Header Animation Keyframes */
        @keyframes headerSlideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Header */
        @media (max-width: 768px) {
            .top-header {
                padding: 12px 16px;
            }

            .header-right {
                gap: 12px;
            }

            .profile-section {
                flex-direction: column;
                height: auto;
                gap: 4px;
            }

            .profile-info {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .profile-name,
            .profile-email {
                max-width: 80px;
            }
        }
</style>
