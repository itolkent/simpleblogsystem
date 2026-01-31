<?php
session_start();
require_once "../app/database.php";

$db = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Fetch user by email
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validate user
    if (!$user || !password_verify($password, $user['password_hash'])) {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: /login.php");
        exit;
    }

    // Optional: Check if verified
    if (!$user['is_verified']) {
        $_SESSION['login_error'] = "Please verify your email before logging in.";
        header("Location: /login.php");
        exit;
    }

    // Login success — store user in session
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => $user['role']
    ];

    header("Location: /index.php");
    exit;
}
?>