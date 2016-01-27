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
