<?php
$pageTitle = 'Donor Dashboard';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Donor';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EnerSave</title>

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

    .nav-left a, .nav-right a {
        text-decoration: none;
        color: black;
        font-weight: 500;
    }

    .nav-right {
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

    .hero {
        width: 90%;
        margin: 20px auto;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }

    .hero img {
        width: 100%;
        height: 541px;
        object-fit: cover;
    }

    .hero-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        max-width: 100%;
    }

    .hero-text h1 {
        font-size: 48px;
        font-weight: black;
        margin: 0 0 10px;
    }

    .hero-buttons button {
        padding: 18px 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        margin-right: 10px;
    }

    .btn-green {
        background: #1fa339;
        color: white;
        width: 247px;
    }

    .btn-white {
        background: white;
        color: black;
        width: 303px;
    }

    h2 {
        width: 90%;
        margin: 30px auto 10px;
        font-size: 20px;
    }

    .products, .learning-forum {
        display: flex;
        gap: 20px;
        width: 90%;
        margin: auto;
    }

    .product-card {
        background: lightgrey;
        width: 30%;
        border-radius: 12px;
        overflow: hidden;
        padding-bottom: 15px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .product-card img {
        width: 100%;
        height: 218px;
        object-fit: cover;
    }

    .product-card .info {
        padding: 10px 15px;
    }
    
    .product-card .info h4,
    .product-card .info p,
    .product-card .info a {
    margin: 4px 0;
    }
    .product-card .price {
        font-weight: bold;
        color: #1fa339;
    }

    .product-card a {
        color: #1fa339;
        text-decoration: none;
        font-weight: bold;
        font-size: 13px;
    }

    .crowdfund-box {
        width: 88%;
        margin: auto;
        display: flex;
        gap: 20px;
        padding: 20px;
        background: lightgrey;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .crowdfund-left, .crowdfund-right {
        flex: 1;
    }

    .crowdfund-img {
        width: 100%;
    }

    .progress-bar {
        background: #e0e0e0;
        height: 10px;
        border-radius: 8px;
        margin: 10px 0;
        position: relative;
    }

    .progress {
        background: #1fa339;
        width: 80%;
        height: 100%;
        border-radius: 8px;
    }

    .donate-btn {
        background: #007BFF;
        color: black;
        padding: 8px 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 10px;
    }

    .view-project {
      background: white;
      color: black;
      padding: 8px 14px; 
      border: none;
      border-radius: 6px; 
      cursor: pointer;
      margin-top: 10px;
      width: fit-content; 
      display: inline-block;
    }

    .learning-card, .forum-card {
        background: white;
        flex: 1;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.06);
    }

    .list-item {
        background: #f2f2f2;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .list-item a {
        text-decoration: none;
        color: #1fa339;
        font-weight: bold;
    }

    .list-item p {
    margin: 2px 0; 
    }

    .list-item a {
    margin: 0; 
    display: block; 
    }

    .brand-name {
    font-weight: 900;
    font-size: 18px;
    }

    footer {
        margin-top: 40px;
        padding: 20px;
        text-align: center;
        font-size: 14px;
        background: white;
        color: #1fa339;
    }

    footer .links {
        margin-top: 10px;
        color: black;
    }

    footer .links a {
        margin: 0 10px;
        text-decoration: none;
        color: black;
    }

    /* --- Updated Product Cards to Look Like Featured Projects --- */

.products {
    display: flex;
    gap: 20px;
    width: 90%;
    margin: auto;
    flex-wrap: nowrap; 
}

.product-card {
    width: 30%;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.10);
    overflow: hidden;
    padding-bottom: 15px;
}

.product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.product-card .info {
    padding: 15px;
}

.product-card .info h4 {
    margin-bottom: 8px;
    font-size: 18px;
}

.product-card .price {
    color: #1fa339;
    font-weight: bold;
    font-size: 14px;
}

.product-card a {
    text-decoration: none;
    color: #1fa339;
    font-weight: bold;
    margin-top: 6px;
    display: inline-block;
}

.product-progress-box p {
    font-size: 13px;
    margin: 0 0 5px 0;
}

.product-progress-bar {
    width: 100%;
    height: 8px;
    background: #eee;
    border-radius: 5px;
    overflow: hidden;
}

.product-progress {
    height: 100%;
    background: #37b34a; 
}

.product-buttons {
    display: flex;
    justify-content: flex-start;
    margin-top: 12px;
    gap: 10px;  
}

