<?php
require_once __DIR__ . '/../models/Product.php';

$pageTitle = 'My Products';
include __DIR__ . '/partials/header.php';

$productModel = new Product();
$supplierId = (int) $_SESSION['user']['id'];
$products = $productModel->findBySupplier($supplierId);
?>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h1>My Products</h1>
            <a href="/products/create" class="btn primary">+ Add Product</a>
        </div>
        
        <div class="grid">
            <div class="card row-span-12">
                <?php if (empty($products)): ?>
                    <p class="muted">No products yet. <a href="/products/create">Add your first product</a></p>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($product['name']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($product['category']); ?></td>
                                    <td>P<?php echo number_format((float)$product['price'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($product['description'] ?? ''); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($product['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
<?php include __DIR__ . '/partials/footer.php'; ?>

