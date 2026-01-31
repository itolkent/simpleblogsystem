<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];


$title = "Create Post";
include "../views/header.php";
require_once "../app/Database.php";
function createSlug($string)
{
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return trim($slug, '-');
}

$slug = createSlug($title);


// $user_id = $_SESSION['user_id'];

// Initialize DB
$db = new Database();
$pdo = $db->getConnection();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $featured_image = null;
    // Generate slug from title
    $slug = createSlug($title);

    // Ensure slug is unique
    $baseSlug = $slug;
    $counter = 1;

    $check = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE slug = ?");
    $check->execute([$slug]);

    while ($check->fetchColumn() > 0) {
        $slug = $baseSlug . '-' . $counter;
        $counter++;
        $check->execute([$slug]);
    }

    if (!empty($_FILES['featured_image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['featured_image']['name']);
        $targetPath = "../public/images/" . $imageName;

        if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $targetPath)) {
            $featured_image = $imageName;
        }
    }

    $stmt = $pdo->prepare("
       INSERT INTO posts (user_id, title, slug, content, featured_image, created_at)
        VALUES (:user_id, :title, :slug, :content, :featured_image, NOW())
    ");

    $stmt->execute([
        ':user_id' => $user_id,
        ':title' => $title,
        ':slug' => $slug,
        ':content' => $content,
        ':featured_image' => $featured_image
    ]);

    header("Location: /post.php");
    exit;
}
?>

<main>
    <div class="create-post-container">
        <div class="create-post-wrapper">

            <h1 class="create-post-title">Create New Post</h1>

            <form action="" method="POST" enctype="multipart/form-data" class="create-post-form">

                <label>Post Title</label>
                <input type="text" name="title" required class="input-field">

                <label>Content</label>
                <textarea name="content" rows="10" required class="textarea-field"></textarea>

                <label>Featured Image</label>
                <input type="file" name="featured_image" accept="image/*" class="input-field">

                <button type="submit" class="btn">Create</button>

            </form>

        </div>
    </div>

</main>

<?php include "../views/footer.php"; ?>