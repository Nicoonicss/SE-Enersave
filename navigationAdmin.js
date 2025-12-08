document.addEventListener('DOMContentLoaded', () => {

    // ==========================================
    // 1. GLOBAL NAVIGATION LOGIC
    // ==========================================
    const pageMap = {
        'dashboard.html': 'adminDashboard.html',
        'users.html': 'usersManagement.html',
        'suppliers.html': 'suppliersManagement.html',
        'projects.html': 'projectsManagement.html'
    };

    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(link => {
        const originalHref = link.getAttribute('href');
        if (pageMap[originalHref]) {
            link.href = pageMap[originalHref];
        }
        const currentPage = window.location.pathname.split("/").pop();
        if (pageMap[originalHref] === currentPage) {
            navItems.forEach(n => n.classList.remove('active'));
            link.classList.add('active');
        }
    });

    // ==========================================
    // 2. DASHBOARD SPECIFIC INTERACTIONS
    // ==========================================
    const quickActions = document.querySelectorAll('.quick-actions-panel button');
    if(quickActions.length > 0) {
        quickActions.forEach(btn => {
            btn.addEventListener('click', () => {
                const text = btn.textContent.trim();
                if(text.includes('Users')) window.location.href = 'usersManagement.html';
                if(text.includes('Suppliers')) window.location.href = 'suppliersManagement.html';
                if(text.includes('Projects')) window.location.href = 'projectsManagement.html';
            });
        });
    }

    const dashboardBtns = document.querySelectorAll('.export-btn, .view-all-btn');
    dashboardBtns.forEach(btn => {
        btn.addEventListener('click', () => alert('Generating Report... 📊'));
    });

    // ==========================================
    // 3. FILTER LOGIC (UPDATED)
    // ==========================================
    const filterBtns = document.querySelectorAll('.filter-btn');
    // Select all rows from the table body
    const tableRows = document.querySelectorAll('.data-table tbody tr');

    if (filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // 1. Update Button Styling
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                // 2. Get the Filter Category (e.g., "Admin", "Supplier")
                const category = btn.textContent.trim();

                // 3. Loop through rows and hide/show based on Role
                tableRows.forEach(row => {
                    // The Role is in the 3rd column (index 2)
                    // Column 0 = ID, Column 1 = Name, Column 2 = Role
                    const roleCell = row.cells[2]; 
                    
                    if (roleCell) {
                        const roleText = roleCell.textContent.trim();

                        // Logic: Show if "All" OR if role matches category
                        if (category === 'All' || roleText === category) {
                            row.style.display = ''; // Default display (show)
                        } else {
                            row.style.display = 'none'; // Hide row
                        }
                    }
                });
            });
        });
    }

    // ==========================================
    // 4. TABLE ACTIONS (Ban <-> Unban Logic)
    // ==========================================
    
    const actionLinks = document.querySelectorAll('.action-link');
    
    actionLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault(); 
            
            const action = link.textContent.trim();
            const row = link.closest('tr');
            const statusSpan = row.querySelector('.status-tag');
            
            if (action === 'Ban') {
                if(confirm('Are you sure you want to BAN this user? 🚫')) {
                    statusSpan.textContent = 'Banned';
                    statusSpan.className = 'status-tag banned';
                    statusSpan.style.backgroundColor = '#ffebee';
                    statusSpan.style.color = '#c62828';

                    link.textContent = 'Unban';
                    link.classList.remove('danger');
                    link.classList.add('success');
                }
            } 
            else if (action === 'Unban') {
                if(confirm('Unban this user? ✅')) {
                    statusSpan.textContent = 'Active';
                    statusSpan.className = 'status-tag active';
                    statusSpan.style.backgroundColor = '#e8f5e9';
                    statusSpan.style.color = '#2e7d32';

                    link.textContent = 'Ban';
                    link.classList.remove('success');
                    link.classList.add('danger');
                }
            }
            else if (action === 'Edit') {
                alert('Opening Edit Modal... ✏️');
            }
            else if (action === 'Approve') {
                statusSpan.textContent = 'Active';
                statusSpan.className = 'status-tag project-active';
                statusSpan.style.backgroundColor = '#e8f5e9';
                statusSpan.style.color = '#2e7d32';
                alert('Project Approved! 🚀');
            }
            else if (action === 'Reject') {
                statusSpan.textContent = 'Rejected';
                statusSpan.className = 'status-tag project-rejected';
                statusSpan.style.backgroundColor = '#ffebee';
                statusSpan.style.color = '#c62828';
            }
            else if (action === 'Close') {
                statusSpan.textContent = 'Completed';
                statusSpan.className = 'status-tag project-completed';
                statusSpan.style.backgroundColor = '#e3f2fd';
                statusSpan.style.color = '#1565c0';
            }
            else if (action === 'Restore') {
                statusSpan.textContent = 'Pending';
                statusSpan.className = 'status-tag project-pending';
                statusSpan.style.backgroundColor = '#fff3e0';
                statusSpan.style.color = '#ef6c00';
            }
            else if (action === 'View') {
                alert('Viewing Project Details... 📄');
            }
        });
    });

    // ==========================================
    // 5. DETAIL PANEL BUTTONS
    // ==========================================
    const detailBtns = document.querySelectorAll('.details-actions .btn');
    detailBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            alert(`Action "${btn.textContent}" executed successfully.`);
        });
    });
});