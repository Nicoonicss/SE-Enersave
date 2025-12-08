<?php
require_once __DIR__ . '/../../helpers/NavigationHelper.php';

$user = $_SESSION['user'] ?? null;
$role = $user['role'] ?? 'COMMUNITY_USER';
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$username = $user['username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'Admin'); ?> · Enersave</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="site-header">
        <div class="inner">
            <div class="brand">
                <img src="/images/logo.svg" alt="logo">
                <span class="name">Enersave</span>
            </div>
            <?php echo NavigationHelper::renderNavigation($role, $currentPath); ?>
            <div class="admin-user-info">
                <span>Admin: <?php echo htmlspecialchars($username); ?></span>
                <div class="user-avatar"><?php echo strtoupper(substr($username, 0, 1)); ?></div>
            </div>
        </div>
    </header>
    <main class="container">

