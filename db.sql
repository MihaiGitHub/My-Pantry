-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: smarandache.com.mysql:3306
-- Generation Time: Sep 26, 2015 at 05:29 AM
-- Server version: 5.5.42-MariaDB-1~wheezy
-- PHP Version: 5.4.36-0+deb7u3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smarandache_com`
--
CREATE DATABASE `smarandache_com` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `smarandache_com`;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `lname` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `postalCode` int(11) NOT NULL,
  `phone` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `employed` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `lastDateWorked` date NOT NULL,
  `annual_income` int(11) NOT NULL,
  `income_updated` date NOT NULL,
  `inhouse` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `howManyMales` int(11) NOT NULL,
  `howManyFemales` int(11) NOT NULL,
  `ageGroups` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `comments` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2147483648 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `fname`, `lname`, `address`, `city`, `state`, `postalCode`, `phone`, `email`, `employed`, `lastDateWorked`, `annual_income`, `income_updated`, `inhouse`, `howManyMales`, `howManyFemales`, `ageGroups`, `comments`) VALUES
(1126239, 'fasddfds', 'fsdfdsfdsf', '', '', 'AZ', 0, '', '', 'undefined', '0000-00-00', 0, '0000-00-00', '', 0, 0, '', ''),
(1126240, 'aaaa', 'bbbbb', '', '', 'AZ', 0, '', '', 'undefined', '0000-00-00', 0, '0000-00-00', '', 0, 0, '', ''),
(2147483647, 'demo', 'demo', 'demo', 'demo', 'AZ', 122134, '', '', 'undefined', '0000-00-00', 0, '0000-00-00', '', 0, 0, '1-5,6-11,12-18', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `role` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `timestamp`) VALUES
(4, 'mark', 'ea82410c7a9991816b5eeeebe195e20a', 'standard', '2015-04-04 04:06:12'),
(3, 'smith', 'a66e44736e753d4533746ced572ca821', 'standard', '2015-04-04 04:06:05'),
(5, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'admin', '2015-04-04 04:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE IF NOT EXISTS `visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `fname` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `how_many_in_house` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `program` text COLLATE latin1_general_ci NOT NULL,
  `volunteer` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `numBags` int(11) NOT NULL,
  `weight` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `date_of_visit` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6705 ;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `lname`, `fname`, `how_many_in_house`, `phone`, `email`, `program`, `volunteer`, `numBags`, `weight`, `client_id`, `date_of_visit`) VALUES
(2, '', '', '', '', '', '2 Food Box/Hygiene/Fruit AND OR Vegetables', 'Anderson, Silva', 0, '', 0, '2013-02-05'),
(6701, 'fsdfdsfdsf', 'fasddfds', '', '', '', '4 Hygiene only', 'Fucsher, Becky', 0, 'undefined', 1126239, '2015-06-10'),
(6702, 'James/ Kristina', 'Harris', '5', '360-672-8029', 'avs187@hotmail.com', '3 Fruit/Vegetables only', 'Fucsher, Becky', 0, 'undefined', 112131, '2015-06-04'),
(6703, 'bbbbb', 'aaaa', '', '', '', '5 Diapers/Wipes/Formula only', 'Hawkins, Brett', 0, 'undefined', 1126240, '2015-06-05'),
(6704, 'demo', 'demo', '', '', '', '3 Fruit/Vegetables only', 'Welch, Debbie', 0, 'undefined', 2147483647, '2015-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE IF NOT EXISTS `volunteers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `volunteer` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `active` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `volunteer`, `active`) VALUES
(5, 'Seth, Rollins', 'N'),

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
