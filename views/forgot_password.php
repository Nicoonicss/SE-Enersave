<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password · Enersave</title>
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="background: #f8fafc; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
    <div style="width: 100%; max-width: 500px;">
        <div class="auth-card" style="background: #ffffff; border-radius: 12px; padding: 48px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);">
            <div class="title" style="text-transform: uppercase; text-align: center; margin-bottom: 12px;">RESET YOUR PASSWORD</div>
            <div class="muted" style="text-align: center; margin-bottom: 32px;">Enter your email address and we'll send you a link to reset your password.</div>
                <?php if (isset($_GET['sent'])): ?>
                    <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem;">
                        <?php if (isset($_SESSION['reset_email'])): ?>
                            Reset link has been sent to <strong><?php echo htmlspecialchars($_SESSION['reset_email']); ?></strong>. Please check your email.
                            <?php 
                            $sentEmail = $_SESSION['reset_email'];
                            unset($_SESSION['reset_email']);
                            ?>
                        <?php else: ?>
                            If an account exists with that email, a password reset link has been sent. Please check your email.
                        <?php endif; ?>
                        <?php if (isset($_SESSION['reset_token'])): ?>
                            <br><br><strong>Development Mode:</strong> Reset token: <?php echo htmlspecialchars($_SESSION['reset_token']); ?>
                            <br><a href="/reset-password?token=<?php echo urlencode($_SESSION['reset_token']); ?>" style="color: #059669; text-decoration: underline;">Click here to reset password</a>
                            <?php unset($_SESSION['reset_token']); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="/forgot-password" id="forgotPasswordForm">
                    <div class="field">
                        <label for="email">EMAIL ADDRESS</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            placeholder="Enter your email"
                            required
                            autocomplete="email"
                        >
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit" style="background: #27ae60; color: #000000;">SEND RESET LINK</button>
                    </div>
                </form>
                <div class="footer-link" style="text-align: center; margin-top: 24px;">
                    <span style="color: #000000;">Remembered your password? </span><a href="/login" style="color: #27ae60; text-decoration: none;">Login</a>
                </div>
        </div>
    </div>
</body>
</html>

