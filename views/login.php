<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - EnerSave</title>
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

h2 {
    font-size: 36px;
    margin-bottom: 10px;
    font-weight: 800;
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
    margin-bottom: 25px; 
    font-size: 15px;
    box-sizing: border-box;
}

.password-wrapper {
    position: relative;
    margin-bottom: 5px;
    width: 100%; 
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
    margin-bottom: 15px; 
    text-decoration: none;
}

.login-btn {
    width: 100%;
    padding: 14px;
    background: #239c42;
    color: black;
    border: none;
    border-radius: 6px;
    font-size: 17px;
    cursor: pointer;
    font-weight: bold;
    display: block;
    margin-top: 0;
    margin-left: 0px; 
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

input,
.login-btn {
    width: 100%;
    height: 45px;
    box-sizing: border-box;
}

.login-btn {
    padding: 12px;
    margin-top: 5px;
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
<h2>LOG IN TO YOUR<br>ACCOUNT</h2>
<p class="welcome">Welcome Back! Please enter your details.</p>

<?php if (isset($_GET['reset']) && $_GET['reset'] === 'success'): ?>
    <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem;">
        Password has been reset successfully. You can now sign in with your new password.
    </div>
<?php endif; ?>

<form action="/login" method="POST">
<label for="email">Email:</label>
<input type="email" id="email" name="email" placeholder="Enter your email address" required />

<label for="password">Password:</label>
<div class="password-wrapper">
<input type="password" id="password" name="password" placeholder="Enter your password" required />
<button type="button" class="toggle-eye" onclick="togglePassword()">👁</button>
</div>

<a href="/forgot-password" class="forgot">Forgot your password?</a>

<button type="submit" class="login-btn">Log In</button>

<p class="register">Don't have an account? <a href="/register">Register Here</a></p>
</form>
</div>
</div>

</div>

<script>
function togglePassword() {
    const field = document.getElementById('password');
    if (field.type === 'password') {
        field.type = 'text';
    } else {
        field.type = 'password';
    }
}
</script>
</body>
</html>