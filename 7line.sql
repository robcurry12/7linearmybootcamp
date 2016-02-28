-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2016 at 12:21 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `7line`
--
CREATE DATABASE IF NOT EXISTS `7line` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `7line`;

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE IF NOT EXISTS `boards` (
  `board_id` int(11) NOT NULL AUTO_INCREMENT,
  `board_name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL,
  PRIMARY KEY (`board_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`board_id`, `board_name`, `description`, `icon`) VALUES
(1, 'General Discussion', 'Free discussion forum', 'images/icontemp.jpg'),
(2, 'New Soldiers', 'New 7 Line Soldiers can come here for any questions they might have. One of our loyal soldiers will be sure to help', 'images/icontemp.jpg'),
(3, 'Outing Travel Tips', 'Post your traveling tips here for any of our away outings', 'images/icontemp.jpg'),
(4, 'Can''t Make A Game', 'Connect with soldiers to ensure your spot goes to another solider', 'images/icontemp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` double NOT NULL AUTO_INCREMENT,
  `thread_id` double NOT NULL,
  `board_id` double NOT NULL,
  `subject` varchar(300) NOT NULL,
  `content` longtext NOT NULL,
  `user_create` varchar(30) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `thread_id`, `board_id`, `subject`, `content`, `user_create`, `date_created`) VALUES
