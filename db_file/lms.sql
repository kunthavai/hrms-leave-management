-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 11:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HR', 'hr', 1, '2026-06-10 02:38:50', '2026-06-10 02:38:50', NULL),
(2, 'Account', 'account', 1, '2026-06-10 02:38:50', '2026-06-10 02:38:50', NULL),
(3, 'Admin', 'admin', 1, '2026-06-10 02:38:50', '2026-06-10 02:38:50', NULL),
(4, 'Data Research', 'data-research', 1, '2026-06-10 02:38:50', '2026-06-10 02:38:50', NULL),
(5, 'GRC', 'grc', 1, '2026-06-10 02:38:50', '2026-06-10 02:38:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `joining_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_code`, `name`, `email`, `phone`, `department_id`, `user_id`, `joining_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'EMP001', 'Kunthavai', 'admin@example.com', '9876543210', 1, 10, '2026-06-02', 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(2, 'EMP002', 'bhabha', 'user@example.com', '9876543211', 1, 11, '2026-06-02', 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(3, 'EMP003', 'TestUser', 'testuser@example.com', '9876543212', 2, 12, '2026-06-02', 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(4, 'KA003', 'Kabilan', 'kaniyan@gmail.com', '7358466214', 1, 14, '2026-01-12', 0, '2026-06-11 03:21:14', '2026-06-11 05:34:57', NULL),
(5, 'EMP006', 'Kabilan', 'kabi.pk@gmail.com', '8987654329', 1, 15, '2020-10-17', 0, '2026-06-17 01:46:57', '2026-06-17 02:01:05', NULL),
(6, 'EMP007', 'kani', 'kani@gmail.com', '7678987658', 1, 16, '2016-10-11', 1, '2026-06-17 02:03:13', '2026-06-17 02:03:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type_id` bigint(20) UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` decimal(5,2) NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected','cancelled') NOT NULL DEFAULT 'pending',
  `admin_remark` text DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_type_id`, `from_date`, `to_date`, `total_days`, `reason`, `status`, `admin_remark`, `approved_by`, `approved_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 10, 3, '2026-06-03', '2026-06-03', 1.00, 'test leave', 'approved', NULL, 10, '2026-06-15 04:56:15', NULL, '2026-06-11 22:58:00', '2026-06-15 04:56:15'),
