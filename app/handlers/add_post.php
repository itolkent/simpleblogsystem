<?php
require_once "../app/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $post_id = intval($_POST['post_id']);
    $comment = trim($_POST['comment']);
    $author = "Guest"; // or $_SESSION['username'] if logged in

    if (strlen($comment) < 2) {
        die("Comment too short.");
    }

    $stmt = $conn->prepare("INSERT INTO comments (post_id, author, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $post_id, $author, $comment);

    if ($stmt->execute()) {
        header("Location: /views/comment.php?id=" . $post_id);
        exit;
    } else {
        echo "Error saving comment.";
    }
}
?>