-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 09:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtual`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisings`
--

CREATE TABLE `advertisings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `url` varchar(191) NOT NULL,
  `media` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `pricing` varchar(191) NOT NULL DEFAULT 'per_link',
  `total_limit` int(11) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'publish',
  `result` varchar(191) DEFAULT '0',
  `total_spent` varchar(191) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mention_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `video_id`, `parent_id`, `mention_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL, 'Sad I missed seeing this live', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(2, 5, 1, 1, NULL, 'Loved catching up with you guys', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(3, 3, 1, NULL, NULL, 'Thank you for this!', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(4, 6, 1, 3, NULL, 'Wow!', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(5, 9, 1, NULL, NULL, 'Awesome! You are looking fine!', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(6, 10, 1, NULL, NULL, 'Shei! Valo lagce!', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(7, 4, 25, NULL, NULL, 'this one good', '2025-07-26 08:03:46', '2025-07-26 08:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `comment_user`
--

CREATE TABLE `comment_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'active', '2025-06-18 00:51:24', '2025-06-18 00:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_05_10_041410_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_04_04_000000_create_user_follower_table', 1),
(6, '2020_05_10_041543_create_videos_table', 1),
(7, '2020_05_10_041605_create_comments_table', 1),
(8, '2020_05_11_053705_create_options_table', 1),
(9, '2020_05_11_102225_create_user_video_table', 1),
(10, '2020_05_20_040702_create_comment_user_table', 1),
(11, '2020_06_11_052623_create_verifications_table', 1),
(12, '2020_06_13_043543_create_monetizations_table', 1),
(13, '2020_06_16_021714_create_advertisings_table', 1),
(14, '2020_06_22_092641_create_withdraws_table', 1),
(15, '2020_06_26_151556_create_reports_table', 1),
(16, '2020_06_26_151633_create_notifications_table', 1),
(17, '2020_06_27_122153_create_sponsors_table', 1),
(18, '2020_07_01_061124_create_pages_table', 1),
(19, '2020_07_06_092510_create_languages_table', 1),
(22, '2025_07_05_165722_add_video_details_to_videos_table', 2),
(23, '2025_07_05_170031_create_photos_table', 3),
(24, '2025_07_05_170042_create_photo_items_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `monetizations`
--

CREATE TABLE `monetizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `link` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'settings', '{\"logo\":\"uploads/logo.png\",\"copyright\":\"© COPYRIGHT 2020 BY TONGTANG\"}', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(2, 'followers', '1000', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(3, 'total_view', '10000', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(4, 'per_link', '10', '2025-06-18 00:51:24', '2025-06-20 19:40:37'),
(5, 'author_get_per_link', '0.25', '2025-06-18 00:51:24', '2025-06-20 19:40:37'),
(6, 'per_impression', '0.50', '2025-06-18 00:51:24', '2025-06-20 19:40:37'),
(7, 'author_get_per_impression', '0.25', '2025-06-18 00:51:24', '2025-06-20 19:40:37'),
(8, 'ads_show_per_second', '60', '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(9, 'user_value', '{\"user_registation\":\"enabled\",\"email_verification\":\"disabled\",\"delete_account\":\"disabled\",\"user_monetization\":\"enabled\",\"user_payment_withdraw\":\"enabled\",\"user_verification\":\"disabled\"}', '2025-06-18 00:51:24', '2025-06-18 00:53:42'),
(10, 'site_value', '{\"site_title\":\"Virtual BPP Store By Buypremiumproducts\",\"site_name\":\"B.P.P. Virtual\",\"site_email\":\"support@buypremiumproducts.com\",\"site_description\":\"Explore Wide Range Of Premium Products World Wide Shipping.\",\"facebook_url\":null,\"twitter_url\":null,\"google_url\":null,\"dark_logo\":\"uploads\\/logo\\/2025-06-18-68520f3aba7ba.webp\",\"light_logo\":\"uploads\\/logo\\/2025-06-18-68520f3aba9f7.webp\",\"default_language\":\"en\",\"active_lang\":\"English\",\"favicon\":\"frontend\\/img\\/favicon.ico\"}', '2025-06-18 00:51:24', '2025-06-20 19:40:37'),
(11, 'currency', '{\"code\":\"INR\",\"symbol\":\"\\u20b9\"}', '2025-06-18 00:51:24', '2025-06-20 19:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `photo_type` varchar(191) NOT NULL,
  `file_path` varchar(191) DEFAULT NULL,
  `cta_label` varchar(191) DEFAULT NULL,
  `cta_url` varchar(191) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `title`, `description`, `photo_type`, `file_path`, `cta_label`, `cta_url`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 4, 'Shoot of the day', 'Today we shoot the nature', 'single', 'uploads/1752647628.jpg', NULL, NULL, 1, '2025-07-16 01:03:48', '2025-07-16 08:09:38'),
(2, 4, 'sdssdsd', 'sdsd', 'single', 'uploads/1752672870.jpg', 'subscribe', 'http://127.0.0.1:8000/upload', 1, '2025-07-16 08:04:30', '2025-07-16 08:09:35'),
(3, 4, 'sdssdsd', 'sdsd', 'single', 'uploads/1752672934.jpg', 'subscribe', 'http://127.0.0.1:8000/upload', 1, '2025-07-16 08:05:34', '2025-07-16 08:09:31'),
(4, 4, 'sdssdsd', 'sdsd', 'single', 'uploads/1752672934.jpg', 'subscribe', 'http://127.0.0.1:8000/upload', 1, '2025-07-16 08:05:34', '2025-07-16 08:09:31'),
(5, 4, 'This is fabulous', 'Fabulous spelling may be incorrect so ....', 'single', 'uploads/1754029618.png', 'subscribe', 'http://127.0.0.1:8000/upload', 1, '2025-08-01 00:56:58', '2025-08-01 07:43:24'),
(6, 4, 'Carousel IMages', 'we try to add carousel for the testing purpose so that we can tell client that it is working and we can move ahead', 'carousel', NULL, 'download', 'https://chatgpt.com/c/687f27e6-b904-8013-9ccd-f64f2ca8c61b', 1, '2025-08-03 00:22:44', '2025-08-03 01:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `photo_comments`
--

CREATE TABLE `photo_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `mention_id` int(11) DEFAULT NULL,
  `message` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo_comments`
--

INSERT INTO `photo_comments` (`id`, `user_id`, `photo_id`, `parent_id`, `mention_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 4, 3, NULL, NULL, 'test comment', '2025-07-26 08:25:37', '2025-07-26 08:25:37'),
(2, 4, 3, NULL, NULL, 'another test comment', '2025-07-26 09:23:47', '2025-07-26 09:23:47'),
(3, 4, 3, 2, 4, 'check', '2025-07-27 00:34:56', '2025-07-27 00:34:56'),
(4, 4, 2, NULL, NULL, 'gg', '2025-07-27 02:01:35', '2025-07-27 02:01:35'),
(5, 4, 2, 4, 4, 'kk', '2025-07-27 02:02:19', '2025-07-27 02:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `photo_comment_user`
--

CREATE TABLE `photo_comment_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_comment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo_comment_user`
--

INSERT INTO `photo_comment_user` (`id`, `user_id`, `photo_comment_id`, `created_at`, `updated_at`) VALUES
(3, 4, 2, '2025-07-27 01:58:05', '2025-07-27 01:58:05'),
(5, 4, 4, '2025-07-27 02:01:53', '2025-07-27 02:01:53'),
(6, 4, 5, '2025-07-27 02:02:21', '2025-07-27 02:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `photo_items`
--

CREATE TABLE `photo_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(191) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo_items`
--

INSERT INTO `photo_items` (`id`, `photo_id`, `file_path`, `order`, `created_at`, `updated_at`) VALUES
(1, 6, 'uploads/1754200364_0.webp', 0, '2025-08-03 00:22:44', '2025-08-03 00:22:44'),
(2, 6, 'uploads/1754200364_1.webp', 1, '2025-08-03 00:22:44', '2025-08-03 00:22:44'),
(3, 6, 'uploads/1754200364_2.jpg', 2, '2025-08-03 00:22:44', '2025-08-03 00:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `photo_user`
--

CREATE TABLE `photo_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo_user`
--

INSERT INTO `photo_user` (`id`, `user_id`, `photo_id`, `comment_id`, `created_at`, `updated_at`) VALUES
(2, 4, 2, NULL, '2025-07-27 02:00:20', '2025-07-27 02:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `body` text NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `video_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `body`, `type`, `parent_id`, `video_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'okok', 'photo', 4, 3, 'pending', '2025-07-29 01:47:36', '2025-07-29 01:47:36'),
(2, 4, 'this report came from 3 dot click popup model', 'photo', 4, 2, 'pending', '2025-08-01 00:37:51', '2025-08-01 00:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(2, 'Author', 'author', '2025-06-18 00:51:23', '2025-06-18 00:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'sponsor.png',
  `title` varchar(191) NOT NULL,
  `url` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `country` varchar(191) DEFAULT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'uploads/default.png',
  `value` text DEFAULT NULL,
  `two_factor` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `slug`, `email`, `username`, `country`, `image`, `value`, `two_factor`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bpp', 'Official', 'bppofficial', 'support@buypremiumproducts.com', '@Bppofficial', 'Bangladesh', 'uploads/2025-06-18-68520dcde7e66.png', '{\"bio\":\"Performance Marketer At Official BPP Store.\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":\"India\",\"gender\":\"male\",\"age\":\"27\",\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads\\/2025-06-18-68520dd15f5d9.webp\",\"two_step\":\"disable\",\"wallet\":\"0\"}', '8632', NULL, '$2y$10$GPsjMkmggkNtSEbV0hO9y.tsdMDI0x.zyTVSk04jhna0kwun50Qk6', '2rcH4ILwkmBrBam9bOcgtXHdvhBH14VGDm2sJ033aLt6YNMBeyvwgktvTiGC', '2025-06-18 00:51:23', '2025-06-20 19:35:25'),
(2, 2, 'Tolis', 'Ligkopoulos', 'tolisligkopoulos', 'user@gmail.com', '@tolisligkopoulos', 'Bangladesh', 'uploads/profile2.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$OnANTe6V0YjRS.JYBbuJCO2wFFSvtn2.kzo8RWTGzdepvWl79CzyS', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(3, 2, 'Alison', 'Phood', 'alison-phood', 'alison@gmail.com', '@alisonphood', 'United States', 'uploads/profile3.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$EWhRBdMocG97/b.Jb9.nce.eZxyScKKgg829kr9c9v8THdAV4o9S6', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(4, 2, 'Ankhi', 'Alamgir', 'ankhi-alamgir', 'ankhi@gmail.com', '@ankhialamgir', 'United States', 'uploads/profile4.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$GPsjMkmggkNtSEbV0hO9y.tsdMDI0x.zyTVSk04jhna0kwun50Qk6', 'tjLIbIEJlztEsBSAOU8Bh7mdZHIWKty4Dk4DTcV8qdSkTCltxZcXMWtDTREH', '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(5, 2, 'Somprity', 'Chowdhury', 'somprity-chowdhury', 'somprity@gmail.com', '@sompritychowdhury', 'United States', 'uploads/profile5.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$RgTNXTqrRgZzDbETclHLleMpmi0G7VeSKv.YAGICYASfdGk0Ikv.G', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(6, 2, 'Neelanjona', 'Neela', 'neelanjona-neela', 'neelanjona@gmail.com', '@neelanjonaneela', 'United States', 'uploads/profile6.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$L55/05kvUpewSrCYqzPxSujqCnpyxdLGxuM3K5oc50H2zFpIPU9si', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(7, 2, 'Srabanti', 'Smile', 'srabanti-smile', 'srabanti@gmail.com', '@srabantismile', 'Bangladesh', 'uploads/profile7.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$skmJm8NmwLP2Gv5xar822OV3JmnrzwBRO6hr4yIk9Djj9ZK98mJzS', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(8, 2, 'Tahsankhan', 'Ahamed', 'tahsankhan-ahamed', 'tahsankhan@gmail.com', '@tahsankhanahamed', 'Bangladesh', 'uploads/profile8.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$22v7aD4J2iHjdylkeWwy9el28iPN2TzKRAl248I7X5hHoMwfyEsRC', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(9, 2, 'Premraj', 'Man', 'premraj-man', 'premraj@gmail.com', '@premrajman', 'Bangladesh', 'uploads/profile9.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$EOLzfEEHREM9VUKc9oYfm.8UPk.Mo2TVaTLR5MNzHENLWsJCWWO2a', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(10, 2, 'Creative', 'It', 'creative-it', 'creative@gmail.com', '@creativeit', 'Bangladesh', 'uploads/profile10.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$n3WwwfUQbBQvrd54TVN3bee23RUgdlS9MHtiaGZQUT2A.PBLKCjDW', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(11, 2, 'Tamim', 'Hossain', 'tamim-hossain', 'tamim@gmail.com', '@tamimhossain', 'Bangladesh', 'uploads/profile11.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$BUscZ8dlhxIfdQl35QkmBOHZY9RUluDzoGwrbO/RT8CGEVjrIzU.G', NULL, '2025-06-18 00:51:23', '2025-06-18 00:51:23'),
(12, 2, 'Nawsheen', 'Nahreen', 'nawsheen-nahreen', 'nawsheen@gmail.com', '@nawsheennahreen', 'Bangladesh', 'uploads/profile12.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$/8Rd8QWnjrTlBTCx5blQO.fbdWgmmNCUwzIG/yOGcIHFnuLMKN0fK', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(13, 2, 'Peya', 'Jannatul', 'peya-jannatul', 'peya@gmail.com', '@peyajannatul', 'Bangladesh', 'uploads/profile13.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$BmuqBGZHEE67j5rbjlIs5.3hBPw1M2dJH5RDLQEm3E/WUx6N7LTOC', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(14, 2, 'Urva', 'Shirautela', 'urva-shirautela', 'urva@gmail.com', '@urvashirautela', 'Bangladesh', 'uploads/profile14.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$fBXcSeOrdP/5qMfYhvcLaO6Cg33KP7FeLvaRNoP7cFvlh9BXcDJei', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(15, 2, 'Sabnam', 'Faria', 'sabnam-faria', 'sabnam@gmail.com', '@Sabnamfaria', 'Bangladesh', 'uploads/profile15.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$tMoOsqjWwmJeOuKCW6SUM.sIoLfbbSJzxPP6Y6bLY4kgGoJKMKi22', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(16, 2, 'Safyan', 'Sary', 'safyan-sary', 'safyan@gmail.com', '@safyansary', 'Bangladesh', 'uploads/profile16.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$yPcy9Md2Bs9cV5WdPYLTvud5awztglbdrPRIRwY26fWmwRIaDYWOO', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(17, 2, 'Bhabna', 'Ashna', 'bhabna-ashna', 'bhabna@gmail.com', '@bhabnaashna', 'Bangladesh', 'uploads/profile17.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$UBfAYlHKOxojeKoP0I52q.iVkh5YTG7cEsONQRkqH3O/aMFPDR7i2', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(18, 2, 'Hamid', 'Mousumi', 'hamid-mousumi', 'hamid@gmail.com', '@hamidmousumi', 'Bangladesh', 'uploads/profile18.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$IGpqvGvu3DxOlJz5x2dvSeU95RdKDGBwgkp/1J/ZzxhrHi/xHptBW', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(19, 2, 'Roberto', 'Dev', 'roberto-dev', 'roberto@gmail.com', '@robertodev', 'Bangladesh', 'uploads/profile19.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$7elqZY7Wk5jGIjqihawohukq50J46gh5webkqvcqfCQwK8p5B2IPO', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(20, 2, 'Jaya', 'Ahsan', 'jaya-ahsan', 'jaya@gmail.com', '@jayaahsan', 'Bangladesh', 'uploads/profile20.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$w.LgKnQ7n2Gom3pckjE8pO5gU.pwbCrex/ccQoniUAQsOps/aqu1q', NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(21, 1, 'Arafat', 'Hossain', 'arafathossain', 'admin@gmail.com', '@arafathossain', 'Bangladesh', 'uploads/profile1.png', '{\"bio\":\"Professional dancer-instructor-trainer!!!\",\"total_view\":0,\"total_like\":0,\"city\":null,\"country\":null,\"gender\":\"male\",\"age\":22,\"status\":\"active\",\"verified\":\"unverified\",\"facebook\":null,\"twitter\":null,\"instagram\":null,\"pinterest\":null,\"relation\":\"single\",\"cover\":\"uploads/cover.jpg\",\"two_step\":\"disable\",\"wallet\":\"0\"}', NULL, NULL, '$2y$10$We4ZqaNHEyc7ahrXvQkNeOlnRo3TmJ3MKxX2eNiGxo/slM9cQU0IS', NULL, '2025-07-14 09:09:06', '2025-07-14 09:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_follower`
--

CREATE TABLE `user_follower` (
  `id` int(10) UNSIGNED NOT NULL,
  `following_id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_video`
--

CREATE TABLE `user_video` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_video`
--

INSERT INTO `user_video` (`id`, `user_id`, `video_id`, `created_at`, `updated_at`) VALUES
(3, 4, 25, '2025-07-26 05:26:23', '2025-07-26 05:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `video_type` varchar(191) NOT NULL DEFAULT 'url',
  `thumbnail_url` varchar(191) DEFAULT NULL,
  `file_path` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `country` varchar(191) DEFAULT NULL,
  `cta_label` varchar(191) DEFAULT NULL,
  `cta_url` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `slug`, `url`, `video_type`, `thumbnail_url`, `file_path`, `status`, `is_approved`, `view`, `country`, `cta_label`, `cta_url`, `created_at`, `updated_at`) VALUES
(1, 3, 'should I teach Lokie??', NULL, 'should-i-teach-lokie', NULL, 'upload', NULL, 'uploads/1.mp4', 'public', 0, 3, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-07-18 05:42:37'),
(2, 3, 'clearly my boyfriend is very supportive', NULL, 'clearly-my-boyfriend-is-very-supportive', NULL, 'upload', NULL, 'uploads/2.mp4', 'public', 0, 1, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 07:14:32'),
(3, 4, 'wait till the end', NULL, 'wait-till-the-end', NULL, 'upload', NULL, 'uploads/3.mp4', 'public', 0, 1, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 07:14:42'),
(4, 2, 'this filter knows what’s up', NULL, 'this-filter-knows-whats-up', NULL, 'upload', NULL, 'uploads/4.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(5, 2, 'we just did a good thing', NULL, 'we-just-did-a-good-thing', NULL, 'upload', NULL, 'uploads/5.mp4', 'public', 0, 1, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 07:14:59'),
(6, 2, 'it all happened so fast', NULL, 'it-all-happened-so-fast', NULL, 'upload', NULL, 'uploads/6.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(7, 2, 'When we unite behind science & public health we save lives', NULL, 'when-we-unite-behind-science-public-health-we-save-lives', NULL, 'upload', NULL, 'uploads/7.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(8, 2, 'ALL midwives for their efforts to save lives of moms and babies.', NULL, 'all-midwives-for-their-efforts-to-save-lives-of-moms-and-babies', NULL, 'upload', NULL, 'uploads/8.mp4', 'public', 0, 0, 'United States', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(9, 2, 'How do Vaccines Work?', NULL, 'how-do-vaccines-work', NULL, 'upload', NULL, 'uploads/5.mp4', 'public', 0, 1, 'United States', NULL, NULL, '2025-06-18 00:51:24', '2025-06-20 19:32:52'),
(10, 2, 'Join us in celebrating health workers today!', NULL, 'join-us-in-celebrating-health-workers-today', NULL, 'upload', NULL, 'uploads/1.mp4', 'public', 0, 0, 'United States', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(11, 2, 'What will you do at home?', NULL, 'what-will-you-do-at-home', NULL, 'upload', NULL, 'uploads/3.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(12, 2, 'I know a mf can hear me', NULL, 'i-know-a-mf-can-hear-me', NULL, 'upload', NULL, 'uploads/7.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(13, 2, 'she only got a tiny little bit of the crust !', NULL, 'she-only-got-a-tiny-little-bit-of-the-crust', NULL, 'upload', NULL, 'uploads/6.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(14, 2, 'buzz lightyear who ?????', NULL, 'buzz-lightyear-who', NULL, 'upload', NULL, 'uploads/4.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(15, 2, 'I can put it in a bun', NULL, 'i-can-put-it-in-a-bun', NULL, 'upload', NULL, 'uploads/8.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(16, 2, 'vegan strawberry milk', NULL, 'vegan-strawberry-milk', NULL, 'upload', NULL, 'uploads/1.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(17, 2, 'quesadilla pocket', NULL, 'quesadilla-pocket', NULL, 'upload', NULL, 'uploads/2.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(18, 2, 'in grade 7 a kid told me', NULL, 'in-grade-7-a-kid-told-me', NULL, 'upload', NULL, 'uploads/3.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(19, 2, 'whipped matcha', NULL, 'whipped-matcha', NULL, 'upload', NULL, 'uploads/5.mp4', 'public', 0, 0, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-06-18 00:51:24'),
(20, 2, 'Cat Father: Volume IV', NULL, 'cat-father-volume-iv', NULL, 'upload', NULL, 'uploads/6.mp4', 'public', 0, 1, 'Bangladesh', NULL, NULL, '2025-06-18 00:51:24', '2025-07-16 08:10:04'),
(21, 4, 'splendid video', 'splendid video', 'splendid-video-1752674798', NULL, 'upload', NULL, 'uploads/1752674798.mp4', 'public', 1, 5, NULL, 'apply now', 'http://127.0.0.1:8000/upload', '2025-07-16 08:36:38', '2025-07-22 07:22:24'),
(22, 4, 'youtube url', 'youtube url', 'youtube-url-1752752886', 'https://www.youtube.com/embed/0QkxlvLiBrI?si=L3YSHEz2A4s3xzfz', 'url', NULL, NULL, 'public', 1, 6, NULL, NULL, NULL, '2025-07-17 06:18:07', '2025-07-29 01:34:53'),
(23, 4, 'mortal combat', 'mortal combat', 'mortal-combat-1752846366', 'https://www.youtube.com/embed/ZdC5mFHPldg?si=47XZ0YSX--rTEmTG', 'url', 'https://img.youtube.com/vi/ZdC5mFHPldg/hqdefault.jpg', NULL, 'public', 1, 2, NULL, NULL, NULL, '2025-07-18 08:16:07', '2025-07-22 00:11:42'),
(24, 4, 'Testing', 'Testing', 'testing-1753179697', NULL, 'upload', NULL, 'uploads/1753179698.mp4', 'pending', 0, 0, NULL, NULL, NULL, '2025-07-22 04:51:38', '2025-07-22 04:51:38'),
(25, 4, 'remote', 'remote', 'remote-1753179783', NULL, 'upload', NULL, 'uploads/1753179783.mp4', 'public', 1, 7, NULL, 'learn more', 'https://chatgpt.com/c/687f27e6-b904-8013-9ccd-f64f2ca8c61b', '2025-07-22 04:53:03', '2025-08-01 07:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_id` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `amount` int(11) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisings`
--
ALTER TABLE `advertisings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertisings_user_id_foreign` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_video_id_foreign` (`video_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`),
  ADD KEY `comments_mention_id_foreign` (`mention_id`);

--
-- Indexes for table `comment_user`
--
ALTER TABLE `comment_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_user_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monetizations`
--
ALTER TABLE `monetizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monetizations_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_user_id_foreign` (`user_id`);

--
-- Indexes for table `photo_comments`
--
ALTER TABLE `photo_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_comment_user`
--
ALTER TABLE `photo_comment_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_items`
--
ALTER TABLE `photo_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_items_photo_id_foreign` (`photo_id`);

--
-- Indexes for table `photo_user`
--
ALTER TABLE `photo_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_parent_id_foreign` (`parent_id`),
  ADD KEY `reports_video_id_foreign` (`video_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_slug_unique` (`slug`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_follower`
--
ALTER TABLE `user_follower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_follower_following_id_index` (`following_id`),
  ADD KEY `user_follower_follower_id_index` (`follower_id`),
  ADD KEY `user_follower_accepted_at_index` (`accepted_at`);

--
-- Indexes for table `user_video`
--
ALTER TABLE `user_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_video_video_id_foreign` (`video_id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `videos_slug_unique` (`slug`),
  ADD KEY `videos_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraws_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisings`
--
ALTER TABLE `advertisings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment_user`
--
ALTER TABLE `comment_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `monetizations`
--
ALTER TABLE `monetizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `photo_comments`
--
ALTER TABLE `photo_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photo_comment_user`
--
ALTER TABLE `photo_comment_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `photo_items`
--
ALTER TABLE `photo_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photo_user`
--
ALTER TABLE `photo_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_follower`
--
ALTER TABLE `user_follower`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_video`
--
ALTER TABLE `user_video`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisings`
--
ALTER TABLE `advertisings`
  ADD CONSTRAINT `advertisings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_mention_id_foreign` FOREIGN KEY (`mention_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_user`
--
ALTER TABLE `comment_user`
  ADD CONSTRAINT `comment_user_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `monetizations`
--
ALTER TABLE `monetizations`
  ADD CONSTRAINT `monetizations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photo_items`
--
ALTER TABLE `photo_items`
  ADD CONSTRAINT `photo_items_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_video`
--
ALTER TABLE `user_video`
  ADD CONSTRAINT `user_video_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
