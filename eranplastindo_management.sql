-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 06:33 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eranplastindo_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_materials`
--

CREATE TABLE `bill_of_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_bom` varchar(255) NOT NULL,
  `bom_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `information` varchar(255) NOT NULL,
  `supply_id` varchar(255) NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `type_product` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount_cost` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomings`
--

CREATE TABLE `incomings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_bpb` varchar(255) NOT NULL,
  `no_po` varchar(255) NOT NULL,
  `po_date` varchar(255) NOT NULL,
  `date_of_receipt` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `no_sj_supplier` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `information` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomings`
--

INSERT INTO `incomings` (`id`, `no_bpb`, `no_po`, `po_date`, `date_of_receipt`, `supplier`, `address`, `no_sj_supplier`, `qty`, `information`, `created_at`, `updated_at`) VALUES
(1, 'BPB-1', 'PO-2', '2023-04-04', '2023-04-11', 'Andika', 'Surakarta', 'SJ-120', '100', 'Ini merupakan barang yang guds', '2023-04-11 09:25:44', '2023-04-12 07:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_08_041531_create_incomings_table', 1),
(6, '2023_02_08_041603_create_warehouses_table', 1),
(7, '2023_02_08_041645_create_supplies_table', 1),
(8, '2023_02_08_041739_create_bill_of_materials_table', 1),
(9, '2023_02_08_041758_create_work_orders_table', 1),
(10, '2023_02_08_041811_create_products_table', 1),
(11, '2023_02_08_041953_create_officers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`id`, `name`, `nik`, `date_of_birth`, `gender`, `address`, `phone`, `position`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'Didin', '1231239129392', '2023-04-07', 'Perempuan', 'Surakarta', '081238123821', 'Manager', 4, NULL, '2023-04-09 23:38:23'),
(6, 'Dudun', '3312301230123', '2023-04-10', 'Perempuan', 'Karanganyar', '08123812383123', 'Staff', 7, '2023-04-10 08:44:31', '2023-04-10 08:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `qty`, `created_at`, `updated_at`) VALUES
(3, 'PEPU-2', 'Stang Motor', 25, '2023-04-11 08:42:58', '2023-04-12 07:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supply_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `purchase_price` bigint(20) NOT NULL,
  `selling_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `supply_code`, `name`, `type`, `category`, `merk`, `memo`, `part_number`, `status`, `purchase_price`, `selling_price`, `created_at`, `updated_at`) VALUES
(1, 'SP-12', 'Stang Mobil', 'WO', 'Mentah', 'Honda', 'Ini merupakan produk ke 5 honda', 'PN-124', 'Not Active', 100000, 200000, '2023-04-11 21:59:52', '2023-04-12 09:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Admin', '$2a$10$LFEcWx3G1SYiQq0SGqYjVeDbVJp4BokeCZxSDxv.S5lPGs2j3U9Be', 'Admin', NULL, NULL, NULL),
(4, 'Gudang', '$2y$10$wKk5D6VqiY9Uq3k2xoVDouuLdHgQIOzZ.1RMEGJXF0NkJZBrpDMGm', 'Gudang', NULL, NULL, '2023-04-10 08:50:47'),
(5, 'Staff', '$2y$10$tzIfOHX4.HX9geFYA7IBKu4nXwzRaRdVbuZN2GFGo3NzIXsw1WKyy', 'Staff', NULL, NULL, '2023-04-10 08:43:04'),
(7, 'dudun', '$2y$10$YtHzYdl0XrNvg7fvF4oGYuqvWTGCEC31.yGEIBYsv3HQpRwsrdtvS', 'Staff', NULL, '2023-04-10 08:44:31', '2023-04-10 08:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `information` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `warehouse_code`, `name`, `information`, `created_at`, `updated_at`) VALUES
(2, 'GEPU-2', 'Gudang Teknik', 'ini merupakan gudang teknik', '2023-03-14 18:28:50', '2023-04-10 09:28:50'),
(4, 'GEPU-3', 'Gudang Pengeluaran', 'sebelum product dipasarkan , product disimpan disini', '2023-04-10 09:37:11', '2023-04-10 09:37:11'),
(5, 'GEPU-1', 'Gudang Penyimpanan', 'ini merupakan tempat penyimpanan barang', '2023-04-10 09:42:08', '2023-04-10 09:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE `work_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_wo` varchar(255) NOT NULL,
  `wo_date` date NOT NULL,
  `qty` varchar(255) NOT NULL,
  `information` varchar(255) NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `plan_warehouse` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `qty_result` varchar(255) NOT NULL,
  `amount_cost` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incomings`
--
ALTER TABLE `incomings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `warehouses_warehouse_code_unique` (`warehouse_code`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomings`
--
ALTER TABLE `incomings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
