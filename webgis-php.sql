-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2020 at 01:36 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgis-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_kecamatan`
--

CREATE TABLE `m_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `kd_kecamatan` varchar(10) NOT NULL,
  `nm_kecamatan` varchar(30) NOT NULL,
  `geojson_kecamatan` varchar(30) NOT NULL,
  `warna_kecamatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kecamatan`
--

INSERT INTO `m_kecamatan` (`id_kecamatan`, `kd_kecamatan`, `nm_kecamatan`, `geojson_kecamatan`, `warna_kecamatan`) VALUES
(6, '63.01.08', 'Tambang Ulang', '28061219081242.geojson', '#009900'),
(8, '63.01.01', 'Takisung', '25061219081252.geojson', '#007700'),
(16, '63.01.05', 'Bati-Bati', '71061219081303.geojson', '#880000'),
(17, '63.01.02', 'Jorong', '34061219081408.geojson', '#000099'),
(18, '63.01.03', 'Pelaihari', '39061219081421.geojson', '#DD9900'),
(19, '63.01.04', 'Kurau', '30061219081442.geojson', '#009999'),
(20, '63.01.07', 'Kintap', '29061219081511.geojson', '#ff0099'),
(21, '63.01.09', 'Batu Ampar', '44061219081535.geojson', '#990099'),
(22, '63.01.10', 'Bajuin', '92061219081549.geojson', '#662222'),
(23, '63.01.11', 'Bumi Makmur', '58061219081604.geojson', '#888'),
(24, '63.01.06', 'Panyipatan', '100061219081653.geojson', '#222');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nm_pengguna` varchar(20) NOT NULL,
  `kt_sandi` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nm_pengguna`, `kt_sandi`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `t_hotspot`
--

CREATE TABLE `t_hotspot` (
  `id_hotspot` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `lat` float(9,6) NOT NULL,
  `lng` float(9,6) NOT NULL,
  `tanggal` date NOT NULL,
  `marker` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_hotspot`
--

INSERT INTO `t_hotspot` (`id_hotspot`, `id_kecamatan`, `lokasi`, `keterangan`, `lat`, `lng`, `tanggal`, `marker`) VALUES
(1, 18, 'Jl. Peganggas gas amat', 'Kebakaran Parah sekali', -3.641010, 114.775002, '2019-12-19', '35281219011541.png'),
(2, 6, 'Jl. Pegangga', 'Kebakaran Parah sekali', -3.656000, 114.775002, '2019-12-19', ''),
(3, 18, 'Jl. Raya', 'Rusak parah', -3.816298, 114.797401, '2019-12-20', '7281219011755.png'),
(4, 18, 'Jl A', 'Rusak parah', -3.817160, 114.800987, '2019-12-20', ''),
(5, 19, 'Jl. Sepeda', '-', -3.641010, 114.675003, '2020-01-20', ''),
(6, 6, 'Rumah Saiful', '-', -3.661010, 114.775002, '2020-01-20', ''),
(7, 21, 'Rmah Jakaria', '-', -3.846298, 114.897400, '2020-01-20', ''),
(8, 22, 'HUtan Rawa Merawa', '-', -3.761010, 114.857399, '2020-01-20', '91200120113957.png'),
(9, 18, 'Gang Jambu', 'Rumah Terbakar', -3.817130, 114.801888, '2020-02-11', ''),
(10, 6, 'Rumah Zakaria', 'Kompor Meledak', -3.657300, 114.766006, '2020-02-11', ''),
(11, 6, 'Gedung Pencakar', 'Lantai 4 terbakar', -3.655300, 114.696503, '2020-02-11', ''),
(12, 6, 'Pasar Kaki Lima', '4 Loket terbakar', -3.655300, 114.686501, '2020-02-11', ''),
(13, 6, 'Pasar 5', 'Terbakar habis', -3.685300, 114.776009, '2020-02-11', '');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `t_hotspot`
--
ALTER TABLE `t_hotspot`
  ADD PRIMARY KEY (`id_hotspot`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_hotspot`
--
ALTER TABLE `t_hotspot`
  MODIFY `id_hotspot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
