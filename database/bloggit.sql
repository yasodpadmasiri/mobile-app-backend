-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 07:03 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloggit`
--

-- --------------------------------------------------------

--
-- Table structure for table `dp_app_settings`
--

CREATE TABLE `dp_app_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dp_app_settings`
--

INSERT INTO `dp_app_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(7, 'date_format', 'm-d-Y', '2020-09-19 12:40:44', '2020-12-28 14:45:28'),
(8, 'language', 'en', '2020-09-19 12:40:44', '2020-12-28 14:45:28'),
(17, 'is_human_date_format', '1', '2020-09-19 12:40:44', NULL),
(18, 'app_name', 'Brilliant NHS', '2020-09-19 12:40:44', '2021-01-14 09:59:39'),
(19, 'app_short_description', 'Manage Mobile Application -1', '2020-09-19 12:40:44', '2020-09-29 11:36:53'),
(20, 'mail_driver', 'smtp', '2020-09-19 12:40:44', NULL),
(21, 'mail_host', 'smtp.hostinger.com', '2020-09-19 12:40:44', '2020-09-23 13:06:50'),
(22, 'mail_port', '5878', '2020-09-19 12:40:44', '2020-09-23 13:06:50'),
(23, 'mail_username', 'productdelivery@smartersvision.com', '2020-09-19 12:40:44', '2020-09-23 13:06:50'),
(24, 'mail_password', 'NnvAwk&&E7', '2020-09-19 12:40:44', '2020-09-23 13:06:50'),
(25, 'mail_encryption', 'ssl', '2020-09-19 12:40:44', '2020-09-23 13:06:50'),
(26, 'mail_from_address', 'productdelivery@smartersvision.com', '2020-09-19 12:40:44', '2020-09-23 13:06:50'),
(27, 'mail_from_name', 'Bloggit', '2020-09-19 12:40:44', '2020-09-23 13:06:50'),
(30, 'timezone', 'Europe/Istanbul', '2020-09-19 12:40:44', '2020-12-28 14:45:28'),
(32, 'theme_contrast', 'light', '2020-09-19 12:40:44', '2020-09-29 11:36:53'),
(33, 'theme_color', 'blue', '2020-09-19 12:40:44', '2020-09-29 11:36:53'),
(34, 'app_logo', '1600866285775134437.jpg', '2020-09-19 12:40:44', '2020-09-23 13:05:03'),
(35, 'nav_color', 'navbar-light bg-white', '2020-09-19 12:40:44', NULL),
(38, 'logo_bg_color', 'bg-white', '2020-09-19 12:40:44', NULL),
(66, 'default_role', 'admin', '2020-09-19 12:40:44', NULL),
(68, 'facebook_app_id', '518416208939727', '2020-09-19 12:40:44', '2020-11-03 22:53:45'),
(69, 'facebook_app_secret', '93649810f78fa9ca0d48972fee2a75cd', '2020-09-19 12:40:44', '2020-11-03 22:53:45'),
(71, 'twitter_app_id', 'twitter', '2020-09-19 12:40:44', NULL),
(72, 'twitter_app_secret', 'twitter 1', '2020-09-19 12:40:44', NULL),
(74, 'google_app_id', '527129559488-roolg8aq110p8r1q952fqa9tm06gbloe.apps.googleusercontent.com', '2020-09-19 12:40:44', '2020-11-03 22:53:45'),
(75, 'google_app_secret', 'FpIi8SLgc69ZWodk-xHaOrxn', '2020-09-19 12:40:44', '2020-11-03 22:53:45'),
(77, 'enable_google', '1', '2020-09-19 12:40:44', '2020-11-03 22:53:45'),
(78, 'enable_facebook', '1', '2020-09-19 12:40:44', '2020-11-03 22:53:45'),
(93, 'enable_stripe', '1', '2020-09-19 12:40:44', NULL),
(94, 'stripe_key', 'pk_test_pltzOnX3zsUZMoTTTVUL4O41', '2020-09-19 12:40:44', NULL),
(95, 'stripe_secret', 'sk_test_o98VZx3RKDUytaokX4My3a20', '2020-09-19 12:40:44', NULL),
(104, 'default_tax', '10', '2020-09-19 12:40:44', NULL),
(107, 'default_currency', '$', '2020-09-19 12:40:44', NULL),
(108, 'fixed_header', '0', '2020-09-19 12:40:44', NULL),
(109, 'fixed_footer', '0', '2020-09-19 12:40:44', NULL),
(110, 'fcm_key', 'AAAAHMZiAQA:APA91bEb71b5sN5jl-w_mmt6vLfgGY5-_CQFxMQsVEfcwO3FAh4-mk1dM6siZwwR3Ls9U0pRDpm96WN1AmrMHQ906GxljILqgU2ZB6Y1TjiLyAiIUETpu7pQFyicER8KLvM9JUiXcfWK', '2020-09-19 12:40:44', NULL),
(111, 'enable_notifications', '1', '2020-09-19 12:40:44', NULL),
(112, 'paypal_username', 'sb-z3gdq482047_api1.business.example.com', '2020-09-19 12:40:44', NULL),
(113, 'paypal_password', 'JV2A7G4SEMLMZ565', '2020-09-19 12:40:44', NULL),
(114, 'paypal_secret', 'AbMmSXVaig1ExpY3utVS3dcAjx7nAHH0utrZsUN6LYwPgo7wfMzrV5WZ', '2020-09-19 12:40:44', NULL),
(115, 'enable_paypal', '1', '2020-09-19 12:40:44', NULL),
(116, 'main_color', '#25D366', '2020-09-19 12:40:44', NULL),
(117, 'main_dark_color', '#25D366', '2020-09-19 12:40:44', NULL),
(118, 'second_color', '#043832', '2020-09-19 12:40:44', NULL),
(119, 'second_dark_color', '#ccccdd', '2020-09-19 12:40:44', NULL),
(120, 'accent_color', '#8c98a8', '2020-09-19 12:40:44', NULL),
(121, 'accent_dark_color', '#9999aa', '2020-09-19 12:40:44', NULL),
(122, 'scaffold_dark_color', '#2c2c2c', '2020-09-19 12:40:44', NULL),
(123, 'scaffold_color', '#fafafa', '2020-09-19 12:40:44', NULL),
(124, 'google_maps_key', 'AIzaSyAT07iMlfZ9bJt1gmGj9KhJDLFY8srI6dA', '2020-09-19 12:40:44', NULL),
(125, 'mobile_language', 'en', '2020-09-19 12:40:44', NULL),
(126, 'app_version', '1.0.0', '2020-09-19 12:40:44', NULL),
(127, 'enable_version', '1', '2020-09-19 12:40:44', NULL),
(128, 'firebase_msg_key', 'AAAALzPsbls:APA91bE-K0WzyoAUZ6m0Yez0XGz18xK_5roagDLzrOGND4StU3it7-d7MqT9iZzISD-yRXoyCcd9SgfA82vmDn9y-o-FDzeqgnyH3TiuDBI4Ij7aMv5yZIHlgmYHY0rcZ3QT-C6MEZsc', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(129, 'firebase_api_key', 'AIzaSyD0w2ahS7oTlY7g6WWx9bn8VCJbHw6GRUc', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(130, 'database_url', 'erwf', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(131, 'storage_bucket', 'erwf', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(132, 'application_id', 'ewrf', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(133, 'auth_domaim', 'wwrgfr', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(134, 'project_id', 'erfeer', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(135, 'msg_sender_id', 'ref', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(136, 'measurement_id', 'ewrf', '2020-09-19 12:52:16', '2020-09-28 09:31:15'),
(137, 'push_notification_enabled', '1', '2020-09-19 12:53:38', '2020-09-28 09:31:15'),
(138, 'pushNoti', '1', '2020-09-19 13:04:15', '2020-09-28 09:31:15'),
(139, 'enable_facebook_check', '1', '2020-09-19 13:18:59', '2020-11-03 22:53:45'),
(140, 'enable_google_check', '0', '2020-09-19 13:19:00', '2020-11-03 22:53:45'),
(142, 'bg_image', '1608789663627844655.jpg', '2020-09-19 12:40:44', '2020-12-24 06:01:05'),
(151, 'image', NULL, '2020-09-23 15:37:14', '2020-09-29 11:36:53'),
(152, 'bgimage', NULL, '2020-09-23 15:37:14', '2021-01-14 09:59:39'),
(153, 'splash_image', '1600866299749969633.jpg', '2020-09-19 12:40:44', '2020-09-23 13:05:03'),
(157, 'google_anlytics_code', 'function (){}', '2020-09-19 12:40:44', '2020-11-03 22:53:45'),
(158, 'font_family', 'Trebuchet MS', '2020-09-19 12:40:44', '2020-09-29 11:36:53'),
(159, 'splashimage', NULL, '2020-09-23 17:19:13', '2020-09-29 11:36:53'),
(160, 'app_theme', '1', '2020-09-19 12:40:44', '2020-09-29 11:36:53'),
(161, 'mail_mailer', 'smtp', '2020-09-19 12:40:44', '2020-09-23 13:06:50'),
(162, 'app_subtitle', 'Health News & Lifestyle', '2020-09-19 12:40:44', '2021-01-14 09:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `dp_author`
--

CREATE TABLE `dp_author` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_blog`
--

CREATE TABLE `dp_blog` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `thumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `is_featured` int(11) NOT NULL DEFAULT '0',
  `is_voting_enable` int(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_blog_author`
--

CREATE TABLE `dp_blog_author` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_blog_category`
--

CREATE TABLE `dp_blog_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_blog_images`
--

CREATE TABLE `dp_blog_images` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dp_blog_view_count`
--

CREATE TABLE `dp_blog_view_count` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dp_bookmark_post`
--

CREATE TABLE `dp_bookmark_post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dp_category`
--

CREATE TABLE `dp_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_cms_content`
--

CREATE TABLE `dp_cms_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `meta_char` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dp_cms_content`
--

INSERT INTO `dp_cms_content` (`id`, `page_name`, `title`, `page_title`, `image`, `description`, `meta_char`, `meta_desc`, `created_at`, `updated_at`) VALUES
(1, 'join_us', 'Join us here', 'Join us', '1605865496159712509.jpg', '<p>Testing terms &amp; condition text here</p>', NULL, NULL, NULL, '2020-11-20 04:15:51'),
(2, 'about', 'About Us', 'About Us', NULL, '<p>Testing terms &amp; condition text</p>', NULL, NULL, NULL, '2020-10-22 16:43:09'),
(3, 'terms', 'Terms & privacy', 'Terms & privacy', NULL, '<p>Testing terms &amp; condition text</p>', NULL, NULL, NULL, '2020-10-22 16:42:21'),
(4, 'advertise', 'Advertise', 'Advertise', NULL, '<p>Testing terms &amp; condition text</p>', NULL, NULL, NULL, '2020-10-22 16:42:21'),
(5, 'contact_us', 'Contact us', 'Contact us', NULL, '<p>Testing terms &amp; condition text</p>', NULL, NULL, NULL, '2020-10-22 16:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `dp_failed_jobs`
--

CREATE TABLE `dp_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_migrations`
--

CREATE TABLE `dp_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dp_migrations`
--

INSERT INTO `dp_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2020_09_10_135412_create_app_setting', 1),
(9, '2020_09_11_053033_create_category', 1),
(10, '2020_09_11_054729_create_author', 1),
(11, '2020_09_11_054931_create_blog', 1),
(12, '2020_09_11_055334_create_blog_category', 1),
(13, '2020_09_11_055520_create_blog_author', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dp_oauth_access_tokens`
--

CREATE TABLE `dp_oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_oauth_auth_codes`
--

CREATE TABLE `dp_oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_oauth_clients`
--

CREATE TABLE `dp_oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dp_oauth_clients`
--

INSERT INTO `dp_oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Bloggit Personal Access Client', 'VPgVmsUlc8p0axGycqaQAJStRT53H6jSFUwQ8FOV', NULL, 'http://localhost', 1, 0, 0, '2020-09-15 02:20:29', '2020-09-15 02:20:29'),
(2, NULL, 'Bloggit Password Grant Client', 'LgElsizIiTVuO8xn18UVtxCLSN1NVY31dpHWiXZp', 'users', 'http://localhost', 0, 1, 0, '2020-09-15 02:20:29', '2020-09-15 02:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `dp_oauth_personal_access_clients`
--

CREATE TABLE `dp_oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dp_oauth_personal_access_clients`
--

INSERT INTO `dp_oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-09-15 02:20:29', '2020-09-15 02:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `dp_oauth_refresh_tokens`
--

CREATE TABLE `dp_oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dp_search_log`
--

CREATE TABLE `dp_search_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `search_keyword` varchar(255) DEFAULT NULL,
  `search_count` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dp_users`
--

CREATE TABLE `dp_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `device_token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` enum('android','ios') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dp_users`
--

INSERT INTO `dp_users` (`id`, `type`, `name`, `email`, `password`, `photo`, `phone`, `gender`, `fb_token`, `active`, `device_token`, `device_type`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@gmail.com', '$2y$10$28Armc2Bm9KItCua0FkOBePG895WaRNgA52m0sFYctCN76rkgeyva', '16043006161170708045.jpg', NULL, 'male', NULL, 1, NULL, NULL, NULL, NULL, '2020-09-15 03:54:47', '2020-11-03 22:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `dp_vote`
--

CREATE TABLE `dp_vote` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `vote` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dp_app_settings`
--
ALTER TABLE `dp_app_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_settings_key_index` (`key`);

--
-- Indexes for table `dp_author`
--
ALTER TABLE `dp_author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_blog`
--
ALTER TABLE `dp_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_blog_author`
--
ALTER TABLE `dp_blog_author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_blog_category`
--
ALTER TABLE `dp_blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_blog_images`
--
ALTER TABLE `dp_blog_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_blog_view_count`
--
ALTER TABLE `dp_blog_view_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_bookmark_post`
--
ALTER TABLE `dp_bookmark_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_category`
--
ALTER TABLE `dp_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_cms_content`
--
ALTER TABLE `dp_cms_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_failed_jobs`
--
ALTER TABLE `dp_failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_migrations`
--
ALTER TABLE `dp_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_oauth_access_tokens`
--
ALTER TABLE `dp_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dp_oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `dp_oauth_auth_codes`
--
ALTER TABLE `dp_oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dp_oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `dp_oauth_clients`
--
ALTER TABLE `dp_oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dp_oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `dp_oauth_personal_access_clients`
--
ALTER TABLE `dp_oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_oauth_refresh_tokens`
--
ALTER TABLE `dp_oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dp_oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `dp_search_log`
--
ALTER TABLE `dp_search_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_users`
--
ALTER TABLE `dp_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_vote`
--
ALTER TABLE `dp_vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dp_app_settings`
--
ALTER TABLE `dp_app_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `dp_author`
--
ALTER TABLE `dp_author`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_blog`
--
ALTER TABLE `dp_blog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_blog_author`
--
ALTER TABLE `dp_blog_author`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_blog_category`
--
ALTER TABLE `dp_blog_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_blog_images`
--
ALTER TABLE `dp_blog_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_blog_view_count`
--
ALTER TABLE `dp_blog_view_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_bookmark_post`
--
ALTER TABLE `dp_bookmark_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_category`
--
ALTER TABLE `dp_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_cms_content`
--
ALTER TABLE `dp_cms_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dp_failed_jobs`
--
ALTER TABLE `dp_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_migrations`
--
ALTER TABLE `dp_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dp_oauth_clients`
--
ALTER TABLE `dp_oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dp_oauth_personal_access_clients`
--
ALTER TABLE `dp_oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dp_search_log`
--
ALTER TABLE `dp_search_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dp_users`
--
ALTER TABLE `dp_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `dp_vote`
--
ALTER TABLE `dp_vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
