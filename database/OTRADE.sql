/*
 Navicat Premium Data Transfer

 Source Server         : xampp localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : OTRADE

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 01/24/2016 02:46:04 AM
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
--  Table structure for `os_chemist_product`
-- ----------------------------
DROP TABLE IF EXISTS `os_chemist_product`;
CREATE TABLE `os_chemist_product` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `small_img_src` varchar(255) DEFAULT NULL,
  `big_img_src` varchar(255) DEFAULT NULL,
  `chemist_price` decimal(10,2) DEFAULT NULL,
  `entrytime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `os_chemist_product`
-- ----------------------------
BEGIN;
INSERT INTO `os_chemist_product` VALUES ('1', '43238', 'Bio-Organics Glucosamine Rapid Cream 100g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/43238/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/43238/original.jpg', '14.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('2', '44645', 'Bio-Organics Tribulus Max 10,000mg 50 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/44645/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/44645/original.jpg', '25.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('3', '48072', 'Bio-Organics Cranberry 10000+ 90 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/48072/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/48072/original.jpg', '19.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('4', '51560', 'Bio-Organics Glucosamine Forte 1500mg 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51560/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51560/original.jpg', '23.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('5', '51767', 'Bio-Organics Glucosamine Sulfate Complex 1000mg 320 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51767/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51767/original.jpg', '38.39', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('6', '51864', 'Bio-Organics Cranberry MAX 20000mg 60 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51864/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51864/original.jpg', '23.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('7', '52952', 'Bio-Organics Cranberry 10000mg 150 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52952/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52952/original.jpg', '34.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('8', '52998', 'Bio-Organics CoQ10 150mg Optimal 30 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52998/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52998/original.jpg', '17.39', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('9', '53682', 'Bio-Organics Cranberry MAX 20000mg 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53682/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53682/original.jpg', '35.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('10', '53988', 'Bio-Organics Brahmi 6000 Optimal 40 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53988/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53988/original.jpg', '20.39', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('11', '55037', 'Bio-Organics Vitamin D3 1000iu 120 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55037/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55037/original.jpg', '8.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('12', '55228', 'Bio-Organics Calcium 600 + Vitamin D3 400 120 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55228/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55228/original.jpg', '11.39', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('13', '55660', 'Bio-Organics Magnesium Forte 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55660/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55660/original.jpg', '14.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('14', '66518', 'Bio-Organics Super Strength Krill Oil 1200mg 30 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66518/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66518/original.jpg', '21.69', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('15', '66555', 'Bio-Organics CoQ10 150mg Optimal 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66555/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66555/original.jpg', '24.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('16', '66556', 'Bio-Organics Glucosamine 750mg and Chondroitin 400mg 180 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66556/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66556/original.jpg', '29.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('17', '66557', 'Bio-Organics Glucosamine Forte 1500mg Tablets 20% Extra 240 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66557/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66557/original.jpg', '23.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('18', '67202', 'Bio-Organics Magnesium Forte Powder with CoQ10 and B Vitamins 200g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67202/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67202/original.jpg', '27.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('19', '67392', 'Bio-Organics Krill Oil + Glucosamine 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67392/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67392/original.jpg', '26.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('20', '76014', 'Bio-Organics Mega Cranberry MAX 50000 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/76014/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/76014/original.jpg', '25.99', '2016-01-24 02:22:44', '2016-01-24 02:39:29'), ('32', '53353', 'Karicare+ Goats\' Milk Follow-On Formula From 6 months 900g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53353/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53353/original.jpg', '33.99', '2016-01-24 02:25:06', '2016-01-24 02:38:57'), ('33', '55112', 'Karicare+ Goats\' Milk Infant Formula From Birth 0-6 Months 900g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55112/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55112/original.jpg', '33.99', '2016-01-24 02:25:06', '2016-01-24 02:38:57'), ('34', '56696', 'Karicare+ Soy Milk Infant Formula All Ages From Birth 900g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/56696/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/56696/original.jpg', '19.99', '2016-01-24 02:25:06', '2016-01-24 02:38:57'), ('35', '67872', 'Karicare+ 3 Toddler Growing Up Milk From 1 year 900g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67872/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67872/original.jpg', '17.69', '2016-01-24 02:25:06', '2016-01-24 02:38:57'), ('36', '67873', 'Karicare+ 4 Toddler Growing Up Milk From 2 years 900g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67873/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67873/original.jpg', '17.69', '2016-01-24 02:25:06', '2016-01-24 02:38:57'), ('37', '68394', 'Karicare+ 1 Infant Formula From Birth 0-6 Months 900g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/68394/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/68394/original.jpg', '19.69', '2016-01-24 02:25:06', '2016-01-24 02:38:57'), ('38', '68395', 'Karicare+ 2 Follow-On Formula From 6 months 900g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/68395/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/68395/original.jpg', '19.69', '2016-01-24 02:25:06', '2016-01-24 02:38:57');
COMMIT;

-- ----------------------------
--  Table structure for `os_chemist_product_fetch`
-- ----------------------------
DROP TABLE IF EXISTS `os_chemist_product_fetch`;
CREATE TABLE `os_chemist_product_fetch` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `small_img_src` varchar(255) DEFAULT NULL,
  `big_img_src` varchar(255) DEFAULT NULL,
  `chemist_price` decimal(10,2) DEFAULT NULL,
  `entrytime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `os_chemist_product_fetch`
-- ----------------------------
BEGIN;
INSERT INTO `os_chemist_product_fetch` VALUES ('43238', 'Bio-Organics Glucosamine Rapid Cream 100g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/43238/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/43238/original.jpg', '14.99', '2016-01-24 02:39:29'), ('44645', 'Bio-Organics Tribulus Max 10,000mg 50 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/44645/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/44645/original.jpg', '25.99', '2016-01-24 02:39:29'), ('48072', 'Bio-Organics Cranberry 10000+ 90 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/48072/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/48072/original.jpg', '19.99', '2016-01-24 02:39:29'), ('51560', 'Bio-Organics Glucosamine Forte 1500mg 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51560/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51560/original.jpg', '23.99', '2016-01-24 02:39:29'), ('51767', 'Bio-Organics Glucosamine Sulfate Complex 1000mg 320 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51767/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51767/original.jpg', '38.39', '2016-01-24 02:39:29'), ('51864', 'Bio-Organics Cranberry MAX 20000mg 60 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51864/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51864/original.jpg', '23.99', '2016-01-24 02:39:29'), ('52952', 'Bio-Organics Cranberry 10000mg 150 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52952/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52952/original.jpg', '34.99', '2016-01-24 02:39:29'), ('52998', 'Bio-Organics CoQ10 150mg Optimal 30 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52998/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52998/original.jpg', '17.39', '2016-01-24 02:39:29'), ('53682', 'Bio-Organics Cranberry MAX 20000mg 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53682/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53682/original.jpg', '35.99', '2016-01-24 02:39:29'), ('53988', 'Bio-Organics Brahmi 6000 Optimal 40 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53988/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53988/original.jpg', '20.39', '2016-01-24 02:39:29'), ('55037', 'Bio-Organics Vitamin D3 1000iu 120 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55037/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55037/original.jpg', '8.99', '2016-01-24 02:39:29'), ('55228', 'Bio-Organics Calcium 600 + Vitamin D3 400 120 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55228/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55228/original.jpg', '11.39', '2016-01-24 02:39:29'), ('55660', 'Bio-Organics Magnesium Forte 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55660/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55660/original.jpg', '14.99', '2016-01-24 02:39:29'), ('66518', 'Bio-Organics Super Strength Krill Oil 1200mg 30 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66518/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66518/original.jpg', '21.69', '2016-01-24 02:39:29'), ('66555', 'Bio-Organics CoQ10 150mg Optimal 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66555/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66555/original.jpg', '24.99', '2016-01-24 02:39:29'), ('66556', 'Bio-Organics Glucosamine 750mg and Chondroitin 400mg 180 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66556/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66556/original.jpg', '29.99', '2016-01-24 02:39:29'), ('66557', 'Bio-Organics Glucosamine Forte 1500mg Tablets 20% Extra 240 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66557/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66557/original.jpg', '23.99', '2016-01-24 02:39:29'), ('67202', 'Bio-Organics Magnesium Forte Powder with CoQ10 and B Vitamins 200g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67202/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67202/original.jpg', '27.99', '2016-01-24 02:39:29'), ('67392', 'Bio-Organics Krill Oil + Glucosamine 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67392/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67392/original.jpg', '26.99', '2016-01-24 02:39:29'), ('76014', 'Bio-Organics Mega Cranberry MAX 50000 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/76014/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/76014/original.jpg', '25.99', '2016-01-24 02:39:29');
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
