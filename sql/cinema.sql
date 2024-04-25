-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 24, 2024 at 08:19 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

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
-- Table structure for table `actors`
--

DROP TABLE IF EXISTS `actors`;
CREATE TABLE IF NOT EXISTS `actors` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `a_name` varchar(60) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crew_members`
--

DROP TABLE IF EXISTS `crew_members`;
CREATE TABLE IF NOT EXISTS `crew_members` (
  `cr_id` int NOT NULL AUTO_INCREMENT,
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

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `m_id` int NOT NULL AUTO_INCREMENT,
  `m_title` varchar(60) NOT NULL,
  `m_description` varchar(20000) NOT NULL,
  `m_release` date NOT NULL,
  `m_budget` int NOT NULL,
  `m_boxoffice` int NOT NULL,
  `m_length` int NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `r_id` int NOT NULL,
  `r_movie` int NOT NULL,
  `r_rating` int NOT NULL,
  `r_summary` varchar(60) NOT NULL,
  `r_review` varchar(1000) NOT NULL,
  `r_date` date NOT NULL,
  `r_user` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `u_username` varchar(60) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_email` varchar(80) NOT NULL,
  `u_newsletter` varchar(5) NOT NULL,
  `u_level` varchar(20) NOT NULL,
  `u_request` varchar(5) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `u_password`, `u_email`, `u_newsletter`, `u_level`, `u_request`) VALUES
(7, 'Cinefile Weirdo', '$2y$10$eMcx2A0L2dt4P2Am333G/.dN1Wc/9n6GZtY.FpstHDy9ZLd6gjTv2', 'jcrawl6554@gmail.com', 'yes', 'reviewer', 'no'),
(6, 'jkcrawley', '$2y$10$ST7fEqv82ilH2OnAamo/fuq7.oplWiz65dWmQ5xkfqNavCxvyz1KC', 'j-crawley@live.com', 'yes', 'admin', 'no'),
(8, 'Mad Movie Master', '$2y$10$5o5iFquzoWfM7NKCZ7wjVe9iq5t0TqZzZjRIY/Q4paIkgaNi2toUS', 'crawleydesign@hotmail.com', 'yes', 'reviewer', 'no');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
