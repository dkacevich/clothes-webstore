-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 31, 2023 at 04:11 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothes`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `label` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `label`) VALUES
(9, 'Женщины', 'female'),
(10, 'Мужчины', 'male'),
(11, 'Дети', 'children'),
(12, 'Аксесуары', 'access');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `firstname` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `patronymic` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `firstname`, `lastname`, `patronymic`, `phone`, `email`, `payment`, `comment`) VALUES
(1, 'me', 'to', 'yes', '2522222222222222', 'fsfsfe@fafa.bj', 'card', NULL),
(2, '2424', '2424', NULL, '2424', '235@fad.cv', 'card', NULL),
(3, 'Pavel', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'cash', 'No'),
(4, 'Pavel', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'card', NULL),
(5, 'taewtaet', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'card', NULL),
(6, 'taewtaet', 'Doroshenko', NULL, '+33553355335', '235@fad.cv', 'card', NULL),
(7, '32535', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'cash', NULL),
(8, 'taewtaet', 'Doroshenko', NULL, '+33553355335', '235@fad.cv', 'card', NULL),
(9, 'taewtaet', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'card', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int UNSIGNED NOT NULL,
  `id_order` int UNSIGNED NOT NULL,
  `id_product` int UNSIGNED NOT NULL,
  `product_qty` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `id_order`, `id_product`, `product_qty`) VALUES
(7, 8, 24, 2),
(8, 8, 26, 1),
(9, 8, 28, 1),
(10, 9, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `image` text COLLATE utf8mb4_general_ci,
  `id_category` int UNSIGNED DEFAULT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `id_category`, `dt_add`) VALUES
(24, 'Dress 1', 500, '/uploads/dress1.jpg', 9, '2023-01-25 09:50:03'),
(25, 'Dress2', 700, '/uploads/dress2.jpg', 9, '2023-01-25 09:50:50'),
(26, 'Dress 3', 1500, '/uploads/dress3.jpg', 9, '2023-01-25 09:51:22'),
(27, 'Pants 1', 1250, '/uploads/pants1.jpg', 10, '2023-01-25 09:51:43'),
(28, 'Pants 2', 7000, '/uploads/pants2.jpg', 10, '2023-01-25 09:52:07'),
(29, 'Gucci pants', 15000, '/uploads/pants3.jpg', 9, '2023-01-25 09:52:41'),
(30, 'Sunglasses', 100, '/uploads/glasses.jpg', 12, '2023-01-25 09:53:01'),
(31, 'Sweater', 350, '/uploads/sweater.jpg', 11, '2023-01-25 09:53:22'),
(36, 'est', 123, '/uploads/sweater.jpg', NULL, '2023-01-30 10:32:50'),
(37, '1331', 2331, '/uploads/sweater.jpg', NULL, '2023-01-30 10:33:15'),
(38, '123', 232, '/uploads/sweater.jpg', NULL, '2023-01-30 10:33:58'),
(39, '24', 23, '/uploads/sweater.jpg', NULL, '2023-01-30 10:35:54'),
(40, '123', 23, '/uploads/sweater.jpg', NULL, '2023-01-30 10:37:53'),
(41, '13', 223, '/uploads/dress3.jpg', NULL, '2023-01-30 10:38:16'),
(42, 'Have be good', 111, '/uploads/dress2.jpg', NULL, '2023-01-30 10:39:50'),
(43, '24', 24, '/uploads/sweater.jpg', NULL, '2023-01-30 10:41:06'),
(44, '123', 4444, '/uploads/sweater.jpg', NULL, '2023-01-30 10:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `label` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `label`) VALUES
(1, 'Новинка', 'new'),
(2, 'Распродажа', 'sale');

-- --------------------------------------------------------

--
-- Table structure for table `tags_products`
--

CREATE TABLE `tags_products` (
  `id` bigint UNSIGNED NOT NULL,
  `id_tag` int UNSIGNED NOT NULL,
  `id_product` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags_products`
--

INSERT INTO `tags_products` (`id`, `id_tag`, `id_product`) VALUES
(8, 1, 24),
(9, 1, 25),
(11, 1, 27),
(13, 1, 29),
(14, 1, 31),
(10, 2, 25),
(12, 2, 28);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `login` int NOT NULL,
  `password` int NOT NULL,
  `id_status` tinyint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `label` (`label`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `label` (`label`);

--
-- Indexes for table `tags_products`
--
ALTER TABLE `tags_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tag` (`id_tag`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags_products`
--
ALTER TABLE `tags_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tags_products`
--
ALTER TABLE `tags_products`
  ADD CONSTRAINT `tags_products_ibfk_1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags_products_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
