-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 05:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart_gomba`
--
CREATE DATABASE IF NOT EXISTS `cart_gomba` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cart_gomba`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `cart_id_id` int(11) NOT NULL,
  `mushroom_id_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200811110549', '2020-08-11 13:05:52', 305),
('DoctrineMigrations\\Version20200811122842', '2020-08-11 14:28:45', 103),
('DoctrineMigrations\\Version20200811123140', '2020-08-11 14:31:43', 41),
('DoctrineMigrations\\Version20200814095539', '2020-08-14 11:56:03', 97),
('DoctrineMigrations\\Version20200817101019', '2020-08-17 12:10:35', 1957),
('DoctrineMigrations\\Version20200817103148', '2020-08-17 12:31:52', 66),
('DoctrineMigrations\\Version20200817105120', '2020-08-17 12:51:24', 178),
('DoctrineMigrations\\Version20200817105643', '2020-08-17 12:56:48', 69),
('DoctrineMigrations\\Version20200817105746', '2020-08-17 12:57:50', 46),
('DoctrineMigrations\\Version20200817110446', '2020-08-17 13:04:49', 43),
('DoctrineMigrations\\Version20200818141801', '2020-08-18 16:18:11', 139);

-- --------------------------------------------------------

--
-- Table structure for table `mushroom`
--

DROP TABLE IF EXISTS `mushroom`;
CREATE TABLE `mushroom` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` float NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `img` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mushroom`
--

INSERT INTO `mushroom` (`id`, `name`, `unit_price`, `description`, `created_at`, `updated_at`, `img`, `stock`, `quantity`) VALUES
(1, 'Oyster Mushroom', 9.9, 'Peer out window, chatter at birds, lure them to mouth stare at wall turn and meow stare at wall some more meow again continue staring fight an alligator and win. Sniff other cat\'s butt and hang jaw half open thereafter good now the other hand', '2020-08-11 16:56:43', NULL, '/img/mushroom.jpg', 2000, 250),
(2, 'Oyster Mushroom', 17.9, 'Peer out window, chatter at birds, lure them to mouth stare at wall turn and meow stare at wall some more meow again continue staring fight an alligator and win. Sniff other cat\'s butt and hang jaw half open thereafter good now the other hand', '2020-08-12 10:19:29', NULL, '/img/mushroom.jpg', 2000, 500),
(3, 'Oyster Mushroom', 28, 'Peer out window, chatter at birds, lure them to mouth stare at wall turn and meow stare at wall some more meow again continue staring fight an alligator and win. Sniff other cat\'s butt and hang jaw half open thereafter good now the other hand', '2020-08-12 10:19:35', NULL, '/img/mushroom.jpg', 2000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `items` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `total` double NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `items`, `address`, `city`, `zip`, `total`, `name`, `user_id`, `order_time`) VALUES
(5, 'a:2:{i:0;a:5:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:15:\"Oyster Mushroom\";s:10:\"unit_price\";i:9;s:5:\"price\";i:9;s:3:\"qty\";i:1;}i:1;a:5:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:15:\"Oyster Mushroom\";s:10:\"unit_price\";i:17;s:5:\"price\";i:17;s:3:\"qty\";i:1;}}', 'Kopalgasse 74/305', 'Wien', 1110, 26, 'Balint Bakos', 1, '2020-08-17 14:13:08'),
(6, 'a:1:{i:0;a:5:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:15:\"Oyster Mushroom\";s:10:\"unit_price\";i:17;s:5:\"price\";i:34;s:3:\"qty\";i:2;}}', 'Kopalgasse 74/305', 'Wien', 1110, 34, 'Balint Bakos', 2, '2020-08-17 16:09:39'),
(7, 'a:1:{i:0;a:5:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:15:\"Oyster Mushroom\";s:10:\"unit_price\";i:17;s:5:\"price\";i:34;s:3:\"qty\";i:2;}}', 'Kopalgasse 74/305', 'Wien', 1110, 34, 'Balint Bakos', 2, '2020-08-17 16:11:26'),
(8, 'a:1:{i:0;a:5:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:15:\"Oyster Mushroom\";s:10:\"unit_price\";i:17;s:5:\"price\";i:34;s:3:\"qty\";i:2;}}', 'Kopalgasse 74/305', 'Wien', 1110, 34, 'Balint Bakos', 2, '2020-08-17 16:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `tel_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `address`, `city`, `zip`, `tel_number`, `admin`, `name`) VALUES
(1, 'balint.bb@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$YXVMbmxYelU1bUZiYzZnag$UG05tuHei+SP4HKFcc2Pfs/bvM1okVgKYGH8/RQfuLM', 'Kopalgasse 74/305', 'Wien', 1110, '6643706022', 0, 'Balint Bakos'),
(2, 'balint.bb.dev@gmail.com', '{ \"roles\": \"ROLE_ADMIN\"}', '$argon2id$v=19$m=65536,t=4,p=1$UGxaM1FxQzRtV2l4WVpXag$tNK5TOxwiJKOyn+KDPjgj8sdJNiKjxiw0gK5Z9FFks0', 'Kopalgasse 74/305', 'Wien', 1110, '6643706022', 1, 'Balint Bakos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F0FE252720AEF35F` (`cart_id_id`),
  ADD KEY `IDX_F0FE252722F63AD1` (`mushroom_id_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mushroom`
--
ALTER TABLE `mushroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mushroom`
--
ALTER TABLE `mushroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `FK_F0FE252720AEF35F` FOREIGN KEY (`cart_id_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_F0FE252722F63AD1` FOREIGN KEY (`mushroom_id_id`) REFERENCES `mushroom` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
