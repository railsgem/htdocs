/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : stock_manager

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/27/2016 15:06:55 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `groups`
-- ----------------------------
BEGIN;
INSERT INTO `groups` VALUES ('1', 'admin', 'Administrator'), ('2', 'members', 'General User');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : stock_manager

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/27/2016 15:07:16 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : stock_manager

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/27/2016 15:07:26 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `li_id` varchar(255) DEFAULT NULL,
  `a_href` varchar(255) DEFAULT NULL,
  `i_class` varchar(255) DEFAULT NULL,
  `li_text` varchar(255) DEFAULT NULL,
  `display` int(11) DEFAULT NULL,
  `entrytime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `menu`
-- ----------------------------
BEGIN;
INSERT INTO `menu` VALUES ('1', 'store_li', '/index.php/store', 'fa fa-fw fa-shopping-cart', 'Store', '1', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('2', 'product_li', '/index.php/product', 'fa fa-fw fa-home', 'Warehouse', '1', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('3', 'distribution_li', '/index.php/distribution', 'fa fa-fw fa-database', 'Distribution', '1', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('4', 'kounta_li', '/index.php/kounta', 'fa fa-fw fa-refresh', 'Kounta Sync', '1', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('5', 'sales_li', '/index.php/sales', 'fa fa-fw fa-signal', 'Sales Record', '1', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('6', 'stocktake_li', '/index.php/stocktake', 'fa fa-fw fa-barcode', 'Stock Take', '1', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('7', 'kpi_li', '/index.php/kpi', 'fa fa-fw fa-line-chart', 'KPI', '1', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('8', 'brand_li', '/index.php/brand', 'fa fa-fw fa-tags', 'Brand', '0', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('9', 'category_li', '/index.php/category', 'fa fa-fw fa-list', 'Category', '0', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('10', 'setting_li', '/index.php/setting', 'fa fa-fw fa-cog', 'Setting', '0', '2016-01-27 10:12:30', '2016-01-27 10:13:08'), ('11', 'auth_li', '/index.php/auth', 'fa fa-fw fa-cog', 'User Setting', '1', '2016-01-27 10:12:30', '2016-01-27 10:13:08');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;


/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : stock_manager

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/27/2016 15:07:49 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `privileges_menu`
-- ----------------------------
DROP TABLE IF EXISTS `privileges_menu`;
CREATE TABLE `privileges_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `privilege_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_menu_prv` (`menu_id`,`privilege_id`),
  KEY `fk_mp_m1_idx` (`menu_id`),
  KEY `fk_mp_p1_idx` (`privilege_id`),
  CONSTRAINT `prv_menu_ibfk_1` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`),
  CONSTRAINT `prvs_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `privileges_menu`
-- ----------------------------
BEGIN;
INSERT INTO `privileges_menu` VALUES ('1', '1', '1'), ('2', '2', '2'), ('3', '3', '3'), ('4', '4', '4'), ('5', '5', '5'), ('6', '6', '6'), ('7', '7', '7'), ('8', '11', '8');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : stock_manager

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/27/2016 15:07:39 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `privileges`
-- ----------------------------
DROP TABLE IF EXISTS `privileges`;
CREATE TABLE `privileges` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `privileges`
-- ----------------------------
BEGIN;
INSERT INTO `privileges` VALUES ('1', 'store', 'Store'), ('2', 'product', 'Warehouse'), ('3', 'distribution', 'Distribution'), ('4', 'kounta', 'Kounta Sync'), ('5', 'sales', 'Sales Record'), ('6', 'stocktake', 'Stock Take'), ('7', 'kpi', 'KPI List'), ('8', 'auth', 'Users setting'), ('9', 'login', 'Login(default)');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : stock_manager

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/27/2016 15:08:20 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users_groups`
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users_groups`
-- ----------------------------
BEGIN;
INSERT INTO `users_groups` VALUES ('46', '1', '1'), ('47', '1', '2'), ('13', '2', '2'), ('4', '3', '2'), ('5', '4', '2'), ('6', '5', '2'), ('7', '6', '2'), ('53', '10', '2');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : stock_manager

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/27/2016 15:08:27 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users_privileges`
-- ----------------------------
DROP TABLE IF EXISTS `users_privileges`;
CREATE TABLE `users_privileges` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `privilege_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_privileges` (`user_id`,`privilege_id`),
  KEY `fk_users_privileges_users1_idx` (`user_id`),
  KEY `fk_users_privileges_privileges1_idx` (`privilege_id`),
  CONSTRAINT `fk_users_privileges_privileges1` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_privileges_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users_privileges`
