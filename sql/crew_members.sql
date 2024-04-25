-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 23, 2024 at 10:04 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `crew_members`
--

DROP TABLE IF EXISTS `crew_members`;
CREATE TABLE IF NOT EXISTS `crew_members` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `cr_fname` varchar(40) NOT NULL,
  `cr_lname` varchar(60) NOT NULL,
  `cr_dob` date NOT NULL,
  PRIMARY KEY (`cr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crew_members`
--

INSERT INTO `crew_members` (`cr_id`, `cr_fname`, `cr_lname`, `cr_dob`) VALUES
(1, 'christian', 'bale', '1974-01-30'),
(2, 'heath', 'ledger', '1979-04-04'),
(8, 'christopher', 'nolan', '1970-07-30'),
(10, 'gary', 'oldman', '1958-04-21'),
(11, 'maggie', 'gyllenhaal', '1977-11-16'),
(12, 'aaron', 'eckhart', '1968-04-12'),
(13, 'michael', 'caine', '1933-04-14'),
(15, 'morgan', 'freeman', '1937-06-01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
