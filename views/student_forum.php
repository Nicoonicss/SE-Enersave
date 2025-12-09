<?php
$pageTitle = 'Forum';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>EnerSave Community Forum</title>

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

.nav-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #ffcc00;
    cursor: pointer;
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
        <a href="/StudentDashBoard" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/StudentDashBoard" id="homeDirect">Home</a>
        <a href="/StudentLearning" id="learnDirect">Learn</a>
        <a href="/StudentCommunity" style="color: green;">Community</a>
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
    <script src="/navigationStudent.js"></script>
</div>
</body>
</html>

