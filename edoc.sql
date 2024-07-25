-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 07:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_fullname` varchar(250) NOT NULL,
  `admin_email` varchar(250) NOT NULL,
  `admin_password` varchar(250) NOT NULL,
  `admin_phone` int(10) NOT NULL,
  `admin_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fullname`, `admin_email`, `admin_password`, `admin_phone`, `admin_image`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 2147483647, '1582015.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DID` int(255) NOT NULL,
  `DFirst_Name` text NOT NULL,
  `DLast_Name` text NOT NULL,
  `DEmail` text NOT NULL,
  `DPassword` text NOT NULL,
  `DNational_ID` text NOT NULL,
  `DPhone_Number` text NOT NULL,
  `DAddress` text NOT NULL,
  `DProfession_Number` text NOT NULL,
  `usertype` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DID`, `DFirst_Name`, `DLast_Name`, `DEmail`, `DPassword`, `DNational_ID`, `DPhone_Number`, `DAddress`, `DProfession_Number`, `usertype`, `status`) VALUES
(126, 'علي2023', 'محممد', 'ali@gmail.com', '1111', '1245367899', '0777257624', 'عمان دوار المدينة الرياضية', '252', 'Dr', 'approve'),
(127, 'ggg', 'محممد', 'ali@gmail.com', 'gggg', '1245367899', '0777257624', 'عمان', '200', 'Dr', 'notapprove');

-- --------------------------------------------------------

--
-- Table structure for table `hosptail`
--

CREATE TABLE `hosptail` (
  `id` int(250) NOT NULL,
  `PID` int(250) NOT NULL,
  `hosptail_name` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `lab_id` int(255) NOT NULL,
  `PID` int(255) NOT NULL,
  `lab_name` text NOT NULL,
  `test` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `massege_admin`
--

CREATE TABLE `massege_admin` (
  `id` int(255) NOT NULL,
  `PID` int(255) NOT NULL,
  `title` text NOT NULL,
  `descr` text NOT NULL,
  `Reply` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `massege_admin`
--

INSERT INTO `massege_admin` (`id`, `PID`, `title`, `descr`, `Reply`, `date`) VALUES
(2, 2, 'ccccccc', 'cccccccccccccc', 'ggggggggggggggggfffffffffff', '2023-12-19 12:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(255) NOT NULL,
  `Doctor_ID` int(255) NOT NULL,
  `PID` int(255) NOT NULL,
  `dates` text NOT NULL,
  `times` text NOT NULL,
  `status` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `Doctor_ID`, `PID`, `dates`, `times`, `status`, `note`) VALUES
(4, 126, 3, '2024-01-05', '11:00PM - 11:20PM', 'approve', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PID` int(250) NOT NULL,
  `Doctor_ID` int(10) DEFAULT NULL,
  `PFirst_Name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PLast_Name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PEmail` text NOT NULL,
  `PPassword` text NOT NULL,
  `PNational_ID` int(250) NOT NULL,
  `PPhone_Number` int(250) NOT NULL,
  `pregion` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PDOB` date NOT NULL,
  `Gender` text NOT NULL,
  `Blood_Type` text NOT NULL,
  `Pcity` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Medicine` text NOT NULL,
  `smoker` text NOT NULL,
  `Allergy_type` text NOT NULL,
  `status1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PID`, `Doctor_ID`, `PFirst_Name`, `PLast_Name`, `PEmail`, `PPassword`, `PNational_ID`, `PPhone_Number`, `pregion`, `PDOB`, `Gender`, `Blood_Type`, `Pcity`, `Medicine`, `smoker`, `Allergy_type`, `status1`) VALUES
(3, 126, 'هشام', 'المشاقبة', 'hesham@gmail.com', '2023', 2147483647, 777257624, 'الموقر', '2023-11-27', 'ذكر', 'A-', 'Jerash', 'ssssssssssssssssss', 'yes', 'sssssssssssssssssssssss', '1');

-- --------------------------------------------------------

--
-- Table structure for table `secretary`
--

CREATE TABLE `secretary` (
  `id` int(255) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `addres` text NOT NULL,
  `phone` text NOT NULL,
  `National_ID` text NOT NULL,
  `DID` int(255) NOT NULL,
  `password` text NOT NULL,
  `usertype` text NOT NULL,
  `status1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secretary`
--

INSERT INTO `secretary` (`id`, `first_name`, `last_name`, `email`, `addres`, `phone`, `National_ID`, `DID`, `password`, `usertype`, `status1`) VALUES
(1, 'dddd', 'ddd', 'dddd@gmail.com', 'dddd', '0777257624', '1010101010', 126, '1212', 'S_Dr', 'approve');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DID`);

--
-- Indexes for table `hosptail`
--
ALTER TABLE `hosptail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`lab_id`);

--
-- Indexes for table `massege_admin`
--
ALTER TABLE `massege_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `secretary`
--
ALTER TABLE `secretary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `DID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `hosptail`
--
ALTER TABLE `hosptail`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `lab_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `massege_admin`
--
ALTER TABLE `massege_admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `secretary`
--
ALTER TABLE `secretary`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
