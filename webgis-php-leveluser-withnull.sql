-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.24 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk webgis-php
DROP DATABASE IF EXISTS `webgis-php`;
CREATE DATABASE IF NOT EXISTS `webgis-php` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `webgis-php`;

-- membuang struktur untuk table webgis-php.m_kecamatan
DROP TABLE IF EXISTS `m_kecamatan`;
CREATE TABLE IF NOT EXISTS `m_kecamatan` (
  `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kecamatan` varchar(10) DEFAULT NULL,
  `nm_kecamatan` varchar(30) DEFAULT NULL,
  `geojson_kecamatan` varchar(30) DEFAULT NULL,
  `warna_kecamatan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_kecamatan`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table webgis-php.pengguna
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pengguna` varchar(20) DEFAULT NULL,
  `kt_sandi` varchar(150) DEFAULT NULL,
  `level` enum('Admin','User') DEFAULT 'User',
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table webgis-php.t_hotspot
DROP TABLE IF EXISTS `t_hotspot`;
CREATE TABLE IF NOT EXISTS `t_hotspot` (
  `id_hotspot` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(11) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `lat` float(9,6) DEFAULT NULL,
  `lng` float(9,6) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `marker` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_hotspot`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
