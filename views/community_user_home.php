<?php
$pageTitle = 'Community Dashboard';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Community User';
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

    .nav-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #ffcc00;
        cursor: pointer;
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

</style>
</head>

<body>

<div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/communityUserUI" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/communityUserUI" style="color: green;">Home</a>
        <a href="/communityMarketplaceUI" id="marketplaceDirect">Marketplace</a>
        <a href="/communityCrowdfundingUI" id="projectDirect">Projects</a>
        <a href="/communityLearnUI" id="learnDirect">Learn</a>
        <a href="/communityForumUI" id="forumDirect">Community</a>
    </div>

    <div class="nav-right">
        Community: <?php echo htmlspecialchars($username); ?>
        <div class="nav-avatar"></div>
    </div>
</div>

<div class="hero">
    <img src="/images/communityUser.png" alt="Hero Image">
    <div class="hero-text">
        <h1>Empowering Communities <br> with Sustainable Energy</h1>
        <p>Connecting local and rural communities with sustainable energy solutions to build a <br>brighter, greener future.</p>
        <div class="hero-buttons">
            <button class="btn-green">Explore Marketplace</button>
            <button class="btn-white">Learn About Clean Energy</button>
        </div>
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
            <p class="price">$499.99</p>
            <a href="#">View Details</a>
        </div>
    </div>

    <div class="product-card">
        <img src="/images/WindTurbine.png">
        <div class="info">
            <h4>Wind Turbine</h4>
            <p class="price">$799.99</p>
            <a href="#">View Details</a>
        </div>
    </div>

    <div class="product-card">
        <img src="/images/SolarPanel.png">
        <div class="info">
            <h4>Solar Panel</h4>
            <p class="price">$250.99</p>
            <a href="#">View Details</a>
        </div>
    </div>
</div>

<h2>Crowdfunding Projects</h2>
<div class="crowdfund-box">
    <div class="crowdfund-left">
        <img class="crowdfund-img" src="/images/Crowdfunding.png">
    </div>

    <div class="crowdfund-right">
        <h3>Light for Rural School</h3>
        <p>Help bring solar-powered electrification to low-income rural schools. Support the installation of solar lighting systems.</p>

        <p><strong>80% funded</strong> — $16,000 / $20,000</p>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>

        <button class="donate-btn">Donate via Gcash ⭐</button>
        <button class="view-project">View Project</button>
    </div>
</div>
<br>
<br>

<div class="learning-forum">
    <div class="learning-card">
        <h3>Learning Hub Preview</h3>
        <div class="list-item">
            <p><strong>Video:</strong> Basics of Solar Energy</p>
            <a href="#">A 5 - minute introduction to how solar panels work.</a>
        </div>

        <div class="list-item">
            <p><strong>Guide:</strong> DIY Solar Setup</p>
            <a href="#">Step - by - step guide to installing your first solaar kit.</a>
        </div>
    </div>

    <div class="forum-card">
        <h3>Community Forum Highlights</h3>
        <div class="list-item">
            <p>Best Solar Panel for Homes?</p>
            <a href="#">12 replies - Last Reply 2 hours ago</a>
        </div>

        <div class="list-item">
            <p>How to join crowdfunding?</p>
            <a href="#">8 replies - Last Reply 5 hours ago</a>
        </div>
    </div>
</div>

<footer>
    © 2025 EnerSave. All Rights Reserved.
    <div class="links">
        <a href="#">About</a> | <a href="#">Privacy Policy</a> | <a href="#">Contact</a>
    </div>
</footer>
<script src="/navigationCommunity.js"></script>
</body>
</html>

