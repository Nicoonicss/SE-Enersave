document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. COMMUNITY NAVIGATION LOGIC ---
    const communityPages = {
        'homeDirect': '/communityUserUI',
        'marketplaceDirect': '/communityMarketplaceUI',
        'projectDirect': '/communityCrowdfundingUI',
        'learnDirect': '/communityLearnUI',
        'forumDirect': '/communityForumUI',
        'Home': '/communityUserUI',
        'Marketplace': '/communityMarketplaceUI',
        'Projects': '/communityCrowdfundingUI',
        'Learn': '/communityLearnUI',
        'Community': '/communityForumUI',
        'EnerSave': '/communityUserUI'
    };

    // Handle all navigation links
    const navLinks = document.querySelectorAll('.nav-left a');
    navLinks.forEach(link => {
        const linkId = link.getAttribute('id');
        const linkText = link.textContent.trim();
        
        // Assign hrefs based on ID or text content
        if (linkId && communityPages[linkId]) {
            if (!link.getAttribute('href') || link.getAttribute('href') === '#') {
                link.href = communityPages[linkId];
            }
        } else if (communityPages[linkText]) {
            if (!link.getAttribute('href') || link.getAttribute('href') === '#') {
                link.href = communityPages[linkText];
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

    // --- 2. HOME PAGE SPECIFIC INTERACTIONS ---
    
    // Hero Section Buttons
    const heroMarketBtn = document.querySelector('.hero-buttons .btn-green');
    if(heroMarketBtn) {
        heroMarketBtn.addEventListener('click', () => {
            window.location.href = '/communityMarketplaceUI';
        });
    }

    const heroLearnBtn = document.querySelector('.hero-buttons .btn-white');
    if(heroLearnBtn) {
        heroLearnBtn.addEventListener('click', () => {
            window.location.href = '/communityLearnUI';
        });
    }

    // "View Project" Button (Next to Gcash) - NEW ADDITION
    const viewProjectBtn = document.querySelector('.view-project');
    if(viewProjectBtn) {
        viewProjectBtn.addEventListener('click', () => {
            window.location.href = '/communityCrowdfundingUI';
        });
    }

    // Home Page "View Details" links (Visual feedback only for now)
    const productLinks = document.querySelectorAll('.product-card a');
    productLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Redirecting to Product Details...');
        });
    });

    // --- 3. MARKETPLACE INTERACTIONS ---
    const filterBtns = document.querySelectorAll('.filter-btn');
    if(filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Reset all buttons
                filterBtns.forEach(b => {
                    b.classList.remove('active');
                    b.style.backgroundColor = '#ddd'; 
                    b.style.color = '#444';
                });
                // Activate clicked button
                btn.classList.add('active');
                
                // Visual styling for active state
                if(btn.textContent === 'All') {
                    btn.style.backgroundColor = '#98FB98';
                    btn.style.color = 'green';
                } else {
                    btn.style.backgroundColor = 'lightgrey';
                    btn.style.color = '#333';
                }
            });
        });

        // Buy/Add Buttons
        document.querySelectorAll('.btn-buy').forEach(btn => {
            btn.addEventListener('click', () => alert('Proceeding to Checkout...'));
        });
        document.querySelectorAll('.btn-add').forEach(btn => {
            btn.addEventListener('click', () => alert('Item added to cart!'));
        });
    }

    // --- 4. CROWDFUNDING INTERACTIONS (Works on Home & Projects Page) ---
    // We select both standard .btn-donate and the specific home page .donate-btn
    const allDonateBtns = document.querySelectorAll('.btn-donate, .donate-btn');
    if(allDonateBtns.length > 0) {
        allDonateBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // If it's the GCash button, customize the message
                if(btn.textContent.includes('Gcash')) {
                    alert('Opening Gcash Integration...');
                } else {
                    const amount = prompt("Enter donation amount (PHP):", "1000");
                    if(amount) alert(`Thank you for donating ₱${amount}!`);
                }
            });
        });
    }

    // --- 5. FORUM INTERACTIONS ---
    const forumTabs = document.querySelectorAll('.tab');
    if(forumTabs.length > 0) {
        forumTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                forumTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });

        const newTopicBtn = document.querySelector('.new-topic-btn');
        if(newTopicBtn) {
            newTopicBtn.addEventListener('click', () => alert('Open "Create New Topic" Modal'));
        }
    }

    // --- 6. LEARNING HUB INTERACTIONS ---
    const downloadBtns = document.querySelectorAll('.download-btn');
    if(downloadBtns.length > 0) {
        downloadBtns.forEach(btn => {
            btn.addEventListener('click', () => alert('Starting Download...'));
        });
    }
});