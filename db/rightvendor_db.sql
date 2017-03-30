-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2014 at 01:43 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rightvendor`
--
CREATE DATABASE IF NOT EXISTS `rightvendor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rightvendor`;

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rv_account_recovery`
--

CREATE TABLE IF NOT EXISTS `rv_account_recovery` (
  `RecoveryCode` varchar(64) NOT NULL DEFAULT '',
  `UserID` int(11) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `CreateTime` varchar(64) NOT NULL,
  `UpdateTime` varchar(64) NOT NULL,
  PRIMARY KEY (`RecoveryCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rv_city`
--

CREATE TABLE IF NOT EXISTS `rv_city` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_comment`
--

CREATE TABLE IF NOT EXISTS `rv_comment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Content` varchar(1000) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_gallery_image`
--

CREATE TABLE IF NOT EXISTS `rv_gallery_image` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL,
  `ColorTags` varchar(128) DEFAULT NULL,
  `ProjectID` int(11) NOT NULL,
  `IsFeatured` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_like`
--

CREATE TABLE IF NOT EXISTS `rv_like` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ImageID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `IPAddress` varchar(32) NOT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_message`
--

CREATE TABLE IF NOT EXISTS `rv_message` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Content` varchar(1000) NOT NULL,
  `ThreadID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `RecipientID` int(11) NOT NULL,
  `SenderID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_message_thread`
--

CREATE TABLE IF NOT EXISTS `rv_message_thread` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectID` int(11) NOT NULL,
  `User1` int(11) NOT NULL,
  `User2` int(11) NOT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_notification`
--

CREATE TABLE IF NOT EXISTS `rv_notification` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `ImageID` int(11) DEFAULT NULL,
  `GuestID` int(11) DEFAULT NULL,
  `VendorID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_price_list`
--

CREATE TABLE IF NOT EXISTS `rv_price_list` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Service` varchar(256) NOT NULL,
  `Description` text NOT NULL,
  `Budget` varchar(32) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_project`
--

CREATE TABLE IF NOT EXISTS `rv_project` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(64) NOT NULL,
  `Venue` varchar(64) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Permalink` varchar(100) DEFAULT NULL,
  `MainImage` int(11) DEFAULT NULL,
  `IsFeatured` int(11) NOT NULL DEFAULT '0',
  `TotalLikes` int(11) NOT NULL DEFAULT '0',
  `TotalViews` int(11) NOT NULL DEFAULT '0',
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_project_category`
--

CREATE TABLE IF NOT EXISTS `rv_project_category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_project_view`
--

CREATE TABLE IF NOT EXISTS `rv_project_view` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IPAddress` varchar(64) NOT NULL,
  `UserAgent` varchar(128) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_review`
--

CREATE TABLE IF NOT EXISTS `rv_review` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Content` varchar(1000) NOT NULL,
  `Rating` int(11) NOT NULL,
  `VendorID` int(11) NOT NULL,
  `AuthorID` int(11) NOT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_subject`
--

CREATE TABLE IF NOT EXISTS `rv_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_temp_user`
--

CREATE TABLE IF NOT EXISTS `rv_temp_user` (
  `ID` varchar(64) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Password` varchar(64) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '0',
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rv_user`
--

CREATE TABLE IF NOT EXISTS `rv_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Password` varchar(64) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT '0',
  `LastLoginTime` varchar(32) DEFAULT NULL,
  `CreateTime` varchar(64) NOT NULL,
  `UpdateTime` varchar(64) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `rv_user_profile`
--

CREATE TABLE IF NOT EXISTS `rv_user_profile` (
  `UserID` int(11) NOT NULL,
  `ProfilePic` varchar(64) DEFAULT NULL,
  `CreateTime` varchar(32) NOT NULL,
  `UpdateTime` varchar(32) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rv_vendor_profile`
--

CREATE TABLE IF NOT EXISTS `rv_vendor_profile` (
  `VendorID` int(11) NOT NULL,
  `BusinessName` varchar(64) DEFAULT NULL,
  `City` int(11) NOT NULL,
  `Category` int(11) NOT NULL,
  `Website` varchar(64) DEFAULT NULL,
  `Permalink` varchar(100) NOT NULL,
  `Email` varchar(64) DEFAULT NULL,
  `Phonenumber` varchar(64) DEFAULT NULL,
  `Address` varchar(1000) DEFAULT NULL,
  `IsFeatured` int(11) NOT NULL DEFAULT '0',
  `Status` int(11) DEFAULT '0',
  `CreateTime` varchar(64) NOT NULL,
  `UpdateTime` varchar(64) NOT NULL,
  PRIMARY KEY (`VendorID`),
  UNIQUE KEY `VendorID` (`VendorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
