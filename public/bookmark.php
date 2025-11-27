<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Bookmark.php';

session_start();

header("Content-Type: application/json");

// Ensure logged-in user
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "You must login first"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$item_id = $_POST['item_id'] ?? null;
$type = $_POST['type'] ?? null;

if (!$item_id || !$type) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$bookmark = new Bookmark($conn);
$marked = $bookmark->toggleBookmark($user_id, $item_id, $type);

echo json_encode([
    "status" => "success",
    "bookmarked" => $marked
]);
