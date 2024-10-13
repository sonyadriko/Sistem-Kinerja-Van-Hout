-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 08:24 AM
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
(1, 1, 1, 'Sangat Setuju'),
(2, 1, 2, 'Sangat Setuju'),
(3, 1, 3, 'Sangat Setuju'),
(4, 1, 4, 'Sangat Setuju'),
(5, 1, 5, 'Setuju'),
(6, 1, 6, 'Netral'),
(7, 1, 7, 'Setuju'),
(8, 1, 8, 'Netral'),
(9, 1, 9, 'Netral'),
(10, 1, 10, 'Netral'),
(11, 1, 11, 'Setuju'),
(12, 1, 12, 'Setuju'),
(13, 1, 13, 'Setuju'),
(14, 1, 14, 'Netral'),
(15, 1, 15, 'Setuju'),
(16, 1, 16, 'Netral'),
(17, 1, 17, 'Tidak Setuju'),
(18, 1, 18, 'Setuju'),
(19, 1, 19, 'Sangat Setuju'),
(20, 1, 20, 'Sangat Setuju'),
(21, 2, 1, 'Sangat Setuju'),
(22, 2, 2, 'Sangat Setuju'),
(23, 2, 3, 'Sangat Setuju'),
(24, 2, 4, 'Setuju'),
(25, 2, 5, 'Sangat Setuju'),
(26, 2, 6, 'Setuju'),
(27, 2, 7, 'Sangat Tidak Setuju'),
(28, 2, 8, 'Tidak Setuju'),
(29, 2, 9, 'Tidak Setuju'),
(30, 2, 10, 'Sangat Tidak Setuju'),
(31, 2, 11, 'Setuju'),
(32, 2, 12, 'Sangat Tidak Setuju'),
(33, 2, 13, 'Sangat Setuju'),
(34, 2, 14, 'Sangat Tidak Setuju'),
(35, 2, 15, 'Setuju'),
(36, 2, 16, 'Tidak Setuju'),
(37, 2, 17, 'Sangat Tidak Setuju'),
(38, 2, 18, 'Sangat Tidak Setuju'),
(39, 2, 19, 'Setuju'),
(40, 2, 20, 'Netral');

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
(1, 1, 'Apakah pimpinan berkomitmen untuk menggunakan nilai strategi TI?'),
(2, 1, 'Apakah pimpinan menyediakan sumber daya yang dibutuhkan untuk mencapai keselarasan TI-bisnis?'),
(3, 1, 'Apakah ada visi dan misi yang jelas untuk keselarasan TI-bisnis?'),
(4, 1, 'Apakah ada strategi TI yang sejalan dengan strategi bisnis? '),
(5, 2, 'Apakah komunikasi antara TI dan bisnis berjalan dengan efektif?'),
(6, 2, 'Apakah ada kepercayaan dan kolaborasi yang solid antara TI dan bisnis?'),
(7, 2, 'Apakah TI dan bisnis saling memahami kebutuhan satu sama lain?'),
(8, 2, 'Apakah ada proses yang jelas untuk menangani konflik antara TI dan bisnis?'),
(9, 3, 'Apakah ada kesepahaman yang sama antara TI dan bisnis mengenai strategi bisnis?'),
(10, 3, 'Apakah ada kesamaan pemahaman antara TI dan bisnis mengenai operasi bisnis?'),
(11, 3, 'Apakah ada kesamaan pemahaman antara TI dan bisnis mengenai teknologi informasi?'),
(12, 3, 'Apakah ada proses yang jelas untuk berbagi pengetahuan antara TI dan bisnis?'),
(13, 4, 'Apakah proyek TI sejalan dengan strategi bisnis?'),
(14, 4, 'Apakah perencanaan TI melibatkan pemangku kepentingan bisnis?'),
(15, 4, 'Apakah proyek TI memiliki tujuan dan sasaran yang terdefinisi dengan jelas?'),
(16, 4, 'Apakah proyek TI dipantau dan dievaluasi secara teratur?'),
(17, 5, 'Apakah nilai yang diberikan oleh TI untuk bisnis?'),
(18, 5, 'Apakah TI membantu organisasi dalam mencapai tujuan mereka?'),
(19, 5, 'Apakah kebutuhan pengguna terpenuhi oleh TI?'),
(20, 5, 'Apakah pengelolaan TI dilakukan dengan efisien dan efektif?');

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
(1, 'andre', 'andre@gmail.com', '2024-06-18 13:13:34'),
(2, 'farid', 'farid@gmail.com', '2024-06-18 13:14:36');

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
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kuesioner`
--
ALTER TABLE `kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `respondents`
--
ALTER TABLE `respondents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
