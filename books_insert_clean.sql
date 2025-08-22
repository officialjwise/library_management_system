-- Clean INSERT query for books - Ready to execute
-- Run this after importing the main library.sql file

USE library;

INSERT INTO `books` (`id`, `BookName`, `Copies`, `IssuedCopies`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `RegDate`, `UpdationDate`) VALUES
(1, 'Things Fall Apart', 5, 0, 1, 1, '9780385474542', 45.00, NOW(), NULL),
(2, 'Homegoing', 3, 0, 1, 7, '9781101947135', 65.00, NOW(), NULL),
(3, 'The Beautyful Ones Are Not Yet Born', 4, 0, 1, 3, '9780435905200', 35.00, NOW(), NULL),
(4, 'Changes: A Love Story', 3, 0, 1, 2, '9780435909741', 40.00, NOW(), NULL),
(5, 'Purple Hibiscus', 4, 0, 1, 17, '9780007189885', 50.00, NOW(), NULL),
(6, 'Introduction to Computer Science', 6, 0, 2, 11, '9780134444321', 120.00, NOW(), NULL),
(7, 'Advanced Mathematics for Engineers', 4, 0, 2, 12, '9781234567890', 95.00, NOW(), NULL),
(8, 'Physics Principles and Applications', 5, 0, 2, 13, '9780987654321', 110.00, NOW(), NULL),
(9, 'Chemistry in Everyday Life', 3, 0, 2, 14, '9781111111111', 85.00, NOW(), NULL),
(10, 'Statistics for Data Analysis', 4, 0, 2, 15, '9782222222222', 105.00, NOW(), NULL),
(11, 'African Business Leadership', 3, 0, 3, 12, '9783333333333', 75.00, NOW(), NULL),
(12, 'Economics of Development in Africa', 4, 0, 3, 20, '9784444444444', 90.00, NOW(), NULL),
(13, 'Entrepreneurship in Ghana', 2, 0, 3, 23, '9785555555555', 80.00, NOW(), NULL),
(14, 'Marketing in African Context', 3, 0, 3, 19, '9786666666666', 70.00, NOW(), NULL),
(15, 'Financial Management Principles', 4, 0, 3, 21, '9787777777777', 95.00, NOW(), NULL),
(16, 'Ghana: The Autobiography of Kwame Nkrumah', 4, 0, 4, 5, '9780717804992', 60.00, NOW(), NULL),
(17, 'The African Genius', 3, 0, 4, 16, '9780333234567', 55.00, NOW(), NULL),
(18, 'History of the Gold Coast and Ashanti', 2, 0, 4, 25, '9780543987654', 85.00, NOW(), NULL),
(19, 'Pan-Africanism and Liberation', 3, 0, 4, 18, '9780876543210', 70.00, NOW(), NULL),
(20, 'African Political Systems', 4, 0, 4, 24, '9780123456789', 65.00, NOW(), NULL),
(21, 'The Path to Success: An African Perspective', 3, 0, 5, 10, '9790111111111', 55.00, NOW(), NULL),
(22, 'Leadership Lessons from Africa', 4, 0, 5, 12, '9790222222222', 60.00, NOW(), NULL),
(23, 'Mindset for African Youth', 3, 0, 5, 15, '9790333333333', 45.00, NOW(), NULL),
(24, 'Building Character: Traditional Values', 2, 0, 5, 23, '9790444444444', 50.00, NOW(), NULL),
(25, 'Excellence in African Education', 3, 0, 5, 10, '9790555555555', 55.00, NOW(), NULL);

-- Verify the insertion
SELECT COUNT(*) as 'Total Books Inserted' FROM books;
SELECT 'Books inserted successfully!' as Status;
