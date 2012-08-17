-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2012 at 02:48 PM
-- Server version: 5.1.63
-- PHP Version: 5.3.3-7+squeeze13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `faucet`
--

-- --------------------------------------------------------

--
-- Table structure for table `dailyltc`
--

CREATE TABLE IF NOT EXISTS `dailyltc` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ltcaddress` char(34) NOT NULL,
  `ip` char(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dailyltc`
--


-- --------------------------------------------------------

--
-- Table structure for table `dailytotal`
--

CREATE TABLE IF NOT EXISTS `dailytotal` (
  `dailytotal` char(34) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dailytotal`
--

INSERT INTO `dailytotal` (`dailytotal`) VALUES
('0');

-- --------------------------------------------------------

--
-- Table structure for table `round`
--

CREATE TABLE IF NOT EXISTS `round` (
  `round` char(34) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `round`
--

INSERT INTO `round` (`round`) VALUES
('0');

-- --------------------------------------------------------

--
-- Table structure for table `roundltc`
--

CREATE TABLE IF NOT EXISTS `roundltc` (
  `roundltc` char(34) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roundltc`
--

INSERT INTO `roundltc` (`roundltc`) VALUES
('0');

-- --------------------------------------------------------

--
-- Table structure for table `subtotal`
--

CREATE TABLE IF NOT EXISTS `subtotal` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ltcaddress` char(34) NOT NULL,
  `ip` char(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `subtotal`
--

