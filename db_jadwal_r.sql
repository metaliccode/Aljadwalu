-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2019 at 04:40 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_jadwal_r`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
`id_admin` int(10) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `kd_jurusan` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `kd_jurusan`, `username`, `password`, `level`) VALUES
(1, 'Admin Akademik TU', 'HES', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Root'),
(2, 'Admin Hes', 'HES', 'hes123', '2bc3312a86691e4360384a95ef6fc46a', 'User'),
(3, 'Ihsan Miftahul Huda', 'PAI', 'ihsanmh', 'ccbc2bffe69e83479314d2df030a2cdf', 'User'),
(4, 'Admin PUD', 'PUD', 'pud123', 'd056501e5fa27743126bc6d08c0cec53', 'User'),
(5, 'Admin PI', 'PI', 'pi12345', '4de9054c0ed62a9f5caae5ebd4a98272', 'User'),
(6, 'Admin MHU', 'MHU', 'mhu123', '1321d07b4bd2b278e18811fd86883a4b', 'User'),
(7, 'Admin KPI', 'KPI', 'kpi123', 'ce0473fe3077fb5bc898829ce164c5d5', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE IF NOT EXISTS `tb_dosen` (
`id_dosen` int(10) NOT NULL,
  `nip` bigint(20) NOT NULL,
  `dosen` varchar(50) NOT NULL,
  `kd_jurusan` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`id_dosen`, `nip`, `dosen`, `kd_jurusan`, `email`, `no_hp`) VALUES
(4, 1, 'Ginan Wibawa, SH., MH.', 'HES', '', ''),
(5, 2, 'Bani M. Tsabit Albanani, S.Ag., M.S.I.', 'PAI', '', ''),
(6, 3, 'Rizal Muttaqin, S.H.I., M.A.', 'HES', '', ''),
(7, 4, 'Nopianti Sa''adah, S.Pd, M.Pd.', 'PAI', '', ''),
(8, 5, 'Asep Wahyudin, S.E., M.M.', 'HES', '', ''),
(9, 6, 'H. R. Arif Badrusarif, S.Ag., M.Ag.', 'PAI', '', ''),
(10, 7, 'Drs. H. Hasjim Rochim, M.Pd.', 'PAI', '', ''),
(11, 8, 'Ropan Abdul Rouf, S.Pd.I.', 'PUD', '', ''),
(12, 9, 'Enjen Abdul Zaeni, S.Ag., M.Pd.I.', 'PAI', '', ''),
(13, 10, 'Sandy Kurniawan, S.E., M.Ag.', 'PAI', '', ''),
(14, 11, 'Diar Faroha, S.H., M.H.', 'HES', '', ''),
(15, 12, 'Irawati, S.E., M.E.Sy.', 'HES', '', ''),
(16, 13, 'Wawan Gunawan, S.H.I., M.E.Sy.', 'HES', '', ''),
(17, 14, 'Dr. KH. Enden Haetami, M.Ag.', 'PAI', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE IF NOT EXISTS `tb_jadwal` (
`id_jadwal` int(10) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `waktu1` time NOT NULL,
  `waktu2` time NOT NULL,
  `kd_matkul` varchar(20) NOT NULL,
  `kd_dosen` int(10) NOT NULL,
  `kd_ruang` varchar(20) NOT NULL,
  `kd_jurusan` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jadwal`, `hari`, `waktu1`, `waktu2`, `kd_matkul`, `kd_dosen`, `kd_ruang`, `kd_jurusan`, `kelas`) VALUES
