<?php

class Sermon {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function uploadSermon($title, $content) {
        $stmt = $this->conn->prepare("INSERT INTO sermons (title, content, created_at) VALUES (?, ?, NOW())");
        return $stmt->execute([$title, $content]);
    }

    public function getAllSermons() {
        $result = $this->conn->query("SELECT * FROM sermons ORDER BY created_at DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>