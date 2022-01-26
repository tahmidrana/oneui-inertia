-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2022 at 11:36 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_oneui_inertia`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bn_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES
(1, 'Comilla', 'কুমিল্লা', NULL, NULL),
(2, 'Feni', 'ফেনী', NULL, NULL),
(3, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', NULL, NULL),
(4, 'Rangamati', 'রাঙ্গামাটি', NULL, NULL),
(5, 'Noakhali', 'নোয়াখালী', NULL, NULL),
(6, 'Chandpur', 'চাঁদপুর', NULL, NULL),
(7, 'Lakshmipur', 'লক্ষ্মীপুর', NULL, NULL),
(8, 'Chittagong', 'চট্টগ্রাম', NULL, NULL),
(9, 'Coxsbazar', 'কক্সবাজার', NULL, NULL),
(10, 'Khagrachhari', 'খাগড়াছড়ি', NULL, NULL),
(11, 'Bandarban', 'বান্দরবান', NULL, NULL),
(12, 'Sirajganj', 'সিরাজগঞ্জ', NULL, NULL),
(13, 'Pabna', 'পাবনা', NULL, NULL),
(14, 'Bogra', 'বগুড়া', NULL, NULL),
(15, 'Rajshahi', 'রাজশাহী', NULL, NULL),
(16, 'Natore', 'নাটোর', NULL, NULL),
(17, 'Joypurhat', 'জয়পুরহাট', NULL, NULL),
(18, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', NULL, NULL),
(19, 'Naogaon', 'নওগাঁ', NULL, NULL),
(20, 'Jessore', 'যশোর', NULL, NULL),
(21, 'Satkhira', 'সাতক্ষীরা', NULL, NULL),
(22, 'Meherpur', 'মেহেরপুর', NULL, NULL),
(23, 'Narail', 'নড়াইল', NULL, NULL),
(24, 'Chuadanga', 'চুয়াডাঙ্গা', NULL, NULL),
(25, 'Kushtia', 'কুষ্টিয়া', NULL, NULL),
(26, 'Magura', 'মাগুরা', NULL, NULL),
(27, 'Khulna', 'খুলনা', NULL, NULL),
(28, 'Bagerhat', 'বাগেরহাট', NULL, NULL),
(29, 'Jhenaidah', 'ঝিনাইদহ', NULL, NULL),
(30, 'Jhalakathi', 'ঝালকাঠি', NULL, NULL),
(31, 'Patuakhali', 'পটুয়াখালী', NULL, NULL),
(32, 'Pirojpur', 'পিরোজপুর', NULL, NULL),
(33, 'Barisal', 'বরিশাল', NULL, NULL),
(34, 'Bhola', 'ভোলা', NULL, NULL),
(35, 'Barguna', 'বরগুনা', NULL, NULL),
(36, 'Sylhet', 'সিলেট', NULL, NULL),
(37, 'Moulvibazar', 'মৌলভীবাজার', NULL, NULL),
(38, 'Habiganj', 'হবিগঞ্জ', NULL, NULL),
(39, 'Sunamganj', 'সুনামগঞ্জ', NULL, NULL),
(40, 'Narsingdi', 'নরসিংদী', NULL, NULL),
(41, 'Gazipur', 'গাজীপুর', NULL, NULL),
(42, 'Shariatpur', 'শরীয়তপুর', NULL, NULL),
(43, 'Narayanganj', 'নারায়ণগঞ্জ', NULL, NULL),
(44, 'Tangail', 'টাঙ্গাইল', NULL, NULL),
(45, 'Kishoreganj', 'কিশোরগঞ্জ', NULL, NULL),
(46, 'Manikganj', 'মানিকগঞ্জ', NULL, NULL),
(47, 'Dhaka', 'ঢাকা', NULL, NULL),
(48, 'Munshiganj', 'মুন্সিগঞ্জ', NULL, NULL),
(49, 'Rajbari', 'রাজবাড়ী', NULL, NULL),
(50, 'Madaripur', 'মাদারীপুর', NULL, NULL),
(51, 'Gopalganj', 'গোপালগঞ্জ', NULL, NULL),
(52, 'Faridpur', 'ফরিদপুর', NULL, NULL),
(53, 'Panchagarh', 'পঞ্চগড়', NULL, NULL),
(54, 'Dinajpur', 'দিনাজপুর', NULL, NULL),
(55, 'Lalmonirhat', 'লালমনিরহাট', NULL, NULL),
(56, 'Nilphamari', 'নীলফামারী', NULL, NULL),
(57, 'Gaibandha', 'গাইবান্ধা', NULL, NULL),
(58, 'Thakurgaon', 'ঠাকুরগাঁও', NULL, NULL),
(59, 'Rangpur', 'রংপুর', NULL, NULL),
(60, 'Kurigram', 'কুড়িগ্রাম', NULL, NULL),
(61, 'Sherpur', 'শেরপুর', NULL, NULL),
(62, 'Mymensingh', 'ময়মনসিংহ', NULL, NULL),
(63, 'Jamalpur', 'জামালপুর', NULL, NULL),
(64, 'Netrokona', 'নেত্রকোণা', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_order` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `parent_menu_id` smallint(5) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `route_name`, `menu_url`, `menu_icon`, `menu_order`, `parent_menu_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard.index', NULL, 'speedometer', 1, NULL, 1, '2021-03-08 07:02:21', '2021-03-08 07:02:21'),
(2, 'Users', 'users.index', NULL, 'users', 10, NULL, 1, NULL, NULL),
(3, 'Add New User', 'users.create', NULL, NULL, 1, 2, 1, NULL, NULL),
(4, 'Manage Users', 'users.index', NULL, NULL, 2, 2, 1, '2021-03-08 07:30:56', '2021-03-08 07:30:56'),
(5, 'Admin Console', NULL, NULL, 'lock', 100, NULL, 1, '2021-03-09 05:16:49', '2021-04-20 07:01:22'),
(6, 'Menu', 'menus.index', NULL, NULL, 2, 5, 1, NULL, '2021-03-16 04:51:43'),
(7, 'User Types', 'user-types.index', NULL, NULL, 1, 5, 1, NULL, '2021-03-09 02:48:59'),
(8, 'Permissions', 'permissions.index', NULL, NULL, 3, 5, 1, NULL, NULL),
(17, 'Settings', NULL, NULL, 'wrench', 50, NULL, 1, '2021-03-16 05:25:28', '2021-03-16 05:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL,
  `menu_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1327, 1, 1, NULL, NULL),
