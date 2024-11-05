-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 06:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fja`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `client_id`, `action`, `timestamp`) VALUES
(9, 9, 'login', '2024-05-13 13:04:10'),
(10, 9, 'logout', '2024-05-13 13:04:28'),
(11, 9, 'login', '2024-05-13 13:18:11'),
(12, 9, 'login', '2024-05-19 01:34:12'),
(13, 9, 'logout', '2024-05-19 02:02:31'),
(14, 50, 'login', '2024-05-19 02:04:28'),
(15, 9, 'login', '2024-05-19 02:14:18'),
(16, 9, 'booking', '2024-05-19 02:14:29'),
(17, 9, 'logout', '2024-05-19 02:16:01'),
(18, 50, 'login', '2024-05-19 02:16:05'),
(19, 50, 'login', '2024-05-19 06:48:31'),
(20, 9, 'login', '2024-05-19 06:58:39'),
(21, 9, 'logout', '2024-05-19 07:03:14'),
(22, 9, 'login', '2024-05-19 07:03:20'),
(23, 9, 'logout', '2024-05-19 07:04:13'),
(24, 9, 'login', '2024-05-19 07:04:40'),
(25, 9, 'logout', '2024-05-19 07:40:57'),
(26, 9, 'login', '2024-05-19 08:06:52'),
(27, 9, 'logout', '2024-05-19 08:09:01'),
(28, 9, 'login', '2024-05-19 13:01:20'),
(29, 50, 'login', '2024-05-19 13:09:34'),
(30, 50, 'login', '2024-05-19 13:11:16'),
(31, 9, 'login', '2024-05-20 10:09:05'),
(32, 9, 'booking', '2024-05-20 10:19:22'),
(33, 9, 'booking', '2024-05-20 10:20:50'),
(34, 9, 'booking', '2024-05-20 10:21:35'),
(35, 9, 'login', '2024-05-20 10:36:26'),
(36, 9, 'booking', '2024-05-20 10:37:38'),
(37, 9, 'booking', '2024-05-20 10:45:46'),
(38, 9, 'booking', '2024-05-20 10:48:26'),
(39, 9, 'logout', '2024-05-20 10:54:12'),
(40, 9, 'login', '2024-05-20 11:04:16'),
(41, 9, 'login', '2024-05-20 11:07:39'),
(42, 9, 'login', '2024-05-20 12:32:29'),
(43, 9, 'booking', '2024-05-20 12:33:16'),
(44, 50, 'login', '2024-05-20 15:20:22'),
(45, 9, 'login', '2024-05-20 16:09:50'),
(46, 9, 'booking', '2024-05-20 16:10:56'),
(47, 9, 'booking', '2024-05-20 16:14:08'),
(48, 9, 'booking', '2024-05-20 16:17:53'),
(49, 9, 'booking', '2024-05-20 16:19:50'),
(50, 9, 'login', '2024-05-21 00:00:13'),
(51, 9, 'booking', '2024-05-21 00:05:13'),
(52, 9, 'logout', '2024-05-21 00:08:31'),
(53, 9, 'login', '2024-05-21 00:23:49'),
(54, 9, 'booking', '2024-05-21 00:24:11'),
(55, 9, 'booking', '2024-05-21 00:32:17'),
(56, 9, 'booking', '2024-05-21 00:33:30'),
(57, 9, 'booking', '2024-05-21 00:33:46'),
(58, 9, 'booking', '2024-05-21 00:42:53'),
(59, 9, 'booking', '2024-05-21 00:44:54'),
(60, 9, 'booking', '2024-05-21 00:48:41'),
(61, 9, 'booking', '2024-05-21 01:05:12'),
(62, 9, 'booking', '2024-05-21 01:07:23'),
(63, 9, 'booking', '2024-05-21 01:23:26'),
(64, 9, 'login', '2024-05-21 01:25:34'),
(65, 9, 'booking', '2024-05-21 01:28:55'),
(66, 9, 'booking', '2024-05-21 01:29:47'),
(67, 9, 'booking', '2024-05-21 01:34:09'),
(68, 9, 'paid', '2024-05-21 01:34:09'),
(69, 9, 'logout', '2024-05-21 01:34:32'),
(70, 9, 'login', '2024-05-21 01:50:14'),
(71, 9, 'booking', '2024-05-21 01:51:01'),
(72, 9, 'paid', '2024-05-21 01:51:01'),
(73, 9, 'paid', '2024-05-21 01:52:26'),
(74, 9, 'paid', '2024-05-21 01:54:27'),
(75, 9, 'paid', '2024-05-21 01:54:31'),
(76, 9, 'paid', '2024-05-21 01:54:56'),
(77, 9, 'paid', '2024-05-21 01:54:56'),
(78, 9, 'paid', '2024-05-21 01:55:03'),
(79, 9, 'paid', '2024-05-21 01:55:04'),
(80, 9, 'paid', '2024-05-21 01:55:19'),
(81, 9, 'paid', '2024-05-21 01:55:24'),
(82, 9, 'paid', '2024-05-21 01:59:04'),
(83, 9, 'logout', '2024-05-21 02:53:43'),
(84, 51, 'login', '2024-05-21 02:54:20'),
(85, 51, 'logout', '2024-05-21 02:56:16'),
(86, 50, 'login', '2024-05-21 02:56:21'),
(87, 9, 'login', '2024-05-21 03:08:02'),
(88, 9, 'login', '2024-05-21 03:08:33'),
(89, 9, 'login', '2024-05-21 03:11:07'),
(90, 9, 'logout', '2024-05-21 03:11:11'),
(91, 50, 'login', '2024-05-21 03:11:15'),
(92, 50, 'logout', '2024-05-21 03:11:30'),
(93, 9, 'login', '2024-05-21 03:11:42'),
(94, 9, 'updateName', '2024-05-21 03:29:58'),
(95, 9, 'updateName', '2024-05-21 03:30:00'),
(96, 9, 'updateProfile', '2024-05-21 03:30:24'),
(97, 9, 'updateName', '2024-05-21 03:30:24'),
(98, 9, 'updateName', '2024-05-21 03:33:24'),
(99, 9, 'updateName', '2024-05-21 03:33:35'),
(100, 9, 'updateName', '2024-05-21 03:37:03'),
(101, 9, 'updateProfile', '2024-05-21 03:37:19'),
(102, 9, 'updateProfile', '2024-05-21 03:37:31'),
(103, 9, 'updateName', '2024-05-21 03:37:31'),
(104, 9, 'updateNameAndProfile', '2024-05-21 03:38:54'),
(105, 9, 'update name', '2024-05-21 03:39:38'),
(106, 9, 'logout', '2024-05-21 03:46:02'),
(107, 9, 'login', '2024-05-21 03:46:49'),
(108, 9, 'booking', '2024-05-21 03:47:05'),
(109, 9, 'paid', '2024-05-21 03:47:05'),
(110, 9, 'login', '2024-05-21 03:47:40'),
(111, 9, 'booking', '2024-05-21 03:47:50'),
(112, 9, 'paid', '2024-05-21 03:47:51'),
(113, 9, 'paid', '2024-05-21 03:49:49'),
(114, 9, 'paid', '2024-05-21 03:50:08'),
(115, 9, 'paid', '2024-05-21 03:53:35'),
(116, 9, 'paid', '2024-05-21 03:53:36'),
(117, 9, 'paid', '2024-05-21 03:54:36'),
(118, 9, 'paid', '2024-05-21 03:54:42'),
(119, 9, 'paid', '2024-05-21 03:55:01'),
(120, 9, 'paid', '2024-05-21 03:55:10'),
(121, 9, 'paid', '2024-05-21 03:55:19'),
(122, 9, 'paid', '2024-05-21 03:57:33'),
(123, 9, 'login', '2024-05-21 03:58:21'),
(124, 9, 'booking', '2024-05-21 04:00:21'),
(125, 9, 'paid', '2024-05-21 04:00:21'),
(126, 9, 'logout', '2024-05-21 04:00:45'),
(127, 50, 'login', '2024-05-21 04:00:50'),
(128, 9, 'login', '2024-05-21 04:11:37'),
(129, 50, 'login', '2024-05-21 04:13:14'),
(130, 50, 'booking', '2024-05-21 04:13:48'),
(131, 50, 'paid', '2024-05-21 04:13:48'),
(132, 53, 'login', '2024-05-21 04:17:28'),
(133, 52, 'login', '2024-05-21 04:17:34'),
(134, 50, 'login', '2024-05-21 04:17:41'),
(135, 52, 'login', '2024-05-21 04:18:55'),
(136, 53, 'login', '2024-05-21 04:19:01'),
(137, 52, 'login', '2024-05-21 04:21:14'),
(138, 52, 'booking', '2024-05-21 04:22:11'),
(139, 52, 'paid', '2024-05-21 04:22:11'),
(140, 9, 'login', '2024-05-21 05:20:55'),
(141, 9, 'booking', '2024-05-21 05:21:18'),
(142, 9, 'paid', '2024-05-21 05:21:18'),
(143, 9, 'login', '2024-05-21 08:19:36'),
(144, 9, 'login', '2024-05-21 15:08:22'),
(145, 9, 'login', '2024-05-22 02:31:12'),
(146, 9, 'booking', '2024-05-22 02:33:09'),
(147, 9, 'paid', '2024-05-22 02:33:10'),
(148, 9, 'logout', '2024-05-22 02:36:12'),
(149, 50, 'login', '2024-05-22 02:36:17'),
(150, 50, 'login', '2024-05-22 02:37:16'),
(151, 9, 'login', '2024-05-22 02:37:31'),
(152, 9, 'logout', '2024-05-22 02:37:32'),
(153, 50, 'login', '2024-05-22 02:37:50'),
(154, 44, 'login', '2024-05-22 02:39:12'),
(155, 50, 'login', '2024-05-22 02:41:36'),
(156, 50, 'login', '2024-05-22 02:42:39'),
(157, 50, 'login', '2024-05-22 02:44:06'),
(158, 50, 'login', '2024-05-22 02:44:15'),
(159, 50, 'login', '2024-05-22 02:45:24'),
(160, 50, 'login', '2024-05-22 02:45:57'),
(161, 50, 'login', '2024-05-22 02:51:32'),
(162, 50, 'login', '2024-05-22 02:52:00'),
(163, 50, 'login', '2024-05-22 02:52:14'),
(164, 50, 'login', '2024-05-22 02:59:10'),
(165, 9, 'login', '2024-05-22 02:59:27'),
(166, 9, 'logout', '2024-05-22 02:59:29'),
(167, 50, 'login', '2024-05-22 03:00:39'),
(168, 50, 'login', '2024-05-22 03:01:59'),
(169, 50, 'login', '2024-05-22 03:06:51'),
(170, 9, 'login', '2024-05-22 03:06:58'),
(171, 9, 'logout', '2024-05-22 03:07:00'),
(172, 9, 'login', '2024-05-22 03:08:38'),
(173, 9, 'login', '2024-05-22 03:08:56'),
(174, 9, 'login', '2024-05-22 03:10:04'),
(175, 9, 'login', '2024-05-22 03:12:03'),
(176, 9, 'login', '2024-05-22 03:12:25'),
(177, 9, 'logout', '2024-05-22 03:12:26'),
(178, 50, 'login', '2024-05-22 03:12:57'),
(179, 50, 'login', '2024-05-22 03:13:05'),
(180, 50, 'login', '2024-05-22 04:19:43'),
(181, 9, 'login', '2024-05-22 04:19:57'),
(182, 9, 'logout', '2024-05-22 04:20:00'),
(183, 50, 'login', '2024-05-22 04:31:24'),
(184, 50, 'login', '2024-05-22 04:33:24'),
(185, 50, 'logout', '2024-05-22 04:33:26'),
(186, 50, 'login', '2024-05-22 04:33:59'),
(187, 50, 'login', '2024-05-22 04:34:09'),
(188, 50, 'login', '2024-05-22 04:34:59'),
(189, 50, 'login', '2024-05-22 04:35:50'),
(190, 50, 'login', '2024-05-22 04:36:09'),
(191, 50, 'login', '2024-05-22 04:39:03'),
(192, 50, 'login', '2024-05-22 04:43:32'),
(193, 50, 'logout', '2024-05-22 04:46:43'),
(194, 9, 'login', '2024-05-22 04:46:54'),
(195, 9, 'login', '2024-05-22 08:27:54'),
(196, 9, 'login', '2024-05-22 09:36:19'),
(197, 9, 'logout', '2024-05-22 09:40:55'),
(198, 9, 'login', '2024-05-22 09:41:04'),
(199, 9, 'login', '2024-05-22 09:42:59'),
(200, 52, 'login', '2024-05-22 09:43:20'),
(201, 52, 'logout', '2024-05-22 09:46:55'),
(202, 9, 'login', '2024-05-22 09:47:05'),
(203, 52, 'login', '2024-05-22 09:47:12'),
(204, 52, 'logout', '2024-05-22 09:52:59'),
(205, 9, 'login', '2024-05-22 09:53:31'),
(206, 9, 'logout', '2024-05-22 09:54:30'),
(207, 52, 'login', '2024-05-22 09:54:36'),
(208, 52, 'logout', '2024-05-22 09:56:09'),
(209, 9, 'login', '2024-05-22 09:56:15'),
(210, 9, 'logout', '2024-05-22 09:56:18'),
(211, 52, 'login', '2024-05-22 09:56:24'),
(212, 52, 'update profile', '2024-05-22 10:03:57'),
(213, 9, 'login', '2024-05-22 10:17:17'),
(214, 9, 'login', '2024-05-22 10:40:00'),
(215, 9, 'logout', '2024-05-22 10:40:03'),
(216, 9, 'login', '2024-05-22 10:42:23'),
(217, 9, 'booking', '2024-05-22 11:04:50'),
(218, 9, 'paid', '2024-05-22 11:04:50'),
(219, 9, 'booking', '2024-05-22 11:05:08'),
(220, 9, 'paid', '2024-05-22 11:05:08'),
(221, 9, 'update name', '2024-05-22 11:21:26'),
(222, 9, 'update profile', '2024-05-22 11:21:35'),
(223, 9, 'update profile', '2024-05-22 11:21:43'),
(224, 9, 'update profile', '2024-05-22 15:52:13'),
(225, 9, 'logout', '2024-05-22 15:53:07'),
(226, 50, 'login', '2024-05-22 15:54:05'),
(227, 50, 'login', '2024-05-22 15:59:11'),
(228, 50, 'logout', '2024-05-22 16:00:13'),
(229, 50, 'login', '2024-05-22 16:00:19'),
(230, 50, 'logout', '2024-05-22 16:04:23'),
(231, 9, 'login', '2024-05-22 23:49:44'),
(232, 9, 'booking', '2024-05-22 23:50:03'),
(233, 9, 'paid', '2024-05-22 23:50:03'),
(234, 9, 'booking', '2024-05-22 23:50:28'),
(235, 9, 'paid', '2024-05-22 23:50:28'),
(236, 9, 'logout', '2024-05-22 23:50:58'),
(237, 52, 'login', '2024-05-23 02:18:10'),
(238, 52, 'booking', '2024-05-23 02:18:33'),
(239, 52, 'paid', '2024-05-23 02:18:33'),
(240, 52, 'paid', '2024-05-23 02:19:39'),
(241, 52, 'paid', '2024-05-23 02:19:55'),
(242, 52, 'paid', '2024-05-23 02:22:27'),
(243, 52, 'paid', '2024-05-23 02:23:04'),
(244, 52, 'paid', '2024-05-23 02:23:21'),
(245, 52, 'paid', '2024-05-23 02:23:40'),
(246, 52, 'paid', '2024-05-23 02:23:48'),
(247, 52, 'paid', '2024-05-23 02:23:59'),
(248, 52, 'paid', '2024-05-23 02:24:12'),
(249, 52, 'paid', '2024-05-23 02:24:19'),
(250, 52, 'paid', '2024-05-23 02:24:33'),
(251, 52, 'paid', '2024-05-23 02:24:40'),
(252, 52, 'paid', '2024-05-23 02:24:47'),
(253, 52, 'paid', '2024-05-23 02:25:15'),
(254, 52, 'paid', '2024-05-23 02:25:16'),
(255, 52, 'paid', '2024-05-23 02:25:16'),
(256, 52, 'paid', '2024-05-23 02:25:29'),
(257, 52, 'paid', '2024-05-23 02:25:30'),
(258, 52, 'paid', '2024-05-23 02:25:30'),
(259, 52, 'paid', '2024-05-23 02:25:42'),
(260, 52, 'paid', '2024-05-23 02:25:42'),
(261, 52, 'paid', '2024-05-23 02:25:42'),
(262, 52, 'paid', '2024-05-23 02:26:05'),
(263, 52, 'paid', '2024-05-23 02:26:25'),
(264, 52, 'paid', '2024-05-23 02:26:40'),
(265, 52, 'paid', '2024-05-23 02:26:59'),
(266, 52, 'paid', '2024-05-23 02:27:00'),
(267, 52, 'paid', '2024-05-23 02:27:04'),
(268, 52, 'paid', '2024-05-23 02:27:12'),
(269, 52, 'paid', '2024-05-23 02:27:45'),
(270, 52, 'paid', '2024-05-23 02:27:49'),
(271, 52, 'paid', '2024-05-23 02:27:52'),
(272, 52, 'paid', '2024-05-23 02:27:56'),
(273, 52, 'paid', '2024-05-23 02:27:59'),
(274, 52, 'paid', '2024-05-23 02:28:02'),
(275, 52, 'paid', '2024-05-23 02:28:21'),
(276, 52, 'paid', '2024-05-23 02:28:59'),
(277, 52, 'paid', '2024-05-23 02:29:05'),
(278, 52, 'paid', '2024-05-23 02:29:08'),
(279, 52, 'paid', '2024-05-23 02:29:12'),
(280, 52, 'paid', '2024-05-23 02:29:17'),
(281, 52, 'paid', '2024-05-23 02:29:41'),
(282, 52, 'paid', '2024-05-23 02:29:45'),
(283, 52, 'paid', '2024-05-23 02:29:48'),
(284, 52, 'paid', '2024-05-23 02:29:48'),
(285, 52, 'paid', '2024-05-23 02:29:55'),
(286, 52, 'paid', '2024-05-23 02:29:59'),
(287, 52, 'paid', '2024-05-23 02:30:10'),
(288, 52, 'paid', '2024-05-23 02:30:26'),
(289, 52, 'paid', '2024-05-23 02:30:39'),
(290, 52, 'paid', '2024-05-23 02:30:47'),
(291, 52, 'paid', '2024-05-23 02:31:34'),
(292, 52, 'paid', '2024-05-23 02:31:48'),
(293, 52, 'booking', '2024-05-23 02:34:46'),
(294, 52, 'paid', '2024-05-23 02:34:46'),
(295, 52, 'booking', '2024-05-23 02:35:34'),
(296, 52, 'paid', '2024-05-23 02:35:34'),
(297, 52, 'paid', '2024-05-23 02:35:41'),
(298, 52, 'paid', '2024-05-23 02:35:46'),
(299, 52, 'paid', '2024-05-23 02:35:51'),
(300, 52, 'paid', '2024-05-23 02:35:57'),
(301, 52, 'logout', '2024-05-23 02:38:29'),
(302, 52, 'login', '2024-05-23 10:46:05'),
(303, 53, 'login', '2024-05-23 10:46:12'),
(304, 53, 'logout', '2024-05-23 10:48:14'),
(305, 52, 'login', '2024-05-23 10:48:31'),
(306, 53, 'login', '2024-05-23 10:48:40'),
(307, 52, 'login', '2024-05-23 10:49:20'),
(308, 53, 'update profile', '2024-05-23 10:50:42'),
(309, 53, 'logout', '2024-05-23 10:51:47'),
(310, 52, 'login', '2024-05-23 10:56:27'),
(311, 52, 'logout', '2024-05-23 10:59:18'),
(312, 50, 'login', '2024-05-23 10:59:24'),
(313, 52, 'login', '2024-05-23 11:03:57'),
(314, 50, 'login', '2024-05-23 11:05:02'),
(315, 50, 'logout', '2024-05-23 11:05:16'),
(316, 50, 'login', '2024-05-23 11:11:25'),
(317, 50, 'logout', '2024-05-23 11:11:26'),
(318, 50, 'login', '2024-05-23 11:11:32'),
(319, 50, 'logout', '2024-05-23 11:11:33'),
(320, 9, 'login', '2024-05-23 11:11:57'),
(321, 9, 'logout', '2024-05-23 11:12:00'),
(322, 50, 'login', '2024-05-23 11:12:08'),
(323, 50, 'logout', '2024-05-23 11:12:09'),
(324, 50, 'login', '2024-05-23 11:13:12'),
(325, 50, 'logout', '2024-05-23 11:13:14'),
(326, 50, 'login', '2024-05-23 11:13:25'),
(327, 50, 'login', '2024-05-23 11:15:29'),
(328, 50, 'login', '2024-05-23 11:17:05'),
(329, 50, 'logout', '2024-05-23 11:35:39'),
(330, 50, 'logout', '2024-05-23 12:13:53'),
(331, 52, 'login', '2024-05-23 12:14:24'),
(332, 52, 'logout', '2024-05-23 12:14:28'),
(333, 50, 'login', '2024-05-23 12:15:17'),
(334, 53, 'login', '2024-05-23 12:15:26'),
(335, 53, 'logout', '2024-05-23 12:15:28'),
(336, 50, 'logout', '2024-05-23 12:20:34'),
(337, 9, 'login', '2024-05-23 12:20:43'),
(338, 9, 'logout', '2024-05-23 13:43:21'),
(339, 9, 'login', '2024-05-23 13:44:32'),
(340, 9, 'booking', '2024-05-23 13:45:38'),
(341, 9, 'paid', '2024-05-23 13:45:39'),
(342, 9, 'logout', '2024-05-23 13:45:50'),
(343, 9, 'login', '2024-05-23 13:47:07'),
(344, 9, 'logout', '2024-05-23 13:50:44'),
(345, 9, 'login', '2024-05-23 13:53:27'),
(346, 9, 'logout', '2024-05-23 13:53:30'),
(347, 9, 'login', '2024-05-23 13:54:19'),
(348, 9, 'logout', '2024-05-23 13:54:20'),
(349, 50, 'login', '2024-05-23 13:55:23'),
(350, 50, 'logout', '2024-05-23 13:55:37'),
(351, 9, 'login', '2024-05-23 13:56:42'),
(352, 9, 'logout', '2024-05-23 13:58:25'),
(353, 9, 'login', '2024-05-23 13:58:44'),
(354, 9, 'logout', '2024-05-23 13:58:47'),
(355, 59, 'login', '2024-05-24 10:49:05'),
(356, 59, 'logout', '2024-05-24 10:59:14'),
(357, 50, 'login', '2024-05-24 10:59:23'),
(358, 50, 'logout', '2024-05-24 11:00:13'),
(359, 52, 'login', '2024-05-24 13:54:02'),
(360, 9, 'login', '2024-05-24 14:00:42'),
(361, 9, 'login', '2024-05-24 14:03:17'),
(362, 9, 'booking', '2024-05-24 14:03:58'),
(363, 9, 'paid', '2024-05-24 14:03:58'),
(364, 9, 'paid', '2024-05-24 14:04:30'),
(365, 9, 'paid', '2024-05-24 14:04:37'),
(366, 9, 'paid', '2024-05-24 14:04:37'),
(367, 9, 'paid', '2024-05-24 14:04:37'),
(368, 9, 'paid', '2024-05-24 14:04:41'),
(369, 9, 'paid', '2024-05-24 14:04:52'),
(370, 9, 'paid', '2024-05-24 14:04:56'),
(371, 9, 'paid', '2024-05-24 14:05:04'),
(372, 9, 'login', '2024-05-24 14:12:00'),
(373, 9, 'booking', '2024-05-24 14:12:19'),
(374, 9, 'paid', '2024-05-24 14:12:19'),
(375, 9, 'booking', '2024-05-24 14:14:46'),
(376, 9, 'paid', '2024-05-24 14:14:46'),
(377, 9, 'logout', '2024-05-24 14:27:59'),
(378, 50, 'login', '2024-05-24 14:28:04'),
(379, 50, 'logout', '2024-05-24 14:28:55'),
(380, 9, 'login', '2024-05-24 14:29:10'),
(381, 9, 'update name or conta', '2024-05-24 14:54:43'),
(382, 9, 'booking', '2024-05-24 14:55:52'),
(383, 9, 'paid', '2024-05-24 14:55:52'),
(384, 9, 'login', '2024-05-26 03:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_firstn` varchar(50) NOT NULL,
  `client_midn` varchar(50) NOT NULL,
  `client_lastn` varchar(50) NOT NULL,
  `client_contnum` varchar(11) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_pw` varchar(256) NOT NULL,
  `user_level` int(1) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `pfp` blob NOT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `lockout_time` datetime DEFAULT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_firstn`, `client_midn`, `client_lastn`, `client_contnum`, `client_email`, `client_pw`, `user_level`, `reg_date`, `pfp`, `failed_attempts`, `lockout_time`, `security_question`, `security_answer`) VALUES
