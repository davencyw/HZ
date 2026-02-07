-- Database schema for wedding website

CREATE DATABASE IF NOT EXISTS hochzeit CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE hochzeit;

CREATE TABLE IF NOT EXISTS rsvp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    guests INT DEFAULT 1,
    attending ENUM('yes', 'no', 'maybe') NOT NULL,
    dietary_requirements TEXT,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_email ON rsvp(email);
