-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 25, 2023 at 10:31 AM
-- Server version: 10.6.11-MariaDB-1:10.6.11+maria~ubu2004-log
-- PHP Version: 8.1.14

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
  `id_category` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `label` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `label`) VALUES
(9, 'Женщины', 'female'),
(10, 'Мужчины', 'male'),
(11, 'Дети', 'children'),
(12, 'Аксесуары', 'access');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `id_category` int(100) UNSIGNED DEFAULT NULL,
  `dt_add` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name`, `price`, `image`, `id_category`, `dt_add`) VALUES
(24, 'Dress 1', 500, 'https://phpclothes.eu-central-1.amazonaws.com/0204055bd2de69b15a2f44790f81e61e6a0af7b46884b9707c2f2935c997.jpg', 9, '2023-01-25 09:50:03'),
(25, 'Dress2', 700, 'https://phpclothes.eu-central-1.amazonaws.com/8859c784da69b16495d370743ad21067d746bf0abbbd8167627c5145903d.jpg', 9, '2023-01-25 09:50:50'),
(26, 'Dress 3', 1500, 'https://phpclothes.eu-central-1.amazonaws.com/0d9dec1be0309d55b30daeb82f857b1788277185f6a855044b0398f609ca.jpg', 9, '2023-01-25 09:51:22'),
(27, 'Pants 1', 1250, 'https://phpclothes.eu-central-1.amazonaws.com/d9f4e72b774dc63303ebf7a7fc533d0c2d47ec6c49a97e190186a6e0d5ab.jpg', 10, '2023-01-25 09:51:43'),
(28, 'Pants 2', 7000, 'https://phpclothes.eu-central-1.amazonaws.com/74181c6c6f81e57c80f082f2123d72819ea2bc76a15cfa7524d3bca7cdf1.jpg', 10, '2023-01-25 09:52:07'),
(29, 'Gucci pants', 15000, 'https://phpclothes.eu-central-1.amazonaws.com/b1dded21c018e23aefedef04d83018726e421f89a17e53cde69ae9345c36.jpg', 9, '2023-01-25 09:52:41'),
(30, 'Sunglasses', 100, 'https://phpclothes.eu-central-1.amazonaws.com/6fd38e798bcfb80b31a9f1a27c4909966bdf94abf989e064a48d869dc1e7.jpg', 12, '2023-01-25 09:53:01'),
(31, 'Sweater', 350, 'https://phpclothes.eu-central-1.amazonaws.com/fc98305740d65d5e1df0562386ab07a68a57c4a341f6f714e206f14eba4e.jpg', 11, '2023-01-25 09:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `label` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id_tag`, `name`, `label`) VALUES
(1, 'Новинка', 'new'),
(2, 'Распродажа', 'sale');

-- --------------------------------------------------------

--
-- Table structure for table `tags_products`
--

CREATE TABLE `tags_products` (
  `id_primary` bigint(20) UNSIGNED NOT NULL,
  `id_tag` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags_products`
--

INSERT INTO `tags_products` (`id_primary`, `id_tag`, `id_product`) VALUES
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
  `id_user` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `login` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `id_status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `label` (`label`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `name` (`name`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`),
  ADD KEY `label` (`label`);

--
-- Indexes for table `tags_products`
--
ALTER TABLE `tags_products`
  ADD PRIMARY KEY (`id_primary`),
  ADD KEY `id_tag` (`id_tag`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags_products`
--
ALTER TABLE `tags_products`
  MODIFY `id_primary` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tags_products`
--
ALTER TABLE `tags_products`
  ADD CONSTRAINT `tags_products_ibfk_1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags_products_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
