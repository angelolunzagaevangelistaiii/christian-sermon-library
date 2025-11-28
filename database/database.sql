CREATE DATABASE christian_sermon_library;
USE christian_sermon_library;

-- Users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- Sermons
CREATE TABLE sermons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    scripture VARCHAR(150),
    teacher VARCHAR(150),
    topic VARCHAR(50),
    video_url VARCHAR(255),
    pdf_url VARCHAR(255),
    notes TEXT,
	content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bookmarks
CREATE TABLE bookmarks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
	item_id INT,
    type VARCHAR(20),
    sermon_id INT,
    UNIQUE KEY unique_bookmark(user_id, sermon_id),
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(sermon_id) REFERENCES sermons(id),
	created_at DATETIME
);

INSERT INTO users (name, email, password) VALUES
('Test User', 'test@example.com', '$2y$10$QmVdV1C7IGqN9dW9I5tz1e9O5.1pLX/xmOZbDxYOfpEiyrJSpO1fu'); 

-- Sample Sermon
INSERT INTO sermons (title, scripture, teacher, topic, video_url, pdf_url, notes)
VALUES (
    'Walking in Holiness',
    '1 Peter 1:15-16',
    'Pastor John Doe',
    'Holiness',
    'https://youtube.com/example',
    'https://example.com/sermon.pdf',
    'Be holy for YHVH is holy.'
);

