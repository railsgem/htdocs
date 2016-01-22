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

 Date: 01/22/2016 17:15:59 PM
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
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `os_chemist_product`
-- ----------------------------
BEGIN;
INSERT INTO `os_chemist_product` VALUES ('1', '43238', 'Bio-Organics Glucosamine Rapid Cream 100g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/43238/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/43238/original.jpg', '14.99', '2016-01-22 17:15:06'), ('2', '66556', 'Bio-Organics Glucosamine 750mg and Chondroitin 400mg 180 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66556/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66556/original.jpg', '29.99', '2016-01-22 17:15:06'), ('3', '55228', 'Bio-Organics Calcium 600 + Vitamin D3 400 120 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55228/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55228/original.jpg', '11.39', '2016-01-22 17:15:06'), ('4', '66557', 'Bio-Organics Glucosamine Forte 1500mg Tablets 20% Extra 240 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66557/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66557/original.jpg', '23.99', '2016-01-22 17:15:06'), ('5', '51767', 'Bio-Organics Glucosamine Sulfate Complex 1000mg 320 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51767/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51767/original.jpg', '38.39', '2016-01-22 17:15:06'), ('6', '66518', 'Bio-Organics Super Strength Krill Oil 1200mg 30 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66518/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66518/original.jpg', '21.69', '2016-01-22 17:15:06'), ('7', '51560', 'Bio-Organics Glucosamine Forte 1500mg 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51560/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51560/original.jpg', '23.99', '2016-01-22 17:15:06'), ('8', '52998', 'Bio-Organics CoQ10 150mg Optimal 30 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52998/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52998/original.jpg', '17.39', '2016-01-22 17:15:06'), ('9', '66555', 'Bio-Organics CoQ10 150mg Optimal 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66555/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/66555/original.jpg', '24.99', '2016-01-22 17:15:06'), ('10', '52952', 'Bio-Organics Cranberry 10000mg 150 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52952/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/52952/original.jpg', '34.99', '2016-01-22 17:15:06'), ('11', '53988', 'Bio-Organics Brahmi 6000 Optimal 40 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53988/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53988/original.jpg', '20.39', '2016-01-22 17:15:06'), ('12', '67392', 'Bio-Organics Krill Oil + Glucosamine 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67392/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67392/original.jpg', '26.99', '2016-01-22 17:15:06'), ('13', '55037', 'Bio-Organics Vitamin D3 1000iu 120 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55037/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55037/original.jpg', '8.99', '2016-01-22 17:15:06'), ('14', '55660', 'Bio-Organics Magnesium Forte 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55660/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/55660/original.jpg', '14.99', '2016-01-22 17:15:06'), ('15', '76014', 'Bio-Organics Mega Cranberry MAX 50000 60 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/76014/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/76014/original.jpg', '25.99', '2016-01-22 17:15:06'), ('16', '51864', 'Bio-Organics Cranberry MAX 20000mg 60 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51864/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/51864/original.jpg', '23.99', '2016-01-22 17:15:06'), ('17', '48072', 'Bio-Organics Cranberry 10000+ 90 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/48072/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/48072/original.jpg', '19.99', '2016-01-22 17:15:06'), ('18', '53682', 'Bio-Organics Cranberry MAX 20000mg 100 Tablets', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53682/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/53682/original.jpg', '35.99', '2016-01-22 17:15:06'), ('19', '44645', 'Bio-Organics Tribulus Max 10,000mg 50 Capsules', 'https://static.chemistwarehouse.com.au/ams/media/productimages/44645/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/44645/original.jpg', '25.99', '2016-01-22 17:15:06'), ('20', '67202', 'Bio-Organics Magnesium Forte Powder with CoQ10 and B Vitamins 200g', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67202/150.jpg', 'https://static.chemistwarehouse.com.au/ams/media/productimages/67202/original.jpg', '27.99', '2016-01-22 17:15:06');
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
