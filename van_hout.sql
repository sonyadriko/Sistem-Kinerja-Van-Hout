-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 01:38 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `van_hout`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nama_area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id_area`, `nama_area`) VALUES
(1, 'Intention Support'),
(2, 'Working Relationship'),
(3, 'Shared Domain Knowledge'),
(4, 'IT Projects and Planning'),
(5, 'IT Performance');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `respondents_id` int(11) NOT NULL,
  `kuesioner_id` int(11) NOT NULL,
  `jawaban` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `respondents_id`, `kuesioner_id`, `jawaban`) VALUES
(1, 1, 1, 'Setuju'),
(2, 1, 2, 'Setuju'),
(3, 1, 3, 'Tidak Setuju'),
(4, 1, 4, 'Sangat Tidak Setuju'),
(5, 1, 5, 'Setuju'),
(6, 1, 6, 'Sangat Tidak Setuju'),
(7, 1, 7, 'Tidak Setuju'),
(8, 1, 8, 'Sangat Setuju'),
(9, 1, 9, 'Tidak Setuju'),
(10, 1, 10, 'Sangat Setuju'),
(11, 1, 11, 'Sangat Tidak Setuju'),
(12, 1, 12, 'Tidak Setuju'),
(13, 1, 13, 'Netral'),
(14, 1, 14, 'Sangat Tidak Setuju'),
(15, 1, 15, 'Sangat Setuju'),
(16, 1, 16, 'Sangat Tidak Setuju'),
(17, 1, 17, 'Tidak Setuju'),
(18, 1, 18, 'Tidak Setuju'),
(19, 1, 19, 'Tidak Setuju'),
(20, 1, 20, 'Netral'),
(21, 1, 21, 'Setuju'),
(22, 1, 22, 'Sangat Setuju'),
(23, 1, 23, 'Sangat Setuju'),
(24, 1, 24, 'Setuju'),
(25, 1, 25, 'Netral'),
(26, 1, 26, 'Tidak Setuju'),
(27, 1, 27, 'Sangat Tidak Setuju'),
(28, 2, 1, 'Sangat Setuju'),
(29, 2, 2, 'Setuju'),
(30, 2, 3, 'Sangat Tidak Setuju'),
(31, 2, 4, 'Tidak Setuju'),
(32, 2, 5, 'Netral'),
(33, 2, 6, 'Sangat Tidak Setuju'),
(34, 2, 7, 'Tidak Setuju'),
(35, 2, 8, 'Setuju'),
(36, 2, 9, 'Sangat Tidak Setuju'),
(37, 2, 10, 'Tidak Setuju'),
(38, 2, 11, 'Netral'),
(39, 2, 12, 'Sangat Setuju'),
(40, 2, 13, 'Sangat Tidak Setuju'),
(41, 2, 14, 'Netral'),
(42, 2, 15, 'Tidak Setuju'),
(43, 2, 16, 'Sangat Tidak Setuju'),
(44, 2, 17, 'Sangat Setuju'),
(45, 2, 18, 'Setuju'),
(46, 2, 19, 'Sangat Setuju'),
(47, 2, 20, 'Setuju'),
(48, 2, 21, 'Netral'),
(49, 2, 22, 'Tidak Setuju'),
(50, 2, 23, 'Tidak Setuju'),
(51, 2, 24, 'Netral'),
(52, 2, 25, 'Tidak Setuju'),
(53, 2, 26, 'Tidak Setuju'),
(54, 2, 27, 'Sangat Tidak Setuju'),
(55, 3, 1, 'Sangat Setuju'),
(56, 3, 2, 'Tidak Setuju'),
(57, 3, 3, 'Netral'),
(58, 3, 4, 'Tidak Setuju'),
(59, 3, 5, 'Setuju'),
(60, 3, 6, 'Sangat Setuju'),
(61, 3, 7, 'Setuju'),
(62, 3, 8, 'Setuju'),
(63, 3, 9, 'Netral'),
(64, 3, 10, 'Sangat Setuju'),
(65, 3, 11, 'Setuju'),
(66, 3, 12, 'Netral'),
(67, 3, 13, 'Setuju'),
(68, 3, 14, 'Netral'),
(69, 3, 15, 'Sangat Setuju'),
(70, 3, 16, 'Tidak Setuju'),
(71, 3, 17, 'Netral'),
(72, 3, 18, 'Tidak Setuju'),
(73, 3, 19, 'Tidak Setuju'),
(74, 3, 20, 'Tidak Setuju'),
(75, 3, 21, 'Tidak Setuju'),
(76, 3, 22, 'Setuju'),
(77, 3, 23, 'Setuju'),
(78, 3, 24, 'Setuju'),
(79, 3, 25, 'Setuju'),
(80, 3, 26, 'Setuju'),
(81, 3, 27, 'Setuju'),
(82, 4, 1, 'Sangat Setuju'),
(83, 4, 2, 'Tidak Setuju'),
(84, 4, 3, 'Tidak Setuju'),
(85, 4, 4, 'Tidak Setuju'),
(86, 4, 5, 'Sangat Setuju'),
(87, 4, 6, 'Tidak Setuju'),
(88, 4, 7, 'Setuju'),
(89, 4, 8, 'Sangat Tidak Setuju'),
(90, 4, 9, 'Sangat Tidak Setuju'),
(91, 4, 10, 'Tidak Setuju'),
(92, 4, 11, 'Netral'),
(93, 4, 12, 'Setuju'),
(94, 4, 13, 'Sangat Setuju'),
(95, 4, 14, 'Setuju'),
(96, 4, 15, 'Netral'),
(97, 4, 16, 'Netral'),
(98, 4, 17, 'Netral'),
(99, 4, 18, 'Netral'),
(100, 4, 19, 'Netral'),
(101, 4, 20, 'Netral'),
(102, 4, 21, 'Tidak Setuju'),
(103, 4, 22, 'Tidak Setuju'),
(104, 4, 23, 'Tidak Setuju'),
(105, 4, 24, 'Sangat Setuju'),
(106, 4, 25, 'Setuju'),
(107, 4, 26, 'Setuju'),
(108, 4, 27, 'Sangat Setuju'),
(109, 5, 1, 'Sangat Setuju'),
(110, 5, 2, 'Tidak Setuju'),
(111, 5, 3, 'Sangat Tidak Setuju'),
(112, 5, 4, 'Tidak Setuju'),
(113, 5, 5, 'Sangat Tidak Setuju'),
(114, 5, 6, 'Tidak Setuju'),
(115, 5, 7, 'Sangat Tidak Setuju'),
(116, 5, 8, 'Sangat Tidak Setuju'),
(117, 5, 9, 'Tidak Setuju'),
(118, 5, 10, 'Setuju'),
(119, 5, 11, 'Sangat Setuju'),
(120, 5, 12, 'Netral'),
(121, 5, 13, 'Netral'),
(122, 5, 14, 'Sangat Setuju'),
(123, 5, 15, 'Netral'),
(124, 5, 16, 'Sangat Setuju'),
(125, 5, 17, 'Netral'),
(126, 5, 18, 'Tidak Setuju'),
(127, 5, 19, 'Tidak Setuju'),
(128, 5, 20, 'Tidak Setuju'),
(129, 5, 21, 'Sangat Tidak Setuju'),
(130, 5, 22, 'Sangat Tidak Setuju'),
(131, 5, 23, 'Tidak Setuju'),
(132, 5, 24, 'Sangat Tidak Setuju'),
(133, 5, 25, 'Tidak Setuju'),
(134, 5, 26, 'Sangat Setuju'),
(135, 5, 27, 'Sangat Setuju');

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner`
--

