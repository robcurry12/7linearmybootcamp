-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2016 at 04:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `7line`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(20) NOT NULL,
  `became_admin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `became_admin`) VALUES
('DarrenMeenan', '2016-04-27 13:27:23'),
('robcurry12', '2016-04-21 14:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `board_id` int(11) NOT NULL,
  `board_name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`board_id`, `board_name`, `description`, `icon`) VALUES
(1, 'General Discussion', 'Free discussion forum', 'images/icontemp.jpg'),
(2, 'New Soldiers', 'New 7 Line Soldiers can come here for any questions they might have. One of our loyal soldiers will be sure to help', 'images/icontemp.jpg'),
(3, 'Outing Travel Tips', 'Post your traveling tips here for any of our away outings', 'images/icontemp.jpg'),
(4, 'Can\'t Make A Game', 'Connect with soldiers to ensure your spot goes to another solider', 'images/icontemp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `post_id` double NOT NULL,
  `user` varchar(50) NOT NULL,
  `post_user` varchar(40) NOT NULL,
  `time_liked` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`post_id`, `user`, `post_user`, `time_liked`) VALUES
(1, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:22'),
(2, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:21'),
(3, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:18'),
(4, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:17'),
(5, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:15'),
(7, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:13'),
(8, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:11'),
(9, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:08'),
(10, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:30'),
(11, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:32'),
(12, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:33'),
(13, 'DarrenMeenan', 'robcurry12', '2016-04-13 01:38:35'),
(30, 'DarrenMeenan', 'robcurry12', '2016-04-21 19:40:38'),
(33, 'alexbraunx3', 'robcurry12', '2016-04-21 20:20:57'),
(33, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:40:46'),
(39, 'alexbraunx3', 'robcurry12', '2016-04-21 20:20:59'),
(39, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:40:44'),
(40, 'alexbraunx3', 'robcurry12', '2016-04-21 20:21:01'),
(40, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:40:48'),
(41, 'alexbraunx3', 'robcurry12', '2016-04-21 20:21:03'),
(41, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:40:53'),
(44, 'alexbraunx3', 'robcurry12', '2016-04-21 20:21:04'),
(44, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:40:50'),
(46, 'alexbraunx3', 'robcurry12', '2016-04-21 20:21:06'),
(46, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:40:55'),
(47, 'alexbraunx3', 'robcurry12', '2016-04-21 20:21:08'),
(47, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:40:57'),
(48, 'alexbraunx3', 'robcurry12', '2016-04-21 20:21:32'),
(48, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:40:58'),
(51, 'alexbraunx3', 'robcurry12', '2016-04-21 20:21:29'),
(51, 'DarrenMeenan', 'robcurry12', '2016-04-14 19:41:00'),
(61, 'alexbraunx3', 'robcurry12', '2016-04-21 19:57:09'),
(61, 'chrislinguini56', 'robcurry12', '2016-04-07 19:46:41'),
(69, 'darrenmeenan', 'robcurry12', '2016-04-04 19:38:14'),
(69, 'robcurry12', 'robcurry12', '2016-04-27 02:50:06'),
(71, 'chrislinguini56', 'robcurry12', '2016-04-12 18:09:41'),
(71, 'DarrenMeenan', 'robcurry12', '2016-04-21 20:33:23'),
(72, 'chrislinguini56', 'chrislinguini56', '2016-03-17 17:58:55'),
(72, 'darrenmeenan', 'chrislinguini56', '2016-04-04 15:55:21'),
(72, 'robcurry12', 'chrislinguini56', '2016-03-17 17:59:25'),
(73, 'alexbraunx3', 'chrislinguini56', '2016-04-21 19:57:05'),
(73, 'chrislinguini56', 'chrislinguini56', '2016-04-07 19:46:44'),
(73, 'robcurry12', 'chrislinguini56', '2016-03-17 19:55:11'),
(74, 'chrislinguini56', 'alexbraunx3', '2016-03-17 17:58:57'),
(74, 'darrenmeenan', 'alexbraunx3', '2016-04-04 15:55:20'),
(74, 'robcurry12', 'alexbraunx3', '2016-03-17 17:59:28'),
(75, 'chrislinguini56', 'joeyg_hd', '2016-04-11 18:48:20'),
(75, 'darrenmeenan', 'joeyg_hd', '2016-04-04 15:55:18'),
(75, 'robcurry12', 'joeyg_hd', '2016-03-17 17:59:30'),
(76, 'chrislinguini56', 'robcurry12', '2016-03-17 17:59:01'),
(76, 'DarrenMeenan', 'robcurry12', '2016-04-21 20:33:28'),
(76, 'robcurry12', 'robcurry12', '2016-03-17 17:59:31'),
(77, 'chrislinguini56', 'robcurry12', '2016-04-12 18:09:47'),
(77, 'DarrenMeenan', 'robcurry12', '2016-04-13 16:16:17'),
(77, 'robcurry12', 'robcurry12', '2016-03-17 17:59:33'),
(79, 'chrislinguini56', 'robcurry12', '2016-04-12 19:40:20'),
(79, 'darrenmeenan', 'robcurry12', '2016-04-04 15:13:16'),
(80, 'DarrenMeenan', 'robcurry12', '2016-04-21 19:42:02'),
(80, 'robcurry12', 'robcurry12', '2016-03-28 18:02:45'),
(81, 'DarrenMeenan', 'robcurry12', '2016-04-13 16:29:05'),
(81, 'robcurry12', 'robcurry12', '2016-03-28 18:02:38'),
(86, 'chrislinguini56', 'darrenmeenan', '2016-04-12 18:09:50'),
(86, 'DarrenMeenan', 'darrenmeenan', '2016-04-21 20:33:26'),
(87, 'darrenmeenan', 'darrenmeenan', '2016-04-04 19:38:16'),
(87, 'robcurry12', 'darrenmeenan', '2016-04-27 02:50:01'),
(90, 'DarrenMeenan', 'darrenmeenan', '2016-04-21 19:42:05'),
(93, 'robcurry12', 'darrenmeenan', '2016-04-27 02:50:08'),
(94, 'DarrenMeenan', 'DarrenMeenan', '2016-04-13 18:15:01'),
(95, 'DarrenMeenan', 'DarrenMeenan', '2016-04-21 19:42:09'),
(98, 'DarrenMeenan', 'DarrenMeenan', '2016-04-21 19:42:15'),
(99, 'DarrenMeenan', 'DarrenMeenan', '2016-04-13 19:12:50'),
(103, 'alexbraunx3', 'DarrenMeenan', '2016-04-21 20:21:28'),
(104, 'alexbraunx3', 'DarrenMeenan', '2016-04-21 20:21:25'),
(105, 'alexbraunx3', 'DarrenMeenan', '2016-04-21 20:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `locked`
--

CREATE TABLE `locked` (
  `board_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `date_locked` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locked`
--

INSERT INTO `locked` (`board_id`, `thread_id`, `date_locked`) VALUES
(7, 7, '2016-05-09 13:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `outings`
--

CREATE TABLE `outings` (
  `outing_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `opponent` varchar(20) NOT NULL,
  `promotions` varchar(300) NOT NULL,
  `outcome` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outings`
--

INSERT INTO `outings` (`outing_id`, `name`, `location`, `opponent`, `promotions`, `outcome`, `date`) VALUES
(1, 'Opening Day 2016', 'Citi Field, NY', 'Phillies', 'PREGAME BRUNCH TAILGATE PARTY WITH PIG GUY NYC  - Mets giveaway: 2016 Magnetic Schedule', '', '2016-04-08 13:10:00'),
(2, 'Monday Night Madness', 'Citi Field, NY', 'Reds', '', '', '2016-04-25 19:10:00'),
(5, 'San Diego Invasion', 'Petco Park, CA', 'Padres', '', '', '2016-05-07 20:40:00'),
(6, 'Battle for the NL East', 'Citi Field, NY', 'Nationals', '', '', '2016-05-17 19:10:00'),
(9, '1986 Reunion Ceremony', 'Citi Field, NY', 'Dodgers', '1986 Mets World Series Champions Pre-Game Ceremony', '', '2016-05-28 19:15:00'),
(10, 'Milwaukee Invasion', 'Miller Park, WI', 'Brewers', '', '', '2016-06-11 16:10:00'),
(11, 'Saturday Night Concert Series', 'Citi Field, NY', 'Braves', 'Postgame Andy Grammer Concert', '', '2016-06-18 20:16:00'),
(12, 'World Series Rematch', 'Citi Field, NY', 'Royals', '', '', '2016-06-22 19:10:00'),
(13, 'Sunday Funday', 'Citi Field, NY', 'Nationals', 'Asdrubal Cabrera Wristbands', '', '2016-07-10 13:10:00'),
(14, 'Hall of Fame Weekend', 'Cooperstown, NY', '', 'Hall of Fame Induction Ceremony and overnight camping at Ommegang Brewery', '', '2016-07-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `poll_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `question` varchar(80) NOT NULL,
  `option1` varchar(100) NOT NULL,
  `option2` varchar(100) NOT NULL,
  `option3` varchar(100) NOT NULL,
  `option4` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `thread_id`, `user`, `question`, `option1`, `option2`, `option3`, `option4`, `date_created`) VALUES
(5, 38, 'robcurry12', 'Did I finally get polling fixed?', 'Yes', 'No', 'Give up!', '', '2016-03-17 13:20:14'),
(6, 39, 'robcurry12', 'Is Tyler hot?', 'Yes', 'Of course', '', '', '2016-03-18 05:14:00'),
(8, 41, 'robcurry12', 'Who is the best Mets starters?', 'Matt Harvey', 'Noah Syndergaard', 'Jacob DeGrom', 'Steven Matz', '2016-03-21 19:34:30'),
(9, 42, 'robcurry12', 'What shirt do I wear tomorrow', 'Mets', 'None', '', '', '2016-03-22 13:26:25'),
(11, 47, 'darrenmeenan', 'What player should a new t-shirt be around', 'Matt Harvey', 'Noah Syndergaard', 'Michael Conforto', 'Yoenis Cespedes', '2016-03-31 15:40:09'),
(12, 48, 'darrenmeenan', 'In case if someone cannot make a game, should the price of the tickets being so', 'Yes', 'No', '', '', '2016-03-31 15:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` double NOT NULL,
  `thread_id` double NOT NULL,
  `board_id` double NOT NULL,
  `subject` varchar(300) NOT NULL,
  `content` longtext NOT NULL,
  `user_create` varchar(30) NOT NULL,
  `date_created` datetime NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `thread_id`, `board_id`, `subject`, `content`, `user_create`, `date_created`, `type`) VALUES
(1, 7, 2, 'Trying out my new posting method', 'Woohoo hope this works!fhsdfsdgfsdfjsdfsdfsdcvsdbcdgfsdvfhjsgfsdyfhsdgfhsdchjsdchbsdhvsdg hvjhsdvsdghjcvsdghcsdvcghhbdhbsdhjvbsdgvfdsvbchjdshcsdcvsdbc sdcbsdvsdbsghsdncvbsdhvsdcvsghcvsbcvscbscbsvc sbc jshbcdhjsbchjsdb csdghcb sn sjbcsdhjcbhjsdbc s', 'robcurry12', '2016-02-13 10:43:03', ''),
(2, 7, 2, '', 'Yay! It seems one method works! Hopefully the reply method works!', 'robcurry12', '2016-02-16 23:41:38', ''),
(3, 7, 2, '', 'Hi Tyler!', 'robcurry12', '2016-02-17 13:27:10', ''),
(4, 7, 2, '', 'Hi again tyler!', 'robcurry12', '2016-02-17 13:31:07', ''),
(5, 7, 2, '', 'Hello Eeveryone!', 'robcurry12', '2016-02-17 13:32:32', ''),
(7, 7, 2, '', 'DSFDGFSDF', 'robcurry12', '2016-02-17 13:53:01', ''),
(8, 7, 2, '', 'fsdgshfhsdfhsdgf', 'robcurry12', '2016-02-17 13:53:19', ''),
(9, 7, 2, '', 'die() better do its damn job', 'robcurry12', '2016-02-17 14:03:55', ''),
(10, 7, 2, '', 'Jquery to the resuce!', 'robcurry12', '2016-02-17 14:05:33', ''),
(11, 7, 2, '', 'woOOPWOOP', 'robcurry12', '2016-02-17 14:08:57', ''),
(12, 7, 2, '', 'Wallabingbang', 'robcurry12', '2016-02-17 14:11:45', ''),
(13, 7, 2, '', 'Hopefully thisd oes it!', 'robcurry12', '2016-02-17 14:38:04', ''),
(14, 7, 2, '', 'Nope i dont think so', 'robcurry12', '2016-02-17 14:39:07', ''),
(15, 7, 2, '', 'YES!', 'robcurry12', '2016-02-17 14:39:39', ''),
(16, 7, 2, '', 'bLAH!', 'robcurry12', '2016-02-17 14:39:54', ''),
(17, 7, 2, '', 'woopiez!', 'robcurry12', '2016-02-17 14:40:53', ''),
(18, 7, 2, '', 'Yay!', 'robcurry12', '2016-02-17 14:41:34', ''),
(19, 7, 2, '', 'I did it!', 'robcurry12', '2016-02-17 20:33:11', ''),
(20, 7, 2, '', 'Hi', 'robcurry12', '2016-02-18 16:03:31', ''),
(21, 9, 1, 'Filling up the board', 'Hello', 'robcurry12', '2016-02-21 14:34:12', ''),
(22, 10, 2, 'I am lost and not sure where to start', 'Help me out', 'robcurry12', '2016-02-21 14:45:44', ''),
(30, 18, 2, 'Attempting to see whats wrong', 'Hi there!', 'robcurry12', '2016-02-22 13:57:17', ''),
(31, 19, 1, 'Now let me try it in Chrome!', 'This worked in firefox now hopefully it works in CHROME', 'robcurry12', '2016-02-22 13:57:52', ''),
(32, 20, 2, 'Testing how long posts will look', '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789', 'robcurry12', '2016-02-22 15:20:46', ''),
(33, 21, 2, 'Testing the length of the post', 'dfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjd', 'robcurry12', '2016-02-22 15:38:36', ''),
(34, 7, 2, '', 'Hi', 'robcurry12', '2016-02-23 14:59:02', ''),
(35, 7, 2, '', 'Hi again', 'robcurry12', '2016-02-23 15:01:15', ''),
(39, 21, 2, '', 'Hi there', 'robcurry12', '2016-02-26 17:42:16', ''),
(40, 21, 2, '', 'hllooo', 'robcurry12', '2016-02-26 17:47:37', ''),
(41, 21, 2, '', 'This is odd', 'robcurry12', '2016-02-26 17:51:00', ''),
(44, 21, 2, '', 'Woohwoop', 'robcurry12', '2016-02-26 18:15:22', ''),
(46, 21, 2, '', 'SDFDSFSD', 'robcurry12', '2016-02-26 18:20:04', ''),
(47, 21, 2, '', 'SDFSDF', 'robcurry12', '2016-02-26 18:20:42', ''),
(48, 21, 2, '', 'Ew', 'robcurry12', '2016-02-26 18:21:28', ''),
(49, 7, 2, '', 'dfd', 'robcurry12', '2016-02-26 18:22:24', ''),
(50, 7, 2, '', 'box', 'robcurry12', '2016-02-26 18:24:12', ''),
(51, 21, 2, '', '123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890123467890', 'robcurry12', '2016-03-03 13:32:41', ''),
(52, 22, 3, 'Outing Travel Tips Post #1', 'Hi all!', 'robcurry12', '2016-03-08 15:23:22', ''),
(53, 23, 2, 'Mow Mow', 'Mow Mow', 'robcurry12', '2016-03-09 10:29:48', ''),
(54, 24, 1, 'Meow', 'Meoooowww', 'robcurry12', '2016-03-09 10:38:04', ''),
(56, 26, 1, 'La Leche', 'The Milk', 'robcurry12', '2016-03-09 10:43:42', ''),
(58, 28, 4, 'Tickets up fpr grabs?', 'Idk about this', 'robcurry12', '2016-03-09 11:22:49', ''),
(59, 29, 1, 'Mike Trout', 'Mike Trout should be a met', 'robcurry12', '2016-03-09 11:56:32', ''),
(60, 30, 4, 'Missing hash tags ugh', 'Cant believe i missed hashtags', 'robcurry12', '2016-03-09 12:04:38', ''),
(61, 31, 1, 'Does Bryce Harper suck', 'YES HE DOES!', 'robcurry12', '2016-03-09 12:06:57', ''),
(62, 32, 3, 'Lets Go Mets', 'Beat the Yankees today', 'robcurry12', '2016-03-09 12:31:02', ''),
(65, 35, 4, 'Missed Game', 'Can I gET A REFUND!', 'robcurry12', '2016-03-09 12:50:28', ''),
(68, 38, 3, 'Bro', 'Broo', 'robcurry12', '2016-03-09 13:02:55', 'poll'),
(69, 39, 3, 'Answer the question ladies', 'Do it', 'robcurry12', '2016-03-09 13:28:08', 'poll'),
(71, 41, 2, '4 Aces', 'Who would you want', 'robcurry12', '2016-03-09 22:33:29', 'poll'),
(72, 41, 2, '', 'Madison Bumgarner!', 'chrislinguini56', '2016-03-10 13:47:28', ''),
(73, 31, 1, '', 'HUNTER PENCE RULES!', 'chrislinguini56', '2016-03-10 13:56:48', ''),
(74, 41, 2, '', 'DeGrom! I really like his hair', 'alexbraunx3', '2016-03-10 15:20:26', ''),
(75, 41, 2, '', 'You gotta rep LI bro! #LetsGoMatz', 'joeyg_hd', '2016-03-10 15:50:57', ''),
(76, 41, 2, '', 'Wow its a 4 way tie!', 'robcurry12', '2016-03-14 15:07:59', ''),
(77, 41, 2, '', 'Here we go!', 'robcurry12', '2016-03-14 15:09:54', ''),
(78, 19, 1, '', 'Yes it worked!', 'robcurry12', '2016-03-15 18:32:09', ''),
(79, 42, 2, 'Attire for tomorrow', 'What should I wear?', 'robcurry12', '2016-03-28 13:13:11', 'poll'),
(80, 43, 2, 'New Recruit Thread', 'Welcome everyone! Here is where you can introduce yourself to The 7 Line Army and meet other 7 Line Soldiers.', 'robcurry12', '2016-03-28 13:14:08', ''),
(82, 45, 1, 'Fresh Fitted Friday', 'Which hat should I put up for sale', 'darrenmeenan', '2016-03-31 15:16:26', 'poll'),
(84, 47, 1, 'T-Shirt Idea', 'Which player should the next tshirt be made about?', 'darrenmeenan', '2016-03-31 15:40:09', 'poll'),
(85, 48, 4, 'Testing out length of poll question', 'Woohoo', 'darrenmeenan', '2016-03-31 15:55:08', 'poll'),
(86, 41, 2, '', 'Its not a 4 way tie anymore!', 'darrenmeenan', '2016-04-04 11:55:06', ''),
(87, 39, 3, '', 'I am trying to post reply', 'darrenmeenan', '2016-04-04 12:10:34', ''),
(88, 48, 4, '', 'Post reply', 'darrenmeenan', '2016-04-04 12:56:03', ''),
(89, 48, 4, '', 'Now why wasnt that wprking befor', 'darrenmeenan', '2016-04-04 12:56:12', ''),
(90, 43, 2, '', 'Welcome to The 7 Line Army forum!', 'darrenmeenan', '2016-04-04 12:56:55', ''),
(91, 48, 4, '', 'Lets try again', 'darrenmeenan', '2016-04-04 15:21:42', ''),
(92, 48, 4, '', 'Wow that was an easy fix!', 'darrenmeenan', '2016-04-04 15:21:52', ''),
(93, 39, 3, '', 'Not this again', 'darrenmeenan', '2016-04-04 15:38:36', ''),
(94, 43, 2, '', 'Please introduce yourself here!', 'DarrenMeenan', '2016-04-13 14:14:35', ''),
(95, 43, 2, '', 'Woohoo', 'DarrenMeenan', '2016-04-13 14:19:30', ''),
(96, 43, 2, '', 'Man I post alot here', 'DarrenMeenan', '2016-04-13 15:04:07', ''),
(97, 43, 2, '', 'Sorry about taht', 'DarrenMeenan', '2016-04-13 15:07:12', ''),
(98, 43, 2, '', 'That', 'DarrenMeenan', '2016-04-13 15:10:21', ''),
(99, 7, 2, '', 'Woohoo', 'DarrenMeenan', '2016-04-13 15:12:22', ''),
(100, 7, 2, '', 'Did it work', 'DarrenMeenan', '2016-04-13 15:12:55', ''),
(101, 7, 2, '', 'Yay!', 'DarrenMeenan', '2016-04-13 15:15:55', ''),
(102, 7, 2, '', 'Uh-oh paging is broken', 'DarrenMeenan', '2016-04-13 15:17:49', ''),
(103, 21, 2, '', 'I am here to add some paging to this board', 'DarrenMeenan', '2016-04-14 15:41:07', ''),
(104, 21, 2, '', 'My name is Darren and I approve this message', 'DarrenMeenan', '2016-04-14 15:41:20', ''),
(105, 21, 2, '', 'I like big butts and I cannot lie', 'DarrenMeenan', '2016-04-14 15:41:29', ''),
(106, 21, 2, '', 'YOU OTHER BROTHERS CANT DENY', 'DarrenMeenan', '2016-04-14 15:42:25', '');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `reported_by` varchar(25) NOT NULL,
  `reported_user` varchar(25) NOT NULL,
  `reported_content` varchar(9000) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `date_reported` datetime NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`reported_by`, `reported_user`, `reported_content`, `thread_id`, `post_id`, `date_reported`, `reason`) VALUES
('alexbraunx3', 'DarrenMeenan', 'I like big butts and I cannot lie', 0, 105, '2016-04-21 16:22:55', 'Inappropriate'),
('alexbraunx3', 'robcurry12', 'dfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjddfgsagfsdfhjd', 21, 33, '2016-04-14 16:10:34', 'Spam'),
('alexbraunx3', 'darrenmeenan', 'Its not a 4 way tie anymore!', 41, 86, '2016-04-14 16:18:10', 'Abusive/Harmful'),
('alexbraunx3', 'DarrenMeenan', 'Man I post alot here', 43, 96, '2016-04-14 16:12:47', 'Spam'),
('chrislinguini56', 'robcurry12', 'hllooo', 21, 40, '2016-04-14 16:27:03', 'Spam'),
('chrislinguini56', 'DarrenMeenan', 'My name is Darren and I approve this message', 21, 104, '2016-04-14 16:27:10', 'Spam'),
('chrislinguini56', 'DarrenMeenan', 'I like big butts and I cannot lie', 21, 105, '2016-04-14 16:26:33', 'Inappropriate');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_requested` varchar(20) NOT NULL,
  `request_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stickys`
--

CREATE TABLE `stickys` (
  `board_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `date_stickied` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stickys`
--

INSERT INTO `stickys` (`board_id`, `thread_id`, `date_stickied`) VALUES
(2, 7, '2016-05-09 13:49:04'),
(2, 41, '2016-05-03 16:00:27'),
(2, 43, '2016-05-03 16:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `board_id` int(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `last_update` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `type` varchar(100) NOT NULL,
  `isSticky` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `board_id`, `subject`, `user_create`, `last_update`, `date_created`, `type`, `isSticky`) VALUES
(7, 2, 'Trying out my new posting method', 'robcurry12', '2016-02-13 10:43:03', '2016-02-13 10:43:03', '', 1),
(9, 1, 'Filling up the board', 'robcurry12', '2016-02-21 14:34:12', '2016-02-21 14:34:12', '', 0),
(10, 2, 'I am lost and not sure where to start', 'robcurry12', '2016-02-21 14:45:44', '2016-02-21 14:45:44', '', 0),
(18, 2, 'Attempting to see whats wrong', 'robcurry12', '2016-02-22 13:57:17', '2016-02-22 13:57:17', '', 0),
(19, 1, 'Now let me try it in Chrome!', 'robcurry12', '2016-02-22 13:57:52', '2016-02-22 13:57:52', '', 0),
(21, 2, 'Testing the length of the post', 'robcurry12', '2016-02-22 15:38:36', '2016-02-22 15:38:36', '', 0),
(22, 3, 'Outing Travel Tips Post #1', 'robcurry12', '2016-03-08 15:23:21', '2016-03-08 15:23:21', '', 0),
(23, 2, 'Mow Mow', 'robcurry12', '2016-03-09 10:29:48', '2016-03-09 10:29:48', '', 0),
(24, 1, 'Meow', 'robcurry12', '2016-03-09 10:38:04', '2016-03-09 10:38:04', '', 0),
(26, 1, 'La Leche', 'robcurry12', '2016-03-09 10:43:42', '2016-03-09 10:43:42', '', 0),
(28, 4, 'Tickets up fpr grabs?', 'robcurry12', '2016-03-09 11:22:49', '2016-03-09 11:22:49', '', 0),
(29, 1, 'Mike Trout', 'robcurry12', '2016-03-09 11:56:31', '2016-03-09 11:56:31', '', 0),
(30, 4, 'Missing hash tags ugh', 'robcurry12', '2016-03-09 12:04:37', '2016-03-09 12:04:37', '', 0),
(31, 1, 'Does Bryce Harper suck', 'robcurry12', '2016-03-09 12:06:57', '2016-03-09 12:06:57', '', 0),
(32, 3, 'Lets Go Mets', 'robcurry12', '2016-03-09 12:31:02', '2016-03-09 12:31:02', '', 0),
(35, 4, 'Missed Game', 'robcurry12', '2016-03-09 12:50:28', '2016-03-09 12:50:28', '', 0),
(38, 3, 'Bro', 'robcurry12', '2016-03-09 13:02:55', '2016-03-09 13:02:55', 'poll', 0),
(39, 3, 'Answer the question ladies', 'robcurry12', '2016-03-09 13:28:08', '2016-03-09 13:28:08', 'poll', 0),
(41, 2, '4 Aces', 'robcurry12', '2016-03-09 22:33:29', '2016-03-09 22:33:29', 'poll', 1),
(42, 2, 'Attire for tomorrow', 'robcurry12', '2016-03-28 13:13:11', '2016-03-28 13:13:11', 'poll', 0),
(43, 2, 'New Recruit Thread', 'robcurry12', '2016-03-28 13:14:08', '2016-03-28 13:14:08', '', 1),
(45, 1, 'Fresh Fitted Friday', 'darrenmeenan', '2016-03-31 15:16:26', '2016-03-31 15:16:26', 'poll', 0),
(47, 1, 'T-Shirt Idea', 'darrenmeenan', '2016-03-31 15:40:09', '2016-03-31 15:40:09', 'poll', 0),
(48, 4, 'Testing out length of poll question', 'darrenmeenan', '2016-03-31 15:55:08', '2016-03-31 15:55:08', 'poll', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_active` datetime NOT NULL,
  `loggedIn` tinyint(1) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `date_join` date NOT NULL,
  `birthday` varchar(5) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `last_active`, `loggedIn`, `image`, `date_join`, `birthday`, `gender`, `status`) VALUES
(1, 'test', 'test@test.com', 'test', '2016-01-24 18:00:30', 0, NULL, '2016-01-24', '2009-', 'male', ''),
(3, 'test2', 'test2@test.com', 'e10adc3949ba59abbe56', '0000-00-00 00:00:00', 0, NULL, '0000-00-00', '0000-', '', ''),
(4, 'test3', 'test3@test.com', 'e10adc3949ba59abbe56', '0000-00-00 00:00:00', 0, NULL, '0000-00-00', '0000-', '', ''),
(5, 'test4', 'test4@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:37:04', 0, NULL, '2016-01-28', '0000-', '', ''),
(6, 'test5', 'test5@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:38:25', 0, NULL, '2016-01-28', '0000-', '', ''),
(7, 'test6', 'test6@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:42:52', 1, NULL, '2016-01-28', '0000-', '', ''),
(8, 'test7', 'test7@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:43:25', 1, NULL, '2016-01-28', '0000-', '', ''),
(9, 'test8', 'test8@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:49:50', 1, NULL, '2016-01-28', '0000-', '', ''),
(10, 'test9', 'test9@test.com', 'e10adc3949ba59abbe56', '2016-01-28 21:51:38', 1, NULL, '2016-01-28', '0000-', '', ''),
(11, 'mets', 'mets@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:52:38', 1, NULL, '2016-01-28', '0000-', '', ''),
(12, 'nymets', 'nymets@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:54:02', 1, NULL, '2016-01-28', '0000-', '', ''),
(13, 'lgm', 'lgm@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:55:34', 1, NULL, '2016-01-28', '0000-', '', ''),
(14, 'nym', 'nym@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:56:16', 1, NULL, '2016-01-28', '0000-', '', ''),
(15, 'yoisback', 'yoisback@mets.com', 'e10adc3949ba59abbe56', '2016-01-28 21:58:08', 1, NULL, '2016-01-28', '0000-', '', ''),
(16, 'captainamerica', 'nyca@mets.com', 'e10adc3949ba59abbe56e057f20f883e', '2016-01-29 15:37:39', 1, NULL, '2016-01-28', '0000-', '', ''),
(18, 'robcurry12', 'robcurry12@gmail.com', '0422eeda16890d9fdf17c472fc600297', '2016-05-11 00:03:55', 1, 'robcurry12.jpg', '2016-01-29', '06/19', 'male', ''),
(19, 'chrislinguini56', 'cxc13@dowling.edu', '20d256a57b9bcf3e6e80f2cf35c9f23e', '2016-04-28 16:53:37', 0, 'chrislinguini56.jpg', '2016-03-10', '03/23', 'male', ''),
(20, 'alexbraunx3', 'abraun@gmail.com', '20d256a57b9bcf3e6e80f2cf35c9f23e', '2016-04-21 16:26:36', 0, 'alexbraunx3.jpg', '2016-03-10', '04/10', 'female', ''),
(21, 'joeyg_hd', 'joeyg_hd@gmail.com', '20d256a57b9bcf3e6e80f2cf35c9f23e', '2016-03-10 16:05:19', 1, 'joeyg_hd.jpg', '2016-03-10', '07/08', 'male', ''),
(22, 'DarrenMeenan', '7linegeneral@t7l.com', '0422eeda16890d9fdf17c472fc600297', '2016-04-25 21:19:50', 1, 'DarrenMeenan.jpg', '2016-03-29', '01/04', 'male', '');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` double NOT NULL,
  `poll_id` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `voted_for` int(11) NOT NULL,
  `date_voted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `poll_id`, `user`, `voted_for`, `date_voted`) VALUES
(39, 0, 'darrenmeenan', 1, '2016-04-04 13:33:57'),
(7, 5, 'robcurry12', 1, '2016-03-09 15:37:27'),
(36, 6, 'darrenmeenan', 1, '2016-04-04 12:08:56'),
(40, 6, 'robcurry12', 2, '2016-04-26 22:49:58'),
(30, 8, 'alexbraunx3', 3, '2016-03-10 15:20:12'),
(27, 8, 'chrislinguini56', 1, '2016-03-10 13:39:37'),
(34, 8, 'darrenmeenan', 2, '2016-04-04 11:08:44'),
(31, 8, 'joeyg_hd', 4, '2016-03-10 15:50:44'),
(22, 8, 'robcurry12', 2, '2016-03-09 22:33:38'),
(35, 9, 'darrenmeenan', 1, '2016-04-04 11:13:12'),
(33, 11, 'darrenmeenan', 3, '2016-03-31 15:40:20'),
(38, 12, 'darrenmeenan', 2, '2016-04-04 12:52:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`board_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`post_id`,`user`);

--
-- Indexes for table `locked`
--
ALTER TABLE `locked`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `outings`
--
ALTER TABLE `outings`
  ADD PRIMARY KEY (`outing_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`reported_by`,`thread_id`,`post_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`,`thread_id`,`post_id`,`user_requested`);

--
-- Indexes for table `stickys`
--
ALTER TABLE `stickys`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`poll_id`,`user`),
  ADD UNIQUE KEY `vote_id` (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `outings`
--
ALTER TABLE `outings`
  MODIFY `outing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
