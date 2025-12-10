<?php
$pageTitle = 'Home';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Educator';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnerSave - Educator Dashboard</title>
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
    margin-right:-15px;
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

    .brand-name {
    font-weight: 900;
    font-size: 18px;
    }

    .container {
        max-width: 1850px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .text-green { color: #2e9e48; }

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
    .nav-links a.active { color: #000; font-weight: 700; } 

    .user-section {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-name {
        font-weight: 700;
        font-size: 0.95rem;
    }

    .user-avatar {
        font-size: 2rem;
        color: #f39c12;
    }

    .welcome-section {
        margin-bottom: 40px;
    }

    .welcome-section h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 5px;
        text-transform: uppercase;
        margin-top:10px;
    }

    .welcome-subtitle {
        color: #2e9e48;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 25px;
        margin-top:5px;
    }

    .btn-continue {
        background-color: #2e9e48;
        color: black;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
        text-decoration: none;
    }
        
    .btn-continue:hover { background-color: #26873e; }

    .categories-section {
        margin-bottom: 50px;
    }
        
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .category-tags {
        display: flex;
        gap: 15px;
    }

    .tag {
        background-color: #F0F0F0;
        padding: 10px 30px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .tag:hover { background-color: #e4e4e7; }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr; 
        gap: 40px;
        align-items: start;
    }

    .column {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .card {
        background-color: #F0F0F0;
        padding: 25px;
        border-radius: 12px;
    }

    .card-header {
        margin-bottom: 15px;
        font-weight: 700;
        font-size: 1rem;
    }

    .featured-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 20px;
    }
        
    .featured-item i { font-size: 1.2rem; margin-top: 14px; }
        
    .featured-text { color: #666; font-size: 0.95rem; line-height: 1.4; }

    .btn-watch {
        background-color: #2e9e48;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        text-decoration: none;
    }
    .btn-watch:hover { background-color: #26873e; }

    .forum-topic {
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.3;
        font-size: 1rem;
    }

    .forum-meta {
        font-size: 0.85rem;
        color: #777;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .link-view {
        color: #2e9e48;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 1rem;
    }

    .link-view:hover { text-decoration: underline; }

    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
    }

    .activity-item:last-child { margin-bottom: 0; }

    .activity-icon {
        font-size: 1.2rem;
        width: 20px;
        margin-top: -2px;
    }

    .icon-green { color: #2e9e48; }

    .icon-yellow { color: #f39c12; }

    .activity-content { flex: 1; }

    .activity-title {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

        .progress-bar-bg {
            background-color: #fff; 
            height: 8px;
            border-radius: 4px;
            width: 100%;
            margin-bottom: 5px;
        }
        
        .progress-bar-fill {
            background-color: #2e9e48;
            height: 100%;
            width: 40%;
            border-radius: 4px;
        }

        .progress-text {
            font-size: 0.8rem;
            color: #666;
            font-weight: 500;
        }

        .activity-subtext {
            font-size: 0.8rem;
            color: #777;
        }

        .event-item {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            align-items: flex-start;
        }
        .event-item:last-child { margin-bottom: 0; }
        
        .event-icon {
            color: #2e9e48;
            font-size: 1.4rem;
            margin-top:11px;
        }

        .event-details {
            font-weight: 700;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .nav-content { flex-direction: column; align-items: flex-start; gap: 15px; }
            .brand-section { flex-direction: column; align-items: flex-start; gap: 10px; }
            .user-section { position: absolute; top: 20px; right: 20px; }
            .dashboard-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/educatorDashboardUI" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/educatorDashboardUI" id="homeDirect">Home</a>
        <a href="/educatorLearnUI">Learn</a>
        <a href="/educatorCommunityUI" id="forumDirect">Community</a>
    </div>

    <div class="nav-right">
        <form method="post" action="/toggle-mode" style="display: inline; margin-right: 10px;">
            <button type="submit" style="background: #2e9e48; color: black; border: none; padding: 10px 20px; border-radius: 25px; cursor: pointer; font-weight: 600; font-size: 14px;">
                Switch to Student Mode
            </button>
        </form>
        Educator: <?php echo htmlspecialchars($username); ?>
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
        
        <section class="welcome-section">
            <h1>WELCOME TO EnerSave!</h1>
            <p class="welcome-subtitle">Your hub for sustainable learning & community projects.</p>
            <a href="/educatorLearnUI" class="btn-continue">
                Continue Learning <i class="fa-solid fa-play"></i>
            </a>
        </section>

        <section class="categories-section">
            <h3 class="section-title">QUICK CATEGORIES</h3>
            <div class="category-tags">
                <div class="tag">Solar</div>
                <div class="tag">Hydro</div>
                <div class="tag">Wind</div>
            </div>
        </section>

        <div class="dashboard-grid">
            
            <div class="column">
                
                <div>
                    <h3 class="section-title">FEATURED CONTENT</h3>
                    <div class="card">
                        <div class="card-header">Featured Lesson</div>
                        <div class="featured-item">
                            <i class="fa-solid fa-video"></i>
                            <p class="featured-text">"Understanding Solar Energy Basics" (6 mins)</p>
                        </div>
                        <a href="#" class="btn-watch">
                            Watch Now <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="section-title">COMMUNITY HIGHLIGHTS</h3>
                    <div class="card">
                        <p class="forum-topic">Topic: "Best materials for a mini solar panel project?"</p>
                        <p class="forum-meta">Replies: 12 &nbsp;&nbsp; Posted by: Mark &nbsp;&nbsp; 1h ago</p>
                        <a href="/educatorCommunityUI" class="link-view">View Topic <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

            </div>

            <div class="column">
                
                <div>
                    <h3 class="section-title">RECENT ACTIVITIES</h3>
                    <div class="card">
                        <ul class="activity-list">
                            
                            <li class="activity-item">
                                <div class="activity-icon icon-green"><i class="fa-solid fa-graduation-cap"></i></div>
                                <div class="activity-content">
                                    <div class="activity-title">Continue: "DIY Solar Setup"</div>
                                    <div class="progress-bar-bg">
                                        <div class="progress-bar-fill"></div>
                                    </div>
                                    <p class="progress-text">40% completed</p>
                                </div>
                            </li>

                            <li class="activity-item">
                                <div class="activity-icon icon-green"><i class="fa-solid fa-video"></i></div>
                                <div class="activity-content">
                                    <div class="activity-title">New: "Hydropower 101"</div>
                                    <p class="activity-subtext">uploaded 2 days ago</p>
                                </div>
                            </li>

                            <li class="activity-item">
                                <div class="activity-icon icon-yellow"><i class="fa-solid fa-comment"></i></div>
                                <div class="activity-content">
                                    <div class="activity-title">Forum: 3 new replies</div>
                                    <p class="activity-subtext">in your followed topics</p>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

                <div>
                    <h3 class="section-title">UPCOMING EVENTS / NOTICES</h3>
                    <div class="card">
                        <div class="event-item">
                            <div class="event-icon"><i class="fa-regular fa-calendar"></i></div>
                            <p class="event-details">Webinar: "Renewable Energy for Beginners" - Jan 15</p>
                        </div>

                        <div class="event-item">
                            <div class="event-icon"><i class="fa-regular fa-clipboard"></i></div>
                            <p class="event-details">Assessment: Solar Energy Basics due in 3 Days</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="/navigationEducator.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
</body>
</html>

