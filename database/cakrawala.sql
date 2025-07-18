-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 10:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakrawala`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `artikel_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `konten` longtext NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gunung`
--

CREATE TABLE `gunung` (
  `id` int(11) NOT NULL,
  `nama_gunung` varchar(100) NOT NULL,
  `jalur_gunung` varchar(55) NOT NULL,
  `lokasi_gunung` varchar(100) NOT NULL,
  `tinggi_gunung` int(11) NOT NULL COMMENT 'dalam mdpl',
  `estimasi_waktu` varchar(50) NOT NULL COMMENT 'contoh: 2 hari 1 malam',
  `biaya_paket` decimal(10,2) NOT NULL,
  `gambar_gunung` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kesulitan` enum('mudah','sedang','sulit') DEFAULT 'sedang',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gunung`
--

INSERT INTO `gunung` (`id`, `nama_gunung`, `jalur_gunung`, `lokasi_gunung`, `tinggi_gunung`, `estimasi_waktu`, `biaya_paket`, `gambar_gunung`, `deskripsi`, `kesulitan`, `created_at`, `updated_at`) VALUES
(1, 'Gunung Rinjani', 'Sembalun', 'Lombok, Nusa Tenggara Barat', 3726, '3 hari 2 malam', 1500000.00, 'rinjani.jpg', 'Gunung berapi aktif yang terletak di Pulau Lombok...', 'sulit', '2025-06-20 14:03:42', '2025-06-25 13:20:55'),
(2, 'Gunung Semeru', 'Ranu Pani', 'Lumajang, Jawa Timur', 3676, '2 hari 1 malam', 1200000.00, 'semeru.jpg', 'Gunung tertinggi di Pulau Jawa dengan puncak Mahameru...', 'sulit', '2025-06-20 14:03:42', '2025-06-25 13:20:51'),
(3, 'Gunung Prau', 'Patak Banteng', 'Wonosobo, Jawa Tengah', 2565, '1 hari 1 malam', 750000.00, 'prau.jpg', 'Gunung dengan padang edelweis terluas di Jawa Tengah...', 'sedang', '2025-06-20 14:03:42', '2025-06-25 13:21:07'),
(4, 'Gunung Gede', 'Cibodas', 'Jawa Barat', 2958, '2 hari 1 malam', 450000.00, 'gede.jpg', 'Gunung dengan jalur populer dan vegetasi lebat.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(5, 'Gunung Merbabu', 'Selo', 'Jawa Tengah', 3145, '2 hari 1 malam', 400000.00, 'merbabu.jpg', 'Gunung dengan pemandangan padang sabana yang luas.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(6, 'Gunung Slamet', 'Bambangan', 'Jawa Tengah', 3428, '3 hari 2 malam', 500000.00, 'slamet.jpg', 'Gunung tertinggi di Jawa Tengah dengan jalur panjang.', 'sulit', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(7, 'Gunung Lawu', 'Cemoro Sewu', 'Jawa Tengah', 3265, '2 hari 1 malam', 350000.00, 'lawu.jpg', 'Gunung mistis dengan warung di puncak.', 'mudah', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(8, 'Gunung Sindoro', 'Kledung', 'Jawa Tengah', 3153, '2 hari 1 malam', 380000.00, 'sindoro.jpg', 'Gunung berhadapan dengan Sumbing dengan sabana luas.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(9, 'Gunung Sumbing', 'Garung', 'Jawa Tengah', 3371, '2 hari 1 malam', 400000.00, 'sumbing.jpg', 'Gunung yang menantang dengan trek curam.', 'sulit', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(10, 'Gunung Cikuray', 'Pemancar', 'Jawa Barat', 2821, '2 hari 1 malam', 300000.00, 'cikuray.jpg', 'Gunung tertinggi di Garut dengan sunrise menawan.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(11, 'Gunung Papandayan', 'Cisurupan', 'Jawa Barat', 2665, '1 hari', 250000.00, 'papandayan.jpg', 'Gunung ramah pemula dengan kawah aktif dan edelweiss.', 'mudah', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(12, 'Gunung Guntur', 'Cikahuripan', 'Jawa Barat', 2249, '1 hari', 200000.00, 'guntur.jpg', 'Gunung kecil namun curam, cocok untuk latihan.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(13, 'Gunung Arjuno', 'Tretes', 'Jawa Timur', 3339, '3 hari 2 malam', 550000.00, 'arjuno.jpg', 'Gunung dengan jalur panjang dan hutan tropis.', 'sulit', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(14, 'Gunung Welirang', 'Tretes', 'Jawa Timur', 3156, '3 hari 2 malam', 500000.00, 'welirang.jpg', 'Bersama Arjuno, dikenal sebagai Arjuno-Welirang.', 'sulit', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(15, 'Gunung Penanggungan', 'Trawas', 'Jawa Timur', 1653, '1 hari', 180000.00, 'penanggungan.jpg', 'Gunung pendek dengan situs sejarah dan candi.', 'mudah', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(16, 'Gunung Kerinci', 'Kersik Tuo', 'Jambi', 3805, '3 hari 2 malam', 750000.00, 'kerinci.jpg', 'Gunung tertinggi di Sumatera dan di luar Papua.', 'sulit', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(17, 'Gunung Talang', 'Air Batumbuk', 'Sumatera Barat', 2597, '2 hari 1 malam', 400000.00, 'talang.jpg', 'Gunung aktif dengan dua danau cantik di sekitarnya.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(18, 'Gunung Singgalang', 'Pandai Sikek', 'Sumatera Barat', 2877, '2 hari 1 malam', 380000.00, 'singgalang.jpg', 'Gunung hijau dengan Telaga Dewi di puncaknya.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(19, 'Gunung Tandikat', 'Padang Panjang', 'Sumatera Barat', 2438, '2 hari 1 malam', 370000.00, 'tandikat.jpg', 'Gunung bersebelahan dengan Singgalang.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(20, 'Gunung Sibayak', 'Berastagi', 'Sumatera Utara', 2172, '1 hari', 250000.00, 'sibayak.jpg', 'Gunung aktif dengan akses mudah dan kawah belerang.', 'mudah', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(21, 'Gunung Marapi (Sumbar)', 'Bukittinggi', 'Sumatera Barat', 2891, '2 hari 1 malam', 390000.00, 'marapi.jpg', 'Gunung aktif dengan view indah ke Bukittinggi.', 'sedang', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(22, 'Gunung Dempo', 'Pagar Alam', 'Sumatera Selatan', 3159, '3 hari 2 malam', 600000.00, 'dempo.jpg', 'Gunung megah dengan kebun teh dan kawah biru.', 'sulit', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(23, 'Gunung Bukit Raya', 'Rantau Malam', 'Kalimantan Tengah', 2278, '4 hari 3 malam', 900000.00, 'bukitraya.jpg', 'Gunung hutan hujan yang sulit diakses, masuk Seven Summits.', 'sulit', '2025-06-26 06:52:52', '2025-06-26 06:52:52'),
(26, 'Merapi', 'Jalur Selo', 'Jawa tengah', 2982, '2 hari 1 malam', 380000.00, '685d36f815317.jpg', 'Gunung merapi yang masih aktif', 'sulit', '2025-06-26 12:03:04', '2025-06-26 12:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pendakian`
--

