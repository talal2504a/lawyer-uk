-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2026 at 04:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawyerconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 21, 'admin', '2026-06-13 09:12:28', '2026-06-13 09:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `case_type` varchar(255) DEFAULT NULL,
  `budget` varchar(255) DEFAULT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `time_slot` time NOT NULL,
  `message` text DEFAULT NULL,
  `lawyer_response` text DEFAULT NULL,
  `customer_notes` text DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `meeting_mode` varchar(255) DEFAULT NULL,
  `meeting_location` varchar(255) DEFAULT NULL,
  `consultation_fee` decimal(10,2) DEFAULT NULL,
  `advance_required` decimal(10,2) DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `suggested_lawyer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `customer_id`, `lawyer_id`, `city`, `case_type`, `budget`, `attachment_path`, `appointment_date`, `time_slot`, `message`, `lawyer_response`, `customer_notes`, `status`, `meeting_mode`, `meeting_location`, `consultation_fee`, `advance_required`, `rejection_reason`, `suggested_lawyer_id`, `created_at`, `updated_at`) VALUES
(6, 20, 20, NULL, NULL, NULL, NULL, '2026-06-19', '14:13:00', 'Name: M TALAL\nEmail: talal2504a@aptechsite.net\nPhone: 9993\n\nCase Details:\nmmf', 'Aapka case accept hai. Please confirm the schedule.', NULL, 'confirmed', 'In-Person', NULL, 4000.00, 2000.00, NULL, NULL, '2026-06-12 19:20:05', '2026-06-14 16:13:26'),
(7, 22, 20, NULL, NULL, NULL, NULL, '2026-06-24', '02:14:00', 'Name: tts\nEmail: talalfarooq2@gmail.com\nPhone: 22323ssd\n\nCase Details:\nddd', 'Aapka case accept hai. Please confirm the schedule.', NULL, 'confirmed', 'In-Person', NULL, 4000.00, 2000.00, NULL, NULL, '2026-06-14 13:16:31', '2026-06-14 16:12:44'),
(8, 20, 20, NULL, NULL, NULL, NULL, '2026-06-15', '21:17:00', 'Name: farooq\nEmail: farooq@gmail.com\nPhone: 31313\n\nCase Details:\nhi', NULL, NULL, 'cancelled', NULL, NULL, NULL, NULL, 'Budget does not meet firm standards', NULL, '2026-06-14 16:17:46', '2026-06-14 16:18:15'),
(9, 22, 20, NULL, NULL, NULL, NULL, '2026-07-04', '11:08:00', 'n', 'Aapka case accept hai. Please confirm the schedule.', NULL, 'confirmed', 'In-Person', NULL, 4000.00, 2000.00, NULL, NULL, '2026-06-14 18:01:08', '2026-06-14 18:02:07'),
(10, 20, 20, NULL, NULL, NULL, NULL, '2026-06-15', '05:05:00', 'hiiiii', 'Aapka case accept hai. Please confirm the schedule.', NULL, 'confirmed', 'In-Person', NULL, 4000.00, 2000.00, NULL, NULL, '2026-06-14 18:03:44', '2026-06-14 18:05:02'),
(11, 23, 23, NULL, NULL, NULL, NULL, '2026-06-16', '02:37:00', 'Name: nnsn\nEmail: 22@gmail.com\nPhone: 2323dd\n\nCase Details:\nss', 'Aapka case accept hai. Please confirm the schedule.', NULL, 'confirmed', 'In-Person', NULL, 10000.00, 5000.00, NULL, NULL, '2026-06-15 16:32:03', '2026-06-15 16:32:25'),
(12, 22, 20, NULL, NULL, NULL, NULL, '2026-06-17', '22:41:00', 'hii how  are u', 'Aapka case accept hai. Please confirm the schedule.', NULL, 'confirmed', 'In-Person', NULL, 4000.00, 2000.00, NULL, NULL, '2026-06-17 00:38:59', '2026-06-17 00:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `appointment_id`, `sender_id`, `message`, `attachment_path`, `created_at`, `updated_at`) VALUES
(1, 6, 20, 'hi', NULL, '2026-06-12 19:20:28', '2026-06-12 19:20:28'),
(2, 6, 20, 'hi', NULL, '2026-06-13 08:34:56', '2026-06-13 08:34:56'),
(3, 7, 20, 'hii', NULL, '2026-06-14 13:17:28', '2026-06-14 13:17:28'),
(4, 7, 20, 'hi', NULL, '2026-06-14 16:33:55', '2026-06-14 16:33:55'),
(5, 6, 20, 'hi', NULL, '2026-06-14 16:34:04', '2026-06-14 16:34:04'),
(6, 6, 20, 'hi', NULL, '2026-06-14 16:35:44', '2026-06-14 16:35:44'),
(7, 7, 20, 'hi', NULL, '2026-06-14 16:36:14', '2026-06-14 16:36:14'),
(8, 7, 22, 'hi', NULL, '2026-06-14 16:59:34', '2026-06-14 16:59:34'),
(9, 7, 20, 'hi', NULL, '2026-06-14 17:02:10', '2026-06-14 17:02:10'),
(10, 6, 20, 'hi', NULL, '2026-06-14 17:29:57', '2026-06-14 17:29:57'),
(11, 7, 22, 'hiiilo', NULL, '2026-06-14 17:33:47', '2026-06-14 17:33:47'),
(12, 7, 22, 'hi', NULL, '2026-06-14 17:39:02', '2026-06-14 17:39:02'),
(13, 7, 20, 'hru', NULL, '2026-06-14 17:44:13', '2026-06-14 17:44:13'),
(14, 9, 22, 'hi', NULL, '2026-06-17 00:36:09', '2026-06-17 00:36:09'),
(15, 9, 20, 'hry', NULL, '2026-06-17 00:37:17', '2026-06-17 00:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `mobile`, `city`, `created_at`, `updated_at`) VALUES
(5, 22, '333oo33030', 'Karachi', '2026-06-14 13:08:10', '2026-06-14 13:08:10');

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
-- Table structure for table `lawyers`
--

CREATE TABLE `lawyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `specialization_id` bigint(20) UNSIGNED DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `experience` int(11) NOT NULL DEFAULT 0,
  `education` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT 4.90,
  `reviews_count` int(11) NOT NULL DEFAULT 140,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_contact` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `consultation_fee` decimal(10,2) NOT NULL DEFAULT 5000.00,
  `consultation_duration` int(11) NOT NULL DEFAULT 45,
  `has_discount` tinyint(1) NOT NULL DEFAULT 1,
  `is_approved` tinyint(4) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lawyers`
