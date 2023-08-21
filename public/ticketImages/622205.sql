-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2023 at 07:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hydrolore_staging`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `season` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `season`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Greens', NULL, ' Leafy vegetables: Crops which are grown for their leaves as produce which can be consumed either in raw form or in cooked form falls under this category. These can be exotic varieties like Lettuce, Pokchoy or can be native varieties such as Amaranthus, Spinach & more', '2023-08-07 07:43:34', '2023-08-07 07:43:34'),
(2, 'Aromatic Herbs', NULL, 'These are the category of crops where plant parts are rich in essential oils. These crops have industrial importance and some of these crop leaves are used for flavoring/garnishing the foods. ', '2023-08-07 07:43:34', '2023-08-07 07:43:34'),
(3, 'Flavoring Herbs', NULL, 'Crops parts which have healing properties or disease preventing properties fall under this category of crops. When these crops are used as a medicinal one has to be sure that a certified practitioner has defined the dosages. Apart from a medicinal perspective, due to their nutritional, preventive and healing properties, a few crop are used as flovoring/garnishing purposes.', '2023-08-07 07:44:41', '2023-08-07 07:44:41'),
(4, 'Medicinal Herbs', NULL, 'Crops parts which have healing properties or disease preventing properties fall under this category of crops. When these crops are used as a medicinal one has to be sure that a certified practitioner has defined the dosages. Apart from a medicinal perspec', '2023-08-07 07:44:41', '2023-08-07 07:44:41'),
(5, 'Vegetables', NULL, 'Crops producing fruits which are majorly used to cook food/meals, make salads, etc fall under this category.', '2023-08-07 07:45:45', '2023-08-07 07:45:45'),
(6, 'Root Crops', NULL, 'Crops which are grown for their tuberous/bulbous roots/stems come under this group of crops.', '2023-08-07 07:45:45', '2023-08-07 07:45:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
