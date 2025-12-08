document.addEventListener('DOMContentLoaded', () => {
    const links = {
        'Dashboard': 'SupplierDashBoard.html',
        'Marketplace': 'SupplierMarketPlace.html',
        'Community': 'SupplierCommunity.html'
    };

    const navAnchors = document.querySelectorAll('.nav-links a');

    navAnchors.forEach(anchor => {
        const linkText = anchor.textContent.trim();
        
        if (links[linkText]) {
            anchor.href = links[linkText];
        }
    });

    const logoDiv = document.querySelector('.logo');
    if (logoDiv) {
        logoDiv.style.cursor = 'pointer';
        logoDiv.addEventListener('click', () => {
            window.location.href = 'SupplierDashBoard.html';
        });
    }
});