--

INSERT INTO `lawyers` (`id`, `user_id`, `specialization_id`, `specialization`, `title`, `experience`, `education`, `bio`, `profile_image`, `rating`, `reviews_count`, `address`, `phone`, `email_contact`, `website`, `consultation_fee`, `consultation_duration`, `has_discount`, `is_approved`, `is_verified`, `created_at`, `updated_at`) VALUES
(3, 13, NULL, 'Corporate & Commercial Law', NULL, 15, NULL, 'Specializing in Corporate Law and Dispute Resolution with 15+ years of active practice.', NULL, 4.90, 140, NULL, NULL, NULL, NULL, 6000.00, 45, 1, 1, 1, '2026-06-12 01:02:40', '2026-06-12 01:02:40'),
(7, 20, NULL, 'Corporate Law', 'High Court Advocate', 10, 'LL.M.', 'Experienced corporate lawyer', 'profile-images/wrJIELTefQTRDWXkFfkw3efj9VHQ9E3kyVE6fsdm.webp', 4.90, 140, NULL, '+923001234567', 'talalfarooq@gmail.com', NULL, 4000.00, 45, 1, 1, 1, '2026-06-12 19:05:23', '2026-06-14 17:45:28'),
(8, 23, NULL, 'General Practice', 'High Court Advocate', 8000, 'law', NULL, 'profile-images/jrms4KW4by5SlGrFYBMJRo5HE3Pfj1aqfeYDfboA.jpg', 4.90, 140, NULL, '938383883', 'lwyer@gmail.com', NULL, 10000.00, 45, 1, 1, 1, '2026-06-15 16:29:40', '2026-06-15 16:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_date` date NOT NULL,
  `time_slot` varchar(255) NOT NULL,
  `meeting_mode` enum('In-Person','Video Call','Phone Call') NOT NULL DEFAULT 'In-Person',
  `meeting_location` varchar(255) DEFAULT NULL,
  `status` enum('scheduled','in_progress','completed','cancelled') NOT NULL DEFAULT 'scheduled',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2026_06_10_155749_add_role_to_users_table', 1),
(5, '2026_06_11_000000_update_users_table', 1),
(6, '2026_06_11_000001_create_specializations_table', 1),
(7, '2026_06_11_000002_create_lawyers_table', 1),
(8, '2026_06_11_000003_create_time_slots_table', 1),
(9, '2026_06_11_000004_create_appointments_table', 1),
(10, '2026_06_12_000000_create_admins_table', 2),
(11, '2026_06_12_000001_create_customers_table', 2),
(12, '2026_06_12_000002_add_lawyer_response_to_appointments_table', 3),
(13, '2026_06_12_000003_add_consultation_fee_to_lawyers_table', 4),
(14, '2026_06_13_000000_update_lawyers_table_for_realworld', 5),
(15, '2026_06_13_000001_update_appointments_table_for_realworld', 5),
(16, '2026_06_13_000002_create_chats_table', 5),
(17, '2026_06_13_000003_create_meetings_table', 6),
(18, '2026_06_13_000004_create_payments_table', 6),
(19, '2026_06_13_000005_create_practice_areas_table', 7),
(20, '2026_06_15_100000_create_notifications_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` enum('pending','partial','paid','refunded') NOT NULL DEFAULT 'pending',
  `payment_method` enum('cash','bank_transfer','jazzcash','easypaisa','card') NOT NULL DEFAULT 'cash',
  `transaction_id` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `practice_areas`
--

CREATE TABLE `practice_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Criminal Law', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(2, 'Family Law', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(3, 'Civil Law', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(4, 'Property Law', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(5, 'Corporate Law', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(6, 'Taxation Law', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(7, 'Constitutional Law', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(8, 'Labor Law', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(9, 'Cyber Crime', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(10, 'Intellectual Property', 'active', '2026-06-10 19:46:59', '2026-06-10 19:46:59'),
(11, 'aptech', 'active', '2026-06-14 16:41:32', '2026-06-14 16:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lawyer_id` bigint(20) UNSIGNED NOT NULL,
  `slot_date` date NOT NULL,
  `slot_time` time NOT NULL,
  `is_booked` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `lawyer_id`, `slot_date`, `slot_time`, `is_booked`, `created_at`, `updated_at`) VALUES
(1, 7, '2026-06-24', '15:51:00', 0, '2026-06-14 17:51:18', '2026-06-14 17:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `user_type` enum('customer','lawyer','admin') NOT NULL DEFAULT 'customer',
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'active',
  `profile_image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `city`, `user_type`, `status`, `profile_image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'Adv. Ahmad Khan', 'ahmad.khan@lawyerconnect.com', '+92 42 3555 0199', 'Lahore', 'lawyer', 'active', NULL, NULL, '$2y$10$15nZ2dcKTOYWNx2kZxOBxOatr/LJu9G9Me0AikAcGAuT5ocDeu9Uu', NULL, '2026-06-12 01:02:40', '2026-06-12 01:02:40'),
(18, 'Adv. Sara Ahmed', 'sara.ahmed@lawyerconnect.com', '+92 51 555 0123', 'Islamabad', 'lawyer', 'active', NULL, NULL, '$2y$10$qDAc3qX6K8LxgGEwxHKc1OovSKo6GEGNBdEstU6oG9FAOsqA6YSlG', NULL, '2026-06-12 17:14:39', '2026-06-12 17:14:39'),
(20, 'Talal Farooq', 'talalfarooq@gmail.com', '+923001234567', 'Lahore', 'lawyer', 'active', NULL, NULL, '$2y$10$LVQ28fXeolOj6chy7J5K1uY8xYMkKbNRDIa1hJ6Pe73PGA6nOnhB2', NULL, '2026-06-12 19:05:23', '2026-06-12 19:05:23'),
(21, 'talal1', 'talalfarooq1@gmail.com', '39939393', 'Karachi', 'admin', 'active', NULL, NULL, '$2y$10$w.xFN0fJegtXBnXbjHr0DOd6r.G3n8Xme91VJbE/3lFuvIJog7ymq', NULL, '2026-06-13 09:12:28', '2026-06-13 09:12:28'),
(22, 'talal2', 'talalfarooq2@gmail.com', '333oo33030', 'Karachi', 'customer', 'active', NULL, NULL, '$2y$10$ebz2v.AaPDRLE/U1dxXJ6eaLoNce8opdl5zwKP4e7RUcQQcPnIVCq', NULL, '2026-06-14 13:08:10', '2026-06-14 13:08:10'),
(23, 'hamza', 'lwyer@gmail.com', '938383883', 'Karachi', 'lawyer', 'active', NULL, NULL, '$2y$10$DAVddUpDEo8GC9OV6sspFeEuN.iwH.rvUvv.3TbojMjB.kCye0Ij.', NULL, '2026-06-15 16:29:40', '2026-06-15 16:29:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_customer_id_foreign` (`customer_id`),
  ADD KEY `appointments_lawyer_id_foreign` (`lawyer_id`),
  ADD KEY `appointments_suggested_lawyer_id_foreign` (`suggested_lawyer_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_appointment_id_foreign` (`appointment_id`),
  ADD KEY `chats_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lawyers`
--
ALTER TABLE `lawyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lawyers_user_id_foreign` (`user_id`),
  ADD KEY `lawyers_specialization_id_foreign` (`specialization_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meetings_appointment_id_foreign` (`appointment_id`),
  ADD KEY `meetings_lawyer_id_foreign` (`lawyer_id`),
  ADD KEY `meetings_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_appointment_id_foreign` (`appointment_id`),
  ADD KEY `payments_meeting_id_foreign` (`meeting_id`),
  ADD KEY `payments_customer_id_foreign` (`customer_id`),
  ADD KEY `payments_lawyer_id_foreign` (`lawyer_id`);

--
-- Indexes for table `practice_areas`
--
ALTER TABLE `practice_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practice_areas_lawyer_id_foreign` (`lawyer_id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_slots_lawyer_id_foreign` (`lawyer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lawyers`
--
ALTER TABLE `lawyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `practice_areas`
--
ALTER TABLE `practice_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_suggested_lawyer_id_foreign` FOREIGN KEY (`suggested_lawyer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lawyers`
--
ALTER TABLE `lawyers`
  ADD CONSTRAINT `lawyers_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lawyers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meetings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meetings_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `practice_areas`
--
ALTER TABLE `practice_areas`
  ADD CONSTRAINT `practice_areas_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD CONSTRAINT `time_slots_lawyer_id_foreign` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
