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
        header('Location: /explore');
        exit;
    }

    public function handleRegister(): void
    {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
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
        $id = $userModel->create($username, $email, $hash);
        $_SESSION['user'] = [ 'id' => $id, 'email' => $email, 'username' => $username, 'role' => 'COMMUNITY_USER' ];
        header('Location: /explore');
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


