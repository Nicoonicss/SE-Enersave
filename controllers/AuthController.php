<?php

class AuthController
{
    public function login(): void
    {
        include __DIR__ . '/../views/login.php';
    }

    public function register(): void
    {
        include __DIR__ . '/../views/registration.php';
    }

    public function handleLogin(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($email === '' || $password === '') {
            http_response_code(400);
            echo 'Email and password are required';
            return;
        }
        $userModel = new User();
        $user = $userModel->findByEmail($email);
        if (!$user || !password_verify($password, $user['password_hash'])) {
            http_response_code(401);
            echo 'Invalid credentials';
            return;
        }
        $_SESSION['user'] = [ 'id' => (int)$user['id'], 'email' => $user['email'], 'username' => $user['username'], 'role' => $user['role'] ];
        
        // Redirect based on role
        $redirectUrl = $this->getRoleRedirectUrl($user['role']);
        header('Location: ' . $redirectUrl);
        exit;
    }

    public function handleRegister(): void
    {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $role = trim($_POST['role'] ?? 'COMMUNITY_USER');
        
        // Validate role
        $validRoles = ['COMMUNITY_USER', 'SUPPLIER_INSTALLER', 'EDUCATOR_ADVOCATE', 'DONOR_NGO', 'ADMIN'];
        if (!in_array($role, $validRoles)) {
            $role = 'COMMUNITY_USER';
        }
        
        if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
            http_response_code(400);
            echo 'All fields are required';
            return;
        }
        
        // Validate password match
        if ($password !== $confirmPassword) {
            http_response_code(400);
            echo 'Passwords do not match';
            return;
        }
        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            http_response_code(409);
            echo 'Email already registered';
            return;
        }
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $id = $userModel->create($username, $email, $hash, $role);
        $_SESSION['user'] = [ 'id' => $id, 'email' => $email, 'username' => $username, 'role' => $role ];
        
        // Redirect based on role
        $redirectUrl = $this->getRoleRedirectUrl($role);
        header('Location: ' . $redirectUrl);
        exit;
    }
    
    private function getRoleRedirectUrl(string $role): string
    {
        return match($role) {
            'COMMUNITY_USER' => '/home',
            'SUPPLIER_INSTALLER' => '/dashboard',
            'EDUCATOR_ADVOCATE' => '/home',
            'DONOR_NGO' => '/home',
            'ADMIN' => '/dashboard',
            default => '/home',
        };
    }

    public function forgotPassword(): void
    {
        include __DIR__ . '/../views/forgot_password.php';
    }

    public function handleForgotPassword(): void
    {
        $email = trim($_POST['email'] ?? '');
        if ($email === '') {
            http_response_code(400);
            echo 'Email is required';
            return;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);
        
        // Always store the email to show in success message
        $_SESSION['reset_email'] = $email;
        
        // Always show success message for security (don't reveal if email exists)
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $userModel->createPasswordResetToken($user['id'], $token);
            
            // Send email with reset link
            require_once __DIR__ . '/../helpers/EmailHelper.php';
            $emailSent = EmailHelper::sendPasswordResetEmail($email, $token);
            
            // For development: also store token in session for easy testing
            if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'development') {
                $_SESSION['reset_token'] = $token;
            }
        }
        
        // Show success message
        header('Location: /forgot-password?sent=1');
        exit;
    }

    public function resetPassword(): void
    {
        $token = $_GET['token'] ?? '';
        if (empty($token)) {
            http_response_code(400);
            die('Invalid reset token');
        }

        $userModel = new User();
        $userId = $userModel->findByResetToken($token);
        
        if (!$userId) {
            http_response_code(400);
            die('Invalid or expired reset token');
        }

        include __DIR__ . '/../views/reset_password.php';
    }

    public function handleResetPassword(): void
    {
        $token = trim($_POST['token'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($token === '' || $password === '' || $confirmPassword === '') {
            http_response_code(400);
            echo 'All fields are required';
            return;
        }

        if ($password !== $confirmPassword) {
            http_response_code(400);
            echo 'Passwords do not match';
            return;
        }

        $userModel = new User();
        $userId = $userModel->findByResetToken($token);
        
        if (!$userId) {
            http_response_code(400);
            echo 'Invalid or expired reset token';
            return;
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);
        $userModel->updatePassword($userId, $hash);
        $userModel->deleteResetToken($token);

        header('Location: /login?reset=success');
        exit;
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /login');
        exit;
    }
}


