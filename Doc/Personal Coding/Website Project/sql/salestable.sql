-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2020 at 10:53 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `salestable`
--

CREATE TABLE IF NOT EXISTS `salestable` (
  `Barcode` varchar(45) NOT NULL,
  `Sold Unit` int(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salestable`
--

INSERT INTO `salestable` (`Barcode`, `Sold Unit`, `Date`) VALUES
('bis01', 2, '2020-06-10 05:28:40'),
('Drk53', 3, '2020-06-20 16:12:22'),
('Drk05', 1, '2020-08-30 07:39:15'),
('Drk77', 1, '2020-07-23 05:45:16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
