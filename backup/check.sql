-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2024 at 03:58 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `check`
--

-- --------------------------------------------------------

--
-- Table structure for table `checks`
--

CREATE TABLE `checks` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `zone_code` varchar(224) NOT NULL,
  `zone_name` varchar(254) NOT NULL,
  `warehouse_code` varchar(8) DEFAULT NULL,
  `warehouse_name` varchar(100) DEFAULT NULL,
  `is_consignment` tinyint(4) NOT NULL DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` set('O','C','D') NOT NULL DEFAULT 'O' COMMENT 'O = open, \r\nC = closed, \r\nD = Cancel',
  `allow_input_qty` tinyint(1) NOT NULL DEFAULT '0',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(50) DEFAULT NULL,
  `remark` text,
  `last_active` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `check_details`
--

CREATE TABLE `check_details` (
  `id` int(11) NOT NULL,
  `check_id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `qty` int(1) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` set('O','C','D') NOT NULL DEFAULT 'O' COMMENT 'O = Open,\r\nC = Closed,\r\nD = Cancel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `check_logs`
--

CREATE TABLE `check_logs` (
  `id` int(11) NOT NULL,
  `check_id` int(11) NOT NULL,
  `action` set('add','update','cancel','close','rollback','get_stock') DEFAULT NULL,
  `uname` varchar(50) NOT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `check_results`
--

CREATE TABLE `check_results` (
  `id` int(11) NOT NULL,
  `check_id` int(11) NOT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `stock_qty` int(11) NOT NULL DEFAULT '0',
  `check_qty` int(11) NOT NULL DEFAULT '0',
  `diff_qty` int(11) NOT NULL DEFAULT '0',
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(254) CHARACTER SET utf8 DEFAULT NULL,
  `value` varchar(250) CHARACTER SET utf8 NOT NULL,
  `group_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`code`, `name`, `value`, `group_code`, `description`, `date_upd`) VALUES
