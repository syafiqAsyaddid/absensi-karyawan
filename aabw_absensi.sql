-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 05:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aabw_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('Hadir','Izin','Alpha','Sakit') DEFAULT 'Alpha',
  `keterangan` text DEFAULT NULL,
  `bukti_izin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `tanggal`, `status`, `keterangan`, `bukti_izin`) VALUES
(6, 8, '2025-12-02', 'Hadir', NULL, NULL),
(7, 7, '2025-12-02', 'Izin', NULL, NULL),
(8, 6, '2025-12-02', 'Izin', NULL, NULL),
(9, 5, '2025-12-02', 'Alpha', NULL, NULL),
(10, 4, '2025-12-02', 'Alpha', NULL, NULL),
(11, 3, '2025-12-02', 'Hadir', NULL, NULL),
(15, 8, '2025-12-01', 'Izin', NULL, NULL),
(16, 7, '2025-12-01', 'Hadir', NULL, NULL),
(17, 6, '2025-12-01', 'Hadir', NULL, NULL),
(18, 5, '2025-12-01', 'Hadir', NULL, NULL),
(19, 4, '2025-12-01', 'Hadir', NULL, NULL),
(20, 3, '2025-12-01', 'Hadir', NULL, NULL),
(24, 8, '2024-12-01', 'Hadir', NULL, NULL),
(25, 7, '2024-12-01', 'Hadir', NULL, NULL),
(26, 6, '2024-12-01', 'Hadir', NULL, NULL),
(27, 5, '2024-12-01', 'Hadir', NULL, NULL),
(28, 4, '2024-12-01', 'Hadir', NULL, NULL),
(29, 3, '2024-12-01', 'Hadir', NULL, NULL),
(33, 8, '2024-12-02', 'Hadir', NULL, NULL),
(34, 7, '2024-12-02', 'Hadir', NULL, NULL),
(35, 6, '2024-12-02', 'Hadir', NULL, NULL),
(36, 5, '2024-12-02', 'Hadir', NULL, NULL),
(37, 4, '2024-12-02', 'Hadir', NULL, NULL),
(38, 3, '2024-12-02', 'Hadir', NULL, NULL),
(42, 8, '2024-12-03', 'Hadir', NULL, NULL),
(43, 7, '2024-12-03', 'Hadir', NULL, NULL),
(44, 6, '2024-12-03', 'Hadir', NULL, NULL),
(45, 5, '2024-12-03', 'Hadir', NULL, NULL),
(46, 4, '2024-12-03', 'Hadir', NULL, NULL),
(47, 3, '2024-12-03', 'Hadir', NULL, NULL),
(51, 8, '2024-12-04', 'Hadir', NULL, NULL),
(52, 7, '2024-12-04', 'Hadir', NULL, NULL),
(53, 6, '2024-12-04', 'Hadir', NULL, NULL),
(54, 5, '2024-12-04', 'Hadir', NULL, NULL),
(55, 4, '2024-12-04', 'Hadir', NULL, NULL),
(56, 3, '2024-12-04', 'Hadir', NULL, NULL),
(60, 8, '2024-12-05', 'Hadir', NULL, NULL),
(61, 7, '2024-12-05', 'Hadir', NULL, NULL),
(62, 6, '2024-12-05', 'Hadir', NULL, NULL),
(63, 5, '2024-12-05', 'Hadir', NULL, NULL),
(64, 4, '2024-12-05', 'Hadir', NULL, NULL),
(65, 3, '2024-12-05', 'Hadir', NULL, NULL),
(66, 18, '2025-12-02', 'Hadir', NULL, NULL),
(67, 18, '2025-12-01', 'Alpha', NULL, NULL),
(68, 18, '2025-11-30', 'Hadir', NULL, NULL),
(69, 8, '2025-11-30', 'Hadir', NULL, NULL),
(70, 7, '2025-11-30', 'Hadir', NULL, NULL),
(71, 6, '2025-11-30', 'Hadir', NULL, NULL),
(72, 5, '2025-11-30', 'Hadir', NULL, NULL),
(73, 4, '2025-11-30', 'Hadir', NULL, NULL),
(74, 3, '2025-11-30', 'Alpha', NULL, NULL),
(75, 18, '2025-11-29', 'Hadir', NULL, NULL),
(76, 8, '2025-11-29', 'Hadir', NULL, NULL),
(77, 7, '2025-11-29', 'Hadir', NULL, NULL),
(78, 6, '2025-11-29', 'Hadir', NULL, NULL),
(79, 5, '2025-11-29', 'Hadir', NULL, NULL),
(80, 4, '2025-11-29', 'Hadir', NULL, NULL),
(81, 3, '2025-11-29', 'Alpha', NULL, NULL),
(82, 18, '2025-11-28', 'Hadir', NULL, NULL),
(83, 8, '2025-11-28', 'Hadir', NULL, NULL),
(84, 7, '2025-11-28', 'Hadir', NULL, NULL),
(85, 6, '2025-11-28', 'Hadir', NULL, NULL),
(86, 5, '2025-11-28', 'Hadir', NULL, NULL),
(87, 4, '2025-11-28', 'Hadir', NULL, NULL),
(88, 3, '2025-11-28', 'Alpha', NULL, NULL),
(89, 18, '2025-11-27', 'Hadir', NULL, NULL),
(90, 8, '2025-11-27', 'Hadir', NULL, NULL),
(91, 7, '2025-11-27', 'Hadir', NULL, NULL),
(92, 6, '2025-11-27', 'Hadir', NULL, NULL),
(93, 5, '2025-11-27', 'Hadir', NULL, NULL),
(94, 4, '2025-11-27', 'Hadir', NULL, NULL),
(95, 3, '2025-11-27', 'Alpha', NULL, NULL),
(96, 18, '2025-11-26', 'Hadir', NULL, NULL),
(97, 8, '2025-11-26', 'Hadir', NULL, NULL),
(98, 7, '2025-11-26', 'Hadir', NULL, NULL),
(99, 6, '2025-11-26', 'Hadir', NULL, NULL),
(100, 5, '2025-11-26', 'Hadir', NULL, NULL),
(101, 4, '2025-11-26', 'Alpha', NULL, NULL),
(102, 3, '2025-11-26', 'Alpha', NULL, NULL),
(103, 18, '2025-11-25', 'Hadir', NULL, NULL),
(104, 8, '2025-11-25', 'Hadir', NULL, NULL),
(105, 7, '2025-11-25', 'Hadir', NULL, NULL),
(106, 6, '2025-11-25', 'Hadir', NULL, NULL),
(107, 5, '2025-11-25', 'Hadir', NULL, NULL),
(108, 4, '2025-11-25', 'Alpha', NULL, NULL),
(109, 3, '2025-11-25', 'Alpha', NULL, NULL),
(110, 18, '2025-11-24', 'Hadir', NULL, NULL),
(111, 8, '2025-11-24', 'Hadir', NULL, NULL),
(112, 7, '2025-11-24', 'Hadir', NULL, NULL),
(113, 6, '2025-11-24', 'Hadir', NULL, NULL),
(114, 5, '2025-11-24', 'Hadir', NULL, NULL),
(115, 4, '2025-11-24', 'Alpha', NULL, NULL),
(116, 3, '2025-11-24', 'Hadir', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `role` enum('admin','karyawan') DEFAULT 'karyawan',
  `jabatan` varchar(50) DEFAULT 'Staff',
  `gaji_pokok` decimal(15,2) DEFAULT 0.00,
  `jenis_kelamin` enum('L','P') DEFAULT 'L',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `alamat`, `role`, `jabatan`, `gaji_pokok`, `jenis_kelamin`, `created_at`) VALUES
(1, 'admin1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Akbar Admin', NULL, 'admin', 'HR Manager', 10000000.00, 'L', '2025-12-02 11:56:32'),
(3, 'karyawan1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', NULL, 'karyawan', 'Staff IT', 5000000.00, 'L', '2025-12-02 11:56:32'),
(4, 'karyawan2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ani Wijaya', NULL, 'karyawan', 'Marketing', 4500000.00, 'L', '2025-12-02 11:56:32'),
(5, 'karyawan3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Doni Tata', NULL, 'karyawan', 'Sales', 4000000.00, 'L', '2025-12-02 11:56:32'),
(6, 'karyawan4', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Eka Putri', NULL, 'karyawan', 'Admin', 3500000.00, 'L', '2025-12-02 11:56:32'),
(7, 'karyawan5', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fajar Nugraha', NULL, 'karyawan', 'Driver', 3000000.00, 'L', '2025-12-02 11:56:32'),
(8, 'karyawan6', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Gita Gutawa', NULL, 'karyawan', 'Staff HR', 4500000.00, 'L', '2025-12-02 11:56:32'),
(18, 'karyawan11', '$2y$10$JJ92.9yEK86ynvE/W4ZTiuU0lQJFW3IYL7NfBYu7OXXr3ONxFHzqS', 'Hadi Sucipto', '', 'karyawan', 'Security', 3000000.00, 'L', '2025-12-02 15:21:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
