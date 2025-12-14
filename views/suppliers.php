<?php
$pageTitle = 'Suppliers Management';
include __DIR__ . '/partials/admin_header.php';

// Sample suppliers data
$suppliers = [
    ['id' => 'S024', 'name' => 'Steven Mitchell', 'role' => 'Admin', 'email' => 's.mitchell@gmail.com', 'status' => 'Active', 'joined' => 'Nov 1, 2025'],
    ['id' => 'S025', 'name' => 'Jer Erick', 'role' => 'Community', 'email' => 'jer.erick@gmail.com', 'status' => 'Active', 'joined' => 'Oct 28, 2025'],
    ['id' => 'S026', 'name' => 'Monico Vian', 'role' => 'Community', 'email' => 'monico.vian@gmail.com', 'status' => 'Active', 'joined' => 'Oct 25, 2025'],
    ['id' => 'S027', 'name' => 'Sarah Discaya', 'role' => 'Supplier', 'email' => 'sarah.discaya@gmail.com', 'status' => 'Banned', 'joined' => 'Oct 20, 2025'],
    ['id' => 'S028', 'name' => 'Crist Briand Brader', 'role' => 'Community', 'email' => 'cristbriand.brader.25@usjr.edu.ph', 'status' => 'Active', 'joined' => 'Nov 2, 2025'],
];

