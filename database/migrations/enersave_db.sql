-- ============================================
-- EnerSave Database Schema
-- Complete database structure for EnerSave platform
-- ============================================

-- Create Database
CREATE DATABASE IF NOT EXISTS enersave_db;
USE enersave_db;

-- ============================================
-- TABLE: users
-- Stores all user accounts (Community, Supplier, Donor, Educator, Admin)
-- ============================================
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('COMMUNITY_USER', 'SUPPLIER_INSTALLER', 'EDUCATOR_ADVOCATE', 'DONOR_NGO', 'ADMIN') NOT NULL DEFAULT 'COMMUNITY_USER',
    is_verified BOOLEAN DEFAULT FALSE,
    status ENUM('active', 'banned') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username),
    INDEX idx_role (role),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample Users Data
INSERT INTO users (username, email, password_hash, role, is_verified, status) VALUES
('admin', 'admin@enersave.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ADMIN', TRUE, 'active'),
('steven_mitchell', 's.mitchell@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ADMIN', TRUE, 'active'),
('jer_erick', 'jer.erick@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'COMMUNITY_USER', TRUE, 'active'),
('monico_vian', 'monico.vian@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'COMMUNITY_USER', TRUE, 'active'),
('sarah_discaya', 'sarah.discaya@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SUPPLIER_INSTALLER', TRUE, 'banned'),
('crist_brader', 'cristbriand.brader.25@usjr.edu.ph', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'COMMUNITY_USER', TRUE, 'active');

-- ============================================
-- TABLE: password_reset_tokens
-- Stores password reset tokens for users
-- ============================================
CREATE TABLE IF NOT EXISTS password_reset_tokens (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_token (token),
    INDEX idx_user_id (user_id),
    INDEX idx_expires_at (expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- TABLE: products
-- Stores products offered by suppliers
-- ============================================
CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image_url VARCHAR(500),
    stock_quantity INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_supplier_id (supplier_id),
    INDEX idx_category (category),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample Products Data
INSERT INTO products (supplier_id, name, category, price, description, stock_quantity) VALUES
(5, 'Solar Panel Kit 100W', 'Solar Energy', 15000.00, 'Complete solar panel kit with inverter and battery', 10),
(5, 'Wind Turbine 500W', 'Wind Energy', 25000.00, 'Small wind turbine for residential use', 5),
(5, 'Hydro Generator 1kW', 'Hydro Energy', 35000.00, 'Micro hydroelectric generator', 3);

-- ============================================
-- TABLE: projects
-- Stores sustainability projects for crowdfunding
-- ============================================
CREATE TABLE IF NOT EXISTS projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    goal_amount DECIMAL(12, 2) NOT NULL,
    raised_amount DECIMAL(12, 2) DEFAULT 0.00,
    status ENUM('active', 'completed', 'cancelled', 'pending') DEFAULT 'active',
    image_url VARCHAR(500),
    location VARCHAR(255),
    created_by INT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at),
    INDEX idx_created_by (created_by)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample Projects Data
INSERT INTO projects (title, description, goal_amount, raised_amount, status, location, created_by) VALUES
('Solar Power for Rural Village', 'Install solar panels to provide electricity to a remote village', 500000.00, 125000.00, 'active', 'Rural Cebu', 3),
('Clean Water Initiative', 'Build a water filtration system for a community', 300000.00, 0.00, 'pending', 'Mountain Province', 4),
('Wind Energy Farm', 'Establish a small wind farm for sustainable energy', 1000000.00, 750000.00, 'active', 'Northern Luzon', 3);

-- ============================================
-- TABLE: donations
-- Stores donations made to projects
-- ============================================
CREATE TABLE IF NOT EXISTS donations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    project_id INT UNSIGNED NOT NULL,
    donor_id INT UNSIGNED NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'confirmed', 'failed') DEFAULT 'pending',
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (donor_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_project_id (project_id),
    INDEX idx_donor_id (donor_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample Donations Data
INSERT INTO donations (project_id, donor_id, amount, status, payment_method) VALUES
(1, 4, 5000.00, 'confirmed', 'Credit Card'),
(1, 3, 10000.00, 'confirmed', 'PayPal'),
(3, 4, 25000.00, 'confirmed', 'Bank Transfer');

-- ============================================
-- TABLE: learning_resources
-- Stores learning materials uploaded by educators
-- ============================================
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

-- Sample Learning Resources Data
INSERT INTO learning_resources (educator_id, title, description, file_type, category) VALUES
(1, 'How Solar Panels Work', 'Educational video explaining solar panel technology', 'video', 'Solar Energy'),
(1, 'Hydropower Basics', 'Introduction to hydropower generation', 'video', 'Hydro Energy'),
(1, 'Wind Energy Explained', 'Comprehensive guide to wind energy', 'video', 'Wind Energy');

-- ============================================
-- TABLE: forum_posts
-- Stores forum discussion posts
-- ============================================
CREATE TABLE IF NOT EXISTS forum_posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category VARCHAR(100),
    views INT UNSIGNED DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_author_id (author_id),
    INDEX idx_category (category),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample Forum Posts Data
INSERT INTO forum_posts (author_id, title, content, category, views) VALUES
(3, 'Best Practices for Solar Installation', 'Share your experiences and tips for installing solar panels in rural areas.', 'Solar Energy', 45),
(4, 'Community Energy Projects', 'Discussion about community-led renewable energy initiatives.', 'Community', 32),
(3, 'Funding Opportunities', 'Information about grants and funding for clean energy projects.', 'Funding', 28);

-- ============================================
-- TABLE: forum_replies
-- Stores replies to forum posts
-- ============================================
CREATE TABLE IF NOT EXISTS forum_replies (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    post_id INT UNSIGNED NOT NULL,
    author_id INT UNSIGNED NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES forum_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_post_id (post_id),
    INDEX idx_author_id (author_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample Forum Replies Data
INSERT INTO forum_replies (post_id, author_id, content) VALUES
(1, 4, 'Great post! I found that proper orientation is crucial for maximum efficiency.'),
(1, 3, 'Thanks for sharing! We also recommend regular maintenance checks.'),
(2, 3, 'Our community successfully implemented a solar project last year. Happy to share details!');

-- ============================================
-- TABLE: migrations
-- Tracks executed database migrations
-- ============================================
CREATE TABLE IF NOT EXISTS migrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    migration_name VARCHAR(255) NOT NULL UNIQUE,
    executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_migration_name (migration_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Verification Queries
-- ============================================
SHOW TABLES;

SELECT 'Users Table' AS 'Table', COUNT(*) AS 'Records' FROM users
UNION ALL
SELECT 'Products Table', COUNT(*) FROM products
UNION ALL
SELECT 'Projects Table', COUNT(*) FROM projects
UNION ALL
SELECT 'Donations Table', COUNT(*) FROM donations
UNION ALL
SELECT 'Learning Resources Table', COUNT(*) FROM learning_resources
UNION ALL
SELECT 'Forum Posts Table', COUNT(*) FROM forum_posts
UNION ALL
SELECT 'Forum Replies Table', COUNT(*) FROM forum_replies;

SELECT * FROM Users;
SELECT * FROM Products;
SELECT * FROM Donations;
SELECT * FROM Learning Resources;
SELECT * FROM forum_posts;

DROP TABLE Users;
