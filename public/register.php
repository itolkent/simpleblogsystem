<?php
require_once __DIR__ . '/../app/Controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    AuthController::register();
    exit;
}

$title = 'Register';

$errors = $_SESSION['flash_errors'] ?? [];
unset($_SESSION['flash_errors']);

include __DIR__ . '/../views/header.php';
include __DIR__ . '/../views/flash.php';
?>
<main>
    <div class="register-container">
        <div class="register-card">
            <h2 class="mb-4">Create your account</h2>
            <?php if (!empty($errors)): ?>
                <div class="error-box">
                    <?php foreach ($errors as $error): ?>
                        <p>
                            <?= htmlspecialchars($error) ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="password" name="confirm_password" class="form-control " placeholder="Confirm Password"
                    required>
                <button class="btn">Create Account</button>
            </form>
            <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
        </div>


    </div>

</main>


<?php include __DIR__ . '/../views/footer.php'; ?>