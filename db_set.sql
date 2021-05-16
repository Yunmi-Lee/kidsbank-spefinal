-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2017 at 02:20 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------


--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- Table structure for table `goal`
CREATE TABLE `goal` (
 `id` int(22) NOT NULL AUTO_INCREMENT,
 `user_id` int(22) NOT NULL,
 `goal_id` int(22) NOT NULL,
 `goal_name` varchar(50) NOT NULL,
 `goal_amount` int(55) NOT NULL,
 `strarting_amount` int(55) NOT NULL,
 `current_amount` int(55) NOT NULL,
 `duedate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
 `iscomplete` tinyint(1) NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



-- Table structure for table `transaction`
CREATE TABLE `trans` (
 `id` int(22) NOT NULL AUTO_INCREMENT,
 `user_id` int(22) NOT NULL,
 `goal_name` varchar(50) NOT NULL,
 `plus` tinyint(1) NULL,
 `trans_amount` int(55) NOT NULL,
 `description` varchar(255) NOT NULL,
 `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;




