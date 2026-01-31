<?php
session_start();
require_once __DIR__ . '/../app/Controllers/AuthController.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    AuthController::login();
    exit;
}

$title = 'Login';
$errors = $_SESSION['flash_errors'] ?? [];
unset($_SESSION['flash_errors']);

include __DIR__ . '/../views/header.php';
include __DIR__ . '/../views/flash.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<main>
    <div class="register-container">
        <div class="register-card">
            <h2 class="text-center ">Login</h2>

            <?php if (!empty($errors)): ?>
                <div class="error-box">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- <form method="POST" action="/index.php?route=login"> -->
            <form method="POST" action="login.php">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button class="btn ">Login</button>
            </form>
            <div>
                <p class="text-center">
                    No account? <a href="register.php">Register</a>
                </p>
            </div>
            <div class="social-login">
                <p>Or continue with</p>
                <div class="social-icons">
                    <a href="#" class="google"><i class="fab fa-google"></i></a>
                    <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="github"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>

    </div>
</main>


<?php include __DIR__ . '/../views/footer.php'; ?>