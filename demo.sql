-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 03:57 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brandnum` varchar(200) NOT NULL,
  `brandname` varchar(200) DEFAULT NULL,
  `imagename` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brandnum`, `brandname`, `imagename`, `status`) VALUES
(7, 'R001', 'Rolex', 'R001.jpg', 1),
(9, 'O001', 'omega', 'O001.jpg', 1),
(10, 'B001', 'Bretiling', 'B001.jpg', 1),
(11, 'T001', 'Tudor', 'T001.jfif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userid`, `prod_id`) VALUES
(4, 3, 15),
(18, 6, 18),
(21, 7, 19);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_no` varchar(200) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image_name` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `model_no`, `price`, `image_name`, `status`) VALUES
(13, 7, 'Rm01', 20000, 'Rm01.jpg', 0),
(15, 7, 'Rm03', 12000, 'Rm03.webp', 1),
(16, 7, 'Rm04', 50000, 'Rm04.webp', 1),
(17, 9, 'Om01', 50000, 'Om01.jpg', 1),
(18, 9, 'Om02', 12000, 'Om02.webp', 1),
(19, 9, 'Om03', 100000, 'Om03.webp', 1),
(20, 9, 'Om04', 50000, 'Om04.jpg', 1),
(21, 10, 'Bm01', 50000, 'Bm01.webp', 1),
(22, 10, 'Bm02', 100000, 'Bm02.webp', 1),
(23, 10, 'Bm03', 12000, 'Bm03.jfif', 1),
(24, 10, 'Bm04', 100000, 'Bm04.jfif', 1),
(25, 11, 'Tm01', 15000, 'Tm01.jfif', 1),
(26, 11, 'Tm02', 12000, 'Tm02.jfif', 1),
(27, 11, 'Tm03', 20000, 'Tm03.jfif', 1),
(28, 11, 'Tm04', 100000, 'Tm04.webp', 1),
(29, 7, 'Rm05', 20000, 'Rm05.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'pranav', 'manav', 'sakariya', 'jbkke@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(2, 'test', 'nirali', 'gajera', 'bjbj@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(3, 'nirmit', 'niru', 'sakariya', 'jbkkle@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(4, 'testing', 'nirmit', 'sakriya', 'pranav@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(5, 'admin', 'dhruv', 'jbjbe', 'bjb@gamil.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(6, 'pranav1', 'hbijb', 'sakriya', 'jke@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(7, 'pranav2', 'nirali', 'manab', 'ke@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brandnum` (`brandnum`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `model_no` (`model_no`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
