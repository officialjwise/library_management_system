-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2018 at 01:54 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_ACREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `Copies` int(11) NOT NULL,
  `IssuedCopies` int(11) NOT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` varchar(20) DEFAULT NULL,
  `BookPrice` decimal(10,2) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Daniel Amoako Kodua', 'daniel@library.com', 'admin', 'e7f84ff145ced31368756c41af7fef9c', '2025-08-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `overdue`
--

CREATE TABLE `overdue` (
  `StudentID` varchar(11) NOT NULL,
  `StudentName` varchar(40) NOT NULL,
  `MobNumber` varchar(11) NOT NULL,
  `Fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `CollegeName` varchar(100) NOT NULL,
  `CollegeCode` varchar(10) NOT NULL,
  `Status` int(1) DEFAULT 1,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `CollegeName`, `CollegeCode`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(1, 'College of Engineering', 'COE', 1, NOW(), NULL),
(2, 'College of Science', 'COS', 1, NOW(), NULL),
(3, 'College of Agriculture and Natural Resources', 'CANR', 1, NOW(), NULL),
(4, 'College of Architecture and Planning', 'CAP', 1, NOW(), NULL),
(5, 'College of Art and Built Environment', 'CABE', 1, NOW(), NULL),
(6, 'College of Health Sciences', 'CHS', 1, NOW(), NULL),
(7, 'College of Humanities and Social Sciences', 'CHASS', 1, NOW(), NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(10) NOT NULL,
  `CollegeId` int(11) NOT NULL,
  `Status` int(1) DEFAULT 1,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `DepartmentName`, `DepartmentCode`, `CollegeId`, `Status`, `CreationDate`, `UpdationDate`) VALUES
-- College of Engineering (COE)
(1, 'Computer Engineering', 'CPE', 1, 1, NOW(), NULL),
(2, 'Electrical/Electronic Engineering', 'EEE', 1, 1, NOW(), NULL),
(3, 'Mechanical Engineering', 'ME', 1, 1, NOW(), NULL),
(4, 'Civil Engineering', 'CE', 1, 1, NOW(), NULL),
(5, 'Chemical Engineering', 'CHE', 1, 1, NOW(), NULL),
(6, 'Geological Engineering', 'GE', 1, 1, NOW(), NULL),
(7, 'Materials Engineering', 'MAE', 1, 1, NOW(), NULL),
(8, 'Agricultural and Biosystems Engineering', 'ABE', 1, 1, NOW(), NULL),
(9, 'Geomatic Engineering', 'GM', 1, 1, NOW(), NULL),
(10, 'Petrochemical Engineering', 'PE', 1, 1, NOW(), NULL),

-- College of Science (COS)
(11, 'Computer Science', 'CS', 2, 1, NOW(), NULL),
(12, 'Mathematics', 'MATH', 2, 1, NOW(), NULL),
(13, 'Physics', 'PHY', 2, 1, NOW(), NULL),
(14, 'Chemistry', 'CHEM', 2, 1, NOW(), NULL),
(15, 'Statistics', 'STAT', 2, 1, NOW(), NULL),
(16, 'Biochemistry', 'BIOCHEM', 2, 1, NOW(), NULL),
(17, 'Food Science and Technology', 'FST', 2, 1, NOW(), NULL),
(18, 'Optometry', 'OPT', 2, 1, NOW(), NULL),

-- College of Agriculture and Natural Resources (CANR)
(19, 'Agricultural Economics, Agribusiness and Extension', 'AEAE', 3, 1, NOW(), NULL),
(20, 'Animal Science', 'AS', 3, 1, NOW(), NULL),
(21, 'Crop and Soil Sciences', 'CSS', 3, 1, NOW(), NULL),
(22, 'Horticulture', 'HORT', 3, 1, NOW(), NULL),
(23, 'Forest Resources Technology', 'FRT', 3, 1, NOW(), NULL),
(24, 'Fisheries and Aquatic Sciences', 'FAS', 3, 1, NOW(), NULL),
(25, 'Renewable Natural Resources', 'RNR', 3, 1, NOW(), NULL),