.product-donate-btn {
    background: #1fa339;
    border: none;
    padding: 8px 18px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.product-details-btn {
    background: #f2f2f2;
    border: none;
    padding: 8px 18px;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
}

.donation-list {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 12px;
    width: 90%;
    margin: auto;
}

.donation-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
}

.amount {
    color: #00a000;
    font-weight: 600;
}

.status {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: bold;
}

.confirmed {
    background: #b1ffb1;
    color: #006400;
}

.pending {
    background: #ffe8b3;
    color: #8a6300;
}

.view-all {
    background: #d9d9d9;
    padding: 10px 16px;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    margin-left: 90px;
}
</style>
</head>

<body>

<div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/donorHomeUI" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/donorHomeUI" style="color: green;">Home</a>
        <a href="/donorCrowdfundingUI" id="projectDirect">Projects</a>
        <a href="/donorCommunityUI" id="forumDirect">Community</a>
    </div>

    <div class="nav-right">
        Donor: <?php echo htmlspecialchars($username); ?>
        <div class="avatar-container">
            <div class="nav-avatar" id="avatarDropdown"></div>
            <div class="avatar-dropdown" id="avatarMenu">
                <a href="#" class="avatar-dropdown-item">Settings</a>
                <a href="/logout" class="avatar-dropdown-item logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="hero">
    <img src="/images/communityUser.png" alt="Hero Image">
    <div class="hero-text">
        <h1>Empowering Communities <br> with Sustainable Energy</h1>
        <p>Connecting local and rural communities with sustainable energy solutions to build a <br>brighter, greener future.</p>
    </div>
</div>
<br>
<br>
<h2>Featured Products</h2>

<div class="products">

    <div class="product-card">
        <img src="/images/SolarKit.png">
        <div class="info">
            <h4>Solar Kit</h4>

            <div class="product-progress-box">
                <p><strong>Goal: ₱100,000</strong> | Raised ₱80,000 (80%)</p>
                <div class="product-progress-bar">
                    <div class="product-progress" style="width: 80%;"></div>
                </div>
            </div>

            <div class="product-buttons">
                <button class="product-donate-btn">Donate 💰</button>
                <button class="product-details-btn">Details 👁️</button>
            </div>
        </div>
    </div>

    <div class="product-card">
        <img src="/images/WindTurbine.png">
        <div class="info">
            <h4>Wind Turbine</h4>

            <div class="product-progress-box">
                <p><strong>Goal: ₱150,000</strong> | Raised ₱75,000 (50%)</p>
                <div class="product-progress-bar">
                    <div class="product-progress" style="width: 50%;"></div>
                </div>
            </div>

            <div class="product-buttons">
                <button class="product-donate-btn">Donate 💰</button>
                <button class="product-details-btn">Details 👁️</button>
            </div>
        </div>
    </div>

    <div class="product-card">
        <img src="/images/SolarPanel.png">
        <div class="info">
            <h4>Solar Panel</h4>

            <div class="product-progress-box">
                <p><strong>Goal: ₱200,000</strong> | Raised ₱50,000 (25%)</p>
                <div class="product-progress-bar">
                    <div class="product-progress" style="width: 25%;"></div>
                </div>
            </div>

            <div class="product-buttons">
                <button class="product-donate-btn">Donate 💰</button>
                <button class="product-details-btn">Details 👁️</button>
            </div>
        </div>
    </div>

</div>


<h2>My Donations Summary</h2>

<div class="donation-list">

    <div class="donation-item">
        <div class="donation-info">
            <p><strong>Project:</strong> Solar for Schools</p>
            <p class="amount">Amount: ₱500</p>
        </div>
        <span class="status confirmed">Confirmed</span>
    </div>

    <hr>

    <div class="donation-item">
        <div class="donation-info">
            <p><strong>Project:</strong> Hydro for Hope</p>
            <p class="amount">Amount: ₱200</p>
        </div>
        <span class="status pending">Pending</span>
    </div>

</div>

<br>

<button class="view-all">View All Donations</button>

<footer>
    © 2025 EnerSave. All Rights Reserved.
    <div class="links">
        <a href="#">About</a> | <a href="#">Privacy Policy</a> | <a href="#">Contact</a>
    </div>
</footer>
<script src="/navigationDonor.js"></script>
<script src="/JavaScripts/avatarDropdown.js"></script>
</body>
</html>

