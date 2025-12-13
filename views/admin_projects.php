<?php
$pageTitle = 'Projects Management';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Management - EnerSave</title>
    <link rel="stylesheet" href="/css/styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-profile {
            position: relative;
        }
        .avatar-container {
            position: relative;
            display: inline-block;
        }
        .avatar {
            cursor: pointer;
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
        .data-table th:nth-child(4) {
            text-align: left;
        }
        .data-table td:nth-child(4) {
            text-align: left;
            padding-left: 16px;
        }
        .data-table td:nth-child(4) .status-tag {
            display: inline-block;
            margin: 0;
            text-align: center;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
        }
        .metrics-cards {
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }
        .card {
            padding: 30px 24px;
            min-height: 120px;
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
        .form-group select,
        .form-group textarea {
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
        .form-group input[readonly],
        .form-group textarea[readonly] {
            background-color: #f8f9fa;
            color: #666;
            cursor: not-allowed;
            border-color: #e8e8e8;
        }
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
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
            max-width: 450px;
        }
        .confirmation-message {
            font-size: 15px;
            color: #444;
            margin-bottom: 0;
            line-height: 1.7;
            padding: 10px 0;
        }
        .confirmation-modal .modal-header {
            background: linear-gradient(to right, #fff, #f8f9fa);
        }
        .confirmation-modal .modal-footer {
            padding: 24px 30px;
        }
        .view-modal .modal-content {
            max-width: 600px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-row:first-child {
            padding-top: 0;
        }
        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #666;
            font-size: 14px;
            min-width: 120px;
        }
        .info-value {
            color: #1a1a1a;
            font-size: 15px;
            text-align: right;
            flex: 1;
            margin-left: 20px;
            word-break: break-word;
        }
        .info-value.status-tag {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
        .info-row:has(.status-tag) .info-value {
            text-align: center;
        }
        .info-value.status-tag.project-active {
            background-color: var(--admin-green, #27ae60);
            color: white;
        }
        .info-value.status-tag.project-pending {
            background-color: var(--admin-yellow-light, #fef3c7);
            color: #000;
        }
        .info-value.status-tag.project-completed {
            background-color: var(--admin-blue, #3b82f6);
            color: white;
        }
        .info-value.status-tag.project-rejected {
            background-color: var(--admin-red, #ef4444);
            color: white;
        }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <img src="/images/Logo.png" alt="EnerSave Logo">
            EnerSave
        </div>
        <nav class="main-nav">
            <a href="/adminDashboard" class="nav-item">Dashboard</a>
            <a href="/usersManagement" class="nav-item">Users</a>
            <a href="/suppliersManagement" class="nav-item">Suppliers</a>
            <a href="/projectsManagement" class="nav-item active">Projects</a>
        </nav>
        <div class="admin-profile">
            <span>Admin: <?php echo htmlspecialchars($username); ?></span>
            <div class="avatar-container">
                <div class="avatar" id="avatarDropdown"><i class="fas fa-user-circle"></i></div>
                <div class="avatar-dropdown" id="avatarMenu">
                    <a href="#" class="avatar-dropdown-item">Settings</a>
                    <a href="/logout" class="avatar-dropdown-item logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <main class="dashboard-container">
        <section id="projects" class="page-content active-page">
            <h1 class="page-title">PROJECTS MANAGEMENT</h1>
            <p class="page-subtitle">Oversee and manage all sustainability projects.</p>

            <div class="metrics-cards">
                <div class="card">
                    <span class="metric-title">Pending Projects</span>
                    <span class="metric-value">340</span>
                </div>
                <div class="card">
                    <span class="metric-title">Active Projects</span>
                    <span class="metric-value">42</span>
                </div>
                <div class="card">
                    <span class="metric-title">Completed Projects</span>
                    <span class="metric-value">18</span>
                </div>
                <div class="card">
                    <span class="metric-title">Rejected Projects</span>
                    <span class="metric-value">P280K</span>
                </div>
            </div>

            <div class="data-management-panel">
                <h2 class="section-title" style="margin-top: 0; margin-bottom: 16px;">All Projects</h2>
                
                <div class="filter-bar">
                    <div class="search-box full-width-search">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search projects...">
                    </div>
                </div>

                <table class="data-table project-table" id="projectsTable">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Community</th>
                            <th>Start Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-name="Solar Initiative - PV1024" data-description="A comprehensive solar panel installation project aimed at providing renewable energy to local communities in Greenwood Valley." data-community="Greenwood Valley" data-date="2023 - 08 - 15" data-status="Active">
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-active">Active</span></td>
                            <td><a href="#" class="action-link view-btn">View</a> <a href="#" class="action-link success">Close</a></td>
                        </tr>
                        <tr data-name="Solar Initiative - PV1024" data-description="A comprehensive solar panel installation project aimed at providing renewable energy to local communities in Greenwood Valley." data-community="Greenwood Valley" data-date="2023 - 08 - 15" data-status="Pending">
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-pending">Pending</span></td>
                            <td><a href="#" class="action-link view-btn">View</a> <a href="#" class="action-link success approve-btn">Approve</a> <a href="#" class="action-link danger reject-btn">Reject</a></td>
                        </tr>
                        <tr data-name="Solar Initiative - PV1024" data-description="A comprehensive solar panel installation project aimed at providing renewable energy to local communities in Greenwood Valley." data-community="Greenwood Valley" data-date="2023 - 08 - 15" data-status="Completed">
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-completed">Completed</span></td>
                            <td><a href="#" class="action-link view-btn">View</a></td>
                        </tr>
                        <tr data-name="Solar Initiative - PV1024" data-description="A comprehensive solar panel installation project aimed at providing renewable energy to local communities in Greenwood Valley." data-community="Greenwood Valley" data-date="2023 - 08 - 15" data-status="Rejected">
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-rejected">Rejected</span></td>
                            <td><a href="#" class="action-link view-btn">View</a> <a href="#" class="action-link success restore-btn">Restore</a></td>
                        </tr>
                        <tr data-name="Solar Initiative - PV1024" data-description="A comprehensive solar panel installation project aimed at providing renewable energy to local communities in Greenwood Valley." data-community="Greenwood Valley" data-date="2023 - 08 - 15" data-status="Active">
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-active">Active</span></td>
                            <td><a href="#" class="action-link view-btn">View</a> <a href="#" class="action-link success">Close</a></td>
                        </tr>
                        <tr data-name="Solar Initiative - PV1024" data-description="A comprehensive solar panel installation project aimed at providing renewable energy to local communities in Greenwood Valley." data-community="Greenwood Valley" data-date="2023 - 08 - 15" data-status="Active">
                            <td>Solar Initiative - PV1024</td>
                            <td>Greenwood Valley</td>
                            <td>2023 - 08 - 15</td>
                            <td><span class="status-tag project-active">Active</span></td>
                            <td><a href="#" class="action-link view-btn">View</a> <a href="#" class="action-link success">Close</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- View Project Modal -->
    <div id="viewModal" class="modal view-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>View Project</h3>
                <button class="close-modal" onclick="closeViewModal()" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="info-row">
                    <span class="info-label">Project Name</span>
                    <span class="info-value" id="viewProjectName"></span>
                </div>
                <div class="info-row" style="flex-direction: column; align-items: flex-start;">
                    <span class="info-label" style="margin-bottom: 8px;">Project Description</span>
                    <span class="info-value" id="viewProjectDescription" style="text-align: left; white-space: pre-wrap; width: 100%; margin-left: 0; line-height: 1.6;"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Community</span>
                    <span class="info-value" id="viewCommunity"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Start Date</span>
                    <span class="info-value" id="viewStartDate"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value" id="viewStatus"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-secondary" onclick="closeViewModal()">Close</button>
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
                <button class="modal-btn" id="confirmBtn" onclick="confirmAction()">Yes</button>
            </div>
        </div>
    </div>

    <script src="/JavaScripts/navigationAdmin.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
    <script>
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('projectsTable');
        
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const tbody = table.getElementsByTagName('tbody')[0];
            const tableRows = tbody.getElementsByTagName('tr');
            
            Array.from(tableRows).forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const community = row.getAttribute('data-community') || '';
                const date = row.getAttribute('data-date') || '';
                const status = row.getAttribute('data-status') || '';
                
                // Also check visible text in table cells
                const cells = row.getElementsByTagName('td');
                let cellText = '';
                for (let i = 0; i < cells.length - 1; i++) { // Exclude actions column
                    cellText += cells[i].textContent.trim() + ' ';
                }
                
                const searchableText = (name + ' ' + community + ' ' + date + ' ' + status + ' ' + cellText).toLowerCase();
                
                if (searchTerm === '' || searchableText.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', performSearch);
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });
        }

        // View Modal functionality
        let currentViewRow = null;
        const viewModal = document.getElementById('viewModal');
        const viewBtns = document.querySelectorAll('.view-btn');

        viewBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                openViewModal(row);
            });
        });

        function closeViewModal() {
            viewModal.classList.remove('show');
            currentViewRow = null;
        }

        // Confirmation Modal functionality
        let currentActionRow = null;
        let currentAction = null;
        const confirmModal = document.getElementById('confirmModal');
        const confirmMessage = document.getElementById('confirmMessage');
        const confirmBtn = document.getElementById('confirmBtn');
        const confirmModalTitle = document.getElementById('confirmModalTitle');
        
        const approveBtns = document.querySelectorAll('.approve-btn');
        const rejectBtns = document.querySelectorAll('.reject-btn');
        const restoreBtns = document.querySelectorAll('.restore-btn');

        approveBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                currentActionRow = row;
                currentAction = 'approve';
                
                const projectName = row.getAttribute('data-name');
                confirmModalTitle.textContent = 'Approve Project';
                confirmMessage.textContent = `Are you sure you want to approve "${projectName}"? This will activate the project and make it visible to users.`;
                confirmBtn.textContent = 'Approve Project';
                confirmBtn.className = 'modal-btn modal-btn-primary';
                confirmModal.classList.add('show');
            });
        });

        rejectBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                currentActionRow = row;
                currentAction = 'reject';
                
                const projectName = row.getAttribute('data-name');
                confirmModalTitle.textContent = 'Reject Project';
                confirmMessage.textContent = `Are you sure you want to reject "${projectName}"? This action cannot be undone easily.`;
                confirmBtn.textContent = 'Reject Project';
                confirmBtn.className = 'modal-btn modal-btn-danger';
                confirmModal.classList.add('show');
            });
        });

        restoreBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                currentActionRow = row;
                currentAction = 'restore';
                
                const projectName = row.getAttribute('data-name');
                confirmModalTitle.textContent = 'Restore Project';
                confirmMessage.textContent = `Are you sure you want to restore "${projectName}"? This will change the status back to Pending.`;
                confirmBtn.textContent = 'Restore Project';
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
            const actionsCell = currentActionRow.cells[4];
            
            if (currentAction === 'approve') {
                // Update status to Active
                statusSpan.textContent = 'Active';
                statusSpan.className = 'status-tag project-active';
                statusSpan.removeAttribute('style'); // Remove inline styles to use CSS classes
                currentActionRow.setAttribute('data-status', 'Active');
                
                // Update actions - remove Approve/Reject, add Close
                actionsCell.innerHTML = '<a href="#" class="action-link view-btn">View</a> <a href="#" class="action-link success">Close</a>';
                
                // Re-attach view button event
                attachViewButtonEvent(actionsCell);
                
                closeConfirmModal();
                
                // Show success message (optional: can be removed if you don't want alerts)
                setTimeout(() => {
                    alert('Project has been approved successfully. Status updated to Active.');
                }, 300);
                performSearch(); // Re-apply search filter if active
            } else if (currentAction === 'reject') {
                // Update status to Rejected
                statusSpan.textContent = 'Rejected';
                statusSpan.className = 'status-tag project-rejected';
                statusSpan.removeAttribute('style'); // Remove inline styles to use CSS classes
                currentActionRow.setAttribute('data-status', 'Rejected');
                
                // Update actions - remove Approve/Reject, add Restore
                actionsCell.innerHTML = '<a href="#" class="action-link view-btn">View</a> <a href="#" class="action-link success restore-btn">Restore</a>';
                
                // Re-attach view and restore button events
                attachViewButtonEvent(actionsCell);
                attachRestoreButtonEvent(actionsCell, currentActionRow);
                
                closeConfirmModal();
                
                // Show success message
                setTimeout(() => {
                    alert('Project has been rejected. Status updated to Rejected.');
                }, 300);
                performSearch(); // Re-apply search filter if active
            } else if (currentAction === 'restore') {
                // Update status to Pending
                statusSpan.textContent = 'Pending';
                statusSpan.className = 'status-tag project-pending';
                statusSpan.removeAttribute('style'); // Remove inline styles to use CSS classes
                currentActionRow.setAttribute('data-status', 'Pending');
                
                // Update actions - add Approve/Reject back
                actionsCell.innerHTML = '<a href="#" class="action-link view-btn">View</a> <a href="#" class="action-link success approve-btn">Approve</a> <a href="#" class="action-link danger reject-btn">Reject</a>';
                
                // Re-attach all button events
                attachViewButtonEvent(actionsCell);
                attachApproveRejectEvents(actionsCell, currentActionRow);
                
                closeConfirmModal();
                
                // Show success message
                setTimeout(() => {
                    alert('Project has been restored. Status updated to Pending.');
                }, 300);
                performSearch(); // Re-apply search filter if active
            }
        }

        // Helper function to attach view button event
        function attachViewButtonEvent(cell) {
            const viewBtn = cell.querySelector('.view-btn');
            if (viewBtn) {
                viewBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    openViewModal(this.closest('tr'));
                });
            }
        }

        // Helper function to open view modal
        function openViewModal(row) {
            const projectName = row.getAttribute('data-name');
            const description = row.getAttribute('data-description');
            const community = row.getAttribute('data-community');
            const startDate = row.getAttribute('data-date');
            const statusTag = row.querySelector('.status-tag');
            
            document.getElementById('viewProjectName').textContent = projectName;
            document.getElementById('viewProjectDescription').textContent = description;
            document.getElementById('viewCommunity').textContent = community;
            document.getElementById('viewStartDate').textContent = startDate;
            
            const statusSpanView = document.getElementById('viewStatus');
            const status = row.getAttribute('data-status') || statusTag.textContent.trim();
            statusSpanView.className = 'info-value status-tag project-' + status.toLowerCase();
            statusSpanView.textContent = status;
            statusSpanView.removeAttribute('style'); // Use CSS classes instead of inline styles
            
            viewModal.classList.add('show');
        }

        // Helper function to attach restore button event
        function attachRestoreButtonEvent(cell, row) {
            const restoreBtn = cell.querySelector('.restore-btn');
            if (restoreBtn) {
                restoreBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentActionRow = row;
                    currentAction = 'restore';
                    
                    const projectName = row.getAttribute('data-name');
                    confirmModalTitle.textContent = 'Restore Project';
                    confirmMessage.textContent = `Are you sure you want to restore "${projectName}"? This will change the status back to Pending.`;
                    confirmBtn.textContent = 'Restore Project';
                    confirmBtn.className = 'modal-btn modal-btn-primary';
                    confirmModal.classList.add('show');
                });
            }
        }


        function attachApproveRejectEvents(cell, row) {
            const approveBtn = cell.querySelector('.approve-btn');
            const rejectBtn = cell.querySelector('.reject-btn');
            
            if (approveBtn) {
                approveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentActionRow = row;
                    currentAction = 'approve';
                    
                    const projectName = row.getAttribute('data-name');
                    confirmModalTitle.textContent = 'Approve Project';
                    confirmMessage.textContent = `Are you sure you want to approve "${projectName}"? This will activate the project and make it visible to users.`;
                    confirmBtn.textContent = 'Approve Project';
                    confirmBtn.className = 'modal-btn modal-btn-primary';
                    confirmModal.classList.add('show');
                });
            }
            
            if (rejectBtn) {
                rejectBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentActionRow = row;
                    currentAction = 'reject';
                    
                    const projectName = row.getAttribute('data-name');
                    confirmModalTitle.textContent = 'Reject Project';
                    confirmMessage.textContent = `Are you sure you want to reject "${projectName}"? This action cannot be undone easily.`;
                    confirmBtn.textContent = 'Reject Project';
                    confirmBtn.className = 'modal-btn modal-btn-danger';
                    confirmModal.classList.add('show');
                });
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target === viewModal) {
                closeViewModal();
            }
            if (event.target === confirmModal) {
                closeConfirmModal();
            }
        }
    </script>
</body>
</html>

