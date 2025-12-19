-- Migration: 011_add_created_by_to_projects.sql
-- Description: Adds created_by column to projects table if it doesn't exist
-- Date: 2025-01-XX

ALTER TABLE projects ADD COLUMN created_by INT UNSIGNED AFTER image_url;
ALTER TABLE projects ADD CONSTRAINT fk_projects_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL;

