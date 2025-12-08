document.addEventListener('DOMContentLoaded', () => {
    // 1. Define your file paths
    // "Home" -> Dashboard
    // "Learn" -> Learning Hub
    // "Community" -> Community Forum
    const links = {
        'Home': 'educatorDashboardUI.html',
        'Learn': 'educatorLearnUI.html',
        'Community': 'educatorCommunityUI.html'
    };

    // 2. Select all navigation links
    const navAnchors = document.querySelectorAll('.nav-links a');

    // 3. Loop through links and assign the correct href based on text
    navAnchors.forEach(anchor => {
        const linkText = anchor.textContent.trim();
        
        if (links[linkText]) {
            anchor.href = links[linkText];
        }
    });

    // 4. Make the Logo clickable (redirects to Dashboard)
    const logoDiv = document.querySelector('.logo');
    if (logoDiv) {
        logoDiv.addEventListener('click', () => {
            window.location.href = 'educatorDashboardUI.html';
        });
    }
});