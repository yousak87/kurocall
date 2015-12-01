-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 at 02:42 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `curo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_11_11_062802_create_data_admin_table', 1),
('2015_11_11_065249_create_active_users_login_table', 1),
('2015_11_13_145704_create_user_admin_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('benisant1505@gmail.com', '182684328', '2015-11-13 08:35:52'),
('benisant1505@gmail.com', '903358364', '2015-11-13 09:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `sex`, `active`, `level`, `foto`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'beni santoso sss', 1, 1, 3, '', 'benisant1505@gmail.com', 'eyJpdiI6ImZsUnlLZGpkZU9WdlpJdWxHWlpFY2c9PSIsInZhbHVlIjoiOERaMGZsdzFRQThrQU5cLzFCK0JXelE9PSIsIm1hYyI6IjdjZmNjNWNiMGQwYjJhYWRjMmQ1Y2JkOGJhMjU3ZTYwYmQzMjNjNjc0ZjYxZGNkMDg5MDc5MWE0OWJiN2FjY2MifQ==', NULL, '2015-11-13 08:21:21', '0000-00-00 00:00:00'),
(4, 'beni santoso', 1, 1, 2, '', 'benisan150@gmail.com', 'eyJpdiI6ImZsUnlLZGpkZU9WdlpJdWxHWlpFY2c9PSIsInZhbHVlIjoiOERaMGZsdzFRQThrQU5cLzFCK0JXelE9PSIsIm1hYyI6IjdjZmNjNWNiMGQwYjJhYWRjMmQ1Y2JkOGJhMjU3ZTYwYmQzMjNjNjc0ZjYxZGNkMDg5MDc5MWE0OWJiN2FjY2MifQ==', NULL, '2015-11-13 08:21:21', '0000-00-00 00:00:00'),
(5, 'beni santoso', 1, 1, 1, '', 'benisan1500gmail.com', 'eyJpdiI6ImZsUnlLZGpkZU9WdlpJdWxHWlpFY2c9PSIsInZhbHVlIjoiOERaMGZsdzFRQThrQU5cLzFCK0JXelE9PSIsIm1hYyI6IjdjZmNjNWNiMGQwYjJhYWRjMmQ1Y2JkOGJhMjU3ZTYwYmQzMjNjNjc0ZjYxZGNkMDg5MDc5MWE0OWJiN2FjY2MifQ==', NULL, '2015-11-13 08:21:21', '0000-00-00 00:00:00'),
(6, 'beni santoso', 1, 1, 3, '', 'benisan150@yahoo.com', 'eyJpdiI6ImdmK0QyZFJOTzNPMllnRzh3MWREXC9RPT0iLCJ2YWx1ZSI6Ikltb1R6bHF1K3Z1R3NqTHN4ZzZDNlE9PSIsIm1hYyI6ImI0ZTRhNzY5NDhmZWJiMmJhZjU3N2VlNmFiYTEwOGUyNzZlYTBiZDBkMWZiODNiZjZmMzdjMWQ0MDJmZmI5ZTQifQ==', NULL, '2015-11-15 11:51:53', '0000-00-00 00:00:00'),
(7, 'beni santoso', 1, 1, 3, '', 'benisan15@yahoo.com', 'eyJpdiI6IjhlRmRoNTRXRW14SmdNdTdaeUJFUkE9PSIsInZhbHVlIjoiRmU5YSt3VlwvSUdjYUxENkRoZTdBZnc9PSIsIm1hYyI6IjhiMTNmNTYyNzZhZTBmZWE0NzUxZWIzYWY4MzQ5ZjljMjI1NDc4ZjI2MjJmMDBkYjUwMDk2YzU5MjM1MjkxMzgifQ==', NULL, '2015-11-15 11:52:42', '0000-00-00 00:00:00'),
(8, 'beni santoso', 1, 0, 3, '', 'natali89@yahoo.com', 'eyJpdiI6IkFvSlE2XC9oMXVrZU1JMDljQ2pGdUdRPT0iLCJ2YWx1ZSI6InV6SEk4SjR1VXA2cGFjdEdvbFZaa3c9PSIsIm1hYyI6IjQwNGIxOTliNGVlMDU2NzU4MTlhNGRmNjAzZjk2ZWVhNjU2ZDVjN2Q2MDZiM2I2MmFlNmU3NTM4Y2VlNTQ4Y2IifQ==', NULL, '2015-11-15 12:03:17', '0000-00-00 00:00:00'),
(9, 'beni santoso', 1, 0, 2, '', 'benisan3315@yahoo.com', 'eyJpdiI6ImhZUlhKMlVNd3MrNldDVTZMNDdLYVE9PSIsInZhbHVlIjoiazhFZEdVbFlia2hqTU45RUFKZk1EZz09IiwibWFjIjoiNWFkNTA0NmQ1YTE2Y2Y2ZGFiZWQ5ODY0YjE0YzZjMmI0YTU1MjMyZTI3NzQ4NzY5NjhiZTA4YTJmNDY2YzEyNCJ9', NULL, '2015-11-15 12:04:17', '0000-00-00 00:00:00'),
(10, 'beni santoso', 1, 0, 2, '', 'benisa4444n150@yahoo.com', 'eyJpdiI6InowSkVXRDFXeUF6dzJXbHNcL0RCakFRPT0iLCJ2YWx1ZSI6IjZMZElLRnJzQ0ZsUmFTMXNuYklkbmc9PSIsIm1hYyI6ImUyODY3NzAzYTdkZmE5ZGU2ZjI2ZjI3NDYwYzY5NzU5ODM4ODlmNTQzZDUxMWY5MzhhZDAwY2Y1YTQ4MjAwYjIifQ==', NULL, '2015-11-15 12:05:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_activated`
--

CREATE TABLE IF NOT EXISTS `users_activated` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_activated`
--

INSERT INTO `users_activated` (`id`, `email`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'benisan150@yahoo.com', '1420103680', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'benisan15@yahoo.com', '-268652001', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'natali89@yahoo.com', '-290758822', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
