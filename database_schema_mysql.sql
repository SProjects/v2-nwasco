# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: us-cdbr-iron-east-04.cleardb.net (MySQL 5.5.46-log)
# Database: heroku_9d1f25f74e0ed9a
# Generation Time: 2016-09-23 17:57:45 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table utilities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `utilities`;

CREATE TABLE `utilities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `abbreviation` varchar(11) NOT NULL DEFAULT '',
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `utilities` WRITE;
/*!40000 ALTER TABLE `utilities` DISABLE KEYS */;

INSERT INTO `utilities` (`id`, `name`, `abbreviation`, `user_id`)
VALUES
  (1,'Luapula WSC','LPWSC',NULL),
  (2,'Chambeshi WSC','CHWSC',NULL),
  (3,'Eastern WSC','EWSC',NULL),
  (4,'Lukanga','LGWSC',NULL),
  (5,'Mulonga WSC','MWSC',NULL),
  (6,'Nkana WSC','NWSC',NULL),
  (7,'Kafubu WSC','KWSC',NULL),
  (8,'Lusaka WSC','LWSC',NULL),
  (9,'Southern WSC','SWSC',NULL),
  (10,'Western WSC','WWSC',NULL),
  (11,'N-Western WSC','NWWSC',NULL);

/*!40000 ALTER TABLE `utilities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`)
VALUES
  (1,'admin','Administrator'),
  (2,'chief_inspector','Chief Inspector'),
  (12,'senior_inspector','Senior Inspector'),
  (22,'inspector','Junior Inspector'),
  (32,'guests','Guest');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table indicator_instructions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `indicator_instructions`;

CREATE TABLE `indicator_instructions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  `union_token` varchar(20) NOT NULL DEFAULT '',
  `indicator_property_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `utility_id` int(11) DEFAULT NULL,
  `scheme_id` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table indicator_properties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `indicator_properties`;

CREATE TABLE `indicator_properties` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT NULL,
  `datatype` varchar(20) NOT NULL DEFAULT '',
  `indicator_id` int(11) DEFAULT NULL,
  `token` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table indicators
# ------------------------------------------------------------

DROP TABLE IF EXISTS `indicators`;

CREATE TABLE `indicators` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `kind` varchar(20) DEFAULT NULL,
  `days_to_expire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `indicators` WRITE;
/*!40000 ALTER TABLE `indicators` DISABLE KEYS */;

INSERT INTO `indicators` (`id`, `name`, `description`, `kind`, `days_to_expire`)
VALUES
  (1,'Directives','Inspection Directives','UTILITY',NULL),
  (2,'Tariff Conditions','Tariff Conditions','UTILITY',NULL),
  (3,'SRS','Special Regulatory Supervision','UTILITY',NULL),
  (4,'Projects','WSS Projects','UTILITY',NULL),
  (5,'RBI','Regulation by Incentives','UTILITY',NULL),
  (6,'SLAs/ SLGs','Service Level Guarantees and Agreements ','UTILITY',NULL),
  (12,'Directives','Inspection Directives','SCHEME',NULL),
  (22,'OL','Operating License','SCHEME',NULL),
  (32,'SLAs/SLGs','Service Level Guarantees and Agreements','SCHEME',NULL);

/*!40000 ALTER TABLE `indicators` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table schemes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `schemes`;

CREATE TABLE `schemes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `schemes` WRITE;
/*!40000 ALTER TABLE `schemes` DISABLE KEYS */;

INSERT INTO `schemes` (`id`, `name`, `user_id`)
VALUES
  (1,'Zesco Limited',NULL),
  (2,'Zambia Sugar pls',NULL),
  (3,'Lafarge cement plc',NULL),
  (4,'Maamba Collieries Limited',NULL),
  (5,'Konkola Copper Mines plc',NULL),
  (6,'Kaleya Smallholders',NULL),
  (7,'Kafue Sugar',NULL);

/*!40000 ALTER TABLE `schemes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kind` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `instruction_token` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `indicator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`)
VALUES
  (1,'127.0.0.1','admin','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,'pEzxKZ5IDdQyPf30AkuuM.',1268889823,1474652881,1,'Admin','Admin','ADMIN','0705245356');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`)
VALUES
  (12,1,1),
  (22,1,32);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
