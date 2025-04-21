-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 21, 2025 at 03:13 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Jackson Wang', 'jacksonwang@example.com', '$2y$10$U/jOhEJwHOlUmcxjGFyWV.pxDDnXo6Yl6u3Ha2XTuM6lSk0kfJ/Q6', 'Admin of CodeFlex', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(2, 'Apple Lee', 'applelee@example.com', '$2y$10$C4EQ47EIOjeYxlFjN8yTJ.k6ahLdG7YNmTnkwqlZ6STg0WK2WdzMC', 'Admin of CodeFlex', '2025-04-21 05:49:41', '2025-04-21 05:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `email`, `password`, `remember_token`, `bio`, `skill`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'johndoe@example.com', '$2y$10$C6TC4TR0Yc9jabxeOC7xl.Ym.wOA4jDXKBeiGuPfGyWuftipi5c1a', NULL, 'Experienced Laravel Developer', 'Laravel, PHP, MySQL', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(2, 'Jane Smith', 'janesmith@example.com', '$2y$10$cCxlX9CVrEuo/QRVV22cMeSj3RwAeif9NABXMv9uGrYCo1aoVh/fO', NULL, 'Frontend Engineer', 'Vue, React, Tailwind', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(3, 'Alice Johnson', 'alicejohnson@example.com', '$2y$10$62J0kIpyLdHUkPpkDndsR.kSQrRFwVfZaHbG9.SUvql17/21mDcVi', NULL, 'Backend Developer', 'Node.js, Express, MongoDB', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(4, 'Bob Williams', 'bobwilliams@example.com', '$2y$10$KBlnlsxpxSyryGwLTI.t/O8xbPMRZL61t0Lib/Jg7LkkTkPr01YhC', NULL, 'Full Stack Developer', 'Angular, Laravel, PostgreSQL', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(5, 'Charlie Brown', 'charliebrown@example.com', '$2y$10$8/QxFTaMuovbn50YiqOmleuE5bNQgqe0blx5utEaxDYoxmzESRnoy', NULL, 'Mobile App Developer', 'Flutter, Dart, Firebase', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(6, 'Diana Prince', 'dianaprince@example.com', '$2y$10$2dDeCshRZqv.J8byPdxdkunXwJ1TmAmGojB3LT1h8J2t7IeRqbjdK', NULL, 'UI/UX Designer', 'Figma, Sketch, Adobe XD', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(7, 'Ethan Hunt', 'ethanhunt@example.com', '$2y$10$dJN4Qy3Kq/ncgPmIXXtVl.En6q6S448ABBR3nub2t7tQIXsxyhRu.', NULL, 'DevOps Engineer', 'Docker, Kubernetes, AWS', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(8, 'Fiona Gallagher', 'fionagallagher@example.com', '$2y$10$n4QSjh8ljkveIrltIVCQt.EiqZJtXTAD8pQgC/v2r.b5R32Wuz2Nu', NULL, 'Data Scientist', 'Python, R, TensorFlow', '2025-04-21 05:49:41', '2025-04-21 05:49:41'),
(9, 'George Martin', 'georgemartin@example.com', '$2y$10$5ERaWkvkeCMEojkuHJEGY.QDnEKNyI/Uh/kZtaz25TxxvcKYeO3tm', NULL, 'Game Developer', 'Unity, C#, Unreal Engine', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(10, 'Hannah Lee', 'hannahlee@example.com', '$2y$10$dwEt3wTpwBRFYyN/FLI7XecdtHvqW2SpiGg2WKM/OfH0foPKOQf72', NULL, 'AI Engineer', 'Machine Learning, AI, Python', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(11, 'Ian Wright', 'ianwright@example.com', '$2y$10$1nSJAetkUEaaTAkVse8STukBm7vEbq3929qvs3o1QZKvj.oqw/WzO', NULL, 'Cybersecurity Specialist', 'Penetration Testing, Network Security, Cryptography', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(12, 'Julia Roberts', 'juliaroberts@example.com', '$2y$10$SWu0IrsQvffPrCb/1Y4gqu0.yeg12bjgdVC6d/nsqWnlwrKGiQfaG', NULL, 'Cloud Architect', 'Azure, AWS, Google Cloud', '2025-04-21 05:49:42', '2025-04-21 05:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `freelancer_id` bigint UNSIGNED DEFAULT NULL,
  `bid_amount` decimal(10,2) NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `project_id`, `freelancer_id`, `bid_amount`, `msg`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 5000.00, 'I am interested in this project.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(2, 4, 5, 6000.00, 'I can complete this project within a 2 month.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(3, 4, 2, 7000.00, 'I have experience in this field.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(4, 4, 4, 8000.00, 'I can deliver high-quality work.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(5, 3, 2, 9000.00, 'I am available to start immediately.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(6, 3, 3, 10000.00, 'I have a strong portfolio in this area.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(7, 4, 1, 11000.00, 'I can work within your budget.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(8, 4, 4, 12000.00, 'I have a proven track record of success.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(9, 5, 2, 13000.00, 'I am committed to delivering quality work.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(10, 5, 3, 14000.00, 'I can provide references upon request.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(11, 5, 1, 15000.00, 'I am passionate about this project.', 'pending', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(12, 9, 2, 10000.00, 'bombadilo crocodilo', 'accepted', '2025-04-21 06:15:31', '2025-04-21 06:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '0001_01_01_000003_create_admins_table', 1),
(4, '0001_01_01_000004_create_authors_table', 1),
(5, '0001_01_01_000005_create_projects_table', 1),
(6, '0001_01_01_000006_create_milestones_table', 1),
(7, '0001_01_01_000007_create_bids_table', 1),
(8, '0001_01_01_000008_create_payments_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2025_04_20_194939_add_remember_token_to_authors_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` timestamp NOT NULL,
  `status` enum('in_progress','completed','paid','received') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_progress',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `project_id`, `title`, `description`, `amount`, `due_date`, `status`, `created_at`, `updated_at`, `completed_at`, `paid_at`, `received_at`) VALUES
(1, 1, 'Design Phase', 'UI/UX design for the project.', 2000.00, '2025-05-31 16:00:00', 'in_progress', '2025-04-21 05:49:42', '2025-04-21 05:49:42', NULL, NULL, NULL),
(2, 1, 'Development Phase', 'Development of the core features.', 5000.00, '2025-08-31 16:00:00', 'in_progress', '2025-04-21 05:49:42', '2025-04-21 05:49:42', NULL, NULL, NULL),
(3, 1, 'Testing Phase', 'Testing and bug fixing.', 3000.00, '2025-11-30 16:00:00', 'in_progress', '2025-04-21 05:49:42', '2025-04-21 05:49:42', NULL, NULL, NULL),
(4, 3, 'Deployment Phase', 'Deployment to production environment.', 2000.00, '2025-12-31 16:00:00', 'in_progress', '2025-04-21 05:49:42', '2025-04-21 05:49:42', NULL, NULL, NULL),
(5, 3, 'Research Phase', 'Research and analysis of the project requirements.', 1500.00, '2025-06-30 16:00:00', 'in_progress', '2025-04-21 05:49:42', '2025-04-21 05:49:42', NULL, NULL, NULL),
(6, 3, 'Implementation Phase', 'Implementation of the project features.', 4000.00, '2025-10-31 16:00:00', 'in_progress', '2025-04-21 05:49:42', '2025-04-21 05:49:42', NULL, NULL, NULL),
(7, 9, 'asfd', 'dddddd', 6666.67, '2025-04-28 16:00:00', 'paid', '2025-04-21 06:14:56', '2025-04-21 06:17:20', NULL, '2025-04-21 06:17:20', NULL),
(8, 9, 'tralalelo tralala', 'asdfasdfasfsfsadfsaf', 3333.33, '2025-05-10 16:00:00', 'paid', '2025-04-21 06:14:56', '2025-04-21 06:18:03', NULL, '2025-04-21 06:18:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `milestone_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `milestone_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 2000.00, '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(2, 2, 5000.00, '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(3, 3, 3000.00, '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(4, 5, 2000.00, '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(5, 7, 6666.67, '2025-04-21 06:17:20', '2025-04-21 06:17:20'),
(6, 8, 3333.33, '2025-04-21 06:18:03', '2025-04-21 06:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
  `freelancer_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('open','assigned','in_progress','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `owner_id`, `freelancer_id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Web Development Project', 'Build a Laravel-based project management system.', 'assigned', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(2, 2, NULL, 'Project 2', 'Description for project 2', 'open', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(3, 3, 1, 'Project 3', 'Description for project 3', 'assigned', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(4, 1, NULL, 'Project 4', 'Description for project 4', 'open', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(5, 2, 1, 'Project 5', 'Description for project 5', 'assigned', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(6, 3, 2, 'Project 6', 'Description for project 6', 'assigned', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(7, 1, 2, 'Project 7', 'Description for project 7', 'assigned', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(8, 2, 3, 'Project 8', 'Description for project 8', 'assigned', '2025-04-21 05:49:42', '2025-04-21 05:49:42'),
(9, 1, 2, 'tung', 'sahru', 'assigned', '2025-04-21 06:14:56', '2025-04-21 06:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `authors_email_unique` (`email`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_project_id_foreign` (`project_id`),
  ADD KEY `bids_freelancer_id_foreign` (`freelancer_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `milestones_project_id_foreign` (`project_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_milestone_id_foreign` (`milestone_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_owner_id_foreign` (`owner_id`),
  ADD KEY `projects_freelancer_id_foreign` (`freelancer_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_admin_id_index` (`admin_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_freelancer_id_foreign` FOREIGN KEY (`freelancer_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `milestones`
--
ALTER TABLE `milestones`
  ADD CONSTRAINT `milestones_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_milestone_id_foreign` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_freelancer_id_foreign` FOREIGN KEY (`freelancer_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
