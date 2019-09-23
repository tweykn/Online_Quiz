-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 24 May 2018, 10:10:29
-- Sunucu sürümü: 10.1.31-MariaDB
-- PHP Sürümü: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `Online_Quiz`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `confirmation`
--

CREATE TABLE `confirmation` (
  `StudentID` int(11) DEFAULT NULL,
  `LectureID` int(11) DEFAULT NULL,
  `inConfirm` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `inReply` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `confirmation`
--

INSERT INTO `confirmation` (`StudentID`, `LectureID`, `inConfirm`, `ID`, `inReply`) VALUES
(2, 13, 0, 20, 1),
(10, 13, 1, 22, 1),
(10, 14, 1, 24, 0),
(10, 15, 1, 25, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `createdquizes`
--

CREATE TABLE `createdquizes` (
  `Id` int(11) NOT NULL,
  `LectureId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `createquiz`
--

CREATE TABLE `createquiz` (
  `QuestionsID` int(11) NOT NULL,
  `ExamID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `inTopicID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `createquiz`
--

INSERT INTO `createquiz` (`QuestionsID`, `ExamID`, `UserID`, `ID`, `StartDate`, `EndDate`, `inTopicID`) VALUES
(88, 13, 1, 170, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 2),
(89, 13, 1, 171, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 2),
(90, 13, 1, 172, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 3),
(92, 13, 1, 173, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 3),
(85, 15, 1, 177, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 1),
(84, 14, 1, 179, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 1),
(85, 14, 1, 180, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 1),
(89, 14, 1, 183, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 2),
(87, 14, 1, 184, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 2),
(84, 13, 1, 185, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 1),
(86, 13, 1, 186, '2018-05-24 00:00:00', '2018-05-24 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `department`
--

CREATE TABLE `department` (
  `Name` varchar(50) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `exams` (
  `ID` int(11) NOT NULL,
  `ExampleExp` varchar(100) DEFAULT NULL,
  `LectureID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `imgquestions`
--

CREATE TABLE `imgquestions` (
  `QuestionsID` int(11) NOT NULL,
  `img` longblob NOT NULL,
  `stImgName` varchar(500) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `imgquestions`
--

INSERT INTO `imgquestions` (`QuestionsID`, `img`, `stImgName`, `ID`) VALUES
(84, '', 'dsa-q36(2).png', 18),
(86, '', 'dsa-q36(2)ads.png', 19),
(88, '', 'dsa-q28(2)wda.png', 20),
(90, '', 'dsa-q18(2)adkqwsd.png', 21);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lecture`
--

CREATE TABLE `lecture` (
  `ID` int(11) NOT NULL,
  `LectureID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lecturepf`
--

CREATE TABLE `lecturepf` (
  `ID` int(11) NOT NULL,
  `LectureID` int(11) NOT NULL,
  `ProfsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lectures`
--

CREATE TABLE `lectures` (
  `ID` int(11) NOT NULL,
  `DepartmentId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `pending` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `profs`
--

CREATE TABLE `profs` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL
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

CREATE TABLE `questions` (
  `ID` int(11) NOT NULL,
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
  `inTopicID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `questions`
--

INSERT INTO `questions` (`ID`, `LectureID`, `Question`, `Option1`, `Option2`, `Option3`, `Option4`, `Option5`, `Type`, `CreatedBy`, `TrueOption`, `inTopicID`) VALUES
(84, 13, 'Suppose you have a directed graph representing all the flights that an airline flies. What algorithm might be used to find the best sequence of connections from one city to another?', 'A shortest-path algorithm', 'A minimum spanning tree algorithm.', 'Breadth first search', 'Depth first search.', 'A * search', 1, 1, 'a', 1),
(85, 13, 'Suppose cursor points to a node in a linked list (using the node definition with member functions called data and link). What Boolean expression will be true when cursor points to the tail node of the list?', '(cursor->link( ) == NULL)', '(cursor->data( ) == 0.0)', '(cursor->data( ) == NULL)', '(cursor == NULL)', 'None', 2, 1, 'd', 1),
(86, 13, 'Which of the following represents the sequence of nodes visited in a post-order traversal of the binary tree T shown below?', 'U X Z Q W Y V P', 'X Z U W Y Q V P', 'U X W Q Z Y V P', 'U Q X W P V Z Y', 'U Y X V P V Z Y', 0, 1, 'b', 1),
(87, 13, 'What does a run-time analysis usually count?', 'The number of arithmetic and other operations required for the program to run', 'The number of seconds plus the number of megabytes', 'The number of seconds required for the program to run', 'The number of megabytes required for the program to run', 'None', 0, 1, 'a', 2),
(88, 13, 'Figure 2 is the array representation of a binary tree shown in Figure 1. What should be put into the space \"a\"?', '3', '5', '4', '6', '2', 1, 1, 'e', 2),
(89, 13, 'Consider the following pseudo code: declare a stack of characters while ( there are more characters in the word to read ) { read a character push the character on the stack } while ( the stack is not empty ) { write the stack\'s top character to the screen', 'Ccaarrtteettss', 'Cartets', 'Serc', 'Stetrac', 'Steractes', 2, 1, 'c', 2),
(90, 13, 'Given a graph G in the box. What is the order of nodes visited using DFS, starting from node a', 'A b c d e f k g h i j l', 'A c b g l k h i j f e d', 'A f e d c k g b h i j l', 'A c d e f k b g h i j l', 'A c b e f l b t h i j l', 2, 1, 'a', 3),
(91, 13, 'Which of the following stack operations could result in stack underflow?', 'Top', 'Pop', 'Is_empty', 'Push', 'Not', 0, 1, 'd', 3),
(92, 13, 'Which of the following is an appropriate description concerning the list and/or array structures?', 'Using a subscript for each element in an array, quick access to any element can be achieved. The array structure allows any data to be inserted or deleted simply by modifying pointers.', 'he number of operations is fixed in inserting or deleting an element in an array; it does not depend on the position of the element in the array', 'The list structure is similar to the array structure in that all data elements of the same type are sequentially lined up. In the list structure, the logical arrangement is the same as the physical arrangement.', 'The list structure allows any data to be inserted or deleted simply by modifying pointers. But, after the data was deleted, the cells that contained the data remain as garbage in memory', 'But, after the data was deleted, the cells that contained the data remain as garbage in memory', 1, 1, 'd', 3),
(95, 15, 'Where did The Flowerpot Men want to go in 1967?', 'New York', 'San Francisco', 'Woodstock', 'Memphis', 'atlanta', 0, 1, 'b', 1),
(98, 14, 'Who wrote \"don\'t count your chickens before they are hatched\"?', 'Aesop', 'Shakespeare', 'Ben  Franklin', 'Chaucer', 'Ahmet arif', 0, 1, 'a', 1),
(99, 14, 'Which kind of animal did Florence Nightingale often carry around in her pocket?', 'Kitten', 'Puppy', 'Owl', 'Snake', 'Horse', 0, 1, 'c', 1),
(100, 14, 'Goodbye Farewell and Amen\' was the final episode of which TV series?', 'MASH', 'Dallas', 'Friends', 'The Muppet Show', 'How i met your mother', 1, 1, 'e', 2),
(101, 14, 'In which film do the words \"I love you\" save the planet earth?', 'The Day After Tomorrow', 'The 5th Element', 'Mars Attacks', 'Independence Day', 'Forest Gump', 1, 1, 'b', 2),
(102, 14, 'What is the name of the man servant in \'Around the world in 80 days\'?', 'Pas Partout', 'Cato', 'Giles', 'Machu Picchu', 'Nalry', 1, 1, 'c', 2),
(103, 14, 'Which actor appeared in the Cranberries music video Ridiculous Thought?', 'Bruce Willis', 'Donald Sutherland', 'George Clooney', 'Elijah Wood', 'Jude law', 2, 1, 'd', 2),
(104, 14, 'How many earths would fit inside the sun?', 'circa 100', 'circa 1,000,000', 'circa 10,000', 'circa 100,000', 'circa 100,000,000', 2, 1, 'b', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `selectedquestions`
--

CREATE TABLE `selectedquestions` (
  `Id` int(11) NOT NULL,
  `QuizId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `studentreply`
--

CREATE TABLE `studentreply` (
  `ID` int(11) NOT NULL,
  `inUserID` int(11) DEFAULT NULL,
  `inLectureID` int(11) DEFAULT NULL,
  `inQuestionID` int(11) DEFAULT NULL,
  `stReply` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `studentreply`
--

INSERT INTO `studentreply` (`ID`, `inUserID`, `inLectureID`, `inQuestionID`, `stReply`) VALUES
(36, 2, 13, 39, 'a'),
(37, 2, 13, 34, 'b'),
(38, 2, 13, 81, 'c'),
(39, 2, 13, 37, 'd'),
(40, 2, 13, 35, 'e'),
(41, 10, 13, 84, 'b'),
(42, 10, 13, 85, 'c'),
(43, 10, 13, 86, 'a'),
(44, 10, 13, 89, 'c'),
(45, 10, 13, 87, 'a'),
(46, 10, 13, 88, 'd'),
(47, 10, 13, 92, 'e'),
(48, 10, 13, 90, 'a'),
(49, 10, 13, 91, 'b'),
(50, 10, 13, 89, 'a'),
(51, 10, 13, 87, 'c'),
(52, 10, 13, 88, 'd'),
(53, 10, 13, 92, 'e'),
(54, 10, 13, 90, 'a'),
(55, 10, 13, 91, 'd'),
(56, 10, 13, 85, 'e'),
(57, 10, 13, 86, 'b'),
(58, 10, 13, 84, 'd'),
(59, 10, 13, 85, 'c'),
(60, 10, 13, 85, 'c'),
(61, 10, 13, 85, 'c'),
(62, 10, 13, 85, 'd'),
(63, 10, 13, 85, 'b'),
(64, 10, 13, 87, 'a'),
(65, 2, 13, 88, 'c'),
(66, 2, 13, 90, 'b'),
(67, 2, 13, 84, 'c');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Department` int(20) DEFAULT NULL,
  `Class` int(10) DEFAULT NULL,
  `Gsm` varchar(15) DEFAULT NULL,
  `UserName` varchar(20) DEFAULT NULL,
  `Passwords` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(200) DEFAULT NULL,
  `UserType` int(11) DEFAULT NULL,
  `inConfirm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 'Cemms', '123', 'cemre.ayik@std.antalya.edu.tr', NULL, 1, 1),
(15, 'bilal', '123', 'asdasd@asda.ofd', NULL, 1, 0),
(19, 'oguz', '123', 'info@oguzhanferli.com', NULL, 1, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `confirmation`
--
ALTER TABLE `confirmation`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `createdquizes`
--
ALTER TABLE `createdquizes`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `createquiz`
--
ALTER TABLE `createquiz`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`LectureID`),
  ADD KEY `ID` (`ID`);

--
-- Tablo için indeksler `imgquestions`
--
ALTER TABLE `imgquestions`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`LectureID`,`StudentID`),
  ADD KEY `ID` (`ID`);

--
-- Tablo için indeksler `lecturepf`
--
ALTER TABLE `lecturepf`
  ADD PRIMARY KEY (`LectureID`,`ProfsID`),
  ADD KEY `ID` (`ID`);

--
-- Tablo için indeksler `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `profs`
--
ALTER TABLE `profs`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `selectedquestions`
--
ALTER TABLE `selectedquestions`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `studentreply`
--
ALTER TABLE `studentreply`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `confirmation`
--
ALTER TABLE `confirmation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `createdquizes`
--
ALTER TABLE `createdquizes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `createquiz`
--
ALTER TABLE `createquiz`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- Tablo için AUTO_INCREMENT değeri `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `imgquestions`
--
ALTER TABLE `imgquestions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `lectures`
--
ALTER TABLE `lectures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Tablo için AUTO_INCREMENT değeri `selectedquestions`
--
ALTER TABLE `selectedquestions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `studentreply`
--
ALTER TABLE `studentreply`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
