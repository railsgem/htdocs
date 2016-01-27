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
