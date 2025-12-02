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
        $role = trim($_POST['role'] ?? 'COMMUNITY_USER');
        
        // Validate role
        $validRoles = ['COMMUNITY_USER', 'SUPPLIER_INSTALLER', 'EDUCATOR_ADVOCATE', 'DONOR_NGO', 'ADMIN'];
        if (!in_array($role, $validRoles)) {
            $role = 'COMMUNITY_USER';
        }
        
        if ($username === '' || $email === '' || $password === '') {
            http_response_code(400);
            echo 'All fields are required';
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

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /login');
        exit;
    }
}


