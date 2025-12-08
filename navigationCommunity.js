document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. GLOBAL NAVIGATION LOGIC ---
    const links = {
        'EnerSave': 'communityUserUI.html', // Clicking Logo goes Home
        'Home': 'communityUserUI.html',     // Clicking Home goes to UserUI
        'Marketplace': 'communityMarketPlaceUI.html',
        'Projects': 'communityCrowdFundingUI.html', // "Projects" in Navbar
        'Community': 'communityForumUI.html',
        'Learn': 'communityLearnUI.html'
    };

    const navAnchors = document.querySelectorAll('.nav-left a');

    navAnchors.forEach(anchor => {
        const linkText = anchor.textContent.trim();
        
        // Assign Links based on text content
        if (links[linkText]) {
            anchor.href = links[linkText];
        }

        // Highlight Active Page Logic
        // We check if the current browser URL includes the file name associated with the link
        const currentFile = links[linkText];
        if(currentFile && window.location.href.includes(currentFile)) {
            anchor.style.color = 'green';
        } else if (linkText !== 'EnerSave') {
            anchor.style.color = 'black';
        }
    });

    // --- 2. HOME PAGE SPECIFIC INTERACTIONS ---
    
    // Hero Section Buttons
    const heroMarketBtn = document.querySelector('.hero-buttons .btn-green');
    if(heroMarketBtn) {
        heroMarketBtn.addEventListener('click', () => {
            window.location.href = 'communityMarketPlaceUI.html';
        });
    }

    const heroLearnBtn = document.querySelector('.hero-buttons .btn-white');
    if(heroLearnBtn) {
        heroLearnBtn.addEventListener('click', () => {
            window.location.href = 'communityLearnUI.html';
        });
    }

    // "View Project" Button (Next to Gcash) - NEW ADDITION
    const viewProjectBtn = document.querySelector('.view-project');
    if(viewProjectBtn) {
        viewProjectBtn.addEventListener('click', () => {
            window.location.href = 'communityCrowdFundingUI.html';
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