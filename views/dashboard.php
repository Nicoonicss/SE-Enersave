<?php
require_once __DIR__ . '/../models/Product.php';

$pageTitle = 'Dashboard';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Supplier';

// Supplier specific data
if ($role === 'SUPPLIER_INSTALLER') {
    $productModel = new Product();
    $supplierId = (int) ($_SESSION['user']['id'] ?? 0);
    $products = $productModel->findBySupplier($supplierId);
    $totalProducts = count($products);

    // Placeholder values to visually match the Figma layout
    $activeProjects = 2;
    $isVerified = true;
}
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
    <?php if ($role === 'SUPPLIER_INSTALLER'): ?>
        <!-- Supplier Header -->
        <header class="site-header">
            <div class="inner">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="font-size: 0.875rem; color: var(--muted); font-weight: 500;">Supplier/Installer</div>
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
                    <span style="font-weight: 600; color: var(--text);">Supplier: <?php echo htmlspecialchars($username); ?></span>
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--accent); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">
                        <?php echo strtoupper(substr($username, 0, 1)); ?>
                    </div>
                </div>
            </div>
        </header>
        <main class="container">
            <!-- Dashboard Overview -->
            <section style="margin-bottom: 40px;">
                <h1 class="admin-title" style="font-size: 1.75rem; margin-bottom: 8px;">DASHBOARD OVERVIEW</h1>
                
                <div class="metrics-grid" style="margin-top: 24px;">
                    <div class="metric-card">
                        <div class="metric-label">Total Products</div>
                        <div class="metric-value"><?php echo htmlspecialchars($totalProducts); ?></div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-label">Active Projects</div>
                        <div class="metric-value"><?php echo htmlspecialchars($activeProjects); ?></div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-label">Verification</div>
                        <div class="metric-value" style="font-size: 2.5rem; line-height: 1;">
                            <?php if ($isVerified): ?>
                                <span style="color: var(--accent);">✓</span>
                            <?php else: ?>
                                <span style="color: var(--warning);">⏳</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- My Product Listings -->
            <section style="margin-bottom: 40px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="section-title" style="margin: 0;">MY PRODUCT LISTINGS</h2>
                    <a href="/products/create" class="action-btn" style="text-decoration: none;">
                        <span style="font-size: 1.2rem; margin-right: 8px;">+</span>
                        Add New Product
                    </a>
                </div>

                <div class="card" style="padding: 0; background: #f9fafb;">
                    <?php if (empty($products)): ?>
                        <div style="padding: 24px; text-align: center;" class="muted">
                            You don't have any products yet. Click <strong>Add New Product</strong> to create your first listing.
                        </div>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid var(--border); background: white; margin-bottom: 1px;">
                                <div>
                                    <div style="font-weight: 600; font-size: 1rem; margin-bottom: 4px;">
                                        <?php echo htmlspecialchars($product['name']); ?>
                                    </div>
                                    <div style="color: var(--text); font-weight: 500;">
                                        P<?php echo htmlspecialchars(number_format((float)$product['price'], 0)); ?>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <a href="/products" 
                                       style="background: #e5f2ff; color: #2563eb; padding: 6px 14px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.333 2.00001C11.5084 1.82465 11.7163 1.68606 11.9441 1.59231C12.1719 1.49856 12.4151 1.45166 12.6667 1.45166C12.9182 1.45166 13.1614 1.49856 13.3892 1.59231C13.617 1.68606 13.8249 1.82465 14 2.00001C14.1754 2.17537 14.314 2.38322 14.4077 2.61101C14.5015 2.8388 14.5484 3.08201 14.5484 3.33367C14.5484 3.58533 14.5015 3.82854 14.4077 4.05633C14.314 4.28412 14.1754 4.49197 14 4.66734L5.00001 13.6667L1.33334 14.6667L2.33334 11L11.333 2.00001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <button type="button"
                                            onclick="confirmDeleteProduct(<?php echo (int)$product['id']; ?>)"
                                            style="background: #fee2e2; color: #b91c1c; border: none; padding: 6px 14px; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 4H14M12.6667 4V13.3333C12.6667 13.687 12.5262 14.0261 12.2761 14.2761C12.0261 14.5262 11.687 14.6667 11.3333 14.6667H4.66667C4.31305 14.6667 3.97391 14.5262 3.72386 14.2761C3.47381 14.0261 3.33333 13.687 3.33333 13.3333V4M5.33333 4V2.66667C5.33333 2.31305 5.47381 1.97391 5.72386 1.72386C5.97391 1.47381 6.31305 1.33333 6.66667 1.33333H9.33333C9.68696 1.33333 10.0261 1.47381 10.2761 1.72386C10.5262 1.97391 10.6667 2.31305 10.6667 2.66667V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

            <!-- My Projects -->
            <section style="margin-bottom: 40px;">
                <h2 class="section-title" style="margin-bottom: 20px;">MY PROJECTS</h2>
                <div class="card">
                    <div style="font-weight: 600; font-size: 1.125rem; margin-bottom: 16px;">Power of Barangay Katipunan</div>
                    <div style="margin-bottom: 8px;">
                        <div style="font-size: 0.875rem; color: var(--muted); margin-bottom: 6px;">Progress</div>
                        <div style="width: 100%; height: 16px; border-radius: 999px; background: #e5e7eb; overflow: hidden; position: relative;">
                            <div style="width: 60%; height: 100%; background: var(--accent); border-radius: 999px;"></div>
                        </div>
                        <div style="text-align: right; font-size: 0.875rem; color: var(--text); font-weight: 600; margin-top: 4px;">60% funded</div>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.9375rem; margin-bottom: 16px; padding-top: 12px; border-top: 1px solid var(--border);">
                        <span style="font-weight: 600;">Donated: <span style="color: var(--accent);">P48,000</span></span>
                        <span class="muted">Goal: P80,000</span>
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <button type="button" 
                                class="btn ghost" 
                                style="height: 38px; padding: 0 16px; background: white; border: 1.5px solid var(--border);"
                                onclick="viewProjectDetails()">
                            View Details
                        </button>
                        <button type="button" 
                                class="action-btn" 
                                style="height: 38px; padding: 0 16px; text-decoration: none;"
                                onclick="updateProjectProgress()">
                            Update Progress
                        </button>
                    </div>
                </div>
            </section>

            <!-- Verification Status -->
            <section style="margin-bottom: 40px;">
                <h2 class="section-title" style="margin-bottom: 20px;">VERIFICATION STATUS</h2>
                <div class="card">
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="display: flex; align-items: center; gap: 12px; font-size: 0.9375rem;">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="20" height="20" rx="4" fill="#22c55e"/>
                                <path d="M6 10L9 13L14 7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Documents:</span>
                            <span style="font-weight: 600; color: var(--accent);">Completed</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; font-size: 0.9375rem;">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="20" height="20" rx="4" fill="#22c55e"/>
                                <path d="M6 10L9 13L14 7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Verified:</span>
                            <span style="font-weight: 600; color: var(--accent);">Yes</span>
                        </div>
                    </div>
                </div>
            </section>

            <script>
                function confirmDeleteProduct(id) {
                    if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                        // TODO: Implement delete functionality
                        alert('Delete functionality will be implemented soon. Product ID: ' + id);
                    }
                }

                function viewProjectDetails() {
                    alert('View project details - coming soon');
                }

                function updateProjectProgress() {
                    alert('Update project progress - coming soon');
                }
            </script>
        </main>
    <?php else: ?>
        <?php include __DIR__ . '/partials/header.php'; ?>
        <h1>Dashboard</h1>
        <div class="grid">
            <div class="card row-span-6">
                <h2>Overview</h2>
                <p class="muted">Manage your account and activities</p>
            </div>
            <div class="card row-span-6">
                <h2>Quick Actions</h2>
                <p class="muted">Access frequently used features</p>
            </div>
        </div>
    <?php endif; ?>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
