<?php
$pageTitle = 'Supplier Dashboard';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Supplier';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnerSave - Supplier Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
    margin-right:0px;
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

.brand-name {
    font-weight: 900;
    font-size: 18px;
}

    .container {
    max-width: 1850px;
    margin: 0 auto;
    padding: 0 20px;
}

        .brand-section {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 1.3rem;
            color: #000;
        }

        .logo-icon {
            height: 32px;
            width: auto;
            margin-right: 10px;
        }

        .nav-links a {
            text-decoration: none;
            color: #555;
            margin-right: 25px;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: #000; }
        
        .nav-links a.active {
            color: #2e9e48;
            font-weight: 600;
        }

        .supplier-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 600;
            color: #333;
        }

        .user-avatar {
            font-size: 2rem;
            color: #f39c12;
            cursor: pointer;
        }

        .dashboard-title {
            margin-bottom: 30px;
            margin-top:15px;
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }

        .status-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .status-card {
            background-color: #f4f4f5;
            padding: 30px;
            border-radius: 16px;
        }

        .card-title {
            font-weight: 600;
            color: #555;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .card-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #111;
        }

        .verification-status {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .verified-icon {
            color: #2e9e48;
            font-size: 2.2rem;
        }

        .quick-actions {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .actions-row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.2s;
        }

        .btn-green {
            background-color: #2e9e48;
            color: black;
        }
        .btn-green:hover { background-color: #25803a; }

        .btn-gray {
            background-color: #e4e4e7;
            color: #333;
        }
        .btn-gray:hover { background-color: #d4d4d8; }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .orders-table-container {
            background-color: #f4f4f5;
            border-radius: 16px;
            padding: 20px;
        }

        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .orders-table th {
            text-align: left;
            color: #777;
            font-weight: 600;
            padding: 0 15px 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .orders-table td {
            background-color: #fff;
            padding: 15px;
            font-weight: 600;
            color: #333;
        }

        .orders-table tr td:first-child { border-radius: 12px 0 0 12px; }
        .orders-table tr td:last-child { border-radius: 0 12px 12px 0; }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            text-align: center;
            display: inline-block;
        }

        .status-delivered { background-color: #8ceba3; color: #0a5c21; }
        .status-pending { background-color: #fef08a; color: #854d0e; }
        .status-shipped { background-color: #bae6fd; color: #0369a1; }

        .products-container {
            background-color: #f4f4f5;
            border-radius: 16px;
            padding: 30px 25px;
        }

        .product-item {
            margin-bottom: 25px;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .product-name { font-size: 1.1rem; }
        .product-sales { color: #777; }

        .progress-bar-bg {
            height: 12px;
            background-color: #e4e4e7;
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background-color: #2e9e48;
            border-radius: 6px;
        }

        @media (max-width: 992px) {
            .content-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .nav-content, .brand-section, .supplier-info { flex-direction: column; align-items: flex-start; gap: 15px; }
            .user-avatar { position: absolute; top: 20px; right: 20px; }
            .actions-row { flex-direction: column; }
            .btn-action { width: 100%; justify-content: center; }
            .orders-table-container { overflow-x: auto; }
        }
    </style>
</head>
<body>

    <div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/SupplierDashBoard" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/SupplierDashBoard" id="homeDirect">Dashboard</a>
        <a href="/SupplierMarketPlace" id="marketplaceDirect">Marketplace</a>
        <a href="/SupplierCommunity">Community</a>
    </div> 
            
    <div class="nav-right">
        Supplier: <?php echo htmlspecialchars($username); ?>
        <div class="avatar-container">
            <div class="nav-avatar" id="avatarDropdown"></div>
            <div class="avatar-dropdown" id="avatarMenu">
                <a href="#" class="avatar-dropdown-item">Settings</a>
                <a href="/logout" class="avatar-dropdown-item logout">Logout</a>
            </div>
        </div>
    </div>
</div>  

    <div class="container">
        
        <h1 class="dashboard-title">Supplier Dashboard Overview</h1>

        <section class="status-cards-grid">
            <div class="status-card">
                <h3 class="card-title">Product Listed</h3>
                <p class="card-value">12</p>
            </div>
            <div class="status-card">
                <h3 class="card-title">Pending Orders</h3>
                <p class="card-value">3</p>
            </div>
            <div class="status-card">
                <h3 class="card-title">Total Sales</h3>
                <p class="card-value">P152,000</p>
            </div>
            <div class="status-card">
                <h3 class="card-title">Verification Status</h3>
                <div class="verification-status" id="verificationStatusCard">
                    <i class="fa-solid fa-circle-check verified-icon"></i>
                    <span>Verified</span>
                </div>
            </div>
        </section>

        <section class="quick-actions">
            <h2 class="section-title">Quick Actions</h2>
            <div class="actions-row">
                <button class="btn-action btn-green">
                    <i class="fa-solid fa-plus"></i> Add Products
                </button>
                <button class="btn-action btn-gray">
                    <i class="fa-solid fa-box-open"></i> View Orders
                </button>
                <button class="btn-action btn-gray">
                    <i class="fa-solid fa-comment-dots"></i> Check Messages
                </button>
            </div>
        </section>

        <div class="content-grid">
            
            <section>
                <h2 class="section-title">Recent Orders</h2>
                <div class="orders-table-container">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Buyer</th>
                                <th>Product</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#EN4567</td>
                                <td>L. Reyes</td>
                                <td>Solar Kit 200w</td>
                                <td><span class="status-badge status-delivered">Delivered</span></td>
                            </tr>
                            <tr>
                                <td>#EN4566</td>
                                <td>J. Santos</td>
                                <td>Wind Turbine 1kW</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>#EN4565</td>
                                <td>M. Cruz</td>
                                <td>Portable Solar Panel</td>
                                <td><span class="status-badge status-shipped">Shipped</span></td>
                            </tr>
                            <tr>
                                <td>#EN4564</td>
                                <td>A. Garcia</td>
                                <td>Solar Kit 200w</td>
                                <td><span class="status-badge status-delivered">Delivered</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section>
                <h2 class="section-title">Total Products</h2>
                <div class="products-container">
                    
                    <div class="product-item">
                        <div class="product-header">
                            <span class="product-name">Solar Kit 200w</span>
                            <span class="product-sales">34 Sold</span>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: 100%;"></div>
                        </div>
                    </div>

                    <div class="product-item">
                        <div class="product-header">
                            <span class="product-name">Wind Turbine 1kW</span>
                            <span class="product-sales">18 Sold</span>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: 53%;"></div>
                        </div>
                    </div>

                    <div class="product-item">
                        <div class="product-header">
                            <span class="product-name">Portable Solar Panel</span>
                            <span class="product-sales">12 Sold</span>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: 35%;"></div>
                        </div>
                    </div>

                    <div class="product-item">
                        <div class="product-header">
                            <span class="product-name">Inverter 500W</span>
                            <span class="product-sales">9 Sold</span>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: 26%;"></div>
                        </div>
                    </div>

                </div>
            </section>

        </div>

    </div>
<script src="/navigationSupplier.js"></script>
<script src="/JavaScripts/avatarDropdown.js"></script>
<script>
    // Load verification status
    function loadVerificationStatus() {
        fetch('/api/suppliers')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.suppliers) {
                    // Get current user ID from session (we'll need to pass it or get it from the page)
                    const currentUserId = <?php echo json_encode($user['id'] ?? null); ?>;
                    
                    if (currentUserId) {
                        const currentSupplier = data.suppliers.find(s => s.id === currentUserId);
                        const verificationCard = document.getElementById('verificationStatusCard');
                        
                        if (currentSupplier) {
                            if (currentSupplier.is_verified) {
                                verificationCard.innerHTML = `
                                    <i class="fa-solid fa-circle-check verified-icon"></i>
                                    <span>Verified</span>
                                `;
                            } else {
                                verificationCard.innerHTML = `
                                    <i class="fa-solid fa-clock" style="color: #ff9800; font-size: 2.2rem;"></i>
                                    <span style="color: #666;">Pending Verification</span>
                                `;
                            }
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error loading verification status:', error);
            });
    }
    
    // Load verification status on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadVerificationStatus();
        
        // Poll for verification status updates every 5 seconds
        setInterval(loadVerificationStatus, 5000);
    });
</script>
</body>
</html>

