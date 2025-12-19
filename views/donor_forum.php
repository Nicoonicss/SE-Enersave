<?php
$pageTitle = 'Forum';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Donor';
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
        color: black;
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
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    .forum-modal.show {
        display: flex !important;
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
        font-weight: 600;
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
        background: #27ae60;
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
        background: #1e8449;
    }

    .discussion-title-display {
        background: #f5f5f5;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 600;
        color: #333;
        font-size: 16px;
    }

    .replies-container {
        margin-top: 20px;
    }

    .reply-item {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        border-left: 3px solid #27ae60;
    }

    .reply-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
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
        line-height: 1.6;
        font-size: 14px;
    }

    .no-replies {
        text-align: center;
        color: #999;
        padding: 40px 20px;
        font-style: italic;
    }
</style>
</head>

<body>

 <div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/donorHomeUI" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/donorHomeUI" id="homeDirect">Home</a>
        <a href="/donorCrowdfundingUI" id="projectDirect">Projects</a>
        <a href="/donorCommunityUI" style="color: green;">Community</a>
    </div>

    <div class="nav-right">
        Donor: <?php echo htmlspecialchars($username); ?>
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
    <button class="new-topic-btn">Start New Topic 🎉</button>
</div>

    <div id="discussionsContainer">
        <div class="discussion" data-category="solar">
            <div class="title">"Best Solar Panel for Home Use?"</div>
            <div class="meta">(<span class="reply-count">12</span> replies)</div>
            <div class="buttons">
                <div class="btn view-thread-btn"><img src="/images/Eye.png">View Thread</div>
                <div class="btn reply-btn"><img src="/images/Reply.png">Reply</div>
            </div>
        </div>

        <div class="discussion" data-category="projects">
            <div class="title">"How to Apply for CrowdFunding?"</div>
            <div class="meta">(<span class="reply-count">8</span> replies)</div>
            <div class="buttons">
                <div class="btn view-thread-btn"><img src="/images/Eye.png">View Thread</div>
                <div class="btn reply-btn"><img src="/images/Reply.png">Reply</div>
            </div>
        </div>

        <div class="discussion" data-category="wind">
            <div class="title">"Tips for Maintaining Wind Turbines?"</div>
            <div class="meta">(<span class="reply-count">4</span> replies)</div>
            <div class="buttons">
                <div class="btn view-thread-btn"><img src="/images/Eye.png">View Thread</div>
                <div class="btn reply-btn"><img src="/images/Reply.png">Reply</div>
            </div>
        </div>
    </div>

    <footer>
        Community Guidelines 
        <span class="report">Report Post 🚩</span>
    </footer>

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

    <script src="/navigationDonor.js"></script>
    <script src="/JavaScripts/avatarDropdown.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const STORAGE_KEY = 'donor_forum_discussions';
            const REPLIES_KEY = 'donor_forum_replies';
            const currentUsername = '<?php echo addslashes(htmlspecialchars($username, ENT_QUOTES, 'UTF-8')); ?>';
            
            // Search and Filter Elements
            const searchInput = document.getElementById('searchInput');
            const tabs = document.querySelectorAll('.tab');
            const container = document.getElementById('discussionsContainer');
            
            let currentFilter = 'all';
            let currentSearch = '';
            
            // Modal Elements
            const newDiscussionModal = document.getElementById('newDiscussionModal');
            const startNewTopicBtn = document.querySelector('.new-topic-btn');
            const closeNewDiscussionModalBtn = document.getElementById('closeNewDiscussionModal');
            const cancelNewDiscussionBtn = document.getElementById('cancelNewDiscussionBtn');
            const newDiscussionForm = document.getElementById('newDiscussionForm');
            
            const replyModal = document.getElementById('replyModal');
            const closeReplyModalBtn = document.getElementById('closeReplyModal');
            const cancelReplyBtn = document.getElementById('cancelReplyBtn');
            const replyForm = document.getElementById('replyForm');
            const replyDiscussionTitle = document.getElementById('replyDiscussionTitle');
            
            const viewThreadModal = document.getElementById('viewThreadModal');
            const closeViewThreadModalBtn = document.getElementById('closeViewThreadModal');
            const viewThreadTitle = document.getElementById('viewThreadTitle');
            const repliesContainer = document.getElementById('repliesContainer');
            
            let currentDiscussionId = null;
            
            // Get all discussions
            function getAllDiscussions() {
                return document.querySelectorAll('.discussion');
            }
            
            // Filter discussions based on category and search
            function filterDiscussions() {
                const discussions = getAllDiscussions();
                discussions.forEach(discussion => {
                    const category = discussion.getAttribute('data-category') || 'all';
                    const title = discussion.querySelector('.title').textContent.toLowerCase();
                    const meta = discussion.querySelector('.meta').textContent.toLowerCase();
                    const searchText = currentSearch.toLowerCase();
                    
                    const categoryMatch = currentFilter === 'all' || category === currentFilter;
                    const searchMatch = searchText === '' || title.includes(searchText) || meta.includes(searchText);
                    
                    discussion.style.display = (categoryMatch && searchMatch) ? 'block' : 'none';
                });
            }
            
            // Tab click handler
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.getAttribute('data-filter');
                    // Reload from database with filter
                    const searchTerm = searchInput ? searchInput.value.trim() : '';
                    if (window.loadDiscussions) {
                        window.loadDiscussions(currentFilter !== 'all' ? currentFilter : null, searchTerm || null);
                    }
                });
            });
            
            // Search input handler - reload from database
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function(e) {
                    clearTimeout(searchTimeout);
                    currentSearch = e.target.value;
                    
                    // Debounce search
                    searchTimeout = setTimeout(function() {
                        const activeTab = document.querySelector('.filter-tab.active');
                        const filter = activeTab ? (activeTab.getAttribute('data-filter') || 'all') : 'all';
                        
                        if (window.loadDiscussions) {
                            window.loadDiscussions(filter !== 'all' ? filter : null, currentSearch || null);
                        }
                    }, 300);
                });
            }
            
            // Determine category from title
            function determineCategory(title) {
                const titleLower = title.toLowerCase();
                if (titleLower.includes('solar')) return 'solar';
                if (titleLower.includes('hydro')) return 'hydro';
                if (titleLower.includes('wind')) return 'wind';
                if (titleLower.includes('project') || titleLower.includes('crowdfund') || titleLower.includes('fundrais')) return 'projects';
                return 'all';
            }
            
            // Add discussion to page
            function addDiscussionToPage(discussion) {
                if (!container) return;
                
                // Check if discussion already exists
                const existing = document.querySelector(`[data-discussion-id="${discussion.id}"]`);
                if (existing) {
                    // Update existing
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
                discussionElement.setAttribute('data-discussion-id', discussion.id);
                discussionElement.setAttribute('data-replies', discussion.reply_count || 0);
                
                discussionElement.innerHTML = `
                    <div class="title">"${discussion.title}"</div>
                    <div class="meta">(<span class="reply-count">${discussion.reply_count || 0}</span> replies)</div>
                    <div class="buttons">
                        <div class="btn view-thread-btn"><img src="/images/Eye.png">View Thread</div>
                        <div class="btn reply-btn"><img src="/images/Reply.png">Reply</div>
                    </div>
                `;
                
                // Add event listeners
                discussionElement.querySelector('.view-thread-btn').addEventListener('click', function() {
                    openViewThreadModal(discussionElement);
                });
                
                discussionElement.querySelector('.reply-btn').addEventListener('click', function() {
                    openReplyModal(discussionElement);
                });
                
                container.insertBefore(discussionElement, container.firstChild);
            }
            
            // Load discussions from database
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
                            if (container) {
                                container.innerHTML = '';
                            }
                            data.posts.forEach(discussion => {
                                addDiscussionToPage(discussion);
                            });
                            filterDiscussions();
                        }
                    })
                    .catch(error => {
                        console.error('Error loading discussions:', error);
                    });
            }
            
            window.loadDiscussions = loadDiscussions;
            
            // Update reply count
            function updateReplyCount(discussionId, count) {
                const discussion = document.querySelector(`[data-discussion-id="${discussionId}"]`);
                if (discussion) {
                    const replyCountSpan = discussion.querySelector('.reply-count');
                    if (replyCountSpan) {
                        replyCountSpan.textContent = count;
                    }
                    const meta = discussion.querySelector('.meta');
                    if (meta) {
                        meta.innerHTML = `(<span class="reply-count">${count}</span> replies)`;
                    }
                }
            }
            
            // Open New Discussion Modal
            function openNewDiscussionModal() {
                if (newDiscussionModal) {
                    newDiscussionModal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            function closeNewDiscussionModal() {
                if (newDiscussionModal) {
                    newDiscussionModal.classList.remove('show');
                    document.body.style.overflow = 'auto';
                    if (newDiscussionForm) {
                        newDiscussionForm.reset();
                    }
                }
            }
            
            // Open Reply Modal
            function openReplyModal(discussionElement) {
                const title = discussionElement.querySelector('.title').textContent.replace(/"/g, '');
                const discussionId = discussionElement.getAttribute('data-discussion-id');
                
                currentDiscussionId = discussionId;
                if (replyDiscussionTitle) {
                    replyDiscussionTitle.textContent = `"${title}"`;
                }
                if (replyModal) {
                    replyModal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            function closeReplyModal() {
                if (replyModal) {
                    replyModal.classList.remove('show');
                    document.body.style.overflow = 'auto';
                    if (replyForm) {
                        replyForm.reset();
                    }
                    currentDiscussionId = null;
                }
            }
            
            // Open View Thread Modal
            function openViewThreadModal(discussionElement) {
                const title = discussionElement.querySelector('.title').textContent.replace(/"/g, '');
                const discussionId = discussionElement.getAttribute('data-discussion-id');
                
                currentDiscussionId = discussionId;
                if (viewThreadTitle) {
                    viewThreadTitle.textContent = `"${title}"`;
                }
                
                // Load replies
                loadReplies(discussionId);
                
                if (viewThreadModal) {
                    viewThreadModal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            function closeViewThreadModal() {
                if (viewThreadModal) {
                    viewThreadModal.classList.remove('show');
                    document.body.style.overflow = 'auto';
                    currentDiscussionId = null;
                }
            }
            
            // Load replies for a discussion from database
            function loadReplies(discussionId) {
                if (!repliesContainer) return;
                
                repliesContainer.innerHTML = '<div class="no-replies">Loading replies...</div>';
                
                fetch(`/api/forum/replies?post_id=${discussionId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.replies) {
                            if (data.replies.length === 0) {
                                repliesContainer.innerHTML = '<div class="no-replies">No replies yet. Be the first to reply!</div>';
                                return;
                            }
                            
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
            
            // Save reply to database
            function saveReply(discussionId, content) {
                fetch('/api/forum/replies', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        post_id: parseInt(discussionId),
                        content: content
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update reply count
                        updateReplyCount(discussionId, data.reply_count || 0);
                        
                        // Reload replies if view thread modal is open
                        if (viewThreadModal && viewThreadModal.classList.contains('show')) {
                            loadReplies(discussionId);
                        }
                        
                        alert('Reply added successfully!');
                    } else {
                        alert('Error: ' + (data.error || 'Failed to create reply'));
                    }
                })
                .catch(error => {
                    console.error('Error creating reply:', error);
                    alert('Error creating reply. Please try again.');
                });
            }
            
            // Event Listeners
            if (startNewTopicBtn) {
                startNewTopicBtn.addEventListener('click', openNewDiscussionModal);
            }
            
            if (closeNewDiscussionModalBtn) {
                closeNewDiscussionModalBtn.addEventListener('click', closeNewDiscussionModal);
            }
            
            if (cancelNewDiscussionBtn) {
                cancelNewDiscussionBtn.addEventListener('click', closeNewDiscussionModal);
            }
            
            if (newDiscussionForm) {
                newDiscussionForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const title = document.getElementById('discussionTitle').value.trim();
                    const description = document.getElementById('discussionDescription').value.trim();
                    
                    if (!title) {
                        alert('Please enter a discussion title');
                        return;
                    }
                    
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
            
            if (closeReplyModalBtn) {
                closeReplyModalBtn.addEventListener('click', closeReplyModal);
            }
            
            if (cancelReplyBtn) {
                cancelReplyBtn.addEventListener('click', closeReplyModal);
            }
            
            if (replyForm) {
                replyForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const replyText = document.getElementById('replyText').value.trim();
                    
                    if (!replyText) {
                        alert('Please enter a reply');
                        return;
                    }
                    
                    if (!currentDiscussionId) {
                        alert('Discussion not found');
                        return;
                    }
                    
                    saveReply(currentDiscussionId, replyText);
                    closeReplyModal();
                });
            }
            
            if (closeViewThreadModalBtn) {
                closeViewThreadModalBtn.addEventListener('click', closeViewThreadModal);
            }
            
            // Add event listeners to existing buttons using event delegation
            document.addEventListener('click', function(e) {
                const viewThreadBtn = e.target.closest('.view-thread-btn');
                const replyBtn = e.target.closest('.reply-btn');
                
                if (viewThreadBtn) {
                    const discussion = viewThreadBtn.closest('.discussion');
                    if (discussion) {
                        openViewThreadModal(discussion);
                    }
                }
                
                if (replyBtn) {
                    const discussion = replyBtn.closest('.discussion');
                    if (discussion) {
                        openReplyModal(discussion);
                    }
                }
            });
            
            // Add data-discussion-id to existing discussions
            getAllDiscussions().forEach((discussion, index) => {
                const title = discussion.querySelector('.title').textContent.replace(/"/g, '');
                const existingId = discussion.getAttribute('data-discussion-id');
                
                if (!existingId) {
                    // Create ID for existing discussions
                    const discussionId = `discussion-${Date.now()}-${index}`;
                    discussion.setAttribute('data-discussion-id', discussionId);
                    
                    // Save to localStorage if not exists
                    const discussions = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
                    const exists = discussions.find(d => d.title === title);
                    if (!exists) {
                        const meta = discussion.querySelector('.meta').textContent;
                        const replyCount = parseInt(meta.match(/\d+/)?.[0] || '0');
                        discussions.push({
                            id: discussionId,
                            title: title,
                            description: '',
                            category: discussion.getAttribute('data-category') || 'all',
                            replies: replyCount,
                            author: 'Community',
                            date: new Date().toLocaleDateString()
                        });
                        localStorage.setItem(STORAGE_KEY, JSON.stringify(discussions));
                    }
                }
            });
            
            // Load discussions from localStorage
            function loadDiscussionsFromStorage() {
                // Load from database instead
                if (window.loadDiscussions) {
                    window.loadDiscussions();
                }
            }
            
            function loadDiscussionsFromStorageOld() {
                const storedDiscussions = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
                const existingIds = Array.from(getAllDiscussions()).map(d => d.getAttribute('data-discussion-id'));
                
                storedDiscussions.forEach(discussion => {
                    if (!existingIds.includes(discussion.id)) {
                        addDiscussionToPage(discussion);
                    }
                });
                
                filterDiscussions();
            }
            
            // Close modals when clicking outside
            [newDiscussionModal, replyModal, viewThreadModal].forEach(modal => {
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            if (modal === newDiscussionModal) closeNewDiscussionModal();
                            if (modal === replyModal) closeReplyModal();
                            if (modal === viewThreadModal) closeViewThreadModal();
                        }
                    });
                }
            });
            
            // Close modals with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (newDiscussionModal && newDiscussionModal.classList.contains('show')) closeNewDiscussionModal();
                    if (replyModal && replyModal.classList.contains('show')) closeReplyModal();
                    if (viewThreadModal && viewThreadModal.classList.contains('show')) closeViewThreadModal();
                }
            });
            
            // Initialize
            loadDiscussionsFromStorage();
        });
    </script>
</div>
</body>
</html>

