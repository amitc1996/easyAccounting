-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2020 at 02:46 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accountingamrp`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'admin access group');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_group_to_group`
--

CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aauth_login_attempts`
--

INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(5, '::1', '2020-03-28 18:10:54', 1),
(7, '::1', '2020-04-24 19:33:31', 1),
(11, '::1', '2020-04-24 20:15:30', 2),
(12, '::1', '2020-04-25 08:10:40', 3),
(15, '::1', '2020-05-09 17:51:21', 1),
(16, '::1', '2020-05-09 19:43:37', 2),
(18, '::1', '2020-05-20 18:43:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE `aauth_perms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  `controller` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perms`
--

INSERT INTO `aauth_perms` (`id`, `name`, `definition`, `controller`, `method`) VALUES
(1, 'Groups Section', 'groups_section', 'groups', 'index'),
(2, 'Permissions Section', 'permissions_index', 'permissions', 'index'),
(3, 'Add Group', 'add_group', 'groups', 'addGroup'),
(4, 'Edit Group', 'edit_group', 'groups', 'editGroup'),
(5, 'Update Group', 'update_group', 'groups', 'updateGroup'),
(6, 'Delete Group', 'delete_group', 'groups', 'deleteGroup'),
(7, 'Add Group Permissions', 'add_group_permissions', 'permissions', 'addPermission'),
(8, 'Remove Group Permissions', 'remove_group_permissions', 'permissions', 'deletePermission'),
(9, 'View Users Permissions', 'view_user_permissions', 'permissions', 'users_permission'),
(10, 'Add Users Permissions', 'add_user_permissions', 'permissions', 'addUserPermission'),
(11, 'Remove Users Permissions', 'remove_user_permissions', 'permissions', 'deleteUserPermission'),
(12, 'Staff section', 'staff_section', 'staff', 'index'),
(13, 'Edit Staff', 'staff_edit_staff', 'staff', 'edit_staff'),
(14, 'Delete Staff', 'delete_user', 'staff', 'delete_staff'),
(15, 'View Staff', 'view_user', 'staff', 'view_staff'),
(17, 'Add Staff', 'staff_add_staff', 'staff', 'add_staff'),
(18, 'Add permission', 'permissions_addPermission', 'permissions', 'addPermission'),
(19, 'Purchases Section ', 'purchases_index', 'purchases', 'index'),
(20, 'View Purchase', 'purchases_view_purchase', 'purchases', 'view_purchase'),
(21, 'Edit Purchase', 'purchases_edit_purchase', 'purchases', 'edit_purchase'),
(22, 'Add Purchase', 'purchases_new_purchase', 'purchases', 'new_purchase'),
(23, 'Sales Section', 'sales_index', 'sales', 'index'),
(24, 'Add Sale', 'sales_add_sale', 'sales', 'add_sale'),
(25, 'Sale Return Section', 'returns_index', 'returns', 'index'),
(26, 'Products Section', 'products_index', 'products', 'index'),
(27, 'Edit Product', 'products_edit_product', 'products', 'edit_product'),
(28, 'Delete Product', 'products_delete', 'products', 'delete'),
(29, 'Categories Section ', 'categories_index', 'categories', 'index'),
(30, 'Add Category', 'categories_add_category', 'categories', 'add_category'),
(31, 'Edit Category', 'categories_edit_category', 'categories', 'edit_category'),
(32, 'Delete Category', 'categories_delete_category', 'categories', 'delete_category'),
(33, 'Clients Section', 'clients_index', 'clients', 'index'),
(34, 'Add Client', 'clients_add_client', 'clients', 'add_client'),
(35, 'Edit Client', 'clients_edit_client', 'clients', 'edit_client'),
(36, 'Delete Client', 'clients_delete_client', 'clients', 'delete_client'),
(37, 'Suppliers Section ', 'suppliers_index ', 'suppliers', 'index'),
(38, 'Add Supplier', 'suppliers_add_supplier', 'suppliers', 'add_supplier'),
(39, 'Edit Supplier', 'suppliers_edit_supplier', 'suppliers', 'edit_supplier'),
(40, 'Delete Supplier', 'suppliers_delete_supplier', 'suppliers', 'delete_supplier'),
(41, 'Purchase Returns Section', 'purchases_return_index', 'purchases_return', 'index'),
(42, 'Add Purchase Return', 'purchases_return_return_purchase', 'purchases_return', 'return_purchase'),
(43, 'View Purchase Return', 'purchases_return_view_purchase_return', 'purchases_return', 'view_purchase_return'),
(44, 'Edit Purchase Return', 'purchases_return_edit_purchase_return', 'purchases_return', 'edit_purchase_return'),
(45, 'Add Product', 'products_add_product', 'products', 'add_product'),
(46, 'Stocks Section ', 'stocks_index ', 'stocks', 'index'),
(47, 'Account Groups Section ', 'account_groups_index ', 'account_groups', 'index'),
(48, 'Add Account_group', 'account_groups_add_account_group', 'account_groups', 'add_account_group'),
(49, 'Edit Account Group', 'account_groups_edit_account_group', 'account_groups', 'edit_account_group'),
(50, 'Delete Account Group', 'account_groups_delete_account_groups', 'account_groups', 'delete_account_groups'),
(51, 'Ledgers Section ', 'ledgers_index ', 'ledgers', 'index'),
(52, 'Add Ledger', 'ledgers_add_ledger', 'ledgers', 'add_ledger'),
(53, 'Edit Ledger', 'ledgers_edit_ledger', 'ledgers', 'edit_ledger'),
(54, 'Delete Ledger', 'ledgers_delete_ledger', 'ledgers', 'delete_ledger'),
(55, 'ExpensesSection ', 'expenses_index ', 'expenses', 'index'),
(56, 'Add Expense', 'expenses_add_expense', 'expenses', 'add_expense'),
(57, 'Edit Expense', 'expenses_edit_expenses', 'expenses', 'edit_expenses'),
(58, 'Delete Expense', 'expenses_delete_expense', 'expenses', 'delete_expense'),
(59, 'Cash_flowsSection ', 'cash_flows_index ', 'cash_flows', 'index'),
(60, 'PaymentsSection ', 'payments_index ', 'payments', 'index'),
(61, 'Add Payment', 'payments_add_payment', 'payments', 'add_payment'),
(62, 'Receipts Section ', 'receipts_index', 'receipts', 'index'),
(63, 'Add Receipt', 'receipts_add_receipt', 'receipts', 'add_receipt'),
(64, 'Company Setting Section ', 'company_index ', 'company', 'index'),
(65, 'Brands Section ', 'brands_index', 'brands', 'index'),
(66, 'Add Brand', 'brands_add_brand', 'brands', 'add_brand'),
(67, 'Edit Brand', 'brands_edit_brand', 'brands', 'edit_brand'),
(68, 'Delete Brand', 'brands_delete_brand', 'brands', 'delete_brand'),
(69, 'Units Section ', 'measurements_index', 'measurements', 'index'),
(70, 'Add Unit', 'measurements_add_measurement', 'measurements', 'add_measurement'),
(71, 'Edit Unit', 'measurements_edit_measurement', 'measurements', 'edit_measurement'),
(72, 'Delete Unit', 'measurements_delete_measurement', 'measurements', 'delete_measurement'),
(73, 'Taxes Section ', 'taxes_index', 'taxes', 'index'),
(74, 'Add Tax', 'taxes_add_tax', 'taxes', 'add_tax'),
(75, 'Edit Tax', 'taxes_edit_tax', 'taxes', 'edit_tax'),
(76, 'Delete Tax', 'taxes_delete_brand', 'taxes', 'delete_tax'),
(77, 'Discounts Section ', 'discounts_index', 'discounts', 'index'),
(78, 'Add Discount', 'discounts_add_discount', 'discounts', 'add_discount'),
(79, 'Edit Discount', 'discounts_edit_discount', 'discounts', 'edit_discount'),
(80, 'Delete Discount', 'discounts_delete_discount', 'discounts', 'delete_discount'),
(81, 'Wherehouses Section ', 'wherehouses_index', 'wherehouses', 'index'),
(82, 'Add Wherehouse', 'wherehouses_add_wherehouse', 'wherehouses', 'add_wherehouse'),
(83, 'Edit Wherehouse', 'wherehouses_edit_wherehouse', 'wherehouses', 'edit_wherehouse'),
(84, 'Delete Wherehouse', 'wherehouses_delete_wherehouse', 'wherehouses', 'delete_wherehouse'),
(85, 'Currencies Section ', 'currencies_index', 'currencies', 'index'),
(86, 'Add Currency', 'currencies_add_currency', 'currencies', 'add_currency'),
(87, 'Edit Currency', 'currencies_edit_currency', 'currencies', 'edit_currency'),
(88, 'Delete Currency', 'currencies_delete_currency', 'currencies', 'delete_currency'),
(89, 'Branches Section ', 'branches_index', 'branches', 'index'),
(90, 'Add Branch', 'branches_add_branch', 'branches', 'add_branch'),
(91, 'Edit Branch', 'branches_edit_branch', 'branches', 'edit_branch'),
(92, 'Delete Branch', 'branches_delete_branch', 'branches', 'delete_branch');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perm_to_user`
--

