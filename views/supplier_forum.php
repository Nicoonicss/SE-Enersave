<?php
$pageTitle = 'Forum';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Supplier';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Supplier Community Forum</title>

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
        padding: 32px;
        max-width: 2000px;
        margin: auto;
    }

    h1 {
        margin-bottom: 5px;
        margin-top: -10px;
    }
    .subtitle {
        margin-bottom: 20px;
        color: #006400;
        font-size: 14px;
    }

    .tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    .tab {
        padding: 6px 16px;
        border-radius: 20px;
        background: #eee;
        cursor: pointer;
        font-size: 14px;
    }
    .tab.active {
        background: #5cd65c;
        color: green;
    }

    .tabs-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}
    .right-controls {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-right: 1148px;
    margin-bottom: 19px;
}
   .search-box input {
    padding: 10px 14px;
    width: 300px;
    border-radius: 20px;
    border: 1px solid #ccc;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0px;
}


    .new-topic-btn {
        background: #22a722;
        padding: 10px 24px;
        border-radius: 20px;
        color: black;
        cursor: pointer;
        border: none;
        font-weight: bold;
    }

    .discussion {
        background: white;
        padding: 20px;
        border: 1px solid #e5e5e5;
        margin-bottom: 15px;
        border-radius: 6px;
    }
    .discussion .title {
        font-weight: bold;
        margin-bottom: 8px;
        font-size: 16px;
    }
    .discussion .meta {
        color: #666;
        font-size: 13px;
        margin-bottom: 12px;
    }
    .buttons {
        display: flex;
        gap: 15px;
    }
    .btn {
        padding: 6px 14px;
        border-radius: 18px;
        font-size: 13px;
        cursor: pointer;
        border: 1px solid #ccc;
        background: #f8f8f8;
    }

    .buttons .btn {
    display: flex;
    align-items: center;   
    justify-content: center; 
    gap: 6px;               
}
.buttons .btn img {
    height: 18px; 
    width: 18px;
}

    footer {
        margin-top: 30px;
        text-align: center;
        font-size: 14px;
        color: #777;
    }
    footer .report {
        color: red;
        margin-left: 20px;
        cursor: pointer;
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
        <a href="/SupplierCommunity" style="color: green;">Community</a>
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
    <h1>COMMUNITY FORUM</h1>
    <div class="subtitle">Connect with others, share ideas, and ask questions.</div>

   <div class="tabs-row">
    <div class="tabs">
        <div class="tab active">All</div>
        <div class="tab">Solar</div>
        <div class="tab">Hydro</div>
        <div class="tab">Wind</div>
        <div class="tab">Projects</div>
    </div>

    <div class="right-controls">
        <div class="search-box">
            <input type="text" placeholder="Search" />
        </div>
    </div>
</div>


    <div class="section-header">
    <h2>Recent Discussions</h2>
    <button class="new-topic-btn">Start New Topic 🎉</button>
</div>

    <div class="discussion">
        <div class="title">"Best Solar Panel for Home Use?"</div>
        <div class="meta">(12 replies)</div>
        <div class="buttons">
            <div class="btn"><img src="/images/Eye.png">View Thread</div>
            <div class="btn"><img src="/images/Reply.png">Reply</div>
        </div>
    </div>

    <div class="discussion">
        <div class="title">"How to Apply for CrowdFunding?"</div>
        <div class="meta">(8 replies)</div>
        <div class="buttons">
            <div class="btn"><img src="/images/Eye.png">View Thread</div>
            <div class="btn"><img src="/images/Reply.png">Reply</div>
        </div>
    </div>

    <div class="discussion">
        <div class="title">"Tips for Maintaining Wind Turbines?"</div>
        <div class="meta">(4 replies)</div>
        <div class="buttons">
            <div class="btn"><img src="/images/Eye.png">View Thread</div>
            <div class="btn"><img src="/images/Reply.png">Reply</div>
        </div>
    </div>

    <footer>
        Community Guidelines 
        <span class="report">Report Post 🚩</span>
    </footer>
    <script src="/navigationSupplier.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
</div>
</body>
</html>

