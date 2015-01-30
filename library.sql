-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2015 at 07:15 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `ISBN` varchar(14) DEFAULT NULL,
  `BookTitle` varchar(40) DEFAULT NULL,
  `Author` varchar(40) DEFAULT NULL,
  `Edition` decimal(2,0) DEFAULT NULL,
  `Year` decimal(4,0) DEFAULT NULL,
  `Category` decimal(3,0) DEFAULT NULL,
  `Reserved` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `BookTitle`, `Author`, `Edition`, `Year`, `Category`, `Reserved`) VALUES
('093-403992', 'Computers in Business', 'Alicia O''Neill', '3', '1997', '3', 'Y'),
('23472-8729', 'Exploring Peru', 'Stephanie Birch', '4', '2005', '5', 'Y'),
('237-34823', 'Business Strategy', 'Joe Peppard', '2', '2002', '2', 'N'),
('23u8-923849', 'A Guide to Nutrition', 'John Thorpe', '2', '1997', '1', 'Y'),
('2983-3494', 'Cooking for children', 'Anabelle Sharpe', '1', '2003', '7', 'N'),
('82n8-308', 'Computers for Idiots', 'Susan O''Neill', '5', '1998', '4', 'N'),
('9823-23984', 'My life in Picture', 'Kevin Graham', '8', '2004', '1', 'N'),
('9823-2403-0', 'DaVinci Code', 'Dan Brown', '1', '2003', '8', 'Y'),
('98234-029384', 'My Ranch in Texas', 'George Bush', '1', '2005', '1', 'Y'),
('9823-98345', 'How to Cook Italian Food', 'Jamie Oliver', '2', '2005', '7', 'N'),
('9823-98487', 'Optimising your Business', 'Cleo Blair', '1', '2001', '2', 'N'),
('988745-234', 'Tara Road', 'Maeve Binchy', '4', '2002', '8', 'N'),
('993-004-00', 'My Life in Bits', 'John Smith', '1', '2001', '1', 'N'),
('9987-0039882', 'Shooting History', 'Jon Snow', '1', '2003', '1', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` decimal(3,0) DEFAULT NULL,
  `CategoryDescription` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryDescription`) VALUES
('1', 'Health'),
('2', 'Business'),
('3', 'Biography'),
('4', 'Technology'),
('5', 'Travel'),
('6', 'Self-Help'),
('7', 'Cookery'),
('8', 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `ISBN` varchar(14) DEFAULT NULL,
  `Username` varchar(40) DEFAULT NULL,
  `ReservedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`ISBN`, `Username`, `ReservedDate`) VALUES
('98234-029384', 'joecrotty', '2008-10-11'),
('9823-2403-0', 'tommy100', '2014-11-26'),
('23472-8729', 'tommy100', '2014-11-26'),
('23u8-923849', 'alanjmckenna', '2014-11-28'),
('093-403992', 'SJ', '2014-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Username` varchar(40) NOT NULL,
  `Password` varchar(6) NOT NULL,
  `FirstName` varchar(40) DEFAULT NULL,
  `Surname` varchar(40) DEFAULT NULL,
  `AddressLine1` varchar(100) DEFAULT NULL,
  `AddressLine2` varchar(40) DEFAULT NULL,
  `City` varchar(40) DEFAULT NULL,
  `Telephone` decimal(10,0) DEFAULT NULL,
  `Mobile` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Password`, `FirstName`, `Surname`, `AddressLine1`, `AddressLine2`, `City`, `Telephone`, `Mobile`) VALUES
('alanjmckenna', 't1234s', 'Alan', 'McKenna', '38 Cranley Road', 'Fairview', 'Dublin', '9998377', '856625567'),
('joecrotty', 'kj7899', 'Joseph', 'Crotty', 'Apt 5 Clyde Road', 'Donnybrook', 'Dublin', '8887889', '876654456'),
('tommy100', '123456', 'tom', 'behan', '14 hyde road', 'dalkey', 'dublin', '9983747', '876738782'),
('SJ', '123456', 'Sean', 'Jennings', '29 Westbourne Lodge', 'Templeogue', 'Dublin', '1111111', '2222222222');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