INSERT INTO `aauth_perm_to_user` (`perm_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `new_email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_on` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `new_email_key` varchar(255) NOT NULL,
  `today_profit` decimal(10,2) NOT NULL,
  `thirty_day_profit` decimal(10,2) NOT NULL,
  `year_profit` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `new_email`, `pass`, `username`, `first_name`, `last_name`, `banned`, `is_deleted`, `deleted_by`, `deleted_on`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `new_email_key`, `today_profit`, `thirty_day_profit`, `year_profit`) VALUES
(1, 'admin@example.com', '', '5d472fe571c52703f82f86686a0455e5cfdd21f97dc5ad6fb252cd8c55a7de45', 'Admin', '', '', 0, 0, NULL, '0000-00-00 00:00:00', '2020-08-18 19:41:06', '2020-08-18 19:41:06', '2019-06-27 00:00:00', NULL, NULL, NULL, '0McWwlHsZG4R5KQn', NULL, '::1', '', '100.00', '3000.00', '40000.00'),
(9, 'testuseradmin@yopmail.com', '', '9c686c598188e0b8c86fda899984bda34f3cdd2f359b38df54ee67dae36a7e89', 'testuser#1', 'IPtestuser#1', 'admin', 1, 1, 1, '2020-03-18 06:42:18', '2020-01-20 08:47:28', '2020-01-20 08:47:28', '2020-01-20 08:35:09', NULL, NULL, NULL, '', NULL, '182.68.80.109', '', '100.00', '3000.00', '40000.00'),
(10, 'test2@yopmail.com', '', '176398faab37f72640fa6f72f685aa7376dc983a825463cba09709648e853050', 'testuser#2', 'IPtestuser#1', 'user', 1, 1, 1, '2020-02-19 07:27:33', '2020-01-20 08:43:35', '2020-01-20 08:43:35', '2020-01-20 08:37:59', NULL, NULL, NULL, NULL, NULL, '182.68.80.109', '', '100.00', '3000.00', '40000.00'),
(11, 'amit@yopmail.com', '', '62d033753b2318132558eb2abb1791559c1269dfffbca3224e46662ef689ac25', 'amit01411', 'Amit', 'Choudhary', 1, 1, 1, '2020-02-19 07:27:36', '2020-01-21 05:53:22', '2020-01-21 05:53:22', '2020-01-21 05:51:11', NULL, NULL, NULL, NULL, NULL, '182.64.165.81', '', '100.00', '3000.00', '40000.00'),
(12, 'mmf.priyansh@gmail.com', '', '23026a68084355cdbdf2ca8695e4846cab3ee0cdd7c2cac29707d72e8ab14e81', 'ppatodi', 'Priyansh', 'Patodi', 1, 1, 1, '2020-02-19 07:27:30', NULL, NULL, '2020-02-11 14:59:41', NULL, NULL, NULL, NULL, NULL, NULL, '', '100.00', '3000.00', '40000.00'),
(13, 'rickjsorenson@gmail.com', '', '3d8804275443e6216f828d6150c15dec1a0d1148895471ccd3c82e5a3f90a6a3', 'Rick', 'Rick', 'Sorenson', 0, 0, NULL, '0000-00-00 00:00:00', '2020-06-01 12:39:19', '2020-06-01 12:39:19', '2020-02-21 20:56:50', NULL, '2020-06-04 00:00:00', 'ceWOwk9NQszql4vx', NULL, NULL, '184.80.202.238', '', '400.00', '12000.00', '150000.00'),
(14, 'cara.sorenson@hotmail.com', '', '73ae525ef787dd3aa29f5a744c0b126f9314ab406a418d52cdba66da160433eb', 'Cara', 'Cara', 'Sorenson', 0, 0, NULL, '0000-00-00 00:00:00', '2020-05-31 21:11:32', '2020-05-31 21:11:32', '2020-02-21 20:57:15', NULL, '2020-03-02 00:00:00', '1ZYwlAhrv2snVBpc', NULL, NULL, '184.80.202.238', '', '100.00', '3000.00', '40000.00');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `account_categories`
--

CREATE TABLE `account_categories` (
  `account_category_id` int(11) NOT NULL,
  `account_category_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_categories`
--

INSERT INTO `account_categories` (`account_category_id`, `account_category_name`, `created_by`, `created`, `last_updated`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Assets ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(2, 'Liabilities ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(3, 'Equity ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(4, 'Income ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(5, 'Expense ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `account_groups`
--

CREATE TABLE `account_groups` (
  `account_group_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `account_category_id` int(11) NOT NULL,
  `opening_balance` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_groups`
--

INSERT INTO `account_groups` (`account_group_id`, `branch_id`, `group_name`, `account_category_id`, `opening_balance`, `description`, `is_default`, `created`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`, `last_updated`, `is_disabled`) VALUES
(1, 1, 'Bank Accounts', 4, '0.00', '', 0, '2020-06-26 21:11:12', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:11:12', 0),
(2, 1, 'Bank OCC A/c', 4, '0.00', '', 0, '2020-06-26 21:11:50', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:11:50', 0),
(3, 1, 'Bank OD A/c', 4, '0.00', '', 0, '2020-06-26 21:12:19', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:12:19', 0),
(4, 1, 'Branch/Divisons', 5, '0.00', '', 0, '2020-06-26 21:12:48', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:12:48', 0),
(5, 1, 'Capital Account', 2, '0.00', '', 0, '2020-06-26 21:13:19', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:13:19', 0),
(6, 1, 'Cash-in-hand', 1, '0.00', '', 0, '2020-06-26 21:13:44', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:13:44', 0),
(7, 1, 'Current Assets', 1, '0.00', '', 0, '2020-06-26 21:14:03', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:14:03', 0),
(8, 1, 'Current Liabilities', 2, '0.00', '', 0, '2020-06-26 21:14:27', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:14:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_phone` varchar(255) NOT NULL,
  `branch_email` varchar(255) NOT NULL,
  `branch_address` varchar(255) NOT NULL,
  `branch_city` varchar(255) NOT NULL,
  `branch_state` varchar(255) NOT NULL,
  `branch_country` varchar(255) NOT NULL,
  `branch_zip` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `branch_phone`, `branch_email`, `branch_address`, `branch_city`, `branch_state`, `branch_country`, `branch_zip`, `is_default`, `created`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`, `last_updated`, `is_disabled`) VALUES
(1, 'AM ENTERPRISES', '6377098903', 'amitchoudhary9487@gmail.com', '23-A, BAJRANG COLONY, KARNI PALACE , VAISHALI NAGAR', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', 0, '2020-06-26 21:08:54', 1, 0, 0, '0000-00-00 00:00:00', '2020-06-26 21:08:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `created`, `last_updated`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'LEXI', '2020-07-20 18:20:34', '2020-07-20 12:50:34', 1, 0, 0, '0000-00-00 00:00:00'),
(2, 'MACO', '2020-07-20 18:20:40', '2020-07-20 12:50:40', 1, 0, 0, '0000-00-00 00:00:00'),
(3, 'PARAS', '2020-07-20 18:20:57', '2020-07-20 12:50:57', 1, 0, 0, '0000-00-00 00:00:00'),
(4, 'MENTAX', '2020-07-20 18:21:12', '2020-07-20 12:51:12', 1, 0, 0, '0000-00-00 00:00:00'),
(5, 'ONUS', '2020-07-20 18:21:20', '2020-07-20 12:51:20', 1, 0, 0, '0000-00-00 00:00:00'),
(6, 'PIK', '2020-07-20 18:21:29', '2020-07-20 12:51:29', 1, 0, 0, '0000-00-00 00:00:00'),
(7, 'SONI OFFICEMATE', '2020-07-20 18:21:45', '2020-07-20 12:51:45', 1, 0, 0, '0000-00-00 00:00:00'),
(8, 'A M RUBBER BAND', '2020-07-20 19:04:09', '2020-07-20 13:34:09', 1, 0, 0, '0000-00-00 00:00:00'),
(9, 'BLUE STREAK', '2020-07-20 19:23:57', '2020-07-20 13:53:57', 1, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cash_flows`
--

CREATE TABLE `cash_flows` (
  `cash_flow_id` int(11) NOT NULL,
  `to_account_name` varchar(255) NOT NULL,
  `to_account_id` int(11) NOT NULL,
  `from_account_name` varchar(255) NOT NULL,
  `from_account_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_flows`
--

INSERT INTO `cash_flows` (`cash_flow_id`, `to_account_name`, `to_account_id`, `from_account_name`, `from_account_id`, `amount`, `created`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`, `last_updated`, `is_disabled`) VALUES
(1, 'DEEPANSHU ENTERPRISES', 2, 'Bandhan Bank A/c', 1, '50.00', '2020-07-30 21:27:01', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_by`, `created`, `last_updated`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'PEN', 1, '2020-07-20 18:16:27', '2020-07-20 12:46:27', 0, 0, '0000-00-00 00:00:00'),
(2, 'RUBBER BAND', 1, '2020-07-20 18:16:42', '2020-07-20 12:46:42', 0, 0, '0000-00-00 00:00:00'),
(3, 'PHOTO GLOSY PAPER', 1, '2020-07-20 18:17:10', '2020-07-20 12:47:10', 0, 0, '0000-00-00 00:00:00'),
(4, 'MARKER', 1, '2020-07-20 18:17:28', '2020-07-20 12:47:28', 0, 0, '0000-00-00 00:00:00'),
(5, 'WHITE BOARD', 1, '2020-07-20 18:18:09', '2020-07-20 12:48:09', 0, 0, '0000-00-00 00:00:00'),
(6, 'STEPLER', 1, '2020-07-20 18:18:22', '2020-07-20 12:48:22', 0, 0, '0000-00-00 00:00:00'),
(7, 'STEPLER PIN', 1, '2020-07-20 18:18:32', '2020-07-20 12:48:32', 0, 0, '0000-00-00 00:00:00'),
(8, 'SKETCH PEN', 1, '2020-07-20 18:52:19', '2020-07-20 13:22:19', 0, 0, '0000-00-00 00:00:00'),
(9, 'CORRECTION PEN', 1, '2020-07-20 20:22:24', '2020-07-20 14:52:24', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `clientId` varchar(255) NOT NULL,
  `client_orgnisation_name` varchar(255) NOT NULL,
  `client_orgnisation_phone` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_tax_number` varchar(255) NOT NULL,
  `gstin` varchar(255) NOT NULL,
  `client_mobile` varchar(255) NOT NULL,
  `client_address_s` varchar(255) NOT NULL,
  `client_city_s` varchar(255) NOT NULL,
  `client_state_s` varchar(255) NOT NULL,
  `client_country_s` varchar(255) NOT NULL,
  `client_zip_s` varchar(255) NOT NULL,
  `client_address_b` varchar(255) NOT NULL,
  `client_city_b` varchar(255) NOT NULL,
  `client_state_b` varchar(255) NOT NULL,
  `client_country_b` varchar(255) NOT NULL,
  `client_zip_b` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `clientId`, `client_orgnisation_name`, `client_orgnisation_phone`, `client_name`, `client_email`, `client_tax_number`, `gstin`, `client_mobile`, `client_address_s`, `client_city_s`, `client_state_s`, `client_country_s`, `client_zip_s`, `client_address_b`, `client_city_b`, `client_state_b`, `client_country_b`, `client_zip_b`, `created_by`, `created`, `last_updated`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, '', 'SINGHAL STATIONERS', '9001266699', 'SINGHAL STATIONERS', '', '', '08ABBPG3844N1ZH', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 1, '2020-07-20 20:42:45', '2020-07-20 15:12:45', 0, 0, '0000-00-00 00:00:00'),
(2, '', 'DEEPANSHU ENTERPRISES', '8432675444', 'Snjay ji', '', '', '08ABFPJ0675E1ZU', '', 'S-7 AMBABARI', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 'S-7 AMBABARI', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 1, '2020-07-20 20:45:27', '2020-07-20 15:15:27', 0, 0, '0000-00-00 00:00:00'),
(3, '', 'KHANDELWAL COMUNICATION & STATIONERS', '9928236206', 'SHYAM BABU KHANDELWAL', '', '', '08AWGPK4056Q1ZX', '', 'KHATIPURA', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 'KHATIPURA', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 1, '2020-07-20 20:47:51', '2020-07-20 15:17:51', 0, 0, '0000-00-00 00:00:00'),
(4, '', 'JAIN BROTHERS', '9414287580', 'ANIL JAIN', '', '', '08ABMPJ4091R1ZU', '', 'BAJARIYA', 'SAWAI MADHOPUR', 'RAJASTHAN', 'INDIA', '', 'BAJARIYA', 'SAWAI MADHOPUR', 'RAJASTHAN', 'INDIA', '', 1, '2020-07-20 20:49:33', '2020-07-20 15:19:33', 0, 0, '0000-00-00 00:00:00'),
(5, '', 'PRAGYA ENTERPRISES', '9649932100', 'DINESH GUPTA', '', '', '08ADZPG8806C1Z8', '', 'VARUN PATH MANSROVER', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 'VARUN PATH MANSROVER', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 1, '2020-07-20 20:53:09', '2020-07-20 15:23:09', 0, 0, '0000-00-00 00:00:00'),
(6, '', 'test', '', '', '', '', '', '', 'test', 'test', 'test', 'test', '', 'test', 'test', 'test', 'test', '', 1, '2020-07-29 11:32:41', '2020-07-29 06:03:24', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_profiles`
--

CREATE TABLE `company_profiles` (
  `company_profile_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `signature_image` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `declaration` text NOT NULL,
  `terms` text NOT NULL,
  `is_gst` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=nongst,1=gst',
  `gstin` varchar(255) NOT NULL,
  `financial_year_start` date NOT NULL,
  `financial_year_end` date NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(255) NOT NULL DEFAULT 'USD',
  `currency_symbol` varchar(255) NOT NULL DEFAULT '$',
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `ad_code` varchar(255) NOT NULL,
  `swift_code` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_profiles`
--

INSERT INTO `company_profiles` (`company_profile_id`, `company_name`, `company_id`, `email`, `mobile`, `tax`, `website`, `work_phone`, `address`, `country`, `state`, `city`, `zip`, `logo_image`, `signature_image`, `signature`, `notes`, `declaration`, `terms`, `is_gst`, `gstin`, `financial_year_start`, `financial_year_end`, `currency_id`, `currency_code`, `currency_symbol`, `bank_name`, `account_number`, `branch_name`, `ifsc_code`, `ad_code`, `swift_code`, `created`, `last_updated`) VALUES
(1, 'AM ENTERPRISES', 1, 'mohitchoudhary0141@gmail.com', '9982229487', '', 'amrp.in', '6350179852', '23-A, Bajrang  Colony, Karni Palace, Hanuman Mandir, Panchyawala', 'INDIA', 'RAJASTHAN', 'JAIPUR', '302034', '', '1595001797_1.jpg', 'MOHIT', 'THIS IS TEST NOTE', '', '<div><u><strong>Terms &amp; Conditions</strong></u></div>\r\n\r\n<div>E.&amp; O.E.</div>\r\n\r\n<div>1. Goods once sold will not be taken back.</div>\r\n\r\n<div>2. Interest will be charged @24% P.A. after 30 days.</div>\r\n\r\n<div>3. Our Responsibility Ceases after handing over the goods to the carrier.</div>\r\n\r\n<div>4. Subject to Jaipur Jurisdiction only.</div>\r\n', 1, '08BGFPC0864G1ZN', '2020-04-01', '2021-03-31', 0, 'USD', '$', 'BANDHAN BANK', '10180002108376', 'VAISHALI NAGAR', 'BDBL0001518', '', '', '2020-05-20 22:25:15', '2020-07-31 07:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_symbol` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int(11) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `discount_percentage` decimal(10,2) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `to_account_id` int(11) NOT NULL,
  `to_account_name` varchar(255) NOT NULL,
  `from_account_id` int(11) NOT NULL,
  `from_account_name` varchar(255) NOT NULL,
  `expense_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leadgers`
--

CREATE TABLE `leadgers` (
  `leadger_id` int(11) NOT NULL,
  `leadger_name` varchar(255) NOT NULL,
  `account_group_id` int(11) NOT NULL,
  `opening_balance` decimal(10,2) NOT NULL,
  `closing_balance` decimal(10,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leadgers`
--

INSERT INTO `leadgers` (`leadger_id`, `leadger_name`, `account_group_id`, `opening_balance`, `closing_balance`, `description`, `created`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`, `last_updated`, `is_disabled`) VALUES
(1, 'Bandhan Bank A/c', 1, '100000.00', '0.00', '', '2020-07-30 21:23:51', 1, 0, 0, '0000-00-00 00:00:00', '2020-07-30 21:23:51', 0),
(2, 'DEEPANSHU ENTERPRISES', 1, '5000.00', '0.00', '', '2020-07-30 21:24:37', 1, 0, 0, '0000-00-00 00:00:00', '2020-07-30 21:24:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `measurement_id` int(11) NOT NULL,
  `measurement_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`measurement_id`, `measurement_name`, `created`, `created_by`, `last_updated`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'PKT', '2020-07-20 18:19:25', 1, '2020-07-20 12:49:25', 0, 0, '0000-00-00 00:00:00'),
(2, 'PCS', '2020-07-20 18:19:33', 1, '2020-07-20 12:49:33', 0, 0, '0000-00-00 00:00:00'),
(3, 'KG', '2020-07-20 18:20:10', 1, '2020-07-20 12:50:10', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `voucher_number` varchar(255) NOT NULL,
  `voucher_date` date NOT NULL,
  `to_account_name` varchar(255) NOT NULL,
  `to_account_id` int(11) NOT NULL,
  `from_account_name` varchar(255) NOT NULL,
  `from_account_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `for_transaction` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `branch_id`, `voucher_number`, `voucher_date`, `to_account_name`, `to_account_id`, `from_account_name`, `from_account_id`, `amount`, `for_transaction`, `payment_mode`, `description`, `purchase_id`, `po_number`, `created`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`, `last_updated`, `is_disabled`) VALUES
(1, 1, 'VR-001/20-21', '2020-07-30', 'DEEPANSHU ENTERPRISES', 2, 'Bandhan Bank A/c', 1, '50.00', 'Purchase', 'Cash', '', 0, '', '2020-07-30 21:27:01', 1, 0, 0, '0000-00-00 00:00:00', '2020-07-30 21:27:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `igst` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cgst` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sgst` decimal(10,2) NOT NULL,
  `measurement` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `salling_price` decimal(10,2) NOT NULL,
  `hsn_sac_code` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `item_title`, `product_description`, `sku`, `category_id`, `brand_id`, `igst`, `cgst`, `sgst`, `measurement`, `stock`, `unit_cost`, `salling_price`, `hsn_sac_code`, `is_deleted`, `created`, `created_by`, `deleted_by`, `last_updated`, `is_disabled`) VALUES
(1, 'LEXI DAX SMOOTH BLUE', '', 'SKU5F15C57F06A3A', 1, 1, '0.00', '6.00', '6.00', 1, 0, '36.00', '40.00', '96081019', 0, '2020-07-20 18:25:35', 1, 0, '2020-07-20 12:56:45', 0),
(2, 'LEXI DAX SMOOTH BLACK', '', 'SKU5F15C626DD3FD', 1, 1, '0.00', '6.00', '6.00', 1, 0, '36.00', '40.00', '96081019', 0, '2020-07-20 18:28:22', 1, 0, '2020-07-20 16:28:22', 0),
(3, 'LEXI DAX SMOOTH RED', '', 'SKU5F15C6657D23F', 1, 1, '0.00', '6.00', '6.00', 1, 0, '36.00', '40.00', '96081019', 0, '2020-07-20 18:29:25', 1, 0, '2020-07-20 16:29:25', 0),
(4, 'LEXI RACE METAL BLUE', '', 'SKU5F15C6C4D6832', 1, 1, '0.00', '6.00', '6.00', 2, 0, '6.00', '7.00', '96081019', 0, '2020-07-20 18:31:00', 1, 0, '2020-07-20 13:03:33', 0),
(5, 'LEXI RACE METAL BLACK', '', 'SKU5F15C7158D3A0', 1, 1, '0.00', '6.00', '6.00', 2, 0, '6.00', '7.00', '96081019', 0, '2020-07-20 18:32:21', 1, 0, '2020-07-20 13:03:48', 0),
(6, 'LEXI RACE METAL RED', '', 'SKU5F15C746D2FDE', 1, 1, '0.00', '6.00', '6.00', 2, 0, '6.00', '7.00', '96081019', 0, '2020-07-20 18:33:10', 1, 0, '2020-07-20 16:33:10', 0),
(7, 'LEXI FAST BOY PEN', '', 'SKU5F15C80F69398', 1, 1, '0.00', '6.00', '6.00', 2, 0, '6.65', '7.15', '96081019', 0, '2020-07-20 18:36:31', 1, 0, '2020-07-20 16:36:31', 0),
(8, 'LEXI CLIQ METAL', '', 'SKU5F15C848839F3', 1, 1, '0.00', '6.00', '6.00', 2, -30, '6.65', '7.15', '96081019', 0, '2020-07-20 18:37:28', 1, 0, '2020-07-20 16:37:28', 0),
(9, 'LEXI DAX RAINBOW', '', 'SKU5F15C8921089A', 1, 1, '0.00', '6.00', '6.00', 2, 0, '1.80', '2.00', '96081019', 0, '2020-07-20 18:38:42', 1, 0, '2020-07-20 16:38:42', 0),
(10, 'MACO EAZY GRIP BLUE', '', 'SKU5F15C8EAA1F9D', 1, 2, '0.00', '6.00', '6.00', 1, 0, '45.00', '50.00', '96081019', 0, '2020-07-20 18:40:10', 1, 0, '2020-07-20 16:40:10', 0),
(11, 'MACO EAZY GRIP BLACK', '', 'SKU5F15C91CCB946', 1, 2, '0.00', '6.00', '6.00', 1, 0, '45.00', '50.00', '96081019', 0, '2020-07-20 18:41:00', 1, 0, '2020-07-20 16:41:00', 0),
(12, 'MACO EAZY GRIP RED', '', 'SKU5F15C95376A73', 1, 2, '0.00', '6.00', '6.00', 1, 0, '45.00', '50.00', '96081019', 0, '2020-07-20 18:41:55', 1, 0, '2020-07-20 16:41:55', 0),
(13, 'MACO RECHARGE PEN', '', 'SKU5F15C9839428C', 1, 2, '0.00', '6.00', '6.00', 1, 0, '28.00', '32.00', '96081019', 0, '2020-07-20 18:42:43', 1, 0, '2020-07-20 16:42:43', 0),
(14, 'MACO PANDA PEN', '', 'SKU5F15C9E142622', 1, 2, '0.00', '6.00', '6.00', 2, 0, '2.60', '2.90', '96081019', 0, '2020-07-20 18:44:17', 1, 0, '2020-07-20 16:44:17', 0),
(15, 'ONUS STEPLER NO-10', '', 'SKU5F15CA48EFB2A', 6, 5, '0.00', '9.00', '9.00', 2, 0, '20.00', '23.00', '8472', 0, '2020-07-20 18:46:00', 1, 0, '2020-07-20 16:46:00', 0),
(16, 'ONUS STEPLER PIN NO-10 (20PC)', '', 'SKU5F15CABF782AE', 7, 5, '0.00', '9.00', '9.00', 1, 0, '80.00', '90.00', '8305', 0, '2020-07-20 18:47:59', 1, 0, '2020-07-20 16:47:59', 0),
(17, 'MENTAX GRIPO PEN', '', 'SKU5F15CB1013FEA', 1, 4, '0.00', '6.00', '6.00', 1, 0, '43.00', '50.00', '96081019', 0, '2020-07-20 18:49:20', 1, 0, '2020-07-20 16:49:20', 0),
(18, 'MENTAX LEXUS PEN', '', 'SKU5F15CB82B23FB', 1, 4, '0.00', '6.00', '6.00', 1, 0, '34.00', '38.00', '96081019', 0, '2020-07-20 18:51:14', 1, 0, '2020-07-20 16:51:14', 0),
(19, 'PARAS SKETCH PEN CHING CHONG', '', 'SKU5F15CC62A6936', 8, 3, '0.00', '6.00', '6.00', 2, 0, '5.70', '6.50', '96082000', 0, '2020-07-20 18:54:58', 1, 0, '2020-07-20 16:54:58', 0),
(20, 'PIK SUPER PERMANENT MARKER 10 PC BLACK', '', 'SKU5F15CD58AE70C', 4, 6, '0.00', '6.00', '6.00', 1, 0, '124.65', '137.00', '96082000', 0, '2020-07-20 18:59:04', 1, 0, '2020-07-20 13:29:31', 0),
(21, 'PIK SUPER PERMANENT MARKER 10PC BLUE', '', 'SKU5F15CDE5C2DA9', 4, 6, '0.00', '6.00', '6.00', 1, 0, '124.65', '137.00', '96082000', 0, '2020-07-20 19:01:25', 1, 0, '2020-07-20 17:01:25', 0),
(22, 'PIK SUPER PERMANENT MARKER 10 PC RED', '', 'SKU5F15CE1E58664', 4, 6, '0.00', '6.00', '6.00', 1, 0, '124.65', '137.00', '96082000', 0, '2020-07-20 19:02:22', 1, 0, '2020-07-20 17:02:22', 0),
(23, 'A M RUBBER BAND 400GM PKT 1.5\'\'', '', '1.5M', 2, 8, '0.00', '6.00', '6.00', 1, 0, '96.32', '140.00', '40169920', 0, '2020-07-20 19:08:22', 1, 0, '2020-07-20 17:08:22', 0),
(24, 'A M RUBBER BAND 200 GM PKT 1.5\'\'', '', '1.5M', 2, 8, '0.00', '6.00', '6.00', 1, 0, '48.16', '70.00', '40169920', 0, '2020-07-20 19:09:42', 1, 0, '2020-07-20 17:09:42', 0),
(25, 'A M RUBBER BAND 20GM PKT 1.5\'\'', '', '1.5M', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '14.00', '40169920', 0, '2020-07-20 19:11:00', 1, 0, '2020-07-20 17:11:00', 0),
(26, 'A M RUBBER BAND 10GM PKT 1.5\'\'', '', '1.5M', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '7.00', '40169920', 0, '2020-07-20 19:12:04', 1, 0, '2020-07-20 17:12:04', 0),
(27, 'A M RUBBER BAND 400GM PKT 3\'\'', '', '3 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '140.00', '40169920', 0, '2020-07-20 19:13:14', 1, 0, '2020-07-20 17:13:14', 0),
(28, 'A M RUBBER BAND 200GM PKT 3\'\'', '', '3 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '70.00', '40169920', 0, '2020-07-20 19:14:07', 1, 0, '2020-07-20 17:14:07', 0),
(29, 'A M RUBBER BAND 100 GM PKT 3\'\'', '', '3 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '35.00', '40169920', 0, '2020-07-20 19:15:35', 1, 0, '2020-07-20 17:15:35', 0),
(30, 'A M RUBBER BAND 100GM PKT 1.5\'\'', '', '1.5 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '35.00', '40169920', 0, '2020-07-20 19:17:03', 1, 0, '2020-07-20 17:17:03', 0),
(31, 'A M RUBBER BAND 400 GM PKT 2\'\'', '', '2 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '140.00', '40169920', 0, '2020-07-20 19:17:53', 1, 0, '2020-07-20 17:17:53', 0),
(32, 'A M RUBBER BAND 200 GM PKT 2\'\'', '', '2 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '70.00', '40169920', 0, '2020-07-20 19:19:10', 1, 0, '2020-07-20 17:19:10', 0),
(33, 'A M RUBBER BAND 400 GM PKT 1\'\'', '', '1 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '140.00', '40169920', 0, '2020-07-20 19:20:32', 1, 0, '2020-07-20 17:20:32', 0),
(34, 'A M RUBBER BAND 200 GM PKT 1\'\'', '', '1 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '70.00', '40169920', 0, '2020-07-20 19:21:36', 1, 0, '2020-07-20 17:21:36', 0),
(35, 'A M RUBBER BAND 400 GM PKT 0.5\'\'', '', '0.5 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '140.00', '40169920', 0, '2020-07-20 19:22:29', 1, 0, '2020-07-20 17:22:29', 0),
(36, 'A M RUBBER BAND 200 GM PKT 0.5\'\'', '', '0.5 M ', 2, 8, '0.00', '6.00', '6.00', 1, 0, '0.00', '70.00', '40169920', 0, '2020-07-20 19:23:24', 1, 0, '2020-07-20 17:23:24', 0),
(37, 'BLUE STREAK PHOTO GLOSY PAPER (180-50)', '', 'SKU5F15D39600F41', 3, 9, '0.00', '6.00', '6.00', 1, 0, '112.00', '125.00', '48022090', 0, '2020-07-20 19:25:42', 1, 0, '2020-07-20 17:25:42', 0),
(38, 'BLUE STREAK PHOTO GLOSY PAPER (130-50)', '', 'SKU5F15D3DF5D434', 3, 9, '0.00', '6.00', '6.00', 1, 0, '95.00', '110.00', '48022090', 0, '2020-07-20 19:26:55', 1, 0, '2020-07-20 17:26:55', 0),
(39, 'PIK SKETCH DINOO AST', '', 'SKU5F15D43F9C4D7', 8, 6, '0.00', '6.00', '6.00', 2, 0, '11.40', '12.50', '96082000', 0, '2020-07-20 19:28:31', 1, 0, '2020-07-20 17:28:31', 0),
(40, 'SONI OFFICEMATE WHITE INK PEN', '', 'SKU5F15E12D64CD0', 9, 7, '0.00', '6.00', '6.00', 2, 0, '12.00', '13.00', '', 0, '2020-07-20 20:23:41', 1, 0, '2020-07-20 18:23:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_histories`
--

CREATE TABLE `product_histories` (
  `history_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `igst` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cgst` decimal(10,0) NOT NULL DEFAULT '0',
  `sgst` decimal(10,2) NOT NULL,
  `measurement` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `salling_price` decimal(10,2) NOT NULL,
  `hsn_sac_code` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_histories`
--

INSERT INTO `product_histories` (`history_id`, `product_id`, `action`, `item_title`, `product_description`, `sku`, `category_id`, `brand_id`, `igst`, `cgst`, `sgst`, `measurement`, `stock`, `unit_cost`, `salling_price`, `hsn_sac_code`, `is_deleted`, `created`, `created_by`, `deleted_by`, `last_updated`, `is_disabled`) VALUES
(1, 1, 'Add Product', 'LEXI DAX SMOOTH', '', 'SKU5F15C57F06A3A', 1, 1, '0.00', '6', '6.00', 1, 0, '36.00', '40.00', '96081019', 0, '2020-07-20 18:25:35', 1, 0, '2020-07-20 16:25:35', 0),
(2, 1, 'Update Product', 'LEXI DAX SMOOTH BLUE', '', '', 1, 1, '0.00', '6', '6.00', 1, 0, '36.00', '40.00', '96081019', 0, '2020-07-20 18:26:45', 1, 0, '2020-07-20 12:56:45', 0),
(3, 2, 'Add Product', 'LEXI DAX SMOOTH BLACK', '', 'SKU5F15C626DD3FD', 1, 1, '0.00', '6', '6.00', 1, 0, '36.00', '40.00', '96081019', 0, '2020-07-20 18:28:22', 1, 0, '2020-07-20 16:28:23', 0),
(4, 3, 'Add Product', 'LEXI DAX SMOOTH RED', '', 'SKU5F15C6657D23F', 1, 1, '0.00', '6', '6.00', 1, 0, '36.00', '40.00', '96081019', 0, '2020-07-20 18:29:25', 1, 0, '2020-07-20 16:29:25', 0),
(5, 4, 'Add Product', 'LEXI RACE METAL BLUE', '', 'SKU5F15C6C4D6832', 1, 1, '0.00', '6', '6.00', 1, 0, '6.00', '7.00', '96081019', 0, '2020-07-20 18:31:00', 1, 0, '2020-07-20 16:31:01', 0),
(6, 5, 'Add Product', 'LEXI RACE METAL BLACK', '', 'SKU5F15C7158D3A0', 1, 1, '0.00', '6', '6.00', 1, 0, '6.00', '7.00', '96081019', 0, '2020-07-20 18:32:21', 1, 0, '2020-07-20 16:32:21', 0),
(7, 6, 'Add Product', 'LEXI RACE METAL RED', '', 'SKU5F15C746D2FDE', 1, 1, '0.00', '6', '6.00', 2, 0, '6.00', '7.00', '96081019', 0, '2020-07-20 18:33:10', 1, 0, '2020-07-20 16:33:10', 0),
(8, 4, 'Update Product', 'LEXI RACE METAL BLUE', '', '', 1, 1, '0.00', '6', '6.00', 2, 0, '6.00', '7.00', '96081019', 0, '2020-07-20 18:33:34', 1, 0, '2020-07-20 13:03:33', 0),
(9, 5, 'Update Product', 'LEXI RACE METAL BLACK', '', '', 1, 1, '0.00', '6', '6.00', 2, 0, '6.00', '7.00', '96081019', 0, '2020-07-20 18:33:48', 1, 0, '2020-07-20 13:03:48', 0),
(10, 7, 'Add Product', 'LEXI FAST BOY PEN', '', 'SKU5F15C80F69398', 1, 1, '0.00', '6', '6.00', 2, 0, '6.65', '7.15', '96081019', 0, '2020-07-20 18:36:31', 1, 0, '2020-07-20 16:36:31', 0),
(11, 8, 'Add Product', 'LEXI CLIQ METAL', '', 'SKU5F15C848839F3', 1, 1, '0.00', '6', '6.00', 2, 0, '6.65', '7.15', '96081019', 0, '2020-07-20 18:37:28', 1, 0, '2020-07-20 16:37:28', 0),
(12, 9, 'Add Product', 'LEXI DAX RAINBOW', '', 'SKU5F15C8921089A', 1, 1, '0.00', '6', '6.00', 2, 0, '1.80', '2.00', '96081019', 0, '2020-07-20 18:38:42', 1, 0, '2020-07-20 16:38:42', 0),
(13, 10, 'Add Product', 'MACO EAZY GRIP BLUE', '', 'SKU5F15C8EAA1F9D', 1, 2, '0.00', '6', '6.00', 1, 0, '45.00', '50.00', '96081019', 0, '2020-07-20 18:40:10', 1, 0, '2020-07-20 16:40:10', 0),
(14, 11, 'Add Product', 'MACO EAZY GRIP BLACK', '', 'SKU5F15C91CCB946', 1, 2, '0.00', '6', '6.00', 1, 0, '45.00', '50.00', '96081019', 0, '2020-07-20 18:41:00', 1, 0, '2020-07-20 16:41:00', 0),
(15, 12, 'Add Product', 'MACO EAZY GRIP RED', '', 'SKU5F15C95376A73', 1, 2, '0.00', '6', '6.00', 1, 0, '45.00', '50.00', '96081019', 0, '2020-07-20 18:41:55', 1, 0, '2020-07-20 16:41:55', 0),
(16, 13, 'Add Product', 'MACO RECHARGE PEN', '', 'SKU5F15C9839428C', 1, 2, '0.00', '6', '6.00', 1, 0, '28.00', '32.00', '96081019', 0, '2020-07-20 18:42:43', 1, 0, '2020-07-20 16:42:43', 0),
(17, 14, 'Add Product', 'MACO PANDA PEN', '', 'SKU5F15C9E142622', 1, 2, '0.00', '6', '6.00', 2, 0, '2.60', '2.90', '96081019', 0, '2020-07-20 18:44:17', 1, 0, '2020-07-20 16:44:17', 0),
(18, 15, 'Add Product', 'ONUS STEPLER NO-10', '', 'SKU5F15CA48EFB2A', 6, 5, '0.00', '9', '9.00', 2, 0, '20.00', '23.00', '8472', 0, '2020-07-20 18:46:00', 1, 0, '2020-07-20 16:46:01', 0),
(19, 16, 'Add Product', 'ONUS STEPLER PIN NO-10 (20PC)', '', 'SKU5F15CABF782AE', 7, 5, '0.00', '9', '9.00', 1, 0, '80.00', '90.00', '8305', 0, '2020-07-20 18:47:59', 1, 0, '2020-07-20 16:47:59', 0),
(20, 17, 'Add Product', 'MENTAX GRIPO PEN', '', 'SKU5F15CB1013FEA', 1, 4, '0.00', '6', '6.00', 1, 0, '43.00', '50.00', '96081019', 0, '2020-07-20 18:49:20', 1, 0, '2020-07-20 16:49:20', 0),
(21, 18, 'Add Product', 'MENTAX LEXUS PEN', '', 'SKU5F15CB82B23FB', 1, 4, '0.00', '6', '6.00', 1, 0, '34.00', '38.00', '96081019', 0, '2020-07-20 18:51:14', 1, 0, '2020-07-20 16:51:14', 0),
(22, 19, 'Add Product', 'PARAS SKETCH PEN CHING CHONG', '', 'SKU5F15CC62A6936', 8, 3, '0.00', '6', '6.00', 2, 0, '5.70', '6.50', '96082000', 0, '2020-07-20 18:54:58', 1, 0, '2020-07-20 16:54:58', 0),
(23, 20, 'Add Product', 'PIK SUPER PERMANENT MARKER 10 PC', '', 'SKU5F15CD58AE70C', 4, 6, '0.00', '6', '6.00', 1, 0, '124.65', '137.00', '96082000', 0, '2020-07-20 18:59:04', 1, 0, '2020-07-20 16:59:04', 0),
(24, 20, 'Update Product', 'PIK SUPER PERMANENT MARKER 10 PC BLACK', '', '', 4, 6, '0.00', '6', '6.00', 1, 0, '124.65', '137.00', '96082000', 0, '2020-07-20 18:59:31', 1, 0, '2020-07-20 13:29:31', 0),
(25, 21, 'Add Product', 'PIK SUPER PERMANENT MARKER 10PC BLUE', '', 'SKU5F15CDE5C2DA9', 4, 6, '0.00', '6', '6.00', 1, 0, '124.65', '137.00', '96082000', 0, '2020-07-20 19:01:25', 1, 0, '2020-07-20 17:01:25', 0),
(26, 22, 'Add Product', 'PIK SUPER PERMANENT MARKER 10 PC RED', '', 'SKU5F15CE1E58664', 4, 6, '0.00', '6', '6.00', 1, 0, '124.65', '137.00', '96082000', 0, '2020-07-20 19:02:22', 1, 0, '2020-07-20 17:02:22', 0),
(27, 23, 'Add Product', 'A M RUBBER BAND 400GM PKT 1.5\'\'', '', '1.5M', 2, 8, '0.00', '6', '6.00', 1, 0, '96.32', '140.00', '40169920', 0, '2020-07-20 19:08:22', 1, 0, '2020-07-20 17:08:22', 0),
(28, 24, 'Add Product', 'A M RUBBER BAND 200 GM PKT 1.5\'\'', '', '1.5M', 2, 8, '0.00', '6', '6.00', 1, 0, '48.16', '70.00', '40169920', 0, '2020-07-20 19:09:42', 1, 0, '2020-07-20 17:09:42', 0),
(29, 25, 'Add Product', 'A M RUBBER BAND 20GM PKT 1.5\'\'', '', '1.5M', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '14.00', '40169920', 0, '2020-07-20 19:11:00', 1, 0, '2020-07-20 17:11:00', 0),
(30, 26, 'Add Product', 'A M RUBBER BAND 10GM PKT 1.5\'\'', '', '1.5M', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '7.00', '40169920', 0, '2020-07-20 19:12:04', 1, 0, '2020-07-20 17:12:04', 0),
(31, 27, 'Add Product', 'A M RUBBER BAND 400GM PKT 3\'\'', '', '3 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '140.00', '40169920', 0, '2020-07-20 19:13:14', 1, 0, '2020-07-20 17:13:14', 0),
(32, 28, 'Add Product', 'A M RUBBER BAND 200GM PKT 3\'\'', '', '3 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '70.00', '40169920', 0, '2020-07-20 19:14:07', 1, 0, '2020-07-20 17:14:07', 0),
(33, 29, 'Add Product', 'A M RUBBER BAND 100 GM PKT 3\'\'', '', '3 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '35.00', '40169920', 0, '2020-07-20 19:15:35', 1, 0, '2020-07-20 17:15:35', 0),
(34, 30, 'Add Product', 'A M RUBBER BAND 100GM PKT 1.5\'\'', '', '1.5 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '35.00', '40169920', 0, '2020-07-20 19:17:03', 1, 0, '2020-07-20 17:17:03', 0),
(35, 31, 'Add Product', 'A M RUBBER BAND 400 GM PKT 2\'\'', '', '2 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '140.00', '40169920', 0, '2020-07-20 19:17:53', 1, 0, '2020-07-20 17:17:53', 0),
(36, 32, 'Add Product', 'A M RUBBER BAND 200 GM PKT 2\'\'', '', '2 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '70.00', '40169920', 0, '2020-07-20 19:19:10', 1, 0, '2020-07-20 17:19:10', 0),
(37, 33, 'Add Product', 'A M RUBBER BAND 400 GM PKT 1\'\'', '', '1 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '140.00', '40169920', 0, '2020-07-20 19:20:32', 1, 0, '2020-07-20 17:20:32', 0),
(38, 34, 'Add Product', 'A M RUBBER BAND 200 GM PKT 1\'\'', '', '1 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '70.00', '40169920', 0, '2020-07-20 19:21:36', 1, 0, '2020-07-20 17:21:36', 0),
(39, 35, 'Add Product', 'A M RUBBER BAND 400 GM PKT 0.5\'\'', '', '0.5 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '140.00', '40169920', 0, '2020-07-20 19:22:29', 1, 0, '2020-07-20 17:22:29', 0),
(40, 36, 'Add Product', 'A M RUBBER BAND 200 GM PKT 0.5\'\'', '', '0.5 M ', 2, 8, '0.00', '6', '6.00', 1, 0, '0.00', '70.00', '40169920', 0, '2020-07-20 19:23:24', 1, 0, '2020-07-20 17:23:24', 0),
(41, 37, 'Add Product', 'BLUE STREAK PHOTO GLOSY PAPER (180-50)', '', 'SKU5F15D39600F41', 3, 9, '0.00', '6', '6.00', 1, 0, '112.00', '125.00', '48022090', 0, '2020-07-20 19:25:42', 1, 0, '2020-07-20 17:25:42', 0),
(42, 38, 'Add Product', 'BLUE STREAK PHOTO GLOSY PAPER (130-50)', '', 'SKU5F15D3DF5D434', 3, 9, '0.00', '6', '6.00', 1, 0, '95.00', '110.00', '48022090', 0, '2020-07-20 19:26:55', 1, 0, '2020-07-20 17:26:55', 0),
(43, 39, 'Add Product', 'PIK SKETCH DINOO AST', '', 'SKU5F15D43F9C4D7', 8, 6, '0.00', '6', '6.00', 2, 0, '11.40', '12.50', '96082000', 0, '2020-07-20 19:28:31', 1, 0, '2020-07-20 17:28:31', 0),
(44, 40, 'Add Product', 'SONI OFFICEMATE WHITE INK PEN', '', 'SKU5F15E12D64CD0', 9, 7, '0.00', '6', '6.00', 2, 0, '12.00', '13.00', '', 0, '2020-07-20 20:23:41', 1, 0, '2020-07-20 18:23:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `wherehouse_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_city` varchar(255) NOT NULL,
  `supplier_state` varchar(255) NOT NULL,
  `supplier_country` varchar(255) NOT NULL,
  `supplier_zip` varchar(255) NOT NULL,
  `supplier_phone` varchar(255) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_tax_no` varchar(255) NOT NULL,
  `b_address` varchar(255) NOT NULL,
  `b_city` varchar(255) NOT NULL,
  `b_state` varchar(255) NOT NULL,
  `b_country` varchar(255) NOT NULL,
  `b_zip` varchar(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `s_city` varchar(255) NOT NULL,
  `s_state` varchar(255) NOT NULL,
  `s_country` varchar(255) NOT NULL,
  `s_zip` varchar(255) NOT NULL,
  `supplier_invoice` varchar(255) NOT NULL,
  `supplier_order` varchar(255) NOT NULL,
  `dispatch_document_no` varchar(255) NOT NULL,
  `delivery_note_date` varchar(255) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `total_discount` decimal(10,2) NOT NULL,
  `total_igst` decimal(10,2) NOT NULL,
  `total_cgst` decimal(10,2) NOT NULL,
  `total_sgst` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `less_round_off` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `is_returned` int(11) NOT NULL DEFAULT '0',
  `is_reverce_charge` tinyint(1) NOT NULL DEFAULT '0',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `po_number`, `supplier_id`, `wherehouse_id`, `purchase_date`, `supplier_name`, `supplier_address`, `supplier_city`, `supplier_state`, `supplier_country`, `supplier_zip`, `supplier_phone`, `supplier_email`, `supplier_tax_no`, `b_address`, `b_city`, `b_state`, `b_country`, `b_zip`, `s_address`, `s_city`, `s_state`, `s_country`, `s_zip`, `supplier_invoice`, `supplier_order`, `dispatch_document_no`, `delivery_note_date`, `sub_total`, `total_discount`, `total_igst`, `total_cgst`, `total_sgst`, `total`, `less_round_off`, `grand_total`, `paid_amount`, `is_returned`, `is_reverce_charge`, `is_paid`, `notes`, `created`, `created_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'PO-001/20-21', 1, 1, '2020-07-24', 'SS TREDLINK', 'ambawadi', 'jaipur', 'rajasthan', 'jaipur', '302034', '6377098903', '', '', '23-A, Bajrang  Colony, Karni Palace, Hanuman Mandir, Panchyawala,', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', '23-A, BAJRANG COLONY, KARNI PALACE , VAISHALI NAGAR', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', 'inv34', 'ord34', 'dsp', '07/24/2020', '96.00', '0.00', '0.00', '3.24', '5.76', '105.00', '0.00', '105.00', '0', 0, 0, 0, '', '2020-07-27 10:57:11', 1, 1, '2020-07-30 12:38:42', 1),
(2, 'PO-002/20-21', 1, 1, '2020-07-24', 'SS TREDLINK', 'ambawadi', 'jaipur', 'rajasthan', 'jaipur', '302034', '6377098903', '', '', '23-A, Bajrang  Colony, Karni Palace, Hanuman Mandir, Panchyawala,', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', '23-A, BAJRANG COLONY, KARNI PALACE , VAISHALI NAGAR', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', 'inv343', 'ord343', 'dsp234', '07/24/2020', '30.00', '0.00', '0.00', '1.80', '1.80', '33.60', '0.60', '33.00', '0', 0, 0, 0, '', '2020-07-24 19:25:27', 1, 1, '2020-07-30 12:39:26', 1),
(3, 'PO-003/20-21', 2, 1, '2020-07-29', 'test', 'test', 'jaipur', 'rajasthan', 'jaipur', '', '', '', '', '23-A, Bajrang  Colony, Karni Palace, Hanuman Mandir, Panchyawala,', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', '23-A, BAJRANG COLONY, KARNI PALACE , VAISHALI NAGAR', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', 'inv3434', '', '', '07/29/2020', '6.65', '0.00', '0.00', '0.26', '0.40', '7.31', '0.31', '7.00', '0', 0, 0, 0, '', '2020-07-29 13:32:37', 1, 1, '2020-07-30 12:42:25', 1),
(4, 'PO-004/20-21', 1, 1, '2020-07-29', 'SS TREDLINK', 'ambawadi', 'jaipur', 'rajasthan', 'jaipur', '', '6377098903', '', '', '23-A, Bajrang  Colony, Karni Palace, Hanuman Mandir, Panchyawala,', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', '23-A, BAJRANG COLONY, KARNI PALACE , VAISHALI NAGAR', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', 'inv234', '', '', '07/29/2020', '216.00', '0.00', '0.00', '50.39', '12.96', '279.35', '0.35', '279.00', '0', 0, 0, 0, '', '2020-07-29 14:10:37', 1, 1, '2020-07-30 12:42:20', 1),
(5, 'PO-005/20-21', 1, 1, '2020-07-30', 'SS TREDLINK', 'ambawadi', 'jaipur', 'rajasthan', 'jaipur', '', '6377098903', '', '', '23-A, Bajrang  Colony, Karni Palace, Hanuman Mandir, Panchyawala,', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', '23-A, BAJRANG COLONY, KARNI PALACE , VAISHALI NAGAR', 'JAIPUR', 'RAJASTHAN', 'INDIA', '302034', 'inv3434', '', '', '07/30/2020', '66.50', '0.00', '0.00', '3.99', '3.99', '74.48', '0.48', '74.00', '50', 0, 0, 1, '', '2020-07-30 12:45:11', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `purchase_item_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `measurement_id` int(11) NOT NULL,
  `measurement_name` varchar(255) NOT NULL,
  `hsn_sac_code` varchar(255) NOT NULL,
  `cgst` decimal(10,2) NOT NULL,
  `cgst_amount` decimal(10,2) NOT NULL,
  `igst` decimal(10,2) NOT NULL,
  `igst_amount` decimal(10,2) NOT NULL,
  `sgst` decimal(10,2) NOT NULL,
  `sgst_amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `grand_total_coast` decimal(10,2) NOT NULL,
  `salling_price` decimal(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`purchase_item_id`, `purchase_id`, `item_title`, `measurement_id`, `measurement_name`, `hsn_sac_code`, `cgst`, `cgst_amount`, `igst`, `igst_amount`, `sgst`, `sgst_amount`, `discount`, `discount_amount`, `unit_cost`, `item_qty`, `total_cost`, `grand_total_coast`, `salling_price`, `created`, `product_id`) VALUES
(3, 2, 'LEXI RACE METAL BLUE', 2, 'PCS', '96081019', '1.80', '1.80', '0.00', '0.00', '6.00', '1.80', '0.00', '0.00', '6.00', 5, '30.00', '33.60', '0.00', '2020-07-24 19:25:27', 4),
(4, 1, 'LEXI RACE METAL BLUE', 1, 'PKT', '96081019', '0.54', '0.54', '0.00', '0.00', '6.00', '1.80', '0.00', '0.00', '6.00', 5, '30.00', '32.34', '0.00', '2020-07-27 10:57:11', 4),
(5, 1, 'LEXI RACE METAL BLUE', 1, 'PKT', '96081019', '0.54', '0.54', '0.00', '0.00', '6.00', '1.80', '0.00', '0.00', '6.00', 5, '30.00', '32.34', '0.00', '2020-07-27 10:57:11', 4),
(6, 1, 'LEXI RACE METAL BLACK', 2, 'PCS', '96081019', '2.16', '2.16', '0.00', '0.00', '6.00', '2.16', '0.00', '0.00', '6.00', 6, '36.00', '40.32', '0.00', '2020-07-27 10:57:11', 5),
(13, 3, 'LEXI CLIQ METAL', 1, 'PKT', '96081019', '0.26', '0.26', '0.00', '0.00', '6.00', '0.40', '0.00', '0.00', '6.65', 1, '6.65', '7.31', '0.00', '2020-07-29 13:32:37', 8),
(19, 4, 'LEXI DAX SMOOTH BLUE', 1, 'PKT', '96081019', '50.39', '50.39', '0.00', '0.00', '6.00', '12.96', '0.00', '0.00', '36.00', 6, '216.00', '279.35', '0.00', '2020-07-29 14:10:37', 1),
(20, 5, 'LEXI CLIQ METAL', 2, 'PCS', '96081019', '3.99', '3.99', '0.00', '0.00', '6.00', '3.99', '0.00', '0.00', '6.65', 10, '66.50', '74.48', '0.00', '2020-07-30 12:45:11', 8);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `payment_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `receipt_date` date NOT NULL,
  `to_account_name` varchar(255) NOT NULL,
  `to_account_id` int(11) NOT NULL,
  `from_account_name` varchar(255) NOT NULL,
  `from_account_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `for_transaction` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `wherehouse_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_address` varchar(255) NOT NULL,
  `client_city` varchar(255) NOT NULL,
  `client_state` varchar(255) NOT NULL,
  `client_country` varchar(255) NOT NULL,
  `client_zip` varchar(255) NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_gstin_no` varchar(255) NOT NULL,
  `b_address` varchar(255) NOT NULL,
  `b_city` varchar(255) NOT NULL,
  `b_state` varchar(255) NOT NULL,
  `b_country` varchar(255) NOT NULL,
  `b_zip` varchar(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `s_city` varchar(255) NOT NULL,
  `s_state` varchar(255) NOT NULL,
  `s_country` varchar(255) NOT NULL,
  `s_zip` varchar(255) NOT NULL,
  `transportation_mode` varchar(255) NOT NULL,
  `distance_to_transport` varchar(255) NOT NULL,
  `transporter_name` varchar(255) NOT NULL,
  `transporter_id` varchar(255) NOT NULL,
  `transporter_document_no` varchar(255) NOT NULL,
  `transporter_document_date` date NOT NULL,
  `vechicle_no` varchar(255) NOT NULL,
  `place_of_supply` varchar(255) NOT NULL,
  `client_order` varchar(255) NOT NULL,
  `dispatch_document_no` varchar(255) NOT NULL,
  `delivery_note_date` varchar(255) NOT NULL,
  `dispatch_through` varchar(255) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `total_discount` decimal(10,2) NOT NULL,
  `total_igst` decimal(10,2) NOT NULL,
  `total_cgst` decimal(10,2) NOT NULL,
  `total_sgst` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `less_round_off` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text NOT NULL,
  `is_returned` int(11) NOT NULL DEFAULT '0',
  `is_reverce_charge` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no;1=yes	',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unpaid;1=paid',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `invoice_number`, `client_id`, `wherehouse_id`, `invoice_date`, `client_name`, `client_address`, `client_city`, `client_state`, `client_country`, `client_zip`, `client_phone`, `client_email`, `client_gstin_no`, `b_address`, `b_city`, `b_state`, `b_country`, `b_zip`, `s_address`, `s_city`, `s_state`, `s_country`, `s_zip`, `transportation_mode`, `distance_to_transport`, `transporter_name`, `transporter_id`, `transporter_document_no`, `transporter_document_date`, `vechicle_no`, `place_of_supply`, `client_order`, `dispatch_document_no`, `delivery_note_date`, `dispatch_through`, `sub_total`, `total_discount`, `total_igst`, `total_cgst`, `total_sgst`, `total`, `less_round_off`, `grand_total`, `paid_amount`, `notes`, `is_returned`, `is_reverce_charge`, `is_paid`, `created`, `created_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'INV-001/20-21', 1, 1, '2020-07-20', 'SINGHAL STATIONERS', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', '', 'amitchoudhary9487@gmail.com', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'Road', '', 'bkd', 'trans', '', '2020-07-20', '', '', '', '', '', '', '822.00', '0.00', '0.00', '2534.45', '49.32', '0.00', '0.00', '3405.00', '0.00', '', 0, 0, 0, '2020-07-30 11:33:23', 1, 1, '2020-07-30 12:24:13', 1),
(4, 'INV-002/20-21', 1, 1, '2020-07-24', 'SINGHAL STATIONERS', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'trans234', '23', 'test', 'test34', 'trans34', '2020-07-24', 'vec34', 'raj', '', '', '07/24/2020', '', '30.00', '0.00', '0.00', '1.80', '1.80', '0.00', '0.00', '33.00', '0.00', '', 0, 0, 0, '2020-07-24 19:45:32', 1, 0, NULL, NULL),
(5, 'INV-003/20-21', 3, 1, '2020-07-24', 'KHANDELWAL COMUNICATION & STATIONERS', 'KHATIPURA', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'KHATIPURA', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 'KHATIPURA', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 'trasns324', '234', 'vk', 'ord', 'tes', '2020-07-24', '', '', '', '', '07/24/2020', '', '18.00', '0.00', '0.00', '1.08', '1.08', '0.00', '0.00', '20.00', '0.00', '', 0, 0, 0, '2020-07-24 19:49:54', 1, 0, NULL, NULL),
(8, 'INV-004/20-21', 5, 1, '2020-07-24', 'PRAGYA ENTERPRISES', 'VARUN PATH MANSROVER', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'VARUN PATH MANSROVER', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 'VARUN PATH MANSROVER', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 'ord', 'test', 'ra', '', '', '2020-07-24', '', '', '', '', '07/24/2020', '', '12.00', '0.00', '0.00', '0.72', '0.72', '0.00', '0.00', '13.00', '0.00', '', 0, 0, 0, '2020-07-24 19:58:15', 1, 0, NULL, NULL),
(9, 'INV-005/20-21', 1, 1, '2020-07-24', 'SINGHAL STATIONERS', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', '', '', '2020-07-24', '', '', '', '', '07/24/2020', '', '30.00', '0.00', '0.00', '1.80', '1.80', '0.00', '0.00', '33.00', '0.00', '', 0, 0, 0, '2020-07-24 20:03:28', 1, 0, NULL, NULL),
(10, 'INV-006/20-21', 5, 1, '2020-07-24', 'PRAGYA ENTERPRISES', 'VARUN PATH MANSROVER', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', '', 'amitchoudhary9487@gmail.com', '', 'VARUN PATH MANSROVER', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', 'VARUN PATH MANSROVER', 'JAIPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', '', '', '2020-07-24', '', '', '', '', '07/24/2020', '', '30.00', '0.00', '0.00', '1.80', '1.80', '0.00', '0.00', '33.00', '0.00', '', 0, 0, 0, '2020-07-24 20:19:39', 1, 0, NULL, 0),
(11, 'INV-007/20-21', 4, 1, '2020-07-29', 'JAIN BROTHERS', 'BAJARIYA', 'SAWAI MADHOPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'BAJARIYA', 'SAWAI MADHOPUR', 'RAJASTHAN', 'INDIA', '', 'BAJARIYA', 'SAWAI MADHOPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', '', '', '2020-07-29', '', '', '', '', '07/29/2020', '', '33.25', '0.00', '0.00', '2.00', '2.00', '0.00', '0.00', '37.00', '0.00', '', 0, 0, 0, '2020-07-29 12:28:31', 1, 1, '2020-07-30 12:25:45', 1),
(12, 'INV-001/20-21', 1, 1, '2020-07-20', 'SINGHAL STATIONERS', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'Road', '', 'bkd', 'trans', '', '2020-07-20', '', '', '', '', '', '', '822.00', '0.00', '0.00', '2534.45', '49.32', '0.00', '0.00', '3405.00', '0.00', '', 0, 0, 0, '2020-07-30 11:39:08', 1, 0, NULL, NULL),
(13, 'INV-001/20-21', 1, 1, '2020-07-20', 'SINGHAL STATIONERS', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'Road', '', 'bkd', 'trans', '', '2020-07-20', '', '', '', '', '', '', '822.00', '0.00', '0.00', '2534.45', '49.32', '0.00', '0.00', '3405.00', '0.00', '', 0, 0, 0, '2020-07-30 11:40:30', 1, 0, NULL, NULL),
(14, 'INV-001/20-21', 1, 1, '2020-07-20', 'SINGHAL STATIONERS', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'GANGAPUR', 'GANGAPUR', 'RAJASTHAN', 'INDIA', '', 'Road', '', 'bkd', 'trans', '', '2020-07-20', '', '', '', '', '', '', '822.00', '0.00', '0.00', '2534.45', '49.32', '0.00', '0.00', '3405.00', '0.00', '', 0, 0, 0, '2020-07-30 11:43:58', 1, 0, NULL, NULL),
(15, 'INV-011/20-21', 4, 1, '2020-07-31', 'JAIN BROTHERS', 'BAJARIYA', 'SAWAI MADHOPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', 'BAJARIYA', 'SAWAI MADHOPUR', 'RAJASTHAN', 'INDIA', '', 'BAJARIYA', 'SAWAI MADHOPUR', 'RAJASTHAN', 'INDIA', '', '', '', '', '', '', '2020-07-31', '', '', '', '', '07/31/2020', '', '817.35', '80.00', '0.00', '57.64', '57.64', '0.00', '0.00', '852.00', '0.00', '', 0, 0, 0, '2020-07-31 09:52:12', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `sale_item_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `measurement_id` int(11) NOT NULL,
  `measurement_name` varchar(255) NOT NULL,
  `hsn_sac_code` varchar(255) NOT NULL,
  `igst` decimal(10,2) NOT NULL,
  `igst_amount` decimal(10,2) NOT NULL,
  `cgst` decimal(10,2) NOT NULL,
  `cgst_amount` decimal(10,2) NOT NULL,
  `sgst` decimal(10,2) NOT NULL,
  `sgst_amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `grand_total_coast` decimal(10,2) NOT NULL,
  `salling_price` decimal(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`sale_item_id`, `sale_id`, `item_title`, `measurement_id`, `measurement_name`, `hsn_sac_code`, `igst`, `igst_amount`, `cgst`, `cgst_amount`, `sgst`, `sgst_amount`, `discount`, `discount_amount`, `unit_cost`, `item_qty`, `total_cost`, `grand_total_coast`, `salling_price`, `created`, `product_id`) VALUES
(6, 4, 'LEXI RACE METAL BLUE', 2, 'PCS', '96081019', '0.00', '0.00', '1.80', '1.80', '6.00', '1.80', '0.00', '0.00', '6.00', 5, '30.00', '33.60', '0.00', '2020-07-24 19:45:32', 4),
(7, 5, 'LEXI RACE METAL BLUE', 2, 'PCS', '96081019', '0.00', '0.00', '1.08', '1.08', '6.00', '1.08', '0.00', '0.00', '6.00', 3, '18.00', '20.16', '0.00', '2020-07-24 19:49:54', 4),
(10, 8, 'LEXI RACE METAL BLUE', 2, 'PCS', '96081019', '0.00', '0.00', '0.72', '0.72', '6.00', '0.72', '0.00', '0.00', '6.00', 2, '12.00', '13.44', '0.00', '2020-07-24 19:58:15', 4),
(11, 9, 'LEXI RACE METAL BLUE', 2, 'PCS', '96081019', '0.00', '0.00', '1.80', '1.80', '6.00', '1.80', '0.00', '0.00', '6.00', 5, '30.00', '33.60', '0.00', '2020-07-24 20:03:28', 4),
(12, 10, 'LEXI RACE METAL BLUE', 2, 'PCS', '96081019', '0.00', '0.00', '1.80', '1.80', '6.00', '1.80', '0.00', '0.00', '6.00', 5, '30.00', '33.60', '0.00', '2020-07-24 20:19:39', 4),
(13, 11, 'LEXI CLIQ METAL', 2, 'PCS', '96081019', '0.00', '0.00', '2.00', '2.00', '6.00', '2.00', '0.00', '0.00', '6.65', 5, '33.25', '37.24', '0.00', '2020-07-29 12:28:31', 8),
(29, 1, 'LEXI DAX RAINBOW', 1, 'PKT', '96081019', '0.00', '0.00', '3.50', '3.50', '6.00', '5.40', '0.00', '0.00', '1.80', 50, '90.00', '98.90', '0.00', '2020-07-30 11:33:23', 9),
(30, 1, 'LEXI DAX SMOOTH BLACK', 1, 'PKT', '96081019', '0.00', '0.00', '2519.42', '2519.42', '6.00', '32.40', '0.00', '0.00', '36.00', 15, '540.00', '3091.82', '0.00', '2020-07-30 11:33:23', 2),
(31, 1, 'LEXI RACE METAL BLACK', 1, 'PCS', '96081019', '0.00', '0.00', '11.52', '11.52', '6.00', '11.52', '0.00', '0.00', '6.00', 32, '192.00', '215.04', '0.00', '2020-07-30 11:33:23', 5),
(32, 12, 'LEXI DAX RAINBOW', 1, 'PKT', '96081019', '0.00', '0.00', '3.50', '3.50', '6.00', '5.40', '0.00', '0.00', '1.80', 50, '90.00', '98.90', '0.00', '2020-07-30 11:39:08', 9),
(33, 12, 'LEXI DAX SMOOTH BLACK', 1, 'PKT', '96081019', '0.00', '0.00', '2519.42', '2519.42', '6.00', '32.40', '0.00', '0.00', '36.00', 15, '540.00', '3091.82', '0.00', '2020-07-30 11:39:08', 2),
(34, 12, 'LEXI RACE METAL BLACK', 1, 'PCS', '96081019', '0.00', '0.00', '11.52', '11.52', '6.00', '11.52', '0.00', '0.00', '6.00', 32, '192.00', '215.04', '0.00', '2020-07-30 11:39:08', 5),
(35, 13, 'LEXI DAX RAINBOW', 1, 'PKT', '96081019', '0.00', '0.00', '3.50', '3.50', '6.00', '5.40', '0.00', '0.00', '1.80', 50, '90.00', '98.90', '0.00', '2020-07-30 11:40:30', 9),
(36, 13, 'LEXI DAX SMOOTH BLACK', 1, 'PKT', '96081019', '0.00', '0.00', '2519.42', '2519.42', '6.00', '32.40', '0.00', '0.00', '36.00', 15, '540.00', '3091.82', '0.00', '2020-07-30 11:40:30', 2),
(37, 13, 'LEXI RACE METAL BLACK', 1, 'PCS', '96081019', '0.00', '0.00', '11.52', '11.52', '6.00', '11.52', '0.00', '0.00', '6.00', 32, '192.00', '215.04', '0.00', '2020-07-30 11:40:30', 5),
(41, 0, 'LEXI DAX RAINBOW', 1, 'PKT', '96081019', '0.00', '0.00', '3.50', '3.50', '6.00', '5.40', '0.00', '0.00', '1.80', 50, '90.00', '98.90', '0.00', '2020-07-30 11:41:52', 9),
(42, 0, 'LEXI DAX SMOOTH BLACK', 1, 'PKT', '96081019', '0.00', '0.00', '2519.42', '2519.42', '6.00', '32.40', '0.00', '0.00', '36.00', 15, '540.00', '3091.82', '0.00', '2020-07-30 11:41:52', 2),
(43, 0, 'LEXI RACE METAL BLACK', 1, 'PCS', '96081019', '0.00', '0.00', '11.52', '11.52', '6.00', '11.52', '0.00', '0.00', '6.00', 32, '192.00', '215.04', '0.00', '2020-07-30 11:41:52', 5),
(44, 0, 'LEXI DAX RAINBOW', 1, 'PKT', '96081019', '0.00', '0.00', '3.50', '3.50', '6.00', '5.40', '0.00', '0.00', '1.80', 50, '90.00', '98.90', '0.00', '2020-07-30 11:42:02', 9),
(45, 0, 'LEXI DAX SMOOTH BLACK', 1, 'PKT', '96081019', '0.00', '0.00', '2519.42', '2519.42', '6.00', '32.40', '0.00', '0.00', '36.00', 15, '540.00', '3091.82', '0.00', '2020-07-30 11:42:02', 2),
(46, 0, 'LEXI RACE METAL BLACK', 1, 'PCS', '96081019', '0.00', '0.00', '11.52', '11.52', '6.00', '11.52', '0.00', '0.00', '6.00', 32, '192.00', '215.04', '0.00', '2020-07-30 11:42:02', 5),
(53, 14, 'LEXI DAX RAINBOW', 1, 'PKT', '96081019', '0.00', '0.00', '3.50', '3.50', '6.00', '5.40', '0.00', '0.00', '1.80', 50, '90.00', '98.90', '0.00', '2020-07-30 11:43:58', 9),
(54, 14, 'LEXI DAX SMOOTH BLACK', 1, 'PKT', '96081019', '0.00', '0.00', '2519.42', '2519.42', '6.00', '32.40', '0.00', '0.00', '36.00', 15, '540.00', '3091.82', '0.00', '2020-07-30 11:43:58', 2),
(55, 14, 'LEXI RACE METAL BLACK', 1, 'PCS', '96081019', '0.00', '0.00', '11.52', '11.52', '6.00', '11.52', '0.00', '0.00', '6.00', 32, '192.00', '215.04', '0.00', '2020-07-30 11:43:58', 5),
(56, 15, 'ONUS STEPLER NO-10', 2, 'PCS', '8472', '0.00', '0.00', '32.00', '32.00', '10.00', '32.00', '20.00', '80.00', '20.00', 20, '400.00', '384.00', '0.00', '2020-07-31 09:52:12', 15),
(57, 15, 'LEXI DAX RAINBOW', 2, 'PCS', '96081019', '0.00', '0.00', '0.32', '0.32', '6.00', '0.32', '0.00', '0.00', '1.80', 3, '5.40', '6.05', '0.00', '2020-07-31 09:52:12', 9),
(58, 15, 'LEXI CLIQ METAL', 2, 'PCS', '96081019', '0.00', '0.00', '1.20', '1.20', '6.00', '1.20', '0.00', '0.00', '6.65', 3, '19.95', '22.34', '0.00', '2020-07-31 09:52:12', 8),
(59, 15, 'LEXI RACE METAL BLUE', 2, 'PCS', '96081019', '0.00', '0.00', '1.08', '1.08', '6.00', '1.08', '0.00', '0.00', '6.00', 3, '18.00', '20.16', '0.00', '2020-07-31 09:52:12', 4),
(60, 15, 'PIK SUPER PERMANENT MARKER 10PC BLUE', 1, 'PKT', '96082000', '0.00', '0.00', '7.48', '7.48', '6.00', '7.48', '0.00', '0.00', '124.65', 1, '124.65', '139.61', '0.00', '2020-07-31 09:52:12', 21),
(61, 15, 'ONUS STEPLER NO-10', 2, 'PCS', '8472', '0.00', '0.00', '1.80', '1.80', '9.00', '1.80', '0.00', '0.00', '20.00', 1, '20.00', '23.60', '0.00', '2020-07-31 09:52:12', 15),
(62, 15, 'LEXI DAX SMOOTH BLACK', 1, 'PKT', '96081019', '0.00', '0.00', '2.16', '2.16', '6.00', '2.16', '0.00', '0.00', '36.00', 1, '36.00', '40.32', '0.00', '2020-07-31 09:52:12', 2),
(63, 15, 'LEXI CLIQ METAL', 2, 'PCS', '96081019', '0.00', '0.00', '0.40', '0.40', '6.00', '0.40', '0.00', '0.00', '6.65', 1, '6.65', '7.45', '0.00', '2020-07-31 09:52:12', 8),
(64, 15, 'MACO RECHARGE PEN', 1, 'PKT', '96081019', '0.00', '0.00', '5.04', '5.04', '6.00', '5.04', '0.00', '0.00', '28.00', 3, '84.00', '94.08', '0.00', '2020-07-31 09:52:12', 13),
(65, 15, 'PIK SKETCH DINOO AST', 2, 'PCS', '96082000', '0.00', '0.00', '0.68', '0.68', '6.00', '0.68', '0.00', '0.00', '11.40', 1, '11.40', '12.77', '0.00', '2020-07-31 09:52:12', 39),
(66, 15, 'LEXI RACE METAL RED', 2, 'PCS', '96081019', '0.00', '0.00', '0.36', '0.36', '6.00', '0.36', '0.00', '0.00', '6.00', 1, '6.00', '6.72', '0.00', '2020-07-31 09:52:12', 6),
(67, 15, 'LEXI DAX SMOOTH BLACK', 1, 'PKT', '96081019', '0.00', '0.00', '2.16', '2.16', '6.00', '2.16', '0.00', '0.00', '36.00', 1, '36.00', '40.32', '0.00', '2020-07-31 09:52:12', 2),
(68, 15, 'LEXI RACE METAL BLACK', 2, 'PCS', '96081019', '0.00', '0.00', '0.36', '0.36', '6.00', '0.36', '0.00', '0.00', '6.00', 1, '6.00', '6.72', '0.00', '2020-07-31 09:52:12', 5),
(69, 15, 'LEXI CLIQ METAL', 2, 'PCS', '96081019', '0.00', '0.00', '0.40', '0.40', '6.00', '0.40', '0.00', '0.00', '6.65', 1, '6.65', '7.45', '0.00', '2020-07-31 09:52:12', 8),
(70, 15, 'LEXI FAST BOY PEN', 2, 'PCS', '96081019', '0.00', '0.00', '0.40', '0.40', '6.00', '0.40', '0.00', '0.00', '6.65', 1, '6.65', '7.45', '0.00', '2020-07-31 09:52:12', 7),
(71, 15, 'LEXI RACE METAL BLACK', 2, 'PCS', '96081019', '0.00', '0.00', '0.36', '0.36', '6.00', '0.36', '0.00', '0.00', '6.00', 1, '6.00', '6.72', '0.00', '2020-07-31 09:52:12', 5),
(72, 15, 'SONI OFFICEMATE WHITE INK PEN', 2, 'PCS', '', '0.00', '0.00', '0.72', '0.72', '6.00', '0.72', '0.00', '0.00', '12.00', 1, '12.00', '13.44', '0.00', '2020-07-31 09:52:12', 40),
(73, 15, 'SONI OFFICEMATE WHITE INK PEN', 2, 'PCS', '', '0.00', '0.00', '0.72', '0.72', '6.00', '0.72', '0.00', '0.00', '12.00', 1, '12.00', '13.44', '0.00', '2020-07-31 09:52:12', 40),
(74, 15, 'A M RUBBER BAND 200 GM PKT 0.5\'\'', 1, 'PKT', '40169920', '0.00', '0.00', '0.00', '0.00', '6.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.00', '2020-07-31 09:52:12', 36),
(75, 15, 'A M RUBBER BAND 100 GM PKT 3\'\'', 1, 'PKT', '40169920', '0.00', '0.00', '0.00', '0.00', '6.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.00', '2020-07-31 09:52:12', 29),
(76, 15, 'A M RUBBER BAND 200GM PKT 3\'\'', 1, 'PKT', '40169920', '0.00', '0.00', '0.00', '0.00', '6.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.00', '2020-07-31 09:52:12', 28),
(77, 15, 'A M RUBBER BAND 10GM PKT 1.5\'\'', 1, 'PKT', '40169920', '0.00', '0.00', '0.00', '0.00', '6.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '0.00', '2020-07-31 09:52:12', 26);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `wherehouse_id` int(11) NOT NULL,
  `stock` bigint(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `product_id`, `wherehouse_id`, `stock`, `created`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`, `last_updated`) VALUES
(1, 9, 1, 4102, '2020-07-20 20:04:13', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 14, 1, 500, '2020-07-20 20:05:09', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 13, 1, 367, '2020-07-20 20:06:28', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 38, 1, 2, '2020-07-20 20:07:16', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 8, 1, 265, '2020-07-20 20:07:46', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 17, 1, 80, '2020-07-20 20:08:28', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 7, 1, 124, '2020-07-20 20:08:52', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 19, 1, 100, '2020-07-20 20:09:34', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 39, 1, 49, '2020-07-20 20:10:09', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 20, 1, 160, '2020-07-20 20:11:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 22, 1, 160, '2020-07-20 20:11:34', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 21, 1, 59, '2020-07-20 20:11:58', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 11, 1, 10, '2020-07-20 20:12:26', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 18, 1, 10, '2020-07-20 20:12:52', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 15, 1, 29, '2020-07-20 20:14:23', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 16, 1, 7, '2020-07-20 20:14:00', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 4, 1, 282, '2020-07-20 20:15:48', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 5, 1, 459, '2020-07-20 20:16:08', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 6, 1, 399, '2020-07-20 20:16:26', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 3, 1, 200, '2020-07-20 20:17:24', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 2, 1, 139, '2020-07-20 20:17:44', 1, 1, 1, '2020-07-20 20:20:28', '0000-00-00 00:00:00'),
(22, 1, 1, 535, '2020-07-20 20:19:50', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 40, 1, 48, '2020-07-20 20:24:15', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_histories`
--

CREATE TABLE `stock_histories` (
  `history_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `stock_in` int(11) NOT NULL DEFAULT '0',
  `stock_out` int(11) NOT NULL DEFAULT '0',
  `opening_stock` int(11) NOT NULL DEFAULT '0',
  `closing_stock` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `purchase_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_histories`
--

INSERT INTO `stock_histories` (`history_id`, `stock_id`, `stock_in`, `stock_out`, `opening_stock`, `closing_stock`, `description`, `purchase_id`, `sale_id`, `created`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`, `last_updated`) VALUES
(1, 1, 4000, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:04:13', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 500, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:05:09', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 370, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:06:28', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 2, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:07:16', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 220, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:07:46', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 6, 80, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:08:28', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 7, 125, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:08:52', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 8, 100, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:09:34', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 9, 50, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:10:09', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 10, 160, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:11:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 11, 160, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:11:35', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 12, 60, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:11:58', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 13, 10, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:12:26', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 14, 10, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:12:52', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 15, 50, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:13:25', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 16, 7, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:14:00', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 17, 300, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:15:48', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 18, 400, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:16:08', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 19, 400, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:16:26', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 20, 200, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:17:25', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 21, 110, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:17:44', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 22, 535, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:19:50', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 23, 50, 0, 0, 0, 'Add Stock', NULL, NULL, '2020-07-20 20:24:15', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 17, 0, 5, 0, 0, 'Sale item', NULL, NULL, '2020-07-24 20:19:39', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 5, 10, 0, 0, 0, 'Purchase item', NULL, NULL, '2020-07-29 12:26:46', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 5, 0, 5, 0, 0, 'Sale item', NULL, NULL, '2020-07-29 12:28:31', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 22, 5, 0, 0, 0, 'Purchase item', NULL, NULL, '2020-07-29 13:45:21', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 22, 3, 0, 0, 0, 'Update purchase item 3', NULL, NULL, '2020-07-29 13:46:35', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 22, 0, 2, 0, 0, 'Update purchase item 2', NULL, NULL, '2020-07-29 13:50:45', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 22, 4, 0, 0, 0, 'Update purchase item 4', NULL, NULL, '2020-07-29 14:09:31', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 22, 0, 4, 0, 0, 'Update purchase item 4', NULL, NULL, '2020-07-29 14:10:37', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 21, 0, 25, 0, 0, 'Update sale item 25', NULL, 1, '2020-07-30 11:27:39', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 1, 50, 0, 0, 0, 'Update sale item 50', NULL, 1, '2020-07-30 11:28:15', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 21, 15, 0, 0, 0, 'Update sale item 15', NULL, 1, '2020-07-30 11:28:15', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 18, 32, 0, 0, 0, 'Update sale item 32', NULL, 1, '2020-07-30 11:28:15', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 21, 25, 0, 0, 0, 'Update sale item 25', NULL, 1, '2020-07-30 11:30:06', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, 10, 0, 0, 0, 'Update sale item 10', NULL, 1, '2020-07-30 11:32:09', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 1, 0, 10, 0, 0, 'Update sale item 10', NULL, 1, '2020-07-30 11:33:23', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 1, 0, 50, 0, 0, 'Sale item', NULL, 12, '2020-07-30 11:39:09', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 21, 0, 15, 0, 0, 'Sale item', NULL, 12, '2020-07-30 11:39:09', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 18, 0, 32, 0, 0, 'Sale item', NULL, 12, '2020-07-30 11:39:09', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, 0, 50, 0, 0, 'Sale item', NULL, 13, '2020-07-30 11:40:30', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 21, 0, 15, 0, 0, 'Sale item', NULL, 13, '2020-07-30 11:40:30', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 18, 0, 32, 0, 0, 'Sale item', NULL, 13, '2020-07-30 11:40:30', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 1, 0, 50, 0, 0, 'Sale item', NULL, 14, '2020-07-30 11:40:44', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 21, 0, 15, 0, 0, 'Sale item', NULL, 14, '2020-07-30 11:40:44', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 18, 0, 32, 0, 0, 'Sale item', NULL, 14, '2020-07-30 11:40:44', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 1, 0, 50, 0, 0, 'Update sale item 50', NULL, NULL, '2020-07-30 11:41:52', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 21, 0, 15, 0, 0, 'Update sale item 15', NULL, NULL, '2020-07-30 11:41:52', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 18, 0, 32, 0, 0, 'Update sale item 32', NULL, NULL, '2020-07-30 11:41:52', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 1, 0, 50, 0, 0, 'Update sale item 50', NULL, NULL, '2020-07-30 11:42:02', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 21, 0, 15, 0, 0, 'Update sale item 15', NULL, NULL, '2020-07-30 11:42:02', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 18, 0, 32, 0, 0, 'Update sale item 32', NULL, NULL, '2020-07-30 11:42:03', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 22, 0, 6, 0, 0, 'Delete purchases item 6', 4, NULL, '2020-07-30 12:42:20', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 5, 0, 1, 0, 0, 'Delete purchases item 1', 3, NULL, '2020-07-30 12:42:25', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 5, 10, 0, 0, 0, 'Purchase item', 5, NULL, '2020-07-30 12:45:11', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 15, 0, 21, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 1, 0, 3, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 5, 0, 5, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 17, 0, 3, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 12, 0, 1, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 21, 0, 2, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 3, 0, 3, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 9, 0, 1, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 19, 0, 1, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 18, 0, 2, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 7, 0, 1, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 23, 0, 2, 0, 0, 'Sale item', NULL, 15, '2020-07-31 09:52:12', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_orgnisation_name` varchar(255) NOT NULL,
  `supplier_orgnisation_phone` varchar(255) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_tax_number` varchar(255) NOT NULL,
  `gstin` varchar(255) NOT NULL,
  `supplier_mobile` varchar(255) NOT NULL,
  `supplier_address_s` varchar(255) NOT NULL,
  `supplier_city_s` varchar(255) NOT NULL,
  `supplier_state_s` varchar(255) NOT NULL,
  `supplier_country_s` varchar(255) NOT NULL,
  `supplier_zip_s` varchar(255) NOT NULL,
  `supplier_address_b` varchar(255) NOT NULL,
  `supplier_city_b` varchar(255) NOT NULL,
  `supplier_state_b` varchar(255) NOT NULL,
  `supplier_country_b` varchar(255) NOT NULL,
  `supplier_zip_b` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_orgnisation_name`, `supplier_orgnisation_phone`, `supplier_name`, `supplier_email`, `supplier_tax_number`, `gstin`, `supplier_mobile`, `supplier_address_s`, `supplier_city_s`, `supplier_state_s`, `supplier_country_s`, `supplier_zip_s`, `supplier_address_b`, `supplier_city_b`, `supplier_state_b`, `supplier_country_b`, `supplier_zip_b`, `created_by`, `created`, `last_updated`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'SS TREDLINK', '6377098903', 'sanjay ji', '', '', '08ABFPJ0675E1ZU', '', 'ambawadi', 'jaipur', 'rajasthan', 'jaipur', '', 'ambawadi', 'jaipur', 'rajasthan', 'jaipur', '', 1, '2020-07-24 19:21:07', '2020-07-29 06:05:38', 0, 0, '0000-00-00 00:00:00'),
(2, 'test', '', '', '', '', '', '', 'test', 'jaipur', 'rajasthan', 'jaipur', '', 'test', 'jaipur', 'rajasthan', 'jaipur', '', 1, '2020-07-29 11:39:11', '2020-07-29 06:09:20', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax_percentage` decimal(10,2) NOT NULL,
  `taxe_groups` text NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_grouped` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wherehouses`
--

CREATE TABLE `wherehouses` (
  `wherehouse_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `wherehouse_name` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wherehouses`
--

INSERT INTO `wherehouses` (`wherehouse_id`, `branch_id`, `wherehouse_name`, `is_default`, `created`, `created_by`, `is_deleted`, `deleted_by`, `deleted_on`, `last_updated`, `is_disabled`) VALUES
(1, 1, 'AM ENTERPRISES', 0, '2020-07-20 20:02:05', 1, 0, 0, '0000-00-00 00:00:00', '2020-07-20 20:02:05', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_group_to_group`
--
ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_group`
--
ALTER TABLE `aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `account_categories`
--
ALTER TABLE `account_categories`
  ADD PRIMARY KEY (`account_category_id`);

--
-- Indexes for table `account_groups`
--
ALTER TABLE `account_groups`
  ADD PRIMARY KEY (`account_group_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cash_flows`
--
ALTER TABLE `cash_flows`
  ADD PRIMARY KEY (`cash_flow_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD PRIMARY KEY (`company_profile_id`),
  ADD KEY `parent` (`company_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `leadgers`
--
ALTER TABLE `leadgers`
  ADD PRIMARY KEY (`leadger_id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `barcode_no` (`sku`);

--
-- Indexes for table `product_histories`
--
ALTER TABLE `product_histories`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `barcode_no` (`sku`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`purchase_item_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`sale_item_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stock_histories`
--
ALTER TABLE `stock_histories`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `wherehouses`
--
ALTER TABLE `wherehouses`
  ADD PRIMARY KEY (`wherehouse_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account_categories`
--
ALTER TABLE `account_categories`
  MODIFY `account_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_groups`
--
ALTER TABLE `account_groups`
  MODIFY `account_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cash_flows`
--
ALTER TABLE `cash_flows`
  MODIFY `cash_flow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_profiles`
--
ALTER TABLE `company_profiles`
  MODIFY `company_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leadgers`
--
ALTER TABLE `leadgers`
  MODIFY `leadger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_histories`
--
ALTER TABLE `product_histories`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `purchase_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `stock_histories`
--
ALTER TABLE `stock_histories`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wherehouses`
--
ALTER TABLE `wherehouses`
  MODIFY `wherehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
