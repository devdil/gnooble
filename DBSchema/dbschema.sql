-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2015 at 06:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `autocode`
--

-- --------------------------------------------------------

--
-- Table structure for table `PracticeQuestions`
--

CREATE TABLE IF NOT EXISTS `PracticeQuestions` (
`questionId` int(11) NOT NULL,
  `questionName` text NOT NULL,
  `questionStatement` longtext NOT NULL,
  `difficulty` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PracticeQuestions`
--

INSERT INTO `PracticeQuestions` (`questionId`, `questionName`, `questionStatement`, `difficulty`, `UserId`) VALUES
(20, 'Test1', 'Write a code that will output the input as you receive to the standard terminal.The test cases will be separated by new lines.There is 1 test case for this problemExample:TestCase 1Input:1 2 3 4 5 6 7 8 9Output:1 2 3 4 5 6 7 8 9The integers will be separated by space.', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Scoreboard`
--

CREATE TABLE IF NOT EXISTS `Scoreboard` (
  `questionId` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `SourceCode` longtext NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Scoreboard`
--

INSERT INTO `Scoreboard` (`questionId`, `Status`, `SourceCode`, `UserId`) VALUES
(20, 'Solved', '#include<stdio.h>\r\nint main()\r\n{\r\nint i,j;\r\nscanf("%d",&i);\r\nwhile(i)\r\n{\r\nscanf("%d",&j);\r\nprintf("%d%d\\n",j);\r\ni = i-1;\r\n}return 0;\r\n}', 2);

-- --------------------------------------------------------

--
-- Table structure for table `TestCases`
--

CREATE TABLE IF NOT EXISTS `TestCases` (
  `qid` int(11) NOT NULL,
`tid` int(11) NOT NULL,
  `inputCase` longtext NOT NULL,
  `outputCase` longtext NOT NULL,
  `isSample` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TestCases`
--

INSERT INTO `TestCases` (`qid`, `tid`, `inputCase`, `outputCase`, `isSample`) VALUES
(20, 1, '9\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9', '1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9', 'Y'),
(20, 2, '11\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11', '1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `UserDetails`
--

CREATE TABLE IF NOT EXISTS `UserDetails` (
  `Name` varchar(200) NOT NULL,
  `EmailId` varchar(100) NOT NULL,
  `Department` varchar(25) NOT NULL,
  `ContactNumber` varchar(100) NOT NULL,
  `Type` varchar(2) NOT NULL,
  `Password` varchar(200) NOT NULL,
`UserId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserDetails`
--

INSERT INTO `UserDetails` (`Name`, `EmailId`, `Department`, `ContactNumber`, `Type`, `Password`, `UserId`) VALUES
('diljit', 'diljitpr@gmail.com', 'CSE', '9836124922', 'T', '123456', 1),
('test', 'test@gmail.com', 'CSE', '9903423072', 'S', '123456', 2),
('Arshad', 'arshad2012@gmail.com', 'CSE', '4545454545', 'S', '4545454', 16),
('dsfsdf', 'kkklklkl', 'CSE', 'klklklkl', 'S', 'lklklklkl', 35),
('fdsfsd', 'fsdkfsd', 'CSE', 'fksdlfklkl', 'S', 'kfldskflkl', 36),
('dsfsdf', 'fdsfdds', 'CSE', 'fdsfsdfq', 'S', 'dsfsdf', 37),
('fsdfsdf', 'fdsfsd', 'CSE', 'fsdfa', 'S', 'fdsfsdfsd', 38),
('ddsf', 'fdsfsdfsd', 'CSE', 'fsdfsdfs', 'S', 'fsdfsdfsdfs', 39),
('vfdf', 'fdsfdf', 'CSE', 'fesdfdf', 'S', 'fdsfdsfds', 40),
('fgdgdfg', 'gdfgfdqgrdfg', 'CSE', 'gfgdfh', 'S', 'rdfgdfg', 41),
('dsadsad', 'sdfsdf', 'CSE', 'fsdfsdfsdxs', 'S', 'fsdfsdfsdf', 42),
('dsdsd', 'klkllklkl', 'CSE', 'lklklklkklk', 'S', 'klklklklklkl', 43),
('asdsd', 'fsdfsdf', 'CSE', 'fdsfdsfds', 'S', 'dfsfdsfsdf', 44);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `PracticeQuestions`
--
ALTER TABLE `PracticeQuestions`
 ADD PRIMARY KEY (`questionId`), ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `Scoreboard`
--
ALTER TABLE `Scoreboard`
 ADD PRIMARY KEY (`questionId`,`UserId`), ADD KEY `UserId` (`UserId`), ADD KEY `UserId_2` (`UserId`);

--
-- Indexes for table `TestCases`
--
ALTER TABLE `TestCases`
 ADD PRIMARY KEY (`tid`), ADD KEY `qid` (`qid`);

--
-- Indexes for table `UserDetails`
--
ALTER TABLE `UserDetails`
 ADD PRIMARY KEY (`UserId`), ADD UNIQUE KEY `ContactNumber` (`ContactNumber`), ADD UNIQUE KEY `UserId` (`UserId`), ADD UNIQUE KEY `EmailId_2` (`EmailId`,`ContactNumber`), ADD UNIQUE KEY `EmailId_3` (`EmailId`,`ContactNumber`), ADD UNIQUE KEY `UserId_2` (`UserId`), ADD KEY `Password` (`Password`), ADD KEY `EmailId` (`EmailId`), ADD KEY `UserId_3` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `PracticeQuestions`
--
ALTER TABLE `PracticeQuestions`
MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `TestCases`
--
ALTER TABLE `TestCases`
MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `UserDetails`
--
ALTER TABLE `UserDetails`
MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `PracticeQuestions`
--
ALTER TABLE `PracticeQuestions`
ADD CONSTRAINT `PracticeQuestions_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `UserDetails` (`UserId`);

--
-- Constraints for table `Scoreboard`
--
ALTER TABLE `Scoreboard`
ADD CONSTRAINT `Scoreboard_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `UserDetails` (`UserId`);

--
-- Constraints for table `TestCases`
--
ALTER TABLE `TestCases`
ADD CONSTRAINT `TestCases_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `PracticeQuestions` (`questionId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;