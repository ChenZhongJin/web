-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        10.3.7-MariaDB - mariadb.org binary distribution
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 qiyun_cms 的数据库结构
DROP DATABASE IF EXISTS `qiyun_cms`;
CREATE DATABASE IF NOT EXISTS `qiyun_cms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `qiyun_cms`;

-- 导出  表 qiyun_cms.qiyun_article 结构
DROP TABLE IF EXISTS `qiyun_article`;
CREATE TABLE IF NOT EXISTS `qiyun_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` int(11) DEFAULT 1,
  `origin` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `create_time` int(11) NOT NULL DEFAULT 0,
  `update_time` int(11) NOT NULL DEFAULT 0,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qiyun_article_qiyun_user` (`user_id`),
  KEY `FK_qiyun_article_qiyun_category` (`category_id`),
  CONSTRAINT `FK_qiyun_article_qiyun_category` FOREIGN KEY (`category_id`) REFERENCES `qiyun_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_qiyun_article_qiyun_user` FOREIGN KEY (`user_id`) REFERENCES `qiyun_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_article 的数据：~2 rows (大约)
DELETE FROM `qiyun_article`;
/*!40000 ALTER TABLE `qiyun_article` DISABLE KEYS */;
INSERT INTO `qiyun_article` (`id`, `title`, `keywords`, `description`, `publish`, `origin`, `user_id`, `category_id`, `create_time`, `update_time`, `content`) VALUES
	(34, 'About', '', 'aads', 1, NULL, 1, 12, 1530784748, 1531656557, '<p>aads</p>');
/*!40000 ALTER TABLE `qiyun_article` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_category 结构
DROP TABLE IF EXISTS `qiyun_category`;
CREATE TABLE IF NOT EXISTS `qiyun_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT 0,
  `cname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT 'article=1,product=2',
  `path` varchar(50) COLLATE utf8mb4_unicode_ci,
  `view` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_view` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `path` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_category 的数据：~5 rows (大约)
DELETE FROM `qiyun_category`;
/*!40000 ALTER TABLE `qiyun_category` DISABLE KEYS */;
INSERT INTO `qiyun_category` (`id`, `parent`, `cname`, `type`, `path`, `view`, `type_view`) VALUES
	(12, 0, 'event', 1, 'event', 'view', 'typeview'),
	(22, 0, 'products', 2, 'products', 'products', 'typeview'),
	(23, 22, 'Modified Sine Wave', 2, 'ModifiedSineWave', '', ''),
	(24, 22, 'Pure Sine Wave SP', 2, 'PureSineWaveSP', '', ''),
	(29, 0, 'support', 1, 'support', '', 'typeview');
