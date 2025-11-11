-- Ensure schema exists and is selected
CREATE DATABASE IF NOT EXISTS enersave_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE enersave_db;

-- Users and Roles
CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  contact_number VARCHAR(50) NULL,
  date_of_birth DATE NULL,
  role ENUM('COMMUNITY_USER','SUPPLIER_INSTALLER','DONOR_NGO','EDUCATOR_ADVOCATE','ADMIN') NOT NULL DEFAULT 'COMMUNITY_USER',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY idx_users_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Products (owned by Supplier/Installer users)
CREATE TABLE IF NOT EXISTS products (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  supplier_id INT UNSIGNED NOT NULL,
  name VARCHAR(150) NOT NULL,
  category VARCHAR(100) NOT NULL,
  price DECIMAL(12,2) NOT NULL DEFAULT 0,
  description TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_products_supplier FOREIGN KEY (supplier_id) REFERENCES users(id) ON DELETE CASCADE,
  KEY idx_products_supplier (supplier_id),
  KEY idx_products_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Projects (can be proposed by community/supplier/admin)
CREATE TABLE IF NOT EXISTS projects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  title VARCHAR(180) NOT NULL,
  description TEXT NULL,
  target_amount DECIMAL(14,2) NOT NULL DEFAULT 0,
  raised_amount DECIMAL(14,2) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_projects_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  KEY idx_projects_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Donations (by Donor/NGO to Projects)
CREATE TABLE IF NOT EXISTS donations (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  donor_id INT UNSIGNED NOT NULL,
  project_id INT UNSIGNED NOT NULL,
  amount DECIMAL(14,2) NOT NULL,
  donated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_donations_donor FOREIGN KEY (donor_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_donations_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
  KEY idx_donations_project (project_id),
  KEY idx_donations_donor (donor_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Learning resources (uploaded by Educator/Advocate)
CREATE TABLE IF NOT EXISTS learning_resources (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  uploader_id INT UNSIGNED NOT NULL,
  title VARCHAR(180) NOT NULL,
  type VARCHAR(100) NOT NULL,
  download_link VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_resources_uploader FOREIGN KEY (uploader_id) REFERENCES users(id) ON DELETE CASCADE,
  KEY idx_resources_uploader (uploader_id),
  KEY idx_resources_type (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inquiries/Feedback from users to suppliers about products
CREATE TABLE IF NOT EXISTS product_inquiries (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  product_id INT UNSIGNED NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_inquiries_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_inquiries_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
  KEY idx_inquiries_product (product_id),
  KEY idx_inquiries_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


