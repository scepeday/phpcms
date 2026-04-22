-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 22, 2026 at 06:38 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_type`, `event_date`, `event_time`, `description`) VALUES
(2, 'Jazz Club Night', 'Classic Jazz music', '2026-04-30', '17:00:00', 'Enjoy the Jazz culture');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `is_admin`) VALUES
(1, 'admin@admin.com', '$2y$10$eOxEunwkX6s5rmoktzKNCOcTCCIgRCY.1t.Z0JULHMkDeUxqwRvIS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `service_type`, `email`, `phone`) VALUES
(1, 'Maple Leaf Catering', 'Catering', 'bookings@mapleleafcatering.ca', '416-555-0142'),
(2, 'Northlight Photo Studio', 'Photography', 'hello@northlightphoto.ca', '647-555-0188'),
(3, 'Petal & Pine Decor', 'Decor', 'events@petalandpine.ca', '905-555-0115');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int NOT NULL,
  `venue_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `capacity` int NOT NULL,
  `contact_person` varchar(150) DEFAULT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `venue_name`, `address`, `city`, `capacity`, `contact_person`, `contact_email`, `created_at`) VALUES
(1, 'Grand Hall Convention Center', '123 King Street', 'Toronto', 500, 'Sarah Johnson', 'sarah.johnson@example.com', '2026-04-20 18:40:38'),
(2, 'Lakeside Banquet Hall', '45 Waterfront Drive', 'Mississauga', 300, 'Michael Chen', 'michael.chen@example.com', '2026-04-20 18:40:38'),
(3, 'Maple Leaf Event Space', '78 Queen Street', 'Brampton', 200, 'Priya Singh', 'priya.singh@example.com', '2026-04-20 18:40:38'),
(4, 'Skyline Rooftop Venue', '12 Bayview Avenue', 'Toronto', 150, 'Daniel Roberts', 'daniel.roberts@example.com', '2026-04-20 18:40:38'),
(7, 'Aurora Event Loft', '128 Crescentview Avenue', 'Oakville', 250, 'Melissa Grant', 'melissa.grant@auroraloft.ca', '2026-04-20 23:15:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
