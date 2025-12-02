<?php
$pageTitle = 'Home';
include __DIR__ . '/partials/header.php';
?>
        <h1>Welcome to Enersave</h1>
        <div class="grid">
            <div class="card row-span-12">
                <h2>Your Dashboard</h2>
                <p class="muted">Welcome back, <?php echo htmlspecialchars($_SESSION['user']['username'] ?? 'User'); ?>!</p>
                <p>This is your home page. Explore sustainable energy solutions and connect with your community.</p>
            </div>
        </div>
<?php include __DIR__ . '/partials/footer.php'; ?>

