{{-- Top Header --}}
<div class="top-header">
    <div class="header-left">
    </div>
    <div class="header-right">
        <button class="header-icon-btn">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.66667 10H18.3333M10 1.66667L18.3333 10L10 18.3333" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <button class="header-icon-btn notification-btn" onclick="toggleNotificationSidebar()">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 6.66667C15 5.34058 14.4732 4.06881 13.5355 3.13115C12.5979 2.19348 11.3261 1.66667 10 1.66667C8.67392 1.66667 7.40215 2.19348 6.46447 3.13115C5.52678 4.06881 5 5.34058 5 6.66667C5 12.5 2.5 14.1667 2.5 14.1667H17.5C17.5 14.1667 15 12.5 15 6.66667Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11.4417 17.5C11.2952 17.7526 11.0849 17.9622 10.8319 18.1079C10.5789 18.2537 10.292 18.3304 10 18.3304C9.70802 18.3304 9.42106 18.2537 9.16809 18.1079C8.91513 17.9622 8.70483 17.7526 8.55835 17.5" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <div class="profile-section">
            <div class="profile-avatar">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=3B82F6&color=fff&size=32" alt="Profile">
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ Auth::user()->name ?? 'User Name' }}</div>
                <div class="profile-email">{{ Auth::user()->email ?? 'user@example.com' }}</div>
            </div>
        </div>
    </div>
</div>
