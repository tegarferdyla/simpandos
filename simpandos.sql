-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2018 at 01:00 AM
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
  `id_tahun` varchar(7) NOT NULL,
  `id_jenis` varchar(7) NOT NULL,
  `id_subdok` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`id_file`, `nama_file`, `id_paket`, `id_tahun`, `id_jenis`, `id_subdok`) VALUES
(1, '2014-Paket 2 Pembangunan-41815010050_Tegar_Ferdyla_M_ERP.docx', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0030'),
(2, '2014-Paket 2 Pembangunan-Alur-Daftar-TA.pdf', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0038'),
(3, '2014-Paket 2 Pembangunan-Ekivalensi_Reg1.pdf', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0049'),
(4, '2014-Paket 2 Pembangunan-Kurikulum_2017_Reguler_1_tegar.docx', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0029'),
(5, '2014-Paket 2 Pembangunan-dapur.jpg', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0057'),
(6, '2014-Paket 2 Pembangunan-background.jpg', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0058'),
(7, '2014-Paket 2 Pembangunan-Analisa_Website_-_Finding_Kitchen.docx', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0059'),
(8, '2014-Paket 2 Pembangunan-map.JPG', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0061'),
(9, '2014-Contoh Teknis-87010_basis_data.pdf', 'PKT0005', 'THN0003', 'JNS0003', 'SUB0069'),
(34, '2015-Paket 2015-1.jpg', 'PKT0007', 'THN0001', 'JNS0002', 'SUB0001'),
(36, '2015-Paket Ppk 2-1.jpg', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0001'),
(37, '2015-Paket Ppk 2- Pendukung -mercu.jpg', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0085'),
(38, '2015-Paket Ppk 2- Pendukung -box.JPG', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0086'),
(39, '2015-Paket Ppk 2- Pendukung -logo.jpg', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0087'),
(40, '2015-Paket Ppk 2- Pendukung -giro.JPG', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0096'),
(41, '2015-Paket Ppk 2- Pendukung -inves.JPG', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0098'),
(42, '2015-Paket Ppk 2- Pendukung -mana.JPG', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0099'),
(43, '2015-Paket Ppk 2- Pendukung -banking.JPG', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0097'),
(44, '2015-Paket Ppk 2- Pendukung -DEPOSOTO.JPG', 'PKT0008', 'THN0004', 'JNS0002', 'SUB0085'),
(45, '2014-Paket 2 Pembangunan-1.jpg', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0061'),
(46, '2014-Paket 1 Pembangunan-1._HALAMAN_COVER.doc', 'PKT0001', 'THN0003', 'JNS0002', 'SUB0001'),
(47, '2014-Paket 2 Pembangunan- Pendukung -47633.jpg', 'PKT0002', 'THN0003', 'JNS0002', 'SUB0085'),
(49, '2014-Paket 1 Pembangunan-Banner_Bukber_2_copy.jpg', 'PKT0001', 'THN0003', 'JNS0002', 'SUB0002'),
(50, '2014-Contoh Teknis-UTS.doc', 'PKT0005', 'THN0003', 'JNS0003', 'SUB0069'),
(51, '2014-Contoh Teknis- Pendukung -bem.png', 'PKT0005', 'THN0003', 'JNS0003', 'SUB0085');

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
('JNS0005', 'Swakelola', 'Swakelola', 'Jenis Paket Swakelola');

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
('PKT0001', 'Paket 1 Pembangunan', 'Paket 1 Pembangunan', 'User PPK 1', 'JNS0002', 'THN0003', 'PPK0002'),
('PKT0002', 'Paket 2 Pembangunan', 'Paket 2 Pembangunan', 'User PPK 1', 'JNS0002', 'THN0003', 'PPK0002'),
('PKT0003', 'Paket Swakelola 1', 'Paket Swakelola 1', 'User PPK 1', 'JNS0005', 'THN0003', 'PPK0002'),
('PKT0005', 'Contoh Teknis', 'Contoh Teknis', 'User PPK 1', 'JNS0003', 'THN0003', 'PPK0002'),
('PKT0006', 'Contoh Pengadaan', 'Contoh Pengadaan', 'User PPK 1', 'JNS0004', 'THN0003', 'PPK0002'),
('PKT0007', 'Paket 2015', 'asdasd', 'User PPK 1', 'JNS0002', 'THN0001', 'PPK0002'),
('PKT0008', 'Paket Ppk 2', 'asdsa', 'User PPK 2', 'JNS0002', 'THN0004', 'PPK0003'),
('PKT0009', 'Kosong', 'ksoong', 'User PPK 1', 'JNS0002', 'THN0003', 'PPK0002');

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
('SUB0006', 'Surat Kuasa', 'KPL0001'),
('SUB0007', 'SPPBJ', 'KPL0002'),
('SUB0008', 'SPMK', 'KPL0002'),
('SUB0009', 'Naskah Kontrak', 'KPL0002'),
('SUB0010', 'Rencana Mutu Kontrak', 'KPL0002'),
('SUB0011', 'Design Drawing', 'KPL0004'),
('SUB0012', 'Berita Acara Lapangan', 'KPL0004'),
('SUB0013', 'Justifikasi dan Spesifikasi Teknis', 'KPL0004'),
('SUB0014', 'Berita Acara Pree Construction Meeting (PCM)', 'KPL0004'),
('SUB0015', 'Bill of Quantity', 'KPL0005'),
('SUB0016', 'Justifikasi dan Spesifikasi Teknis', 'KPL0005'),
('SUB0017', 'Surat Lampiran Pendukung', 'KPL0005'),
('SUB0018', 'Kurva S Revisi', 'KPL0005'),
('SUB0019', 'Shop Drawing', 'KPL0005'),
('SUB0020', 'Berita Acara Klarifikasi Negosiasi', 'KPL0005'),
('SUB0021', 'Naskah Addendum I', 'KPL0005'),
('SUB0022', 'Berita Acara Lapangan', 'KPL0006'),
('SUB0023', 'Bill of Quantity', 'KPL0006'),
('SUB0024', 'Justifikasi dan Spesifikasi Teknis', 'KPL0006'),
('SUB0025', 'Surat Lampiran Pendukung', 'KPL0006'),
('SUB0026', 'Kurva S Revisi', 'KPL0006'),
('SUB0027', 'Shop Drawing', 'KPL0006'),
('SUB0028', 'Berita Acara Klarifikasi Negosiasi', 'KPL0006'),
('SUB0029', 'Naskah Addendum II', 'KPL0006'),
('SUB0030', 'Berita Acara Lapangan', 'KPL0007'),
('SUB0031', 'Bill of Quantity', 'KPL0007'),
('SUB0032', 'Justifikasi dan Spesifikasi Teknis', 'KPL0007'),
('SUB0033', 'Surat Lampiran Pendukung', 'KPL0007'),
('SUB0034', 'Kurva S Revisi', 'KPL0007'),
('SUB0035', 'Shop Drawing', 'KPL0007'),
('SUB0036', 'Berita Acara Klarifikasi Negosiasi', 'KPL0007'),
('SUB0037', 'Naskah Addendum III', 'KPL0007'),
('SUB0038', 'Berita Acara Lapangan', 'KPL0008'),
('SUB0039', 'Bill of Quantity', 'KPL0008'),
('SUB0040', 'Justifikasi dan Spesifikasi Teknis', 'KPL0008'),
('SUB0041', 'Surat Lampiran Pendukung', 'KPL0008'),
('SUB0042', 'Kurva S Revisi', 'KPL0008'),
('SUB0043', 'Shop Drawing', 'KPL0008'),
('SUB0044', 'Berita Acara Klarifikasi Negosiasi', 'KPL0008'),
('SUB0045', 'Naskah Addendum IV', 'KPL0008'),
('SUB0046', 'Berita Acara Lapangan', 'KPL0009'),
('SUB0047', 'Bill of Quantity', 'KPL0009'),
('SUB0048', 'Justifikasi dan Spesifikasi Teknis', 'KPL0009'),
('SUB0049', 'Surat Lampiran Pendukung', 'KPL0009'),
('SUB0050', 'Kurva S Revisi', 'KPL0009'),
('SUB0051', 'Shop Drawing', 'KPL0009'),
('SUB0052', 'Berita Acara Klarifikasi Negosiasi', 'KPL0009'),
('SUB0053', 'Naskah Addendum V', 'KPL0009'),
('SUB0054', 'Laporan Harian', 'KPL0010'),
('SUB0055', 'Laporan Mingguan', 'KPL0010'),
('SUB0056', 'Laporan Bulanan', 'KPL0010'),
('SUB0057', 'Sertifikat Pembayaran', 'KPL0010'),
('SUB0058', 'Berita Acara Pengujian Material', 'KPL0011'),
('SUB0059', 'Berita Acara Show Cause Meeting (SCM)', 'KPL0012'),
('SUB0060', 'Surat Permohonan PHO', 'KPL0013'),
('SUB0061', 'Berita Acara First Visit', 'KPL0013'),
('SUB0062', 'Berita Acara Second Visit', 'KPL0013'),
('SUB0063', 'Berita Acara Serah Terima Pekerjaan', 'KPL0013'),
('SUB0064', 'Surat Permohonan FHO', 'KPL0014'),
('SUB0065', 'Berita Acara First Visit', 'KPL0014'),
('SUB0066', 'Berita Acara Second Visit', 'KPL0014'),
('SUB0067', 'Berita Acara Serah Terima Pekerjaan', 'KPL0014'),
('SUB0068', 'Dokumentasi', 'KPL0015'),
('SUB0069', 'Laporan Pendahuluan', 'KPL0016'),
('SUB0070', 'Laporan Antara', 'KPL0016'),
('SUB0071', 'Draft Laporan Akhir', 'KPL0016'),
('SUB0072', 'Laporan Akhir', 'KPL0016'),
('SUB0073', 'Surat Minat', 'KPL0019'),
('SUB0074', 'Surat Pernyataan Menerima Hibah', 'KPL0019'),
('SUB0075', 'Penyerahan Kendaraan + STNK', 'KPL0019'),
('SUB0076', 'BAST Kasatker dengan Dinas Pengelola', 'KPL0019'),
('SUB0077', 'Status dari Kasatker Ke Kementrian Keuangan', 'KPL0019'),
('SUB0078', 'Rekomtek Dirjen Ke Kasatker', 'KPL0019'),
('SUB0079', 'Pengajuan Hibah Ke Kementrian Keuangan', 'KPL0019'),
('SUB0080', 'Persetujuan Hibah Ke Satker', 'KPL0019'),
('SUB0081', 'Naskah Hibah antara Satker dengan Kepala Daerah', 'KPL0019'),
('SUB0082', 'Perjanjian Hibah antara Satker dengan Kepala Daerah', 'KPL0019'),
('SUB0083', 'Dokumen Hibah BPKB ke Pemda', 'KPL0019'),
('SUB0084', 'Laporan Swakelola', 'KPL0020'),
('SUB0085', 'Surat Alih status', 'KPL0003'),
('SUB0086', 'Rekomendasi Teknis', 'KPL0003'),
('SUB0087', 'Surat Hibah Ke Kementrian Keuangan', 'KPL0003'),
('SUB0088', 'Permohonan Pembayaran', 'KPL0017'),
('SUB0089', 'Kuitansi', 'KPL0017'),
('SUB0090', 'Kartu Pengawasan (Karwas)', 'KPL0017'),
('SUB0091', 'Faktur Pajak', 'KPL0017'),
('SUB0092', 'PPh dan PPN', 'KPL0017'),
('SUB0093', 'SPP', 'KPL0017'),
('SUB0094', 'SPM', 'KPL0017'),
('SUB0095', 'SP2D', 'KPL0017'),
('SUB0096', 'LPJ', 'KPL0018'),
('SUB0097', 'Berita Acara Pemeriksaan Kas dan Rekonsiliasi', 'KPL0018'),
('SUB0098', 'Rekening Koran', 'KPL0018'),
('SUB0099', 'Berita Acara Pemeriksaan Kas', 'KPL0018');

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
('THN0003', '2014', 'Tahun 2014', 'User PPK 1', 'PPK0002'),
('THN0004', '2015', 'Tahun 2015', 'User PPK 2', 'PPK0003'),
('THN0005', '2018', 'Tahun 2018', 'User PPK 1', 'PPK0002');

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
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
