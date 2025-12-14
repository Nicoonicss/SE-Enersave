<?php
$pageTitle = 'My Marketplace Listings';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Supplier';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnerSave - My Marketplace Listings</title>
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
    margin-right:15px;
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

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .user-avatar {
            font-size: 2rem;
            color: #f39c12;
            cursor: pointer;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            margin-bottom: -10px;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            color: #2e9e48;
            font-weight: 500;
            font-size: 1rem;
        }


        .controls-row {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .btn-add-product {
            background-color: #2e9e48;
            color: #000;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.2s;
        }

        .btn-add-product:hover {
            background-color: #25803a;
            color: #fff;
        }

        .search-container {
            position: relative;
            max-width: 300px;
            width: 100%;
        }

        .search-input {
            width: 100%;
            background-color: #f0f0f0;
            border: none;
            padding: 12px 40px 12px 20px;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #555;
            outline: none;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .listings-container {
            background-color: #f4f4f5;
            border-radius: 20px;
            padding: 0 30px 30px 30px;
            overflow: hidden;
        }

        .listings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .listings-table th {
            text-align: left;
            padding: 25px 0 15px 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #111;
        }

        .listings-table td {
            padding: 20px 0;
            border-top: 1px solid #d4d4d8;
            vertical-align: middle;
            font-size: 1.1rem;
        }

        .product-name {
            font-weight: 800;
            color: #000;
        }

        .text-green {
            color: #2e9e48;
            font-weight: 500;
        }

        .status-badge {
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }

        .status-live {
            background-color: #86efac; 
            color: #111;
        }

        .status-draft {
            background-color: #fff;
            color: #777;
            border: 1px solid #e4e4e7;
        }

        .action-cell {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .icon-btn {
            font-size: 1.2rem;
            cursor: pointer;
            transition: opacity 0.2s;
            border: none;
            background: none;
        }

        .icon-btn:hover { opacity: 0.7; }

        .icon-edit { color: #2e9e48; }
        .icon-delete { color: #ef4444; }

        @media (max-width: 768px) {
            .nav-content, .brand-section, .supplier-info { flex-direction: column; align-items: flex-start; gap: 15px; }
            .user-avatar { position: absolute; top: 20px; right: 20px; }
            .listings-container { overflow-x: auto; padding: 0 15px 15px 15px; }
            .listings-table th, .listings-table td { min-width: 120px; }
            .controls-row { flex-direction: column; align-items: stretch; }
            .search-container { max-width: none; }
        }
    </style>
</head>
<body>

    <div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/SupplierDashBoard" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/SupplierDashBoard" id="homeDirect">Dashboard</a>
        <a href="/SupplierMarketPlace" id="marketplaceDirect" style="color: green;">Marketplace</a>
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
        
        <section class="page-header">
            <h1 class="page-title">My Marketplace Listings</h1>
            <p class="page-subtitle">Manage your renewable energy products.</p>
        </section>

        <section class="controls-row">
            <button class="btn-add-product">
                <i class="fa-solid fa-circle-plus"></i> Add Products
            </button>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search My Products">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </div>
        </section>

        <div class="listings-container">
            <table class="listings-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">Product Name</th>
                        <th style="width: 20%;">Price</th>
                        <th style="width: 15%;">Stock</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="product-name">Solar Kit 200w</td>
                        <td class="text-green">P450.00</td>
                        <td class="text-green">50</td>
                        <td><span class="status-badge status-live">Live</span></td>
                        <td>
                            <div class="action-cell">
                                <button class="icon-btn icon-edit"><i class="fa-solid fa-pen"></i></button>
                                <button class="icon-btn icon-delete"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="product-name">Solar Kit 200w</td>
                        <td class="text-green">P450.00</td>
                        <td class="text-green">50</td>
                        <td><span class="status-badge status-live">Live</span></td>
                        <td>
                            <div class="action-cell">
                                <button class="icon-btn icon-edit"><i class="fa-solid fa-pen"></i></button>
                                <button class="icon-btn icon-delete"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="product-name">Solar Kit 200w</td>
                        <td class="text-green">P450.00</td>
                        <td class="text-green">50</td>
                        <td><span class="status-badge status-live">Live</span></td>
                        <td>
                            <div class="action-cell">
                                <button class="icon-btn icon-edit"><i class="fa-solid fa-pen"></i></button>
                                <button class="icon-btn icon-delete"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="product-name">Solar Kit 200w</td>
                        <td class="text-green">P450.00</td>
                        <td class="text-green">50</td>
                        <td><span class="status-badge status-draft">Draft</span></td>
                        <td>
                            <div class="action-cell">
                                <button class="icon-btn icon-edit"><i class="fa-solid fa-pen"></i></button>
                                <button class="icon-btn icon-delete"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
<script src="/navigationSupplier.js"></script>
<script src="/JavaScripts/avatarDropdown.js"></script>
</body>
</html>

