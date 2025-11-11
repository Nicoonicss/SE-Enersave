<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login · Enersave</title>
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
            <div class="title">Welcome back</div>
            <div class="muted">Sign in to continue</div>
            <form method="post" action="/login">
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="actions">
                    <button class="btn" type="submit">Login</button>
                </div>
            </form>
            <div class="footer-link">No account? <a href="/register">Create one</a></div>
        </div>
    </div>
</body>
</html>

