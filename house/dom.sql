-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `dom`;
CREATE TABLE `dom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `seo_name` varchar(150) NOT NULL,
  `space` varchar(5) DEFAULT NULL,
  `head1` varchar(250) DEFAULT NULL,
  `head2` varchar(250) DEFAULT NULL,
  `roof` tinytext,
  `wall` tinytext,
  `fundament` tinytext,
  `feature1` tinytext,
  `feature2` tinytext,
  `feature3` tinytext,
  `feature4` tinytext,
  `feature5` tinytext,
  `feature6` tinytext,
  `feature7` tinytext,
  `feature8` tinytext,
  `feature9` tinytext,
  `feature10` tinytext,
  `feature2_desc` text,
  `feature1_desc` text,
  `feature4_desc` text,
  `feature6_desc` text,
  `feature5_desc` text,
  `feature3_desc` text,
  `feature7_desc` text,
  `feature9_desc` text,
  `feature8_desc` text,
  `feature10_desc` text,
  `description1` text,
  `title_description2` varchar(200) DEFAULT NULL,
  `description2` text,
  `title_description3` varchar(200) DEFAULT NULL,
  `description3` text,
  `cost` varchar(20) DEFAULT NULL,
  `price` varchar(200) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `default` varchar(5) DEFAULT 'false',
  `main_photo` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `dom` (`id`, `name`, `seo_name`, `space`, `head1`, `head2`, `roof`, `wall`, `fundament`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `feature8`, `feature9`, `feature10`, `feature2_desc`, `feature1_desc`, `feature4_desc`, `feature6_desc`, `feature5_desc`, `feature3_desc`, `feature7_desc`, `feature9_desc`, `feature8_desc`, `feature10_desc`, `description1`, `title_description2`, `description2`, `title_description3`, `description3`, `cost`, `price`, `category`, `default`, `main_photo`) VALUES
(1,	'1',	'1',	NULL,	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	NULL,	'1',	NULL,	'1',	NULL,	'1',	'brick',	'true',	NULL),
(2,	'1',	'1',	NULL,	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	'1',	NULL,	'1',	NULL,	'1',	NULL,	'1',	'brick',	'true',	NULL),
(3,	'2',	'2',	NULL,	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	NULL,	'2',	NULL,	'2',	NULL,	'2',	'brick',	'true',	NULL),
(4,	'3',	'3',	NULL,	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3w',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	NULL,	'3',	'brick',	'true',	NULL),
(5,	'3',	'3',	NULL,	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'3w',	'3',	'3',	'3',	'3',	'3',	'3',	'3',	'Описание дома <br> Jgbcfybt ljvf <br><h1>asdfaksdfadf</h2>',	'3',	'3',	'3',	'3',	NULL,	'3',	'brick',	'true',	NULL),
(6,	'2',	'2',	NULL,	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	'2',	NULL,	'2',	'brick',	'true',	NULL),
(7,	'ДОМ AERO POLAR 42',	'dom-aero-polar-42',	'42',	'ДОМ AERO POLAR 42 ИЗ ДВОЙНОГО БРУСА',	'Дом из двойного бруса',	'Металлочерепица',	'Двойной брус 150х150',	'Винтовые сваи',	'Утепление: ',	'Окна:',	'Внутренняя отделка кровли:',	'Лестница: ',	'Пол:',	'Терраса:',	'',	'',	'',	'',	'немецкий профиль Geolan 8000',	'Эковата экстра толщиной 100 мм.',	'Деревянная поворотная.',	'Террасная доска (Лиственница)',	'Доска пола 30×120 мм.(Евро-пол)',	'Имитация бруса',	'',	'',	'',	'',	'Идеальный дом для круглогодичного проживания!\r\nФинские дома проекта Polar энергосберегающие, экологически чистые!\r\nПосле возведения дом не дает усадки, идеально просушенный брус, при разнице температур 1-2мм.\r\nНе требует дополнительных отделочных работ!\r\nНе требует затрат на вентиляцию!\r\nМинимальные затраты на отопление! Примерно 5000 КВт в год. Без использования котельного оборудования на максимальной мощности.\r\nВ строительстве дома не применяются клей и фенолы, безопасны для аллергиков и людей с хроническими заболеваниями, полностью эко продукт!\r\nСтроительство домов можно осуществлять круглый год!',	'',	'',	'',	'',	'790 000',	'790 000 рублей',	'rod',	'true',	'dom-aero-polar-42-264.jpg');

-- 2015-07-10 10:39:21
