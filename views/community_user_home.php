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

    .hero-buttons button,
    .hero-buttons a {
        padding: 18px 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        margin-right: 10px;
        text-align: center;
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
        gap: 10px;
        width: 90%;
        margin: auto;
    }

    .product-card {
        background: lightgrey;
        flex: 1;
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

    .list-item:last-child {
        margin-bottom: 0;
    }

    .list-item::before {
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

    .list-item:hover {
        background-color: #f0f9f4 !important;
        border-color: rgba(39, 174, 96, 0.2);
        box-shadow: 0 2px 8px rgba(39, 174, 96, 0.15), 0 1px 3px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }

    .list-item:hover::before {
        transform: scaleY(1);
    }

    .list-item-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .list-item-text {
        transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding-left: 0;
        flex: 1;
        position: relative;
        z-index: 2;
    }

    .list-item:hover .list-item-text {
        padding-left: 4px;
    }

    .list-item:active .list-item-text {
        padding-left: 2px;
    }

    .list-item p {
        margin: 2px 0;
        transition: color 0.3s ease;
    }

    .list-item a {
        text-decoration: none;
        color: #1fa339;
        font-weight: bold;
        display: block;
        margin-top: 4px;
        transition: color 0.3s ease;
    }

    .list-item:hover a {
        color: #27ae60;
    }

    .list-item-arrow {
        color: #666;
        font-size: 0.875rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-left: 8px;
        flex-shrink: 0;
        position: relative;
        z-index: 2;
    }

    .list-item:hover .list-item-arrow {
        color: var(--admin-green, #27ae60);
        transform: translateX(2px);
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

    /* Product Modal Styles */
    .product-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    .product-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-content {
        background-color: white;
        margin: auto;
        padding: 30px;
        border-radius: 12px;
        max-width: 600px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 28px;
        font-weight: bold;
        color: #999;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }

    .close-modal:hover {
        color: #333;
    }

    .modal-body {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .modal-product-image {
        width: 100%;
        max-height: 300px;
        object-fit: contain;
        border-radius: 8px;
        background: #f5f5f5;
        padding: 10px;
    }

    .modal-product-info {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .modal-info-row {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .modal-info-label {
        font-weight: 700;
        color: #666;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modal-product-price {
        font-size: 28px;
        font-weight: 700;
        color: #2e7d32;
    }

    .modal-product-description {
        line-height: 1.6;
        color: #555;
        margin: 0;
    }

    .modal-supplier {
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #2e7d32;
        color: #2e7d32;
        font-weight: 600;
    }

    .view-details-link {
        display: block;
        width: 100%;
        background: white;
        border: 1px solid #e0e0e0;
        color: #000 !important;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.2s ease, border-color 0.2s ease;
        text-align: center;
        font-size: 14px;
        box-sizing: border-box;
    }

    .view-details-link:hover {
        background-color: #f5f5f5;
        border-color: #d0d0d0;
        color: #000 !important;
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
        <div class="hero-buttons">
            <a href="/communityMarketplaceUI" class="btn-green" style="text-decoration: none; display: inline-block;">Explore Marketplace</a>
            <a href="/communityLearnUI" class="btn-white" style="text-decoration: none; display: inline-block;">Learn About Clean Energy</a>
        </div>
    </div>
</div>
<br>
<br>
<h2>Featured Products</h2>
<div class="products">
    <div class="product-card" data-product="solar-kit">
        <img src="/images/SolarKit.png" alt="Solar Kit">
        <div class="info">
            <h4>Solar Kit</h4>
            <p class="price">$499.99</p>
            <a href="#" class="view-details-link" data-product="solar-kit">View Details</a>
        </div>
    </div>

    <div class="product-card" data-product="wind-turbine">
        <img src="/images/WindTurbine.png" alt="Wind Turbine">
        <div class="info">
            <h4>Wind Turbine</h4>
            <p class="price">$799.99</p>
            <a href="#" class="view-details-link" data-product="wind-turbine">View Details</a>
        </div>
    </div>

    <div class="product-card" data-product="solar-panel">
        <img src="/images/SolarPanel.png" alt="Solar Panel">
        <div class="info">
            <h4>Solar Panel</h4>
            <p class="price">$250.99</p>
            <a href="#" class="view-details-link" data-product="solar-panel">View Details</a>
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
        <div class="list-item" onclick="window.location.href='/communityLearnUI'">
            <div class="list-item-content">
                <div class="list-item-text">
                    <p><strong>Video:</strong> Basics of Solar Energy</p>
                    <a href="/communityLearnUI">A 5 - minute introduction to how solar panels work.</a>
                </div>
                <i class="fas fa-chevron-right list-item-arrow"></i>
            </div>
        </div>

        <div class="list-item" onclick="window.location.href='/communityLearnUI'">
            <div class="list-item-content">
                <div class="list-item-text">
                    <p><strong>Guide:</strong> DIY Solar Setup</p>
                    <a href="/communityLearnUI">Step - by - step guide to installing your first solaar kit.</a>
                </div>
                <i class="fas fa-chevron-right list-item-arrow"></i>
            </div>
        </div>
    </div>

    <div class="forum-card">
        <h3>Community Forum Highlights</h3>
        <div class="list-item" onclick="window.location.href='/communityForumUI'">
            <div class="list-item-content">
                <div class="list-item-text">
                    <p>Best Solar Panel for Homes?</p>
                    <a href="/communityForumUI">12 replies - Last Reply 2 hours ago</a>
                </div>
                <i class="fas fa-chevron-right list-item-arrow"></i>
            </div>
        </div>

        <div class="list-item" onclick="window.location.href='/communityForumUI'">
            <div class="list-item-content">
                <div class="list-item-text">
                    <p>How to join crowdfunding?</p>
                    <a href="/communityForumUI">8 replies - Last Reply 5 hours ago</a>
                </div>
                <i class="fas fa-chevron-right list-item-arrow"></i>
            </div>
        </div>
    </div>
</div>

<!-- Product Details Modal -->
<div id="productModal" class="product-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalProductName">Product Name</h2>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <img id="modalProductImage" src="" alt="Product Image" class="modal-product-image">
            <div class="modal-product-info">
                <div class="modal-info-row">
                    <span class="modal-info-label">Price</span>
                    <span class="modal-product-price" id="modalProductPrice">$0</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Description</span>
                    <p class="modal-product-description" id="modalProductDescription">Product description will appear here.</p>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Supplier</span>
                    <div class="modal-supplier" id="modalProductSupplier">Supplier name will appear here.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    © 2025 EnerSave. All Rights Reserved.
    <div class="links">
        <a href="#">About</a> | <a href="#">Privacy Policy</a> | <a href="#">Contact</a>
    </div>
</footer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="/navigationCommunity.js"></script>
<script src="/JavaScripts/avatarDropdown.js"></script>
<script>
    // Product data
    const productData = {
        'solar-kit': {
            name: 'Solar Kit',
            image: '/images/SolarKit.png',
            price: '$499.99',
            description: 'A comprehensive solar energy starter kit perfect for small homes and off-grid applications. Includes high-efficiency solar panels, charge controller, battery storage system, and all necessary mounting hardware. Easy to install and maintain, this kit provides reliable renewable energy for your daily needs. Ideal for powering lights, small appliances, and electronic devices while reducing your carbon footprint.',
            supplier: 'GreenTech'
        },
        'wind-turbine': {
            name: 'Wind Turbine',
            image: '/images/WindTurbine.png',
            price: '$799.99',
            description: 'An efficient wind energy system designed for residential use. Features durable turbine blades, generator, and control system. Perfect for areas with consistent wind patterns. Helps reduce electricity costs and environmental impact. This compact design is ideal for homes and small businesses looking to harness wind power.',
            supplier: 'WindPower Solutions'
        },
        'solar-panel': {
            name: 'Solar Panel',
            image: '/images/SolarPanel.png',
            price: '$250.99',
            description: 'High-efficiency monocrystalline solar panel designed for maximum energy output. Features advanced photovoltaic technology with excellent performance in various weather conditions. Durable construction ensures long-lasting reliability. Perfect for residential installations, RVs, and off-grid applications. Easy to install and maintain.',
            supplier: 'SolarMax'
        }
    };

    // Modal elements
    const modal = document.getElementById('productModal');
    const closeModalBtn = document.getElementById('closeModal');
    const viewDetailsLinks = document.querySelectorAll('.view-details-link');

    // Function to open modal
    function openProductModal(productKey) {
        const product = productData[productKey];
        if (!product) return;

        // Populate modal
        document.getElementById('modalProductName').textContent = product.name;
        document.getElementById('modalProductPrice').textContent = product.price;
        document.getElementById('modalProductDescription').textContent = product.description;
        document.getElementById('modalProductSupplier').textContent = product.supplier;
        document.getElementById('modalProductImage').src = product.image;
        document.getElementById('modalProductImage').alt = product.name;

        // Show modal
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    // Function to close modal
    function closeProductModal() {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    // Add event listeners to all "View Details" links
    viewDetailsLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const productKey = this.getAttribute('data-product');
            openProductModal(productKey);
        });
    });

    // Close modal when clicking the X button
    closeModalBtn.addEventListener('click', closeProductModal);

    // Close modal when clicking outside the modal content
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeProductModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            closeProductModal();
        }
    });
</script>
</body>
</html>

