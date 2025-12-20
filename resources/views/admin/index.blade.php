@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<div class="dashboard-container">
    <div class="container">
        <!-- Header Section -->
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-subtitle">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="btn-primary">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Manage Jobs
            </a>
        </div>

        <!-- Notifications Section -->
        <div class="notifications-section">
            <div class="section-header">
                <h2 class="section-title">Notifications</h2>
                @if($notifications->count() > 0)
                    <span class="notification-badge">{{ $notifications->count() }}</span>
                @endif
            </div>

            @if($notifications->count() > 0)
                <div class="notifications-list">
                    @foreach($notifications as $notification)
                        <div class="notification-item">
                            <div class="notification-icon">
                                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="notification-content">
                                <p class="notification-text">
                                    New application for <strong>{{ $notification->data['job_title'] }}</strong> by <strong>{{ $notification->data['user_name'] }}</strong>
                                </p>
                            </div>
                            <a href="{{ route('admin.notification.read', $notification->id) }}" class="btn-mark-read">
                                Mark as Read
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-notifications">
                    <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <p class="empty-text">No new notifications</p>
                </div>
            @endif
        </div>

        <!-- Logout Section -->
        <div class="logout-section">
            <a href="{{ route('logout') }}" class="btn-logout">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </a>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    background: #ffffff;
    min-height: 100vh;
    padding: 48px 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Header Section */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 48px;
    padding-bottom: 24px;
    border-bottom: 1px solid #e5e7eb;
    flex-wrap: wrap;
    gap: 16px;
}

.dashboard-title {
    font-size: 32px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 4px;
    letter-spacing: -0.5px;
}

.dashboard-subtitle {
    font-size: 15px;
    color: #6b7280;
    margin: 0;
}

.btn-primary {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #000000;
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background: #1f2937;
    color: #ffffff;
    transform: translateY(-1px);
}

/* Notifications Section */
.notifications-section {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 32px;
    margin-bottom: 32px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
}

.section-title {
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.notification-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 24px;
    height: 24px;
    padding: 0 8px;
    background: #000000;
    color: #ffffff;
    font-size: 12px;
    font-weight: 600;
    border-radius: 12px;
}

/* Notifications List */
.notifications-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.notification-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.notification-item:hover {
    background: #ffffff;
    border-color: #d1d5db;
}

.notification-icon {
    width: 40px;
    height: 40px;
    background: #000000;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: #ffffff;
}

.notification-content {
    flex: 1;
}

.notification-text {
    font-size: 14px;
    color: #4b5563;
    margin: 0;
    line-height: 1.5;
}

.notification-text strong {
    color: #111827;
    font-weight: 600;
}

.btn-mark-read {
    padding: 8px 16px;
    background: #ffffff;
    color: #111827;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.btn-mark-read:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    color: #111827;
}

/* Empty State */
.empty-notifications {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 48px 24px;
    text-align: center;
}

.empty-notifications svg {
    color: #9ca3af;
    margin-bottom: 16px;
}

.empty-text {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

/* Logout Section */
.logout-section {
    display: flex;
    justify-content: flex-start;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
}

.btn-logout {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #ffffff;
    color: #dc2626;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-logout:hover {
    background: #fef2f2;
    border-color: #fecaca;
    color: #dc2626;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .btn-primary {
        width: 100%;
        justify-content: center;
    }
    
    .notification-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .btn-mark-read {
        width: 100%;
        text-align: center;
    }
    
    .notifications-section {
        padding: 24px 16px;
    }
}
</style>
@endsection