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
(40, 'Prince George`s Park Residence', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\029µ3L­ô?cïÅíñY@\0\0\0²t±©ô?H£''ÛñY@\0\0\0Üšt[¢ô?‹k|&ûñY@\0\0\0°p’æ©ô?øAc&òY@\0\0\0º/g¶«ô?ê–âòY@\0\0\0të5=(¨ô?ÚÄÉýñY@'),
(41, 'King Edward VII Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0PÂLÛ¿²ô?t&mªîñY@\0\0\0û=±N•¯ô?aP¦ÑäñY@\0\0\029µ3L­ô?cïÅíñY@\0\0\0të5=(¨ô?ÚÄÉýñY@\0\0\0º/g¶«ô?ê–âòY@'),
(42, 'Instititute of Materials Research and Engineering', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0$Ô©¢¸ô?¥ùcZ›ñY@\0\0\0^G²´ô?Ä±.n£ñY@\0\0\0ãÄW;Š³ô?”M¹ÂñY@\0\0\0‘ÑIØ·ô?¸uÊñY@'),
(43, 'Singapore Synchrotron Light Source', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0û]Øš­¼ô?¦{Ô—ñY@\0\0\0$Ô©¢¸ô?¥ùcZ›ñY@\0\0\0œÞÅûq»ô?Ø»?Þ«ñY@'),
(44, 'NUS Business School', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0`:­Û ¶ô?W%‘}ñY@\0\0\04ö%¶ô?ÖÈ®´ŒñY@\0\0\0|îû¯³ô?ÄC?ñY@\0\0\0tì ×±ô?QN´«ñY@\0\0\0(í\r¾°ô?á_™ñY@\0\0\0©‡ht±ô?î v¦ñY@'),
(45, 'Hon Sui Sen Memorial Library', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0tì ×±ô?QN´«ñY@\0\0\0Ý\na5–°ô?ËhäóŠñY@\0\0\0zÄè¹…®ô?[z4Õ“ñY@\0\0\0(í\r¾°ô?á_™ñY@'),
(46, 'Mochtar Riady Building', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0Ý\na5–°ô?ËhäóŠñY@\0\0\0à‚lY¾®ô?(Òýœ‚ñY@\0\0\0`ÊÀ­ô?Î‰=´ñY@\0\0\0zÄè¹…®ô?[z4Õ“ñY@'),
(47, 'ICube', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\03ˆìø¯ô?„/¡ñY@\0\0\0@¦µil¯ô?ì¿ÎM›ñY@\0\0\08±Ñƒ¬ô?ü¨†ýžñY@\0\0\0‡ùòì£ô?Šø¬ñY@\0\0\0ì ×1®ô?ÉÉÄ­ñY@'),
(48, 'Kent Ridge Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0`ÊÀ­ô?Î‰=´ñY@\0\0\0¹-@Ûªô?»,D‡ñY@\0\0\0FÓÙÉà¨ô?^èI™ñY@\0\0\0æZ´\0m«ô?t''ØñY@'),
(49, 'Sheares Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0æZ´\0m«ô?t''ØñY@\0\0\0FÓÙÉà¨ô?^èI™ñY@\0\0\0žŽ’W§ô?‹8d«ñY@\0\0\0Æ4Ó½Nªô?ÉÉÄ­ñY@'),
(50, 'School of Computing Com1', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0â‘xyºô?¼çÀr„ñY@\0\0\0Zbe4ò¹ô?*:’ËñY@\0\0\0=ñœ- ´ô?¶ö>U…ñY@\0\0\0Ý\na5–°ô?ËhäóŠñY@\0\0\0tì ×±ô?QN´«ñY@\0\0\0|îû¯³ô?ÄC?ñY@\0\0\04ö%¶ô?ÖÈ®´ŒñY@\0\0\0`:­Û ¶ô?W%‘}ñY@'),
(51, 'AS6', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0È\n~b¼ô?Ð¶šuñY@\0\0\0g{ô†»ô?”…¯¯uñY@\0\0\0¿b\r¹ô?œQ}ñY@\0\0\0â‘xyºô?¼çÀr„ñY@\0\0\0±Š72¼ô? B\\9{ñY@'),
(52, 'Eusoff Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0ù×òÊõ¶ô?4¡IbIñY@\0\0\0*˜Ùç±ô?µ¿³=ñY@\0\0\0b.©Ú®ô?''ÙêrJñY@\0\0\0î<0€°ô?PU¡XñY@'),
(53, 'Temasek Hall', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0î<0€°ô?PU¡XñY@\0\0\0b.©Ú®ô?''ÙêrJñY@\0\0\0|€îË™­ô?<FzQñY@\0\0\0|€îË™­ô?„‚R´rñY@\0\0\0üáç¿¯ô?0XrñY@'),
(54, 'Kent Ridge Guild House', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0û“øÜ	¶ô?ÔòWyñY@\0\0\0åÅo²ô?ÂP‡nñY@\0\0\0øÅ¥*m±ô?Ýê9é}ñY@\0\0\0CŒ×¼ª³ô?íŸ§ƒñY@'),
(55, 'Shaw Foundation Alumni House', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0CŒ×¼ª³ô?íŸ§ƒñY@\0\0\0øÅ¥*m±ô?Ýê9é}ñY@\0\0\0Á=~¯ô?íŸ§ƒñY@\0\0\0Œ„¶œK±ô?û Ë‚‰ñY@'),
(56, 'Faculty of Art and Social Sciences', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0&ßlscºô?|¸ä¸SñY@\0\0\0¿œ3¢´ô?—uXñY@\0\0\0åÅo²ô?ÂP‡nñY@\0\0\0û“øÜ	¶ô?ÔòWyñY@\0\0\0g{ô†»ô?”…¯¯uñY@'),
(57, 'Block ADM', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0jN^d¾ô?•¸ŽqñY@\0\0\0»ì×î¼ô?|&ûçiñY@\0\0\0g{ô†»ô?”…¯¯uñY@\0\0\0È\n~b¼ô?Ð¶šuñY@'),
(58, 'Central Library', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0ØœƒgÂô?¨©ek}ñY@\0\0\0jN^d¾ô?•¸ŽqñY@\0\0\0±Š72¼ô? B\\9{ñY@\0\0\0¿Òùð,Áô?BÍ*ŠñY@'),
(59, 'Chinese Library', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0B?S¯[Äô?¿ÑŽ~ñY@\0\0\0ØœƒgÂô?¨©ek}ñY@\0\0\0üûŒÂô?Ï ¡‚ñY@\0\0\0=`2åÃô?ÔC4ºƒñY@');

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
('121', '121', '121', 'female', '121', NULL, NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\0ÛÉ;âë¦ô?#š¾\ròY@', '2012-09-23 00:00:00'),
('22', '11', '212', 'female', NULL, NULL, NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\07vä£ ³ô?²o¥\ròY@', '2012-09-23 00:00:00'),
('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'male', NULL, NULL, NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\0ù¿~ãÆ¨ô?^\n´àêñY@', '2012-09-23 08:29:55'),
('elleryjiao@gmail.com', 'Apple', '5011e35943a47afdf6c4b2ae2c354865', 'male', 'changed', 'CS', 'SOC', 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\0›M‘Q¨ô?ŠÆ&çñY@', '2012-09-23 07:59:10'),
('newuser@gmail.com', 'newuser', '098f6bcd4621d373cade4e832627b4f6', 'male', 'ahha', 'test', NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '', '2012-09-23 08:12:25'),
('test2email', 'test2name', '098f6bcd4621d373cade4e832627b4f6', 'male', NULL, NULL, NULL, 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '', '0000-00-00 00:00:00'),
('testadss', 'jjp', 'a3dcb4d229de6fde0db5686dee47145d', 'male', 'sdasd', 'ad', 'asd', 'http://ec2-122-248-209-136.ap-southeast-1.compute.amazonaws.com/application/views/images/profile/male.jpg', '\0\0\0\0\0\0\0\0\0\0\0\0\0ð?\0\0\0\0\0\0\0@', '0000-00-00 00:00:00'),
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
