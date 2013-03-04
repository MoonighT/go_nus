-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2012 at 04:29 PM
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

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`user`, `user_followed`, `timestamp`) VALUES
('elleryjiao@gmail.com', 'admin', '2012-09-22 15:51:17'),
('test2email', 'elleryjiao@gmail.com', '2012-09-22 07:45:24'),
('admin', 'test2email', '2012-09-22 07:45:24'),
('elleryjiao@gmail.com', 'test2email', '2012-09-22 07:45:13');

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
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `profile` mediumblob,
  `geometry` geometrycollection NOT NULL,
  PRIMARY KEY (`location_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `name`, `description`, `profile`, `geometry`) VALUES
(40, 'Prince George`s Park Residence', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\029�3L��?c����Y@\0\0\0��t���?H�''��Y@\0\0\0�ܚt[��?�k|&��Y@\0\0\0�p�揩�?�Ac&�Y@\0\0\0�/g���?���Y@\0\0\0t�5=(��?������Y@'),
(41, 'King Edward VII Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0P�Lۿ��?t&m���Y@\0\0\0�=�N���?aP����Y@\0\0\029�3L��?c����Y@\0\0\0t�5=(��?������Y@\0\0\0�/g���?���Y@'),
(42, 'Instititute of Materials Research and Engineering', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0$�����?��cZ��Y@\0\0\0^G����?ı.n��Y@\0\0\0��W;���?�M���Y@\0\0\0��Iط�?�u��Y@'),
(43, 'Singapore Synchrotron Light Source', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0�]ؚ���?�{�ԗ�Y@\0\0\0$�����?��cZ��Y@\0\0\0����q��?ػ?ޫ�Y@'),
(44, 'NUS Business School', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0`:�۠��?W%�}��Y@\0\0\04�%��?�Ȯ���Y@\0\0\0|�����?�C?��Y@\0\0\0t�ױ�?QN����Y@\0\0\0�(�\r���?�_���Y@\0\0\0��ht��?�� v��Y@'),
(45, 'Hon Sui Sen Memorial Library', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0t�ױ�?QN����Y@\0\0\0�\na5���?�h���Y@\0\0\0z�蹅��?[z4Փ�Y@\0\0\0�(�\r���?�_���Y@'),
(46, 'Mochtar Riady Building', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0�\na5���?�h���Y@\0\0\0��lY���?(�����Y@\0\0\0`����?Ή=���Y@\0\0\0z�蹅��?[z4Փ�Y@'),
(47, 'ICube', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\03�����?��/��Y@\0\0\0@��il��?��M��Y@\0\0\08�у��?������Y@\0\0\0�����?����Y@\0\0\0��1��?��ĭ�Y@'),
(48, 'Kent Ridge Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0`����?Ή=���Y@\0\0\0�-@۪�?�,D��Y@\0\0\0F�����?^��I��Y@\0\0\0�Z�\0m��?t''���Y@'),
(49, 'Sheares Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0�Z�\0m��?t''���Y@\0\0\0F�����?^��I��Y@\0\0\0���W��?�8�d��Y@\0\0\0�4ӽN��?��ĭ�Y@'),
(50, 'School of Computing Com1', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0�xy��?���r��Y@\0\0\0Zbe4��?*:���Y@\0\0\0=�- ��?��>U��Y@\0\0\0�\na5���?�h���Y@\0\0\0t�ױ�?QN����Y@\0\0\0|�����?�C?��Y@\0\0\04�%��?�Ȯ���Y@\0\0\0`:�۠��?W%�}��Y@'),
(51, 'AS6', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0�\n~b��?ж�u�Y@\0\0\0g{��?����u�Y@\0\0\0�b\r��?�Q}�Y@\0\0\0�xy��?���r��Y@\0\0\0��72���? B\\9{�Y@'),
(52, 'Eusoff Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0�������?4�IbI�Y@\0\0\0*�����?����=�Y@\0\0\0b.�ڮ�?''��rJ�Y@\0\0\0�<0���?PU��X�Y@'),
(53, 'Temasek Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0�<0���?PU��X�Y@\0\0\0b.�ڮ�?''��rJ�Y@\0\0\0|��˙��?<FzQ�Y@\0\0\0|��˙��?��R�r�Y@\0\0\0�����?�0Xr�Y@'),
(54, 'Kent Ridge Guild House', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0����	��?��Wy�Y@\0\0\0��o��?�P�n�Y@\0\0\0�ť*m��?��9�}�Y@\0\0\0C�׼���?ퟧ��Y@'),
(55, 'Shaw Foundation Alumni House', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0C�׼���?ퟧ��Y@\0\0\0�ť*m��?��9�}�Y@\0\0\0�=~��?ퟧ��Y@\0\0\0����K��?� ˂��Y@'),
(56, 'Faculty of Art and Social Sciences', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0&�lsc��?|��S�Y@\0\0\0��3���?�uX�Y@\0\0\0��o��?�P�n�Y@\0\0\0����	��?��Wy�Y@\0\0\0g{��?����u�Y@'),
(57, 'Block ADM', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0jN^d��?���q�Y@\0\0\0��ם��?|&��i�Y@\0\0\0g{��?����u�Y@\0\0\0�\n~b��?ж�u�Y@'),
(58, 'Central Library', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0؜�g��?��ek}�Y@\0\0\0jN^d��?���q�Y@\0\0\0��72���? B\\9{�Y@\0\0\0����,��?B͐*��Y@'),
(59, 'Chinese Library', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0B?S�[��?�ю~�Y@\0\0\0؜�g��?��ek}�Y@\0\0\0�����?Ϡ���Y@\0\0\0=`2���?�C4���Y@');

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

--
-- Dumping data for table `location_msg`
--

INSERT INTO `location_msg` (`location_id`, `email`, `content`, `timestamp`) VALUES
(41, 'admin', 'test content', '2012-09-21 18:01:42'),
(41, 'elleryjiao@gmail.com', 'test content', '2012-09-21 18:02:34'),
(41, 'elleryjiao@gmail.com', 'test content', '2012-09-21 18:02:56'),
(41, 'elleryjiao@gmail.com', 'test content', '2012-09-21 18:03:29'),
(42, 'test2email', 'adasd', '2012-09-21 17:53:55'),
(43, 'test2email', 'hahah', '2012-09-21 10:24:20'),
(43, 'testadss', 'test', '2012-09-21 10:36:23'),
(44, 'admin', 'uuuuu', '2012-09-21 17:57:02'),
(44, 'elleryjiao@gmail.com', 'test content', '2012-09-21 17:43:29');

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
  `profile` varchar(256) DEFAULT 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg',
  `last_location` geometry NOT NULL,
  `last_location_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`email`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `password`, `gender`, `status`, `major`, `faculty`, `profile`, `last_location`, `last_location_timestamp`) VALUES
('121', '121', '121', 'female', '121', NULL, NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\0��;���?#��\r�Y@', '2012-09-23 00:00:00'),
('22', '11', '212', 'female', NULL, NULL, NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\07v� ��?��o�\r�Y@', '2012-09-23 00:00:00'),
('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'male', NULL, NULL, NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\0��~�ƨ�?^\n����Y@', '2012-09-23 08:29:55'),
('elleryjiao@gmail.com', 'Apple', '5011e35943a47afdf6c4b2ae2c354865', 'male', 'changed', 'CS', 'SOC', 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\0�M��Q��?��&��Y@', '2012-09-23 07:59:10'),
('newuser@gmail.com', 'newuser', '098f6bcd4621d373cade4e832627b4f6', 'male', 'ahha', 'test', NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '', '2012-09-23 08:12:25'),
('test2email', 'test2name', '098f6bcd4621d373cade4e832627b4f6', 'male', NULL, NULL, NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '', '0000-00-00 00:00:00'),
('testadss', 'jjp', 'a3dcb4d229de6fde0db5686dee47145d', 'male', 'sdasd', 'ad', 'asd', 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\0\0\0\0\0\0\0�?\0\0\0\0\0\0\0@', '0000-00-00 00:00:00'),
('testemail@gmail.com', 'testuser', 'ec02c59dee6faaca3189bace969c22d3', 'male', 'asdasd', 'cs', 'soc', 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '', '0000-00-00 00:00:00');

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
-- Dumping data for table `user_msg`
--

INSERT INTO `user_msg` (`user_from`, `user_to`, `content`, `timestamp`) VALUES
('admin', 'elleryjiao@gmail.com', 'adsasd', '2012-09-20 22:05:36'),
('elleryjiao@gmail.com', 'admin', '', '2012-09-20 21:35:53'),
('elleryjiao@gmail.com', 'admin', 'wtf', '2012-09-23 05:21:39'),
('elleryjiao@gmail.com', 'testemail@gmail.com', 'haha', '2012-09-20 23:35:28'),
('test2email', 'testadss', 'asda', '2012-09-20 22:08:22'),
('testadss', 'testadss', 'test', '2012-09-20 21:35:29'),
('testadss', 'testemail@gmail.com', 'asdasd', '2012-09-20 21:35:39');

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
