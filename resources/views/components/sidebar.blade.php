{{-- resources/views/components/sidebar.blade.php --}}
<aside class="sidebar" style="width: 260px; min-height: 100vh; position: fixed; left: 0; top: 0; overflow-y: auto; background: #ffffff; border-right: 1px solid #e5e7eb;">
    <div class="sidebar-content">
        <!-- Header -->
        <div class="sidebar-header">
            <h4 class="sidebar-title">Admin Panel</h4>
            <p class="sidebar-subtitle">Job Portal</p>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 nav-icon"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('jobs.index') }}" class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}">
                        <i class="bi bi-briefcase nav-icon"></i>
                        <span class="nav-text">Jobs</span>
                    </a>
                </li>
            </ul>
            
            <!-- Divider -->
            <div class="nav-divider"></div>
            
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link logout-link">
                        <i class="bi bi-box-arrow-right nav-icon"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    
    <!-- Footer -->
    <div class="sidebar-footer">
        <p class="footer-text">© 2025 Hanan Fijananto</p>
    </div>
</aside>

<style>
/* Sidebar Base */
.sidebar {
    display: flex;
    flex-direction: column;
}

.sidebar-content {
    flex: 1;
    padding: 32px 20px;
}

/* Header */
.sidebar-header {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 32px;
    border-bottom: 1px solid #f3f4f6;
}

.logo-container {
    width: 56px;
    height: 56px;
    background: #000000;
    border-radius: 12px;
    margin: 0 auto 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 28px;
}

.sidebar-title {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 4px;
    letter-spacing: -0.3px;
}

.sidebar-subtitle {
    font-size: 13px;
    color: #6b7280;
    margin: 0;
    font-weight: 400;
}

/* Navigation */
.sidebar-nav {
    display: flex;
    flex-direction: column;
}

.nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.nav-item {
    margin: 0;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    border-radius: 8px;
    text-decoration: none;
    color: #4b5563;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
    position: relative;
}

.nav-link:hover {
    background: #f9fafb;
    color: #111827;
}

.nav-link.active {
    background: #000000;
    color: #ffffff;
}

.nav-link.active .nav-icon {
    color: #ffffff;
}

.nav-icon {
    font-size: 18px;
    margin-right: 12px;
    color: #6b7280;
    transition: all 0.2s ease;
}

.nav-link:hover .nav-icon {
    color: #111827;
}

.nav-text {
    flex: 1;
}

/* Logout Link */
.logout-link:hover {
    background: #fef2f2;
    color: #dc2626;
}

.logout-link:hover .nav-icon {
    color: #dc2626;
}

/* Divider */
.nav-divider {
    height: 1px;
    background: #f3f4f6;
    margin: 24px 0;
}

/* Footer */
.sidebar-footer {
    padding: 20px;
    border-top: 1px solid #f3f4f6;
    background: #fafafa;
}

.footer-text {
    font-size: 12px;
    color: #9ca3af;
    text-align: center;
    margin: 0;
    font-weight: 400;
}

/* Scrollbar */
.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #e5e7eb;
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #d1d5db;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        position: relative;
        min-height: auto;
    }
}
</style>