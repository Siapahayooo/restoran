-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 05:02 PM
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
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT 1,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_user`, `id_menu`, `jumlah`, `status`) VALUES
(16, 15, 29, 2, 'selesai'),
(17, 15, 25, 4, 'selesai'),
(18, 15, 28, 6, 'selesai'),
(19, 15, 26, 17, 'selesai'),
(20, 15, 23, 1, 'selesai'),
(21, 15, 24, 10, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` enum('makanan','minuman') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `kategori`) VALUES
(22, 'Ichiraku Ramen', ' Dibuat oleh Ichiran', 47000, 'Japanese noodle ramen bowl.jpg', 'makanan'),
(23, 'Sate Kelelawar', ' Daging Kelelawar asli', 16000, 'Sate ayam.jpg', 'makanan'),
(24, 'Nasi Goreng', ' Nasi Goreng Rumahan', 16000, 'How to cook the perfect nasi goreng – recipe….jpg', 'makanan'),
(25, 'Matca', ' Bahan pilihan', 15000, 'matcha.jpg', 'minuman'),
(26, 'Thaitea', ' Teh asli', 15000, 'thaitea.jpg', 'minuman'),
(27, 'Cofee', ' Dari biji kopi pilihan', 15000, 'cofee.jpg', 'minuman'),
(28, 'Roti Chanai', ' Dari india', 15000, 'food-menu-6.png', 'makanan'),
(29, 'Ayam Goreng Upin & Ipin', ' Oncle mutu', 34000, 'food-menu-3.png', 'makanan'),
(30, 'Beef Steak', ' Dari daging Saun the Sheep', 55000, 'promo-1.png', 'makanan'),
(31, 'Tiramisu Choco', ' Coklat alami', 12000, 'tiramisu-choco.jpg', 'minuman'),
(32, 'Lemon Tea', ' Lemon dan Teh pilihan', 12000, 'lemon-tea.jpg', 'minuman'),
(33, 'Choco Milk', ' Dari Susu Sapi pilihan', 15000, 'Untitled.jpg', 'minuman');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT 1,
  `total_harga` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('belum','menunggu','diterima','ditolak') DEFAULT 'belum',
  `tanggal` datetime DEFAULT current_timestamp(),
  `status` enum('pending','diproses','selesai','dibatalkan') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_user`, `nama_user`, `id_menu`, `jumlah`, `total_harga`, `metode_pembayaran`, `bukti_bayar`, `status_pembayaran`, `tanggal`, `status`) VALUES
(6, 15, 'saha', 29, 2, 68000, 'QRIS', NULL, 'belum', '2025-05-25 11:27:31', 'selesai'),
(7, 15, 'saha', 25, 4, 60000, 'Transfer Bank', NULL, 'belum', '2025-06-03 16:17:47', 'selesai'),
(8, 15, 'saha', 28, 6, 90000, 'QRIS', NULL, 'belum', '2025-06-03 16:50:58', 'pending'),
(9, 15, 'saha', 26, 17, 255000, 'QRIS', NULL, 'belum', '2025-06-03 19:57:37', 'pending'),
(10, 15, 'saha', 23, 1, 16000, 'QRIS', NULL, 'belum', '2025-06-03 20:07:18', 'pending'),
(11, 15, 'saha', 24, 10, 160000, 'QRIS', 'Tugas PJOK.jpeg', 'menunggu', '2025-06-03 20:07:18', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(14, 'admin', 'admin123', 'admin'),
(15, 'saha', '1111', 'user'),
(16, 'nabil', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
