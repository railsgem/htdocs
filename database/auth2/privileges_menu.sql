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
