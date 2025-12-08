<?php
require_once __DIR__ . '/../../helpers/NavigationHelper.php';

$user = $_SESSION['user'] ?? null;
$role = $user['role'] ?? 'COMMUNITY_USER';
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'Enersave'); ?> · Enersave</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <header class="site-header">
        <div class="inner">
            <div class="brand">
                <img src="/images/logo.svg" alt="logo">
                <span class="name">Enersave</span>
            </div>
            <?php echo NavigationHelper::renderNavigation($role, $currentPath); ?>
        </div>
    </header>
    <main class="container">

