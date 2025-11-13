-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Waktu pembuatan: 13 Nov 2025 pada 05.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpipi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'admin@smkn4bogor.sch.id', '$2y$12$IQsdJDrlpSDbENDEe0EehuKyNXyQkg1LEPFvilyKmkgFRVaP2TDuy', NULL, '2025-11-09 22:47:33', '2025-11-09 22:47:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `galery_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `galery_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `body` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'visible',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `downloads`
--

CREATE TABLE `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `galery_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `galery_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`id`, `galery_id`, `file`, `created_at`, `updated_at`) VALUES
(45, 29, 'fotos/1762920074_1 (1).JPG', '2025-11-11 21:01:14', '2025-11-11 21:01:14'),
(46, 29, 'fotos/1762920074_2 (1).JPG', '2025-11-11 21:01:14', '2025-11-11 21:01:14'),
(47, 29, 'fotos/1762920074_3.JPG', '2025-11-11 21:01:14', '2025-11-11 21:01:14'),
(48, 29, 'fotos/1762920074_4 (1).JPG', '2025-11-11 21:01:14', '2025-11-11 21:01:14'),
(49, 29, 'fotos/1762920074_5 (1).JPG', '2025-11-11 21:01:14', '2025-11-11 21:01:14'),
(50, 29, 'fotos/1762920074_DSC05601.JPG', '2025-11-11 21:01:14', '2025-11-11 21:01:14'),
(51, 29, 'fotos/1762920074_flashmob (1).JPG', '2025-11-11 21:01:14', '2025-11-11 21:01:14'),
(52, 30, 'fotos/1762994884_1 (2).JPG', '2025-11-12 17:48:04', '2025-11-12 17:48:04'),
(53, 30, 'fotos/1762994885_2 (2).JPG', '2025-11-12 17:48:05', '2025-11-12 17:48:05'),
(54, 30, 'fotos/1762994886_2 (5).JPG', '2025-11-12 17:48:07', '2025-11-12 17:48:07'),
(55, 30, 'fotos/1762994888_4 (2).JPG', '2025-11-12 17:48:08', '2025-11-12 17:48:08'),
(56, 30, 'fotos/1762994892_5 (2).JPG', '2025-11-12 17:48:12', '2025-11-12 17:48:12'),
(57, 30, 'fotos/1762994893_5 (3).JPG', '2025-11-12 17:48:13', '2025-11-12 17:48:13'),
(58, 30, 'fotos/1762994893_flashmob (2).JPG', '2025-11-12 17:48:13', '2025-11-12 17:48:13'),
(59, 31, 'fotos/1763003969_2 (1).JPG', '2025-11-12 20:19:29', '2025-11-12 20:19:29'),
(60, 31, 'fotos/1763003970_2 (2).JPG', '2025-11-12 20:19:30', '2025-11-12 20:19:30'),
(61, 31, 'fotos/1763003971_2 (3).JPG', '2025-11-12 20:19:31', '2025-11-12 20:19:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery`
--

CREATE TABLE `galery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `total_likes` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total_comments` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total_bookmarks` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total_downloads` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galery`
--

INSERT INTO `galery` (`id`, `post_id`, `judul`, `position`, `status`, `total_likes`, `total_comments`, `total_bookmarks`, `total_downloads`, `created_at`, `updated_at`) VALUES
(29, 24, NULL, 1, 1, 0, 0, 0, 0, '2025-11-11 21:01:14', '2025-11-11 21:01:14'),
(30, 24, NULL, 2, 1, 0, 0, 0, 0, '2025-11-12 17:48:02', '2025-11-12 17:48:02'),
(31, 22, 'Minangkabau | Padang', 3, 1, 0, 0, 0, 0, '2025-11-12 20:19:28', '2025-11-12 20:19:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `judul`, `created_at`, `updated_at`) VALUES
(16, 'galeri sekolah', '2025-10-12 20:48:09', '2025-10-28 23:03:52'),
(17, 'informasi terkini', '2025-10-28 23:03:34', '2025-10-28 23:03:34'),
(19, 'Agenda', '2025-10-29 00:23:31', '2025-10-29 00:23:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_post`
--

CREATE TABLE `kategori_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_post_pivot`
--

