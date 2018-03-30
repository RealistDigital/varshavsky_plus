-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 18 2015 г., 12:27
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `fr_jd_group`
--

-- --------------------------------------------------------

--
-- Структура таблицы `_a_sys_tpl`
--

CREATE TABLE IF NOT EXISTS `_a_sys_tpl` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `edit_tpl` varchar(50) DEFAULT NULL,
  `view_tpl` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `_a_sys_tpl`
--

INSERT INTO `_a_sys_tpl` (`id`, `parent_id`, `name`, `description`, `edit_tpl`, `view_tpl`) VALUES
(1, 0, 'Главная', '', 'edit_main', 'view_home'),
(2, 0, 'Контакты', '', 'edit_contacts', '');

-- --------------------------------------------------------

--
-- Структура таблицы `_a_users`
--

CREATE TABLE IF NOT EXISTS `_a_users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `access` set('yes','no') NOT NULL DEFAULT 'no',
  `name` varchar(100) DEFAULT NULL,
  `right_edit` varchar(255) DEFAULT '0',
  `right_delete` varchar(255) DEFAULT '0',
  `right_template` varchar(255) DEFAULT '0',
  `right_sect_dis` varchar(255) DEFAULT '0',
  `right_sect_del` varchar(100) DEFAULT '0',
  `right_sect_edit` varchar(100) DEFAULT '0',
  `right_manag_dis` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `_a_users`
--

INSERT INTO `_a_users` (`id`, `login`, `pass`, `access`, `name`, `right_edit`, `right_delete`, `right_template`, `right_sect_dis`, `right_sect_del`, `right_sect_edit`, `right_manag_dis`) VALUES
(1, 'admin', 'MzQ5OHI2NWV3eWZlMjQzYzJhcA==', 'yes', 'Админ', '0', '0', '0', '0', '0', '0', '0'),
(2, 'editor', 'MzQ5OHI2NWV3eWZlMjQzYzJhMTExMQ==', 'yes', 'New User', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `_main`
--

CREATE TABLE IF NOT EXISTS `_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(7) DEFAULT NULL,
  `position` int(11) DEFAULT '10',
  `visible_ru` set('yes','no') NOT NULL DEFAULT 'no',
  `visible_en` set('yes','no') DEFAULT 'no',
  `visible_ua` set('yes','no') DEFAULT 'no',
  `type_tpl` int(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `img_2` varchar(255) DEFAULT NULL,
  `files` varchar(255) DEFAULT NULL,
  `files_2` varchar(255) DEFAULT NULL,
  `name_ru` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ua` varchar(255) DEFAULT NULL,
  `name_2_ru` varchar(255) DEFAULT NULL,
  `name_2_en` varchar(255) DEFAULT NULL,
  `name_2_ua` varchar(255) DEFAULT NULL,
  `text_ru` text,
  `text_en` text,
  `text_ua` text,
  `short_text_ru` text,
  `short_text_en` text,
  `short_text_ua` text,
  `anons_text_ru` text,
  `anons_text_en` text,
  `anons_text_ua` text,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_ua` varchar(255) DEFAULT NULL,
  `meta_k_ru` text,
  `meta_k_en` text,
  `meta_k_ua` text,
  `meta_d_ru` text,
  `meta_d_en` text,
  `meta_d_ua` text,
  `link` varchar(255) DEFAULT NULL,
  `links_ru` varchar(255) DEFAULT NULL,
  `links_en` varchar(255) DEFAULT NULL,
  `links_ua` varchar(255) DEFAULT NULL,
  `coordinates_x` varchar(20) DEFAULT '0',
  `coordinates_y` varchar(20) DEFAULT '0',
  `path_svg` text,
  `status_apart` int(2) DEFAULT '1',
  `living_space` varchar(10) DEFAULT '0',
  `general_space` varchar(10) DEFAULT '0',
  `add_space` varchar(255) DEFAULT '0',
  `link_3d_plan` varchar(255) DEFAULT NULL,
  `map_coordinates_x` varchar(50) NOT NULL DEFAULT '0',
  `map_coordinates_y` varchar(50) NOT NULL DEFAULT '0',
  `map_coordinates_x_center` varchar(50) DEFAULT NULL,
  `map_coordinates_y_center` varchar(50) DEFAULT NULL,
  `map_zoom` int(2) NOT NULL DEFAULT '14',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `_main`
--

INSERT INTO `_main` (`id`, `parent`, `position`, `visible_ru`, `visible_en`, `visible_ua`, `type_tpl`, `url`, `address`, `date`, `img`, `img_2`, `files`, `files_2`, `name_ru`, `name_en`, `name_ua`, `name_2_ru`, `name_2_en`, `name_2_ua`, `text_ru`, `text_en`, `text_ua`, `short_text_ru`, `short_text_en`, `short_text_ua`, `anons_text_ru`, `anons_text_en`, `anons_text_ua`, `title_ru`, `title_en`, `title_ua`, `meta_k_ru`, `meta_k_en`, `meta_k_ua`, `meta_d_ru`, `meta_d_en`, `meta_d_ua`, `link`, `links_ru`, `links_en`, `links_ua`, `coordinates_x`, `coordinates_y`, `path_svg`, `status_apart`, `living_space`, `general_space`, `add_space`, `link_3d_plan`, `map_coordinates_x`, `map_coordinates_y`, `map_coordinates_x_center`, `map_coordinates_y_center`, `map_zoom`) VALUES
(1, 0, 10, 'no', 'no', 'no', 1, '', '', '', '', NULL, NULL, NULL, 'Главная', NULL, 'Главная', NULL, NULL, NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'Главная', NULL, '', '', NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, 1, '0', '0', '0', NULL, '0', '0', NULL, NULL, 14),
(2, 0, 90, 'no', 'no', 'no', 2, '2/', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Контакты', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, 1, '0', '0', '0', NULL, '0', '0', NULL, NULL, 14);

-- --------------------------------------------------------

--
-- Структура таблицы `_settings`
--

CREATE TABLE IF NOT EXISTS `_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `email_2` varchar(255) NOT NULL,
  `pages` int(2) DEFAULT NULL,
  `pagination_ad` int(5) NOT NULL DEFAULT '15',
  `allow_ips` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `_settings`
--

INSERT INTO `_settings` (`id`, `email`, `email_2`, `pages`, `pagination_ad`, `allow_ips`) VALUES
(1, 'niike@ukr.net', '', 2, 15, '');

-- --------------------------------------------------------

--
-- Структура таблицы `_translation`
--

CREATE TABLE IF NOT EXISTS `_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) DEFAULT NULL,
  `name_ru` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ua` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `_translation`
--

INSERT INTO `_translation` (`id`, `key`, `name_ru`, `name_en`, `name_ua`) VALUES
(1, NULL, 'Тестовый перевод', 'Тестовый перевод', 'Тестовый перевод');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
