/*
Navicat MariaDB Data Transfer

Source Server         : MariaDB
Source Server Version : 100109
Source Host           : localhost:3306
Source Database       : db_rmh

Target Server Type    : MariaDB
Target Server Version : 100109
File Encoding         : 65001

Date: 2016-08-25 00:41:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pengaturan
-- ----------------------------
DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan` (
  `pengaturan_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_tipe` varchar(20) DEFAULT NULL,
  `setting_name` varchar(20) DEFAULT NULL,
  `setting_value` varchar(255) DEFAULT NULL,
  `setting_field` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pengaturan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengaturan
-- ----------------------------
INSERT INTO `pengaturan` VALUES ('1', 'site_title', 'Nama Situs', 'Rekam Medis', 'text');
INSERT INTO `pengaturan` VALUES ('2', 'site_description', 'Deskripsi Situs', 'Aplikasi rekam medis', 'text');
INSERT INTO `pengaturan` VALUES ('3', 'site_keyword', 'Keyword Situs', 'gatau', 'text');
INSERT INTO `pengaturan` VALUES ('4', 'site_footer', 'Teks Footer', 'Copyright © 2016. Rekam Medis. All Rights Reserved.', 'text');
INSERT INTO `pengaturan` VALUES ('5', 'site_theme', 'Nama Template', 'default', 'dropdown');
INSERT INTO `pengaturan` VALUES ('6', 'site_address', 'Alamat', 'Jln Bakti Sejati Batureok Lembang\r\nBandung, Indonesia', 'textarea');
INSERT INTO `pengaturan` VALUES ('7', 'site_email_server', 'Email Server', 'info@aboutlembang.com', 'text');
INSERT INTO `pengaturan` VALUES ('8', 'site_phone', 'Phone', '+62896 3990 2197', 'text');
INSERT INTO `pengaturan` VALUES ('9', 'site_language', 'Bahasa', 'indonesia', 'dropdown');
INSERT INTO `pengaturan` VALUES ('10', 'site_author', 'Author', 'Ferdhika Yudira', 'text');
INSERT INTO `pengaturan` VALUES ('11', 'site_list_limit', 'Limit Data Page', '5', 'text');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `deskripsi` text,
  `email_user` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL,
  `user_group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_user_group_idx` (`user_group_id`),
  CONSTRAINT `fk_user_user_group` FOREIGN KEY (`user_group_id`) REFERENCES `user_group` (`user_group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'Ferdhika Yudira', 'Bandung', '1997-08-31', 'Laki-Laki', 'Lembang', '083821708285', 'Apa', 'rpl4rt08@gmail.com', 'ferdhika31', 'bandung0', null, '2016-08-23 18:17:28', '2016-08-23 18:17:25', '1');
INSERT INTO `user` VALUES ('2', 'Reka Alamsyah', 'Bandung', '1997-08-31', 'Laki-Laki', 'Lembang', '083821708285', 'Apa', 'rpl4rt07@gmail.com', 'reka', '1234', '', '2016-08-23 18:17:28', '2016-08-23 18:17:25', '2');
INSERT INTO `user` VALUES ('3', 'Ujang Wahyu', 'Bandung', '1997-08-31', 'Laki-Laki', 'Lembang', '083821708285', 'Apa', 'rpl4rt06@gmail.com', 'uwa', '1234', '', '2016-08-23 18:17:28', '2016-08-23 18:17:25', '3');

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `key_name` varchar(25) DEFAULT NULL,
  `permission` text,
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO `user_group` VALUES ('1', 'Administrator', 'admin', 'a:2:{s:4:\"view\";a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}s:5:\"modif\";a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}}');
INSERT INTO `user_group` VALUES ('2', 'Dokter', 'dokter', 'a:2:{s:4:\"view\";a:0:{}s:5:\"modif\";a:0:{}}');
INSERT INTO `user_group` VALUES ('3', 'Operator', 'operator', 'a:2:{s:4:\"view\";a:0:{}s:5:\"modif\";a:0:{}}');

-- ----------------------------
-- Table structure for user_page
-- ----------------------------
DROP TABLE IF EXISTS `user_page`;
CREATE TABLE `user_page` (
  `user_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(50) DEFAULT NULL,
  `page_url` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_page
-- ----------------------------
INSERT INTO `user_page` VALUES ('1', 'Obat', 'obat');
INSERT INTO `user_page` VALUES ('2', 'User', 'user');
INSERT INTO `user_page` VALUES ('3', 'User Group', 'user_group');
INSERT INTO `user_page` VALUES ('4', 'User Pages', 'user_pages');
