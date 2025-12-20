<div class="footer-container">
    <!-- Left side - Brand -->
    <div class="footer-brand">
        <h1 class="brand-title">Job Portal</h1>
        <div class="brand-line"></div>
    </div>
    
    <!-- Center - Divider -->
    <div class="footer-divider">
        <div class="divider-line"></div>
    </div>
    
    <!-- Right side - Copyright -->
    <div class="footer-copyright">
        <p class="copyright-text">© 2025 Copyright</p>
        <p class="rights-text">All Rights Reserved</p>
    </div>
</div>

<style>
.footer-container {
    display: flex;
    margin-left: 30px;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    background: #ffffff;
    padding: 32px 48px;
    border-top: 1px solid #e5e7eb;
    position: relative;
}

/* Left side - Brand */
.footer-brand {
    position: relative;
}

.brand-title {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    letter-spacing: -0.3px;
}

.brand-line {
    width: 48px;
    height: 2px;
    background: #000000;
    margin-top: 8px;
    border-radius: 1px;
}

/* Center - Divider */
.footer-divider {
    flex: 1;
    max-width: 300px;
    margin: 0 48px;
    position: relative;
}

.divider-line {
    height: 1px;
    background: #e5e7eb;
}

/* Right side - Copyright */
.footer-copyright {
    text-align: right;
}

.copyright-text {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    color: #111827;
    letter-spacing: 0;
}

.rights-text {
    margin: 4px 0 0 0;
    font-size: 13px;
    color: #6b7280;
    font-weight: 400;
    letter-spacing: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        gap: 24px;
        padding: 32px 24px;
        margin-left: 0;
    }
    
    .footer-brand {
        text-align: center;
    }
    
    .brand-line {
        margin: 8px auto 0;
    }
    
    .footer-divider {
        width: 100%;
        max-width: 200px;
        margin: 0;
    }
    
    .footer-copyright {
        text-align: center;
    }
}
</style>