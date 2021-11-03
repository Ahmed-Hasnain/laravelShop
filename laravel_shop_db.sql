-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 08:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'aliamin7000@gmail.com', '12345', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'samsung', '1632995359.png', '1', '2021-08-27 09:51:59', '2021-09-30 04:49:19'),
(3, 'nokia', '1632995367.png', '1', '2021-08-27 09:52:06', '2021-09-30 04:49:27'),
(4, 'sony', '1632995376.png', '1', '2021-08-27 09:52:14', '2021-09-30 04:49:36'),
(5, 'panasonic', '1632995386.png', '1', '2021-08-27 09:52:22', '2021-09-30 04:49:46'),
(6, 'infinix', '1632995399.png', '1', '2021-08-27 09:52:29', '2021-09-30 04:49:59'),
(7, 'watec', '1632995408.png', '1', '2021-08-29 05:29:02', '2021-09-30 04:50:08'),
(8, 'hikvissionsasda', '1632995422.png', '1', '2021-08-29 05:32:21', '2021-09-30 04:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('Reg','Not-Reg') NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `user_type`, `product_id`, `product_attr_id`, `qty`, `added_on`) VALUES
(7, 5, 'Reg', 5, 9, 1, '2021-10-14 02:54:53'),
(8, 5, 'Reg', 8, 20, 1, '2021-10-14 02:55:00'),
(9, 5, 'Reg', 6, 15, 5, '2021-10-14 02:55:08'),
(10, 5, 'Reg', 9, 21, 10, '2021-10-14 02:55:18'),
(43, 6, 'Reg', 6, 15, 1, '2021-10-29 11:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `parent_category_id`, `category_image`, `is_home`, `created_at`, `updated_at`, `status`) VALUES
(1, 'sports', 'sports', 7, '1630528161.jpg', 0, '2021-07-18 15:57:40', '2021-09-28 10:40:31', 1),
(2, 'health', 'health', 7, '1632919919.jpg', 1, '2021-07-18 15:59:03', '2021-09-30 14:33:29', 1),
(3, 'kids', 'kids', 7, '1632918371.jpg', 1, '2021-07-18 16:04:19', '2021-09-29 07:26:11', 1),
(7, 'entertainment', 'entertainment', 0, '1632918376.jpg', 0, '2021-08-13 16:38:19', '2021-09-29 07:26:16', 1),
(8, 'Dark Humor', 'dark-humor', 0, '1632918382.jpg', 1, '2021-08-14 16:27:31', '2021-09-29 07:26:22', 1),
(9, 'technology', 'technology', 0, '1632918387.jpg', 0, '2021-08-14 16:36:20', '2021-09-29 07:35:32', 1),
(10, 'games', 'games', 0, '1632918393.jpg', 1, '2021-08-14 16:41:13', '2021-09-29 07:26:33', 1),
(12, 'dramaaaa', 'drama', 9, '1632918399.jpg', 0, '2021-08-14 16:51:25', '2021-09-29 07:26:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Black', 1, '2021-08-16 16:19:52', '2021-08-17 02:17:12'),
(2, 'white', 1, '2021-08-16 16:20:17', '2021-08-17 02:17:15'),
(3, 'Blue', 1, '2021-08-16 16:20:25', '2021-08-17 02:17:17'),
(4, 'Red', 1, '2021-08-16 16:20:42', '2021-08-16 16:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Value','Per') COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_order_amount` int(11) DEFAULT NULL,
  `is_one_time` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `code`, `value`, `type`, `min_order_amount`, `is_one_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'january', '50_off', '50', 'Value', 250, 1, 0, '2021-08-14 18:20:52', '2021-09-01 14:45:45'),
(3, 'Aprail', '30_off', '300', 'Value', 500, 0, 1, '2021-08-14 18:23:23', '2021-08-16 15:06:30'),
(4, 'new coup', '123', '50', 'Per', 1000, 0, 1, '2021-09-01 14:47:05', '2021-09-01 14:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `is_varify` int(11) DEFAULT NULL,
  `rand_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_forgot_password` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `password`, `address`, `city`, `state`, `zip`, `company`, `gstin`, `status`, `is_varify`, `rand_id`, `is_forgot_password`, `created_at`, `updated_at`) VALUES
(1, 'hasnain', 'hasnain@gmail.com', '3225555205', '12345', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '0', 0, '2021-10-09 07:20:04', '2021-10-09 07:20:04'),
(2, 'usman', 'usman@gmail.com', '3225555205', 'eyJpdiI6Inc5YitKRVdPZVg5cDNFaklNVEZTOGc9PSIsInZhbHVlIjoiNnRmOEllZEgxNSs1aU5EV2NaSk1xZz09IiwibWFjIjoiZTgxMTQyZGQwZDI3MDdjMjRmNjgxNTRiNWJmYTk1N2IwNTRkNWFhMTM2MGJhNWRiYzc2OTlmY2E1NTM0NWUyMiIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '329692331', 1, '2021-10-09 07:24:18', '2021-10-09 07:24:18'),
(5, 'shumsy', 'shumsytechnologies1@gmail.com', '1234567891', 'eyJpdiI6IjJHNDBRNDViZDRPQmYzWk1EaUhJcUE9PSIsInZhbHVlIjoiWExkSUtwUk9Oa0JXNEFDa0NoS3NwUT09IiwibWFjIjoiMDkxN2MzNzM5NGQ1MThkMTViOGQxYWZkNGIxNGE3MDFjNmRhZjNhNWVlYTI5NjllZjJhMTE4YThmZWFjNjAxMyIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '', 0, '2021-10-12 02:45:44', '2021-10-12 02:45:44'),
(6, 'Ahmed Hasnain', 'ahmedhasnainmughal@gmail.com', '3225555205', 'eyJpdiI6IjhLSDZtZHQ1MVNXejBtQkpTZ3NGOEE9PSIsInZhbHVlIjoiZUxrZ1dHeER2NWFUTnBnTkh5Mjk4dz09IiwibWFjIjoiMzNlMDkzNmM3YzRmZjlhM2Q5ZTA1YmU1YTM0MTRiZDE5NzU4ZmM0NWFjMzIwMmM2YzJlNThjZWQ0Mjg5M2U4NyIsInRhZyI6IiJ9', 'House no 594, block f, satellite town', 'rawalpindi', 'Punjab', '46000', 'ShumsyTechnologies', '4949494949', 1, 1, '', 0, '2021-10-12 03:22:57', '2021-10-12 03:22:57'),
(7, 'qwe', 'zxcvbn@gmail.com', '3135382006', 'eyJpdiI6IkJ6L2tpV1V4cCtscFVnN0wzR3ZhZ3c9PSIsInZhbHVlIjoiT0xkemd0RU1kOWRkZE1yWTVLWHF5Zz09IiwibWFjIjoiNjNmNTYwMmJkZTRiN2Q0ODBhOWE2OWVhOTM1YzEzYzlmOWY4YmY0YmVjMmJjNDE0ZGQ3OTllMjI5YjljYTUwNCIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '566626286', 0, '2021-10-25 20:07:46', '2021-10-25 20:07:46'),
(8, 'qwe', 'ahmedibrahim@gmail.com', '3135382006', 'eyJpdiI6IlhwcnI1bXRGV2szYlpMRWFYNHlNMmc9PSIsInZhbHVlIjoidUNqcVNCaG9ZczA1cW5ScjJvTER0QT09IiwibWFjIjoiMzA1YTZkZDUyMDljMGQ4OTMyYmY1NzY2ZGUwNGIwNjdhOTMxNjFlYzZkNjQzNmMwZmFmZTk0MDc2OGE4MDUwZiIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '215937650', 0, '2021-10-25 20:10:06', '2021-10-25 20:10:06'),
(9, 'asdfds', 'ahmedibrfgdfgdfgdahim@gmail.com', '3135382006', 'eyJpdiI6InpWOHBZcUY1NmFyMWZ5emNLVkJOdFE9PSIsInZhbHVlIjoid3lOKzFNc21YZUtwWGtzS3JYY3hYQT09IiwibWFjIjoiNjQ2OTVhMDM3MmE1ZGM2MGVkYjUxNjMxMGFiNTE2ODBiNjhhZTZmZGI0ODZiYmEzZjM3YzExNGRiYjkxMjYzZSIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '798154768', 0, '2021-10-25 20:38:52', '2021-10-25 20:38:52'),
(10, 'ghjghj', 'weijbmnvkmc@gmail.com', '3135382006', 'eyJpdiI6ImMreDBXSnc4ZitDaU1pak1uTTlackE9PSIsInZhbHVlIjoiODE3L0F2REhKS2dQbWdOM290SWVvUT09IiwibWFjIjoiMmE0NzhlNjMzZjZhNDU2OTE5ODA1YWY0NTZmN2MwMjU2MWQ1NjYxMTgyZWQ3MjFiODA1YTA0ZDU4MTA2ODg4YSIsInRhZyI6IiJ9', 'sdfsd', 'sdff', 'sdff', '34000', NULL, NULL, 1, 1, '303079435', 0, '2021-10-26 02:05:23', '2021-10-26 02:05:23'),
(11, 'shumsy', 'unpopularmail1@gmail.com', '3135382009', 'eyJpdiI6IlBLb2VYWGFBMlA4N3J5TThqSzh4TWc9PSIsInZhbHVlIjoiM09QeXR6RUZ6VFl4aTdPK21pQi80QT09IiwibWFjIjoiNTgzODQ5MWM0MzVlZTE1MzMzNTNlOTM4YmNmNTM2Yjc2NDRiZmUyMjRkNzc5M2EyYjFiM2JjYjQ5YTRlYTBmOSIsInRhZyI6IiJ9', 'lorum ipsum', 'rwp', 'punjab', '44000', NULL, NULL, 1, 1, '891684479', 0, '2021-10-26 02:08:47', '2021-10-26 02:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_txt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `image`, `btn_txt`, `btn_link`, `text_1`, `heading`, `text_2`, `status`, `created_at`, `updated_at`) VALUES
(1, '1633025781.jpg', 'Shop Now', 'http://127.0.0.1:8000/', 'Sale upto 50%', 'Shumsy Cloth Houses', 'Lorum ipsum delore perfogore', 1, '2021-09-30 09:29:55', '2021-09-30 13:16:21'),
(2, '1633025790.jpg', 'Shop Now', 'http://127.0.0.1:8000/', 'Sale upto 50%', 'Outfitters', 'Lorum ipsum delore perfogore', 1, '2021-09-30 09:31:47', '2021-09-30 13:16:30'),
(3, '1633025800.jpg', 'Shop Now', 'http://127.0.0.1:8000/', 'Sale upto 50%', 'Breakout', 'Lorum ipsum delore perfogore', 1, '2021-09-30 09:32:10', '2021-09-30 13:16:40'),
(4, '1633025810.jpg', 'Our Shop', 'http://127.0.0.1:8000/', 'Sale upto 70%', 'Grohe', 'Lorum ipsum delore perfogore', 1, '2021-09-30 09:46:40', '2021-09-30 13:16:51');

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
(1, '2021_07_13_202548_create_admins_table', 1),
(2, '2021_07_15_200453_create_categories_table', 2),
(3, '2021_08_14_220409_create_coupons_table', 3),
(4, '2021_08_16_200918_create_sizes_table', 4),
(5, '2021_08_16_210529_create_colors_table', 5),
(6, '2021_08_17_200230_create_products_table', 6),
(7, '2021_08_27_140629_create_brands_table', 7),
(8, '2021_09_02_201321_create_taxes_table', 8),
(9, '2021_09_28_124459_create_user_lists_table', 9),
(10, '2021_09_28_124751_create_customers_table', 9),
(11, '2021_09_30_133501_create_home_banners_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `oders_detail`
--

CREATE TABLE `oders_detail` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `products_attr_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oders_detail`
--

INSERT INTO `oders_detail` (`id`, `orders_id`, `product_id`, `products_attr_id`, `price`, `qty`) VALUES
(1, 5, 5, 9, 1, 1),
(2, 5, 6, 15, 15, 10),
(3, 5, 8, 20, 33, 1),
(4, 5, 9, 21, 1500, 1),
(5, 5, 6, 15, 15, 1),
(6, 5, 8, 20, 33, 1),
(7, 6, 5, 9, 1, 1),
(8, 6, 6, 15, 15, 10),
(9, 6, 8, 20, 33, 1),
(10, 6, 9, 21, 1500, 1),
(11, 6, 6, 15, 15, 1),
(12, 6, 8, 20, 33, 1),
(13, 7, 8, 20, 33, 1),
(14, 7, 9, 21, 1500, 1),
(15, 8, 5, 9, 1, 1),
(16, 8, 8, 20, 33, 1),
(17, 9, 5, 9, 1, 1),
(18, 9, 6, 15, 15, 1),
(19, 10, 8, 20, 33, 1),
(20, 10, 9, 21, 1500, 1),
(21, 11, 5, 9, 1, 1),
(22, 11, 6, 15, 15, 1),
(23, 12, 5, 9, 1, 1),
(24, 12, 6, 15, 15, 1),
(25, 13, 5, 9, 1, 1),
(26, 13, 6, 15, 15, 1),
(27, 13, 9, 21, 1500, 1),
(28, 14, 9, 21, 1500, 1),
(29, 14, 8, 20, 33, 1),
(30, 15, 6, 15, 15, 1),
(31, 15, 9, 21, 1500, 1),
(32, 15, 8, 20, 33, 1),
(33, 16, 9, 21, 1500, 1),
(34, 17, 9, 21, 1500, 3),
(35, 17, 6, 15, 15, 1),
(36, 18, 8, 20, 33, 1),
(37, 18, 5, 9, 1, 1),
(38, 18, 6, 15, 15, 1),
(39, 18, 9, 21, 1500, 1),
(40, 19, 8, 20, 33, 1),
(41, 19, 5, 9, 1, 1),
(42, 19, 6, 15, 15, 1),
(43, 19, 9, 21, 1500, 1),
(44, 20, 9, 21, 1500, 1),
(45, 20, 5, 9, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `customer_id` int(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_value` int(11) DEFAULT NULL,
  `order_status` int(11) NOT NULL,
  `payment_type` enum('COD','Gateway') NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_id` varchar(50) DEFAULT NULL,
  `total_amount` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `track_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `name`, `email`, `mobile`, `address`, `city`, `state`, `pincode`, `coupon_code`, `coupon_value`, `order_status`, `payment_type`, `payment_status`, `payment_id`, `total_amount`, `added_on`, `track_details`) VALUES
(6, 6, 'Ahmed Hasnain', 'ahmedhasnainmughal@gmail.com', '3225555205', 'House no 594, block f, satellite town', 'rawalpindi', 'Punjab', '46000', NULL, 0, 1, 'COD', 'Fail', '', 1732, '2021-10-17 10:29:45', 'on the way'),
(7, 6, 'Ahmed Hasnain', 'ahmedhasnainmughal@gmail.com', '3225555205', 'House no 594, block f, satellite town', 'rawalpindi', 'Punjab', '46000', NULL, 0, 3, 'COD', 'Fail', '', 1533, '2021-10-17 10:39:52', NULL),
(11, NULL, 'asdas', 'asdasd@gmail.com', '3135382006', 'asdasd', 'asdads', 'asdasd', '123458', NULL, 0, 1, 'COD', 'Pending', '', 16, '2021-10-26 12:47:33', NULL),
(12, 8, 'qwe', 'ahmedibrahim@gmail.com', '3135382006', 'asdas', 'asd', 'zxc', '123456', NULL, 0, 1, 'COD', 'Pending', '', 16, '2021-10-26 01:10:06', NULL),
(13, 8, 'qwe', 'ahmedibraasdhim@gmail.com', '3135382006', 'asdasd', 'asdd', 'asdd', '123456', NULL, 0, 1, 'COD', 'Pending', '', 1516, '2021-10-26 01:35:04', NULL),
(14, 9, 'asdfds', 'ahmedibrfgdfgdfgdahim@gmail.com', '3135382006', 'asd', 'asdf', 'asdf', '12345', NULL, 0, 1, 'COD', 'Pending', '', 1533, '2021-10-26 01:38:52', NULL),
(15, 10, 'ghjghj', 'weijbmnvkmc@gmail.com', '3135382006', 'sdfsd', 'sdff', 'sdff', '34000', NULL, 0, 1, 'COD', 'Pending', '', 1548, '2021-10-26 07:05:31', NULL),
(16, 11, 'shumsy', 'unpopularmail1@gmail.com', '3135382009', 'lorum ipsum', 'rwp', 'punjab', '44000', NULL, 0, 1, 'COD', 'Pending', '', 1500, '2021-10-26 07:08:51', NULL),
(17, 6, 'Ahmed Hasnain', 'ahmedhasnainmughal@gmail.com', '3225555205', 'House no 594, block f, satellite town', 'rawalpindi', 'Punjab', '46000', NULL, 0, 1, 'COD', 'Pending', '', 4515, '2021-10-27 11:00:33', NULL),
(18, 6, 'Ahmed Hasnain', 'ahmedhasnainmughal@gmail.com', '3225555205', 'House no 594, block f, satellite town', 'rawalpindi', 'Punjab', '46000', NULL, 0, 1, 'COD', 'Pending', '', 1549, '2021-10-27 11:44:51', NULL),
(19, 6, 'Ahmed Hasnain', 'ahmedhasnainmughal@gmail.com', '3225555205', 'House no 594, block f, satellite town', 'rawalpindi', 'Punjab', '46000', NULL, 0, 1, 'COD', 'Pending', '', 1549, '2021-10-27 11:45:25', NULL),
(20, 6, 'Ahmed Hasnain', 'ahmedhasnainmughal@gmail.com', '3225555205', 'House no 594, block f, satellite town', 'rawalpindi', 'Punjab', '46000', '123', 751, 1, 'COD', 'Pending', '', 1501, '2021-10-27 02:29:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `id` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`id`, `order_status`) VALUES
(1, 'placed'),
(2, 'processing'),
(3, 'recieved'),
(4, 'refund');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `technical_specs` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uses` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_promo` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `is_discounted` int(11) NOT NULL,
  `is_trending` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `brand_id`, `model`, `short_desc`, `desc`, `keywords`, `technical_specs`, `uses`, `warranty`, `lead_time`, `tax_id`, `is_promo`, `is_featured`, `is_discounted`, `is_trending`, `status`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(5, 2, '123', '3', '123', '<p>123</p>', '<p>dark</p>', '<p>123</p>', '<p>123</p>', '<p>123</p>', '<p>123</p>', NULL, NULL, 0, 0, 0, NULL, 1, '123', '1629297790.png', '2021-08-18 09:43:10', '2021-10-05 10:35:37'),
(6, 2, '1', '3', 'dark', '<p>567</p>', '<p>7,gtx</p>', '<p>8</p>', '<p>9</p>', '<p>10</p>', '<p>111</p>', '2 days', '1', 1, 1, 1, NULL, 1, '1213123131231', '1632821559.jpg', '2021-08-22 09:03:48', '2021-10-05 10:35:45'),
(8, 2, 'dark', '5', 'n90', '<p>DASD</p>', '<p>ASDASD</p>', '<p>ASDAS</p>', '<p>ASDASD</p>', '<p>ADASD</p>', '<p>ASASAS</p>', '2 days', '1', 1, 0, 1, NULL, 1, 'darkhumor', '1632991002.png', '2021-09-30 03:36:43', '2021-09-30 04:18:24'),
(9, 2, 'GTX 120 Radion', '2', 'GTX R20', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, dark, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Will be delivered in 2 days', '2', 1, 1, 1, NULL, 1, 'games', '1633086389.jpg', '2021-09-30 03:40:47', '2021-10-01 06:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `product_attr`
--

CREATE TABLE `product_attr` (
  `id` int(11) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `attr_image` varchar(255) DEFAULT NULL,
  `mrp` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attr`
--

INSERT INTO `product_attr` (`id`, `sku`, `attr_image`, `mrp`, `price`, `qty`, `size_id`, `color_id`, `product_id`) VALUES
(9, '12345', 'test', 1, 1, 123, 0, 0, 5),
(12, '4', 'test', 4, 4, 4, 3, 3, 4),
(13, '5', 'test', 5, 5, 5, 3, 1, 4),
(15, '13', '876361519.jpg', 14, 15, 16, 4, 4, 6),
(16, '1333', '516455062.jpg', 10, 33, 10, 3, 4, 6),
(17, 'test123456', '202957209.jpg', 1, 2, 3, 3, 3, 7),
(18, 'test1234567', '441149215.jpg', 1, 2, 3, 3, 3, 7),
(20, '1', '647712371.jpg', 1, 33, 44, 4, 3, 8),
(21, '46346345634', '130864598.jpg', 2000, 1500, 44, 4, 4, 9),
(22, '67867976899', '144701924.jpg', 2500, 2000, 44, 5, 3, 9),
(23, 'sadad87a6s896d', '450983649.jpg', 10, 1200, 10, 1, 1, 9),
(24, 'asda098as9089', '751900766.jpg', 10, 1000, 5, 1, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `images`) VALUES
(2, 6, '692339479.jpg'),
(10, 5, '480483101.jpg'),
(15, 6, '628282370.jpg'),
(16, 6, '628282370.jpg'),
(17, 6, '628282370.jpg'),
(18, 8, '532451730.jpg'),
(19, 9, '836474227.jpg'),
(20, 9, '753576030.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `customer_id`, `product_id`, `rating`, `review`, `status`, `added_on`) VALUES
(1, 6, 9, 'Good', 'hi i am hasnain', 1, '2021-10-29 12:51:04'),
(2, 6, 9, 'Good', 'i like this', 1, '2021-10-29 01:01:08'),
(3, 6, 9, 'Bad', 'i dont like this', 1, '2021-10-29 01:01:29'),
(4, 2, 9, 'Bad', 'qweqwe', 1, '2021-10-29 01:16:26'),
(5, 2, 9, 'Good', 'This is a good product', 1, '2021-10-29 01:23:26'),
(6, 2, 5, 'Better', 'it is good', 1, '2021-10-29 01:24:40'),
(7, 6, 5, 'Bad', 'it is bad', 1, '2021-10-29 01:25:31'),
(8, 6, 5, 'Good', 'it is better', 1, '2021-10-29 01:25:52'),
(9, 6, 5, 'Bad', 'asasd', 0, '2021-10-29 01:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `status`, `created_at`, `updated_at`) VALUES
(1, '210', 1, '2021-08-16 15:48:33', '2021-08-16 15:49:24'),
(2, '10', 0, '2021-08-16 15:49:32', '2021-08-16 15:49:58'),
(3, '20', 1, '2021-08-16 15:49:38', '2021-08-16 15:49:38'),
(4, '30', 1, '2021-08-16 15:49:46', '2021-08-16 15:50:02'),
(5, '40', 1, '2021-08-16 15:49:54', '2021-08-16 15:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax_desc`, `tax_value`, `created_at`, `updated_at`) VALUES
(1, 'Percentage', '100', '2021-09-02 15:39:58', '2021-09-02 15:41:23'),
(2, 'Value', '200', '2021-09-02 15:41:34', '2021-09-02 15:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_lists`
--

CREATE TABLE `user_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oders_detail`
--
ALTER TABLE `oders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attr`
--
ALTER TABLE `product_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_lists`
--
ALTER TABLE `user_lists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `oders_detail`
--
ALTER TABLE `oders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_attr`
--
ALTER TABLE `product_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_lists`
--
ALTER TABLE `user_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
