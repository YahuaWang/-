/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : edu

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 15/06/2018 18:24:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户密码',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户邮箱',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `role` tinyint(2) NULL DEFAULT NULL COMMENT '角色：1超级管理员 0普通用户',
  `status` int(255) NULL DEFAULT NULL COMMENT '状态：1 启用 0禁用',
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  `login_time` int(11) NULL DEFAULT NULL COMMENT '登录时间',
  `login_count` int(11) NULL DEFAULT NULL COMMENT '登录次数',
  `is_delete` int(2) NULL DEFAULT NULL COMMENT '是否删除1是0否',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 1528882039, 1528882039, 1, 1, NULL, NULL, 16, NULL);
INSERT INTO `user` VALUES (2, 'yahua', 'e10adc3949ba59abbe56e057f20f883e', 'leoasa@163.com', 1528882325, 1529055803, 0, 1, NULL, NULL, 10, 1);

SET FOREIGN_KEY_CHECKS = 1;
