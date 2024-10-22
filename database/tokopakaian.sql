-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 05:20 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokopakaian`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) UNSIGNED NOT NULL,
  `namakategori` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `created_at`, `updated_at`) VALUES
(4, 'Pria', '2023-05-19 14:31:46', '2024-06-28 15:14:42'),
(5, 'Wanita', '2023-05-19 14:31:50', '2024-06-28 15:14:46'),
(6, 'Anak - Anak', '2023-05-19 14:31:53', '2024-06-28 15:14:51'),
(7, 'Aksesoris', '2023-05-21 06:39:20', '2023-05-21 06:39:20'),
(10, 'Unisex', '2024-06-28 15:30:27', '2024-06-28 15:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-05-16-075112', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1684290163, 1),
(2, '2023-05-16-144438', 'App\\Database\\Migrations\\Produk', 'default', 'App', 1684290163, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `idpengguna` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idpengguna`, `nama`, `email`, `password`, `nohp`, `alamat`, `level`) VALUES
(1, 'Sugeng', 'admin@gmail.com', 'admin', '0895182951', '', 'Admin'),
(3, 'Albert', 'pegawai@gmail.com', 'pegawai', '0859812951', '', 'Pegawai'),
(5, 'Agus', 'owner@gmail.com', 'owner', '0821859155125', '', 'Pemilik Toko'),
(8, 'Udin', 'udin@gmail.com', 'udin', '0859120512', 'Jl. Perintis Kode Global Palembang', 'Pembeli');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) UNSIGNED NOT NULL,
  `idkategori` int(11) UNSIGNED NOT NULL,
  `namaproduk` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `harga`, `stok`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(6, 5, 'Cardigan', '2000000', '22', 'Polo Shirt Pria dengan Model Kerah dari Orangeklaud dibuat dengan bahan katun terbaik, memberikan sensasi nyaman dan adem saat dikenakan. Tidak hanya elegan dan modern, namun Polo Shirt Orangeklaud sangat memperhatikan kenyamanan saat digunakan dengan kualitas bahan katun terbaik, cocok digunakan untuk iklim tropis di Indonesia.\r\n\r\nWarna yang tersedia:\r\nEgg White\r\nEmerald Green\r\nWashed Blue\r\n\r\nSize Chart:\r\nS: 51 x 69 cm\r\nM: 53 x 71 cm\r\nL: 55 x 73 cm\r\nXL: 57 x 75 cm\r\n\r\nMaterials: US Supima Cotton\r\n\r\nApabila terdapat kesalahan saat pengiriman warna, mohon hubungi admin untuk proses retur barang.', '1719588251_415bed915fbf88b98212.jpg', '2023-05-19 14:34:37', '2024-06-28 15:25:25'),
