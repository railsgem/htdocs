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
