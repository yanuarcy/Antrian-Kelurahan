-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 12:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `antarmuka`
--

CREATE TABLE `antarmuka` (
  `id_antarmuka` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `durasi_video` varchar(200) NOT NULL,
  `sumber` varchar(200) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `antarmuka`
--

INSERT INTO `antarmuka` (`id_antarmuka`, `keterangan`, `nama`, `durasi_video`, `sumber`, `status`) VALUES
(4, 'Youtube', 'Klarifikasi', '1 jam 22 menit', 'https://www.youtube.com/embed/PiJveQUYKkc?si=fq5jGbQXYidLdOb0', 0),
(5, 'Youtube', 'profil', '5 menit', 'https://www.youtube.com/embed/9Qe9-mAaq_Q?si=QXpb9B-UvRymsNNi', 0),
(7, 'Youtube', 'pkk', '5 menit', 'https://www.youtube.com/embed/wSzQ0H9S11Y?si=fWvTLXAGOSjEUdT-', 0),
(8, 'Youtube', 'profil kel berhasil', '1', 'https://www.youtube.com/embed/9Qe9-mAaq_Q?si=dyZoeecZ8kHH2g6V', 1),
(10, 'Youtube', 'antrian', '1', 'https://www.youtube.com/embed/9Qe9-mAaq_Q?si=bmSf9qUqvmyGH_zr', 0),
(11, 'Youtube', 'AKAS', '1', 'https://www.youtube.com/embed/72Ys5-wJMo0?si=F4_PdUJqXCRIda9H\" title=\"YouTube video player', 0);

-- --------------------------------------------------------

--
-- Table structure for table `api_whatsapp`
--

CREATE TABLE `api_whatsapp` (
  `id_api_whatsapp` int(11) NOT NULL,
  `no_whatsapp` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `api_whatsapp`
--

INSERT INTO `api_whatsapp` (`id_api_whatsapp`, `no_whatsapp`, `token`, `status`) VALUES
(1, '085184669869', '9f3HRJQc_io1U+22Mqca', 0),
(3, '082139813374', 'X3kZdaQAf3QqepFWxius', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loket`
--

CREATE TABLE `loket` (
  `id_loket` int(20) NOT NULL,
  `nama_cs` varchar(200) NOT NULL,
  `loket` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `status_pemanggilan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loket`
--

INSERT INTO `loket` (`id_loket`, `nama_cs`, `loket`, `status`, `status_pemanggilan`) VALUES
(4, 'Admin', 8, 0, 1),
(6, 'User', 9, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_loket` int(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `Gender` varchar(2) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Telp` varchar(50) NOT NULL,
  `Alamat` varchar(200) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_loket`, `nama`, `Gender`, `Email`, `username`, `password`, `Telp`, `Alamat`, `level`) VALUES
(4, 'Admin', 'L', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', '082257508081', 'Surabaya', 'Admin'),
(6, 'User', 'L', 'User1@gmail.com', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '0123-4567-8901', 'My Address is private', 'CS');

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id_pelayanan` int(10) NOT NULL,
  `Kode_Antrian` varchar(10) NOT NULL,
  `Jenis` varchar(200) NOT NULL,
  `Keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `Kode_Antrian`, `Jenis`, `Keterangan`) VALUES
(1, 'A', 'KTP/KK/KIA/IKD', 'PEREKAMAN KTP'),
(3, 'A', 'KTP/KK/KIA/IKD', 'CETAK ULANG KTP'),
(4, 'B', 'AKTA', 'AKTA KELAHIRAN'),
(5, 'A', 'KTP/KK/KIA/IKD', 'PENGAMBILAN KTP'),
(6, 'B', 'AKTA', 'AKTA KEMATIAN'),
(7, 'A', 'KTP/KK/KIA/IKD', 'CETAK ULANG KTP'),
(8, 'A', 'KTP/KK/KIA/IKD', 'PENGAJUAN IKD'),
(9, 'A', 'KTP/KK/KIA/IKD', 'PENGAJUAN KK BARCODE'),
(10, 'A', 'KTP/KK/KIA/IKD', 'PERUBAHAN BIODATA KK'),
(11, 'A', 'KTP/KK/KIA/IKD', 'PEMUTAHIRAN GELAR'),
(12, 'A', 'KTP/KK/KIA/IKD', 'PECAH KK'),
(13, 'A', 'KTP/KK/KIA/IKD', 'PENGAMBILAN KK'),
(14, 'A', 'KTP/KK/KIA/IKD', 'BUKA BLOKIR / HAPUS DATA GANDA'),
(15, 'A', 'KTP/KK/KIA/IKD', 'CETAK ULANG KK'),
(16, 'A', 'KTP/KK/KIA/IKD', 'PENGAMBILAN KIA'),
(17, 'C', 'PINDAH DATANG', 'PINDAH DATANG DALAM KOTA'),
(18, 'C', 'PINDAH DATANG', 'PINDAH MASUK ANTAR KOTA / KABUPATEN'),
(19, 'C', 'PINDAH DATANG', 'PINDAH KELUAR ANTAR KOTA / KABUPATEN'),
(20, 'C', 'PINDAH DATANG', 'PENDUDUK NON PERMANEN'),
(21, 'C', 'PINDAH DATANG', 'SKPTI ORANG TERLANTAR'),
(22, 'D', 'SKT/SKAW', 'SURAT KETERANGAN AHLI WARIS'),
(23, 'D', 'SKT/SKAW', 'SURAT KETERANGAN TANAH'),
(24, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT PENGANTAR NIKAH'),
(25, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT KETERANGAN DOMISILI'),
(26, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT PERNYATAAN PENGHASILAN UNTUK NON FORMAL'),
(27, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT PERNYATAAN TIDAK MEMILIKI RUMAH'),
(28, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT PERNYATAAN BELUM PERNAH MENIKAH'),
(29, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT PERNYATAAN BELUM MENIKAH LAGI BAGI JANDA/DUDA'),
(30, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT JAMINAN KESANGGUPAN DARI PIHAK KELUARGA'),
(31, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT PERMOHONAN PENERBITAN BPKB'),
(32, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT PERNYATAAN BELUM MEMILIKI RUMAH'),
(33, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT KUASA KHUSUS UNTUK PEMBAYARAN PENSIUN'),
(34, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT PERNYATAAN, SURAT PERNYATAAN BELUM PERNAH MENIKAH, SURAT PERSETUJUAN ORANG TUA/WALI, DAFTAR RIWAYAT HIDUP UNTUK PENDAFTARAN SEBAGAI TNI'),
(35, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT KETERANGAN IZIN SUAMI/ISTRI/IZIN ORANG TUA, ATAU IZIN WALI'),
(36, 'E', 'LAYANAN KELURAHAN', 'PELAYANAN SURAT KUASA PENUNJUKAN PELIMPAHAN NOMOR PORSI JEMAAH HAJI MENINGGAL DUNIA'),
(37, 'F', 'KONSULTASI', 'KONSULTASI');

-- --------------------------------------------------------

--
-- Table structure for table `pemohon`
--

CREATE TABLE `pemohon` (
  `id_pemohon` int(2) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kode_pemohon` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `no_whatsapp` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `jenis_layanan` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `jenis_antrian` varchar(200) NOT NULL,
  `jenis_pengiriman` varchar(200) NOT NULL,
  `status` int(2) NOT NULL,
  `petugas` varchar(200) NOT NULL,
  `tanggal_dilayani` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemohon`
--

INSERT INTO `pemohon` (`id_pemohon`, `tanggal`, `kode_pemohon`, `nama`, `email`, `no_whatsapp`, `alamat`, `jenis_layanan`, `keterangan`, `jenis_antrian`, `jenis_pengiriman`, `status`, `petugas`, `tanggal_dilayani`) VALUES
(497, '2024-10-09 15:10:03', 'KNH9UT', 'ataa', 'NULL', '-', 'fasfasra', 'SKT/SKAW', 'Surat Keterangan Tanah', 'Offline', '', 1, 'Admin', '2024-10-09 15:12:01'),
(498, '2024-10-19 14:04:16', 'SFEYPD', 'safsaf', 'NULL', '21512', 'gsagsar', 'SKT/SKAW', 'Surat Keterangan Tanah', 'Offline', '', 1, 'Admin', '2024-10-19 14:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(2) NOT NULL,
  `antrian` varchar(100) NOT NULL,
  `loket` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrian`
--

CREATE TABLE `tbl_antrian` (
  `id` bigint(20) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(200) NOT NULL,
  `no_whatsapp` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `jenis_layanan` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `no_antrian` varchar(6) NOT NULL,
  `jenis_antrian` varchar(200) NOT NULL,
  `jenis_pengiriman` varchar(200) NOT NULL,
  `calling_by` varchar(200) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_antrian`
--

INSERT INTO `tbl_antrian` (`id`, `tanggal`, `nama`, `no_whatsapp`, `alamat`, `jenis_layanan`, `keterangan`, `no_antrian`, `jenis_antrian`, `jenis_pengiriman`, `calling_by`, `status`, `updated_date`) VALUES
(503, '2024-10-09', 'ataa', '-', 'fasfasra', 'SKT/SKAW', 'Surat Keterangan Tanah', 'D1', 'Offline', '', '', '1', '2024-10-09 15:12:01'),
(504, '2024-10-19', 'safsaf', '21512', 'gsagsar', 'SKT/SKAW', 'Surat Keterangan Tanah', 'D1', 'Offline', '', '', '1', '2024-10-19 14:04:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antarmuka`
--
ALTER TABLE `antarmuka`
  ADD PRIMARY KEY (`id_antarmuka`);

--
-- Indexes for table `api_whatsapp`
--
ALTER TABLE `api_whatsapp`
  ADD PRIMARY KEY (`id_api_whatsapp`);

--
-- Indexes for table `loket`
--
ALTER TABLE `loket`
  ADD PRIMARY KEY (`id_loket`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_loket`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id_pelayanan`);

--
-- Indexes for table `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`id_pemohon`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_antrian`
--
ALTER TABLE `tbl_antrian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antarmuka`
--
ALTER TABLE `antarmuka`
  MODIFY `id_antarmuka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `api_whatsapp`
--
ALTER TABLE `api_whatsapp`
  MODIFY `id_api_whatsapp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_loket` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id_pemohon` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbl_antrian`
--
ALTER TABLE `tbl_antrian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
