<?php
session_start();
require_once '../src/db.php';
require_once '../src/functions.php';
requireLogin();

$sermons = $mysqli->query("SELECT * FROM sermons ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Sermon Library</title>
<link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
<a href="logout.php">Logout</a>
<hr>

<input type="text" id="search" placeholder="Search sermons..." onkeyup="searchSermons()">

<div id="results">
<?php while($s = $sermons->fetch_assoc()): ?>
    <div class="sermon-box">
        <h3><a href="sermon.php?id=<?php echo $s['id']; ?>"><?php echo $s['title']; ?></a></h3>
        <p><strong>Scripture:</strong> <?php echo $s['scripture']; ?></p>
        <p><strong>Teacher:</strong> <?php echo $s['teacher']; ?></p>
        <p><strong>Topic:</strong> <?php echo $s['topic']; ?></p>
    </div>
<?php endwhile; ?>
</div>

<script src="script.js"></script>
</div>
</body>
</html>
