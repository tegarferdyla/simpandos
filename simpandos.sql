-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2018 at 11:04 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpandos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(7) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`) VALUES
('AD00001', 'admin', 'df70d98996977a7b6f8dcf37c3265a38', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `id_file` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `id_paket` varchar(7) NOT NULL,
  `id_subdok` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`id_file`, `nama_file`, `id_paket`, `id_subdok`) VALUES
(1, '2014-Paket 2 Kontraktual Pembangunan-Ketentuan-Sertifikat-TA.pdf', 'PKT0003', 'SUB0001'),
(2, '2014-Paket 2 Kontraktual Pembangunan-Kurikulum_2017_Reguler_1_tegar.docx', 'PKT0003', 'SUB0001'),
(3, '2014-Paket 2 Kontraktual Pembangunan-1.jpg', 'PKT0003', 'SUB0002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis`
--

CREATE TABLE `tbl_jenis` (
  `id_jenis` varchar(7) NOT NULL,
  `main_jenis` varchar(25) NOT NULL,
  `sub_jenis` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis`
--

INSERT INTO `tbl_jenis` (`id_jenis`, `main_jenis`, `sub_jenis`, `keterangan`) VALUES
('JNS0002', 'Kontraktual', 'Pembangunan', 'Jenis Paket Kontraktual Sub Paket Pembangunan'),
('JNS0003', 'Kontraktual', 'Perencanaan Teknis', 'Jenis Paket Kontraktual Sub Jenis Perencanaan'),
('JNS0004', 'Kontraktual', 'Pengadaan Alat Berat', 'Jenis Paket Kontraktual Sub Pengadaan Alat Berat'),
('JNS0005', 'Swakelola', '', 'Jenis Paket Swakelola');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kepaladok`
--

CREATE TABLE `tbl_kepaladok` (
  `id_kepaladok` varchar(7) NOT NULL,
  `nama_kepala` varchar(50) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `id_jenis` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kepaladok`
--

INSERT INTO `tbl_kepaladok` (`id_kepaladok`, `nama_kepala`, `kategori`, `id_jenis`) VALUES
('KPL0001', 'Readiness Criteria', 'Dokumen Utama', 'JNS0002'),
('KPL0002', 'Kontrak', 'Dokumen Utama', 'JNS0002'),
('KPL0003', 'BMN', 'Dokumen Pendukung', ''),
('KPL0004', 'MC0', 'Dokumen Utama', 'JNS0002'),
('KPL0005', 'Hasil Klarifikasi Pasca MC0', 'Dokumen Utama', 'JNS0002'),
('KPL0006', 'Addendum II', 'Dokumen Utama', 'JNS0002'),
('KPL0007', 'Addendum III', 'Dokumen Utama', 'JNS0002'),
('KPL0008', 'Addendum IV', 'Dokumen Utama', 'JNS0002'),
('KPL0009', 'Addendum V', 'Dokumen Utama', 'JNS0002'),
('KPL0010', 'Laporan', 'Dokumen Utama', 'JNS0002'),
('KPL0011', 'Uji Kualitas Konstruksi', 'Dokumen Utama', 'JNS0002'),
('KPL0012', 'Show Cause Meeting (SCM)', 'Dokumen Utama', 'JNS0002'),
('KPL0013', 'Provosional Hand Over (PHO)', 'Dokumen Utama', 'JNS0002'),
('KPL0014', 'Final Hand Over', 'Dokumen Utama', 'JNS0002'),
('KPL0015', 'Dokumentasi', 'Dokumen Utama', 'JNS0002'),
('KPL0016', 'Konsultan', 'Dokumen Utama', 'JNS0003'),
('KPL0017', 'Keuangan', 'Dokumen Pendukung', ''),
('KPL0018', 'Bendahara', 'Dokumen Pendukung', ''),
('KPL0019', 'Pengadaan Alat Berat', 'Dokumen Utama', 'JNS0004'),
('KPL0020', 'Laporan Swakelola', 'Dokumen Utama', 'JNS0005');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `id_paket` varchar(7) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `id_jenis` varchar(7) NOT NULL,
  `id_tahun` varchar(7) NOT NULL,
  `id_ppk` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_paket`
--

INSERT INTO `tbl_paket` (`id_paket`, `nama_paket`, `deskripsi`, `input_by`, `id_jenis`, `id_tahun`, `id_ppk`) VALUES
('PKT0001', 'Paket Tester', 'Tester Paket 1', 'User PPK 1', 'JNS0002', 'THN0003', 'PPK0002'),
('PKT0002', 'Paket Swakelola Tester', 'Teseter paket swakelolaa 2014', 'User PPK 1', 'JNS0005', 'THN0003', 'PPK0002'),
('PKT0003', 'Paket 2 Kontraktual Pembangunan', 'Paket Pembangunan 2', 'User PPK 1', 'JNS0002', 'THN0003', 'PPK0002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ppk`
--

CREATE TABLE `tbl_ppk` (
  `id_ppk` varchar(7) NOT NULL,
  `nama_ppk` varchar(35) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ppk`
--

INSERT INTO `tbl_ppk` (`id_ppk`, `nama_ppk`, `keterangan`) VALUES
('PPK0002', 'Tester Panjang Gelar nye', 'PPK Tester Panjang Banget 2'),
('PPK0003', 'PPK Tester Ke 2', 'PPK Tester Ke 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subdok`
--

CREATE TABLE `tbl_subdok` (
  `id_subdok` varchar(7) NOT NULL,
  `sub_dokumen` varchar(100) NOT NULL,
  `id_kepaladok` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subdok`
--

INSERT INTO `tbl_subdok` (`id_subdok`, `sub_dokumen`, `id_kepaladok`) VALUES
('SUB0001', 'Surat Minat Daerah', 'KPL0001'),
('SUB0002', 'Surat Menerima Hibah', 'KPL0001'),
('SUB0003', 'Surat Kesiapan Lahan', 'KPL0001'),
('SUB0004', 'Kesepakatan Bersama', 'KPL0001'),
('SUB0005', 'Perjanjian Kerjasama (PKS)', 'KPL0001'),
('SUB0006', 'Surat Kuasa', 'KPL0001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun`
--

CREATE TABLE `tbl_tahun` (
  `id_tahun` varchar(7) NOT NULL,
  `nama_tahun` varchar(5) NOT NULL,
  `deskripsi` text NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `id_ppk` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tahun`
--

INSERT INTO `tbl_tahun` (`id_tahun`, `nama_tahun`, `deskripsi`, `input_by`, `id_ppk`) VALUES
('THN0001', '2015', 'Tahun 2015', 'User PPK 1', 'PPK0002'),
('THN0003', '2014', 'Tahun 2014', 'User PPK 1', 'PPK0002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(7) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `bagian` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `id_ppk` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nip`, `nama_user`, `bagian`, `email`, `alamat`, `foto`, `id_ppk`) VALUES
('USR0002', 'testerbmncuy', 'f5279d632b07f593605ea4637183ceb4', '1234567890290836', 'BMN', 'BMN', 'tegarferdyla@gmail.com', 'asdasd', 'default-avatar.jpg', ''),
('USR0003', 'userspmcuy', '8ea66a816217f5cedb3ee1e791c94d03', '5214124789632145', 'SPM Cuy', 'SPM', 'tegarferdyla@gmail.com', 'Alamat', 'default-avatar.jpg', ''),
('USR0004', 'bendaharacuy', '9605c5a3c8bdbc939ff9dfc4461ff7ac', '5214213214567854', 'Bendahara nih', 'Bendahara', 'tegarferdyla@gmail.com', 'Pejompongan', 'default-avatar.jpg', ''),
('USR0005', 'userppk1', 'df70d98996977a7b6f8dcf37c3265a38', '4152132145678541', 'User PPK 1', 'PPK', 'tegarferdyla@gmail.com', 'Pejompongan', 'default-avatar.jpg', 'PPK0002'),
('USR0006', 'userppk2', 'df70d98996977a7b6f8dcf37c3265a38', '1234567890567894', 'User PPK 2', 'PPK', 'tegarferdyla@gmaili.com', 'Pejompongan', 'default-avatar.jpg', 'PPK0003');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tbl_kepaladok`
--
ALTER TABLE `tbl_kepaladok`
  ADD PRIMARY KEY (`id_kepaladok`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_tahun` (`id_tahun`),
  ADD KEY `id_ppk` (`id_ppk`);

--
-- Indexes for table `tbl_ppk`
--
ALTER TABLE `tbl_ppk`
  ADD PRIMARY KEY (`id_ppk`);

--
-- Indexes for table `tbl_subdok`
--
ALTER TABLE `tbl_subdok`
  ADD PRIMARY KEY (`id_subdok`);

--
-- Indexes for table `tbl_tahun`
--
ALTER TABLE `tbl_tahun`
  ADD PRIMARY KEY (`id_tahun`),
  ADD KEY `id_ppk` (`id_ppk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_ppk` (`id_ppk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
