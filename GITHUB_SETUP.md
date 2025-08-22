# GitHub Setup Guide for KNUST Library Management System

This guide helps you set up the KNUST Library Management System from GitHub in various environments.

## 🚀 Quick Deployment

### For XAMPP Users (Windows/Linux)

```bash
# 1. Clone the repository
git clone https://github.com/officialjwise/knust-library-management-system.git

# 2. Move to XAMPP directory
mv knust-library-management-system /opt/lampp/htdocs/library
# OR for Windows: move to C:\xampp\htdocs\library\

# 3. Start XAMPP services
sudo /opt/lampp/lampp start
# OR use XAMPP Control Panel on Windows

# 4. Create database
mysql -u root -p -e "CREATE DATABASE library;"
mysql -u root -p library < /opt/lampp/htdocs/library/library.sql

# 5. Access the application
# http://localhost/library/ (Student Portal)
# http://localhost/library/admin/ (Admin Portal)
```

### For MAMP Users (macOS)

```bash
# 1. Clone the repository
git clone https://github.com/officialjwise/knust-library-management-system.git

# 2. Move to MAMP directory
mv knust-library-management-system /Applications/MAMP/htdocs/library

# 3. Start MAMP services
# Use MAMP application to start Apache and MySQL

# 4. Import database via phpMyAdmin
# Navigate to http://localhost:8888/phpMyAdmin
# Create database 'library'
# Import library.sql file

# 5. Access the application
# http://localhost:8888/library/ (Student Portal)
# http://localhost:8888/library/admin/ (Admin Portal)
```

### For Docker Users

```bash
# 1. Clone the repository
git clone https://github.com/officialjwise/knust-library-management-system.git
cd knust-library-management-system

# 2. Create docker-compose.yml (example)
cat > docker-compose.yml << EOF
version: '3.8'
services:
  web:
    image: php:7.4-apache
    ports:
      - "80:80"
    volumes:
      - .:/var/www/html
    depends_on:
      - db
  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: library
    volumes:
      - ./library.sql:/docker-entrypoint-initdb.d/library.sql
    ports:
      - "3306:3306"
EOF

# 3. Start containers
docker-compose up -d

# 4. Access the application
# http://localhost/ (Student Portal)
# http://localhost/admin/ (Admin Portal)
```

## 🔧 Configuration

### Database Configuration

Update the following files with your database credentials:

1. **Student Portal Config**: `includes/config.php`
```php
<?php
$host = "localhost";
$user = "root";        // Your MySQL username
$password = "";        // Your MySQL password
$database = "library"; // Database name
?>
```

2. **Admin Portal Config**: `admin/includes/config.php`
```php
<?php
$host = "localhost";
$user = "root";        // Your MySQL username
$password = "";        // Your MySQL password
$database = "library"; // Database name
?>
```

### Default Login Credentials

After setup, use these credentials:

**Admin Access:**
- Username: `admin`
- Password: `admin123`

**Test Student Access:**
- Email: `officialjwise20@gmail.com`
- Password: (set during registration)

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check your MySQL service is running
   - Verify database credentials in config files
   - Ensure database 'library' exists

2. **Permission Issues**
   - Set proper file permissions: `chmod 755 -R /path/to/library`
   - Ensure web server can read/write files

3. **Port Conflicts**
   - XAMPP: Apache (80), MySQL (3306)
   - MAMP: Apache (8888), MySQL (8889)
   - Adjust ports in your environment

4. **Import Errors**
   - Ensure you're importing `library.sql` not individual files
   - Check MySQL version compatibility
   - Use phpMyAdmin if command line fails

### PHP Requirements Check

Create a file `check.php` in the project root:

```php
<?php
echo "PHP Version: " . phpversion() . "<br>";
echo "MySQL Extension: " . (extension_loaded('mysql') ? 'Yes' : 'No') . "<br>";
echo "MySQLi Extension: " . (extension_loaded('mysqli') ? 'Yes' : 'No') . "<br>";
echo "PDO MySQL Extension: " . (extension_loaded('pdo_mysql') ? 'Yes' : 'No') . "<br>";
echo "Session Support: " . (function_exists('session_start') ? 'Yes' : 'No') . "<br>";
?>
```

Access via browser to check compatibility.

## 📧 Support

If you encounter issues:

1. Check the [GitHub Issues](https://github.com/officialjwise/knust-library-management-system/issues)
2. Create a new issue with detailed error description
3. Include your environment details (OS, PHP version, MySQL version)

## 🎯 Next Steps

After successful setup:

1. **Customize for your institution**:
   - Update college/department data
   - Modify book categories
   - Add your institution's books

2. **Security hardening**:
   - Change default admin password
   - Update database passwords
   - Enable HTTPS in production

3. **Backup setup**:
   - Regular database backups
   - File system backups
   - Version control your customizations

---

**Happy coding! 🚀**
