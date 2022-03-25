-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 07:04 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appoinment_tbl`
--

CREATE TABLE `appoinment_tbl` (
  `AppoinmentId` bigint(20) NOT NULL,
  `PatientId` int(11) NOT NULL DEFAULT '0',
  `DoctorId` int(11) NOT NULL DEFAULT '0',
  `Date` date NOT NULL,
  `Time` varchar(150) NOT NULL,
  `Details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appoinment_tbl`
--

INSERT INTO `appoinment_tbl` (`AppoinmentId`, `PatientId`, `DoctorId`, `Date`, `Time`, `Details`) VALUES
(1, 1, 1, '2022-03-25', '3', 'qwerty'),
(2, 2, 2, '2022-03-25', '5', 'iopll'),
(3, 1, 2, '2022-03-25', '7', 'jjj'),
(4, 3, 2, '2022-03-25', '6', 'pp'),
(5, 2, 2, '2022-03-25', '3', 'll'),
(6, 4, 1, '2022-03-25', '1', '10 to 10.30'),
(7, 4, 2, '2022-03-25', '1', '10 - 10.30'),
(8, 4, 4, '2022-03-25', '3', '11-11.30'),
(9, 4, 5, '2022-03-25', '6', '12.30-1.00');

-- --------------------------------------------------------

--
-- Table structure for table `consultation_time_tbl`
--

CREATE TABLE `consultation_time_tbl` (
  `ConsultationId` bigint(20) NOT NULL,
  `Time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultation_time_tbl`
--

INSERT INTO `consultation_time_tbl` (`ConsultationId`, `Time`) VALUES
(1, '10.00-10.30'),
(2, '10.30-11.00'),
(3, '11.00-11.30'),
(4, '11.30-12.00'),
(5, '12.00-12.30'),
(6, '12.30-13.00'),
(7, '13.00-13.30'),
(8, '13.30-14.00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specialize_tbl`
--

CREATE TABLE `doctor_specialize_tbl` (
  `DoctorId` int(11) DEFAULT NULL,
  `Specialize` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_specialize_tbl`
--

INSERT INTO `doctor_specialize_tbl` (`DoctorId`, `Specialize`) VALUES
(1, 'Internal Medicine'),
(2, 'Pediatrics'),
(3, 'Ophthalmology'),
(4, 'Orthopedics'),
(5, 'Dermatology');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_tbl`
--

CREATE TABLE `doctor_tbl` (
  `DoctorId` bigint(20) NOT NULL,
  `DoctorName` varchar(350) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_tbl`
--

INSERT INTO `doctor_tbl` (`DoctorId`, `DoctorName`) VALUES
(1, 'Dr. Anil'),
(2, 'Dr. Maya'),
(3, 'Dr. Gayathri'),
(4, 'Dr. Sara'),
(5, 'Dr. Deepu');

-- --------------------------------------------------------

--
-- Table structure for table `patient_tbl`
--

CREATE TABLE `patient_tbl` (
  `PatientId` bigint(20) NOT NULL,
  `Name` varchar(350) NOT NULL DEFAULT '0',
  `MobileNo` varchar(350) NOT NULL DEFAULT '0',
  `Address` varchar(500) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_tbl`
--

INSERT INTO `patient_tbl` (`PatientId`, `Name`, `MobileNo`, `Address`) VALUES
(1, 'amaya', '9876543210', 'askfhjfnvkfj'),
(2, 'meera', '9638520741', 'dfggfhb'),
(3, 'tina', '8520147963', 'tghfhdf'),
(4, 'usha', '5896321047', 'ioklpinn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appoinment_tbl`
--
ALTER TABLE `appoinment_tbl`
  ADD PRIMARY KEY (`AppoinmentId`);

--
-- Indexes for table `consultation_time_tbl`
--
ALTER TABLE `consultation_time_tbl`
  ADD PRIMARY KEY (`ConsultationId`);

--
-- Indexes for table `doctor_tbl`
--
ALTER TABLE `doctor_tbl`
  ADD PRIMARY KEY (`DoctorId`);

--
-- Indexes for table `patient_tbl`
--
ALTER TABLE `patient_tbl`
  ADD PRIMARY KEY (`PatientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appoinment_tbl`
--
ALTER TABLE `appoinment_tbl`
  MODIFY `AppoinmentId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `consultation_time_tbl`
--
ALTER TABLE `consultation_time_tbl`
  MODIFY `ConsultationId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `doctor_tbl`
--
ALTER TABLE `doctor_tbl`
  MODIFY `DoctorId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `patient_tbl`
--
ALTER TABLE `patient_tbl`
  MODIFY `PatientId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
