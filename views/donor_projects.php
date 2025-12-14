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
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s ease;
  }

  .fundraiser-modal.show {
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
      <button type="button" class="start-fundraiser-btn" id="startFundraiserBtn" onclick="openFundraiserModal()">Start a Fundraiser</button>

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

  <!-- Fundraiser Modal -->
  <div id="fundraiserModal" class="fundraiser-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Start a Fundraiser</h2>
        <button class="close-modal" id="closeFundraiserModal">&times;</button>
      </div>
      <form id="fundraiserForm">
        <div class="form-group">
          <label for="fundraiserImage">Upload Image</label>
          <input type="file" id="fundraiserImage" accept="image/*" required>
          <img id="imagePreview" class="image-preview" alt="Preview">
        </div>
        <div class="form-group">
          <label for="fundraiserName">Crowdfunding Name</label>
          <input type="text" id="fundraiserName" required placeholder="Enter crowdfunding name">
        </div>
        <div class="form-group">
          <label for="fundraiserDescription" class="optional">Description</label>
          <textarea id="fundraiserDescription" placeholder="Enter description (optional)"></textarea>
        </div>
        <div class="form-group">
          <label for="fundraiserAmount">Amount</label>
          <input type="number" id="fundraiserAmount" required placeholder="Enter target amount" min="1">
        </div>
        <div class="form-actions">
          <button type="button" class="btn-cancel" id="cancelFundraiserBtn">Cancel</button>
          <button type="submit" class="btn-add">Add Crowdfunding</button>
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

<script src="/navigationDonor.js"></script>
<script src="/JavaScripts/avatarDropdown.js"></script>
<script>
  // Global function for inline onclick
  function openFundraiserModal(e) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    const modal = document.getElementById('fundraiserModal');
    if (modal) {
      modal.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
  }

  // Wait for DOM to be fully loaded
  document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing fundraiser modal...');
    
    // Modal elements
    const fundraiserModal = document.getElementById('fundraiserModal');
    const startFundraiserBtn = document.getElementById('startFundraiserBtn');
    const closeFundraiserModal = document.getElementById('closeFundraiserModal');
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
      row.innerHTML = `
        <td><img src="${project.image}" alt="${project.name}" class="table-image"></td>
        <td><strong>${project.name}</strong></td>
        <td>${project.description}</td>
        <td class="table-amount">₱${project.amount.toLocaleString()}</td>
        <td>${project.dateCreated}</td>
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
      projectCard.innerHTML = `
        <img class="project-image" src="${project.image}" alt="${project.name}" />
        <div class="project-content">
          <div class="project-title">${project.name}</div>
          <p class="project-raised">Raised<br><strong>₱${project.raised.toLocaleString()}</strong> / ${project.amount.toLocaleString()}</p>
          <div class="progress-bar-container" aria-label="Progress toward funding goal">
            <div class="progress-bar" style="width: ${project.progress}%;"></div>
          </div>
          <div class="progress-text">${project.progress}%</div>
          <div class="btn-group">
            <button class="btn-donate" aria-label="Donate to ${project.name}">
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

          // Create new crowdfunding project
          const newProject = {
            id: Date.now().toString(),
            name: name,
            description: description || 'No description provided',
            amount: parseFloat(amount),
            image: imageData,
            dateCreated: new Date().toLocaleDateString('en-US', { 
              year: 'numeric', 
              month: 'short', 
              day: 'numeric' 
            }),
            raised: 0,
            progress: 0
          };

          // Get existing projects from localStorage
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
          alert('Crowdfunding project added successfully!');
        };
        reader.readAsDataURL(imageFile);
      });
    }

    // Load existing projects on page load
    function loadExistingProjects() {
      const projects = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
      if (projects.length > 0) {
        projects.forEach(project => {
          // Check if project already exists on page (by ID)
          const existingProject = document.querySelector(`[data-project-id="${project.id}"]`);
          if (!existingProject) {
            addProjectToTable(project);
            addProjectToDonorProjects(project);
          }
        });
      }
    }

    // Event listeners
    if (startFundraiserBtn) {
      console.log('Adding click listener to button');
      startFundraiserBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        openFundraiserModal(e);
      });
    } else {
      console.error('startFundraiserBtn not found!');
    }
    if (closeFundraiserModal) {
      closeFundraiserModal.addEventListener('click', closeFundraiserModal);
    }
    if (cancelFundraiserBtn) {
      cancelFundraiserBtn.addEventListener('click', closeFundraiserModal);
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
</script>
</body>
</html>

