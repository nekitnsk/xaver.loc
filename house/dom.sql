-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `dom`;
CREATE TABLE `dom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `seo_name` text NOT NULL,
  `head1` text NOT NULL,
  `head2` text NOT NULL,
  `roof` text NOT NULL,
  `wall` text NOT NULL,
  `fundament` text NOT NULL,
  `feature1` text NOT NULL,
  `feature2` text NOT NULL,
  `feature3` text NOT NULL,
  `feature4` text NOT NULL,
  `feature5` text NOT NULL,
  `feature6` text NOT NULL,
  `feature7` text NOT NULL,
  `feature8` text NOT NULL,
  `feature9` text NOT NULL,
  `feature10` text NOT NULL,
  `feature2_desc` text NOT NULL,
  `feature1_desc` text NOT NULL,
  `feature4_desc` text NOT NULL,
  `feature6_desc` text NOT NULL,
  `feature5_desc` text NOT NULL,
  `feature3_desc` text NOT NULL,
  `feature7_desc` text NOT NULL,
  `feature9_desc` text NOT NULL,
  `feature8_desc` text NOT NULL,
  `feature10_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2015-07-08 10:54:21
