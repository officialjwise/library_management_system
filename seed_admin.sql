-- Seed admin user for Library Management System
-- Username: admin
-- Password: admin123 (you should change this after first login)

USE library;

-- Clear existing admin data (optional - remove if you want to keep existing admins)
-- DELETE FROM admin;

-- Insert admin user
INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Administrator', 'admin@library.com', 'admin', '0192023a7bbd73250516f069df18b500', NOW());

-- Display success message
SELECT 'Admin user created successfully!' as Message;
SELECT 'Username: admin' as LoginDetails;
SELECT 'Password: admin123' as PasswordInfo;
SELECT 'Please change the password after first login for security.' as SecurityNote;
