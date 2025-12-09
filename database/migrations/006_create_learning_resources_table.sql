-- Migration: 006_create_learning_resources_table.sql
-- Description: Creates the learning_resources table for educator learning materials
-- Date: 2025-01-XX

CREATE TABLE IF NOT EXISTS learning_resources (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    educator_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    file_url VARCHAR(500),
    file_type ENUM('video', 'document', 'image', 'other') DEFAULT 'video',
    is_downloadable BOOLEAN DEFAULT FALSE,
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (educator_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_educator_id (educator_id),
    INDEX idx_category (category),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