CREATE TABLE `kategori_post_pivot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `galery_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_26_011324_create_kategori_table', 1),
(5, '2025_08_26_011342_create_petugas_table', 1),
(6, '2025_08_26_011349_create_posts_table', 1),
(7, '2025_08_26_011407_create_profile_table', 1),
(8, '2025_08_26_011419_create_galery_table', 1),
(9, '2025_08_26_011432_create_foto_table', 1),
(10, '2025_08_29_053526_add_remember_token_to_petugas_table', 2),
(11, '2025_10_07_012456_create_testimonials_table', 3),
(12, '2025_10_10_012700_add_user_fields_for_otp_and_profile', 4),
(13, '2025_10_20_090000_create_likes_table', 5),
(14, '2025_10_20_090100_create_bookmarks_table', 5),
(15, '2025_10_20_090200_create_comments_table', 5),
(16, '2025_10_20_090300_create_downloads_table', 5),
(17, '2025_10_23_000001_add_counters_to_galery_table', 6),
(21, '2025_11_10_041700_add_role_to_petugas_table', 7),
(23, '2025_11_10_054059_create_admins_table', 8),
(24, '2025_11_12_020300_remove_judul_from_foto_table', 9),
(25, '2025_11_13_014218_add_judul_to_galery_table', 10),
(26, '2025_11_13_014221_create_kategori_post_pivot_table', 10),
(27, '2025_11_13_015500_create_kategori_post_table', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL DEFAULT 'petugas',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', '$2y$12$2cCSI6hSnmMs/fThsdO6NOLX00LVUiC/ptzMU3i4XFO/qJdx/M70q', 'petugas', '2025-08-28 22:24:06', '2025-08-28 22:24:06', NULL),
(2, 'vyda', 'vyda123', 'petugas', '2025-08-28 22:32:59', '2025-08-28 22:32:59', NULL),
(3, 'admin', '$2y$12$6sxYGulYwUCzPBUjA0Q2bunRwd4VqdJgh0mwpMGmXqKCf.BvYTRry', 'petugas', '2025-08-28 22:36:06', '2025-08-28 22:36:06', NULL),
(4, 'Vidania', 'Vidania123', 'petugas', '2025-11-09 22:02:28', '2025-11-09 22:02:28', NULL),
(5, 'rama petugas', '$2y$12$m5FFMJJK8GHEyQAGn4g9WOYQCwtYsXuHRSCh9gkUwS2yIYzI9FQ7e', 'petugas', '2025-11-10 03:48:02', '2025-11-10 03:48:02', NULL),
(6, 'sipa petugas', '$2y$12$5lgtxdWOLS3bPhC8pCrpkOTxB.LhiGdHfXij6yF30IoKo6v3B7Ia.', 'petugas', '2025-11-10 17:29:26', '2025-11-10 17:29:26', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `isi` text NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `judul`, `kategori_id`, `isi`, `petugas_id`, `status`, `created_at`, `updated_at`) VALUES
(22, 'transforkrab', 16, 'transforkrab 2024', 1, 'published', '2025-11-11 20:43:22', '2025-11-11 20:43:22'),
(23, 'neospragma', 16, 'neospragma 2024', 1, 'published', '2025-11-11 20:43:50', '2025-11-11 20:43:50'),
(24, 'transforkrab', 17, 'waw waw waw transforkrab 2024 sangat amat seru', 1, 'published', '2025-11-11 20:59:16', '2025-11-11 20:59:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id`, `judul`, `isi`, `created_at`, `updated_at`) VALUES
(1, 'Profil Sekolah Kita', 'Sekolah Kita adalah lembaga pendidikan yang berkomitmen untuk mengembangkan potensi siswa secara optimal.', '2025-08-28 22:24:06', '2025-08-28 22:24:06'),
(2, 'Profil Sekolah Kita', 'Sekolah Kita adalah lembaga pendidikan yang berkomitmen untuk mengembangkan potensi siswa secara optimal.', '2025-08-28 22:36:06', '2025-08-28 22:36:06'),
(3, 'Halo temen temen semua', 'profile halo contoh', '2025-09-07 20:52:44', '2025-09-07 20:52:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FWywuuc1179yopdhGO77FH02cYSgdvizVttkLj4T', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGtvUGkzbTFVWndnZnVvNmRTV1JRUjZ6RG00dUhUZ3ZiWTRTZ0VRRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nYWxlcmkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUxOiJsb2dpbl91c2VyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1760756562),
('KZcd9MJZbc5bf1NHPCBTdx3IzFSln0OmwLsJZcuq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclR3bm9JMzUwYnBacW1qVUFJOVZTZE1PZFhkSE9XVnpXWXpvb2JCaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZXN0aW1vbmlhbHMvYXBwcm92ZWQiO319', 1760879850),
('sCLJhJm1y7wtknl20ggAJnfEGfrUorpJke9zCyse', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGJTS1dkZ0F5ck9ISG5XRjAyZk9Wemwyb3NsdEdTbU8zcEJ1bWtvUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nYWxlcmkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1760928598);

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `nama`, `email`, `pesan`, `status`, `created_at`, `updated_at`) VALUES
(9, 'risti', 'riris123@gmail.com', 'keren, mantap, sukses selalu', 'approved', '2025-10-06 22:23:54', '2025-10-06 22:24:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `email_verified_at`, `is_verified`, `otp_code`, `otp_expires_at`, `password`, `profile_photo_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rahmat Noer Islam', 'mamat ganteng', 'cursor.0101.0101@gmail.com', NULL, '2025-10-11 22:22:05', 1, NULL, NULL, '$2y$12$q25dG8cAm7YsZULz9IzY1.jJFKSFrtDFKpE3Jn91RPohLRxBxW8cW', NULL, NULL, '2025-10-11 22:20:10', '2025-10-11 22:22:05'),
(2, 'noviyati', 'novi cantik', 'novikerja80@gmail.com', NULL, '2025-10-17 19:18:04', 1, NULL, NULL, '$2y$12$aVaNRNXrQbC05OZX4OghbuXzMH1BR33hVTp5yvMro7JfAPsfAZM8e', NULL, NULL, '2025-10-17 19:17:29', '2025-10-17 19:18:04'),
(3, 'daniramdani', 'dani ganteng', 'daniram0707@gmail.com', NULL, '2025-10-19 06:15:36', 1, NULL, NULL, '$2y$12$Z0WmdLONm9QKqf6fwNnc0Ohq.8J2TtQOmSE2o4ZfASVNmP7PqVNwO', NULL, NULL, '2025-10-19 06:14:59', '2025-10-19 06:15:36'),
(4, 'winaaa nurul', 'wina aja', 'gisnawina8@gmail.com', NULL, '2025-10-22 17:09:58', 1, NULL, NULL, '$2y$12$.wdXrynH8W3AnRST3nBaCeuU3AkKBG8XKLAbcF9AJvOOq5/Vna192', NULL, NULL, '2025-10-22 17:09:08', '2025-10-22 17:09:58'),
(5, 'Ridwan Nurullah Fauzi', 'iweng', 'ridwanfauze26@gmail.com', NULL, NULL, 0, '348802', '2025-10-23 20:37:07', '$2y$12$v6TNVZ8QR8VXwxd1UxnNQetL9x.0PSEkIripWWJcUi73SP32lrO0S', NULL, NULL, '2025-10-23 20:27:07', '2025-10-23 20:27:07'),
(6, 'Ridwan Nurullah Fauzi', 'iweng ganteng', 'iwangg6098@gmail.com', NULL, '2025-10-23 20:30:21', 1, NULL, NULL, '$2y$12$OGHeRhdQ2/ycX9QM0QlfT.T1AiVw7IZY3jsXhsRJQVnlOQl2lfn1.', NULL, NULL, '2025-10-23 20:29:12', '2025-10-23 20:30:21'),
(7, 'rama gaanteng banget dong', 'abang', 'ramdhanimulya86@gmail.com', NULL, '2025-10-24 22:24:16', 1, NULL, NULL, '$2y$12$hjHcLJrohknWcrRLz9jWzehcFUFFdiKfvPwwBwKmP7HAULgnf2y8e', NULL, 'rsST04w3haGn1sloEDpVi6v1GkWFfQcYI5d7lDpM9tm6hFHAyFNECSkOOR2W', '2025-10-24 22:23:36', '2025-11-10 03:44:59'),
(8, 'vidania alifa', 'vida', 'vidaniaayasha04@gmail.com', NULL, NULL, 0, '031232', '2025-11-11 18:04:32', '$2y$12$kyCf6aASfuvewiRbJoBylePIrVXTsQYaV39VuU9yHygQBHkxC99se', NULL, NULL, '2025-11-11 17:54:32', '2025-11-11 17:54:32'),
(9, 'vidania alifa', 'vidacantik', 'vydaartlab@gmail.com', NULL, '2025-11-11 18:03:53', 1, NULL, NULL, '$2y$12$O86C9YgZHixJrYy4PnYA4.Obv0n3J.JhQkOvWnndKMShwsoNXes3O', NULL, NULL, '2025-11-11 18:03:00', '2025-11-11 18:07:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookmarks_user_id_galery_id_unique` (`user_id`,`galery_id`),
  ADD KEY `bookmarks_galery_id_index` (`galery_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_galery_id_index` (`galery_id`),
  ADD KEY `comments_parent_id_index` (`parent_id`),
  ADD KEY `comments_created_at_index` (`created_at`);

--
-- Indeks untuk tabel `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `downloads_galery_id_index` (`galery_id`),
  ADD KEY `downloads_user_id_index` (`user_id`),
  ADD KEY `downloads_created_at_index` (`created_at`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_galery_id_foreign` (`galery_id`);

--
-- Indeks untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galery_post_id_foreign` (`post_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_post`
--
ALTER TABLE `kategori_post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_post_post_id_kategori_id_unique` (`post_id`,`kategori_id`),
  ADD KEY `kategori_post_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `kategori_post_pivot`
--
ALTER TABLE `kategori_post_pivot`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `likes_user_id_galery_id_unique` (`user_id`,`galery_id`),
  ADD KEY `likes_galery_id_index` (`galery_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_kategori_id_foreign` (`kategori_id`),
  ADD KEY `posts_petugas_id_foreign` (`petugas_id`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `galery`
--
ALTER TABLE `galery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kategori_post`
--
ALTER TABLE `kategori_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_post_pivot`
--
ALTER TABLE `kategori_post_pivot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_galery_id_foreign` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_galery_id_foreign` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_galery_id_foreign` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `downloads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_galery_id_foreign` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kategori_post`
--
ALTER TABLE `kategori_post`
  ADD CONSTRAINT `kategori_post_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kategori_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_galery_id_foreign` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
