<?php
session_start();

$title = "Simple Blog System";
include "../views/header.php";

$route = $_GET['route'] ?? null;

if ($route === 'add_comment') {
    require_once "../app/handlers/add_comment.php";
    exit;
}

if ($route === "login") {
    require_once "../app/handlers/handler_login.php";
    exit;
}
// --

require_once "../app/database.php";
$db = Database::getConnection();

// Fetch the 2 most recent published posts
$stmt = $db->prepare("
    SELECT id, title, content, featured_image
    FROM posts
    WHERE status = 'published'
    ORDER BY created_at DESC
    LIMIT 2
");
$stmt->execute();
$recentPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ----
// Fetch all published posts
$stmt = $db->prepare("
    SELECT id, title, content, featured_image, created_at
    FROM posts
    WHERE status = 'published'
    ORDER BY created_at DESC
");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<main>

    <div class="card-body">
        <div class="card-recent-body">
            <h1 class="recent-title">Our recent posts</h1>

            <div class="card-horizontal">
                <?php foreach ($recentPosts as $post): ?>
                    <div class="post-card">
                        <img src="/images/<?= htmlspecialchars($post['featured_image']) ?>" class="card-h-img">
                        <h3>
                            <?= htmlspecialchars($post['title']) ?>
                        </h3>
                        <p>
                            <?= htmlspecialchars(substr($post['content'], 0, 180)) ?>...
                        </p>
                        <a href="/comment.php?id=<?= $post['id'] ?>" class="btn">
                            Read More
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="card-about">
            <div class="card-title-float">About Me</div>

            <div class="card-content">
                <img src="/images/me.png" class="card-me">
                <div class="intro-card">
                    <h1>Hello!</h1>
                    <h2>I'm Kent, a developer and designer who loves building clean, simple experiences.</h2>
                    <p>Welcome to my Simple Blog System.</p>

                    <a href="contact.php" class="btn">Contact Me</a>
                </div>
            </div>
        </div>
    </div>
    <h1 class="page-title">All Posts</h1>

    <div class="posts-grid">

        <?php foreach ($posts as $post): ?>
            <div class="post-card">

                <?php if (!empty($post['featured_image'])): ?>
                    <img src="/images/<?= htmlspecialchars($post['featured_image']) ?>" class="post-card-image"
                        alt="<?= htmlspecialchars($post['title']) ?>">
                <?php endif; ?>

                <div class="post-card-body">
                    <h2 class="post-card-title">
                        <?= htmlspecialchars($post['title']) ?>
                    </h2>

                    <p class="post-card-excerpt">
                        <?= htmlspecialchars(substr($post['content'], 0, 120)) ?>...
                    </p>

                    <a href="/comment.php?id=<?= $post['id'] ?>" class="btn">
                        Read More
                    </a>
                </div>

            </div>
        <?php endforeach; ?>

    </div>


    <div class="bottom-container">
        <h3 class="mb-4">
            Your ideas matter. Sign in to post, comment, and connect.</h3>
        <button class="btn">Login</button>
        <div class="social-login">
            <p>Or continue with</p>
            <div class="social-icons">
                <a href="#" class="google"><i class="fab fa-google"></i></a>
                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="github"><i class="fab fa-github"></i></a>
            </div>
        </div>

    </div>

</main>

<?php include "../views/footer.php"; ?>