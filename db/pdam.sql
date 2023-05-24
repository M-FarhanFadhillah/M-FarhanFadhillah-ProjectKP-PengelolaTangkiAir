-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2023 at 02:37 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int NOT NULL,
  `quantity` varchar(15) NOT NULL,
  `id_kategori` varchar(5) NOT NULL,
  `id_radius` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `harga`, `quantity`, `id_kategori`, `id_radius`) VALUES
('TNK01', 'Tangki Sosial A', 85000, '20', 'KTG01', 'RDS01'),
('TNK02', 'Tangki Sosial B', 95000, '20', 'KTG01', 'RDS02'),
('TNK03', 'Tangki Sosial C', 110000, '20', 'KTG01', 'RDS03'),
('TNK04', 'Tangki Sosial D', 120000, '20', 'KTG01', 'RDS04'),
('TNK05', 'Tangki Sosial E', 130000, '20', 'KTG01', 'RDS05'),
('TNK06', 'Tangki Sosial F', 140000, '20', 'KTG01', 'RDS06'),
('TNK07', 'Tangki Rumah Tangga A', 90000, '20', 'KTG02', 'RDS01'),
('TNK08', 'Tangki Rumah Tangga B', 110000, '20', 'KTG02', 'RDS02'),
('TNK09', 'Tangki Rumah Tangga C', 135000, '20', 'KTG02', 'RDS03'),
('TNK10', 'Tangki Rumah Tangga D', 150000, '20', 'KTG02', 'RDS04'),
('TNK11', 'Tangki Rumah Tangga E', 160000, '20', 'KTG02', 'RDS05'),
('TNK12', 'Tangki Rumah Tangga F', 170000, '20', 'KTG02', 'RDS06'),
('TNK13', 'Tangki Niaga Kecil A', 110000, '20', 'KTG03', 'RDS01'),
('TNK14', 'Tangki Niaga Kecil B', 125000, '20', 'KTG03', 'RDS02'),
('TNK15', 'Tangki Niaga Kecil C', 135000, '20', 'KTG03', 'RDS03'),
('TNK16', 'Tangki Niaga Kecil D', 150000, '20', 'KTG03', 'RDS04'),
('TNK17', 'Tangki Niaga Kecil E', 160000, '20', 'KTG03', 'RDS05'),
('TNK18', 'Tangki Niaga Kecil F', 170000, '20', 'KTG03', 'RDS06'),
('TNK19', 'Industri A', 120000, '20', 'KTG04', 'RDS01'),
('TNK20', 'Industri B', 135000, '20', 'KTG04', 'RDS02'),
('TNK21', 'Industri C', 150000, '20', 'KTG04', 'RDS03'),
('TNK22', 'Industri D', 170000, '20', 'KTG04', 'RDS04'),
('TNK23', 'Industri E', 180000, '20', 'KTG04', 'RDS05'),
('TNK24', 'Industri F', 20, '20', 'KTG04', 'RDS06');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengiriman`
--

CREATE TABLE `detail_pengiriman` (
  `id_detail` int NOT NULL,
  `id_pengiriman` varchar(25) NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pengiriman`
--

INSERT INTO `detail_pengiriman` (`id_detail`, `id_pengiriman`, `id_barang`, `qty`) VALUES
(67, '02_SPL_00_I_2023', 'TNK01', 1),
(68, '03_SPL_00_I_2023', 'TNK03', 3),
(69, '03_SPL_00_I_2023', 'TNK02', 1),
(73, '05_SPL_00_I_2023', 'TNK05', 8),
(78, '06_SPL_00_I_2023', 'TNK05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
('KTG01', 'Sosial'),
('KTG02', 'Rumah Tangga'),
('KTG03', 'Niaga Kecil'),
('KTG04', 'Industri');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `nama`, `jenis_kelamin`, `telepon`, `alamat`, `password`) VALUES
('KRR01', 'M. Fachru Syahputra', 'Laki-Laki', '082278573936', 'Wisma Andini', 'ee9cc68e583241dcb548e4217d8c8eb9');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(7) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `telepon`, `alamat`) VALUES
('CST0001', 'M. FARHAN FADHILLAH', '082217703265', 'Pramuka Garden Residence, Blok K.15'),
('CST0002', 'Muhammad Faiz', '082182091941', 'Gedong Aer'),
('CST0003', 'Ervan Chodry', '0812359268', 'Lampung Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pelanggan` varchar(7) NOT NULL,
  `id_kurir` varchar(5) NOT NULL,
  `no_kendaraan` varchar(10) CHARACTER SET latin1 NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `penerima` varchar(50) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `tanggal`, `id_pelanggan`, `id_kurir`, `no_kendaraan`, `keterangan`, `penerima`, `photo`, `status`) VALUES
('02_SPL_00_I_2023', '2023-03-08', 'CST0001', 'KRR01', 'AB 1234 RE', NULL, NULL, NULL, 2),
('03_SPL_00_I_2023', '2023-03-08', 'CST0003', 'KRR01', 'BE 2651 OF', NULL, NULL, NULL, 2),
('05_SPL_00_I_2023', '2023-03-08', 'CST0002', 'KRR01', 'B 1111 AD', '', '', NULL, 2),
('06_SPL_00_I_2023', '2023-03-08', 'CST0001', 'KRR01', 'B 1111 AD', 'aaa', 'JOY', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `radius`
--

CREATE TABLE `radius` (
  `id_radius` varchar(50) CHARACTER SET latin1 NOT NULL,
  `radius` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radius`
--

INSERT INTO `radius` (`id_radius`, `radius`) VALUES
('RDS01', 'Radius - A'),
('RDS02', 'Radius - B'),
('RDS03', 'Radius - C'),
('RDS04', 'Radius - D'),
('RDS05', 'Radius - E'),
('RDS06', 'Radius - F');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
('USR01', 'admin', '1a1dc91c907325c69271ddf0c944bc72', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_kategori` (`id_kategori`);

--
-- Indexes for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_id_pengiriman` (`id_pengiriman`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `radius`
--
ALTER TABLE `radius`
  ADD PRIMARY KEY (`id_radius`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pengiriman`
--
  ADD CONSTRAINT `fk_id_pengiriman` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
