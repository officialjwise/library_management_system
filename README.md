# KNUST Library Management System

A comprehensive web-based Library Management System specifically designed for **Kwame Nkrumah University of Science and Technology (KNUST)**. This system automates library operations and provides efficient management of books, students, and library transactions.

> 🚀 **Now Available on GitHub!** This project has been completely refactored, localized for Ghana/KNUST, and is now production-ready. All features have been tested and the system is ready for deployment.

## 🎯 **Project Overview**

This Library Management System transforms manual library operations into a modern, automated digital platform. Built with PHP and MySQL, it provides separate interfaces for administrators and students with role-based access control.

### 🏛️ **KNUST-Specific Features**
- **KNUST College Integration**: All 7 KNUST colleges pre-configured
- **Department Management**: 34+ academic departments across all colleges
- **Student ID Format**: 8-digit Student ID + 7-digit Index Number (KNUST standard)
- **Ghana Cedis (GH₵)**: Localized currency for book pricing
- **African Literature Focus**: Pre-seeded with Ghanaian and African authors
- **Local Content**: Categories and books relevant to African academic context

## ✨ **Key Features**

### 👨‍💼 **Administrator Features**
- **Dashboard**: Comprehensive overview with statistics and charts
- **Student Management**: Registration, profile management, status control
- **Book Management**: Add, edit, delete books with ISBN support
- **Category & Author Management**: Organize library content efficiently
- **Book Issuing System**: Issue books to students with availability checks
- **Request Management**: Handle student book requests
- **Reports Generation**: Detailed reports and analytics
- **Fine Management**: Set and track overdue fines
- **Security**: Password encryption and session management

### 👨‍🎓 **Student Features**
- **Email-based Login**: Secure authentication using email addresses
- **Book Request System**: Request books with 2-book limit
- **Profile Management**: Update personal information
- **Book Search**: Browse available books by category/author
- **Issue History**: Track borrowed books and due dates
- **Password Recovery**: Forgot password functionality

### 🔧 **Technical Features**
- **Responsive Design**: Bootstrap-based UI works on all devices
- **Security**: MD5 password encryption, session management, CAPTCHA
- **Database Integrity**: Transaction-safe operations with rollback support
- **Error Handling**: Comprehensive error reporting and user feedback
- **Validation**: Input validation and sanitization
- **SEO Friendly**: Clean URLs and proper meta tags

## 🏗️ **System Architecture**

### **Database Structure**
- **Students Table**: KNUST-specific fields (StudentId, IndexNumber, College, Department)
- **Books Table**: ISBN support, pricing in GH₵, copy tracking
- **Categories & Authors**: Pre-seeded with relevant African content
- **Issue Tracking**: Complete book issuing and return workflow
- **Request System**: Student book request management

### **Security Features**
- Role-based access control (Admin/Student)
- Session-based authentication
- Password encryption (MD5)
- Input validation and sanitization
- CSRF protection on forms
- SQL injection prevention (PDO prepared statements)

## 🚀 **Installation & Setup**

### **Quick Start** 🏃‍♂️

For experienced developers who want to get started immediately:

```bash
# Clone the repository
git clone https://github.com/officialjwise/knust-library-management-system.git

# Navigate to project directory
cd knust-library-management-system

# Copy to your web server directory (adjust path as needed)
cp -r . /Applications/MAMP/htdocs/library/

# Import database (via phpMyAdmin or command line)
mysql -u root -p -e "CREATE DATABASE library;"
mysql -u root -p library < library.sql

# Update config file with your database credentials
# Edit includes/config.php and admin/includes/config.php

# Access the application
# Student Portal: http://localhost/library/
# Admin Portal: http://localhost/library/admin/
```

### **Prerequisites**
- **Web Server**: Apache (XAMPP/MAMP recommended)
- **Database**: MySQL 5.7+ or MariaDB
- **PHP**: Version 7.4 or higher
- **Browser**: Modern web browser with JavaScript enabled

### **Installation Steps**

1. **Clone the Repository**
   ```bash
   git clone https://github.com/officialjwise/knust-library-management-system.git
   cd knust-library-management-system
   ```

2. **Setup Web Server**
   - Install XAMPP/MAMP/WAMP
   - Copy project files to `htdocs` folder
   - Start Apache and MySQL services

3. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create new database named `library`
   - Import `library.sql` file
   - Database will be pre-seeded with KNUST-specific data

4. **Configuration**
   - Update database credentials in `includes/config.php`
   - Update admin credentials in `admin/includes/config.php`
   - Ensure proper file permissions

5. **Access the System**
   - **Student Portal**: http://localhost/library/
   - **Admin Portal**: http://localhost/library/admin/

### **Default Credentials**

