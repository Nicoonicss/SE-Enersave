<?php
$pageTitle = 'Users';
include __DIR__ . '/partials/header.php';
?>
        <h1>User Management</h1>
        <div class="grid">
            <div class="card row-span-12">
                <h2>All Users</h2>
                <p class="muted">Manage user accounts and roles</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="4" class="muted">No users found</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
<?php include __DIR__ . '/partials/footer.php'; ?>

