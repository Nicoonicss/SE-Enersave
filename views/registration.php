<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration - EnerSave</title>
    <style>
    body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: #f5f5f5;
}

.container {
    display: flex;
    height: 100vh;
}

.left-section {
    flex: 1.2;
    position: relative;
    background-image: url("/images/image 23.png"); 
    background-size: cover;
    background-position: center;
}

.logo-wrapper {
    position: absolute; 
    top: 20px;         
    left: 40px;  
    display: flex;     
    align-items: center; 
    gap: 10px;            
    z-index: 2;
}

.logo-wrapper .logo {
    width: 25px;       
    height: auto;      
}

.logo-wrapper .app-name {
    color: white;        
    font-size: 28px;   
    font-weight: bold;   
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
}

.left-content {
    position: absolute;
    bottom: 50px;
    left: 40px;
    transform: translate(10%,-100%);
    color: white;
    max-width: 450px;
    z-index: 2;
}

.left-content .logo {
    width: 25px;
    height: auto;
}

.left-content h1 {
    font-size: 80px;       
    font-weight: bold;
    line-height: 1.2;
    margin-bottom: 15px;
    text-align: left;
    white-space: nowrap;    
}

.left-content h1 .subline {
    display: block;        
    font-size: 48px;      
    white-space: normal;   
}

.left-content p {
    font-size: 16px;
    line-height: 22px;
}

.right-section {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f0f0f0;
}

.form-box {
    width: 80%;
    max-width: 400px;
}

h1 {
    font-size: 28px;
    margin-bottom: 10px;
    font-weight: 700;
}

.welcome {
    margin-bottom: 25px;
    color: #333;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
    font-size: 14px;
}

input {
    width: 100%;
    padding: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
    font-size: 15px;
    box-sizing: border-box;
}

.password-wrapper {
    position: relative;
}

.toggle-eye {
    position: absolute;
    right: 12px;
    top: 12px;
    cursor: pointer;
    background: none;
    border: none;
    font-size: 18px;
}

.forgot {
    display: block;
    text-align: right;
    color: green;
    font-size: 14px;
    margin-bottom: 20px;
    text-decoration: none;
}

.register-btn {
    width: 100%;
    padding: 14px;
    background: #239c42;
    color: black;
    border: none;
    border-radius: 6px;
    font-size: 17px;
    cursor: pointer;
    font-weight: bold;
    margin-top: 25px;
    box-sizing: border-box;
}

.register {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.register a {
    color: green;
    font-weight: bold;
    text-decoration: none;
}

.role-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 8px;
    margin-bottom: 15px;
}

.role-btn {
    padding: 10px 20px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    background: white;
    color: #333;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    flex: 1;
    min-width: 100px;
}

.role-btn:hover {
    border-color: #239c42;
    background: #f0f0f0;
}

.role-btn.selected {
    background: #239c42;
    color: white;
    border-color: #239c42;
}

.error-message {
    color: #ef4444;
    font-size: 12px;
    margin-top: 4px;
    display: none;
}
</style>
</head>
<body>
<div class="container">

<div class="left-section">
<div class="overlay"></div>

<div class="logo-wrapper">
<img src="/images/Logo.png" class="logo" alt="EnerSave Logo" />
<span class="app-name">EnerSave</span>
</div>

<div class="left-content">
<h1>Powering Communities,<span class="subline">Sustainably.</span></h1>
<p>Join Enersave to bring clean energy solutions to remote and rural areas around the globe.</p>
</div>
</div>
<div class="right-section">
  <div class="form-box">
    <h1>CREATE YOUR ACCOUNT</h1>

    <form action="/register" method="POST" id="registerForm">
      <label for="fullName">Full Name</label>
      <input type="text" id="fullName" name="username" placeholder="Enter your full name" required />

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" placeholder="Enter your email address" required />

      <label for="password">Password</label>
      <div class="password-wrapper">
        <input type="password" id="password" name="password" placeholder="Enter your password" required />
        <button type="button" class="toggle-eye" onclick="togglePassword('password')">👁</button>
      </div>

      <label for="confirmPassword">Confirm Password</label>
      <div class="password-wrapper">
        <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm your password" required />
        <button type="button" class="toggle-eye" onclick="togglePassword('confirmPassword')">👁</button>
      </div>
      <span id="password-match-error" class="error-message">Passwords do not match</span>

 <label for="role">Role:</label>
      <div class="role-options">
        <button type="button" class="role-btn" data-role="COMMUNITY_USER" onclick="selectRole(this, 'COMMUNITY_USER')">Community</button>
        <button type="button" class="role-btn" data-role="DONOR_NGO" onclick="selectRole(this, 'DONOR_NGO')">Donor</button>
        <button type="button" class="role-btn" data-role="SUPPLIER_INSTALLER" onclick="selectRole(this, 'SUPPLIER_INSTALLER')">Supplier</button>
        <button type="button" class="role-btn" data-role="EDUCATOR_ADVOCATE" onclick="selectRole(this, 'EDUCATOR_ADVOCATE')">Educator/Student</button>
      </div>
      <input type="hidden" id="role" name="role" value="">
      <span id="role-error" class="error-message">Please select a role</span>

      <button type="submit" class="register-btn">Register</button>
    </form>

    <p class="register">Already have an account? <a href="/login">Login</a></p>
  </div>
</div>


</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    if (field.type === 'password') {
        field.type = 'text';
    } else {
        field.type = 'password';
    }
}

function selectRole(button, roleValue) {
    // Remove selected class from all buttons
    document.querySelectorAll('.role-btn').forEach(btn => {
        btn.classList.remove('selected');
    });
    
    // Add selected class to clicked button
    button.classList.add('selected');
    
    // Set hidden input value
    document.getElementById('role').value = roleValue;
    
    // Hide error if shown
    document.getElementById('role-error').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const errorMessage = document.getElementById('password-match-error');
    const roleInput = document.getElementById('role');
    const roleError = document.getElementById('role-error');
    
    function validatePasswords() {
        if (confirmPassword.value === '') {
            errorMessage.style.display = 'none';
            confirmPassword.style.borderColor = '';
            return false;
        }
        
        if (password.value !== confirmPassword.value) {
            errorMessage.style.display = 'block';
            confirmPassword.style.borderColor = '#ef4444';
            return false;
        } else {
            errorMessage.style.display = 'none';
            confirmPassword.style.borderColor = '';
            return true;
        }
    }
    
    confirmPassword.addEventListener('input', validatePasswords);
    password.addEventListener('input', validatePasswords);
    
    form.addEventListener('submit', function(e) {
        if (!validatePasswords()) {
            e.preventDefault();
            return false;
        }
        
        if (!roleInput.value) {
            e.preventDefault();
            roleError.style.display = 'block';
            return false;
        }
    });
});
</script>
</body>
</html>