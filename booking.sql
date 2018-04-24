-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2018 at 01:34 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocate`
--

CREATE TABLE `allocate` (
  `s.no` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `no_of_persons` int(50) NOT NULL,
  `in_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alltables`
--

CREATE TABLE `alltables` (
  `Id` int(50) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `table_capacity` int(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alltables`
--

INSERT INTO `alltables` (`Id`, `table_name`, `table_capacity`, `status`) VALUES
(1, 'rose', 2, 0),
(2, 'lilly', 4, 0),
(3, 'daisy', 6, 0),
(4, 'jasmine', 8, 0),
(5, 'lavender', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `table_capacity` int(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_cart`
--

CREATE TABLE `booking_cart` (
  `Id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `table_capacity` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_cart`
--

INSERT INTO `booking_cart` (`Id`, `table_name`, `table_capacity`, `status`) VALUES
(1, 'rose', '2', 0),
(2, 'lilly', '4', 0),
(3, 'daisy', '6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `outing`
--

CREATE TABLE `outing` (
  `s_no` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `table_capacity` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outing`
--

INSERT INTO `outing` (`s_no`, `table_name`, `table_capacity`, `name`, `status`, `out_time`) VALUES
(6, 'daisy', 6, 'swamy', 1, '14:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `s_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `no_of_persons` varchar(50) NOT NULL,
  `waiting_time` time NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`s_no`, `name`, `mobile`, `no_of_persons`, `waiting_time`, `status`) VALUES
(2, 'adi', '45475752', '2', '18:24:00', 0),
(3, 'nani', '25487899', '4', '12:19:04', 0),
(4, 'venkata', '98546123', '6', '15:03:17', 0),
(6, 'swamy', '321565468', '6', '10:59:20', 0),
(7, 'xyz', '54351', '3', '11:40:07', 0),
(9, 'abhi', '515415', '2', '17:08:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `s_no` int(50) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `table_capacity` int(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`s_no`, `table_name`, `table_capacity`, `status`, `out_time`) VALUES
(1, 'rose', 2, 1, '12:02:35'),
(2, 'lilly', 4, 1, '12:02:39'),
(3, 'daisy', 6, 1, '12:02:43'),
(4, 'jasmine', 8, 1, '12:02:46'),
(5, 'lavender', 10, 1, '11:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_list`
--

CREATE TABLE `waiting_list` (
  `s_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `no_of_persons` int(50) NOT NULL,
  `in_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waiting_list`
--

INSERT INTO `waiting_list` (`s_no`, `name`, `no_of_persons`, `in_time`) VALUES
(9, 'abhi', 2, '17:00:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocate`
--
ALTER TABLE `allocate`
  ADD PRIMARY KEY (`s.no`);

--
-- Indexes for table `alltables`
--
ALTER TABLE `alltables`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD PRIMARY KEY (`s_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocate`
--
ALTER TABLE `allocate`
  MODIFY `s.no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `waiting_list`
--
ALTER TABLE `waiting_list`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