-- ----------------------------
BEGIN;
INSERT INTO `users_privileges` VALUES ('43', '1', '1'), ('44', '1', '2'), ('45', '1', '3'), ('46', '1', '4'), ('47', '1', '5'), ('48', '1', '6'), ('49', '1', '7'), ('50', '1', '8'), ('51', '1', '9'), ('2', '2', '2'), ('63', '10', '1'), ('64', '10', '2'), ('65', '10', '4'), ('66', '10', '5'), ('67', '10', '9');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : stock_manager

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/27/2016 15:08:00 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
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
  `psw` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'admin', '$2y$08$FQNBgZCRXKKHMjSMyGrCUOjwmjUzZuOYpO03jT333ChYvvUJE.t.6', '', 'admin@admin.com', '', null, null, 'oBdQNfA3ag.p.ndQVJv2zu', '1268889823', '1453861323', '1', 'Admin', 'istrator', 'ADMIN', '0', 'oneshop123'), ('2', '::1', 'y c', '$2y$08$wMkc3nAJHmM5yqaVoDmNKuPrU6AHMIirVY/Z//KGeuAM4.7X5gPj2', null, 'qq@qqq.com', null, null, null, null, '1453691691', null, '1', 'yaaa', 'c', 'aaaaa', '112121', null), ('3', '::1', 'q c', '$2y$08$jLx3D8/FtulyeTGhFDMpfuHfvTBdP5ThRul87p44JPLO6b6Xhk2f2', null, '1qq@qqq.com', null, null, null, null, '1453692598', null, '1', 'q', 'c', 'ccc', '112121', null), ('4', '::1', 'y2 c2', '$2y$08$JLWZdyNF2fgLST14yya/a.Pn6q8tumwagjfHj5bo5jhpFdAmok1PK', null, '1@asd.com', null, null, null, null, '1453692704', null, '1', 'y2', 'c2', 'ccc', '112121', null), ('5', '::1', 'a b', '$2y$08$VtcuYVzqra57UUqinx9h/eIL2em92.n7UqI7b55kpK2fo3q0u.rIG', null, 'd@d.com', null, null, null, null, '1453692942', null, '1', 'a', 'b', 'c', 'www', null), ('6', '::1', 'a a', '$2y$08$dn28ad4q2Ko93yAsfZhHm.iE6BQEUd31AHB3Oz9jDsysojORETT/6', null, 'a@aa.com', null, null, null, null, '1453697585', null, '1', 'a', 'a', 'a', '11111', null), ('7', '::1', 'c c', '$2y$08$cl/gGttm4PLy9gIh7NKDruzQssk9VfNQX4/hN73aLr/s.JztDhHwa', null, 'c@cc.com', null, null, null, null, '1453702875', null, '1', 'c', 'c', 'c', '1', null), ('8', '::1', 'cc-ccc', '$2y$08$3EP8.zI8ElQQ4ofnJjoSAe5zfBv6OkhQrGIxqwP8y/Qd6VCf97PJC', null, 'cccc@cc.com', null, null, null, null, '1453703337', null, '1', 'cc', 'ccc', 'cc', '1111', null), ('9', '::1', 'kitty', '$2y$08$M.4O0.CrYGKaFBB1g/rZNOlbtTdbijCwO5zYQ759ZcF.qlDx8atZq', null, 'hellokitty@hello.com', null, null, null, null, '1453703640', null, '1', 'hello', 'kitty', 'hellokitty', '1111111111', null), ('10', '::1', 'hellokitty', '$2y$08$Dr9NAWINuMCpgoyLUqen3eWzUsgflj/z833T.AvvCm5/TPIa452A2', null, 'kitty@hello.com', null, null, null, null, '1453703717', '1453863201', '1', 'hello', 'kitty', 'hellokitty', '11111111112', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
