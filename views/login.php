<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · Enersave</title>
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
                    <img src="/images/Logo.png" alt="Enersave logo">
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
                <div class="title" style="text-transform: uppercase;">LOG IN TO YOUR ACCOUNT</div>
                <div class="muted">Welcome Back! Please enter your details.</div>
                <?php if (isset($_GET['reset']) && $_GET['reset'] === 'success'): ?>
                    <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem;">
                        Password has been reset successfully. You can now sign in with your new password.
                    </div>
                <?php endif; ?>
                <form method="post" action="/login" id="loginForm">
                    <div class="field">
                        <label for="email">Email:</label>
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
                        <label for="password">Password:</label>
                        <div class="password-input-wrapper">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <svg id="password-eye" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 3C5 3 1.73 7.11 1 10C1.73 12.89 5 17 10 17C15 17 18.27 12.89 19 10C18.27 7.11 15 3 10 3ZM10 15C7.24 15 5 12.76 5 10C5 7.24 7.24 5 10 5C12.76 5 15 7.24 15 10C15 12.76 12.76 15 10 15ZM10 7C8.34 7 7 8.34 7 10C7 11.66 8.34 13 10 13C11.66 13 13 11.66 13 10C13 8.34 11.66 7 10 7Z" fill="#6b7280"/>
                                </svg>
                            </button>
                        </div>
                        <div style="margin-top: 8px; text-align: right;">
                            <a href="/forgot-password" style="font-size: 0.875rem; color: #27ae60; text-decoration: none; font-weight: 500;">Forgot your password?</a>
                        </div>
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit" style="background: #27ae60; color: #000000;">Log In</button>
                    </div>
                </form>
                <div class="footer-link">Don't have an account? <a href="/register" style="color: #27ae60;">Register Here</a></div>
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
    </script>
</body>
</html>