-- College of Health Sciences (CHS)
(26, 'Medicine', 'MED', 6, 1, NOW(), NULL),
(27, 'Dentistry', 'DENT', 6, 1, NOW(), NULL),
(28, 'Pharmacy', 'PHARM', 6, 1, NOW(), NULL),
(29, 'Nursing and Midwifery', 'NM', 6, 1, NOW(), NULL),
(30, 'Public Health', 'PH', 6, 1, NOW(), NULL),

-- College of Humanities and Social Sciences (CHASS)
(31, 'English', 'ENG', 7, 1, NOW(), NULL),
(32, 'Modern Languages', 'ML', 7, 1, NOW(), NULL),
(33, 'History and Political Studies', 'HPS', 7, 1, NOW(), NULL),
(34, 'Religious Studies', 'RS', 7, 1, NOW(), NULL),
(35, 'Social Work', 'SW', 7, 1, NOW(), NULL),
(36, 'Geography and Rural Development', 'GRD', 7, 1, NOW(), NULL),
(37, 'Economics', 'ECON', 7, 1, NOW(), NULL),
(38, 'Sociology and Anthropology', 'SA', 7, 1, NOW(), NULL),

-- College of Architecture and Planning (CAP)
(39, 'Architecture', 'ARCH', 4, 1, NOW(), NULL),
(40, 'Planning', 'PLAN', 4, 1, NOW(), NULL),

