-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 01, 2023 at 10:05 AM
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
(9, 'taewtaet', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'card', NULL),
(10, 'taewtaet', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'card', NULL),
(11, 'taewtaet', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'card', NULL),
(12, 'taewtaet', '235235', NULL, '+33553355335', '235@fad.cv', 'card', NULL),
(13, 'taewtaet', '2424', NULL, '+33553355335', 'men.me@urk.net', 'card', NULL),
(14, 'taewtaet', 'Doroshenko', NULL, '+33553355335', 'men.me@urk.net', 'card', NULL);

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
(10, 9, 24, 1),
(11, 12, 25, 3),
(12, 12, 24, 1),
(13, 13, 24, 1),
(14, 14, 24, 2),
(15, 14, 25, 2);

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
(44, '123', 4444, '/uploads/sweater.jpg', NULL, '2023-01-30 10:41:38'),
(45, 'Added by admin', 1414, '/uploads/burgess-milner-OYYE4g-I5ZQ-unsplash (1).jpg', NULL, '2023-02-01 05:42:07'),
(53, 'Admin added', 1000, '/uploads/done.png', NULL, '2023-02-01 07:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `token` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `id_user`, `token`, `dt_add`) VALUES
(1, 1, '17ecdb0853e197c24adcca89b9cd40fd310565ebd234e1fccb9cb9806485de0422a298e8bc736c804390eb68ced45cbccf3cd30f1c8521141f7ddc7b7d36b10c', '2023-01-31 16:46:17'),
(5, 1, 'addae2d944668e04c893e21618e649ecabca13136bc89a7617c27538ff5d4d65939cb4beb892a73f43d8d54102d9343259c904c926c362d3f8cf2b913f6e6a06', '2023-01-31 16:55:33'),
(6, 1, '2645fa39afb7598646268089f4864350b3e57a8e02f8de92d9086cba9f3a48ac09ccf2642d4f8227e5a3dd7354a3bc3a35b316c1249099c5b93ee88b353b7c75', '2023-01-31 16:56:17'),
(7, 1, '8ac8b3b864e3c402ade4e816ec23401ff458206d2426dafdeb77c9c1270aa6676ada45270da54bdd81dbf9af67fe1065e927d8196e4eeb4497ec74f5b3cd1fa9', '2023-01-31 16:56:29'),
(8, 1, '2d8c6d5ba01e2273fedb213ffc5a149ee1b7dd433ab8452c5b2174ebb631487858f9b425411cffa898a897a1712b76f32979941138ab80a4e3ec304f0eb844cb', '2023-01-31 16:56:43'),
(9, 1, '6286a7a1971e02a325a9b29b281e60b66cee8874c2a9bd16d0c068733a1d34a905a019bc62005137469e3c2d70b5e931ee523d6bb5214e7e8f8b32f42cffcac5', '2023-01-31 16:59:28'),
(10, 1, '9b1ef90e5eaabc463889756e4cb9901395513e4cc3ca9eff0227f6a93437535167846bfc622010c95400fe1db41ed4c44b3069fe0cddae78cb2890026b487a0c', '2023-01-31 17:02:34'),
(11, 1, '592d0121010c83ecd9cf39a375173925a9b31470c7f03e92add26402b72ed73e8211c800b64b6ad568a47a062a351a0750172de60756a25754eca6fad12c41af', '2023-01-31 17:03:04'),
(12, 1, 'a289c64057ada1aab52ac98674cced0dec250fcb4c81ae10b411b1494839069343d2f7b88a37d2eb22e855ed0cc6187287c18419981b04fb728442d2f8d250a6', '2023-01-31 17:03:41'),
(13, 1, '943456762771395a1c0351946e84e4d19c62006b1bd2187e3b3daa30a57abffe039355741642ec144950c21d1596cc2a3a2569ed67bde5b951e7c295fd2b8aab', '2023-01-31 17:04:05'),
(14, 1, '528f464c895a540e6d390b3651bfc22d182eb4bd9109f8d1be8dc4fb13eae1c29569076470fe011f97ffb50ead13833121c18214d12eec2ce9a09459f1f51705', '2023-01-31 17:04:28'),
(15, 1, '0fac4dc3b2a7bed5c9e244d7b454d053aeeadda12004d6507547cabb8cfa84ba4284787e2ff87946b6b9a574c98857d74ecdac13a96ab0c5f15b6eca1b097687', '2023-01-31 17:06:56'),
(16, 1, '6969d53b4c192715058f110cb5ead73f541cd9eb83591f0cc78fe8bd5e384e740d6f85829e1f0ddd740756bc9f0b97a96b786b2b8c89749a966fff63034382ad', '2023-01-31 17:07:41'),
(17, 1, 'a58fed26dce86c8b8f9f5b82fac1e69c320d63f6a85a20fb5c14a7f63fa5283598a26664b42566dade606e48c7e9f65e9094e8e1360e3a4df16dfa2fbd593e33', '2023-01-31 17:08:59'),
(18, 1, 'b360c377b7b46eb9566a0fe6f3c864fa8e48ef09cd7dd4932206856b06dc5715c3faada182437e36b9b7852e00a885b637b3df5cfcf8f99392f2325489a3ae35', '2023-01-31 17:09:43'),
(19, 1, '75ef31339425304d921512c7db80b88e9987684465a32108db7c0be5adcf5d3c17a480f83a8f4b955263642dacdfe825d55dc3d7c5981a443e98bd25d93c34e9', '2023-01-31 17:10:00'),
(20, 1, '970e87e4f691af2d49b398e731f8b4783c4c193d2ef3a26c32180345d27d25519c2fdfafaae724c3001f3ae4a96f815f858a6b24082a0b5449fb399a5e2f79b9', '2023-01-31 17:10:11'),
(21, 1, '8dfffefd882330bf58c41944b8797a98e7a1670513f8c5166e2992d4554166dc293265b0f8ccc3afa97edfa40e8ef6dbf99678d75d7d5854eb850dbb17fa0344', '2023-01-31 17:10:49'),
(22, 1, '0c1af98e8cf0390cb67c2b55176404f419e8f7ecd22853c40205d3fc8b8f06d7acb72cb5d47c16a5028b9950a6d60bed5c3d668499d4659717ae811f8aed26e5', '2023-01-31 17:11:35'),
(23, 1, '0c633ad908ad569550d55bfb2144a9cd57c0a301c37252765f7299a9e7f3630430411d3571d745451b7f8069ac762fe224121230b5d7cb344bd5f13d6bdae74d', '2023-01-31 17:11:48'),
(24, 1, '72ff0e3e63daa3ffd3f5ff647f5b864e2a62ea2dc2902fdf446413583b36c10376bbcc0ed221fba5db4f2ae41d091d32d8eb634a0d42aaef7457e6665dabfe57', '2023-01-31 17:13:43'),
(25, 1, '863cbbc3db1e13973414768139aa83b7d8e96cda2b39bc104ef7fef09472c759dca595e8768de0cd8fc53cdd1df3944c74c8d513c37dafe924c86ad967ee77cd', '2023-01-31 17:14:43'),
(26, 1, 'f0dd4f7e402eba765bcbce30049747d4c1e43428f4db5423eed3ab4d18ca3134fe3a95d39354538a2b13a247326f005abf37e2ab38d9974184e136b06930cdef', '2023-01-31 17:14:54'),
(27, 1, 'a5392f3416b1a2707cf9b5dd0ecec9e747d44b6d7805b85d35535b0b4d07ad7dd0086aebaa0d993e5adf5ae5a4690a8719fc8f31bb6ad3ed76f430e615dd3d6c', '2023-01-31 17:17:06'),
(28, 1, '7771c63e235671b48b8bddbd8694c50341d6282724be45c9a35048cd99830804e88bba9dd3b97b9f9c91c7950ae264c8aa67878e5bb113fe0063e4852659887f', '2023-01-31 17:17:57'),
(29, 1, '5d91a2c7f2f3ee833809e5eedda0f1d5215e7def679c00e6457b5ae79180022c87bae27e7dbc2271c96276eb13c2baaf5162b3dc22110f74b0837a0dd34f3e6a', '2023-01-31 17:18:21'),
(30, 1, 'bc8d0e5501e76194a11c0d9c759ae751c6d65e4a4e0ee2ebb641eb67fbed108073c7bc44eb3c657659e486f5cddfdc3265847ff8229a49f3ee3da2b5af3ddfd5', '2023-02-01 05:41:14'),
(31, 1, '5e8437ab5a3bd9e3a3e8b143d0dd944900e061a6d7c1921eec02fb51d7e502648d209a77f9f4c0de477973c4f64a0532f70e099bafb816dc9b8484a4253bd7ae', '2023-02-01 05:51:31'),
(32, 1, 'b7f884dd81203a12e3ae720d6c4b64744f46de1eecd698058920d417941cfd4dfc321aa82be446ae10f557c193e8092abadf2248cc0a2cb911ed1c8cc10c1a99', '2023-02-01 05:51:36'),
(33, 1, '9f92b7d0db1fbde6884e585249e54cd653dcc38a4617e3f2b844a22d450e4ad44726d1d08e1d8bdbf6525e6a4285a41a9426468a42ed29760fffd7b0d98e35ef', '2023-02-01 05:51:39'),
(34, 1, 'f3b9325f77898aa7950f08e6b869dbd5fa2ed8df9d1eccbd0f94f391e1c54dd91605a2c9ecef98718629f3ad5812221c1eb12d6ffb038c1eca51f1bcbdf73404', '2023-02-01 05:51:59'),
(35, 2, '48673f4aed656942b52b92c45440470f63bfbf12a8c7d96d4a8fcf99fe004c23048ec64f51872b5178c9bc5e202c3ed35a6d12e9bda4422a6451d24c8baff358', '2023-02-01 05:54:37'),
(36, 1, '0a18f86ef0e21c6fd9af9e2138f8973f52bc97677a71c88c151bbe2da4c81dd5c2f9c634739f251a1363ec0fa3c257c644a05b89bddd1746c032089fc23ede71', '2023-02-01 05:54:48'),
(37, 1, '8e6be6fc70fe393f311591336213c366f558b8400bbad4673a2a6c9f28231b0457850ee1c6289b858e1d6e62b2075acc33614145b63f7bed08c39ae4380c147a', '2023-02-01 05:55:12'),
(38, 1, '8971a4d4fd310bb86b71dc8eee704c8827aa13ed19f34a649f907412a6cbec8fc8ff55dd64b3c0fddccfa4b3783e331bb63a695d5f7baa2dead7fea2c50646f7', '2023-02-01 06:01:25'),
(39, 4, '3325253c04aca23290756a3b6bc9a250e4312487c4283089c752683c91860f3553e062ae3ae7d42aba162ca8ca249b0d97dfcef54d070bc668f153cdd2628b16', '2023-02-01 06:11:09'),
(40, 1, '47867b917c3441b7a182cbe3762b4c26df066549d9d47902d4c8abe62c83f26047ab61ff24dcadeae359850013f33319154a85404b759b9a70b8a36ad551f5c2', '2023-02-01 06:17:29'),
(41, 1, '55af9c503159908266c0095dc1270dafd7259dfefb973190c566758281e9ac4ab587a4719669634751af6bbbf9f2ae240487268c3666dd391aad573b73012911', '2023-02-01 06:27:15'),
(42, 1, '859ea6b07662806647d2104dd560a011163b77133eafc1e2ca4933e774e3744735cd945d595f9a91d30a942f9c1d741c05d3a8fbe853acfbbccc0e3d79dc26f9', '2023-02-01 06:27:31'),
(43, 1, '6240d08be53df3487d51c8b480939b1e8c82980ea68d2a1f43340ffbf9a3aa3fee8bc63270d6e85ccf9e271c52f98679606c92616c860c34720be3bce06edf9f', '2023-02-01 06:29:38'),
(44, 1, 'e975d4acb9e3f2189f7d6558d9ea9f05a49cc4d10ee778a31ae46db34921266e5448c4f7502b97f8ca599b2584ae82f4f05528922064bee9288c9ece25bee112', '2023-02-01 06:31:13'),
(45, 4, '43f65f12329075f1fdc9aa76b1cfebb9217423bfc6ac128dd2eb01195cf1ea1842d19bfce621b916698a9d19979a87068c5bed1904cbbe5f1c12dc37ef2c3c49', '2023-02-01 06:31:34'),
(46, 1, '918e59b1eb99a791fe026da9e386ea5ab9b378af1d3c453f44b7a37979a99955021807b2ecb38fda85b17a124d7a146629922068c335d0dd9ddf16cd0b7e92c5', '2023-02-01 06:32:31'),
(47, 1, 'd75d6c1831e4ac916e3caa671f5ed13611d362255bb254e024e581092ea0ae7c928d0f76329fe496878364157307f4a871ee9df1851b8b39d6fa3d5fd5dff771', '2023-02-01 06:32:59'),
(48, 1, 'd2c4670ffcfcdcc3418023b7903b78e5759bfaaebc2125f9bd5b85a5d8df6b1e8ca75b7d939ba5b1a6b46de650f6d280f78c88390450224c071d7171a523c4d0', '2023-02-01 06:39:25'),
(49, 1, '260e386da65910187aab9534da5ec682e246cd1ceb37c9dab1909d529b26d42bf56f04dafde6412975d7eb5d0e0a0a2f603a2d9c92d8b86a1a3b9331f1a412c7', '2023-02-01 06:40:36'),
(50, 4, '56ccd3e7c9312cc438cf98f587f0aa2277881db5706cd1a3fc53afd2b3bfa15e0c740e380293e04ff8d22f1e25e8fa6f7d852f92d7de7ddebdb72dd9040aac31', '2023-02-01 06:40:52'),
(51, 1, '6e944b189de7248fc24bba1e25afb1ec76750dc52953d8036bc03048c9f8023fc962adf0cb871b499e6528c874298ae7be5bf7f2b3a41cbab6a515ce54e12621', '2023-02-01 07:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` tinyint UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'buyer');

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
  `login` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `id_status` tinyint UNSIGNED NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `email`, `id_status`) VALUES
(1, 'Owner', 'admin', '$2y$10$mee1KbZG6w7gOdn5PtuCx.GG5QmVaVMddmREI0T5INnpFCFjaaxT6', 'admin.clothes@php.net', 1),
(2, 'John Merton', 'johnm', '$2y$10$q781.Tr.sPd803WVpNdnUOhgVaS7prHl1IwZtl906AE0tQS3vmPqm', 'johnmerton@gmail.cm', 2),
(3, 'Test1', 'Test1', '$2y$10$2qpcWQsV2khdt9gmGNmfJe3U4ZaitciDcR4nGezePLbrxh46uJ51K', '235@fad.cv', 2),
(4, 'Test2', 'Test2', '$2y$10$FBXJYhbtjojcdilRoHB11eK5lbdH88P.bcjPSDL.ES8hs8bO.38RS', 'men.me@urk.net', 2);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_status` (`id_status`);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags_products`
--
ALTER TABLE `tags_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tags_products`
--
ALTER TABLE `tags_products`
  ADD CONSTRAINT `tags_products_ibfk_1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags_products_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
