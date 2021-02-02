-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2016 at 05:32 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel52`
--

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
`id` tinyint(4) NOT NULL,
  `parentid` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `parentid`, `title`, `desc`, `order`) VALUES
(1, 0, 'My Client', 'My Client description', 0),
(2, 0, 'Important Client', 'Important Client description', 1),
(3, 0, 'Best Client', 'Best Client description', 2),
(4, 0, 'Hard Client', 'Hard Client description', 3),
(5, 4, 'First project', '', 0),
(6, 4, 'Website project', '', 0),
(7, 6, 'UI', '', 0),
(8, 6, 'Database', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `level_task`
--

CREATE TABLE IF NOT EXISTS `level_task` (
  `level_id` tinyint(4) NOT NULL,
  `task_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `level_task`
--

INSERT INTO `level_task` (`level_id`, `task_id`) VALUES
(8, 0),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `assignee` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `duedate` datetime NOT NULL,
  `est_hour` time NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `assignee`, `duedate`, `est_hour`, `desc`, `order`) VALUES
(0, 'Design database', 'lapnguyen', '0000-00-00 00:00:00', '00:00:00', '', 0),
(1, 'Create table', 'lapnguyen', '2016-10-17 00:00:00', '23:00:00', '', 0),
(2, 'Write script', 'hoangan', '2016-10-18 00:00:00', '23:00:00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `firstname`, `lastname`) VALUES
('lapnguyen', 'lapnguyen', 'lap', 'nguyen'),
('hoangan', 'hoangan', 'hoang', 'an');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
