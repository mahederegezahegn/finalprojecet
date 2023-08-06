-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 10:21 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `address`, `phone`, `password`) VALUES
(2, 'semir ibrahim', 'semiribrahim@gmail.com', 'addiss abeba', '0911232323', 'semiribrahim');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` time NOT NULL,
  `doctor_id` int(6) UNSIGNED DEFAULT NULL,
  `reason` enum('checkup','cleaning','whitening','filling','extraction','other') NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `online` varchar(20) NOT NULL DEFAULT 'not online'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `name`, `email`, `preferred_date`, `preferred_time`, `doctor_id`, `reason`, `approve`, `online`) VALUES
(9, 'lelida tigist', 'leli@gmail.com', '2023-06-11', '10:56:00', 5, 'whitening', 1, 'not online'),
(10, 'nathan', 'nathan12gez@gmail.com', '2023-06-10', '11:57:00', 1, 'extraction', 0, 'not online'),
(11, 'mahedere gezahegn', 'redu@gmail.com', '2023-06-11', '09:58:00', 1, 'checkup', 1, 'not online'),
(12, 'lelida tigist', 'leli@gmail.com', '2023-07-11', '03:23:00', 1, 'filling', 0, 'not online'),
(13, 'nathan', 'nathan12gez@gmail.com', '2023-06-11', '11:41:00', 1, 'filling', 0, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `approve_patient`
--

CREATE TABLE `approve_patient` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `city` varchar(50) NOT NULL,
  `reasone` varchar(20) NOT NULL,
  `appointment_id` int(10) UNSIGNED DEFAULT NULL,
  `doctor_name` varchar(30) NOT NULL,
  `see` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `approve_patient`
--

INSERT INTO `approve_patient` (`id`, `first_name`, `last_name`, `email`, `phone`, `gender`, `city`, `reasone`, `appointment_id`, `doctor_name`, `see`) VALUES
(12, 'tigist', 'kebede', 'tigistkebede@gmail.com', '091223345', 'female', 'addiss abeba', 'check up', NULL, 'maheder', 1),
(17, 'lelida tigist', 'kebede', 'leli@gmail.com', '1212121212', 'female', 'addiss abeba', 'filling', 9, 'Nebiyu', 1),
(18, '', '', '', '', '', '', 'checkup', 11, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `patient_id`, `text`, `date`, `approved`) VALUES
(11, 8, 'this is the best design', '2023-06-08', 1),
(13, 1, 'the best website', '2023-06-09', 1),
(14, 1, 'the doctors are polite and friendly to my child and me i will go back for sure', '2023-06-09', 1),
(15, 11, 'the doctors are polite and friendly to my child and me i will go back for sure', '2023-06-10', 1),
(16, 11, 'the cleaning procedure was perfect ', '2023-06-10', 0),
(17, 13, 'this website is full of information ', '2023-06-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_advice`
--

CREATE TABLE `doctor_advice` (
  `advice_id` int(6) UNSIGNED NOT NULL,
  `doctor_id` int(6) UNSIGNED DEFAULT NULL,
  `advice` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor_advice`
--

INSERT INTO `doctor_advice` (`advice_id`, `doctor_id`, `advice`, `date`, `approved`) VALUES
(1, 1, 'always wait till the 3rd date after the Surgery before every appointment', '2023-06-09', 1),
(2, 1, 'hello iam here to help you ', '2023-06-09', 1),
(3, 5, 'always wait till the 3rd date after the Surgery before every appointment', '2023-06-09', 1),
(4, 1, 'always wait till the 3rd date after the Surgery before every appointment', '2023-06-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(6) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `speciality` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `email`, `phone`, `password`, `address`, `image`, `job_title`, `speciality`) VALUES
(1, 'maheder', 'gezaheheng', 'lelidagezahegn@gmail.com', '0979089495', '121212', 'addiss abeba', '6482299ff36e92.05693206.jpg', 'Doctor', 'Cleaning'),
(2, 'tigist', 'kebede', 'tigist@gmail.com', '09114632334', 'tigist1212', 'addiss abeba', '6482428f96f778.48771674.jpg', 'Receptionist', 'Reception'),
(3, 'bedru', 'yt', 'redu@gmail.com', '0979089498', '121212', 'addiss abeba', '64837108f3aee2.77054594.jpg', 'Nurse', 'Nursing'),
(5, 'Nebiyu', 'leul', 'nabiyuleul@gmail.com', '0912422323', 'nebiyu', 'hawassa', '648373b0e2c574.30730346.jpg', 'Doctor', 'Filling');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(5) NOT NULL,
  `city` varchar(200) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `email`, `phone`, `gender`, `city`, `password`, `last_name`) VALUES
(11, 'lelida tigist', 'leli@gmail.com', '1212121212', 'Femal', 'addiss abeba', '121212', ''),
(12, 'nathan', 'nathan12gez@gmail.com', '0912121212', 'Male', 'gimbicho', 'nathan', 'desta'),
(13, 'semir', 'semiribrahim@gmail.com', '0993234233', 'Male', 'bahirdar', 'semiribrahim', 'ibrahim');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `name`, `description`, `price`, `image`) VALUES
(1, 'tooth filling', 'this is best of our customer uses', 12312.00, 'uploads/64822ba0237e7.jpg'),
(2, 'whitening Tooth ', 'this is best of our customer uses with most Experienced Doctors   ', 13000.00, 'uploads/648369041cfd1.jpg'),
(3, 'filling', '50% discount in the holiday', 5000.00, 'uploads/6483694124e38.jpg'),
(4, 'check up', 'the check up means you care about your self ', 1000.00, 'uploads/64836989748a6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `approve_patient`
--
ALTER TABLE `approve_patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_approve_patient_appointment` (`appointment_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `doctor_advice`
--
ALTER TABLE `doctor_advice`
  ADD PRIMARY KEY (`advice_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `approve_patient`
--
ALTER TABLE `approve_patient`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `doctor_advice`
--
ALTER TABLE `doctor_advice`
  MODIFY `advice_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `approve_patient`
--
ALTER TABLE `approve_patient`
  ADD CONSTRAINT `fk_approve_patient_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
