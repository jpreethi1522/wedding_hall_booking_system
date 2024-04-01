-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 07:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding_hall_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(50) NOT NULL,
  `groomName` varchar(50) NOT NULL,
  `groomFatherName` varchar(50) NOT NULL,
  `groomMotherName` varchar(50) NOT NULL,
  `brideName` varchar(50) NOT NULL,
  `brideFatherName` varchar(50) NOT NULL,
  `brideMotherName` varchar(50) NOT NULL,
  `contactName` varchar(50) NOT NULL,
  `contactNumber` int(50) NOT NULL,
  `contactEmail` varchar(50) NOT NULL,
  `preferredDate1` date DEFAULT NULL,
  `hallPreference1` varchar(50) DEFAULT '',
  `preferredDate2` date DEFAULT NULL,
  `hallPreference2` varchar(50) DEFAULT '',
  `preferredDate3` date DEFAULT NULL,
  `hallPreference3` varchar(50) DEFAULT '',
  `preferreddate` date DEFAULT NULL,
  `hallpreference` varchar(50) DEFAULT '',
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
