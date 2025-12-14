// Avatar dropdown functionality - reusable for all pages
document.addEventListener('DOMContentLoaded', function() {
    const avatar = document.getElementById('avatarDropdown');
    const dropdown = document.getElementById('avatarMenu');
    
    if (avatar && dropdown) {
        avatar.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!avatar.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });
    }
});

