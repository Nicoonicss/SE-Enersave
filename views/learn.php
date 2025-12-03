<?php
$pageTitle = 'Learn';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Student';

// Sample learning resources
$learningResources = [
    ['type' => 'video', 'title' => 'How Solar Power Works (8 min)', 'category' => 'Solar'],
    ['type' => 'download', 'title' => 'DIY Solar Setup Guide', 'category' => 'Solar'],
    ['type' => 'video', 'title' => 'Intro to Micro Hydro Systems', 'category' => 'Hydro'],
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
</head>
<body>
    <!-- Educator/Student Header -->
    <header class="site-header">
        <div class="inner">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="font-size: 0.875rem; color: var(--muted); font-weight: 500;">Educator/Student</div>
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
                <span style="font-weight: 600; color: var(--text);">Student: <?php echo htmlspecialchars($username); ?></span>
                <div style="width: 36px; height: 36px; border-radius: 50%; background: #f59e0b; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">
                    <?php echo strtoupper(substr($username, 0, 1)); ?>
                </div>
            </div>
        </div>
    </header>
    <main class="container">
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 32px; margin-top: 32px;">
            <!-- Main Content -->
            <div>
                <h1 class="admin-title" style="font-size: 2rem; margin-bottom: 24px;">Learning Hub</h1>
                
                <!-- Categories -->
                <div style="margin-bottom: 32px;">
                    <div style="font-weight: 600; font-size: 1rem; margin-bottom: 12px; color: var(--text);">Categories</div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <button class="filter-pill active" data-category="all" onclick="filterCategory('all')">All</button>
                        <button class="filter-pill" data-category="solar" onclick="filterCategory('solar')">Solar</button>
                        <button class="filter-pill" data-category="hydro" onclick="filterCategory('hydro')">Hydro</button>
                        <button class="filter-pill" data-category="wind" onclick="filterCategory('wind')">Wind</button>
                        <button class="filter-pill" data-category="sustainability" onclick="filterCategory('sustainability')">Sustainability</button>
                    </div>
                </div>

                <!-- Learning Resources List -->
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <?php foreach ($learningResources as $resource): ?>
                        <div class="card" style="display: flex; align-items: center; justify-content: space-between; padding: 20px;">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <?php if ($resource['type'] === 'video'): ?>
                                    <div style="width: 48px; height: 48px; border-radius: 50%; background: #e5f2ff; display: flex; align-items: center; justify-content: center;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10" fill="#2563eb"/>
                                            <path d="M10 8L16 12L10 16V8Z" fill="white"/>
                                        </svg>
                                    </div>
                                <?php else: ?>
                                    <div style="width: 48px; height: 48px; border-radius: 8px; background: #f0f9ff; display: flex; align-items: center; justify-content: center;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14 2V8H20" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div style="font-weight: 600; font-size: 1rem; color: var(--text);">
                                        <?php echo htmlspecialchars($resource['title']); ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <?php if ($resource['type'] === 'video'): ?>
                                    <button class="action-btn" style="background: #d1fae5; color: #065f46; border: none; padding: 8px 16px; border-radius: 6px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;" onclick="watchVideo('<?php echo htmlspecialchars($resource['title']); ?>')">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="7" fill="#065f46"/>
                                            <path d="M6 5L11 8L6 11V5Z" fill="white"/>
                                        </svg>
                                        Watch
                                    </button>
                                <?php else: ?>
                                    <button class="action-btn" style="background: #d1fae5; color: #065f46; border: none; padding: 8px 16px; border-radius: 6px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;" onclick="downloadResource('<?php echo htmlspecialchars($resource['title']); ?>')">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 11V1M8 11L5 8M8 11L11 8" stroke="#065f46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M1 14H15" stroke="#065f46" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        Download
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div style="display: flex; flex-direction: column; gap: 24px;">
                <!-- My Learning Progress -->
                <div class="card">
                    <h2 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 16px; color: var(--text);">My Learning Progress</h2>
                    <div style="width: 100%; height: 12px; border-radius: 999px; background: #e5e7eb; overflow: hidden; margin-bottom: 12px;">
                        <div style="width: 60%; height: 100%; background: var(--accent); border-radius: 999px;"></div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.9375rem;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="20" height="20" rx="4" fill="#22c55e"/>
                            <path d="M6 10L9 13L14 7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>You've completed <strong>3/5 Lessons</strong></span>
                    </div>
                </div>

                <!-- Community Forum Highlights -->
                <div class="card">
                    <h2 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 16px; color: var(--text);">Community Forum Highlights</h2>
                    <div style="margin-bottom: 16px;">
                        <div style="font-weight: 600; font-size: 0.9375rem; margin-bottom: 8px; color: var(--text);">
                            Topic: "How do wind turbines work?"
                        </div>
                        <div style="font-size: 0.875rem; color: var(--muted);">
                            Replies: 8 | Posted by: Ana | 2h ago
                        </div>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <button class="action-btn" style="flex: 1; background: var(--accent); color: white; border: none; padding: 10px 16px; border-radius: 6px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 6px; text-decoration: none;" onclick="replyToTopic()">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 1L3 6H7V11H9V6H13L8 1Z" fill="white"/>
                            </svg>
                            Reply
                        </button>
                        <button class="btn ghost" style="flex: 1; background: #f3f4f6; color: var(--text); border: 1.5px solid var(--border); padding: 10px 16px; border-radius: 6px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 6px;" onclick="shareTopic()">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8C12 8.53043 11.7893 9.03914 11.4142 9.41421C11.0391 9.78929 10.5304 10 10 10C9.46957 10 8.96086 9.78929 8.58579 9.41421C8.21071 9.03914 8 8.53043 8 8C8 7.46957 8.21071 6.96086 8.58579 6.58579C8.96086 6.21071 9.46957 6 10 6C10.5304 6 11.0391 6.21071 11.4142 6.58579C11.7893 6.96086 12 7.46957 12 8Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M4 4C4 4.53043 3.78929 5.03914 3.41421 5.41421C3.03914 5.78929 2.53043 6 2 6C1.46957 6 0.960861 5.78929 0.585786 5.41421C0.210714 5.03914 0 4.53043 0 4C0 3.46957 0.210714 2.96086 0.585786 2.58579C0.960861 2.21071 1.46957 2 2 2C2.53043 2 3.03914 2.21071 3.41421 2.58579C3.78929 2.96086 4 3.46957 4 4Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M4 12C4 12.5304 3.78929 13.0391 3.41421 13.4142C3.03914 13.7893 2.53043 14 2 14C1.46957 14 0.960861 13.7893 0.585786 13.4142C0.210714 13.0391 0 12.5304 0 12C0 11.4696 0.210714 10.9609 0.585786 10.5858C0.960861 10.2107 1.46957 10 2 10C2.53043 10 3.03914 10.2107 3.41421 10.5858C3.78929 10.9609 4 11.4696 4 12Z" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            Share
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function filterCategory(category) {
                // Remove active class from all buttons
                document.querySelectorAll('.filter-pill').forEach(btn => {
                    btn.classList.remove('active');
                });
                // Add active class to clicked button
                document.querySelector(`[data-category="${category}"]`).classList.add('active');
                
                // TODO: Filter resources by category
                console.log('Filtering by category:', category);
            }

            function watchVideo(title) {
                alert('Opening video: ' + title);
                // TODO: Implement video player
            }

            function downloadResource(title) {
                alert('Downloading: ' + title);
                // TODO: Implement download functionality
            }

            function replyToTopic() {
                alert('Opening reply form...');
                // TODO: Navigate to forum reply page
            }

            function shareTopic() {
                alert('Sharing topic...');
                // TODO: Implement share functionality
            }
        </script>
    </main>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
