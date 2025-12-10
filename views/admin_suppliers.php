<?php
$pageTitle = 'Suppliers Management';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers Management - EnerSave</title>
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
        .details-panel {
            width: 100%;
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
            <a href="/suppliersManagement" class="nav-item active">Suppliers</a>
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
        <section id="suppliers" class="page-content active-page">
            <h1 class="page-title">SUPPLIERS MANAGEMENT</h1>
            <p class="page-subtitle">Manage supplier registration, verification, and details.</p>

            <div class="data-management-panel">
                <div class="filter-bar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Enter supplier name, email, or ID">
                    </div>
                    <div class="role-filter">
                        <span>Filter by: Role</span>
                        <button class="filter-btn active">All</button>
                        <button class="filter-btn">Admin</button>
                        <button class="filter-btn">Supplier</button>
                        <button class="filter-btn">Community</button>
                    </div>
                    <div class="sort-by">
                        <span>Sort by: Name <i class="fas fa-chevron-up"></i></span>
                        <span>Status <i class="fas fa-chevron-up"></i></span>
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Supplier Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>S024</td>
                            <td>Steven Mitchell</td>
                            <td>Admin</td>
                            <td>s.mitchell@gmail.com</td>
                            <td><span class="status-tag active">Active</span></td>
                            <td><a href="#" class="action-link">Edit</a> / <a href="#" class="action-link danger">Ban</a></td>
                        </tr>
                        <tr>
                            <td>S025</td>
                            <td>Jer Erick</td>
                            <td>Community</td>
                            <td>jer.erick@gmail.com</td>
                            <td><span class="status-tag active">Active</span></td>
                            <td><a href="#" class="action-link">Edit</a> / <a href="#" class="action-link danger">Ban</a></td>
                        </tr>
                        <tr>
                            <td>S026</td>
                            <td>Monico Vian</td>
                            <td>Community</td>
                            <td>monico.vian@gmail.com</td>
                            <td><span class="status-tag active">Active</span></td>
                            <td><a href="#" class="action-link">Edit</a> / <a href="#" class="action-link danger">Ban</a></td>
                        </tr>
                        <tr>
                            <td>S027</td>
                            <td>Sarah Discaya</td>
                            <td>Supplier</td>
                            <td>sarah.discaya@gmail.com</td>
                            <td><span class="status-tag banned">Banned</span></td>
                            <td><a href="#" class="action-link">Edit</a> / <a href="#" class="action-link success">Unban</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="section-title">Users Details Panel</h2>
            <div class="details-panel">
                <div class="detail-row">
                    <div class="detail-item"><span>Full Name</span><strong>Crist Briand Brader</strong></div>
                    <div class="detail-item"><span>Role</span><strong>Community</strong></div>
                    <div class="detail-item"><span>Email</span><strong>cristbriand.brader.25@usjr.edu.ph</strong></div>
                </div>
                <div class="detail-row">
                    <div class="detail-item"><span>Status</span><strong class="text-active">Active</strong></div>
                    <div class="detail-item"><span>Joined</span><strong>Nov 2, 2025</strong></div>
                </div>
                <div class="details-actions">
                    <button class="btn btn-success">Update Role</button>
                    <button class="btn btn-warning">Deactivate Account</button>
                    <button class="btn btn-dark">Reset Password</button>
                </div>
            </div>
        </section>
    </main>
    <script src="/JavaScripts/navigationAdmin.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
</body>
</html>

