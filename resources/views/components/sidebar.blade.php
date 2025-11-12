{{-- resources/views/components/sidebar.blade.php --}}
<aside class="sidebar text-white" style="width: 280px; min-height: 100vh; position: fixed; left: 0; top: 0; overflow-y: auto; background: linear-gradient(180deg, #667eea 0%, #764ba2 50%, #4568dc 100%); box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);">
    <div class="p-4">
        <!-- Header -->
        <div class="text-center mb-5 mt-3">
            <div class="logo-circle mb-3" style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.3);">
                <i class="bi bi-grid-3x3-gap" style="font-size: 32px;"></i>
            </div>
            <h4 class="mb-0" style="font-weight: 600; letter-spacing: 0.5px;">Admin Panel</h4>
            <small style="opacity: 0.8;">Management System</small>
        </div>
        
        <!-- Navigation Menu -->
        <ul class="nav flex-column" style="gap: 8px;">
            <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link text-white d-flex align-items-center {{ request()->routeIs('admin.index') ? 'active' : '' }}" style="padding: 14px 18px; border-radius: 12px; transition: all 0.3s ease;">
                    <i class="bi bi-speedometer2 me-3" style="font-size: 20px;"></i>
                    <span style="font-weight: 500;">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('jobs.index') }}" class="nav-link text-white d-flex align-items-center {{ request()->routeIs('jobs.index') ? 'active' : '' }}" style="padding: 14px 18px; border-radius: 12px; transition: all 0.3s ease;">
                    <i class="bi bi-briefcase me-3" style="font-size: 20px;"></i>
                    <span style="font-weight: 500;">Jobs</span>
                </a>
            </li>
            
            <!-- Divider -->
            <li style="margin: 20px 0;">
                <hr style="border-color: rgba(255, 255, 255, 0.2); opacity: 0.5;">
            </li>
            
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link text-white d-flex align-items-center logout-link" style="padding: 14px 18px; border-radius: 12px; transition: all 0.3s ease;">
                    <i class="bi bi-box-arrow-right me-3" style="font-size: 20px;"></i>
                    <span style="font-weight: 500;">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Footer Badge -->
    <div class="mt-auto p-4" style="position: absolute; bottom: 20px; width: 100%;">
        <div class="text-center p-3" style="background: rgba(255, 255, 255, 0.1); border-radius: 12px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
            <small style="opacity: 0.9;">© 2024 Admin Panel</small>
        </div>
    </div>
</aside>

<style>
    .sidebar .nav-link {
        position: relative;
        overflow: hidden;
    }
    
    .sidebar .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .sidebar .nav-link:hover::before {
        transform: translateX(0);
    }
    
    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .sidebar .nav-link.active {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        border-left: 4px solid #fff;
    }
    
    .sidebar .nav-link.active i {
        animation: pulse 2s infinite;
    }
    
    .sidebar .logout-link:hover {
        background: rgba(255, 59, 48, 0.2);
        border-left: 4px solid #ff3b30;
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }
    
    .logo-circle {
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    /* Scrollbar Styling */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }
    
    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
    }
    
    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
</style>