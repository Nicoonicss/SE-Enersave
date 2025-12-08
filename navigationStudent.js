document.addEventListener('DOMContentLoaded', () => {

    const pages = {
        'Home': 'StudentDashBoard.html',
        'Learn': 'StudentLearning.html',
        'Community': 'StudentCommunity.html',
        'EnerSave': 'StudentDashBoard.html' 
    };

    const navLinks = document.querySelectorAll('.nav-left a');

    navLinks.forEach(link => {
        const linkText = link.textContent.trim();
        
        if (pages[linkText]) {
            link.href = pages[linkText];
        }

        const currentPage = window.location.pathname.split("/").pop();
        if (pages[linkText] === currentPage) {
            link.style.color = '#2e9e48';
            link.style.fontWeight = '700';
        } else if (linkText !== 'EnerSave') {
            link.style.color = 'black'; 
            link.style.fontWeight = '500';
        }
    });
    
    const btnContinue = document.querySelector('.btn-continue');
    if (btnContinue) {
        btnContinue.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = 'StudentLearning.html';
        });
    }

    const linkViewTopic = document.querySelector('.link-view');
    if (linkViewTopic) {
        linkViewTopic.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = 'StudentCommunity.html';
        });
    }

    const btnWatch = document.querySelector('.btn-watch');
    if (btnWatch) {
        btnWatch.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Opening video player for: Understanding Solar Energy Basics...');
        });
    }

    const tags = document.querySelectorAll('.tag');
    if (tags.length > 0) {
        tags.forEach(tag => {
            tag.addEventListener('click', () => {
                if (tag.style.backgroundColor === 'rgb(46, 158, 72)') {
                    tag.style.backgroundColor = '#F0F0F0';
                    tag.style.color = 'black';
                } else {
                    tag.style.backgroundColor = '#2e9e48'; 
                    tag.style.color = 'white';
                }
            });
        });
    }

    const downloadBtns = document.querySelectorAll('.download-btn');
    if (downloadBtns.length > 0) {
        downloadBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                alert('Starting download... 📄');
            });
        });
    }

    const registerBtn = document.querySelector('.register-btn');
    if (registerBtn) {
        registerBtn.addEventListener('click', () => {
            alert('You have successfully registered for the webinar! 📅');
            registerBtn.textContent = 'Registered';
            registerBtn.style.backgroundColor = '#888';
            registerBtn.disabled = true;
        });
    }

    const tabs = document.querySelectorAll('.tab');
    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.style.backgroundColor = '#eee';
                    t.style.color = 'black';
                });
                
                tab.classList.add('active');
                tab.style.backgroundColor = '#5cd65c'; // Bright green
                tab.style.color = 'green'; // Darker green text
            });
        });
    }

    const newTopicBtn = document.querySelector('.new-topic-btn');
    if (newTopicBtn) {
        newTopicBtn.addEventListener('click', () => {
            const topic = prompt("Enter your new discussion topic:");
            if (topic) {
                alert(`Topic "${topic}" submitted for review!`);
            }
        });
    }

    const actionBtns = document.querySelectorAll('.buttons .btn');
    if (actionBtns.length > 0) {
        actionBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                alert('This feature will open the detailed discussion thread.');
            });
        });
    }
});