-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 06:26 PM
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
-- Database: `prmsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `ID` int(60) NOT NULL,
  `USER_ID` varchar(60) NOT NULL,
  `FILE_ID` varchar(60) NOT NULL,
  `DATE_TIME` datetime NOT NULL,
  `ACTION` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_folder`
--

CREATE TABLE `faculty_folder` (
  `ID` varchar(60) NOT NULL,
  `SECTION_ID` varchar(60) NOT NULL,
  `FACULTY_NAME` varchar(60) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `STATUS` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `ID` varchar(255) NOT NULL,
  `FOLDER_ID` varchar(60) NOT NULL,
  `FILE_NAME` varchar(255) NOT NULL,
  `DISPLAY_FILE_NAME` varchar(60) NOT NULL,
  `NOTES` varchar(60) NOT NULL,
  `TAGS` varchar(60) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `STATUS` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files_folder`
--

CREATE TABLE `files_folder` (
  `ID` varchar(60) NOT NULL,
  `FACULTY_ID` varchar(60) NOT NULL,
  `FOLDER_NAME` varchar(60) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `STATUS` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `ID` int(60) NOT NULL,
  `SENDER_ID` varchar(60) NOT NULL,
  `RECEIVER_ID` varchar(60) NOT NULL,
  `MESSAGE` varchar(1000) NOT NULL,
  `DATE_TIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `ID` varchar(60) NOT NULL,
  `SECTION_NAME` varchar(60) NOT NULL,
  `STATUS` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`ID`, `SECTION_NAME`, `STATUS`) VALUES
('SECTION_671294', 'Cpe', 'active'),
('SECTION_947213', 'CE', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `shared_files`
--

CREATE TABLE `shared_files` (
  `ID` int(60) NOT NULL,
  `USER_ID` varchar(60) NOT NULL,
  `FILE_ID` varchar(60) NOT NULL,
  `STATUS` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `ID` int(11) NOT NULL,
  `FOR_USER_ID` varchar(60) NOT NULL,
  `TASK_MESSAGE` varchar(1000) NOT NULL,
  `TASK_FILE_NAME` varchar(255) NOT NULL,
  `TASK_DISPLAY_FILE_NAME` varchar(255) NOT NULL,
  `TASK_DATETIME` datetime NOT NULL,
  `RESPONSE_COMMENT` varchar(1000) NOT NULL,
  `RESPONSE_FILE_NAME` varchar(255) NOT NULL,
  `RESPONSE_DISPLAY_FILE_NAME` varchar(255) NOT NULL,
  `RESPONSE_DATETIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` varchar(60) NOT NULL,
  `F_NAME` varchar(60) NOT NULL,
  `L_NAME` varchar(60) NOT NULL,
  `MI` varchar(60) NOT NULL,
  `SUFFIX` varchar(60) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `USERNAME` varchar(60) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `FACULTY_ID` varchar(60) NOT NULL,
  `USER_TYPE` varchar(60) NOT NULL,
  `STATUS` varchar(60) NOT NULL,
  `INBOX` int(11) NOT NULL,
  `NOTIF` int(11) NOT NULL,
  `SENT_INBOX` int(60) NOT NULL,
  `SENT_NOTIF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `F_NAME`, `L_NAME`, `MI`, `SUFFIX`, `EMAIL`, `USERNAME`, `PASSWORD`, `FACULTY_ID`, `USER_TYPE`, `STATUS`, `INBOX`, `NOTIF`, `SENT_INBOX`, `SENT_NOTIF`) VALUES
('ADMIN_1', 'Admin', 'Admin', '', '', 'admin@gmail.com', 'admin', 'password', '', 'admin', 'active', 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_faculty_files`
--

CREATE TABLE `user_faculty_files` (
  `ID` int(11) NOT NULL,
  `FOLDER_ID` varchar(60) NOT NULL,
  `FILE_NAME` varchar(255) NOT NULL,
  `DISPLAY_FILE_NAME` varchar(60) NOT NULL,
  `NOTES` varchar(60) NOT NULL,
  `TAGS` varchar(60) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `STATUS` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_faculty_folder`
--

CREATE TABLE `user_faculty_folder` (
  `ID` int(60) NOT NULL,
  `USER_ID` varchar(60) NOT NULL,
  `FOLDER_NAME` varchar(60) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `STATUS` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faculty_folder`
--
ALTER TABLE `faculty_folder`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `files_folder`
--
ALTER TABLE `files_folder`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shared_files`
--
ALTER TABLE `shared_files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_faculty_files`
--
ALTER TABLE `user_faculty_files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_faculty_folder`
--
ALTER TABLE `user_faculty_folder`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `ID` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `ID` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `shared_files`
--
ALTER TABLE `shared_files`
  MODIFY `ID` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_faculty_files`
--
ALTER TABLE `user_faculty_files`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_faculty_folder`
--
ALTER TABLE `user_faculty_folder`
  MODIFY `ID` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
