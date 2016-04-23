-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 23 2016 г., 16:38
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `food_type`
--

INSERT INTO `food_type` (`id`, `name`) VALUES
(1, 'Без питания'),
(2, 'Только завтраки'),
(3, 'Трехразовое питание'),
(4, 'Все включено');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `homestead`
--

INSERT INTO `homestead` (`id`, `id_supplier`, `id_region`, `address`, `area`) VALUES
(23, 24, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `homestead_food_type`
--

CREATE TABLE IF NOT EXISTS `homestead_food_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_food_type` int(11) NOT NULL,
  `food_type_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `id_homestead` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_food_type` (`id_food_type`),
  KEY `id_homestead` (`id_homestead`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `homestead_food_type`
--

INSERT INTO `homestead_food_type` (`id`, `id_food_type`, `food_type_name`, `price`, `active`, `id_homestead`) VALUES
(5, 1, 'Без питания', 0, 0, 23),
(6, 2, 'Только завтраки', 100, 1, 23),
(7, 3, 'Трехразовое питание', 10, 1, 23),
(8, 4, 'Все включено', 0, 0, 23);

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
  `service_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_homestead` (`id_homestead`),
  KEY `id_service` (`id_service`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Дамп данных таблицы `homestead_service`
--

INSERT INTO `homestead_service` (`id`, `id_homestead`, `id_service`, `price`, `active`, `service_name`) VALUES
(49, 23, 1, 0, 0, 'Сельхоз работы'),
(50, 23, 2, 0, 0, 'Уход за скотом'),
(51, 23, 3, 100, 1, 'Рыбалка'),
(52, 23, 4, 0, 0, 'Пешие экскурсии'),
(53, 23, 5, 300, 1, 'Автомобильные экскурсии'),
(54, 23, 6, 0, 0, 'Сплав по реке');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Дамп данных таблицы `homestead_tourism_type`
--

INSERT INTO `homestead_tourism_type` (`id`, `id_homestead`, `id_tourism_type`, `active`, `price`, `tourism_type_name`) VALUES
(120, 23, 1, 0, 0, 'Агротуризм'),
(121, 23, 2, 0, 0, 'Туризм пребывания'),
(122, 23, 3, 0, 0, 'Практический туризм'),
(123, 23, 4, 0, 0, 'Гастрономический туризм'),
(124, 23, 5, 0, 0, 'Спортивный туризм'),
(125, 23, 6, 0, 0, 'Общинный туризм'),
(126, 23, 7, 0, 0, 'Этнографический туризм');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `house`
--

INSERT INTO `house` (`id`, `price`, `place`, `id_homestead`, `description`, `name`, `empty_place`, `id_live_type`, `spring`, `summer`, `autumn`, `winter`) VALUES
(10, 10, 10, 23, 'dfsdfdsf', 'Домик с койко-местами', 10, 2, 1, 0, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `supplier`
--

INSERT INTO `supplier` (`id`, `fio`, `phone`, `email`, `password`) VALUES
(24, 'aaa', '123', 'a@a', 'aaa');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `supplier_service`
--

INSERT INTO `supplier_service` (`id`, `name`, `price`, `id_homestead`) VALUES
(19, 'Услуга 1', 550, 23),
(20, 'Услуга 3', 456, 23);

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
-- Ограничения внешнего ключа таблицы `homestead_food_type`
--
ALTER TABLE `homestead_food_type`
  ADD CONSTRAINT `homestead_food_type_ibfk_2` FOREIGN KEY (`id_homestead`) REFERENCES `homestead` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `homestead_food_type_ibfk_1` FOREIGN KEY (`id_food_type`) REFERENCES `food_type` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
