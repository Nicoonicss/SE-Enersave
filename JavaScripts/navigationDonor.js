document.addEventListener('DOMContentLoaded', () => {

    // --- 1. DONOR NAVIGATION LOGIC ---
    const donorPages = {
        'homeDirect': '/donorHomeUI',
        'projectDirect': '/donorCrowdfundingUI',
        'forumDirect': '/donorCommunityUI',
        'Home': '/donorHomeUI',
        'Projects': '/donorCrowdfundingUI',
        'Community': '/donorCommunityUI',
        'EnerSave': '/donorHomeUI'
    };

    // Handle all navigation links
    const navLinks = document.querySelectorAll('.nav-left a');
    navLinks.forEach(link => {
        const linkId = link.getAttribute('id');
        const linkText = link.textContent.trim();
        
        // Assign hrefs based on ID or text content
        if (linkId && donorPages[linkId]) {
            if (!link.getAttribute('href') || link.getAttribute('href') === '#') {
                link.href = donorPages[linkId];
            }
        } else if (donorPages[linkText]) {
            if (!link.getAttribute('href') || link.getAttribute('href') === '#') {
                link.href = donorPages[linkText];
            }
        }

        // Highlight active link based on current URL
        const currentPath = window.location.pathname;
        const linkHref = link.getAttribute('href');
        
        if (linkHref && linkHref === currentPath) {
            link.style.color = '#2e9e48'; // Green for active
            link.style.fontWeight = '700';
        } else if (linkText !== 'EnerSave' && !link.classList.contains('brand-name')) {
            link.style.color = 'black';
            link.style.fontWeight = '500';
        }
    });

    // --- 2. COMMUNITY TABS INTERACTIVITY ---
    const tabs = document.querySelectorAll('.tab');
    if(tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.style.backgroundColor = '#eee';
                    t.style.color = '#333';
                });
                tab.classList.add('active');
                tab.style.backgroundColor = '#5cd65c';
                tab.style.color = 'green';
            });
        });
    }

    // --- 3. PROJECTS INTERACTIVITY ---
    const btnDonate = document.querySelectorAll('.btn-donate, .product-donate-btn');
    btnDonate.forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Opening donation form...');
        });
    });

    const btnDetails = document.querySelectorAll('.btn-details, .product-details-btn');
    btnDetails.forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Opening project details...');
        });
    });

    const startFundraiserBtn = document.querySelector('.start-fundraiser-btn');
    if(startFundraiserBtn) {
        startFundraiserBtn.addEventListener('click', () => {
            alert('Opening fundraiser creation form...');
        });
    }

    // --- 4. COMMUNITY TOPIC ACTIONS ---
    const newTopicBtn = document.querySelector('.new-topic-btn');
    if(newTopicBtn) {
        newTopicBtn.addEventListener('click', () => alert('Create New Topic Modal Opening...'));
    }

    const viewAllBtn = document.querySelector('.view-all');
    if(viewAllBtn) {
        viewAllBtn.addEventListener('click', () => {
            alert('Viewing all donations...');
        });
    }
});