(8, 'Senin', '07:00:00', '07:50:00', 'HES-11', 4, 'A1', 'HES', 'A'),
(9, 'Senin', '07:50:00', '08:40:00', 'HES-12', 5, 'A1', 'HES', 'A'),
(10, 'Senin', '08:40:00', '09:30:00', 'HES-14', 9, 'A1', 'HES', 'A'),
(11, 'Senin', '07:00:00', '07:50:00', 'PAI-AT', 16, 'A2', 'PAI', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE IF NOT EXISTS `tb_jurusan` (
`id_jurusan` int(10) NOT NULL,
  `kd_jurusan` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `kd_jurusan`, `jurusan`) VALUES
(3, 'HES', 'Hukum Ekonomi Syariah'),
(4, 'PAI', 'Pendidikan Agama Islam'),
(6, 'PUD', 'Pendidikan Usia Dini'),
(7, 'KPI', 'Komunikasi Penyiaran Islam'),
(8, 'PI', 'Psikologi Islam'),
(9, 'MHU', 'Manajemen Haji dan Umroh');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE IF NOT EXISTS `tb_kelas` (
`id_kelas` int(10) NOT NULL,
  `kd_kelas` varchar(20) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `kd_kelas`, `kelas`) VALUES
(1, 'k1', 'A'),
(2, 'k2', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `tb_matkul`
--

CREATE TABLE IF NOT EXISTS `tb_matkul` (
`id_matkul` int(10) NOT NULL,
  `kd_matkul` varchar(20) NOT NULL,
  `matkul` varchar(50) NOT NULL,
  `sks` int(50) NOT NULL,
  `kd_jurusan` varchar(20) NOT NULL,
  `semester` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `tb_matkul`
--

INSERT INTO `tb_matkul` (`id_matkul`, `kd_matkul`, `matkul`, `sks`, `kd_jurusan`, `semester`) VALUES
(4, 'KPR', 'Kepramukaan', 0, 'PAI', 1),
(5, 'PAI-BI', 'Bahasa Indonesia', 2, 'PAI', 1),
(6, 'PAI-BTQ', 'BTQ', 2, 'PAI', 1),
(7, 'PAI-IAD', 'Ilmu Alamiah Dasar (IAD)', 2, 'PAI', 1),
(8, 'PAI-PPKn', 'Pendidikan Pancasila dan Kewarganegaraan', 2, 'PAI', 1),
(9, 'PAI-PSI', 'Pengantar Studi Islam', 2, 'PAI', 1),
(10, 'PAI-UH', 'Ulumul Hadis', 2, 'PAI', 1),
(11, 'PAI-UQ', 'Ulumul Qur''an', 2, 'PAI', 1),
(12, 'PAI-BA1', 'Bahasa Arab 1 (Qira''ah)', 3, 'PAI', 1),
(13, 'PAI-BI1', 'Bahasa Inggris 1 (Reading)', 3, 'PAI', 1),
(14, 'PAI-PI', 'Praktik Ibadah', 0, 'PAI', 2),
(15, 'PAI-AT', 'Akhlak Tasawuf', 2, 'PAI', 2),
(16, 'PAI-DDM', 'Dasar-Dasar Manajemen', 2, 'PAI', 2),
(17, 'PAI-HT', 'Hadis Tarbawi', 2, 'PAI', 2),
(18, 'PAI-IK', 'Ilmu Kalam', 2, 'PAI', 2),
(19, 'PAI-KWU', 'Kewirausahaan', 2, 'PAI', 2),
(20, 'PAI-PAK', 'Pendidikan Anti Korupsi', 2, 'PAI', 2),
(21, 'PAI-PFI', 'Pengantar Filsafat Islam', 2, 'PAI', 2),
(22, 'PAI-TT', 'Tafsir Tarbawi', 2, 'PAI', 2),
(23, 'PAI-BA2', 'Bahasa Arab 2 (Kitabah)', 3, 'PAI', 2),
(24, 'PAI-BI2', 'Bahasa Inggris 2 (Writing)', 3, 'PAI', 2),
(25, 'PAI-PT', 'Praktik Tilawah', 0, 'PAI', 3),
(26, 'PAI-APTK', 'Administrasi Pendidik dan Tenaga Kependidikan', 2, 'PAI', 3),
(27, 'PAI-DDP', 'DAsar-DAsar Pendidikan', 2, 'PAI', 3),
(28, 'PAI-FI', 'Filsafat Ilmu', 2, 'PAI', 3),
(29, 'PAI-PP', 'Psikologi Perkembangan', 2, 'PAI', 3),
(30, 'PAI-TTB', 'Teori-Teori Belajar', 2, 'PAI', 3),
(31, 'PAI-FUF', 'Fikih-Ushul Fiqh', 2, 'PAI', 3),
(32, 'PAI-MTP', 'Media dan Teknologi Pembelajaran', 2, 'PAI', 3),
(33, 'PAI-SPII', 'Sejarah Pendidikan Islam Indonesia', 2, 'PAI', 3),
(34, 'PAI-ICTP', 'ICT Pembelajaran', 3, 'PAI', 3),
(35, 'PAI-SP', 'Statistik Pendidikan', 3, 'PAI', 3),
(36, 'PAI-PLP', 'Pemegang Lembaga Pendidikan', 2, 'PAI', 4),
(37, 'PAI-BKP', 'Bimbingan Konseling Pendidikan', 2, 'PAI', 4),
(38, 'PAI-FPI', 'Filsafat Pendidikan Islam', 2, 'PAI', 4),
(39, 'PAI-MSP', 'Manajemen Satuan Pendidikan', 2, 'PAI', 4),
(40, 'PAI-MMP', 'Model-Model Pendidikan', 2, 'PAI', 4),
(41, 'PAI-PP1', 'Psikologi Pendidikan', 2, 'PAI', 4),
(42, 'PAI-PP2', 'Perencanaan Pengajaran', 2, 'PAI', 4),
(43, 'PAI-TPKI', 'Teknik Penulisan Karya Ilmiah', 2, 'PAI', 4),
(44, 'PAI-BBD', 'Bahasa Budaya Daerah/Sunda', 2, 'PAI', 4),
(45, 'PAI-PPAI', 'Pembelajaran PAI pada Pendidikan DAsar dan Menenga', 3, 'PAI', 4),
(46, 'PAI-KP', 'Komunikasi Pembelajaran', 2, 'PAI', 5),
(47, 'PAI-PAA', 'Pembelajaran Akidah Ahlak', 3, 'PAI', 5),
(48, 'PAI-PAH', 'Pembelajaran Al-quran Hadis', 3, 'PAI', 5),
(49, 'PAI-PBA', 'Pembelajaran Bahasa Arab', 3, 'PAI', 5),
(50, 'PAI-PF', 'Pembelajaran Fiqih', 3, 'PAI', 5),
(51, 'PAI-PSPI', 'Pembelajaran SPI', 3, 'PAI', 5),
(52, 'PAI-MT', 'Micro Teaching', 3, 'PAI', 5),
(53, 'PAI-EPG', 'Etika dan Profesi Guru', 2, 'PAI', 6),
(54, 'PAI-PN', 'Pendidikan Nilai', 2, 'PAI', 6),
(55, 'PAI-PIKPAI', 'Pengembangan dan Inovasi Kurikulum PAI', 2, 'PAI', 6),
(56, 'PAI-PPL', 'PPL', 2, 'PAI', 6),
(57, 'PAI-SEPPAI', 'Sistem Evaluasi Pengajaran PAI', 2, 'PAI', 6),
(58, 'PAI-SP1', 'Sosialisasi Pendidikan', 2, 'PAI', 6),
(59, 'PAI-MPP', 'Metodologi Penelitian Pendidikan', 2, 'PAI', 6),
(60, 'PAI-PTKS', 'Penelitian Tindakan Kelas dan Sekolah', 3, 'PAI', 6),
(61, 'PAI-KSP', 'Kapita Selekta Pendidikan', 2, 'PAI', 7),
(62, 'PAI-MP4GN', 'MP4GN', 2, 'PAI', 7),
(63, 'PAI-PPPM', 'Pemikiran-Pemikiran Pendidikan Modern', 2, 'PAI', 7),
(64, 'PAI-PKH', 'Pendidikan Keterampilan Hidup (Life Skills)', 2, 'PAI', 7),
(65, 'PAI-PLS', 'Pendidikan Luar Sekolah', 2, 'PAI', 7),
(66, 'PAI-SPMP', 'Sistem Penjaminan Mutu Pendidikan', 2, 'PAI', 7),
(67, 'PAI-IM', 'Ilmu Manthiq', 2, 'PAI', 7),
(68, 'PAI-BS', 'Bimbingan Skripsi', 0, 'PAI', 8),
(69, 'PAI-JJ', 'Jam''ul Jawami', 2, 'PAI', 8),
(70, 'PAI-KKN', 'KKN', 2, 'PAI', 8),
(71, 'PAI-SKR', 'Skripsi (Munaqosah)', 2, 'PAI', 8),
(72, 'PAI-KOMP', 'Komprehensif', 4, 'PAI', 8),
(75, 'HES-1', 'Pengantar Studi Islam', 3, 'HES', 1),
(76, 'HES-2', 'BTQ', 0, 'HES', 1),
(77, 'HES-3', 'Ulumul Hadis', 2, 'HES', 1),
(78, 'HES-5', 'Pengantar Ilmu Fiqih/Ushul Fiqih', 2, 'HES', 1),
(79, 'HES-6', 'PPKn', 2, 'HES', 1),
(80, 'HES-7', 'Bahasa Indonesia', 2, 'HES', 1),
(81, 'HES-8', 'Bahasa Inggris I (Grammer)', 3, 'HES', 1),
(82, 'HES-9', 'Ilmu Sosial Dasar', 2, 'HES', 1),
(83, 'HES-10', 'Bahasa Arab I (Nahwu-Sharaf)', 3, 'HES', 1),
(84, 'HES-11', 'Akhlak Tasawuf', 2, 'HES', 2),
(85, 'HES-12', 'Pendidikan Anti Korupsi', 2, 'HES', 2),
(86, 'HES-14', 'Ilmu Kalam', 2, 'HES', 2),
(87, 'HES-15', 'Praktek Ibadah', 0, 'HES', 2),
(88, 'HES-17', 'Bahasa Inggris II', 3, 'HES', 2),
(89, 'HES-18', 'Ushul Fiqih', 3, 'HES', 2),
(90, 'HES-19', 'Pengantar Ilmu Hukum', 2, 'HES', 2),
(91, 'HES-20', 'Matematika Ekonomi', 2, 'HES', 2),
(92, 'HES-21', 'Pengantar Ilmu Ekonomi & Bisnis', 2, 'HES', 2),
(93, 'HES-22', 'Pengantar Ekonomi Syariah', 2, 'HES', 3),
(94, 'HES-23', 'Bahtsul Kutub/Qiraatul Kutub', 0, 'HES', 3),
(95, 'HES-24', 'Dasar-dasar Manajemen Syariah', 2, 'HES', 3),
(96, 'HES-25', 'Filsafat Islam', 2, 'HES', 3),
(97, 'HES-26', 'Hukum Perdata', 2, 'HES', 3),
(98, 'HES-27', 'Sejarah Peradaban Islam', 2, 'HES', 3),
(99, 'HES-28', 'Bahasa Arab III ', 2, 'HES', 3),
(100, 'HES-29', 'Tafsir Ahkam Muamalah', 3, 'HES', 3),
(101, 'HES-30', 'Bahasa Inggris III (Writing)', 2, 'HES', 3),
(102, 'HES-31', 'Fiqh Munakahat & Mawarits', 3, 'HES', 3),
(103, 'HES-32', 'Dasar-dasar Akuntansi', 2, 'HES', 3),
(104, 'HES-33', 'Fiqh Muamalah II (Ijarah & Syirkah)', 2, 'HES', 3),
(105, 'HES-34', 'Ekonomi Mikro & Makro Islam', 3, 'HES', 4),
(106, 'HES-35', 'Fiqh Zakat & Wakaf', 2, 'HES', 4),
(107, 'HES-37', 'Filsafat Hukum Islam', 2, 'HES', 4),
(108, 'HES-38', 'Pengantar Statistik', 2, 'HES', 4),
(109, 'HES-39', 'Teknik-teknik Penulisan Karya Ilmiah', 2, 'HES', 4),
(110, 'HES-40', 'Hadits Ahkam Muamalah', 3, 'HES', 4),
(111, 'HES-42', 'Hukum Acara Perdata', 2, 'HES', 4),
(112, 'HES-44', 'Akuntansi Syariah', 2, 'HES', 4),
(113, 'HES-45', 'Statistik Ekonomi dan Bisnis', 2, 'HES', 5),
(114, 'HES-46', 'Sistem Peradilan Islam di Indonesia', 2, 'HES', 5),
(115, 'HES-47', 'Sejarah dan Pemikiran Ekonomi Syariah', 2, 'HES', 5),
(116, 'HES-48', 'Manajemen ZIS, Haji dan Wakaf', 2, 'HES', 5),
(117, 'HES-49', 'Ilmu Mantiq', 2, 'HES', 5),
(118, 'HES-50', 'Hukum Perikatan dan Alternatif Penyelesaian Persel', 2, 'HES', 5),
(119, 'HES-52', 'Fiqih Jinayah dan Siyasah', 3, 'HES', 5),
(120, 'HES-53', 'Qawaidul Fiqhiyyah Muamalah', 3, 'HES', 6),
(121, 'HES-54', 'Metode Penelitian Hukum Ekonomi Syariah', 3, 'HES', 6),
(122, 'HES-55', 'Manajemen Pemasaran BS', 2, 'HES', 6),
(123, 'HES-56', 'Legal Drafting', 2, 'HES', 6),
(124, 'HES-57', 'KKN-M', 2, 'HES', 6),
(125, 'HES-58', 'Kewirausahaan', 2, 'HES', 6),
(126, 'HES-59', 'Hukum Pidana dan Acara Pidana', 2, 'HES', 6),
(127, 'HES-60', 'Hukum Perpajakan', 2, 'HES', 6),
(128, 'HES-61', 'Fatwa-fatwa Ekonomi Syariah', 2, 'HES', 6),
(129, 'HES-63', 'Sosiologi Hukum Islam', 2, 'HES', 7),
(130, 'HES-64', 'PPL/Magang', 2, 'HES', 7),
(131, 'HES-65', 'MP4GN', 2, 'HES', 7),
(132, 'HES-66', 'Manajemen SDM Perbankan Syariah', 2, 'HES', 7),
(133, 'HES-68', 'Etika Profesi Hukum', 2, 'HES', 7),
(134, 'HES-69', 'Bimbingan Skripsi', 0, 'HES', 7),
(135, 'HES-70', 'Komprehensif', 2, 'HES', 8),
(136, 'HES-71', 'Skripsi ( SUPS dan Munaqasah )', 4, 'HES', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruangan`
--

CREATE TABLE IF NOT EXISTS `tb_ruangan` (
`id_ruang` int(10) NOT NULL,
  `kd_ruang` varchar(20) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`id_ruang`, `kd_ruang`, `nama_ruang`) VALUES
(1, 'A1', 'Gedung Ruang A1'),
(2, 'A2', 'Gedung Ruang A2'),
(4, 'B1', 'Gedung Ruang B1'),
(5, 'B2', 'Gedung Ruang B2'),
(6, 'C1', 'Gedung Ruang C1'),
(7, 'C2', 'Gedung Ruang C2'),
(8, 'Micro', 'Laboratorium Microteaching'),
(9, 'LAB-PerSem', 'Laboratorium Peradilan Semu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_semester`
--

CREATE TABLE IF NOT EXISTS `tb_semester` (
`id_smt` int(10) NOT NULL,
  `semester` int(5) NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_semester`
--

INSERT INTO `tb_semester` (`id_smt`, `semester`, `ket`) VALUES
(1, 1, 'Ganjil'),
(2, 2, 'Genap'),
(3, 3, 'Ganjil'),
(4, 4, 'Genap'),
(5, 5, 'Ganjil'),
(6, 6, 'Genap'),
(7, 7, 'Ganjil'),
(8, 8, 'Genap');

-- --------------------------------------------------------

--
-- Table structure for table `tb_set_sks`
--

CREATE TABLE IF NOT EXISTS `tb_set_sks` (
`id_sks` int(11) NOT NULL,
  `lama` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_set_sks`
--

INSERT INTO `tb_set_sks` (`id_sks`, `lama`) VALUES
(1, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
 ADD PRIMARY KEY (`id_admin`), ADD KEY `kd_jurusan` (`kd_jurusan`), ADD KEY `kd_jurusan_2` (`kd_jurusan`);

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
 ADD PRIMARY KEY (`id_dosen`), ADD UNIQUE KEY `nip` (`nip`), ADD KEY `d_prodi` (`kd_jurusan`), ADD KEY `d_prodi_2` (`kd_jurusan`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
 ADD PRIMARY KEY (`id_jadwal`), ADD KEY `kd_matkul` (`kd_matkul`,`kd_dosen`,`kd_ruang`), ADD KEY `kelas` (`kelas`), ADD KEY `kd_jurusan` (`kd_jurusan`), ADD KEY `kd_ruang` (`kd_ruang`), ADD KEY `kd_dosen` (`kd_dosen`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
 ADD PRIMARY KEY (`id_jurusan`), ADD UNIQUE KEY `kd_jurusan` (`kd_jurusan`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
 ADD PRIMARY KEY (`id_kelas`), ADD UNIQUE KEY `kelas` (`kelas`), ADD UNIQUE KEY `kd_kelas` (`kd_kelas`,`kelas`), ADD UNIQUE KEY `kd_kelas_2` (`kd_kelas`);

--
-- Indexes for table `tb_matkul`
--
ALTER TABLE `tb_matkul`
 ADD PRIMARY KEY (`id_matkul`), ADD UNIQUE KEY `kd_matkul` (`kd_matkul`), ADD KEY `kd_jurusan` (`kd_jurusan`,`semester`), ADD KEY `semester` (`semester`);

--
-- Indexes for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
 ADD PRIMARY KEY (`id_ruang`), ADD UNIQUE KEY `kd_ruang` (`kd_ruang`);

--
-- Indexes for table `tb_semester`
--
ALTER TABLE `tb_semester`
 ADD PRIMARY KEY (`id_smt`), ADD UNIQUE KEY `semester` (`semester`);

--
-- Indexes for table `tb_set_sks`
--
ALTER TABLE `tb_set_sks`
 ADD PRIMARY KEY (`id_sks`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
MODIFY `id_dosen` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
MODIFY `id_jadwal` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
MODIFY `id_jurusan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_matkul`
--
ALTER TABLE `tb_matkul`
MODIFY `id_matkul` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
MODIFY `id_ruang` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_semester`
--
ALTER TABLE `tb_semester`
MODIFY `id_smt` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_set_sks`
--
ALTER TABLE `tb_set_sks`
MODIFY `id_sks` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`kd_jurusan`) REFERENCES `tb_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
ADD CONSTRAINT `tb_dosen_ibfk_1` FOREIGN KEY (`kd_jurusan`) REFERENCES `tb_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`kd_matkul`) REFERENCES `tb_matkul` (`kd_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_10` FOREIGN KEY (`kd_ruang`) REFERENCES `tb_ruangan` (`kd_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_11` FOREIGN KEY (`kd_matkul`) REFERENCES `tb_matkul` (`kd_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_12` FOREIGN KEY (`kd_jurusan`) REFERENCES `tb_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_13` FOREIGN KEY (`kd_ruang`) REFERENCES `tb_ruangan` (`kd_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_14` FOREIGN KEY (`kd_dosen`) REFERENCES `tb_dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_15` FOREIGN KEY (`kd_matkul`) REFERENCES `tb_matkul` (`kd_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_16` FOREIGN KEY (`kelas`) REFERENCES `tb_kelas` (`kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`kd_dosen`) REFERENCES `tb_dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_3` FOREIGN KEY (`kelas`) REFERENCES `tb_kelas` (`kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_4` FOREIGN KEY (`kd_ruang`) REFERENCES `tb_ruangan` (`kd_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_5` FOREIGN KEY (`kd_ruang`) REFERENCES `tb_ruangan` (`kd_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_6` FOREIGN KEY (`kelas`) REFERENCES `tb_kelas` (`kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_7` FOREIGN KEY (`kd_matkul`) REFERENCES `tb_matkul` (`kd_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_8` FOREIGN KEY (`kd_dosen`) REFERENCES `tb_dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_jadwal_ibfk_9` FOREIGN KEY (`kd_jurusan`) REFERENCES `tb_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_matkul`
--
ALTER TABLE `tb_matkul`
ADD CONSTRAINT `tb_matkul_ibfk_1` FOREIGN KEY (`kd_jurusan`) REFERENCES `tb_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_matkul_ibfk_2` FOREIGN KEY (`semester`) REFERENCES `tb_semester` (`semester`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_matkul_ibfk_3` FOREIGN KEY (`semester`) REFERENCES `tb_semester` (`semester`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_matkul_ibfk_4` FOREIGN KEY (`kd_jurusan`) REFERENCES `tb_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_matkul_ibfk_5` FOREIGN KEY (`semester`) REFERENCES `tb_semester` (`semester`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_matkul_ibfk_6` FOREIGN KEY (`semester`) REFERENCES `tb_semester` (`semester`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_matkul_ibfk_7` FOREIGN KEY (`kd_jurusan`) REFERENCES `tb_jurusan` (`kd_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