(9, 'Pierre', 'Isaiah', 'SSs', '09420808105', 'ise@gmail.com', '$2y$10$iYr2CjIQBAXzDlWoqO4C8.I6eyjSjKFh5eLkZwMF/uoFND5G6Zzc6', 1, '2024-04-28 22:27:57', 0x75706c6f6164732f3338373536373234315f3731333635313432333935343339395f343535303931313038393037353031393537335f6e2e6a7067, 0, NULL, '', ''),
(10, 'Philip', 'Castro', 'Aguinaldo', '2147483647', 'philip@gmail.com', '$2y$10$SR4uysGpaUUNIUFCkGCdu.wB1auexq0qinJrWa1PNydTWhSOOBo5C', 2, '2024-04-29 00:00:15', '', 0, NULL, '', ''),
(11, 'Pamela', 'Ignacio', 'Aguinaldo', '2147483647', 'pam@gmail.com', '$2y$10$45fEel0GhEd9yJysycyl9Ofa/hFocviam3WwFiiCZGabgobKZCSka', 1, '2024-04-29 00:00:39', '', 0, NULL, '', ''),
(12, 'Rigel Marie', 'Lomibao', 'Villarosa', '932932932', 'rigel@gmail.com', '$2y$10$LB5a4FgkgjuZxX/s99ZuleKEalCACS.5EobHqlN7lOgtPWT055lmy', 2, '2024-04-29 00:01:42', '', 0, NULL, '', ''),
(13, 'John', 'A', 'Doe', '2147483647', 'john.doe@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(14, 'Jane', 'B', 'Smith', '2147483647', 'jane.smith@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(15, 'Michael', 'C', 'Johnson', '2147483647', 'michael.johnson@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(16, 'Emily', 'D', 'Williams', '2147483647', 'emily.williams@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(17, 'David', 'E', 'Brown', '2147483647', 'david.brown@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(18, 'Sarah', 'F', 'Jones', '2147483647', 'sarah.jones@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(19, 'Robert', 'G', 'Miller', '2147483647', 'robert.miller@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(20, 'Jessica', 'H', 'Davis', '2147483647', 'jessica.davis@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(21, 'Christopher', 'I', 'Garcia', '2147483647', 'christopher.garcia@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(22, 'Amanda', 'J', 'Rodriguez', '2147483647', 'amanda.rodriguez@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(23, 'Matthew', 'K', 'Wilson', '2147483647', 'matthew.wilson@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(24, 'Ashley', 'L', 'Martinez', '2147483647', 'ashley.martinez@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(25, 'Joshua', 'M', 'Anderson', '2147483647', 'joshua.anderson@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(26, 'Stephanie', 'N', 'Taylor', '2147483647', 'stephanie.taylor@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(27, 'Daniel', 'O', 'Thomas', '2147483647', 'daniel.thomas@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(28, 'John', 'A', 'Doe', '2147483647', 'john.doe@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(29, 'Jane', 'B', 'Smith', '2147483647', 'jane.smith@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(30, 'Michael', 'C', 'Johnson', '2147483647', 'michael.johnson@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(31, 'Emily', 'D', 'Williams', '2147483647', 'emily.williams@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(32, 'David', 'E', 'Brown', '2147483647', 'david.brown@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(33, 'Sarah', 'F', 'Jones', '2147483647', 'sarah.jones@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(34, 'Robert', 'G', 'Miller', '2147483647', 'robert.miller@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(35, 'Jessica', 'H', 'Davis', '2147483647', 'jessica.davis@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(36, 'Christopher', 'I', 'Garcia', '2147483647', 'christopher.garcia@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(37, 'Amanda', 'J', 'Rodriguez', '2147483647', 'amanda.rodriguez@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(38, 'Matthew', 'K', 'Wilson', '2147483647', 'matthew.wilson@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(39, 'Ashley', 'L', 'Martinez', '2147483647', 'ashley.martinez@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(40, 'Joshua', 'M', 'Anderson', '2147483647', 'joshua.anderson@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(41, 'Stephanie', 'N', 'Taylor', '2147483647', 'stephanie.taylor@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(42, 'Daniel', 'O', 'Thomas', '2147483647', 'daniel.thomas@email.com', '$2y$10$iusesomesillystringforsalt./', 1, '2024-04-29 11:49:34', '', 0, NULL, '', ''),
(43, 'Pam', 'Ignacio', 'Aguinaldo', '63343434', 'pam@gmail.com', 'Seyangtut23', 2, '2024-04-30 03:51:55', '', 0, NULL, '', ''),
(44, 'Pamela', 'Pamela', 'Pamela', '123123123', 'bambi@gmail.com', '$2y$10$M.h7nzeSR2xU110dJMeHveijHw46jYdmHn.vxd14Z75pxOzUTgXYq', 2, '2024-04-30 03:58:35', '', 0, NULL, '', ''),
(45, 'Okoak', 'Aokasd', 'Paosd', '9420808105', 'se@gmail.com', '$2y$10$JqwTtDu/ASfuWEufPgHpkeCSA2WllLSuKUyt3gxgQWtoqHNs73zqq', 1, '2024-04-30 04:58:31', '', 0, NULL, '', ''),
(46, 'Nat', 'Nat', 'Nat', '9420101032', 'nat@gmail.com', '$2y$10$/PnA9kVUFZWdY2i1jSQDIeJ/BNOmwqljIPKUmuvoNj7FM/b4PFkKG', 1, '2024-04-30 05:43:22', '', 0, NULL, '', ''),
(47, 'Nat', 'Nat', 'Nat', '21321312312', 'nat@gmail.com', '$2y$10$AnqRm3ivSGqfFvhm4WxthO6tWDflVBA5wdnajlkLJty1S1n7Ki1Lm', 1, '2024-04-30 05:44:54', '', 0, NULL, '', ''),
(48, 'Asds', 'Aasd', 'Aasds', '9420808105', 'asdas@gmail.com', '$2y$10$yOYqx18RlMcY0hXQ9YD8mO1wXag7UeZql61og5BbBKlrtSoPHkvRG', 1, '2024-05-01 16:04:33', '', 0, NULL, '', ''),
(49, 'Pierre', 'Ignacio', 'Isaiah', '9420808105', 'ig@gmail.com', '$2y$10$cSjATeFHGVIVslh65EX2s.dGbHx32lEcMkwOZvFeWl3o6U/pECyVO', 1, '2024-05-05 09:46:02', '', 0, NULL, '', ''),
(50, 'Ppp', 'Ppp', 'Ppp', '9999999999', 'g@gmail.com', '$2y$10$BdHMuu9qe4.N1RrOrH12peu/ylSQWi2q/X42My1za5ujYIsJLbtee', 2, '2024-05-19 02:04:11', '', 0, NULL, '', ''),
(51, 'Sam', 'Sam', 'Sam', '94232323232', 'samm@gmail.com', '$2y$10$XyHZJ./H1Ur3MJs1.d2iYuMjryWIsBeOftW/FGIY3hdFM6MGw7qCe', 1, '2024-05-21 02:54:09', '', 0, NULL, '', ''),
(52, 'One', 'One', 'One', '0120321033', 'one@gmail.com', '$2y$10$jNJcr/7dHv3jqq.xGG0H1.GZ91OJeorkOVbjd29i/BDqdD0IFoWpq', 1, '2024-05-21 04:17:03', 0x75706c6f6164732f3338373536373234315f3731333635313432333935343339395f343535303931313038393037353031393537335f6e2e6a7067, 0, NULL, '', ''),
(53, 'Two', 'Two', 'Two', '12312312312', 'two@gmail.com', '$2y$10$4KRBfD8cxVZM6LNKJlqt0OurYryPdEKKt5T8ew/AjCmi44SRKqaB6', 1, '2024-05-21 04:17:23', 0x75706c6f6164732f57494e5f32303233313030385f31305f34315f31345f50726f2e6a7067, 0, NULL, '', ''),
(54, 'Isaiah', 'Isaiah', 'Isaiah', '9999999999', 'iseaguinalds@gmail.com', '$2y$10$4Eb8u91pHoTchIdT8cVqCuVJJDeXjI7G2Hb1KQo0OCZ1MnN9AqES6', 1, '2024-05-22 16:43:32', '', 0, NULL, '', ''),
(55, 'One', 'One', 'One', '9420808105', 'iseaguinalds@gmail.com', '$2y$10$jAbv7udIfMHgn.fmrhNHh./zPq0qcw3MEAbqN0WEZt3iQTusPv8na', 1, '2024-05-23 00:55:39', '', 0, NULL, '', ''),
(56, 'Lll', 'Lll', 'LLl', '9420808105', 'iseaguinalds@gmail.com', '$2y$10$L.ArF9TIKXXJ1L1yUPebC.zwFpY2fKe7DYWB0NrD3JCbnfaZQk3WO', 1, '2024-05-23 00:56:51', '', 0, NULL, '', ''),
(57, 'Ll', 'Ll', 'Ll', '9420880150', 'iseaguinalds@gmail.com', '$2y$10$02ZR8Yx/RZdyes.9RzH5WOWXqVquMfCOKOf5tbcYtDQ6auwJKy.J6', 1, '2024-05-23 00:57:09', '', 0, NULL, '', ''),
(58, 'Ooo', 'Ooo', 'Ooo', '9420808105', 'iseaguinalds@gmail.com', '$2y$10$MMciWyNvKVHkOk.q6CLJr./O4Tp0ytBcyPvfiW6Q/0cXsy0qGNLYa', 1, '2024-05-23 01:00:29', '', 0, NULL, '', ''),
(59, 'Kk', 'Kk', 'Kk', '9420808105', 'kk@gmail.com', '$2y$10$LcPhw1ho584hAw2oIw1GFeR.ZoMPCQfSD4Yt7DkKeRpU1mXoGur9C', 1, '2024-05-24 10:48:03', '', 0, NULL, 'In what city were you born?', 'Baliwag');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires_at`) VALUES
(1, 'iseaguinalds@gmail.com', '5a28a86f111af0cdb03cbf5213e9d183ca24c70d6dfe3d9d58e236c5f7fff14aa107ce5a9c65f7cd9c5cce8ac177e63e30bc', '2024-05-23 03:32:08'),
(2, 'iseaguinalds@gmail.com', '00359b2589e6af67579a03327af15d114d0d1aa9492343a8d53f91faa258d45e4f3e6ff0c4ad5e31af663edc3c4b97ff1cbb', '2024-05-23 03:37:32'),
(3, 'iseaguinalds@gmail.com', '1aff7248c6a3c43e99285b4602642c9037e6cc82f71fb85af8cb1f307a24c1c6c9683457a97c8964a743743cbf20867377e3', '2024-05-23 03:38:11'),
(4, 'iseaguinalds@gmail.com', '8e2a189c3af999d5ae8325124854ff4aba7027e4d18c16daab74cb2485c1ac51006a33d2fc1d9d20235ae671b64b83f7bb25', '2024-05-23 03:38:21'),
(5, 'iseaguinalds@gmail.com', '93f13719288c07a9334d4be944bdca1ced1465a6de7bda131183c219767f77bc3d2506b807f55c76850894a85b9efd006697', '2024-05-23 14:36:13'),
(6, 'iseaguinalds@gmail.com', '16567eccb8141039e41124f0c41d9d03f8d0070a171d7de0ec329bbc25344d7185702d4578c34aa9973b3206cbf582ccbd28', '2024-05-23 19:27:07'),
(7, 'iseaguinalds@gmail.com', '3138c15fb3c544255d6e79020fbf565854a2dc9e5d1ffbbb205f4a6930a8353202b17b063711b8bc5e061ad8c5b7c8e95c65', '2024-05-23 19:29:17'),
(8, 'iseaguinalds@gmail.com', '5d5b5449feab5a93fbe029209a9c5e6730a908a3d9406fa0b15c167dc3fec4d5f25a342ac8de9fc9e3de4486e5b67d94934f', '2024-05-23 19:34:42'),
(9, 'iseaguinalds@gmail.com', 'ab187681cd98f7667efc8dadf4f7b0eb919ef0b7d2bbe7a2ecb3982e4765b3d53d1ca70305d45782588255325dd59ff002c7', '2024-05-23 19:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `sched`
--

CREATE TABLE `sched` (
  `sched_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `sched_timedate` datetime NOT NULL,
  `sched_endtime` datetime NOT NULL,
  `court_name` varchar(40) NOT NULL,
  `sched_status` varchar(25) NOT NULL,
  `sched_time` time NOT NULL,
  `sched_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sched`
--

INSERT INTO `sched` (`sched_id`, `client_id`, `sched_timedate`, `sched_endtime`, `court_name`, `sched_status`, `sched_time`, `sched_end`) VALUES
(94, 9, '2024-05-24 05:00:00', '2024-05-24 07:00:00', 'Andoy', 'Booked', '05:00:00', '07:00:00'),
(95, 9, '2024-05-24 04:00:00', '2024-05-24 06:00:00', 'Juliet', 'Booked', '04:00:00', '06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `reference_number` varchar(50) NOT NULL,
  `court_name` varchar(40) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `sched_id`, `client_id`, `amount`, `payment_method`, `reference_number`, `court_name`, `total_amount`, `timestamp`) VALUES
(1, 94, 9, 300.00, 'GCash', 'REF_6650a0d688a038.68200068', 'Andoy', 600.00, '2024-05-24 14:14:46'),
(2, 95, 9, 300.00, 'GCash', 'REF_6650aa7822a250.93993860', 'Juliet', 500.00, '2024-05-24 14:55:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `identifier` (`client_lastn`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sched`
--
ALTER TABLE `sched`
  ADD PRIMARY KEY (`sched_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `client` (`sched_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sched`
--
ALTER TABLE `sched`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sched`
--
ALTER TABLE `sched`
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `client` FOREIGN KEY (`sched_id`) REFERENCES `sched` (`sched_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