(1328, 1, 2, NULL, NULL),
(1329, 1, 3, NULL, NULL),
(1330, 1, 4, NULL, NULL),
(1331, 1, 17, NULL, NULL),
(1332, 1, 5, NULL, NULL),
(1333, 1, 7, NULL, NULL),
(1334, 1, 6, NULL, NULL),
(1335, 1, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_08_054341_create_roles_table', 2),
(6, '2021_03_08_060516_create_role_user_table', 3),
(8, '2021_03_08_060744_create_permissions_table', 4),
(9, '2021_03_08_061229_create_permission_role_table', 5),
(10, '2021_03_08_061449_create_menus_table', 6),
(11, '2021_03_08_061623_create_menu_role_table', 7),
(13, '2021_03_08_061752_create_districts_table', 8),
(124, '2021_03_10_043926_add_last_login_to_users', 9),
(125, '2022_01_26_170846_create_notifications_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'user-create', 'create-user', '2021-03-09 01:17:05', '2021-03-28 11:24:40'),
(3, 'user-update', 'update-user', '2021-03-09 01:21:42', '2021-03-28 11:24:48'),
(4, 'user-delete', 'delete-user', '2021-03-09 01:21:48', '2021-03-28 11:25:05'),
(5, 'assign-client-to-clinician', 'assign-client-to-clinician', '2021-03-24 06:00:51', '2021-03-24 06:00:51'),
(6, 'approval.assign-client-to-clinician', 'approvalassign-client-to-clinician', '2021-03-24 06:01:45', '2021-03-24 06:01:45'),
(7, 'release-client-clinician', 'release-client-clinician', '2021-03-24 10:05:59', '2021-03-24 10:06:03'),
(8, 'approval.release-client-clinician', 'approvalrelease-client-clinician', '2021-03-24 10:06:10', '2021-03-24 10:06:10'),
(9, 'client-create', 'add-individual-client', '2021-03-28 11:11:39', '2021-03-28 11:22:49'),
(10, 'client-update', 'update-individual-client', '2021-03-28 11:11:52', '2021-03-28 11:22:56'),
(11, 'client-activation', 'clientindividual-client-activation', '2021-03-28 11:13:31', '2021-03-28 11:22:44'),
(12, 'client-view', 'clientview-individual-client', '2021-03-28 11:14:46', '2021-03-28 11:23:02'),
(13, 'corporate-add', 'corporateadd', '2021-03-28 11:16:34', '2021-03-28 11:21:57'),
(14, 'corporate-update', 'corporateupdate', '2021-03-28 11:16:40', '2021-03-28 11:22:34'),
(15, 'corporate-activation', 'corporateactivation', '2021-03-28 11:16:55', '2021-03-28 11:21:47'),
(16, 'corporate-view', 'corporateview', '2021-03-28 11:17:33', '2021-03-28 11:21:38'),
(17, 'corporate-add-discount-policy', 'corporateadd-discount-policy', '2021-03-28 11:17:55', '2021-03-28 11:22:13'),
(18, 'corporate-update-discount-policy', 'corporateupdate-discount-policy', '2021-03-28 11:18:06', '2021-03-28 11:22:23'),
(19, 'clinician-add', 'clinicianadd', '2021-03-28 11:19:00', '2021-12-19 05:21:14'),
(20, 'clinician-update', 'clinicianupdate', '2021-03-28 11:19:08', '2021-03-28 11:23:29'),
(21, 'clinician-activation', 'clinicianactivation', '2021-03-28 11:20:12', '2021-03-28 11:23:10'),
(22, 'clinician-password-reset', 'clinicianpassword-reset', '2021-03-28 11:20:26', '2021-03-28 11:23:20'),
(23, 'clinician-view', 'clinicianview', '2021-03-28 11:20:39', '2021-03-28 11:23:39'),
(24, 'user-activation', 'user-actiavtion', '2021-03-28 11:24:31', '2021-04-18 09:23:00'),
(25, 'user-password-reset', 'user-password-reset', '2021-03-28 11:25:17', '2021-03-28 11:25:17'),
(26, 'user-view', 'user-view', '2021-03-28 11:25:33', '2021-03-28 11:25:33'),
(27, 'client-upload-attachment', 'client-upload-attachment', '2021-04-01 09:44:24', '2021-04-01 09:44:24'),
(28, 'view-session-invitations', 'view-session-invitations', '2021-08-03 10:56:33', '2021-08-03 10:56:33'),
(29, 'show-session-invitations-detail', 'show-session-invitations-detail', '2021-08-03 10:57:12', '2021-08-03 10:57:12'),
(30, 'Md. Rahul Hossan', 'md-rahul-hossan', '2021-12-15 07:29:35', '2021-12-15 07:29:35'),
(31, 'nonclinical-sessions-create', 'nonclinical-sessions-create', '2022-01-24 04:19:22', '2022-01-24 04:19:22'),
(32, 'clinical-sessions-create', 'clinical-sessions-create', '2022-01-24 04:19:32', '2022-01-24 04:19:32'),
(33, 'client-delete', 'client-delete', '2022-01-24 10:48:06', '2022-01-24 10:48:06'),
(34, 'corporate-client-delete', 'corporate-client-delete', '2022-01-24 10:48:17', '2022-01-24 10:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(457, 34, 1),
(458, 33, 1),
(459, 32, 1),
(460, 31, 1),
(461, 29, 1),
(462, 28, 1),
(463, 27, 1),
(464, 26, 1),
(465, 25, 1),
(466, 24, 1),
(467, 23, 1),
(468, 22, 1),
(469, 21, 1),
(470, 20, 1),
(471, 19, 1),
(472, 18, 1),
(473, 17, 1),
(474, 16, 1),
(475, 15, 1),
(476, 14, 1),
(477, 13, 1),
(478, 12, 1),
(479, 11, 1),
(480, 10, 1),
(481, 9, 1),
(482, 8, 1),
(483, 7, 1),
(484, 6, 1),
(485, 5, 1),
(486, 4, 1),
(487, 3, 1),
(488, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 1, '2021-03-08 08:57:18', '2021-03-08 08:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, '2021-03-08 04:31:18', '2021-03-08 04:31:18'),
(6, 10, 1, 1, '2021-03-09 04:18:18', '2021-03-09 04:18:18'),
(56, 26, 1, 0, '2021-08-11 02:24:30', '2021-08-11 02:24:30'),
(64, 28, 1, 1, '2021-09-08 05:00:02', '2021-09-08 05:00:02'),
(75, 38, 1, 1, '2021-09-21 04:30:04', '2021-09-21 04:30:04'),
(97, 33, 1, 0, '2021-09-21 06:02:07', '2021-09-21 06:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '1 - Male, 2 - Female, 3 - Other',
  `dob` date DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `employment_type` smallint(5) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 - Permanent, 2 - Part time, 3 - Contractual',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_superuser` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `userid`, `email`, `gender`, `dob`, `blood_group`, `address`, `phone`, `photo`, `joining_date`, `employment_type`, `is_active`, `is_superuser`, `email_verified_at`, `password`, `remember_token`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', 'superadmin@example.com', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-08', 1, 1, 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2022-01-26 11:28:16', '2021-03-08 05:25:51', '2022-01-26 11:28:16'),
(2, 'Tahmidur Rahman', '5224', 'tahmidrana@gmail.com', 1, '2021-02-25', '1', 'abc def', '01676470847', NULL, NULL, 1, 0, 0, NULL, '$2y$10$S0Ajp53ChBbRSFLOjYWj5.OfqlSeE.l6jYVr9bgLrkpdZJhQNroKa', NULL, NULL, '2021-03-08 04:13:57', '2021-09-21 04:23:26'),
(3, 'John Doe', '1259', 'tahmidrana@gmail.com', 1, '2021-03-06', '1', 'abc def', '01676470847', NULL, '2021-03-13', 1, 0, 0, NULL, '$2y$10$WqU6E0eguMqKdroblo3uzO26S4WjEDS3VZS9DC61LjHjZagILiR.e', NULL, NULL, '2021-03-08 04:18:25', '2021-09-21 04:23:21'),
(4, 'Ariful Islam', 'SF5221', 'tahmidrana@gmail.com', 1, '2021-02-24', '1', 'abc def', '01676470847', NULL, '2021-03-24', 1, 0, 0, NULL, '$2y$10$oU3U3ELsh65w/ch2cfwMkOo2glWGARi5c5WABBtZhwEn9eS7ZwOGG', NULL, NULL, '2021-03-08 04:23:13', '2021-09-21 04:23:30'),
(6, 'Steve Smith', 'SF8546', 'steve@gmail.com', 1, '2021-03-10', '1', 'abc def', '01676470849', NULL, '2021-03-26', 1, 0, 0, NULL, '$2y$10$5GK/DIzzL.sKF3L/DFxpv.xgOwvX.Fzna6aotOFINOtyBeG7izVby', NULL, NULL, '2021-03-08 04:31:18', '2021-09-21 04:23:34'),
(7, 'Maxwell', '12598', 'steve@gmail.com', 1, '2021-03-05', '1', 'abc def', '01676470849', 'images/users/3NqwXKWSKBGRxCZgPKIgum0LmU6ALUEpqjSeSPfP.jpg', '2021-03-14', 1, 0, 0, NULL, '$2y$10$zRoCjzAKrDDnN9QNm17V4.WI0gIBx/OcTtcbND465BuStC9qeRLA6', NULL, NULL, '2021-03-08 04:53:00', '2021-09-21 04:23:14'),
(10, 'Admin', 'admin', 'admin@example.com', 1, '2021-02-22', '1', '-', '01555555555', NULL, NULL, 1, 1, 0, NULL, '$2y$10$lnHvBx.NHPjjTPz/GOOBjeWAkLTLp7NX2un7mPOpwLLqC8/XdE4Tu', 'saCaKj0ACsnEMnGqPrxPAK9eqHXeWE48DviOio2rgnf0fb76BMtdIIKu9GyE', NULL, '2021-03-09 04:18:18', '2022-01-26 09:08:43'),
(11, 'Jen Doe', 'SF85467', 'jendoe@gmail.com', 1, '2000-02-02', '1', '-', '01676470849', NULL, '2021-02-25', 1, 0, 0, NULL, '$2y$10$3SraQz8Ew8OStAWOn45Z/OA2HOLTv1vNFtYCgBwE4MHYcXAYLFYdS', NULL, NULL, '2021-03-10 10:36:29', '2021-09-21 04:45:14'),
(12, 'Rashedul Islam', 'SF983', 'ras@gmail.com', 1, '1998-03-05', '1', '23/A, Banani', '01555555555', NULL, NULL, 1, 0, 0, NULL, '$2y$10$3YqhmofF.cwl0qFJcQcMf.Ibal9.WAl3ut1tZ4a.4ZZWuscOtw7o2', NULL, NULL, '2021-03-10 11:27:44', '2021-09-21 04:45:10'),
(16, 'MD Ariful Haque', 'SF8547', 'ar@abc.com', 1, '1989-07-06', '4', '23/A, Banani', '0111111111', 'images/clinician/photo/3d8WvqORYgxeE5gyCb6N9PUkXv5ZXPbXHoMxooma.jpg', '2021-03-27', 2, 1, 0, NULL, '$2y$10$FWZ/Z8Gy83SSZwpr.TH2CeQe7lYgvV/BQaF7HEedWbGsih.X/M0Ge', NULL, NULL, '2021-03-11 04:49:42', '2022-01-16 08:24:37'),
(17, 'Courtney Shaffer', 'SF7669', 'mynomod@mailinator.com', 1, '1999-03-12', '1', 'Incididunt autem ips', '+1 (811) 898-6889', 'images/users/xuQAoAl7SwALIJDrvsaeQByrwl7NycjQ1jwPthaP.jpg', '2002-03-24', 1, 0, 0, NULL, '$2y$10$BVGrt8OUBL02ZO49kF5Sr.TlQ12nNEr7bTbeD1srw/hcImxrNfJve', NULL, NULL, '2021-03-18 04:46:23', '2021-09-21 04:22:43'),
(18, 'Jada Cote', 'SF8554', 'qedyxy@mailinator.com', 2, '2015-03-25', '6', 'Qui cupiditate molli', '+1 (769) 833-4856', NULL, '2021-03-22', 3, 0, 0, NULL, '$2y$10$Lr1PnAjRyYJ9xDLhXBu.4uLQdpYjmrjKtL4uvxc1L3qlo4B8WgumC', NULL, NULL, '2021-03-22 06:38:57', '2021-09-21 04:22:49'),
(19, 'Ann Austin', 'SF5949', 'cugavi@mailinator.com', 2, '1995-07-18', '7', 'Mollitia est similiq', '(889) 856-7229', 'images/clinician/photo/ABWx6yRgDaAf9nNdsFYMfh41cxVIN97YqLSkIYfC.jpg', '2012-03-17', 1, 0, 0, NULL, '$2y$10$AqNeop9q/0sFlIXxKhrjfen5UD.s8Jz.r9xs5d7hzID/j.S4VLnr.', NULL, NULL, '2021-03-28 10:51:03', '2021-09-21 04:45:01'),
(20, 'Colby Morrison', 'morrison', 'xisaxyrina@mailinator.com', 3, '1996-04-18', '7', 'Libero cupiditate om', '+1 (628) 584-5617', NULL, '2014-04-18', 3, 0, 0, NULL, '$2y$10$5XzQaxNcpceBaRzU81FdSuvTjy.8JGLFnDlbpsJwXAQxSN8husmOi', NULL, NULL, '2021-04-18 09:49:06', '2021-09-21 04:22:25'),
(21, 'Colleen Spears', 'mowisulo', 'zypyl@mailinator.com', 2, '2011-04-02', '2', 'Neque eius quis nihi', '+1 (346) 161-5122', NULL, '1991-02-26', 1, 0, 0, NULL, '$2y$10$TY7jzmECC5vUIj16tiNWlulK5v57iLYFeCRAtTqsIEoxwplXJpZAi', NULL, NULL, '2021-04-18 09:50:52', '2021-09-21 04:23:01'),
(22, 'Dieter Whitaker', 'SF1212', 'peka@mailinator.com', 2, '2010-04-20', '6', 'Nostrud non cupidita', '+1 (936) 374-6718', NULL, '2009-04-20', 3, 1, 0, NULL, '$2y$10$784iqT2U36vmFuN5r0PSse9XSwM7ucP4WuAuhAuy5PkLaVL0moLxe', 'Y9MrPsD4nvJxHhdCraQlskFp3YJoFDKpF3wwTzSGlOgrCEAX1FWj92jcohrk', NULL, '2021-04-20 07:27:27', '2022-01-18 06:50:06'),
(23, 'Christian Mccormick', 'SF3331', 'tahmidrana@gmail.com', 1, '1997-04-20', '2', 'Voluptatem impedit', '01665435475', NULL, '2006-04-14', 1, 0, 0, NULL, '$2y$10$MuOF765PTmua.GO.anzv2uPYExYaLf6IkUePNpxmS.ofLOdRJKWAy', NULL, NULL, '2021-04-20 07:29:32', '2021-09-21 04:44:52'),
(24, 'MR Fin Admin', 'P7633', 'boda@mailinator.com', 1, '1981-03-05', '2', 'Dolorem nesciunt ex', '+1 (918) 553-2307', NULL, '2021-02-03', 1, 0, 0, NULL, '$2y$10$KJP8sCGXwVhGcNNj7q2Ge.Mb6VOKDABUudWmvAwsVBwZQyab.0lp2', NULL, NULL, '2021-07-27 08:08:42', '2021-09-21 04:22:38'),
(26, 'Jabed Munna', 'jabed', 'test@gmail.com', 1, '1994-02-22', '1', 'Dhaka', '01733332556', NULL, NULL, 1, 0, 0, NULL, '$2y$10$5Kpf5U7977qC.OZQrbH0Xe1vAyMAqSrPv/EeXYJXuFIK3geGsGuga', '58KMeSzmPiBbJhMi3zMaANeqmwPv4a7bcd0afsh9xHmJ9hWeMOpttufcHhqR', NULL, '2021-08-11 02:24:30', '2021-09-21 04:44:45'),
(27, 'Alisa Stevens', 'R8001', 'alisa@mailinator.com', 2, '1997-02-13', '6', 'Gulshan, Dhaka', '01667584758', NULL, '2021-06-03', 1, 0, 0, NULL, '$2y$10$TPsotPT9bgVPnBIi4FhmWexcPQiyqs9Qc7x0wDH.S8EeUhZygzQBC', NULL, NULL, '2021-09-07 07:15:50', '2021-09-21 04:22:33'),
(28, 'Kazi Mustafizur Rahman', 'KMR', 'kmrahman@phwcbd.org', 1, '1991-10-23', '1', '135/6, MALIBAGH, 1st road, shantinagar', '01894806222', NULL, '2018-08-01', 1, 1, 0, NULL, '$2y$10$W/dZj1B8Ali6qNcu.ol4DOUL8dhW/ztvfFXJO47VM.AKIQ46pJ58q', NULL, NULL, '2021-09-08 05:00:02', '2021-11-29 06:18:52'),
(29, 'Md. Rasel Sarker', 'MRS', 'rsarker@phwcbd.org', 1, '1990-10-02', '7', '3/A, IPH officers quarter, mohakhali, dhaka', '01894806201', NULL, '2018-01-16', 1, 1, 0, NULL, '$2y$10$0u/2roWW4hPAKrWT4hefg.buSwGFODHKJ/FRZ7oqqbi//f8yrha4m', NULL, NULL, '2021-09-08 05:02:51', '2021-12-15 07:03:20'),
(30, 'Areeba Ahmed', 'AAH', 'aahmed@phwcbd.org', 1, '1994-10-13', '1', 'apt 2a, house 19/a, road 23 banani', '01894806204', NULL, '2018-10-21', 1, 1, 0, NULL, '$2y$10$Spj8bG/a.ITEY8KA.pD.Zu6TU2qN4SX9rnEDcp30hfe9EAZhZrX.m', NULL, NULL, '2021-09-08 05:05:27', '2021-09-21 04:35:13'),
(31, 'Mehrin Ashique', 'MAP', 'mashique@phwcbd.org', 2, NULL, '2', 'House 31, Ground floor Haji Bari, Shankar Jami Mashjid Rd, Dhanmondi Dhaka - 1209', '01894806209', NULL, '1992-07-07', 1, 1, 0, NULL, '$2y$10$DXbD2/MKVaAZywt7iRkhrO5V1S3K/OpIaHGy8wMSqHNJWp7dL3sl2', NULL, NULL, '2021-09-08 05:07:28', '2021-11-29 06:15:26'),
(32, 'Karen Angelica Farooque', 'KAF', 'kangelica@phwcbd.org', 2, '1985-12-08', '4', 'Apt: A3, House - 187/D, Road 9, Block I, Bashundhara, Dhaka-1229', '01894806208', NULL, '2018-07-03', 1, 1, 0, NULL, '$2y$10$ewNhGPjAXmiCl0FyL0kHBOSejkm42okHb0liZ2SOeKhl9ysTULUT6', NULL, NULL, '2021-09-08 05:09:10', '2022-01-25 04:39:21'),
(33, 'Dr. Ashique Selim', 'ASE', 'aselim@phwcbd.org', 1, '1999-06-02', '1', 'apt 2b, house 10, road 81 gulshan 2', '01894806206', NULL, NULL, 1, 1, 0, NULL, '$2y$10$9KR/Ez3YZDuekRC6sZTdse2z3B6RQ4eeyRYm3NWrdO5WzJPV9SO0m', NULL, NULL, '2021-09-08 05:15:29', '2022-01-26 04:54:51'),
(34, 'Nissim Jan Sajid', 'NJS', 'nsajid@phwcbd.org', 2, '1987-01-19', '1', 'House 55, Park Road 14, Baridhara, Gulshan 2, Dhaka- 1214', '01894806207', NULL, NULL, 1, 1, 0, NULL, '$2y$10$WCqudPBQ6gjwXLST2ELch.pzirwQSfOigcl0bZcmOK.Vi5V04TyK2', '2LCTbv86qiUZFkbZGnyTOW9rV37mJ0FpKTT8JD3qPRLIIwKDW4ycdDV5iloH', NULL, '2021-09-08 05:18:17', '2021-12-26 05:26:53'),
(35, 'Mosammat Sultana', 'MSU', 'msultana@phwcbd.org', 2, '1987-01-03', '7', 'House -10/2, Nurzahan Road, Mohammadpur, Dhaka -1230', '01894806213', NULL, NULL, 1, 1, 0, NULL, '$2y$10$d3XTdb4CSVeNweBEWRsr6.LU184NRia74rCXScCmvRVIyo4Rdi6n6', NULL, NULL, '2021-09-08 05:21:41', '2021-09-21 06:15:39'),
(36, 'Dr. Sharmin Akter Pali', 'SAP', 'sakterpali@phwcbd.org', 2, '1998-08-07', '4', 'Dhaka, BD', '01894806231', 'images/clinician/photo/4dbjx4haEaiPxmKqGQT0819vjrfnnXnXlGvLGAPH.jpg', NULL, 1, 1, 0, NULL, '$2y$10$W4E.YCAHdFBG4b7DRpi0C.DK261QApMn1gSQPHtk3ZGnk1DMh2QdG', NULL, NULL, '2021-09-08 05:24:13', '2021-11-29 06:23:33'),
(37, 'Morgan Barrett', 'S8001', 'appinion.tahmid@gmail.com', 2, '1998-06-03', '7', 'Dhaka', '01676470847', NULL, NULL, 1, 0, 0, NULL, '$2y$10$gTVkK9phShUdSCiQPCyBxOiOsGcLQjwnHyZl.jgj.69IZP7CtLp0i', NULL, NULL, '2021-09-08 05:35:26', '2021-09-21 04:18:42'),
(38, 'Shah Nazim Uddin', 'SNU', 'shah.nazim@phwcbd.org', 1, '1991-12-16', '1', '2/B NS Road. block A, Banasiri', '01810013550', NULL, '2019-08-18', 1, 1, 0, NULL, '$2y$10$x6UbwiQ.OVME/XUNJj.XxuptX9WRv224GXVvri5KGrUR51XEo5egy', NULL, NULL, '2021-09-21 04:30:04', '2021-09-21 04:30:31'),
(39, 'Iram Akhtar', 'IAK', 'iakhtar@phwcbd.org', 2, '1981-12-23', '1', 'House 20, Apt- C-5, Road 76, Gulshan 2, 1214', '01894806221', NULL, '2019-11-01', 1, 1, 0, NULL, '$2y$10$oC7/fJmdRrrruxa91o3wW./aKWpOUBa8ZjWpnptbn5S.BJ/gvjeUq', NULL, NULL, '2021-09-21 04:47:49', '2021-09-21 04:47:49'),
(40, 'Susahma Mahmuda Ananna', 'SMA', 'smananna@phwcbd.org', 2, '1996-03-31', '1', '7/w, green road, staff quarter dhaka', '01894806205', NULL, NULL, 1, 1, 0, NULL, '$2y$10$DGD/Njvqa3V.Z5F91JaF5.okAkp03YVf1ojqeA7VlQrH9ILyT40u6', NULL, NULL, '2021-09-21 04:50:09', '2021-09-21 04:50:09'),
(41, 'Precila Doris Ojha', 'PDO', 'pojha@phwcbd.org', 2, '1996-08-23', '1', 'parbata afsar tower, H-380, senpara parbata, mirpur 10, 1216', '01894806232', NULL, '2018-08-01', 1, 1, 0, NULL, '$2y$10$C8SZD6fQ3mFuUYx/zDP/EOMLHbGCoPNnAx6QAJiUvn6vQu/RY4KKW', NULL, NULL, '2021-09-21 04:54:42', '2021-09-21 04:54:42'),
(42, 'Md Sanaullah', 'MDS', 'mdsanaullah@phwcbd.org', 1, '1994-02-01', '1', 'Dhaka, BD', '01894806210', NULL, '2020-09-01', 1, 1, 0, NULL, '$2y$10$vr8uN034Yuk7JAmzKS4mjuEctcKYr.CJDC1u76XwUrN/6Jf/ZRAZC', NULL, NULL, '2021-09-21 04:57:38', '2021-09-21 04:57:38'),
(85, 'Dr. Syed Faheem Shams', 'SFS', 'sshams@phwcbd.org', 1, NULL, '1', 'House 315/1, Road-15 (west), Jigatola, Dhanmondi, 1209', '01712997514', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2022-01-26 08:55:32'),
(86, 'Dr. Bushra Sultana', 'BSU', 'bsultana@phwcbd.org', 2, NULL, NULL, 'House 5, Road 20, Uttara, Sector 7, Dhaka - 1230', '01894806212', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', 'E7EzKP6u55UM1pfDG8l8HdQhBtuREXYDPwxpzREYbWWuqsE22yrn1LdGw5Jp', NULL, '2021-09-21 05:56:49', '2022-01-26 08:06:56'),
(87, 'Md. Shajahan Ali', 'MSA', 'msali@phwcbd.org', 1, '1990-10-10', '1', 'DCC - 327, South Kafrul, Dhaka Cantonment, Dhaka - 1206 House 32, Road 19, Mirpur, Dhaka- 1216', '01894806217', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2022-01-16 08:24:04'),
(88, 'Md. Mehedi Hasan', 'MMH', 'mmhasan@phwcbd.org', 1, '1989-11-03', '1', 'House-1402, Building - 12, Road-24/A Tajmahal Road, Japan Garden City Mohammadpur, Dhaka- 1207.', '01894806214', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 06:18:47'),
(89, 'Shahina Akther', 'SAK', 'sakther@phwcbd.org', 2, NULL, NULL, 'Flat 8A, House 109, Crescent Road, Green Road Dhaka', '01894806218', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2022-01-20 08:57:30'),
(90, 'Mosammat Adiba Akter', 'MAK', 'aakther@phwcbd.org', 2, '1987-11-21', '1', 'House -2, 1st Floor, Road -12/2 Block -E, Rupnagar R/A, Mirpur -12, Pallabi, Dhaka -1216', '01894806215', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', '1AQYYBRVmO2S02wkTK4ECeEiGa8d8B6AFfiYftVZLD6feK19EaeXLbHmoI5k', NULL, '2021-09-21 05:56:49', '2021-12-22 08:18:40'),
(91, 'Mariyam Sultana', 'MAS', 'masultana@phwcbd.org', 2, NULL, NULL, '6/2, K. M. Das Lane, Tikatuly, Dhaka - 1203', '01894806230', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 05:56:49'),
(92, 'Md. Sazzad Chowdhury', 'SCH', 'schowdhury@phwcbd.org', 1, NULL, NULL, '84/E South Nilkhet Staff Quarter, DU', '01894806223', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 05:56:49'),
(93, 'Shamima Akter Mimi', 'SAM', 's.akter@phwcbd.org', 2, NULL, NULL, 'Namapara, Boatghat, Khilkhet, Dhaka', '01894806224', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', 'LGtVkOoS4SOzBCYhMVoGonvkCmEFv6XQJ5NgtoVBg8Eij1mz8AqSN8tEuQCo', NULL, '2021-09-21 05:56:49', '2021-12-22 06:29:08'),
(94, 'Rahnuma-E-Jannat', 'REJ', 'rjannat@phwcbd.org', 2, NULL, NULL, 'Niharika Bhaban, Hasnabad Housing, South\nKeraniganj, Dhaka – 1311.', '01894806225', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 05:56:49'),
(95, 'Sadeka Hossain', 'SHO', 'shossain@phwcbd.org', 2, '1988-12-06', '1', 'Flat#C7, Bashgreho Nahar Monjil 104 Central Rad, Dhanmondi, Dhaka', '01894806216', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 06:23:29'),
(96, 'Linda Sultana', 'LSU', 'lsultana@phwcbd.org', 2, NULL, NULL, '22/23, hossaini dalan ,dhaka - 1000', '01894806219', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 05:56:49'),
(97, 'Moobashshira Zaman Cynthia', 'MZC', 'mzaman@phwcbd.org', 2, NULL, NULL, '9/2, New Secretariat Road, Shahbagh, Dhaka - 1000', '01894806220', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 05:56:49'),
(98, 'Masuda Afrin', 'MAF', 'mafrin@phwcbd.org', 2, NULL, NULL, 'House-7, Road- 3, Block- B, Nobodoy Bazar, Adabor, Dhaka-1207', '01894806226', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 05:56:49'),
(99, 'Mehrin Mostafa Mumu', 'MMM', 'mmostafa@phwcbd.org', 2, NULL, NULL, 'MatikatBazar, 55/1, Cantonement, Dhaka', '01894806227', NULL, NULL, 1, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', 'cvKxwrreuaAph4FGEHjjXAXppNhYE8oYsuBjSuLJkA8RgdseoLDy1RAwigGn', NULL, '2021-09-21 05:56:49', '2021-12-22 05:59:18'),
(100, 'Fatema Akter Keya', 'FAK', 'fakter@phwcbd.org', 2, NULL, NULL, 'Muktinagar, Chittagong road, Shiddhirganj, Narayanganj', '01894806228', NULL, NULL, 3, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-11-29 06:37:54'),
(101, 'Dr.Antara Chowdhuary', 'ACH', 'medicalofficer@phwcbd.org', 2, NULL, NULL, 'apt 7C, 94, indira road', '01894806229', NULL, NULL, 3, 1, 0, NULL, '$2y$10$uCDM76hBqZ7JteDdv/iGyeHXRQwTQUfrnYNS/wUdQbyP7BhbmxO/y', NULL, NULL, '2021-09-21 05:56:49', '2021-09-21 05:56:49'),
(102, 'Clinician_RA', 'CLRA', 'qety@mailinator.com', 1, '2021-11-29', '8', 'Quis dolorem ut volu', '17344213551', NULL, NULL, 1, 0, 0, NULL, '$2y$10$weKOQByiAu57OP0FNcnWzOL9/rovNDR5Px/o9WOlX2vBTSMn3wmOa', 'iGTtafhD0FR8qTbi1cF1Tjq4o4oaY2Mxin70cgq1gpE5H83ya7HjyxtxHIxg', NULL, '2021-11-29 06:12:36', '2022-01-12 11:27:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_userid_unique` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1336;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
