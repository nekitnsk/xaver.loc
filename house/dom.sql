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
  `price` varchar(200) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `default` varchar(5) DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2015-07-08 15:44:49
