-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2015 at 07:53 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `course_work`
--
CREATE DATABASE IF NOT EXISTS `course_work` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `course_work`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id_author` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица Автор' AUTO_INCREMENT=19 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id_author`, `name`) VALUES
(16, 'Исаева Олеся'),
(17, 'Чернега В.С.'),
(18, 'Платтнер Б.');

-- --------------------------------------------------------

--
-- Table structure for table `author_resource`
--

CREATE TABLE IF NOT EXISTS `author_resource` (
  `id_resource` int(10) NOT NULL,
  `id_author` int(10) NOT NULL,
  PRIMARY KEY (`id_resource`,`id_author`),
  KEY `id_resource` (`id_resource`),
  KEY `id_author` (`id_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Промежуточная таблица Автор-Ресурс';

--
-- Dumping data for table `author_resource`
--

INSERT INTO `author_resource` (`id_resource`, `id_author`) VALUES
(29, 16),
(30, 17),
(30, 18);

-- --------------------------------------------------------

--
-- Table structure for table `direction`
--

CREATE TABLE IF NOT EXISTS `direction` (
  `id_direction` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_direction`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Направление учащихся' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `direction`
--

INSERT INTO `direction` (`id_direction`, `Name`) VALUES
(1, 'Информационные системы'),
(2, 'Судовождение'),
(3, 'Судостроение'),
(4, 'Судомеханика'),
(5, 'Системная инженерия'),
(6, 'Компьютерная инженерия');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id_show` int(10) NOT NULL,
  `id_resource` int(10) NOT NULL,
  PRIMARY KEY (`id_show`,`id_resource`),
  KEY `id_resource` (`id_resource`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица Экспонат';

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_show`, `id_resource`) VALUES
(3, 29),
(4, 29),
(4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE IF NOT EXISTS `librarian` (
  `id_reg` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица Библиотекарь';

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`id_reg`, `status`) VALUES
(28, 'Старший'),
(29, 'Старший');

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE IF NOT EXISTS `organizer` (
  `id_show` int(10) NOT NULL,
  `id_reg` int(10) NOT NULL,
  PRIMARY KEY (`id_show`,`id_reg`),
  KEY `id_reg` (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица организаторов выставки';

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

CREATE TABLE IF NOT EXISTS `recommendation` (
  `id_reg` int(10) NOT NULL,
  `id_resource` int(10) NOT NULL,
  `id_subject` int(10) NOT NULL,
  PRIMARY KEY (`id_reg`,`id_resource`),
  KEY `id_resource` (`id_resource`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Рекомендации преподавателя ';

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE IF NOT EXISTS `reg` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `access` varchar(25) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Регистрация на сайте электронной библиотеки' AUTO_INCREMENT=30 ;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`id`, `login`, `password`, `email`, `access`, `hash`) VALUES
(17, 'Миша', '1', '', 'Студент', 'ccf16f8a4de908e54d132dc33146a6fd'),
(24, 'Петя', '1', '', 'Преподаватель', '914b2c4d061d13bacff022435eeb437f'),
(25, 'Надежда', '1', '', 'Студент', '81235019ba082e4501de47046f9a26d1'),
(26, 'Василий', '1', '', 'Студент', '514c9888ba6a9257c567bfdd039a5046'),
(27, 'Пётр', '1', '', 'Студент', 'e36789f2b4c491e488dc9b3a6b2b5818'),
(28, 'Вениамин', '1', '', 'Библиотекарь', '64b170fef658479694b37171e9b0f7e5'),
(29, 'Веня', '1', '', 'Библиотекарь', '01c001cd224f20bccd6fa91558c8ff75');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id_resource` int(10) NOT NULL AUTO_INCREMENT,
  `id_reg` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(10) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `pages` int(10) NOT NULL,
  `date_create` date NOT NULL,
  `reference` varchar(255) NOT NULL,
  PRIMARY KEY (`id_resource`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица Ресурс (книга, МУ, Периодич. издание)' AUTO_INCREMENT=31 ;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id_resource`, `id_reg`, `name`, `year`, `publisher`, `pages`, `date_create`, `reference`) VALUES
(29, 10, 'Три слова', 2015, 'СевГУ', 0, '2015-05-03', 'че за ссылка'),
(30, 29, 'Компьютерные сети', 2006, 'СевНТУ', 500, '2015-05-05', 'http://chernega.net/spd');

-- --------------------------------------------------------

--
-- Table structure for table `show`
--

CREATE TABLE IF NOT EXISTS `show` (
  `id_show` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id_show`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица Выставка' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `show`
--

INSERT INTO `show` (`id_show`, `name`, `date_start`, `time`) VALUES
(1, '1', '1', 1),
(2, 'Новая выставка', '2012-12-12', 12),
(3, 'Новая выставка', '2167-12-12', 1),
(4, 'Выствка', '2015-05-04', 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `n_record_book` int(10) NOT NULL,
  `id_reg` int(255) NOT NULL,
  `group` int(10) NOT NULL,
  PRIMARY KEY (`n_record_book`,`id_reg`),
  KEY `id_reg` (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица Студент';

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`n_record_book`, `id_reg`, `group`) VALUES
(1, 17, 1),
(1, 25, 1),
(22, 26, 2),
(34, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE IF NOT EXISTS `student_subject` (
  `n_record_book` int(10) NOT NULL,
  `id_subject` int(10) NOT NULL,
  PRIMARY KEY (`n_record_book`,`id_subject`),
  KEY `id_subject` (`id_subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Промежуточная таблица Студент-Дисциплина';

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id_subject` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_direction` int(10) NOT NULL,
  PRIMARY KEY (`id_subject`,`id_direction`),
  UNIQUE KEY `id_subject` (`id_subject`),
  KEY `id_direction` (`id_direction`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Дисциплины, изучаемые студентами и преподаваемые преподавателями' AUTO_INCREMENT=28 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id_subject`, `name`, `id_direction`) VALUES
(1, 'Управление данными', 1),
(2, 'ППРвУН', 1),
(3, 'ТОПК', 1),
(4, 'ИАД', 1),
(5, 'ТБД', 1),
(6, 'ВЕБ-Технологии', 1),
(12, 'Навигация и локация', 2),
(13, 'Мореходная астрономия', 2),
(14, 'Судовые энергетические установки', 2),
(15, 'Конструкция судна', 3),
(16, 'Мореходные качества судов', 3),
(18, 'Технология машиностроения', 3),
(19, 'Дифференциальная геометрия', 4),
(20, 'Проектирование конструкций', 4),
(21, 'Сопромат', 4),
(22, 'Операционные системы', 5),
(23, 'Дискретная матемактика', 5),
(24, 'Программирование', 5),
(25, 'Электроника', 6),
(26, 'Архитектура компьютеров', 6),
(27, 'Параллельные вычисления', 6);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id_reg` int(10) NOT NULL,
  `experience` varchar(255) NOT NULL,
  PRIMARY KEY (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица Преподаватель';

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id_reg`, `experience`) VALUES
(24, '1');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE IF NOT EXISTS `teacher_subject` (
  `id_reg` int(10) NOT NULL,
  `id_subject` int(10) NOT NULL,
  PRIMARY KEY (`id_reg`,`id_subject`),
  KEY `id_subject` (`id_subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Промежуточная таблица таблиц Дисциплина (subject) и Преподаватель (teacer)';

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`id_reg`, `id_subject`) VALUES
(24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `id_resource` int(10) NOT NULL,
  `id_reg` int(10) NOT NULL,
  `count` int(10) NOT NULL,
  PRIMARY KEY (`id_resource`,`id_reg`),
  KEY `id_reg` (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id_resource`, `id_reg`, `count`) VALUES
(29, 17, 9),
(29, 24, 3),
(29, 25, 6),
(29, 26, 2),
(29, 27, 17),
(29, 28, 5),
(30, 17, 6),
(30, 24, 2),
(30, 25, 3),
(30, 26, 2),
(30, 27, 15);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author_resource`
--
ALTER TABLE `author_resource`
  ADD CONSTRAINT `author_resource_ibfk_1` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id_resource`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `author_resource_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_show`) REFERENCES `show` (`id_show`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id_resource`);

--
-- Constraints for table `librarian`
--
ALTER TABLE `librarian`
  ADD CONSTRAINT `librarian_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organizer`
--
ALTER TABLE `organizer`
  ADD CONSTRAINT `organizer_ibfk_2` FOREIGN KEY (`id_reg`) REFERENCES `librarian` (`id_reg`),
  ADD CONSTRAINT `organizer_ibfk_1` FOREIGN KEY (`id_show`) REFERENCES `show` (`id_show`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD CONSTRAINT `recommendation_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `teacher` (`id_reg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recommendation_ibfk_2` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id_resource`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_ibfk_2` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`),
  ADD CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`n_record_book`) REFERENCES `student` (`n_record_book`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`id_direction`) REFERENCES `direction` (`id_direction`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `teacher_subject_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `teacher` (`id_reg`);

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id_resource`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `views_ibfk_2` FOREIGN KEY (`id_reg`) REFERENCES `reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
