<?php
session_start();

require_once "../app/Database.php";

// Only admins can access
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /login.php");
    exit;
}

$title = "Admin Posts";
include "../views/header.php";

$db = Database::getConnection();

// Fetch ALL posts
$stmt = $db->prepare("
    SELECT id, title,content, status, created_at
    FROM posts
    ORDER BY created_at DESC
");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <div class="all-post-card">
        <div class="post-header">
            <h1 class="blog-title">Manage Posts</h1>
        </div>

        <?php if (empty($posts)): ?>
            <p>No posts found.</p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    <div class="post-card-body">
                        <h2 class="post-card-title">
                            <?= htmlspecialchars($post['title']) ?>
                        </h2>
                        <p class="post-content">
                            <?= htmlspecialchars($post['content']) ?>
                        </p>

                        <p>Status: <strong><?= htmlspecialchars($post['status']) ?></strong></p>

                        <?php if ($post['status'] === 'published'): ?>
                            <a href="/admin/update_status.php?id=<?= $post['id'] ?>&status=unpublished"
                                class="btn">Unpublish</a>
                        <?php else: ?>
                            <a href="/admin/update_status.php?id=<?= $post['id'] ?>&status=published"
                                class="btn">Publish</a>
                        <?php endif; ?>
                        <a href="/admin/delete_post.php?id=<?= $post['id'] ?>" class="btn"
                            onclick="return confirm('Are you sure you want to delete this post?');">
                            Delete
                        </a>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<?php include "../views/footer.php"; ?>