#### Admin Access
- **Username**: `admin`
- **Password**: `admin123`

#### Sample Student Access
- **Email**: `officialjwise20@gmail.com`
- **Password**: (as set during registration)

## 📊 **Pre-seeded Data**

### **KNUST Colleges (7)**
- College of Engineering (COE)
- College of Science (COS)
- College of Agriculture and Natural Resources (CANR)
- College of Architecture and Planning (CAP)
- College of Art and Built Environment (CABE)
- College of Health Sciences (CHS)
- College of Humanities and Social Sciences (CHASS)

### **Academic Departments (34+)**
All major KNUST departments across all colleges pre-configured

### **Book Categories (5)**
- Fiction & Literature
- Science & Technology
- Business & Economics
- Education & Social Sciences
- Personal Development

### **Authors & Books**
- 25+ African and Ghanaian authors
- 25+ pre-seeded books with proper ISBN numbers
- Pricing in Ghana Cedis (GH₵)

## 🔧 **System Requirements**

### **Minimum Requirements**
- **RAM**: 512MB
- **Storage**: 100MB free space
- **PHP**: 7.4+
- **MySQL**: 5.7+
- **Browser**: Chrome 60+, Firefox 55+, Safari 10+

### **Recommended Requirements**
- **RAM**: 2GB+
- **Storage**: 1GB free space
- **PHP**: 8.0+
- **MySQL**: 8.0+
- **SSD**: For better performance

## 📱 **Screenshots**

### Admin Interface
![Admin Dashboard](Screenshots/admin_dashboard.png)
*Comprehensive admin dashboard with statistics*

![Manage Books](Screenshots/manage_books.png)
*Book management with GH₵ pricing*

![Issue Book](Screenshots/issue_book.png)
*Book issuing system with ISBN support*

### Student Interface
![Login Page](Screenshots/Login.png)
*Student login with email authentication*

![Request Books](Screenshots/request_a_book.png)
*Student book request interface*

![Profile Management](Screenshots/profile.png)
*Student profile with KNUST-specific fields*

## 🤝 **Contributing**

We welcome contributions to improve the KNUST Library Management System!

### **How to Contribute**
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### **Contribution Guidelines**
- Follow PSR-12 coding standards for PHP
- Write clear commit messages
- Test your changes thoroughly
- Update documentation as needed
- Ensure compatibility with existing features

## 🐛 **Bug Reports & Feature Requests**

- **Bug Reports**: Please use GitHub Issues with detailed description
- **Feature Requests**: Submit through GitHub Issues with `enhancement` label
- **Security Issues**: Contact maintainers directly

## 🔄 **Version History**

### **v2.0.0** (Current - GitHub Release)
- 🚀 **GitHub Deployment**: Project now available on GitHub
- ✅ **KNUST-specific implementation**: Complete transformation for KNUST context
- ✅ **Ghana Cedis (GH₵)**: Localized currency integration
- ✅ **Enhanced security**: Comprehensive validation and error handling
- ✅ **Improved UI/UX**: Modern, responsive design
- ✅ **African content**: Localized categories, authors, and books
- ✅ **Book request system**: Complete overhaul with 2-book limit
- ✅ **Admin book issuing**: Enhanced workflow with ISBN support
- ✅ **Student management**: KNUST ID format and college/department integration
- ✅ **Production ready**: Comprehensive testing and documentation
- ✅ **Clean codebase**: Removed all dummy data and prefixes

### **v1.0.0** (Base)
- Basic library management functionality
- Student and admin portals
- Book and category management
- Report generation

## 📄 **License**

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 **Author & Maintainer**

**Developer**: [officialjwise](https://github.com/officialjwise)
- GitHub: [@officialjwise](https://github.com/officialjwise)
- Email: officialjwise20@gmail.com

## 🙏 **Acknowledgments**

- **KNUST**: For providing the institutional context and requirements
- **PHP Guru Kul**: For the original library management system foundation
- **Bootstrap Team**: For the responsive UI framework
- **MySQL Team**: For the robust database system
- **Apache Foundation**: For the web server platform

## 🔗 **Useful Links**

- **GitHub Repository**: [KNUST Library Management System](https://github.com/officialjwise/knust-library-management-system)
- **Live Demo**: [Coming Soon]
- **Documentation**: [Wiki Pages](https://github.com/officialjwise/knust-library-management-system/wiki)
- **Issue Tracker**: [GitHub Issues](https://github.com/officialjwise/knust-library-management-system/issues)
- **Releases**: [GitHub Releases](https://github.com/officialjwise/knust-library-management-system/releases)

---

**⭐ If this project helped you, please consider giving it a star on GitHub!**

---

*Built with ❤️ for KNUST and the academic community*
