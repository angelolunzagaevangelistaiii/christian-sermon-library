<?php
require_once '../src/db.php';

$q = $_GET['q'];
$res = $mysqli->query("SELECT * FROM sermons WHERE title LIKE '%$q%' OR scripture LIKE '%$q%' OR teacher LIKE '%$q%'");

while($s = $res->fetch_assoc()) {
    echo "
    <div class='sermon-box'>
        <h3><a href='sermon.php?id={$s['id']}'>{$s['title']}</a></h3>
        <p><strong>Scripture:</strong> {$s['scripture']}</p>
        <p><strong>Teacher:</strong> {$s['teacher']}</p>
        <p><strong>Topic:</strong> {$s['topic']}</p>
    </div>";
}
