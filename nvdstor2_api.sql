-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2025 at 06:30 PM
-- Server version: 8.0.42-cll-lve
-- PHP Version: 8.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nvdstor2_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_key`
--

CREATE TABLE `api_key` (
  `id_api` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `whitelist_ip` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `api_key`
--

INSERT INTO `api_key` (`id_api`, `id_user`, `api_key`, `whitelist_ip`) VALUES
(1, 1, 'ai405GB6onFRH9QelXUgVjkus8LNPWm3rKSTOzdEMJbwvxDI12qCc7ftYyZh', ''),
(32, 36, 'j1mWlXfrNtxb5OK3QokvLB6zAs2TaEPu8UVeGgpC7inwhcRFZ4HS90dYqJyM', '103.140.90.100:103.140.90.98'),
(34, 38, 'jbXgOPS1dh0nTysBZo6taA5Wr8NzkK2LceDCE3GxVfIQvwUFq4m7RHpMulYi', ''),
(35, 39, 'brCIERFksN3P0whDycLO1UH4XVM9vT7gfJYqajdpZ6xmuSGKeW2otzQi5lnB', ''),
(36, 40, '63gNDX4e2x7ZHatFonfORkYmjGQsiPyv0qSCTrhlLWuzB8U1VbJKd9MIAEpc', NULL),
(37, 41, 'oX7K3iyMOutx45m0zrFnUVAJgGNd2h6fRqpEBwlTsv1Z9aQcDPbYWCkHejL8', '');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `slug` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `endpoint` text NOT NULL,
  `user_id_required` tinyint(1) DEFAULT '1',
  `zone_required` tinyint(1) DEFAULT '0',
  `zone_options` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting_web`
--

CREATE TABLE `setting_web` (
  `id_setting` bigint UNSIGNED NOT NULL,
  `title_web` text NOT NULL,
  `copyright_web` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `setting_web`
--

INSERT INTO `setting_web` (`id_setting`, `title_web`, `copyright_web`) VALUES
(1, 'NVD STORE INDONESIA System', 'Copyright &copy 2019 NVD System');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `role`, `status`) VALUES
(1, 'Admin Web', 'admin@admin.com', 'admin', '$2y$10$W0mkLZPFxQDie6wB9sAn6eZtHHVD0eGYnBgLotzxAS4J6Sf4OUmLi', 'admin', 1),
(36, 'godsettings', 'godsettings@gmail.com', 'godsettings', '$2y$10$C1Ip292SIpEQ.fgLtcLYDOKGDYemGZmkuwPPEoe04csE88zjdgaQq', 'user', 1),
(38, 'baqul', 'baqul@baqul.com', 'baqul', '$2y$10$vsVXcaMuofmCYkwZlu5.WenozrOMLEig08p4NbfwmYJ30YobETK6e', 'user', 1),
(39, 'zeostore', 'zeostore@zeostore.com', 'zeostore', '$2y$10$3R1UsgGBVNK/V85GHHsXOeHy/37v1rvA6hpf6ic/.op3x8kIuy6L6', 'user', 1),
(40, 'demo', 'demo@demo.com', 'demo', '$2y$10$TI1UIbgom4UKNFJ1JRpX2e4RjWgoeQRUAOJ1NF8YFf00EVKDLab22', 'user', 1),
(41, 'nvdstore', 'nvdstore@nvdstore.com', 'nvdstore', '$2y$10$mqloAyFRkzHRf1Sprb/iUutmq9P6mOShxWWoPoSA3/01IVnTi4DTG', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_key`
--
ALTER TABLE `api_key`
  ADD PRIMARY KEY (`id_api`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `setting_web`
--
ALTER TABLE `setting_web`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_key`
--
ALTER TABLE `api_key`
  MODIFY `id_api` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting_web`
--
ALTER TABLE `setting_web`
  MODIFY `id_setting` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_key`
--
ALTER TABLE `api_key`
  ADD CONSTRAINT `api_key_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
