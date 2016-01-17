/*
 Navicat Premium Data Transfer

 Source Server         : xampp localhost
 Source Server Type    : MySQL
 Source Server Version : 50624
 Source Host           : localhost
 Source Database       : OTRADE

 Target Server Type    : MySQL
 Target Server Version : 50624
 File Encoding         : utf-8

 Date: 01/17/2016 22:12:00 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `os_brand`
-- ----------------------------
DROP TABLE IF EXISTS `os_brand`;
CREATE TABLE `os_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(200) NOT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_valid` int(11) DEFAULT '1' COMMENT '1:valid, 0 not valid',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `os_brand`
-- ----------------------------
BEGIN;
INSERT INTO `os_brand` VALUES ('8', 'Swisse', '2016-01-17 18:11:25', '1'), ('2', 'Apatami', '2016-01-14 22:18:09', '1'), ('6', 'A2', '2016-01-17 17:55:32', '1'), ('7', 'A2', '2016-01-17 17:56:00', '1'), ('9', 'blackmore', '2016-01-17 18:11:45', '1'), ('10', 'A2', '2016-01-17 18:13:14', '0');
COMMIT;

-- ----------------------------
--  Table structure for `os_category`
-- ----------------------------
DROP TABLE IF EXISTS `os_category`;
CREATE TABLE `os_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `is_valid` int(11) DEFAULT '1',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `os_category`
-- ----------------------------
BEGIN;
INSERT INTO `os_category` VALUES ('2', 'Health', '1', '2016-01-17 22:05:04'), ('3', 'Beauty', '1', '2016-01-17 22:05:33'), ('4', 'Vitamins', '0', '2016-01-17 22:07:25'), ('6', 'test', '0', '2016-01-17 22:11:20');
COMMIT;

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

SET FOREIGN_KEY_CHECKS = 1;
