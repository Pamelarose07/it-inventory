-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 10:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `asset_id` varchar(255) NOT NULL,
  `asset_type` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `accessories` varchar(255) NOT NULL,
  `conditionn` varchar(255) NOT NULL,
  `deployed_to` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `deployment_date` datetime DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `specifications` text NOT NULL,
  `comments` text NOT NULL,
  `prev_users` varchar(255) NOT NULL,
  `date_returned` date DEFAULT NULL,
  `date_stamp` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`id`, `asset_id`, `asset_type`, `serial_no`, `brand`, `model_name`, `color`, `accessories`, `conditionn`, `deployed_to`, `employee_id`, `department`, `deployment_date`, `location`, `specifications`, `comments`, `prev_users`, `date_returned`, `date_stamp`) VALUES
(50, '1', 'Printer', '', '', '', '', '', 'Faulty', '', '', '', '0000-00-00 00:00:00', '', '\r\n            ', '\r\n            ', '', '0000-00-00', '2025-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `asset_id` varchar(255) NOT NULL,
  `asset_type` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `accessories` varchar(255) NOT NULL,
  `conditionn` varchar(255) NOT NULL,
  `deployed_to` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `deployment_date` datetime DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `specifications` text NOT NULL,
  `comments` text NOT NULL,
  `prev_users` varchar(255) NOT NULL,
  `date_returned` date DEFAULT NULL,
  `date_stamp` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id`, `asset_id`, `asset_type`, `serial_no`, `brand`, `model_name`, `color`, `accessories`, `conditionn`, `deployed_to`, `employee_id`, `department`, `deployment_date`, `location`, `specifications`, `comments`, `prev_users`, `date_returned`, `date_stamp`) VALUES
(85, '', 'Computer', '', '', '', '', '', 'Choose one', '', '', '', '0000-00-00 00:00:00', '', '\r\n            ', '\r\n            ', '', '0000-00-00', '2025-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(5, 'russ', 'baby');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