CREATE TABLE `kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `pertanyaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuesioner`
--

INSERT INTO `kuesioner` (`id_kuesioner`, `area_id`, `pertanyaan`) VALUES
(1, 1, 'Apakah pimpinan berkomitmen untuk menggunakan nilai strategi TI?\n'),
(2, 1, 'Apakah Top manajemen memahami pentingnya keberadaan visi TI dan perannya dalam mencapai tujuan organisasi. ?\n'),
(3, 1, 'Apakah ada visi dan misi yang jelas untuk keselarasan TI-bisnis?\n'),
(4, 1, 'Apakah manajemen puncak menyediakan sumber daya yang diperlukan untuk mencapai keselarasan TI-bisnis, baik itu sumber daya manusia (Unit TI) dan dana?\n'),
(5, 1, 'Apakah terdapat strategi TI yang selaras dengan strategi bisnis?\n'),
(6, 2, 'Apakah komunikasi antara Unit TI dan  Unit bisnis berjalan dengan efektif?\n'),
(7, 2, 'Apakah Top Management Bisnis dan Top Management TI saling berdiskusi tentang isu-isu strategis TI.\n'),
(8, 2, 'Apakah terdapat kepercayaan dan kolaborasi yang kuat antara Unit TI dan Unit bisnis? Cth: Kehadiran top management TI dalam rapat bisnis \n'),
(9, 2, 'Apakah Unit TI dan Unit bisnis saling memahami kebutuhan satu sama lain?\n'),
(10, 2, 'Apakah Top management Bisnis memiliki keterlibatan yang besar terhadap Perencanaan TI?\n'),
(11, 2, 'Apakah terdapat proses yang jelas untuk menyelesaikan konflik antara Unit TI dan Uni Bisnis bisnis?\n'),
(12, 3, 'Apakah terdapat proses yang jelas untuk berbagi pengetahuan antara Unit TI dan Unit Bisnis?\n'),
(13, 3, 'Apakah Unit TI memiliki pemahaman dan pengatahuan terkait  operasional bisnis?\n'),
(14, 3, 'Apakah Unit bisnis memiliki pemahaman dan pengatahuan terkait teknologi informasi?\n'),
(15, 3, 'Apakah Unit TI memiliki pemahaman terkait tujuan bisnis?\n'),
(16, 3, 'Apakah Unit TI memiliki pemahaman terkait rencana strategis bisnis?\n'),
(17, 4, 'Apakah perencanaan TI dilakukan dengan melibatkan para pemangku kepentingan pada Unit Bisnis? (Dukungan Unit Bisnis)\n'),
(18, 4, 'Apakah Perencanaan TI telah selaras mendukung tujuan bisnis organisasi?\n'),
(19, 4, 'Apakah proyek TI yang diprioritaskan memiliki tujuan dan sasaran yang jelas sesuai kebutuhan organisasi?\n'),
(20, 4, 'Apakah inovasi TI telah meningkatkan efisiensi operasional bisnis?\n'),
(21, 4, 'Apakah Proyek TI diinisiasi(dibuat) berdasarkan kebutuhan bisnis yang jelas?'),
(22, 4, 'Apakah proyek TI dipantau dan dievaluasi secara teratur?'),
(23, 5, 'Apakah Perusahaan sering kali menjadi yang pertama dalam mengadopsi teknologi terbaru dibandingkan pesaing?'),
(24, 5, 'Apakah Unit TI terus berinovasi dalam hal memenuhi kebutuhan bisnis? (Unit TI mengembangkan berbagai produk atau layanan baru yang mampu mendukung bisnis maupun operasional perusahaan)'),
(25, 5, 'Apakah TI memenuhi kebutuhan pengguna serta memberikan nilai bagi bisnis?'),
(26, 5, 'Apakah TI membantu organisasi dalam mencapai tujuannya?'),
(27, 5, 'Apakah pengelolaan TI dilakukan dengan efisien dan efektif? (Menerapkan Tata Kelola TI)');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_project` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `user_id`, `nama_project`, `link`) VALUES
(4, 1, 'survey 1', '5e7ec69f8b0f4775ed310632b43c2092');

-- --------------------------------------------------------

--
-- Table structure for table `respondents`
--

CREATE TABLE `respondents` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `respondents`
--

INSERT INTO `respondents` (`id`, `nama`, `email`, `date`) VALUES
(1, 'alif', 'alif@gmail.com', '2024-10-13 18:38:31'),
(2, 'rena', 'rena@gmail.com', '2024-10-13 18:38:31'),
(3, 'kala', 'kala@gmail.com', '2024-10-13 18:38:31'),
(4, 'karina', 'karina@gmail.com', '2024-10-13 18:38:31'),
(5, 'maya', 'maya@gmail.com', '2024-10-13 18:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'auditor', 'auditor@gmail.com', '5cb59fe845b83231b0e5aa95d96267e9', 'auditor'),
(4, 'auditor2', 'auditor2@gmail.com', '5cb59fe845b83231b0e5aa95d96267e9', 'auditor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kuesioner`
--
ALTER TABLE `kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `respondents`
--
ALTER TABLE `respondents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `kuesioner`
--
ALTER TABLE `kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `respondents`
--
ALTER TABLE `respondents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