CREATE TABLE `jadwal_pendakian` (
  `id` int(11) NOT NULL,
  `id_gunung` int(11) NOT NULL,
  `tanggal_keberangkatan` date NOT NULL,
  `tanggal_pulang` date NOT NULL,
  `kuota` int(11) NOT NULL,
  `status` enum('buka','tutup','penuh') DEFAULT 'buka',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jadwal_pendakian`
--

INSERT INTO `jadwal_pendakian` (`id`, `id_gunung`, `tanggal_keberangkatan`, `tanggal_pulang`, `kuota`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-01-01', '2023-12-17', 60, 'buka', NULL, '2025-06-20 14:03:42', '2025-06-26 10:52:20'),
(2, 2, '2023-12-21', '2023-12-22', 250, 'buka', NULL, '2025-06-20 14:03:42', '2025-06-26 11:12:06'),
(3, 3, '2023-12-10', '2023-12-11', 0, 'penuh', NULL, '2025-06-20 14:03:42', '2025-06-26 06:36:57'),
(4, 23, '2025-07-01', '0000-00-00', 220, 'buka', NULL, '2025-06-26 08:12:17', '2025-06-26 08:16:44'),
(7, 26, '2025-06-26', '0000-00-00', 20, 'buka', NULL, '2025-06-26 12:03:45', '2025-06-26 12:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar_pendakian`
--

CREATE TABLE `pendaftar_pendakian` (
  `id` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `identitas` varchar(255) DEFAULT NULL COMMENT 'path file identitas',
  `jumlah_orang` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('pending','diterima','ditolak','selesai') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pendaftar_pendakian`
--

INSERT INTO `pendaftar_pendakian` (`id`, `id_jadwal`, `nama_lengkap`, `email`, `no_telepon`, `alamat`, `identitas`, `jumlah_orang`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'Ridho Alfatih', 'ridhoalfatih631@gmail.com', '089638218905', 'cicadas, gn putri, bogor, jawa barat', 'identitas_3_d41f6db686a9c1ac.jpg', 30, 'cihuy', 'diterima', '2025-06-26 09:21:42', '2025-06-27 08:03:59'),
(11, 1, 'jabbar', 'jabar@gmail.com', '089564782711', 'depok, jawa barat', 'identitas_11_0a570d003998dac6.jpg', 10, 'uye', 'diterima', '2025-06-26 11:04:44', '2025-06-27 08:03:50'),
(14, 7, 'Asep', 'asep@gmail.com', '0898766453', 'depok, jawa barat', 'identitas_14_99e3ba0cd96491e2.jpeg', 15, 'uye', 'diterima', '2025-06-26 12:05:21', '2025-06-27 08:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `nilai_setting` text NOT NULL,
  `keterangan` text DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesan_kontak`
--

CREATE TABLE `pesan_kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('unread','read','replied') DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','editor','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '2025-06-20 14:03:42', '2025-06-20 14:03:42'),
(3, 'Ridho', 'ridho', '202cb962ac59075b964b07152d234b70', 'editor', '2025-06-27 03:00:26', '2025-06-27 03:00:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artikel_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `gunung`
--
ALTER TABLE `gunung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_pendakian`
--
ALTER TABLE `jadwal_pendakian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gunung` (`id_gunung`);

--
-- Indexes for table `pendaftar_pendakian`
--
ALTER TABLE `pendaftar_pendakian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_setting` (`nama_setting`);

--
-- Indexes for table `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artikel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gunung`
--
ALTER TABLE `gunung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `jadwal_pendakian`
--
ALTER TABLE `jadwal_pendakian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pendaftar_pendakian`
--
ALTER TABLE `pendaftar_pendakian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_pendakian`
--
ALTER TABLE `jadwal_pendakian`
  ADD CONSTRAINT `jadwal_pendakian_ibfk_1` FOREIGN KEY (`id_gunung`) REFERENCES `gunung` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftar_pendakian`
--
ALTER TABLE `pendaftar_pendakian`
  ADD CONSTRAINT `pendaftar_pendakian_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_pendakian` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
