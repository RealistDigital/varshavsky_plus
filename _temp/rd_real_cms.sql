-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2018 at 06:35 PM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rd_westhouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `_a_sys_tpl`
--

CREATE TABLE IF NOT EXISTS `_a_sys_tpl` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `edit_tpl` varchar(50) DEFAULT NULL,
  `view_tpl` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `_a_sys_tpl`
--

INSERT INTO `_a_sys_tpl` (`id`, `parent_id`, `name`, `description`, `edit_tpl`, `view_tpl`) VALUES
(1, 0, 'Главная', '', 'edit_main', 'view_home'),
(2, 0, 'Про комплекс', '', 'edit_list', 'view_child'),
(3, 2, 'Концепция', '', 'edit_list', ''),
(4, 2, 'Переваги', '', 'edit_list', ''),
(5, 2, 'Застройщик', '', 'edit_list', 'view_uchasniki'),
(6, 0, 'Расположение', '', 'edit_list', 'view_infra'),
(7, 0, 'Квартиры', '', 'edit_list', 'view_child'),
(8, 0, 'Преимущества', '', 'edit_list', ''),
(9, 0, 'Галерея', '', 'edit_list', 'view_gallery'),
(10, 9, 'Ход строительства', '', 'edit_list_hid_bud', 'view_hid_bud'),
(11, 9, 'Визуализации', '', 'edit_visual', 'view_visual'),
(12, 9, 'Панорама', '', 'edit_list', ''),
(13, 0, 'Пресс-центр', '', 'edit_list', 'view_child'),
(14, 2, 'Документация', '', 'edit_list', 'view_docs'),
(15, 13, 'Новости', '', 'edit_list', 'view_news'),
(16, 0, 'Контакты', '', 'edit_list', 'view_parent'),
(17, 13, 'Акции', '', 'edit_list', 'view_akciia'),
(18, 15, 'Новость', '', 'edit_new', 'view_new'),
(19, 17, 'Акция', '', 'edit_general', 'view_new'),
(20, 22, 'Дом', '', 'edit_dom', 'view_parent'),
(21, 20, 'Этаж', '', 'edit_floor', 'view_floor'),
(22, 7, 'Квартиры(дома)', '', 'edit_houses', 'view_flats'),
(23, 7, 'Фильтр квартир', '', 'edit_general', 'view_filter'),
(24, 21, 'Квартира', '', 'edit_flat', 'view_flat'),
(25, 10, 'Месяц', '', 'edit_hid_bud', 'view_parent'),
(26, 6, 'Група маркеров', '', 'edit_marker_group', 'view_parent'),
(27, 26, 'Маркер', '', 'edit_marker', 'view_parent'),
(29, 0, 'Планировки', '', 'edit_list', 'view_parent'),
(30, 29, 'Планировка', '', 'edit_planning', 'view_parent'),
(31, 30, 'Комната', '', 'edit_type_room', 'view_parent'),
(32, 16, 'Контакт(ПРОЕКТ)', '', 'edit_contacts', 'view_parent'),
(33, 16, 'Контакт(ОТДЕЛ ПРОДАЖ)', '', 'edit_contacts_2', 'view_parent'),
(34, 5, 'Застройщик (один)', '', 'edit_general', 'view_parent'),
(35, 14, 'Документ', '', 'edit_docs', 'view_parent');

-- --------------------------------------------------------

--
-- Table structure for table `_a_users`
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
-- Dumping data for table `_a_users`
--

