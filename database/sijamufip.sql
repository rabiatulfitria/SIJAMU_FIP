-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jul 2024 pada 07.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sijamufip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `evaluasis`
--

CREATE TABLE `evaluasis` (
  `id_evaluasi` int(11) NOT NULL,
  `namaDokumen_evaluasi` varchar(1000) NOT NULL,
  `unggahDokumen_evaluasi` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jamutims`
--

CREATE TABLE `jamutims` (
  `id` bigint(20) NOT NULL,
  `nip` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PJ` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jamutims`
--

INSERT INTO `jamutims` (`id`, `nip`, `nama`, `email`, `PJ`, `created_at`, `updated_at`) VALUES
(1, 19880823201803001, 'Muhamad Afif Effindi', 'mafif@gmail.com', 'Ketua Jaminan Mutu', '2024-07-14 02:52:45', '2024-07-13 19:52:45'),
(2, 19880823201803002, 'Eriqa Pratiwi', 'eriqa@gmail.com', 'Sekretaris Jaminan Mutu', '2024-06-07 02:07:58', '2024-06-07 02:07:58'),
(3, 19880823201803002, 'Nilamsari Damayanti Fajrin', 'nilams@gmail.com', 'Akademik', '2024-06-08 06:41:53', '2024-06-07 23:41:53'),
(4, 19880823201803003, 'Ayyu Subhi Farahiba', 'ayyu@gmail.com', 'Akademik', '2024-06-08 04:29:47', '2024-06-07 21:29:47'),
(5, 19880823201803001, 'Mochammad Yasir', 'yasir@gmail.com', 'Akademik', '2024-06-08 06:41:02', '2024-06-07 23:41:02'),
(6, 19880823201803002, 'Ana Naimatul Jannah', 'naimatul@gmail.com', 'Akademik', '2024-06-07 21:36:42', '2024-06-07 21:36:42'),
(7, 19880823201803001, 'Fiyan Ilman Faqih', 'fyan@gmail.com', 'Akademik', '2024-06-08 06:39:28', '2024-06-07 23:39:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaksanaans`
--

CREATE TABLE `pelaksanaans` (
  `id_pelaksanaan` int(11) NOT NULL,
  `level_pelaksanaan` varchar(20) NOT NULL,
  `namaDokumen_pelaksanaan` varchar(1000) NOT NULL,
  `unggahDokumen_pelaksanaan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penetapans`
--

CREATE TABLE `penetapans` (
  `id_penetapan` int(11) NOT NULL,
  `level_penetapan` enum('perangkatspmi','standarinstitusi') NOT NULL,
  `namaDokumen_penetapan` varchar(1000) NOT NULL,
  `unggahDokumen_penetapan` varchar(2048) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengendalians`
--

CREATE TABLE `pengendalians` (
  `id_pengendalian` int(11) NOT NULL,
  `namaDokumen_pengendalian` varchar(1000) NOT NULL,
  `unggahDokumen_pengendalian` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peningkatans`
--

CREATE TABLE `peningkatans` (
  `id_peningkatan` int(11) NOT NULL,
  `namaDokumen_peningkatan` varchar(1000) NOT NULL,
  `unggahDokumen_peningkatan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_level` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `evaluasis`
--
ALTER TABLE `evaluasis`
  ADD PRIMARY KEY (`id_evaluasi`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jamutims`
--
ALTER TABLE `jamutims`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pelaksanaans`
--
ALTER TABLE `pelaksanaans`
  ADD PRIMARY KEY (`id_pelaksanaan`);

--
-- Indeks untuk tabel `penetapans`
--
ALTER TABLE `penetapans`
  ADD PRIMARY KEY (`id_penetapan`);

--
-- Indeks untuk tabel `pengendalians`
--
ALTER TABLE `pengendalians`
  ADD PRIMARY KEY (`id_pengendalian`);

--
-- Indeks untuk tabel `peningkatans`
--
ALTER TABLE `peningkatans`
  ADD PRIMARY KEY (`id_peningkatan`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `evaluasis`
--
ALTER TABLE `evaluasis`
  MODIFY `id_evaluasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jamutims`
--
ALTER TABLE `jamutims`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelaksanaans`
--
ALTER TABLE `pelaksanaans`
  MODIFY `id_pelaksanaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penetapans`
--
ALTER TABLE `penetapans`
  MODIFY `id_penetapan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengendalians`
--
ALTER TABLE `pengendalians`
  MODIFY `id_pengendalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peningkatans`
--
ALTER TABLE `peningkatans`
  MODIFY `id_peningkatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
