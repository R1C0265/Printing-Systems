-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 26, 2023 at 05:58 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `printing_systems`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `ap_id` int NOT NULL AUTO_INCREMENT,
  `student` int NOT NULL,
  `lecture` int NOT NULL,
  `ap_title` varchar(70) NOT NULL,
  `date_` datetime NOT NULL,
  `state` int NOT NULL DEFAULT '0' COMMENT '1 allowed, 2 deny, 3 rescheduled',
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`ap_id`, `student`, `lecture`, `ap_title`, `date_`, `state`, `stamp`) VALUES
(6, 5, 4, 'Review of SRS document', '2021-07-07 09:56:00', 2, '2023-09-21 07:54:46'),
(7, 31, 3, 'tO DIScuss project', '2022-06-14 10:47:00', 0, '2023-09-21 07:54:46'),
(8, 6, 3, 'to pray', '2022-06-23 00:17:00', 0, '2023-09-21 07:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `comment_text` text,
  `customer_id` int NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
CREATE TABLE IF NOT EXISTS `information` (
  `info_id` int NOT NULL AUTO_INCREMENT,
  `info_title` varchar(128) DEFAULT NULL,
  `info_description` text,
  `info_type` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`info_id`, `info_title`, `info_description`, `info_type`) VALUES
(1, 'wfa', 'asdfa', 'asdf'),
(2, 'Introduction', 'alot of words that are supposed to make sense.', ''),
(3, 'Welcome to Printer Systems', 'Total Branding & Printing Solutions', 'Welcome Note');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `news_title` varchar(1280) DEFAULT NULL,
  `news_info` text,
  `author` varchar(128) DEFAULT NULL,
  `news_image` text,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int NOT NULL AUTO_INCREMENT,
  `page_name` varchar(50) DEFAULT NULL,
  `page_location` text,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` text NOT NULL,
  `product_amount` text NOT NULL,
  `product_category` text NOT NULL,
  `product_price` text NOT NULL,
  `product_image_location` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '../images/products/shoppin_cart%202.png',
  `product_image_alt` varchar(124) DEFAULT 'an image of your selected product',
  `product_description` text,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_amount`, `product_category`, `product_price`, `product_image_location`, `product_image_alt`, `product_description`) VALUES
(1, 'JK Golf Shirts', '200', 'Golf Shirts', '15000', '../images/products/jk golf shirt.jpeg', NULL, NULL),
(2, 'JK T-Shirts', '190', 'T-Shirts', '15000', '../images/products/OIF.jfif', NULL, NULL),
(3, 'Puma Soccer Boots', '20', 'Soccer Boots', '65000', '../images/products/download.jfif', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `pr_id` int NOT NULL AUTO_INCREMENT,
  `pr_name` varchar(70) NOT NULL,
  `student` int NOT NULL,
  `lecture` int NOT NULL DEFAULT '0',
  `pr_desc` text NOT NULL,
  `pr_state` int NOT NULL DEFAULT '0' COMMENT '0 not taken, 1 supervised by, 2 submitted FD, 3 alumni\r\n',
  `pr_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pr_id`, `pr_name`, `student`, `lecture`, `pr_desc`, `pr_state`, `pr_stamp`) VALUES
