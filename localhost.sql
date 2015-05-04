-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 04 2015 г., 19:16
-- Версия сервера: 5.5.43-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `course_work`
--
CREATE DATABASE IF NOT EXISTS `course_work` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `course_work`;

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id_author` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица Автор' AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id_author`, `name`) VALUES
(16, 'Исаева');

-- --------------------------------------------------------

--
-- Структура таблицы `author_resource`
--

CREATE TABLE IF NOT EXISTS `author_resource` (
  `id_resource` int(10) NOT NULL,
  `id_author` int(10) NOT NULL,
  PRIMARY KEY (`id_resource`,`id_author`),
  KEY `id_resource` (`id_resource`),
  KEY `id_author` (`id_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Промежуточная таблица Автор-Ресурс';

--
-- Дамп данных таблицы `author_resource`
--

INSERT INTO `author_resource` (`id_resource`, `id_author`) VALUES
(29, 16);

-- --------------------------------------------------------

--
-- Структура таблицы `direction`
--

CREATE TABLE IF NOT EXISTS `direction` (
  `id_direction` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_direction`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Направление учащихся' AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `direction`
--

INSERT INTO `direction` (`id_direction`, `Name`) VALUES
(1, 'Информационные системы'),
(2, 'Судовождение');

-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id_show` int(10) NOT NULL,
  `id_resource` int(10) NOT NULL,
  PRIMARY KEY (`id_show`,`id_resource`),
  KEY `id_resource` (`id_resource`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица Экспонат';

-- --------------------------------------------------------

--
-- Структура таблицы `librarian`
--

CREATE TABLE IF NOT EXISTS `librarian` (
  `id_reg` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица Библиотекарь';

-- --------------------------------------------------------

--
-- Структура таблицы `organizer`
--

CREATE TABLE IF NOT EXISTS `organizer` (
  `id_show` int(10) NOT NULL,
  `id_reg` int(10) NOT NULL,
  PRIMARY KEY (`id_show`,`id_reg`),
  KEY `id_reg` (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица организаторов выставки';

-- --------------------------------------------------------

--
-- Структура таблицы `recommendation`
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
-- Структура таблицы `reg`
--

CREATE TABLE IF NOT EXISTS `reg` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `access` varchar(25) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Регистрация на сайте электронной библиотеки' AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `reg`
--

INSERT INTO `reg` (`id`, `login`, `password`, `email`, `access`, `hash`) VALUES
(9, '123', '123', '123', 'Студент', 'e2e5846fc9fe40f00f7bd7e4dce85b2e'),
(10, '12', '12', '12', 'Преподаватель', 'bf3d4d82417d5ed9cc7e75d70c0590d0'),
(11, '1', '1', '1', 'Библиотекарь', 'dd49442d1cf5d6a60f2d5874dd2d3443'),
(13, 'Морковка', '27228721', 'karylma27@gmail.com', 'Библиотекарь', '5cd2bcfc2e1c3217f4b11ff5a04e07c0'),
(17, 'Миша', '1', '', 'Студент', '16611ba987c30de30d03673dd4790416'),
(24, 'Петя', '1', '', 'Преподаватель', '82445d8760a2ac40af61e718774d4047');

-- --------------------------------------------------------

--
-- Структура таблицы `resource`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица Ресурс (книга, МУ, Периодич. издание)' AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `resource`
--

INSERT INTO `resource` (`id_resource`, `id_reg`, `name`, `year`, `publisher`, `pages`, `date_create`, `reference`) VALUES
(29, 10, 'Три слова', 2015, 'СевГУ', 0, '2015-05-03', 'че за ссылка');

-- --------------------------------------------------------

--
-- Структура таблицы `show`
--

CREATE TABLE IF NOT EXISTS `show` (
  `id_show` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id_show`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица Выставка' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `show`
--

INSERT INTO `show` (`id_show`, `name`, `date_start`, `time`) VALUES
(1, '1', '1', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `n_record_book` int(10) NOT NULL,
  `id_reg` int(255) NOT NULL,
  `group` int(10) NOT NULL,
  PRIMARY KEY (`n_record_book`,`id_reg`),
  KEY `id_reg` (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица Студент';

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`n_record_book`, `id_reg`, `group`) VALUES
(1, 17, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `student_subject`
--

CREATE TABLE IF NOT EXISTS `student_subject` (
  `n_record_book` int(10) NOT NULL,
  `id_subject` int(10) NOT NULL,
  PRIMARY KEY (`n_record_book`,`id_subject`),
  KEY `id_subject` (`id_subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Промежуточная таблица Студент-Дисциплина';

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id_subject` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_direction` int(10) NOT NULL,
  PRIMARY KEY (`id_subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Дисциплины, изучаемые студентами и преподаваемые преподавателями' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`id_subject`, `name`, `id_direction`) VALUES
(1, 'Управление данными', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id_reg` int(10) NOT NULL,
  `experience` varchar(255) NOT NULL,
  PRIMARY KEY (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица Преподаватель';

--
-- Дамп данных таблицы `teacher`
--

INSERT INTO `teacher` (`id_reg`, `experience`) VALUES
(24, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_subject`
--

CREATE TABLE IF NOT EXISTS `teacher_subject` (
  `id_reg` int(10) NOT NULL,
  `id_subject` int(10) NOT NULL,
  PRIMARY KEY (`id_reg`,`id_subject`),
  KEY `id_subject` (`id_subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Промежуточная таблица таблиц Дисциплина (subject) и Преподаватель (teacer)';

--
-- Дамп данных таблицы `teacher_subject`
--

INSERT INTO `teacher_subject` (`id_reg`, `id_subject`) VALUES
(24, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `id_resource` int(10) NOT NULL,
  `id_reg` int(10) NOT NULL,
  `count` int(10) NOT NULL,
  PRIMARY KEY (`id_resource`,`id_reg`),
  KEY `id_reg` (`id_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `author_resource`
--
ALTER TABLE `author_resource`
  ADD CONSTRAINT `author_resource_ibfk_1` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id_resource`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `author_resource_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_show`) REFERENCES `show` (`id_show`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id_resource`);

--
-- Ограничения внешнего ключа таблицы `librarian`
--
ALTER TABLE `librarian`
  ADD CONSTRAINT `librarian_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `organizer`
--
ALTER TABLE `organizer`
  ADD CONSTRAINT `organizer_ibfk_2` FOREIGN KEY (`id_reg`) REFERENCES `librarian` (`id_reg`),
  ADD CONSTRAINT `organizer_ibfk_1` FOREIGN KEY (`id_show`) REFERENCES `show` (`id_show`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `recommendation`
--
ALTER TABLE `recommendation`
  ADD CONSTRAINT `recommendation_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `teacher` (`id_reg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recommendation_ibfk_2` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id_resource`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`n_record_book`) REFERENCES `student` (`n_record_book`),
  ADD CONSTRAINT `student_subject_ibfk_2` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`);

--
-- Ограничения внешнего ключа таблицы `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`id_subject`) REFERENCES `direction` (`id_direction`);

--
-- Ограничения внешнего ключа таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `teacher_subject_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `teacher` (`id_reg`),
  ADD CONSTRAINT `teacher_subject_ibfk_2` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`);

--
-- Ограничения внешнего ключа таблицы `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`id_resource`) REFERENCES `resource` (`id_resource`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `views_ibfk_2` FOREIGN KEY (`id_reg`) REFERENCES `reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
