-- Migration: 010_update_projects_image_url.sql
-- Description: Updates image_url column to TEXT to support base64 images
-- Date: 2025-01-XX

-- The migration runner will check if column exists and either add or modify it
ALTER TABLE projects MODIFY COLUMN image_url TEXT;
