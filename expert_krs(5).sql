-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2020 at 06:06 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expert_krs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`) VALUES
(1, 'novalnauw', '29c0e233dac1f8891d6bc32449b39a71', 'novalsmith69@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bidangminat`
--

CREATE TABLE `bidangminat` (
  `id_bidangminat` int(5) NOT NULL,
  `id_mk` int(50) NOT NULL,
  `id_minat` int(5) NOT NULL,
  `semester` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidangminat`
--

INSERT INTO `bidangminat` (`id_bidangminat`, `id_mk`, `id_minat`, `semester`) VALUES
(18, 64, 1, 6),
(19, 65, 1, 6),
(20, 66, 1, 6),
(22, 68, 1, 6),
(24, 67, 1, 6),
(25, 51, 1, 7),
(26, 52, 1, 7),
(27, 53, 1, 7),
(28, 54, 1, 7),
(29, 55, 1, 7),
(30, 56, 1, 7),
(31, 57, 1, 7),
(32, 58, 1, 7),
(33, 59, 1, 7),
(34, 71, 3, 6),
(35, 72, 3, 6),
(36, 73, 3, 6),
(37, 74, 3, 6),
(38, 75, 3, 6),
(39, 76, 3, 7),
(40, 77, 3, 7),
(41, 78, 3, 7),
(42, 79, 3, 7),
(43, 80, 3, 7),
(44, 81, 3, 7),
(45, 82, 3, 7),
(46, 83, 3, 7),
(47, 84, 3, 7),
(48, 85, 2, 6),
(49, 86, 2, 6),
(50, 87, 2, 6),
(51, 88, 2, 6),
(52, 89, 2, 6),
(53, 90, 2, 7),
(54, 91, 2, 7),
(55, 92, 2, 7),
(56, 93, 2, 7),
(57, 94, 2, 7),
(58, 95, 2, 7),
(59, 96, 2, 7),
(60, 97, 2, 7),
(61, 98, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `bidangminat_bersyarat`
--

CREATE TABLE `bidangminat_bersyarat` (
  `id_bminat_syarat` int(5) NOT NULL,
  `id_minat` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidangminat_bersyarat`
--

INSERT INTO `bidangminat_bersyarat` (`id_bminat_syarat`, `id_minat`, `id_mk`) VALUES
(2, 1, 19),
(3, 1, 20),
(4, 1, 21),
(5, 1, 18),
(7, 2, 18),
(8, 2, 21),
(9, 3, 18),
(10, 3, 21),
(11, 3, 20),
(12, 3, 19),
(13, 1, 48),
(14, 2, 48),
(15, 2, 20);

-- --------------------------------------------------------

--
-- Table structure for table `dpam`
--

CREATE TABLE `dpam` (
  `id_dpam` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_dpam` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dpam`
--

INSERT INTO `dpam` (`id_dpam`, `username`, `nama_dpam`, `password`) VALUES
(3, '1412jetbrains', 'Noval Smith', '29cd9c87d9df74a817af326937ba6be4');

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `id_entry` int(5) NOT NULL,
  `id_mk_tawaran` int(10) NOT NULL,
  `id_mahasiswa` int(30) NOT NULL,
  `waktu_entry` varchar(20) NOT NULL,
  `semester_aktif` int(5) NOT NULL,
  `validasi` varchar(10) NOT NULL,
  `id_kelas` int(20) NOT NULL,
  `semester_tahun_akademik` varchar(10) NOT NULL,
  `tahun_akademik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id_entry`, `id_mk_tawaran`, `id_mahasiswa`, `waktu_entry`, `semester_aktif`, `validasi`, `id_kelas`, `semester_tahun_akademik`, `tahun_akademik`) VALUES
(1379, 10, 18, '2017', 1, 'BELUM', 1, 'Ganjil', '2016/2017'),
(1380, 11, 18, '2017', 1, 'BELUM', 1, 'Ganjil', '2016/2017'),
(1381, 12, 18, '2017', 1, 'BELUM', 1, 'Ganjil', '2016/2017'),
(1382, 51, 18, '2017', 1, 'BELUM', 1, 'Ganjil', '2016/2017'),
(1383, 52, 18, '2017', 1, 'BELUM', 1, 'Ganjil', '2016/2017'),
(1384, 53, 18, '2017', 1, 'BELUM', 1, 'Ganjil', '2016/2017'),
(1385, 54, 18, '2017', 1, 'BELUM', 1, 'Ganjil', '2016/2017'),
(1386, 56, 18, '2017', 1, 'BELUM', 1, 'Ganjil', '2016/2017'),
(1387, 13, 18, '04-04-2017', 2, 'BELUM', 1, 'Genap', '2016/2017'),
(1388, 14, 18, '04-04-2017', 2, 'BELUM', 1, 'Genap', '2016/2017'),
(1389, 15, 18, '04-04-2017', 2, 'BELUM', 1, 'Genap', '2016/2017'),
(1390, 16, 18, '04-04-2017', 2, 'BELUM', 1, 'Genap', '2016/2017'),
(1391, 17, 18, '04-04-2017', 2, 'BELUM', 1, 'Genap', '2016/2017'),
(1392, 18, 18, '04-04-2017', 2, 'BELUM', 1, 'Genap', '2016/2017'),
(1393, 19, 18, '04-04-2017', 2, 'BELUM', 1, 'Genap', '2016/2017'),
(1394, 26, 18, '04-04-2018', 3, 'BELUM', 1, 'Ganjil', '2017/2018'),
(1395, 27, 18, '04-04-2018', 3, 'BELUM', 1, 'Ganjil', '2017/2018'),
(1396, 29, 18, '04-04-2018', 3, 'BELUM', 1, 'Ganjil', '2017/2018'),
(1397, 30, 18, '04-04-2018', 3, 'BELUM', 1, 'Ganjil', '2017/2018'),
(1398, 31, 18, '04-04-2018', 3, 'BELUM', 1, 'Ganjil', '2017/2018'),
(1399, 32, 18, '04-04-2018', 3, 'BELUM', 1, 'Ganjil', '2017/2018'),
(1400, 42, 18, '04-04-2018', 3, 'BELUM', 1, 'Ganjil', '2017/2018'),
(1401, 24, 18, '04-04-2018', 4, 'BELUM', 1, 'Genap', '2017/2018'),
(1402, 43, 18, '04-04-2018', 4, 'BELUM', 1, 'Genap', '2017/2018'),
(1403, 44, 18, '04-04-2018', 4, 'BELUM', 1, 'Genap', '2017/2018'),
(1404, 45, 18, '04-04-2018', 4, 'BELUM', 1, 'Genap', '2017/2018'),
(1405, 46, 18, '04-04-2018', 4, 'BELUM', 1, 'Genap', '2017/2018'),
(1406, 57, 18, '04-04-2018', 4, 'BELUM', 1, 'Genap', '2017/2018'),
(1407, 58, 18, '04-04-2018', 4, 'BELUM', 1, 'Genap', '2017/2018'),
(1408, 22, 18, '04-04-2019', 5, 'BELUM', 1, 'Ganjil', '2018/2019'),
(1409, 25, 18, '04-04-2019', 5, 'BELUM', 1, 'Ganjil', '2018/2019'),
(1410, 33, 18, '04-04-2019', 5, 'BELUM', 1, 'Ganjil', '2018/2019'),
(1411, 34, 18, '04-04-2019', 5, 'BELUM', 1, 'Ganjil', '2018/2019'),
(1412, 60, 18, '04-04-2019', 5, 'BELUM', 1, 'Ganjil', '2018/2019'),
(1413, 62, 18, '04-04-2019', 5, 'BELUM', 1, 'Ganjil', '2018/2019'),
(1488, 48, 18, '07-04-2019', 6, 'BELUM', 1, 'Genap', '2018/2019'),
(1489, 65, 18, '07-04-2019', 6, 'BELUM', 1, 'Genap', '2018/2019'),
(1490, 61, 18, '07-04-2019', 6, 'BELUM', 1, 'Genap', '2018/2019'),
(1491, 63, 18, '07-04-2019', 6, 'BELUM', 1, 'Genap', '2018/2019'),
(1492, 35, 18, '07-04-2020', 7, 'BELUM', 1, 'Ganjil', '2019/2020'),
(1493, 36, 18, '07-04-2020', 7, 'BELUM', 1, 'Ganjil', '2019/2020'),
(1494, 37, 18, '07-04-2020', 7, 'BELUM', 1, 'Ganjil', '2019/2020'),
(1495, 38, 18, '07-04-2020', 7, 'BELUM', 1, 'Ganjil', '2019/2020'),
(1496, 55, 18, '07-04-2020', 7, 'BELUM', 1, 'Ganjil', '2019/2020'),
(1497, 68, 18, '07-04-2020', 7, 'BELUM', 1, 'Ganjil', '2019/2020'),
(1498, 69, 18, '07-04-2020', 7, 'BELUM', 1, 'Ganjil', '2019/2020');

-- --------------------------------------------------------

--
-- Table structure for table `entry_temporary`
--

CREATE TABLE `entry_temporary` (
  `id_entry_temporary` int(20) NOT NULL,
  `id_mahasiswa` int(10) NOT NULL,
  `waktu_entry` varchar(30) NOT NULL,
  `semester_aktif` int(5) NOT NULL,
  `validasi` varchar(30) NOT NULL,
  `id_mk_tawaran` int(10) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `semester_tahun_akademik` varchar(10) NOT NULL,
  `tahun_akademik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mk`
--

CREATE TABLE `jadwal_mk` (
  `id_jadwal` int(10) NOT NULL,
  `jam_masuk` varchar(30) NOT NULL,
  `jam_selesai` varchar(30) NOT NULL,
  `id_ruang_kuliah` int(5) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `id_mk_tawaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_mk`
--

INSERT INTO `jadwal_mk` (`id_jadwal`, `jam_masuk`, `jam_selesai`, `id_ruang_kuliah`, `hari`, `id_mk_tawaran`) VALUES
(3, '18.50', '19.70', 1, 'SELASA', 52),
(4, '18.50', '19.70', 1, 'SELASA', 34),
(5, '18.50', '19.70', 1, 'SELASA', 26),
(7, '18.50', '19.70', 3, 'KAMIS', 11),
(8, '18.50', '19.70', 1, 'JUMAT', 16),
(9, '18.50', '19.70', 1, 'JUMAT', 10),
(10, '18.50', '19.70', 2, 'RABU', 51),
(11, '18.50', '19.70', 2, 'SABTU', 12),
(12, '18.50', '19.70', 1, 'SELASA', 13),
(13, '18.50', '19.70', 2, 'SELASA', 14),
(14, '18.50', '19.70', 3, 'SELASA', 15),
(15, '18.50', '19.70', 2, 'KAMIS', 17),
(16, '18.50', '19.70', 2, 'KAMIS', 18),
(17, '18.50', '19.70', 2, 'RABU', 19),
(18, '18.50', '19.70', 2, 'JUMAT', 47),
(19, '18.50', '19.70', 2, 'SELASA', 44),
(20, '18.30', '19.20', 1, 'RABU', 53),
(21, '18.50', '19.70', 3, 'JUMAT', 54),
(22, '17.50', '19.10', 2, 'RABU', 48),
(23, '18.50', '19.10', 1, 'SABTU', 39),
(24, '18.50', '19.10', 1, 'SELASA', 42),
(25, '18.50', '19.10', 1, 'KAMIS', 49),
(26, '18.50', '19.70', 2, 'KAMIS', 50),
(27, '17.50', '19.10', 1, 'RABU', 45),
(29, '17.50', '19.20', 2, 'SELASA', 27),
(30, '18.50', '19.20', 2, 'RABU', 29),
(33, '18.50', '19.20', 1, 'RABU', 30),
(34, '18.50', '19.70', 2, 'JUMAT', 31),
(35, '18.50', '19.20', 1, 'SELASA', 32),
(37, '17.30', '19.00', 1, 'SELASA', 46),
(39, '15.30', '18.00', 1, 'SELASA', 24),
(40, '15.30', '18.00', 2, 'RABU', 43),
(41, '15.30', '18.00', 3, 'KAMIS', 57),
(42, '15.30', '18.00', 3, 'KAMIS', 22),
(43, '15.30', '18.00', 2, 'RABU', 25),
(44, '15.30', '18.00', 2, 'RABU', 33),
(45, '15.30', '18.00', 1, 'RABU', 58),
(46, '19.00', '20.00', 1, 'RABU', 60),
(47, '19.00', '20.00', 2, 'KAMIS', 61),
(48, '19.00', '20.00', 2, 'RABU', 62),
(49, '19.00', '20.00', 1, 'RABU', 63),
(50, '19.00', '20.00', 1, 'KAMIS', 65),
(51, '18.00', '13.00', 3, 'KAMIS', 64),
(52, '18.00', '20.00', 2, 'SELASA', 66),
(53, '18.00', '20.00', 1, 'KAMIS', 67),
(54, '18.00', '19.00', 1, 'SELASA', 23),
(55, '18.00', '19.00', 1, 'SELASA', 35),
(56, '18.00', '19.00', 1, 'SABTU', 36),
(57, '18.00', '19.00', 1, 'SELASA', 37),
(58, '18.00', '19.00', 2, 'SABTU', 38),
(60, '18.00', '19.00', 3, 'SELASA', 55),
(61, '18.00', '19.00', 2, 'JUMAT', 68),
(62, '18.00', '19.00', 2, 'RABU', 69);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` varchar(20) NOT NULL,
  `nama_jawaban` text NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `nama_jawaban`, `solusi`) VALUES
('H2', 'ini contoh hasil 2', 'ini contoh hasil 2\r\nketerangan'),
('K1', 'Matakuliah yang di Paketkan Semester ini', 'Anda Hanya dapat melihat Daftar Matakuliah, karena  telah di program secara otomatis untuk mahasiswa baru'),
('Z1', 'Silahkan Pilih Semester Atas, Anda di tawarkan semester di bawah ini.', 'Anda Hanya Dapat melihat Matakuliah yang terdapat Pada Semester Atas, Anda tidak Dapat Memprogram Matakuliah-matakuliah tersebut. Dikarenakan anda masih Mahasiswa Baru');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(5) NOT NULL,
  `kode_jurusan` varchar(20) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `kode_jurusan`, `nama_jurusan`) VALUES
(1, '12TF', 'Teknik informatika'),
(2, '13TS', 'Teknik Sipil');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(5) NOT NULL,
  `nama_kelas` varchar(60) NOT NULL,
  `keterangan` text NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `keterangan`, `kapasitas`) VALUES
(1, 'A', 'Kelas A adalah jenis pembagian kelas pada kategori makasiswa kelas Pagi', 2),
(2, 'B', 'Kelas B adalah jenis pembagian kelas pada kategori makasiswa kelas Pagi', 2),
(3, 'K', 'Kelas K adalah jenis pembagian kelas pada kategori makasiswa kelas Sore', 5),
(4, 'L', 'Kelas L adalah jenis pembagian kelas pada kategori makasiswa kelas Sore', 5),
(5, 'X', 'Kelas X adalah jenis pembagian kelas pada kategori makasiswa kelas Pagi dan sore yang telah kelebihan kelas', 5),
(6, 'Y', 'Kelas Y adalah jenis pembagian kelas pada kategori makasiswa kelas Pagi dan sore yang telah kelebihan kelas', 5),
(7, 'C', 'Kelas C adalah jenis pembagian kelas pada kategori makasiswa kelas Pagi', 2),
(8, 'D', 'Kelas D adalah jenis pembagian kelas pada kategori makasiswa kelas Pagi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelebihan_sks`
--

CREATE TABLE `kelebihan_sks` (
  `id_kelebihan` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL,
  `lebih` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(10) NOT NULL,
  `nim` int(50) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `pin` int(10) NOT NULL,
  `jenis_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama_mahasiswa`, `pin`, `jenis_kelas`) VALUES
(18, 2012420141, 'Mahasiswa Semester 1', 11111, 'Pagi'),
(19, 2012420142, 'Mahasiswa Semester 2', 22222, 'Pagi'),
(20, 2012420143, 'Mahasiswa Semester 3', 33333, 'Pagi'),
(21, 2012420144, 'Mahasiswa Semester 4', 44444, 'Pagi'),
(22, 2012420145, 'Mahasiswa Semester 5', 55555, 'Pagi'),
(23, 2012420146, 'Mahasiswa Semester 6', 66666, 'Pagi'),
(24, 2012420147, 'Mahasiswa Semester 7', 77777, 'Pagi'),
(25, 2012420148, 'Mahasiswa Semester 8', 88888, 'Pagi');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id_mk` int(5) NOT NULL,
  `kode_mk` varchar(50) NOT NULL,
  `nama_matakuliah` varchar(100) NOT NULL,
  `sks` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id_mk`, `kode_mk`, `nama_matakuliah`, `sks`) VALUES
(1, 'IN2A34', 'Algoritma & Pemrograman 2', 3),
(2, 'IN1A35', 'Algoritma & Pemrograman 1', 3),
(5, 'IN6A12', 'Kuliah Kerja Nyata (KKN)', 1),
(9, 'MKK124', 'Kalkulus 1', 2),
(10, 'MKK222', 'Kalkulus 2', 2),
(11, 'IN1A18', 'Praktikum Algoritma & Pemrograman 1', 1),
(12, 'IN2A18', 'Praktikum Algoritma & Pemrograman 2', 1),
(18, 'IN5A31', 'Kecerdasan Buatan', 3),
(19, 'IN5A34', 'Pemrograman Framework', 3),
(20, 'IN5A18', 'Praktikum Pemrograman Framework', 1),
(21, 'IN5A36', 'Pemrograman Jaringan', 3),
(23, 'IN8A51', 'Skripsi / Tugas Akhir', 5),
(24, 'MPK001', 'Agama', 3),
(25, 'MPK002', 'Pendidikan Pancasila', 3),
(26, 'MPK003', 'Bahasa Indonesia', 3),
(27, 'MPK004', 'Pendidikan Kewarganegaraan', 3),
(28, 'MPK005', 'Manajemen Bencana dan Lingkungan', 1),
(29, 'MPK006', 'Kewirausahaan dan Koperasi', 2),
(30, 'MPK007', 'Pendidikan Anti Koruppsi', 2),
(31, 'IN1A19', 'Praktikum Dasar Komputer', 1),
(32, 'IN1A36', 'Pengantar Teknologi Informasi', 3),
(33, 'IN1A37', 'Teknik Digital', 3),
(34, 'IN2A36', 'Arsitektur & Organisasi Komputer', 3),
(35, 'IN5A33', 'Sistem Informasi', 3),
(36, 'IN3A34', 'Matematika Diskrit', 3),
(37, 'IN4A31', 'Pemrograman Berorientasi Obyek', 3),
(38, 'IN3A36', 'Sistem Basis Data', 3),
(39, 'IN3A31', 'Sistem Operasi', 3),
(40, 'IN3A19', 'Praktikum Sistem Basis Data', 1),
(41, 'IN3A12', 'Praktikum Sistem Operasi', 1),
(42, 'IN4A33', 'Rekayasa Perangkat Lunak (RPL)', 3),
(43, 'IN4A32', 'Teori Graph & Automata', 3),
(44, 'IN4A36', 'Jaringan Komputer', 3),
(45, 'IN4A18', 'Praktikum Jaringan Komputer', 1),
(46, 'IN3A25', 'Algoritma & Pemrograman Lanjut', 2),
(47, 'IN4A34', 'Desain & Pemrograman Web', 3),
(48, 'IN5A35', 'Sistem Basis Data Lanjut', 3),
(49, 'IN4A17', 'Praktikum Pemrograman Web', 1),
(50, 'IN5A27', 'Kerja Praktek', 2),
(51, 'IN7C31', 'Knowlage Base System', 3),
(52, 'IN7C32', 'Topik Khusus Intelligence System', 3),
(53, 'IN7C33', 'Natural Language Procesing', 3),
(54, 'IN7C34', 'Geographical Information System', 3),
(55, 'IN7C35', 'Digital Intelegence', 3),
(56, 'IN7C36', 'E-Learning', 3),
(57, 'IN7C37', 'E-Commerce', 3),
(58, 'IN7C37', 'E-Goverment', 3),
(59, 'IN7C39', 'Mobile Programming', 3),
(60, 'IN7A13', 'Ujian Kompetensi', 1),
(61, 'MKK233', 'Aljabar Linier & Matriks', 3),
(62, 'IN2A25', 'Kecakapan Antar Personal', 2),
(63, 'MKB123', 'Bahasa Inggris & Pre TOEFL', 2),
(64, 'IN6C31', 'Data Mining', 3),
(65, 'IN6C32', 'Data Warehouse', 3),
(66, 'IN6C33', 'Sistem Pendukung Keputusan ( SPK )', 3),
(67, 'IN6C34', 'Analisa & Desain Sistem', 3),
(68, 'IN6C35', 'SIstem Pakar', 3),
(70, 'IN7A22', 'Sosio & Etika', 2),
(71, 'IN6M31', 'Kecerdasan Buatan Game', 3),
(72, 'IN6M32', 'Augmented Reality', 3),
(73, 'IN6M33', 'Pengolahan Bahasa Manusia (NLP)', 3),
(74, 'IN6M34', 'Pemrograman Berorientasi Game', 3),
(75, 'IN6M35', 'Skenario & Desain Game', 3),
(76, 'IN7M31', 'Pemrograman Animasi', 3),
(77, 'IN7M32', 'Pemodelan 3D ( Blender, 3D Max, Unity )', 3),
(78, 'IN7M33', 'Mobile Game Programming', 3),
(79, 'IN7M34', 'Network Game Programing', 3),
(80, 'IN7M35', 'Game Engine Programing', 3),
(81, 'IN7M36', 'Desain Karakter Game', 3),
(82, 'IN7M37', 'Visi Komputer', 3),
(83, 'IN7M38', 'Jaringan Multimedia', 3),
(84, 'IN7M39', 'Topik Khusus Komputasi Cerdas & Visualisasi', 3),
(85, 'IN6P31', 'Rangkaian Listrik', 3),
(86, 'IN6P32', 'Rangkaian Elktronika', 3),
(87, 'IN6P33', 'Mikroprosessor', 3),
(88, 'IN6P34', 'Mikontroler', 3),
(89, 'IN6P35', 'Interfacing', 3),
(90, 'IN7P31', 'Sistem Kendali Cerdas', 3),
(91, 'IN7P32', 'Topik Khusus Robotika', 3),
(92, 'IN7P33', 'Automasi Industri', 3),
(93, 'IN7P34', 'Sensor & Akuator', 3),
(94, 'IN7P35', 'Pengolahan Sinyal Digital', 3),
(95, 'IN7P36', 'Pembelajaran Mesin', 3),
(96, 'IN7P37', 'Optimasi Non Linier', 3),
(97, 'IN7P38', 'Sistem Non Linier', 3),
(98, 'IN7P39', 'Computer Vision', 3);

-- --------------------------------------------------------

--
-- Table structure for table `minat`
--

CREATE TABLE `minat` (
  `id_minat` int(5) NOT NULL,
  `nama_minat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `minat`
--

INSERT INTO `minat` (`id_minat`, `nama_minat`) VALUES
(1, 'SC'),
(2, 'PPK'),
(3, 'JCM');

-- --------------------------------------------------------

--
-- Table structure for table `mk_syarat`
--

CREATE TABLE `mk_syarat` (
  `id_syarat` int(5) NOT NULL,
  `id_mk` int(5) NOT NULL,
  `id_semester` int(10) NOT NULL,
  `syarat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mk_syarat`
--

INSERT INTO `mk_syarat` (`id_syarat`, `id_mk`, `id_semester`, `syarat`) VALUES
(17, 12, 12, 11),
(18, 34, 12, 33),
(20, 37, 13, 1),
(21, 10, 12, 9),
(22, 1, 12, 2),
(23, 38, 13, 12),
(24, 40, 13, 12),
(25, 39, 13, 34),
(26, 41, 13, 34),
(27, 42, 14, 35),
(28, 43, 14, 36),
(29, 46, 14, 37),
(31, 50, 15, 38),
(32, 50, 15, 44),
(33, 21, 15, 44),
(36, 48, 14, 38),
(37, 18, 15, 1),
(38, 1, 12, 11),
(41, 23, 18, 60),
(42, 64, 16, 48),
(43, 12, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mk_tawaran`
--

CREATE TABLE `mk_tawaran` (
  `id_mk_tawaran` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL,
  `id_semester` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mk_tawaran`
--

INSERT INTO `mk_tawaran` (`id_mk_tawaran`, `id_mk`, `id_semester`) VALUES
(13, 1, 12),
(52, 2, 11),
(63, 5, 16),
(53, 9, 11),
(14, 10, 12),
(54, 11, 11),
(15, 12, 12),
(33, 18, 15),
(25, 19, 15),
(22, 20, 15),
(34, 21, 15),
(39, 23, 18),
(16, 24, 12),
(17, 25, 12),
(18, 26, 12),
(62, 27, 15),
(61, 28, 16),
(49, 29, 18),
(50, 30, 18),
(11, 32, 11),
(51, 33, 11),
(19, 34, 12),
(26, 35, 13),
(27, 36, 13),
(42, 37, 13),
(29, 38, 13),
(30, 39, 13),
(31, 40, 13),
(32, 41, 13),
(24, 42, 14),
(43, 43, 14),
(44, 44, 14),
(45, 45, 14),
(46, 47, 14),
(58, 48, 14),
(57, 49, 14),
(60, 50, 15),
(35, 51, 17),
(36, 52, 17),
(37, 53, 17),
(38, 54, 17),
(55, 55, 17),
(68, 60, 17),
(56, 61, 11),
(10, 62, 11),
(12, 63, 11),
(48, 64, 16),
(65, 65, 16),
(69, 70, 17),
(64, 71, 16),
(66, 72, 16),
(23, 77, 17),
(67, 87, 16),
(47, 95, 17);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(5) NOT NULL,
  `id_mk` int(10) NOT NULL,
  `id_mahasiswa` int(50) NOT NULL,
  `id_semester` int(5) NOT NULL,
  `tugas` decimal(20,0) NOT NULL,
  `uts` varchar(20) NOT NULL,
  `uas` decimal(20,0) NOT NULL,
  `akhir` float NOT NULL,
  `huruf` varchar(3) NOT NULL,
  `bobot` varchar(10) NOT NULL,
  `sks` int(10) NOT NULL,
  `mutu` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_mk`, `id_mahasiswa`, `id_semester`, `tugas`, `uts`, `uas`, `akhir`, `huruf`, `bobot`, `sks`, `mutu`) VALUES
(13, 2, 18, 11, '90', '90', '90', 90, 'A', '4', 3, 12),
(14, 9, 18, 11, '90', '90', '90', 90, 'A', '4', 2, 8),
(15, 11, 18, 11, '90', '90', '90', 90, 'A', '4', 1, 4),
(17, 61, 18, 11, '90', '90', '90', 90, 'A', '4', 3, 12),
(18, 62, 18, 11, '90', '90', '90', 90, 'A', '4', 2, 8),
(19, 32, 18, 11, '90', '90', '90', 90, 'A', '4', 3, 12),
(20, 63, 18, 11, '10', '10', '10', 10, 'E', '0', 2, 0),
(43, 1, 18, 12, '90', '90', '90', 90, 'A', '4', 3, 12),
(44, 10, 18, 12, '90', '90', '90', 90, 'A', '4', 2, 8),
(46, 35, 18, 13, '90', '90', '90', 90, 'A', '4', 3, 12),
(47, 36, 18, 13, '90', '90', '90', 90, 'A', '4', 3, 12),
(48, 38, 18, 13, '90', '90', '90', 90, 'A', '4', 3, 12),
(49, 12, 18, 12, '90', '90', '90', 90, 'A', '4', 1, 4),
(50, 24, 18, 12, '90', '90', '90', 90, 'A', '4', 3, 12),
(51, 25, 18, 12, '90', '90', '90', 90, 'A', '4', 3, 12),
(52, 26, 18, 12, '10', '10', '10', 10, 'E', '0', 3, 0),
(54, 29, 18, 14, '90', '90', '90', 90, 'A', '4', 2, 8),
(55, 42, 18, 14, '90', '90', '90', 90, 'A', '4', 3, 12),
(56, 44, 18, 14, '10', '90', '90', 63.3333, 'C+', '2.5', 3, 8),
(57, 45, 18, 14, '90', '90', '90', 90, 'A', '4', 1, 4),
(58, 47, 18, 14, '90', '90', '90', 90, 'A', '4', 3, 12),
(59, 49, 18, 14, '10', '10', '10', 10, 'E', '0', 1, 0),
(60, 34, 18, 12, '70', '90', '80', 80, 'A-', '3.75', 3, 11),
(69, 48, 18, 14, '90', '90', '90', 90, 'A', '4', 3, 12),
(70, 20, 18, 15, '80', '80', '80', 80, 'A-', '3.75', 1, 4),
(71, 19, 18, 15, '90', '90', '90', 90, 'A', '4', 3, 12),
(72, 18, 18, 15, '90', '90', '90', 90, 'A', '4', 3, 12),
(73, 50, 18, 15, '10', '10', '10', 10, 'E', '0', 2, 0),
(74, 27, 18, 15, '10', '10', '10', 10, 'E', '0', 3, 0),
(75, 64, 18, 16, '90', '90', '90', 90, 'A', '4', 3, 12),
(76, 65, 18, 16, '90', '90', '90', 90, 'A', '4', 3, 12),
(79, 87, 18, 16, '90', '90', '90', 90, 'A', '4', 3, 12),
(82, 71, 18, 16, '90', '90', '90', 90, 'A', '4', 3, 12),
(83, 72, 18, 15, '90', '90', '90', 90, 'A', '4', 3, 12),
(84, 28, 18, 16, '90', '90', '90', 90, 'A', '4', 1, 4),
(85, 5, 18, 16, '90', '90', '90', 90, 'A', '4', 1, 4),
(86, 51, 18, 17, '90', '10', '90', 63.3333, 'C+', '2.5', 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `paket_mk`
--

CREATE TABLE `paket_mk` (
  `id_paket` int(10) NOT NULL,
  `id_semester` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket_mk`
--

INSERT INTO `paket_mk` (`id_paket`, `id_semester`, `id_mk`) VALUES
(5, 11, 2),
(6, 11, 9),
(7, 11, 61),
(8, 11, 62),
(9, 11, 63),
(10, 11, 11),
(11, 11, 32),
(12, 11, 31),
(13, 11, 33);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` varchar(20) NOT NULL,
  `id_semester` int(20) NOT NULL,
  `nama_pertanyaan` text NOT NULL,
  `jika_ya` varchar(20) NOT NULL,
  `jika_tidak` varchar(20) NOT NULL,
  `mulai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `id_semester`, `nama_pertanyaan`, `jika_ya`, `jika_tidak`, `mulai`) VALUES
(' HSMT3', 13, 'KRS Semester 3 Anda, Berhasil di Cetak. Anda akan mengikuti Perkuliahan Berdasarkan Matakuliah yang terdaftar dibawah ini.', '', '', 'T'),
(' HSMT7', 17, 'KRS Semester 7 Anda, Berhasil di Cetak. Anda akan mengikuti Perkuliahan Berdasarkan Matakuliah yang terdaftar dibawah ini.', '', '', 'T'),
('HSMT1', 11, 'KRS Semester 1 Anda, Berhasil di Cetak.\r\nAnda akan mengikuti Perkuliahan Berdasarkan Matakuliah yang terdaftar dibawah ini.', '', '', 'Y'),
('HSMT2', 12, 'KRS Semester 2 Anda, Berhasil di Cetak.\r\nAnda akan mengikuti Perkuliahan Berdasarkan Matakuliah yang terdaftar dibawah ini.', 'HSMT2', 'HSMT2', 'T'),
('HSMT4', 14, 'KRS Semester 4 Anda, Berhasil di Cetak. Anda akan mengikuti Perkuliahan Berdasarkan Matakuliah yang terdaftar dibawah ini.', '', '', 'T'),
('P1SMT2', 12, 'Apakah Anda ingin Mengambil semua matakuliah Pada semester ini saja (Semester 2 ) ?', 'PKT2', 'RB1SMT2-2', 'Y'),
('P1SMT3', 13, 'Apakah Anda ingin Mengambil semua matakuliah Pada semester ini saja (Semester 3 ) ?', 'PKT3', 'RB1SMT3-3', 'Y'),
('P1SMT4', 14, 'Apakah Anda ingin Mengambil semua matakuliah Pada semester ini saja (Semester 4 ) ?', 'PKT4', 'RB1SMT4-4', 'Y'),
('P1SMT5', 15, 'Apakah Anda ingin Mengambil semua matakuliah Pada semester ini saja (Semester 5 ) ?', 'PKT5', 'RB1SMT5-5', 'Y'),
('P1SMT7', 17, 'Apakah Anda ingin Mengambil semua matakuliah Pada semester ini saja (Semester 7 ) ?', 'PKT7', 'RB1SMT7-7', 'Y'),
('P1SMT8', 18, 'Apakah Anda ingin Mengambil semua matakuliah Pada semester ini saja (Semester 8 ) ?', 'PKT8', 'RB1SMT8-8', 'Y'),
('P2SMT2-2', 12, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas, Dalam Konteks ini adalah (Semester 4 )', 'RB1SMT4-2', 'P2SMT4-2', 'T'),
('P2SMT4-2', 12, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas, Dalam Konteks ini adalah (Semester 6)', 'RB1SMT6-2', 'P2SMT6-2', 'T'),
('P2SMT4-4', 14, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah ? <br> Dikarenakan Anda Masih Memiliki Kelebihan SKS. Dalam Konteks ini adalah (Semester 4 )', 'RB1SMT4-4', 'P4SMT4', 'T'),
('P2SMT5-3', 13, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas ? <br> Dalam Konteks ini Anda ditawarkan Matakuliah Semester 5.', 'RB1SMT5-3', 'P2SMT7-3', 'T'),
('P2SMT5-5', 15, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dikarenakan Anda Masih Memiliki Kelebihan SKS. Dalam Konteks ini adalah (Semester 5 )', 'RB1SMT5-5', 'P4SMT5', 'T'),
('P2SMT6-2', 12, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas, Dalam Konteks ini adalah (Semester 8 )', 'RB1SMT8-2', 'RB1SMT2-2', 'T'),
('P2SMT6-4', 14, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas  ?<br>Dalam Konteks ini Anda Ditawarkan Matakuliah (Semester 6)', 'RB1SMT6-4', 'P2SMT8-4', 'T'),
('P2SMT6-6', 16, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah ?\r\nDikarenakan Anda Masih Memiliki Kelebihan SKS. Dalam Konteks ini adalah (Semester 6 )', 'PKT6EMPTY', 'P4SMT6', 'T'),
('P2SMT7-3', 13, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas ? <br>\r\nDalam Konteks ini Anda ditawarkan Matakuliah Semester 7.', 'RB1SMT7-3', 'RB1SMT3-3', 'T'),
('P2SMT7-5', 15, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas, Dalam Konteks ini adalah (Semester 7 )', 'RB1SMT7-5', 'RB1SMT5-5', 'T'),
('P2SMT8-2', 12, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah,  Dikarenakan Anda Masih Memiliki Kelebihan SKS. Dalam Konteks ini adalah (Semester 2 )', 'RB1SMT2-2', 'P4SMT2', 'T'),
('P2SMT8-4', 14, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas ? <br>\r\nDalam Konteks ini Anda Ditawarkan Matakuliah (Semester 8)', 'RB1SMT8-4', 'RB1SMT4-4', 'T'),
('P2SMT8-6', 16, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Atas, Dalam Konteks ini adalah (Semester 8 )', 'RB1SMT8-6', 'P4SMT6', 'T'),
('P3SMT1-3', 13, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 1 ).\r\nKemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 1 ini.', 'RB3SMT1-3', 'P2SMT5-3', 'T'),
('P3SMT1-5', 15, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 1 ).\r\nKemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 1 ini.', 'RB3SMT1-5', 'RB4SMT3-5', 'T'),
('P3SMT1-7', 17, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 1 ).\r\nKemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 1 ini.', 'RB3SMT1-7', 'RB4SMT3-7', 'T'),
('P3SMT2-4', 14, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 2 ). Kemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 2 ini.', 'RB3SMT2-4', 'P2SMT6-4', 'T'),
('P3SMT2-6', 16, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 2 ). Kemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 2 ini.', 'RB3SMT2-6', 'RB4SMT4-6', 'T'),
('P3SMT2-8', 18, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 2 ). Kemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 2 ini.', 'RB3SMT2-8', 'RB4SMT4-8', 'T'),
('P3SMT3-5', 15, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 3 ).\r\nKemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 3 ini.', 'RB3SMT3-5', 'P2SMT7-5', 'T'),
('P3SMT3-7', 17, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 3 ).\r\nKemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 3 ini.', 'RB3SMT3-7', 'RB4SMT5-7', 'T'),
('P3SMT4-6', 16, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 4 ). Kemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 4 ini.', 'RB3SMT4-6', 'P4SMT6', 'T'),
('P3SMT4-8', 18, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 4 ). Kemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 4 ini.', 'RB3SMT4-8', 'RB4SMT6-8', 'T'),
('P3SMT5-7', 17, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 5 ).\r\nKemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 5 ini.', 'RB3SMT5-7', 'P1SMT7', 'T'),
('P3SMT6-8', 18, 'Apakah Anda Ingin Kontrak Matakuliah Pada Semester Bawah, Dalam Konteks ini adalah (Semester 6 ). Kemungkinan Anda Belum Lulus atau Belum Kontrak Matakuliah di Semester 6 ini.', 'RB3SMT6-8', 'P1SMT8', 'T'),
('P4SMT2', 12, 'Dibawah ini adalah Daftar Matakuliah yang Telah anda Program. Apakah Anda Yakin CETAK Sebagai KRS Anda di Semester 2 ?', 'HSMT2', 'P1SMT2', 'T'),
('P4SMT3', 13, 'Dibawah ini adalah Daftar Matakuliah yang Telah anda Program. Apakah Anda Yakin CETAK Sebagai KRS Anda di Semester 3 ?', ' HSMT3', 'P1SMT3', 'T'),
('P4SMT4', 14, 'Dibawah ini adalah Daftar Matakuliah yang Telah anda Program. Apakah Anda Yakin CETAK Sebagai KRS Anda di Semester 4 ?', '', 'P1SMT4', 'T'),
('P4SMT5', 15, 'Dibawah ini adalah Daftar Matakuliah yang Telah anda Program. Apakah Anda Yakin CETAK Sebagai KRS Anda di Semester 5 ?', '', '', 'T'),
('P4SMT6', 16, 'Dibawah ini adalah Daftar Matakuliah yang Telah anda Program. Apakah Anda Yakin CETAK Sebagai KRS Anda di Semester 6 ?', '', '', 'T'),
('P4SMT7', 17, 'Dibawah ini adalah Daftar Matakuliah yang Telah anda Program. Apakah Anda Yakin CETAK Sebagai KRS Anda di Semester 7 ?', '', '', 'T'),
('P4SMT8', 18, 'Dibawah ini adalah Daftar Matakuliah yang Telah anda Program. Apakah Anda Yakin CETAK Sebagai KRS Anda di Semester 8 ?', '', '', 'T'),
('P5SMT6', 16, 'Anda sekarang berada di semester 6, Silahkan Melanjutkan Proses KRS anda Untuk Mengetahui Jenis Bidang Minat yang di Rekomendasikan Kepada Anda !', 'P5SMT6SC', '', 'Y'),
('P5SMT6JCM', 16, 'Anda Di Rekomendasi Bidang Minat Jarungan Cerdas Multimedia (JCM).Apakah Anda ingin Kotrak Bidang Minat ini ?', 'PKT6JCM', 'P5SMT6TJCMPPK', 'T'),
('P5SMT6PPK', 16, 'Anda Di Rekomendasi Bidangminat Pemrograman Perangkat Keras (PPK).Apakah Anda ingin Kotrak Bidang Minat ini ?', 'PKT6PPK', 'P5SMT6TPPKJCM', 'T'),
('P5SMT6SC', 16, 'Anda Di Rekomendasi Bidang Minat \r\nSistem Cerdas (SC).Apakah Anda ingin Kontrak Bidang Minat ini ?', 'PKT6SC', 'P5SMT6TSCPPK', 'T'),
('P5SMT6TJCMPPK', 16, 'Anda Ditawarkan Bidangminat Pemrograman Perangkat Keras (PPK), Apakah anda ingin Kontrak Semua Matakuliah Di Semester Ini Saja ?', 'PKT6PPK', 'P5SMT6TJCMSC', 'T'),
('P5SMT6TJCMSC', 16, 'Anda Ditawarkan Bidangminat Sistem Cerdas , Apakah anda ingin Kontrak Semua Matakuliah Di Semester Ini Saja ?', 'PKT6SC', 'P5SMT6PPK', 'T'),
('P5SMT6TPPKJCM', 16, 'Anda Ditawarkan Bidangminat Jaringan Cerdas Multimedia (JCM), Apakah anda ingin Kontrak Semua Matakuliah Di Semester Ini Saja ?', 'PKT6JCM', 'P5SMT6TPPKSC', 'T'),
('P5SMT6TPPKSC', 16, 'Anda Ditawarkan Bidangminat Sistem Cerdas (SC), Apakah anda ingin Kontrak Semua Matakuliah Di Semester Ini Saja ?', 'PKT6SC', 'P5SMT6PPK', 'T'),
('P5SMT6TSC', 16, 'Anda Ditawarkan Bidangminat Sistem Cerdas, Apakah anda ingin Kontrak Semua Matakuliah Di Semester Ini Saja ?', '', 'P5SMT6SC', 'T'),
('P5SMT6TSCJCM', 16, 'Anda Ditawarkan Bidangminat Jaringan Cerdas Multimedia (JCM). Apakah anda ingin Kontrak Semua Matakuliah Di Semester Ini Saja ?', 'PKT6JCM', 'P5SMT6SC', 'T'),
('P5SMT6TSCPPK', 16, 'Anda Ditawarkan Bidangminat Pemrograman Perangkat Keras (PPK). Apakah anda ingin Kontrak Semua Matakuliah Di Semester Ini Saja ?', 'PKT6PPK', 'P5SMT6TSCJCM', 'T'),
('PKT2', 12, 'Anda Diberikan Paket Matakuliah Semester 2 secara Otomatis dikarekanan anda Memilih Matakuliah Paket.', 'RB2SMT2-2', 'P4SMT2', 'T'),
('PKT3', 13, 'Anda Diberikan Paket Matakuliah Semester 3 secara Otomatis dikarekanan anda Memilih Matakuliah Paket.', 'P4SMT3', 'RB1SMT3-3', 'T'),
('PKT4', 14, 'Anda Diberikan Paket Matakuliah Semester 4 secara Otomatis dikarekanan anda Memilih Matakuliah Paket.', '', '', 'T'),
('PKT5', 13, 'Anda Diberikan Paket Matakuliah Semester 5 secara Otomatis dikarekanan anda Memilih Matakuliah Paket.', '', '', 'T'),
('PKT6', 16, 'Anda Diberikan Paket Matakuliah Semester 6 secara Otomatis dikarekanan anda Memilih Matakuliah Paket.', '', '', 'T'),
('PKT6EMPTY', 16, 'Anda Tidak Di Rekomendasi / Di tawarkan Matakuliah Bidang MInat, Dikarekanakan Anda Tidak Lulus Matakuliah Prasyarat.\r\nSilahkan Pilih Matakuliah Dibawah ini !', 'RB2SMT6-6', '', 'T'),
('PKT6JCM', 16, 'Anda Diberikan Paket Matakuliah Bidang Minat Jaringan Cerdas Multimedia Semester 6 secara Otomatis.', '', '', 'T'),
('PKT6PPK', 16, 'Anda Diberikan Paket Matakuliah Bidang Minat Pemrograman Perangkat Keras Semester 6 secara Otomatis.', '', '', 'T'),
('PKT6SC', 16, 'Anda Diberikan Paket Matakuliah Bidang Minat Sistem Cerdas Semester 6 secara Otomatis.', '', '', 'T'),
('PKT7', 17, 'Anda Diberikan Paket Matakuliah Semester 7 secara Otomatis dikarekanan anda Memilih Matakuliah Paket.', '', '', 'T'),
('PKT8', 18, 'Anda Diberikan Paket Matakuliah Semester 8 secara Otomatis dikarekanan anda Memilih Matakuliah Paket.', '', '', 'T'),
('RB1SMT2-2', 12, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 2', 'RB2SMT2-2', 'P1SMT2', 'T'),
('RB1SMT2-4', 14, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 2', '', '', 'T'),
('RB1SMT3-3', 13, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 3', 'RB2SMT3-3', 'P1SMT3', 'T'),
('RB1SMT4-2', 12, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 4', 'RB2SMT4-2', 'RB1SMT2-2', 'T'),
('RB1SMT4-4', 14, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 4', 'RB2SMT4-4', 'P1SMT4', 'T'),
('RB1SMT5-3', 13, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 5', 'RB2SMT5-3', 'RB1SMT3-3', 'T'),
('RB1SMT5-5', 15, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 5', 'RB2SMT5-5', '', 'T'),
('RB1SMT6-2', 12, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 6', 'RB2SMT6-2', 'RB1SMT4-2', 'T'),
('RB1SMT6-4', 14, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 6', 'RB2SMT6-4', 'RB1SMT4-4', 'T'),
('RB1SMT7-3', 13, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 7', 'RB2SMT7-3', 'RB1SMT5-3', 'T'),
('RB1SMT7-5', 15, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 7', 'RB2SMT7-5', 'P4SMT5', 'T'),
('RB1SMT7-7', 17, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 7', 'RB2SMT7-7', '', 'T'),
('RB1SMT8-2', 12, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 8', 'RB2SMT8-2', 'RB1SMT6-2', 'T'),
('RB1SMT8-4', 14, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 8', 'RB2SMT8-4', 'RB1SMT6-4', 'T'),
('RB1SMT8-6', 16, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 8', 'RB2SMT8-6', 'P2SMT8-6', 'T'),
('RB1SMT8-8', 18, 'Dibawah Ini adalah Matakuliah yang ditawarkan kepada Anda. Silahkan Pilih Matakuliah Semester 8', 'RB2SMT8-8', 'P4SMT8', 'T'),
('RB2SMT1-3', 13, 'Periksa Apakah Masih Kelebihan SKS di Semester 1. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 1.', 'P2SMT5-3', 'P4SMT3', 'T'),
('RB2SMT1-5', 15, 'Periksa Apakah Masih Kelebihan SKS di Semester 5. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 1.', 'RB4SMT3-5', 'P4SMT5', 'T'),
('RB2SMT1-7', 17, 'Periksa Apakah Masih Kelebihan SKS di Semester 7. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 1.', 'RB4SMT3-7', 'P4SMT7', 'T'),
('RB2SMT2-2', 12, 'Periksa Apakah Masih Kelebihan SKS di Semester 2.\r\nSKS Anda yang tersisa  Setelah Proses yang anda di lakukan di Matakuliah Semester 2.', 'P2SMT2-2', 'P4SMT2', 'T'),
('RB2SMT2-4', 14, 'Periksa Apakah Masih Kelebihan SKS di Semester 2. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 2.', 'P2SMT6-4', 'P4SMT4', 'T'),
('RB2SMT2-6', 16, 'Periksa Apakah Masih Kelebihan SKS di Semester 6. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 2.', 'RB4SMT4-6', 'P4SMT6', 'T'),
('RB2SMT2-8', 18, 'Periksa Apakah Masih Kelebihan SKS di Semester 8. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 2.', 'RB4SMT4-8', 'P4SMT8', 'T'),
('RB2SMT3-3', 13, 'Periksa Apakah Masih Kelebihan SKS di Semester 3. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 3.', 'RB4SMT1', 'P4SMT3', 'T'),
('RB2SMT3-5', 15, 'Periksa Apakah Masih Kelebihan SKS di Semester 5. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 3.', '', '', 'T'),
('RB2SMT3-7', 17, 'Periksa Apakah Masih Kelebihan SKS di Semester 7. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 3.', 'RB4SMT5-7', 'P4SMT7', 'T'),
('RB2SMT4-2', 12, 'Periksa Apakah Masih Kelebihan SKS di Semester 2.\r\nSKS Anda yang tersisa  Setelah Proses yang anda di lakukan di Matakuliah Semester 4.', 'P2SMT4-2', 'P4SMT2', 'T'),
('RB2SMT4-4', 14, 'Periksa Apakah Masih Kelebihan SKS di Semester 4. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 4.', 'RB4SMT2', 'P4SMT4', 'T'),
('RB2SMT4-6', 16, 'Periksa Apakah Masih Kelebihan SKS di Semester 6. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 4.', 'P2SMT8-6', 'P4SMT6', 'T'),
('RB2SMT4-8', 18, 'Periksa Apakah Masih Kelebihan SKS di Semester 8. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 4.', 'RB4SMT6-8', 'P4SMT8', 'T'),
('RB2SMT5-3', 13, 'Periksa Apakah Masih Kelebihan SKS di Semester 5. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 5.', 'P2SMT7-3', 'P4SMT3', 'T'),
('RB2SMT5-5', 15, 'Periksa Apakah Masih Kelebihan SKS di Semester 5. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 5.', 'RB4SMT1-5', '', 'T'),
('RB2SMT5-7', 17, 'Periksa Apakah Masih Kelebihan SKS di Semester 7. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 5.', 'P1SMT7', 'P4SMT7', 'T'),
('RB2SMT6-2', 12, 'Periksa Apakah Masih Kelebihan SKS di Semester 2. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 6.', 'P2SMT6-2', 'P4SMT2', 'T'),
('RB2SMT6-4', 14, 'Periksa Apakah Masih Kelebihan SKS di Semester 6. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 6.', 'P2SMT8-4', 'P4SMT4', 'T'),
('RB2SMT6-6', 16, 'Periksa Apakah Masih Kelebihan SKS di Semester 6. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 6.', 'RB4SMT2-6', 'P4SMT6', 'T'),
('RB2SMT6-8', 18, 'Periksa Apakah Masih Kelebihan SKS di Semester 8. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 6.', 'P1SMT8', 'P4SMT8', 'T'),
('RB2SMT7-3', 13, 'Periksa Apakah Masih Kelebihan SKS di Semester 7. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 7.', 'RB1SMT3-3', 'P4SMT3', 'T'),
('RB2SMT7-5', 15, 'Periksa Apakah Masih Kelebihan SKS di Semester 5. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 7.', 'P2SMT5-5', 'P4SMT5', 'T'),
('RB2SMT7-7', 17, 'Periksa Apakah Masih Kelebihan SKS di Semester 7. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 7.', 'RB4SMT1-7', 'P4SMT7', 'T'),
('RB2SMT8-2', 12, 'Periksa Apakah Masih Kelebihan SKS di Semester 2. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 8.', 'P2SMT8-2', 'P4SMT2', 'T'),
('RB2SMT8-4', 14, 'Periksa Apakah Masih Kelebihan SKS di Semester 4. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 8.', 'P2SMT4-4', 'P4SMT4', 'T'),
('RB2SMT8-6', 16, 'Periksa Apakah Masih Kelebihan SKS di Semester 6. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 8.', 'P2SMT6-6', 'P4SMT6', 'T'),
('RB2SMT8-8', 18, 'Periksa Apakah Masih Kelebihan SKS di Semester 8. SKS Anda yang tersisa Setelah Proses yang anda di lakukan di Matakuliah Semester 8.', 'RB4SMT2-8', 'P4SMT8', 'T'),
('RB3SMT1-3', 13, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 1', 'RB2SMT1-3', 'RB2SMT3-3', 'T'),
('RB3SMT1-5', 15, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 1', 'RB2SMT1-5', 'RB1SMT5-5', 'T'),
('RB3SMT1-7', 17, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 1', 'RB2SMT1-7', 'P3SMT1-7', 'T'),
('RB3SMT2', 12, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 2', '', '', 'T'),
('RB3SMT2-4', 14, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 2', 'RB2SMT2-4', 'RB1SMT4-4', 'T'),
('RB3SMT2-6', 16, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 2', 'RB2SMT2-6', 'P3SMT2-6', 'T'),
('RB3SMT2-8', 18, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 2', 'RB2SMT2-8', 'P3SMT2-8', 'T'),
('RB3SMT3', 13, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 3', '', '', 'T'),
('RB3SMT3-5', 15, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 3', 'RB2SMT3-5', 'RB1SMT5-5', 'T'),
('RB3SMT3-7', 17, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 3', 'RB2SMT3-7', 'P3SMT3-7', 'T'),
('RB3SMT4', 14, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 4', '', '', 'T'),
('RB3SMT4-6', 16, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 4', 'RB2SMT4-6', 'P3SMT4-6', 'T'),
('RB3SMT4-8', 18, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 4', 'RB2SMT4-8', 'P3SMT4-8', 'T'),
('RB3SMT5', 15, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 5', '', '', 'T'),
('RB3SMT5-7', 17, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 5', 'RB2SMT5-7', 'P3SMT5-7', 'T'),
('RB3SMT6', 16, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 6', '', '', 'T'),
('RB3SMT6-8', 18, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 6', 'RB2SMT6-8', 'P3SMT6-8', 'T'),
('RB3SMT7', 17, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 7', '', '', 'T'),
('RB3SMT8', 18, 'Dibawah ini Adalah Matakuliah yang Belum Lulus Atau Belum di Kontrak Oleh Anda. Silahkan Pilih Matakuliah Semester 8', '', '', 'T'),
('RB4SMT1', 11, 'Periksa Apakah Semester 1 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT1-3', 'P2SMT5-3', 'T'),
('RB4SMT1-5', 15, 'Periksa Apakah Semester 1 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT1-5', 'RB4SMT3-5', 'T'),
('RB4SMT1-7', 17, 'Periksa Apakah Semester 1 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT1-7', 'RB4SMT3-7', 'T'),
('RB4SMT2', 12, 'Periksa Apakah Semester 2 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT2-4', 'P2SMT6-4', 'T'),
('RB4SMT2-6', 16, 'Periksa Apakah Semester 2 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT2-6', '', 'T'),
('RB4SMT2-8', 18, 'Periksa Apakah Semester 2 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT2-8', 'RB4SMT4-8', 'T'),
('RB4SMT3', 13, 'Periksa Apakah Semester 3 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT3-5', 'P2SMT7-5', 'T'),
('RB4SMT3-5', 15, 'Periksa Apakah Semester 3 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT3-5', 'P2SMT7-5', 'T'),
('RB4SMT3-7', 17, 'Periksa Apakah Semester 3 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT3-7', 'RB4SMT5-7', 'T'),
('RB4SMT4', 14, 'Periksa Apakah Semester 4 Ada Matkuliah yang belum lulus Atau Belum Kontrak', '', '', 'T'),
('RB4SMT4-6', 16, 'Periksa Apakah Semester 4 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT4-6', '', 'T'),
('RB4SMT4-8', 18, 'Periksa Apakah Semester 4 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT4-8', 'RB4SMT6-8', 'T'),
('RB4SMT5', 15, 'Periksa Apakah Semester 5 Ada Matkuliah yang belum lulus Atau Belum Kontrak', '', '', 'T'),
('RB4SMT5-7', 17, 'Periksa Apakah Semester 5 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT5-7', '', 'T'),
('RB4SMT6', 16, 'Periksa Apakah Semester 6 Ada Matkuliah yang belum lulus Atau Belum Kontrak', '', '', 'T'),
('RB4SMT6-8', 18, 'Periksa Apakah Semester 6 Ada Matkuliah yang belum lulus Atau Belum Kontrak', 'P3SMT6-8', 'P1SMT8', 'T'),
('RB4SMT7', 17, 'Periksa Apakah Semester 7 Ada Matkuliah yang belum lulus Atau Belum Kontrak', '', '', 'T'),
('RB4SMT8', 18, 'Periksa Apakah Semester 8 Ada Matkuliah yang belum lulus Atau Belum Kontrak', '', '', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id_rekom` int(5) NOT NULL,
  `id_bidangminat` int(10) NOT NULL,
  `id_mk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruang_kuliah`
--

CREATE TABLE `ruang_kuliah` (
  `id_ruang_kuliah` int(5) NOT NULL,
  `nama_ruangan` varchar(30) NOT NULL,
  `ket_ruangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang_kuliah`
--

INSERT INTO `ruang_kuliah` (`id_ruang_kuliah`, `nama_ruangan`, `ket_ruangan`) VALUES
(1, 'F404', 'runagan terletak di gedung F pada lantai 4 dengan fasilitas Ac , LCD, Meja, Kursi'),
(2, 'F405', 'F405 terdapat pada gedung F lantai 5'),
(3, 'LAB', 'Laboratorium Komputer\r\ndi gunakan untuk melakukan praktikum');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id_rules` int(10) NOT NULL,
  `id_pertanyaan` varchar(30) NOT NULL,
  `id_jawaban` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(5) NOT NULL,
  `nama_semester` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `nama_semester`) VALUES
(11, 1),
(12, 2),
(13, 3),
(14, 4),
(15, 5),
(16, 6),
(17, 7),
(18, 8);

-- --------------------------------------------------------

--
-- Table structure for table `semester_sekarang`
--

CREATE TABLE `semester_sekarang` (
  `id_semester_sekarang` int(4) NOT NULL,
  `sekarang` varchar(20) NOT NULL,
  `tahun_ajaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester_sekarang`
--

INSERT INTO `semester_sekarang` (`id_semester_sekarang`, `sekarang`, `tahun_ajaran`) VALUES
(1, 'Genap', '2019/2020');

-- --------------------------------------------------------

--
-- Table structure for table `syarat_batas_sks`
--

CREATE TABLE `syarat_batas_sks` (
  `id_mk_syarat_sks` int(10) NOT NULL,
  `id_mk` int(10) NOT NULL,
  `batas_sks` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syarat_batas_sks`
--

INSERT INTO `syarat_batas_sks` (`id_mk_syarat_sks`, `id_mk`, `batas_sks`) VALUES
(1, 5, 124),
(2, 50, 150);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bidangminat`
--
ALTER TABLE `bidangminat`
  ADD PRIMARY KEY (`id_bidangminat`),
  ADD KEY `id_mk` (`id_mk`),
  ADD KEY `id_minat` (`id_minat`),
  ADD KEY `id_minat_2` (`id_minat`),
  ADD KEY `id_mk_2` (`id_mk`),
  ADD KEY `id_mk_3` (`id_mk`);

--
-- Indexes for table `bidangminat_bersyarat`
--
ALTER TABLE `bidangminat_bersyarat`
  ADD PRIMARY KEY (`id_bminat_syarat`),
  ADD KEY `id_minat` (`id_minat`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `dpam`
--
ALTER TABLE `dpam`
  ADD PRIMARY KEY (`id_dpam`);

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`id_entry`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_mk_tawaran` (`id_mk_tawaran`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `entry_temporary`
--
ALTER TABLE `entry_temporary`
  ADD PRIMARY KEY (`id_entry_temporary`),
  ADD KEY `mhs` (`id_mahasiswa`),
  ADD KEY `mk` (`id_mk_tawaran`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `jadwal_mk`
--
ALTER TABLE `jadwal_mk`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_ruang_kuliah` (`id_ruang_kuliah`),
  ADD KEY `id_mk` (`id_jadwal`),
  ADD KEY `id_mk_2` (`id_mk_tawaran`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kelebihan_sks`
--
ALTER TABLE `kelebihan_sks`
  ADD PRIMARY KEY (`id_kelebihan`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indexes for table `minat`
--
ALTER TABLE `minat`
  ADD PRIMARY KEY (`id_minat`);

--
-- Indexes for table `mk_syarat`
--
ALTER TABLE `mk_syarat`
  ADD PRIMARY KEY (`id_syarat`),
  ADD KEY `id_bidangminat` (`id_mk`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `syarat` (`syarat`),
  ADD KEY `id_mk` (`id_mk`),
  ADD KEY `id_semester_2` (`id_semester`),
  ADD KEY `id_minat` (`id_mk`),
  ADD KEY `syarat_2` (`syarat`),
  ADD KEY `syarat_3` (`syarat`),
  ADD KEY `id_mk_2` (`id_mk`),
  ADD KEY `id_nilai` (`syarat`),
  ADD KEY `syarat_4` (`syarat`);

--
-- Indexes for table `mk_tawaran`
--
ALTER TABLE `mk_tawaran`
  ADD PRIMARY KEY (`id_mk_tawaran`),
  ADD KEY `id_mk` (`id_mk`,`id_semester`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_mk_2` (`id_mk`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_mk` (`id_mk`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_mk_tawaran` (`id_mk`),
  ADD KEY `id_mk_2` (`id_mk`);

--
-- Indexes for table `paket_mk`
--
ALTER TABLE `paket_mk`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `jika_ya` (`jika_ya`),
  ADD KEY `jika_tidak` (`jika_tidak`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id_rekom`),
  ADD KEY `id_bidangminat` (`id_bidangminat`),
  ADD KEY `id_mk` (`id_mk`),
  ADD KEY `id_mk_2` (`id_mk`);

--
-- Indexes for table `ruang_kuliah`
--
ALTER TABLE `ruang_kuliah`
  ADD PRIMARY KEY (`id_ruang_kuliah`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id_rules`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`),
  ADD KEY `id_jawaban` (`id_jawaban`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `semester_sekarang`
--
ALTER TABLE `semester_sekarang`
  ADD PRIMARY KEY (`id_semester_sekarang`);

--
-- Indexes for table `syarat_batas_sks`
--
ALTER TABLE `syarat_batas_sks`
  ADD PRIMARY KEY (`id_mk_syarat_sks`),
  ADD KEY `id_mk` (`id_mk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bidangminat`
--
ALTER TABLE `bidangminat`
  MODIFY `id_bidangminat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `bidangminat_bersyarat`
--
ALTER TABLE `bidangminat_bersyarat`
  MODIFY `id_bminat_syarat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `dpam`
--
ALTER TABLE `dpam`
  MODIFY `id_dpam` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `id_entry` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1519;
--
-- AUTO_INCREMENT for table `entry_temporary`
--
ALTER TABLE `entry_temporary`
  MODIFY `id_entry_temporary` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `jadwal_mk`
--
ALTER TABLE `jadwal_mk`
  MODIFY `id_jadwal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kelebihan_sks`
--
ALTER TABLE `kelebihan_sks`
  MODIFY `id_kelebihan` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_mk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `minat`
--
ALTER TABLE `minat`
  MODIFY `id_minat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mk_syarat`
--
ALTER TABLE `mk_syarat`
  MODIFY `id_syarat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `mk_tawaran`
--
ALTER TABLE `mk_tawaran`
  MODIFY `id_mk_tawaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `paket_mk`
--
ALTER TABLE `paket_mk`
  MODIFY `id_paket` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  MODIFY `id_rekom` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ruang_kuliah`
--
ALTER TABLE `ruang_kuliah`
  MODIFY `id_ruang_kuliah` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id_rules` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `semester_sekarang`
--
ALTER TABLE `semester_sekarang`
  MODIFY `id_semester_sekarang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `syarat_batas_sks`
--
ALTER TABLE `syarat_batas_sks`
  MODIFY `id_mk_syarat_sks` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidangminat`
--
ALTER TABLE `bidangminat`
  ADD CONSTRAINT `matkul` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `minat` FOREIGN KEY (`id_minat`) REFERENCES `minat` (`id_minat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bidangminat_bersyarat`
--
ALTER TABLE `bidangminat_bersyarat`
  ADD CONSTRAINT `min` FOREIGN KEY (`id_minat`) REFERENCES `minat` (`id_minat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mkmks` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `entry`
--
ALTER TABLE `entry`
  ADD CONSTRAINT `entry_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `entry_ibfk_3` FOREIGN KEY (`id_mk_tawaran`) REFERENCES `mk_tawaran` (`id_mk_tawaran`),
  ADD CONSTRAINT `mhss` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `entry_temporary`
--
ALTER TABLE `entry_temporary`
  ADD CONSTRAINT `entry_temporary_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `entry_temporary_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `entry_temporary_ibfk_5` FOREIGN KEY (`id_mk_tawaran`) REFERENCES `mk_tawaran` (`id_mk_tawaran`);

--
-- Constraints for table `jadwal_mk`
--
ALTER TABLE `jadwal_mk`
  ADD CONSTRAINT `jadwal_mk_ibfk_1` FOREIGN KEY (`id_mk_tawaran`) REFERENCES `mk_tawaran` (`id_mk_tawaran`),
  ADD CONSTRAINT `ruangan` FOREIGN KEY (`id_ruang_kuliah`) REFERENCES `ruang_kuliah` (`id_ruang_kuliah`);

--
-- Constraints for table `kelebihan_sks`
--
ALTER TABLE `kelebihan_sks`
  ADD CONSTRAINT `lebihsks` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mk_syarat`
--
ALTER TABLE `mk_syarat`
  ADD CONSTRAINT `mkmka` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ses` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `syr` FOREIGN KEY (`syarat`) REFERENCES `matakuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mk_tawaran`
--
ALTER TABLE `mk_tawaran`
  ADD CONSTRAINT `mk_tawaran_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`),
  ADD CONSTRAINT `mk_tawaran_ibfk_2` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `gsf` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sems` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paket_mk`
--
ALTER TABLE `paket_mk`
  ADD CONSTRAINT `mkmk` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sese` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`);

--
-- Constraints for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD CONSTRAINT `mats` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `miittt` FOREIGN KEY (`id_bidangminat`) REFERENCES `bidangminat` (`id_bidangminat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rules_ibfk_2` FOREIGN KEY (`id_jawaban`) REFERENCES `jawaban` (`id_jawaban`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `syarat_batas_sks`
--
ALTER TABLE `syarat_batas_sks`
  ADD CONSTRAINT `syarat_batas_sks_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
