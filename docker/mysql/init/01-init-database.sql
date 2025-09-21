-- Classera EMS Database Initialization Script
-- This script creates the initial database structure

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `classera_ems` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the database
USE `classera_ems`;

-- Create initial configuration
INSERT IGNORE INTO `config_items` (`name`, `code`, `type`, `label`, `value`, `default_value`, `editable`, `visible`, `field_type`, `option_type`, `created_user_id`, `created`) VALUES
('Classera EMS', 'classera_ems_name', 'System', 'System Name', 'Classera EMS', 'Classera EMS', 1, 1, 'string', NULL, 1, NOW()),
('Classera Education Management System', 'classera_ems_description', 'System', 'System Description', 'Classera Education Management System', 'Classera Education Management System', 1, 1, 'text', NULL, 1, NOW()),
('https://classera.com', 'classera_ems_website', 'System', 'Website', 'https://classera.com', 'https://classera.com', 1, 1, 'string', NULL, 1, NOW()),
('support@classera.com', 'classera_ems_support_email', 'System', 'Support Email', 'support@classera.com', 'support@classera.com', 1, 1, 'string', NULL, 1, NOW());

-- Create default admin user (password: admin123)
INSERT IGNORE INTO `security_users` (`username`, `password`, `first_name`, `last_name`, `email`, `status`, `created_user_id`, `created`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System', 'Administrator', 'admin@classera.com', 1, 1, NOW());

-- Create default security role
INSERT IGNORE INTO `security_roles` (`name`, `code`, `created_user_id`, `created`) VALUES
('System Administrator', 'SYSTEM_ADMIN', 1, NOW()),
('School Administrator', 'SCHOOL_ADMIN', 1, NOW()),
('Teacher', 'TEACHER', 1, NOW()),
('Student', 'STUDENT', 1, NOW());

-- Assign admin role to admin user
INSERT IGNORE INTO `security_group_users` (`security_group_id`, `security_user_id`, `created_user_id`, `created`) VALUES
(1, 1, 1, NOW());

-- Create default academic period
INSERT IGNORE INTO `academic_periods` (`name`, `code`, `start_date`, `end_date`, `current`, `created_user_id`, `created`) VALUES
('Academic Year 2024-2025', 'AY2024-2025', '2024-09-01', '2025-06-30', 1, 1, NOW());

-- Create default institution types
INSERT IGNORE INTO `institution_types` (`name`, `code`, `created_user_id`, `created`) VALUES
('Primary School', 'PRIMARY', 1, NOW()),
('Secondary School', 'SECONDARY', 1, NOW()),
('High School', 'HIGH_SCHOOL', 1, NOW()),
('University', 'UNIVERSITY', 1, NOW());

-- Create default student statuses
INSERT IGNORE INTO `student_statuses` (`name`, `code`, `created_user_id`, `created`) VALUES
('Active', 'ACTIVE', 1, NOW()),
('Inactive', 'INACTIVE', 1, NOW()),
('Graduated', 'GRADUATED', 1, NOW()),
('Transferred', 'TRANSFERRED', 1, NOW());

-- Create default staff statuses
INSERT IGNORE INTO `staff_statuses` (`name`, `code`, `created_user_id`, `created`) VALUES
('Active', 'ACTIVE', 1, NOW()),
('Inactive', 'INACTIVE', 1, NOW()),
('Retired', 'RETIRED', 1, NOW()),
('Resigned', 'RESIGNED', 1, NOW());

-- Create default genders
INSERT IGNORE INTO `genders` (`name`, `code`, `created_user_id`, `created`) VALUES
('Male', 'MALE', 1, NOW()),
('Female', 'FEMALE', 1, NOW()),
('Other', 'OTHER', 1, NOW());

-- Create default countries
INSERT IGNORE INTO `countries` (`name`, `code`, `created_user_id`, `created`) VALUES
('United States', 'US', 1, NOW()),
('Canada', 'CA', 1, NOW()),
('United Kingdom', 'GB', 1, NOW()),
('Australia', 'AU', 1, NOW());

-- Create default labels for Classera EMS
INSERT IGNORE INTO `labels` (`module`, `field`, `code`, `en`, `created_user_id`, `created`) VALUES
('System', 'name', 'SYSTEM_NAME', 'Classera EMS', 1, NOW()),
('System', 'description', 'SYSTEM_DESCRIPTION', 'Classera Education Management System', 1, NOW()),
('System', 'version', 'SYSTEM_VERSION', '1.0.0', 1, NOW()),
('System', 'copyright', 'SYSTEM_COPYRIGHT', 'Copyright © 2024 Classera. All rights reserved.', 1, NOW());
