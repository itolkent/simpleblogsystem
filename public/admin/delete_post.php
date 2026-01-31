<?php
session_start();
require_once "../../app/Database.php";

// Only admins allowed
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /login.php");
    exit;
}

$id = intval($_GET['id']);

$db = Database::getConnection();

// Delete the post
$stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);

header("Location: /admin_post.php");
exit;