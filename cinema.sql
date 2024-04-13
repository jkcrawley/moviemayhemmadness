-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 13, 2024 at 02:18 AM
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
-- Table structure for table `actors`
--

DROP TABLE IF EXISTS `actors`;
CREATE TABLE IF NOT EXISTS `actors` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(60) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_movies`
--

DROP TABLE IF EXISTS `actor_movies`;
CREATE TABLE IF NOT EXISTS `actor_movies` (
  `am_actor` int(11) NOT NULL,
  `am_movie` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

DROP TABLE IF EXISTS `directors`;
CREATE TABLE IF NOT EXISTS `directors` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(60) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `director_movies`
--

DROP TABLE IF EXISTS `director_movies`;
CREATE TABLE IF NOT EXISTS `director_movies` (
  `dm_director` int(11) NOT NULL,
  `dm_movie` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_title` varchar(60) NOT NULL,
  `m_description` varchar(20000) NOT NULL,
  `m_release` date NOT NULL,
  `m_budget` int(11) NOT NULL,
  `m_boxoffice` int(11) NOT NULL,
  `m_length` int(11) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `r_id` int(11) NOT NULL,
  `r_movie` int(11) NOT NULL,
  `r_rating` int(11) NOT NULL,
  `r_summary` varchar(60) NOT NULL,
  `r_review` varchar(1000) NOT NULL,
  `r_date` date NOT NULL,
  `r_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `screenwriters`
--

DROP TABLE IF EXISTS `screenwriters`;
CREATE TABLE IF NOT EXISTS `screenwriters` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_screenwtier` varchar(60) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `screenwriter_movies`
--

DROP TABLE IF EXISTS `screenwriter_movies`;
CREATE TABLE IF NOT EXISTS `screenwriter_movies` (
  `sw_id` int(11) NOT NULL,
  `sw_name` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
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
