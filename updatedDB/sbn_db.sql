-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2020 at 09:11 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sbn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `MemberId` int(11) NOT NULL AUTO_INCREMENT,
  `Mobile` varchar(10) NOT NULL,
  `MobileVerificationCode` varchar(10) NOT NULL,
  `MobileVerificationStatus` tinyint(1) NOT NULL,
  `MobileVerificationDate` datetime NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Location` varchar(300) DEFAULT NULL,
  `State` varchar(30) DEFAULT NULL,
  `City` varchar(30) DEFAULT NULL,
  `Country` varchar(20) DEFAULT NULL,
  `Profile_picture_path` varchar(300) DEFAULT NULL,
  `Occupation` varchar(30) DEFAULT NULL,
  `Headline` varchar(30) DEFAULT NULL,
  `facebook` varchar(30) DEFAULT NULL,
  `twitter` varchar(30) DEFAULT NULL,
  `linkedin` varchar(30) DEFAULT NULL,
  `whatsapp` varchar(30) DEFAULT NULL,
  `instagram` varchar(30) DEFAULT NULL,
  `youtube` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`MemberId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`MemberId`, `Mobile`, `MobileVerificationCode`, `MobileVerificationStatus`, `MobileVerificationDate`, `Password`, `FirstName`, `LastName`, `Status`, `CreatedOn`, `UpdatedOn`, `Email`, `Location`, `State`, `City`, `Country`, `Profile_picture_path`, `Occupation`, `Headline`, `facebook`, `twitter`, `linkedin`, `whatsapp`, `instagram`, `youtube`) VALUES
(1, '8866244488', '6816', 1, '2019-08-22 18:27:26', 'password', 'Muktesh', 'Bhavsar', 1, '2019-08-22 18:26:25', '2019-08-22 18:26:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '9427654743', '6134', 1, '2020-01-24 09:19:53', 'password', 'Ghanshyam', 'Pande', 1, '2020-01-24 09:18:50', '2020-01-24 09:18:50', 'ghanu@akshardham.com', 'Vadtal, Gujarat, India', 'Gujarat', 'Vadtal', 'India', 'profilepics/profile-image-png-14.png', 'empty', 'GOD', NULL, NULL, NULL, NULL, NULL, NULL),
(7, '7096810981', '1425', 1, '2020-01-25 22:59:30', 'password', 'Bhavesh', 'Soni', 1, '2020-01-25 22:12:59', '2020-01-25 22:12:59', 'bhaveshsoni@yahoo.com', 'Miami, California, USA', 'California', 'Miami', 'USA', 'profilepics/profile-image-png-8.png', 'BusinessOwner', 'Business Man', NULL, NULL, NULL, NULL, NULL, NULL),
(8, '9033755744', '4160', 1, '2020-02-05 21:48:32', 'password', 'Dharmik', 'Rajpara', 1, '2020-02-05 21:47:49', '2020-02-05 21:47:49', 'dharmiktatahitachi@gmail.com', 'Gandhi Nagar, Bengaluru, Karnataka, India', 'Karnataka', 'Bengaluru', 'India', '/profilepics/luminescence_by_4burakfe-dbhhltr.jpg', 'Employee', 'Tata Hitachi Sales Executive', NULL, NULL, NULL, NULL, NULL, NULL),
(9, '7874954971', '3466', 1, '2020-02-08 23:57:27', 'password', 'Sunny', 'Soni', 1, '2020-02-08 23:56:41', '2020-02-08 23:56:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '8866128862', '1393', 1, '2020-02-17 01:02:45', 'password', 'Vivek', 'Soni', 1, '2020-02-17 01:02:31', '2020-02-17 01:02:31', 'viveksoni100@gmail.com', 'Miami, FL, USA', 'FL', 'Miami', 'USA', 'profilepics/josephMRGN.jpg', 'BusinessOwner', 'The Original', 'vivek.barbhaya', 'viveksoni100', 'viveksoni100@outlook.com', '8866128862', 'viveksoni100', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
