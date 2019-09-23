-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 16 May 2018, 09:37:33
-- Sunucu sürümü: 5.7.21
-- PHP Sürümü: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `online_quiz`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `confirmation`
--

DROP TABLE IF EXISTS `confirmation`;
CREATE TABLE IF NOT EXISTS `confirmation` (
  `StudentID` int(11) DEFAULT NULL,
  `LectureID` int(11) DEFAULT NULL,
  `inConfirm` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `inReply` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `confirmation`
--

INSERT INTO `confirmation` (`StudentID`, `LectureID`, `inConfirm`, `ID`, `inReply`) VALUES
(2, 13, 1, 17, 1),
(10, 13, 0, 18, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `createdquizes`
--

DROP TABLE IF EXISTS `createdquizes`;
CREATE TABLE IF NOT EXISTS `createdquizes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `LectureId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `createquiz`
--

DROP TABLE IF EXISTS `createquiz`;
CREATE TABLE IF NOT EXISTS `createquiz` (
  `QuestionsID` int(11) NOT NULL,
  `ExamID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `inTopicID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `createquiz`
--

INSERT INTO `createquiz` (`QuestionsID`, `ExamID`, `UserID`, `ID`, `StartDate`, `EndDate`, `inTopicID`) VALUES
(39, 13, 1, 118, '2018-05-08 00:00:00', '2018-05-08 00:00:00', 2),
(34, 13, 1, 128, '2018-05-10 00:00:00', '2018-05-10 00:00:00', 1),
(81, 13, 1, 129, '2018-05-10 00:00:00', '2018-05-10 00:00:00', 1),
(37, 13, 1, 130, '2018-05-10 00:00:00', '2018-05-10 00:00:00', 1),
(35, 13, 1, 131, '2018-05-10 00:00:00', '2018-05-10 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `Name` varchar(50) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `department`
--

INSERT INTO `department` (`Name`, `ID`) VALUES
('Computer Engineering', 1),
('Industrial Engineering', 2),
('Electrical Engineering', 3),
('Civil Engineering', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `exams`
--

DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
  `ID` int(11) NOT NULL,
  `ExampleExp` varchar(100) DEFAULT NULL,
  `LectureID` int(11) NOT NULL,
  PRIMARY KEY (`LectureID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `imgquestions`
--

DROP TABLE IF EXISTS `imgquestions`;
CREATE TABLE IF NOT EXISTS `imgquestions` (
  `QuestionsID` int(11) NOT NULL,
  `img` longblob NOT NULL,
  `stImgName` varchar(500) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `imgquestions`
--

INSERT INTO `imgquestions` (`QuestionsID`, `img`, `stImgName`, `ID`) VALUES
(3, '', 'WhatsApp Image 2018-04-14 at 00.10.48.jpeg', 1),
(4, '', 'WhatsApp Image 2018-04-14 at 00.10.48.jpeg', 2),
(5, '', 'WhatsApp Image 2017-10-06 at 19.38.03.jpeg', 3),
(6, '', 'WhatsApp Image 2017-10-06 at 19.36.10.jpeg', 4),
(7, '', 'WhatsApp Image 2017-10-06 at 19.38.03.jpeg', 5),
(8, '', 'WhatsApp Image 2017-10-06 at 19.36.06.jpeg', 6),
(9, '', 'WhatsApp Image 2017-10-06 at 19.38.01.jpeg', 7),
(16, '', 'WhatsApp Image 2017-10-06 at 19.38.01.jpeg', 8),
(17, '', 'WhatsApp Image 2017-10-06 at 19.36.10.jpeg', 9),
(32, '', 'im_your_wallpaper_and_i_love_you-wallpaper-1440x900.jpg', 10),
(34, '', 'WhatsApp Image 2018-04-14 at 00.10.48.jpeg', 11),
(35, '', 'WhatsApp Image 2017-10-06 at 19.38.03.jpeg', 12),
(36, '', 'WhatsApp Image 2018-04-14 at 00.10.48.jpeg', 13),
(43, '', 'WhatsApp Image 2018-04-14 at 00.10.48.jpeg', 14),
(44, '', 'WhatsApp Image 2017-10-06 at 19.38.03.jpeg', 15),
(65, '', '9329fae0-e9c3-11e7-9874-f23c9128fa47.jpg', 16),
(83, '', '74a729d1-e9c2-11e7-9874-f23c9128fa47.jpg', 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lecture`
--

DROP TABLE IF EXISTS `lecture`;
CREATE TABLE IF NOT EXISTS `lecture` (
  `ID` int(11) NOT NULL,
  `LectureID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`LectureID`,`StudentID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lecturepf`
--

DROP TABLE IF EXISTS `lecturepf`;
CREATE TABLE IF NOT EXISTS `lecturepf` (
  `ID` int(11) NOT NULL,
  `LectureID` int(11) NOT NULL,
  `ProfsID` int(11) NOT NULL,
  PRIMARY KEY (`LectureID`,`ProfsID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lectures`
--

DROP TABLE IF EXISTS `lectures`;
CREATE TABLE IF NOT EXISTS `lectures` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `lectures`
--

INSERT INTO `lectures` (`ID`, `DepartmentId`, `Name`) VALUES
(1, 1, 'CS101'),
(2, 1, 'CS102'),
(3, 1, 'CS103'),
(7, 2, 'EE101'),
(8, 2, 'EE102'),
(9, 2, 'EE103'),
(10, 3, 'IE101'),
(11, 3, 'IE102'),
(12, 3, 'IE103'),
(13, 4, 'CE101'),
(14, 4, 'CE102'),
(15, 4, 'CE103'),
(16, 2, 'TEST');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pending`
--

DROP TABLE IF EXISTS `pending`;
CREATE TABLE IF NOT EXISTS `pending` (
  `ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `profs`
--

DROP TABLE IF EXISTS `profs`;
CREATE TABLE IF NOT EXISTS `profs` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `profs`
--

INSERT INTO `profs` (`ID`, `Name`, `UserName`, `Password`) VALUES
(1, 'Tarek Khalifa', 'tarek.khalifa@antalya.edu.tr', '123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LectureID` int(11) NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Option1` varchar(255) NOT NULL,
  `Option2` varchar(255) NOT NULL,
  `Option3` varchar(255) NOT NULL,
  `Option4` varchar(255) NOT NULL,
  `Option5` varchar(255) NOT NULL,
  `Type` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `TrueOption` varchar(225) DEFAULT NULL,
  `inTopicID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `questions`
--

INSERT INTO `questions` (`ID`, `LectureID`, `Question`, `Option1`, `Option2`, `Option3`, `Option4`, `Option5`, `Type`, `CreatedBy`, `TrueOption`, `inTopicID`) VALUES
(34, 13, 'jfahkshb', 'hg', 'ssd', 'khk', 'jhg', 'hoi', 1, 1, 'a', 1),
(35, 13, 'd,fnbskbdkja', 'ds,fndkjnfs', 'djfhsj', 'dhsjf', 'jhgh', 'iui', 1, 1, 'c', 1),
(36, 13, 'dfsjkbdkfbs', 'j', 'h', 'jh', 'hi', 'h', 1, 1, 'd', 1),
(37, 13, 'dbfksdkbfsjd', 'dfs', 'sdfsd', 'dfs', 'dfs', 'sdfs', 2, 1, 'b', 1),
(38, 13, 'dkjfhsehfsl', 'uyu', 'JH', 'JLJ', 'HJG', 'HV', 2, 1, 'e', 1),
(39, 13, 'DNLSFJDFKJSBDKJS', 'hgk', 'kl', 'ljkn', 'jb', 'jkbjbk', 2, 1, 'a', 2),
(40, 13, 'dnfbskhb', 'kb', 'hjv', 'kb', 'hv', 'y', 0, 1, 'c', 2),
(41, 13, 'sadkjbkajsbdka', 'hb', 'h', 'hb', 'hb', 'h', 0, 1, 'd', 2),
(42, 13, 'jkahksakdbkbkb', 'j', 'j', 'j', 'j', 'j', 0, 1, 'e', 2),
(43, 14, 'asbdfkabk', 'bk', 'jb', 'kjb', 'kb', 'kj', 1, 1, 'c', NULL),
(44, 14, 'd,fsbkjbdhfs', 'kjb', 'kjb', 'jkb', 'kj', 'bj', 1, 1, 'a', NULL),
(45, 14, 'dmbnfskjd', 'kbh', 'h', 'h', 'h', 'h', 1, 1, 'b', NULL),
(46, 14, 'nbsdhkjabsdhkav', 'bh', 'bh', 'bh', 'h', 'vg', 2, 1, 'e', NULL),
(47, 14, 'dfnbsjhvdj', 'gv', 'g', 'cf', 'c', 'rc', 2, 1, 'e', NULL),
(48, 14, 'adshvagjsv', 'hvhg', 'v', 'h', 'vh', 'bj', 2, 1, 'd', NULL),
(49, 14, 'dfbshvsfjvj', 'bhj', 'bh', 'v', 'hv', 'jk', 0, 1, 'a', NULL),
(50, 14, 'asjkbdakhsvk', 'kh', 'hb', 'kb', 'h', 'bk', 0, 1, 'c', NULL),
(51, 14, 'safkhdahj', 'bkh', 'bhk', 'bk', 'bk', 'b', 1, 1, 'a', NULL),
(52, 0, 'flfdmznld', 'df,djn', 'df', 'grr', 'bsvda', 'aefsgrdhf', 2, 1, 'e', NULL),
(53, 0, 'flfdmznld', 'df,djn', 'df', 'grr', 'bsvda', 'aefsgrdhf', 2, 1, NULL, NULL),
(54, 0, 'flfdmznld', 'df,djn', 'df', 'grr', 'bsvda', 'aefsgrdhf', 2, 1, NULL, NULL),
(55, 0, 'flfdmznld', 'df,djn', 'df', 'grr', 'bsvda', 'aefsgrdhf', 2, 1, NULL, NULL),
(56, 0, 'flfdmznld', 'df,djn', 'df', 'grr', 'bsvda', 'aefsgrdhf', 2, 1, NULL, NULL),
(57, 0, 'flfdmznld', 'df,djn', 'df', 'grr', 'bsvda', 'aefsgrdhf', 2, 1, NULL, NULL),
(58, 0, 'flfdmznld', 'df,djn', 'df', 'grr', 'bsvda', 'aefsgrdhf', 2, 1, NULL, NULL),
(59, 0, '', '', '', '', '', '', 0, 1, NULL, NULL),
(60, 0, ',zcn,', 'cs,', 'zf', 'dv', 'dgv', 'd', 0, 1, NULL, NULL),
(61, 0, '', 'fdsk', 'skksd', 'dkd', 'fls', 'fvlk', 2, 1, NULL, NULL),
(62, 0, '', 'fsadlk', 'dsfkl', 'df', 'sdksd', 'sfdlj', 0, 1, NULL, NULL),
(63, 0, 'kldkzfmlkdzsl', 'fsadlk', 'dsfkl', 'df', 'sdksd', 'sfdlj', 0, 1, NULL, NULL),
(64, 0, 'sdlm', 'szck', 'asd', 'fdz', 'vdz', 'df', 1, 1, NULL, NULL),
(65, 0, 'sdlm', 'szck', 'asd', 'fdz', 'vdz', 'df', 1, 1, NULL, NULL),
(66, 0, 'afdfadf', 'gsd', 'gfs', 'sgf', 'gsd', 'asdf', 2, 1, NULL, NULL),
(67, 0, 'afdfadf', 'gsd', 'gfs', 'sgf', 'gsd', 'asdf', 2, 1, NULL, NULL),
(68, 0, '', '', '', '', '', '', 0, 1, NULL, NULL),
(69, 0, 'fds', 'f', 'fsd', 'gxsd', 'sdg', 'sd', 0, 1, NULL, NULL),
(70, 0, 'fds', 'f', 'fsd', 'gxsd', 'sdg', 'sd', 0, 1, NULL, NULL),
(71, 0, 'sg', 'srgssv', 'gsrgrsg', 'gcgch', 'cyjyuj', 'ikikv', 0, 1, NULL, NULL),
(72, 0, 'zdmd', 'fsd', 'df', 'df', 'dg', 'gds', 0, 1, NULL, NULL),
(73, 0, '', '', '', '', '', '', 0, 1, NULL, NULL),
(74, 13, 'sdasd', 'sad', 'sa', 'asd', 'sad', 'sad', 0, 1, NULL, NULL),
(75, 0, '', '', '', '', '', '', 0, 1, NULL, NULL),
(76, 13, 'seqw', 'we', 'hjv', 'hv', 'jh', 'hv', 0, 1, NULL, NULL),
(77, 13, 'asdasd', 'hg', 'hg', 'k', 'khbh', 'bh', 0, 1, 'c', NULL),
(78, 13, 'asdaas', 'asdasd', 'asd', 'asda', 'sadasas', 'da', 2, 1, 'a', NULL),
(79, 13, 'asdaas', 'asdasd', 'asd', 'asda', 'sadasas', 'da', 2, 1, 'a', NULL),
(80, 13, 'asdfadfa', 'hv', 'kjh', 'jk', 'jk', 'bk', 1, 1, 'a', 4),
(81, 13, 'dasdasda', 'a', 'jhv', 'v', 'hh', 'vh', 0, 1, 'b', 1),
(82, 13, 'sfsf', '', '', '', '', '', 0, 1, 'c', 1),
(83, 13, 'ldsjfspfief', 'sdfsdsg', 'rgagf', 'dardhggrdf', 'yhrtyhtd', 'rgrfgr', 1, 1, 'e', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `selectedquestions`
--

DROP TABLE IF EXISTS `selectedquestions`;
CREATE TABLE IF NOT EXISTS `selectedquestions` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `QuizId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `studentreply`
--

DROP TABLE IF EXISTS `studentreply`;
CREATE TABLE IF NOT EXISTS `studentreply` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `inUserID` int(11) DEFAULT NULL,
  `inLectureID` int(11) DEFAULT NULL,
  `inQuestionID` int(11) DEFAULT NULL,
  `stReply` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `studentreply`
--

INSERT INTO `studentreply` (`ID`, `inUserID`, `inLectureID`, `inQuestionID`, `stReply`) VALUES
(36, 2, 13, 39, 'a'),
(37, 2, 13, 34, 'b'),
(38, 2, 13, 81, 'c'),
(39, 2, 13, 37, 'd'),
(40, 2, 13, 35, 'e');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Department` int(20) DEFAULT NULL,
  `Class` int(10) DEFAULT NULL,
  `Gsm` varchar(15) DEFAULT NULL,
  `UserName` varchar(20) DEFAULT NULL,
  `Passwords` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(200) DEFAULT NULL,
  `UserType` int(11) DEFAULT NULL,
  `inConfirm` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`uid`, `user`, `pass`, `email`, `profile_photo`, `UserType`, `inConfirm`) VALUES
(1, 'phpzag', 'test', 'test@phpzag.com', NULL, 0, 1),
(2, 'Test Student', 'test1', 'php@student.com', '', 1, 1),
(3, 'ADMIN', 'adm', 'admin@antalya.edu.tr', '', -1, -1),
(4, 'test user', '1', 'test@test1.asd', '', 0, 0),
(10, 'tweykn', 'Kartal94', 'bilal.oskar@std.antalya.edu.tr', NULL, 1, 1),
(11, 'vandals44', '123456', 'baris.gokalp@std.antalya.edu.tr', NULL, 1, 1),
(12, 'Cemms', '123', 'cemre.ayik@std.antalya.edu.tr', NULL, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
