-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 03, 2024 at 05:13 AM
-- Server version: 11.3.2-MariaDB
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
CREATE DATABASE IF NOT EXISTS `cinema` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cinema`;

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
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(15, 'morgan', 'freeman', '1937-06-01'),
(16, 'Paul', 'Thomas Anderson', '1970-06-26'),
(17, 'paul', 'thomas anderson', '1970-06-26'),
(18, 'paul', 'verhoeven', '1938-07-18'),
(19, 'edward', 'nuemeier', '1957-08-24'),
(20, 'michael', 'miner', '1933-03-23'),
(21, 'peter', 'weller', '1947-06-24'),
(22, 'cillian', 'murphey', '1976-05-25'),
(58, 'zoe', 'kravitz', '1988-12-01'),
(57, 'matt', 'reeves', '1966-04-27'),
(56, 'robert', 'pattinson', '1986-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_title` varchar(60) NOT NULL,
  `m_premise` varchar(20000) NOT NULL,
  `m_release` date NOT NULL,
  `m_budget` int(11) NOT NULL,
  `m_boxoffice` int(11) NOT NULL,
  `m_runtime` int(11) NOT NULL,
  `m_poster` varchar(255) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`m_id`, `m_title`, `m_premise`, `m_release`, `m_budget`, `m_boxoffice`, `m_runtime`, `m_poster`) VALUES
(2, 'The Dark Knight', 'The plot follows the vigilante Batman, police lieutenant James Gordon, and district attorney Harvey Dent, who form an alliance to dismantle organized crime in Gotham City. Their efforts are derailed by the Joker, an anarchistic mastermind who seeks to test how far Batman will go to save the city from chaos.', '2008-07-18', 185000000, 1006000000, 152, '818hyvdVfvL._AC_UF894,1000_QL80_.jpg'),
(29, 'Furiosa', 'Snatched from the Green Place of Many Mothers, young Furiosa falls into the hands of a great biker horde led by the warlord Dementus. Sweeping through the Wasteland, they come across the Citadel, presided over by the Immortan Joe. As the two tyrants fight for dominance, Furiosa soon finds herself in a nonstop battle to make her way home.', '2024-05-24', 168000000, 32000000, 148, 'furiosa.jpg'),
(27, 'Civil War', 'In a dystopian future America, a team of military-embedded journalists races against time to reach Washington, D.C., before rebel factions descend upon the White House.', '2024-04-12', 50000000, 112000000, 109, 'civilwar.jpg'),
(28, 'The Batman', 'Batman ventures into Gotham City\\\'s underworld when a sadistic killer leaves behind a trail of cryptic clues. As the evidence begins to lead closer to home and the scale of the perpetrator\\\'s plans become clear, he must forge new relationships, unmask the culprit and bring justice to the abuse of power and corruption that has long plagued the metropolis.', '2022-03-04', 185000000, 772245583, 176, 'thebatman.jpg'),
(20, 'If', 'After discovering she can see everyone\'s imaginary friends, a girl embarks on a magical adventure to reconnect forgotten IFs with their kids.', '2024-05-17', 185000000, 127000000, 104, 'ifmovie.jpg'),
(21, 'The Fall Guy', 'A down-and-out stuntman must find the missing star of his ex-girlfriend\\\'s blockbuster film.', '2024-05-03', 125000000, 130100000, 125, 'fallguy.jpg'),
(10, 'Dune part 2', 'Paul Atreides unites with Chani and the Fremen while seeking revenge against the conspirators who destroyed his family. Facing a choice between the love of his life and the fate of the universe, he must prevent a terrible future only he can foresee.', '2024-03-01', 190000000, 711800000, 167, 'jKE4GGhhSLf4HR2fpD9Ayo2UtAD.jpg'),
(7, 'Robocop', 'RoboCop takes place in Detroit in 2043, in a near-apocalyptic, crime-ridden future. The movie is about a terminally wounded police officer, Alex Murphy, who is murdered by a gang and then revived as a cyborg law enforcer by the megacorporation Omni Consumer Products (OCP). OCP wins a contract from the city government to privatize the police force and uses Murphy\'s body to test their untested RoboCop prototype. However, RoboCop turns on OCP when he learns of their evil plans.', '1987-07-17', 13700000, 53400000, 103, 'MV5BZWVlYzU2ZjQtZmNkMi00OTc3LTkwZmYtZDVjNmY4OWFmZGJlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg'),
(8, 'Robocop', 'Set in 2028, a detective becomes critically injured and is turned into a cyborg police officer whose programming blurs the line between man and machine.', '2014-02-12', 130000000, 242600000, 108, 'MV5BMjAyOTUzMTcxN15BMl5BanBnXkFtZTgwMjkyOTc1MDE@._V1_.jpg'),
(9, 'Dune', 'Paul Atreides, a brilliant and gifted young man born into a great destiny beyond his understanding, must travel to the most dangerous planet in the universe to ensure the future of his family and his people.', '2021-10-21', 165000000, 407500000, 155, '61QbqeCVm0L.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movie_crew`
--

DROP TABLE IF EXISTS `movie_crew`;
CREATE TABLE IF NOT EXISTS `movie_crew` (
  `mc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mc_movie` int(11) NOT NULL,
  `mc_crew` int(11) NOT NULL,
  `mc_role` varchar(20) NOT NULL,
  PRIMARY KEY (`mc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
