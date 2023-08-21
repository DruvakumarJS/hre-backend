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
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `season` varchar(255) DEFAULT NULL,
  `duration` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `name`, `category_id`, `season`, `duration`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Amarnath Green', '1 ', 'Summer crop -Throughout the year', '30-40', 'It is a leafy vegetable that comes in red and green colour. It is a shrub, short-duration crop which will be ready for harvest within 30-45 days. It is a good source of Iron, Magnesium, Phosphorus,etc.', 'amarnath.jpg', '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(2, 'Chakotha ', '1 ', 'Throughout the year ', '45-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(3, 'Chukkaaku (Sorrel) ', '1 ', 'Summer crop  ', '30-40 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(4, 'Fenugreek ', '1 ', 'Summer crop -Throughout the year ', '40 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(5, 'Gongura (Roselle) ', '1 ', 'Summer crop -Throughout the year ', '35-45 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(6, 'Spinach ', '1 ', 'Summer crop -Throughout the year ', '45 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(7, 'Aregula ', '1 ', 'Summer crop -Throughout the year ', '45-50 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(8, 'Kale ', '1 ', 'Cold crop Throughout the year ', '50-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(9, 'Lettuce Green ', '1 ', 'Cold crop Throughout the year ', '45 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(10, 'Lettuce Red ', '1 ', 'Cold crop Throughout the year ', '45 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(11, 'Mizuana ', '1 ', 'Cold crop Throughout the year ', '45-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(12, 'Pakchoi/Bokchoi ', '1 ', 'Cold crop Throughout the year ', '50-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(13, 'Swiss chard Red ', '1 ', 'Summer crop -Throughout the year ', '45 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(14, 'Mints ', '2 ', '-', 'Perennial ', NULL, 'mint.jpg', '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(15, 'Rosemerry ', '2 ', '-', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(16, 'Thyme ', '2 ', '-', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(17, 'Lavender ', '2 ', '-', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(18, 'Oregano ', '2 ', '-', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(19, 'Mint ', '3 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(20, 'Chives ', '3 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(21, 'Sage ', '3 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(22, 'Stevia ', '3 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(23, 'Dill ', '3 ', 'Summer crop -Throughout the year ', '50-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(24, 'Kasuri Methi ', '3 ', 'Summer crop -Throughout the year ', '45-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(25, 'Coriander ', '3 ', 'Throughout the year ', '45-55 ', NULL, 'coriander.jpg', '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(26, 'Turmeric ', '4 ', 'Summer crop -Throughout the year ', '90 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(27, 'Doddapathre ', '4 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(28, 'Basil ', '4 ', '- ', 'Perennial ', NULL, 'basil.jpg', '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(29, 'Wheat Grass ', '4 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(30, 'Aloe Vera ', '4 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(31, 'Brahmi ', '4 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(32, 'Amruthaballi ', '4 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(33, 'Lemon grass ', '4 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(34, 'Lemon Balm ', '4 ', '- ', 'Perennial ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(35, 'Bitter gourd ', '5 ', 'Summer crop -Throughout the year ', '50-65 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(36, 'Brinjal (bottle purple) ', '5 ', 'Summer crop -Throughout the year ', '105-130 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(37, 'Brinjal (Long Green) ', '5 ', 'Summer crop -Throughout the year ', '105-120 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(38, 'Broccoli ', '5 ', 'Cold crop ', '120-150 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(39, 'Capsicum ', '5 ', 'Summer crop -Throughout the year ', '120-150 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(40, 'Cauliflower ', '5 ', 'Cold crop - Winter ', '120-150 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(41, 'Chilli ', '5 ', 'Summer crop -Throughout the year ', '120-150 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(42, 'Cucumber - Parthenocarpic ', '5 ', 'Summer crop -Throughout the year ', '50-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(43, 'Cucumber - normal ', '5 ', 'Summer crop -Throughout the year ', '_ ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(44, 'Dolichos (Avare) ', '5 ', 'Winter / cold crop ', '55-90 ', NULL, 'avare.jpg', '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(45, 'French Beans ', '5 ', 'Summer crop -Throughout the year ', '60-90 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(46, 'Peas (Green Peas) ', '5 ', 'Winter / cold crop ', '45-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(47, 'Ridge gourd ', '5 ', 'Summer crop -Throughout the year ', '65-120 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(48, 'Tomato Cherry ', '5 ', 'Summer crop -Throughout the year ', '120 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(49, 'Tomato Normal ', '5 ', 'Summer crop -Throughout the year ', '150 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(50, 'Zuchchini (light green) ', '5 ', 'Summer crop -Throughout the year ', '55-75 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(51, 'Beetroot ', '6 ', 'Cold crop ', '100 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(52, 'Carrot ', '6 ', 'August to October ', '90 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(53, 'Knolkhol ', '6 ', 'Cold crop ', '50-60 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(54, 'Radish ', '6 ', 'Cold crop ', '45-50 ', NULL, 'raddish.jpg', '2023-08-08 04:40:10', '2023-08-08 04:40:10'),
(55, 'Radish - Purple ', '6 ', 'Cold crop ', '45-50 ', NULL, NULL, '2023-08-08 04:40:10', '2023-08-08 04:40:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
