<?php
$pageTitle = 'Crowdfunding Projects';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Donor';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Crowdfunding Projects</title>
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

  .main {
    display: flex;
    gap: 30px;
  }
  .projects {
    flex: 1;
  }

  h2 {
  font-size: 22px;
  font-weight: 700;
  margin-bottom: 4px;
  margin-left: 30px;
  margin-top: 5px;  /* force it */
}

.projects {
  flex: 1;
  padding-top: 20px; /* moves everything down */
}

  p.subtitle {
    margin-top: 0px;
    margin-bottom: 25px;
    color: #666;
    font-size: 14px;
    margin-left: 30px;
  }
  .project-card {
    background: #f8f8f8;
    border-radius: 15px;
    margin-left: 30px;
    margin-bottom: 25px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
  }
  .project-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    display: block;
    border-radius: 15px 15px 0 0;
  }
  .project-content {
    padding: 15px 20px 20px;
  }
  .project-title {
    font-weight: 700;
    margin-bottom: 6px;
    font-size: 16px;
  }
  .project-raised {
    font-size: 13px;
    margin: 0 0 4px 0;
  }
  .progress-bar-container {
    background: #e6e6e6;
    border-radius: 10px;
    overflow: hidden;
    height: 12px;
    margin-bottom: 12px;
  }
  .progress-bar {
    height: 12px;
    background: #27ae60;
    width: 80%; 
    transition: width 0.5s ease;
  }
  .progress-text {
    text-align: right;
    font-size: 12px;
    color: #444;
    margin-top: -43px;
    margin-bottom: 30px;
  }
  .btn-group {
    display: flex;
    gap: 10px;
  }
  .btn-donate {
    background: #27ae60;
    color: black;
    padding: 8px 18px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
  }
  .btn-donate:hover {
    background: #1e8449;
  }
  .btn-details {
    background: #bbb;
    color: #222;
    border: none;
    padding: 8px 14px;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 700;
    font-size: 14px;
  }
  .btn-details:hover {
    background: #999;
  }
  .btn-donate svg {
    fill: white;
  }

  .summary {
    width: 280px;
    background: #f0f0f0;
    border-radius: 20px;
    padding: 20px 25px;
    box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
    font-size: 14px;
    line-height: 1.4;
    margin-top: 93px;
  }
  .summary h3 {
    margin-top: 0;
    margin-bottom: 15px;
    font-weight: 700;
  }
  .summary-item {
    background: white;
    border-radius: 12px;
    padding: 12px 15px;
    margin-bottom: 15px;
    box-shadow: 0 1px 6px rgb(0 0 0 / 0.1);
  }
  .summary-item strong {
    display: block;
    margin-bottom: 4px;
    font-weight: 700;
  }
  .summary-item .amount {
    color: #27ae60;
    font-weight: 700;
    font-size: 15px;
  }
  .summary-item.pending .amount {
    color: #b94a48;
  }
  .summary-item .status {
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 12px;
    float: right;
  }
  .summary-item .status.confirmed {
    background: #d4f8d4;
    color: #27ae60;
  }
  .summary-item.pending .status {
    background: #f9edc9;
    color: #b89c49;
  }
  .start-fundraiser-btn {
    background: #27ae60;
    color: black;
    font-weight: 700;
    padding: 10px 22px;
    border-radius: 30px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    margin-bottom: 30px;
    float: right;
  }
  .start-fundraiser-btn:hover {
    background: #1e8449;
  }

  /* Fundraiser Modal Styles */
  .fundraiser-modal {
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

  .fundraiser-modal.show {
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
  .form-group input[type="number"],
  .form-group textarea,
  .form-group input[type="file"] {
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

  .form-group input[type="file"] {
    padding: 8px;
    cursor: pointer;
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

  .btn-add {
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

  .btn-add:hover {
    background: #1e8449;
  }

  .image-preview {
    margin-top: 10px;
    max-width: 100%;
    max-height: 200px;
    border-radius: 8px;
    display: none;
  }

  .image-preview.show {
    display: block;
  }

  /* Crowdfunding Table Styles */
  .crowdfunding-table-container {
    margin-top: 30px;
    margin-left: 30px;
    margin-right: 30px;
  }

  .crowdfunding-table-container h3 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 15px;
  }

  .crowdfunding-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .crowdfunding-table thead {
    background: #f8f8f8;
  }

  .crowdfunding-table th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 700;
    font-size: 14px;
    color: #333;
    border-bottom: 2px solid #e0e0e0;
  }

  .crowdfunding-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #f0f0f0;
    font-size: 14px;
  }

  .crowdfunding-table tbody tr:hover {
    background: #f8f8f8;
  }

  .crowdfunding-table tbody tr:last-child td {
    border-bottom: none;
  }

  .table-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
  }

  .table-amount {
    color: #27ae60;
    font-weight: 700;
  }

  /* Project Details Modal Styles */
  .project-modal {
    display: none;
    position: fixed;
    z-index: 10001;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s ease;
  }

  .project-modal.show {
    display: flex !important;
    align-items: center;
    justify-content: center;
  }

  .project-modal .modal-content {
    background-color: white;
    margin: auto;
    padding: 30px;
    border-radius: 12px;
    max-width: 600px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    animation: slideUp 0.3s ease;
  }

  @keyframes slideUp {
    from {
      transform: translateY(50px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .project-modal .modal-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .modal-project-image {
    width: 100%;
    max-height: 300px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 20px;
  }

  .modal-project-description {
    line-height: 1.6;
    color: #555;
    font-size: 15px;
    margin: 0;
  }

  .modal-project-initiator {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e0e0e0;
  }

  .modal-project-initiator-label {
    font-weight: 600;
    color: #666;
    font-size: 14px;
    margin-bottom: 5px;
  }

  .modal-project-initiator-name {
    font-size: 16px;
    color: #333;
    font-weight: 500;
  }
</style>
</head>
<body>

  <div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/donorHomeUI" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/donorHomeUI" id="homeDirect">Home</a>
        <a href="/donorCrowdfundingUI" style="color: green;">Projects</a>
        <a href="/donorCommunityUI" id="forumDirect">Community</a>
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

  <main class="main">
    <section class="projects">
      <h2>CROWDFUNDING PROJECTS</h2>
      <p class="subtitle">Support sustainable energy initiatives.</p>

      <article class="project-card">
        <img class="project-image" src="/images/crowdfundingPic1.png" alt="Solar for School" />
        <div class="project-content">
          <div class="project-title">Solar for School</div>
          <p class="project-raised">Raised<br><strong>₱80,000</strong> / 100,000</p>
          <div class="progress-bar-container" aria-label="Progress toward funding goal">
            <div class="progress-bar" style="width: 80%;"></div>
          </div>
          <div class="progress-text">80%</div>
          <div class="btn-group">
            <button class="btn-donate" aria-label="Donate to Solar for School">
              Donate
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M2 6h20v12H2V6zm2 2v8h16V8H4zm8 1a3 3 0 110 6 3 3 0 010-6z"/>
              </svg>
            </button>
            <button class="btn-details">View Details</button>
          </div>
        </div>
      </article>

      <article class="project-card">
        <img class="project-image" src="/images/crowdfundingPic2.png" alt="Hydro for Hope" />
        <div class="project-content">
          <div class="project-title">Hydro for Hope</div>
          <p class="project-raised">Raised<br><strong>₱20,000</strong> / 60,000</p>
          <div class="progress-bar-container" aria-label="Progress toward funding goal">
            <div class="progress-bar" style="width: 33%;"></div>
          </div>
          <div class="progress-text">33%</div>
          <div class="btn-group">
            <button class="btn-donate" aria-label="Donate to Hydro for Hope">
              Donate
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M2 6h20v12H2V6zm2 2v8h16V8H4zm8 1a3 3 0 110 6 3 3 0 010-6z"/>
              </svg>
            </button>
            <button class="btn-details">View Details</button>
          </div>
        </div>
      </article>
    </section>

    <aside class="summary">
      <button type="button" class="start-fundraiser-btn" id="startFundraiserBtn" onclick="openFundraiserModal(event)">Start a Fundraiser</button>

      <h3>My Donation Summary</h3>

      <div class="summary-item">
        <strong>Solar for School</strong>
        <span class="amount">₱500</span>
        <span class="status confirmed">Confirmed</span>
      </div>

      <div class="summary-item">
        <strong>Community Wind Turbine</strong>
        <span class="amount">₱1,200</span>
        <span class="status confirmed">Confirmed</span>
      </div>

      <div class="summary-item pending">
        <strong>Clean Water Pumps</strong>
        <span class="amount">₱250</span>
        <span class="status pending">Pending</span>
      </div>
    </aside>
  </main>

  <!-- Project Details Modal -->
  <div id="projectDetailsModal" class="project-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="modalProjectName">Project Name</h2>
        <button class="close-modal" id="closeProjectModal">&times;</button>
      </div>
      <div class="modal-body">
        <img id="modalProjectImage" class="modal-project-image" src="" alt="Project Image" style="display: none;">
        <p class="modal-project-description" id="modalProjectDescription">Project description will appear here.</p>
        <div class="modal-project-initiator">
          <div class="modal-project-initiator-label">Project Initiator:</div>
          <div class="modal-project-initiator-name" id="modalProjectInitiator">Loading...</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Fundraiser Modal -->
  <div id="fundraiserModal" class="fundraiser-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Start a Fundraiser</h2>
        <button class="close-modal" id="closeFundraiserModal">&times;</button>
      </div>
      <form id="fundraiserForm">
        <div class="form-group">
          <label for="fundraiserImage" class="required">Upload Image</label>
          <input type="file" id="fundraiserImage" accept="image/*" required>
          <img id="imagePreview" class="image-preview" alt="Preview">
        </div>
        <div class="form-group">
          <label for="fundraiserName" class="required">Crowdfunding Name</label>
          <input type="text" id="fundraiserName" required placeholder="Enter crowdfunding name">
        </div>
        <div class="form-group">
          <label for="fundraiserDescription" class="optional">Description</label>
          <textarea id="fundraiserDescription" placeholder="Enter description (optional)"></textarea>
        </div>
        <div class="form-group">
          <label for="fundraiserAmount" class="required">Target Amount</label>
          <input type="number" id="fundraiserAmount" required placeholder="Enter target amount" min="1">
        </div>
        <div class="form-actions">
          <button type="button" class="btn-cancel" id="cancelFundraiserBtn">Cancel</button>
          <button type="submit" class="btn-add">Add Crowdfunding Project</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Crowdfunding Table -->
  <div class="crowdfunding-table-container" id="crowdfundingTableContainer" style="display: none;">
    <h3>My Crowdfunding Projects</h3>
    <table class="crowdfunding-table" id="crowdfundingTable">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Description</th>
          <th>Target Amount</th>
          <th>Date Created</th>
        </tr>
      </thead>
      <tbody id="crowdfundingTableBody">
        <!-- Crowdfunding projects will be added here -->
      </tbody>
    </table>
  </div>

<script>
  // Define function immediately - before DOM is ready
  function openFundraiserModal(e) {
    console.log('openFundraiserModal called', e);
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    const modal = document.getElementById('fundraiserModal');
    console.log('Modal element:', modal);
    if (modal) {
      console.log('Adding show class to modal');
      modal.classList.add('show');
      document.body.style.overflow = 'hidden';
      console.log('Modal classes:', modal.className);
      console.log('Modal display style:', window.getComputedStyle(modal).display);
    } else {
      console.error('Modal not found!');
    }
  }
  
  // Also attach to window for safety
  window.openFundraiserModal = openFundraiserModal;
</script>
<script src="/navigationDonor.js"></script>
<script src="/JavaScripts/avatarDropdown.js"></script>
<script>

  // Wait for DOM to be fully loaded
  document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing fundraiser modal...');
    
    // Modal elements
    const fundraiserModal = document.getElementById('fundraiserModal');
    const startFundraiserBtn = document.getElementById('startFundraiserBtn');
    const closeFundraiserModalBtn = document.getElementById('closeFundraiserModal');
    const cancelFundraiserBtn = document.getElementById('cancelFundraiserBtn');
    const fundraiserForm = document.getElementById('fundraiserForm');
    const imageInput = document.getElementById('fundraiserImage');
    const imagePreview = document.getElementById('imagePreview');
    const crowdfundingTableContainer = document.getElementById('crowdfundingTableContainer');
    const crowdfundingTableBody = document.getElementById('crowdfundingTableBody');

    // Check if elements exist
    console.log('fundraiserModal:', fundraiserModal);
    console.log('startFundraiserBtn:', startFundraiserBtn);
    
    if (!fundraiserModal) {
      console.error('fundraiserModal not found');
    }
    if (!startFundraiserBtn) {
      console.error('startFundraiserBtn not found');
    }

    // Storage key
    const STORAGE_KEY = 'donor_crowdfunding_projects';

    // Function to close modal
    function closeFundraiserModal() {
      if (fundraiserModal) {
        fundraiserModal.classList.remove('show');
        document.body.style.overflow = 'auto';
        if (fundraiserForm) {
          fundraiserForm.reset();
        }
        if (imagePreview) {
          imagePreview.classList.remove('show');
          imagePreview.src = '';
        }
      }
    }

    // Image preview
    if (imageInput && imagePreview) {
      imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.add('show');
          };
          reader.readAsDataURL(file);
        }
      });
    }

    // Function to add project to table
    function addProjectToTable(project) {
      if (!crowdfundingTableBody || !crowdfundingTableContainer) return;
      const row = document.createElement('tr');
      const projectName = project.name || project.title || 'Untitled';
      const projectImage = project.image || '';
      row.innerHTML = `
        <td><img src="${projectImage}" alt="${projectName}" class="table-image"></td>
        <td><strong>${projectName}</strong></td>
        <td>${project.description || ''}</td>
        <td class="table-amount">₱${(project.amount || 0).toLocaleString()}</td>
        <td>${project.dateCreated || ''}</td>
      `;
      crowdfundingTableBody.appendChild(row);
      crowdfundingTableContainer.style.display = 'block';
    }

    // Function to add project to donor_projects.php main section
    function addProjectToDonorProjects(project) {
      const projectsSection = document.querySelector('.projects');
      if (!projectsSection) return;

      // Create project card
      const projectCard = document.createElement('article');
      projectCard.className = 'project-card';
      projectCard.setAttribute('data-project-id', project.id);
      const projectName = project.name || project.title || 'Untitled';
      const projectImage = project.image || '';
      const projectRaised = project.raised || 0;
      const projectAmount = project.amount || 0;
      const projectProgress = project.progress || 0;
      projectCard.innerHTML = `
        <img class="project-image" src="${projectImage}" alt="${projectName}" />
        <div class="project-content">
          <div class="project-title">${projectName}</div>
          <p class="project-raised">Raised<br><strong>₱${projectRaised.toLocaleString()}</strong> / ${projectAmount.toLocaleString()}</p>
          <div class="progress-bar-container" aria-label="Progress toward funding goal">
            <div class="progress-bar" style="width: ${projectProgress}%;"></div>
          </div>
          <div class="progress-text">${projectProgress}%</div>
          <div class="btn-group">
            <button class="btn-donate" aria-label="Donate to ${projectName}">
              Donate
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                <path d="M2 6h20v12H2V6zm2 2v8h16V8H4zm8 1a3 3 0 110 6 3 3 0 010-6z"/>
              </svg>
            </button>
            <button class="btn-details">View Details</button>
          </div>
        </div>
      `;

      // Append to projects section
      projectsSection.appendChild(projectCard);
    }

    // Form submission
    if (fundraiserForm) {
      fundraiserForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const name = document.getElementById('fundraiserName').value.trim();
        const description = document.getElementById('fundraiserDescription').value.trim();
        const amount = document.getElementById('fundraiserAmount').value;
        const imageFile = imageInput ? imageInput.files[0] : null;

        if (!name || !amount || !imageFile) {
          alert('Please fill in all required fields');
          return;
        }

        // Read image as base64
        const reader = new FileReader();
        reader.onload = function(e) {
          const imageData = e.target.result;

          // Get current username
          const currentUsername = '<?php echo addslashes(htmlspecialchars($username, ENT_QUOTES, 'UTF-8')); ?>';
          
          // Prepare project data for API
          const projectData = {
            title: name,
            description: description || 'No description provided',
            goal_amount: parseFloat(amount),
            image: imageData
          };

          // Save to database via API
          fetch('/api/projects', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(projectData)
          })
          .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
              return response.json().then(err => {
                throw new Error(err.error || 'Server error');
              });
            }
            return response.json();
          })
          .then(data => {
            console.log('Response data:', data);
            if (data.success) {
              // Create project object for display
              const newProject = {
                id: data.id.toString(),
                name: name,
                description: description || 'No description provided',
                amount: parseFloat(amount),
                image: imageData,
                initiator: currentUsername || 'Donor',
                dateCreated: new Date().toLocaleDateString('en-US', { 
                  year: 'numeric', 
                  month: 'short', 
                  day: 'numeric' 
                }),
                raised: 0,
                progress: 0
              };

              // Also save to localStorage for backward compatibility (can be removed later)
              let projects = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
              projects.push(newProject);
              localStorage.setItem(STORAGE_KEY, JSON.stringify(projects));

              // Add to table
              addProjectToTable(newProject);

              // Add to donor_projects.php page
              addProjectToDonorProjects(newProject);

              // Close modal
              closeFundraiserModal();

              // Show success message
              alert('Crowdfunding project added successfully! Saved to database.');
            } else {
              alert('Error: ' + (data.error || 'Failed to create project'));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Error creating project: ' + error.message + '. Check browser console for details.');
          });
        };
        reader.readAsDataURL(imageFile);
      });
    }

    // Load existing projects from database
    function loadExistingProjects() {
      // First, load from database
      fetch('/api/projects')
        .then(response => response.json())
        .then(data => {
          if (data.success && data.projects) {
            data.projects.forEach(project => {
              // Check if project already exists on page (by ID)
              const existingProject = document.querySelector(`[data-project-id="${project.id}"]`);
              if (!existingProject) {
                addProjectToTable(project);
                addProjectToDonorProjects(project);
              }
            });
          }
        })
        .catch(error => {
          console.error('Error loading projects from database:', error);
          // Fallback to localStorage if database fails
          const projects = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
          if (projects.length > 0) {
            projects.forEach(project => {
              const existingProject = document.querySelector(`[data-project-id="${project.id}"]`);
              if (!existingProject) {
                addProjectToTable(project);
                addProjectToDonorProjects(project);
              }
            });
          }
        });
    }

    // Event listeners
    if (startFundraiserBtn) {
      console.log('Adding click listener to button');
      startFundraiserBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Button clicked, opening modal');
        if (window.openFundraiserModal) {
          window.openFundraiserModal(e);
        } else {
          // Fallback: directly open modal
          if (fundraiserModal) {
            fundraiserModal.classList.add('show');
            document.body.style.overflow = 'hidden';
          }
        }
      });
    } else {
      console.error('startFundraiserBtn not found!');
    }
    if (closeFundraiserModalBtn) {
      closeFundraiserModalBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeFundraiserModal();
      });
    }
    if (cancelFundraiserBtn) {
      cancelFundraiserBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeFundraiserModal();
      });
    }

    // Close modal when clicking outside
    if (fundraiserModal) {
      fundraiserModal.addEventListener('click', function(e) {
        if (e.target === fundraiserModal) {
          closeFundraiserModal();
        }
      });
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && fundraiserModal && fundraiserModal.classList.contains('show')) {
        closeFundraiserModal();
      }
    });

    // Load existing projects on page load
    loadExistingProjects();
  });

  // Project Details Modal Functionality
  document.addEventListener('DOMContentLoaded', function() {
    const projectModal = document.getElementById('projectDetailsModal');
    const closeProjectModalBtn = document.getElementById('closeProjectModal');
    
    // Project data for hardcoded projects
    const projectData = {
      'Solar for School': {
        description: 'This initiative aims to install solar panels in local schools to provide clean, renewable energy and reduce electricity costs. The project will benefit multiple schools in the community, providing them with sustainable power for classrooms, computer labs, and other facilities. By implementing solar energy, we can help schools save money on electricity bills while teaching students about renewable energy and environmental sustainability.',
        initiator: 'Community Energy Initiative',
        image: '/images/crowdfundingPic1.png'
      },
      'Hydro for Hope': {
        description: 'A community-driven project to install small-scale hydroelectric systems in rural areas with access to flowing water. This sustainable energy solution will provide reliable electricity to remote communities, improving quality of life and supporting local economic development. The project includes community training on maintenance and operation of the hydro systems.',
        initiator: 'Rural Development Foundation',
        image: '/images/crowdfundingPic2.png'
      }
    };

    // Function to open project details modal
    function openProjectModal(projectCard) {
      const projectTitle = projectCard.querySelector('.project-title');
      const projectImage = projectCard.querySelector('.project-image');
      
      if (!projectTitle || !projectModal) {
        console.error('Project elements not found');
        return;
      }

      const projectName = projectTitle.textContent.trim();
      const imageUrl = projectImage ? projectImage.src : '';
      const imageAlt = projectImage ? projectImage.alt : projectName;
      
      // Get project data
      let description = 'No description provided.';
      let initiator = 'Unknown';
      
      if (projectData[projectName]) {
        description = projectData[projectName].description;
        initiator = projectData[projectName].initiator;
      } else {
        // Check if this is a dynamically added project from localStorage
        const projectId = projectCard.getAttribute('data-project-id');
        if (projectId) {
          const projects = JSON.parse(localStorage.getItem('donor_crowdfunding_projects') || '[]');
          const project = projects.find(p => p.id === projectId);
          if (project) {
            description = project.description || 'No description provided.';
            initiator = project.initiator || 'Donor';
          }
        }
      }
      
      // Populate modal
      const modalImage = document.getElementById('modalProjectImage');
      const modalName = document.getElementById('modalProjectName');
      const modalDescription = document.getElementById('modalProjectDescription');
      const modalInitiator = document.getElementById('modalProjectInitiator');
      
      if (!modalImage || !modalName || !modalDescription || !modalInitiator) {
        console.error('Modal elements not found');
        return;
      }
      
      // Set project name in header
      modalName.textContent = projectName;
      
      if (imageUrl) {
        modalImage.src = imageUrl;
        modalImage.alt = imageAlt;
        modalImage.style.display = 'block';
      } else {
        modalImage.style.display = 'none';
      }
      modalDescription.textContent = description;
      modalInitiator.textContent = initiator;
      
      // Show modal
      projectModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
    
    // Function to close modal
    function closeProjectModal() {
      if (projectModal) {
        projectModal.classList.remove('show');
        document.body.style.overflow = 'auto';
      }
    }
    
    // Add event listeners using event delegation for both existing and dynamically added buttons
    document.addEventListener('click', function(e) {
      const btnDetails = e.target.closest('.btn-details');
      if (btnDetails) {
        e.preventDefault();
        e.stopPropagation();
        const projectCard = btnDetails.closest('.project-card');
        if (projectCard) {
          openProjectModal(projectCard);
        }
      }
    });
    
    // Close modal button
    if (closeProjectModalBtn) {
      closeProjectModalBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeProjectModal();
      });
    }
    
    // Close modal when clicking outside
    if (projectModal) {
      projectModal.addEventListener('click', function(e) {
        if (e.target === projectModal) {
          closeProjectModal();
        }
      });
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && projectModal && projectModal.classList.contains('show')) {
        closeProjectModal();
      }
    });
  });
</script>
</body>
</html>

