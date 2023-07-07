-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2023 at 05:27 AM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hre_backend`
--
CREATE DATABASE IF NOT EXISTS `hre_backend` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `hre_backend`;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `customer_id`, `brand`, `state`, `gst`, `created_at`, `updated_at`) VALUES
(1, '1', 'Mc DONALD\'S', 'KARNATAKA', 'GST@#', '2023-06-30 14:39:51', '2023-06-30 14:39:51'),
(2, '2', 'RESIDENCE', 'KARNATAKA', 'GST@#', '2023-06-30 14:47:35', '2023-06-30 14:47:35'),
(3, '3', 'BBQN', 'KARNATAKA', '2edt3w4y', '2023-06-30 14:59:47', '2023-06-30 15:02:37'),
(4, '4', 'Third Wave Coffee', 'KARNATAKA', 'aqswdefrgth', '2023-06-30 15:03:29', '2023-06-30 15:03:29'),
(5, '5', 'KFC', 'KARNATAKA', 'tyur', '2023-06-30 15:14:04', '2023-06-30 15:16:12'),
(6, '5', 'Pizza Hut', 'KARNATAKA', 'klio', '2023-06-30 15:14:04', '2023-06-30 15:16:12'),
(7, '5', 'STARBUCKS- Naveen Project', 'COCHIN', 'dfytyk', '2023-06-30 15:14:04', '2023-06-30 15:16:12'),
(8, '5', 'CALIFORNIA BURRITO', 'KARNATAKA', 'dfytyk', '2023-06-30 15:16:12', '2023-06-30 15:16:12'),
(9, '5', 'Pizza Hut', 'KERLA', 'rfgrwg', '2023-06-30 15:16:12', '2023-06-30 15:16:12'),
(10, '6', 'Starbucks Coffee', 'Karanataka', '29aa3c111111', '2023-07-01 13:03:02', '2023-07-01 14:53:49'),
(11, '6', 'Starbucks Coffee', 'Tamilnadu', '33fafasdadsf42424', '2023-07-01 13:03:02', '2023-07-01 14:53:49'),
(12, '7', 'BRIKOVEN', 'KARNATAKA', '29AAAABBBCCC', '2023-07-01 14:47:14', '2023-07-01 14:47:14'),
(13, '6', 'Starbucks Coffee', 'Kerala', '32', '2023-07-01 14:53:49', '2023-07-01 14:53:49'),
(14, '8', 'Head Office', 'KARNATAKA', '29AJP1', '2023-07-01 15:47:09', '2023-07-01 15:47:09'),
(15, '8', 'Factory Works', 'KARNATAKA', '29AJP2', '2023-07-01 15:47:09', '2023-07-01 15:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logout_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logout_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logout_long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logout_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overtime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `out_of_work` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total_hours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `category`, `material_category`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'C001', 'CARPENTRY', 'CPY', 'Plywood, Flexy Ply, Birch Ply, Larch Ply, Centering Ply, HDF, MDF, BISON Board, Cement Board', NULL, '2023-06-30 15:45:28', '2023-07-01 15:20:07'),
(2, 'C002', 'GLASS & MIRROR', 'GM', 'aqwedfrty', NULL, '2023-06-30 15:45:45', '2023-06-30 15:45:45'),
(3, 'C003', 'LIGHT FIXTURES', 'LF', 'wert5y', NULL, '2023-06-30 15:46:05', '2023-06-30 15:46:05'),
(4, 'C004', 'SANITARY & FIXTURES', 'SF', 'aqftrgyu', NULL, '2023-06-30 15:46:27', '2023-06-30 15:46:27'),
(5, 'C005', 'FOAM & SOFA FURNISHING', 'FS', 'deeeegfregqr', NULL, '2023-06-30 18:19:52', '2023-06-30 18:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `email1`, `email2`, `email3`, `mobile`, `mobile1`, `mobile2`, `mobile3`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'HARDCASTLE RESTAURANTS', 'sanjay@hresolutions.in', NULL, NULL, NULL, '9167199961', NULL, NULL, NULL, NULL, '2023-06-30 14:39:51', '2023-06-30 14:39:51'),
(2, 'HEISETASSE BEVERAGES', 'sanjay1@hresolutions.in', NULL, NULL, NULL, '9167195961', NULL, NULL, NULL, NULL, '2023-06-30 14:47:35', '2023-06-30 14:47:35'),
(3, 'BARBEQUE NATIION', 'Nandita.Bapat@sapphirefoods.in', NULL, NULL, NULL, '9167195981', NULL, NULL, NULL, NULL, '2023-06-30 14:59:47', '2023-06-30 15:02:37'),
(4, 'HEISETASSE BEVERAGES', 'manojguotha@hresolutions.in', NULL, NULL, NULL, '8076557299', NULL, NULL, NULL, NULL, '2023-06-30 15:03:29', '2023-06-30 15:03:29'),
(5, 'SAPPHIRE FOODS INDIA LTD', 'vaibhavkumarrana.hre@gmail.com', NULL, NULL, NULL, '9632443072', NULL, NULL, NULL, NULL, '2023-06-30 15:14:04', '2023-06-30 15:16:12'),
(6, 'TATA Starbucks India Pvt Ltd', 'afkhafkdfb@gmail.com', NULL, NULL, NULL, '1111111111', NULL, NULL, NULL, NULL, '2023-07-01 13:03:02', '2023-07-01 14:53:49'),
(7, 'BRIKOVEN FOOD LIMITED', 'projects@brikoven.com', NULL, NULL, NULL, '9739055572', NULL, NULL, NULL, NULL, '2023-07-01 14:47:14', '2023-07-01 14:47:14'),
(8, 'HITESH RANA ENTERPRISES', 'kamal@hresolutions.in', 'projects@brikoven.com', 'projects@brikoven.com', 'projects@brikoven.com', '9003810101', NULL, NULL, NULL, NULL, '2023-07-01 15:47:09', '2023-07-01 15:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `employee_id`, `name`, `mobile`, `email`, `role`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1', 'ADMIN001', 'Super Admin', '9517531472', 'admin@admin.com', 'admin', NULL, '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(2, '2', '2', 'druva', '8076557299', 'druva@gmail.com', 'manager', NULL, '2023-06-30 18:30:56', '2023-06-30 18:30:56'),
(3, '3', 'HRE-027', 'Kamala Kannan', '9003810101', 'kamal@hresolutions.in', 'admin', NULL, '2023-07-01 13:49:57', '2023-07-01 13:49:57'),
(4, '4', 'HRE-045', 'MITHUN KUMAR SINHA', '9035715113', 'mithunsinha@hresolutions.in', 'manager', NULL, '2023-07-01 13:52:05', '2023-07-01 13:52:05'),
(5, '5', 'HRE-013', 'SUMIT KUMAR SINHA', '6360388848', 'sumitsinha.hre@gmail.com', 'supervisor', NULL, '2023-07-01 13:53:06', '2023-07-01 13:53:06'),
(6, '6', 'HRE-017', 'SANJAY KUMAR RANA', '7204056253', 'purchase@hersolutions.in', 'procurement', NULL, '2023-07-01 14:08:34', '2023-07-01 14:12:17'),
(7, '7', 'HRE-043', 'RUPESH RANA', '9304996854', 'rupesh.hre@gmail.com', 'procurement', NULL, '2023-07-01 14:13:18', '2023-07-01 14:13:18'),
(8, '8', 'HRE-007', 'RANJIT RANA', '8792359133', 'accounts@hresolutions.in', 'finance', NULL, '2023-07-01 16:25:14', '2023-07-01 16:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g_r_n_s`
--