('CLOSE_SYSTEM', 'ปิดปรับปรุงระบบ', '0', 'System', '', '2022-08-11 14:09:01'),
('COMPANY_ADDRESS1', 'ที่อยู่', '', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_ADDRESS2', NULL, '', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_CODE', 'รหัสบริษัท', '0001', 'Company', '', '2019-08-31 11:49:52'),
('COMPANY_EMAIL', 'อีเมล์', '', 'Company', '', '2023-08-21 07:54:24'),
('COMPANY_FACEBOOK', NULL, '', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_FAX', 'แฟกซ์', '', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_FULL_NAME', 'ชื่อเต็ม', 'บริษัท วอริกซ์ สปอร์ต จำกัด (มหาชน)', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_LINE', 'LINE', '', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_NAME', 'ชื่อย่อ', 'CHECK', 'Company', '', '2023-10-25 16:04:41'),
('COMPANY_PHONE', 'โทรศัพท์', '', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_POST_CODE', 'รหัสไปรษณีย์', '', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_TAX_ID', 'เลขที่ผู้เสียภาษี', '', 'Company', '', '2023-10-19 06:03:50'),
('COMPANY_WEBSITE', NULL, '', 'Company', '', '2023-10-19 06:03:50'),
('IX_API_HOST', '', 'http://localhost/wms/rest/V1/', 'System', '', '2023-12-13 05:50:54'),
('LOGS_JSON', NULL, '1', 'System', '', '2023-08-30 05:17:24'),
('PREFIX_CHECK', NULL, 'CK', 'Document', '', '2023-10-23 14:03:36'),
('RUN_DIGIT_CHECK', 'จำนวนหลัก', '4', 'Document', '', '2023-10-23 14:03:04'),
('SALE_VAT_CODE', NULL, 'S07', 'Company', '', '2022-07-06 06:21:53'),
('SALE_VAT_RATE', NULL, '7.00', 'Company', '', '2022-07-06 06:21:53'),
('TEST', NULL, '1', 'System', '', '2023-10-11 08:53:37'),
('USER_PASSWORD_AGE', NULL, '0', 'System', '', '2022-08-05 01:41:36'),
('USE_STRONG_PWD', NULL, '0', 'System', '', '2022-07-22 03:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `config_group`
--

CREATE TABLE `config_group` (
  `code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `name` varchar(254) CHARACTER SET utf8 NOT NULL,
  `position` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_group`
--

INSERT INTO `config_group` (`code`, `name`, `position`) VALUES
('Company', 'ข้อมูลบริษัท', 2),
('Document', 'เอกสาร', 3),
('General', 'ทั่วไป', 1),
('Inventory', 'คลัง', 5),
('Order', 'ออเดอร์', 4),
('System', 'ระบบ', 6);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) CHARACTER SET utf8 NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text CHARACTER SET utf8,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, '513bcfa2b82dc1735a07b97b7f870106', 1, 0, 0, NULL, 1549696881);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `url` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `group_code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `sub_group` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(3) NOT NULL DEFAULT '1',
  `valid` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = check permission'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`code`, `name`, `url`, `group_code`, `sub_group`, `active`, `position`, `valid`) VALUES
('DBPROD', 'เพิ่ม/แก้ไข รายการสินค้า', 'masters/products', 'DB', NULL, 1, 1, 1),
('DBSHOP', 'เพิ่ม/แก้ไข สถานที่', 'masters/shop', 'DB', NULL, 1, 2, 1),
('HOME', 'Welcome', 'main', '', NULL, 1, 1, 0),
('ICCHECK', 'เพิ่ม/แก้ไข การตรวจนับ', 'inventory/check', 'IC', NULL, 1, 1, 1),
('SCCONF', 'การตั้งค่า', 'setting', 'SC', NULL, 1, 7, 1),
('SCPERM', 'กำหนดสิทธิ์', 'users/permission', 'SC', NULL, 1, 4, 1),
('SCPROF', 'Profile', 'users/profiles', 'SC', NULL, 0, 3, 1),
('SCUSER', 'เพิ่ม/แก้ไข ผู้ใช้งาน', 'users/users', 'SC', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `position` int(5) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `type` enum('side','top') CHARACTER SET utf8 NOT NULL DEFAULT 'side',
  `icon` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`code`, `name`, `position`, `active`, `type`, `icon`) VALUES
('DB', 'ฐานข้อมูล', 8, 1, 'side', 'fa-database'),
('IC', 'การตรวจนับ', 1, 1, 'side', 'fa-home'),
('RE', 'รายงาน', 10, 0, 'top', 'fa-bar-chart'),
('SC', 'ผู้ดูแลระบบ', 5, 1, 'side', 'fa-cogs');

-- --------------------------------------------------------

--
-- Table structure for table `menu_sub_group`
--

CREATE TABLE `menu_sub_group` (
  `code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `group_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `menu` varchar(10) CHARACTER SET utf8 NOT NULL,
  `id_profile` int(11) DEFAULT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT '0',
  `can_add` tinyint(1) NOT NULL DEFAULT '0',
  `can_edit` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '0',
  `can_approve` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `menu`, `id_profile`, `can_view`, `can_add`, `can_edit`, `can_delete`, `can_approve`) VALUES
(50, 'SOODSQ', 3, 1, 1, 1, 1, 0),
(51, 'SCUSER', 3, 0, 0, 0, 0, 0),
(52, 'SCSIGN', 3, 0, 0, 0, 0, 0),
(53, 'DBSTEAM', 3, 0, 0, 0, 0, 0),
(54, 'SCAPPV', 3, 0, 0, 0, 0, 0),
(55, 'SCPERM', 3, 0, 0, 0, 0, 0),
(56, 'SCCONF', 3, 0, 0, 0, 0, 0),
(57, 'SCACLOG', 3, 0, 0, 0, 0, 0),
(74, 'SOODSQ', 6, 1, 1, 1, 1, 0),
(75, 'APODSQ', 6, 1, 1, 1, 1, 0),
(76, 'SCUSER', 6, 1, 1, 1, 1, 0),
(77, 'SCSIGN', 6, 1, 1, 1, 1, 0),
(78, 'DBSTEAM', 6, 1, 1, 1, 1, 0),
(79, 'SCAPPV', 6, 1, 1, 1, 1, 0),
(80, 'SCPERM', 6, 1, 1, 1, 1, 0),
(81, 'SCCONF', 6, 1, 1, 1, 1, 0),
(82, 'SCACLOG', 6, 1, 1, 1, 1, 0),
(136, 'ICCHECK', 1, 1, 1, 1, 1, 0),
(137, 'SCUSER', 1, 1, 1, 1, 1, 0),
(138, 'SCPERM', 1, 1, 1, 1, 1, 0),
(139, 'SCCONF', 1, 1, 1, 1, 1, 0),
(140, 'DBPROD', 1, 1, 1, 1, 1, 0),
(141, 'DBSHOP', 1, 1, 1, 1, 1, 0),
(142, 'ICCHECK', 2, 1, 0, 0, 0, 0),
(143, 'SCUSER', 2, 0, 0, 0, 0, 0),
(144, 'SCPERM', 2, 0, 0, 0, 0, 0),
(145, 'SCCONF', 2, 0, 0, 0, 0, 0),
(146, 'DBPROD', 2, 0, 0, 0, 0, 0),
(147, 'DBSHOP', 2, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `style` varchar(50) DEFAULT NULL,
  `cost` decimal(12,2) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_sync` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_sync_logs`
--

CREATE TABLE `products_sync_logs` (
  `id` int(11) NOT NULL,
  `sync_at` datetime DEFAULT NULL,
  `sync_by` varchar(50) DEFAULT NULL,
  `sync_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = not complete,\r\n1 = complete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`) VALUES
(1, 'Administrator'),
(-987654321, 'Super Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `code` varchar(228) NOT NULL COMMENT 'ix_zone_code',
  `name` varchar(254) NOT NULL COMMENT 'ix_zone_name',
  `warehouse_code` varchar(8) DEFAULT NULL,
  `warehouse_name` varchar(100) DEFAULT NULL,
  `allow_input_qty` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `is_consignment` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'ฝากขายเทียมหรือไม่',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` datetime DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_sync_logs`
--

CREATE TABLE `shop_sync_logs` (
  `id` int(11) NOT NULL,
  `sync_at` datetime DEFAULT NULL,
  `sync_by` varchar(50) DEFAULT NULL,
  `sync_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = not complete,\r\n1 = complete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sync_error_logs`
--

CREATE TABLE `sync_error_logs` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `error_message` text,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sync_logs`
--

