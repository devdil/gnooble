-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2015 at 08:58 AM
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
-- Table structure for table `Challenge`
--

CREATE TABLE IF NOT EXISTS `Challenge` (
`cId` int(11) NOT NULL,
  `cName` longtext NOT NULL,
  `cDesc` longtext NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `Type` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Challenge`
--

INSERT INTO `Challenge` (`cId`, `cName`, `cDesc`, `startDate`, `endDate`, `Type`, `userId`) VALUES
(13, 'ram', 'ram', '2015-03-05 14:30:33', '2015-03-07 12:25:26', 'cgf', 22),
(14, 'lalala', '&lt;p&gt;lll&lt;/p&gt;', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Contest', 22),
(15, 'lop', '&lt;p&gt;lop&lt;/p&gt;', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Contest', 22),
(16, 'aa', '&lt;p&gt;aa&lt;/p&gt;', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Contest', 22),
(17, 'diljit', '&lt;p&gt;diljit&lt;/p&gt;', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Contest', 22),
(18, 'lop', '&lt;p&gt;lop&lt;/p&gt;', '2015-03-08 12:17:00', '2015-03-08 12:17:00', 'Contest', 22);

-- --------------------------------------------------------

--
-- Table structure for table `ChallengeQuestions`
--

CREATE TABLE IF NOT EXISTS `ChallengeQuestions` (
  `cId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ChallengeQuestions`
--

INSERT INTO `ChallengeQuestions` (`cId`, `questionId`) VALUES
(13, 43);

-- --------------------------------------------------------

--
-- Table structure for table `PracticeQuestions`
--

CREATE TABLE IF NOT EXISTS `PracticeQuestions` (
`questionId` int(11) NOT NULL,
  `questionName` text NOT NULL,
  `questionStatement` longtext NOT NULL,
  `difficulty` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `isPrivate` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PracticeQuestions`
--

INSERT INTO `PracticeQuestions` (`questionId`, `questionName`, `questionStatement`, `difficulty`, `UserId`, `isPrivate`) VALUES
(31, 'EasyAsPie', '&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Alice and Bob are great friends.Alice has recently been introducted to computer Programming and is eager to introduce Bob the fun of programming.To make things interesting,Alice decided to teach BOB programming in a different way.Alice wants BOB to write a program which would&lt;strong&gt;&lt;em&gt; increment a number given by Alice and print them back on the screen.&lt;/em&gt;&lt;/strong&gt;Its so simple as it could get.However BOB is so lazy to write a program now.So ,he wants you to write a program for him.Help Bob to write a program.The format in which Alice will be giving numbers to BOB will be in the following way.&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;First Line&lt;/strong&gt; will be an integer &lt;strong&gt;''T''&lt;/strong&gt; representing the sets of &amp;nbsp;number Alice will be giving.(TestCases)&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Second Line&lt;/strong&gt; will be an integer &lt;strong&gt;''N''&lt;/strong&gt; representing the numbers of size N followed by&lt;strong&gt; 1...N numbers&lt;/strong&gt; each number seperated by a new line.&lt;/p&gt;\r\n&lt;p&gt;Each number ''I'' may be anywhere between&lt;strong&gt; 1&amp;lt;= I &amp;lt;= 1000&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Note : Make sure you print a newline after you increment and print the number on the screen.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;h3&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;Input Format&lt;/span&gt;&lt;/h3&gt;\r\n&lt;p&gt;2&lt;/p&gt;\r\n&lt;p&gt;3&lt;/p&gt;\r\n&lt;p&gt;1&lt;/p&gt;\r\n&lt;p&gt;2&lt;/p&gt;\r\n&lt;p&gt;5&lt;/p&gt;\r\n&lt;p&gt;1&lt;/p&gt;\r\n&lt;p&gt;9&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;h3&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;Output Format&lt;/span&gt;&lt;/h3&gt;\r\n&lt;p&gt;2&lt;/p&gt;\r\n&lt;p&gt;3&lt;/p&gt;\r\n&lt;p&gt;6&lt;/p&gt;\r\n&lt;p&gt;10&lt;/p&gt;\r\n&lt;h3&gt;&amp;nbsp;&lt;/h3&gt;\r\n&lt;h3&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Explanation :&lt;/strong&gt;&lt;/span&gt;&lt;/h3&gt;\r\n&lt;p&gt;2 is the number of the testcases.&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;First test case: &lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;3 is the size of the numbers which Alice will be giving followed by 3 numbers. which are 1 ,2 and 5 respectively.&lt;/p&gt;\r\n&lt;p&gt;According to the Alice,the expected output will be 2,3 and 6 since 2=(1+1),3=(2+1) and 6 =(5+!1).&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Second Test Case :&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 is the size of the numbers which Alice will be giving followed by 1 number. which is &amp;nbsp;10&lt;/p&gt;\r\n&lt;p&gt;Since 10 = (9+1).&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 20, 22, 'N'),
(32, 'Hello World', '&lt;h4&gt;Write a program that prints &quot;Hello World!&quot; &amp;nbsp;N times where ''N'' is an integer that lies between 1&amp;lt;=N&amp;lt;=1000.Each &quot;Hello World!&quot; must be seperated by a new Line&lt;/h4&gt;\r\n&lt;h4&gt;First Line will be an integer n where 1&amp;lt;= N and &amp;lt;=1000,specifiying the number of times &quot;Hello World!&quot; has to be printed!&lt;/h4&gt;\r\n&lt;h4&gt;&amp;nbsp;&lt;/h4&gt;\r\n&lt;h2&gt;&lt;strong&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;Input Format&lt;/span&gt;&lt;/strong&gt;&lt;/h2&gt;\r\n&lt;h4&gt;5&lt;/h4&gt;\r\n&lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Output Format&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;\r\n&lt;h4&gt;Hello World!&lt;/h4&gt;\r\n&lt;h4&gt;Hello World!&lt;/h4&gt;\r\n&lt;h4&gt;Hello World!&lt;/h4&gt;\r\n&lt;h4&gt;Hello World!&lt;/h4&gt;\r\n&lt;h4&gt;Hello Wordl!&lt;/h4&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Explanation :&lt;/strong&gt;&lt;/span&gt;&lt;/h2&gt;\r\n&lt;h4&gt;From the given input 5 is the number of times to be printed,&quot;Hello World!&quot; has been printed 5 times each seperated by new Line.&lt;/h4&gt;\r\n&lt;h4&gt;&amp;nbsp;&lt;/h4&gt;', 20, 22, 'N'),
(37, 'oLLAA', '&lt;h2&gt;&lt;strong&gt;OLLAAAA&lt;/strong&gt;&lt;/h2&gt;', 20, 22, 'Y'),
(38, 'pola', '&lt;p&gt;pola&lt;/p&gt;', 20, 22, 'Y'),
(39, 'aaa', '&lt;p&gt;aaaaa&lt;/p&gt;', 20, 22, 'Y'),
(40, 'lop', '&lt;p&gt;lop&lt;/p&gt;', 20, 22, 'Y'),
(41, 'aa', '&lt;p&gt;aa&lt;/p&gt;', 20, 22, 'Y'),
(42, 'potla', '&lt;p&gt;potla&lt;/p&gt;', 20, 22, 'Y'),
(43, 'ram', '&lt;p&gt;ram&lt;/p&gt;', 20, 22, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `Scoreboard`
--

CREATE TABLE IF NOT EXISTS `Scoreboard` (
  `questionId` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `SourceCode` longtext,
  `UserId` int(11) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `Time` varchar(200) NOT NULL,
  `Memory` varchar(200) NOT NULL,
  `charsInCode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Scoreboard`
--

INSERT INTO `Scoreboard` (`questionId`, `Status`, `SourceCode`, `UserId`, `startTime`, `endTime`, `Time`, `Memory`, `charsInCode`) VALUES
(31, 'Attempted', '#Your Solution Here\nx = int(raw_input())\nfor x in range(x):\n    print "Hello World!\\n"', 1, '2015-02-07 19:17:38', '0000-00-00 00:00:00', 'NA', 'NA', NULL),
(31, 'Attempted', NULL, 23, '2015-02-08 18:49:29', '0000-00-00 00:00:00', '', '', NULL),
(32, 'Solved', '#include<stdio.h>\nint main()\n{\n//Your Code Here\n\n printf("Hello World\\nHello World\\nHello World\\n");\n return 0;\n}  ', 1, '2015-02-09 14:58:34', '2015-03-12 22:12:07', '0', '9360000', NULL),
(32, 'Attempted', NULL, 25, '2015-02-10 21:33:45', '0000-00-00 00:00:00', '', '', NULL),
(32, 'Attempted', NULL, 26, '2015-02-10 22:36:14', '0000-00-00 00:00:00', '', '', NULL),
(32, 'Attempted', NULL, 27, '2015-02-13 14:34:31', '0000-00-00 00:00:00', '', '', NULL),
(37, 'Attempted', '#include<stdio.h>\n int main()\n{\n//Your Code Here\n\nkdkdkdkdkd\n return 0;\n} ', 1, '2015-03-01 17:43:57', '0000-00-00 00:00:00', 'NA', 'NA', NULL),
(38, 'Attempted', NULL, 1, '2015-03-01 17:43:52', '0000-00-00 00:00:00', '', '', NULL),
(43, 'Attempted', '#include<stdio.h>\n int main()\n{\n//Your Code Here\n\n\n return 0;\n} ', 1, '2015-03-05 17:21:54', '0000-00-00 00:00:00', 'NA', 'NA', 64);

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TestCases`
--

INSERT INTO `TestCases` (`qid`, `tid`, `inputCase`, `outputCase`, `isSample`) VALUES
(31, 9, '2\n3\n1\n2\n5\n1\n9', '2\n3\n6\n10', 'Y'),
(31, 10, '2\n3\n1\n2\n5\n1\n9', '2\n3\n6\n10', 'N'),
(31, 11, '2\n3\n1\n2\n5\n1\n9', '2\n3\n6\n10', 'N'),
(32, 12, '3', 'Hello World\nHello World\nHello World', 'Y'),
(37, 17, '1\n2\n3', '1\n2\n3', 'Y'),
(38, 18, '1\n2\n3', '1\n2\n3', 'Y'),
(39, 19, '12345', '12345', 'Y'),
(40, 20, '123', '123', 'Y'),
(41, 21, 'aa', 'aa', 'Y'),
(42, 22, 'potal', 'potal', 'Y'),
(43, 23, 'ram', 'ram', 'Y'),
(32, 24, '5', 'Hello World\nHello World\nHello World\nHello World\nHello World\n', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `UserDetails`
--

CREATE TABLE IF NOT EXISTS `UserDetails` (
  `Name` varchar(200) NOT NULL,
  `EmailId` varchar(100) NOT NULL,
  `Department` varchar(25) NOT NULL,
  `Type` varchar(2) NOT NULL,
  `Password` varchar(200) NOT NULL,
`UserId` int(11) NOT NULL,
  `ContactNumber` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserDetails`
--

INSERT INTO `UserDetails` (`Name`, `EmailId`, `Department`, `Type`, `Password`, `UserId`, `ContactNumber`) VALUES
('Diljit', 'diljitpr@gmail.com', 'CSE', 'S', 'diljit123', 1, '8335974888'),
('admin', 'admin@gmail.com', 'CSE', 'T', '9903423072', 22, '123'),
('Arshad', 'arshad2012@gmail.com', 'CSE', 'S', 'arshad123', 23, '8981892663'),
('Anirban', 'anirbannag@gmail.com', 'CSE', 'S', '14300', 24, '8981330442'),
('abdev', 'addev@gmail.com', 'CSE', 'S', 'diljit123', 25, '78787878'),
('Tony', 'tony@gmail.com', 'CSE', 'S', '14300', 26, '8335974888'),
('Arshad', 'arshad01@gmail.com', 'CSE', 'S', 'nokia430', 27, '8981892663');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Challenge`
--
ALTER TABLE `Challenge`
 ADD PRIMARY KEY (`cId`), ADD KEY `userId` (`userId`);

--
-- Indexes for table `ChallengeQuestions`
--
ALTER TABLE `ChallengeQuestions`
 ADD PRIMARY KEY (`questionId`), ADD KEY `cId` (`cId`);

--
-- Indexes for table `PracticeQuestions`
--
ALTER TABLE `PracticeQuestions`
 ADD PRIMARY KEY (`questionId`), ADD KEY `UserId` (`UserId`), ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `Scoreboard`
--
ALTER TABLE `Scoreboard`
 ADD PRIMARY KEY (`questionId`,`UserId`), ADD KEY `UserId` (`UserId`), ADD KEY `UserId_2` (`UserId`), ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `TestCases`
--
ALTER TABLE `TestCases`
 ADD PRIMARY KEY (`tid`), ADD KEY `qid` (`qid`);

--
-- Indexes for table `UserDetails`
--
ALTER TABLE `UserDetails`
 ADD PRIMARY KEY (`UserId`), ADD UNIQUE KEY `EmailId_2` (`EmailId`), ADD UNIQUE KEY `EmailId_3` (`EmailId`), ADD UNIQUE KEY `UserId_2` (`UserId`), ADD KEY `Password` (`Password`), ADD KEY `EmailId` (`EmailId`), ADD KEY `UserId_3` (`UserId`), ADD KEY `EmailId_4` (`EmailId`), ADD KEY `EmailId_5` (`EmailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Challenge`
--
ALTER TABLE `Challenge`
MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `PracticeQuestions`
--
ALTER TABLE `PracticeQuestions`
MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `TestCases`
--
ALTER TABLE `TestCases`
MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `UserDetails`
--
ALTER TABLE `UserDetails`
MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Challenge`
--
ALTER TABLE `Challenge`
ADD CONSTRAINT `Challenge_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `UserDetails` (`UserId`);

--
-- Constraints for table `ChallengeQuestions`
--
ALTER TABLE `ChallengeQuestions`
ADD CONSTRAINT `ChallengeQuestions_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `Challenge` (`cId`),
ADD CONSTRAINT `ChallengeQuestions_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `PracticeQuestions` (`questionId`);

--
-- Constraints for table `PracticeQuestions`
--
ALTER TABLE `PracticeQuestions`
ADD CONSTRAINT `PracticeQuestions_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `UserDetails` (`UserId`);

--
-- Constraints for table `Scoreboard`
--
ALTER TABLE `Scoreboard`
ADD CONSTRAINT `Scoreboard_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `UserDetails` (`UserId`) ON UPDATE NO ACTION,
ADD CONSTRAINT `Scoreboard_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `PracticeQuestions` (`questionId`) ON UPDATE NO ACTION;

--
-- Constraints for table `TestCases`
--
ALTER TABLE `TestCases`
ADD CONSTRAINT `TestCases_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `PracticeQuestions` (`questionId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
