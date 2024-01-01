-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 12:23 PM
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
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `application_id` int(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `vacancy_id` int(30) NOT NULL,
  `resume` varchar(40) NOT NULL,
  `bio` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `feedback` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `login_id`, `vacancy_id`, `resume`, `bio`, `status`, `feedback`) VALUES
(1, 4, 1, 'CAR TEST DRIVE BOOKING WEBSITE.docx', 'hbhbjhb', 'Accept', 'kjnkjnk'),
(2, 4, 1, 'RDInstallmentReport28-12-2023.xls', 'jhkgbmkliuh', 'Reject', 'jhbjh');

-- --------------------------------------------------------

--
-- Table structure for table `book_location`
--

CREATE TABLE `book_location` (
  `booking_id` int(30) NOT NULL,
  `location_id` int(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `details` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_location`
--

INSERT INTO `book_location` (`booking_id`, `location_id`, `login_id`, `start_date`, `end_date`, `details`, `status`) VALUES
(1, 9, 3, '2024-01-06', '2024-01-05', 'kjhkj', 'reject'),
(2, 9, 3, '2024-01-06', '2024-01-05', 'kjhkj', 'accept'),
(3, 9, 3, '2024-01-06', '2024-01-05', 'kjhkj', 'accept'),
(4, 9, 0, '2024-01-06', '2024-01-05', 'kjhkj', 'accept'),
(5, 9, 3, '2023-12-25', '2024-01-04', 'kjnkjn', 'accept'),
(6, 0, 3, '2024-01-03', '2024-01-06', 'knkjhbn', 'pending'),
(7, 0, 3, '2024-01-01', '2024-01-06', 'kjnkjn', 'pending'),
(8, 9, 3, '2023-12-30', '2024-01-05', 'njhvngb', 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `hiring`
--

CREATE TABLE `hiring` (
  `hiring_id` int(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `id_proof` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hiring`
--

INSERT INTO `hiring` (`hiring_id`, `login_id`, `name`, `phone`, `photo`, `id_proof`, `address`, `status`) VALUES
(1, 3, 'manu', '8947564734', 'kadmin.png', 'kowner.png', 'kjhbjbjhj', 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `lender`
--

CREATE TABLE `lender` (
  `lender_id` int(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `id_proof` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lender`
--

INSERT INTO `lender` (`lender_id`, `login_id`, `name`, `phone`, `photo`, `id_proof`, `address`, `status`) VALUES
(1, 5, 'vismaya', '8374547565', 'kadmin.png', 'kowner.png', 'hbjhbiy ihkhiuju', 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL,
  `details` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `login_id`, `name`, `price`, `details`, `image`) VALUES
(9, 5, 'kozhikode', '300', 'wonderful city', 'kadmin.png');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `username`, `password`, `type`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin'),
(2, 'admin@gmail.com', 'admin', 'admin'),
(3, 'manu@gmail.com', 'manu', 'hiring'),
(4, 'sneha@gmail.com', 'sneha', 'user'),
(5, 'vismaya@gmail.com', 'vismaya', 'lender');

-- --------------------------------------------------------

--
-- Table structure for table `previous_work`
--

CREATE TABLE `previous_work` (
  `work_id` int(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `details` varchar(100) NOT NULL,
  `image` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `previous_work`
--

INSERT INTO `previous_work` (`work_id`, `login_id`, `name`, `details`, `image`) VALUES
(1, 4, 'jhbj', 'hbjhbjh', 'CAR TEST DRIVE BOOKING WEBSITE.docx'),
(2, 4, 'khbjh', 'jhgjhgj', 'kadmin.png'),
(3, 4, 'hjgjh', 'jhgjhg', 'kadmin.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `id_proof` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `login_id`, `name`, `phone`, `photo`, `id_proof`, `address`, `status`) VALUES
(1, 4, 'sneha', '8948574834', 'kadmin.png', 'kowner.png', 'hbnbjhbh', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `vacancy_id` int(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `details` varchar(100) NOT NULL,
  `vacancies` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`vacancy_id`, `login_id`, `name`, `details`, `vacancies`) VALUES
(1, 3, 'cameraman', 'dsfsdf', 2),
(3, 3, 'makeup', 'kjhkjhkjhkjj', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `book_location`
--
ALTER TABLE `book_location`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `hiring`
--
ALTER TABLE `hiring`
  ADD PRIMARY KEY (`hiring_id`);

--
-- Indexes for table `lender`
--
ALTER TABLE `lender`
  ADD PRIMARY KEY (`lender_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `previous_work`
--
ALTER TABLE `previous_work`
  ADD PRIMARY KEY (`work_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`vacancy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_location`
--
ALTER TABLE `book_location`
  MODIFY `booking_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hiring`
--
ALTER TABLE `hiring`
  MODIFY `hiring_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lender`
--
ALTER TABLE `lender`
  MODIFY `lender_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `previous_work`
--
ALTER TABLE `previous_work`
  MODIFY `work_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `vacancy_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
