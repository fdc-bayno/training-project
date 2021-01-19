-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 10:39 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messages_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hubby` text DEFAULT NULL,
  `last_login_time` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_ip` varchar(20) NOT NULL COMMENT 'user ip address',
  `modified_ip` varchar(20) NOT NULL COMMENT 'user ip address'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthdate`, `hubby`, `last_login_time`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(1, 'asdasd', 'jengo221@gmail.com', 'asdasd', NULL, NULL, '2021-01-19', NULL, '0000-00-00 00:00:00', '2021-01-19 02:28:42', '2021-01-19 02:28:42', '', ''),
(2, 'asdasd', 'jengo2211@gmail.com', 'asdasd', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 02:30:43', '2021-01-19 02:30:43', '', ''),
(3, 'asdadd', 'asd@gmail.com', 'fgdfgasd', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 02:33:53', '2021-01-19 02:33:53', '', ''),
(4, 'asdadd', 'asd1@gmail.com', 'fgdfgqqq', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 02:34:36', '2021-01-19 02:34:36', '', ''),
(5, 'asdadd', 'asd3@gmail.com', 'qweqweqwe', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 02:36:56', '2021-01-19 02:36:56', '', ''),
(6, 'FDC.Bayno', 'fdc.bayno@gmail.com', 'qwertyuiop', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 02:59:35', '2021-01-19 02:59:35', '', ''),
(7, 'asdasd', 'jengo2221@gmail.com', '123456', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 03:03:00', '2021-01-19 03:03:00', '', ''),
(8, 'qweqwe', 'jengo22211@gmail.com', 'qweqweqwe', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 03:09:04', '2021-01-19 03:09:04', '', ''),
(9, '123123123', 'jengo211121@gmail.com', '123123123', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 03:10:20', '2021-01-19 03:10:20', '', ''),
(10, 'asdasd', 'jeng1o221@gmail.com', 'qweqweqwe', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 03:13:25', '2021-01-19 03:13:25', '::1', ''),
(11, 'asdasd', 'jen11go221@gmail.com', 'qweqweqwe', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 03:16:26', '2021-01-19 03:16:26', '::1', ''),
(12, 'asdasd', 'je1n11go221@gmail.com', 'qweqweqwe', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 03:16:46', '2021-01-19 03:16:46', '::1', ''),
(13, 'asdasd', 'asdasd@gmail.com', '$2a$10$fZbmTiafKSi2/tBYj210V.Qb4JwouXWv0sYVe2A1NUhpm7ipX5CB.', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 03:17:13', '2021-01-19 03:17:13', '::1', ''),
(14, 'Admin', 'admin@gmail.com', '$2a$10$CjSIXWLyTVJxgwhuxRtc8uZjSYthKopuV./S69cu3Pvpw39/lv4Ia', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 03:24:34', '2021-01-19 03:24:34', '::1', ''),
(15, 'FDC Bayno', 'admin123@gmail.com', '$2a$10$0ExS2x4V/RThG5eZgwyJoe3Ldj/SS3SL0tMdcc0zxi9amnWPPGTrC', '1611048944.jpg', '1', '2019-03-08', 'GAMING', '2021-01-19 11:43:51', '2021-01-19 04:11:48', '2021-01-19 15:22:35', '::1', '::1'),
(16, 'asdasdasdasdasd', 'asd@gm2ail.com', '$2a$10$si1LArGLzSzV1x.ym9oE5.y8TGmNJex4XI/sbVZjujbRPnVxIfVAS', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-01-19 15:02:20', '2021-01-19 15:02:20', '::1', ''),
(17, 'Marky', '', '$2a$10$V3Ue7oD/HKkXLJcEuIM7pOO6khJrkecMX/o/ppZGnDfYdohiMB1Cm', NULL, '2', '0000-00-00', 'test', '0000-00-00 00:00:00', '2021-01-19 15:19:39', '2021-01-19 15:19:39', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
