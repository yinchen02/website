-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-10-22 17:11:36
-- 服务器版本： 8.0.12
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `website`
--

-- --------------------------------------------------------

--
-- 表的结构 `wb_admin_user`
--

CREATE TABLE `wb_admin_user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `role` int(10) UNSIGNED NOT NULL COMMENT '后台人员角色id',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `last_login_ip` varchar(50) NOT NULL COMMENT '最后登录ip',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态',
  `operate_user` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作人'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户表' ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `wb_admin_user`
--

INSERT INTO `wb_admin_user` (`id`, `username`, `password`, `role`, `create_time`, `update_time`, `last_login_ip`, `status`, `operate_user`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 1634891965, '127.0.0.1', 1, 'xj');

-- --------------------------------------------------------

--
-- 表的结构 `wb_menu`
--

CREATE TABLE `wb_menu` (
  `id` int(2) UNSIGNED NOT NULL COMMENT '导航栏id',
  `name` varchar(30) NOT NULL COMMENT '导航栏名称',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '所属上级菜单id',
  `link` varchar(30) DEFAULT NULL COMMENT '链接',
  `is_del` int(1) NOT NULL DEFAULT '0' COMMENT '是否被删除 0:未删除 1：已删除',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态0:未启用 1:已启用',
  `icon` varchar(10) DEFAULT NULL COMMENT 'icon图标'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `wb_menu`
--

INSERT INTO `wb_menu` (`id`, `name`, `pid`, `link`, `is_del`, `create_time`, `status`, `icon`) VALUES
(1, '系统管理', 0, NULL, 0, '2021-09-12 18:44:47', 1, NULL),
(2, '用户管理', 0, NULL, 0, '2021-09-12 18:45:29', 1, NULL),
(3, '房源管理', 0, NULL, 0, '2021-09-12 18:45:59', 0, NULL),
(4, '报备管理', 0, NULL, 0, '2021-09-12 18:47:06', 0, NULL),
(5, '财务管理', 0, NULL, 0, '2021-09-12 18:47:41', 0, NULL),
(6, '角色权限管理', 1, '/auth/index', 0, '2021-09-12 18:48:15', 1, NULL),
(7, '后台账号管理', 1, '/user/index', 0, '2021-09-12 18:48:57', 1, NULL),
(8, '操作日志', 1, '/log/index', 0, '2021-09-12 18:49:32', 1, NULL),
(9, '通用', 1, '/setting/index', 0, '2021-09-12 18:50:09', 1, NULL),
(10, '会员设置', 1, '/member/index', 0, '2021-09-12 18:50:31', 1, NULL),
(11, '轮播图设置', 1, '/banner/index', 0, '2021-09-12 18:50:56', 1, NULL),
(12, '中介公司管理', 2, '/company/index', 0, '2021-09-12 20:01:49', 1, NULL),
(13, '经纪人管理', 2, '/agent/index', 0, '2021-09-12 20:02:20', 0, NULL),
(14, '置业顾问管理', 2, '/consultant/index', 0, '2021-09-12 20:02:20', 0, NULL),
(15, '项目经理管理', 2, '/manager/index', 0, '2021-09-12 20:02:20', 0, NULL),
(16, '渠道管理', 2, '/channel/index', 0, '2021-09-12 20:02:20', 0, NULL),
(17, '房源合作商管理', 2, '/partner/index', 0, '2021-09-12 20:02:20', 0, NULL),
(18, '审核-人员', 2, '/experson/index', 0, '2021-09-12 20:02:20', 0, NULL),
(19, '审核-公司', 2, '/excompany/index', 0, '2021-09-12 20:02:20', 0, NULL),
(20, '楼盘列表', 3, '/propertie/index', 0, '2021-09-12 20:02:20', 0, NULL),
(21, '房源列表', 3, '/house/index', 0, '2021-09-12 20:02:20', 0, NULL),
(22, '房源看板', 3, '/board/index', 0, '2021-09-12 20:07:30', 0, NULL),
(23, '报备列表', 4, '/report/index', 0, '2021-09-12 20:08:40', 0, NULL),
(24, '客户列表', 4, '/customer/index', 0, '2021-09-12 20:09:09', 0, NULL),
(25, '收益列表', 5, '/reward/index', 1, '2021-09-12 20:09:32', 0, NULL),
(26, '成交结佣台账', 5, '/commission/index', 0, '2021-09-12 20:10:02', 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wb_roles`
--

CREATE TABLE `wb_roles` (
  `id` int(2) UNSIGNED NOT NULL COMMENT '角色id',
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `note` varchar(150) DEFAULT NULL COMMENT '角色备注',
  `authority` longtext COMMENT '权限列表(json)',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态 0:被禁用 1：使用中',
  `is_del` int(1) NOT NULL DEFAULT '0' COMMENT '是否删除 1:已被删除 0:未删除',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `wb_roles`
--

INSERT INTO `wb_roles` (`id`, `role_name`, `note`, `authority`, `status`, `is_del`, `create_time`) VALUES
(1, '超级管理员', '云之家总账号', '[\"1\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"2\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"3\",\"20\",\"21\",\"22\",\"4\",\"23\",\"24\",\"5\",\"26\"]', 1, 0, '2021-09-13 14:24:32');

--
-- 转储表的索引
--

--
-- 表的索引 `wb_admin_user`
--
ALTER TABLE `wb_admin_user`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `wb_menu`
--
ALTER TABLE `wb_menu`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `wb_roles`
--
ALTER TABLE `wb_roles`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `wb_admin_user`
--
ALTER TABLE `wb_admin_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `wb_menu`
--
ALTER TABLE `wb_menu`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '导航栏id', AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `wb_roles`
--
ALTER TABLE `wb_roles`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色id', AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
