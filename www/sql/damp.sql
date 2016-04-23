-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 23 2016 г., 09:45
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `selotur`
--

-- --------------------------------------------------------

--
-- Структура таблицы `food_type`
--

CREATE TABLE IF NOT EXISTS `food_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `homestead`
--

CREATE TABLE IF NOT EXISTS `homestead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) NOT NULL,
  `id_region` int(11) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `area` varchar(200) DEFAULT NULL COMMENT 'Населенный пункт',
  PRIMARY KEY (`id`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_region` (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `homestead`
--

INSERT INTO `homestead` (`id`, `id_supplier`, `id_region`, `address`, `area`) VALUES
(18, 19, 1, 'Адрес дом 25', 'Барнаул'),
(19, 20, 2, 'Хорошая улица', 'Барнаул');

-- --------------------------------------------------------

--
-- Структура таблицы `homestead_service`
--

CREATE TABLE IF NOT EXISTS `homestead_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_homestead` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_homestead` (`id_homestead`),
  KEY `id_service` (`id_service`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `homestead_service`
--

INSERT INTO `homestead_service` (`id`, `id_homestead`, `id_service`, `price`, `active`, `name`, `service_name`) VALUES
(19, 18, 1, 0, 0, '', 'Сельхоз работы'),
(20, 18, 2, 2000, 1, '', 'Уход за скотом'),
(21, 18, 3, 10, 1, '', 'Рыбалка'),
(22, 18, 4, 0, 0, '', 'Пешие экскурсии'),
(23, 18, 5, 300, 1, '', 'Автомобильные экскурсии'),
(24, 18, 6, 0, 0, '', 'Сплав по реке'),
(25, 19, 1, 1000, 1, '', 'Сельхоз работы'),
(26, 19, 2, 300, 1, '', 'Уход за скотом'),
(27, 19, 3, 0, 0, '', 'Рыбалка'),
(28, 19, 4, 2000, 1, '', 'Пешие экскурсии'),
(29, 19, 5, 0, 0, '', 'Автомобильные экскурсии'),
(30, 19, 6, 1999, 1, '', 'Сплав по реке');

-- --------------------------------------------------------

--
-- Структура таблицы `homestead_tourism_type`
--

CREATE TABLE IF NOT EXISTS `homestead_tourism_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_homestead` int(11) NOT NULL,
  `id_tourism_type` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `tourism_type_name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tourism_tour` (`id_tourism_type`),
  KEY `id_homestead` (`id_homestead`),
  KEY `id_tourism_type` (`id_tourism_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

--
-- Дамп данных таблицы `homestead_tourism_type`
--

INSERT INTO `homestead_tourism_type` (`id`, `id_homestead`, `id_tourism_type`, `active`, `price`, `tourism_type_name`) VALUES
(85, 18, 1, 0, 0, 'Агротуризм'),
(86, 18, 2, 0, 0, 'Туризм пребывания'),
(87, 18, 3, 0, 0, 'Практический туризм'),
(88, 18, 4, 1, 0, 'Гастрономический туризм'),
(89, 18, 5, 0, 0, 'Спортивный туризм'),
(90, 18, 6, 0, 0, 'Общинный туризм'),
(91, 18, 7, 0, 0, 'Этнографический туризм'),
(92, 19, 1, 0, 0, 'Агротуризм'),
(93, 19, 2, 0, 0, 'Туризм пребывания'),
(94, 19, 3, 0, 0, 'Практический туризм'),
(95, 19, 4, 0, 0, 'Гастрономический туризм'),
(96, 19, 5, 1, 0, 'Спортивный туризм'),
(97, 19, 6, 0, 0, 'Общинный туризм'),
(98, 19, 7, 0, 0, 'Этнографический туризм');

-- --------------------------------------------------------

--
-- Структура таблицы `house`
--

CREATE TABLE IF NOT EXISTS `house` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `place` int(11) NOT NULL,
  `id_homestead` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `name` varchar(50) NOT NULL,
  `empty_place` int(11) NOT NULL,
  `id_live_type` int(11) NOT NULL,
  `spring` tinyint(1) NOT NULL DEFAULT '0',
  `summer` tinyint(1) NOT NULL DEFAULT '0',
  `autumn` tinyint(1) NOT NULL DEFAULT '0',
  `winter` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_live_type` (`id_live_type`),
  KEY `id_homestead` (`id_homestead`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `house`
--

INSERT INTO `house` (`id`, `price`, `place`, `id_homestead`, `description`, `name`, `empty_place`, `id_live_type`, `spring`, `summer`, `autumn`, `winter`) VALUES
(7, 10, 10, 18, 'fadsfasdsad', 'Домик с койко-местами', 4, 2, 0, 0, 0, 0),
(9, 10, 10, 19, 'ячвсфывфывфыв', 'Домик с койко-местами', 10, 2, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `live_type`
--

CREATE TABLE IF NOT EXISTS `live_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `live_type`
--

INSERT INTO `live_type` (`id`, `name`) VALUES
(2, 'Койко-место'),
(3, 'Комната'),
(4, 'Домик'),
(5, 'Котедж');

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_house` int(11) NOT NULL,
  `path` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `path` (`path`(255)),
  KEY `id_house` (`id_house`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `name`, `description`) VALUES
(1, 'Алтайский край', 'Описание Алтайского края'),
(2, 'Краснодарский край', 'Описание Краснодарского края');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id`, `name`) VALUES
(1, 'Сельхоз работы'),
(2, 'Уход за скотом'),
(3, 'Рыбалка'),
(4, 'Пешие экскурсии'),
(5, 'Автомобильные экскурсии'),
(6, 'Сплав по реке');

-- --------------------------------------------------------

--
-- Структура таблицы `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(200) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `supplier`
--

INSERT INTO `supplier` (`id`, `fio`, `phone`, `email`, `password`) VALUES
(19, 'aaa', '123213213', 'a@a', 'aaa'),
(20, 'bbb', '1232131', 'b@b', 'bbb');

-- --------------------------------------------------------

--
-- Структура таблицы `supplier_service`
--

CREATE TABLE IF NOT EXISTS `supplier_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `id_homestead` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_homestead` (`id_homestead`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `supplier_service`
--

INSERT INTO `supplier_service` (`id`, `name`, `price`, `id_homestead`) VALUES
(13, 'Услуга 1', 150, 18),
(14, 'Услуга 2', 400, 18),
(17, 'Услуга 1', 500, 19);

-- --------------------------------------------------------

--
-- Структура таблицы `tourism_type`
--

CREATE TABLE IF NOT EXISTS `tourism_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `tourism_type`
--

INSERT INTO `tourism_type` (`id`, `name`) VALUES
(1, 'Агротуризм'),
(2, 'Туризм пребывания'),
(3, 'Практический туризм'),
(4, 'Гастрономический туризм'),
(5, 'Спортивный туризм'),
(6, 'Общинный туризм'),
(7, 'Этнографический туризм');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `homestead`
--
ALTER TABLE `homestead`
  ADD CONSTRAINT `homestead_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `homestead_ibfk_2` FOREIGN KEY (`id_region`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `homestead_service`
--
ALTER TABLE `homestead_service`
  ADD CONSTRAINT `homestead_service_ibfk_1` FOREIGN KEY (`id_homestead`) REFERENCES `homestead` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `homestead_service_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `homestead_tourism_type`
--
ALTER TABLE `homestead_tourism_type`
  ADD CONSTRAINT `homestead_tourism_type_ibfk_1` FOREIGN KEY (`id_homestead`) REFERENCES `homestead` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `homestead_tourism_type_ibfk_2` FOREIGN KEY (`id_tourism_type`) REFERENCES `tourism_type` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`id_live_type`) REFERENCES `live_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `house_ibfk_2` FOREIGN KEY (`id_homestead`) REFERENCES `homestead` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_2` FOREIGN KEY (`id_house`) REFERENCES `house` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `supplier_service`
--
ALTER TABLE `supplier_service`
  ADD CONSTRAINT `supplier_service_ibfk_1` FOREIGN KEY (`id_homestead`) REFERENCES `homestead` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
