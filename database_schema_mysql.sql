# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Database: nwascov
# Generation Time: 2017-03-17 15:32:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
  (32,'guests','Guest'),
  (42,'desk_officer','Desk Officer');

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
  `created_at` date DEFAULT NULL,
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

LOCK TABLES `indicator_properties` WRITE;
/*!40000 ALTER TABLE `indicator_properties` DISABLE KEYS */;

INSERT INTO `indicator_properties` (`id`, `name`, `description`, `datatype`, `indicator_id`, `token`)
VALUES
  (242,'Description','This has the details of the directive','LONG_TEXT',1,'Y6oW0UIfRG'),
  (252,'Due Date','Date of expiry','DATE',1,'VgXNnCSB3t'),
  (272,'Condition','Condition issued to the CU','LONG_TEXT',2,'Lcr7P6pH8J'),
  (292,'Weight','Weight attached to a a tarrif','INTEGER',2,'kdeDTrnLjp'),
  (302,'Due Date','Date of expiry','DATE',2,'vHcfGmiZkM'),
  (312,'Remarks','What happened after the directive was issued','LONG_TEXT',1,'xIwfGUtC5a'),
  (313,'Description','The detailed information of the SRS','LONG_TEXT',3,'mSwa7ZFDHB'),
  (314,'Due Date','Date of expiry','DATE',3,'rcTo8f9WtH'),
  (315,'Remarks','The NWASCO comment on the issue in description','LONG_TEXT',3,'0cgD7vPYxW'),
  (316,'Description','Project detail','LONG_TEXT',4,'h8RWXicq6l'),
  (317,'Target','Target to be achieved','LONG_TEXT',5,'8tqvbpPWrd'),
  (318,'Weight','Weight attached to the target','LONG_TEXT',5,'ujJiOX5MsF'),
  (319,'Due Date','Date of expiry','DATE',5,'KYvb8OUQJI'),
  (320,'Remarks','NWASCO comments','LONG_TEXT',5,'RtT3QuzEH5'),
  (321,'Description','Summary of the SLAs/SLGs','LONG_TEXT',6,'3CuV0ear6y'),
  (322,'Due Date','Date of expiry','DATE',6,'H43pG2LjYz'),
  (323,'Remarks','NWASCO comment','LONG_TEXT',6,'gfP53ZSRHG'),
  (324,'Risk Issues','The area of interest or concern','LONG_TEXT',42,'8onxhcwCgH'),
  (325,'Proposed action to be taken','Proposals from CU to address the issue','LONG_TEXT',42,'Mx5T1Vn9OQ'),
  (326,'Update','Current situation','LONG_TEXT',42,'RK2VYJZANB'),
  (327,'Due Date','Date of next quarterly update                                ','DATE',42,'WCMjw5UJae'),
  (328,'Description','Detail of the licence','LONG_TEXT',43,'v0pehYCZ82'),
  (329,'Due Date','Date of expiry','DATE',43,'ciImto1UOG'),
  (330,'Remarks','NWASCO comments','LONG_TEXT',43,'vbcDzjioGm'),
  (331,'Description','Directive issued to a CU','LONG_TEXT',12,'tynKuZ4Tmo'),
  (332,'Due Date','Date of expiry','DATE',12,'ieYzvjAksQ'),
  (333,'Remarks','NWASCO comment','LONG_TEXT',12,'0sIKnHWvz6'),
  (334,'Description','Licence issued to the CU','LONG_TEXT',22,'0seJvQO91N'),
  (335,'Due Date','Date of expiry','DATE',22,'eQRq90mFtV'),
  (336,'Remarks','Comment from NWASCO','LONG_TEXT',22,'FSbJs5L4U0'),
  (337,'Description','SLGs/SLAs issued to a CU','LONG_TEXT',32,'niQF9JsBL6'),
  (338,'Due Date','Expiry Date','DATE',32,'Hc1oeu89CZ'),
  (339,'Remarks','NWASCO remarks','LONG_TEXT',32,'euXy0Wtn71');

/*!40000 ALTER TABLE `indicator_properties` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table indicator_summaries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `indicator_summaries`;

CREATE TABLE `indicator_summaries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `overdue` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `almost` int(11) DEFAULT NULL,
  `indicator_id` int(11) DEFAULT NULL,
  `utility_id` int(11) DEFAULT NULL,
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
  `have_chart` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `indicators` WRITE;
/*!40000 ALTER TABLE `indicators` DISABLE KEYS */;

INSERT INTO `indicators` (`id`, `name`, `description`, `kind`, `days_to_expire`, `have_chart`)
VALUES
  (1,'Directives','Inspection Directives                                                                ','UTILITY',5,1),
  (2,'Tariff Conditions','Tariff Conditions                                                                                                                                ','UTILITY',5,1),
  (3,'SRS','Special Regulatory Supervision                                                                ','UTILITY',5,0),
  (4,'Projects','WSS Projects','UTILITY',NULL,NULL),
  (5,'RBI','Regulation by Incentives                                ','UTILITY',5,0),
  (6,'SLAs/ SLGs','Service Level Guarantees and Agreements                                 ','UTILITY',60,0),
  (12,'Directives','Inspection Directives                                ','SCHEME',5,1),
  (22,'Operating License       ','Operating License                                                                  ','SCHEME',90,0),
  (32,'SLAs/SLGs','Service Level Guarantees and Agreements                                ','SCHEME',60,0),
  (42,'Hot Spots','Areas of focus                                ','UTILITY',90,0),
  (43,'Operating License       ','Operating License       ','UTILITY',90,0);

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



# Dump of table requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kind` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reason` text,
  `instruction_token` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `indicator_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
  (1,'127.0.0.1','admin','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,'pEzxKZ5IDdQyPf30AkuuM.',1268889823,1489756210,1,'Admin','Admin','ADMIN','0705245356');

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
  (231,1,1);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;


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
  (11,'N-Western WSC','NWWSC',NULL),
  (12,'Western WSC','WWSC',NULL);

/*!40000 ALTER TABLE `utilities` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
