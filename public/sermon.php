<?php
session_start();
require_once '../src/db.php';
require_once '../src/functions.php';
requireLogin();

$id = intval($_GET['id']);
$sermon = $mysqli->query("SELECT * FROM sermons WHERE id=$id")->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $sermon['title']; ?></title>
<link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h2><?php echo $sermon['title']; ?></h2>
<p><strong>Scripture:</strong> <?php echo $sermon['scripture']; ?></p>
<p><strong>Teacher:</strong> <?php echo $sermon['teacher']; ?></p>
<p><strong>Topic:</strong> <?php echo $sermon['topic']; ?></p>
<hr>

<h3>Notes</h3>
<p><?php echo nl2br($sermon['notes']); ?></p>

<?php if($sermon['video_url']): ?>
<h3>Watch Video</h3>
<a href="<?php echo $sermon['video_url']; ?>" target="_blank">View Sermon Video</a>
<?php endif; ?>

<?php if($sermon['pdf_url']): ?>
<h3>Download PDF</h3>
<a href="<?php echo $sermon['pdf_url']; ?>" target="_blank">Download Notes</a>
<?php endif; ?>

</div>
</body>
</html>