(1, 7, 2, 'Trying out my new posting method', 'Woohoo hope this works!fhsdfsdgfsdfjsdfsdfsdcvsdbcdgfsdvfhjsgfsdyfhsdgfhsdchjsdchbsdhvsdg hvjhsdvsdghjcvsdghcsdvcghhbdhbsdhjvbsdgvfdsvbchjdshcsdcvsdbc sdcbsdvsdbsghsdncvbsdhvsdcvsghcvsbcvscbscbsvc sbc jshbcdhjsbchjsdb csdghcb sn sjbcsdhjcbhjsdbc s', 'robcurry12', '2016-02-13 10:43:03'),
(2, 7, 2, '', 'Yay! It seems one method works! Hopefully the reply method works!', 'robcurry12', '2016-02-16 23:41:38'),
(3, 7, 2, '', 'Hi Tyler!', 'robcurry12', '2016-02-17 13:27:10'),
(4, 7, 2, '', 'Hi again tyler!', 'robcurry12', '2016-02-17 13:31:07'),
(5, 7, 2, '', 'Hello Eeveryone!', 'robcurry12', '2016-02-17 13:32:32'),
(7, 7, 2, '', 'DSFDGFSDF', 'robcurry12', '2016-02-17 13:53:01'),
(8, 7, 2, '', 'fsdgshfhsdfhsdgf', 'robcurry12', '2016-02-17 13:53:19'),
(9, 7, 2, '', 'die() better do its damn job', 'robcurry12', '2016-02-17 14:03:55'),
(10, 7, 2, '', 'Jquery to the resuce!', 'robcurry12', '2016-02-17 14:05:33'),
(11, 7, 2, '', 'woOOPWOOP', 'robcurry12', '2016-02-17 14:08:57'),
(12, 7, 2, '', 'Wallabingbang', 'robcurry12', '2016-02-17 14:11:45'),
(13, 7, 2, '', 'Hopefully thisd oes it!', 'robcurry12', '2016-02-17 14:38:04'),
(14, 7, 2, '', 'Nope i dont think so', 'robcurry12', '2016-02-17 14:39:07'),
(15, 7, 2, '', 'YES!', 'robcurry12', '2016-02-17 14:39:39'),
(16, 7, 2, '', 'bLAH!', 'robcurry12', '2016-02-17 14:39:54'),
(17, 7, 2, '', 'woopiez!', 'robcurry12', '2016-02-17 14:40:53'),
(18, 7, 2, '', 'Yay!', 'robcurry12', '2016-02-17 14:41:34'),
(19, 7, 2, '', 'I did it!', 'robcurry12', '2016-02-17 20:33:11'),
(20, 7, 2, '', 'Hi', 'robcurry12', '2016-02-18 16:03:31'),
(21, 9, 2, 'Filling up the board', 'Hello', 'robcurry12', '2016-02-21 14:34:12'),
(22, 10, 2, 'I am lost and not sure where to start', 'Help me out', 'robcurry12', '2016-02-21 14:45:44'),
(23, 11, 2, 'I am lost ', 'help', 'robcurry12', '2016-02-21 15:44:04'),
(24, 12, 2, 'Meow', 'I am a cat', 'robcurry12', '2016-02-21 15:51:57'),
(25, 13, 2, 'undefined', 'I like to eat pizza! What about you?! I like goats! Baaaaahhh', 'robcurry12', '2016-02-21 17:12:46'),
(26, 14, 2, 'undefined', 'Can someone take my seat at an upcoming game?', 'robcurry12', '2016-02-22 13:03:54'),
(27, 15, 2, 'undefined', 'Big bag of potatos', 'robcurry12', '2016-02-22 13:10:25'),
(28, 16, 2, 'undefined', 'Lets Go Mets!', 'robcurry12', '2016-02-22 13:11:24'),
(29, 17, 2, 'undefined', 'Rawr', 'robcurry12', '2016-02-22 13:13:30'),
(30, 18, 2, 'Attempting to see whats wrong', 'Hi there!', 'robcurry12', '2016-02-22 13:57:17'),
(31, 19, 2, 'Now let me try it in Chrome!', 'This worked in firefox now hopefully it works in CHROME', 'robcurry12', '2016-02-22 13:57:52'),
(32, 20, 2, 'Testing how long posts will look', '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789', 'robcurry12', '2016-02-22 15:20:46'),
(33, 21, 2, 'Testing the length of the post', 'dfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjd', 'robcurry12', '2016-02-22 15:38:36'),
(34, 7, 2, '', 'Hi', 'robcurry12', '2016-02-23 14:59:02'),
(35, 7, 2, '', 'Hi again', 'robcurry12', '2016-02-23 15:01:15'),
(38, 22, 3, '', 'Posting reply!', 'robcurry12', '2016-02-23 20:28:40'),
(39, 21, 2, '', 'Hi there', 'robcurry12', '2016-02-26 17:42:16'),
(40, 21, 2, '', 'hllooo', 'robcurry12', '2016-02-26 17:47:37'),
(41, 21, 2, '', 'This is odd', 'robcurry12', '2016-02-26 17:51:00'),
(44, 21, 2, '', 'Woohwoop', 'robcurry12', '2016-02-26 18:15:22'),
(46, 21, 2, '', 'SDFDSFSD', 'robcurry12', '2016-02-26 18:20:04'),
(47, 21, 2, '', 'SDFSDF', 'robcurry12', '2016-02-26 18:20:42'),
(48, 21, 2, '', 'Ew', 'robcurry12', '2016-02-26 18:21:28'),
(49, 7, 2, '', 'dfd', 'robcurry12', '2016-02-26 18:22:24'),
(50, 7, 2, '', 'box', 'robcurry12', '2016-02-26 18:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE IF NOT EXISTS `threads` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `board_id` int(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `last_update` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `board_id`, `subject`, `user_create`, `last_update`, `date_created`) VALUES
(7, 2, 'Trying out my new posting method', 'robcurry12', '2016-02-13 10:43:03', '2016-02-13 10:43:03'),
(9, 2, 'Filling up the board', 'robcurry12', '2016-02-21 14:34:12', '2016-02-21 14:34:12'),
(10, 2, 'I am lost and not sure where to start', 'robcurry12', '2016-02-21 14:45:44', '2016-02-21 14:45:44'),
(11, 2, 'I am lost ', 'robcurry12', '2016-02-21 15:44:04', '2016-02-21 15:44:04'),
(12, 2, 'Meow', 'robcurry12', '2016-02-21 15:51:57', '2016-02-21 15:51:57'),
(13, 2, 'undefined', 'robcurry12', '2016-02-21 17:12:46', '2016-02-21 17:12:46'),
(14, 2, 'undefined', 'robcurry12', '2016-02-22 13:03:54', '2016-02-22 13:03:54'),
(15, 2, 'undefined', 'robcurry12', '2016-02-22 13:10:25', '2016-02-22 13:10:25'),
(16, 2, 'undefined', 'robcurry12', '2016-02-22 13:11:24', '2016-02-22 13:11:24'),
(17, 2, 'undefined', 'robcurry12', '2016-02-22 13:13:30', '2016-02-22 13:13:30'),
(18, 2, 'Attempting to see whats wrong', 'robcurry12', '2016-02-22 13:57:17', '2016-02-22 13:57:17'),
(19, 2, 'Now let me try it in Chrome!', 'robcurry12', '2016-02-22 13:57:52', '2016-02-22 13:57:52'),
(21, 2, 'Testing the length of the post', 'robcurry12', '2016-02-22 15:38:36', '2016-02-22 15:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_active` datetime NOT NULL,
  `loggedIn` tinyint(1) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `date_join` date NOT NULL,
  `birthday` varchar(5) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `last_active`, `loggedIn`, `image`, `date_join`, `birthday`, `gender`) VALUES
(1, 'test', 'test@test.com', 'test', '2016-01-24 18:00:30', 0, NULL, '2016-01-24', '2009-', 'male'),
(3, 'test2', 'test2@test.com', 'e10adc3949ba59abbe56', '0000-00-00 00:00:00', 0, NULL, '0000-00-00', '0000-', ''),
(4, 'test3', 'test3@test.com', 'e10adc3949ba59abbe56', '0000-00-00 00:00:00', 0, NULL, '0000-00-00', '0000-', ''),
(5, 'test4', 'test4@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:37:04', 0, NULL, '2016-01-28', '0000-', ''),
(6, 'test5', 'test5@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:38:25', 0, NULL, '2016-01-28', '0000-', ''),
(7, 'test6', 'test6@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:42:52', 1, NULL, '2016-01-28', '0000-', ''),
(8, 'test7', 'test7@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:43:25', 1, NULL, '2016-01-28', '0000-', ''),
(9, 'test8', 'test8@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:49:50', 1, NULL, '2016-01-28', '0000-', ''),
(10, 'test9', 'test9@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:51:38', 1, NULL, '2016-01-28', '0000-', ''),
(11, 'mets', 'mets@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:52:38', 1, NULL, '2016-01-28', '0000-', ''),
(12, 'nymets', 'nymets@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:54:02', 1, NULL, '2016-01-28', '0000-', ''),
(13, 'lgm', 'lgm@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:55:34', 1, NULL, '2016-01-28', '0000-', ''),
(14, 'nym', 'nym@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:56:16', 1, NULL, '2016-01-28', '0000-', ''),
(15, 'yoisback', 'yoisback@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:58:08', 1, NULL, '2016-01-28', '0000-', ''),
(16, 'captainamerica', 'nyca@mets.com', 'e10adc3949ba59abbe56e057f20f883e', '2016-01-29 15:37:39', 1, NULL, '2016-01-28', '0000-', ''),
(18, 'robcurry12', 'robcurry12@gmail.com', '0422eeda16890d9fdf17c472fc600297', '2016-02-27 19:20:49', 1, 'robcurry12.jpg', '2016-01-29', '06/19', 'male');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
