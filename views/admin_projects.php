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
    <link rel="stylesheet" href="/styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <img src="/images/Logo.png" alt="EnerSave Logo">
            EnerSave
        </div>
        <nav class="main-nav">
            <a href="/admin" class="nav-item">Dashboard</a>
            <a href="/admin/users" class="nav-item">Users</a>
            <a href="/admin/suppliers" class="nav-item">Suppliers</a>
            <a href="/admin/projects" class="nav-item active">Projects</a>
        </nav>
        <div class="admin-profile">
            <span>Admin: <?php echo htmlspecialchars($username); ?></span>
            <div class="avatar"><i class="fas fa-user-circle"></i></div>
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
</body>
</html>

