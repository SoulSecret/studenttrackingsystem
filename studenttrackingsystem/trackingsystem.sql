-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 03, 2024 at 11:22 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trackingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `program_name`
--

DROP TABLE IF EXISTS `program_name`;
CREATE TABLE IF NOT EXISTS `program_name` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `program_name`
--

INSERT INTO `program_name` (`id`, `program_name`) VALUES
(1, 'BSIT'),
(2, 'BSE'),
(9, 'BSBA');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Nigel', 'nigel@gmail.com', 9123124128);

-- --------------------------------------------------------

--
-- Table structure for table `students_form`
--

DROP TABLE IF EXISTS `students_form`;
CREATE TABLE IF NOT EXISTS `students_form` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program_name_id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `noc_tob` varchar(255) NOT NULL,
  `position_in_company` varchar(255) NOT NULL,
  `tracked_by` varchar(255) NOT NULL,
  `permanent` varchar(15) NOT NULL,
  `related_field` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `employed_for_over_six_months` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students_form`
--

INSERT INTO `students_form` (`id`, `program_name_id`, `fullname`, `status`, `noc_tob`, `position_in_company`, `tracked_by`, `permanent`, `related_field`, `employed_for_over_six_months`, `gender`) VALUES
(1, '1', 'MARVIN LOPEZ NAGAÑO', 'Employed', 'Excellence', 'Software Developer', 'Kingston', 'Yes', 'Yes', 'No', 'Male'),
(4, '9', 'MARIA LUNA DELA CRUZ', 'Employed', 'Hardware Store', 'Tindera', 'Lopare', 'Yes', 'No', 'Yes', 'Female'),
(5, '2', 'PALOMA RIDYUS', 'Employed', 'STM', 'CASHIER', 'sst', 'No', 'Yes', 'No', 'Female'),
(6, '1', 'MARK MABALAY', 'Employed', 'Digiart LLC', 'EDITOR', 'skalop', 'Yes', 'Yes', 'Yes', 'Male'),
(7, '1', 'JULUIS CESAR REYES', 'Not Tracked', 'Digiart LLC', 'EDITOR', 'skalop', 'No', 'No', 'Yes', 'Male'),
(8, '1', 'MARIELLE LUNA DELA CRUZ', 'Not Tracked', 'Digiart LLC', 'EDITOR', 'skalop', 'Yes', 'Yes', 'Yes', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'jose', '$2y$10$32LSLzzGZD//5h0FKARF2eXz/b2u.GJ7twdX3S9REZaNEUaol2K.O'),
(4, 'jose1', '$2y$10$unbe/c7nn.oVEGqRddenBee93SIaVAvRzh/17JKcBUNwnqf/xsL.S'),
(3, 'mark1', '$2y$10$VEUmM7M7Fy7nKW6ZLhGFheOcZk.DIX8MY9fBWHXjUjpOlNIjpXykq');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
