<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create account · Enersave</title>
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
    <div class="auth-wrap">
        <div class="auth-card">
            <div class="brand">
                <img src="/images/logo.png" alt="Enersave logo">
                <div class="brand-name">Enersave</div>
            </div>
            <div class="title">Create your account</div>
            <div class="muted">Get started with Enersave</div>
            <form method="post" action="/register">
                <div class="field">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" required>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="actions">
                    <button class="btn" type="submit">Create account</button>
                </div>
            </form>
            <div class="footer-link">Already have an account? <a href="/login">Sign in</a></div>
        </div>
    </div>
</body>
</html>

