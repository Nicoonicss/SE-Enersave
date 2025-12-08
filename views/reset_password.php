<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password · Enersave</title>
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }
    </style>
</head>
<body style="background: white; margin: 0; padding: 0; height: 100vh; width: 100vw; overflow: hidden; position: fixed; top: 0; left: 0; right: 0; bottom: 0;">
    <div style="width: 100%; height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 0; margin: 0;">
        <div style="width: 100%; max-width: 500px; padding: 0 20px;">
            <div class="title" style="text-transform: uppercase; text-align: center; margin-bottom: 12px;">RESET YOUR PASSWORD</div>
            <div class="muted" style="text-align: center; margin-bottom: 32px;">Enter your new password below.</div>
                <form method="post" action="/reset-password" id="resetPasswordForm">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
                    <div class="field">
                        <label for="password">NEW PASSWORD</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            placeholder="Enter your new password"
                            required
                            autocomplete="new-password"
                            minlength="6"
                        >
                    </div>
                    <div class="field">
                        <label for="confirm_password">CONFIRM PASSWORD</label>
                        <input 
                            id="confirm_password" 
                            type="password" 
                            name="confirm_password" 
                            placeholder="Confirm your new password"
                            required
                            autocomplete="new-password"
                            minlength="6"
                        >
                        <span id="password-match-error" class="error-message" style="display: none; color: #ef4444; font-size: 0.8125rem; margin-top: 4px;">Passwords do not match</span>
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit" style="background: #27ae60; color: #000000;">RESET PASSWORD</button>
                    </div>
                </form>
                <div class="footer-link" style="text-align: center; margin-top: 24px;">
                    <span style="color: #000000;">Remembered your password? </span><a href="/login" style="color: #27ae60; text-decoration: none;">Login</a>
                </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('resetPasswordForm');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            const errorMessage = document.getElementById('password-match-error');
            
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
            });
        });
    </script>
</body>
</html>

