document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. ADMIN NAVIGATION LOGIC ---
    // Map the conceptual names in your HTML to the actual filenames
    const adminPages = {
        'dashboard.html': 'dashboard.html', // Placeholder
        'users.html': 'usersManagement.html',
        'suppliers.html': 'suppliersManagement.html',
        'projects.html': 'projects.html' // Placeholder
    };

    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(link => {
        // Get the original href attribute (e.g., "users.html")
        const originalHref = link.getAttribute('href');

        // 1. Update the href to the actual filename
        if (adminPages[originalHref]) {
            link.href = adminPages[originalHref];
        }

        // 2. Highlight Active Link
        // Check if the current actual URL contains the mapped filename
        const currentUrl = window.location.pathname.split("/").pop();
        if (adminPages[originalHref] === currentUrl) {
            navItems.forEach(n => n.classList.remove('active'));
            link.classList.add('active');
        }
    });

    // --- 2. FILTER BUTTONS INTERACTIVITY ---
    const filterBtns = document.querySelectorAll('.filter-btn');
    if (filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked
                btn.classList.add('active');
                
                // Simulation: Filter logic would go here
                console.log(`Filtering by: ${btn.textContent}`);
            });
        });
    }

    // --- 3. ACTION LINKS (Edit/Ban/Unban) ---
    const actionLinks = document.querySelectorAll('.action-link');
    actionLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const action = link.textContent.trim();
            const row = link.closest('tr');
            const name = row ? row.cells[1].textContent : 'User';

            if (action === 'Ban') {
                if(confirm(`Are you sure you want to ban ${name}?`)) {
                    alert(`${name} has been banned.`);
                    // Visual update simulation
                    const statusSpan = row.querySelector('.status-tag');
                    if(statusSpan) {
                        statusSpan.textContent = 'Banned';
                        statusSpan.className = 'status-tag banned';
                        statusSpan.style.backgroundColor = '#ffebee';
                        statusSpan.style.color = '#c62828';
                    }
                }
            } else if (action === 'Unban') {
                alert(`${name} has been unbanned.`);
                 const statusSpan = row.querySelector('.status-tag');
                    if(statusSpan) {
                        statusSpan.textContent = 'Active';
                        statusSpan.className = 'status-tag active';
                        statusSpan.style.backgroundColor = '#e8f5e9'; // Light green
                        statusSpan.style.color = '#2e7d32';
                    }
            } else {
                alert(`Opening edit modal for ${name}...`);
            }
        });
    });

    // --- 4. DETAIL PANEL BUTTONS ---
    const detailBtns = document.querySelectorAll('.details-actions .btn');
    detailBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            alert(`Action "${btn.textContent}" triggered.`);
        });
    });
});