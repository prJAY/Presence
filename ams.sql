-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2021 at 07:55 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_master`
--

CREATE TABLE `attendance_master` (
  `aid` int(5) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `present_no` int(4) NOT NULL,
  `absent_no` int(4) NOT NULL,
  `present_list` text NOT NULL,
  `absent_list` text NOT NULL,
  `record_by` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_master`
--

INSERT INTO `attendance_master` (`aid`, `class_id`, `present_no`, `absent_no`, `present_list`, `absent_list`, `record_by`, `date`) VALUES
(18, 'BCA_2019', 4, 0, '19BCA001,19BCA002,19BCA003,19BCA004', '', 'Jay Prajapati', '2021-10-18'),
(19, 'BCA_2019', 3, 1, '19BCA001,19BCA003,19BCA004', '19BCA002', 'Jay Prajapati', '2021-10-19'),
(21, 'BCA_2019', 2, 2, '19BCA002,19BCA003', '19BCA001,19BCA004', 'Jay Prajapati', '2021-10-20'),
(22, 'BCA_2019', 3, 1, '19BCA001,19BCA002,19BCA004', '19BCA003', 'Jay Prajapati', '2021-10-21'),
(24, 'BscIT_2019', 3, 0, '19BscIT001,19BscIT002,19BscIT003', '', 'Jay Prajapati', '2021-10-21'),
(25, 'BscIT_2019', 2, 1, '19BscIT001,19BscIT002', '19BscIT003', 'Jay Prajapati', '2021-10-22'),
(27, 'BCA_2019', 3, 0, '19BCA001,19BCA002,19BCA003', '', 'Jay Prajapati', '2021-10-22'),
(28, 'MCA_2020', 3, 2, '20MCA001,20MCA002,20MCA003', '20MCA004,20MCA005', 'Jay Prajapati', '2021-10-29'),
(29, 'MScIT_2020', 4, 0, '20MScIT001,20MScIT002,20MScIT003,20MScIT004', '', 'Jay Prajapati', '2021-10-29'),
(31, 'MScIT_2020', 3, 1, '20MScIT001,20MScIT002,20MScIT003', '20MScIT004', 'Jay Prajapati', '2021-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ClassId` varchar(20) NOT NULL,
  `ClassCourse` varchar(20) NOT NULL,
  `ClassYear` int(20) NOT NULL,
  `ClassSem` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ClassId`, `ClassCourse`, `ClassYear`, `ClassSem`) VALUES
('BCA_2019', 'BCA', 2019, 5),
('BscIT_2019', 'BscIT', 2019, 5),
('MCA_2020', 'MCA', 2020, 4),
('MCA_2021', 'MCA', 2021, 1),
('MScIT_2020', 'MScIT', 2020, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_Id` varchar(20) NOT NULL,
  `stud_Fname` varchar(10) NOT NULL,
  `stud_Lname` varchar(10) NOT NULL,
  `stud_Class` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_Id`, `stud_Fname`, `stud_Lname`, `stud_Class`) VALUES
('19BCA001', 'Sonia', 'Andrews', 'BCA_2019'),
('19BCA002', 'Caroline', 'Flowers', 'BCA_2019'),
('19BCA003', 'Skye', 'Dorsey', 'BCA_2019'),
('19BscIT001', 'Naomi', 'Avila', 'BscIT_2019'),
('19BscIT002', 'Chandler', 'Joseph', 'BscIT_2019'),
('19BscIT003', 'Thomas', 'Evans', 'BscIT_2019'),
('20MCA001', 'Roland', 'Briggs', 'MCA_2020'),
('20MCA002', 'Sofia', 'Weiss', 'MCA_2020'),
('20MCA003', 'Tucker', 'Glenn', 'MCA_2020'),
('20MCA004', 'Anton', 'Morton', 'MCA_2020'),
('20MCA005', 'Noel', 'Hunt', 'MCA_2020'),
('20MScIT001', 'Melody', 'Solomon', 'MScIT_2020'),
('20MScIT002', 'Tomas', 'Fernandez', 'MScIT_2020'),
('20MScIT003', 'Carmen', 'Hunt', 'MScIT_2020'),
('20MScIT004', 'Skyler', 'Sloan', 'MScIT_2020');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` varchar(20) NOT NULL,
  `user_pass` varchar(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_type` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_pass`, `user_name`, `user_type`) VALUES
('admin', 'admin', 'Jay Prajapati', 'A'),
('faculty', 'faculty', 'Jay Prajapati', 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_master`
--
ALTER TABLE `attendance_master`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ClassId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_Id`),
  ADD KEY `fk_class_id` (`stud_Class`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_master`
--
ALTER TABLE `attendance_master`
  MODIFY `aid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_class_id` FOREIGN KEY (`stud_Class`) REFERENCES `class` (`ClassId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
