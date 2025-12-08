document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll('.nav-links a');

    navLinks.forEach(link => {
        const text = link.innerText.trim();

        if (text === 'Home' || text === 'Dashboard') {
            link.href = "StudentDashBoard.html";
        } 
        else if (text === 'Learn') {
            link.href = "StudentLearning.html";
        } 
        else if (text === 'Community') {
            link.href = "StudentCommunity.html";
        }
    });

    const continueBtn = document.querySelector('.btn-continue');
    if (continueBtn) {
        continueBtn.href = "StudentLearning.html";
    }

    const viewTopicLink = document.querySelector('.link-view');
    if (viewTopicLink) {
        viewTopicLink.href = "StudentCommunity.html";
    }
});