<?php
$pageTitle = 'Users Management';
include __DIR__ . '/partials/admin_header.php';

// Sample users data - in production, this would come from the database
$users = [
    ['id' => 1024, 'name' => 'Steven Mitchell', 'role' => 'Admin', 'email' => 's.mitchell@gmail.com', 'status' => 'Active', 'joined' => 'Nov 1, 2025'],
    ['id' => 1025, 'name' => 'Jer Erick', 'role' => 'Community', 'email' => 'jer.erick@gmail.com', 'status' => 'Active', 'joined' => 'Oct 28, 2025'],
    ['id' => 1026, 'name' => 'Monico Vian', 'role' => 'Community', 'email' => 'monico.vian@gmail.com', 'status' => 'Active', 'joined' => 'Oct 25, 2025'],
    ['id' => 1027, 'name' => 'Sarah Discaya', 'role' => 'Supplier', 'email' => 'sarah.discaya@gmail.com', 'status' => 'Banned', 'joined' => 'Oct 20, 2025'],
    ['id' => 1028, 'name' => 'Crist Briand Brader', 'role' => 'Community', 'email' => 'cristbriand.brader.25@usjr.edu.ph', 'status' => 'Active', 'joined' => 'Nov 2, 2025'],
];

$selectedUser = $users[4] ?? null; // Default to last user
?>
        <div class="management-header">
            <h1 class="management-title">USERS MANAGEMENT</h1>
            <p class="management-subtitle">Manage all users in the EnerSave platform.</p>
        </div>
        
        <!-- Search and Filter Panel -->
        <div class="search-filter-panel">
            <div class="search-bar">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Enter name, email, or ID" onkeyup="filterUsers()">
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
                    <div class="sort-option" onclick="sortUsers('name')">
                        Name
                        <svg class="sort-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6L8 2L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 10L8 14L12 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="sort-option" onclick="sortUsers('status')">
                        Status
                        <svg class="sort-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6L8 2L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 10L8 14L12 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="data-table-panel">
            <h2 class="table-title">All Users</h2>
            <table class="admin-table" id="usersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    <?php foreach ($users as $user): ?>
                    <tr onclick="selectUser(<?php echo htmlspecialchars(json_encode($user)); ?>)">
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                            <span class="status-badge <?php echo strtolower($user['status']); ?>">
                                <?php echo htmlspecialchars($user['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-links">
                                <a href="#" class="action-link" onclick="event.stopPropagation(); editUser(<?php echo $user['id']; ?>)">Edit</a>
                                <span> / </span>
                                <a href="#" class="action-link danger" onclick="event.stopPropagation(); toggleBan(<?php echo $user['id']; ?>, '<?php echo $user['status']; ?>')">
                                    <?php echo $user['status'] === 'Banned' ? 'Unban' : 'Ban'; ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- User Details Panel -->
        <div class="details-panel">
            <h2 class="details-panel-title">Users Details Panel</h2>
            <div class="details-grid" id="userDetails">
                <div class="detail-item">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value" id="detailName"><?php echo htmlspecialchars($selectedUser['name']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Role</div>
                    <div class="detail-value" id="detailRole"><?php echo htmlspecialchars($selectedUser['role']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value" id="detailEmail"><?php echo htmlspecialchars($selectedUser['email']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value status-<?php echo strtolower($selectedUser['status']); ?>" id="detailStatus">
                        <?php echo htmlspecialchars($selectedUser['status']); ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Joined</div>
                    <div class="detail-value" id="detailJoined"><?php echo htmlspecialchars($selectedUser['joined']); ?></div>
                </div>
            </div>
            <div class="details-actions">
                <button class="btn-update-role" onclick="updateRole()">Update Role</button>
                <button class="btn-deactivate" onclick="deactivateAccount()">Deactivate Account</button>
                <button class="btn-reset-password" onclick="resetPassword()">Reset Password</button>
            </div>
        </div>
        
        <script>
        let allUsers = <?php echo json_encode($users); ?>;
        let currentFilter = 'all';
        let selectedUserData = <?php echo json_encode($selectedUser); ?>;
        
        function selectUser(user) {
            selectedUserData = user;
            document.getElementById('detailName').textContent = user.name;
            document.getElementById('detailRole').textContent = user.role;
            document.getElementById('detailEmail').textContent = user.email;
            document.getElementById('detailStatus').textContent = user.status;
            document.getElementById('detailStatus').className = 'detail-value status-' + user.status.toLowerCase();
            document.getElementById('detailJoined').textContent = user.joined || 'N/A';
        }
        
        function filterUsers() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#usersTableBody tr');
            
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
            filterUsers();
        }
        
        function sortUsers(sortBy) {
            // Simple client-side sorting
            const tbody = document.getElementById('usersTableBody');
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
        
        function editUser(id) {
            alert('Editing user ' + id);
            // Add edit functionality
        }
        
        function toggleBan(id, currentStatus) {
            const action = currentStatus === 'Banned' ? 'unban' : 'ban';
            if (confirm(`Are you sure you want to ${action} this user?`)) {
                alert(`User ${action}ned successfully`);
                location.reload();
            }
        }
        
        function updateRole() {
            if (!selectedUserData) return;
            const newRole = prompt('Enter new role (Admin, Supplier, Community):', selectedUserData.role);
            if (newRole) {
                alert('Role updated to ' + newRole);
                location.reload();
            }
        }
        
        function deactivateAccount() {
            if (!selectedUserData) return;
            if (confirm('Are you sure you want to deactivate this account?')) {
                alert('Account deactivated');
                location.reload();
            }
        }
        
        function resetPassword() {
            if (!selectedUserData) return;
            if (confirm('Reset password for ' + selectedUserData.name + '?')) {
                alert('Password reset email sent');
            }
        }
        </script>
<?php include __DIR__ . '/partials/footer.php'; ?>
