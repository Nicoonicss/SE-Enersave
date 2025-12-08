document.addEventListener("DOMContentLoaded", function() {
    // Select all links inside the navigation bar
    const navLinks = document.querySelectorAll('.nav-links a');

    // Loop through each link and assign the correct HTML file
    navLinks.forEach(link => {
        // Get the text inside the link (e.g., "Home", "Learn", "Community")
        // .trim() removes any extra spaces around the text
        const text = link.innerText.trim();

        if (text === 'Home' || text === 'Dashboard') {
            // "Home" button goes to StudentDashBoard.html
            link.href = "StudentDashBoard.html";
        } 
        else if (text === 'Learn') {
            // "Learn" button goes to StudentLearning.html
            link.href = "StudentLearning.html";
        } 
        else if (text === 'Community') {
            // "Community" button goes to StudentCommunity.html
            link.href = "StudentCommunity.html";
        }
    });

    // --- Optional: Make the "Continue Learning" button on Dashboard work ---
    const continueBtn = document.querySelector('.btn-continue');
    if (continueBtn) {
        continueBtn.href = "StudentLearning.html";
    }

    // --- Optional: Make the "View Topic" link on Dashboard work ---
    const viewTopicLink = document.querySelector('.link-view');
    if (viewTopicLink) {
        viewTopicLink.href = "StudentCommunity.html";
    }
});