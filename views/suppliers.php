<?php
$pageTitle = 'Suppliers';
include __DIR__ . '/partials/header.php';
?>
        <h1>Supplier Management</h1>
        <div class="grid">
            <div class="card row-span-12">
                <h2>Verified Suppliers</h2>
                <p class="muted">Manage supplier accounts and verifications</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="4" class="muted">No suppliers found</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
<?php include __DIR__ . '/partials/footer.php'; ?>

