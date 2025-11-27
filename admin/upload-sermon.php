<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Sermon.php';

session_start();

// OPTIONAL: Restrict only to logged-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$sermon = new Sermon($conn);

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title !== "" && $content !== "") {
        if ($sermon->uploadSermon($title, $content)) {
            $message = "Sermon uploaded successfully!";
        } else {
            $message = "Error uploading sermon.";
        }
    } else {
        $message = "Please fill out all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Sermon</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Upload Sermon</h2>

<?php if ($message): ?>
<p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" rows="10" required></textarea><br><br>

    <button type="submit">Upload</button>
</form>

<br>
<a href=
