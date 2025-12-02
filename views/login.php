<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · Enersave</title>
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
    <div class="auth-wrap">
        <!-- Left Column - Form Section -->
        <div class="auth-form-section">
            <div class="auth-card">
                <div class="title">Welcome Back</div>
                <div class="muted">Sign in to your Enersave account</div>
                <form method="post" action="/login" id="loginForm">
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
                    <div class="field">
                        <label for="password">PASSWORD</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit">SIGN IN</button>
                    </div>
                </form>
                <div class="footer-link">Don't have an account? <a href="/register">Create one here</a></div>
            </div>
        </div>

        <!-- Right Column - Promotional Section -->
        <div class="auth-promo-section">
            <div class="promo-content">
                <div class="promo-brand">
                    <img src="/images/logo.svg" alt="Enersave logo">
                    <div class="promo-brand-name">Enersave</div>
                </div>
                <div class="promo-tagline">Connecting communities with sustainable energy solutions</div>
                <div class="promo-description">
                    Our software is a web-based platform designed to connect rural and remote communities with sustainable energy solutions.
                </div>
                <ul class="promo-features">
                    <li>Premium Energy Solutions from World's Leading Providers</li>
                    <li>Community-Driven Projects for Sustainable Development</li>
                    <li>Curated Resources for Every Energy Need</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
