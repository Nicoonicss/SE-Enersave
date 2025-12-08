document.addEventListener('DOMContentLoaded', () => {

    // --- 1. SUPPLIER NAVIGATION LOGIC ---
    const supplierPages = {
        'homeDirect': 'SupplierDashBoard.html',
        'marketplaceDirect': 'SupplierMarketPlace.html',
        'Community': 'SupplierCommunity.html',
        'EnerSave': 'SupplierDashBoard.html'
    };

    // Handle ID-based links (homeDirect, marketplaceDirect)
    const idLinks = ['homeDirect', 'marketplaceDirect'];
    idLinks.forEach(id => {
        const linkElement = document.getElementById(id);
        if (linkElement) {
            linkElement.addEventListener('click', (e) => {
                e.preventDefault();
                window.location.href = supplierPages[id];
            });
            
            // Highlight Logic for IDs
            const targetPage = supplierPages[id];
            const currentPage = window.location.pathname.split("/").pop();
            if(targetPage === currentPage) {
                linkElement.style.color = 'green';
                linkElement.style.fontWeight = '700';
            } else {
                 linkElement.style.color = 'black';
            }
        }
    });

    // Handle Text-based links (Community, Logo)
    const textLinks = document.querySelectorAll('.nav-left a:not([id])'); // Selects links without IDs
    textLinks.forEach(link => {
        const text = link.textContent.trim();
        if (supplierPages[text]) {
            link.href = supplierPages[text];
            
            // Highlight Logic
            const currentPage = window.location.pathname.split("/").pop();
            if(supplierPages[text] === currentPage) {
                link.style.color = 'green';
                link.style.fontWeight = '700';
            }
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

    // --- 3. MARKETPLACE INTERACTIVITY ---
    const btnAddProduct = document.querySelector('.btn-add-product');
    if(btnAddProduct) {
        btnAddProduct.addEventListener('click', () => {
            alert('Opening "Add Product" form...');
        });
    }

    // Marketplace Actions (Edit/Delete)
    const actionBtns = document.querySelectorAll('.icon-btn');
    actionBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if(btn.classList.contains('icon-delete')) {
                if(confirm('Delete this product listing?')) {
                    btn.closest('tr').remove();
                }
            } else {
                alert('Editing product details...');
            }
        });
    });

    // --- 4. COMMUNITY TOPIC ACTIONS ---
    const newTopicBtn = document.querySelector('.new-topic-btn');
    if(newTopicBtn) {
        newTopicBtn.addEventListener('click', () => alert('Create New Topic Modal Opening...'));
    }
});