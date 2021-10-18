-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2021 at 07:23 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profileimg` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `ename`, `age`, `gender`, `profileimg`, `created_at`) VALUES
(1, 'abc@gmail.com', '1a4086394e', 'abcde', 'ABC', 22, 'Male', 'uploads/abcde.jpg', '2021-10-18 03:48:51'),
(2, 'Black31@gmail.com', '0ec05dca1c', '31_SiriusBlack', 'Sirius Black', 30, 'Male', 'uploads/31_SiriusBlack.jpg', '2021-10-18 03:56:14'),
(3, 'Snape31@gmail.com', '22774b69e0', '31_Severus', 'Severus Snape', 30, 'Male', 'uploads/31_Severus.jpg', '2021-10-18 04:01:11'),
(4, 'granger31@gmail.com', 'e82511708c', '4_Hermione', 'Hermione Granger', 18, 'Female', 'uploads/4_Hermione.jpg', '2021-10-18 04:06:42'),
(5, 'ron31@gmail.com', 'd34d34a309', '31_Weasley', 'Ronald Weasley', 18, 'Male', 'uploads/31_Weasley.jpg', '2021-10-18 04:12:52'),
(6, 'harry31@gmail.com', '6b57cf4a1f', '31_Potter', 'Harry J. Potter', 18, 'Male', 'uploads/31_Potter.jpg', '2021-10-18 04:16:55'),
(7, 'malfoy31@gmail.com', '5481d5b89d', '31_Malfoy', 'Draco Malfoy', 18, 'Male', 'uploads/31_Malfoy.jpg', '2021-10-18 04:40:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
