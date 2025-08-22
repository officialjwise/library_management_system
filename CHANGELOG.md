# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2025-08-22

### Added
- KNUST-specific college and department integration (7 colleges, 34+ departments)
- Ghana Cedis (GH₵) currency support throughout the system
- African and Ghanaian authors pre-seeded in database
- Enhanced student registration with Index Number and College/Department fields
- Comprehensive book request system with 2-book limit
- Advanced book issuing system with ISBN support and author information
- Debug tools for troubleshooting (debug-request.php, test-book-request.php, etc.)
- Transaction-safe database operations with rollback support
- Enhanced error handling and user feedback
- Email-based authentication for students
- Auto-loading of student and book information in forms
- Proper URL encoding and parameter validation

### Changed
- Updated database schema to remove "tbl" prefix from all tables
- Modified student table structure for KNUST requirements (8-digit Student ID, 7-digit Index Number)
- Enhanced book table with VARCHAR ISBN support and DECIMAL pricing
- Improved user interface with better error/success messaging
- Updated all price displays to show Ghana Cedis formatting (GH₵XX.XX)
- Enhanced security with comprehensive input validation
- Improved responsive design for better mobile experience

### Fixed
- Book request system database field type mismatches (ISBN and price fields)
- Session variable warnings and undefined array key issues
- Book issuing logic errors and parameter validation
- Form field naming inconsistencies and typos
- URL generation issues in book request links
- Database transaction handling and error recovery
- Memory and security issues with proper session management

### Security
- Enhanced password encryption and session management
- Added comprehensive input sanitization
- Implemented CSRF protection on critical forms
- Added proper SQL injection prevention with PDO prepared statements
- Enhanced user authentication and authorization

### Documentation
- Complete README.md rewrite with KNUST-specific information
- Added comprehensive installation and setup instructions
- Created contributing guidelines and license file
- Added detailed system requirements and technical specifications
- Included troubleshooting guides and debug tools documentation

## [1.0.0] - 2024-XX-XX

### Initial Release
- Basic library management functionality
- Student and admin authentication systems
- Book and category management
- Basic reporting features
- Student registration and profile management
- Book issuing and return tracking
- Fine management system

---

### Legend
- **Added**: New features
- **Changed**: Changes in existing functionality
- **Deprecated**: Soon-to-be removed features
- **Removed**: Removed features
- **Fixed**: Bug fixes
- **Security**: Security improvements
