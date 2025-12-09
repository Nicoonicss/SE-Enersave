document.addEventListener('DOMContentLoaded', () => {

    // --- 1. GLOBAL NAVIGATION LOGIC ---
    // Define the routes for Educator pages
    const pages = {
        'Home': '/educatorDashboardUI',
        'Learn': '/educatorLearnUI',
        'Community': '/educatorCommunityUI',
        'EnerSave': '/educatorDashboardUI' // Clicking Brand Name goes to Dashboard
    };

    // UPDATED: We only select links inside .nav-left now
    const navLinks = document.querySelectorAll('.nav-left a');

    navLinks.forEach(link => {
        const linkText = link.textContent.trim();
        
        // 1. Assign hrefs based on text content (skip if already has href from PHP)
        if (pages[linkText] && !link.getAttribute('href') || link.getAttribute('href') === '#') {
            link.href = pages[linkText];
        }

        // 2. Highlight the active link based on current URL
        const currentPath = window.location.pathname;
        
        // Only apply styling if the link destination matches the current page
        if (pages[linkText] === currentPath) {
            link.style.color = '#2e9e48'; // Green for active
            link.style.fontWeight = '700';
        } else if (linkText !== 'EnerSave' && !link.classList.contains('brand-name')) { 
            // Reset others (excluding the brand logo)
            link.style.color = 'black'; 
            link.style.fontWeight = '500';
        }
    });

    // --- 2. DASHBOARD INTERACTIONS ---
    
    // "Continue Learning" Button -> Go to Learning Hub
    const btnContinue = document.querySelector('.btn-continue');
    if (btnContinue) {
        btnContinue.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = '/educatorLearnUI';
        });
    }

    // "View Topic" Link -> Go to Community Forum
    const linkViewTopic = document.querySelector('.link-view');
    if (linkViewTopic) {
        linkViewTopic.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = '/educatorCommunityUI';
        });
    }

    // "Watch Now" Button -> Simulation
    const btnWatch = document.querySelector('.btn-watch');
    if (btnWatch) {
        btnWatch.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Opening featured lesson video player...');
        });
    }

    // Category Tags (Visual Toggle)
    const tags = document.querySelectorAll('.tag');
    if (tags.length > 0) {
        tags.forEach(tag => {
            tag.addEventListener('click', () => {
                if (tag.style.backgroundColor === 'rgb(46, 158, 72)') { // Check for green
                    tag.style.backgroundColor = '#F0F0F0';
                    tag.style.color = 'black';
                } else {
                    tag.style.backgroundColor = '#2e9e48'; // Green
                    tag.style.color = 'white';
                }
            });
        });
    }

    // --- 3. LEARNING HUB INTERACTIONS ---

    // Download Buttons
    const downloadBtns = document.querySelectorAll('.download-btn');
    if (downloadBtns.length > 0) {
        downloadBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                alert('Starting download for educational material... 📄');
            });
        });
    }

    // Educator Upload Button
    const uploadBtn = document.querySelector('.educator-upload-btn');
    if (uploadBtn) {
        uploadBtn.addEventListener('click', () => {
            alert('Opening File Uploader...\nTypes allowed: .mp4, .pdf, .docx');
        });
    }

    // --- 4. COMMUNITY FORUM INTERACTIONS ---

    // Tab Switching Logic
    const tabs = document.querySelectorAll('.tab');
    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.style.backgroundColor = '#eee';
                    t.style.color = 'black';
                });
                tab.classList.add('active');
                tab.style.backgroundColor = '#5cd65c';
                tab.style.color = 'green';
            });
        });
    }

    // Start New Topic Button
    const newTopicBtn = document.querySelector('.new-topic-btn');
    if (newTopicBtn) {
        newTopicBtn.addEventListener('click', () => {
            const topic = prompt("Enter title for new discussion topic:");
            if (topic) {
                alert(`New topic "${topic}" created successfully!`);
            }
        });
    }

    // Discussion Buttons (Reply, Pin, Mark Helpful)
    const discussionBtns = document.querySelectorAll('.discussion .btn');
    if (discussionBtns.length > 0) {
        discussionBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const actionText = btn.textContent.trim();
                
                if (actionText.includes('View Thread')) {
                    alert('Opening full discussion thread...');
                } else if (actionText.includes('Reply')) {
                    alert('Opening reply text box...');
                } else if (actionText.includes('Pin')) {
                    alert('Topic pinned to top of board! 📌');
                    btn.style.backgroundColor = '#ffd700'; // Gold color to show pinned status
                } else if (actionText.includes('Mark Helpful')) {
                    alert('Marked as helpful answer! ✅');
                    btn.style.backgroundColor = '#90ee90'; // Light green
                }
            });
        });
    }
});