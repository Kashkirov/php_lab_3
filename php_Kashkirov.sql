-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2023 at 03:01 PM
-- Server version: 8.0.30
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_Kashkirov`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `pub_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `pub_year`) VALUES
(1, 'Fatal eggs', '1925'),
(2, 'The art of electronics', '1993'),
(3, 'Twilight', '2009'),
(4, 'Mysterious island', '1875'),
(5, 'Principles of orchestration by Nikolai Rimski-Korsakov', '1913');

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `color` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_taking`
--

CREATE TABLE `log_taking` (
  `id` int NOT NULL,
  `reader_id` int NOT NULL,
  `book_id` int NOT NULL,
  `took_in` date NOT NULL,
  `returned_in` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log_taking`
--

INSERT INTO `log_taking` (`id`, `reader_id`, `book_id`, `took_in`, `returned_in`) VALUES
(1, 2, 3, '2022-09-02', '2022-10-14'),
(2, 1, 5, '2022-08-01', NULL),
(3, 3, 2, '2022-11-19', '2023-01-18'),
(4, 4, 3, '2022-10-16', '2022-12-19'),
(5, 4, 2, '2022-11-02', '2022-11-18'),
(6, 1, 2, '2022-09-05', '2022-09-22'),
(7, 3, 1, '2022-10-02', '2022-11-02'),
(8, 1, 3, '2022-12-22', '2023-01-18'),
(9, 2, 2, '2023-01-29', '2023-02-05'),
(10, 1, 4, '2023-01-07', '2023-01-21'),
(11, 1, 3, '2023-01-19', '2023-02-01'),
(12, 5, 1, '2022-11-29', '2023-12-05'),
(13, 3, 3, '2023-02-16', '2023-02-26'),
(14, 4, 1, '2022-12-23', '2023-01-13'),
(15, 2, 1, '2023-01-15', '2023-02-09'),
(16, 4, 4, '2023-01-29', '2023-02-14'),
(17, 5, 1, '2023-02-10', '2023-02-25'),
(18, 1, 2, '2023-03-08', NULL),
(19, 3, 4, '2023-02-26', '2023-03-02'),
(20, 4, 3, '2023-03-07', '2023-03-17'),
(21, 5, 1, '2023-03-03', NULL),
(22, 5, 3, '2023-03-18', '2023-03-25'),
(23, 4, 4, '2023-03-04', '2023-03-31'),
(24, 5, 3, '2023-04-08', NULL),
(25, 4, 2, '2022-11-02', '2022-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `readers`
--

CREATE TABLE `readers` (
  `id` int NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `readers`
--

INSERT INTO `readers` (`id`, `last_name`, `first_name`) VALUES
(1, 'Leanpool', 'Martin'),
(2, 'Karawski', 'Sabrine'),
(3, 'Brackser', 'Theodore'),
(4, 'Berardo', 'Roy'),
(5, 'Salmon', 'Bob');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_taking`
--
ALTER TABLE `log_taking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key_taken_book` (`book_id`),
  ADD KEY `key_person_take` (`reader_id`);

--
-- Indexes for table `readers`
--
ALTER TABLE `readers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_taking`
--
ALTER TABLE `log_taking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `readers`
--
ALTER TABLE `readers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_taking`
--
ALTER TABLE `log_taking`
  ADD CONSTRAINT `key_person_take` FOREIGN KEY (`reader_id`) REFERENCES `log_taking` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `key_taken_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
