<div class="header-container">
    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
        <span class="nav-text">Home</span>
    </a>
    
    <a href="/about" class="nav-link {{ request()->is('about') ? 'active' : '' }}">
        <span class="nav-text">About</span>
    </a>
    
    <a href="/login" class="nav-link {{ request()->is('login') ? 'active' : '' }}">
        <span class="nav-text">Login</span>
    </a>
    
    <a href="/register" class="nav-link {{ request()->is('register') ? 'active' : '' }}">
        <span class="nav-text">Register</span>
    </a>
</div>

<style>
.header-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    padding: 16px 40px;
    border-bottom: 1px solid #e5e7eb;
    position: relative;
}

.nav-link {
    text-decoration: none;
    color: #6b7280;
    padding: 10px 24px;
    border-radius: 8px;
    transition: all 0.2s ease;
    position: relative;
    background: transparent;
    border: 1px solid transparent;
}

.nav-link:hover {
    color: #111827;
    background: #f9fafb;
}

.nav-link.active {
    color: #ffffff;
    background: #000000;
    border-color: #000000;
}

.nav-text {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .header-container {
        padding: 16px 20px;
        gap: 4px;
    }
    
    .nav-link {
        padding: 10px 16px;
    }
    
    .nav-text {
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .header-container {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .nav-link {
        flex: 1;
        min-width: 100px;
        text-align: center;
    }
}
</style>