#!/bin/bash

# Script to replace table names in PHP files
# Remove tbl prefix from all table references

echo "Updating table references in PHP files..."

# Replace tblstudents with students
find . -name "*.php" -type f -exec sed -i '' 's/tblstudents/students/g' {} \;

# Replace tblbooks with books  
find . -name "*.php" -type f -exec sed -i '' 's/tblbooks/books/g' {} \;

# Replace tblcategory with category
find . -name "*.php" -type f -exec sed -i '' 's/tblcategory/category/g' {} \;

# Replace tblauthors with authors
find . -name "*.php" -type f -exec sed -i '' 's/tblauthors/authors/g' {} \;

# Replace tblissuedbookdetails with issuedbookdetails
find . -name "*.php" -type f -exec sed -i '' 's/tblissuedbookdetails/issuedbookdetails/g' {} \;

# Replace tblrequestedbookdetails with requestedbookdetails
find . -name "*.php" -type f -exec sed -i '' 's/tblrequestedbookdetails/requestedbookdetails/g' {} \;

# Replace tblfine with fine
find . -name "*.php" -type f -exec sed -i '' 's/tblfine/fine/g' {} \;

echo "Table references updated successfully!"
echo "Updated tables:"
echo "- tblstudents -> students"
echo "- tblbooks -> books"
echo "- tblcategory -> category"
echo "- tblauthors -> authors"
echo "- tblissuedbookdetails -> issuedbookdetails"
echo "- tblrequestedbookdetails -> requestedbookdetails"
echo "- tblfine -> fine"
