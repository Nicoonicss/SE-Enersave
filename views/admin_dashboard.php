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
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f7f7;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 15px;
        }

        .nav-left img {
            width: 30px;
        }

        .nav-left a,
        .nav-right a {
            text-decoration: none;
            color: black;
            font-weight: 500;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 15px;
        }

        .brand-name {
            font-weight: 900;
            font-size: 18px;
        }

        .main-nav {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-left: 20px;
        }

        .main-nav .nav-item {
            text-decoration: none;
            color: black;
            font-weight: 500;
            font-size: 15px;
            padding: 5px 0;
            transition: color 0.2s ease;
        }

        .main-nav .nav-item:hover {
            color: #239c42;
        }

        .main-nav .nav-item.active {
            color: #239c42;
            font-weight: 600;
        }

        .admin-profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .avatar-container {
            position: relative;
            margin-right: 15px;
        }
        .nav-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffcc00;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 20px;
        }
        .avatar {
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 20px;
        }
        .avatar-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
            min-width: 180px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            pointer-events: none;
            overflow: hidden;
        }
        .avatar-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }
        .avatar-dropdown-item {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid #f0f0f0;
        }
        .avatar-dropdown-item:last-child {
            border-bottom: none;
        }
        .avatar-dropdown-item:hover {
            background-color: #f8f9fa;
            color: #239c42;
            padding-left: 20px;
        }
        .avatar-dropdown-item:first-child {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .avatar-dropdown-item:last-child {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .avatar-dropdown-item.logout {
            color: #d32f2f;
            font-weight: 600;
        }
        .avatar-dropdown-item.logout:hover {
            background-color: #ffebee;
            color: #b71c1c;
            padding-left: 20px;
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
            border-radius: 10px;
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
        .activity-list {
            overflow: visible;
            padding: 0;
            margin: 0;
        }
        .activity-list li {
            background-color: #f5f5f5;
            border-radius: 8px;
            margin-bottom: 8px;
            padding: 14px 20px 14px 16px;
            border: 2px solid transparent;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .activity-list li:last-child {
            margin-bottom: 0;
        }
        .activity-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--admin-green, #27ae60);
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
        }
        .activity-list li:hover {
            background-color: #f0f9f4 !important;
            border-color: rgba(39, 174, 96, 0.2);
            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.15), 0 1px 3px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }
        .activity-list li:hover::before {
            transform: scaleY(1);
        }
        .activity-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .activity-text {
            transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding-left: 0;
            flex: 1;
            position: relative;
            z-index: 2;
        }
        .activity-list li:hover .activity-text {
            padding-left: 4px;
        }
        .activity-list li:active .activity-text {
            padding-left: 2px;
        }
        .activity-arrow {
            color: #666;
            font-size: 0.875rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: 8px;
            flex-shrink: 0;
            position: relative;
            z-index: 2;
        }
        .activity-list li:hover .activity-arrow {
            color: var(--admin-green, #27ae60);
            transform: translateX(2px);
        }
        .export-btn,
        button.export-btn,
        .btn.export-btn {
            background-color: #27ae60 !important;
            color: white !important;
            border: none !important;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: none !important;
        }
        .export-btn:hover,
        button.export-btn:hover,
        .btn.export-btn:hover {
            background-color: #229954 !important;
        }
        .export-btn i,
        button.export-btn i,
        .btn.export-btn i {
            color: white !important;
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
        <div class="nav-left">
            <img src="/images/Logo.png" alt="EnerSave Logo">
            <a href="/adminDashboard" class="brand-name"><strong>EnerSave</strong></a>
            <nav class="main-nav">
                <a href="/adminDashboard" class="nav-item active">Dashboard</a>
                <a href="/usersManagement" class="nav-item">Users</a>
                <a href="/suppliersManagement" class="nav-item">Suppliers</a>
                <a href="/projectsManagement" class="nav-item">Projects</a>
            </nav>
        </div>
        <div class="nav-right">
            <span>Admin: <?php echo htmlspecialchars($username); ?></span>
            <div class="avatar-container">
                <div class="nav-avatar" id="avatarDropdown"><?php echo strtoupper(substr($username, 0, 1)); ?></div>
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
                    <span class="metric-value" id="totalUsers">0</span>
                </div>
                <div class="card">
                    <span class="metric-title">Total Suppliers</span>
                    <span class="metric-value" id="totalSuppliers">0</span>
                </div>
                <div class="card">
                    <span class="metric-title">Active Projects</span>
                    <span class="metric-value" id="activeProjects">0</span>
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
                        <li class="activity-item" data-activity-type="supplier" onclick="redirectToManagement('/suppliersManagement')">
                            <div class="activity-text">
                                <div class="activity-title">New Supplier Registered: <strong>GreenTech Power</strong></div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                            <i class="fas fa-chevron-right activity-arrow"></i>
                        </li>
                        <li class="activity-item" data-activity-type="project" onclick="redirectToManagement('/projectsManagement')">
                            <div class="activity-text">
                                <div class="activity-title">New Project Submitted: <strong>Solar for Hope</strong></div>
                                <div class="activity-time">5 hours ago</div>
                            </div>
                            <i class="fas fa-chevron-right activity-arrow"></i>
                        </li>
                        <li class="activity-item" data-activity-type="project" onclick="redirectToManagement('/projectsManagement')">
                            <div class="activity-text">
                                <div class="activity-title">Donation Received: <strong>P5,000 from EcoFund Inc.</strong></div>
                                <div class="activity-time">1 day ago</div>
                            </div>
                            <i class="fas fa-chevron-right activity-arrow"></i>
                        </li>
                        <li class="activity-item" data-activity-type="user" onclick="redirectToManagement('/usersManagement')">
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
                        <span class="status-value red" id="pendingVerifications">0</span>
                    </div>
                    <div class="status-item">
                        <span>Active Crowdfunding Projects:</span>
                        <span class="status-value" id="activeProjectsStatus">0</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="/JavaScripts/navigationAdmin.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
    <script>
        function redirectToManagement(page) {
            window.location.href = page;
        }

        // Load dynamic counts
        document.addEventListener('DOMContentLoaded', function() {
            // Load user counts
            fetch('/api/users/counts')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.counts) {
                        document.getElementById('totalUsers').textContent = data.counts.total || 0;
                        document.getElementById('totalSuppliers').textContent = data.counts.suppliers || 0;
                    }
                })
                .catch(error => {
                    console.error('Error loading user counts:', error);
                });

            // Load suppliers to count pending verifications
            fetch('/api/suppliers')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.suppliers) {
                        const unverified = data.suppliers.filter(s => !s.is_verified);
                        document.getElementById('pendingVerifications').textContent = unverified.length;
                    }
                })
                .catch(error => {
                    console.error('Error loading suppliers:', error);
                });

            // Load projects count
            fetch('/api/projects')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.projects) {
                        const active = data.projects.filter(p => p.status === 'active' || !p.status);
                        document.getElementById('activeProjects').textContent = active.length;
                        document.getElementById('activeProjectsStatus').textContent = active.length;
                    }
                })
                .catch(error => {
                    console.error('Error loading projects:', error);
                });
        });
    </script>
</body>
</html>
