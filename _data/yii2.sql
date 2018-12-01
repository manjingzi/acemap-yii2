/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yii2

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-12-01 08:30:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jj_article`
-- ----------------------------
DROP TABLE IF EXISTS `jj_article`;
CREATE TABLE `jj_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_article
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_article_category`
-- ----------------------------
DROP TABLE IF EXISTS `jj_article_category`;
CREATE TABLE `jj_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_article_category
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_article_comment`
-- ----------------------------
DROP TABLE IF EXISTS `jj_article_comment`;
CREATE TABLE `jj_article_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_article_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_article_content`
-- ----------------------------
DROP TABLE IF EXISTS `jj_article_content`;
CREATE TABLE `jj_article_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_article_content
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_article_tag`
-- ----------------------------
DROP TABLE IF EXISTS `jj_article_tag`;
CREATE TABLE `jj_article_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_article_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `jj_auth_assignment`;
CREATE TABLE `jj_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `jj_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `jj_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_auth_assignment
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `jj_auth_item`;
CREATE TABLE `jj_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `jj_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `jj_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_auth_item
-- ----------------------------
INSERT INTO `jj_auth_item` VALUES ('超级管理', '1', 'erweew', null, null, '1543619646', '1543619657');

-- ----------------------------
-- Table structure for `jj_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `jj_auth_item_child`;
CREATE TABLE `jj_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `jj_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `jj_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jj_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `jj_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_auth_item_child
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_auth_menu`
-- ----------------------------
DROP TABLE IF EXISTS `jj_auth_menu`;
CREATE TABLE `jj_auth_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `route` varchar(100) NOT NULL DEFAULT '' COMMENT '路由',
  PRIMARY KEY (`id`),
  KEY `parent` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_auth_menu
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `jj_auth_rule`;
CREATE TABLE `jj_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_auth_rule
-- ----------------------------
INSERT INTO `jj_auth_rule` VALUES ('common\\rules\\ArticleRule', 0x4F3A32343A22636F6D6D6F6E5C72756C65735C41727469636C6552756C65223A333A7B733A343A226E616D65223B733A32343A22636F6D6D6F6E5C72756C65735C41727469636C6552756C65223B733A393A22637265617465644174223B693A313534333530313139333B733A393A22757064617465644174223B693A313534333530313139333B7D, '1543501193', '1543501193');

-- ----------------------------
-- Table structure for `jj_migration`
-- ----------------------------
DROP TABLE IF EXISTS `jj_migration`;
CREATE TABLE `jj_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_migration
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_site_key_value`
-- ----------------------------
DROP TABLE IF EXISTS `jj_site_key_value`;
CREATE TABLE `jj_site_key_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_site_key_value
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_site_link`
-- ----------------------------
DROP TABLE IF EXISTS `jj_site_link`;
CREATE TABLE `jj_site_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_site_link
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_site_menu`
-- ----------------------------
DROP TABLE IF EXISTS `jj_site_menu`;
CREATE TABLE `jj_site_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_site_menu
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_system_log`
-- ----------------------------
DROP TABLE IF EXISTS `jj_system_log`;
CREATE TABLE `jj_system_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `data` text COMMENT '日志内容',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `login_ip` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统日志表';

-- ----------------------------
-- Records of jj_system_log
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_user`
-- ----------------------------
DROP TABLE IF EXISTS `jj_user`;
CREATE TABLE `jj_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(43) COLLATE utf8_unicode_ci NOT NULL COMMENT '重置密码token',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态 1正常 2无效',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员表';

-- ----------------------------
-- Records of jj_user
-- ----------------------------
INSERT INTO `jj_user` VALUES ('1', 'admin', 'CqcJFlEefHGb6MitXMKZFSP77mfIOM-z', '$2y$13$BpsDc2MrRD/tXg1LuqhG2uATx09rj6XXYUKOQDjtj9dDCWqIPjwjS', '', '19744244@qq.com', '1', '1542901437', '1543588825');
INSERT INTO `jj_user` VALUES ('2', '123', 'Hr3nfDmuJAwRn-P7_3mhPCA-qi_kWuxV', '$2y$13$JGjsQ2mo6fuIfhsg1toe7eYdhDtt8mo4SE0qJGXILrK3jk/yGwzG.', 't4R2Brbfk2E24_XVkpboC0ahTlQFbiCK_1543415068', '12@12.com', '1', '1543415068', '1543415068');
INSERT INTO `jj_user` VALUES ('3', '123123123', 'Iwt8v6blNw1evdyU7UdDxd8N1lB5-O7I', '$2y$13$kxxLtJp9ZZC4LT4DIgAWpe9I.uYFKeJV2WEFLo4gOfzd8OdqieVsi', 'D-9hOgM_--LvwHlTlDPA8T6hxxobpl0Q_1543415087', '12@144432.com', '2', '1543415087', '1543587354');

-- ----------------------------
-- Table structure for `jj_user_login_log`
-- ----------------------------
DROP TABLE IF EXISTS `jj_user_login_log`;
CREATE TABLE `jj_user_login_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(20) NOT NULL DEFAULT '' COMMENT '登录密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '登录状态 1成功 2失败',
  `login_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员登录日志表';

-- ----------------------------
-- Records of jj_user_login_log
-- ----------------------------
INSERT INTO `jj_user_login_log` VALUES ('1', 'admin', '', '1', '2130706433', '1543402502');
INSERT INTO `jj_user_login_log` VALUES ('2', 'admin', '', '1', '2130706433', '1543588825');

-- ----------------------------
-- Table structure for `jj_user_operation_log`
-- ----------------------------
DROP TABLE IF EXISTS `jj_user_operation_log`;
CREATE TABLE `jj_user_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `route` varchar(255) NOT NULL DEFAULT '' COMMENT '路由地址',
  `data_before` text COMMENT '更新或删除之前的数据',
  `data_add` text COMMENT '新增的数据',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '操作类型 1新增 2更新 3删除',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1成功 2失败',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `object_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作的对象ID',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员操作日志表';

-- ----------------------------
-- Records of jj_user_operation_log
-- ----------------------------
INSERT INTO `jj_user_operation_log` VALUES ('1', 'admin', 'user/admin/delete', 'null', '{\"status\":2,\"updated_at\":1543415508,\"id\":\"3\"}', '0', '1', '1', '0', '1543415509', '0');
INSERT INTO `jj_user_operation_log` VALUES ('2', '', 'user/user/delete', 'null', '{\"status\":2,\"updated_at\":1543493928,\"id\":\"3\"}', '0', '1', '0', '0', '1543493929', '0');
INSERT INTO `jj_user_operation_log` VALUES ('3', '', 'user/user/delete', 'null', '{\"status\":2,\"updated_at\":1543587354,\"id\":\"3\"}', '0', '1', '0', '0', '1543587355', '0');
