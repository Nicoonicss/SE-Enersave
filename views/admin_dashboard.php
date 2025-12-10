<?php
$pageTitle = 'Admin Dashboard Overview';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Overview - EnerSave</title>
    <link rel="stylesheet" href="/css/styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-profile {
            position: relative;
        }
        .avatar-container {
            position: relative;
            display: inline-block;
        }
        .avatar {
            cursor: pointer;
        }
        .avatar-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 150px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.2s ease, visibility 0.2s ease, transform 0.2s ease;
            z-index: 1000;
        }
        .avatar-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .avatar-dropdown-item {
            display: block;
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            transition: background-color 0.2s ease;
        }
        .avatar-dropdown-item:hover {
            background-color: #f5f5f5;
        }
        .avatar-dropdown-item:first-child {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .avatar-dropdown-item:last-child {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .avatar-dropdown-item.logout {
            color: #d32f2f;
        }
        .avatar-dropdown-item.logout:hover {
            background-color: #ffebee;
        }
        .dashboard-container {
            max-width: 100%;
            width: 100%;
            padding: 30px 50px;
            margin: 0;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-top: 30px;
        }
        .metrics-cards {
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }
        .card {
            padding: 30px 24px;
            min-height: 120px;
        }
        .quick-actions-panel {
            grid-column: 1 / -1;
            margin-bottom: 0;
        }
        .recent-activity-panel {
            grid-column: 1;
        }
        .system-status-panel {
            grid-column: 2;
        }
        .quick-actions-panel,
        .recent-activity-panel,
        .system-status-panel {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            height: fit-content;
        }
        .action-buttons {
            display: flex;
            flex-direction: row;
            gap: 15px;
        }
        .action-buttons button {
            flex: 1;
            justify-content: center;
            background-color: #d1fae5;
            color: #000;
            border: none;
            border-radius: 25px;
            padding: 12px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .action-buttons button i {
            color: #000;
        }
        .action-buttons button:hover {
            background-color: #a7f3d0;
        }
        .data-management-panel {
            width: 100%;
        }
        .activity-list li {
            background-color: #f5f5f5;
            border-radius: 8px;
            margin-bottom: 8px;
            padding: 14px 16px;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .activity-list li:last-child {
            margin-bottom: 0;
        }
        .activity-arrow {
            color: #666;
            font-size: 0.875rem;
        }
        .export-btn {
            background-color: var(--admin-green);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .export-btn:hover {
            background-color: #229954;
        }
        .export-btn i {
            color: white;
            margin-right: 8px;
        }
        .view-all-btn {
            background-color: #f5f5f5;
            color: #333;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .view-all-btn:hover {
            background-color: #e8e8e8;
        }
        .view-all-btn i {
            color: #333;
            margin-right: 8px;
        }
        .status-item {
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .status-item:last-child {
            border-bottom: none;
        }
        .status-value.green {
            color: var(--admin-green);
            font-weight: 700;
        }
        .status-value.red {
            color: var(--admin-red);
            font-weight: 700;
        }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <img src="/images/Logo.png" alt="EnerSave Logo"> 
            EnerSave
        </div>
        <nav class="main-nav">
            <a href="/adminDashboard" class="nav-item active">Dashboard</a>
            <a href="/usersManagement" class="nav-item">Users</a>
            <a href="/suppliersManagement" class="nav-item">Suppliers</a>
            <a href="/projectsManagement" class="nav-item">Projects</a>
        </nav>
        <div class="admin-profile">
            <span>Admin: <?php echo htmlspecialchars($username); ?></span>
            <div class="avatar-container">
                <div class="avatar" id="avatarDropdown"><i class="fas fa-user-circle"></i></div>
                <div class="avatar-dropdown" id="avatarMenu">
                    <a href="#" class="avatar-dropdown-item">Settings</a>
                    <a href="/logout" class="avatar-dropdown-item logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <main class="dashboard-container">
        <section id="dashboard" class="page-content active-page">
            <h1 class="page-title">ADMIN DASHBOARD OVERVIEW</h1>
            <p class="page-subtitle">A summary of key platform metrics.</p>

            <div class="metrics-cards">
                <div class="card">
                    <span class="metric-title">Total Users</span>
                    <span class="metric-value">340</span>
                </div>
                <div class="card">
                    <span class="metric-title">Total Suppliers</span>
                    <span class="metric-value">42</span>
                </div>
                <div class="card">
                    <span class="metric-title">Active Projects</span>
                    <span class="metric-value">18</span>
                </div>
                <div class="card">
                    <span class="metric-title">Total Donations</span>
                    <span class="metric-value">P280k</span>
                </div>
            </div>

            <div class="dashboard-grid">
                
                <div class="quick-actions-panel">
                    <h2>Quick Actions</h2>
                    <div class="action-buttons">
                        <button onclick="window.location.href='/usersManagement'"><i class="fas fa-users"></i> Manage Users</button>
                        <button onclick="window.location.href='/suppliersManagement'"><i class="fas fa-bolt"></i> Manage Suppliers</button>
                        <button onclick="window.location.href='/projectsManagement'"><i class="fas fa-sun"></i> Manage Projects</button>
                    </div>
                </div>

                <div class="recent-activity-panel">
                    <h2>Recent Activity</h2>
                    <ul class="activity-list">
                        <li>
                            <div class="activity-text">
                                <div class="activity-title">New Supplier Registered: <strong>GreenTech Power</strong></div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                            <i class="fas fa-chevron-right activity-arrow"></i>
                        </li>
                        <li>
                            <div class="activity-text">
                                <div class="activity-title">New Project Submitted: <strong>Solar for Hope</strong></div>
                                <div class="activity-time">5 hours ago</div>
                            </div>
                            <i class="fas fa-chevron-right activity-arrow"></i>
                        </li>
                        <li>
                            <div class="activity-text">
                                <div class="activity-title">Donation Received: <strong>P5,000 from EcoFund Inc.</strong></div>
                                <div class="activity-time">1 day ago</div>
                            </div>
                            <i class="fas fa-chevron-right activity-arrow"></i>
                        </li>
                        <li>
                            <div class="activity-text">
                                <div class="activity-title">User Account Updated: <strong>Sarah Discaya (Community)</strong></div>
                                <div class="activity-time">2 days ago</div>
                            </div>
                            <i class="fas fa-chevron-right activity-arrow"></i>
                        </li>
                    </ul>
                    
                    <div class="activity-footer">
                        <button class="btn export-btn"><i class="fas fa-download"></i> Export Report</button>
                        <button class="btn view-all-btn"><i class="fas fa-bell"></i> View All Notifications</button>
                    </div>
                </div>

                <div class="system-status-panel">
                    <h2>System Status</h2>
                    <div class="status-item">
                        <span>Platform Uptime:</span>
                        <span class="status-value green">99.8%</span>
                    </div>
                    <div class="status-item">
                        <span>Pending Supplier Verifications:</span>
                        <span class="status-value red">3</span>
                    </div>
                    <div class="status-item">
                        <span>Active Crowdfunding Projects:</span>
                        <span class="status-value">18</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="/JavaScripts/navigationAdmin.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
</body>
</html>
