<?php
$pageTitle = 'Learn';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Learning Hub</title>

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
}

.nav-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #ffcc00;
    cursor: pointer;
    margin-right: 15px;
}

.brand-name {
    font-weight: 900;
    font-size: 18px;
}

.container {
    padding: 5px 50px;
    margin-right: 5px;
    margin-left: -20px;
}

h1 {
    font-size: 28px;
    margin-bottom: 5px;
}
.subtitle {
    color: #666;
    margin-top: 0;
    margin-bottom: 40px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 35px;
    margin-bottom: 18px;
    font-weight: 700;
    font-size: 18px;
}

.section-header a {
    font-size: 14px;
    color: #2e7d32;
    text-decoration: none;
}

.video-list {
    display: flex;
    gap: 20px;
}

.video-card,
.guide-card {
    background: #ececec;
    padding: 14px 20px;
    border-radius: 30px;
    display: flex;
    align-items: center;
    gap: 12px;

    flex: 1;                  
    max-width: 600px;         
    min-width: 250px;     
}

.icon {
    width: 22px;
    height: 22px;
}

.guide-list {
    display: flex;
    gap: 20px;
}

.download-btn {
    margin-left: auto;        
    background: white;
    border: 1px solid #ccc;
    border-radius: 15px;
    padding: 6px 15px;

    display: inline-flex;       
    align-items: center;        
    justify-content: center;    
    gap: 6px;
    cursor: pointer;
    width: 110px;               
    text-align: center;        
}

.webinar-box {
    background: #eaeaea;
    padding: 18px 25px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
    max-width: 600px;
}

.webinar-info {
    flex: 1;
}

.webinar-title {
    font-weight: 700;
    font-size: 15px;
}

.webinar-date {
    font-size: 13px;
    color: #555;
}

.register-btn {
    background: #27ae60;
    padding: 10px 20px;
    border-radius: 25px;
    color: white;
    font-weight: 700;
    border: none;
    cursor: pointer;
}
.register-btn:hover {
    background: #1e8449;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/StudentDashBoard" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/StudentDashBoard" id="homeDirect">Home</a>
        <a href="/StudentLearning" style="color: green;">Learn</a>
        <a href="/StudentCommunity" id="forumDirect">Community</a>
    </div>

    <div class="nav-right">
        <?php if ($role === 'EDUCATOR_ADVOCATE'): ?>
        <form method="post" action="/toggle-mode" style="display: inline; margin-right: 10px;">
            <button type="submit" style="background: #2e9e48; color: black; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: 600; font-size: 13px;">
                Switch to Educator Mode
            </button>
        </form>
        <?php endif; ?>
        Student: <?php echo htmlspecialchars($username); ?>
        <div class="nav-avatar"></div>
    </div>
</div>      

<div class="container">
    <h1>LEARNING HUB</h1>
    <p class="subtitle">Explore guides, videos, and tips on clean energy to power your community.</p>

    <div class="section-header">
        <span>Featured Videos</span>
        <a href="#">View More Videos &gt;&gt;</a>
    </div>

    <div class="video-list">
        <div class="video-card">
            <img src="/images/video.png" class="icon">
            "How Solar Panels Work"
            <span style="margin-left:auto; color:#666;">(5 mins)</span>
        </div>

        <div class="video-card">
            <img src="/images/video.png" class="icon">
            "Hydropower Basics"
            <span style="margin-left:auto; color:#666;">(8 mins)</span>
        </div>

        <div class="video-card">
            <img src="/images/video.png" class="icon">
            "Wind Energy Explained"
            <span style="margin-left:auto; color:#666;">(6 mins)</span>
        </div>
    </div>

    <div class="section-header">
        <span>Downloadable Guides</span>
        <a href="#">View More Videos &gt;&gt;</a>
    </div>

    <div class="guide-list">
        <div class="guide-card">
            <img src="/images/notes.png" class="icon">
            "DIY Solar Panel Setup"
            <button class="download-btn">
                <i class="fa-solid fa-download"></i>
                Download
            </button>
        </div>

        <div class="guide-card">
            <img src="/images/notes.png" class="icon">
            "Wind Generator Guide"
            <button class="download-btn">
                <i class="fa-solid fa-download"></i>
                Download
            </button>
        </div>

        <div class="guide-card">
            <img src="/images/notes.png" class="icon">
            "Community Energy Tips"
            <button class="download-btn">
                <i class="fa-solid fa-download"></i>Download
            </button>
        </div>
    </div>

    <div class="section-header" style="margin-top:40px;">
        <span>Upcoming Webinars</span>
    </div>

    <div class="webinar-box">
        <img src="/images/calendar.png" class="icon">
        <div class="webinar-info">
            <div class="webinar-title">"Sustainable Energy in Rural Areas"</div>
            <div class="webinar-date">Nov 20, 2025</div>
        </div>
        <button class="register-btn">Register Now</button>
    </div>
<script src="/navigationStudent.js"></script>
</div>
</body>
</html>

