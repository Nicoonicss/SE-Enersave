<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account · Enersave</title>
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
    <div class="auth-wrap">
        <!-- Left Column - Form Section -->
        <div class="auth-form-section">
            <div class="auth-card">
                <div class="title">Create Your Account</div>
                <div class="muted">Join our community and start making a difference today</div>
                <form method="post" action="/register" id="registerForm">
                    <div class="field">
                        <label for="username">USERNAME</label>
                        <input 
                            id="username" 
                            type="text" 
                            name="username" 
                            placeholder="Enter your username"
                            required
                            autocomplete="username"
                        >
                    </div>
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
                            placeholder="Create a strong password"
                            required
                            autocomplete="new-password"
                            minlength="6"
                        >
                    </div>
                    <div class="field">
                        <label for="role">ACCOUNT TYPE</label>
                        <select 
                            id="role" 
                            name="role" 
                            required
                        >
                            <option value="">Select your account type</option>
                            <option value="COMMUNITY_USER">Community User</option>
                            <option value="SUPPLIER_INSTALLER">Supplier/Installer</option>
                            <option value="EDUCATOR_ADVOCATE">Educator/Student</option>
                            <option value="DONOR_NGO">Donor/NGO</option>
                            <option value="ADMIN">Admin</option>
                        </select>
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit">CREATE ACCOUNT</button>
                    </div>
                </form>
                <div class="footer-link">Already have an account? <a href="/login">Sign in here</a></div>
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
