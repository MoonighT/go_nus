-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2012 at 02:26 AM
-- Server version: 5.5.21-log
-- PHP Version: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs3216`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `user` varchar(64) NOT NULL,
  `user_followed` varchar(64) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_followed`,`user`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `last_location`
--

CREATE TABLE IF NOT EXISTS `last_location` (
  `email` varchar(64) NOT NULL,
  `location_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`email`,`location_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `profile` mediumblob,
  `geometry` geometrycollection NOT NULL,
  PRIMARY KEY (`location_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `location_msg`
--

CREATE TABLE IF NOT EXISTS `location_msg` (
  `location_id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`location_id`,`email`,`timestamp`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(64) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 NOT NULL,
  `status` text CHARACTER SET utf8,
  `major` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `faculty` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `profile` mediumblob,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_msg`
--

CREATE TABLE IF NOT EXISTS `user_msg` (
  `user_from` varchar(64) NOT NULL,
  `user_to` varchar(64) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_from`,`user_to`,`timestamp`),
  KEY `user_to` (`user_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`user_followed`) REFERENCES `user` (`email`);

--
-- Constraints for table `last_location`
--
ALTER TABLE `last_location`
  ADD CONSTRAINT `last_location_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `last_location_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Constraints for table `location_msg`
--
ALTER TABLE `location_msg`
  ADD CONSTRAINT `location_msg_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `location_msg_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user` (`email`);

--
-- Constraints for table `user_msg`
--
ALTER TABLE `user_msg`
  ADD CONSTRAINT `user_msg_ibfk_1` FOREIGN KEY (`user_from`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `user_msg_ibfk_2` FOREIGN KEY (`user_to`) REFERENCES `user` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
