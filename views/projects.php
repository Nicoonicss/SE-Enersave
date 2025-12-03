<?php
$pageTitle = 'Projects Management';
include __DIR__ . '/partials/admin_header.php';

// Sample projects data
$projects = [
    ['name' => 'Solar Initiative - PV1024', 'community' => 'Greenwood Valley', 'start_date' => '2023-08-15', 'status' => 'Active'],
    ['name' => 'Solar Initiative - PV1024', 'community' => 'Greenwood Valley', 'start_date' => '2023-08-15', 'status' => 'Pending'],
    ['name' => 'Solar Initiative - PV1024', 'community' => 'Greenwood Valley', 'start_date' => '2023-08-15', 'status' => 'Completed'],
    ['name' => 'Solar Initiative - PV1024', 'community' => 'Greenwood Valley', 'start_date' => '2023-08-15', 'status' => 'Rejected'],
    ['name' => 'Solar Initiative - PV1024', 'community' => 'Greenwood Valley', 'start_date' => '2023-08-15', 'status' => 'Active'],
    ['name' => 'Solar Initiative - PV1024', 'community' => 'Greenwood Valley', 'start_date' => '2023-08-15', 'status' => 'Active'],
];
?>
        <div class="management-header">
            <h1 class="management-title">PROJECTS MANAGEMENT</h1>
            <p class="management-subtitle">Oversee and manage all sustainability projects.</p>
        </div>
        
        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="summary-card">
                <div class="summary-card-label">Pending Projects</div>
                <div class="summary-card-value">340</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-label">Active Projects</div>
                <div class="summary-card-value">42</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-label">Completed Projects</div>
                <div class="summary-card-value">18</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-label">Rejected Projects</div>
                <div class="summary-card-value">P280k</div>
            </div>
        </div>
        
        <!-- Projects Table -->
        <div class="data-table-panel">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h2 class="table-title" style="margin: 0;">All Projects</h2>
                <div class="search-bar" style="width: 300px; margin: 0;">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <input type="text" placeholder="Search projects..." onkeyup="filterProjects()">
                </div>
            </div>
            <table class="admin-table" id="projectsTable">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Community</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="projectsTableBody">
                    <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project['name']); ?></td>
                        <td><?php echo htmlspecialchars($project['community']); ?></td>
                        <td><?php echo htmlspecialchars($project['start_date']); ?></td>
                        <td>
                            <span class="status-badge <?php echo strtolower($project['status']); ?>">
                                <?php echo htmlspecialchars($project['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-links">
                                <a href="#" class="action-link" onclick="viewProject('<?php echo htmlspecialchars($project['name']); ?>')">View</a>
                                <?php if ($project['status'] === 'Pending'): ?>
                                    <span> / </span>
                                    <a href="#" class="action-link success" onclick="approveProject('<?php echo htmlspecialchars($project['name']); ?>')">Approve</a>
                                    <span> / </span>
                                    <a href="#" class="action-link danger" onclick="rejectProject('<?php echo htmlspecialchars($project['name']); ?>')">Reject</a>
                                <?php elseif ($project['status'] === 'Active'): ?>
                                    <span> / </span>
                                    <a href="#" class="action-link danger" onclick="closeProject('<?php echo htmlspecialchars($project['name']); ?>')">Close</a>
                                <?php elseif ($project['status'] === 'Rejected'): ?>
                                    <span> / </span>
                                    <a href="#" class="action-link success" onclick="restoreProject('<?php echo htmlspecialchars($project['name']); ?>')">Restore</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <script>
        function filterProjects() {
            const searchTerm = event.target.value.toLowerCase();
            const rows = document.querySelectorAll('#projectsTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        }
        
        function viewProject(name) {
            alert('Viewing project: ' + name);
            // Add view functionality
        }
        
        function approveProject(name) {
            if (confirm('Approve project: ' + name + '?')) {
                alert('Project approved');
                location.reload();
            }
        }
        
        function rejectProject(name) {
            if (confirm('Reject project: ' + name + '?')) {
                alert('Project rejected');
                location.reload();
            }
        }
        
        function closeProject(name) {
            if (confirm('Close project: ' + name + '?')) {
                alert('Project closed');
                location.reload();
            }
        }
        
        function restoreProject(name) {
            if (confirm('Restore project: ' + name + '?')) {
                alert('Project restored');
                location.reload();
            }
        }
        </script>
<?php include __DIR__ . '/partials/footer.php'; ?>
