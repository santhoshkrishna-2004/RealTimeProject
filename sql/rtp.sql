-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 05:50 PM
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
-- Database: `rtp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'admin420', '2020-07-17 08:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(2, 'admin', 'admin420', 9030503722, 'admin420@gmial.com', 'admin420', '2024-05-26 07:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `tblblooddonars`
--

CREATE TABLE `tblblooddonars` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblblooddonars`
--

INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `Gender`, `Age`, `BloodGroup`, `Address`, `Message`, `PostingDate`, `status`, `Password`) VALUES
(6, 'Ashu Misra', '7797987981', 'ashu@gmail.com', 'Male', 35, 'O-', 'H-900, Ravinderpuri colony, Varanasi', ' Call me if blood require', '2024-01-02 07:13:41', 1, '202cb962ac59075b964b07152d234b70'),
(9, 'Test Demo', '9789797979', 'test@gmail.com', 'Male', 56, 'A+', 'Allahabad', ' gjhgjhgjhghjghj', '2024-01-03 00:39:08', 1, '202cb962ac59075b964b07152d234b70'),
(10, 'John Doe', '1236547890', 'johnd@gmail.com', 'Male', 25, 'O-', 'A 5623 XYZ Street New Delhi', ' NA', '2024-01-02 20:20:58', 1, 'f925916e2754e5e03f75dd58a5733251'),
(11, 'Amit Kumar', '1231231230', 'amitk@gmail.com', 'Male', 26, 'AB+', 'ABc Street Sector 20 Noida UP', ' NA', '2024-01-03 19:52:52', 1, 'f925916e2754e5e03f75dd58a5733251'),
(12, 'Anuj kumar', '1425362514', 'ak@test.com', 'Male', 30, 'A-', 'NA', ' NA', '2024-01-05 12:01:08', 1, 'f925916e2754e5e03f75dd58a5733251'),
(19, 'shyam420', '9030503722', 'shyam420@gmail.com', 'Male', 22, 'O+', 'khm', 'ee saala cup nahi', '2024-05-22 17:27:58', 1, '$2y$10$Hf9OUwZLFM1HcK7QebRjWefV097tVRkmZCY0c4W31tNKfRkvWxQVq'),
(20, 'santhosh', '1234567890', 'santhosh420@gmail.com', 'Male', 22, 'A+', 'hyderabad', 'hi world', '2024-05-26 09:34:20', 1, '$2y$10$77QSaNIISA0wko4zlKXq.eYkqdb2.RhAa/oRjw4QBBYrQmJfxHWYa');

-- --------------------------------------------------------

--
-- Table structure for table `tblbloodgroup`
--

