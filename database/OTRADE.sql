/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 50163
 Source Host           : localhost
 Source Database       : OTRADE

 Target Server Type    : MySQL
 Target Server Version : 50163
 File Encoding         : utf-8

 Date: 01/14/2016 00:22:06 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

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

SET FOREIGN_KEY_CHECKS = 1;
