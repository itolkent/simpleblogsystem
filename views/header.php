<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/css/styles.css">
</head>

<body class="body-header">
    <div class="header-container">
        <a class="header-title" href="/index.php">SIMPLE BLOG SYSTEM</a>

        <nav>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/index.php">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="/post.php">POST</a></li>
                <li class="nav-item"><a class="nav-link" href="/portfolio.php">PORTFOLIO</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact.php">CONTACT</a></li>
                <li class="nav-item"><a class="nav-link" href="/about.php">ABOUT US</a></li>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="/admin_post.php">ADMIN PANEL</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <?php if (isset($_SESSION['user'])): ?>
            <div class="logged-user">
                <strong>    
                    Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?>
                    <a href="/logout.php" class="logout-link">Logout</a>
                </strong>
            </div>
        <?php else: ?>
            <div class="auth-buttons">
                <a class="nav-link" href="/login.php">Login</a>
                <a class="nav-link" href="/register.php">Register</a>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>