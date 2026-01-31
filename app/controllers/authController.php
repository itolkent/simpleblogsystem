<?php
require_once __DIR__ . '/../Models/User.php';

class AuthController
{
    public static function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            $errors = [];

            if ($name === '' || $email === '' || $password === '') {
                $errors[] = 'All fields are required.';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email.';
            }
            if ($password !== $confirm) {
                $errors[] = 'Passwords do not match.';
            }
            if (User::findByEmail($email)) {
                $errors[] = 'Email already registered.';
            }

            if (empty($errors)) {
                if (User::create($name, $email, $password)) {
                    $_SESSION['flash_success'] = 'Registration successful. You can now log in.';
                    header('Location: login.php');
                    exit;
                } else {
                    $errors[] = 'Failed to create user.';
                }
            }

            $_SESSION['flash_errors'] = $errors;
            header('Location: register.php');
            exit;
        }
    }

    public static function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $errors = [];

            $user = User::findByEmail($email);
            if (!$user || !password_verify($password, $user['password_hash'])) {
                $errors[] = 'Invalid credentials.';
            }

            if (empty($errors)) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role'],
                ];
                header('Location: index.php');
                exit;
            }

            $_SESSION['flash_errors'] = $errors;
            header('Location: login.php');
            exit;
        }
    }

    public static function logout(): void
    {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}