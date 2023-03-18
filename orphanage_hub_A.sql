-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 11:03 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orphanage_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `pin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`, `pin`) VALUES
(1, 'admin00', 'BWZXZQA7Cm0NYlpkAGYHYg==', 1, 'BTZbP1k8XmQ='),
(2, 'admin001', 'WToFN1liAGdZNg0zA2VfOg==', 0, 'WWpbP1M2CDI='),
(7, 'admin002', 'WToAMgU+XjkKZVhmAGYFYA==', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `blog_table`
--

CREATE TABLE `blog_table` (
  `id` int(100) NOT NULL,
  `category` varchar(255) NOT NULL,
  `blog_post` longtext NOT NULL,
  `title` varchar(255) NOT NULL,
  `featured_image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_table`
--

INSERT INTO `blog_table` (`id`, `category`, `blog_post`, `title`, `featured_image`) VALUES
(5, 'Tech', '<p><img src=\"../uploads/blog_images/orphanage-crop-white-bg.png\" alt=\"\" width=\"499\" height=\"173\"></p>', 'admin00', 'orphanage-crop-navyblue-bg.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(100) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(3, 'Tech'),
(4, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `orphanage_id` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `name_comment` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `orphanage_id`, `comment`, `name_comment`, `created_at`) VALUES
(1, 24, 'djdjdj', 'Ades', '0000-00-00 00:00:00'),
(2, 24, 'Hello', 'Anonymous', '2023-02-22 15:16:31'),
(3, 24, 'Yes 0', 'Anonymous', '2023-02-22 16:13:23'),
(4, 24, 'Yes 0', 'ANthony', '2023-02-22 16:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `orphanage_id` int(11) NOT NULL,
  `orphanage_name` varchar(250) NOT NULL,
  `name` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `orphanage_id`, `orphanage_name`, `name`, `time`, `date`, `description`, `location`) VALUES
(4, 25, 'Oluwatoyin Emmanuel Adesina', 'Party Party', '10:00', '2023-12-01', 'HJudyehkei vhfh', ''),
(5, 25, 'Oluwatoyin Emmanuel Adesina', 'Parry Again', '13:00', '1999-09-30', 'yes o yes juj', ''),
(6, 25, 'Oluwatoyin Emmanuel Adesina', 'Tayo', '18:06', '2023-08-23', 'ujuj olol, osohi', '9, ujuj olol, osohi');

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE `news_feed` (
  `id` int(100) NOT NULL,
  `orphanage_id` int(100) NOT NULL,
  `media_address` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orphanages_users`
--

CREATE TABLE `orphanages_users` (
  `id` int(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mission_statement` mediumtext NOT NULL,
  `owner` varchar(255) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `website` varchar(255) NOT NULL,
  `open_for_adoption` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `boys` int(100) NOT NULL,
  `girls` int(100) NOT NULL,
  `needs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`needs`)),
  `location` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `verification_key` varchar(250) NOT NULL,
  `email_verified` tinyint(1) NOT NULL,
  `cover_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orphanages_users`
--

INSERT INTO `orphanages_users` (`id`, `name`, `email`, `password`, `mission_statement`, `owner`, `phone_number`, `website`, `open_for_adoption`, `verified`, `created_at`, `modified_at`, `address`, `boys`, `girls`, `needs`, `location`, `state`, `country`, `verification_key`, `email_verified`, `cover_photo`) VALUES
(24, 'Oluwatoyin Emmanuel Adesina', 'toyinadesina60@gmail.com', 'A3VVZgUgXiQOewliAicCIg==', '', 'toyinadesina60@gmail.com', '08189980451', '', 0, 1, '2023-01-31 15:56:47', '2023-01-31 15:56:47', '9, Michael Adesina str, Loburo Mowe, Ogun.', 0, 0, NULL, '', '', 'Nigeria', '168940a7c4e7ff43de6e54244e077881', 1, 'caro2.jpg'),
(25, 'Oluwatoyin Emmanuel Adesina', 'toyinadesina2015@gmail.com', 'AHYAM1dyXiRbLghjU3Zefg==', '', 'Oluwatoyin Emmanuel Adesina', '+2348189980451', '', 0, 0, '2023-02-11 12:59:08', '2023-02-11 12:59:08', '9, Michael Adesina str, Loburo Mowe, Ogun.', 0, 0, NULL, '', '', 'Mauritius', 'f4ef1352a4bfcd1b468d7c7e4fab7e58', 1, 'ADESINA_OLUWATOYIN.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reply_table`
--

CREATE TABLE `reply_table` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `name_reply` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply_table`
--

INSERT INTO `reply_table` (`id`, `comment_id`, `content`, `name_reply`, `created_at`) VALUES
(0, 4, 'February', 'Toyin', '2023-02-22 18:43:25'),
(0, 4, 'Yes, You are right.', 'Anonymous', '2023-02-22 18:53:23'),
(0, 4, 'No, Stop it', 'Anonymous', '2023-02-22 18:55:44'),
(0, 3, 'No o', 'Anonymous', '2023-02-22 18:57:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `blog_table`
--
ALTER TABLE `blog_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orphanage_id` (`orphanage_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orphanages_users`
--
ALTER TABLE `orphanages_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reply_table`
--
ALTER TABLE `reply_table`
  ADD KEY `comment_id` (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_table`
--
ALTER TABLE `blog_table`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orphanages_users`
--
ALTER TABLE `orphanages_users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `orphanage_id` FOREIGN KEY (`orphanage_id`) REFERENCES `orphanages_users` (`id`);

--
-- Constraints for table `reply_table`
--
ALTER TABLE `reply_table`
  ADD CONSTRAINT `comment_id` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_outdated_events` ON SCHEDULE EVERY 3 DAY STARTS '2023-03-14 12:03:15' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM events WHERE STR_TO_DATE(date, "%Y-%m-%d") > CURRENT_DATE()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
