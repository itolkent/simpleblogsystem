<?php

session_start();
$title = "Post";
include "../views/header.php";
require_once "../app/Database.php";
$db = Database::getConnection();
$post_id = intval($_GET['id'] ?? 1);

$stmt = $db->prepare("
    SELECT id, title, content, featured_image, created_at
    FROM posts
    WHERE status = 'published'
    ORDER BY created_at DESC
");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<main>
    <div class="all-post-card">
        <div class="post-header">
            <h1 class="blog-title">Latest Posts</h1>

            <a href="/create-post.php" class="btn">
                + Create Post
            </a>
        </div>


        <p class="blog-subtitle">Read articles, insights, and updates from my development journey.</p>

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


</main>


<?php include "../views/footer.php"; ?>