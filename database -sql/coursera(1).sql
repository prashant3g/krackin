-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2017 at 09:25 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursera`
--

-- --------------------------------------------------------

--
-- Table structure for table `savedcourses`
--

CREATE TABLE `savedcourses` (
  `email` varchar(50) DEFAULT NULL,
  `courseID` varchar(100) DEFAULT NULL,
  `courseName` varchar(100) DEFAULT NULL,
  `courseType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savedcourses`
--

INSERT INTO `savedcourses` (`email`, `courseID`, `courseName`, `courseType`) VALUES
('Prashant22@yahoo.com', '5zjIsJq-EeW_wArffOXkOw', 'Vital Signs: Understanding What the Body Is Telling Us', 'v2.ondemand');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(50) NOT NULL,
  `name` char(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profession` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `name`, `password`, `profession`) VALUES
('prashant22@yahoo.com', 'Prashant Kumar Tripa', '81dc9bdb52d04dc20036dbd8313ed055', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `savedcourses`
--
ALTER TABLE `savedcourses`
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `savedcourses`
--
ALTER TABLE `savedcourses`
  ADD CONSTRAINT `savedcourses_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
