-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 07:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_maut`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_nilai`
--

CREATE TABLE `bobot_nilai` (
  `kode_bobot` int(4) NOT NULL,
  `b_nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `n_bobot` int(10) DEFAULT NULL,
  `kode_kriteria` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bobot_nilai`
--

INSERT INTO `bobot_nilai` (`kode_bobot`, `b_nama`, `n_bobot`, `kode_kriteria`) VALUES
(1, 'Kurang', 0, 'C1'),
(2, 'Cukup', 1, 'C1'),
(3, 'Baik', 2, 'C1'),
(4, 'Kurang', 0, 'C2'),
(5, 'Cukup', 1, 'C2'),
(6, 'Baik', 2, 'C2'),
(7, 'Kurang', 0, 'C3'),
(8, 'Cukup', 1, 'C3'),
(9, 'Baik', 2, 'C3'),
(10, 'Kurang', 0, 'C4'),
(11, 'Cukup', 1, 'C4'),
(12, 'Baik', 2, 'C4'),
(13, 'Kurang', 0, 'C5'),
(14, 'Cukup', 1, 'C5'),
(15, 'Baik', 2, 'C5'),
(16, 'Kurang', 0, 'C6'),
(17, 'Cukup', 1, 'C6'),
(18, 'Baik', 2, 'C6'),
(19, 'Kurang', 0, 'C7'),
(20, 'Cukup', 1, 'C7'),
(21, 'Baik', 2, 'C7');

-- --------------------------------------------------------

--
-- Table structure for table `dt_penduduk`
--

CREATE TABLE `dt_penduduk` (
  `id_penduduk` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_penduduk`
--

INSERT INTO `dt_penduduk` (`id_penduduk`, `nama`, `alamat`) VALUES
(1, ' WAODE MARLINA', 'DESA KAMPANI DUSUN 01 RT 01'),
(2, 'WAODE IBI', 'RT 01 DUSUN 01 DESA KAMPANI'),
(3, 'WAODE DARSIA', 'RT 02 DUSUN 02 DESA KAMPANI'),
(4, 'WAODE NDOBARA', 'RT 01 DUSUN 01 DESA KAMPANI'),
(5, 'IDA ROYANI', 'RT 02 DUSUN 02 DESA KAMPANI'),
(6, 'DARNIA', 'RT 01 DUSUN 01 DESA KAMPANI'),
(7, 'WAODE SALINA', 'RT 02 DUSUN 02 DESA KAMPANI'),
(8, 'WA SURIANI', 'RT 02 DUSUN 02 DESA KAMPANI'),
(9, 'SUFIANA', 'RT 01 DUSUN 01 DESA KAMPANI'),
(10, 'WAODE HAMINI', 'RT 02 DUSUN 02 DESA KAMPANI'),
(11, 'HARIATI', 'RT 01 DUSUN 01 DESA KAMPANI');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(4) NOT NULL,
  `id_penduduk` int(10) NOT NULL,
  `nilai` decimal(5,1) NOT NULL,
  `n_komponen` decimal(6,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_penduduk`, `nilai`, `n_komponen`) VALUES
(1, 1, '0.0', '0.0'),
(2, 2, '0.2', '0.0'),
(3, 3, '0.0', '0.0'),
(4, 4, '0.0', '0.0'),
(5, 5, '0.0', '0.0'),
(6, 6, '0.0', '0.0'),
(7, 7, '0.0', '0.0'),
(8, 8, '0.0', '0.0'),
(9, 9, '0.0', '0.0'),
(10, 10, '0.0', '0.0'),
(11, 11, '0.0', '0.0');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` varchar(15) NOT NULL DEFAULT '0',
  `k_nama` varchar(50) DEFAULT NULL,
  `k_komponen` text NOT NULL,
  `k_bobot` decimal(6,1) UNSIGNED DEFAULT NULL,
  `tot_bobot` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `k_nama`, `k_komponen`, `k_bobot`, `tot_bobot`) VALUES
('C1', 'Jumlah Anak SD', 'Pendidikan', '0.2', 0),
('C2', 'Jumlah Anak SMP', 'Pendidikan', '0.2', 0),
('C3', 'Jumlah Anak SMA', 'Pendidikan', '0.2', 0),
('C4', 'Jumlah Ibu Hamil', 'Kesehatan', '0.2', 0),
('C5', 'Jumlah Anak Usia Dini', 'Kesehatan', '0.2', 0),
('C6', 'Jumlah Lansia', 'Kesejahteraan Sosial', '0.2', 0),
('C7', 'Jumlah Disabilitas', 'Kesejahteraan Sosial', '0.2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_nilai` int(15) UNSIGNED NOT NULL,
  `id_penduduk` int(10) NOT NULL,
  `kode_kriteria` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `kode_bobot` int(4) DEFAULT NULL,
  `nilai` int(10) DEFAULT NULL,
  `min` int(5) UNSIGNED NOT NULL,
  `max` int(5) UNSIGNED NOT NULL,
  `nilai1` decimal(5,1) UNSIGNED NOT NULL,
  `nilai2` decimal(6,1) NOT NULL,
  `nilai3` decimal(6,1) NOT NULL,
  `n_komponen` decimal(6,1) NOT NULL,
  `n_komponen2` decimal(6,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_nilai`, `id_penduduk`, `kode_kriteria`, `kode_bobot`, `nilai`, `min`, `max`, `nilai1`, `nilai2`, `nilai3`, `n_komponen`, `n_komponen2`) VALUES
(1, 1, 'C7', NULL, 0, 0, 0, '0.0', '0.0', '0.0', '0.0', '0.0'),
(2, 1, 'C6', NULL, 0, 0, 0, '0.0', '0.0', '0.0', '0.0', '0.0'),
(3, 1, 'C5', NULL, 0, 0, 0, '0.0', '0.0', '0.0', '0.0', '0.0'),
(4, 1, 'C4', NULL, 0, 0, 0, '0.0', '0.0', '0.0', '0.0', '0.0'),
(5, 1, 'C3', NULL, 0, 0, 1, '0.0', '0.0', '0.0', '0.0', '0.0'),
(6, 1, 'C2', 5, 1, 1, 1, '0.0', '0.0', '0.0', '0.0', '0.0'),
(7, 1, 'C1', 2, 1, 1, 1, '0.0', '0.0', '0.0', '0.0', '0.0'),
(8, 2, 'C7', NULL, 0, 0, 0, '0.0', '0.0', '0.2', '0.0', '0.0'),
(9, 2, 'C6', NULL, 0, 0, 0, '0.0', '0.0', '0.2', '0.0', '0.0'),
(10, 2, 'C5', NULL, 0, 0, 0, '0.0', '0.0', '0.2', '0.0', '0.0'),
(11, 2, 'C4', NULL, 0, 0, 0, '0.0', '0.0', '0.2', '0.0', '0.0'),
(12, 2, 'C3', 8, 1, 0, 1, '1.0', '0.2', '0.2', '1.0', '0.2'),
(13, 2, 'C2', 5, 1, 1, 1, '0.0', '0.0', '0.2', '0.0', '0.0'),
(14, 2, 'C1', 2, 1, 1, 1, '0.0', '0.0', '0.2', '0.0', '0.0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `akses` enum('master','ppsb') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `akses`) VALUES
('admin', 'admin', 'admin', 'master');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_nilai`
--
ALTER TABLE `bobot_nilai`
  ADD PRIMARY KEY (`kode_bobot`);

--
-- Indexes for table `dt_penduduk`
--
ALTER TABLE `dt_penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `nik` (`id_penduduk`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nik` (`id_penduduk`,`kode_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot_nilai`
--
ALTER TABLE `bobot_nilai`
  MODIFY `kode_bobot` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `dt_penduduk`
--
ALTER TABLE `dt_penduduk`
  MODIFY `id_penduduk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_nilai` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
