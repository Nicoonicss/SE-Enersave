<?php
$pageTitle = 'Users Management';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management - EnerSave</title>
    <link rel="stylesheet" href="/css/styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f7f7;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 15px;
        }

        .nav-left img {
            width: 30px;
        }

        .nav-left a,
        .nav-right a {
            text-decoration: none;
            color: black;
            font-weight: 500;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 15px;
        }

        .brand-name {
            font-weight: 900;
            font-size: 18px;
        }

        .main-nav {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-left: 20px;
        }

        .main-nav .nav-item {
            text-decoration: none;
            color: black;
            font-weight: 500;
            font-size: 15px;
            padding: 5px 0;
            transition: color 0.2s ease;
        }

        .main-nav .nav-item:hover {
            color: #239c42;
        }

        .main-nav .nav-item.active {
            color: #239c42;
            font-weight: 600;
        }

        .admin-profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .avatar-container {
            position: relative;
            margin-right: 15px;
        }
        .nav-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffcc00;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 20px;
        }
        .avatar {
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 20px;
        }
        .avatar-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
            min-width: 180px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            pointer-events: none;
            overflow: hidden;
        }
        .avatar-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }
        .avatar-dropdown-item {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid #f0f0f0;
        }
        .avatar-dropdown-item:last-child {
            border-bottom: none;
        }
        .avatar-dropdown-item:hover {
            background-color: #f8f9fa;
            color: #239c42;
            padding-left: 20px;
        }
        .avatar-dropdown-item:first-child {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .avatar-dropdown-item:last-child {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .avatar-dropdown-item.logout {
            color: #d32f2f;
            font-weight: 600;
        }
        .avatar-dropdown-item.logout:hover {
            background-color: #ffebee;
            color: #b71c1c;
            padding-left: 20px;
        }
        .dashboard-container {
            max-width: 100%;
            width: 100%;
            padding: 30px 50px;
            margin: 0;
        }
        .data-management-panel {
            width: 100%;
        }
        .data-table {
            width: 100%;
        }
        .data-table tbody tr.selected {
            background-color: #e3f2fd;
            border-left: 3px solid #2196f3;
        }
        .data-table tbody tr:hover {
            background-color: #f5f5f5;
        }
        .details-panel {
            width: 100%;
        }
        /* Sort and Filter Styles */
        .sort-by-group {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .name-sort {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .name-sort > span {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9375rem;
        }
        .sort-btn {
            background: white;
            border: 1.5px solid var(--border-light);
            padding: 6px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            color: #000;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }
        .sort-btn:hover {
            border-color: var(--admin-green);
        }
        .sort-btn.active {
            background-color: var(--admin-green);
            color: white;
            border-color: var(--admin-green);
        }
        .status-filter {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .status-filter > span {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9375rem;
        }
        .status-filter-btn {
            background: white;
            border: 1.5px solid var(--border-light);
            padding: 6px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            color: #000;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }
        .status-filter-btn:hover {
            border-color: var(--admin-green);
        }
        .status-filter-btn.active {
            background-color: var(--admin-green);
            color: white;
            border-color: var(--admin-green);
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            animation: fadeIn 0.3s ease;
        }
        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: white;
            border-radius: 16px;
            padding: 0;
            max-width: 520px;
            width: 90%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            animation: slideDown 0.3s ease;
            overflow: hidden;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideDown {
            from { transform: translateY(-30px) scale(0.95); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 30px;
            border-bottom: 1px solid #e8e8e8;
            background: linear-gradient(to right, #f8f9fa, #ffffff);
        }
        .modal-header h3 {
            margin: 0;
            font-size: 1.625rem;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -0.5px;
        }
        .close-modal {
            background: #f5f5f5;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #666;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }
        .close-modal:hover {
            background: #e8e8e8;
            color: #000;
            transform: rotate(90deg);
        }
        .modal-body {
            padding: 30px;
            margin-bottom: 0;
        }
        .form-group {
            margin-bottom: 22px;
        }
        .form-group:last-child {
            margin-bottom: 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            letter-spacing: 0.2px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            box-sizing: border-box;
            transition: all 0.2s ease;
            background-color: #fff;
            color: #1a1a1a;
            font-family: inherit;
        }
        .form-group input[readonly] {
            background-color: #f8f9fa;
            color: #666;
            cursor: not-allowed;
            border-color: #e8e8e8;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--admin-green);
            box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
        }
        .form-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
            cursor: pointer;
        }
        .form-group select option {
            padding: 8px;
        }
        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding: 20px 30px;
            border-top: 1px solid #e8e8e8;
            background-color: #fafafa;
        }
        .modal-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.2s ease;
            min-width: 100px;
            letter-spacing: 0.3px;
        }
        .modal-btn-primary {
            background-color: var(--admin-green);
            color: white;
            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
        }
        .modal-btn-primary:hover {
            background-color: #229954;
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.4);
            transform: translateY(-1px);
        }
        .modal-btn-primary:active {
            transform: translateY(0);
        }
        .modal-btn-secondary {
            background-color: white;
            color: #333;
            border: 2px solid #e0e0e0;
        }
        .modal-btn-secondary:hover {
            background-color: #f8f9fa;
            border-color: #d0d0d0;
        }
        .modal-btn-danger {
            background-color: var(--admin-red);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }
        .modal-btn-danger:hover {
            background-color: #dc2626;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
            transform: translateY(-1px);
        }
        .confirmation-modal .modal-content {
            max-width: 420px;
        }
        .confirmation-message {
            font-size: 15px;
            color: #444;
            margin-bottom: 0;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="nav-left">
            <img src="/images/Logo.png" alt="EnerSave Logo">
            <a href="/adminDashboard" class="brand-name"><strong>EnerSave</strong></a>
            <nav class="main-nav">
                <a href="/adminDashboard" class="nav-item">Dashboard</a>
                <a href="/usersManagement" class="nav-item active">Users</a>
                <a href="/suppliersManagement" class="nav-item">Suppliers</a>
                <a href="/projectsManagement" class="nav-item">Projects</a>
            </nav>
        </div>
        <div class="nav-right">
            <span>Admin: <?php echo htmlspecialchars($username); ?></span>
            <div class="avatar-container">
                <div class="nav-avatar" id="avatarDropdown"><?php echo strtoupper(substr($username, 0, 1)); ?></div>
                <div class="avatar-dropdown" id="avatarMenu">
                    <a href="#" class="avatar-dropdown-item">Settings</a>
                    <a href="/logout" class="avatar-dropdown-item logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <main class="dashboard-container">
        <section id="users" class="page-content active-page">
            <h1 class="page-title">USERS MANAGEMENT</h1>
            <p class="page-subtitle">Manage all users in the EnerSave platform.</p>

            <div class="data-management-panel">
                <div class="filter-bar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Enter full name, email, or ID">
                    </div>
                    <div class="role-filter">
                        <span>Filter by: Role</span>
                        <button class="filter-btn active">All</button>
                        <button class="filter-btn">Admin</button>
                        <button class="filter-btn">Supplier</button>
                        <button class="filter-btn">Community</button>
                    </div>
                    <div class="sort-by-group">
                        <div class="name-sort">
                            <span>Sort by: Name</span>
                            <button class="sort-btn active" data-sort="asc">Ascending</button>
                            <button class="sort-btn" data-sort="desc">Descending</button>
                        </div>
                        <div class="status-filter">
                            <span>Sort by: Status</span>
                            <button class="status-filter-btn active" data-status="clear">Clear</button>
                            <button class="status-filter-btn" data-status="active">Active</button>
                            <button class="status-filter-btn" data-status="banned">Banned</button>
                        </div>
                    </div>
                </div>

                <table class="data-table" id="usersTable">
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
                        <!-- Users will be loaded dynamically from database -->
                    </tbody>
                </table>
            </div>

            <h2 class="section-title">Users Details Panel</h2>
            <div class="details-panel">
                <div class="detail-row">
                    <div class="detail-item"><span>Full Name</span><strong id="detailFullName">-</strong></div>
                    <div class="detail-item"><span>Role</span><strong id="detailRole">-</strong></div>
                    <div class="detail-item"><span>Email</span><strong id="detailEmail">-</strong></div>
                </div>
                <div class="detail-row">
                    <div class="detail-item"><span>Status</span><strong id="detailStatus" class="text-active">-</strong></div>
                    <div class="detail-item"><span>Joined</span><strong id="detailJoined">-</strong></div>
                </div>
                <div class="details-actions">
                    <button class="btn btn-success">Update Role</button>
                    <button class="btn btn-warning">Deactivate Account</button>
                    <button class="btn btn-dark">Reset Password</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit User</h3>
                <button class="close-modal" onclick="closeEditModal()" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="editId">ID</label>
                        <input type="text" id="editId" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editFullName">Full Name</label>
                        <input type="text" id="editFullName" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" id="editEmail" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-secondary" onclick="closeEditModal()">Cancel</button>
                <button class="modal-btn modal-btn-primary" onclick="saveEdit()">Save Changes</button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal confirmation-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="confirmModalTitle">Confirm Action</h3>
                <button class="close-modal" onclick="closeConfirmModal()" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p class="confirmation-message" id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-secondary" onclick="closeConfirmModal()">Cancel</button>
                <button class="modal-btn" id="confirmBtn" onclick="confirmAction()">Confirm</button>
            </div>
        </div>
    </div>

    <!-- Update Role Modal -->
    <div id="updateRoleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Update Role</h3>
                <button class="close-modal" onclick="closeUpdateRoleModal()" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="updateRoleForm">
                    <div class="form-group">
                        <label for="newRole">Select New Role</label>
                        <select id="newRole" required>
                            <option value="">Select a role</option>
                            <option value="Community">Community</option>
                            <option value="Supplier">Supplier</option>
                            <option value="Donor">Donor</option>
                            <option value="Educator/Student">Educator/Student</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-secondary" onclick="closeUpdateRoleModal()">Cancel</button>
                <button class="modal-btn modal-btn-primary" onclick="confirmUpdateRole()">Update Role</button>
            </div>
        </div>
    </div>

        <script src="/JavaScripts/navigationAdmin.js"></script>
        <script src="/JavaScripts/avatarDropdown.js"></script>
        <script>
        // Search, Sort, and Filter functionality
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('usersTable');
        const tbody = table.getElementsByTagName('tbody')[0];
        
        let currentNameSort = 'asc'; // 'asc' or 'desc'
        let currentStatusFilter = 'clear'; // 'clear', 'active', 'banned'
        let currentRoleFilter = 'All'; // Role filter from navigationAdmin.js
        
        // Sort by Name functionality
        const sortBtns = document.querySelectorAll('.sort-btn[data-sort]');
        
        sortBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const sortType = this.getAttribute('data-sort');
                currentNameSort = sortType;
                
                // Update active state
                sortBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                applySortAndFilter();
            });
        });
        
        // Status Filter functionality
        const statusFilterBtns = document.querySelectorAll('.status-filter-btn');
        
        statusFilterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                currentStatusFilter = status;
                
                // Update active state
                statusFilterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                applySortAndFilter();
            });
        });
        
        // Apply sort and filter function
        function applySortAndFilter() {
            const rows = Array.from(tbody.getElementsByTagName('tr'));
            const searchTerm = searchInput.value.toLowerCase();
            
            // First, filter rows based on search, role, and status
            let filteredRows = rows.filter(row => {
                // Apply search filter
                const id = row.getAttribute('data-id') || '';
                const name = row.getAttribute('data-name') || '';
                const email = row.getAttribute('data-email') || '';
                const searchableText = (id + ' ' + name + ' ' + email).toLowerCase();
                const matchesSearch = searchTerm === '' || searchableText.includes(searchTerm);
                
                // Apply role filter
                const roleCell = row.cells[2]; // Role is in 3rd column (index 2)
                const roleText = roleCell ? roleCell.textContent.trim() : '';
                const matchesRole = currentRoleFilter === 'All' || roleText === currentRoleFilter;
                
                // Apply status filter
                const status = row.getAttribute('data-status') || '';
                let matchesStatus = true;
                if (currentStatusFilter === 'active') {
                    matchesStatus = status === 'active';
                } else if (currentStatusFilter === 'banned') {
                    matchesStatus = status === 'banned';
                }
                // If 'clear', matchesStatus remains true
                
                return matchesSearch && matchesRole && matchesStatus;
            });
            
            // Then sort by name
            filteredRows.sort((a, b) => {
                const nameA = (a.getAttribute('data-name') || '').toLowerCase();
                const nameB = (b.getAttribute('data-name') || '').toLowerCase();
                
                if (currentNameSort === 'asc') {
                    return nameA.localeCompare(nameB);
                } else {
                    return nameB.localeCompare(nameA);
                }
            });
            
            // Hide all rows first
            rows.forEach(row => {
                row.style.display = 'none';
            });
            
            // Show and reorder filtered rows
            filteredRows.forEach(row => {
                tbody.appendChild(row);
                row.style.display = '';
            });
        }
        
        // Search functionality
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                applySortAndFilter();
            });
        }
        
        // Initial setup - default active states are set in HTML
        
        // Integrate with role filter from navigationAdmin.js
        const roleFilterBtns = document.querySelectorAll('.role-filter .filter-btn');
        roleFilterBtns.forEach(btn => {
            const originalClick = btn.onclick;
            btn.addEventListener('click', function() {
                currentRoleFilter = this.textContent.trim();
                applySortAndFilter();
            });
        });

        // Edit Modal functionality
        let currentEditRow = null;
        const editModal = document.getElementById('editModal');
        const editBtns = document.querySelectorAll('.edit-btn');

        editBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                currentEditRow = row;
                
                const rowId = row.getAttribute('data-id');
                const rowName = row.getAttribute('data-name');
                const rowEmail = row.getAttribute('data-email');
                const rowRole = row.getAttribute('data-role');
                
                document.getElementById('editId').value = rowId || '';
                document.getElementById('editFullName').value = rowName || '';
                document.getElementById('editEmail').value = rowEmail || '';
                
                // Focus first editable field
                document.getElementById('editFullName').focus();
                
                editModal.classList.add('show');
            });
        });

        function closeEditModal() {
            editModal.classList.remove('show');
            currentEditRow = null;
        }

        function saveEdit() {
            if (!currentEditRow) return;
            
            const newName = document.getElementById('editFullName').value;
            const newEmail = document.getElementById('editEmail').value;
            
            // Update row data attributes
            currentEditRow.setAttribute('data-name', newName);
            currentEditRow.setAttribute('data-email', newEmail);
            
            // Update table cells
            currentEditRow.cells[1].textContent = newName;
            currentEditRow.cells[3].textContent = newEmail;
            
            // Update detail panel if this row is selected
            if (currentEditRow.classList.contains('selected')) {
                updateUserDetailsPanel(currentEditRow);
            }
            
            alert('User updated successfully!');
            closeEditModal();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target === editModal) {
                closeEditModal();
            }
            if (event.target === confirmModal) {
                closeConfirmModal();
            }
        }

        // Ban/Unban confirmation modal
        let currentActionRow = null;
        let currentAction = null;
        const confirmModal = document.getElementById('confirmModal');
        const confirmMessage = document.getElementById('confirmMessage');
        const confirmBtn = document.getElementById('confirmBtn');
        const confirmModalTitle = document.getElementById('confirmModalTitle');
        const banBtns = document.querySelectorAll('.ban-btn');
        const unbanBtns = document.querySelectorAll('.unban-btn');

        banBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                currentActionRow = row;
                currentAction = 'ban';
                
                const userName = row.getAttribute('data-name');
                confirmModalTitle.textContent = 'Ban User';
                confirmMessage.textContent = `Are you sure you want to ban "${userName}"? This action will restrict their access to the platform.`;
                confirmBtn.textContent = 'Ban User';
                confirmBtn.className = 'modal-btn modal-btn-danger';
                confirmModal.classList.add('show');
            });
        });

        unbanBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                currentActionRow = row;
                currentAction = 'unban';
                
                const userName = row.getAttribute('data-name');
                confirmModalTitle.textContent = 'Unban User';
                confirmMessage.textContent = `Are you sure you want to unban "${userName}"? This will restore their access to the platform.`;
                confirmBtn.textContent = 'Unban User';
                confirmBtn.className = 'modal-btn modal-btn-primary';
                confirmModal.classList.add('show');
            });
        });

        function closeConfirmModal() {
            confirmModal.classList.remove('show');
            currentActionRow = null;
            currentAction = null;
        }

        function confirmAction() {
            if (!currentActionRow || !currentAction) return;
            
            const statusSpan = currentActionRow.querySelector('.status-tag');
            const actionsCell = currentActionRow.cells[5];
            const actionLinks = actionsCell.querySelectorAll('a');
            const editBtn = actionsCell.querySelector('.edit-btn');
            
            if (currentAction === 'ban') {
                statusSpan.textContent = 'Banned';
                statusSpan.className = 'status-tag banned';
                currentActionRow.setAttribute('data-status', 'banned');
                
                // Replace Ban button with Unban
                actionLinks.forEach(link => {
                    if (link.classList.contains('ban-btn')) {
                        link.textContent = 'Unban';
                        link.classList.remove('danger', 'ban-btn');
                        link.classList.add('success', 'unban-btn');
                    }
                });
                
                alert('User has been banned successfully.');
            } else if (currentAction === 'unban') {
                statusSpan.textContent = 'Active';
                statusSpan.className = 'status-tag active';
                currentActionRow.setAttribute('data-status', 'active');
                
                // Replace Unban button with Ban
                actionLinks.forEach(link => {
                    if (link.classList.contains('unban-btn')) {
                        link.textContent = 'Ban';
                        link.classList.remove('success', 'unban-btn');
                        link.classList.add('danger', 'ban-btn');
                    }
                });
                
                alert('User has been unbanned successfully.');
            }
            
            // Update detail panel if this row is selected
            if (currentActionRow.classList.contains('selected')) {
                updateUserDetailsPanel(currentActionRow);
            }
            
            closeConfirmModal();
        }

        // Load users from database
        function loadUsers() {
            fetch('/api/users')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.users) {
                        const tbody = document.getElementById('usersTableBody');
                        tbody.innerHTML = '';
                        
                        data.users.forEach(user => {
                            const roleDisplay = user.role === 'COMMUNITY_USER' ? 'Community' : 
                                              user.role === 'SUPPLIER_INSTALLER' ? 'Supplier' :
                                              user.role === 'ADMIN' ? 'Admin' : user.role;
                            const status = user.status || 'active';
                            const statusClass = status === 'banned' ? 'banned' : 'active';
                            const statusText = status === 'banned' ? 'Banned' : 'Active';
                            const banText = status === 'banned' ? 'Unban' : 'Ban';
                            const banClass = status === 'banned' ? 'success unban-btn' : 'danger ban-btn';
                            
                            const row = document.createElement('tr');
                            row.setAttribute('data-id', user.id);
                            row.setAttribute('data-name', user.username);
                            row.setAttribute('data-role', roleDisplay);
                            row.setAttribute('data-email', user.email);
                            row.setAttribute('data-status', status);
                            row.onclick = () => updateUserDetailsPanel(row);
                            
                            row.innerHTML = `
                                <td>${user.id}</td>
                                <td>${user.username}</td>
                                <td>${roleDisplay}</td>
                                <td>${user.email}</td>
                                <td><span class="status-tag ${statusClass}">${statusText}</span></td>
                                <td>
                                    <a href="#" class="action-link edit-btn" onclick="event.stopPropagation(); editUser(${user.id})">Edit</a> / 
                                    <a href="#" class="action-link ${banClass}" onclick="event.stopPropagation(); toggleBan(${user.id}, '${status}')">${banText}</a>
                                </td>
                            `;
                            
                            tbody.appendChild(row);
                        });
                        
                        // Reapply filters after loading
                        applySortAndFilter();
                    }
                })
                .catch(error => {
                    console.error('Error loading users:', error);
                });
        }
        
        // Load users on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadUsers();
        });

        // Update User Details Panel when clicking on a table row
        function updateUserDetailsPanel(row) {
            const name = row.getAttribute('data-name') || '-';
            const role = row.getAttribute('data-role') || '-';
            const email = row.getAttribute('data-email') || '-';
            const status = row.getAttribute('data-status') || '-';
            
            // Update detail panel
            document.getElementById('detailFullName').textContent = name;
            document.getElementById('detailRole').textContent = role;
            document.getElementById('detailEmail').textContent = email;
            
            // Update status with appropriate class
            const statusElement = document.getElementById('detailStatus');
            statusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1);
            statusElement.className = status === 'active' ? 'text-active' : 'text-banned';
            
            // Joined date - using placeholder for now
            document.getElementById('detailJoined').textContent = 'N/A';
        }

        // Add click event listeners to table rows
        let currentSelectedRow = null;
        const tableRows = tbody.getElementsByTagName('tr');
        Array.from(tableRows).forEach(row => {
            row.style.cursor = 'pointer';
            row.addEventListener('click', function(e) {
                // Don't trigger if clicking on action links
                if (e.target.tagName === 'A' || e.target.closest('a')) {
                    return;
                }
                updateUserDetailsPanel(this);
                
                // Highlight selected row
                Array.from(tableRows).forEach(r => r.classList.remove('selected'));
                this.classList.add('selected');
                currentSelectedRow = this;
            });
        });

        // Update Role Modal functionality
        const updateRoleModal = document.getElementById('updateRoleModal');
        const updateRoleBtn = document.querySelector('.details-actions .btn-success');
        
        if (updateRoleBtn) {
            updateRoleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                
                if (!currentSelectedRow) {
                    return;
                }
                
                const roleSelect = document.getElementById('newRole');
                const currentRole = currentSelectedRow.getAttribute('data-role') || '';
                roleSelect.value = currentRole;
                
                updateRoleModal.classList.add('show');
            }, true); // Use capture phase to execute before navigationAdmin.js
        }

        window.closeUpdateRoleModal = function() {
            updateRoleModal.classList.remove('show');
            document.getElementById('newRole').value = '';
        };

        window.confirmUpdateRole = function() {
            if (!currentSelectedRow) {
                closeUpdateRoleModal();
                return;
            }
            
            const newRole = document.getElementById('newRole').value;
            if (!newRole) {
                return;
            }
            
            // Update row data attribute
            currentSelectedRow.setAttribute('data-role', newRole);
            
            // Update table cell (Role is in 3rd column, index 2)
            currentSelectedRow.cells[2].textContent = newRole;
            
            // Update detail panel
            document.getElementById('detailRole').textContent = newRole;
            
            closeUpdateRoleModal();
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === updateRoleModal) {
                closeUpdateRoleModal();
            }
        });
    </script>
</body>
</html>

