-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2024 at 11:01 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgis_pangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_entries`
--

CREATE TABLE `data_entries` (
  `id` int NOT NULL,
  `id_pengguna` int DEFAULT NULL,
  `id_kecamatan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_entries`
--

INSERT INTO `data_entries` (`id`, `id_pengguna`, `id_kecamatan`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `m_kecamatan`
--

CREATE TABLE `m_kecamatan` (
  `id_kecamatan` int NOT NULL,
  `kd_kecamatan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nm_kecamatan` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `geojson_kecamatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jml_pangan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `warna_kecamatan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_isi` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_kecamatan`
--

INSERT INTO `m_kecamatan` (`id_kecamatan`, `kd_kecamatan`, `nm_kecamatan`, `geojson_kecamatan`, `jml_pangan`, `warna_kecamatan`, `tgl_isi`) VALUES
(1, '63.04.04', 'Anjir Muara', 'anjir_muara.geojson', '27832', '#ff0000', 'Sunday/16/Jun/2024-15:23:10:pm'),
(2, '63.04.05', 'Alalak', 'alalak.geojson', '12918', '#00b344', 'Sunday/16/Jun/2024-15:23:19:pm'),
(3, '63.04.03', 'Anjir Pasar', 'anjir_pasar.geojson', '32762', '#ccaa00', 'Sunday/16/Jun/2024-15:23:28:pm'),
(4, '63.04.09', 'Cerbon', 'cerbon.geojson', '19810', '#b300ad', 'Sunday/16/Jun/2024-15:23:38:pm'),
(5, '63.04.06', 'Mandastana', 'mandastana.geojson', '19890', '#09d7d4', 'Sunday/16/Jun/2024-15:23:58:pm'),
(6, '63.04.15', 'Marabahan', 'marabahan.geojson', '14371', '#dbeb00', 'Sunday/16/Jun/2024-15:24:06:pm');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nm_pengguna` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `kt_sandi` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('Super Admin','Administrator','Kepala') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nm_pengguna`, `kt_sandi`, `level`) VALUES
(1, 'Ahmad S', 'ahmad123', 'Administrator'),
(2, 'Gita', '123', 'Administrator'),
(3, 'Zakki', '123', 'Administrator'),
(4, 'Hambali', '123', 'Administrator'),
(5, 'Test', '123', 'Kepala'),
(6, 'Asai', 'asai123', 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `t_pangan`
--

CREATE TABLE `t_pangan` (
  `id_Pangan` int NOT NULL,
  `id_kecamatan` int NOT NULL,
  `lokasi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lat` float(9,6) NOT NULL,
  `lng` float(9,6) NOT NULL,
  `tanggal` datetime NOT NULL,
  `marker` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pengguna` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pangan`
--

INSERT INTO `t_pangan` (`id_Pangan`, `id_kecamatan`, `lokasi`, `keterangan`, `lat`, `lng`, `tanggal`, `marker`, `id_pengguna`) VALUES
(1, 1, 'Handil Ketapi', 'Area Persawahan Padi', -3.181765, 114.535378, '2024-06-17 22:23:00', 'marker.png', 6),
(2, 2, 'Beringin', 'Area Persawahan Padi', -3.213542, 114.590668, '2024-06-17 22:33:00', 'marker-purple.png', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_entries`
--
ALTER TABLE `data_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `t_pangan`
--
ALTER TABLE `t_pangan`
  ADD PRIMARY KEY (`id_Pangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_entries`
--
ALTER TABLE `data_entries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  MODIFY `id_kecamatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_pangan`
--
ALTER TABLE `t_pangan`
  MODIFY `id_Pangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
