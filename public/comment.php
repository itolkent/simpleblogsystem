<?php
$title = "Comment";
include "../views/header.php";
require_once "../app/Database.php";

$db = Database::getConnection();

// Get post ID
$post_id = intval($_GET['id'] ?? 1);

// Fetch post
$stmt = $db->prepare("
    SELECT p.id, p.title, p.content, p.featured_image, p.created_at,
           u.name AS author
    FROM posts p
    LEFT JOIN users u ON p.user_id = u.id
    WHERE p.id = ? AND p.status = 'published'
    LIMIT 1
");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);


// If post not found
if (!$post) {
    echo "<main><h1>Post not found.</h1></main>";
    include "../views/footer.php";
    exit;
}

// Fetch comments
$stmt = $db->prepare("
    SELECT c.user_id, c.content, c.created_at, u.name AS author
    FROM comments c
    LEFT JOIN users u ON c.user_id = u.id
    WHERE c.post_id = ?
      AND c.parent_id IS NULL
      AND c.status = 'approved'
    ORDER BY c.created_at DESC
");
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="post-container">

    <!-- Post Header -->
    <article class="post-card">
        <h1 class="post-title"><?= htmlspecialchars($post['title']) ?></h1>

        <p class="post-meta">
            By <?= htmlspecialchars($post['author'] ?? "Unknown") ?>
            • <?= date("M d, Y", strtotime($post['created_at'])) ?>
        </p>

        <?php if (!empty($post['featured_image'])): ?>
            <img src="/images/<?= htmlspecialchars($post['featured_image']) ?>" class="post-image" alt="Post image">
        <?php endif; ?>

        <div class="post-content">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>
    </article>

    <hr class="divider">

    <!-- Comments Section -->
    <section class="comments-section">
        <h3 class="section-title">Comments</h3>

        <?php foreach ($comments as $row): ?>
            <div class="comment-card">
                <strong class="comment-author">
                    <?= htmlspecialchars($row['author'] ?? "Unknown User") ?>
                </strong>


                <p class="comment-text">
                    <?= nl2br(htmlspecialchars($row['content'])) ?>
                </p>

                <small class="comment-date">
                    <?= $row['created_at'] ?>
                </small>
            </div>
        <?php endforeach; ?>

        <form method="POST" action="/index.php?route=add_comment" class="comment-form">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">

            <textarea name="content" class="comment-input" rows="3" placeholder="Write a comment..."
                required></textarea>

            <button class="post-card-btn">Submit</button>
        </form>
    </section>

</main>

<?php include "../views/footer.php"; ?>