INSERT INTO `_a_users` (`id`, `login`, `pass`, `access`, `name`, `right_edit`, `right_delete`, `right_template`, `right_sect_dis`, `right_sect_del`, `right_sect_edit`, `right_manag_dis`) VALUES
(1, 'admin', 'MzQ5OHI2NWV3eWZlMjQzYzJhcA==', 'yes', 'Админ', '0', '0', '0', '0', '0', '0', '0'),
(2, 'editor', 'MzQ5OHI2NWV3eWZlMjQzYzJhMTExMQ==', 'yes', 'New User', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `_comments`
--

CREATE TABLE IF NOT EXISTS `_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `id_good` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Comments' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `_main`
--

CREATE TABLE IF NOT EXISTS `_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count_room` varchar(10) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `tel_2` varchar(255) NOT NULL,
  `tel_3` varchar(255) DEFAULT NULL,
  `count_rooms` varchar(10) NOT NULL,
  `plan` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `type_marker` tinyint(4) NOT NULL,
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
  `img_3` varchar(255) NOT NULL,
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
  `text_2_ru` text,
  `text_2_en` text,
  `text_2_ua` text,
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
  `path_svg_2` text,
  `status_apart` int(2) DEFAULT '1',
  `living_space` varchar(10) DEFAULT '0',
  `general_space` varchar(10) DEFAULT '0',
  `add_space` varchar(255) DEFAULT '0',
  `add_space2` varchar(255) NOT NULL,
  `link_3d_plan` varchar(255) DEFAULT NULL,
  `map_coordinates_x` varchar(50) NOT NULL DEFAULT '0',
  `map_coordinates_y` varchar(50) NOT NULL DEFAULT '0',
  `map_coordinates_x_center` varchar(50) DEFAULT NULL,
  `map_coordinates_y_center` varchar(50) DEFAULT NULL,
  `map_zoom` int(2) NOT NULL DEFAULT '14',
  `compas` varchar(100) NOT NULL,
  `side` varchar(10) NOT NULL,
  `side2` int(10) unsigned NOT NULL,
  `side3` int(10) unsigned NOT NULL,
  `side4` int(10) unsigned NOT NULL,
  `window` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `_main`
--

INSERT INTO `_main` (`id`, `count_room`, `tel`, `tel_2`, `tel_3`, `count_rooms`, `plan`, `status`, `type_marker`, `parent`, `position`, `visible_ru`, `visible_en`, `visible_ua`, `type_tpl`, `url`, `address`, `date`, `img`, `img_2`, `img_3`, `files`, `files_2`, `name_ru`, `name_en`, `name_ua`, `name_2_ru`, `name_2_en`, `name_2_ua`, `text_ru`, `text_en`, `text_ua`, `text_2_ru`, `text_2_en`, `text_2_ua`, `short_text_ru`, `short_text_en`, `short_text_ua`, `anons_text_ru`, `anons_text_en`, `anons_text_ua`, `title_ru`, `title_en`, `title_ua`, `meta_k_ru`, `meta_k_en`, `meta_k_ua`, `meta_d_ru`, `meta_d_en`, `meta_d_ua`, `link`, `links_ru`, `links_en`, `links_ua`, `coordinates_x`, `coordinates_y`, `path_svg`, `path_svg_2`, `status_apart`, `living_space`, `general_space`, `add_space`, `add_space2`, `link_3d_plan`, `map_coordinates_x`, `map_coordinates_y`, `map_coordinates_x_center`, `map_coordinates_y_center`, `map_zoom`, `compas`, `side`, `side2`, `side3`, `side4`, `window`) VALUES
(1, '', '+38(097) 111-29-00', '+38(067) 111-29-00', '+38(077) 111-29-00', '', '', '', 0, 0, 10, 'no', 'no', 'no', 1, '', '', '', '', NULL, '', NULL, NULL, 'Главная', NULL, 'Главная', NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, '', NULL, NULL, NULL, 'Главная', NULL, '', '', NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(3, '', '', '', NULL, '', '', '', 0, 0, 80, 'no', 'no', 'yes', 16, '3/', '3', NULL, NULL, NULL, '', 'DFGG', NULL, NULL, NULL, 'Контакти', NULL, NULL, NULL, NULL, NULL, 'FGH', '', '', '', NULL, NULL, 'GHJG', NULL, NULL, 'GFHGF', NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', 'FH', NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(7, '', '', '', NULL, '', '', '', 0, 0, 60, 'no', 'no', 'yes', 9, '7/', '7', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Галерея', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(8, '', '', '', NULL, '', '', '', 0, 7, 30, 'no', 'no', 'yes', 10, '7/8/', '8', NULL, 'public/files/test/1.jpg', NULL, '', NULL, NULL, NULL, NULL, 'Хід будівництва', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(9, '', '', '', NULL, '', '', '', 0, 0, 70, 'no', 'no', 'yes', 13, '9/', '9', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Пресцентр', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(10, '', '', '', NULL, '', '', '', 0, 0, 50, 'no', 'no', 'yes', 8, '10/', '10', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Переваги', NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(11, '', '', '', NULL, '', '', '', 0, 9, 10, 'no', 'no', 'yes', 15, '9/11/', '11', NULL, '', NULL, '', 'public/files/location.jpg', NULL, NULL, NULL, 'Новини', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(12, '', '', '', NULL, '', '', '', 0, 9, 20, 'no', 'no', 'yes', 17, '9/12/', '12', NULL, '', NULL, '', 'public/files/location.jpg', NULL, NULL, NULL, 'Акції', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(14, '', '', '', NULL, '', '', '', 0, 0, 20, 'no', 'no', 'yes', 2, '14/', '14', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Про комплекс', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(15, '', '', '', NULL, '', '', '', 0, 0, 30, 'no', 'no', 'yes', 6, '15/', '15', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Розташування', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(16, '', '', '', NULL, '', '', '', 0, 0, 40, 'no', 'no', 'yes', 7, '16/', '16', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Обрати квартиру', NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(17, '', '', '', NULL, '', '', '', 0, 16, 10, 'no', 'no', 'yes', 22, '16/17/', '17', NULL, 'public/files/houses/bg_houses.jpg', 'public/files/genplan/genplan_1.png', '', NULL, NULL, NULL, NULL, 'Квартири', NULL, NULL, 'test 2', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(18, '', '', '', NULL, '', '', '', 0, 0, 100, 'no', 'no', 'no', 29, '18/', '18', NULL, 'public/files/test/1.jpg', NULL, '', '', NULL, NULL, NULL, 'Планировки (функционал)', NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', 'M86 106,L378 116,L491 259,L18 420,L95 190Z', '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(19, '', '', '', NULL, '1', '', '', 0, 18, 10, 'no', 'no', 'yes', 30, '18/19/', '19', NULL, 'public/files/flats/flat_test.png', 'public/files/filter_flats/filter_flat_test.jpg', 'public/files/docs/docs_test.jpg', 'public/files/docs/docs_test.jpg', NULL, NULL, NULL, '1А', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '132', '121', '', '', NULL, '0', '0', NULL, NULL, 14, '', '0', 0, 0, 4, '1'),
(100, '', '', '', NULL, '', '', '', 0, 10, 10, 'no', 'no', 'no', 11, '10/100/', '100', NULL, NULL, NULL, '', NULL, NULL, 'Test 1', NULL, 'Test 1', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(101, '', '', '', NULL, '', '', '', 0, 100, 10, 'no', 'no', 'yes', 12, '10/100/101/', '101', NULL, NULL, NULL, '', NULL, NULL, 'Copy 1.1', NULL, 'Copy 1.1', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(102, '', '', '', NULL, '', '', '', 0, 101, 10, 'no', 'no', 'yes', 13, '10/100/101/102/', '102', NULL, NULL, NULL, '', NULL, NULL, 'Copy 1.1.1', NULL, 'Copy 1.1.1', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(103, '', '', '', NULL, '', '', '', 0, 101, 20, 'no', 'no', 'yes', 13, '10/100/101/103/', '103', NULL, NULL, NULL, '', NULL, NULL, 'Copy 1.1.2', NULL, 'Copy 1.1.2', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(104, '', '', '', NULL, '', '', '', 0, 101, 30, 'no', 'no', 'yes', 13, '10/100/101/104/', '104', NULL, NULL, NULL, '', NULL, NULL, 'Copy 1.1.3', NULL, 'Copy 1.1.3', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(105, '', '', '', NULL, '', '', '', 0, 100, 20, 'no', 'no', 'yes', 12, '10/100/105/', '105', NULL, NULL, NULL, '', NULL, NULL, 'Copy 1.2', NULL, 'Copy 1.2', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(124, '', '', '', NULL, '', '', '', 0, 105, 10, 'no', 'no', 'yes', 13, '10/100/105/124/', '124', NULL, NULL, NULL, '', NULL, NULL, 'Copy 2.1', NULL, 'Copy 2.1', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(129, '', '', '', NULL, '', '', '', 0, 3, 10, 'no', 'no', 'yes', 32, '3/129/', '129', NULL, 'public/files/test/1.jpg', NULL, '', '', NULL, NULL, NULL, 'АДРЕСА ПРОЕКТУ ', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Метро «Демеевская»', NULL, NULL, 'Киев, ул. Кустанайская,  13 ', NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(133, '', '', '', NULL, '', '', '', 0, 11, 10, 'no', 'no', 'yes', 18, '9/11/133/', '133', '04.01.2018', 'public/files/test/1.jpg', '', '', NULL, NULL, NULL, NULL, 'Новина 1', NULL, NULL, NULL, NULL, NULL, 'Окружной административный суд отказался обязать Государственную миграционную службу рассмотреть вопрос о предоставлении Саакашвили дополнительной защиты. "Суд принял решение отказать Михаилу Саакашвили в удовлетворении его иска к Государственной миграционной службе о предоставлении ему статуса беженца или лица, требующего дополнительной защиты. В иске отказать полностью", - заявила судья Татьяна Скочок.', '', '', '', NULL, NULL, 'Суд отказал Саакашвили в статусе беженца и дополнительной защите', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(134, '', '', '', NULL, '', '', '', 0, 7, 10, 'no', 'no', 'yes', 11, '7/134/', '134', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Візуалізації', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(135, '', '', '', NULL, '', '', '', 0, 7, 40, 'no', 'no', 'no', 12, '7/135/', '135', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Панорама', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(136, '', '', '', NULL, '', '', '', 0, 14, 10, 'no', 'no', 'no', 3, '14/136/', '136', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Концепція', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(137, '', '', '', NULL, '', '', '', 0, 14, 20, 'no', 'no', 'no', 4, '14/137/', '137', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Переваги', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(138, '', '', '', NULL, '', '', '', 0, 14, 30, 'no', 'no', 'yes', 5, '14/138/', '138', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Забудовник', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(139, '', '', '', NULL, '', '', '', 0, 14, 40, 'no', 'no', 'yes', 14, '14/139/', '139', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Документація', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(140, '', '', '', NULL, '', '', '', 0, 17, 10, 'no', 'no', 'yes', 20, '16/17/140/', '140', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Дом 1', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '265', '219', 'M228 253,L205 204,L228 159,L333 204,L299 271Z', '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '10', '', 0, 0, 0, ''),
(141, '', '', '', NULL, '', '', '', 0, 140, 10, 'no', 'no', 'yes', 21, '16/17/140/141/', '141', NULL, 'public/files/floor/floor_test.png', NULL, '', '', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '240.5', '349', 'M556 697,L556 641,L916 641,L916 704Z', '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(142, '', '', '', NULL, '', '164', '0', 0, 141, 10, 'no', 'no', 'yes', 24, '16/17/140/141/142/', '142', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '3А', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '127', '59', 'M19 22,L380 22,L368 256,L208 256,L208 190,L156 190,L156 141,L19 141Z', '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(143, '', '', '', NULL, '', '', '', 0, 8, 10, 'no', 'no', 'yes', 25, '7/8/143/', '143', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '08', NULL, NULL, '2017', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(144, '', '', '', NULL, '', '', '', 0, 8, 20, 'no', 'no', 'yes', 25, '7/8/144/', '144', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '09', NULL, NULL, '2018', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(145, '', '', '', NULL, '', '', '', 0, 143, 10, 'no', 'no', 'yes', 0, '7/8/143/145/', '145', NULL, 'public/files/hid_bud/img_test.jpg', NULL, '', NULL, NULL, NULL, NULL, 'New', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(146, '', '', '', NULL, '', '', '', 0, 143, 20, 'no', 'no', 'yes', 0, '7/8/143/146/', '146', NULL, 'public/files/houses/bg_houses.jpg', NULL, '', NULL, NULL, NULL, NULL, 'New', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(147, '', '', '', NULL, '', '', '', 0, 144, 10, 'no', 'no', 'yes', 0, '7/8/144/147/', '147', NULL, 'public/files/genplan/genplan_1.png', NULL, '', NULL, NULL, NULL, NULL, 'New', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(148, '', '', '', NULL, '', '', '', 0, 134, 10, 'no', 'no', 'yes', 0, '7/134/148/', '148', NULL, 'public/files/test/RD_1.png', NULL, '', NULL, NULL, NULL, NULL, 'New', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(149, '', '', '', NULL, '', '', '', 0, 134, 20, 'no', 'no', 'yes', 0, '7/134/149/', '149', NULL, 'public/files/test/RD_2.png', NULL, '', NULL, NULL, NULL, NULL, 'New', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(150, '', '', '', NULL, '', '', '', 0, 134, 30, 'no', 'no', 'yes', 0, '7/134/150/', '150', NULL, 'public/files/test/RD_3.png', NULL, '', NULL, NULL, NULL, NULL, 'New', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(151, '', '', '', NULL, '', '', '', 0, 134, 40, 'no', 'no', 'yes', 0, '7/134/151/', '151', NULL, 'public/files/test/RD_4.png', NULL, '', NULL, NULL, NULL, NULL, 'New', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(152, '', '', '', NULL, '', '', '', 0, 15, 10, 'no', 'no', 'yes', 26, '15/152/', '152', NULL, 'public/files/marker/map_marker_det_sad.png', 'public/files/marker/marker_det_sad.png', '', NULL, NULL, NULL, NULL, 'Дитячі садочки', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '1', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(153, '', '', '', NULL, '', '', '', 0, 152, 10, 'no', 'no', 'yes', 27, '15/152/153/', '153', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Школа 1', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '50.40756109922213', '30.494045904541053', '50.415574237061314', '30.4880377563477', 12, '', '', 0, 0, 0, ''),
(154, '', '', '', NULL, '', '', '', 0, 152, 20, 'no', 'no', 'yes', 27, '15/152/154/', '154', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Дит.Сад', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '50.401215264173096', '30.49267261352543', '50.39708454433297', '30.465893438720748', 12, '', '', 0, 0, 0, ''),
(155, '', '', '', NULL, '', '', '', 0, 15, 20, 'no', 'no', 'yes', 26, '15/155/', '155', NULL, 'public/files/marker/map_marker_book.png', 'public/files/marker/marker_book.png', '', NULL, NULL, NULL, NULL, 'Освітні заклади', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '2', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(156, '', '', '', NULL, '', '', '', 0, 155, 10, 'no', 'no', 'yes', 27, '15/155/156/', '156', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Парк', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '50.39771375006437', '30.50962417449955', '50.40109216845484', '30.516962698364303', 15, '', '', 0, 0, 0, ''),
(157, '', '', '', NULL, '', '', '', 0, 11, 20, 'no', 'no', 'yes', 18, '9/11/157/', '157', '08.01.2018', 'public/files/houses/bg_houses.jpg', NULL, '', NULL, NULL, NULL, NULL, 'Новина 2', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(158, '', '', '', NULL, '', '', '', 0, 12, 10, 'no', 'no', 'yes', 19, '9/12/158/', '158', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Акция тест', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(159, '', '', '', NULL, '', '', '', 0, 16, 20, 'no', 'no', 'yes', 23, '16/159/', '159', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Фільтр квартир', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(160, '', '', '', NULL, '', '', '', 0, 17, 20, 'no', 'no', 'yes', 20, '16/17/160/', '160', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Дом 2', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '139.5', '141', 'M82 92,L221 154,L205 189,L67 141Z', '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(161, '', '', '', NULL, '', '', '', 0, 160, 10, 'no', 'no', 'yes', 21, '16/17/160/161/', '161', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '748.5', '203', 'M990 320,L974 344,L974 771,L1003 795,L1430 771,L1430 306,L1003 271Z', '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(162, '', '', '', NULL, '', '', '', 0, 161, 10, 'no', 'no', 'yes', 24, '16/17/160/161/162/', '162', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2Б', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(163, '', '', '', NULL, '2', '', '', 0, 18, 20, 'no', 'no', 'yes', 30, '18/163/', '163', NULL, 'public/files/test/1.jpg', 'public/files/houses/bg_houses.jpg', '', '', NULL, NULL, NULL, '2А', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '20', '10', '', '', NULL, '0', '0', NULL, NULL, 14, '', '1', 0, 0, 0, '1'),
(164, '', '', '', NULL, '3', '', '', 0, 18, 30, 'no', 'no', 'yes', 30, '18/164/', '164', NULL, 'public/files/flats/flat_test.png', 'public/files/genplan/genplan_1.png', '', 'public/img/compas.png', NULL, NULL, NULL, '3А', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, '', 1, '67,25', '35,32', '', '', NULL, '0', '0', NULL, NULL, 14, '', '0', 2, 0, 0, '2'),
(165, '', '', '', NULL, '', '', '', 0, 19, 10, 'no', 'no', 'yes', 31, '18/19/165/', '165', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Кухня', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '154', '150', NULL, '', 1, '0', '0', '10,21', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(166, '', '', '', NULL, '', '', '', 0, 19, 20, 'no', 'no', 'yes', 31, '18/19/166/', '166', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Вітальня', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '439', '417', NULL, '', 1, '0', '0', '7,58', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(167, '', '', '', NULL, '', '', '', 0, 163, 10, 'no', 'no', 'yes', 31, '18/163/167/', '167', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Коридор', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '163.5', '30', NULL, '', 1, '0', '0', '125,3', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(168, '', '', '', NULL, '', '', '', 0, 164, 10, 'no', 'no', 'yes', 31, '18/164/168/', '168', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Балкон', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '41.5', '35', NULL, '', 1, '0', '0', '7', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(169, '', '', '', NULL, '', '', '', 0, 140, 20, 'no', 'no', 'yes', 21, '16/17/140/169/', '169', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '241.5', '157', 'M558 605,L558 199,L918 227,L918 629Z', '', 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(170, '', '', '', NULL, '', '164', '0', 0, 169, 10, 'no', 'no', 'yes', 24, '16/17/140/169/170/', '170', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '3B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', '', NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '0', 0, 0, 0, '0'),
(171, '', '', '', NULL, '', '163', '1', 0, 141, 20, 'no', 'no', 'yes', 24, '16/17/140/141/171/', '171', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '325.5', '57', 'M549 200,L518 200,L518 37,L520 37,L520 23,L729 23,L730 43,L859 44,L859 151,L723 151,L723 185,L688 185,L689 254,L549 254Z', NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '1', 0, 0, 0, '1'),
(172, '', '', '', NULL, '', '19', '2', 0, 141, 30, 'no', 'no', 'yes', 24, '16/17/140/141/172/', '172', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '1A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '58', '216', 'M26 365,L232 365,L264 491,L142 491,L142 547,L12 547Z', NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '1', 0, 0, 0, '0'),
(173, '', '', '', NULL, '', '', '', 0, 3, 20, 'no', 'no', 'yes', 33, '3/173/', '173', NULL, NULL, NULL, '', 'office@westhouse.kiev.ua', NULL, NULL, NULL, 'Відділ продажу', NULL, NULL, NULL, NULL, NULL, 'Пн.-Пт. 09:30 - 19:00 <br>Сб. 10:00 - 17:00 <br>Вс. 10.00 - 17.00', NULL, NULL, NULL, NULL, NULL, 'Метро «Демеевская»', NULL, NULL, 'Киев, ул. Кустанайская, 13', NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', '+38(066) 111-29-00', NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(174, '', '', '', NULL, '', '', '', 0, 11, 30, 'no', 'no', 'yes', 18, '9/11/174/', '174', '26.01.2018', '', NULL, '', NULL, NULL, NULL, NULL, 'Новина 3', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(175, '', '', '', NULL, '', '', '', 0, 11, 40, 'no', 'no', 'yes', 18, '9/11/175/', '175', '21.01.2018', '', NULL, '', NULL, NULL, NULL, NULL, 'Новина 4', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(176, '', '', '', NULL, '', '', '', 0, 138, 10, 'no', 'no', 'yes', 34, '14/138/176/', '176', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'ПРАТ “КИЕВБУДКОМ”', NULL, NULL, NULL, NULL, NULL, 'ПрАТ &laquo;КИЕВБУДКОМ&raquo; &mdash; это огромный опыт сотрудничества с украинскими и зарубежными компаниями по выполнению проектных и строительно-монтажных работ. Основным направлением деятельности является проектирование и строительство монолитно-каркасных многоэтажных домов, офисов, бизнес-центров, гражданских и промышленных объектов с применением новейших технологий и материалов. <br><br>Среди объектов, построенных ПрАТ &laquo;Киевбудкомом&raquo;: ЖК по ул. Майорова, 5, ЖК по ул. Боженко, 75-77, Владимирско-Лыбедская 21-17, комплекс многоэтажных жилых домов между пр. Николая Бажана и ул.Завальной, ЖК по ул. Здолбуновская, 3, ЖК по ул. Малиновского 8 и 8а, ЖК по ул. Подвысоцкого 6в, микрорайоны I, II по ул. Маршала Гречко и пр. Правды, Академия искусств Украины, ТРЦ &laquo;Ocean Plaza&raquo; (монолитные работы) возле метро Лыбедская, офисный центр UM AIR, супермаркет Billa, завод строительных сухих смесей &laquo;Хенкель-Баутехник&raquo; (г.Вышгород), главный производственный корпус ЗАО &laquo;Киевская кондитерская фабрика им. Карла Маркса&raquo; и множество других.Среди объектов, построенных ПрАТ &laquo;Киевбудкомом&raquo;: ЖК по ул. Майорова, 5, ЖК по ул. Боженко, 75-77, Владимирско-Лыбедская 21-17, комплекс многоэтажных жилых домов между пр. Николая Бажана и ул.Завальной, ЖК по ул. Здолбуновская, 3, ЖК по ул. Малиновского 8 и 8а, ЖК по ул. Подвысоцкого 6в, микрорайоны I, II по ул. Маршала Гречко и пр. Правды, Академия искусств Украины, ТРЦ &laquo;Ocean Plaza&raquo; (монолитные работы) возле метро Лыбедская, офисный центр UM AIR, супермаркет Billa, завод строительных сухих смесей &laquo;Хенкель-Баутехник&raquo; (г.Вышгород), главный производственный корпус ЗАО &laquo;Киевская кондитерская фабрика им. Карла Маркса&raquo; и множество других', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(177, '', '', '', NULL, '', '', '', 0, 138, 20, 'no', 'no', 'yes', 34, '14/138/177/', '177', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'ПРАТ “КИЕВБУДКОМ 2”', NULL, NULL, NULL, NULL, NULL, 'ПрАТ &laquo;КИЕВБУДКОМ&raquo; &mdash; это огромный опыт сотрудничества с украинскими и зарубежными компаниями по выполнению проектных и строительно-монтажных работ. Основным направлением деятельности является проектирование и строительство монолитно-каркасных многоэтажных домов, офисов, бизнес-центров, гражданских и промышленных объектов с применением новейших технологий и материалов.&nbsp;', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(178, '', '', '', NULL, '', '', '', 0, 139, 10, 'no', 'no', 'yes', 35, '14/139/178/', '178', NULL, 'public/files/docs/docs_test.jpg', NULL, '', 'public/files/test/1.jpg', NULL, NULL, NULL, 'Документ 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(179, '', '', '', NULL, '', '', '', 0, 139, 20, 'no', 'no', 'yes', 35, '14/139/179/', '179', NULL, 'public/files/docs/docs_test.jpg', NULL, '', 'public/files/docs/docs_test.jpg', NULL, NULL, NULL, 'Документ 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(180, '', '', '', NULL, '', '', '', 0, 7, 20, 'no', 'no', 'yes', 11, '7/180/', '180', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'Інтер''єри', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(181, '', '', '', NULL, '', '', '', 0, 15, 30, 'no', 'no', 'yes', 26, '15/181/', '181', NULL, 'public/files/marker/map_marker_food.png', 'public/files/marker/marker_food.png', '', NULL, NULL, NULL, NULL, 'Ресторани, барі, кафе', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(182, '', '', '', NULL, '', '', '', 0, 15, 40, 'no', 'no', 'yes', 26, '15/182/', '182', NULL, 'public/files/marker/map_marker_sport.png', 'public/files/marker/marker_sport.png', '', NULL, NULL, NULL, NULL, 'Фітнес центри, спортклуби', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(183, '', '', '', NULL, '', '', '', 0, 15, 50, 'no', 'no', 'yes', 26, '15/183/', '183', NULL, 'public/files/marker/map_marker_shop.png', 'public/files/marker/marker_shop.png', '', NULL, NULL, NULL, NULL, 'ТРЦ, супермаркети', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, ''),
(184, '', '', '', NULL, '', '', '', 0, 15, 60, 'no', 'no', 'yes', 26, '15/184/', '184', NULL, 'public/files/marker/map_marker_park.png', 'public/files/marker/marker_park.png', '', NULL, NULL, NULL, NULL, 'Місця для відпочинку', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '0', '0', '0', '', NULL, '0', '0', NULL, NULL, 14, '', '', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `_settings`
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
-- Dumping data for table `_settings`
--

INSERT INTO `_settings` (`id`, `email`, `email_2`, `pages`, `pagination_ad`, `allow_ips`) VALUES
(1, 'support@realist.digital', '', 2, 15, '');

-- --------------------------------------------------------

--
-- Table structure for table `_shop_customers`
--

CREATE TABLE IF NOT EXISTS `_shop_customers` (
  `order` int(11) NOT NULL AUTO_INCREMENT,
  `all_price` decimal(10,2) NOT NULL,
  `all_count` int(5) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `fio` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заказы' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `_shop_orders`
--

CREATE TABLE IF NOT EXISTS `_shop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_good` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `count` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `_subscribe`
--

CREATE TABLE IF NOT EXISTS `_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `flag` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `_translation`
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
-- Dumping data for table `_translation`
--

INSERT INTO `_translation` (`id`, `key`, `name_ru`, `name_en`, `name_ua`) VALUES
(1, NULL, 'Тестовый перевод', 'Тестовый перевод', 'Тестовый перевод');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
