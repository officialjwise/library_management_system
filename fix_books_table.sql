-- Fix books table structure for proper ISBN and Price handling
-- Run this SQL to fix the issues with adding/updating books

-- First, let's fix the ISBNNumber field to handle VARCHAR data
ALTER TABLE `books` MODIFY COLUMN `ISBNNumber` VARCHAR(20) DEFAULT NULL;

-- Fix the BookPrice field to handle decimal values for currency
ALTER TABLE `books` MODIFY COLUMN `BookPrice` DECIMAL(10,2) DEFAULT NULL;

-- Add any missing indexes for better performance
CREATE INDEX idx_books_isbn ON books(ISBNNumber);
CREATE INDEX idx_books_category ON books(CatId);
CREATE INDEX idx_books_author ON books(AuthorId);

-- Verify the changes
DESCRIBE books;
