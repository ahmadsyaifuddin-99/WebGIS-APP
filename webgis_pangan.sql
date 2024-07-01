-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2024 at 05:40 AM
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
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 6, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17);

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
(1, '63.04.04', 'Anjir Muara', 'anjir_muara.geojson', '27832', '#ff0000', 'Minggu/30/Jun/2024-17:21:43:pm'),
(2, '63.04.05', 'Alalak', 'alalak.geojson', '12918', '#00b344', 'Minggu/30/Jun/2024-17:22:25:pm'),
(3, '63.04.03', 'Anjir Pasar', 'anjir_pasar.geojson', '32762', '#ccaa00', 'Minggu/30/Jun/2024-17:22:28:pm'),
(4, '63.04.09', 'Cerbon', 'cerbon.geojson', '19810', '#b300ad', 'Minggu/30/Jun/2024-17:22:34:pm'),
(5, '63.04.06', 'Mandastana', 'mandastana.geojson', '19890', '#09d7d4', 'Minggu/30/Jun/2024-17:22:38:pm'),
(6, '63.04.15', 'Marabahan', 'marabahan.geojson', '14371', '#dbeb00', 'Minggu/30/Jun/2024-17:22:50:pm'),
(7, '63.04.11', 'Kuripan', 'kuripan.geojson', '920', '#b30036', 'Minggu/30/Jun/2024-17:22:54:pm'),
(8, '63.04.13', 'Mekarsari', 'mekarsari.geojson', '23005', '#700000', 'Minggu/30/Jun/2024-17:22:59:pm'),
(9, '63.04.01', 'Tabunganen', 'tabunganen.geojson', '45189', '#853c00', 'Minggu/30/Jun/2024-17:23:02:pm'),
(10, '63.04.16', 'Wanaraya', 'wanaraya.geojson', '10945', '#9e007c', 'Minggu/30/Jun/2024-17:23:06:pm'),
(11, '63.04.02', 'Tamban', 'tamban.geojson', '28352', '#00209e', 'Minggu/30/Jun/2024-17:23:21:pm'),
(12, '63.04.17', 'Jejangkit', 'jejangkit.geojson', '15354', '#609a6c', 'Minggu/30/Jun/2024-17:23:26:pm'),
(13, '63.04.14', 'Barambai', 'barambai.geojson', '30076', '#cc5c00', 'Minggu/30/Jun/2024-17:23:31:pm'),
(14, '63.04.10', 'Bakumpai', 'bakumpai.geojson', '17543', '#32bd00', 'Minggu/30/Jun/2024-17:23:36:pm'),
(15, '63.04.08', 'Belawang', 'belawang.geojson', '20888', '#f39c12', 'Minggu/30/Jun/2024-17:23:40:pm'),
(16, '63.04.07', 'Rantau Badauh', 'rantau_badauh.geojson', '28166', '#76056c', 'Minggu/30/Jun/2024-17:23:45:pm'),
(17, '63.04.12', 'Tabukan', 'tabukan.geojson', '21310', '#fa009e', 'Minggu/30/Jun/2024-17:23:49:pm');

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
(1, 'Ahmad S', 'ahmad1234', 'Super Admin'),
(2, 'Asai', 'asai1234', 'Administrator'),
(3, 'Kepala 1', 'kepala123', 'Kepala');

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
(1, 1, 'Handil Ketapi', 'Area Persawahan Padi', -3.181765, 114.535378, '2024-06-21 11:50:00', 'marker-wheat-agriculture.png', 1),
(2, 2, 'Beringin', 'Area Persawahan Padi', -3.213542, 114.590668, '2024-06-21 11:50:00', 'marker-wheat-agriculture.png', 1),
(3, 3, 'Jl. Handil Tura', 'Persawahan', -3.144277, 114.507034, '2024-06-21 11:50:00', 'marker-wheat-agriculture.png', 1),
(4, 4, 'Jl. H. M. Yunus, Sungai Tunjang', 'Persawahan', -3.037122, 114.760033, '2024-06-21 11:56:00', 'marker-wheat-agriculture.png', 1),
(5, 5, 'Bangkit Baru', 'Persawahan', -3.202346, 114.662781, '2024-06-21 11:58:00', 'marker-wheat-agriculture.png', 1),
(6, 6, 'Ulu Benteng', 'Persawahan', -2.971786, 114.742188, '2024-06-21 12:01:00', 'marker-wheat-agriculture.png', 1),
(7, 7, 'Rimbun Tulang', 'Persawahan', -2.618699, 114.804405, '2024-06-21 12:07:00', 'marker-wheat-agriculture.png', 1),
(8, 8, 'Tamban Raya Baru', 'Persawahan', -3.280238, 114.440643, '2024-06-21 12:10:00', 'marker-wheat-agriculture.png', 1),
(9, 9, 'Kuala Lupak', 'Persawahan', -3.462666, 114.395248, '2024-06-21 12:13:00', 'marker-wheat-agriculture.png', 1),
(10, 10, 'Sido Mulyo', 'Persawahan', -3.061239, 114.143570, '2024-06-25 08:28:00', 'marker-wheat-agriculture.png', 1),
(11, 11, 'Sekata Baru', 'Persawahan', -3.361472, 114.376724, '2024-06-21 12:16:00', 'marker-wheat-agriculture.png', 1),
(12, 12, 'Sampurna', 'Persawahan', -3.195798, 114.725159, '2024-06-21 12:18:00', 'marker-wheat-agriculture.png', 1),
(13, 13, 'Karya Baru', 'Persawahan', -3.002637, 114.650368, '2024-06-21 12:27:00', 'marker-wheat-agriculture.png', 1),
(14, 14, 'Murung Raya', 'Persawahan', -2.959078, 114.782211, '2024-06-21 12:29:00', 'marker-wheat-agriculture.png', 1),
(15, 15, 'Rangga Surya', 'Persawahan', -3.172132, 114.623138, '2024-06-21 12:30:00', 'marker-wheat-agriculture.png', 1),
(16, 16, 'Sungai Gampa Asahi', 'Persawahan', -3.110638, 114.705978, '2024-06-21 12:30:00', 'marker-wheat-agriculture.png', 1),
(17, 17, 'Karya Jadi', 'Persawahan', -2.870246, 114.650154, '2024-06-21 12:32:00', 'marker-wheat-agriculture.png', 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  MODIFY `id_kecamatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_pangan`
--
ALTER TABLE `t_pangan`
  MODIFY `id_Pangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
