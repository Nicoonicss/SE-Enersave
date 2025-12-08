<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account · Enersave</title>
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-wrap">
        <!-- Left Column - Promotional Section -->
        <div class="auth-promo-section">
            <div class="promo-content">
                <div class="promo-brand-top">
                    <img src="/images/logo.svg" alt="Enersave logo">
                    <div class="promo-brand-name-top">EnerSave</div>
                </div>
                <div class="promo-main-text">
                    <div class="promo-headline">Powering Communities,</div>
                    <div class="promo-headline-large">Sustainably.</div>
                </div>
                <div class="promo-call-to-action">
                    Join Enersave to bring clean energy solutions to remote and rural areas around the globe.
                </div>
            </div>
        </div>

        <!-- Right Column - Form Section -->
        <div class="auth-form-section">
            <div class="auth-card">
                <div class="title" style="text-transform: uppercase;">CREATE YOUR ACCOUNT</div>
                <div class="muted">Join our community and start making a difference today</div>
                <form method="post" action="/register" id="registerForm">
                    <div class="field">
                        <label for="fullname">FULL NAME</label>
                        <input 
                            id="fullname" 
                            type="text" 
                            name="username" 
                            placeholder="Enter your full name"
                            required
                            autocomplete="name"
                        >
                    </div>
                    <div class="field">
                        <label for="email">EMAIL ADDRESS</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            placeholder="Enter your email address"
                            required
                            autocomplete="email"
                        >
                    </div>
                    <div class="field">
                        <label for="password">PASSWORD</label>
                        <div class="password-input-wrapper">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                placeholder="Enter your password"
                                required
                                autocomplete="new-password"
                                minlength="6"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <svg id="password-eye" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 3C5 3 1.73 7.11 1 10C1.73 12.89 5 17 10 17C15 17 18.27 12.89 19 10C18.27 7.11 15 3 10 3ZM10 15C7.24 15 5 12.76 5 10C5 7.24 7.24 5 10 5C12.76 5 15 7.24 15 10C15 12.76 12.76 15 10 15ZM10 7C8.34 7 7 8.34 7 10C7 11.66 8.34 13 10 13C11.66 13 13 11.66 13 10C13 8.34 11.66 7 10 7Z" fill="#6b7280"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="field">
                        <label for="confirm_password">CONFIRM PASSWORD</label>
                        <div class="password-input-wrapper">
                            <input 
                                id="confirm_password" 
                                type="password" 
                                name="confirm_password" 
                                placeholder="Confirm your password"
                                required
                                autocomplete="new-password"
                                minlength="6"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                                <svg id="confirm_password-eye" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 3C5 3 1.73 7.11 1 10C1.73 12.89 5 17 10 17C15 17 18.27 12.89 19 10C18.27 7.11 15 3 10 3ZM10 15C7.24 15 5 12.76 5 10C5 7.24 7.24 5 10 5C12.76 5 15 7.24 15 10C15 12.76 12.76 15 10 15ZM10 7C8.34 7 7 8.34 7 10C7 11.66 8.34 13 10 13C11.66 13 13 11.66 13 10C13 8.34 11.66 7 10 7Z" fill="#6b7280"/>
                                </svg>
                            </button>
                        </div>
                        <span id="password-match-error" class="error-message" style="display: none; color: #ef4444; font-size: 0.8125rem; margin-top: 4px;">Passwords do not match</span>
                    </div>
                    <div class="field">
                        <label>ROLE:</label>
                        <div class="role-buttons">
                            <button type="button" class="role-btn" data-role="COMMUNITY_USER" onclick="selectRole(this, 'COMMUNITY_USER')">Community User</button>
                            <button type="button" class="role-btn" data-role="SUPPLIER_INSTALLER" onclick="selectRole(this, 'SUPPLIER_INSTALLER')">Supplier</button>
                            <button type="button" class="role-btn" data-role="DONOR_NGO" onclick="selectRole(this, 'DONOR_NGO')">Donor</button>
                            <button type="button" class="role-btn" data-role="EDUCATOR_ADVOCATE" onclick="selectRole(this, 'EDUCATOR_ADVOCATE')">Educator</button>
                            <button type="button" class="role-btn" data-role="ADMIN" onclick="selectRole(this, 'ADMIN')">Admin</button>
                        </div>
                        <input type="hidden" id="role" name="role" required>
                        <span id="role-error" class="error-message" style="display: none; color: #ef4444; font-size: 0.8125rem; margin-top: 4px;">Please select a role</span>
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit" style="background: #27ae60; color: #000000;">REGISTER</button>
                    </div>
                </form>
                <div class="footer-link">Already have an account? <a href="/login" style="color: #27ae60;">Login</a></div>
            </div>
        </div>
    </div>
    
    <style>
        .password-input-wrapper {
            position: relative;
        }
        
        .password-input-wrapper input {
            padding-right: 45px;
        }
        
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .password-toggle:hover svg path {
            fill: var(--blue-primary);
        }
        
        .role-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }
        
        .role-btn {
            padding: 10px 20px;
            border: 1.5px solid var(--border-light);
            border-radius: 8px;
            background: white;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.2s ease;
            flex: 1;
            min-width: 120px;
        }
        
        .role-btn:hover {
            border-color: var(--blue-primary);
            background: #f0f9ff;
        }
        
        .role-btn.selected {
            background: var(--blue-primary);
            color: white;
            border-color: var(--blue-primary);
        }
    </style>
    
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            
            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.innerHTML = '<path d="M2.5 2.5L17.5 17.5M17.5 2.5L2.5 17.5" stroke="#6b7280" stroke-width="2" stroke-linecap="round"/><path d="M10 3C5 3 1.73 7.11 1 10C1.73 12.89 5 17 10 17C15 17 18.27 12.89 19 10C18.27 7.11 15 3 10 3ZM10 15C7.24 15 5 12.76 5 10C5 7.24 7.24 5 10 5C12.76 5 15 7.24 15 10C15 12.76 12.76 15 10 15ZM10 7C8.34 7 7 8.34 7 10C7 11.66 8.34 13 10 13C11.66 13 13 11.66 13 10C13 8.34 11.66 7 10 7Z" fill="#6b7280"/>';
            } else {
                field.type = 'password';
                eyeIcon.innerHTML = '<path d="M10 3C5 3 1.73 7.11 1 10C1.73 12.89 5 17 10 17C15 17 18.27 12.89 19 10C18.27 7.11 15 3 10 3ZM10 15C7.24 15 5 12.76 5 10C5 7.24 7.24 5 10 5C12.76 5 15 7.24 15 10C15 12.76 12.76 15 10 15ZM10 7C8.34 7 7 8.34 7 10C7 11.66 8.34 13 10 13C11.66 13 13 11.66 13 10C13 8.34 11.66 7 10 7Z" fill="#6b7280"/>';
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
            const confirmPassword = document.getElementById('confirm_password');
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
