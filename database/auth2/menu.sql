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
