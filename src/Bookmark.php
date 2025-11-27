<?php

class Bookmark {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function toggleBookmark($user_id, $item_id, $type) {
        // Check if already bookmarked
        $stmt = $this->conn->prepare("SELECT id FROM bookmarks WHERE user_id=? AND item_id=? AND type=?");
        $stmt->execute([$user_id, $item_id, $type]);
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Remove bookmark
            $stmt = $this->conn->prepare("DELETE FROM bookmarks WHERE user_id=? AND item_id=? AND type=?");
            $stmt->execute([$user_id, $item_id, $type]);
            return false;
        } else {
            // Add bookmark
            $stmt = $this->conn->prepare(
                "INSERT INTO bookmarks (user_id, item_id, type, created_at) VALUES (?, ?, ?, NOW())"
            );
            $stmt->execute([$user_id, $item_id, $type]);
            return true;
        }
    }
}
?>