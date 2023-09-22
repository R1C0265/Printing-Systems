-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2022 at 08:21 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repo`
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

INSERT INTO `appointment` (`ap_id`, `student`, `lecture`, `ap_title`, `date_`, `state`) VALUES
(6, 5, 4, 'Review of SRS document', '2021-07-07 09:56:00', 2),
(7, 31, 3, 'tO DIScuss project', '2022-06-14 10:47:00', 0),
(8, 6, 3, 'to pray', '2022-06-23 00:17:00', 0);

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

INSERT INTO `pr_docs` (`pd_id`, `type`, `file`, `pr_id`) VALUES
(3, 'SRS Document', 'Transfer Form.docx', 3),
(18, 'Concept Note', 'Computer Security.docx', 6),
(20, 'SRS Document', 'Tough Bwana SRS.pdf', 6),
(22, 'Concept Note', 'RR Concept Note', 7),
(39, 'Concept Note', 'Tough Bwana Concept Note.pdf', 8),
(41, 'UML Document', 'Tough Bwana UML Document.pdf', 8),
(44, 'Concept Note', 'John Kittle concept note.pdf', 4),
(48, 'Final Documentation', 'John Kittle Final Documentation.pdf', 4),
(51, 'Use Case Document', 'John Kittle Use Case Document.pdf', 4),
(56, 'UML Document', 'John Kittle UML Document.pdf', 4),
(57, 'Final Project Zip', 'John Kittle Final Project.zip', 4),
(58, 'DDS Document', 'John Kittle DDS Document.pdf', 4),
(59, 'SRS Document', 'John Kittle SRS Document.pdf', 4),
(60, 'Concept Note', 'Jimmy Kazembe concept note.pdf', 5);

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
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_password`, `u_type`, `u_img`, `u_stamp`) VALUES
(1, 'Kondwani Chimatiro', 'kondwanichimatiro@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 1, 'user.svg', '2021-07-05 08:38:40'),
(2, 'Susan Chinyama', 'susanchinyama@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 1, 'user.svg', '2021-07-05 08:38:35'),
(3, 'Clifford Ghambi', 'cliffordghambi@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 2, 'photo_2021-03-11_16-32-22.jpg', '2021-07-05 08:38:35'),
(4, 'Tchilli Alindiamawo', 'Tchillialindiamawo@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 2, 'photo_2021-03-18_16-01-12.jpg', '2021-07-05 08:26:11'),
(5, 'Eric Kabambe', 'erickabambe@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'photo_2021-03-18_16-01-12.jpg', '2021-07-05 08:26:11'),
(6, 'Jimmy Kazembe', 'jimmykazembe@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'photo_2021-03-18_16-01-12.jpg', '2021-07-05 08:26:11'),
(31, 'John Kittle', 'jk@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'user.svg', '2022-06-01 12:03:46'),
(33, 'rico', 'admin@admin.admin', '70352f41061eda4ff3c322094af068ba70c3b38b', 2, 'user.svg', '2022-06-01 12:30:59'),
(34, 'RR', 'rr@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'user.svg', '2022-06-06 13:14:40'),
(36, 'Chadwick Boseman', 'bd@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'user.svg', '2022-06-06 20:35:48'),
(37, 'Tough Bwana', 'zgr@gmail.com', '70352f41061eda4ff3c322094af068ba70c3b38b', 3, 'user.svg', '2022-06-06 20:35:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