/*!40000 ALTER TABLE `qiyun_category` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_product 结构
DROP TABLE IF EXISTS `qiyun_product`;
CREATE TABLE IF NOT EXISTS `qiyun_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '页面标题',
  `keywords` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '页面关键字',
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '页面描述',
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '产品名称',
  `model` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '产品型号',
  `category_id` int(11) NOT NULL COMMENT '产品系列',
  `serial_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '产品序列号',
  `preview` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '预览图',
  `trait` text COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '产品特点',
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '页面内容',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qiyun_product_qiyun_user` (`category_id`),
  CONSTRAINT `FK_qiyun_product_qiyun_user` FOREIGN KEY (`category_id`) REFERENCES `qiyun_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_product 的数据：~8 rows (大约)
DELETE FROM `qiyun_product`;
/*!40000 ALTER TABLE `qiyun_product` DISABLE KEYS */;
INSERT INTO `qiyun_product` (`id`, `title`, `keywords`, `description`, `name`, `model`, `category_id`, `serial_number`, `preview`, `trait`, `content`, `create_time`) VALUES
	(13, 'Modified Sine Wave vP3000Wc', '', '', 'vp3000Wc', 'vp3000Wc', 23, '', '"{\\"HTB1JHzfHpXXXXX_XFXXq6xXFXXXr.jpg\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/49251c389b50adcdce361b17c52529ed.jpg\\"}"', '<p>&bull; Consumer Electronics: Marine portable audio, TV, amplifier, high-fidelity 4-channel equalizer</p>\r\n<p>&bull; Computer / mobile office: fax machines, laptop</p>\r\n<p>&bull; Adapter / battery charger: phone chargers, rechargeable drill, camera adapter</p>\r\n<p>&bull; Light: ordinary work lights,ordinary Incandescent desk lamp, spotlight, low spotlight</p>\r\n<p>&bull; Motor Pump: motors, air compressors</p>\r\n<p>&bull; Power tools: electric drill, electric saw, scroll saw, grinder, torch, circular saw, weeder, vacuum cleaner, lawnmower,</p>\r\n<p>&bull; Home: Toaster, blender, food processing machines, dryers, toasters, washing machines, coffee pots, refrigerators, microwave ovens, air conditioners, electric kettle, etc.</p>', '<p><strong data-spm-anchor-id="a2700.8304367.prilbd6e79.i14.1d1d5957tvpYHR">12v 220v 1500W ups with 20A charger for home and outdoor power supply&nbsp;</strong></p>\n<p>&nbsp;</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i13.1d1d5957tvpYHR">It can convert DC12V electricity provided the automobile into AC power, and be widely used with those electric equipments which power consumption are less than 180w, such as notebook, cell phone, razor, digital camera, digital video, TV, CD, DVD, game machine, electric light, charge and various kinds of professional tools, as the necessity for your travel, mobile office, outdoor work and special vehicle, it is the very solution to using electricity in the automobile.</p>\n<p>With the multiple protection circuit, it would do no harm to the equipment and automobile</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i12.1d1d5957tvpYHR">Special versatile socket, suitable for various kinds of plugs</p>\n<table class="aliDataTable" style="height: 414px;" border="1" cellspacing="0" cellpadding="0">\n<tbody>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left" data-spm-anchor-id="a2700.8304367.prilbd6e79.i10.1d1d5957tvpYHR">Rated power</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>1500W</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Input&nbsp;voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>DC12V</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>AC110V/AC220V&nbsp; 60Hz/50Hz</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output waveform</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Modified Sine Wave</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">USB output</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>5V/0.5A</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Protection Function</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Over voltage shutdown/Low voltage shutdown/Overload protection</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Sheathing material</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Aluminium Alloys</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Size:L&times;W&times;H</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>390&times;235&times;60 mm</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">N.W</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i3.1d1d5957tvpYHR">3.5&nbsp;Kg</p>\n</td>\n</tr>\n</tbody>\n</table>', 1),
	(14, 'Modified Sine Wave vP1500wc', '', '', 'vP1500wc', 'vP1500wc', 23, '', '"{\\"HTB1yq_gHpXXXXbpXpXXq6xXFXXXK\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/06cda32217e3b17a5083b1c450765219.jpg\\"}"', '<p>&bull; Consumer Electronics: Marine portable audio, TV, amplifier, high-fidelity 4-channel equalizer</p>\r\n<p>&bull; Computer / mobile office: fax machines, laptop</p>\r\n<p>&bull; Adapter / battery charger: phone chargers, rechargeable drill, camera adapter</p>\r\n<p>&bull; Light: ordinary work lights,ordinary Incandescent desk lamp, spotlight, low spotlight</p>\r\n<p>&bull; Motor Pump: motors, air compressors</p>\r\n<p>&bull; Power tools: electric drill, electric saw, scroll saw, grinder, torch, circular saw, weeder, vacuum cleaner, lawnmower,</p>\r\n<p>&bull; Home: Toaster, blender, food processing machines, dryers, toasters, washing machines, coffee pots, refrigerators, microwave ovens, air conditioners, electric kettle, etc.</p>', '<p><strong data-spm-anchor-id="a2700.8304367.prilbd6e79.i14.1d1d5957tvpYHR">12v 220v 1500W ups with 20A charger for home and outdoor power supply&nbsp;</strong></p>\n<p>&nbsp;</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i13.1d1d5957tvpYHR">It can convert DC12V electricity provided the automobile into AC power, and be widely used with those electric equipments which power consumption are less than 180w, such as notebook, cell phone, razor, digital camera, digital video, TV, CD, DVD, game machine, electric light, charge and various kinds of professional tools, as the necessity for your travel, mobile office, outdoor work and special vehicle, it is the very solution to using electricity in the automobile.</p>\n<p>With the multiple protection circuit, it would do no harm to the equipment and automobile</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i12.1d1d5957tvpYHR">Special versatile socket, suitable for various kinds of plugs</p>\n<table class="aliDataTable" style="height: 414px;" border="1" cellspacing="0" cellpadding="0">\n<tbody>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left" data-spm-anchor-id="a2700.8304367.prilbd6e79.i10.1d1d5957tvpYHR">Rated power</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>1500W</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Input&nbsp;voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>DC12V</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>AC110V/AC220V&nbsp; 60Hz/50Hz</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output waveform</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Modified Sine Wave</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">USB output</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>5V/0.5A</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Protection Function</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Over voltage shutdown/Low voltage shutdown/Overload protection</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Sheathing material</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Aluminium Alloys</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Size:L&times;W&times;H</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>390&times;235&times;60 mm</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">N.W</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i3.1d1d5957tvpYHR">3.5&nbsp;Kg</p>\n</td>\n</tr>\n</tbody>\n</table>', 1),
	(15, 'Modified Sine Wave vp800wc', '', '', 'vp800wc', 'vp800wc', 22, '', '"{\\"800.jpg\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/dbcf854045288863bbb1ef677b743947.jpg\\"}"', '<p>&bull; Consumer Electronics: Marine portable audio, TV, amplifier, high-fidelity 4-channel equalizer</p>\n<p>&bull; Computer / mobile office: fax machines, laptop</p>\n<p>&bull; Adapter / battery charger: phone chargers, rechargeable drill, camera adapter</p>\n<p>&bull; Light: ordinary work lights,ordinary Incandescent desk lamp, spotlight, low spotlight</p>\n<p>&bull; Motor Pump: motors, air compressors</p>\n<p>&bull; Power tools: electric drill, electric saw, scroll saw, grinder, torch, circular saw, weeder, vacuum cleaner, lawnmower,</p>\n<p>&bull; Home: Toaster, blender, food processing machines, dryers, toasters, washing machines, coffee pots, refrigerators, microwave ovens, air conditioners, electric kettle, etc.</p>', '<p><strong data-spm-anchor-id="a2700.8304367.prilbd6e79.i14.1d1d5957tvpYHR">12v 220v 1500W ups with 20A charger for home and outdoor power supply&nbsp;</strong></p>\n<p>&nbsp;</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i13.1d1d5957tvpYHR">It can convert DC12V electricity provided the automobile into AC power, and be widely used with those electric equipments which power consumption are less than 180w, such as notebook, cell phone, razor, digital camera, digital video, TV, CD, DVD, game machine, electric light, charge and various kinds of professional tools, as the necessity for your travel, mobile office, outdoor work and special vehicle, it is the very solution to using electricity in the automobile.</p>\n<p>With the multiple protection circuit, it would do no harm to the equipment and automobile</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i12.1d1d5957tvpYHR">Special versatile socket, suitable for various kinds of plugs</p>\n<table class="aliDataTable" style="height: 414px;" border="1" cellspacing="0" cellpadding="0">\n<tbody>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left" data-spm-anchor-id="a2700.8304367.prilbd6e79.i10.1d1d5957tvpYHR">Rated power</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>1500W</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Input&nbsp;voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>DC12V</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>AC110V/AC220V&nbsp; 60Hz/50Hz</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output waveform</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Modified Sine Wave</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">USB output</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>5V/0.5A</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Protection Function</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Over voltage shutdown/Low voltage shutdown/Overload protection</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Sheathing material</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Aluminium Alloys</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Size:L&times;W&times;H</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>390&times;235&times;60 mm</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">N.W</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i3.1d1d5957tvpYHR">3.5&nbsp;Kg</p>\n</td>\n</tr>\n</tbody>\n</table>', 1),
	(16, 'Modified Sine Wave vp500wc', '', '', 'vp500wc', 'vp500wc', 23, '', '"{\\"500\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/fe5c16b22d3c567b2dba57be319be9a5.jpg\\"}"', '<p>power inverter 220v 12v 2400w pure sine wave off grid solar inverter charger 24v UPS inverter solar inverter Available for general use of electrical appliances(laptop, mobile phone charging,digital product,small power of household appliances etc.)</p>', '<p><strong data-spm-anchor-id="a2700.8304367.prilbd6e79.i14.1d1d5957tvpYHR">12v 220v 1500W ups with 20A charger for home and outdoor power supply&nbsp;</strong></p>\n<p>&nbsp;</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i13.1d1d5957tvpYHR">It can convert DC12V electricity provided the automobile into AC power, and be widely used with those electric equipments which power consumption are less than 180w, such as notebook, cell phone, razor, digital camera, digital video, TV, CD, DVD, game machine, electric light, charge and various kinds of professional tools, as the necessity for your travel, mobile office, outdoor work and special vehicle, it is the very solution to using electricity in the automobile.</p>\n<p>With the multiple protection circuit, it would do no harm to the equipment and automobile</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i12.1d1d5957tvpYHR">Special versatile socket, suitable for various kinds of plugs</p>\n<table class="aliDataTable" style="height: 414px;" border="1" cellspacing="0" cellpadding="0">\n<tbody>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left" data-spm-anchor-id="a2700.8304367.prilbd6e79.i10.1d1d5957tvpYHR">Rated power</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>1500W</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Input&nbsp;voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>DC12V</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>AC110V/AC220V&nbsp; 60Hz/50Hz</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output waveform</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Modified Sine Wave</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">USB output</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>5V/0.5A</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Protection Function</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Over voltage shutdown/Low voltage shutdown/Overload protection</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Sheathing material</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Aluminium Alloys</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Size:L&times;W&times;H</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>390&times;235&times;60 mm</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">N.W</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i3.1d1d5957tvpYHR">3.5&nbsp;Kg</p>\n</td>\n</tr>\n</tbody>\n</table>', 21),
	(17, 'Modified Sine Wave vp300wc', '', '', 'vp300wc', 'vp300wc', 23, '', '"{\\"300\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/16e622047c131869611280ffbfed2b48.jpg\\"}"', '<p>Small size , light weight and portable</p>\n<p>Easy to use and high efficiency</p>\n<p>Green LED indicates power on,Red LED indicates wrong</p>\n<p>Input &amp; output isolation Muti-protection function</p>\n<p>USB output port: 5V 500mA,Built-in Cooling Fan</p>', '<p><strong data-spm-anchor-id="a2700.8304367.prilbd6e79.i14.1d1d5957tvpYHR">12v 220v 1500W ups with 20A charger for home and outdoor power supply&nbsp;</strong></p>\n<p>&nbsp;</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i13.1d1d5957tvpYHR">It can convert DC12V electricity provided the automobile into AC power, and be widely used with those electric equipments which power consumption are less than 180w, such as notebook, cell phone, razor, digital camera, digital video, TV, CD, DVD, game machine, electric light, charge and various kinds of professional tools, as the necessity for your travel, mobile office, outdoor work and special vehicle, it is the very solution to using electricity in the automobile.</p>\n<p>With the multiple protection circuit, it would do no harm to the equipment and automobile</p>\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i12.1d1d5957tvpYHR">Special versatile socket, suitable for various kinds of plugs</p>\n<table class="aliDataTable" style="height: 414px;" border="1" cellspacing="0" cellpadding="0">\n<tbody>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left" data-spm-anchor-id="a2700.8304367.prilbd6e79.i10.1d1d5957tvpYHR">Rated power</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>1500W</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Input&nbsp;voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>DC12V</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output voltage</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>AC110V/AC220V&nbsp; 60Hz/50Hz</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Output waveform</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Modified Sine Wave</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">USB output</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>5V/0.5A</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Protection Function</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Over voltage shutdown/Low voltage shutdown/Overload protection</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Sheathing material</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>Aluminium Alloys</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">Size:L&times;W&times;H</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p>390&times;235&times;60 mm</p>\n</td>\n</tr>\n<tr style="height: 46px;">\n<td style="height: 46px; width: 136px;">\n<p align="left">N.W</p>\n</td>\n<td style="height: 46px; width: 472px;">\n<p data-spm-anchor-id="a2700.8304367.prilbd6e79.i3.1d1d5957tvpYHR">3.5&nbsp;Kg</p>\n</td>\n</tr>\n</tbody>\n</table>', 3),
	(20, 'DC-AC pure sine wave inverter', '', '', 'SP300W', 'SP300W', 22, '', '"{\\"2.png\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/cdc5e250c6f0bd24ad8a9c6f54448b98.png\\"}"', '<p>power inverter 220v 12v 2400w pure sine wave off grid solar inverter charger 24v UPS inverter solar inverter Available for general use of electrical appliances(laptop, mobile phone charging,digital product,small power of household appliances etc.)</p>', '<p><img src="/data/20180705/4775855a1183aa425612dd5c35c267f1.png" alt="" /><img src="/data/20180705/b5145f6a673eca2ad0b8e01e6c3544a8.png" alt="" /></p>\n<p><img src="/data/20180705/bba1ae9cad24af3d2abcc2ee224bbb9f.png" alt="" /></p>\n<p><img src="/data/20180705/af4a6840af7e8cdc77bb81fa7e675fea.png" alt="" /></p>\n<p><img src="/data/20180705/36fca3601259a67acd7e33069c641660.jpg" alt="" /></p>', 3),
	(21, 'DC-AC pure sine wave inverter', '', '', 'SP300W', 'SP300W', 22, '', '"{\\"2.png\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/cdc5e250c6f0bd24ad8a9c6f54448b98.png\\"}"', '<p>power inverter 220v 12v 2400w pure sine wave off grid solar inverter charger 24v UPS inverter solar inverter Available for general use of electrical appliances(laptop, mobile phone charging,digital product,small power of household appliances etc.)</p>', '<p><img src="/data/20180705/4775855a1183aa425612dd5c35c267f1.png" alt="" /><img src="/data/20180705/b5145f6a673eca2ad0b8e01e6c3544a8.png" alt="" /></p>\n<p><img src="/data/20180705/bba1ae9cad24af3d2abcc2ee224bbb9f.png" alt="" /></p>\n<p><img src="/data/20180705/af4a6840af7e8cdc77bb81fa7e675fea.png" alt="" /></p>\n<p><img src="/data/20180705/36fca3601259a67acd7e33069c641660.jpg" alt="" /></p>', 43),
	(22, 'DC-AC pure sine wave inverter', '', '', 'SP300W', 'SP300W', 22, '', '"{\\"2.png\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/cdc5e250c6f0bd24ad8a9c6f54448b98.png\\"}"', '<p>power inverter 220v 12v 2400w pure sine wave off grid solar inverter charger 24v UPS inverter solar inverter Available for general use of electrical appliances(laptop, mobile phone charging,digital product,small power of household appliances etc.)</p>', '<p><img src="/data/20180705/4775855a1183aa425612dd5c35c267f1.png" alt="" /><img src="/data/20180705/b5145f6a673eca2ad0b8e01e6c3544a8.png" alt="" /></p>\n<p><img src="/data/20180705/bba1ae9cad24af3d2abcc2ee224bbb9f.png" alt="" /></p>\n<p><img src="/data/20180705/af4a6840af7e8cdc77bb81fa7e675fea.png" alt="" /></p>\n<p><img src="/data/20180705/36fca3601259a67acd7e33069c641660.jpg" alt="" /></p>', 23),
	(23, 'DC-AC pure sine wave inverter', '', '', 'SP300W', 'SP300W', 22, '', '"{\\"2.png\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/cdc5e250c6f0bd24ad8a9c6f54448b98.png\\"}"', '<p>power inverter 220v 12v 2400w pure sine wave off grid solar inverter charger 24v UPS inverter solar inverter Available for general use of electrical appliances(laptop, mobile phone charging,digital product,small power of household appliances etc.)</p>', '<p><img src="/data/20180705/4775855a1183aa425612dd5c35c267f1.png" alt="" /><img src="/data/20180705/b5145f6a673eca2ad0b8e01e6c3544a8.png" alt="" /></p>\n<p><img src="/data/20180705/bba1ae9cad24af3d2abcc2ee224bbb9f.png" alt="" /></p>\n<p><img src="/data/20180705/af4a6840af7e8cdc77bb81fa7e675fea.png" alt="" /></p>\n<p><img src="/data/20180705/36fca3601259a67acd7e33069c641660.jpg" alt="" /></p>', 42),
	(24, 'DC-AC pure sine wave inverter', '', '', 'SP300W', 'SP300W', 22, '', '"{\\"2.png\\":\\"\\\\\\/data\\\\\\/20180705\\\\\\/cdc5e250c6f0bd24ad8a9c6f54448b98.png\\"}"', '<p>power inverter 220v 12v 2400w pure sine wave off grid solar inverter charger 24v UPS inverter solar inverter Available for general use of electrical appliances(laptop, mobile phone charging,digital product,small power of household appliances etc.)</p>', '<p><img src="/data/20180705/4775855a1183aa425612dd5c35c267f1.png" alt="" /><img src="/data/20180705/b5145f6a673eca2ad0b8e01e6c3544a8.png" alt="" /></p>\n<p><img src="/data/20180705/bba1ae9cad24af3d2abcc2ee224bbb9f.png" alt="" /></p>\n<p><img src="/data/20180705/af4a6840af7e8cdc77bb81fa7e675fea.png" alt="" /></p>\n<p><img src="/data/20180705/36fca3601259a67acd7e33069c641660.jpg" alt="" /></p>', 564);
