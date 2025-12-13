document.addEventListener('DOMContentLoaded', () => {

    // ==========================================
    // 1. GLOBAL NAVIGATION LOGIC (Updated for PHP routes)
    // ==========================================
    const pageRoutes = {
        '/adminDashboard': '/adminDashboard',
        '/usersManagement': '/usersManagement',
        '/suppliersManagement': '/suppliersManagement',
        '/projectsManagement': '/projectsManagement'
    };

    // Update active state based on current URL
    const navItems = document.querySelectorAll('.nav-item');
    const currentPath = window.location.pathname;

    navItems.forEach(link => {
        const linkHref = link.getAttribute('href');
        
        // Remove active class from all items first
        navItems.forEach(n => n.classList.remove('active'));
        
        // Add active class if the link matches current path
        if (linkHref === currentPath) {
            link.classList.add('active');
        }
    });

    // ==========================================
    // 2. DASHBOARD SPECIFIC INTERACTIONS (Updated for PHP routes)
    // ==========================================
    const quickActions = document.querySelectorAll('.quick-actions-panel button');
    if(quickActions.length > 0) {
        quickActions.forEach(btn => {
            btn.addEventListener('click', () => {
                const text = btn.textContent.trim();
                if(text.includes('Users')) window.location.href = '/usersManagement';
                if(text.includes('Suppliers')) window.location.href = '/suppliersManagement';
                if(text.includes('Projects')) window.location.href = '/projectsManagement';
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
            
            // Ban/Unban functionality is now handled by modal scripts in admin pages
            // Approve/Reject/Restore functionality is handled by modal scripts in projects management
            // Only handle actions that don't have dedicated modals
            if (action === 'Ban' || action === 'Unban') {
                // Handled by modal scripts
                return;
            }
            else if (action === 'Edit') {
                // Edit functionality is handled by inline scripts in admin pages
                // Do nothing here to avoid conflicts
                return;
            }
            else if (action === 'Approve' || action === 'Reject' || action === 'Restore') {
                // Handled by modal scripts in projects management
                // Do nothing here to avoid conflicts
                return;
            }
            else if (action === 'Close') {
                statusSpan.textContent = 'Completed';
                statusSpan.className = 'status-tag project-completed';
                statusSpan.style.backgroundColor = '#e3f2fd';
                statusSpan.style.color = '#1565c0';
            }
            else if (action === 'View') {
                // View functionality is handled by modal scripts in admin pages
                // Do nothing here to avoid conflicts
                return;
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