-- College of Art and Built Environment (CABE)
(41, 'Industrial Art', 'IA', 5, 1, NOW(), NULL),
(42, 'Publishing Studies', 'PS', 5, 1, NOW(), NULL),
(43, 'Integrated Rural Art and Industry', 'IRAI', 5, 1, NOW(), NULL),
(44, 'Fashion Design and Textiles', 'FDT', 5, 1, NOW(), NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Chinua Achebe', NOW(), NULL),
(2, 'Ama Ata Aidoo', NOW(), NULL),
(3, 'Ayi Kwei Armah', NOW(), NULL),
(4, 'Kofi Awoonor', NOW(), NULL),
(5, 'Kwame Nkrumah', NOW(), NULL),
(6, 'Nana Darkoa Sekyiamah', NOW(), NULL),
(7, 'Yaa Gyasi', NOW(), NULL),
(8, 'Akosua Busia', NOW(), NULL),
(9, 'Kojo Laing', NOW(), NULL),
(10, 'Naana Jane Opoku-Agyemang', NOW(), NULL),
(11, 'Nii Ayikwei Parkes', NOW(), NULL),
(12, 'Kwame Anthony Appiah', NOW(), NULL),
(13, 'Abena Busia', NOW(), NULL),
(14, 'Meshack Asare', NOW(), NULL),
(15, 'Efua Sutherland', NOW(), NULL),
(16, 'Wole Soyinka', NOW(), NULL),
(17, 'Chimamanda Ngozi Adichie', NOW(), NULL),
(18, 'Kofi Anyidoho', NOW(), NULL),
(19, 'Amma Darko', NOW(), NULL),
(20, 'Kwadwo Opoku-Agyemang', NOW(), NULL),
(21, 'Adaora Lily Ulasi', NOW(), NULL),
(22, 'Buchi Emecheta', NOW(), NULL),
(23, 'Kwame Gyekye', NOW(), NULL),
(24, 'Francis Selormey', NOW(), NULL),
(25, 'Kobina Sekyi', NOW(), NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `Copies` int(3) NOT NULL,
  `IssuedCopies` int(3) NOT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `BookPrice` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `BookName`, `Copies`, `IssuedCopies`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `RegDate`, `UpdationDate`) VALUES
-- Fiction Books
(1, 'Things Fall Apart', 5, 0, 1, 1, '9780385474542', 45.00, NOW(), NULL),
(2, 'Homegoing', 3, 0, 1, 7, '9781101947135', 65.00, NOW(), NULL),
(3, 'The Beautyful Ones Are Not Yet Born', 4, 0, 1, 3, '9780435905200', 35.00, NOW(), NULL),
(4, 'Changes: A Love Story', 3, 0, 1, 2, '9780435909741', 40.00, NOW(), NULL),
(5, 'Purple Hibiscus', 4, 0, 1, 17, '9780007189885', 50.00, NOW(), NULL),

-- Science & Technology Books
(6, 'Introduction to Computer Science', 6, 0, 2, 11, '9780134444321', 120.00, NOW(), NULL),
(7, 'Advanced Mathematics for Engineers', 4, 0, 2, 12, '9781234567890', 95.00, NOW(), NULL),
(8, 'Physics Principles and Applications', 5, 0, 2, 13, '9780987654321', 110.00, NOW(), NULL),
(9, 'Chemistry in Everyday Life', 3, 0, 2, 14, '9781111111111', 85.00, NOW(), NULL),
(10, 'Statistics for Data Analysis', 4, 0, 2, 15, '9782222222222', 105.00, NOW(), NULL),

-- Business Books
(11, 'African Business Leadership', 3, 0, 3, 12, '9783333333333', 75.00, NOW(), NULL),
(12, 'Economics of Development in Africa', 4, 0, 3, 20, '9784444444444', 90.00, NOW(), NULL),
(13, 'Entrepreneurship in Ghana', 2, 0, 3, 23, '9785555555555', 80.00, NOW(), NULL),
(14, 'Marketing in African Context', 3, 0, 3, 19, '9786666666666', 70.00, NOW(), NULL),
(15, 'Financial Management Principles', 4, 0, 3, 21, '9787777777777', 95.00, NOW(), NULL),

-- History Books
(16, 'Ghana: The Autobiography of Kwame Nkrumah', 4, 0, 4, 5, '9780717804992', 60.00, NOW(), NULL),
(17, 'The African Genius', 3, 0, 4, 16, '9780333234567', 55.00, NOW(), NULL),
(18, 'History of the Gold Coast and Ashanti', 2, 0, 4, 25, '9780543987654', 85.00, NOW(), NULL),
(19, 'Pan-Africanism and Liberation', 3, 0, 4, 18, '9780876543210', 70.00, NOW(), NULL),
(20, 'African Political Systems', 4, 0, 4, 24, '9780123456789', 65.00, NOW(), NULL),

-- Personal Development Books
(21, 'The Path to Success: An African Perspective', 3, 0, 5, 10, '9790111111111', 55.00, NOW(), NULL),
(22, 'Leadership Lessons from Africa', 4, 0, 5, 12, '9790222222222', 60.00, NOW(), NULL),
(23, 'Mindset for African Youth', 3, 0, 5, 15, '9790333333333', 45.00, NOW(), NULL),
(24, 'Building Character: Traditional Values', 2, 0, 5, 23, '9790444444444', 50.00, NOW(), NULL),
(25, 'Excellence in African Education', 3, 0, 5, 10, '9790555555555', 55.00, NOW(), NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Fiction', 1, NOW(), NULL),
(2, 'Science & Technology', 1, NOW(), NULL),
(3, 'Business', 1, NOW(), NULL),
(4, 'History', 1, NOW(), NULL),
(5, 'Personal Development', 1, NOW(), NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`fine`) VALUES
(10);

-- --------------------------------------------------------

--
-- Table structure for table `issuedbookdetails`
--

CREATE TABLE `issuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ReturnStatus` int(1) NOT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuedbookdetails`
--

-- No dummy data inserted

-- --------------------------------------------------------

--
-- Table structure for table `requestedbookdetails`
--

CREATE TABLE `requestedbookdetails` (
  `StudentID` varchar(20) NOT NULL,
  `StudName` varchar(40) NOT NULL,
  `BookName` varchar(100) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `AuthorName` varchar(100) NOT NULL,
  `ISBNNumber` varchar(20) NOT NULL,
  `BookPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(8) DEFAULT NULL COMMENT '8-digit Student ID (e.g., 20857953)',
  `IndexNumber` varchar(7) DEFAULT NULL COMMENT '7-digit Index Number (e.g., 8552721)',
  `FullName` varchar(120) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL COMMENT 'KNUST College',
  `Department` varchar(100) DEFAULT NULL COMMENT 'Department within College',
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

-- No dummy data inserted

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CollegeCode` (`CollegeCode`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Indexes for table `issuedbookdetails`
--
ALTER TABLE `issuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `issuedbookdetails`
--
ALTER TABLE `issuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`CollegeId`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
