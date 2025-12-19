<?php
$pageTitle = 'Learning Hub';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Community User';
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
    color: black;
    font-weight: 700;
    border: none;
    cursor: pointer;
}
.register-btn:hover {
    background: #1e8449;
}
</style>
</head>

<body>

<div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/communityUserUI" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/communityUserUI" id="homeDirect">Home</a>
        <a href="/communityMarketplaceUI" id="marketplaceDirect">Marketplace</a>
        <a href="/communityCrowdfundingUI" id="projectDirect">Projects</a>
        <a href="/communityLearnUI" style="color: green;">Learn</a>
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

<div class="container">
    <h1>LEARNING HUB</h1>
    <p class="subtitle">Explore guides, videos, and tips on clean energy to power your community.</p>

    <div class="section-header">
        <span>Featured Videos</span>
        <a href="#">View More Videos &gt;&gt;</a>
    </div>

    <div class="video-list" id="videosContainer">
        <!-- Videos will be loaded dynamically from database -->
    </div>

    <div class="section-header">
        <span>Downloadable Guides</span>
        <a href="#">View More Guides &gt;&gt;</a>
    </div>

    <div class="guide-list" id="guidesContainer">
        <!-- Guides will be loaded dynamically from database -->
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

</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="/navigationCommunity.js"></script>
<script src="/JavaScripts/avatarDropdown.js"></script>
<script>
// Load learning resources from database
document.addEventListener('DOMContentLoaded', function() {
    const videosContainer = document.getElementById('videosContainer');
    const guidesContainer = document.getElementById('guidesContainer');
    
    function createVideoCard(resource) {
        const card = document.createElement('div');
        card.className = 'video-card';
        card.innerHTML = `
            <img src="/images/video.png" class="icon">
            "${resource.title}"
            <span style="margin-left:auto; color:#666;">(${resource.description || 'Video'})</span>
        `;
        
        if (resource.file_url) {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function() {
                window.open(resource.file_url, '_blank');
            });
        }
        
        return card;
    }
    
    function createGuideCard(resource) {
        const card = document.createElement('div');
        card.className = 'guide-card';
        card.innerHTML = `
            <img src="/images/notes.png" class="icon">
            "${resource.title}"
            <button class="download-btn" ${resource.file_url ? '' : 'disabled'}>
                <i class="fa-solid fa-download"></i>
                Download
            </button>
        `;
        
        const downloadBtn = card.querySelector('.download-btn');
        if (downloadBtn && resource.file_url) {
            downloadBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (resource.file_url) {
                    window.open(resource.file_url, '_blank');
                }
            });
        }
        
        return card;
    }
    
    function loadResources(category = null) {
        let url = '/api/learning-resources';
        if (category && category !== 'all') {
            url += '?category=' + encodeURIComponent(category);
        }
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.resources) {
                    // Clear containers
                    if (videosContainer) videosContainer.innerHTML = '';
                    if (guidesContainer) guidesContainer.innerHTML = '';
                    
                    // Separate videos and downloadable guides
                    const videos = data.resources.filter(r => r.file_type === 'video' && !r.is_downloadable);
                    const guides = data.resources.filter(r => r.is_downloadable);
                    
                    // Display videos
                    if (videos.length === 0) {
                        if (videosContainer) {
                            videosContainer.innerHTML = '<p style="color: #666; padding: 20px;">No videos available.</p>';
                        }
                    } else {
                        videos.slice(0, 3).forEach(resource => {
                            const card = createVideoCard(resource);
                            if (videosContainer) videosContainer.appendChild(card);
                        });
                    }
                    
                    // Display guides
                    if (guides.length === 0) {
                        if (guidesContainer) {
                            guidesContainer.innerHTML = '<p style="color: #666; padding: 20px;">No downloadable guides available.</p>';
                        }
                    } else {
                        guides.slice(0, 3).forEach(resource => {
                            const card = createGuideCard(resource);
                            if (guidesContainer) guidesContainer.appendChild(card);
                        });
                    }
                } else {
                    console.error('Error loading resources:', data);
                }
            })
            .catch(error => {
                console.error('Error loading resources:', error);
                if (videosContainer) videosContainer.innerHTML = '<p style="color: #666; padding: 20px;">Error loading videos.</p>';
                if (guidesContainer) guidesContainer.innerHTML = '<p style="color: #666; padding: 20px;">Error loading guides.</p>';
            });
    }
    
    // Load resources on page load
    loadResources();
    
    // Make loadResources accessible globally for category filtering
    window.loadResources = loadResources;
});
</script>
</body>
</html>

