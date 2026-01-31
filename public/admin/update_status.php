<?php
session_start();
require_once "../../app/Database.php";

// admins section
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /login.php");
    exit;
}

$id = intval($_GET['id']);
$status = $_GET['status'] === 'published' ? 'published' : 'draft';

$db = Database::getConnection();

$stmt = $db->prepare("UPDATE posts SET status = ?, updated_at = NOW() WHERE id = ?");
$stmt->execute([$status, $id]);

header("Location: /admin_post.php");
exit;