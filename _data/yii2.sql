/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yii2

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-11-26 23:33:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jj_admin`
-- ----------------------------
DROP TABLE IF EXISTS `jj_admin`;
CREATE TABLE `jj_admin` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员表';

-- ----------------------------
-- Records of jj_admin
-- ----------------------------
INSERT INTO `jj_admin` VALUES ('1', 'admin', 'CqcJFlEefHGb6MitXMKZFSP77mfIOM-z', '$2y$13$BpsDc2MrRD/tXg1LuqhG2uATx09rj6XXYUKOQDjtj9dDCWqIPjwjS', '', '19744244@qq.com', '1', '1542901437', '1542901437');

-- ----------------------------
-- Table structure for `jj_admin_login_log`
-- ----------------------------
DROP TABLE IF EXISTS `jj_admin_login_log`;
CREATE TABLE `jj_admin_login_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `login_name` varchar(20) NOT NULL DEFAULT '' COMMENT '登录名',
  `login_password` varchar(20) NOT NULL DEFAULT '' COMMENT '登录密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '登录状态 1成功 2失败',
  `login_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员登录日志表';

-- ----------------------------
-- Records of jj_admin_login_log
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_admin_operation_log`
-- ----------------------------
DROP TABLE IF EXISTS `jj_admin_operation_log`;
CREATE TABLE `jj_admin_operation_log` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员操作日志表';

-- ----------------------------
-- Records of jj_admin_operation_log
-- ----------------------------

-- ----------------------------
-- Table structure for `jj_article`
-- ----------------------------
DROP TABLE IF EXISTS `jj_article`;
CREATE TABLE `jj_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
INSERT INTO `jj_auth_assignment` VALUES ('超级管理', '1', '1487817340');

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
INSERT INTO `jj_auth_item` VALUES ('/*', '2', null, null, null, '1487816675', '1487816675');
INSERT INTO `jj_auth_item` VALUES ('/admin/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/assignment/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/assignment/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/assignment/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/assignment/revoke', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/assignment/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/menu/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/menu/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/menu/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/menu/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/menu/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/menu/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/permission/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/permission/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/permission/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/permission/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/permission/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/permission/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/permission/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/permission/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/role/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/role/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/role/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/role/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/role/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/role/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/role/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/role/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/route/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/route/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/route/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/route/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/route/refresh', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/route/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/rule/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/rule/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/rule/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/rule/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/rule/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/rule/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/activate', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/change-password', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/login', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/logout', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/request-password-reset', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/reset-password', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/signup', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/admin/user/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/batch/*', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `jj_auth_item` VALUES ('/batch/cruds', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `jj_auth_item` VALUES ('/batch/index', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `jj_auth_item` VALUES ('/batch/models', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `jj_auth_item` VALUES ('/debug/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/debug/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/debug/default/db-explain', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/debug/default/download-mail', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/debug/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/debug/default/toolbar', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/debug/default/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/gii/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/gii/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/gii/default/action', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/gii/default/diff', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/gii/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/gii/default/preview', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/gii/default/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/site/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/site/error', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/site/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/site/login', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('/site/logout', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `jj_auth_item` VALUES ('超级管理', '1', null, null, null, '1487817275', '1542984653');

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
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/assignment/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/assignment/assign');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/assignment/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/assignment/revoke');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/assignment/view');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/default/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/default/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/menu/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/menu/create');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/menu/delete');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/menu/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/menu/update');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/menu/view');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/permission/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/permission/assign');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/permission/create');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/permission/delete');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/permission/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/permission/remove');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/permission/update');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/permission/view');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/role/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/role/assign');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/role/create');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/role/delete');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/role/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/role/remove');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/role/update');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/role/view');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/route/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/route/assign');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/route/create');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/route/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/route/refresh');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/route/remove');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/rule/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/rule/create');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/rule/delete');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/rule/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/rule/update');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/rule/view');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/activate');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/change-password');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/delete');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/login');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/logout');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/request-password-reset');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/reset-password');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/signup');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/admin/user/view');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/batch/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/batch/cruds');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/batch/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/batch/models');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/debug/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/debug/default/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/debug/default/db-explain');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/debug/default/download-mail');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/debug/default/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/debug/default/toolbar');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/debug/default/view');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/gii/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/gii/default/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/gii/default/action');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/gii/default/diff');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/gii/default/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/gii/default/preview');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/gii/default/view');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/site/*');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/site/error');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/site/index');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/site/login');
INSERT INTO `jj_auth_item_child` VALUES ('超级管理', '/site/logout');

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

-- ----------------------------
-- Table structure for `jj_menu`
-- ----------------------------
DROP TABLE IF EXISTS `jj_menu`;
CREATE TABLE `jj_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `route` varchar(256) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `jj_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `jj_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jj_menu
-- ----------------------------
INSERT INTO `jj_menu` VALUES ('1', null, '100', '系统设置', null, '{\"icon\": \"fa fa-wrench\", \"visible\": true}');
INSERT INTO `jj_menu` VALUES ('2', '1', '1', '菜单列表', '/admin/menu/index', '{\"icon\": \"fa fa-bars\", \"visible\": true}');
INSERT INTO `jj_menu` VALUES ('3', '1', '2', '角色列表', '/admin/role/index', '{\"icon\": \"fa fa-users\", \"visible\": true}');
INSERT INTO `jj_menu` VALUES ('4', '1', '3', '用户管理', '/admin/user/index', '{\"icon\": \"fa fa-user\", \"visible\": true}');
INSERT INTO `jj_menu` VALUES ('5', '1', '6', '权限列表', '/admin/permission/index', '{\"icon\": \"fa fa-lock\", \"visible\": true}');
INSERT INTO `jj_menu` VALUES ('6', '1', '4', '路由列表', '/admin/route/index', '{\"icon\": \"fa fa-internet-explorer\", \"visible\": true}');
INSERT INTO `jj_menu` VALUES ('7', '1', '5', '规则列表', '/admin/rule/index', '{\"icon\": \"fa fa-list\", \"visible\": true}');
INSERT INTO `jj_menu` VALUES ('8', '1', '7', '分配权限', '/admin/assignment/index', '{\"icon\": \"fa fa-unlock\", \"visible\": true}');

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
INSERT INTO `jj_migration` VALUES ('m000000_000000_base', '1542901231');
INSERT INTO `jj_migration` VALUES ('m130524_201442_init', '1542901235');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员表';

-- ----------------------------
-- Records of jj_user
-- ----------------------------
INSERT INTO `jj_user` VALUES ('1', 'admin', 'CqcJFlEefHGb6MitXMKZFSP77mfIOM-z', '$2y$13$BpsDc2MrRD/tXg1LuqhG2uATx09rj6XXYUKOQDjtj9dDCWqIPjwjS', '', '19744244@qq.com', '1', '1542901437', '1542901437');
