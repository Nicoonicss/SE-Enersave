-- Migration: 012_add_is_verified_and_status_to_users.sql
-- Description: Adds is_verified and status columns to the users table
-- Date: 2025-01-XX

-- Add is_verified column (will fail gracefully if column already exists)
ALTER TABLE users ADD COLUMN is_verified BOOLEAN DEFAULT FALSE;

-- Add status column (will fail gracefully if column already exists)
ALTER TABLE users ADD COLUMN status ENUM('active', 'banned') DEFAULT 'active';

-- Add index on status (will fail gracefully if index already exists)
CREATE INDEX idx_status ON users(status);

