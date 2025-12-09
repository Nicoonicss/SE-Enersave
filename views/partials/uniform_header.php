<?php
require_once __DIR__ . '/../../helpers/NavigationHelper.php';

$user = $_SESSION['user'] ?? null;
$role = $user['role'] ?? 'COMMUNITY_USER';
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$username = $user['username'] ?? 'User';

// Role badge labels
$roleBadges = [
    'COMMUNITY_USER' => 'Community',
    'SUPPLIER_INSTALLER' => 'Supplier/Installer',
    'EDUCATOR_ADVOCATE' => 'Educator/Student',
    'DONOR_NGO' => 'Donor',
    'ADMIN' => 'Admin',
];

$roleBadge = $roleBadges[$role] ?? 'User';
?>
<header class="site-header">
    <div class="inner">
        <div class="header-left">
            <div class="role-badge"><?php echo htmlspecialchars($roleBadge); ?></div>
            <div class="brand">
                <img src="/images/Logo.png" alt="logo">
                <span class="name">EnerSave</span>
            </div>
        </div>
        <?php echo NavigationHelper::renderNavigation($role, $currentPath); ?>
        <div class="header-right">
            <span class="user-info"><?php echo htmlspecialchars($username); ?></span>
            <div class="user-avatar">
                <?php echo strtoupper(substr($username, 0, 1)); ?>
            </div>
        </div>
    </div>
</header>

