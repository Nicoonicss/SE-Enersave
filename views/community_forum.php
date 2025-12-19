<?php
$pageTitle = 'Forum';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Community User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>EnerSave Community Forum</title>

<style>
   body {
   margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #f7f7f7;
}

    .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    background: white;
    border-bottom: 1px solid #e0e0e0;
    position: sticky;
    top: 0;
    z-index: 10;
}

.nav-left {
    display: flex;
    align-items: center;
    gap: 20px;
    font-size: 15px;
}

.nav-left img {
    width: 30px;
}

.nav-left a,
.nav-right a {
    text-decoration: none;
    color: black;
    font-weight: 500;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-right:15px;
}

.avatar-container {
    position: relative;
    margin-right: 15px;
}

.nav-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #ffcc00;
    cursor: pointer;
}

.avatar-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
    min-width: 180px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
    pointer-events: none;
    overflow: hidden;
}

.avatar-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

.avatar-dropdown-item {
    display: flex;
    align-items: center;
    padding: 14px 18px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    border-bottom: 1px solid #f0f0f0;
}

.avatar-dropdown-item:last-child {
    border-bottom: none;
}

.avatar-dropdown-item:hover {
    background-color: #f8f9fa;
    color: #239c42;
    padding-left: 20px;
}

.avatar-dropdown-item:first-child {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.avatar-dropdown-item:last-child {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.avatar-dropdown-item.logout {
    color: #d32f2f;
    font-weight: 600;
}

.avatar-dropdown-item.logout:hover {
    background-color: #ffebee;
    color: #b71c1c;
    padding-left: 20px;
}

.brand-name {
    font-weight: 900;
    font-size: 18px;
}

    .container {
        padding: 32px;
        max-width: 2000px;
        margin: auto;
    }

    h1 {
        margin-bottom: 5px;
        margin-top: -10px;
    }
    .subtitle {
        margin-bottom: 20px;
        color: #006400;
        font-size: 14px;
    }

    .tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    .tab {
        padding: 6px 16px;
        border-radius: 20px;
        background: #eee;
        cursor: pointer;
        font-size: 14px;
    }
    .tab.active {
        background: #5cd65c;
        color: green;
    }

    .tabs-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}
    .right-controls {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-right: 1148px;
    margin-bottom: 19px;
}
   .search-box input {
    padding: 10px 14px;
    width: 300px;
    border-radius: 20px;
    border: 1px solid #ccc;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0px;
}


    .new-topic-btn {
        background: #22a722;
        padding: 10px 24px;
        border-radius: 20px;
        color: white;
        cursor: pointer;
        border: none;
        font-weight: bold;
    }

    .discussion {
        background: white;
        padding: 20px;
        border: 1px solid #e5e5e5;
        margin-bottom: 15px;
        border-radius: 6px;
    }
    .discussion .title {
        font-weight: bold;
        margin-bottom: 8px;
        font-size: 16px;
    }
    .discussion .meta {
        color: #666;
        font-size: 13px;
        margin-bottom: 12px;
    }
    .buttons {
        display: flex;
        gap: 15px;
    }
    .btn {
        padding: 6px 14px;
        border-radius: 18px;
        font-size: 13px;
        cursor: pointer;
        border: 1px solid #ccc;
        background: #f8f8f8;
    }

    .buttons .btn {
    display: flex;
    align-items: center;   
    justify-content: center; 
    gap: 6px;               
}
.buttons .btn img {
    height: 18px; 
    width: 18px;
}

    footer {
        margin-top: 30px;
        text-align: center;
        font-size: 14px;
        color: #777;
    }
    footer .report {
        color: red;
        margin-left: 20px;
        cursor: pointer;
    }

    /* Modal Styles */
    .forum-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    .forum-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-content {
        background-color: white;
        margin: auto;
        padding: 30px;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 28px;
        font-weight: bold;
        color: #999;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }

    .close-modal:hover {
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-group label.required::after {
        content: " *";
        color: #d32f2f;
    }

    .form-group label.optional::after {
        content: " (optional)";
        font-weight: normal;
        color: #999;
        font-size: 12px;
    }

    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        font-family: Arial, Helvetica, sans-serif;
        box-sizing: border-box;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 25px;
    }

    .btn-cancel {
        background: #f0f0f0;
        color: #333;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        transition: background 0.2s ease;
    }

    .btn-cancel:hover {
        background: #e0e0e0;
    }

    .btn-add-discussion,
    .btn-reply {
        background: #22a722;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        transition: background 0.2s ease;
    }

    .btn-add-discussion:hover,
    .btn-reply:hover {
        background: #1e8a1e;
    }

    .discussion-title-display {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        padding: 10px;
        background: #f8f8f8;
        border-radius: 8px;
    }

    .replies-container {
        max-height: 400px;
        overflow-y: auto;
        margin-top: 20px;
    }

    .reply-item {
        background: #f8f8f8;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        border-left: 3px solid #22a722;
    }

    .reply-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .reply-author {
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .reply-date {
        color: #666;
        font-size: 12px;
    }

    .reply-content {
        color: #555;
        line-height: 1.5;
        font-size: 14px;
    }

    .no-replies {
        text-align: center;
        padding: 40px 20px;
        color: #999;
        font-style: italic;
    }
</style>
</head>

<body>

 <div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/communityUserUI" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/communityUserUI" id="homeDirect">Home</a>
        <a href="/communityMarketplaceUI" id="marketplaceDirect">Marketplace</a>
        <a href="/communityCrowdfundingUI" id="projectDirect">Projects</a>
        <a href="/communityLearnUI" id="learnDirect">Learn</a>
        <a href="/communityForumUI" style="color: green;">Community</a>
    </div>

    <div class="nav-right">
        Community: <?php echo htmlspecialchars($username); ?>
        <div class="avatar-container">
            <div class="nav-avatar" id="avatarDropdown"></div>
            <div class="avatar-dropdown" id="avatarMenu">
                <a href="#" class="avatar-dropdown-item">Settings</a>
                <a href="/logout" class="avatar-dropdown-item logout">Logout</a>
            </div>
        </div>
    </div>
</div>  


<div class="container">
    <h1>COMMUNITY FORUM</h1>
    <div class="subtitle">Connect with others, share ideas, and ask questions.</div>

   <div class="tabs-row">
    <div class="tabs">
        <div class="tab active" data-filter="all">All</div>
        <div class="tab" data-filter="solar">Solar</div>
        <div class="tab" data-filter="hydro">Hydro</div>
        <div class="tab" data-filter="wind">Wind</div>
        <div class="tab" data-filter="projects">Projects</div>
    </div>

    <div class="right-controls">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search" />
        </div>
    </div>
</div>


    <div class="section-header">
    <h2>Recent Discussions</h2>
    <button class="new-topic-btn" id="startNewDiscussionBtn">Start New Discussion</button>
</div>

    <div id="discussionsContainer">
        <div class="discussion" data-category="solar" data-replies="12" data-discussion-id="discussion-1">
            <div class="title">"Best Solar Panel for Home Use?"</div>
            <div class="meta">(<span class="reply-count">12</span> replies)</div>
            <div class="buttons">
                <div class="btn"><img src="/images/Eye.png">View Thread</div>
                <div class="btn reply-btn"><img src="/images/Reply.png">Reply</div>
            </div>
        </div>

        <div class="discussion" data-category="projects" data-replies="8" data-discussion-id="discussion-2">
            <div class="title">"How to Apply for CrowdFunding?"</div>
            <div class="meta">(<span class="reply-count">8</span> replies)</div>
            <div class="buttons">
                <div class="btn"><img src="/images/Eye.png">View Thread</div>
                <div class="btn reply-btn"><img src="/images/Reply.png">Reply</div>
            </div>
        </div>

        <div class="discussion" data-category="wind" data-replies="4" data-discussion-id="discussion-3">
            <div class="title">"Tips for Maintaining Wind Turbines?"</div>
            <div class="meta">(<span class="reply-count">4</span> replies)</div>
            <div class="buttons">
                <div class="btn"><img src="/images/Eye.png">View Thread</div>
                <div class="btn reply-btn"><img src="/images/Reply.png">Reply</div>
            </div>
        </div>
    </div>

    <footer>
        Community Guidelines 
        <span class="report">Report Post 🚩</span>
    </footer>
</div>

    <!-- Start New Discussion Modal -->
    <div id="newDiscussionModal" class="forum-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Start New Discussion</h2>
                <button class="close-modal" id="closeNewDiscussionModal">&times;</button>
            </div>
            <form id="newDiscussionForm">
                <div class="form-group">
                    <label for="discussionTitle" class="required">Title</label>
                    <input type="text" id="discussionTitle" required placeholder="Enter discussion title">
                </div>
                <div class="form-group">
                    <label for="discussionDescription" class="optional">Description</label>
                    <textarea id="discussionDescription" placeholder="Enter description (optional)"></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" id="cancelNewDiscussionBtn">Cancel</button>
                    <button type="submit" class="btn-add-discussion">Add Discussion</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reply Modal -->
    <div id="replyModal" class="forum-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Reply to Discussion</h2>
                <button class="close-modal" id="closeReplyModal">&times;</button>
            </div>
            <form id="replyForm">
                <div class="discussion-title-display" id="replyDiscussionTitle"></div>
                <div class="form-group">
                    <label for="replyText" class="required">Your Reply</label>
                    <textarea id="replyText" required placeholder="Enter your reply"></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" id="cancelReplyBtn">Cancel</button>
                    <button type="submit" class="btn-reply">Reply</button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Thread Modal -->
    <div id="viewThreadModal" class="forum-modal">
        <div class="modal-content" style="max-width: 700px;">
            <div class="modal-header">
                <h2>Discussion Thread</h2>
                <button class="close-modal" id="closeViewThreadModal">&times;</button>
            </div>
            <div class="discussion-title-display" id="viewThreadTitle"></div>
            <div class="replies-container" id="repliesContainer">
                <div class="no-replies">No replies yet. Be the first to reply!</div>
            </div>
        </div>
    </div>

    <script src="/navigationCommunity.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterTabs = document.querySelectorAll('.tab');
        const searchInput = document.getElementById('searchInput');
        const discussions = document.querySelectorAll('.discussion');
        let currentFilter = 'all';

        // Function to apply filters and search
        function applyFiltersAndSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();

            discussions.forEach(discussion => {
                const category = discussion.getAttribute('data-category') || '';
                const title = discussion.querySelector('.title')?.textContent.toLowerCase() || '';
                const meta = discussion.querySelector('.meta')?.textContent.toLowerCase() || '';
                const searchableText = `${title} ${meta}`;

                // Check if matches filter
                const matchesFilter = currentFilter === 'all' || category === currentFilter;

                // Check if matches search
                const matchesSearch = searchTerm === '' || searchableText.includes(searchTerm);

                // Show or hide discussion
                if (matchesFilter && matchesSearch) {
                    discussion.style.display = '';
                } else {
                    discussion.style.display = 'none';
                }
            });
        }

        // Filter tab click handlers - reload from database
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                // Update current filter
                currentFilter = this.getAttribute('data-filter') || 'all';
                // Reload discussions from database with filter
                const searchTerm = searchInput ? searchInput.value.trim() : '';
                if (window.loadDiscussions) {
                    window.loadDiscussions(currentFilter !== 'all' ? currentFilter : null, searchTerm || null);
                }
            });
        });

        // Search input handler - reload from database
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const searchTerm = this.value.trim();
                
                // Debounce search - wait 300ms after user stops typing
                searchTimeout = setTimeout(function() {
                    // Get current filter
                    const activeTab = document.querySelector('.filter-tab.active');
                    const filter = activeTab ? (activeTab.getAttribute('data-filter') || 'all') : 'all';
                    
                    if (window.loadDiscussions) {
                        window.loadDiscussions(filter !== 'all' ? filter : null, searchTerm || null);
                    }
                }, 300);
            });
        }

        // Initial filter application
        applyFiltersAndSearch();

        // Storage key for discussions (kept for backward compatibility, but we use database now)
        const STORAGE_KEY = 'community_forum_discussions';

        // Start New Discussion Modal
        const newDiscussionModal = document.getElementById('newDiscussionModal');
        const startNewDiscussionBtn = document.getElementById('startNewDiscussionBtn');
        const closeNewDiscussionModalBtn = document.getElementById('closeNewDiscussionModal');
        const cancelNewDiscussionBtn = document.getElementById('cancelNewDiscussionBtn');
        const newDiscussionForm = document.getElementById('newDiscussionForm');
        const discussionsContainer = document.getElementById('discussionsContainer');

        // Reply Modal
        const replyModal = document.getElementById('replyModal');
        const closeReplyModalBtn = document.getElementById('closeReplyModal');
        const cancelReplyBtn = document.getElementById('cancelReplyBtn');
        const replyForm = document.getElementById('replyForm');
        let replyButtons = document.querySelectorAll('.reply-btn');

        // View Thread Modal
        const viewThreadModal = document.getElementById('viewThreadModal');
        const closeViewThreadModalBtn = document.getElementById('closeViewThreadModal');
        const repliesContainer = document.getElementById('repliesContainer');
        const viewThreadButtons = document.querySelectorAll('.btn:not(.reply-btn)');

        // Function to determine category from title
        function determineCategory(title) {
            const titleLower = title.toLowerCase();
            if (titleLower.includes('solar')) return 'solar';
            if (titleLower.includes('hydro')) return 'hydro';
            if (titleLower.includes('wind')) return 'wind';
            if (titleLower.includes('project') || titleLower.includes('crowdfund') || titleLower.includes('fundrais')) return 'projects';
            return 'all';
        }

        // Function to add discussion to page
        function addDiscussionToPage(discussion) {
            if (!discussionsContainer) return;

            // Check if discussion already exists on page
            const existing = document.querySelector(`[data-discussion-id="${discussion.id}"]`);
            if (existing) {
                // Update existing discussion
                const replyCountEl = existing.querySelector('.reply-count');
                if (replyCountEl) {
                    replyCountEl.textContent = discussion.reply_count || 0;
                }
                existing.setAttribute('data-replies', discussion.reply_count || 0);
                return;
            }

            const discussionElement = document.createElement('div');
            discussionElement.className = 'discussion';
            discussionElement.setAttribute('data-category', discussion.category || 'all');
            discussionElement.setAttribute('data-replies', discussion.reply_count || 0);
            discussionElement.setAttribute('data-discussion-id', discussion.id);
            
            discussionElement.innerHTML = `
                <div class="title">"${discussion.title}"</div>
                <div class="meta">(<span class="reply-count">${discussion.reply_count || 0}</span> replies)</div>
                <div class="buttons">
                    <div class="btn"><img src="/images/Eye.png">View Thread</div>
                    <div class="btn reply-btn"><img src="/images/Reply.png">Reply</div>
                </div>
            `;

            // Add event listeners to buttons
            const newReplyBtn = discussionElement.querySelector('.reply-btn');
            if (newReplyBtn) {
                newReplyBtn.addEventListener('click', function() {
                    const discussion = this.closest('.discussion');
                    if (discussion) {
                        openReplyModal(discussion);
                    }
                });
            }

            const viewThreadBtn = discussionElement.querySelector('.btn:not(.reply-btn)');
            if (viewThreadBtn) {
                viewThreadBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const discussion = this.closest('.discussion');
                    if (discussion) {
                        openViewThreadModal(discussion);
                    }
                });
            }

            // Insert at the beginning (most recent first)
            discussionsContainer.insertBefore(discussionElement, discussionsContainer.firstChild);

            // Re-query reply buttons to include the new one
            replyButtons = document.querySelectorAll('.reply-btn');
        }

        // Function to load discussions from database
        function loadDiscussions(category = null, searchQuery = null) {
            let url = '/api/forum/posts';
            const params = new URLSearchParams();
            if (category && category !== 'all') {
                params.append('category', category);
            }
            if (searchQuery) {
                params.append('search', searchQuery);
            }
            if (params.toString()) {
                url += '?' + params.toString();
            }
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.posts) {
                        // Clear container
                        if (discussionsContainer) {
                            discussionsContainer.innerHTML = '';
                        }
                        
                        // Add all discussions
                        data.posts.forEach(discussion => {
                            addDiscussionToPage(discussion);
                        });
                        
                        // Re-apply filters
                        applyFiltersAndSearch();
                    } else {
                        console.error('Error loading discussions:', data);
                    }
                })
                .catch(error => {
                    console.error('Error loading discussions:', error);
                    // Fallback to localStorage if database fails
                    const savedDiscussions = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
                    savedDiscussions.forEach(discussion => {
                        const existing = document.querySelector(`[data-discussion-id="${discussion.id}"]`);
                        if (!existing) {
                            addDiscussionToPage(discussion);
                        }
                    });
                });
        }
        
        // Make loadDiscussions accessible globally for filter/search
        window.loadDiscussions = loadDiscussions;

        // Function to open new discussion modal
        function openNewDiscussionModal() {
            console.log('Opening new discussion modal');
            if (newDiscussionModal) {
                newDiscussionModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            } else {
                console.error('newDiscussionModal not found');
            }
        }

        // Function to close new discussion modal
        function closeNewDiscussionModal() {
            if (newDiscussionModal) {
                newDiscussionModal.classList.remove('show');
                document.body.style.overflow = 'auto';
                if (newDiscussionForm) {
                    newDiscussionForm.reset();
                }
            }
        }

        // Function to open reply modal
        function openReplyModal(discussionElement) {
            console.log('Opening reply modal', discussionElement);
            if (replyModal && discussionElement) {
                const title = discussionElement.querySelector('.title')?.textContent || '';
                const replyTitleElement = document.getElementById('replyDiscussionTitle');
                if (replyTitleElement) {
                    replyTitleElement.textContent = title;
                }
                replyModal.setAttribute('data-discussion-id', discussionElement.getAttribute('data-replies') || '');
                replyModal.setAttribute('data-discussion-element', '');
                // Store reference to discussion element
                replyModal._discussionElement = discussionElement;
                replyModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            } else {
                console.error('replyModal or discussionElement not found', replyModal, discussionElement);
            }
        }

        // Function to close reply modal
        function closeReplyModal() {
            if (replyModal) {
                replyModal.classList.remove('show');
                document.body.style.overflow = 'auto';
                if (replyForm) {
                    replyForm.reset();
                }
                replyModal._discussionElement = null;
            }
        }

        // Event listeners for new discussion modal
        if (startNewDiscussionBtn) {
            console.log('Adding click listener to startNewDiscussionBtn');
            startNewDiscussionBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openNewDiscussionModal();
            });
        } else {
            console.error('startNewDiscussionBtn not found');
        }
        if (closeNewDiscussionModalBtn) {
            closeNewDiscussionModalBtn.addEventListener('click', closeNewDiscussionModal);
        }
        if (cancelNewDiscussionBtn) {
            cancelNewDiscussionBtn.addEventListener('click', closeNewDiscussionModal);
        }

        // Event listeners for reply modal
        if (closeReplyModalBtn) {
            closeReplyModalBtn.addEventListener('click', closeReplyModal);
        }
        if (cancelReplyBtn) {
            cancelReplyBtn.addEventListener('click', closeReplyModal);
        }

        // Reply button click handlers
        replyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const discussion = this.closest('.discussion');
                if (discussion) {
                    openReplyModal(discussion);
                }
            });
        });

        // View Thread button click handlers
        function attachViewThreadListeners() {
            const allViewThreadButtons = document.querySelectorAll('.btn:not(.reply-btn)');
            allViewThreadButtons.forEach(button => {
                // Remove existing listeners by cloning
                const newButton = button.cloneNode(true);
                button.parentNode.replaceChild(newButton, button);
                
                newButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const discussion = this.closest('.discussion');
                    if (discussion) {
                        openViewThreadModal(discussion);
                    }
                });
            });
        }

        // Function to open view thread modal
        function openViewThreadModal(discussionElement) {
            if (viewThreadModal && discussionElement) {
                const discussionId = discussionElement.getAttribute('data-discussion-id');
                const title = discussionElement.querySelector('.title')?.textContent || '';
                
                // Set title
                document.getElementById('viewThreadTitle').textContent = title;
                
                // Load and display replies
                displayReplies(discussionId);
                
                viewThreadModal.setAttribute('data-discussion-id', discussionId);
                viewThreadModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }

        // Function to close view thread modal
        function closeViewThreadModal() {
            if (viewThreadModal) {
                viewThreadModal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        }

        // Function to display replies from database
        function displayReplies(discussionId) {
            if (!repliesContainer) return;
            
            // Show loading state
            repliesContainer.innerHTML = '<div class="no-replies">Loading replies...</div>';
            
            // Fetch replies from database
            fetch(`/api/forum/replies?post_id=${discussionId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.replies) {
                        if (data.replies.length === 0) {
                            repliesContainer.innerHTML = '<div class="no-replies">No replies yet. Be the first to reply!</div>';
                            return;
                        }
                        
                        // Display replies
                        repliesContainer.innerHTML = data.replies.map(reply => {
                            const date = new Date(reply.created_at);
                            return `
                                <div class="reply-item">
                                    <div class="reply-header">
                                        <span class="reply-author">${reply.author_name || 'Anonymous'}</span>
                                        <span class="reply-date">${date.toLocaleDateString('en-US', { 
                                            year: 'numeric', 
                                            month: 'short', 
                                            day: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}</span>
                                    </div>
                                    <div class="reply-content">${reply.content}</div>
                                </div>
                            `;
                        }).join('');
                    } else {
                        repliesContainer.innerHTML = '<div class="no-replies">Error loading replies.</div>';
                    }
                })
                .catch(error => {
                    console.error('Error loading replies:', error);
                    repliesContainer.innerHTML = '<div class="no-replies">Error loading replies.</div>';
                });
        }

        // Event listener for close view thread modal
        if (closeViewThreadModalBtn) {
            closeViewThreadModalBtn.addEventListener('click', closeViewThreadModal);
        }

        // New discussion form submission
        if (newDiscussionForm) {
            newDiscussionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const title = document.getElementById('discussionTitle').value.trim();
                const description = document.getElementById('discussionDescription').value.trim();

                if (!title) {
                    alert('Please enter a title');
                    return;
                }

                // Determine category from title
                const category = determineCategory(title);

                // Save to database via API
                fetch('/api/forum/posts', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        title: title,
                        content: description || '',
                        category: category !== 'all' ? category : null
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload discussions from database
                        loadDiscussions();
                        
                        // Show success message
                        alert('Discussion added successfully!');
                        closeNewDiscussionModal();
                    } else {
                        alert('Error: ' + (data.error || 'Failed to create discussion'));
                    }
                })
                .catch(error => {
                    console.error('Error creating discussion:', error);
                    alert('Error creating discussion. Please try again.');
                });
            });
        }

        // Reply form submission
        if (replyForm) {
            replyForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const replyText = document.getElementById('replyText').value.trim();
                const discussionElement = replyModal._discussionElement;

                if (!replyText) {
                    alert('Please enter a reply');
                    return;
                }

                if (discussionElement) {
                    // Get discussion ID
                    const discussionId = discussionElement.getAttribute('data-discussion-id');
                    
                    if (!discussionId) {
                        alert('Error: Discussion ID not found');
                        return;
                    }

                    // Save reply to database via API
                    fetch('/api/forum/replies', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            post_id: parseInt(discussionId),
                            content: replyText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update reply count in the discussion element
                            const replyCountElement = discussionElement.querySelector('.reply-count');
                            if (replyCountElement) {
                                replyCountElement.textContent = data.reply_count || 0;
                            }
                            discussionElement.setAttribute('data-replies', data.reply_count || 0);
                            
                            // If view thread modal is open, reload replies
                            if (viewThreadModal && viewThreadModal.classList.contains('show')) {
                                const modalDiscussionId = viewThreadModal.getAttribute('data-discussion-id');
                                if (modalDiscussionId === discussionId) {
                                    displayReplies(discussionId);
                                }
                            }
                            
                            alert('Reply added successfully!');
                            closeReplyModal();
                        } else {
                            alert('Error: ' + (data.error || 'Failed to create reply'));
                        }
                    })
                    .catch(error => {
                        console.error('Error creating reply:', error);
                        alert('Error creating reply. Please try again.');
                    });
                }
            });
        }

        // Load discussions on page load
        loadDiscussions();

        // Attach view thread listeners to existing buttons
        attachViewThreadListeners();

        // Close modals when clicking outside
        if (newDiscussionModal) {
            newDiscussionModal.addEventListener('click', function(e) {
                if (e.target === newDiscussionModal) {
                    closeNewDiscussionModal();
                }
            });
        }

        if (replyModal) {
            replyModal.addEventListener('click', function(e) {
                if (e.target === replyModal) {
                    closeReplyModal();
                }
            });
        }

        if (viewThreadModal) {
            viewThreadModal.addEventListener('click', function(e) {
                if (e.target === viewThreadModal) {
                    closeViewThreadModal();
                }
            });
        }

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (newDiscussionModal && newDiscussionModal.classList.contains('show')) {
                    closeNewDiscussionModal();
                }
                if (replyModal && replyModal.classList.contains('show')) {
                    closeReplyModal();
                }
                if (viewThreadModal && viewThreadModal.classList.contains('show')) {
                    closeViewThreadModal();
                }
            }
        });
    });
    </script>
</div>
</body>
</html>

