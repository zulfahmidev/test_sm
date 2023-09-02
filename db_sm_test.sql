-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Sep 2023 pada 14.23
-- Versi server: 8.0.34-0ubuntu0.22.04.1
-- Versi PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sm_test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approvals`
--

CREATE TABLE `approvals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `status` enum('panding','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'panding',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `booking_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `approvals`
--

INSERT INTO `approvals` (`id`, `user_id`, `confirmed_at`, `status`, `created_at`, `updated_at`, `booking_id`) VALUES
(15, 3, NULL, 'rejected', '2023-09-02 00:10:37', '2023-09-02 00:21:59', 4),
(16, 6, NULL, 'rejected', '2023-09-02 00:10:37', '2023-09-02 00:23:19', 4),
(17, 2, NULL, 'panding', '2023-09-02 00:11:41', '2023-09-02 00:11:41', 5),
(18, 6, NULL, 'approved', '2023-09-02 00:11:41', '2023-09-02 00:23:29', 5),
(19, 2, NULL, 'approved', '2023-09-02 00:13:03', '2023-09-02 00:22:46', 6),
(20, 3, NULL, 'approved', '2023-09-02 00:13:03', '2023-09-02 00:17:25', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `usage_at` timestamp NOT NULL,
  `estimated_duration` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `customer_name`, `vehicle_id`, `driver_id`, `usage_at`, `estimated_duration`, `note`, `created_at`, `updated_at`) VALUES
(4, 'Zulfahmi', 16, 17, '2023-09-02 07:10:00', 3, 'tidak ada', '2023-09-02 00:10:37', '2023-09-02 00:10:37'),
(5, 'Joko Anwar', 15, 15, '2023-09-02 07:11:00', 1, 'tidak ada', '2023-09-02 00:11:41', '2023-09-02 00:11:41'),
(6, 'Tatang Sutarma', 17, 16, '2023-09-22 07:12:00', 5, 'tidak ada', '2023-09-02 00:13:03', '2023-09-02 00:13:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability_status` enum('yes','not') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `drivers`
--

INSERT INTO `drivers` (`id`, `fullname`, `phone`, `availability_status`, `created_at`, `updated_at`) VALUES
(3, 'zulfahmi', '+6285678901234', 'not', '2023-09-01 10:28:12', '2023-09-01 23:57:24'),
(14, 'Budi Santoso', '+6281234567890', 'yes', '2023-09-01 23:56:27', '2023-09-01 23:56:27'),
(15, 'Ahmad Rizki', '+6282345678901', 'yes', '2023-09-01 23:56:39', '2023-09-01 23:56:39'),
(16, 'Dika Pratama', '+6283456789012', 'yes', '2023-09-01 23:56:56', '2023-09-01 23:56:56'),
(17, 'Joko Susanto', '+6284567890123', 'yes', '2023-09-01 23:57:16', '2023-09-01 23:57:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `maintenances`
--

CREATE TABLE `maintenances` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `maintenance_at` timestamp NOT NULL,
  `cost` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_09_01_092735_create_vehicles_table', 1),
(4, '2023_09_01_092749_create_drivers_table', 1),
(5, '2023_09_01_092759_create_bookings_table', 1),
(6, '2023_09_01_092807_create_approvals_table', 1),
(7, '2023_09_01_095847_create_vehicle_returns_table', 1),
(8, '2023_09_01_102509_create_service_schedules_table', 1),
(9, '2023_09_01_103721_create_maintenances_table', 1),
(10, '2023_09_02_015817_update1_approvals_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_schedules`
--

CREATE TABLE `service_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `last_service_at` timestamp NOT NULL,
  `next_service_at` timestamp NOT NULL,
  `cost` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','approver') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `position`, `role`, `created_at`, `updated_at`) VALUES
(2, 'pimpinan2', '$2y$10$Sip/UsTWUHA.QfLpBO468u/.hcAbcXAPnz.9GCu1W5JOC1lzxONsy', 'pimpinan 2', 'pimpinan', 'approver', '2023-09-02 03:02:20', '2023-09-02 00:07:04'),
(3, 'pimpinan1', '$2y$10$ZWleQkfQwfp2cc87fll8lObgIqnRdfsRLkw5.LefVrG9qpmloQZXG', 'pimpinan 1', 'pimpinan', 'approver', '2023-09-02 03:02:45', '2023-09-02 00:06:49'),
(4, 'admin', '$2y$10$HaNHr.wuGIdsqbNOkJvjC.rveSkMPU0mQAxGr09R4CSYogS2Z974a', 'Super Admin', '-', 'admin', '2023-09-02 03:46:59', '2023-09-02 03:46:59'),
(5, 'pimpinan4', '$2y$10$ExwnxKRCpO0sJ/uKidWyteE8FhdKA3BOrM709RbeyBL5UXA2c.vaW', 'pimpinan 4', 'pimpinan', 'approver', '2023-09-01 22:03:42', '2023-09-02 00:01:54'),
(6, 'pimpinan3', '$2y$10$wS6FxrvaMQHhqiH7XA6/JO1Lku49LdpNsXixzaRe9HSbrXzWh30GS', 'pimpinan 3', 'pimpinan', 'approver', '2023-09-01 22:04:34', '2023-09-01 23:59:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `plat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `transport_type` enum('goods','passengers') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownership_status` enum('owned','leased') COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` enum('damaged','good','repair') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vehicles`
--

INSERT INTO `vehicles` (`id`, `plat`, `capacity`, `transport_type`, `ownership_status`, `condition`, `created_at`, `updated_at`) VALUES
(13, 'AB 123 CD', 30, 'passengers', 'owned', 'good', '2023-09-01 23:53:34', '2023-09-01 23:53:34'),
(14, 'XY 789 ZW', 30, 'passengers', 'owned', 'good', '2023-09-01 23:53:46', '2023-09-01 23:53:46'),
(15, 'JK 456 LM', 20, 'passengers', 'owned', 'good', '2023-09-01 23:54:05', '2023-09-01 23:54:05'),
(16, 'QR 789 UV', 3000, 'goods', 'leased', 'good', '2023-09-01 23:54:40', '2023-09-01 23:54:40'),
(17, 'CD 012 EF', 5000, 'goods', 'owned', 'good', '2023-09-01 23:55:01', '2023-09-01 23:55:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicle_returns`
--

CREATE TABLE `vehicle_returns` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `return_at` timestamp NOT NULL,
  `fuel_consumed` int NOT NULL,
  `distance_traveled` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvals_user_id_foreign` (`user_id`),
  ADD KEY `approvals_booking_id_foreign` (`booking_id`);

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `bookings_driver_id_foreign` (`driver_id`);

--
-- Indeks untuk tabel `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenances_vehicle_id_foreign` (`vehicle_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `service_schedules`
--
ALTER TABLE `service_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_schedules_vehicle_id_foreign` (`vehicle_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vehicle_returns`
--
ALTER TABLE `vehicle_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_returns_booking_id_foreign` (`booking_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `service_schedules`
--
ALTER TABLE `service_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `vehicle_returns`
--
ALTER TABLE `vehicle_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `approvals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `maintenances`
--
ALTER TABLE `maintenances`
  ADD CONSTRAINT `maintenances_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `service_schedules`
--
ALTER TABLE `service_schedules`
  ADD CONSTRAINT `service_schedules_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `vehicle_returns`
--
ALTER TABLE `vehicle_returns`
  ADD CONSTRAINT `vehicle_returns_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