/*!40000 ALTER TABLE `qiyun_product` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_role 结构
DROP TABLE IF EXISTS `qiyun_role`;
CREATE TABLE IF NOT EXISTS `qiyun_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_role 的数据：~0 rows (大约)
DELETE FROM `qiyun_role`;
/*!40000 ALTER TABLE `qiyun_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `qiyun_role` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_role_access 结构
DROP TABLE IF EXISTS `qiyun_role_access`;
CREATE TABLE IF NOT EXISTS `qiyun_role_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_role_access 的数据：~0 rows (大约)
DELETE FROM `qiyun_role_access`;
/*!40000 ALTER TABLE `qiyun_role_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `qiyun_role_access` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_role_mid_access 结构
DROP TABLE IF EXISTS `qiyun_role_mid_access`;
CREATE TABLE IF NOT EXISTS `qiyun_role_mid_access` (
  `role_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`access_id`),
  KEY `FK_qiyun_role_mid_access_qiyun_role_access` (`access_id`),
  CONSTRAINT `FK_qiyun_role_mid_access_qiyun_role` FOREIGN KEY (`role_id`) REFERENCES `qiyun_role` (`id`),
  CONSTRAINT `FK_qiyun_role_mid_access_qiyun_role_access` FOREIGN KEY (`access_id`) REFERENCES `qiyun_role_access` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_role_mid_access 的数据：~0 rows (大约)
DELETE FROM `qiyun_role_mid_access`;
/*!40000 ALTER TABLE `qiyun_role_mid_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `qiyun_role_mid_access` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_role_user 结构
DROP TABLE IF EXISTS `qiyun_role_user`;
CREATE TABLE IF NOT EXISTS `qiyun_role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `FK__qiyun_user` (`user_id`),
  CONSTRAINT `FK__qiyun_role` FOREIGN KEY (`role_id`) REFERENCES `qiyun_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__qiyun_user` FOREIGN KEY (`user_id`) REFERENCES `qiyun_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_role_user 的数据：~0 rows (大约)
DELETE FROM `qiyun_role_user`;
/*!40000 ALTER TABLE `qiyun_role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `qiyun_role_user` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_site 结构
DROP TABLE IF EXISTS `qiyun_site`;
CREATE TABLE IF NOT EXISTS `qiyun_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_site 的数据：~4 rows (大约)
DELETE FROM `qiyun_site`;
/*!40000 ALTER TABLE `qiyun_site` DISABLE KEYS */;
INSERT INTO `qiyun_site` (`id`, `name`, `cname`, `content`) VALUES
	(1, 'webhost', '站点地址', 'cms.io'),
	(2, 'phone', '手机号', '180000000'),
	(3, 'tel', '电话', '+86 0371 67676756'),
	(14, 'mail', '邮箱', 'admin@fullsolar.com');