$selectedSupplier = $suppliers[4] ?? null;
?>
        <div class="management-header">
            <h1 class="management-title">SUPPLIERS MANAGEMENT</h1>
            <p class="management-subtitle">Manage all suppliers in the EnerSave platform.</p>
        </div>
        
        <!-- Search and Filter Panel -->
        <div class="search-filter-panel">
            <div class="search-bar">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Enter supplier name, email, or ID" onkeyup="filterSuppliers()">
            </div>
            <div class="filter-sort-row">
                <div class="filter-group">
                    <span class="filter-label">Filter by: Role</span>
                    <div class="filter-pills">
                        <button class="filter-pill active" data-role="all" onclick="filterByRole('all')">All</button>
                        <button class="filter-pill" data-role="Admin" onclick="filterByRole('Admin')">Admin</button>
                        <button class="filter-pill" data-role="Supplier" onclick="filterByRole('Supplier')">Supplier</button>
                        <button class="filter-pill" data-role="Community" onclick="filterByRole('Community')">Community</button>
                    </div>
                </div>
                <div class="sort-group">
                    <span class="sort-label">Sort by:</span>
                    <div class="sort-option" onclick="sortSuppliers('name')">
                        Name
                        <svg class="sort-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6L8 2L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 10L8 14L12 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="sort-option" onclick="sortSuppliers('status')">
                        Status
                        <svg class="sort-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6L8 2L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 10L8 14L12 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Suppliers Table -->
        <div class="data-table-panel">
            <h2 class="table-title">All Suppliers</h2>
            <table class="admin-table" id="suppliersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="suppliersTableBody">
                    <?php foreach ($suppliers as $supplier): ?>
                    <tr onclick="selectSupplier(<?php echo htmlspecialchars(json_encode($supplier)); ?>)">
                        <td><?php echo htmlspecialchars($supplier['id']); ?></td>
                        <td><?php echo htmlspecialchars($supplier['name']); ?></td>
                        <td><?php echo htmlspecialchars($supplier['role']); ?></td>
                        <td><?php echo htmlspecialchars($supplier['email']); ?></td>
                        <td>
                            <span class="status-badge <?php echo strtolower($supplier['status']); ?>">
                                <?php echo htmlspecialchars($supplier['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-links">
                                <a href="#" class="action-link" onclick="event.stopPropagation(); editSupplier(<?php echo htmlspecialchars(json_encode($supplier['id'])); ?>)">Edit</a>
                                <span> / </span>
                                <a href="#" class="action-link danger" onclick="event.stopPropagation(); toggleBan('<?php echo $supplier['id']; ?>', '<?php echo $supplier['status']; ?>')">
                                    <?php echo $supplier['status'] === 'Banned' ? 'Unban' : 'Ban'; ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Supplier Details Panel -->
        <div class="details-panel">
            <h2 class="details-panel-title">Users Details Panel</h2>
            <div class="details-grid" id="supplierDetails">
                <div class="detail-item">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value" id="detailName"><?php echo htmlspecialchars($selectedSupplier['name']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value status-<?php echo strtolower($selectedSupplier['status']); ?>" id="detailStatus">
                        <?php echo htmlspecialchars($selectedSupplier['status']); ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Role</div>
                    <div class="detail-value" id="detailRole"><?php echo htmlspecialchars($selectedSupplier['role']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value" id="detailEmail"><?php echo htmlspecialchars($selectedSupplier['email']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Joined</div>
                    <div class="detail-value" id="detailJoined"><?php echo htmlspecialchars($selectedSupplier['joined']); ?></div>
                </div>
            </div>
            <div class="details-actions">
                <button class="btn-update-role" onclick="updateRole()">Update Role</button>
                <button class="btn-deactivate" onclick="deactivateAccount()">Deactivate Account</button>
                <button class="btn-reset-password" onclick="resetPassword()">Reset Password</button>
            </div>
        </div>
        
        <script>
        let allSuppliers = <?php echo json_encode($suppliers); ?>;
        let currentFilter = 'all';
        let selectedSupplierData = <?php echo json_encode($selectedSupplier); ?>;
        
        function selectSupplier(supplier) {
            selectedSupplierData = supplier;
            document.getElementById('detailName').textContent = supplier.name;
            document.getElementById('detailRole').textContent = supplier.role;
            document.getElementById('detailEmail').textContent = supplier.email;
            document.getElementById('detailStatus').textContent = supplier.status;
            document.getElementById('detailStatus').className = 'detail-value status-' + supplier.status.toLowerCase();
            document.getElementById('detailJoined').textContent = supplier.joined || 'N/A';
        }
        
        function filterSuppliers() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#suppliersTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const matchesSearch = text.includes(searchTerm);
                const role = row.querySelector('td:nth-child(3)').textContent.trim();
                const matchesRole = currentFilter === 'all' || role === currentFilter;
                
                row.style.display = (matchesSearch && matchesRole) ? '' : 'none';
            });
        }
        
        function filterByRole(role) {
            currentFilter = role;
            document.querySelectorAll('.filter-pill').forEach(pill => {
                pill.classList.remove('active');
            });
            document.querySelector(`[data-role="${role}"]`).classList.add('active');
            filterSuppliers();
        }
        
        function sortSuppliers(sortBy) {
            const tbody = document.getElementById('suppliersTableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            rows.sort((a, b) => {
                let aVal, bVal;
                if (sortBy === 'name') {
                    aVal = a.querySelector('td:nth-child(2)').textContent.trim();
                    bVal = b.querySelector('td:nth-child(2)').textContent.trim();
                } else {
                    aVal = a.querySelector('td:nth-child(5)').textContent.trim();
                    bVal = b.querySelector('td:nth-child(5)').textContent.trim();
                }
                return aVal.localeCompare(bVal);
            });
            
            rows.forEach(row => tbody.appendChild(row));
        }
        
        function editSupplier(id) {
            alert('Editing supplier ' + id);
        }
        
        function toggleBan(id, currentStatus) {
            const action = currentStatus === 'Banned' ? 'unban' : 'ban';
            if (confirm(`Are you sure you want to ${action} this supplier?`)) {
                alert(`Supplier ${action}ned successfully`);
                location.reload();
            }
        }
        
        function updateRole() {
            if (!selectedSupplierData) return;
            const newRole = prompt('Enter new role:', selectedSupplierData.role);
            if (newRole) {
                alert('Role updated to ' + newRole);
                location.reload();
            }
        }
        
        function deactivateAccount() {
            if (!selectedSupplierData) return;
            if (confirm('Are you sure you want to deactivate this account?')) {
                alert('Account deactivated');
                location.reload();
            }
        }
        
        function resetPassword() {
            if (!selectedSupplierData) return;
            if (confirm('Reset password for ' + selectedSupplierData.name + '?')) {
                alert('Password reset email sent');
            }
        }
        </script>
<?php include __DIR__ . '/partials/footer.php'; ?>
