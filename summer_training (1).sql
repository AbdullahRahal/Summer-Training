-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 07:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `summer_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(255) NOT NULL,
  `nnouncement_body` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_notes`
--

CREATE TABLE `app_notes` (
  `app_id` int(255) NOT NULL,
  `std_name` varchar(255) DEFAULT NULL,
  `std_num` varchar(255) DEFAULT NULL,
  `app_body` varchar(255) NOT NULL,
  `cs_email` varchar(255) DEFAULT NULL,
  `cs_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `cid` int(255) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `cfeild` varchar(255) NOT NULL,
  `cwebsite` varchar(255) NOT NULL,
  `ccountry` varchar(255) NOT NULL,
  `cwork_to_be_done` varchar(255) NOT NULL,
  `cphone` varchar(255) NOT NULL,
  `cemail` varchar(255) NOT NULL,
  `cfax` varchar(255) NOT NULL,
  `cduration` varchar(255) NOT NULL,
  `caddress` varchar(255) NOT NULL,
  `csfname` varchar(255) NOT NULL,
  `cslname` varchar(255) NOT NULL,
  `csemail` varchar(255) NOT NULL,
  `csposition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_cs`
--

CREATE TABLE `company_cs` (
  `cs_id` int(200) NOT NULL,
  `cs_name` varchar(255) NOT NULL,
  `cs_email` varchar(255) NOT NULL,
  `cs_password` varchar(255) NOT NULL,
  `cs_phone` varchar(255) NOT NULL,
  `cs_company_name` varchar(255) NOT NULL,
  `cs_position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confirmations`
--

CREATE TABLE `confirmations` (
  `con_id` int(255) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `std_num` varchar(255) NOT NULL,
  `cs_name` varchar(255) NOT NULL,
  `cs_email` varchar(255) NOT NULL,
  `cc_name` varchar(255) NOT NULL,
  `cc_field` varchar(255) NOT NULL,
  `cc_address` varchar(255) NOT NULL,
  `cc_city` varchar(255) NOT NULL,
  `cc_country` varchar(255) NOT NULL,
  `cc_fax` varchar(255) NOT NULL,
  `cc_tele` varchar(255) NOT NULL,
  `cc_email` varchar(255) NOT NULL,
  `cc_website` varchar(255) NOT NULL,
  `std_s_date` date NOT NULL,
  `std_e_date` date NOT NULL,
  `work_to_be_done` varchar(255) NOT NULL,
  `e_stamp` longblob NOT NULL,
  `e_signature` longblob NOT NULL,
  `con_state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_onum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE `logbooks` (
  `book_id` int(255) NOT NULL,
  `std_num` varchar(255) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `book_date` date NOT NULL,
  `book_department` varchar(255) NOT NULL,
  `book_Description` varchar(255) NOT NULL,
  `book_day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logbooks_eva`
--

CREATE TABLE `logbooks_eva` (
  `eva_id` int(255) NOT NULL,
  `std_num` varchar(255) NOT NULL,
  `cs_name` varchar(255) NOT NULL,
  `cs_email` varchar(255) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `eva1` varchar(255) NOT NULL,
  `eva2` varchar(255) NOT NULL,
  `eva3` varchar(255) NOT NULL,
  `eva4` varchar(255) NOT NULL,
  `eva5` varchar(255) NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `eva_state` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(255) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `std_num` varchar(255) NOT NULL,
  `std_department` varchar(255) NOT NULL,
  `report_file` longblob NOT NULL,
  `report_e_1` varchar(255) DEFAULT NULL,
  `report_e_2` varchar(255) DEFAULT NULL,
  `report_e_3` varchar(255) DEFAULT NULL,
  `report_e_4` varchar(255) DEFAULT NULL,
  `report_e_5` varchar(255) DEFAULT NULL,
  `report_e_comments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stdform`
--

CREATE TABLE `stdform` (
  `stdf_id` int(255) NOT NULL,
  `stdf_stdname` varchar(255) NOT NULL,
  `stdf_stdnum` varchar(255) NOT NULL,
  `stdf_stdphone` varchar(255) NOT NULL,
  `stdf_stdemail` varchar(255) NOT NULL,
  `stdf_stdaddress` varchar(255) NOT NULL,
  `stdf_stdphoto` longblob NOT NULL,
  `stdf_cname` varchar(255) NOT NULL,
  `stdf_cphone` varchar(255) NOT NULL,
  `stdf_cemail` varchar(255) NOT NULL,
  `stdf_cfax` varchar(255) NOT NULL,
  `stdf_cfield` varchar(255) NOT NULL,
  `stdf_cwebsite` varchar(255) NOT NULL,
  `stdf_ccountry` varchar(255) NOT NULL,
  `stdf_cduration` varchar(255) NOT NULL,
  `stdf_cwtbd` varchar(255) NOT NULL,
  `stdf_caddress` varchar(255) NOT NULL,
  `stdf_csfname` varchar(255) NOT NULL,
  `stdf_cslname` varchar(255) NOT NULL,
  `stdf_csemail` varchar(255) NOT NULL,
  `stdf_csposition` varchar(255) NOT NULL,
  `stdf_fstates` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `std_id` int(200) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `std_email` varchar(255) NOT NULL,
  `std_num` varchar(255) NOT NULL,
  `academic_semester` varchar(255) NOT NULL,
  `std_department` varchar(255) NOT NULL,
  `std_password` varchar(255) NOT NULL,
  `cs_name` varchar(255) DEFAULT NULL,
  `cs_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `app_notes`
--
ALTER TABLE `app_notes`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `company_cs`
--
ALTER TABLE `company_cs`
  ADD PRIMARY KEY (`cs_id`);

--
-- Indexes for table `confirmations`
--
ALTER TABLE `confirmations`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `logbooks_eva`
--
ALTER TABLE `logbooks_eva`
  ADD PRIMARY KEY (`eva_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `stdform`
--
ALTER TABLE `stdform`
  ADD PRIMARY KEY (`stdf_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`std_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_notes`
--
ALTER TABLE `app_notes`
  MODIFY `app_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `cid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_cs`
--
ALTER TABLE `company_cs`
  MODIFY `cs_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confirmations`
--
ALTER TABLE `confirmations`
  MODIFY `con_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `book_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logbooks_eva`
--
ALTER TABLE `logbooks_eva`
  MODIFY `eva_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stdform`
--
ALTER TABLE `stdform`
  MODIFY `stdf_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `std_id` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
