<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../app/database.php";

$db = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Require login to comment
    if (!isset($_SESSION['user'])) {
        die("You must be logged in to comment.");
    }

    $post_id = intval($_POST['post_id']);
    $user_id = $_SESSION['user']['id']; // logged-in user ID
    $parent_id = null; // top-level comment
    $content = trim($_POST['content']);

    if (strlen($content) < 2) {
        die("Comment too short.");
    }

    $stmt = $db->prepare("
        INSERT INTO comments (post_id, user_id, parent_id, content, status)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([$post_id, $user_id, $parent_id, $content, 'approved']);

    header("Location: /comment.php?id=" . $post_id);
    exit;
}
?>