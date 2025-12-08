<?php
$pageTitle = 'Admin Dashboard';
include __DIR__ . '/partials/admin_header.php';
?>
        <h1 class="admin-title">ADMIN DASHBOARD OVERVIEW</h1>
        <p class="admin-subtitle">A summary of key platform metrics.</p>
        
        <!-- Key Metrics -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-label">Total Users</div>
                <div class="metric-value">340</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Total Suppliers</div>
                <div class="metric-value">42</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Active Projects</div>
                <div class="metric-value">18</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Total Donations</div>
                <div class="metric-value">P280k</div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2 class="section-title">Quick Actions</h2>
            <div class="quick-actions-grid">
                <a href="/users" class="action-btn">
                    <div class="action-btn-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    Manage Users
                </a>
                <a href="/suppliers" class="action-btn">
                    <div class="action-btn-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    Manage Suppliers
                </a>
                <a href="/projects" class="action-btn">
                    <div class="action-btn-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 2V6M12 18V22M22 12H18M6 12H2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    Manage Projects
                </a>
                <a href="/reports" class="action-btn">
                    <div class="action-btn-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 3V21H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7 16L12 11L16 15L21 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 10V3H14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    View Reports
                </a>
            </div>
        </div>
        
        <!-- Recent Activity and System Status -->
        <div class="grid">
            <div class="card row-span-6">
                <h2 class="section-title">Recent Activity</h2>
                <div class="activity-panel">
                    <div class="activity-item" onclick="window.location.href='/suppliers'">
                        <div class="activity-text">
                            <div class="activity-title">New Supplier Registered: GreenTech Power</div>
                            <div class="activity-time">2 hours ago</div>
                        </div>
                        <div class="activity-arrow">→</div>
                    </div>
                    <div class="activity-item" onclick="window.location.href='/projects'">
                        <div class="activity-text">
                            <div class="activity-title">New Project Submitted: Solar for Hope</div>
                            <div class="activity-time">5 hours ago</div>
                        </div>
                        <div class="activity-arrow">→</div>
                    </div>
                    <div class="activity-item" onclick="window.location.href='/projects'">
                        <div class="activity-text">
                            <div class="activity-title">Donation Received: P5,000 from EcoFund Inc.</div>
                            <div class="activity-time">1 day ago</div>
                        </div>
                        <div class="activity-arrow">→</div>
                    </div>
                    <div class="activity-item" onclick="window.location.href='/users'">
                        <div class="activity-text">
                            <div class="activity-title">User Account Updated: Sarah Discaya (Community)</div>
                            <div class="activity-time">2 days ago</div>
                        </div>
                        <div class="activity-arrow">→</div>
                    </div>
                </div>
                <div class="admin-buttons">
                    <button class="btn-export" onclick="exportReport()">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2V12M10 12L6 8M10 12L14 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 16H18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Export Report
                    </button>
                    <button class="btn-notifications" onclick="viewNotifications()">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 17H5C4.44772 17 4 16.5523 4 16V11C4 8.79086 5.79086 7 8 7H12C14.2091 7 16 8.79086 16 11V16C16 16.5523 15.5523 17 15 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 3V1M10 3C8.34315 3 7 4.34315 7 6V7M10 3C11.6569 3 13 4.34315 13 6V7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        View All Notifications
                    </button>
                </div>
            </div>
            <div class="card row-span-6">
                <h2 class="section-title">System Status</h2>
                <div class="status-panel">
                    <div class="status-item">
                        <span class="status-label">Platform Uptime:</span>
                        <span class="status-value green">99.8%</span>
                    </div>
                    <div class="status-item">
                        <span class="status-label">Pending Supplier Verifications:</span>
                        <span class="status-value red">3</span>
                    </div>
                    <div class="status-item">
                        <span class="status-label">Active Crowdfunding Projects:</span>
                        <span class="status-value black">18</span>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
        function exportReport() {
            alert('Exporting report...');
            // Add export functionality here
        }
        
        function viewNotifications() {
            alert('Opening notifications...');
            // Add notifications functionality here
        }
        </script>
<?php include __DIR__ . '/partials/footer.php'; ?>
