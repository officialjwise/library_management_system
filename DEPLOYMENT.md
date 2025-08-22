# Production Deployment Checklist

## 🚀 Pre-Deployment

### Code Review
- [ ] All dummy data removed
- [ ] No debugging code in production files
- [ ] Proper error handling implemented
- [ ] Input validation on all forms
- [ ] SQL injection protection verified
- [ ] Session security implemented

### Database
- [ ] Production database created
- [ ] Database user with limited privileges created
- [ ] Database import completed successfully
- [ ] Default admin password changed
- [ ] Test data cleaned up
- [ ] Backup strategy implemented

### Security
- [ ] Change all default passwords
- [ ] Update database credentials
- [ ] Remove debug files from production
- [ ] Configure proper file permissions
- [ ] Enable HTTPS
- [ ] Configure session security
- [ ] Set up rate limiting (optional)

### Configuration
- [ ] Update config files with production settings
- [ ] Set proper error reporting levels
- [ ] Configure email settings (if applicable)
- [ ] Update file upload limits
- [ ] Configure timezone settings

## 🔧 Deployment Steps

### 1. Server Setup
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install LAMP stack
sudo apt install apache2 mysql-server php php-mysql libapache2-mod-php -y

# Enable Apache modules
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 2. Project Deployment
```bash
# Clone repository
git clone https://github.com/officialjwise/knust-library-management-system.git

# Move to web directory
sudo mv knust-library-management-system /var/www/html/library

# Set permissions
sudo chown -R www-data:www-data /var/www/html/library
sudo chmod -R 755 /var/www/html/library
```

### 3. Database Setup
```bash
# Secure MySQL installation
sudo mysql_secure_installation

# Create database and user
mysql -u root -p << EOF
CREATE DATABASE library;
CREATE USER 'library_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON library.* TO 'library_user'@'localhost';
FLUSH PRIVILEGES;
USE library;
SOURCE /var/www/html/library/library.sql;
EOF
```

### 4. Configuration Update
```bash
# Update config files
nano /var/www/html/library/includes/config.php
nano /var/www/html/library/admin/includes/config.php

# Remove setup files
rm /var/www/html/library/debug-*.php
rm /var/www/html/library/test-*.php
rm /var/www/html/library/check-session.php
```

## 🛡️ Security Hardening

### File Permissions
```bash
# Set strict permissions
find /var/www/html/library -type d -exec chmod 755 {} \;
find /var/www/html/library -type f -exec chmod 644 {} \;

# Protect config files
chmod 600 /var/www/html/library/includes/config.php
chmod 600 /var/www/html/library/admin/includes/config.php
```

### Apache Security
```apache
# Add to .htaccess or virtual host
<Files "*.php">
    Order Deny,Allow
    Allow from all
</Files>

<Files "config.php">
    Order Deny,Allow
    Deny from all
</Files>

# Disable directory browsing
Options -Indexes

# Prevent access to sensitive files
<FilesMatch "\.(sql|log|md)$">
    Order Deny,Allow
    Deny from all
</FilesMatch>
```

### MySQL Security
```sql
-- Remove default accounts
DELETE FROM mysql.user WHERE User='';
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');

-- Set strong password policy
SET GLOBAL validate_password.policy = 'STRONG';
SET GLOBAL validate_password.length = 12;
```

## 📊 Post-Deployment

### Testing
- [ ] Admin login functionality
- [ ] Student registration and login
- [ ] Book management operations
- [ ] Book issuing workflow
- [ ] Book request system
- [ ] Report generation
- [ ] All forms and validation
- [ ] Database integrity
- [ ] Session handling
- [ ] Error pages

### Monitoring
- [ ] Set up log monitoring
- [ ] Configure database monitoring
- [ ] Set up uptime monitoring
- [ ] Configure backup monitoring
- [ ] Set up security alerts

### Backup Strategy
```bash
# Daily database backup
0 2 * * * mysqldump -u library_user -p'secure_password' library > /backups/library_$(date +\%Y\%m\%d).sql

# Weekly full backup
0 3 * * 0 tar -czf /backups/library_full_$(date +\%Y\%m\%d).tar.gz /var/www/html/library

# Cleanup old backups (keep 30 days)
0 4 * * * find /backups -name "library_*.sql" -mtime +30 -delete
```

## 🔍 Health Checks

### Database Health
```sql
-- Check tables
SHOW TABLES;

-- Verify data
SELECT COUNT(*) FROM students;
SELECT COUNT(*) FROM books;
SELECT COUNT(*) FROM admin;

-- Check for errors
SHOW ENGINE INNODB STATUS;
```

### Application Health
```bash
# Check PHP errors
tail -f /var/log/apache2/error.log

# Monitor access logs
tail -f /var/log/apache2/access.log

# Check disk space
df -h

# Monitor memory usage
free -m
```

### Performance Optimization
```apache
# Enable compression
LoadModule deflate_module modules/mod_deflate.so
<Location />
    SetOutputFilter DEFLATE
    SetEnvIfNoCase Request_URI \
        \.(?:gif|jpe?g|png)$ no-gzip dont-vary
    SetEnvIfNoCase Request_URI \
        \.(?:exe|t?gz|zip|bz2|sit|rar)$ no-gzip dont-vary
</Location>

# Browser caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
</IfModule>
```

## 📈 Maintenance

### Regular Tasks
- [ ] Database backup verification
- [ ] Log file rotation
- [ ] Security updates
- [ ] Performance monitoring
- [ ] User feedback review
- [ ] System resource monitoring

### Monthly Tasks
- [ ] Full system backup
- [ ] Security audit
- [ ] Performance review
- [ ] Update dependencies
- [ ] Review access logs
- [ ] Database optimization

### Emergency Procedures
```bash
# Quick rollback
cp /backups/library_latest.tar.gz /var/www/html/
tar -xzf library_latest.tar.gz

# Database restore
mysql -u library_user -p library < /backups/library_latest.sql

# Service restart
sudo systemctl restart apache2
sudo systemctl restart mysql
```

---

**Production deployment complete! 🎉**

For issues, check logs and GitHub issues: https://github.com/officialjwise/knust-library-management-system/issues