/*!40000 ALTER TABLE `qiyun_site` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_task 结构
DROP TABLE IF EXISTS `qiyun_task`;
CREATE TABLE IF NOT EXISTS `qiyun_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `command` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_task 的数据：~0 rows (大约)
DELETE FROM `qiyun_task`;
/*!40000 ALTER TABLE `qiyun_task` DISABLE KEYS */;
INSERT INTO `qiyun_task` (`id`, `command`, `description`) VALUES
	(1, 'collect', '采集');
/*!40000 ALTER TABLE `qiyun_task` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_task_collect 结构
DROP TABLE IF EXISTS `qiyun_task_collect`;
CREATE TABLE IF NOT EXISTS `qiyun_task_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '列表页链接',
  `xpath_list` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '列表页规则',
  `xpath_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '捕获标题规则',
  `replace_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标题替换规则',
  `xpath_major` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '正文主要块规则',
  `replace_major` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '正文主要块替换规则',
  `xpath_minor` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '正文次要块规则',
  `replace_minor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '正文次要块替换规则',
  PRIMARY KEY (`id`),
  KEY `FK_qiyun_task_collect_qiyun_category` (`category_id`),
  CONSTRAINT `FK_qiyun_task_collect_qiyun_category` FOREIGN KEY (`category_id`) REFERENCES `qiyun_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_task_collect 的数据：~2 rows (大约)
DELETE FROM `qiyun_task_collect`;
/*!40000 ALTER TABLE `qiyun_task_collect` DISABLE KEYS */;
INSERT INTO `qiyun_task_collect` (`id`, `category_id`, `name`, `link`, `xpath_list`, `xpath_title`, `replace_title`, `xpath_major`, `replace_major`, `xpath_minor`, `replace_minor`) VALUES
	(2, 12, 'dytt', 'http://www.dytt8.net/html/gndy/dyzz/index.html', 'div.co_content8:0 table', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 12, 'lol', 'https://www.loldytt.com/', '//*[@id="fenlei"][1]/div[2]/div/ul', '', '', NULL, '', NULL, NULL);
/*!40000 ALTER TABLE `qiyun_task_collect` ENABLE KEYS */;

-- 导出  表 qiyun_cms.qiyun_user 结构
DROP TABLE IF EXISTS `qiyun_user`;
CREATE TABLE IF NOT EXISTS `qiyun_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  qiyun_cms.qiyun_user 的数据：~3 rows (大约)
DELETE FROM `qiyun_user`;
/*!40000 ALTER TABLE `qiyun_user` DISABLE KEYS */;
INSERT INTO `qiyun_user` (`id`, `name`, `cname`, `password`) VALUES
	(1, 'admin', NULL, '0b0b7159f2ba5a8391ba89fc1fdbc69c');
/*!40000 ALTER TABLE `qiyun_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
