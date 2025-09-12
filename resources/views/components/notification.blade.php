{{-- Include notification styles --}}
@include('components.notification-styles')

{{-- Notification Sidebar Component --}}
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
        
        <div class="notification-item">
            <div class="notification-icon">
                <svg width="16" height="16" fill="none" stroke="#8b5cf6" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
            </div>
            <div class="notification-details">
                <div class="notification-title">Review Positif</div>
                <div class="notification-message">Perusahaan ABC memberikan rating 5 bintang untuk layanan Anda</div>
                <div class="notification-time">5 jam yang lalu</div>
            </div>
        </div>
    </div>
    
    <div class="notification-footer">
        <button class="mark-all-read-btn" onclick="markAllAsRead()">Tandai Semua Dibaca</button>
    </div>
</div>

{{-- Notification Overlay --}}
<div class="notification-overlay" id="notificationOverlay" onclick="toggleNotificationSidebar()"></div>

{{-- Notification JavaScript --}}
<script>
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

function markAllAsRead() {
    var unreadItems = document.querySelectorAll('.notification-item.unread');
    unreadItems.forEach(function(item) {
        item.classList.remove('unread');
    });
    
    // Update notification badge
    var badge = document.querySelector('.notification-badge');
    if(badge) {

        badge.style.display = 'none';
    }
}

// Close notification sidebar when clicking outside
document.addEventListener('click', function(e) {
    var sidebar = document.getElementById('notificationSidebar');
    var overlay = document.getElementById('notificationOverlay');
    var trigger = document.querySelector('.notification-icon');
    
    if (sidebar && overlay && trigger) {
        if (!sidebar.contains(e.target) && !trigger.contains(e.target) && sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }
    }
});
</script>

