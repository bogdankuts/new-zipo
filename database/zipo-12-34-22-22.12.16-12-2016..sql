# ************************************************************
# Sequel Pro SQL dump
# Версия 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.7.15)
# Схема: zipo
# Время создания: 2016-12-22 10:34:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы item_sale
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_sale`;

CREATE TABLE `item_sale` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

LOCK TABLES `item_sale` WRITE;
/*!40000 ALTER TABLE `item_sale` DISABLE KEYS */;

INSERT INTO `item_sale` (`id`, `sale_id`, `item_id`)
VALUES
	(3,1,8),
	(4,1,9),
	(5,1,10),
	(9,1,4713),
	(10,1,4719),
	(11,1,4717);

/*!40000 ALTER TABLE `item_sale` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы sales
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `description` text,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `changed_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;

INSERT INTO `sales` (`id`, `title`, `url`, `description`, `start_date`, `end_date`, `changed_by`)
VALUES
	(1,'Новогодняя распродажа','new-year-sale','Только в этом месяце - рекордная предновогодняя распродажа, сотни товаров с огромными скидками. Только с 20 по 30 декабря! Спешите. <br>На этой странице представлены все акционные товары, цены указаны с учетом скидок.','2016-12-22 00:00:01','2017-01-22 00:00:01',7);

/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
