-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 09:42 AM
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
-- Database: `cake_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `bcake`
--

CREATE TABLE `bcake` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcake`
--

INSERT INTO `bcake` (`id`, `name`, `price`, `image`) VALUES
(1, 'Birthday Perfect Cake', 400.00, 'b1.jpeg'),
(3, 'Golden choco Cake', 1600.00, 'b3.jpg'),
(4, 'Choclate Delight', 1000.00, 'b4.jpg'),
(6, 'Cholo special Delight', 1700.00, 'b6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cakes`
--

CREATE TABLE `cakes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`id`, `name`, `image`, `price`) VALUES
(1, 'Chocolate Cake', 'choco1.webp', 500.00),
(2, 'Strawberry Delight', 'cake2.jpg', 600.00),
(3, 'Black Forest', 'b1.jpeg', 550.00),
(4, 'Pineapple Cake', 'p.jpg', 450.00),
(5, 'Red Velvet', 'l4.jpeg', 700.00),
(6, 'Vanilla Cream', 'v1.jpg', 400.00),
(7, 'Choco lava Cake', 'lava.jpg', 500.00),
(8, 'Special Vanilla Cake', 'v2.jpg', 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `cake_categories`
--

CREATE TABLE `cake_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_categories`
--

INSERT INTO `cake_categories` (`id`, `name`, `image_url`, `link`) VALUES
(1, 'Photo Cakes', 'p5.jpg', 'pcake.php'),
(2, 'Designer Cakes', 'd2.jpeg', 'dcake.php'),
(3, 'Birthday Cakes', 'b6.jpg', 'bcake.php'),
(4, 'Love Cakes', 'l3.jpeg', 'lcake.php'),
(5, 'Special Cakes', 'cake3.jpg', 'scake.php');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cake_name` varchar(100) DEFAULT NULL,
  `cake_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `cake_name`, `cake_image`, `quantity`, `total_price`, `created_at`) VALUES
(1, 6, 'Chocolate Almond', NULL, 2, 600.00, '2025-10-29 08:41:24'),
(2, 6, 'Strawberry Delight', NULL, 4, 2400.00, '2025-10-29 08:40:55'),
(3, 6, 'Vanilla Delight', NULL, 1, 500.00, '2025-10-29 08:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `chocolate`
--

CREATE TABLE `chocolate` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chocolate`
--

INSERT INTO `chocolate` (`id`, `name`, `image`, `price`) VALUES
(1, 'Hazelnut Rocks', 'ch1.jpg', 250.00),
(2, 'Chocolate Almond', 'ch2.jpg', 300.00),
(3, 'Truffle Bombs', 'chc.jpeg', 350.00),
(4, 'Chocolate Special', 'ch4.jpeg', 450.00),
(5, 'Nutty Crunch', 'ch5.jpeg', 200.00),
(6, 'Fudge Treat', 'ch6.jpeg', 150.00),
(7, 'Milky Magic', 'ch7.jpeg', 500.00),
(8, 'Dark Delight', 'ch8.jpeg', 420.00);

-- --------------------------------------------------------

--
-- Table structure for table `dcake`
--

CREATE TABLE `dcake` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dcake`
--

INSERT INTO `dcake` (`id`, `name`, `price`, `image`) VALUES
(1, 'Angry Bird Cake', 700.00, 'd1.jpeg'),
(2, 'Red bird Cake', 800.00, 'd2.jpeg'),
(3, 'Blue bird Cake', 900.00, 'd3.jpeg'),
(5, 'Bheem theme cake', 1100.00, 'd5.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `lcake`
--

CREATE TABLE `lcake` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lcake`
--

INSERT INTO `lcake` (`id`, `name`, `image`, `price`) VALUES
(1, 'Perfectlove Cake', 'l4.jpeg', 600.00),
(2, 'love Magic Cake', 'l5.jpg', 1200.00),
(3, 'Golden love Cake', 'l6.jpg', 1800.00),
(6, 'love choco Delight', 'l3.jpeg', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `pcakes`
--

CREATE TABLE `pcakes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pcakes`
--

INSERT INTO `pcakes` (`id`, `name`, `image`, `price`) VALUES
(1, 'Picture Perfect Cake', 'p1.jpg', 500.00),
(2, 'Photo Magic Cake', 'p2.jpg', 1000.00),
(3, 'Golden Frame Cake', 'p3.jpg', 1500.00),
(4, 'Snapshot Delight', 'p4.jpg', 750.00);

-- --------------------------------------------------------

--
-- Table structure for table `scake`
--

CREATE TABLE `scake` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scake`
--

INSERT INTO `scake` (`id`, `name`, `image`, `price`) VALUES
(1, 'Chocolate Delight', 'cake1.jpg', 300.00),
(2, 'Strawberry Chocolate Cake', 'cake2.jpg', 500.00),
(3, 'Strawberry Heaven', 'cake3.jpg', 450.00),
(4, 'Vanilla Delight', 'cake4.jpg', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Neel Patel', 'pneel21@gmail.com', '$2y$10$yHa3.1L3NTz8kwDEkJHKoOBtkaN9UL8kg4qaqjsRc7LSad6vIpwzy', '2025-10-29 08:40:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bcake`
--
ALTER TABLE `bcake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cake_categories`
--
ALTER TABLE `cake_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chocolate`
--
ALTER TABLE `chocolate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcake`
--
ALTER TABLE `dcake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lcake`
--
ALTER TABLE `lcake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcakes`
--
ALTER TABLE `pcakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scake`
--
ALTER TABLE `scake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bcake`
--
ALTER TABLE `bcake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cake_categories`
--
ALTER TABLE `cake_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `chocolate`
--
ALTER TABLE `chocolate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dcake`
--
ALTER TABLE `dcake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lcake`
--
ALTER TABLE `lcake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pcakes`
--
ALTER TABLE `pcakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `scake`
--
ALTER TABLE `scake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