(8, 5, 'Cardigan Crop', '90000', '40', 'Polo Shirt Pria dengan Model Kerah dari Orangeklaud dibuat dengan bahan katun terbaik, memberikan sensasi nyaman dan adem saat dikenakan. Tidak hanya elegan dan modern, namun Polo Shirt Orangeklaud sangat memperhatikan kenyamanan saat digunakan dengan kualitas bahan katun terbaik, cocok digunakan untuk iklim tropis di Indonesia.\r\n\r\nWarna yang tersedia:\r\nEgg White\r\nEmerald Green\r\nWashed Blue\r\n\r\nSize Chart:\r\nS: 51 x 69 cm\r\nM: 53 x 71 cm\r\nL: 55 x 73 cm\r\nXL: 57 x 75 cm\r\n\r\nMaterials: US Supima Cotton\r\n\r\nApabila terdapat kesalahan saat pengiriman warna, mohon hubungi admin untuk proses retur barang.', '1719588413_ec267d81d8636be29ca9.jpg', '2023-05-19 14:36:07', '2024-06-28 15:26:53'),
(9, 5, 'Cardigan Crop', '90000', '100', 'Polo Shirt Pria dengan Model Kerah dari Orangeklaud dibuat dengan bahan katun terbaik, memberikan sensasi nyaman dan adem saat dikenakan. Tidak hanya elegan dan modern, namun Polo Shirt Orangeklaud sangat memperhatikan kenyamanan saat digunakan dengan kualitas bahan katun terbaik, cocok digunakan untuk iklim tropis di Indonesia.\r\n\r\nWarna yang tersedia:\r\nEgg White\r\nEmerald Green\r\nWashed Blue\r\n\r\nSize Chart:\r\nS: 51 x 69 cm\r\nM: 53 x 71 cm\r\nL: 55 x 73 cm\r\nXL: 57 x 75 cm\r\n\r\nMaterials: US Supima Cotton\r\n\r\nApabila terdapat kesalahan saat pengiriman warna, mohon hubungi admin untuk proses retur barang.', '1719588381_81abc0c4101fbb1d503c.jpg', '2024-06-28 15:26:21', '2024-06-28 15:26:21'),
(10, 4, 'Crewneck NBA', '60000', '100', 'Polo Shirt Pria dengan Model Kerah dari Orangeklaud dibuat dengan bahan katun terbaik, memberikan sensasi nyaman dan adem saat dikenakan. Tidak hanya elegan dan modern, namun Polo Shirt Orangeklaud sangat memperhatikan kenyamanan saat digunakan dengan kualitas bahan katun terbaik, cocok digunakan untuk iklim tropis di Indonesia.\r\n\r\nWarna yang tersedia:\r\nEgg White\r\nEmerald Green\r\nWashed Blue\r\n\r\nSize Chart:\r\nS: 51 x 69 cm\r\nM: 53 x 71 cm\r\nL: 55 x 73 cm\r\nXL: 57 x 75 cm\r\n\r\nMaterials: US Supima Cotton\r\n\r\nApabila terdapat kesalahan saat pengiriman warna, mohon hubungi admin untuk proses retur barang.', '1719588452_04eefca35f0315243f6b.png', '2024-06-28 15:27:32', '2024-06-28 15:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `produkmasuk`
--

CREATE TABLE `produkmasuk` (
  `kode` varchar(255) NOT NULL,
  `idprodukmasuk` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `grandtotal` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `supplier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produkmasuk`
--

INSERT INTO `produkmasuk` (`kode`, `idprodukmasuk`, `idproduk`, `jumlah`, `harga`, `total`, `grandtotal`, `tanggal`, `supplier`) VALUES
('030723114812', 0, 6, '5', '2000000', '25000', '25000', '2023-07-03', 'John Alex');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kodepos` varchar(25) NOT NULL,
  `metodepengiriman` varchar(255) NOT NULL,
  `kurir` varchar(100) NOT NULL,
  `layanan` varchar(100) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `total` varchar(50) NOT NULL,
  `ongkir` varchar(255) NOT NULL,
  `grandtotal` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `buktipembayaran` text NOT NULL,
  `noresi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `idpengguna`, `provinsi`, `kota`, `kodepos`, `metodepengiriman`, `kurir`, `layanan`, `nohp`, `alamat`, `total`, `ongkir`, `grandtotal`, `waktu`, `status`, `buktipembayaran`, `noresi`) VALUES
(1, 8, '33,Sumatera Selatan', '327,Palembang', '30118', 'Kurir', 'jne', '10000,CTC(JNE City Courier)', '0859120512', 'Jl. Perintis Kode Global Palembang', '270000', '10000', '280000', '2024-06-28 22:29:31', 'Selesai', '1719588586_66f457facf4d0e3adee2.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksidetail`
--

CREATE TABLE `transaksidetail` (
  `idtransaksidetail` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `statusulasan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksidetail`
--

INSERT INTO `transaksidetail` (`idtransaksidetail`, `idtransaksi`, `idproduk`, `jumlah`, `harga`, `subtotal`, `statusulasan`) VALUES
(1, 1, 9, '2', '90000', '180000', 'Sudah'),
(2, 1, 8, '1', '90000', '90000', '');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `idulasan` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idproduk` text NOT NULL,
  `idpengguna` text NOT NULL,
  `bintang` text NOT NULL,
  `ulasan` text NOT NULL,
  `tampilannama` text NOT NULL,
  `foto` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`idulasan`, `idtransaksi`, `idproduk`, `idpengguna`, `bintang`, `ulasan`, `tampilannama`, `foto`, `waktu`) VALUES
(1, 1, '9', '8', '5', 'Keren banget minn', 'Tampilkan Nama', '1719588714_f05ae83a9cc80fb494c9.jpg', '2024-06-28 22:31:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idpengguna`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `produk_id_kategori_foreign` (`idkategori`);

--
-- Indexes for table `produkmasuk`
--
ALTER TABLE `produkmasuk`
  ADD PRIMARY KEY (`idprodukmasuk`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- Indexes for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  ADD PRIMARY KEY (`idtransaksidetail`),
  ADD KEY `idtransaksi` (`idtransaksi`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`idulasan`),
  ADD KEY `idtransaksi` (`idtransaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idpengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  MODIFY `idtransaksidetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `idulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  ADD CONSTRAINT `transaksidetail_ibfk_1` FOREIGN KEY (`idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
