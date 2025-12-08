<?php
$pageTitle = 'Community';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'User';

// Sample forum topics
$forumTopics = [
    ['id' => 1, 'title' => 'Best Solar Panel for Home Use?', 'replies' => 123, 'category' => 'Solar'],
    ['id' => 2, 'title' => 'How to Apply for Crowdfunding?', 'replies' => 56, 'category' => 'Projects'],
    ['id' => 3, 'title' => 'Tips for Maintaining Wind Turbines?', 'replies' => 24, 'category' => 'Wind'],
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
    <!-- Community Header -->
    <header class="site-header">
        <div class="inner">
            <div class="brand">
                <img src="/images/logo.svg" alt="logo">
                <span class="name">EnerSave</span>
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
        <!-- Community Forum -->
        <section style="margin-top: 32px;">
            <h1 class="admin-title" style="font-size: 2rem; margin-bottom: 8px;">COMMUNITY FORUM</h1>
            <p class="admin-subtitle" style="margin-bottom: 24px;">Connect with others, share ideas, and ask questions.</p>

            <!-- Filter and Search Bar -->
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 32px; flex-wrap: wrap;">
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <button class="filter-pill active" data-category="all" onclick="filterCategory('all')">All</button>
                    <button class="filter-pill" data-category="solar" onclick="filterCategory('solar')">Solar</button>
                    <button class="filter-pill" data-category="hydro" onclick="filterCategory('hydro')">Hydro</button>
                    <button class="filter-pill" data-category="wind" onclick="filterCategory('wind')">Wind</button>
                    <button class="filter-pill" data-category="projects" onclick="filterCategory('projects')">Projects</button>
                </div>
                <div style="position: relative; flex: 1; min-width: 200px;">
                    <svg style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: var(--muted);" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <input type="text" placeholder="Search Topics" style="width: 100%; padding: 10px 12px 10px 40px; border: 1.5px solid var(--border); border-radius: 8px; font-size: 0.9375rem; outline: none;" onkeyup="searchTopics(this.value)">
                </div>
                <button class="action-btn" onclick="startNewTopic()" style="text-decoration: none;">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 6px;">
                        <path d="M8 1V15M8 1L3 6H8M8 1L13 6H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Start New Topic
                </button>
            </div>

            <!-- Recent Discussions -->
            <div style="margin-bottom: 32px;">
                <h2 class="section-title" style="margin-bottom: 20px;">Recent Discussions</h2>
                <div class="card" style="padding: 0;">
                    <?php foreach ($forumTopics as $topic): ?>
                        <div style="padding: 20px; border-bottom: 1px solid var(--border);">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; font-size: 1rem; margin-bottom: 6px; color: var(--text);">
                                        <?php echo htmlspecialchars($topic['title']); ?>
                                    </div>
                                    <div style="font-size: 0.875rem; color: var(--muted);">
                                        <?php echo $topic['replies']; ?> replies
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn ghost" onclick="viewThread(<?php echo $topic['id']; ?>)" style="background: white; border: 1.5px solid var(--border);">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 6px;">
                                        <path d="M8 3C5.79086 3 4 4.79086 4 7C4 9.20914 5.79086 11 8 11C10.2091 11 12 9.20914 12 7C12 4.79086 10.2091 3 8 3Z" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M1 7C1 7 3 3 8 3C13 3 15 7 15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                        <path d="M1 7C1 7 3 11 8 11C13 11 15 7 15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                    View Thread
                                </button>
                                <button class="action-btn" onclick="replyToThread(<?php echo $topic['id']; ?>)" style="text-decoration: none;">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 6px;">
                                        <path d="M8 1V15M8 1L3 6H8M8 1L13 6H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Reply
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Footer Links -->
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 0; border-top: 1px solid var(--border);">
                <a href="#" style="color: var(--text); text-decoration: none; font-size: 0.875rem;">Community Guidelines</a>
                <button onclick="reportPost()" style="background: var(--danger); color: white; border: none; padding: 8px 16px; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 1V8M8 8V15M8 8H1M8 8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Report Post
                </button>
            </div>

            <script>
                function filterCategory(category) {
                    document.querySelectorAll('.filter-pill').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    document.querySelector(`[data-category="${category}"]`).classList.add('active');
                    console.log('Filtering by category:', category);
                }

                function searchTopics(query) {
                    console.log('Searching for:', query);
                    // TODO: Implement search functionality
                }

                function startNewTopic() {
                    alert('Starting new topic...');
                    // TODO: Navigate to new topic form
                }

                function viewThread(id) {
                    alert('Viewing thread ID: ' + id);
                    // TODO: Navigate to thread page
                }

                function replyToThread(id) {
                    alert('Replying to thread ID: ' + id);
                    // TODO: Navigate to reply form
                }

                function reportPost() {
                    if (confirm('Report this post?')) {
                        alert('Post reported. Thank you for keeping the community safe.');
                    }
                }
            </script>
        </section>
    </main>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