(2, 10, 3, '2026-06-05', '2026-06-08', 4.00, 'testone', 'approved', NULL, 10, '2026-06-15 04:56:15', NULL, '2026-06-11 22:59:00', '2026-06-15 04:56:15'),
(3, 10, 2, '2026-06-12', '2026-06-12', 1.00, 'reason', 'approved', NULL, 10, '2026-06-15 05:29:01', NULL, '2026-06-15 05:09:02', '2026-06-15 05:29:01'),
(4, 10, 1, '2026-06-02', '2026-06-02', 1.00, 'test', 'rejected', 'test rejected', 10, '2026-06-15 05:31:48', NULL, '2026-06-15 05:30:10', '2026-06-15 05:31:48'),
(5, 11, 1, '2026-06-03', '2026-06-04', 2.00, 'test leaeb', 'approved', NULL, 10, '2026-06-17 01:32:20', NULL, '2026-06-17 00:37:22', '2026-06-17 01:32:20'),
(6, 11, 1, '2026-06-05', '2026-06-05', 1.00, 'ggh', 'cancelled', NULL, NULL, NULL, NULL, '2026-06-17 00:38:31', '2026-06-17 01:21:33'),
(7, 11, 1, '2026-06-05', '2026-06-05', 1.00, 'aSas', 'rejected', 'test reject', 10, '2026-06-17 01:33:00', NULL, '2026-06-17 01:22:27', '2026-06-17 01:33:00'),
(8, 16, 1, '2026-06-04', '2026-06-04', 1.00, 'test reason', 'pending', NULL, NULL, NULL, NULL, '2026-06-17 03:09:53', '2026-06-17 03:09:53'),
(9, 11, 1, '2026-06-11', '2026-06-12', 2.00, 'reason', 'pending', NULL, NULL, NULL, NULL, '2026-06-17 03:24:29', '2026-06-17 03:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `leave_balances`
--

CREATE TABLE `leave_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type_id` bigint(20) UNSIGNED NOT NULL,
  `allocated_days` decimal(5,2) NOT NULL DEFAULT 0.00,
  `availed_days` decimal(5,2) NOT NULL DEFAULT 0.00,
  `balance_days` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_balances`
--

INSERT INTO `leave_balances` (`id`, `user_id`, `leave_type_id`, `allocated_days`, `availed_days`, `balance_days`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 1, 12.00, 0.00, 12.00, 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(2, 10, 2, 6.00, 1.00, 5.00, 1, '2026-06-11 01:01:48', '2026-06-15 05:29:01', NULL),
(3, 10, 3, 12.00, 5.00, 7.00, 1, '2026-06-11 01:01:48', '2026-06-15 04:56:15', NULL),
(4, 11, 1, 12.00, 2.00, 10.00, 1, '2026-06-11 01:01:48', '2026-06-17 01:32:20', NULL),
(5, 11, 2, 6.00, 0.00, 6.00, 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(6, 11, 3, 12.00, 0.00, 12.00, 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(7, 12, 1, 12.00, 0.00, 12.00, 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(8, 12, 2, 6.00, 0.00, 6.00, 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(9, 12, 3, 12.00, 0.00, 12.00, 1, '2026-06-11 01:01:48', '2026-06-11 01:01:48', NULL),
(10, 14, 1, 12.00, 0.00, 12.00, 1, '2026-06-11 03:21:14', '2026-06-11 03:21:14', NULL),
(11, 14, 2, 6.00, 0.00, 6.00, 1, '2026-06-11 03:21:14', '2026-06-11 03:21:14', NULL),
(12, 14, 3, 12.00, 0.00, 12.00, 1, '2026-06-11 03:21:14', '2026-06-11 03:21:14', NULL),
(13, 15, 1, 12.00, 0.00, 12.00, 1, '2026-06-17 01:46:57', '2026-06-17 01:46:57', NULL),
(14, 15, 2, 6.00, 0.00, 6.00, 1, '2026-06-17 01:46:57', '2026-06-17 01:46:57', NULL),
(15, 15, 3, 12.00, 0.00, 12.00, 1, '2026-06-17 01:46:57', '2026-06-17 01:46:57', NULL),
(16, 16, 1, 12.00, 0.00, 12.00, 1, '2026-06-17 02:03:13', '2026-06-17 02:03:13', NULL),
(17, 16, 2, 6.00, 0.00, 6.00, 1, '2026-06-17 02:03:13', '2026-06-17 02:03:13', NULL),
(18, 16, 3, 12.00, 0.00, 12.00, 1, '2026-06-17 02:03:13', '2026-06-17 02:03:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(20) NOT NULL,
  `default_days` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `code`, `default_days`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Casual Leave', 'CL', 12, 1, NULL, '2026-06-11 00:36:23', '2026-06-11 00:36:23'),
(2, 'Sick Leave', 'SL', 6, 1, NULL, '2026-06-11 00:36:23', '2026-06-11 00:36:23'),
(3, 'Paid Leave', 'PAL', 12, 1, NULL, '2026-06-11 00:36:23', '2026-06-11 00:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_route` varchar(255) DEFAULT NULL,
  `show_in_sidebar` tinyint(1) NOT NULL DEFAULT 1,
  `menu_icon` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `menu_route`, `show_in_sidebar`, `menu_icon`, `parent_id`, `menu_order`, `status`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Leave Statistics', 'leaveStatistics', 1, 'bi-speedometer2', NULL, 1, 1, '2026-06-16 05:07:47', '2026-06-16 05:07:47', 'leave-statistics'),
(2, 'Employee Management', NULL, 1, 'bi-people', NULL, 2, 1, '2026-06-16 05:07:47', '2026-06-16 05:07:47', 'employee-management'),
(3, 'Employee List', 'employees', 1, NULL, 2, 1, 1, '2026-06-16 05:07:47', '2026-06-16 05:07:47', 'employee-list'),
(4, 'Add Employee', 'employees.create', 0, NULL, 2, 2, 1, '2026-06-16 05:07:47', '2026-06-16 05:07:47', 'add-employee'),
(5, 'Get Employee', 'employees.getDetails', 0, NULL, 2, 3, 1, '2026-06-16 05:07:47', '2026-06-16 05:07:47', 'get-employee'),
(6, 'Delete Employee', 'employees.delete', 0, NULL, 2, 4, 1, '2026-06-16 05:07:47', '2026-06-16 05:07:47', 'delete-employee'),
(7, 'Leave Management', NULL, 1, 'bi-calendar-check', NULL, 3, 1, '2026-06-16 05:07:47', '2026-06-16 05:07:47', 'leave-management'),
(8, 'Leave Details', 'leaves', 1, NULL, 7, 1, 1, '2026-06-16 05:07:47', '2026-06-16 05:07:47', 'leave-details'),
(9, 'Approval Leave Details', 'pendingLeaves', 1, NULL, 7, 2, 1, '2026-06-16 05:07:48', '2026-06-16 05:07:48', 'approval-leave-details'),
(10, 'LeaveBulkApprove', 'leaveBulkApprove', 0, NULL, 7, 3, 1, '2026-06-16 05:07:48', '2026-06-16 05:07:48', 'leavebulkapprove'),
(11, 'Leave Reject', 'leaveBulkReject', 0, NULL, 7, 4, 1, '2026-06-16 05:07:48', '2026-06-16 05:07:48', 'leave-reject'),
(12, 'Apply Leave', 'applyLeave', 0, NULL, 7, 5, 1, '2026-06-16 05:07:48', '2026-06-16 05:07:48', 'apply-leave'),
(13, 'Get Leave', 'leaves.getDetails', 0, NULL, 7, 6, 1, '2026-06-16 05:07:48', '2026-06-16 05:07:48', 'get-leave'),
(14, 'Delete Leave', 'leaves.delete', 0, NULL, 7, 7, 1, '2026-06-16 05:07:48', '2026-06-16 05:07:48', 'delete-leave');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2026_06_10_065133_add_status_to_users_table', 2),
(6, '2026_06_10_070335_add_status_to_users_table', 2),
(7, '2026_06_10_075555_create_departments_table', 3),
(8, '2026_06_10_080600_add_slug_to_departments_table', 4),
(9, '2026_06_10_082020_create_employees_table', 5),
(10, '2026_06_10_090035_create_roles_table', 5),
(11, '2026_06_10_090954_add_role_id_to_users_table', 5),
(12, '2026_06_11_041554_create_leave_types_table', 6),
(13, '2026_06_11_041915_create_leaves_table', 6),
(14, '2026_06_11_044744_create_leave_balances_table', 6),
(15, '2026_06_16_065416_create_role_user_table', 7),
(16, '2026_06_16_071016_remove_role_id_from_users_table', 7),
(17, '2026_06_16_074624_create_menus_table', 8),
(18, '2026_06_16_075122_create_role_menu_table', 8),
(19, '2026_06_16_102640_add_show_in_sidebar_in_menus_table', 9),
(20, '2026_06_16_103710_add_slug_in_menus_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 1, '2026-06-10 06:10:08', '2026-06-10 06:10:08'),
(2, 'Employee', 'employee', 1, '2026-06-10 06:10:09', '2026-06-10 06:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(2, 1, 2, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(3, 1, 7, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(4, 1, 3, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(5, 1, 4, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(6, 1, 5, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(7, 1, 6, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(8, 1, 8, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(9, 1, 9, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(10, 1, 10, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(11, 1, 11, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(12, 1, 12, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(13, 1, 13, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(14, 1, 14, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(15, 2, 8, '2026-06-16 05:13:36', '2026-06-16 05:13:36', 1),
(18, 2, 7, '2026-06-16 10:51:40', NULL, 1),
(19, 2, 12, '2026-06-17 08:38:49', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(5, 10, 1, NULL, NULL),
(6, 10, 2, NULL, NULL),
(7, 11, 2, NULL, NULL),
(8, 12, 2, NULL, NULL),
(9, 14, 2, NULL, NULL),
(10, 16, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4XTUgTVezWzUjqgu8M2TsQfEZLACElk1kAYeIQ7J', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYzZSOFhJTjc4SGNERjNCMWFoR2FwM1ZUenJNSzlpVzgyZDYxRUNjTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lbXBsb3llZXMiO3M6NToicm91dGUiO3M6OToiZW1wbG95ZWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1781687010),
('goX9WyDj1iJvO0PNcFxEbVodjqjdfVwIJVnQtY6Q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRENseFlVdGVUMUlGSmhiZHJnd2h5U3E2YkhXVDY5ODRkRkRITDZKdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781675743);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(10, 'Kunthavai', 'admin@example.com', NULL, '$2y$12$L7Qjy3r9urVs8UbBjsktj.cPt.vj/5/B763cxLM1NLYK06TZ/JAWu', NULL, '2026-06-11 01:01:48', '2026-06-11 01:01:48', 1),
(11, 'bhabha', 'user@example.com', NULL, '$2y$12$1AAn/QKnGw9htU.6kb6igOrubpGKkbtMKMvWWt4mDwfW35vqZaLwC', NULL, '2026-06-11 01:01:48', '2026-06-11 01:01:48', 1),
(12, 'TestUser', 'testuser@example.com', NULL, '$2y$12$B1BSM4zsXFmYwIfj/RAZw.0ECdbGfdW11bYLn1yx6UNiWgIAV/S/C', NULL, '2026-06-11 01:01:48', '2026-06-11 01:01:48', 1),
(14, 'Kabilan', 'kaniyan@gmail.com', NULL, '$2y$12$R1Vg4.vR143Xh89lVfUVx.wqHZK1b6yIlhqyuHXlsu/xYvQd9nODm', NULL, '2026-06-11 03:21:14', '2026-06-11 05:34:57', 0),
(15, 'Kabilan', 'kabi.pk@gmail.com', NULL, '$2y$12$ifzpwhwLzz73nKlJsfxfRO/o4Os5G6NWqWB8HdAnrpk6lOesnNE32', NULL, '2026-06-17 01:46:57', '2026-06-17 02:01:05', 0),
(16, 'kani', 'kani@gmail.com', NULL, '$2y$12$IWBumLSRbJcQxdHIcQKOBuc6Ec.jOT6xalIOKTvmDUx6v49C3kD76', NULL, '2026-06-17 02:03:13', '2026-06-17 02:03:13', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_slug_unique` (`slug`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_employee_code_unique` (`employee_code`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_user_id_foreign` (`user_id`),
  ADD KEY `leaves_leave_type_id_foreign` (`leave_type_id`),
  ADD KEY `leaves_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leave_balances_user_id_leave_type_id_unique` (`user_id`,`leave_type_id`),
  ADD KEY `leave_balances_leave_type_id_foreign` (`leave_type_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leave_types_code_unique` (`code`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_slug_unique` (`slug`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_menu_role_id_menu_id_unique` (`role_id`,`menu_id`),
  ADD KEY `role_menu_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `leave_balances`
--
ALTER TABLE `leave_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `leaves_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD CONSTRAINT `leave_balances_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`),
  ADD CONSTRAINT `leave_balances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD CONSTRAINT `role_menu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_menu_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
