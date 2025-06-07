-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 10:33 AM
-- Server version: 9.1.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haf_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `full_name`, `house_number`, `city`, `state`, `postal_code`, `created_at`) VALUES
(1, 2, 'YIQI', '9,Lorong Bayu', 'George Town', 'Penang', '14000', '2025-05-11 04:27:47'),
(2, 1, 'yi', '232', 'Butterworth', 'Penang', '14000', '2025-05-11 15:33:12'),
(3, 1, 'YIQI', '12131221212', 'Bukit Mertajam', 'Penang', '121212', '2025-05-18 16:01:08'),
(4, 6, 'YIQI', '121312', 'Nibong Tebal', 'Penang', '14000', '2025-06-06 17:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `quantity`) VALUES
(1, 11, 1),
(2, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `action` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES
(1, 1, 'logout', 'User logged out', '2025-05-16 16:45:51'),
(2, NULL, 'login_failed', '{\"username\":\"admin\"}', '2025-05-16 16:45:55'),
(3, NULL, 'login_failed', '{\"username\":\"admin\"}', '2025-05-16 16:46:06'),
(4, NULL, 'login_failed', '{\"username\":\"admin\"}', '2025-05-16 16:46:10'),
(5, NULL, 'login_failed', '{\"username\":\"admin\"}', '2025-05-16 16:46:15'),
(6, NULL, 'login_failed', '{\"username\":\"admin\"}', '2025-05-16 16:46:33'),
(7, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:49:09'),
(8, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:49:10'),
(9, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:49:19'),
(10, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:54:16'),
(11, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:54:18'),
(12, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:54:20'),
(13, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:54:20'),
(14, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:54:20'),
(15, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:54:20'),
(16, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:54:21'),
(17, NULL, 'login_failed', '{\"username\":\"user\"}', '2025-05-16 16:54:21'),
(18, 2, 'view_wishlist', '{\"product_count\":0}', '2025-05-17 15:09:18'),
(19, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:09:22'),
(20, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:09:24'),
(21, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:09:26'),
(22, 2, 'add_to_cart', '{\"product_id\":1,\"quantity\":1}', '2025-05-17 15:09:26'),
(23, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:09:28'),
(24, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:09:30'),
(25, 2, 'add_to_wishlist', '{\"product_id\":1}', '2025-05-17 15:09:30'),
(26, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:13'),
(27, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:15'),
(28, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:17'),
(29, 2, 'remove_from_wishlist', '{\"product_id\":1}', '2025-05-17 15:12:17'),
(30, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:17'),
(31, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:18'),
(32, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:19'),
(33, 2, 'add_to_wishlist', '{\"product_id\":2}', '2025-05-17 15:12:19'),
(34, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:19'),
(35, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:25'),
(36, 2, 'view_wishlist', '{\"product_count\":1}', '2025-05-17 15:12:26'),
(37, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:29'),
(38, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:33'),
(39, 2, 'add_to_wishlist', '{\"product_id\":1}', '2025-05-17 15:12:33'),
(40, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:12:33'),
(41, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:06'),
(42, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:12'),
(43, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:16'),
(44, 2, 'view_wishlist', '{\"product_count\":2}', '2025-05-17 15:22:16'),
(45, 2, 'view_wishlist', '{\"product_count\":2}', '2025-05-17 15:22:18'),
(46, 2, 'remove_from_wishlist', '{\"product_id\":2}', '2025-05-17 15:22:18'),
(47, 2, 'view_wishlist', '{\"product_count\":1}', '2025-05-17 15:22:18'),
(48, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:20'),
(49, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:22'),
(50, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:22'),
(51, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:23'),
(52, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:23'),
(53, 2, 'logout', 'User logged out', '2025-05-17 15:22:29'),
(54, 1, 'login', 'User logged in successfully', '2025-05-17 15:22:32'),
(55, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:32'),
(56, 1, 'add_product', '{\"name_zh\":\"1\",\"category\":\"1\",\"stock\":11}', '2025-05-17 15:22:52'),
(57, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:54'),
(58, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:56'),
(59, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:56'),
(60, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:22:56'),
(61, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:31:54'),
(62, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:31:55'),
(63, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:31:56'),
(64, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:31:56'),
(65, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:36:27'),
(66, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:36:27'),
(67, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:36:28'),
(68, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:36:28'),
(69, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:36:28'),
(70, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-17 15:37:41'),
(71, 1, 'logout', 'User logged out', '2025-05-17 15:37:46'),
(72, 1, 'login', 'User logged in successfully', '2025-05-17 15:38:27'),
(73, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:27'),
(74, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:30'),
(75, 1, 'add_to_wishlist', '{\"product_id\":3}', '2025-05-17 15:38:30'),
(76, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:30'),
(77, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:32'),
(78, 1, 'add_product', '{\"name_zh\":\"1\",\"category\":\"1\",\"stock\":1}', '2025-05-17 15:38:48'),
(79, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:50'),
(80, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:52'),
(81, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:53'),
(82, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:53'),
(83, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:38:53'),
(84, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:49:42'),
(85, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:49:43'),
(86, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:49:43'),
(87, 1, 'add_product', '{\"name_zh\":\"1\",\"category\":\"1\",\"stock\":1}', '2025-05-17 15:50:07'),
(88, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:09'),
(89, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:10'),
(90, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:11'),
(91, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:13'),
(92, 1, 'submit_review', '{\"product_id\":5,\"rating\":5}', '2025-05-17 15:50:13'),
(93, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:13'),
(94, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:15'),
(95, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:17'),
(96, 1, 'submit_review', '{\"product_id\":5,\"rating\":4}', '2025-05-17 15:50:17'),
(97, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:17'),
(98, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:18'),
(99, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:23'),
(100, 1, 'add_to_cart', '{\"product_id\":5,\"quantity\":1}', '2025-05-17 15:50:23'),
(101, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:50:23'),
(102, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:55:36'),
(103, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:58:55'),
(104, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:58:56'),
(105, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:58:56'),
(106, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:58:57'),
(107, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:58:57'),
(108, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:58:57'),
(109, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:58:57'),
(110, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-17 15:58:58'),
(111, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 15:59:02'),
(112, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:01:28'),
(113, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:01:29'),
(114, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:01:29'),
(115, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:01:29'),
(116, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:01:29'),
(117, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:01:38'),
(118, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:23'),
(119, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:24'),
(120, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:24'),
(121, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:24'),
(122, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(123, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(124, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(125, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(126, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(127, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(128, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(129, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(130, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(131, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(132, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(133, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(134, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(135, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(136, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(137, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(138, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(139, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(140, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(141, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:25'),
(142, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(143, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(144, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(145, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(146, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(147, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(148, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(149, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(150, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(151, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(152, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(153, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(154, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(155, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(156, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(157, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(158, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(159, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(160, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(161, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(162, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(163, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(164, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(165, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(166, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(167, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(168, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(169, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(170, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(171, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(172, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:26'),
(173, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:27'),
(174, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:27'),
(175, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:27'),
(176, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:27'),
(177, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:27'),
(178, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:27'),
(179, 2, 'login', 'User logged in successfully', '2025-05-17 16:10:40'),
(180, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:40'),
(181, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:43'),
(182, 2, 'add_to_cart', '{\"product_id\":3,\"quantity\":1}', '2025-05-17 16:10:43'),
(183, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:50'),
(184, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:52'),
(185, 2, 'add_to_wishlist', '{\"product_id\":5}', '2025-05-17 16:10:52'),
(186, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:52'),
(187, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:54'),
(188, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:10:59'),
(189, 2, 'view_wishlist', '{\"product_count\":2}', '2025-05-17 16:11:00'),
(190, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:11:03'),
(191, 2, 'logout', 'User logged out', '2025-05-17 16:11:08'),
(192, 1, 'login', 'User logged in successfully', '2025-05-17 16:11:13'),
(193, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:11:13'),
(194, 1, 'add_product', '{\"name_zh\":\"1213132\",\"category\":\"21312\",\"stock\":3123213123}', '2025-05-17 16:11:41'),
(195, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:11:42'),
(196, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:11:49'),
(197, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:11:49'),
(198, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:12:15'),
(199, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 16:20:23'),
(200, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 17:46:56'),
(201, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-17 17:47:01'),
(202, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 13:21:02'),
(203, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:00:33'),
(204, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:00:41'),
(205, 1, 'add_to_cart', '{\"product_id\":6,\"quantity\":1}', '2025-05-18 16:00:41'),
(206, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:01:12'),
(207, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:01:14'),
(208, 1, 'add_to_cart', '{\"product_id\":6,\"quantity\":1}', '2025-05-18 16:01:14'),
(209, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:01:57'),
(210, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:02'),
(211, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:05'),
(212, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:07'),
(213, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:09'),
(214, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:12'),
(215, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:15'),
(216, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:16'),
(217, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:18'),
(218, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:24'),
(219, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:25'),
(220, 1, 'add_to_cart', '{\"product_id\":6,\"quantity\":1}', '2025-05-18 16:02:25'),
(221, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:43'),
(222, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:49'),
(223, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:50'),
(224, 1, 'add_to_cart', '{\"product_id\":6,\"quantity\":1}', '2025-05-18 16:02:50'),
(225, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:51'),
(226, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:54'),
(227, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:02:57'),
(228, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-18 16:02:59'),
(229, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:00'),
(230, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:01'),
(231, 1, 'add_to_wishlist', '{\"product_id\":6}', '2025-05-18 16:03:01'),
(232, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:01'),
(233, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:03'),
(234, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-18 16:03:04'),
(235, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:14'),
(236, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-18 16:03:15'),
(237, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:15'),
(238, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:18'),
(239, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:31'),
(240, 1, 'add_product', '{\"name_zh\":\"1\",\"category\":\"1\",\"stock\":1}', '2025-05-18 16:03:56'),
(241, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:03:59'),
(242, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:04:04'),
(243, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:04:04'),
(244, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:04:04'),
(245, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:04:05'),
(246, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:04:08'),
(247, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:04:43'),
(248, 1, 'logout', 'User logged out', '2025-05-18 16:04:46'),
(249, 2, 'login', 'User logged in successfully', '2025-05-18 16:05:00'),
(250, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:05:00'),
(251, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:05:02'),
(252, 2, 'add_to_cart', '{\"product_id\":7,\"quantity\":1}', '2025-05-18 16:05:02'),
(253, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:10:49'),
(254, 2, 'logout', 'User logged out', '2025-05-18 16:10:53'),
(255, 1, 'login', 'User logged in successfully', '2025-05-18 16:11:05'),
(256, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:11:05'),
(257, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:32:50'),
(258, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-18 16:32:52'),
(259, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 14:02:10'),
(260, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 14:25:51'),
(261, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 14:59:50'),
(262, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:05:30'),
(263, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:05:37'),
(264, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:05:39'),
(265, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:05:40'),
(266, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:05:41'),
(267, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-25 15:05:43'),
(268, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:05:43'),
(269, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:05:44'),
(270, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:05:46'),
(271, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-25 15:10:44'),
(272, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-26 13:19:46'),
(273, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-26 13:59:55'),
(274, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:10:26'),
(275, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:15:19'),
(276, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:35:45'),
(277, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:38:04'),
(278, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:40:20'),
(279, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:41:44'),
(280, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:41:51'),
(281, 1, 'submit_review', '{\"product_id\":7,\"rating\":5}', '2025-05-28 08:41:51'),
(282, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:41:51'),
(283, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-28 08:41:54'),
(284, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:41:55'),
(285, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:42:01'),
(286, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:42:03'),
(287, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:42:06'),
(288, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:42:09'),
(289, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:42:12'),
(290, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:42:13'),
(291, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:42:14'),
(292, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:44:08'),
(293, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:44:11'),
(294, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:44:14'),
(295, 1, 'add_product', '{\"name_zh\":\"112\",\"category\":\"123\",\"stock\":123}', '2025-05-28 08:45:08'),
(296, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:45:15'),
(297, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:45:29'),
(298, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:45:38'),
(299, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-28 08:45:38'),
(300, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:46:07'),
(301, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 08:46:12'),
(302, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 16:52:53'),
(303, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 16:52:58'),
(304, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-28 16:52:58'),
(305, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-28 16:52:59'),
(306, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:24:20'),
(307, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:26:08'),
(308, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:39:54'),
(309, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:39:56'),
(310, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:39:56'),
(311, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:39:57'),
(312, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:39:57'),
(313, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:40:00'),
(314, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:40:01'),
(315, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:40:06'),
(316, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:44:34'),
(317, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 03:44:35'),
(318, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 03:45:51'),
(319, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:45:55'),
(320, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 03:45:57'),
(321, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:47:03'),
(322, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:51:02'),
(323, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 03:51:04'),
(324, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 03:51:05'),
(325, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 03:51:09'),
(326, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 03:51:14'),
(327, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 03:51:15'),
(328, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:51:18'),
(329, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:51:20'),
(330, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-29 03:51:20'),
(331, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:51:22'),
(332, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:51:24'),
(333, 1, 'add_to_wishlist', '{\"product_id\":8}', '2025-05-29 03:51:24'),
(334, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:51:24'),
(335, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 03:51:25'),
(336, 1, 'add_product', '{\"name_zh\":\"342\",\"category\":\"432\",\"stock\":432}', '2025-05-29 03:57:03'),
(337, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:57:05'),
(338, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:57:09'),
(339, 1, 'add_to_wishlist', '{\"product_id\":9}', '2025-05-29 03:57:09'),
(340, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:57:09'),
(341, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:57:12'),
(342, 1, 'view_wishlist', '{\"product_count\":2}', '2025-05-29 03:57:15'),
(343, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:57:19'),
(344, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 03:59:24'),
(345, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:01:22'),
(346, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:01:29'),
(347, 1, 'add_product', '{\"name_zh\":\"gh\",\"category\":\"324\",\"stock\":342}', '2025-05-29 04:01:51'),
(348, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:01:54'),
(349, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:02:16'),
(350, 1, 'submit_review', '{\"product_id\":10,\"rating\":4}', '2025-05-29 04:02:16'),
(351, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:02:16'),
(352, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:02:17'),
(353, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:18:50'),
(354, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:18:53'),
(355, 1, 'remove_from_wishlist', '{\"product_id\":8}', '2025-05-29 04:18:53'),
(356, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:18:53'),
(357, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:18:54'),
(358, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"all\",\"sort\":\"name_asc\"}', '2025-05-29 04:19:30'),
(359, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"all\",\"sort\":\"name_asc\"}', '2025-05-29 04:23:36'),
(360, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"123\",\"sort\":\"price_asc\"}', '2025-05-29 04:23:46'),
(361, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"all\",\"sort\":\"name_asc\"}', '2025-05-29 04:23:46'),
(362, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:23:47'),
(363, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:23:48'),
(364, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:23:49'),
(365, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:32:02'),
(366, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 04:32:07'),
(367, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 04:32:08'),
(368, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 04:32:21'),
(369, 1, 'remove_from_wishlist', '{\"product_id\":9}', '2025-05-29 04:32:21'),
(370, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 04:32:21'),
(371, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 04:32:37'),
(372, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 04:38:01'),
(373, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:11:26'),
(374, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:11:32'),
(375, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:11:38'),
(376, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:17:21'),
(377, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:17:27'),
(378, 1, 'add_to_cart', '{\"product_id\":10,\"quantity\":1}', '2025-05-29 05:17:27'),
(379, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:17:28'),
(380, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:17:57'),
(381, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:18:29'),
(382, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:21:06'),
(383, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:21:12'),
(384, 1, 'submit_review', '{\"product_id\":8,\"rating\":5}', '2025-05-29 05:21:12'),
(385, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:21:12'),
(386, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:21:12'),
(387, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:21:14'),
(388, 1, 'submit_review', '{\"product_id\":8,\"rating\":5}', '2025-05-29 05:21:14'),
(389, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:21:14'),
(390, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:21:15'),
(391, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:04'),
(392, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:22'),
(393, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:23'),
(394, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:31'),
(395, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:32'),
(396, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:37'),
(397, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 05:23:38'),
(398, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:39'),
(399, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:41'),
(400, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:23:53'),
(401, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 05:24:05'),
(402, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:24:06'),
(403, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:25:46'),
(404, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:25:47'),
(405, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:25:48'),
(406, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:25:48'),
(407, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:25:48'),
(408, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:27:39'),
(409, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:27:40'),
(410, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:27:44'),
(411, 1, 'submit_review', '{\"product_id\":10,\"rating\":5}', '2025-05-29 05:27:44'),
(412, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:27:44'),
(413, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:27:45'),
(414, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:27:48'),
(415, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:17'),
(416, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:25'),
(417, 1, 'add_to_cart', '{\"product_id\":9,\"quantity\":1}', '2025-05-29 05:40:25'),
(418, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:26'),
(419, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:27'),
(420, 1, 'add_to_cart', '{\"product_id\":10,\"quantity\":1}', '2025-05-29 05:40:27'),
(421, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:28'),
(422, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:30'),
(423, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:33'),
(424, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:34'),
(425, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:40:39'),
(426, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:41:38'),
(427, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:41:38'),
(428, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 05:41:41'),
(429, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:41:42'),
(430, 1, 'login', 'User logged in successfully', '2025-05-29 05:46:06'),
(431, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 05:46:06'),
(432, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:29:43'),
(433, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:29:44'),
(434, 1, 'logout', 'User logged out', '2025-05-29 06:52:03'),
(435, NULL, 'admin_login_failed', '{\"username\":\"admin\"}', '2025-05-29 06:52:08'),
(436, NULL, 'admin_login_failed', '{\"username\":\"admin\"}', '2025-05-29 06:52:11'),
(437, NULL, 'admin_login_failed', '{\"username\":\"user\"}', '2025-05-29 06:52:15'),
(438, 1, 'login', 'User logged in successfully', '2025-05-29 06:52:21'),
(439, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:52:21'),
(440, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:52:25'),
(441, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:56:40'),
(442, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:58:38'),
(443, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:58:41'),
(444, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:58:43'),
(445, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:58:48'),
(446, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:58:52'),
(447, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 06:59:12'),
(448, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:02:34'),
(449, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:06:31'),
(450, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:06:34'),
(451, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:07:03'),
(452, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:07:11'),
(453, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 07:07:12'),
(454, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 07:07:29'),
(455, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 07:07:31');
INSERT INTO `logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES
(456, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:09:55'),
(457, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:10:16'),
(458, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:10:27'),
(459, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:10:30'),
(460, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:10:46'),
(461, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:10:48'),
(462, 1, 'view_products', '{\"page\":1,\"search\":\"112\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:10:56'),
(463, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:10:56'),
(464, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:10:59'),
(465, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:01'),
(466, 1, 'view_products', '{\"page\":1,\"search\":\"2323\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:03'),
(467, 1, 'view_products', '{\"page\":1,\"search\":\"112\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:07'),
(468, 1, 'view_products', '{\"page\":1,\"search\":\"112\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:08'),
(469, 1, 'view_products', '{\"page\":1,\"search\":\"112\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:08'),
(470, 1, 'view_products', '{\"page\":1,\"search\":\"112\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:09'),
(471, 1, 'view_products', '{\"page\":1,\"search\":\"112\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:09'),
(472, 1, 'view_products', '{\"page\":1,\"search\":\"112\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:11'),
(473, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"all\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:14'),
(474, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:14'),
(475, 1, 'view_products', '{\"page\":1,\"search\":\"123\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:22'),
(476, 1, 'view_products', '{\"page\":1,\"search\":\"123\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:24'),
(477, 1, 'add_to_wishlist', '{\"product_id\":8}', '2025-05-29 07:11:24'),
(478, 1, 'view_products', '{\"page\":1,\"search\":\"123\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:11:24'),
(479, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:11:27'),
(480, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:15:02'),
(481, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:15:05'),
(482, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:15:05'),
(483, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:15:06'),
(484, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:15:14'),
(485, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:38'),
(486, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:38'),
(487, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:39'),
(488, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:39'),
(489, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(490, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(491, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(492, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(493, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(494, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(495, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(496, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(497, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(498, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(499, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(500, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(501, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(502, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(503, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(504, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(505, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(506, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(507, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(508, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:40'),
(509, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:50'),
(510, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:50'),
(511, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:51'),
(512, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:51'),
(513, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:16:53'),
(514, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:16:59'),
(515, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:17:14'),
(516, 1, 'logout', 'User logged out', '2025-05-29 07:18:09'),
(517, NULL, 'admin_login_failed', '{\"username\":\"admin\"}', '2025-05-29 07:18:41'),
(518, NULL, 'admin_login_failed', '{\"username\":\"admin\"}', '2025-05-29 07:18:43'),
(519, NULL, 'admin_login_failed', '{\"username\":\"admin\"}', '2025-05-29 07:18:45'),
(520, NULL, 'admin_login_failed', '{\"username\":\"user\"}', '2025-05-29 07:18:48'),
(521, 1, 'login', 'User logged in successfully', '2025-05-29 07:18:53'),
(522, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:18:53'),
(523, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:22:31'),
(524, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:23:08'),
(525, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:23:11'),
(526, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:23:12'),
(527, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:23:13'),
(528, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:27:07'),
(529, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:27:08'),
(530, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:27:12'),
(531, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:27:13'),
(532, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:27:14'),
(533, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:27:15'),
(534, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:27:16'),
(535, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:27:27'),
(536, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:29:45'),
(537, 1, 'logout', 'User logged out', '2025-05-29 07:29:46'),
(538, 1, 'login', 'User logged in successfully', '2025-05-29 07:29:50'),
(539, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:29:50'),
(540, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:29:52'),
(541, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:29:53'),
(542, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:29:57'),
(543, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:30:12'),
(544, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:30:12'),
(545, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:32:12'),
(546, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:32:15'),
(547, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:32:17'),
(548, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:32:21'),
(549, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-29 07:32:21'),
(550, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:38:18'),
(551, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:38:20'),
(552, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-29 07:38:20'),
(553, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:41:41'),
(554, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:41:43'),
(555, 1, 'add_to_cart', '{\"product_id\":10,\"quantity\":1}', '2025-05-29 07:41:43'),
(556, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:41:47'),
(557, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:41:49'),
(558, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-29 07:41:49'),
(559, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:46:26'),
(560, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:46:39'),
(561, 1, 'submit_review', '{\"product_id\":10,\"rating\":2}', '2025-05-29 07:46:39'),
(562, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:46:39'),
(563, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:46:41'),
(564, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:46:50'),
(565, 1, 'add_to_cart', '{\"product_id\":9,\"quantity\":1}', '2025-05-29 07:46:50'),
(566, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:47:21'),
(567, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:47:23'),
(568, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:47:30'),
(569, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:47:35'),
(570, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:47:36'),
(571, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:47:41'),
(572, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 07:47:45'),
(573, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:48:05'),
(574, 1, 'logout', 'User logged out', '2025-05-29 07:48:05'),
(575, NULL, 'login_failed', '{\"username\":\"hihgj\"}', '2025-05-29 07:54:14'),
(576, 5, 'login', 'User logged in successfully', '2025-05-29 07:59:36'),
(577, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 07:59:36'),
(578, 5, 'logout', 'User logged out', '2025-05-29 07:59:44'),
(579, 5, 'login', 'User logged in successfully', '2025-05-29 08:00:27'),
(580, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:00:27'),
(581, 5, 'logout', 'User logged out', '2025-05-29 08:00:28'),
(582, 5, 'login', 'User logged in successfully', '2025-05-29 08:08:38'),
(583, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:08:38'),
(584, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:08:38'),
(585, 5, 'logout', 'User logged out', '2025-05-29 08:08:40'),
(586, 5, 'login', 'User logged in successfully', '2025-05-29 08:14:18'),
(587, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:14:18'),
(588, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:14:20'),
(589, 5, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 08:14:21'),
(590, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:14:22'),
(591, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:14:24'),
(592, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:14:41'),
(593, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:14:42'),
(594, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 08:14:43'),
(595, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:24'),
(596, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:38'),
(597, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:40'),
(598, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:42'),
(599, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:46'),
(600, 5, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 16:14:47'),
(601, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:49'),
(602, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:52'),
(603, 5, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 16:14:53'),
(604, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:56'),
(605, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:57'),
(606, 5, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 16:14:58'),
(607, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:58'),
(608, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:14:59'),
(609, 5, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:15:00'),
(610, 5, 'logout', 'User logged out', '2025-05-29 16:15:02'),
(611, 1, 'login', 'User logged in successfully', '2025-05-29 16:15:23'),
(612, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:15:23'),
(613, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:15:28'),
(614, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 16:15:29'),
(615, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:15:29'),
(616, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:15:32'),
(617, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 16:15:35'),
(618, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:15:36'),
(619, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:15:40'),
(620, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:16:56'),
(621, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:17:01'),
(622, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:17:19'),
(623, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-29 16:17:19'),
(624, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 16:17:24'),
(625, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:17:35'),
(626, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 16:22:34'),
(627, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:22:35'),
(628, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:51:19'),
(629, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:51:29'),
(630, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:51:31'),
(631, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:51:35'),
(632, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:51:38'),
(633, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:51:43'),
(634, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 16:54:00'),
(635, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:54:03'),
(636, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:54:07'),
(637, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-29 16:54:07'),
(638, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:54:08'),
(639, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:54:08'),
(640, 1, 'add_to_cart', '{\"product_id\":8,\"quantity\":1}', '2025-05-29 16:54:08'),
(641, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:54:12'),
(642, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:54:14'),
(643, 1, 'add_to_wishlist', '{\"product_id\":9}', '2025-05-29 16:54:14'),
(644, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 16:54:14'),
(645, 1, 'view_wishlist', '{\"product_count\":2}', '2025-05-29 16:54:16'),
(646, 1, 'view_wishlist', '{\"product_count\":2}', '2025-05-29 16:54:19'),
(647, 1, 'remove_from_wishlist', '{\"product_id\":9}', '2025-05-29 16:54:19'),
(648, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 16:54:19'),
(649, 1, 'view_wishlist', '{\"product_count\":1}', '2025-05-29 16:54:20'),
(650, 1, 'remove_from_wishlist', '{\"product_id\":8}', '2025-05-29 16:54:20'),
(651, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 16:54:20'),
(652, 1, 'view_wishlist', '{\"product_count\":0}', '2025-05-29 16:54:23'),
(653, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-29 17:05:19'),
(654, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:58:44'),
(655, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:58:47'),
(656, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:58:48'),
(657, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:58:50'),
(658, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:58:52'),
(659, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:59:44'),
(660, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:59:48'),
(661, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:59:51'),
(662, 1, 'add_to_wishlist', '{\"product_id\":9}', '2025-05-30 01:59:51'),
(663, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:59:51'),
(664, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-05-30 01:59:52'),
(665, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 05:34:21'),
(666, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 05:39:13'),
(667, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:04:18'),
(668, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:18:29'),
(669, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:52:16'),
(670, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:54:36'),
(671, 1, 'view_products', '{\"page\":1,\"search\":\"234\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:54:45'),
(672, 1, 'view_products', '{\"page\":1,\"search\":\"234\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:55:35'),
(673, 1, 'view_wishlist', '{\"product_count\":1}', '2025-06-01 06:55:36'),
(674, 1, 'view_products', '{\"page\":1,\"search\":\"234\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:55:37'),
(675, 1, 'view_products', '{\"page\":1,\"search\":\"234\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:55:39'),
(676, 1, 'view_products', '{\"page\":1,\"search\":\"234\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:55:41'),
(677, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:55:42'),
(678, 1, 'logout', 'User logged out', '2025-06-01 06:55:43'),
(679, 1, 'login', 'User logged in successfully', '2025-06-01 06:56:03'),
(680, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 06:56:03'),
(681, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 11:12:42'),
(682, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 11:12:44'),
(683, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 11:12:46'),
(684, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-01 17:10:14'),
(685, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-02 15:47:23'),
(686, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-02 15:47:28'),
(687, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-02 15:47:30'),
(688, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-02 15:47:31'),
(689, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-02 15:47:34'),
(690, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-05 16:05:28'),
(691, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-05 17:50:50'),
(692, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:46:04'),
(693, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:46:28'),
(694, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:46:50'),
(695, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:49:02'),
(696, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:49:19'),
(697, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:49:24'),
(698, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:49:34'),
(699, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:50:39'),
(700, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:51:09'),
(701, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:52:48'),
(702, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:53:17'),
(703, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:53:46'),
(704, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:54:11'),
(705, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:54:27'),
(706, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:55:16'),
(707, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:55:43'),
(708, 1, 'view_wishlist', '{\"product_count\":1}', '2025-06-06 16:55:51'),
(709, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:56:36'),
(710, 1, 'view_wishlist', '{\"product_count\":0}', '2025-06-06 16:56:37'),
(711, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:56:39'),
(712, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:56:41'),
(713, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:56:46'),
(714, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:56:49'),
(715, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:56:52'),
(716, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 16:56:55'),
(717, 1, 'view_wishlist', '{\"product_count\":0}', '2025-06-06 16:56:58'),
(718, 1, 'view_wishlist', '{\"product_count\":0}', '2025-06-06 16:57:00'),
(719, 1, 'add_product', '{\"name_zh\":\"Haf \\u6807\\u5fd7\\u6027\\u6c34\\u676f\",\"category\":\"Mug\",\"stock\":100}', '2025-06-06 17:01:12'),
(720, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:22'),
(721, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"all\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:36'),
(722, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:37'),
(723, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:42'),
(724, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:45'),
(725, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:47'),
(726, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:50'),
(727, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:54'),
(728, 1, 'view_wishlist', '{\"product_count\":0}', '2025-06-06 17:01:57'),
(729, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:01:59'),
(730, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:02:01'),
(731, 1, 'add_to_cart', '{\"product_id\":11,\"quantity\":1}', '2025-06-06 17:02:01'),
(732, 1, 'view_wishlist', '{\"product_count\":0}', '2025-06-06 17:03:51'),
(733, 1, 'view_wishlist', '{\"product_count\":0}', '2025-06-06 17:03:52'),
(734, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:03:56'),
(735, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:03:57'),
(736, 1, 'add_to_cart', '{\"product_id\":11,\"quantity\":1}', '2025-06-06 17:03:57'),
(737, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:03:58'),
(738, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:04:00'),
(739, 1, 'add_to_wishlist', '{\"product_id\":11}', '2025-06-06 17:04:00'),
(740, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:04:00'),
(741, 1, 'view_wishlist', '{\"product_count\":1}', '2025-06-06 17:04:02'),
(742, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:04:06'),
(743, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:04:26'),
(744, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:04:29'),
(745, 1, 'logout', 'User logged out', '2025-06-06 17:04:34'),
(746, 1, 'login', 'User logged in successfully', '2025-06-06 17:05:38'),
(747, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:05:38'),
(748, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_asc\"}', '2025-06-06 17:08:26'),
(749, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:30'),
(750, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:34'),
(751, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:34'),
(752, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:35'),
(753, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"all\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:38'),
(754, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:45'),
(755, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"all\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:46'),
(756, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:48'),
(757, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:49'),
(758, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_desc\"}', '2025-06-06 17:08:49'),
(759, 1, 'add_product', '{\"name_zh\":\"Haf \\u65e5\\u5e38\\u6c34\\u676f\",\"category\":\"Mug\",\"stock\":100}', '2025-06-06 17:26:52'),
(760, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:26:53'),
(761, 1, 'add_product', '{\"name_zh\":\"Haf \\u65e5\\u5e38T\\u6064\",\"category\":\"clothes\",\"stock\":100}', '2025-06-06 17:33:56'),
(762, 1, 'add_product', '{\"name_zh\":\"Haf \\u8fd0\\u52a8\\u4e0a\\u8863\",\"category\":\"clothes\",\"stock\":100}', '2025-06-06 17:39:17'),
(763, 1, 'add_product', '{\"name_zh\":\"Haf \\u7ecf\\u5178\\u8fde\\u5e3d\\u886b\",\"category\":\"clothes\",\"stock\":100}', '2025-06-06 17:42:41'),
(764, 1, 'add_product', '{\"name_zh\":\"Haf \\u9650\\u91cf\\u7248T\\u6064\\t\",\"category\":\"clothes\",\"stock\":100}', '2025-06-06 17:47:05'),
(765, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:47:12'),
(766, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"clothes\",\"sort\":\"name_asc\"}', '2025-06-06 17:49:20'),
(767, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"name_asc\"}', '2025-06-06 17:49:22'),
(768, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"price_asc\"}', '2025-06-06 17:49:24'),
(769, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"price_asc\"}', '2025-06-06 17:49:29'),
(770, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"Mug\",\"sort\":\"price_asc\"}', '2025-06-06 17:49:36'),
(771, 1, 'logout', 'User logged out', '2025-06-06 17:49:55'),
(772, 6, 'login', 'User logged in successfully', '2025-06-06 17:50:36'),
(773, 6, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:50:36'),
(774, 6, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-06 17:50:40'),
(775, 6, 'add_to_cart', '{\"product_id\":14,\"quantity\":1}', '2025-06-06 17:50:40'),
(776, 6, 'logout', 'User logged out', '2025-06-06 17:51:15'),
(777, 1, 'login', 'User logged in successfully', '2025-06-07 04:58:41'),
(778, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 04:58:41'),
(779, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 05:14:22'),
(780, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:06:09'),
(781, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:06:12'),
(782, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:06:17'),
(783, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:06:19'),
(784, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:06:21'),
(785, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:06:23'),
(786, 1, 'add_product', '{\"name_zh\":\"Haf \\u88c5\\u9970\\u7eb8\\u5e26\",\"category\":\"Bag\",\"stock\":100}', '2025-06-07 07:13:37'),
(787, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:13:40'),
(788, 1, 'add_product', '{\"name_zh\":\"Haf \\u88c5\\u9970\\u7eb8\\u5e26\",\"category\":\"Bag\",\"stock\":100}', '2025-06-07 07:13:45'),
(789, 1, 'add_product', '{\"name_zh\":\"Haf \\u6c34\\u7f50\",\"category\":\"Bottle \",\"stock\":100}', '2025-06-07 07:54:45'),
(790, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:57:48'),
(791, 1, 'view_wishlist', '{\"product_count\":1}', '2025-06-07 07:58:06'),
(792, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 07:58:13'),
(793, 1, 'add_product', '{\"name_zh\":\"Haf \\u8bb0\\u4e8b\\u672c   \\u7528 Haf \\u8bb0\\u4e8b\\u672c\\u8bb0\\u5f55\\u7075\\u611f\\u4e0e\\u751f\\u6d3b\\u70b9\\u6ef4\\uff0c\\u7b80\\u7ea6\\u5c01\\u9762\\u8bbe\\u8ba1\\u642d\\u914d\\u5185\\u9875\\u7ec6\\u81f4\\u6392\\u7248\\uff0c\\u662f\\u5b66\\u4e60\\u4e0e\\u521b\\u610f\\u5de5\\u4f5c\\u7684\\u597d\\u5e2e\\u624b\\u3002 Minimalist and functional, the Haf Notes help you capture ideas anywhere. Buku nota bergaya Haf untuk mencatat inspirasi dan perancangan harian anda.\",\"category\":\"Book\",\"stock\":100}', '2025-06-07 08:01:32'),
(794, 1, 'add_product', '{\"name_zh\":\"Haf \\u73af\\u4fdd\\u888b \",\"category\":\"Bag\",\"stock\":100}', '2025-06-07 08:03:29'),
(795, 1, 'add_product', '{\"name_zh\":\"Haf \\u9999\\u6c1b\\u8721\\u70db \",\"category\":\"Candle\",\"stock\":100}', '2025-06-07 08:05:12'),
(796, 1, 'add_product', '{\"name_zh\":\"Haf \\u8212\\u9002\\u62b1\\u6795\",\"category\":\"Pillow\",\"stock\":100}', '2025-06-07 08:07:17'),
(797, 1, 'add_product', '{\"name_zh\":\"Haf \\u4e0d\\u9508\\u94a2\\u6c34\\u7f50 \",\"category\":\"Bottle \",\"stock\":100}', '2025-06-07 08:08:48'),
(798, 1, 'add_product', '{\"name_zh\":\"Haf \\u72ec\\u7279\\u6c34\\u676f \",\"category\":\"Mug\",\"stock\":100}', '2025-06-07 08:10:13'),
(799, 1, 'add_product', '{\"name_zh\":\"Haf \\u7cbe\\u6cb9\",\"category\":\"Skin Care\",\"stock\":100}', '2025-06-07 08:16:32'),
(800, 1, 'add_product', '{\"name_zh\":\"Haf \\u62a4\\u80a4\\u54c1\\u5957\\u88c5 \",\"category\":\"Skin Care\",\"stock\":100}', '2025-06-07 08:18:51'),
(801, 1, 'add_product', '{\"name_zh\":\" Haf \\u65e5\\u5386 \",\"category\":\"Calendar\",\"stock\":100}', '2025-06-07 08:21:21'),
(802, 1, 'add_product', '{\"name_zh\":\"Haf \\u6807\\u5fd7\\u6c34\\u676f\",\"category\":\"Mug\",\"stock\":100}', '2025-06-07 08:31:40'),
(803, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:31:42'),
(804, 1, 'view_products', '{\"page\":2,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:31:47'),
(805, 1, 'view_products', '{\"page\":2,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:31:50'),
(806, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:31:50'),
(807, 1, 'view_products', '{\"page\":2,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:01'),
(808, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:03'),
(809, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:05'),
(810, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:06'),
(811, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:17'),
(812, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:19'),
(813, 1, 'view_products', '{\"page\":2,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:23'),
(814, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:26'),
(815, 1, 'view_products', '{\"page\":2,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:28'),
(816, 1, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:28'),
(817, 1, 'logout', 'User logged out', '2025-06-07 08:32:34'),
(818, 2, 'login', 'User logged in successfully', '2025-06-07 08:32:39'),
(819, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:39'),
(820, 2, 'view_products', '{\"page\":2,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:43'),
(821, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:44'),
(822, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:50'),
(823, 2, 'add_to_cart', '{\"product_id\":18,\"quantity\":1}', '2025-06-07 08:32:50'),
(824, 2, 'view_products', '{\"page\":1,\"search\":\"\",\"category\":\"\",\"sort\":\"name_asc\"}', '2025-06-07 08:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_zh` decimal(10,2) NOT NULL,
  `total_en` decimal(10,2) NOT NULL,
  `total_ms` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `address_id` int DEFAULT NULL,
  `payment_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'credit_card'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_zh`, `total_en`, `total_ms`, `status`, `created_at`, `address_id`, `payment_method`) VALUES
(1, 2, 200.00, 160.00, 700.00, 'pending', '2025-05-10 11:21:52', 1, 'credit_card'),
(2, 2, 100.00, 80.00, 350.00, 'cancelled', '2025-05-01 10:00:00', 1, 'credit_card'),
(3, 2, 900.00, 690.00, 2850.00, 'pending', '2025-05-11 04:39:00', 1, 'credit_card'),
(4, 1, 1000.00, 770.00, 3200.00, 'pending', '2025-05-11 04:39:00', 1, 'credit_card'),
(5, 2, 2000.00, 1500.00, 6000.00, 'completed', '2025-05-11 04:39:00', 1, 'credit_card'),
(6, 2, 200.00, 150.00, 600.00, 'pending', '2025-05-11 04:39:00', 1, 'credit_card'),
(7, 2, 200.00, 150.00, 600.00, 'completed', '2025-05-11 04:39:00', 1, 'credit_card'),
(8, 2, 400.00, 300.00, 1200.00, 'pending', '2025-05-11 23:31:09', 1, 'credit_card'),
(9, 1, 800.00, 600.00, 2400.00, 'pending', '2025-05-11 23:33:12', 2, 'credit_card'),
(10, 1, 200.00, 150.00, 600.00, 'completed', '2025-05-11 23:34:57', 2, 'credit_card'),
(11, 1, 234.00, 2342342.00, 34.00, 'pending', '2025-05-19 00:01:08', 3, 'credit_card'),
(12, 1, 234.00, 2342342.00, 34.00, 'pending', '2025-05-19 00:01:37', 3, 'credit_card'),
(13, 1, 234.00, 2342342.00, 34.00, 'completed', '2025-05-19 00:02:34', 3, 'credit_card'),
(14, 2, 1.00, 1.00, 1.00, 'pending', '2025-05-19 00:05:11', 1, 'credit_card'),
(15, 1, 21.00, 12.00, 12.00, 'pending', '2025-05-28 16:46:00', 2, 'credit_card'),
(16, 1, 1128.00, 1119.00, 1020.00, 'pending', '2025-05-29 15:34:34', 3, 'credit_card'),
(17, 1, 21.00, 12.00, 12.00, 'pending', '2025-05-29 15:39:01', 2, 'credit_card'),
(18, 1, 342.00, 342.00, 342.00, 'pending', '2025-05-29 15:41:44', 2, 'credit_card'),
(19, 1, 21.00, 12.00, 12.00, 'pending', '2025-05-29 15:41:58', 2, 'credit_card'),
(20, 1, 106173.00, 106173.00, 81324.00, 'completed', '2025-05-29 15:47:12', 2, 'credit_card'),
(21, 1, 18.00, 18.00, 18.00, 'pending', '2025-06-07 01:02:12', 2, 'credit_card'),
(22, 6, 28.00, 28.00, 28.00, 'pending', '2025-06-07 01:51:08', 4, 'credit_card');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(25, 21, 11, 1, 18.00),
(26, 22, 14, 1, 28.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name_zh` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ms` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_zh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_ms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price_zh` decimal(10,2) NOT NULL,
  `price_en` decimal(10,2) NOT NULL,
  `price_ms` decimal(10,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_zh` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_en` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_ms` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_zh`, `name_en`, `name_ms`, `description_zh`, `description_en`, `description_ms`, `price_zh`, `price_en`, `price_ms`, `image`, `alt_zh`, `alt_en`, `alt_ms`, `category`, `stock`) VALUES
(11, 'Haf 标志性水杯', 'Haf Signature Mug', 'Mug Tanda Tangan Haf', '这款印有我们Haf标志的水杯不仅实用，而且展现了我们的独特品牌风格，是日常使用或赠送亲友的绝佳选择！', 'This mug featuring our Haf logo is not only practical but also showcases our unique brand identity&mdash;perfect for daily use or as a thoughtful gift!', 'Cawan yang tertera logo Haf ini bukan sahaja berguna, malah menyerlahkan identiti jenama kita&mdash;sesuai untuk kegunaan harian atau sebagai hadiah istimewa!', 18.00, 18.00, 18.00, 'images/product_68431ed878a44.jpg', '这款印有我们Haf标志的水杯不仅实用，而且展现了我们的独特品牌风格，是日常使用或赠送亲友的绝佳选择！', 'This mug featuring our Haf logo is not only practical but also showcases our unique brand identity&m', 'Cawan yang tertera logo Haf ini bukan sahaja berguna, malah menyerlahkan identiti jenama kita&mdash;', 'Mug', 98),
(12, 'Haf 日常水杯', 'Haf Everyday Mug', 'Mug Harian Haf', '无论是在家、学校还是办公室，这款印有 Haf 标志的日常水杯都是你每天不可或缺的好伙伴。简约又有个性，让每一天都充满温暖与风格。', 'Start your day right with the Haf Everyday Mug&mdash;simple, stylish, and made for daily use. Whether at home, school, or the office, this mug is your perfect companion for every sip.', 'Mulakan hari anda dengan Mug Harian Haf&mdash;ringkas, bergaya dan sesuai untuk kegunaan harian. Sama ada di rumah, sekolah atau pejabat, mug ini adalah teman setia untuk setiap hirupan.', 20.00, 20.00, 20.00, 'images/product_684324dc13905.png', '无论是在家、学校还是办公室，这款印有 Haf 标志的日常水杯都是你每天不可或缺的好伙伴。简约又有个性，让每一天都充满温暖与风格。', 'Start your day right with the Haf Everyday Mug&mdash;simple, stylish, and made for daily use. Whethe', 'Mulakan hari anda dengan Mug Harian Haf&mdash;ringkas, bergaya dan sesuai untuk kegunaan harian. Sam', 'Mug', 100),
(13, 'Haf 日常T恤', 'Haf Everyday Tee', 'Haf Kemeja-T Harian', '这款日常T恤结合了简洁设计与舒适面料，适合各种场合穿着，无论是上学、出街或居家都百搭耐看。胸前印有 Haf 品牌标志，低调中展现个性，是你每天都想穿上的那一件。', 'Designed for comfort and versatility, the Haf Everyday Tee is your go-to shirt for any occasion&mdash;school, errands, or just relaxing at home. Featuring a clean design and the signature Haf logo, it blends simplicity with everyday style.\r\n\r\n', 'Kemeja-T Harian Haf direka untuk keselesaan dan gaya harian. Sesuai dipakai ke sekolah, berjalan-jalan, atau bersantai di rumah. Logo Haf yang dicetak di bahagian depan menambah sentuhan identiti yang ringkas tetapi bergaya.', 25.00, 25.00, 25.00, 'images/product_684326847f17d.jpg', '这款日常T恤结合了简洁设计与舒适面料，适合各种场合穿着，无论是上学、出街或居家都百搭耐看。胸前印有 Haf 品牌标志，低调中展现个性，是你每天都想穿上的那一件。', 'Designed for comfort and versatility, the Haf Everyday Tee is your go-to shirt for any occasion&mdas', 'Kemeja-T Harian Haf direka untuk keselesaan dan gaya harian. Sesuai dipakai ke sekolah, berjalan-jal', 'clothes', 100),
(14, 'Haf 运动上衣', 'Haf Activewear Jersey	', 'Jersi Aktif Haf', '这款 Haf 运动上衣采用轻盈透气材质，专为运动和日常活动而设计，无论是晨跑、健身还是休闲穿搭都毫不违和。胸前印有 Haf 品牌标志，运动中也能展现你的独特风格。', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, morning jogs, or sporty casual looks. With the iconic Haf logo on the chest, it keeps you moving in style and comfort.\r\n\r\n', 'Jersi Aktif Haf diperbuat daripada kain ringan dan bernafas, sesuai untuk bersenam, berjoging atau gaya santai yang aktif. Dengan logo Haf yang menonjol, ia memberikan gaya dan keselesaan semasa anda bergerak.', 28.00, 28.00, 28.00, 'images/product_684327c52d48c.jpg', '这款 Haf 运动上衣采用轻盈透气材质，专为运动和日常活动而设计，无论是晨跑、健身还是休闲穿搭都毫不违和。胸前印有 Haf 品牌标志，运动中也能展现你的独特风格。', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, m', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, m', 'clothes', 99),
(15, 'Haf 经典连帽衫', 'Haf Classic Hoodie	', 'Hoodie Klasik Haf', '这款 Haf 经典连帽衫融合了舒适与时尚，采用柔软厚实面料，适合在冷天穿着或当作日常造型单品。胸前简约印上 Haf 标志，低调而有型，是你衣柜里不可或缺的经典之选。', 'The Haf Classic Hoodie combines comfort and timeless style. Made with soft, cozy fabric, it&rsquo;s perfect for chilly days or casual layering. Featuring a clean Haf logo on the front, it&#039;s a wardrobe essential for any season.\r\n\r\n', 'Hoodie Klasik Haf menggabungkan keselesaan dan gaya abadi. Diperbuat daripada fabrik lembut dan hangat, sesuai untuk cuaca sejuk atau gaya santai harian. Logo Haf yang ringkas di bahagian hadapan menambah sentuhan elegan pada penampilan anda.', 30.00, 30.00, 30.00, 'images/product_684328914df1c.jpg', '这款 Haf 经典连帽衫融合了舒适与时尚，采用柔软厚实面料，适合在冷天穿着或当作日常造型单品。胸前简约印上 Haf 标志，低调而有型，是你衣柜里不可或缺的经典之选。', 'The Haf Classic Hoodie combines comfort and timeless style. Made with soft, cozy fabric, it&rsquo;s ', 'Hoodie Klasik Haf menggabungkan keselesaan dan gaya abadi. Diperbuat daripada fabrik lembut dan hang', 'clothes', 100),
(16, 'Haf 限量版T恤	', 'Haf Limited Edition Tee	', 'Haf Kemeja-T Edisi Terhad', '这款 Haf 限量版T恤为特别设计，仅限量发行，极具收藏价值。融合独特图案与品牌标志，不仅是时尚穿搭的亮点，更是对 Haf 品牌理念的致敬。错过就买不到，值得你拥有！', 'The Haf Limited Edition Tee is a rare release, crafted with exclusive designs and our iconic logo. A perfect piece for collectors and fans, it&rsquo;s more than just a shirt&mdash;it&rsquo;s a statement. Get yours before it&rsquo;s gone!', 'Haf Kemeja-T Edisi Terhad direka khas dalam jumlah yang terhad, menjadikannya item eksklusif untuk peminat Haf. Dengan reka bentuk unik dan logo tersendiri, ia bukan sekadar pakaian, tetapi lambang gaya dan identiti. Jangan lepaskan peluang!', 45.00, 45.00, 45.00, 'images/product_6843299921945.png', '这款 Haf 限量版T恤为特别设计，仅限量发行，极具收藏价值。融合独特图案与品牌标志，不仅是时尚穿搭的亮点，更是对 Haf 品牌理念的致敬。错过就买不到，值得你拥有！', 'The Haf Limited Edition Tee is a rare release, crafted with exclusive designs and our iconic logo. A', 'Haf Kemeja-T Edisi Terhad direka khas dalam jumlah yang terhad, menjadikannya item eksklusif untuk p', 'clothes', 100),
(18, 'Haf 装饰纸带', ' Haf Deco Tape', 'Pita Dekorasi Haf', '这款 Haf 装饰纸带图案独特，适合用于手帐、礼物包装、文具DIY，彰显你的细节美学。\r\n', 'A stylish washi tape with the Haf identity&mdash;perfect for journaling, scrapbooking, or gift wrapping.\r\n\r\n', 'Pita washi Haf dengan reka bentuk unik, sesuai untuk buku jurnal, hadiah, atau hiasan harian.\r\n', 15.00, 15.00, 15.00, 'images/product_6843e6a95120d.png', '这款 Haf 装饰纸带图案独特，适合用于手帐、礼物包装、文具DIY，彰显你的细节美学。', 'A stylish washi tape with the Haf identity&mdash;perfect for journaling, scrapbooking, or gift wrapp', 'Pita washi Haf dengan reka bentuk unik, sesuai untuk buku jurnal, hadiah, atau hiasan harian.', 'Bag', 99),
(19, 'Haf 水罐', 'Haf Hydration Bottle', 'Botol Air Haf', '轻便易携，Haf 水罐是保持全天水分摄取的好伙伴。环保耐用，是你出门必备。\r\n', 'Stay refreshed with the Haf Bottle&mdash;lightweight, reusable, and made for daily hydration.\r\n\r\n', 'Kekal segar dengan Botol Air Haf&mdash;ringan, boleh guna semula dan bergaya.\r\n', 32.00, 32.00, 32.00, 'images/product_6843f045a38e3.jpg', '轻便易携，Haf 水罐是保持全天水分摄取的好伙伴。环保耐用，是你出门必备。', 'Stay refreshed with the Haf Bottle&mdash;lightweight, reusable, and made for daily hydration.', 'Kekal segar dengan Botol Air Haf&mdash;ringan, boleh guna semula dan bergaya.', 'Bottle ', 100),
(20, 'Haf 记事本   用 Haf 记事本记录灵感与生活点滴，简约封面设计搭配内页细致排版，是学习与创意工作的好帮手。 Minimalist and functional, the Haf Notes h', ' Haf Notes ', 'Buku Nota Haf', '用 Haf 记事本记录灵感与生活点滴，简约封面设计搭配内页细致排版，是学习与创意工作的好帮手。 ', 'Minimalist and functional, the Haf Notes help you capture ideas anywhere. ', 'Buku nota bergaya Haf untuk mencatat inspirasi dan perancangan harian anda.', 16.00, 16.00, 16.00, 'images/product_6843f1dc1af64.jpg', '用 Haf 记事本记录灵感与生活点滴，简约封面设计搭配内页细致排版，是学习与创意工作的好帮手。 ', 'Minimalist and functional, the Haf Notes help you capture ideas anywhere. ', 'Buku nota bergaya Haf untuk mencatat inspirasi dan perancangan harian anda.', 'Book', 100),
(21, 'Haf 环保袋 ', 'Haf Eco Tote ', 'Beg Mesra Alam Haf ', '以环保理念打造的 Haf 帆布袋，适合购物、通勤或日常携带，耐用又时尚。 ', 'Stylish and sustainable, the Haf Eco Tote is your go-to bag for daily use. ', 'Beg tahan lama dan mesra alam dengan reka bentuk Haf yang moden dan ringkas.', 17.00, 17.00, 17.00, 'images/product_6843f251d65a6.jpg', '以环保理念打造的 Haf 帆布袋，适合购物、通勤或日常携带，耐用又时尚。 ', 'Stylish and sustainable, the Haf Eco Tote is your go-to bag for daily use. ', 'Beg tahan lama dan mesra alam dengan reka bentuk Haf yang moden dan ringkas.', 'Bag', 100),
(22, 'Haf 香氛蜡烛 ', 'Haf Scented Candle ', 'Lilin Beraroma Haf ', ' 点燃这款 Haf 香氛蜡烛，让空间充满温暖与宁静气息。多种香味可选，营造放松氛围。', ' Create a cozy vibe with Haf&rsquo;s scented candles&mdash;elegant, calming, and perfect for any space. ', 'Wujudkan suasana tenang dengan lilin wangi Haf&mdash;menenangkan dan berkelas.', 10.00, 10.00, 10.00, 'images/product_6843f2b8a1e2d.jpg', ' 点燃这款 Haf 香氛蜡烛，让空间充满温暖与宁静气息。多种香味可选，营造放松氛围。', ' Create a cozy vibe with Haf&rsquo;s scented candles&mdash;elegant, calming, and perfect for any spa', 'Wujudkan suasana tenang dengan lilin wangi Haf&mdash;menenangkan dan berkelas.', 'Candle', 100),
(23, 'Haf 舒适抱枕', 'Haf Cozy Pillow', 'Bantal Hiasan Haf', ' 柔软舒适的 Haf 抱枕，不仅为你的空间增添温馨，也展现你对生活品味的坚持。 ', 'Soft and stylish, the Haf Pillow is perfect for your room, sofa, or reading corner.', ' Bantal lembut dan cantik dari Haf untuk keselesaan dan hiasan rumah.', 30.00, 30.00, 30.00, 'images/product_6843f33588f56.jpg', ' 柔软舒适的 Haf 抱枕，不仅为你的空间增添温馨，也展现你对生活品味的坚持。 ', 'Soft and stylish, the Haf Pillow is perfect for your room, sofa, or reading corner.', ' Bantal lembut dan cantik dari Haf untuk keselesaan dan hiasan rumah.', 'Pillow', 100),
(24, 'Haf 不锈钢水罐 ', 'Haf Steel Flask', 'Termos Keluli Haf  ', 'Haf 不锈钢水罐具备保温保冷功能，适合长时间户外活动或上班族使用。极具质感又耐用。', ' Keep drinks hot or cold all day with the Haf Stainless Steel Flask&mdash;built to last.', ' Termos keluli tahan lama dengan keupayaan mengekalkan suhu, ideal untuk aktiviti harian.', 26.00, 26.00, 26.00, 'images/product_6843f39090784.jpg', 'Haf 不锈钢水罐具备保温保冷功能，适合长时间户外活动或上班族使用。极具质感又耐用。', ' Keep drinks hot or cold all day with the Haf Stainless Steel Flask&mdash;built to last.', ' Termos keluli tahan lama dengan keupayaan mengekalkan suhu, ideal untuk aktiviti harian.', 'Bottle ', 100),
(25, 'Haf 独特水杯 ', 'Haf Unique Mug ', 'Mug Unik Haf ', ' 造型独特、设计前卫的 Haf 创意杯，每一口都充满个性。是送礼或自用的理想之选。', ' Break the mold with the Haf Unique Mug&mdash;bold design for bold personalities. ', 'Mug unik dengan reka bentuk tersendiri, sesuai untuk hadiah atau koleksi peribadi.', 18.00, 18.00, 18.00, 'images/product_6843f3e552d42.jpg', ' 造型独特、设计前卫的 Haf 创意杯，每一口都充满个性。是送礼或自用的理想之选。', ' Break the mold with the Haf Unique Mug&mdash;bold design for bold personalities. ', 'Mug unik dengan reka bentuk tersendiri, sesuai untuk hadiah atau koleksi peribadi.', 'Mug', 100),
(26, 'Haf 精油', 'Haf Essential Oil ', 'Minyak Pati Haf  ', ' Haf 精油采用天然植物萃取，适合香薰、按摩或冥想使用，帮助你放松身心，恢复平衡。 ', 'Haf Essential Oil is made from pure botanical extracts to calm your mind and refresh your space. ', 'Minyak pati Haf daripada bahan semula jadi, membantu menenangkan fikiran dan menyegarkan suasana.', 58.00, 58.00, 58.00, 'images/product_6843f560ce73e.jpg', ' Haf 精油采用天然植物萃取，适合香薰、按摩或冥想使用，帮助你放松身心，恢复平衡。 ', 'Haf Essential Oil is made from pure botanical extracts to calm your mind and refresh your space. ', 'Minyak pati Haf daripada bahan semula jadi, membantu menenangkan fikiran dan menyegarkan suasana.', 'Skin Care', 100),
(27, 'Haf 护肤品套装 ', ' Haf Skincare Set ', 'Set Penjagaan Kulit Haf  ', '为不同肤质设计的 Haf 护肤系列，温和呵护，补水滋养，打造清新自然的健康肌肤。 ', 'Gentle yet effective, Haf Skincare is your daily ritual for radiant and hydrated skin. ', 'Penjagaan kulit Haf yang lembut sesuai untuk semua jenis kulit&mdash;kulit sihat dan berseri setiap hari.', 36.00, 36.00, 36.00, 'images/product_6843f5eb4e9be.png', '为不同肤质设计的 Haf 护肤系列，温和呵护，补水滋养，打造清新自然的健康肌肤。 ', 'Gentle yet effective, Haf Skincare is your daily ritual for radiant and hydrated skin. ', 'Penjagaan kulit Haf yang lembut sesuai untuk semua jenis kulit&mdash;kulit sihat dan berseri setiap ', 'Skin Care', 100),
(28, ' Haf 日历 ', 'Haf Wall Calendar ', 'Kalendar Dinding Haf  ', ' 这款 Haf 挂历设计简约实用，附有标记空间，适合记录重要日子，装点你的墙面与生活。 ', 'Stay organized and inspired with the Haf Wall Calendar&mdash;minimalist, functional, and stylish. ', 'Kalendar dinding Haf yang kemas dan praktikal, sesuai untuk hiasan dan perancangan bulanan anda.', 24.00, 24.00, 24.00, 'images/product_6843f6816f888.png', ' 这款 Haf 挂历设计简约实用，附有标记空间，适合记录重要日子，装点你的墙面与生活。 ', 'Stay organized and inspired with the Haf Wall Calendar&mdash;minimalist, functional, and stylish. ', 'Kalendar dinding Haf yang kemas dan praktikal, sesuai untuk hiasan dan perancangan bulanan anda.', 'Calendar', 100),
(29, 'Haf 标志水杯', 'Haf Logo Mug', 'Mug Logo Haf  解释： ', '这款经典 Haf LOGO 杯以陶瓷制作，印有 Haf 品牌标志，简约不失格调，适合日常饮品使用或作为纪念收藏。', ' A timeless ceramic mug featuring the Haf logo&mdash;perfect for everyday coffee, tea, or as a stylish gift. ', 'Mug seramik Haf dengan logo ikonik&mdash;ideal untuk kegunaan harian atau sebagai cenderahati eksklusif.', 28.00, 28.00, 28.00, 'images/product_6843f8eccc88e.jpg', '这款经典 Haf LOGO 杯以陶瓷制作，印有 Haf 品牌标志，简约不失格调，适合日常饮品使用或作为纪念收藏。', ' A timeless ceramic mug featuring the Haf logo&mdash;perfect for everyday coffee, tea, or as a styli', 'Mug seramik Haf dengan logo ikonik&mdash;ideal untuk kegunaan harian atau sebagai cenderahati eksklu', 'Mug', 100);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_zh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_ms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `alt_zh`, `alt_en`, `alt_ms`, `is_primary`) VALUES
(11, 11, 'images/product_68431ed878a44.jpg', '这款印有我们Haf标志的水杯不仅实用，而且展现了我们的独特品牌风格，是日常使用或赠送亲友的绝佳选择！', 'This mug featuring our Haf logo is not only practical but also showcases our unique brand identity&mdash;perfect for daily use or as a thoughtful gift!', 'Cawan yang tertera logo Haf ini bukan sahaja berguna, malah menyerlahkan identiti jenama kita&mdash;sesuai untuk kegunaan harian atau sebagai hadiah istimewa!', 1),
(12, 11, 'images/product_68431ed879145.jpg', '这款印有我们Haf标志的水杯不仅实用，而且展现了我们的独特品牌风格，是日常使用或赠送亲友的绝佳选择！', 'This mug featuring our Haf logo is not only practical but also showcases our unique brand identity&mdash;perfect for daily use or as a thoughtful gift!', 'Cawan yang tertera logo Haf ini bukan sahaja berguna, malah menyerlahkan identiti jenama kita&mdash;sesuai untuk kegunaan harian atau sebagai hadiah istimewa!', 0),
(13, 11, 'images/product_68431ed8794d4.jpg', '这款印有我们Haf标志的水杯不仅实用，而且展现了我们的独特品牌风格，是日常使用或赠送亲友的绝佳选择！', 'This mug featuring our Haf logo is not only practical but also showcases our unique brand identity&mdash;perfect for daily use or as a thoughtful gift!', 'Cawan yang tertera logo Haf ini bukan sahaja berguna, malah menyerlahkan identiti jenama kita&mdash;sesuai untuk kegunaan harian atau sebagai hadiah istimewa!', 0),
(14, 11, 'images/product_68431ed8797be.jpg', '这款印有我们Haf标志的水杯不仅实用，而且展现了我们的独特品牌风格，是日常使用或赠送亲友的绝佳选择！', 'This mug featuring our Haf logo is not only practical but also showcases our unique brand identity&mdash;perfect for daily use or as a thoughtful gift!', 'Cawan yang tertera logo Haf ini bukan sahaja berguna, malah menyerlahkan identiti jenama kita&mdash;sesuai untuk kegunaan harian atau sebagai hadiah istimewa!', 0),
(15, 12, 'images/product_684324dc13905.png', '无论是在家、学校还是办公室，这款印有 Haf 标志的日常水杯都是你每天不可或缺的好伙伴。简约又有个性，让每一天都充满温暖与风格。', 'Start your day right with the Haf Everyday Mug&mdash;simple, stylish, and made for daily use. Whether at home, school, or the office, this mug is your perfect companion for every sip.', 'Mulakan hari anda dengan Mug Harian Haf&mdash;ringkas, bergaya dan sesuai untuk kegunaan harian. Sama ada di rumah, sekolah atau pejabat, mug ini adalah teman setia untuk setiap hirupan.', 1),
(16, 12, 'images/product_684324dc13fe0.png', '无论是在家、学校还是办公室，这款印有 Haf 标志的日常水杯都是你每天不可或缺的好伙伴。简约又有个性，让每一天都充满温暖与风格。', 'Start your day right with the Haf Everyday Mug&mdash;simple, stylish, and made for daily use. Whether at home, school, or the office, this mug is your perfect companion for every sip.', 'Mulakan hari anda dengan Mug Harian Haf&mdash;ringkas, bergaya dan sesuai untuk kegunaan harian. Sama ada di rumah, sekolah atau pejabat, mug ini adalah teman setia untuk setiap hirupan.', 0),
(17, 12, 'images/product_684324dc1441c.jpg', '无论是在家、学校还是办公室，这款印有 Haf 标志的日常水杯都是你每天不可或缺的好伙伴。简约又有个性，让每一天都充满温暖与风格。', 'Start your day right with the Haf Everyday Mug&mdash;simple, stylish, and made for daily use. Whether at home, school, or the office, this mug is your perfect companion for every sip.', 'Mulakan hari anda dengan Mug Harian Haf&mdash;ringkas, bergaya dan sesuai untuk kegunaan harian. Sama ada di rumah, sekolah atau pejabat, mug ini adalah teman setia untuk setiap hirupan.', 0),
(18, 13, 'images/product_684326847f17d.jpg', '这款日常T恤结合了简洁设计与舒适面料，适合各种场合穿着，无论是上学、出街或居家都百搭耐看。胸前印有 Haf 品牌标志，低调中展现个性，是你每天都想穿上的那一件。', 'Designed for comfort and versatility, the Haf Everyday Tee is your go-to shirt for any occasion&mdash;school, errands, or just relaxing at home. Featuring a clean design and the signature Haf logo, it blends simplicity with everyday style.', 'Kemeja-T Harian Haf direka untuk keselesaan dan gaya harian. Sesuai dipakai ke sekolah, berjalan-jalan, atau bersantai di rumah. Logo Haf yang dicetak di bahagian depan menambah sentuhan identiti yang ringkas tetapi bergaya.', 1),
(19, 13, 'images/product_684326847f40a.jpg', '这款日常T恤结合了简洁设计与舒适面料，适合各种场合穿着，无论是上学、出街或居家都百搭耐看。胸前印有 Haf 品牌标志，低调中展现个性，是你每天都想穿上的那一件。', 'Designed for comfort and versatility, the Haf Everyday Tee is your go-to shirt for any occasion&mdash;school, errands, or just relaxing at home. Featuring a clean design and the signature Haf logo, it blends simplicity with everyday style.', 'Kemeja-T Harian Haf direka untuk keselesaan dan gaya harian. Sesuai dipakai ke sekolah, berjalan-jalan, atau bersantai di rumah. Logo Haf yang dicetak di bahagian depan menambah sentuhan identiti yang ringkas tetapi bergaya.', 0),
(20, 13, 'images/product_684326847f6ad.jpg', '这款日常T恤结合了简洁设计与舒适面料，适合各种场合穿着，无论是上学、出街或居家都百搭耐看。胸前印有 Haf 品牌标志，低调中展现个性，是你每天都想穿上的那一件。', 'Designed for comfort and versatility, the Haf Everyday Tee is your go-to shirt for any occasion&mdash;school, errands, or just relaxing at home. Featuring a clean design and the signature Haf logo, it blends simplicity with everyday style.', 'Kemeja-T Harian Haf direka untuk keselesaan dan gaya harian. Sesuai dipakai ke sekolah, berjalan-jalan, atau bersantai di rumah. Logo Haf yang dicetak di bahagian depan menambah sentuhan identiti yang ringkas tetapi bergaya.', 0),
(21, 14, 'images/product_684327c52d48c.jpg', '这款 Haf 运动上衣采用轻盈透气材质，专为运动和日常活动而设计，无论是晨跑、健身还是休闲穿搭都毫不违和。胸前印有 Haf 品牌标志，运动中也能展现你的独特风格。', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, morning jogs, or sporty casual looks. With the iconic Haf logo on the chest, it keeps you moving in style and comfort.', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, morning jogs, or sporty casual looks. With the iconic Haf logo on the chest, it keeps you moving in style and comfort.', 1),
(22, 14, 'images/product_684327c52d701.jpg', '这款 Haf 运动上衣采用轻盈透气材质，专为运动和日常活动而设计，无论是晨跑、健身还是休闲穿搭都毫不违和。胸前印有 Haf 品牌标志，运动中也能展现你的独特风格。', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, morning jogs, or sporty casual looks. With the iconic Haf logo on the chest, it keeps you moving in style and comfort.', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, morning jogs, or sporty casual looks. With the iconic Haf logo on the chest, it keeps you moving in style and comfort.', 0),
(23, 14, 'images/product_684327c52da2c.jpg', '这款 Haf 运动上衣采用轻盈透气材质，专为运动和日常活动而设计，无论是晨跑、健身还是休闲穿搭都毫不违和。胸前印有 Haf 品牌标志，运动中也能展现你的独特风格。', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, morning jogs, or sporty casual looks. With the iconic Haf logo on the chest, it keeps you moving in style and comfort.', 'The Haf Activewear Jersey is crafted with breathable, lightweight fabric&mdash;ideal for workouts, morning jogs, or sporty casual looks. With the iconic Haf logo on the chest, it keeps you moving in style and comfort.', 0),
(24, 15, 'images/product_684328914df1c.jpg', '这款 Haf 经典连帽衫融合了舒适与时尚，采用柔软厚实面料，适合在冷天穿着或当作日常造型单品。胸前简约印上 Haf 标志，低调而有型，是你衣柜里不可或缺的经典之选。', 'The Haf Classic Hoodie combines comfort and timeless style. Made with soft, cozy fabric, it&rsquo;s perfect for chilly days or casual layering. Featuring a clean Haf logo on the front, it&#039;s a wardrobe essential for any season.', 'Hoodie Klasik Haf menggabungkan keselesaan dan gaya abadi. Diperbuat daripada fabrik lembut dan hangat, sesuai untuk cuaca sejuk atau gaya santai harian. Logo Haf yang ringkas di bahagian hadapan menambah sentuhan elegan pada penampilan anda.', 1),
(25, 15, 'images/product_684328914e459.jpg', '这款 Haf 经典连帽衫融合了舒适与时尚，采用柔软厚实面料，适合在冷天穿着或当作日常造型单品。胸前简约印上 Haf 标志，低调而有型，是你衣柜里不可或缺的经典之选。', 'The Haf Classic Hoodie combines comfort and timeless style. Made with soft, cozy fabric, it&rsquo;s perfect for chilly days or casual layering. Featuring a clean Haf logo on the front, it&#039;s a wardrobe essential for any season.', 'Hoodie Klasik Haf menggabungkan keselesaan dan gaya abadi. Diperbuat daripada fabrik lembut dan hangat, sesuai untuk cuaca sejuk atau gaya santai harian. Logo Haf yang ringkas di bahagian hadapan menambah sentuhan elegan pada penampilan anda.', 0),
(26, 15, 'images/product_684328914eab4.jpg', '这款 Haf 经典连帽衫融合了舒适与时尚，采用柔软厚实面料，适合在冷天穿着或当作日常造型单品。胸前简约印上 Haf 标志，低调而有型，是你衣柜里不可或缺的经典之选。', 'The Haf Classic Hoodie combines comfort and timeless style. Made with soft, cozy fabric, it&rsquo;s perfect for chilly days or casual layering. Featuring a clean Haf logo on the front, it&#039;s a wardrobe essential for any season.', 'Hoodie Klasik Haf menggabungkan keselesaan dan gaya abadi. Diperbuat daripada fabrik lembut dan hangat, sesuai untuk cuaca sejuk atau gaya santai harian. Logo Haf yang ringkas di bahagian hadapan menambah sentuhan elegan pada penampilan anda.', 0),
(27, 16, 'images/product_6843299921945.png', '这款 Haf 限量版T恤为特别设计，仅限量发行，极具收藏价值。融合独特图案与品牌标志，不仅是时尚穿搭的亮点，更是对 Haf 品牌理念的致敬。错过就买不到，值得你拥有！', 'The Haf Limited Edition Tee is a rare release, crafted with exclusive designs and our iconic logo. A perfect piece for collectors and fans, it&rsquo;s more than just a shirt&mdash;it&rsquo;s a statement. Get yours before it&rsquo;s gone!', 'Haf Kemeja-T Edisi Terhad direka khas dalam jumlah yang terhad, menjadikannya item eksklusif untuk peminat Haf. Dengan reka bentuk unik dan logo tersendiri, ia bukan sekadar pakaian, tetapi lambang gaya dan identiti. Jangan lepaskan peluang!', 1),
(28, 16, 'images/product_6843299921b95.jpg', '这款 Haf 限量版T恤为特别设计，仅限量发行，极具收藏价值。融合独特图案与品牌标志，不仅是时尚穿搭的亮点，更是对 Haf 品牌理念的致敬。错过就买不到，值得你拥有！', 'The Haf Limited Edition Tee is a rare release, crafted with exclusive designs and our iconic logo. A perfect piece for collectors and fans, it&rsquo;s more than just a shirt&mdash;it&rsquo;s a statement. Get yours before it&rsquo;s gone!', 'Haf Kemeja-T Edisi Terhad direka khas dalam jumlah yang terhad, menjadikannya item eksklusif untuk peminat Haf. Dengan reka bentuk unik dan logo tersendiri, ia bukan sekadar pakaian, tetapi lambang gaya dan identiti. Jangan lepaskan peluang!', 0),
(29, 16, 'images/product_6843299921e0b.png', '这款 Haf 限量版T恤为特别设计，仅限量发行，极具收藏价值。融合独特图案与品牌标志，不仅是时尚穿搭的亮点，更是对 Haf 品牌理念的致敬。错过就买不到，值得你拥有！', 'The Haf Limited Edition Tee is a rare release, crafted with exclusive designs and our iconic logo. A perfect piece for collectors and fans, it&rsquo;s more than just a shirt&mdash;it&rsquo;s a statement. Get yours before it&rsquo;s gone!', 'Haf Kemeja-T Edisi Terhad direka khas dalam jumlah yang terhad, menjadikannya item eksklusif untuk peminat Haf. Dengan reka bentuk unik dan logo tersendiri, ia bukan sekadar pakaian, tetapi lambang gaya dan identiti. Jangan lepaskan peluang!', 0),
(33, 18, 'images/product_6843e6a95120d.png', '这款 Haf 装饰纸带图案独特，适合用于手帐、礼物包装、文具DIY，彰显你的细节美学。', 'A stylish washi tape with the Haf identity&mdash;perfect for journaling, scrapbooking, or gift wrapping. ', 'Pita washi Haf dengan reka bentuk unik, sesuai untuk buku jurnal, hadiah, atau hiasan harian.', 1),
(34, 18, 'images/product_6843e6a9514ae.jpg', '这款 Haf 装饰纸带图案独特，适合用于手帐、礼物包装、文具DIY，彰显你的细节美学。', 'A stylish washi tape with the Haf identity&mdash;perfect for journaling, scrapbooking, or gift wrapping. ', 'Pita washi Haf dengan reka bentuk unik, sesuai untuk buku jurnal, hadiah, atau hiasan harian.', 0),
(35, 18, 'images/product_6843e6a951614.jpg', '这款 Haf 装饰纸带图案独特，适合用于手帐、礼物包装、文具DIY，彰显你的细节美学。', 'A stylish washi tape with the Haf identity&mdash;perfect for journaling, scrapbooking, or gift wrapping. ', 'Pita washi Haf dengan reka bentuk unik, sesuai untuk buku jurnal, hadiah, atau hiasan harian.', 0),
(36, 19, 'images/product_6843f045a38e3.jpg', '轻便易携，Haf 水罐是保持全天水分摄取的好伙伴。环保耐用，是你出门必备。', 'Stay refreshed with the Haf Bottle&mdash;lightweight, reusable, and made for daily hydration.', 'Kekal segar dengan Botol Air Haf&mdash;ringan, boleh guna semula dan bergaya.', 1),
(37, 19, 'images/product_6843f045a3d3e.png', '轻便易携，Haf 水罐是保持全天水分摄取的好伙伴。环保耐用，是你出门必备。', 'Stay refreshed with the Haf Bottle&mdash;lightweight, reusable, and made for daily hydration.', 'Kekal segar dengan Botol Air Haf&mdash;ringan, boleh guna semula dan bergaya.', 0),
(38, 19, 'images/product_6843f045a406a.jpg', '轻便易携，Haf 水罐是保持全天水分摄取的好伙伴。环保耐用，是你出门必备。', 'Stay refreshed with the Haf Bottle&mdash;lightweight, reusable, and made for daily hydration.', 'Kekal segar dengan Botol Air Haf&mdash;ringan, boleh guna semula dan bergaya.', 0),
(39, 20, 'images/product_6843f1dc1af64.jpg', '用 Haf 记事本记录灵感与生活点滴，简约封面设计搭配内页细致排版，是学习与创意工作的好帮手。 ', 'Minimalist and functional, the Haf Notes help you capture ideas anywhere. ', 'Buku nota bergaya Haf untuk mencatat inspirasi dan perancangan harian anda.', 1),
(40, 20, 'images/product_6843f1dc1b1a0.jpg', '用 Haf 记事本记录灵感与生活点滴，简约封面设计搭配内页细致排版，是学习与创意工作的好帮手。 ', 'Minimalist and functional, the Haf Notes help you capture ideas anywhere. ', 'Buku nota bergaya Haf untuk mencatat inspirasi dan perancangan harian anda.', 0),
(41, 20, 'images/product_6843f1dc1b3ad.png', '用 Haf 记事本记录灵感与生活点滴，简约封面设计搭配内页细致排版，是学习与创意工作的好帮手。 ', 'Minimalist and functional, the Haf Notes help you capture ideas anywhere. ', 'Buku nota bergaya Haf untuk mencatat inspirasi dan perancangan harian anda.', 0),
(42, 21, 'images/product_6843f251d65a6.jpg', '以环保理念打造的 Haf 帆布袋，适合购物、通勤或日常携带，耐用又时尚。 ', 'Stylish and sustainable, the Haf Eco Tote is your go-to bag for daily use. ', 'Beg tahan lama dan mesra alam dengan reka bentuk Haf yang moden dan ringkas.', 1),
(43, 21, 'images/product_6843f251d693a.jpg', '以环保理念打造的 Haf 帆布袋，适合购物、通勤或日常携带，耐用又时尚。 ', 'Stylish and sustainable, the Haf Eco Tote is your go-to bag for daily use. ', 'Beg tahan lama dan mesra alam dengan reka bentuk Haf yang moden dan ringkas.', 0),
(44, 21, 'images/product_6843f251d6b26.jpg', '以环保理念打造的 Haf 帆布袋，适合购物、通勤或日常携带，耐用又时尚。 ', 'Stylish and sustainable, the Haf Eco Tote is your go-to bag for daily use. ', 'Beg tahan lama dan mesra alam dengan reka bentuk Haf yang moden dan ringkas.', 0),
(45, 22, 'images/product_6843f2b8a1e2d.jpg', ' 点燃这款 Haf 香氛蜡烛，让空间充满温暖与宁静气息。多种香味可选，营造放松氛围。', ' Create a cozy vibe with Haf&rsquo;s scented candles&mdash;elegant, calming, and perfect for any space. ', 'Wujudkan suasana tenang dengan lilin wangi Haf&mdash;menenangkan dan berkelas.', 1),
(46, 22, 'images/product_6843f2b8a2126.jpg', ' 点燃这款 Haf 香氛蜡烛，让空间充满温暖与宁静气息。多种香味可选，营造放松氛围。', ' Create a cozy vibe with Haf&rsquo;s scented candles&mdash;elegant, calming, and perfect for any space. ', 'Wujudkan suasana tenang dengan lilin wangi Haf&mdash;menenangkan dan berkelas.', 0),
(47, 22, 'images/product_6843f2b8a22d6.jpg', ' 点燃这款 Haf 香氛蜡烛，让空间充满温暖与宁静气息。多种香味可选，营造放松氛围。', ' Create a cozy vibe with Haf&rsquo;s scented candles&mdash;elegant, calming, and perfect for any space. ', 'Wujudkan suasana tenang dengan lilin wangi Haf&mdash;menenangkan dan berkelas.', 0),
(48, 23, 'images/product_6843f33588f56.jpg', ' 柔软舒适的 Haf 抱枕，不仅为你的空间增添温馨，也展现你对生活品味的坚持。 ', 'Soft and stylish, the Haf Pillow is perfect for your room, sofa, or reading corner.', ' Bantal lembut dan cantik dari Haf untuk keselesaan dan hiasan rumah.', 1),
(49, 23, 'images/product_6843f335891c1.jpg', ' 柔软舒适的 Haf 抱枕，不仅为你的空间增添温馨，也展现你对生活品味的坚持。 ', 'Soft and stylish, the Haf Pillow is perfect for your room, sofa, or reading corner.', ' Bantal lembut dan cantik dari Haf untuk keselesaan dan hiasan rumah.', 0),
(50, 23, 'images/product_6843f3358935f.jpg', ' 柔软舒适的 Haf 抱枕，不仅为你的空间增添温馨，也展现你对生活品味的坚持。 ', 'Soft and stylish, the Haf Pillow is perfect for your room, sofa, or reading corner.', ' Bantal lembut dan cantik dari Haf untuk keselesaan dan hiasan rumah.', 0),
(51, 24, 'images/product_6843f39090784.jpg', 'Haf 不锈钢水罐具备保温保冷功能，适合长时间户外活动或上班族使用。极具质感又耐用。', ' Keep drinks hot or cold all day with the Haf Stainless Steel Flask&mdash;built to last.', ' Termos keluli tahan lama dengan keupayaan mengekalkan suhu, ideal untuk aktiviti harian.', 1),
(52, 24, 'images/product_6843f390909e7.jpg', 'Haf 不锈钢水罐具备保温保冷功能，适合长时间户外活动或上班族使用。极具质感又耐用。', ' Keep drinks hot or cold all day with the Haf Stainless Steel Flask&mdash;built to last.', ' Termos keluli tahan lama dengan keupayaan mengekalkan suhu, ideal untuk aktiviti harian.', 0),
(53, 24, 'images/product_6843f39090b7d.jpg', 'Haf 不锈钢水罐具备保温保冷功能，适合长时间户外活动或上班族使用。极具质感又耐用。', ' Keep drinks hot or cold all day with the Haf Stainless Steel Flask&mdash;built to last.', ' Termos keluli tahan lama dengan keupayaan mengekalkan suhu, ideal untuk aktiviti harian.', 0),
(54, 25, 'images/product_6843f3e552d42.jpg', ' 造型独特、设计前卫的 Haf 创意杯，每一口都充满个性。是送礼或自用的理想之选。', ' Break the mold with the Haf Unique Mug&mdash;bold design for bold personalities. ', 'Mug unik dengan reka bentuk tersendiri, sesuai untuk hadiah atau koleksi peribadi.', 1),
(55, 25, 'images/product_6843f3e55311e.jpg', ' 造型独特、设计前卫的 Haf 创意杯，每一口都充满个性。是送礼或自用的理想之选。', ' Break the mold with the Haf Unique Mug&mdash;bold design for bold personalities. ', 'Mug unik dengan reka bentuk tersendiri, sesuai untuk hadiah atau koleksi peribadi.', 0),
(56, 25, 'images/product_6843f3e5534d3.jpg', ' 造型独特、设计前卫的 Haf 创意杯，每一口都充满个性。是送礼或自用的理想之选。', ' Break the mold with the Haf Unique Mug&mdash;bold design for bold personalities. ', 'Mug unik dengan reka bentuk tersendiri, sesuai untuk hadiah atau koleksi peribadi.', 0),
(57, 26, 'images/product_6843f560ce73e.jpg', ' Haf 精油采用天然植物萃取，适合香薰、按摩或冥想使用，帮助你放松身心，恢复平衡。 ', 'Haf Essential Oil is made from pure botanical extracts to calm your mind and refresh your space. ', 'Minyak pati Haf daripada bahan semula jadi, membantu menenangkan fikiran dan menyegarkan suasana.', 1),
(58, 26, 'images/product_6843f560cebfd.jpg', ' Haf 精油采用天然植物萃取，适合香薰、按摩或冥想使用，帮助你放松身心，恢复平衡。 ', 'Haf Essential Oil is made from pure botanical extracts to calm your mind and refresh your space. ', 'Minyak pati Haf daripada bahan semula jadi, membantu menenangkan fikiran dan menyegarkan suasana.', 0),
(59, 26, 'images/product_6843f560ceeaa.jpg', ' Haf 精油采用天然植物萃取，适合香薰、按摩或冥想使用，帮助你放松身心，恢复平衡。 ', 'Haf Essential Oil is made from pure botanical extracts to calm your mind and refresh your space. ', 'Minyak pati Haf daripada bahan semula jadi, membantu menenangkan fikiran dan menyegarkan suasana.', 0),
(60, 27, 'images/product_6843f5eb4e9be.png', '为不同肤质设计的 Haf 护肤系列，温和呵护，补水滋养，打造清新自然的健康肌肤。 ', 'Gentle yet effective, Haf Skincare is your daily ritual for radiant and hydrated skin. ', 'Penjagaan kulit Haf yang lembut sesuai untuk semua jenis kulit&mdash;kulit sihat dan berseri setiap hari.', 1),
(61, 27, 'images/product_6843f5eb4ed75.jpg', '为不同肤质设计的 Haf 护肤系列，温和呵护，补水滋养，打造清新自然的健康肌肤。 ', 'Gentle yet effective, Haf Skincare is your daily ritual for radiant and hydrated skin. ', 'Penjagaan kulit Haf yang lembut sesuai untuk semua jenis kulit&mdash;kulit sihat dan berseri setiap hari.', 0),
(62, 27, 'images/product_6843f5eb4ef07.jpg', '为不同肤质设计的 Haf 护肤系列，温和呵护，补水滋养，打造清新自然的健康肌肤。 ', 'Gentle yet effective, Haf Skincare is your daily ritual for radiant and hydrated skin. ', 'Penjagaan kulit Haf yang lembut sesuai untuk semua jenis kulit&mdash;kulit sihat dan berseri setiap hari.', 0),
(63, 28, 'images/product_6843f6816f888.png', ' 这款 Haf 挂历设计简约实用，附有标记空间，适合记录重要日子，装点你的墙面与生活。 ', 'Stay organized and inspired with the Haf Wall Calendar&mdash;minimalist, functional, and stylish. ', 'Kalendar dinding Haf yang kemas dan praktikal, sesuai untuk hiasan dan perancangan bulanan anda.', 1),
(64, 28, 'images/product_6843f6816facd.jpg', ' 这款 Haf 挂历设计简约实用，附有标记空间，适合记录重要日子，装点你的墙面与生活。 ', 'Stay organized and inspired with the Haf Wall Calendar&mdash;minimalist, functional, and stylish. ', 'Kalendar dinding Haf yang kemas dan praktikal, sesuai untuk hiasan dan perancangan bulanan anda.', 0),
(65, 28, 'images/product_6843f6816fc7e.png', ' 这款 Haf 挂历设计简约实用，附有标记空间，适合记录重要日子，装点你的墙面与生活。 ', 'Stay organized and inspired with the Haf Wall Calendar&mdash;minimalist, functional, and stylish. ', 'Kalendar dinding Haf yang kemas dan praktikal, sesuai untuk hiasan dan perancangan bulanan anda.', 0),
(66, 29, 'images/product_6843f8eccc88e.jpg', '这款经典 Haf LOGO 杯以陶瓷制作，印有 Haf 品牌标志，简约不失格调，适合日常饮品使用或作为纪念收藏。', ' A timeless ceramic mug featuring the Haf logo&mdash;perfect for everyday coffee, tea, or as a stylish gift. ', 'Mug seramik Haf dengan logo ikonik&mdash;ideal untuk kegunaan harian atau sebagai cenderahati eksklusif.', 1),
(67, 29, 'images/product_6843f8ecccc64.jpg', '这款经典 Haf LOGO 杯以陶瓷制作，印有 Haf 品牌标志，简约不失格调，适合日常饮品使用或作为纪念收藏。', ' A timeless ceramic mug featuring the Haf logo&mdash;perfect for everyday coffee, tea, or as a stylish gift. ', 'Mug seramik Haf dengan logo ikonik&mdash;ideal untuk kegunaan harian atau sebagai cenderahati eksklusif.', 0),
(68, 29, 'images/product_6843f8ecccf39.jpg', '这款经典 Haf LOGO 杯以陶瓷制作，印有 Haf 品牌标志，简约不失格调，适合日常饮品使用或作为纪念收藏。', ' A timeless ceramic mug featuring the Haf logo&mdash;perfect for everyday coffee, tea, or as a stylish gift. ', 'Mug seramik Haf dengan logo ikonik&mdash;ideal untuk kegunaan harian atau sebagai cenderahati eksklusif.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@example.com', '123456', 'admin'),
(2, 'user', 'user@example.com', '123456', 'user'),
(3, 'testuser', 'testuser@example.com', 'test123', 'user'),
(4, 'hihgj', 'xedep65724@betzenn.com', '$2y$10$gbN6Qva6.42Fu2k2zF3PIuQVYTCxNfhE9ZvhU8yKTD/nB0BaPlR/O', 'user'),
(5, 'qqqqqq', 'khorziqian8965542@gmail.com', '111111', 'user'),
(6, 'root', 'xedep657fg@betzenn.com', '1111111', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `product_id`, `created_at`) VALUES
(1, 11, '2025-06-06 17:04:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=825;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
