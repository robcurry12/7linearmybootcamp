-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2016 at 02:54 AM
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
(71, 'chrislinguini56', 'robcurry12', '2016-03-17 17:58:53'),
(72, 'chrislinguini56', 'chrislinguini56', '2016-03-17 17:58:55'),
(72, 'robcurry12', 'chrislinguini56', '2016-03-17 17:59:25'),
(73, 'robcurry12', 'chrislinguini56', '2016-03-17 19:55:11'),
(74, 'chrislinguini56', 'alexbraunx3', '2016-03-17 17:58:57'),
(74, 'robcurry12', 'alexbraunx3', '2016-03-17 17:59:28'),
(75, 'chrislinguini56', 'joeyg_hd', '2016-03-17 17:58:59'),
(75, 'robcurry12', 'joeyg_hd', '2016-03-17 17:59:30'),
(76, 'chrislinguini56', 'robcurry12', '2016-03-17 17:59:01'),
(76, 'robcurry12', 'robcurry12', '2016-03-17 17:59:31'),
(77, 'chrislinguini56', 'robcurry12', '2016-03-17 17:59:03'),
(77, 'robcurry12', 'robcurry12', '2016-03-17 17:59:33'),
(80, 'robcurry12', 'robcurry12', '2016-03-28 18:02:45'),
(81, 'robcurry12', 'robcurry12', '2016-03-28 18:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `poll_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `question` varchar(200) NOT NULL,
  `option1` varchar(100) NOT NULL,
  `option2` varchar(100) NOT NULL,
  `option3` varchar(100) NOT NULL,
  `option4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `thread_id`, `user`, `question`, `option1`, `option2`, `option3`, `option4`) VALUES
(5, 38, 'robcurry12', 'Did I finally get polling fixed?', 'Yes', 'No', 'Give up!', ''),
(6, 39, 'robcurry12', 'Is Tyler hot?', 'Yes', 'Of course', '', ''),
(7, 40, 'robcurry12', '', '', '', '', ''),
(8, 41, 'robcurry12', 'Who is the best Mets starters?', 'Matt Harvey', 'Noah Syndergaard', 'Jacob DeGrom', 'Steven Matz'),
(9, 42, 'robcurry12', 'What shirt do I wear tomorrow', 'Mets', 'None', '', '');

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
(21, 9, 2, 'Filling up the board', 'Hello', 'robcurry12', '2016-02-21 14:34:12', ''),
(22, 10, 2, 'I am lost and not sure where to start', 'Help me out', 'robcurry12', '2016-02-21 14:45:44', ''),
(23, 11, 2, 'I am lost ', 'help', 'robcurry12', '2016-02-21 15:44:04', ''),
(24, 12, 2, 'Meow', 'I am a cat', 'robcurry12', '2016-02-21 15:51:57', ''),
(25, 13, 2, 'undefined', 'I like to eat pizza! What about you?! I like goats! Baaaaahhh', 'robcurry12', '2016-02-21 17:12:46', ''),
(26, 14, 2, 'undefined', 'Can someone take my seat at an upcoming game?', 'robcurry12', '2016-02-22 13:03:54', ''),
(27, 15, 2, 'undefined', 'Big bag of potatos', 'robcurry12', '2016-02-22 13:10:25', ''),
(28, 16, 2, 'undefined', 'Lets Go Mets!', 'robcurry12', '2016-02-22 13:11:24', ''),
(29, 17, 2, 'undefined', 'Rawr', 'robcurry12', '2016-02-22 13:13:30', ''),
(30, 18, 2, 'Attempting to see whats wrong', 'Hi there!', 'robcurry12', '2016-02-22 13:57:17', ''),
(31, 19, 2, 'Now let me try it in Chrome!', 'This worked in firefox now hopefully it works in CHROME', 'robcurry12', '2016-02-22 13:57:52', ''),
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
(52, 22, 1, 'Outing Travel Tips Post #1', 'Hi all!', 'robcurry12', '2016-03-08 15:23:22', ''),
(53, 23, 1, 'Mow Mow', 'Mow Mow', 'robcurry12', '2016-03-09 10:29:48', ''),
(54, 24, 1, 'Meow', 'Meoooowww', 'robcurry12', '2016-03-09 10:38:04', ''),
(55, 25, 4, 'Here is a poll', 'Poll', 'robcurry12', '2016-03-09 10:41:28', ''),
(56, 26, 3, 'La Leche', 'The Milk', 'robcurry12', '2016-03-09 10:43:42', ''),
(57, 27, 4, 'Here is another poll', 'Vote vote vote!', 'robcurry12', '2016-03-09 11:19:35', ''),
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
(78, 19, 2, '', 'Yes it worked!', 'robcurry12', '2016-03-15 18:32:09', ''),
(79, 42, 2, 'Attire for tomorrow', 'What should I wear?', 'robcurry12', '2016-03-28 13:13:11', 'poll'),
(80, 43, 2, 'New Recruit Thread', 'Welcome everyone! Here is where you can introduce yourself to The 7 Line Army and meet other 7 Line Soldiers.', 'robcurry12', '2016-03-28 13:14:08', ''),
(81, 44, 2, 'New Thread', 'New content', 'robcurry12', '2016-03-28 14:02:28', '');

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
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `board_id`, `subject`, `user_create`, `last_update`, `date_created`, `type`) VALUES
(7, 2, 'Trying out my new posting method', 'robcurry12', '2016-02-13 10:43:03', '2016-02-13 10:43:03', ''),
(9, 2, 'Filling up the board', 'robcurry12', '2016-02-21 14:34:12', '2016-02-21 14:34:12', ''),
(10, 2, 'I am lost and not sure where to start', 'robcurry12', '2016-02-21 14:45:44', '2016-02-21 14:45:44', ''),
(11, 2, 'I am lost ', 'robcurry12', '2016-02-21 15:44:04', '2016-02-21 15:44:04', ''),
(12, 2, 'Meow', 'robcurry12', '2016-02-21 15:51:57', '2016-02-21 15:51:57', ''),
(13, 2, 'undefined', 'robcurry12', '2016-02-21 17:12:46', '2016-02-21 17:12:46', ''),
(14, 2, 'undefined', 'robcurry12', '2016-02-22 13:03:54', '2016-02-22 13:03:54', ''),
(15, 2, 'undefined', 'robcurry12', '2016-02-22 13:10:25', '2016-02-22 13:10:25', ''),
(16, 2, 'undefined', 'robcurry12', '2016-02-22 13:11:24', '2016-02-22 13:11:24', ''),
(17, 2, 'undefined', 'robcurry12', '2016-02-22 13:13:30', '2016-02-22 13:13:30', ''),
(18, 2, 'Attempting to see whats wrong', 'robcurry12', '2016-02-22 13:57:17', '2016-02-22 13:57:17', ''),
(19, 2, 'Now let me try it in Chrome!', 'robcurry12', '2016-02-22 13:57:52', '2016-02-22 13:57:52', ''),
(21, 2, 'Testing the length of the post', 'robcurry12', '2016-02-22 15:38:36', '2016-02-22 15:38:36', ''),
(22, 1, 'Outing Travel Tips Post #1', 'robcurry12', '2016-03-08 15:23:21', '2016-03-08 15:23:21', ''),
(23, 1, 'Mow Mow', 'robcurry12', '2016-03-09 10:29:48', '2016-03-09 10:29:48', ''),
(24, 1, 'Meow', 'robcurry12', '2016-03-09 10:38:04', '2016-03-09 10:38:04', ''),
(25, 4, 'Here is a poll', 'robcurry12', '2016-03-09 10:41:28', '2016-03-09 10:41:28', ''),
(26, 3, 'La Leche', 'robcurry12', '2016-03-09 10:43:42', '2016-03-09 10:43:42', ''),
(27, 4, 'Here is another poll', 'robcurry12', '2016-03-09 11:19:35', '2016-03-09 11:19:35', ''),
(28, 4, 'Tickets up fpr grabs?', 'robcurry12', '2016-03-09 11:22:49', '2016-03-09 11:22:49', ''),
(29, 1, 'Mike Trout', 'robcurry12', '2016-03-09 11:56:31', '2016-03-09 11:56:31', ''),
(30, 4, 'Missing hash tags ugh', 'robcurry12', '2016-03-09 12:04:37', '2016-03-09 12:04:37', ''),
(31, 1, 'Does Bryce Harper suck', 'robcurry12', '2016-03-09 12:06:57', '2016-03-09 12:06:57', ''),
(32, 3, 'Lets Go Mets', 'robcurry12', '2016-03-09 12:31:02', '2016-03-09 12:31:02', ''),
(35, 4, 'Missed Game', 'robcurry12', '2016-03-09 12:50:28', '2016-03-09 12:50:28', ''),
(38, 3, 'Bro', 'robcurry12', '2016-03-09 13:02:55', '2016-03-09 13:02:55', 'poll'),
(39, 3, 'Answer the question ladies', 'robcurry12', '2016-03-09 13:28:08', '2016-03-09 13:28:08', 'poll'),
(41, 2, '4 Aces', 'robcurry12', '2016-03-09 22:33:29', '2016-03-09 22:33:29', 'poll'),
(42, 2, 'Attire for tomorrow', 'robcurry12', '2016-03-28 13:13:11', '2016-03-28 13:13:11', 'poll'),
(43, 2, 'New Recruit Thread', 'robcurry12', '2016-03-28 13:14:08', '2016-03-28 13:14:08', 'sticky'),
(44, 2, 'New Thread', 'robcurry12', '2016-03-28 14:02:28', '2016-03-28 14:02:28', '');

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
  `gender` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(18, 'robcurry12', 'robcurry12@gmail.com', '0422eeda16890d9fdf17c472fc600297', '2016-03-28 20:37:52', 1, 'robcurry12.jpg', '2016-01-29', '06/19', 'male'),
(19, 'chrislinguini56', 'cxc13@dowling.edu', '20d256a57b9bcf3e6e80f2cf35c9f23e', '2016-03-17 13:59:07', 0, 'chrislinguini56.jpg', '2016-03-10', '03/23', 'male'),
(20, 'alexbraunx3', 'abraun@gmail.com', '20d256a57b9bcf3e6e80f2cf35c9f23e', '2016-03-10 15:23:46', 0, 'alexbraunx3.jpg', '2016-03-10', NULL, NULL),
(21, 'joeyg_hd', 'joeyg_hd@gmail.com', '20d256a57b9bcf3e6e80f2cf35c9f23e', '2016-03-10 16:05:19', 1, 'joeyg_hd.jpg', '2016-03-10', '07/08', 'male');

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
(7, 5, 'robcurry12', 1, '2016-03-09 15:37:27'),
(30, 8, 'alexbraunx3', 3, '2016-03-10 15:20:12'),
(27, 8, 'chrislinguini56', 1, '2016-03-10 13:39:37'),
(31, 8, 'joeyg_hd', 4, '2016-03-10 15:50:44'),
(22, 8, 'robcurry12', 2, '2016-03-09 22:33:38');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
