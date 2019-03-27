-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql304.byetcluster.com
-- Generation Time: Mar 26, 2019 at 11:54 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epiz_23637101_tportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `type` enum('post','tournament') NOT NULL,
  `userid` varchar(50) NOT NULL,
  `userpro` varchar(20) NOT NULL,
  `message` longtext NOT NULL,
  `description` longtext NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `startDates` varchar(100) NOT NULL,
  `endDates` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `contactName` varchar(50) NOT NULL,
  `contactPhone` varchar(20) NOT NULL,
  `contactEmail` varchar(50) NOT NULL,
  `organizerName` varchar(50) NOT NULL,
  `organizerPhone` varchar(20) NOT NULL,
  `organizerEmail` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `role` varchar(10) NOT NULL DEFAULT 'admin',
  `email` varchar(50) NOT NULL,
  `profession` varchar(20) NOT NULL DEFAULT 'state',
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `organizer` varchar(50) NOT NULL,
  `regNo` int(30) NOT NULL,
  `pan` int(20) NOT NULL,
  `objectives` mediumtext NOT NULL,
  `contactPerson` varchar(50) NOT NULL,
  `contactPhone` varchar(20) NOT NULL,
  `image` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`role`, `email`, `profession`, `name`, `country`, `organization`, `contact`, `phone`, `password`, `website`, `organizer`, `regNo`, `pan`, `objectives`, `contactPerson`, `contactPhone`, `image`, `document`, `createdAt`, `updatedAt`) VALUES
('admin', 'theonlyamos@gmail.com', 'state', 'Western Region', '', 'Takoradi Chess Federation', '0335355635', '057999666', '6c36d7f2b3f46e5a341255a504a0b6d2f52fda73bb638ba1d40a918663de33c4', 'facebook.com/amosamissah', 'Amos Amissah', 24343443, 53223, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s,', 'Gabriel Bruce', '0245356655', 'theonlyamos@gmail.comportfolio-background.jpg', '', '2019-03-26 20:49:52', '2019-03-26 20:49:52'),
('admin', 'usa@gmail.com', 'state', 'USA', '', 'USA Association', '6456456', '4654654', '4c9f240cafe2de7d80fa1f4187ed17cf2e0af8810694a12dceb134ea910ff508', 'jbdjsad', 'njsadns', 5545, 54545, 'sdbsdn', 'kjk', '45454545', 'usa@gmail.comBiLFLRXG.png', '', '2019-03-26 21:34:53', '2019-03-26 21:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `blindness` varchar(100) DEFAULT NULL,
  `cell` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `trainertitle` varchar(50) DEFAULT NULL,
  `experience` int(11) NOT NULL DEFAULT '0',
  `address` varchar(100) DEFAULT NULL,
  `state` varchar(50) NOT NULL,
  `district` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal` int(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `adhar` varchar(50) DEFAULT NULL,
  `pan` varchar(50) DEFAULT NULL,
  `fideid` varchar(50) DEFAULT NULL,
  `fiderating` varchar(50) DEFAULT NULL,
  `aicfbid` varchar(50) DEFAULT NULL,
  `communication` varchar(20) DEFAULT NULL,
  `profession` varchar(50) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`,`dob`),
  FULLTEXT KEY `id` (`email`,`password`,`fullname`,`username`,`cell`,`phone`,`state`,`communication`,`profession`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `fullname`, `username`, `dob`, `gender`, `blindness`, `cell`, `phone`, `trainertitle`, `experience`, `address`, `state`, `district`, `city`, `postal`, `country`, `adhar`, `pan`, `fideid`, `fiderating`, `aicfbid`, `communication`, `profession`, `picture`, `createdAt`, `updatedAt`, `role`) VALUES
('amosamissah@outlook.com', '33a6e1cd9e91d2979cc3854aa37f1c82c124eeda08e83eb0957f9fe1c9205e3b', 'Amos Amissah', 'theonlyamos', '1990-07-23', 'male', 'Myopia', '0557821030', '057999666', NULL, 0, NULL, 'Western', 'STMA', 'Takoradi', 233, NULL, '13234', '4344343', '35424', '32', '54534', 'email', 'player', NULL, '2019-03-23 10:45:47', '2019-03-23 13:00:36', 'user'),
('nirvanaball86@gmail.com', '2904947e5680faa13ad909aed16c9b4fe2901f2fc515ed2c981799fe045e480e', 'naveen kumar', 'nirvanaball', '1880-02-15', 'male', 'total', '9999999999', '9999999999', NULL, 0, NULL, 'Delhi', 'North', 'New Delhi', 110059, NULL, '46555546546546', '656545645', '4654654', '465465456', '45646545', 'email', 'player', NULL, '2019-03-24 15:04:19', '2019-03-26 17:56:22', 'user'),
('fireisaverywickedmaster@gmail.com', '381a862f48d6c43ec76f55a47621f66c52ef746e822cb8ee23a93586f6853850', 'James Stefens', 'jamesstefens18', '0000-00-00', '', NULL, NULL, '057999666', '', 0, 'Prisons Road, Sekondi', 'Western', 'STMA', 'Takoradi', 0, 'GH', '23444', '4223', NULL, NULL, NULL, 'a:2:{i:0;s:5:"email"', 'arbiter', 'fireisaverywickedmaster@gmail.comIMG-20180827-WA0003.jpg', '2019-03-25 15:09:31', '2019-03-25 15:09:31', 'user'),
('naveenwebint@gmail.com', '9e1520d654cee0e109554b07e127358164a3cd217075f445f0e13038e7f0391a', 'random player', 'random', '0000-00-00', '', NULL, NULL, '7878787878', NULL, 0, 'test', 'Delhi', 'North', 'New Delhi', 0, 'IN', 'dsdfsdfd', 'dfdsfdfds', NULL, NULL, NULL, 'a:2:{i:0;s:5:"email"', 'coach', 'naveenwebint@gmail.comezgif.com-webp-to-png.png', '2019-03-26 19:56:11', '2019-03-26 19:56:11', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
