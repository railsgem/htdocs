/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : OTRADE

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/14/2016 15:47:23 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `auth_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `auth_sessions`;
CREATE TABLE `auth_sessions` (
  `id` varchar(40) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `auth_sessions`
-- ----------------------------
BEGIN;
INSERT INTO `auth_sessions` VALUES ('0c522750109cd40e4d224df19a685b7c1d4a1092', '4180093998', '2016-01-14 05:18:43', '2016-01-14 15:18:43', '127.0.0.1', 'Chrome 47.0.2526.106 on Mac OS X');
COMMIT;

-- ----------------------------
--  Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `denied_access`
-- ----------------------------
DROP TABLE IF EXISTS `denied_access`;
CREATE TABLE `denied_access` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ips_on_hold`
-- ----------------------------
DROP TABLE IF EXISTS `ips_on_hold`;
CREATE TABLE `ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `login_errors`
-- ----------------------------
DROP TABLE IF EXISTS `login_errors`;
CREATE TABLE `login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ot_brand`
-- ----------------------------
DROP TABLE IF EXISTS `ot_brand`;
CREATE TABLE `ot_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `band_name` varchar(200) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ot_category`
-- ----------------------------
DROP TABLE IF EXISTS `ot_category`;
CREATE TABLE `ot_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ot_product`
-- ----------------------------
DROP TABLE IF EXISTS `ot_product`;
CREATE TABLE `ot_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '产品ID',
  `product_name` varchar(200) NOT NULL,
  `product_chinese_name` varchar(200) DEFAULT NULL,
  `barcode` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_brand` (`brand_id`) USING BTREE,
  KEY `fk_category` (`category_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `username_or_email_on_hold`
-- ----------------------------
DROP TABLE IF EXISTS `username_or_email_on_hold`;
CREATE TABLE `username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `auth_level` tinyint(2) unsigned NOT NULL,
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `passwd` varchar(60) NOT NULL,
  `passwd_recovery_code` varchar(60) DEFAULT NULL,
  `passwd_recovery_date` datetime DEFAULT NULL,
  `passwd_modified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('4180093998', 'skunkbot', 'skunkbot@example.com', '9', '0', '$2y$11$nKIyEFlIDSfexStXP5yqBevBLyfIjCCYx5oIwnHhYJ5S64IK7nIRa', null, null, null, '2016-01-14 05:19:10', '2016-01-14 05:14:42', '2016-01-14 15:20:20');
COMMIT;

-- ----------------------------
--  Triggers structure for table users
-- ----------------------------
DROP TRIGGER IF EXISTS `ca_passwd_trigger`;
delimiter ;;
CREATE TRIGGER `ca_passwd_trigger` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
    IF ((NEW.passwd <=> OLD.passwd) = 0) THEN
        SET NEW.passwd_modified_at = NOW();
    END IF;
END
 ;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