CREATE TABLE `sync_logs` (
  `id` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `get_item` int(11) NOT NULL DEFAULT '0',
  `update_item` int(11) NOT NULL DEFAULT '0',
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL COMMENT 'User Name',
  `pwd` varchar(100) NOT NULL COMMENT 'Password',
  `name` varchar(100) NOT NULL COMMENT 'Display name',
  `uid` varchar(32) NOT NULL COMMENT 'Unique id',
  `id_profile` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` timestamp NULL DEFAULT NULL,
  `last_pass_change` date DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pwd`, `name`, `uid`, `id_profile`, `active`, `date_add`, `date_upd`, `last_pass_change`, `force_reset`) VALUES
(-1, 'superadmin', '$2y$10$s.Ey6n.SIYRGq5wW.q/sJefuYVOU7pkbnA3X0XEN2ezKiTn11qk6u', 'Super Admin', 'IX1', -987654321, 1, '2019-12-01 21:39:10', NULL, '2024-12-31', 0),
(1, 'admin', '$2y$10$kKh6iu8t4O6b91OTds9YHeg0sLMW0nDe.VEn9Lb9dNZEvJJtzSTt6', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2023-10-19 14:16:34', NULL, '2023-10-19', 0),
(2, 'user', '$2y$10$qETNie3HGRZEpszWmDFacOVaARnzdP.k./CuND2e5YaobkY7caC/G', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 2, 1, '2024-01-31 12:31:03', NULL, '2024-01-31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `zone_id` (`zone_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `check_details`
--
ALTER TABLE `check_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `barcode` (`barcode`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `check_logs`
--
ALTER TABLE `check_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `check_id` (`check_id`);

--
-- Indexes for table `check_results`
--
ALTER TABLE `check_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`code`),
  ADD KEY `group_code` (`group_code`);

--
-- Indexes for table `config_group`
--
ALTER TABLE `config_group`
  ADD PRIMARY KEY (`code`),
  ADD KEY `position` (`position`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`code`),
  ADD KEY `groupCode` (`group_code`),
  ADD KEY `active` (`active`),
  ADD KEY `sub_group` (`sub_group`),
  ADD KEY `valid` (`valid`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `position` (`position`),
  ADD KEY `isActive` (`active`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `menu_sub_group`
--
ALTER TABLE `menu_sub_group`
  ADD PRIMARY KEY (`code`),
  ADD KEY `group_code` (`group_code`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu` (`menu`,`id_profile`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `style_code` (`style`),
  ADD KEY `code` (`code`),
  ADD KEY `barcode` (`barcode`) USING BTREE;

--
-- Indexes for table `products_sync_logs`
--
ALTER TABLE `products_sync_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sync_at` (`sync_at`),
  ADD KEY `sync_status` (`sync_status`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `allow_input_qty` (`allow_input_qty`),
  ADD KEY `warehouse_code` (`warehouse_code`),
  ADD KEY `active` (`active`),
  ADD KEY `warehouse_name` (`warehouse_name`),
  ADD KEY `name` (`name`),
  ADD KEY `is_consignment` (`is_consignment`);

--
-- Indexes for table `shop_sync_logs`
--
ALTER TABLE `shop_sync_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sync_at` (`sync_at`),
  ADD KEY `sync_status` (`sync_status`);

--
-- Indexes for table `sync_error_logs`
--
ALTER TABLE `sync_error_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sync_logs`
--
ALTER TABLE `sync_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD KEY `active` (`active`),
  ADD KEY `id_profile` (`id_profile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checks`
--
ALTER TABLE `checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_details`
--
ALTER TABLE `check_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_logs`
--
ALTER TABLE `check_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_results`
--
ALTER TABLE `check_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_sync_logs`
--
ALTER TABLE `products_sync_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_sync_logs`
--
ALTER TABLE `shop_sync_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sync_error_logs`
--
ALTER TABLE `sync_error_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sync_logs`
--
ALTER TABLE `sync_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `config_group` FOREIGN KEY (`group_code`) REFERENCES `config_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