DROP TABLE IF EXISTS `g_r_n_s`;
CREATE TABLE `g_r_n_s` (
  `id` bigint UNSIGNED NOT NULL,
  `grn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indent_list_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indent_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatched` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `damaged` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `g_r_n_s`
--

INSERT INTO `g_r_n_s` (`id`, `grn`, `user_id`, `indent_list_id`, `indent_no`, `pcn`, `dispatched`, `approved`, `damaged`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GRN001', '1', '5', 'MI005', 'PCN_5', '3', NULL, NULL, NULL, 'Awaiting for Confirmation', '2023-07-01 13:11:45', '2023-07-01 13:11:45'),
(2, 'GRN002', '4', '6', 'MI006', 'PCN_10', '8', '7', '1', '1 not received', 'Received', '2023-07-01 14:14:40', '2023-07-01 14:17:26'),
(3, 'GRN003', '4', '7', 'MI006', 'PCN_10', '4', '4', '0', 'with good condition', 'Received', '2023-07-01 14:15:21', '2023-07-01 14:18:21'),
(4, 'GRN004', '4', '7', 'MI006', 'PCN_10', '1', '1', '0', 'with good condition', 'Received', '2023-07-01 14:27:17', '2023-07-01 14:31:34'),
(5, 'GRN005', '4', '7', 'MI006', 'PCN_10', '1', '1', '0', 'with good condition', 'Received', '2023-07-01 14:28:47', '2023-07-01 14:31:47'),
(6, 'GRN006', '4', '6', 'MI006', 'PCN_10', '3', '3', '0', 'with good condition', 'Received', '2023-07-01 14:36:39', '2023-07-01 14:47:36'),
(7, 'GRN007', '1', '5', 'MI005', 'PCN_5', '4', NULL, NULL, NULL, 'Awaiting for Confirmation', '2023-07-01 14:55:12', '2023-07-01 14:55:12'),
(8, 'GRN008', '3', '11', 'MI008', 'PCN_050', '20', '20', '0', 'all received', 'Received', '2023-07-01 15:55:15', '2023-07-01 15:56:19'),
(9, 'GRN009', '3', '11', 'MI008', 'PCN_050', '3', '3', '0', 'received', 'Received', '2023-07-01 15:55:25', '2023-07-01 15:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `indent_lists`
--

DROP TABLE IF EXISTS `indent_lists`;
CREATE TABLE `indent_lists` (
  `id` bigint UNSIGNED NOT NULL,
  `indent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recieved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pending` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `indent_lists`
--

INSERT INTO `indent_lists` (`id`, `indent_id`, `material_id`, `decription`, `quantity`, `recieved`, `pending`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'CT003', 'nil', '6', '0', '6', 'Active', '2023-06-30 18:23:34', '2023-06-30 18:23:34'),
(2, '2', 'CT003', 'nil', '7', '0', '7', 'Active', '2023-06-30 18:24:07', '2023-06-30 18:24:07'),
(3, '3', 'SF001', 'nil', '4', '0', '4', 'Active', '2023-06-30 18:24:36', '2023-06-30 18:24:36'),
(4, '4', 'CT001', 'nil', '7', '0', '7', 'Active', '2023-06-30 18:25:49', '2023-06-30 18:25:49'),
(5, '5', 'CT003', 'nil', '4', '0', '4', 'Active', '2023-06-30 18:26:14', '2023-06-30 18:26:14'),
(6, '6', 'CT001', 'BOH PANELING', '10', '10', '0', 'Completed', '2023-07-01 14:07:10', '2023-07-01 14:47:36'),
(7, '6', 'CT002', 'BOH PANELING', '5', '6', '-1', 'Active', '2023-07-01 14:07:10', '2023-07-01 14:31:47'),
(8, '7', 'CT003', 'partition', '10', '0', '10', 'Active', '2023-07-01 14:43:34', '2023-07-01 14:43:34'),
(9, '7', 'CT002', 'back wall', '8', '0', '8', 'Active', '2023-07-01 14:43:34', '2023-07-01 14:43:34'),
(10, '7', 'CT001', 'counter', '12', '0', '12', 'Active', '2023-07-01 14:43:34', '2023-07-01 14:43:34'),
(11, '8', 'CPY003', 'nil', '25', '23', '2', 'Active', '2023-07-01 15:53:13', '2023-07-01 15:57:04'),
(12, '8', 'CT001', 'nil', '15', '0', '15', 'Active', '2023-07-01 15:53:13', '2023-07-01 15:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `indent_trackers`
--

DROP TABLE IF EXISTS `indent_trackers`;
CREATE TABLE `indent_trackers` (
  `id` bigint UNSIGNED NOT NULL,
  `indent_list_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indent_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intends`
--

DROP TABLE IF EXISTS `intends`;
CREATE TABLE `intends` (
  `id` bigint UNSIGNED NOT NULL,
  `indent_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recieved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pending` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intends`
--

INSERT INTO `intends` (`id`, `indent_no`, `pcn`, `user_id`, `quantity`, `recieved`, `pending`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MI001', 'PCN_1', '1', '6', '0', '6', 'Active', '2023-06-30 18:23:34', '2023-06-30 18:23:34'),
(2, 'MI002', 'PCN_2', '1', '7', '0', '7', 'Active', '2023-06-30 18:24:07', '2023-06-30 18:24:07'),
(3, 'MI003', 'PCN_3', '1', '4', '0', '4', 'Active', '2023-06-30 18:24:36', '2023-06-30 18:24:36'),
(4, 'MI004', 'PCN_4', '1', '7', '0', '7', 'Active', '2023-06-30 18:25:49', '2023-06-30 18:25:49'),
(5, 'MI005', 'PCN_5', '1', '4', '0', '4', 'Active', '2023-06-30 18:26:14', '2023-06-30 18:26:14'),
(6, 'MI006', 'PCN_10', '4', '15', '16', '-1', 'Active', '2023-07-01 14:07:10', '2023-07-01 14:47:36'),
(7, 'MI007', 'PCN_10', '4', '30', '0', '30', 'Active', '2023-07-01 14:43:34', '2023-07-01 14:43:34'),
(8, 'MI008', 'PCN_050', '3', '40', '23', '17', 'Active', '2023-07-01 15:53:13', '2023-07-01 15:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
  `id` bigint UNSIGNED NOT NULL,
  `item_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` json DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `item_code`, `category_id`, `name`, `brand`, `uom`, `information`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'CT001', 'C001', 'Ply Wood', 'Archid', 'Nos', '{\"Size\": \"1200mm x 2400mm\", \"GRADE\": \"BWR\", \"THICKNESS\": \"32 mm\"}', '2023-07-01 15:14:38', '2023-06-30 18:14:44', '2023-07-01 15:14:38'),
(2, 'CT002', 'C001', 'Laminate', 'Zing Lam', 'Nos', '{\"Size\": \"1200mm x 2400mm\", \"GRADE\": \"Unicore Glossy\", \"Shade No\": \"Caramal Damask - 49909\", \"THICKNESS\": \"2 mm\"}', '2023-07-01 15:14:36', '2023-06-30 18:17:06', '2023-07-01 15:14:36'),
(3, 'CT003', 'C001', 'HDF (Exterior)', 'Somany', 'Nos', '{\"Size\": \"1200mm x 2400mm\", \"GRADE\": \"BWR\", \"Shade No\": \"Caramal Damask - 49909\", \"THICKNESS\": \"32 mm\"}', '2023-07-01 15:14:12', '2023-06-30 18:18:06', '2023-07-01 15:14:12'),
(4, 'SF001', 'C004', 'Spring', 'n/a', 'nos', '{\"Size\": \"150mm\", \"GRADE\": \"Heavy\", \"THICKNESS\": \"4mm\"}', '2023-07-01 15:14:34', '2023-06-30 18:21:18', '2023-07-01 15:14:34'),
(5, 'GM001', 'C002', 'Toughened Glass', 'Saintgobain', 'Sft', '{\"Quality\": \"Extra Clear\", \"Thickness\": \"12mm\", \"Length x Height\": \"1500mm x 3000mm\"}', '2023-07-01 15:14:32', '2023-07-01 15:00:17', '2023-07-01 15:14:32'),
(6, 'CPY001', 'C001', 'Laminate', 'STYLAM', 'NO', '{\"Shade\": \"142-SD\", \"Finish\": \"Suede\", \"Thickness\": \"0.8 mm\", \"Length x Height\": \"1.2m x 2.44m\"}', NULL, '2023-07-01 15:25:36', '2023-07-01 15:25:36'),
(7, 'CPY002', 'C001', 'Laminate', 'SUNDEK', 'Sheet', '{\"Shade\": \"ACACIA WHITE [2142]\", \"Finish\": \"SF/Suede\", \"Thickness\": \"0.8mm\", \"Length x Height\": \"1.22m x 2.44m\"}', NULL, '2023-07-01 15:28:44', '2023-07-01 15:28:44'),
(8, 'CPY003', 'C001', 'Laminate', 'GREENLAM', 'Sheet', '{\"Shade\": \"GREY [7110]\", \"Finish\": \"SF/Suede\", \"Thickness\": \"0.8mm\", \"Length x Height\": \"1.22m x 2.44m\"}', NULL, '2023-07-01 15:31:29', '2023-07-01 15:31:29'),
(9, 'CPY004', 'C001', 'Plywood', 'GREENPLY', 'Nos', '{\"Grade\": \"MR/Commercial\", \"Length\": \"1.22m x 1.44m\", \"Thicknes\": \"4\"}', NULL, '2023-07-01 16:52:56', '2023-07-01 17:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(373, '2023_06_07_111715_customer_sorft_delete_column', 1),
(374, '2023_06_07_144635_category_soft_delete_column', 1),
(375, '2023_06_07_144649_material_soft_delete_column', 1),
(376, '2023_06_07_151242_employee_soft_delete_column', 1),
(377, '2023_06_07_151745_user_soft_delete_column', 1),
(557, '2014_10_12_000000_create_users_table', 2),
(558, '2014_10_12_100000_create_password_resets_table', 2),
(559, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(560, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(561, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(562, '2016_06_01_000004_create_oauth_clients_table', 2),
(563, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(564, '2019_08_19_000000_create_failed_jobs_table', 2),
(565, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(566, '2023_03_21_055306_create_employees_table', 2),
(567, '2023_03_24_181121_create_materials_table', 2),
(568, '2023_03_28_111355_create_tickets_table', 2),
(569, '2023_03_28_112239_create_pcns_table', 2),
(570, '2023_03_28_112403_create_attendances_table', 2),
(571, '2023_03_28_112545_create_pettycashes_table', 2),
(572, '2023_03_28_183043_create_roles_table', 2),
(573, '2023_03_29_152448_create_intends_table', 2),
(574, '2023_04_03_131317_create_settings_table', 2),
(575, '2023_04_04_111940_create_categories_table', 2),
(576, '2023_04_06_172558_create_size_masters_table', 2),
(577, '2023_04_06_180641_create_thickness_masters_table', 2),
(578, '2023_04_06_180700_create_unit_masters_table', 2),
(579, '2023_04_11_105014_create_customers_table', 2),
(580, '2023_04_11_150354_create_addresses_table', 2),
(581, '2023_04_14_162052_create_indent_lists_table', 2),
(582, '2023_04_18_155451_create_indent_trackers_table', 2),
(583, '2023_04_19_151811_create_g_r_n_s_table', 2),
(584, '2023_05_02_181316_create_ticket_conversations_table', 2),
(585, '2023_05_24_185243_create_petty_cash_details_table', 2),
(586, '2023_06_28_164432_create_vaults_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pcns`
--

DROP TABLE IF EXISTS `pcns`;
CREATE TABLE `pcns` (
  `id` bigint UNSIGNED NOT NULL,
  `pcn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposed_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposed_end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_holidays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `targeted_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_completed_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hold_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days_acheived` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pcns`
--

INSERT INTO `pcns` (`id`, `pcn`, `customer_id`, `client_name`, `brand`, `work`, `location`, `area`, `city`, `state`, `gst`, `proposed_start_date`, `proposed_end_date`, `approve_holidays`, `approved_days`, `targeted_days`, `actual_start_date`, `actual_completed_date`, `hold_days`, `days_acheived`, `status`, `assigned_to`, `owner`, `created_at`, `updated_at`) VALUES
(1, 'PCN_1', '1', 'HARDCASTLE RESTAURANTS', 'Mc DONALD', 'new', 'swdefrgt', 'sdcf', 'swdefrg', 'KARNATAKA', 'GST@#', '2023-07-20', '2023-07-27', 'Yes', '2', '6', '2023-06-30', NULL, '3', NULL, 'Active', '1', '1', '2023-06-30 15:24:21', '2023-06-30 15:24:21'),
(2, 'PCN_2', '2', 'HEISETASSE BEVERAGES', 'RESIDENCE', 'new', 'lkjh', 'se', 'fcDSGt', 'KARNATAKA', 'GST@#', '2023-08-09', '2023-08-17', NULL, '0', '9', '2023-06-30', NULL, NULL, NULL, 'Active', '1', '1', '2023-06-30 15:35:01', '2023-06-30 15:35:01'),
(3, 'PCN_3', '5', 'SAPPHIRE FOODS INDIA LTD', 'STARBUCKS- Naveen Project', 'furniture', 'lkjhgvfc', 'hjugvfc', 'plhju', 'COCHIN', 'dfytyk', '2023-07-10', '2023-07-20', 'Yes', '2', '9', '2023-07-05', '2023-07-13', '1', NULL, 'Active', '1', '1', '2023-06-30 15:36:16', '2023-06-30 15:36:16'),
(4, 'PCN_4', '4', 'HEISETASSE BEVERAGES', 'Third Wave Coffee', 'furniture', 'lkjhgfdsa', ';lknmjbvc', 'ihjugft', 'KARNATAKA', 'aqswdefrgth', '2023-07-25', '2023-07-29', 'Yes', '3', '2', '2023-07-20', '2023-07-27', NULL, NULL, 'Active', '1', '1', '2023-06-30 15:37:29', '2023-06-30 15:37:29'),
(5, 'PCN_5', '5', 'SAPPHIRE FOODS INDIA LTD', 'CALIFORNIA BURRITO', 'mnb', 'lkjhugft', 'khjugfdxs', 'ogfts', 'KARNATAKA', 'dfytyk', '2023-07-20', '2023-07-28', 'Yes', '3', '6', '2023-07-19', '2023-07-27', '6', NULL, 'Active', '1', '1', '2023-06-30 15:38:22', '2023-06-30 15:38:22'),
(6, 'PCN_10', '6', 'TATA Starbucks', 'Starbucks Coffee', 'furniture works', 'DSHA, T2', 'BIAL', 'Bengaluru', 'Karanataka', '29aa3c111111', '2023-07-01', '2023-07-28', 'Yes', '2', '26', '2023-07-01', NULL, NULL, NULL, 'Active', '1', '1', '2023-07-01 13:06:27', '2023-07-01 13:06:27'),
(7, 'PCN_874', '7', 'BRIKOVEN FOOD LIMITED', 'BRIKOVEN', 'Turn Key Project', 'G\'Floor, RMZ 30', 'RMZ ECOWORLD', 'Bangalore', 'KARNATAKA', '29AAAABBBCCC', '2023-07-01', '2023-07-31', 'Yes', '2', '29', '2023-07-01', NULL, NULL, NULL, 'Active', '3', '3', '2023-07-01 14:51:40', '2023-07-01 14:51:40'),
(8, 'PCN_863', '6', 'TATA Starbucks India Pvt Ltd', 'Starbucks Coffee', 'Turnkey', 'Domestic SHA, T2', 'BIAL', 'Bangalore', 'Karanataka', '29aa3c111111', '2023-07-05', '2023-08-07', 'Yes', '3', '31', '2023-07-03', NULL, NULL, '', 'Active', '3', '3', '2023-07-01 14:55:41', '2023-07-01 14:56:01'),
(9, 'PCN_869', '6', 'TATA Starbucks India Pvt Ltd', 'Starbucks Coffee', 'Turn Key Project', 'Internationa SHA, T2', 'BIAL', 'Bangalore', 'Karanataka', '29aa3c111111', '2023-07-01', '2023-07-31', 'No', '0', '31', '2023-07-01', NULL, NULL, NULL, 'Active', '3', '3', '2023-07-01 14:58:01', '2023-07-01 14:58:01'),
(10, 'PCN_050', '8', 'HITESH RANA ENTERPRISES', 'Head Office', 'R&M', '241/E', 'Opp Bhima Jewellers', 'Bangalore', 'KARNATAKA', '29AJP1', '2023-07-01', '2023-07-31', NULL, '0', '31', '2023-07-01', NULL, NULL, NULL, 'Active', '3', '3', '2023-07-01 15:50:35', '2023-07-01 15:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pettycashes`
--

DROP TABLE IF EXISTS `pettycashes`;
CREATE TABLE `pettycashes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spend` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remaining` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finance_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pettycashes`
--

INSERT INTO `pettycashes` (`id`, `user_id`, `total`, `comments`, `spend`, `remaining`, `finance_id`, `mode`, `reference_number`, `created_at`, `updated_at`) VALUES
(1, '2', '50000', 'htdmtd,ydf', '0', '50000', '1', 'Cash', NULL, '2023-06-30 18:31:37', '2023-06-30 18:31:37'),
(2, '4', '10000', 'petty cash', '500', '9500', '3', 'Cash', NULL, '2023-07-01 13:55:41', '2023-07-01 13:57:49'),
(3, '3', '11519', 'Opening Balance from May 2023', '0', '11519', '3', 'Cash', NULL, '2023-07-01 17:21:12', '2023-07-01 17:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `petty_cash_details`
--

DROP TABLE IF EXISTS `petty_cash_details`;
CREATE TABLE `petty_cash_details` (
  `id` bigint UNSIGNED NOT NULL,
  `pettycash_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spent_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isapproved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petty_cash_details`
--

INSERT INTO `petty_cash_details` (`id`, `pettycash_id`, `billing_no`, `bill_date`, `spent_amount`, `purpose`, `pcn`, `comments`, `filename`, `isapproved`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '2', 'PC001', '2023-07-01', '500', 'Personal', NULL, 'HOTEL CHARGES', 'PC001.pdf', '1', 'Approved', '2023-07-01 13:56:49', '2023-07-01 13:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `alias`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Super Admin', 'All Controles', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(2, 'manager', 'Project Manager', 'All Controles', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(3, 'procurement', 'Procurement', 'Limited data can see', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(4, 'supervisor', 'Supervisor', 'Limited data can see', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(5, 'finance', 'Finance', 'Limited data can see', '2023-06-30 14:37:22', '2023-06-30 14:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size_masters`
--

DROP TABLE IF EXISTS `size_masters`;
CREATE TABLE `size_masters` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size_masters`
--

INSERT INTO `size_masters` (`id`, `category_id`, `size`, `description`, `created_at`, `updated_at`) VALUES
(1, 'CT', '1200mm x 2400mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(2, 'CT', '900mm x 2100mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(3, 'FS', '150 mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(4, 'FS', '200 mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(5, 'FS', '900mm x 1800mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(6, 'FS', '1000 mtr', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(7, 'CA', '75mm x 100mm x 225mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(8, 'CA', '100mm x 200mm x 400mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(9, 'CA', '150mm x 2000mm x 400mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(10, 'CA', '200mm x 200mm x 400mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(11, 'CA', '100m x 200mm x 600mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(12, 'CA', 'CFT', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(13, 'EL', '12 mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(14, 'EL', '20 mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(15, 'EL', '20 mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(16, 'EL', '12 mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(17, 'EL', '5 amps', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(18, 'EL', '32 amps', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `thickness_masters`
--

DROP TABLE IF EXISTS `thickness_masters`;
CREATE TABLE `thickness_masters` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thickness` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thickness_masters`
--

INSERT INTO `thickness_masters` (`id`, `category_id`, `thickness`, `description`, `created_at`, `updated_at`) VALUES
(1, 'CT', 'mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(2, 'FS', 'mm', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(3, 'FS', 'mm Density', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(4, 'EL', 'Gauge', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(5, 'EL', 'n/a', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reopened` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_no`, `pcn`, `category`, `issue`, `assigner`, `assigned_to`, `creator`, `status`, `reopened`, `priority`, `tat`, `comments`, `filename`, `created_at`, `updated_at`) VALUES
(1, 'TN001', 'PCN_3', 'CARPENTRY', 'iuhgfdghj', NULL, NULL, '1', 'Created', '0', 'High', NULL, NULL, 'loose-chair-joint-for-repair.jpg', '2023-06-30 18:28:14', '2023-06-30 18:28:14'),
(2, 'TN002', 'PCN_2', 'FOAM & SOFA FURNISHING', 'sdfghjk', NULL, NULL, '1', 'Created', '0', 'Medium', NULL, NULL, 'Bill-No-COVID-grant-copy.png', '2023-06-30 18:28:50', '2023-06-30 18:28:50'),
(3, 'TN003', 'PCN_4', 'LIGHT FIXTURES', 'kjhuyghjkl', NULL, NULL, '1', 'Created', '0', 'Low', NULL, NULL, 'CreeCracksOverview.jpg', '2023-06-30 18:29:16', '2023-06-30 18:29:16'),
(4, 'TN004', 'PCN_863', 'CARPENTRY', 'Chari wooden leg damaged', NULL, NULL, '3', 'Created', '0', 'Medium', NULL, NULL, 'old-broken-chair-street-i-nnaples-italy-50196341.webp', '2023-07-01 16:01:13', '2023-07-01 16:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_conversations`
--

DROP TABLE IF EXISTS `ticket_conversations`;
CREATE TABLE `ticket_conversations` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_masters`
--

DROP TABLE IF EXISTS `unit_masters`;
CREATE TABLE `unit_masters` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_masters`
--

INSERT INTO `unit_masters` (`id`, `category_id`, `unit`, `description`, `created_at`, `updated_at`) VALUES
(1, 'CT', 'Nos', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(2, 'FS', 'Nos', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(3, 'FS', 'RMT (Running Meter)', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(4, 'FS', 'CFT (Cubic Feet)', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(5, 'EL', 'Length', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(6, 'EL', 'Nos', '', '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(7, 'GM', 'Sft', NULL, '2023-07-01 15:00:17', '2023-07-01 15:00:17'),
(8, 'CPY', 'NO', NULL, '2023-07-01 15:25:36', '2023-07-01 15:25:36'),
(9, 'CPY', 'Sheet', NULL, '2023-07-01 15:28:44', '2023-07-01 15:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isloggedin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `role`, `email_verified_at`, `password`, `isloggedin`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'admin@admin.com', '1', 'admin', NULL, '$2y$10$vIM5xVNn.nM4UVl1gFd1F.Mn2iG4Jb4/MWZ2slP.b963so6bMmX32', '0', NULL, NULL, '2023-06-30 14:37:22', '2023-06-30 14:37:22'),
(2, 'druva', 'druva@gmail.com', '2', 'manager', NULL, '$2y$10$Bv20PlJIoTIzR1gQnnBs9.5kRphDAfxW47LEiHNMqdqME9FFcRfrC', '0', NULL, NULL, '2023-06-30 18:30:56', '2023-06-30 18:30:56'),
(3, 'Kamala Kannan', 'kamal@hresolutions.in', '1', 'admin', NULL, '$2y$10$8XiS7SvEv1XClhV0CbAiw.zOdL.r3xcHgEajjYZdOUvMgz1fgCRX2', '0', NULL, NULL, '2023-07-01 13:49:57', '2023-07-01 13:49:57'),
(4, 'MITHUN KUMAR SINHA', 'mithunsinha@hresolutions.in', '2', 'manager', NULL, '$2y$10$H2Wcvf23wsbXbY/qsL1UWem6MJWJbxtvujw0Sb6GFfAkt9REaxh0i', '0', NULL, NULL, '2023-07-01 13:52:05', '2023-07-01 13:52:05'),
(5, 'SUMIT KUMAR SINHA', 'sumitsinha.hre@gmail.com', '4', 'supervisor', NULL, '$2y$10$09gqVinWcbGV2zPgSS/HP.bKwWw29HPaEdj3aBsGZkSpGXadpAITm', '0', NULL, NULL, '2023-07-01 13:53:06', '2023-07-01 13:53:06'),
(6, 'SANJAY KUMAR RANA', 'purchase@hersolutions.in', '3', 'procurement', NULL, '$2y$10$/qTJjF3DCWoB9jMCVz2tP.R171anyqi.SlwYup08nYBPpp9NuFXDe', '0', NULL, NULL, '2023-07-01 14:08:34', '2023-07-01 14:12:17'),
(7, 'RUPESH RANA', 'rupesh.hre@gmail.com', '3', 'procurement', NULL, '$2y$10$Wa2HAsLMXQrCqBCIsFcrse7C1DOnfUApt0/v6AZlFc1Z4Z3dGM4PW', '0', NULL, NULL, '2023-07-01 14:13:18', '2023-07-01 14:13:18'),
(8, 'RANJIT RANA', 'accounts@hresolutions.in', '5', 'finance', NULL, '$2y$10$LzM0xC4PsLsv7lKweZ0ssuwXhm2W9K8Gyy.dEAoeQcvTMiszfSlTm', '0', NULL, NULL, '2023-07-01 16:25:14', '2023-07-01 16:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `vaults`
--

DROP TABLE IF EXISTS `vaults`;
CREATE TABLE `vaults` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_mobile_unique` (`mobile`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_employee_id_unique` (`employee_id`),
  ADD UNIQUE KEY `employees_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `g_r_n_s`
--
ALTER TABLE `g_r_n_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indent_lists`
--
ALTER TABLE `indent_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indent_trackers`
--
ALTER TABLE `indent_trackers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intends`
--
ALTER TABLE `intends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pcns`
--
ALTER TABLE `pcns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pcns_pcn_unique` (`pcn`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pettycashes`
--
ALTER TABLE `pettycashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petty_cash_details`
--
ALTER TABLE `petty_cash_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_masters`
--
ALTER TABLE `size_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thickness_masters`
--
ALTER TABLE `thickness_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_conversations`
--
ALTER TABLE `ticket_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_masters`
--
ALTER TABLE `unit_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vaults`
--
ALTER TABLE `vaults`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g_r_n_s`
--
ALTER TABLE `g_r_n_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `indent_lists`
--
ALTER TABLE `indent_lists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `indent_trackers`
--
ALTER TABLE `indent_trackers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intends`
--
ALTER TABLE `intends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=587;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pcns`
--
ALTER TABLE `pcns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pettycashes`
--
ALTER TABLE `pettycashes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `petty_cash_details`
--
ALTER TABLE `petty_cash_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size_masters`
--
ALTER TABLE `size_masters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `thickness_masters`
--
ALTER TABLE `thickness_masters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket_conversations`
--
ALTER TABLE `ticket_conversations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_masters`
--
ALTER TABLE `unit_masters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vaults`
--
ALTER TABLE `vaults`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
