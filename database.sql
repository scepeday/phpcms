-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2026 at 08:09 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(11) NOT NULL,
  `venue_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  `contact_person` varchar(150) DEFAULT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `venue_name`, `address`, `city`, `capacity`, `contact_person`, `contact_email`, `created_at`) VALUES
(1, 'Grand Hall Convention Center', '123 King Street', 'Toronto', 500, 'Sarah Johnson', 'sarah.johnson@example.com', '2026-04-20 14:40:38'),
(2, 'Lakeside Banquet Hall', '45 Waterfront Drive', 'Mississauga', 300, 'Michael Chen', 'michael.chen@example.com', '2026-04-20 14:40:38'),
(3, 'Maple Leaf Event Space', '78 Queen Street', 'Brampton', 200, 'Priya Singh', 'priya.singh@example.com', '2026-04-20 14:40:38'),
(4, 'Skyline Rooftop Venue', '12 Bayview Avenue', 'Toronto', 150, 'Daniel Roberts', 'daniel.roberts@example.com', '2026-04-20 14:40:38'),
(7, 'Aurora Event Loft', '128 Crescentview Avenue', 'Oakville', 250, 'Melissa Grant', 'melissa.grant@auroraloft.ca', '2026-04-20 19:15:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