CREATE TABLE `tblbloodgroup` (
  `id` int(11) NOT NULL,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbloodgroup`
--

INSERT INTO `tblbloodgroup` (`id`, `BloodGroup`, `PostingDate`) VALUES
(1, 'A-', '2024-01-01 15:03:50'),
(2, 'AB-', '2024-01-01 15:03:50'),
(3, 'O-', '2024-01-01 15:03:50'),
(4, 'A-', '2024-01-01 15:03:50'),
(5, 'A+', '2024-01-01 15:03:50'),
(6, 'AB+', '2024-01-01 15:03:50'),
(8, 'O+', '2024-05-26 08:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `tblbloodrequirer`
--

CREATE TABLE `tblbloodrequirer` (
  `ID` int(10) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `mobileNumber` bigint(20) DEFAULT NULL,
  `emailId` varchar(250) DEFAULT NULL,
  `BloodRequirefor` varchar(250) DEFAULT NULL,
  `bloodtype` varchar(10) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbloodrequirer`
--

INSERT INTO `tblbloodrequirer` (`ID`, `name`, `mobileNumber`, `emailId`, `BloodRequirefor`, `bloodtype`, `location`, `Message`, `ApplyDate`) VALUES
(1, 'Santhosh', 7894561236, 'santhu420@gmail.com', 'Father', 'A+', 'Hyderabad', 'Please help', '2024-01-06 06:27:24'),
(2, 'Mukesh', 5896231478, 'mukesh@gmail.com', 'Others', 'B+', 'Warangal', 'Please help', '2024-01-06 06:28:48'),
(3, 'Abhinav', 1236547896, 'Abhinav420@gmail.com', 'Brother', 'O-', 'Nizamabad', 'do the needful', '2024-01-07 06:32:12'),
(4, 'Rakesh', 2536251425, 'rakesh2125@gmail.com', 'Mother', 'AB+', 'Karimnagar', 'Please help me', '2024-01-07 20:21:52'),
(5, 'shyam', 8525232102, 'shyam420@gmail.com', 'Others', 'A-', 'Khammam', 'Need blood on urgent basis', '2024-01-07 19:54:18'),
(16, 'Nageswara chary', 9014865697, 'tejaneethipudi14@gmail.com', 'Father', 'A-', 'hyderabad', 'gjcgjt', '2024-05-26 15:15:44'),
(17, 'Nageswara chary', 9014865697, 'tejaneethipudi14@gmail.com', 'Father', 'A-', 'hyderabad', 'gjcgjt', '2024-05-26 15:17:25'),
(18, 'Nageswara chary', 9014865697, 'tejaneethipudi14@gmail.com', 'Father', 'A-', 'hyderabad', 'gjcgjt', '2024-05-26 15:19:29'),
(19, 'Nageswara chary', 6441531315, 'shyam420@gmial.com', 'Mother', 'A-', 'hyderabad', '', '2024-05-26 15:22:45'),
(20, 'Nageswara chary', 6441531315, 'shyam420@gmial.com', 'Mother', 'A-', 'hyderabad', '', '2024-05-26 15:24:16'),
(21, 'fhgwerb', 28372, 'shyam420@gmail.com', 'Sister', 'O-', 'grsgrshfsdfhdfh', 'dvsvs', '2024-05-26 15:24:39'),
(22, 'fhgwerb', 28372, 'shyam420@gmail.com', 'Sister', 'O-', 'grsgrshfsdfhdfh', 'dvsvs', '2024-05-26 15:25:26'),
(23, 'ggggg', 22222222222, 'tejaneethipudi14@gmail.com', 'Others', 'O-', 'aevw', 'jjjjjjjjjjj', '2024-05-26 15:25:54'),
(24, 'ggggg', 22222222222, 'tejaneethipudi14@gmail.com', 'Others', 'O-', 'aevw', 'jjjjjjjjjjj', '2024-05-26 15:27:58'),
(25, 'ggggg', 22222222222, 'tejaneethipudi14@gmail.com', 'Others', 'O-', 'aevw', 'jjjjjjjjjjj', '2024-05-26 15:28:13'),
(26, 'ggggg', 22222222222, 'tejaneethipudi14@gmail.com', 'Others', 'O-', 'aevw', 'jjjjjjjjjjj', '2024-05-26 15:28:29'),
(27, 'ggggg', 22222222222, 'tejaneethipudi14@gmail.com', 'Others', 'O-', 'aevw', 'jjjjjjjjjjj', '2024-05-26 15:28:35'),
(28, '', 0, 'shyam420@gmial.com', 'Brother', 'O-', 'wfqw', '', '2024-05-26 15:29:45'),
(29, '', 0, 'shyam420@gmial.com', 'Brother', 'O-', 'wfqw', '', '2024-05-26 15:31:09'),
(30, '', 0, 'shyam420@gmial.com', 'Brother', 'O-', 'wfqw', '', '2024-05-26 15:31:30'),
(31, '', 0, 'shyam420@gmial.com', 'Brother', 'O-', 'wfqw', '', '2024-05-26 15:31:58'),
(32, '', 0, 'shyam420@gmial.com', 'Brother', 'O-', 'wfqw', '', '2024-05-26 15:32:19'),
(33, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:32:54'),
(34, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:33:26'),
(35, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:34:30'),
(36, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:34:42'),
(37, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:35:22'),
(38, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:35:47'),
(39, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:36:08'),
(40, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:36:57'),
(41, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:37:24'),
(42, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:37:34'),
(43, '', 0, 'shyam420@gmail.com', '', 'A+', '', '', '2024-05-26 15:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(1, 'rakesh', 'Rakesh2125@gmail.com', '2125420420', 'smile ', '2024-05-22 17:44:36', NULL),
(5, 'nna gvads g', 'shyam420@gmial.com', '9014865697', 'qwfewagaweb', '2024-05-22 17:51:43', NULL),
(6, 'bxsns', 'tejaneethipudi14@gmail.com', '6441531315', 'sdfbsbhsn', '2024-05-22 17:55:25', NULL),
(10, 'shyam', 'shyam@gmail.com', '9151354351', 'hi', '2024-05-26 04:41:44', NULL),
(11, 'Santhosh', 'santhosh@gmail.com', '9999955555', 'i am santhosh', '2024-05-26 04:43:07', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblblooddonars`
--
ALTER TABLE `tblblooddonars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbloodgroup`
--
ALTER TABLE `tblbloodgroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BloodGroup` (`BloodGroup`),
  ADD KEY `BloodGroup_2` (`BloodGroup`);

--
-- Indexes for table `tblbloodrequirer`
--
ALTER TABLE `tblbloodrequirer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblblooddonars`
--
ALTER TABLE `tblblooddonars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblbloodgroup`
--
ALTER TABLE `tblbloodgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblbloodrequirer`
--
ALTER TABLE `tblbloodrequirer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
