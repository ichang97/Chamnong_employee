-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2018 at 02:47 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_log`
--

CREATE TABLE `leave_log` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `doc_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `t_class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `t_subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_sclass` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `reason` longtext COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `s_time_range` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` date NOT NULL,
  `e_time_range` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ad_home_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ad_road` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ad_alley` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ad_sub_district` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ad_district` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ad_province` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ad_postcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_log`
--

INSERT INTO `leave_log` (`id`, `userid`, `doc_title`, `t_class`, `t_subject`, `t_sclass`, `category`, `reason`, `start_date`, `s_time_range`, `end_date`, `e_time_range`, `ad_home_no`, `ad_road`, `ad_alley`, `ad_sub_district`, `ad_district`, `ad_province`, `ad_postcode`, `tel`, `timestamp`) VALUES
(3, 3, 'ลากิจ', '', 'คณิตศาสตร์', 'ป.6', '1', 'ไปงานศพญาตินะจ๊ะ', '2018-04-18', '1', '2018-04-18', '1', '1', 'ประชาสงเคราะห์', 'สมปรารถนา', 'ดินแดง', 'ดินแดง', 'กรุงเทพฯ', '10400', '0967314939', '2018-04-17 20:42:38'),
(5, 11, 'ขอลาป่วย', 'ป.1/1', '', '', '2', 'ผ่าตัดหลอดเลือดหัวใจและทำบายบาส', '2018-04-23', '1', '2018-04-27', '2', '70/32', 'ประชาสงเคราะห์', 'ประชาสงเคราะห์ 4', 'ดินแดง', 'ดินแดง', 'กรุงเทพฯ', '10400', '0964442222', '2018-04-18 00:40:23'),
(6, 12, 'ขอลากิจ', '', 'นาฏศิลป์', 'ม.1', '1', 'ไปงานศพคุณตา', '2018-04-30', '1', '2018-04-30', '1', '1', 'ประชาสงเคราะห์', 'สมปรารถนา', 'ดินแดง', 'ดินแดง', 'กรุงเทพฯ', '10400', '0967314939', '2018-04-18 01:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE `login_log` (
  `id` int(10) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `t_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login_log`
--

INSERT INTO `login_log` (`id`, `username`, `t_name`, `timestamp`) VALUES
(1, 'ichang97', 'วัชรพล', '2018-04-16 23:50:55'),
(2, 'somtawil', 'สมถวิล', '2018-04-16 23:51:53'),
(3, 'upin', 'ยุพิณ', '2018-04-16 23:52:12'),
(4, 'ichang97', 'วัชรพล', '2018-04-17 00:20:29'),
(5, 'test', 'หมื่น', '2018-04-17 17:16:14'),
(6, 'ichang97', 'วัชรพล', '2018-04-17 17:17:32'),
(7, 'ichang97', 'วัชรพล', '2018-04-17 17:18:29'),
(8, 'test1', 'หมื่น', '2018-04-17 17:18:52'),
(9, 'test2', 'การะเกด', '2018-04-17 17:19:02'),
(10, 'test1', 'หมื่น', '2018-04-17 17:19:24'),
(11, 'test1', 'หมื่น', '2018-04-17 20:36:55'),
(12, 'upin', 'ยุพิณ', '2018-04-18 00:37:28'),
(13, 'test2', 'การะเกด', '2018-04-18 00:58:04'),
(14, 'test1', 'หมื่น', '2018-04-18 01:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `t_salutation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_surname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `permission` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `t_salutation`, `t_name`, `t_surname`, `permission`) VALUES
(1, 'ichang97', 'Chamnong19**', 'นาย', 'วัชรพล', 'ประคองใจ', 1),
(3, 'test1', 'Chamnong19**', 'นาย', 'หมื่น', 'สุนทรเทวา', 2),
(6, 'somtawil', 'Chamnong19**', 'นาง', 'สมถวิล', 'มะโรง', 1),
(8, 'somtui', 'Chamnong19**', 'นาย', 'สมถุย', 'ตุ๋ยแหลก', 2),
(11, 'upin', 'Chamnong19**', 'นาง', 'ยุพิณ', 'แซวกระโทก', 2),
(12, 'test2', 'Chamnong19**', 'นาง', 'การะเกด', 'สุนทรเทวา', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_log`
--
ALTER TABLE `leave_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_log`
--
ALTER TABLE `leave_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_log`
--
ALTER TABLE `leave_log`
  ADD CONSTRAINT `leave_log_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
