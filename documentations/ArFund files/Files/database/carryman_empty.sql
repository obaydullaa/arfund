-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2024 at 01:48 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `switch_courier`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admins', 'admin@site.com', 'admin', NULL, '6646d3b209cfc1715917746.jpg', '$2y$12$MfIoh.z9TpW4CKKoob8rNObzgw.NAh/TCDERn6J1XeIDGmUKc6l2O', NULL, NULL, '2024-05-17 02:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT '0',
  `staff_id` int UNSIGNED NOT NULL DEFAULT '0',
  `manager_id` int DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `user_id`, `staff_id`, `manager_id`, `title`, `is_read`, `click_url`, `created_at`, `updated_at`) VALUES
(236, 0, 36, 0, 'New member registered', 1, '/admin/users/detail/36', '2024-05-09 05:24:12', '2024-05-21 08:21:31'),
(237, 0, 34, 0, 'Deposit request from testuser', 1, '/admin/deposit/details/34', '2024-05-10 10:09:58', '2024-05-21 08:21:31'),
(238, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-10 10:10:03', '2024-05-21 08:21:31'),
(239, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-10 10:16:57', '2024-05-21 08:21:31'),
(240, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-10 10:26:36', '2024-05-21 08:21:31'),
(241, 0, 34, 0, 'New withdraw request from testuser', 1, '/admin/withdraw/details/4', '2024-05-10 10:27:13', '2024-05-21 08:21:31'),
(242, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-10 10:27:14', '2024-05-21 08:21:31'),
(243, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-10 10:37:37', '2024-05-21 08:21:31'),
(244, 0, 37, 0, 'New member registered', 1, '/admin/users/detail/37', '2024-05-19 10:28:26', '2024-05-21 08:21:31'),
(245, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-19 10:29:00', '2024-05-21 08:21:31'),
(246, 0, 37, 0, 'New support ticket has opened', 1, '/admin/ticket/view/3', '2024-05-19 10:30:25', '2024-05-21 08:21:31'),
(247, 0, 37, 0, 'New support ticket has opened', 1, '/admin/ticket/view/4', '2024-05-19 10:48:33', '2024-05-21 08:21:31'),
(248, 0, 37, 0, 'New support ticket has opened', 1, '/admin/ticket/view/6', '2024-05-20 05:06:25', '2024-05-21 08:21:31'),
(249, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/8', '2024-05-20 05:19:50', '2024-05-21 08:21:31'),
(250, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/9', '2024-05-20 05:26:15', '2024-05-21 08:21:31'),
(251, 0, 37, 0, 'New support ticket has opened', 1, '/admin/ticket/view/10', '2024-05-20 05:42:23', '2024-05-21 08:21:31'),
(252, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/11', '2024-05-20 05:49:51', '2024-05-21 08:21:31'),
(253, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/12', '2024-05-20 06:32:17', '2024-05-21 08:21:31'),
(254, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/13', '2024-05-20 07:14:40', '2024-05-21 08:21:31'),
(255, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/14', '2024-05-20 07:16:50', '2024-05-21 08:21:31'),
(256, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/15', '2024-05-20 07:18:09', '2024-05-21 08:21:31'),
(257, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/16', '2024-05-20 07:42:57', '2024-05-21 08:21:31'),
(258, 0, 0, 17, 'New support ticket has opened', 1, '/admin/ticket/view/17', '2024-05-20 08:00:17', '2024-05-21 08:21:31'),
(259, 0, 0, 17, 'New support ticket has opened', 1, '/admin/ticket/view/18', '2024-05-20 08:04:11', '2024-05-21 08:21:31'),
(260, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/19', '2024-05-20 08:35:10', '2024-05-21 08:21:31'),
(261, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/20', '2024-05-20 08:40:29', '2024-05-21 08:21:31'),
(262, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/21', '2024-05-20 09:12:59', '2024-05-21 08:21:31'),
(263, 0, 22, 0, 'New support ticket has opened', 1, '/admin/ticket/view/23', '2024-05-20 09:35:21', '2024-05-21 08:21:31'),
(264, 0, 22, 0, 'New support ticket has opened', 1, '/admin/ticket/view/24', '2024-05-20 09:37:22', '2024-05-21 08:21:31'),
(265, 0, 22, 0, 'New support ticket has opened', 1, '/admin/ticket/view/25', '2024-05-20 09:48:23', '2024-05-21 08:21:31'),
(266, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/26', '2024-05-20 10:33:25', '2024-05-21 08:21:31'),
(267, 0, 22, 0, 'New support ticket has opened', 1, '/admin/ticket/view/27', '2024-05-20 10:43:37', '2024-05-21 08:21:31'),
(268, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/28', '2024-05-20 10:54:27', '2024-05-21 08:21:31'),
(269, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/29', '2024-05-20 10:54:41', '2024-05-21 08:21:31'),
(270, 0, 0, 11, 'New support ticket has opened', 1, '/admin/ticket/view/30', '2024-05-20 10:55:00', '2024-05-21 05:45:03'),
(271, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/31', '2024-05-21 05:40:40', '2024-05-21 08:21:31'),
(272, 0, 22, 0, 'New support ticket has opened', 1, '/admin/ticket/view/32', '2024-05-21 05:42:31', '2024-05-21 05:44:59'),
(273, 0, 22, 0, 'New support ticket has opened', 1, '/admin/ticket/view/33', '2024-05-21 05:45:23', '2024-05-21 05:45:28'),
(274, 0, 0, 21, 'New support ticket has opened', 1, '/admin/ticket/view/34', '2024-05-21 09:14:52', '2024-05-21 09:14:58'),
(275, 0, 0, 22, 'New support ticket has opened', 1, '/admin/ticket/view/35', '2024-05-23 05:39:45', '2024-05-23 05:40:14'),
(276, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-23 11:16:53', '2024-05-23 11:17:41'),
(277, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-23 11:16:54', '2024-05-23 11:17:25'),
(278, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 11:50:26', '2024-05-23 11:50:26'),
(279, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 11:50:27', '2024-05-23 11:50:27'),
(280, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 12:25:15', '2024-05-23 12:25:15'),
(281, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 12:25:16', '2024-05-23 12:25:16'),
(282, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 12:38:17', '2024-05-23 12:38:17'),
(283, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 12:38:19', '2024-05-23 12:38:19'),
(284, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 12:56:45', '2024-05-23 12:56:45'),
(285, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 12:56:46', '2024-05-23 12:56:46'),
(286, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 13:48:05', '2024-05-23 13:48:05'),
(287, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 13:48:06', '2024-05-23 13:48:06'),
(288, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 13:49:35', '2024-05-23 13:49:35'),
(289, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 13:49:36', '2024-05-23 13:49:36'),
(290, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 13:57:28', '2024-05-23 13:57:28'),
(291, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 13:57:30', '2024-05-23 13:57:30'),
(292, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 14:05:22', '2024-05-23 14:05:22'),
(293, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 14:05:23', '2024-05-23 14:05:23'),
(294, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 14:11:26', '2024-05-23 14:11:26'),
(295, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 14:11:27', '2024-05-23 14:11:27'),
(296, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 14:15:08', '2024-05-23 14:15:08'),
(297, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 14:15:09', '2024-05-23 14:15:09'),
(298, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 14:16:57', '2024-05-23 14:16:57'),
(299, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-23 14:16:59', '2024-05-23 14:16:59'),
(300, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-25 07:24:39', '2024-05-25 07:24:39'),
(301, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-25 07:24:40', '2024-05-25 07:24:40'),
(302, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-26 10:03:43', '2024-05-26 10:03:43'),
(303, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-26 10:03:44', '2024-05-26 10:03:44'),
(304, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-26 10:35:17', '2024-05-26 10:35:17'),
(305, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-26 10:35:18', '2024-05-26 10:35:18'),
(306, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-26 11:08:24', '2024-05-26 11:08:24'),
(307, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-26 11:08:25', '2024-05-26 11:08:25'),
(308, 0, 24, 0, 'New support ticket has opened', 1, '/admin/ticket/view/36', '2024-05-26 11:09:24', '2024-05-28 09:23:20'),
(309, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 0, '#', '2024-05-28 08:33:31', '2024-05-28 08:33:31'),
(310, 0, 0, 0, 'SMS Error: [HTTP 401] Unable to create record: Authentication Error - invalid username', 1, '#', '2024-05-28 08:33:32', '2024-05-28 09:23:11'),
(311, 0, 0, 23, 'New support ticket has opened', 0, '/admin/ticket/view/37', '2024-05-28 12:27:38', '2024-05-28 12:27:38'),
(312, 0, 26, 0, 'New support ticket has opened', 0, '/admin/ticket/view/38', '2024-05-28 12:31:25', '2024-05-28 12:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `address` text,
  `email` text,
  `mobile` text,
  `status` tinyint DEFAULT NULL COMMENT '0 => disabled,\r\n1 => Enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` bigint NOT NULL,
  `sender_id` int DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `sender_branch_id` int DEFAULT NULL,
  `receiver_branch_id` int DEFAULT NULL,
  `sender_staff_id` bigint DEFAULT NULL,
  `receiver_staff_id` bigint DEFAULT NULL,
  `invoice_number` text,
  `tracking_number` text,
  `payment_status` tinyint DEFAULT NULL COMMENT 'Unpaid => 0,\r\nPaid => 1',
  `payment_received_by` bigint DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `discount` decimal(28,2) DEFAULT NULL,
  `total_amount` decimal(28,2) DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT 'Sent in Queue => 0,\r\nDispatch(Shipping) => 1,\r\nReceived(Delivery in Queue) => 2,\r\nDelivered => 3\r\n\r\n\r\n\r\n',
  `estimate_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` text,
  `mobile` text,
  `city` varchar(40) DEFAULT NULL,
  `zip` bigint DEFAULT NULL,
  `state` varchar(40) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `act`, `form_data`, `created_at`, `updated_at`) VALUES
(2, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number_22\":{\"name\":\"NID Number 22\",\"label\":\"nid_number_22\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"textarea\"},\"sadfg\":{\"name\":\"sadfg\",\"label\":\"sadfg\",\"is_required\":\"optional\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"asdf\":{\"name\":\"asdf\",\"label\":\"asdf\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"Test2\",\"Test3\"],\"type\":\"select\"},\"nid_number_226985\":{\"name\":\"NID Number 226985\",\"label\":\"nid_number_226985\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"Test 2\",\"Test 3\"],\"type\":\"checkbox\"},\"nid_number_3333\":{\"name\":\"NID Number 3333\",\"label\":\"nid_number_3333\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"asdf\"],\"type\":\"radio\"},\"nid_number_3333587\":{\"name\":\"NID Number 3333587\",\"label\":\"nid_number_3333587\",\"is_required\":\"optional\",\"extensions\":\"jpg,bmp,png,pdf\",\"options\":[],\"type\":\"file\"}}', '2022-03-16 01:09:49', '2022-03-17 00:02:54'),
(3, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number_226985\":{\"name\":\"NID Number 226985\",\"label\":\"nid_number_226985\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-16 04:32:29', '2022-03-16 04:35:32'),
(5, 'withdraw_method', '{\"nid_number_33\":{\"name\":\"NID Number 33\",\"label\":\"nid_number_33\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-17 00:45:35', '2022-03-17 00:53:17'),
(6, 'withdraw_method', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-17 00:47:04', '2022-03-17 00:47:04'),
(7, 'kyc', '{\"email\":{\"name\":\"Email\",\"label\":\"email\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"email\",\"placeholder\":\"Email Check Placeholder\"},\"fullname\":{\"name\":\"Fullname\",\"label\":\"fullname\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\",\"placeholder\":\"Enter fullname\"},\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"number\",\"placeholder\":\"Enter NID number\"},\"gender\":{\"name\":\"Gender\",\"label\":\"gender\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Male\",\"Female\",\"Others\"],\"type\":\"radio\",\"placeholder\":null},\"your_hobby\":{\"name\":\"Your Hobby\",\"label\":\"your_hobby\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Programming\",\"Gaming\",\"Traveling\",\"Bloging\",\"Gardening\",\"Others\"],\"type\":\"checkbox\",\"placeholder\":\"Choose your hobby set\"},\"attachment_filed\":{\"name\":\"Attachment Filed\",\"label\":\"attachment_filed\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg,png,docx,xlsx\",\"options\":[],\"type\":\"file\",\"placeholder\":\"dd\"},\"date_of_birth\":{\"name\":\"Date of Birth\",\"label\":\"date_of_birth\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"date\",\"placeholder\":null}}', '2022-03-17 02:56:14', '2024-05-09 17:38:40'),
(8, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-21 07:53:25', '2022-03-21 07:53:25'),
(9, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-21 07:54:15', '2022-03-21 07:54:15'),
(10, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-21 07:55:15', '2022-03-21 07:55:22'),
(11, 'withdraw_method', '{\"nid_number_2658\":{\"name\":\"NID Number 2658\",\"label\":\"nid_number_2658\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[\"asdf\"],\"type\":\"checkbox\"}}', '2022-03-22 00:14:09', '2022-03-22 00:14:18'),
(12, 'withdraw_method', '[]', '2022-03-30 09:03:12', '2022-03-30 09:03:12'),
(13, 'withdraw_method', '{\"bank_name\":{\"name\":\"Bank Name\",\"label\":\"bank_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"number\",\"placeholder\":\"fff\"},\"account_name\":{\"name\":\"Account Name\",\"label\":\"account_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"number\",\"placeholder\":null},\"email\":{\"name\":\"Email\",\"label\":\"email\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"email\",\"placeholder\":null},\"mobile\":{\"name\":\"Mobile\",\"label\":\"mobile\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"number\",\"placeholder\":\"Mobile Number\"},\"date\":{\"name\":\"Date\",\"label\":\"date\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"date\",\"placeholder\":\"Date\"}}', '2022-03-30 09:09:11', '2024-05-05 13:02:30'),
(14, 'withdraw_method', '{\"mobile_number\":{\"name\":\"Mobile Number\",\"label\":\"mobile_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"}}', '2022-03-30 09:10:12', '2024-04-22 03:02:18'),
(15, 'manual_deposit', '{\"send_from_number\":{\"name\":\"Send From Number\",\"label\":\"send_from_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"transaction_number\":{\"name\":\"Transaction Number\",\"label\":\"transaction_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"screenshot\":{\"name\":\"Screenshot\",\"label\":\"screenshot\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg,png\",\"options\":[],\"type\":\"file\"}}', '2022-03-30 09:15:27', '2022-03-30 09:15:27'),
(16, 'manual_deposit', '{\"transaction_number\":{\"name\":\"Transaction Number\",\"label\":\"transaction_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"screenshot\":{\"name\":\"Screenshot\",\"label\":\"screenshot\",\"is_required\":\"required\",\"extensions\":\"jpg,pdf,docx\",\"options\":[],\"type\":\"file\"}}', '2022-03-30 09:16:43', '2022-04-11 03:19:54'),
(17, 'manual_deposit', '[]', '2022-03-30 09:21:19', '2022-03-30 09:21:19'),
(18, 'manual_deposit', '[]', '2022-07-26 05:53:36', '2022-07-26 05:53:36'),
(19, 'manual_deposit', '{\"email\":{\"name\":\"Email\",\"label\":\"email\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"}}', '2024-04-17 05:06:53', '2024-04-17 05:19:50'),
(20, 'withdraw_method', '{\"email\":{\"name\":\"Email\",\"label\":\"email\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"}}', '2024-04-17 05:51:33', '2024-04-22 03:02:47'),
(21, 'manual_deposit', '{\"emailddd\":{\"name\":\"Emailddd\",\"label\":\"emailddd\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"name\":{\"name\":\"Name\",\"label\":\"name\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg\",\"options\":[],\"type\":\"file\"},\"file_input\":{\"name\":\"File Input\",\"label\":\"file_input\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg,png\",\"options\":[],\"type\":\"file\"}}', '2024-04-20 05:04:47', '2024-04-26 04:30:58'),
(22, 'manual_deposit', '{\"account_number\":{\"name\":\"Account Number\",\"label\":\"account_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\",\"placeholder\":\"dd\"},\"payment_details\":{\"name\":\"Payment Details\",\"label\":\"payment_details\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"textarea\",\"placeholder\":\"eee\"},\"email\":{\"name\":\"Email\",\"label\":\"email\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\",\"placeholder\":\"ddd\"}}', '2024-04-26 04:55:16', '2024-04-30 05:42:27'),
(23, 'manual_deposit', '{\"email\":{\"name\":\"Email\",\"label\":\"email\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"email\",\"placeholder\":\"Email Check Placeholder\"},\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"number\",\"placeholder\":\"NID Number\"},\"hello\":{\"name\":\"hello\",\"label\":\"hello\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\",\"placeholder\":\"hello\"}}', '2024-04-30 07:37:07', '2024-05-05 04:20:09'),
(24, 'withdraw_method', '[]', '2024-05-07 08:52:10', '2024-05-07 08:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint UNSIGNED NOT NULL,
  `data_keys` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `tempname`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"Courier Service\",\"Express Delivery\",\"Parcel Shipping\",\"Package Delivery\",\"Logistics\",\"Same Day Delivery\",\"Overnight Shipping\",\"International Courier\",\"Local Courier\",\"Freight Services\",\"Delivery Tracking\",\"Courier Company\",\"Shipping Solutions\",\"Delivery Services\",\"Package Tracking\"],\"description\":\"Reliable courier services offering fast and secure delivery with same-day, overnight, and international shipping options. Enjoy real-time tracking for all your packages.\",\"social_title\":\"Fast and Reliable Courier Services for All Your Delivery Needs\",\"social_description\":\"Experience fast, secure, and reliable courier services with same-day, overnight, and international shipping. Enjoy real-time tracking for all your deliveries.\",\"image\":\"665492e5925471716818661.png\"}', NULL, '2020-07-04 23:42:52', '2024-05-27 13:11:22'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Delivering Excellence Tailored Solutions For Precision Shipments.\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier. Track your parcels in real-time, from pickup to delivery, ensuring peace of mind every step of the way.\",\"video_link\":\"https:\\/\\/www.youtube.com\\/watch?v=7JdSjdY6h7c\",\"vedeo_thumbnail\":\"6645e1955ffce1715855765.jpg\"}', 'basic', '2020-10-28 00:51:20', '2024-05-16 09:36:05'),
(25, 'blog.content', '{\"heading\":\"Our Latest Blog And Articles\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\",\"button_name\":\"Discover More\",\"button_link\":\"\\/blog\"}', 'basic', '2020-10-28 00:51:34', '2024-05-16 11:08:34'),
(27, 'contact_us.content', '{\"footer_short_description\":\"Let\'s make something great together. We are trusted by over 5000+ clients.\",\"button_name\":\"CarryMan\",\"button_link\":\"https:\\/\\/carryman.com\\/\",\"mobile_one\":\"+1 (432) 567-5641\",\"mobile_two\":\"+1 (432) 567-6554\",\"email_one\":\"demotext12@gmail.com\",\"email_two\":\"test456@gmail.com\",\"location\":\"4517 Washington Avenue. Manchester, Kentucky 39495\",\"latitude\":\"25.197525\",\"longitude\":\"55.274288\",\"footer_bottom_line_editor\":\"<p>2024 @ All rights reserved by\\u00a0<br><\\/p> \"}', 'basic', '2020-10-28 00:59:19', '2024-05-29 05:53:30'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"subheading\":\"faaffa\"}', 'basic', '2020-10-28 01:04:02', '2024-04-07 08:46:54'),
(33, 'feature.content', '{\"heading\":\"asdf\",\"subheading\":\"dd\"}', 'basic', '2021-01-03 23:40:54', '2024-04-07 08:38:58'),
(34, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"<i class=\\\"fab fa-accusoft\\\"><\\/i>\"}', 'basic', '2021-01-03 23:41:02', '2024-04-07 08:38:48'),
(36, 'service.content', '{\"heading\":\"What We Serve.\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\"}', 'basic', '2021-03-06 01:27:34', '2024-05-16 10:11:18'),
(39, 'banner.content', '{\"has_image\":\"1\",\"primary_heading\":\"PREMIUM SERVICE 24\\/7\",\"secondary_heading\":\"Elevate Your Business With Our Proven Strategies\",\"subheading\":\"Our courier service delivers fast, reliable, and secure transportation for your parcels, documents, and goods.\",\"background_image\":\"6645e03f5b67b1715855423.jpg\"}', 'basic', '2021-05-02 06:09:30', '2024-05-16 09:30:40'),
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;\\\"><h4 style=\\\"margin-bottom:15px;list-style:none;font-family:Rubik, sans-serif;color:rgb(0,0,0);\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">GDPR, cookies and compliance\\u00a0<\\/span><\\/h4><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">Even though cookies are mentioned only once in the GDPR,\\u00a0cookie consent\\u00a0is nonetheless a cornerstone of compliance for websites with EU-located users.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">This is because\\u00a0one of the most common ways for personal data to be collected and shared online is through website cookies. The GDPR sets out specific rules for the use of cookies.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">That why end-user consent to cookies is the GDPR most used legal basis that allows websites to process personal data and use cookies.\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Cookie Consent Banner:<\\/span>\\u00a0Implement a cookie consent banner that informs users about the use of cookies on your website. This banner should allow users to either accept or reject cookies and provide them with the option to learn more about the types of cookies used.<br style=\\\"list-style:none;\\\" \\/><br style=\\\"list-style:none;\\\" \\/><span style=\\\"list-style:none;font-weight:bolder;\\\">Cookie Categories<\\/span>: Categorize cookies used in your application. Common categories include essential, functional, analytical, and marketing cookies. This classification helps users make informed choices about which cookies they want to accept.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Consent Management<\\/span>: Store user consent preferences in a secure manner. If a user consents to certain types of cookies, set a cookie or store the preference in your database. Make it easy for users to change their preferences at any time.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Cookie Documentation<\\/span>: Maintain a clear and accessible cookie policy or documentation explaining the purpose of each type of cookie used, their duration, and any third-party services involved. Keep this information up-to-date.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Anonymize IP Addresses<\\/span>: If you\'re using Google Analytics or similar tools, configure them to anonymize IP addresses. This helps protect user privacy.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Data Retention<\\/span>: Ensure that your application doesn\'t retain user data longer than necessary. Implement automated data deletion processes to comply with GDPR\'s data minimization principle.<br style=\\\"list-style:none;\\\" \\/><br style=\\\"list-style:none;\\\" \\/><span style=\\\"list-style:none;font-weight:bolder;\\\">Data Access and Portability<\\/span>: Provide users with the ability to access their data and, if requested, export it in a machine-readable format.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Data Protection Impact Assessment (DPIA)<\\/span>: Perform DPIAs for data processing activities that present a high risk to user privacy.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Third-Party Services<\\/span>: Review and document the use of third-party services and their GDPR compliance. Ensure that their data processing aligns with GDPR requirements.<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-family:Rubik, sans-serif;font-size:17px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">User Education<\\/span>: Educate your users about their rights and your data protection practices. This could include creating a privacy policy and including links to it in your application.<\\/p><\\/div> \",\"status\":1}', NULL, '2020-07-04 23:42:52', '2024-05-29 10:46:38'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details_editor\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Introduction<\\/span><\\/h4><h4><\\/h4><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">Meticulous selection process ensures each hotel meets stringent quality standards. Whether you\\u2019re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.It waspopularised in the with the release of Letraset sheets containing Lorem Ipsum passages, and more recently consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Data controller<\\/span><\\/h4><h4><\\/h4><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">Nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo,condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Data Security<\\/span><\\/h4><h4><\\/h4><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">Elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">1. Usage :\\u00a0<\\/span>Info commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">2. Security :\\u00a0<\\/span>In enim justo,condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">3. Purposes :\\u00a0<\\/span>Tree planting is the act of planting young trees, shrubs, or other woody plants into the ground to establish new forests or enhance existing ones. It is a crucial component of environmental.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">4. Information :\\u00a0<\\/span>Commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Terms and Conditions<\\/span><\\/h4><h4><\\/h4><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">Meticulous selection process ensures each hotel meets stringent quality standards. Whether you\\u2019re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.It waspopularised in the with the release of Letraset sheets containing Lorem Ipsum passages, and more recently consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Data update<\\/span><\\/h4><h4><\\/h4><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">1. Commodo :\\u00a0<\\/span>ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">2. In enim :\\u00a0<\\/span>justo,condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">3. Tree :\\u00a0<\\/span>planting is the act of planting young trees, shrubs, or other woody plants into the ground to establish new forests or enhance existing ones. It is a crucial component of environmental.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">4. Commodo :\\u00a0<\\/span>ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit.<\\/p><\\/div>\"}', 'basic', '2021-06-09 08:50:42', '2024-05-16 11:20:59'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details_editor\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Introduction<\\/span><\\/h4><p style=\\\"list-style:none;line-height:30px;\\\">Meticulous selection process ensures each hotel meets stringent quality standards. Whether you\\u2019re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.It waspopularised in the with the release of Letraset sheets containing Lorem Ipsum passages, and more recently consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Data controller<\\/span><\\/h4><p style=\\\"list-style:none;line-height:30px;\\\">Nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo,condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Data Security<\\/span><\\/h4><p style=\\\"list-style:none;line-height:30px;\\\">Elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">1. Usage :\\u00a0<\\/span>Info commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">2. Security :\\u00a0<\\/span>In enim justo,condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">3. Purposes :\\u00a0<\\/span>Tree planting is the act of planting young trees, shrubs, or other woody plants into the ground to establish new forests or enhance existing ones. It is a crucial component of environmental.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">4. Information :\\u00a0<\\/span>Commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Terms and Conditions<\\/span><\\/h4><p style=\\\"list-style:none;line-height:30px;\\\">Meticulous selection process ensures each hotel meets stringent quality standards. Whether you\\u2019re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.It waspopularised in the with the release of Letraset sheets containing Lorem Ipsum passages, and more recently consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">Data update<\\/span><\\/h4><p style=\\\"list-style:none;line-height:30px;\\\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\">\\u00a0<\\/p><p style=\\\"list-style:none;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">1. Commodo :\\u00a0<\\/span>ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">2. In enim :\\u00a0<\\/span>justo,condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">3. Tree :\\u00a0<\\/span>planting is the act of planting young trees, shrubs, or other woody plants into the ground to establish new forests or enhance existing ones. It is a crucial component of environmental.<\\/p><p style=\\\"list-style:none;line-height:30px;\\\"><span style=\\\"list-style:none;font-weight:bolder;\\\">4. Commodo :\\u00a0<\\/span>ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit.<\\/p><\\/div>\"}', 'basic', '2021-06-09 08:51:18', '2024-05-16 11:21:11'),
(44, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align:center;font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\"><\\/h3><p style=\\\"border:0px solid rgb(227,227,227);margin-bottom:1.25em;color:rgb(13,13,13);font-family:\'ui-sans-serif\', \'-apple-system\', \'system-ui\', \'Segoe UI\', Roboto, Ubuntu, Cantarell, \'Noto Sans\', sans-serif, Helvetica, \'Apple Color Emoji\', Arial, \'Segoe UI Emoji\', \'Segoe UI Symbol\';font-size:16px;font-weight:400;\\\"><span style=\\\"border:0px solid rgb(227,227,227);font-weight:600;\\\">We\'ll Be Back Soon!<\\/span><\\/p><p style=\\\"border:0px solid rgb(227,227,227);margin-top:1.25em;margin-bottom:1.25em;color:rgb(13,13,13);font-family:\'ui-sans-serif\', \'-apple-system\', \'system-ui\', \'Segoe UI\', Roboto, Ubuntu, Cantarell, \'Noto Sans\', sans-serif, Helvetica, \'Apple Color Emoji\', Arial, \'Segoe UI Emoji\', \'Segoe UI Symbol\';font-size:16px;font-weight:400;\\\">Thank you for visiting our website. We are currently performing scheduled maintenance to improve your experience.<\\/p><p style=\\\"border:0px solid rgb(227,227,227);margin-top:1.25em;margin-bottom:1.25em;color:rgb(13,13,13);font-family:\'ui-sans-serif\', \'-apple-system\', \'system-ui\', \'Segoe UI\', Roboto, Ubuntu, Cantarell, \'Noto Sans\', sans-serif, Helvetica, \'Apple Color Emoji\', Arial, \'Segoe UI Emoji\', \'Segoe UI Symbol\';font-size:16px;font-weight:400;\\\"><span style=\\\"border:0px solid rgb(227,227,227);font-weight:600;\\\">What\'s Happening?<\\/span><\\/p><ul style=\\\"border:0px solid rgb(227,227,227);margin-top:1.25em;margin-bottom:1.25em;padding-left:1.625em;color:rgb(13,13,13);font-family:\'ui-sans-serif\', \'-apple-system\', \'system-ui\', \'Segoe UI\', Roboto, Ubuntu, Cantarell, \'Noto Sans\', sans-serif, Helvetica, \'Apple Color Emoji\', Arial, \'Segoe UI Emoji\', \'Segoe UI Symbol\';font-size:16px;font-weight:400;\\\"><li style=\\\"border:0px solid rgb(227,227,227);margin-bottom:0.5em;margin-top:0.5em;padding-left:0.375em;\\\">Enhancements and updates to our features<\\/li><li style=\\\"border:0px solid rgb(227,227,227);margin-bottom:0.5em;margin-top:0.5em;padding-left:0.375em;\\\">Improving site performance and security<\\/li><li style=\\\"border:0px solid rgb(227,227,227);margin-bottom:0.5em;margin-top:0.5em;padding-left:0.375em;\\\">Routine checks to ensure everything runs smoothly<\\/li><\\/ul><p style=\\\"border:0px solid rgb(227,227,227);margin-top:1.25em;margin-bottom:1.25em;color:rgb(13,13,13);font-family:\'ui-sans-serif\', \'-apple-system\', \'system-ui\', \'Segoe UI\', Roboto, Ubuntu, Cantarell, \'Noto Sans\', sans-serif, Helvetica, \'Apple Color Emoji\', Arial, \'Segoe UI Emoji\', \'Segoe UI Symbol\';font-size:16px;font-weight:400;\\\"><span style=\\\"border:0px solid rgb(227,227,227);font-weight:600;\\\">Estimated Downtime:<\\/span> We expect to be back online by [insert estimated time\\/date].<\\/p><p style=\\\"border:0px solid rgb(227,227,227);margin-top:1.25em;margin-bottom:1.25em;color:rgb(13,13,13);font-family:\'ui-sans-serif\', \'-apple-system\', \'system-ui\', \'Segoe UI\', Roboto, Ubuntu, Cantarell, \'Noto Sans\', sans-serif, Helvetica, \'Apple Color Emoji\', Arial, \'Segoe UI Emoji\', \'Segoe UI Symbol\';font-size:16px;font-weight:400;\\\">We appreciate your patience and understanding. If you need immediate assistance, please contact us at [insert contact information].<\\/p><p style=\\\"border:0px solid rgb(227,227,227);margin-top:1.25em;margin-bottom:1.25em;color:rgb(13,13,13);font-family:\'ui-sans-serif\', \'-apple-system\', \'system-ui\', \'Segoe UI\', Roboto, Ubuntu, Cantarell, \'Noto Sans\', sans-serif, Helvetica, \'Apple Color Emoji\', Arial, \'Segoe UI Emoji\', \'Segoe UI Symbol\';font-size:16px;font-weight:400;\\\">Thank you for your support!<\\/p><\\/div> \"}', NULL, '2020-07-04 23:42:52', '2024-05-29 05:47:05'),
(47, 'faq.content', '{\"has_image\":\"1\",\"heading\":\"Frequently Asked Question and Answer Here\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\",\"image\":\"6645f587955901715860871.png\"}', 'basic', '2024-04-07 08:40:37', '2024-05-16 11:01:12'),
(64, 'banner.element', '{\"name\":\"Truck\",\"has_image\":\"1\",\"image\":\"6645e062b47ec1715855458.png\"}', 'basic', '2024-05-16 09:30:58', '2024-05-16 09:30:58'),
(65, 'banner.element', '{\"name\":\"Truck\",\"has_image\":\"1\",\"image\":\"6645e07c60f381715855484.png\"}', 'basic', '2024-05-16 09:31:24', '2024-05-16 09:31:24'),
(66, 'banner.element', '{\"name\":\"Truck\",\"has_image\":\"1\",\"image\":\"6645e083db44c1715855491.png\"}', 'basic', '2024-05-16 09:31:31', '2024-05-16 09:31:32'),
(67, 'banner.element', '{\"name\":\"Truck\",\"has_image\":\"1\",\"image\":\"6645e09d6781e1715855517.png\"}', 'basic', '2024-05-16 09:31:57', '2024-05-16 09:31:57'),
(68, 'about.element', '{\"icon\":\"<i class=\\\"fas fa-truck\\\"><\\/i>\",\"title\":\"On-Time Delivery\",\"description\":\"Trust us to handle your packages with care and efficiency courier.\"}', 'basic', '2024-05-16 09:36:36', '2024-05-16 09:36:36'),
(69, 'about.element', '{\"icon\":\"<i class=\\\"fas fa-fighter-jet\\\"><\\/i>\",\"title\":\"Secure Transport\",\"description\":\"Trust us to handle your packages with care and efficiency courier.\"}', 'basic', '2024-05-16 09:37:51', '2024-05-16 09:37:51'),
(70, 'about.element', '{\"icon\":\"<i class=\\\"fas fa-briefcase-medical\\\"><\\/i>\",\"title\":\"24\\/7 Support\",\"description\":\"Trust us to handle your packages with care and efficiency courier.\"}', 'basic', '2024-05-16 09:50:50', '2024-05-16 09:50:50'),
(71, 'about.element', '{\"icon\":\"<i class=\\\"fas fa-headset\\\"><\\/i>\",\"title\":\"Customer Support\",\"description\":\"Trust us to handle your packages with care and efficiency courier.\"}', 'basic', '2024-05-16 09:51:34', '2024-05-16 09:51:34'),
(72, 'how_it_works.content', '{\"heading\":\"How To Start Our Work.\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\"}', 'basic', '2024-05-16 09:54:38', '2024-05-16 09:54:38'),
(73, 'how_it_works.element', '{\"icon\":\"<i class=\\\"far fa-check-circle\\\"><\\/i>\",\"title\":\"Enter Tracking Number\",\"description\":\"Pick the service you are looking for from the website or the app.\"}', 'basic', '2024-05-16 09:56:05', '2024-05-16 09:56:05'),
(74, 'how_it_works.element', '{\"icon\":\"<i class=\\\"fas fa-calendar-alt\\\"><\\/i>\",\"title\":\"View Shipment Status\",\"description\":\"Pick the service you are looking for from the website or the app.\"}', 'basic', '2024-05-16 09:56:33', '2024-05-16 09:56:33'),
(75, 'how_it_works.element', '{\"icon\":\"<i class=\\\"far fa-list-alt\\\"><\\/i>\",\"title\":\"Receive Updates\",\"description\":\"Pick the service you are looking for from the website or the app.\"}', 'basic', '2024-05-16 09:56:57', '2024-05-16 09:56:57'),
(76, 'counter.element', '{\"icon\":\"<i class=\\\"fas fa-users\\\"><\\/i>\",\"counter_digit\":\"25\",\"title\":\"Satisfied Client\"}', 'basic', '2024-05-16 09:58:34', '2024-05-16 09:58:34'),
(77, 'counter.element', '{\"icon\":\"<i class=\\\"fas fa-globe-americas\\\"><\\/i>\",\"counter_digit\":\"280\",\"title\":\"Available Countries\"}', 'basic', '2024-05-16 10:08:39', '2024-05-16 10:08:39'),
(78, 'counter.element', '{\"icon\":\"<i class=\\\"fas fa-user-clock\\\"><\\/i>\",\"counter_digit\":\"125\",\"title\":\"Total Staffs\"}', 'basic', '2024-05-16 10:09:07', '2024-05-16 10:09:08'),
(79, 'counter.element', '{\"icon\":\"<i class=\\\"fas fa-user-plus\\\"><\\/i>\",\"counter_digit\":\"75\",\"title\":\"Total Member\"}', 'basic', '2024-05-16 10:09:30', '2024-05-16 10:09:30'),
(80, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-plane-departure\\\"><\\/i>\",\"title\":\"Global Shipping\",\"description\":\"Trust us to handle your packages with care and efficiency, whether it\'s across town or around the globe. Experience the future of courier services with us today.\"}', 'basic', '2024-05-16 10:11:59', '2024-05-16 10:11:59'),
(81, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-users\\\"><\\/i>\",\"title\":\"Dedicated Customer Care\",\"description\":\"Trust us to handle your packages with care and efficiency, whether it\'s across town or around the globe. Experience the future of courier services with us today.\"}', 'basic', '2024-05-16 10:12:24', '2024-05-16 10:12:24'),
(82, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-box-open\\\"><\\/i>\",\"title\":\"Package Pick-up\",\"description\":\"Trust us to handle your packages with care and efficiency, whether it\'s across town or around the globe. Experience the future of courier services with us today.\"}', 'basic', '2024-05-16 10:22:09', '2024-05-16 10:22:09'),
(83, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-microchip\\\"><\\/i>\",\"title\":\"Advanced Technology\",\"description\":\"Trust us to handle your packages with care and efficiency, whether it\'s across town or around the globe. Experience the future of courier services with us today.\"}', 'basic', '2024-05-16 10:22:49', '2024-05-16 10:22:49'),
(84, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-tv\\\"><\\/i>\",\"title\":\"Delivery Monitoring\",\"description\":\"Trust us to handle your packages with care and efficiency, whether it\'s across town or around the globe. Experience the future of courier services with us today.\"}', 'basic', '2024-05-16 10:23:19', '2024-05-16 10:23:19'),
(85, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-dolly-flatbed\\\"><\\/i>\",\"title\":\"Fast Delivery\",\"description\":\"Trust us to handle your packages with care and efficiency, whether it\'s across town or around the globe. Experience the future of courier services with us today.\"}', 'basic', '2024-05-16 10:24:15', '2024-05-16 10:24:15'),
(86, 'team.content', '{\"heading\":\"We\\u2019ve Most Talented Team Members\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\"}', 'basic', '2024-05-16 10:45:30', '2024-05-16 10:45:30'),
(87, 'team.element', '{\"has_image\":[\"1\"],\"name\":\"Leslie Alexander\",\"designation\":\"HR Manager\",\"gmail\":\"http:\\/\\/gmail.com\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"image\":\"6645f23b207c31715860027.png\"}', 'basic', '2024-05-16 10:47:07', '2024-05-16 10:47:07'),
(88, 'team.element', '{\"has_image\":[\"1\"],\"name\":\"Mark John\",\"designation\":\"HR Manager\",\"gmail\":\"http:\\/\\/gmail.com\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"image\":\"6645f26aef0f61715860074.png\"}', 'basic', '2024-05-16 10:47:54', '2024-05-16 10:47:55'),
(89, 'team.element', '{\"has_image\":[\"1\"],\"name\":\"Peter Parker\",\"designation\":\"HR Manager\",\"gmail\":\"http:\\/\\/gmail.com\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"image\":\"6645f2aa2e6241715860138.png\"}', 'basic', '2024-05-16 10:48:58', '2024-05-16 10:48:58'),
(90, 'team.element', '{\"has_image\":[\"1\"],\"name\":\"Alfreed Nobel\",\"designation\":\"HR Manager\",\"gmail\":\"http:\\/\\/gmail.com\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"image\":\"6645f2d84f72f1715860184.png\"}', 'basic', '2024-05-16 10:49:44', '2024-05-16 10:49:44'),
(91, 'custom_quote.content', '{\"heading\":\"Leading Provider Of Contract Logistics And Transportation Services Worldwide.\",\"button_name\":\"request custom quote\",\"button_link\":\"\\/contact\"}', 'basic', '2024-05-16 10:51:52', '2024-05-16 10:51:52'),
(92, 'branches.content', '{\"has_image\":\"1\",\"heading\":\"Our Top All Branches\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\",\"image\":\"6645f3e5cbaaa1715860453.png\"}', 'basic', '2024-05-16 10:54:13', '2024-05-16 10:54:14'),
(93, 'branches.element', '{\"country\":\"America\",\"address\":\"Washington, McDonald\",\"mobile\":\"543 5432 6553\",\"email\":\"demomail@gmaol.com\"}', 'basic', '2024-05-16 10:54:52', '2024-05-16 10:54:52'),
(94, 'branches.element', '{\"country\":\"Canada\",\"address\":\"Ottawa,The Glebe\",\"mobile\":\"432 4321 5432\",\"email\":\"demomail@gmaol.com\"}', 'basic', '2024-05-16 10:55:18', '2024-05-16 10:55:18'),
(95, 'branches.element', '{\"country\":\"Turkey\",\"address\":\"Ankara,Polatli\",\"mobile\":\"432 3213 6532\",\"email\":\"demo123@gmaol.com\"}', 'basic', '2024-05-16 10:55:38', '2024-05-16 10:55:38'),
(96, 'branches.element', '{\"country\":\"France\",\"address\":\"Gujranwala, McDonald\",\"mobile\":\"543 5432 6553\",\"email\":\"demomail@gmaol.com\"}', 'basic', '2024-05-16 10:56:03', '2024-05-16 10:56:03'),
(97, 'branches.element', '{\"country\":\"Spain\",\"address\":\"Ottawa,The Glebe\",\"mobile\":\"432 4321 5432\",\"email\":\"demomail@gmaol.com\"}', 'basic', '2024-05-16 10:56:36', '2024-05-16 10:56:36'),
(98, 'branches.element', '{\"country\":\"Netherlands\",\"address\":\"Ankara,Polatli\",\"mobile\":\"432 3213 6532\",\"email\":\"demo123@gmaol.com\"}', 'basic', '2024-05-16 10:56:59', '2024-05-16 10:56:59'),
(99, 'branches.element', '{\"country\":\"Pakistan\",\"address\":\"Gujranwala, McDonald\",\"mobile\":\"543 5432 6553\",\"email\":\"demomail@gmaol.com\"}', 'basic', '2024-05-16 10:57:34', '2024-05-16 10:57:34'),
(100, 'branches.element', '{\"country\":\"China\",\"address\":\"Ottawa,The Glebe\",\"mobile\":\"432 4321 5432\",\"email\":\"demomail@gmaol.com\"}', 'basic', '2024-05-16 10:58:28', '2024-05-16 10:58:28'),
(101, 'branches.element', '{\"country\":\"Japan\",\"address\":\"Ankara,Polatli\",\"mobile\":\"432 3213 6532\",\"email\":\"demo123@gmaol.com\"}', 'basic', '2024-05-16 10:58:59', '2024-05-16 10:58:59'),
(102, 'faq.element', '{\"question\":\"What are your fees?\",\"answer_editor\":\"<p><span style=\\\"color:rgba(0,36,23,0.7);font-family:Poppins, sans-serif;\\\">We offer comprehensive mining services including cloud mining, mining pool solutions, and consultancy services, tailored to meet the diverse needs of our clients in the mining industry.<\\/span><br><\\/p> \"}', 'basic', '2024-05-16 11:01:34', '2024-05-29 05:42:49'),
(103, 'faq.element', '{\"question\":\"Can I track my progress?\",\"answer_editor\":\"<span style=\\\"color:rgba(0,36,23,0.7);font-family:Poppins, sans-serif;\\\">We offer comprehensive mining services including cloud mining, mining pool solutions, and consultancy services, tailored to meet the diverse needs of our clients in the mining industry.<\\/span> \"}', 'basic', '2024-05-16 11:01:50', '2024-05-29 05:43:00'),
(104, 'faq.element', '{\"question\":\"How secure is your platform?\",\"answer_editor\":\"<p><span style=\\\"color:rgba(0,36,23,0.7);font-family:Poppins, sans-serif;\\\">We offer comprehensive mining services including cloud mining, mining pool solutions, and consultancy services, tailored to meet the diverse needs of our clients in the mining industry.<\\/span><br><\\/p> \"}', 'basic', '2024-05-16 11:02:01', '2024-05-29 05:43:04'),
(105, 'faq.element', '{\"question\":\"Environmental sustainability measures?\",\"answer_editor\":\"<p><span style=\\\"color:rgba(0,36,23,0.7);font-family:Poppins, sans-serif;\\\">We offer comprehensive mining services including cloud mining, mining pool solutions, and consultancy services, tailored to meet the diverse needs of our clients in the mining industry.<\\/span><br><\\/p> \"}', 'basic', '2024-05-16 11:02:12', '2024-05-29 05:43:08'),
(106, 'faq.element', '{\"question\":\"What mining services do you offer?\",\"answer_editor\":\"<p><span style=\\\"color:rgba(0,36,23,0.7);font-family:Poppins, sans-serif;\\\">We offer comprehensive mining services including cloud mining, mining pool solutions, and consultancy services, tailored to meet the diverse needs of our clients in the mining industry.<\\/span><br><\\/p> \"}', 'basic', '2024-05-16 11:02:52', '2024-05-29 05:43:13'),
(107, 'testimonial.content', '{\"heading\":\"Trusted By Our Happy Clients\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\"}', 'basic', '2024-05-16 11:04:09', '2024-05-16 11:04:09'),
(108, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Jack Ryan\",\"location\":\"Client USA\",\"rating\":\"5\",\"review\":\"Reliable courier, fast deliveries, friendly customer service, top choice for all shipping requirements.\",\"image\":\"6645f66245f581715861090.png\"}', 'basic', '2024-05-16 11:04:50', '2024-05-16 11:04:50'),
(109, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Lily Rose\",\"location\":\"Client USA\",\"rating\":\"5\",\"review\":\"Reliable courier, fast deliveries, friendly customer service, top choice for all shipping requirements.\",\"image\":\"6645f677738af1715861111.png\"}', 'basic', '2024-05-16 11:05:11', '2024-05-16 11:05:11'),
(110, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Emma Grace\",\"location\":\"Client USA\",\"rating\":\"5\",\"review\":\"Reliable courier, fast deliveries, friendly customer service, top choice for all shipping requirements.\",\"image\":\"6645f68e404d91715861134.png\"}', 'basic', '2024-05-16 11:05:34', '2024-05-16 11:05:34'),
(111, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Luke James\",\"location\":\"Client USA\",\"rating\":\"5\",\"review\":\"Reliable courier, fast deliveries, friendly customer service, top choice for all shipping requirements.\",\"image\":\"6645f6a51f4fa1715861157.png\"}', 'basic', '2024-05-16 11:05:57', '2024-05-16 11:05:57'),
(112, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Finn Thomas\",\"location\":\"Client USA\",\"rating\":\"5\",\"review\":\"Reliable courier, fast deliveries, friendly customer service, top choice for all shipping requirements.\",\"image\":\"6645f6b81a33c1715861176.png\"}', 'basic', '2024-05-16 11:06:16', '2024-05-16 11:06:16'),
(113, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"We are committed to provide custom\",\"description_editor\":\"<h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\">We are committed to provide custom<\\/h3><h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\"><\\/h3><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">In today\'s dynamic business landscape, efficiency is paramount. From startups to established enterprises, the ability to deliver goods and documents swiftly and securely is a cornerstone of success. Enter professional courier services \\u00e2\\u0080\\u0093 the unsung heroes of streamlined operations and seamless logistics.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Speedy Deliveries, Swift Results<\\/h4><h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\"><\\/h3><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">Time is of the essence in the business world. Courier services specialize in rapid deliveries, offering same-day or next-day options that keep you ahead of the competition. Discover how leveraging their expertise can elevate your delivery game and meet even the tightest deadlines.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Reliability Redefined<\\/h4><h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\"><\\/h3><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">Consistency breeds trust, and in business, reliability is non-negotiable. Professional courier services excel in handling parcels and documents with care and precision, ensuring they reach their destination securely and on time. Explore how partnering with a trusted courier can enhance your reputation and customer satisfaction.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Cost-Effectiveness: Beyond the Balance Sheet<\\/h4><h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\"><\\/h3><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">While some may see courier services as an added expense, the reality is quite the opposite. By outsourcing your delivery needs, you can eliminate the overhead costs of in-house logistics, from staffing to vehicle maintenance. Uncover the hidden savings and customizable plans that make professional courier services a cost-effective solution for businesses of all sizes.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Scalability: Growing Pains, Solved<\\/h4><h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\"><\\/h3><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">As your business expands, so do your delivery requirements. Professional courier services offer scalable solutions that adapt to your evolving needs, whether you\'re entering new markets or experiencing a surge in orders. Learn how their flexible approach ensures seamless logistics, no matter the scale of your operation.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Elevating Customer Experience<\\/h4><h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\"><\\/h3><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">Exceptional service is the cornerstone of customer loyalty. By partnering with a professional courier service, you can provide your clients with fast, reliable deliveries that exceed their expectations. Discover how real-time tracking, personalized service, and a commitment to excellence can enhance the overall customer experience and set your business apart.<\\/p><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Conclusion: Delivering Success, One Parcel at a Time<\\/h4><h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\"><\\/h3><p style=\\\"list-style:none;font-size:16px;line-height:30px;\\\">In conclusion, the benefits of professional courier services extend far beyond logistics. From speed and reliability to cost-effectiveness and scalability, they are essential partners in navigating the complexities of modern business. By harnessing their expertise and dedication, you can optimize efficiency, delight your customers, and propel your business towards success in today\'s competitive marketplace.<\\/p> \",\"blog_image\":\"6645f766b58b11715861350.png\"}', 'basic', '2024-05-16 11:09:10', '2024-05-29 05:33:55');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `tempname`, `created_at`, `updated_at`) VALUES
(114, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Behind the Scenes: The Logistics of Efficient Courier Services\",\"description_editor\":\"<h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\">We are committed to provide custom<\\/h3><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In today\'s dynamic business landscape, efficiency is paramount. From startups to established enterprises, the ability to deliver goods and documents swiftly and securely is a cornerstone of success. Enter professional courier services \\u00e2\\u0080\\u0093 the unsung heroes of streamlined operations and seamless logistics.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Speedy Deliveries, Swift Results<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Time is of the essence in the business world. Courier services specialize in rapid deliveries, offering same-day or next-day options that keep you ahead of the competition. Discover how leveraging their expertise can elevate your delivery game and meet even the tightest deadlines.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Reliability Redefined<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Consistency breeds trust, and in business, reliability is non-negotiable. Professional courier services excel in handling parcels and documents with care and precision, ensuring they reach their destination securely and on time. Explore how partnering with a trusted courier can enhance your reputation and customer satisfaction.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Cost-Effectiveness: Beyond the Balance Sheet<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">While some may see courier services as an added expense, the reality is quite the opposite. By outsourcing your delivery needs, you can eliminate the overhead costs of in-house logistics, from staffing to vehicle maintenance. Uncover the hidden savings and customizable plans that make professional courier services a cost-effective solution for businesses of all sizes.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Scalability: Growing Pains, Solved<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">As your business expands, so do your delivery requirements. Professional courier services offer scalable solutions that adapt to your evolving needs, whether you\'re entering new markets or experiencing a surge in orders. Learn how their flexible approach ensures seamless logistics, no matter the scale of your operation.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Elevating Customer Experience<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Exceptional service is the cornerstone of customer loyalty. By partnering with a professional courier service, you can provide your clients with fast, reliable deliveries that exceed their expectations. Discover how real-time tracking, personalized service, and a commitment to excellence can enhance the overall customer experience and set your business apart.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Conclusion: Delivering Success, One Parcel at a Time<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In conclusion, the benefits of professional courier services extend far beyond logistics. From speed and reliability to cost-effectiveness and scalability, they are essential partners in navigating the complexities of modern business. By harnessing their expertise and dedication, you can optimize efficiency, delight your customers, and propel your business towards success in today\'s competitive marketplace.<\\/p> \",\"blog_image\":\"6645f77b141e11715861371.png\"}', 'basic', '2024-05-16 11:09:31', '2024-05-29 05:34:02'),
(115, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The Evolution of Courier Services: From Postmen to Package Tracking\",\"description_editor\":\"<h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\">We are committed to provide custom<\\/h3><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In today\'s dynamic business landscape, efficiency is paramount. From startups to established enterprises, the ability to deliver goods and documents swiftly and securely is a cornerstone of success. Enter professional courier services \\u00e2\\u0080\\u0093 the unsung heroes of streamlined operations and seamless logistics.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Speedy Deliveries, Swift Results<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Time is of the essence in the business world. Courier services specialize in rapid deliveries, offering same-day or next-day options that keep you ahead of the competition. Discover how leveraging their expertise can elevate your delivery game and meet even the tightest deadlines.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Reliability Redefined<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Consistency breeds trust, and in business, reliability is non-negotiable. Professional courier services excel in handling parcels and documents with care and precision, ensuring they reach their destination securely and on time. Explore how partnering with a trusted courier can enhance your reputation and customer satisfaction.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Cost-Effectiveness: Beyond the Balance Sheet<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">While some may see courier services as an added expense, the reality is quite the opposite. By outsourcing your delivery needs, you can eliminate the overhead costs of in-house logistics, from staffing to vehicle maintenance. Uncover the hidden savings and customizable plans that make professional courier services a cost-effective solution for businesses of all sizes.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Scalability: Growing Pains, Solved<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">As your business expands, so do your delivery requirements. Professional courier services offer scalable solutions that adapt to your evolving needs, whether you\'re entering new markets or experiencing a surge in orders. Learn how their flexible approach ensures seamless logistics, no matter the scale of your operation.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Elevating Customer Experience<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Exceptional service is the cornerstone of customer loyalty. By partnering with a professional courier service, you can provide your clients with fast, reliable deliveries that exceed their expectations. Discover how real-time tracking, personalized service, and a commitment to excellence can enhance the overall customer experience and set your business apart.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Conclusion: Delivering Success, One Parcel at a Time<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In conclusion, the benefits of professional courier services extend far beyond logistics. From speed and reliability to cost-effectiveness and scalability, they are essential partners in navigating the complexities of modern business. By harnessing their expertise and dedication, you can optimize efficiency, delight your customers, and propel your business towards success in today\'s competitive marketplace.<\\/p> \",\"blog_image\":\"6645f7b2e847e1715861426.png\"}', 'basic', '2024-05-16 11:10:26', '2024-05-29 05:34:11'),
(116, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Speed, Safety, and Service: What Makes a Courier Service Stand Out?\",\"description_editor\":\"<h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\">We are committed to provide custom<\\/h3><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In today\'s dynamic business landscape, efficiency is paramount. From startups to established enterprises, the ability to deliver goods and documents swiftly and securely is a cornerstone of success. Enter professional courier services \\u00e2\\u0080\\u0093 the unsung heroes of streamlined operations and seamless logistics.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Speedy Deliveries, Swift Results<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Time is of the essence in the business world. Courier services specialize in rapid deliveries, offering same-day or next-day options that keep you ahead of the competition. Discover how leveraging their expertise can elevate your delivery game and meet even the tightest deadlines.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Reliability Redefined<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Consistency breeds trust, and in business, reliability is non-negotiable. Professional courier services excel in handling parcels and documents with care and precision, ensuring they reach their destination securely and on time. Explore how partnering with a trusted courier can enhance your reputation and customer satisfaction.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Cost-Effectiveness: Beyond the Balance Sheet<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">While some may see courier services as an added expense, the reality is quite the opposite. By outsourcing your delivery needs, you can eliminate the overhead costs of in-house logistics, from staffing to vehicle maintenance. Uncover the hidden savings and customizable plans that make professional courier services a cost-effective solution for businesses of all sizes.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Scalability: Growing Pains, Solved<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">As your business expands, so do your delivery requirements. Professional courier services offer scalable solutions that adapt to your evolving needs, whether you\'re entering new markets or experiencing a surge in orders. Learn how their flexible approach ensures seamless logistics, no matter the scale of your operation.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Elevating Customer Experience<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Exceptional service is the cornerstone of customer loyalty. By partnering with a professional courier service, you can provide your clients with fast, reliable deliveries that exceed their expectations. Discover how real-time tracking, personalized service, and a commitment to excellence can enhance the overall customer experience and set your business apart.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Conclusion: Delivering Success, One Parcel at a Time<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In conclusion, the benefits of professional courier services extend far beyond logistics. From speed and reliability to cost-effectiveness and scalability, they are essential partners in navigating the complexities of modern business. By harnessing their expertise and dedication, you can optimize efficiency, delight your customers, and propel your business towards success in today\'s competitive marketplace.<\\/p> \",\"blog_image\":\"6645f7d0284131715861456.png\"}', 'basic', '2024-05-16 11:10:56', '2024-05-29 05:34:18'),
(117, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Delivering Convenience: How Courier Services Shape Modern Commerce\",\"description_editor\":\"<h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\">We are committed to provide custom<\\/h3><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In today\'s dynamic business landscape, efficiency is paramount. From startups to established enterprises, the ability to deliver goods and documents swiftly and securely is a cornerstone of success. Enter professional courier services \\u00e2\\u0080\\u0093 the unsung heroes of streamlined operations and seamless logistics.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Speedy Deliveries, Swift Results<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Time is of the essence in the business world. Courier services specialize in rapid deliveries, offering same-day or next-day options that keep you ahead of the competition. Discover how leveraging their expertise can elevate your delivery game and meet even the tightest deadlines.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Reliability Redefined<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Consistency breeds trust, and in business, reliability is non-negotiable. Professional courier services excel in handling parcels and documents with care and precision, ensuring they reach their destination securely and on time. Explore how partnering with a trusted courier can enhance your reputation and customer satisfaction.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Cost-Effectiveness: Beyond the Balance Sheet<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">While some may see courier services as an added expense, the reality is quite the opposite. By outsourcing your delivery needs, you can eliminate the overhead costs of in-house logistics, from staffing to vehicle maintenance. Uncover the hidden savings and customizable plans that make professional courier services a cost-effective solution for businesses of all sizes.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Scalability: Growing Pains, Solved<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">As your business expands, so do your delivery requirements. Professional courier services offer scalable solutions that adapt to your evolving needs, whether you\'re entering new markets or experiencing a surge in orders. Learn how their flexible approach ensures seamless logistics, no matter the scale of your operation.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Elevating Customer Experience<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Exceptional service is the cornerstone of customer loyalty. By partnering with a professional courier service, you can provide your clients with fast, reliable deliveries that exceed their expectations. Discover how real-time tracking, personalized service, and a commitment to excellence can enhance the overall customer experience and set your business apart.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Conclusion: Delivering Success, One Parcel at a Time<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In conclusion, the benefits of professional courier services extend far beyond logistics. From speed and reliability to cost-effectiveness and scalability, they are essential partners in navigating the complexities of modern business. By harnessing their expertise and dedication, you can optimize efficiency, delight your customers, and propel your business towards success in today\'s competitive marketplace.<\\/p> \",\"blog_image\":\"6645f7e81c6df1715861480.png\"}', 'basic', '2024-05-16 11:11:20', '2024-05-29 05:34:22'),
(118, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"From Door to Door: The Journey of Your Package with Our Courier Service\",\"description_editor\":\"<h3 class=\\\"blog-details__title\\\" style=\\\"margin-bottom:15px;list-style:none;background-color:rgba(0,0,0,0.01);\\\">We are committed to provide custom<\\/h3><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In today\'s dynamic business landscape, efficiency is paramount. From startups to established enterprises, the ability to deliver goods and documents swiftly and securely is a cornerstone of success. Enter professional courier services \\u00e2\\u0080\\u0093 the unsung heroes of streamlined operations and seamless logistics.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Speedy Deliveries, Swift Results<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Time is of the essence in the business world. Courier services specialize in rapid deliveries, offering same-day or next-day options that keep you ahead of the competition. Discover how leveraging their expertise can elevate your delivery game and meet even the tightest deadlines.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Reliability Redefined<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Consistency breeds trust, and in business, reliability is non-negotiable. Professional courier services excel in handling parcels and documents with care and precision, ensuring they reach their destination securely and on time. Explore how partnering with a trusted courier can enhance your reputation and customer satisfaction.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Cost-Effectiveness: Beyond the Balance Sheet<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">While some may see courier services as an added expense, the reality is quite the opposite. By outsourcing your delivery needs, you can eliminate the overhead costs of in-house logistics, from staffing to vehicle maintenance. Uncover the hidden savings and customizable plans that make professional courier services a cost-effective solution for businesses of all sizes.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Scalability: Growing Pains, Solved<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">As your business expands, so do your delivery requirements. Professional courier services offer scalable solutions that adapt to your evolving needs, whether you\'re entering new markets or experiencing a surge in orders. Learn how their flexible approach ensures seamless logistics, no matter the scale of your operation.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Elevating Customer Experience<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">Exceptional service is the cornerstone of customer loyalty. By partnering with a professional courier service, you can provide your clients with fast, reliable deliveries that exceed their expectations. Discover how real-time tracking, personalized service, and a commitment to excellence can enhance the overall customer experience and set your business apart.<\\/p><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">\\u00a0<\\/p><h4 style=\\\"list-style:none;background-color:rgba(0,0,0,0.01);\\\">Conclusion: Delivering Success, One Parcel at a Time<\\/h4><p style=\\\"list-style:none;line-height:30px;background-color:rgba(0,0,0,0.01);\\\">In conclusion, the benefits of professional courier services extend far beyond logistics. From speed and reliability to cost-effectiveness and scalability, they are essential partners in navigating the complexities of modern business. By harnessing their expertise and dedication, you can optimize efficiency, delight your customers, and propel your business towards success in today\'s competitive marketplace.<\\/p> \",\"blog_image\":\"6645f7f6e8ea81715861494.png\"}', 'basic', '2024-05-16 11:11:34', '2024-05-29 05:34:26'),
(119, 'coverage.element', '{\"has_image\":[\"1\"],\"name\":\"envato\",\"image\":\"6645f8bd4fe5a1715861693.png\"}', 'basic', '2024-05-16 11:14:53', '2024-05-16 11:14:53'),
(120, 'coverage.element', '{\"has_image\":[\"1\"],\"name\":\"envato\",\"image\":\"6645f8c83a85a1715861704.png\"}', 'basic', '2024-05-16 11:15:04', '2024-05-16 11:15:04'),
(121, 'coverage.element', '{\"has_image\":[\"1\"],\"name\":\"themeforest\",\"image\":\"6645f8d2894641715861714.png\"}', 'basic', '2024-05-16 11:15:14', '2024-05-16 11:15:14'),
(122, 'coverage.element', '{\"has_image\":[\"1\"],\"name\":\"envato\",\"image\":\"6645f8da00ff01715861722.png\"}', 'basic', '2024-05-16 11:15:21', '2024-05-16 11:15:22'),
(123, 'coverage.element', '{\"has_image\":[\"1\"],\"name\":\"themeforest\",\"image\":\"6645f8e45199d1715861732.png\"}', 'basic', '2024-05-16 11:15:32', '2024-05-16 11:15:32'),
(124, 'coverage.element', '{\"has_image\":[\"1\"],\"name\":\"themeforest\",\"image\":\"6645f8ebc066f1715861739.png\"}', 'basic', '2024-05-16 11:15:39', '2024-05-16 11:15:39'),
(125, 'coverage.element', '{\"has_image\":[\"1\"],\"name\":\"envato\",\"image\":\"6645f905b36741715861765.png\"}', 'basic', '2024-05-16 11:16:05', '2024-05-16 11:16:05'),
(126, 'header_button.content', '{\"button_name\":\"Get a Quote\",\"button_link\":\"\\/contact\"}', 'basic', '2024-05-16 11:17:15', '2024-05-16 11:17:15'),
(127, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook-square\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', 'basic', '2024-05-16 11:23:20', '2024-05-16 11:23:20'),
(128, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', 'basic', '2024-05-16 11:23:44', '2024-05-16 11:23:44'),
(129, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/twitter.com\\/\"}', 'basic', '2024-05-16 11:24:07', '2024-05-16 11:24:07'),
(130, 'social_icon.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"fab fa-linkedin\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', 'basic', '2024-05-16 11:24:30', '2024-05-16 11:24:30'),
(131, 'footer_company_links.element', '{\"title\":\"Latest Blogs\",\"url\":\"\\/blog\"}', 'basic', '2024-05-16 11:28:14', '2024-05-16 11:28:14'),
(132, 'footer_company_links.element', '{\"title\":\"Our Team\",\"url\":\"\\/team\"}', 'basic', '2024-05-16 11:28:28', '2024-05-16 11:28:28'),
(133, 'footer_company_links.element', '{\"title\":\"Contact Us\",\"url\":\"\\/contact\"}', 'basic', '2024-05-16 11:28:40', '2024-05-16 11:28:40'),
(134, 'footer_company_links.element', '{\"title\":\"FAQ\",\"url\":\"\\/faq\"}', 'basic', '2024-05-16 11:28:59', '2024-05-16 11:28:59'),
(135, 'footer_important_links.element', '{\"title\":\"Order Tracking\",\"url\":\"\\/tracking\"}', 'basic', '2024-05-16 11:29:24', '2024-05-16 11:29:24'),
(136, 'links.element', '{\"title\":\"Order Tracking\",\"url\":\"\\/tracking\"}', 'basic', '2024-05-22 06:24:34', '2024-05-22 06:26:15'),
(138, 'tracking.content', '{\"heading\":\"Your Parcel Status\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\"}', 'basic', '2024-05-22 06:31:35', '2024-05-22 06:31:35'),
(139, 'order_tracking.content', '{\"heading\":\"Your Parcel Status\",\"subheading\":\"Welcome to our courier website, your gateway to seamless shipping solutions. With our user-friendly interface and robust features, sending packages has never been easier.\"}', 'basic', '2024-05-22 07:39:42', '2024-05-22 07:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `help_desks`
--

CREATE TABLE `help_desks` (
  `id` bigint NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=> reply, 0 => pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint NOT NULL,
  `branch_id` bigint DEFAULT NULL,
  `staff_id` bigint DEFAULT NULL,
  `courier_id` bigint DEFAULT NULL,
  `income` decimal(28,2) DEFAULT NULL,
  `collected_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '2020-07-06 03:47:55', '2024-04-23 09:46:47'),
(9, 'Spanish', 'bn', 0, '2021-03-14 04:37:41', '2024-05-16 12:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` int DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` text,
  `username` varchar(40) DEFAULT NULL,
  `mobile` text,
  `address` text,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` text,
  `password` text,
  `remember_token` text,
  `status` tinyint DEFAULT NULL COMMENT '0 => Disabled,\r\n1 => Enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager_password_resets`
--

CREATE TABLE `manager_password_resets` (
  `id` bigint NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_14_061757_create_support_tickets_table', 3),
(5, '2020_06_14_061837_create_support_messages_table', 3),
(6, '2020_06_14_061904_create_support_attachments_table', 3),
(7, '2020_06_14_062359_create_admins_table', 3),
(8, '2020_06_14_064604_create_transactions_table', 4),
(9, '2020_06_14_065247_create_general_settings_table', 5),
(12, '2014_10_12_100000_create_password_resets_table', 6),
(13, '2020_06_14_060541_create_user_logins_table', 6),
(14, '2020_06_14_071708_create_admin_password_resets_table', 7),
(15, '2020_09_14_053026_create_countries_table', 8),
(16, '2021_03_15_084721_create_admin_notifications_table', 9),
(17, '2016_06_01_000001_create_oauth_auth_codes_table', 10),
(18, '2016_06_01_000002_create_oauth_access_tokens_table', 10),
(19, '2016_06_01_000003_create_oauth_refresh_tokens_table', 10),
(20, '2016_06_01_000004_create_oauth_clients_table', 10),
(21, '2016_06_01_000005_create_oauth_personal_access_clients_table', 10),
(22, '2021_05_08_103925_create_sms_gateways_table', 11),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 12),
(24, '2021_05_23_111859_create_email_logs_table', 13),
(25, '2022_02_26_061836_create_forms_table', 14),
(26, '2023_06_15_144908_create_update_logs_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notification_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', '{\"code\":\"Email verification code\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '---', 'Your phone verification code is: {{code}}', '{\"code\":\"SMS Verification Code\"}', 0, 1, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(18, 'SENT_IN_QUEUE_SENDER', 'Sent in Queue (Sender)', 'Your Courier has been picked successfully', '<p></p><p></p><p><font face=\"Raleway, sans-serif\" style=\"color: rgb(0, 0, 0); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">We are pleased to inform you that your courier has been successfully picked</font><font face=\"Raleway, sans-serif\" style=\"color: rgb(0, 0, 0); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">. Below are the details of your courier:</font><br></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\"><br></font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">**Courier Details:**</font><p><font face=\"Raleway, sans-serif\" style=\"color: rgb(0, 0, 0); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font><span style=\"color: rgb(0, 0, 0); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><br></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">Invoice Number: {{invoice_number}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">Pickup Branch Name: {{sender_branch_name}}&nbsp; &nbsp; &nbsp; &nbsp;</font><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Pickup Branch Address:&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{sender_branch_address}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span><span style=\"background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">&nbsp;&nbsp;</span><span style=\"background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">&nbsp;</span><font face=\"Raleway, sans-serif\" style=\"color: hsl(var(--black)/0.8); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">Receiver Branch Name: {{receiver_branch_name}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Receiver Branch Address:&nbsp;</span><font face=\"Raleway, sans-serif\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{receiver_branch_address}}&nbsp;</font></font></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">Estimated Delivery Date: {{estimate_date}}&nbsp;</font><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Amount(</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{site_currency}}</font></span><span style=\"background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">):</span><font face=\"Raleway, sans-serif\" style=\"color: hsl(var(--black)/0.8); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp;</font><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">{{total_amount}}&nbsp; &nbsp; </font></span></p><p><span style=\"color: rgb(0, 0, 0); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif;\">Payment Status</span><span style=\"color: rgb(0, 0, 0); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif;\">:&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">{{payment_status}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span></p><p><span style=\"color: rgb(0, 0, 0); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif;\">Discount(%</span><span style=\"color: rgb(0, 0, 0); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif;\">):&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{status}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span><font color=\"rgba(0, 0, 0, 0.8)\" face=\"Raleway, sans-serif\" style=\"font-family: Raleway, sans-serif; text-align: var(--bs-body-text-align); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font><font color=\"rgba(0, 0, 0, 0.8)\" style=\"font-family: Raleway, sans-serif; text-align: var(--bs-body-text-align); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\"><span style=\"font-weight: var(--bs-body-font-weight);\">&nbsp;</span></font></p><p><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">Discount(%</span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">):</span><font face=\"Raleway, sans-serif\" style=\"color: hsl(var(--black)/0.8); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp;</font><span style=\"color: rgba(0, 0, 0, 0.8); text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">{{discount}}&nbsp;</font></span><span style=\"background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgba(0, 0, 0, 0.8);\"><font face=\"Raleway, sans-serif\"><br></font></span><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span><span style=\"background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgba(0, 0, 0, 0.8);\"><font face=\"Raleway, sans-serif\">&nbsp; &nbsp;</font></span><span style=\"color: hsl(var(--black)/0.8); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span><span style=\"color: hsl(var(--black)/0.8); background-color: ; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Raleway, sans-serif;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">We understand the importance of timely and secure delivery, and we assure you that your parcel is in good hands. You can track the status of your courier using the tracking number provided below:</font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\"><br></font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><span style=\"font-family: Raleway, sans-serif;\">Tracking Number: {{tracking_number}}&nbsp;&nbsp;</span><br><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\"><br></font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">To track your courier, please visit our website and enter your tracking number.</font><br><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\"><br></font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">Thank you for choosing our service. We appreciate your trust and look forward to serving you again.</font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\"><br></font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">Best regards,</font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\"><br></font><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><font face=\"Raleway, sans-serif\">{{site_name}}</font><br><p><br></p><p><br></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"line-height: inherit; vertical-align: top; width: 600px;\"></table><p></p><p></p><p></p>', 'Dear {{sender}}                                                                                    ,\r\n\r\nWe are pleased to inform you that your courier has been successfully picked. Below are the details of your courier:\r\n\r\n**Courier Details:**\r\n                                                                                                                                                                         \r\nInvoice Number: {{invoice_number}}                                                                                    \r\nPickup Branch Name: {{sender_branch_name}}       \r\nPickup Branch Address: {{sender_branch_address}}                                                                                                                                                                   \r\nReceiver Branch Name: {{receiver_branch_name}}                                                                                    \r\nReceiver Branch Address: {{receiver_branch_address}} \r\nEstimated Delivery Date: {{estimate_date}} \r\nAmount({{site_currency}}): {{total_amount}}   \r\nPayment Status: {{payment_status}}                                                                                                      \r\nDiscount(%): {{status}}                                                                                                                                                                        \r\nDiscount(%): {{discount}} \r\n                                                                                                                                                                                                                               \r\n\r\nWe understand the importance of timely and secure delivery, and we assure you that your parcel is in good hands. You can track the status of your courier using the tracking number provided below:\r\n\r\nTracking Number: {{tracking_number}}  \r\n\r\nTo track your courier, please visit our website and enter your tracking number.\r\n\r\nThank you for choosing our service. We appreciate your trust and look forward to serving you again.\r\n\r\nBest regards,\r\n\r\n{{site_name}}', '{\"sender\":\"Sender Name\", \"receiver\":\"Receiver Name\", \"sender_branch_name\":\"Sender Branch Name\", \"sender_branch_address\":\"Sender Branch Address\", \"receiver_branch_name\":\"Receiver Branch Name\", \"receiver_branch_address\":\"Receiver Branch Address\", \"sender_staff\":\"Sender Staff Name\", \"invoice_number\":\"Invoice Number\", \"tracking_number\":\"Tracking Number\", \"payment_status\":\"Payment status\", \"total_amount\":\"Total amount\", \"discount\":\"Discount amount\", \"status\":\"Courier Status\", \"estimate_date\":\"Estimate date\"}', 1, 1, '2021-11-03 12:00:00', '2024-05-23 12:49:55'),
(19, 'SENT_IN_QUEUE_RECEIVER', 'Sent in Queue (Receiver)', 'Your Courier has been picked successfully', '<p></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: hsl(var(--black)/0.8); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">We are pleased to inform you that your courier has been picked up from the sender and is on its way to you.</span><br></p><p><font face=\"Raleway, sans-serif\"><br></font></p><p><font face=\"Raleway, sans-serif\">**Courier Details:**</font></p><p><br></p><p><font face=\"Raleway, sans-serif\">Sender:&nbsp;</font><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">{{sender}}&nbsp; </font></span></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Tracking Number: {{tracking_number}}&nbsp;&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span></p><p><font face=\"Raleway, sans-serif\" style=\"color: rgb(0, 0, 0);\">Pickup Branch Name: {{sender_branch_name}}&nbsp; &nbsp; &nbsp; &nbsp;</font></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Pickup Branch Address:&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{sender_branch_address}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">&nbsp;&nbsp;</span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">&nbsp;</span><font face=\"Raleway, sans-serif\" style=\"color: hsl(var(--black)/0.8); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"width: 600px; line-height: inherit; vertical-align: top;\"></table><p><span style=\"color: rgb(0, 0, 0); font-family: Raleway, sans-serif;\">Receiver Branch Name: {{receiver_branch_name}}&nbsp;&nbsp;</span><br></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Receiver Branch Address:&nbsp;</span><font face=\"Raleway, sans-serif\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{receiver_branch_address}}&nbsp;</font></font></p><p><span style=\"color: rgb(0, 0, 0); font-family: Raleway, sans-serif;\">Estimated Delivery Date: {{estimate_date}}&nbsp;</span><font face=\"Raleway, sans-serif\"><font color=\"#000000\" face=\"Raleway, sans-serif\"><br></font></font></p><p><font face=\"Raleway, sans-serif\"><br></font></p><p><font face=\"Raleway, sans-serif\">You can track your courier using the tracking number provided above. For tracking, please visit our website.</font></p><p><font face=\"Raleway, sans-serif\"><br></font></p><p><font face=\"Raleway, sans-serif\">Thank you for choosing our service.</font></p><p><font face=\"Raleway, sans-serif\"><br></font></p><p><font face=\"Raleway, sans-serif\">Best regards,</font></p><p><font face=\"Raleway, sans-serif\"><br></font></p><p><span style=\"color: rgb(0, 0, 0); font-family: Raleway, sans-serif;\">{{site_name}}</span><br></p><p><br></p><p></p><p></p><p></p>', 'Dear {{receiver}}                                                                                    ,\r\n\r\nWe are pleased to inform you that your courier has been picked up from the sender and is on its way to you.\r\n\r\n**Courier Details:**\r\n\r\nSender: {{sender}} \r\n\r\nTracking Number: {{tracking_number}}                                                                                    \r\nPickup Branch Name: {{sender_branch_name}}       \r\nPickup Branch Address: {{sender_branch_address}}                                                                                                                                                                   \r\nReceiver Branch Name: {{receiver_branch_name}}  \r\nReceiver Branch Address: {{receiver_branch_address}} \r\nEstimated Delivery Date: {{estimate_date}} \r\n\r\nYou can track your courier using the tracking number provided above. For tracking, please visit our website.\r\n\r\nThank you for choosing our service.\r\n\r\nBest regards,\r\n\r\n{{site_name}}', '{\"sender\":\"Sender Name\", \"receiver\":\"Receiver Name\", \"sender_branch_name\":\"Sender Branch Name\", \"sender_branch_address\":\"Sender Branch Address\", \"receiver_branch_name\":\"Receiver Branch Name\", \"receiver_branch_address\":\"Receiver Branch Address\", \"sender_staff\":\"Sender Staff Name\", \"invoice_number\":\"Invoice Number\", \"tracking_number\":\"Tracking Number\", \"payment_status\":\"Payment status\", \"total_amount\":\"Total amount\", \"discount\":\"Discount amount\", \"status\":\"Courier Status\", \"estimate_date\":\"Estimate date\"}', 1, 1, '2021-11-03 12:00:00', '2024-05-23 13:43:02'),
(20, 'COURIER_DISPATCH', 'Courier Dispatched ', 'Your Courier has been sent successfully', '<p></p><p></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Your courier has been sent and is on its way.</font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\"><br></font></p><p><font face=\"Raleway, sans-serif\">Sender:&nbsp;</font><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">{{sender}}&nbsp;</font></span></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Tracking Number: {{tracking_number}}&nbsp;&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span></p><p><font face=\"Raleway, sans-serif\" style=\"color: rgb(0, 0, 0);\">Pickup Branch Name: {{sender_branch_name}}&nbsp; &nbsp; &nbsp; &nbsp;</font></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Pickup Branch Address:&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{sender_branch_address}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">&nbsp;&nbsp;</span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">&nbsp;</span><font face=\"Raleway, sans-serif\" style=\"color: hsl(var(--black)/0.8); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"width: 600px; line-height: inherit; vertical-align: top;\"></table><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">Receiver Branch Name: {{receiver_branch_name}}&nbsp;&nbsp;</span><br></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Receiver Branch Address:&nbsp;</span><font face=\"Raleway, sans-serif\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{receiver_branch_address}}&nbsp;</font></font></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">Estimated Delivery Date: {{estimate_date}}&nbsp;</span></p><p><br></p><p><span style=\"font-family: Raleway, sans-serif; color: rgba(0, 0, 0, 0.8);\">You can track your courier using the tracking number provided above. For tracking, please visit our website.</span><br></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\"><br></font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Thank you for using our service.</font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\"><br></font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Best regards,</font></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">{{site_name}}</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: Raleway, sans-serif;\"></span></p><p></p><p></p><p></p>', 'Dear {{receiver}}                                                                                    ,\r\n\r\nWe are pleased to inform you that your courier has been picked up from the sender and is on its way to you.\r\n\r\n**Courier Details:**\r\n\r\nSender: {{sender}} \r\n\r\nTracking Number: {{tracking_number}}                                                                                    \r\nPickup Branch Name: {{sender_branch_name}}       \r\nPickup Branch Address: {{sender_branch_address}}                                                                                                                                                                   \r\nReceiver Branch Name: {{receiver_branch_name}}  \r\nReceiver Branch Address: {{receiver_branch_address}} \r\nEstimated Delivery Date: {{estimate_date}} \r\n\r\nYou can track your courier using the tracking number provided above. For tracking and more details, please visit our [tracking page](#).\r\n\r\nThank you for choosing our service.\r\n\r\nBest regards,\r\n\r\n{{site_name}}', '{\"sender\":\"Sender Name\", \"receiver\":\"Receiver Name\", \"sender_branch_name\":\"Sender Branch Name\", \"sender_branch_address\":\"Sender Branch Address\", \"receiver_branch_name\":\"Receiver Branch Name\", \"receiver_branch_address\":\"Receiver Branch Address\", \"sender_staff\":\"Sender Staff Name\", \"invoice_number\":\"Invoice Number\", \"tracking_number\":\"Tracking Number\", \"payment_status\":\"Payment status\", \"total_amount\":\"Total amount\", \"discount\":\"Discount amount\", \"status\":\"Courier Status\", \"estimate_date\":\"Estimate date\"}', 1, 1, '2021-11-03 12:00:00', '2024-05-23 13:42:02'),
(21, 'COURIER_RECEIVED', 'Courier Received', 'Your Courier Has Arrived at the Destination Branch', '<p></p><p></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Your Courier has been received to {{receiver_branch_name}}&nbsp; &nbsp; &nbsp;</font><br></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\"><br></font></p><p><font face=\"Raleway, sans-serif\">Sender:&nbsp;</font><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">{{sender}}&nbsp;</font></span></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Tracking Number: {{tracking_number}}&nbsp;&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span></p><p><font face=\"Raleway, sans-serif\" style=\"color: rgb(0, 0, 0);\">Pickup Branch Name: {{sender_branch_name}}&nbsp; &nbsp; &nbsp; &nbsp;</font></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Pickup Branch Address:&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{sender_branch_address}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">&nbsp;&nbsp;</span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">&nbsp;</span><font face=\"Raleway, sans-serif\" style=\"color: hsl(var(--black)/0.8); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"width: 600px; line-height: inherit; vertical-align: top;\"></table><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">Receiver Branch Name: {{receiver_branch_name}}&nbsp;&nbsp;</span><br></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Receiver Branch Address:&nbsp;</span><font face=\"Raleway, sans-serif\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{receiver_branch_address}}&nbsp;</font></font></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">Estimated Delivery Date: {{estimate_date}}&nbsp;</span></p><p><br></p><p><span style=\"font-family: Raleway, sans-serif; color: rgba(0, 0, 0, 0.8);\">You can track your courier using the tracking number provided above. For tracking, please visit our website.</span><br></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\"><br></font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Thank you for using our service.</font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\"><br></font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Best regards,</font></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">{{site_name}}</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: Raleway, sans-serif;\"></span></p><p></p><p></p><p></p>', 'Your Courier has been received to {{receiver_branch_name}}     \r\n\r\n\r\n\r\nSender: {{sender}} \r\n\r\nTracking Number: {{tracking_number}}                                                                                    \r\n\r\nPickup Branch Name: {{sender_branch_name}}       \r\n\r\nPickup Branch Address: {{sender_branch_address}}                                                                                                                                                                   \r\n\r\nReceiver Branch Name: {{receiver_branch_name}}  \r\n\r\nReceiver Branch Address: {{receiver_branch_address}} \r\n\r\nEstimated Delivery Date: {{estimate_date}} \r\n\r\n\r\n\r\nYou can track your courier using the tracking number provided above. For tracking, please visit our website.\r\n\r\n\r\n\r\nThank you for using our service.\r\n\r\n\r\n\r\nBest regards,\r\n\r\n{{site_name}}', '{\"sender\":\"Sender Name\", \"receiver\":\"Receiver Name\", \"sender_branch_name\":\"Sender Branch Name\", \"sender_branch_address\":\"Sender Branch Address\", \"receiver_branch_name\":\"Receiver Branch Name\", \"receiver_branch_address\":\"Receiver Branch Address\", \"sender_staff\":\"Sender Staff Name\", \"invoice_number\":\"Invoice Number\", \"tracking_number\":\"Tracking Number\", \"payment_status\":\"Payment status\", \"total_amount\":\"Total amount\", \"discount\":\"Discount amount\", \"status\":\"Courier Status\", \"estimate_date\":\"Estimate date\"}', 1, 1, '2021-11-03 12:00:00', '2024-05-23 13:57:03'),
(22, 'COURIER_DELIVERED', 'Courier Delivered', 'Your Courier Has Been Delivered', '<p></p><p></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Your Courier has been delivered&nbsp;</font><br></p><p><br></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Tracking Number: {{tracking_number}}&nbsp;&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font face=\"Raleway, sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span></p><p><font face=\"Raleway, sans-serif\" style=\"color: rgb(0, 0, 0);\">Pickup Branch Name: {{sender_branch_name}}&nbsp; &nbsp; &nbsp; &nbsp;</font></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Pickup Branch Address:&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{sender_branch_address}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">&nbsp;&nbsp;</span><span style=\"font-family: Raleway, sans-serif; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); color: rgb(0, 0, 0);\">&nbsp;</span><font face=\"Raleway, sans-serif\" style=\"color: hsl(var(--black)/0.8); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></p><table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"width: 600px; line-height: inherit; vertical-align: top;\"></table><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">Receiver Branch Name: {{receiver_branch_name}}&nbsp;&nbsp;</span><br></p><p></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Receiver Branch Address:&nbsp;</span><font face=\"Raleway, sans-serif\"><font color=\"#000000\" face=\"Raleway, sans-serif\">{{receiver_branch_address}}&nbsp;</font></font></p><p><br></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Thank you for using our service.</font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\"><br></font></p><p><font color=\"#000000\" face=\"Raleway, sans-serif\">Best regards,</font></p><p><span style=\"font-family: Raleway, sans-serif; color: rgb(0, 0, 0);\">{{site_name}}</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: Raleway, sans-serif;\"></span></p><p></p><p></p><p></p>', 'Your Courier has been delivered \r\n\r\n\r\n\r\nTracking Number: {{tracking_number}}                                                                                    \r\n\r\nPickup Branch Name: {{sender_branch_name}}       \r\n\r\nPickup Branch Address: {{sender_branch_address}}                                                                                                                                                                   \r\n\r\nReceiver Branch Name: {{receiver_branch_name}}  \r\n\r\nReceiver Branch Address: {{receiver_branch_address}} \r\n\r\n\r\n\r\nThank you for using our service.\r\n\r\n\r\n\r\nBest regards,\r\n\r\n{{site_name}}', '{\"sender\":\"Sender Name\", \"receiver\":\"Receiver Name\", \"sender_branch_name\":\"Sender Branch Name\", \"sender_branch_address\":\"Sender Branch Address\", \"receiver_branch_name\":\"Receiver Branch Name\", \"receiver_branch_address\":\"Receiver Branch Address\", \"sender_staff\":\"Sender Staff Name\", \"invoice_number\":\"Invoice Number\", \"tracking_number\":\"Tracking Number\", \"payment_status\":\"Payment status\", \"total_amount\":\"Total amount\", \"discount\":\"Discount amount\", \"status\":\"Courier Status\", \"estimate_date\":\"Estimate date\"}', 1, 1, '2021-11-03 12:00:00', '2024-05-23 14:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `header_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 => Show , 0 => Hide',
  `footer_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 => Show , 0 => Hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `header_status`, `footer_status`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 'templates.basic.', '[\"banner\",\"about\",\"how_it_works\",\"counter\",\"service\",\"team\",\"custom_quote\",\"branches\",\"faq\",\"testimonial\",\"blog\",\"coverage\"]', 1, 1, 0, '2020-07-11 06:23:58', '2024-05-28 10:43:53'),
(2, 'About', 'about', 'templates.basic.', '[\"about\"]', 1, 1, 0, '2024-05-28 10:21:10', '2024-05-28 10:21:25'),
(3, 'Contact Us', 'contact', 'templates.basic.', '[\"about\",\"blog\"]', 1, 1, 1, '2020-10-22 01:14:53', '2024-05-22 05:45:57'),
(4, 'Tracking', 'tracking', 'templates.basic.', NULL, 1, 1, 0, '2024-05-17 01:32:01', '2024-05-22 06:23:52'),
(5, 'Blog', 'blog', 'templates.basic.', NULL, 1, 1, 1, '2020-10-22 01:14:43', '2024-05-22 05:59:51'),
(15, 'Team', 'team', 'templates.basic.', '[\"team\"]', 0, 1, 1, '2024-05-17 01:32:43', '2024-05-17 02:55:46'),
(16, 'Faq', 'faq', 'templates.basic.', '[\"faq\"]', 0, 1, 1, '2024-05-17 01:32:50', '2024-05-17 02:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` bigint NOT NULL,
  `courier_id` bigint DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `title` text,
  `price` decimal(28,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_plugins.png', '<script>\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\n                        (function(){\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\n                        s1.async=true;\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\n                        s1.charset=\"UTF-8\";\n                        s1.setAttribute(\"crossorigin\",\"*\");\n                        s0.parentNode.insertBefore(s1,s0);\n                        })();\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, '2019-10-18 23:16:05', '2022-03-22 05:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha_plugins.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, '2019-10-18 23:16:05', '2022-05-24 11:35:09'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'custom_captch_plugins.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 23:16:05', '2024-05-29 07:18:00'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics_plugins.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 1, NULL, '2024-04-23 13:26:34'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, '2022-03-22 05:18:36'),
(6, 'messenger', 'Messenger', 'Key location is shown bellow', 'messenger.png', '<div id=\"fb-root\"></div>\r\n<div class=\"fb-customerchat\"\r\n     attribution=\"setup_tool\"\r\n     page_id=\"{{page_id}}\"\r\n     theme_color=\"#0084FF\"\r\n     logged_in_greeting=\"{{logged_in_greeting}}\">\r\n</div>\r\n<script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId={{app_id}}&autoLogAppEvents=1\" nonce=\"sXX5A6Md\"></script>', '{\"app_id\":{\"title\":\"App Id\",\"value\":\"ddddddddddddddd\"},\"page_id\":{\"title\":\"Page Id\",\"value\":\"fffffffffffffffff\"},\"logged_in_greeting\":{\"title\":\"Logged in greeting\",\"value\":\"eeeeeeeeeeeeeeeeeeee\"}}', 'fb_com.PNG', 0, '2024-05-07 17:56:18', '2024-05-07 17:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oj3QdP84wujIBBjGkSTTmoELgD1cpMt8lsHpMQ1c', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSzJuRDVUYVpvSFBNd1JVYWM1QWRVV3duY0xtZnk5SmpWVjZ3c0ZyMCI7czo0OiJsYW5nIjtzOjI6ImVuIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1NzoiaHR0cDovL2xvY2FsaG9zdC9zd2l0Y2gtY291cmllci9wbGFjZWhvbGRlci1pbWFnZS80MDB4NDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1717249686);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `global_shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `multi_language` tinyint(1) NOT NULL DEFAULT '1',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_cron` datetime DEFAULT NULL,
  `system_customized` tinyint(1) NOT NULL DEFAULT '0',
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date_format` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_body`, `sms_from`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `force_ssl`, `maintenance_mode`, `secure_password`, `agree`, `multi_language`, `registration`, `active_template`, `system_info`, `last_cron`, `system_customized`, `image`, `date_format`, `created_at`, `updated_at`) VALUES
(1, 'CarryMan', 'USD', '$', 'info@caryman.com', '<!--[if gte mso 9]>\r\n<xml>\r\n  <o:OfficeDocumentSettings>\r\n    <o:AllowPNG/>\r\n    <o:PixelsPerInch>96</o:PixelsPerInch>\r\n  </o:OfficeDocumentSettings>\r\n</xml>\r\n<![endif]-->\r\n  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <meta name=\"x-apple-disable-message-reformatting\">\r\n  <!--[if !mso]><!--><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><!--<![endif]-->\r\n  <title></title>\r\n  \r\n    <style type=\"text/css\">\r\n      @media only screen and (min-width: 620px) {\r\n  .u-row {\r\n    width: 600px !important;\r\n  }\r\n  .u-row .u-col {\r\n    vertical-align: top;\r\n  }\r\n\r\n  .u-row .u-col-100 {\r\n    width: 600px !important;\r\n  }\r\n\r\n}\r\n\r\n@media (max-width: 620px) {\r\n  .u-row-container {\r\n    max-width: 100% !important;\r\n    padding-left: 0px !important;\r\n    padding-right: 0px !important;\r\n  }\r\n  .u-row .u-col {\r\n    min-width: 320px !important;\r\n    max-width: 100% !important;\r\n    display: block !important;\r\n  }\r\n  .u-row {\r\n    width: 100% !important;\r\n  }\r\n  .u-col {\r\n    width: 100% !important;\r\n  }\r\n  .u-col > div {\r\n    margin: 0 auto;\r\n  }\r\n}\r\nbody {\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\n\r\ntable,\r\ntr,\r\ntd {\r\n  vertical-align: top;\r\n  border-collapse: collapse;\r\n}\r\n\r\np {\r\n  margin: 0;\r\n}\r\n\r\n.ie-container table,\r\n.mso-container table {\r\n  table-layout: fixed;\r\n}\r\n\r\n* {\r\n  line-height: inherit;\r\n}\r\n\r\na[x-apple-data-detectors=\'true\'] {\r\n  color: inherit !important;\r\n  text-decoration: none !important;\r\n}\r\n\r\ntable, td { color: #000000; } @media (max-width: 480px) { #u_content_heading_1 .v-container-padding-padding { padding: 20px 10px 0px !important; } #u_content_heading_1 .v-font-size { font-size: 30px !important; } #u_content_text_1 .v-container-padding-padding { padding: 10px !important; } }\r\n    </style>\r\n  \r\n  \r\n\r\n<!--[if !mso]><!--><link href=\"https://fonts.googleapis.com/css?family=Raleway:400,700&amp;display=swap\" rel=\"stylesheet\" type=\"text/css\"><link href=\"https://fonts.googleapis.com/css2?family=Federo&amp;display=swap\" rel=\"stylesheet\" type=\"text/css\"><!--<![endif]-->\r\n\r\n\r\n\r\n\r\n  <!--[if IE]><div class=\"ie-container\"><![endif]-->\r\n  <!--[if mso]><div class=\"mso-container\"><![endif]-->\r\n  <table style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #e7e7e7;width:100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n  <tbody>\r\n  <tr style=\"vertical-align: top\">\r\n    <td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">\r\n    <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td align=\"center\" style=\"background-color: #e7e7e7;\"><![endif]-->\r\n    \r\n  \r\n  \r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">\r\n      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: transparent;\"><![endif]-->\r\n      \r\n<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"background-color: #ffffff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->\r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #ffffff;height: 100%;width: 100% !important;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->\r\n  \r\n<table style=\"font-family:\'Raleway\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:\'Raleway\',sans-serif;\" align=\"left\">\r\n        \r\n<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n  <tbody><tr>\r\n    <td style=\"padding-right: 0px;padding-left: 0px;\" align=\"center\">\r\n      \r\n      <img align=\"middle\" border=\"0\" src=\"https://ui-library-jet.vercel.app/assets/images/common/image-2.png\" alt=\"\" title=\"\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;\" width=\"600\">\r\n      \r\n    </td>\r\n  </tr>\r\n</tbody></table>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table style=\"font-family:\'Raleway\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Raleway\',sans-serif;\" align=\"left\">\r\n        \r\n<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n  <tbody><tr>\r\n    <td style=\"padding-right: 0px;padding-left: 0px;\" align=\"center\">\r\n      \r\n      <img align=\"middle\" border=\"0\" src=\"https://ui-library-jet.vercel.app/assets/images/common/email-img.png\" alt=\"\" title=\"\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 43px;\" width=\"43\">\r\n      \r\n    </td>\r\n  </tr>\r\n</tbody></table>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_heading_1\" style=\"font-family:\'Raleway\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:31px;font-family:\'Raleway\',sans-serif;\" align=\"left\">\r\n        \r\n  <!--[if mso]><table width=\"100%\"><tr><td><![endif]-->\r\n    <h1 class=\"v-font-size\" style=\"margin: 0px; color: #000000; line-height: 90%; text-align: center; word-wrap: break-word; font-family: Federo; font-size: 24px; font-weight: 400;\"><span><span style=\"line-height: 36px;\"><span style=\"line-height: 36px;\"><span style=\"line-height: 36px;\"><u>System Generated Email</u></span></span></span></span></h1><h1 class=\"v-font-size\" style=\"margin: 0px; color: #000000; line-height: 90%; text-align: center; word-wrap: break-word; font-family: Federo; font-size: 24px; font-weight: 400;\"><p style=\"line-height: 19.6px; font-size: 14px; text-align: left;\"><br></p></h1><h2 style=\"line-height: 19.6px; font-size: 14px; text-align: left;\">Hi {{fullname}} ({{username}}),</h2><p style=\"line-height: 19.6px; font-size: 14px; text-align: left;\">{{message}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <br></p>\r\n  <!--[if mso]></td></tr></table><![endif]-->\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<br><br>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n  </div>\r\n  \r\n\r\n\r\n    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->\r\n    </td>\r\n  </tr>\r\n  </tbody>\r\n  </table>\r\n  <!--[if mso]></div><![endif]-->\r\n  <!--[if IE]></div><![endif]-->', 'hi {{fullname}} ({{username}}), {{message}}', 'Cary Man', 'df2a2a', 'fb2a2a', '{\"name\":\"php\"}', '{\"name\":\"twilio\",\"message_bird\":{\"api_key\":\"-----------------------\"},\"nexmo\":{\"api_key\":\"-----------------------\",\"api_secret\":\"------------------\"},\"twilio\":{\"account_sid\":\"---------------------\",\"auth_token\":\"-----------------\",\"from\":\"------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 'basic', '[]', '2024-04-30 20:13:13', 0, '{\"logo\":\"66586bc9464711717070793.png\",\"favicon\":\"665845a00a8651717061024.png\"}', 'yyyy-mm-dd', NULL, '2024-05-30 11:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint NOT NULL,
  `branch_id` int DEFAULT NULL,
  `manager_id` int DEFAULT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` text,
  `username` varchar(40) DEFAULT NULL,
  `mobile` text,
  `address` text,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` text,
  `password` text,
  `remember_token` text,
  `status` tinyint DEFAULT NULL COMMENT '0 => Disabled, 1 => Enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_password_resets`
--

CREATE TABLE `staff_password_resets` (
  `id` bigint NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `support_message_id` int UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `support_ticket_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `manager_id` int DEFAULT '0',
  `staff_id` int DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `unit_id` int DEFAULT NULL,
  `price` decimal(28,2) DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT '0 => disabled, 1 => Enabled	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT '0 => disabled, 1 => Enabled	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint UNSIGNED NOT NULL,
  `manager_id` int UNSIGNED NOT NULL DEFAULT '0',
  `staff_id` int DEFAULT '0',
  `user_ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_desks`
--
ALTER TABLE `help_desks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager_password_resets`
--
ALTER TABLE `manager_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_password_resets`
--
ALTER TABLE `staff_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `help_desks`
--
ALTER TABLE `help_desks`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager_password_resets`
--
ALTER TABLE `manager_password_resets`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_password_resets`
--
ALTER TABLE `staff_password_resets`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
