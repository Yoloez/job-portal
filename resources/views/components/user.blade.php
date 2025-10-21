<!-- User Dashboard Content -->
<div class="user-dashboard">
    <h2>User Dashboard</h2>
    <p>Browse jobs, update your profile, and track applications. yes sir</p>
    <div class="dashboard-links">
        <a href="#">Browse Jobs</a>
        <a href="#">My Profile</a>
        <a href="#">My Applications</a>
    </div>
</div>

<style>
.user-dashboard {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 20px;
}

.user-dashboard h2 {
    color: #333;
    margin-bottom: 15px;
    font-size: 1.8em;
}

.user-dashboard p {
    color: #666;
    font-size: 1.1em;
    margin-bottom: 20px;
}

.dashboard-links {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
}

.dashboard-links a {
    background: rgba(255, 255, 255, 0.8);
    color: #333;
    padding: 12px 24px;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.dashboard-links a:hover {
    background: rgba(255, 255, 255, 1);
    transform: translateY(-2px);
}
</style>
