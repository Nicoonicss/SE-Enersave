<?php
$pageTitle = 'Projects Management';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Management - EnerSave</title>
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
        .data-management-panel {
            width: 100%;
        }
        .data-table {
            width: 100%;
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
    </style>
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <img src="/images/Logo.png" alt="EnerSave Logo">
            EnerSave
        </div>
        <nav class="main-nav">
            <a href="/adminDashboard" class="nav-item">Dashboard</a>
            <a href="/usersManagement" class="nav-item">Users</a>
            <a href="/suppliersManagement" class="nav-item">Suppliers</a>
            <a href="/projectsManagement" class="nav-item active">Projects</a>
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
        <section id="projects" class="page-content active-page">
            <h1 class="page-title">Projects Management</h1>
            <p class="page-subtitle">Oversee and manage all sustainability projects.</p>

            <div class="metrics-cards">
                <div class="card">
                    <span class="metric-title">Pending Projects</span>
                    <span class="metric-value">340</span>
                </div>
                <div class="card">
                    <span class="metric-title">Active Projects</span>
                    <span class="metric-value">42</span>
                </div>
                <div class="card">
                    <span class="metric-title">Completed Projects</span>
                    <span class="metric-value">18</span>
                </div>
                <div class="card">
                    <span class="metric-title">Rejected Projects</span>
                    <span class="metric-value">P280K</span>
                </div>
            </div>

            <div class="data-management-panel">
                <h2 class="section-title" style="margin-top: 0; margin-bottom: 16px;">All Projects</h2>
                
                <div class="filter-bar">
                    <div class="search-box full-width-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search projects...">
                    </div>
                </div>

                <table class="data-table project-table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Community</th>
                            <th>Start Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-active">Active</span></td>
                            <td><a href="#" class="action-link">View</a> <a href="#" class="action-link success">Close</a></td>
                        </tr>
                        <tr>
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-pending">Pending</span></td>
                            <td><a href="#" class="action-link">View</a> <a href="#" class="action-link success">Approve</a> <a href="#" class="action-link danger">Reject</a></td>
                        </tr>
                        <tr>
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-completed">Completed</span></td>
                            <td><a href="#" class="action-link">View</a></td>
                        </tr>
                        <tr>
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-rejected">Rejected</span></td>
                            <td><a href="#" class="action-link">View</a> <a href="#" class="action-link success">Restore</a></td>
                        </tr>
                        <tr>
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-active">Active</span></td>
                            <td><a href="#" class="action-link">View</a> <a href="#" class="action-link success">Close</a></td>
                        </tr>
                        <tr>
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-active">Active</span></td>
                            <td><a href="#" class="action-link">View</a> <a href="#" class="action-link success">Close</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script src="/JavaScripts/navigationAdmin.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
</body>
</html>