(3, 'Fumigation System', 5, 4, 'The confirm() method displays a dialog box with a specified message, along with an OK and a Cancel button.\r\n\r\nA confirm box is often used if you want the user to verify or accept something.\r\n\r\nNote: The confirm box takes the focus away from the current window, and forces the browser to read the message. Do not overuse this method, as it prevents the user from accessing other parts of the page until the box is closed.\r\n\r\nThe confirm() method returns true if the user clicked \"OK\", and false otherwise.', 3, '2021-07-04 12:36:07'),
(4, 'werw', 31, 3, 'gsh dffghdfh nfdv hsfdhdz gdsg', 2, '2022-06-01 12:47:27'),
(5, 'fuck', 6, 3, 'erhtr ', 1, '2022-06-01 14:08:59'),
(8, 'A Project', 37, 0, 'reter', 1, '2022-06-06 22:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `pr_docs`
--

DROP TABLE IF EXISTS `pr_docs`;
CREATE TABLE IF NOT EXISTS `pr_docs` (
  `pd_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pr_id` int NOT NULL,
  PRIMARY KEY (`pd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pr_docs`
--

INSERT INTO `pr_docs` (`pd_id`, `type`, `file`, `stamp`, `pr_id`) VALUES
(3, 'SRS Document', 'Transfer Form.docx', '2023-09-21 07:54:48', 3),
(18, 'Concept Note', 'Computer Security.docx', '2023-09-21 07:54:48', 6),
(20, 'SRS Document', 'Tough Bwana SRS.pdf', '2023-09-21 07:54:48', 6),
(22, 'Concept Note', 'RR Concept Note', '2023-09-21 07:54:48', 7),
(39, 'Concept Note', 'Tough Bwana Concept Note.pdf', '2023-09-21 07:54:48', 8),
(41, 'UML Document', 'Tough Bwana UML Document.pdf', '2023-09-21 07:54:48', 8),
(44, 'Concept Note', 'John Kittle concept note.pdf', '2023-09-21 07:54:48', 4),
(48, 'Final Documentation', 'John Kittle Final Documentation.pdf', '2023-09-21 07:54:48', 4),
(51, 'Use Case Document', 'John Kittle Use Case Document.pdf', '2023-09-21 07:54:48', 4),
(56, 'UML Document', 'John Kittle UML Document.pdf', '2023-09-21 07:54:48', 4),
(57, 'Final Project Zip', 'John Kittle Final Project.zip', '2023-09-21 07:54:48', 4),
(58, 'DDS Document', 'John Kittle DDS Document.pdf', '2023-09-21 07:54:48', 4),
(59, 'SRS Document', 'John Kittle SRS Document.pdf', '2023-09-21 07:54:48', 4),
(60, 'Concept Note', 'Jimmy Kazembe concept note.pdf', '2023-09-21 07:54:48', 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `purchase_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `services_id` int NOT NULL AUTO_INCREMENT,
  `service_title` varchar(128) DEFAULT NULL,
  `service_description` text,
  PRIMARY KEY (`services_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `service_title`, `service_description`) VALUES
(1, 'sadfasdf', 'asdfasdas dasdf'),
(2, 'Large Format Printing', 'Our products is large format printing include:\r\n\r\nRoad Banners, Roll-up banners, X-banners,Pop-Ups, Billboards, Clip Frames, Tear drops, Posters, Stickers, Wall signs, Road signs, Lamination, Full color posters, POP Display stand, Picture Frames'),
(3, 'Welcome to Printer Systems', 'Total Branding and Printing solutions'),
(4, 'Offset and digital printing', 'Our Products uin digital aqnd offset printing include but not limited:\r\n\r\nBooklets, Brochures, Leaflets, Catalogues,Business cards, folders,Newspaper Inserts,PVC cards, Invitations, Certificates, Letterhead, Envelopes, Identity cards, Annual Report, Fliers, Tickets, Newsletters.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `u_name` varchar(50) NOT NULL,
  `u_email` varchar(70) NOT NULL,
  `u_password` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '70352f41061eda4ff3c322094af068ba70c3b38b',
  `u_type` int NOT NULL COMMENT '1-amin, 2-lecture, 3-finale, 4 student',
  `u_img` varchar(70) NOT NULL DEFAULT 'user.svg',
  `u_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_number1` text,
  `u_number2` text,
  `u_address` text,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_password`, `u_type`, `u_img`, `u_stamp`, `u_number1`, `u_number2`, `u_address`) VALUES
(2, 'Susan Chinyama', 'susanchinyama@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 1, 'user.svg', '2021-07-05 08:38:35', NULL, NULL, NULL),
(3, 'Clifford Ghambi', 'cliffordghambi@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 2, 'photo_2021-03-11_16-32-22.jpg', '2021-07-05 08:38:35', NULL, NULL, NULL),
(4, 'Tchilli Alindiamawo', 'Tchillialindiamawo@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 2, 'photo_2021-03-18_16-01-12.jpg', '2021-07-05 08:26:11', NULL, NULL, NULL),
(5, 'Eric Kabambe', 'erickabambe@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'photo_2021-03-18_16-01-12.jpg', '2021-07-05 08:26:11', NULL, NULL, NULL),
(6, 'Jimmy Kazembe', 'jimmykazembe@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'photo_2021-03-18_16-01-12.jpg', '2021-07-05 08:26:11', NULL, NULL, NULL),
(31, 'John Kittle', 'jk@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'user.svg', '2022-06-01 12:03:46', NULL, NULL, NULL),
(33, 'rico', 'admin@admin.admin', '70352f41061eda4ff3c322094af068ba70c3b38b', 2, 'user.svg', '2022-06-01 12:30:59', NULL, NULL, NULL),
(34, 'RR', 'rr@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'user.svg', '2022-06-06 13:14:40', NULL, NULL, NULL),
(36, 'Chadwick Boseman', 'bd@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'user.svg', '2022-06-06 20:35:48', NULL, NULL, NULL),
(37, 'Tough Bwana', 'zgr@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'user.svg', '2022-06-06 20:35:49', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `welcome_notes`
--

DROP TABLE IF EXISTS `welcome_notes`;
CREATE TABLE IF NOT EXISTS `welcome_notes` (
  `notes_id` int NOT NULL AUTO_INCREMENT,
  `notes_title` varchar(128) DEFAULT NULL,
  `notes_description` text,
  PRIMARY KEY (`notes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `welcome_notes`
--

INSERT INTO `welcome_notes` (`notes_id`, `notes_title`, `notes_description`) VALUES
(1, 'adskfs', 'askd;f');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
