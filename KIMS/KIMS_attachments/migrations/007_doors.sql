-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2013 at 02:59 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kims`
--

-- --------------------------------------------------------

--
-- Table structure for table `doors`
--

CREATE TABLE IF NOT EXISTS `doors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `perant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `doors`
--

INSERT INTO `doors` (`id`, `name`, `sub_name`, `balance`, `price`, `date`, `perant`) VALUES
(2, 'الباب الاول', NULL, NULL, '0', '2013-03-27 11:45:03', NULL),
(3, 'الباب الثانى', '', NULL, NULL, '2013-03-31 17:14:05', NULL),
(4, 'الباب الثالث', NULL, NULL, '0', '2013-03-21 13:44:55', NULL),
(5, 'الباب الرابع', NULL, NULL, '0', '2013-03-21 13:45:02', NULL),
(6, 'الباب الخامس', NULL, NULL, NULL, '2013-03-21 13:45:11', NULL),
(8, NULL, 'karim', NULL, '100', '2013-03-24 16:13:28', 3),
(9, NULL, 'helmy', NULL, '1000', '2013-03-24 16:13:40', 4),
(11, NULL, 'qwewqeqw', NULL, '0', '2013-03-21 15:03:55', 10),
(15, NULL, 'hhhhhhh', '2234', '43335', '2013-04-01 12:50:24', 2),
(16, NULL, 'احمد', '100', '1000', '2013-03-25 13:51:20', 2),
(24, 'kl;kl;k', 'jhgjkhkjhkj', NULL, '0', '2013-03-24 17:03:14', 23),
(27, 'الباب السادس', NULL, NULL, NULL, '2013-03-26 11:00:08', NULL),
(29, NULL, 'eeeeee', '100', '1000', '2013-03-26 16:05:57', 5),
(30, '', 'fffffffffff', '100', '3000', '2013-03-26 16:12:32', 6),
(31, '', 'qqqqqqq', '1999', '4000', '2013-03-26 16:12:59', 27),
(37, NULL, 'غغغغغغغغ', NULL, '0', '2013-03-31 15:54:12', 3),
(38, NULL, 'ةةةةةةة', NULL, '0', '2013-03-31 15:59:18', 3),
(39, NULL, 'علاء', '100', '0', '2013-03-31 16:31:51', 2),
(43, NULL, 'yyyyyyy', NULL, '0', '2013-03-31 16:39:07', 2),
(48, NULL, 'ddddd', NULL, '0', '2013-03-31 17:20:20', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
