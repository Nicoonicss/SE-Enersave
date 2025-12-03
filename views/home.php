<?php
$pageTitle = 'Home';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Donor';

// Sample projects data
$featuredProjects = [
    ['id' => 1, 'title' => 'Solar for Schools', 'goal' => 100000, 'raised' => 93000, 'percentage' => 93, 'image' => 'solar-schools.jpg'],
    ['id' => 2, 'title' => 'Hydro for Hope', 'goal' => 75000, 'raised' => 75000, 'percentage' => 100, 'image' => 'hydro-hope.jpg'],
    ['id' => 3, 'title' => 'Wind for Progress', 'goal' => 200000, 'raised' => 50000, 'percentage' => 25, 'image' => 'wind-progress.jpg'],
];

// Sample donations data
$myDonations = [
    ['project' => 'Solar for Schools', 'amount' => 500, 'status' => 'Confirmed'],
    ['project' => 'Hydro for Hope', 'amount' => 200, 'status' => 'Pending'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> · Enersave</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .hero-banner {
            position: relative;
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
            background-image: url('/images/solarpanelfarm.png');
            background-size: cover;
            background-position: center;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3));
        }
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 40px;
            max-width: 800px;
        }
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 16px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }
        .hero-description {
            font-size: 1.125rem;
            margin-bottom: 32px;
            opacity: 0.95;
        }
        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
        }
        .project-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }
        .project-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        .donation-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid var(--border);
        }
        .donation-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <?php if ($role === 'DONOR_NGO'): ?>
        <!-- Donor Header -->
        <header class="site-header">
            <div class="inner">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="font-size: 0.875rem; color: var(--muted); font-weight: 500;">Donor</div>
                    <div class="brand">
                        <img src="/images/logo.svg" alt="logo">
                        <span class="name">EnerSave</span>
                    </div>
                </div>
                <?php 
                require_once __DIR__ . '/../helpers/NavigationHelper.php';
                $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
                echo NavigationHelper::renderNavigation($role, $currentPath);
                ?>
                <div style="display: flex; align-items: center; gap: 12px; margin-left: 20px;">
                    <span style="font-weight: 600; color: var(--text);"><?php echo htmlspecialchars($username); ?></span>
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--accent); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">
                        <?php echo strtoupper(substr($username, 0, 1)); ?>
                    </div>
                </div>
            </div>
        </header>
        <main class="container">
            <!-- Hero Banner -->
            <div class="hero-banner">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <h1 class="hero-title">Empowering Communities with Sustainable Energy</h1>
                    <p class="hero-description">Connecting rural and remote communities with sustainable energy solutions to build a brighter, greener future.</p>
                    <div class="hero-buttons">
                        <a href="/marketplace" class="action-btn" style="text-decoration: none;">
                            Explore Marketplace
                        </a>
                        <a href="/learn" class="btn ghost" style="background: white; color: var(--accent); border: 2px solid white; text-decoration: none;">
                            Learn About Clean Energy
                        </a>
                    </div>
                </div>
            </div>

            <!-- Featured Projects (Quick Donate) -->
            <section style="margin-bottom: 48px;">
                <h2 class="section-title" style="margin-bottom: 24px;">Featured Projects (Quick Donate)</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                    <?php foreach ($featuredProjects as $project): ?>
                        <div class="project-card">
                            <div class="project-image">
                                <div style="text-align: center;">
                                    <div style="font-size: 1.5rem; margin-bottom: 8px;">⚡</div>
                                    <div style="font-size: 0.875rem; opacity: 0.9;"><?php echo htmlspecialchars($project['title']); ?></div>
                                </div>
                            </div>
                            <div style="padding: 20px;">
                                <div style="margin-bottom: 12px;">
                                    <div style="font-size: 0.875rem; color: var(--muted); margin-bottom: 4px;">Goal: P<?php echo number_format($project['goal']); ?></div>
                                    <div style="font-weight: 600; color: var(--text);">
                                        Raised P<?php echo number_format($project['raised']); ?> (<?php echo $project['percentage']; ?>%)
                                    </div>
                                </div>
                                <div style="width: 100%; height: 12px; border-radius: 999px; background: #e5e7eb; overflow: hidden; margin-bottom: 16px;">
                                    <div style="width: <?php echo $project['percentage']; ?>%; height: 100%; background: var(--accent); border-radius: 999px;"></div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <button class="action-btn" style="flex: 1; text-decoration: none; justify-content: center;" onclick="donateToProject(<?php echo $project['id']; ?>, '<?php echo htmlspecialchars($project['title']); ?>')">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 6px;">
                                            <path d="M8 1V15M8 1L3 6H8M8 1L13 6H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Donate
                                    </button>
                                    <button class="btn ghost" style="flex: 1; background: white; border: 1.5px solid var(--border);" onclick="viewProjectDetails(<?php echo $project['id']; ?>)">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 6px;">
                                            <path d="M8 3C5.79086 3 4 4.79086 4 7C4 9.20914 5.79086 11 8 11C10.2091 11 12 9.20914 12 7C12 4.79086 10.2091 3 8 3Z" stroke="currentColor" stroke-width="1.5"/>
                                            <path d="M1 7C1 7 3 3 8 3C13 3 15 7 15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                            <path d="M1 7C1 7 3 11 8 11C13 11 15 7 15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                        Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- My Donations Summary -->
            <section style="margin-bottom: 48px;">
                <h2 class="section-title" style="margin-bottom: 24px;">My Donations Summary</h2>
                <div class="card" style="padding: 0;">
                    <?php if (empty($myDonations)): ?>
                        <div style="padding: 24px; text-align: center;" class="muted">
                            You haven't made any donations yet. Browse featured projects above to get started!
                        </div>
                    <?php else: ?>
                        <?php foreach ($myDonations as $donation): ?>
                            <div class="donation-item">
                                <div>
                                    <div style="font-weight: 600; font-size: 0.9375rem; margin-bottom: 4px;">
                                        Project: <?php echo htmlspecialchars($donation['project']); ?>
                                    </div>
                                    <div style="font-size: 0.875rem; color: var(--text);">
                                        Amount: P<?php echo number_format($donation['amount']); ?>
                                    </div>
                                </div>
                                <div>
                                    <?php if ($donation['status'] === 'Confirmed'): ?>
                                        <span class="status-badge active">Confirmed</span>
                                    <?php else: ?>
                                        <span class="status-badge pending">Pending</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div style="padding: 16px; text-align: center; border-top: 1px solid var(--border);">
                            <button class="btn ghost" onclick="viewAllDonations()" style="width: 100%;">
                                View All Donations
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <script>
                function donateToProject(id, title) {
                    const amount = prompt('Enter donation amount for "' + title + '":');
                    if (amount && parseFloat(amount) > 0) {
                        alert('Thank you for your donation of P' + amount + ' to ' + title + '!');
                        // TODO: Implement donation functionality
                        location.reload();
                    }
                }

                function viewProjectDetails(id) {
                    alert('Viewing project details for project ID: ' + id);
                    // TODO: Navigate to project details page
                }

                function viewAllDonations() {
                    alert('Viewing all donations...');
                    // TODO: Navigate to donations page
                }
            </script>
        </main>
    <?php else: ?>
        <?php include __DIR__ . '/partials/header.php'; ?>
        <h1>Welcome to Enersave</h1>
        <div class="grid">
            <div class="card row-span-12">
                <h2>Your Dashboard</h2>
                <p class="muted">Welcome back, <?php echo htmlspecialchars($_SESSION['user']['username'] ?? 'User'); ?>!</p>
                <p>This is your home page. Explore sustainable energy solutions and connect with your community.</p>
            </div>
        </div>
    <?php endif; ?>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
