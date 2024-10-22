-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 09:52 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `message`, `timestamp`) VALUES
(33, 'owner', 'tolong untuk seluruh karyawan pada setiap masing masing untuk selalu memperhatikan kinerja masing-masing agar perusahaan tauge kita bisa cepat berkembang dan maju dan apabila penjualan tauge kita bagus dan kualitasnya bagus, maka saya akan naikkan gaji kalian, saya akan memberikan bonus bagi karyawan yang memiliki, etos kerja yang tinggi', '2024-07-11 19:16:59'),
(34, 'keuangan', 'baik pak kita akan selalu semangat bekerja sampai akhir hayat', '2024-07-11 19:17:34'),
(35, 'gudang', 'siap pak bos, kita pasti selalu semangat dong, kita kan perusahaan tauge kualitas paling bagus pak bos.', '2024-07-11 19:18:22'),
(36, 'penjualan', 'ashiaap bossku, pokoknya kita selalu semangat untuk memajukan perusahaan ini ya.. kan gaess... ?', '2024-07-11 19:19:11'),
(37, 'keuangan', 'iya dong tetep semangat gaess...', '2024-07-11 19:19:45'),
(38, 'gudang', 'semangaaaatttttt..... yuh kerja kerja', '2024-07-11 19:20:10'),
(39, 'produksi', 'maaf baru buka chat guys... gass semangat bolooo....', '2024-07-11 19:21:03'),
(40, 'owner', 'bagus anak anak biar saya cepat kebeli pajero hehe..', '2024-07-11 19:21:36'),
(41, 'keuangan', 'innova reborn aja pak bagus..', '2024-07-11 19:22:20'),
(42, 'owner', 'siapppp beli dua duanya...', '2024-07-11 19:22:45'),
(43, '', 'p', '2024-10-18 16:15:13'),
(44, '', 'p', '2024-10-18 16:29:24'),
(45, 'fahmi', 'tes', '2024-10-18 19:41:00'),
(46, 'fahmi', 'p', '2024-10-18 19:41:07'),
(47, 'fahmi', 'p', '2024-10-18 19:42:02'),
(48, 'fahmi', 'py', '2024-10-20 14:21:08');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idpengguna`, `nama`, `email`, `password`, `nohp`, `alamat`, `level`) VALUES
(1, 'Fahmi', 'admin@gmail.com', 'admin', '085225247124', '', 'Admin'),
(3, 'Albert', 'pegawai@gmail.com', 'pegawai', '0859812951', '', 'Pegawai'),
(5, 'Agus', 'owner@gmail.com', 'owner', '0821859155125', '', 'Pemilik Toko'),
(8, 'Udin', 'udin@gmail.com', 'udin', '0859120512', 'Jl. Perintis Kode Global Palembang', 'Pembeli'),
(9, 'fahmi Putra', 'fahmi@gmail.com', 'fahmi', '085225247124', 'Peruma grogolan baru, Belakang Pasar ', 'Pembeli'),
(10, 'budi', 'budi@gmail.com', 'budi', '08654545454', 'pasirsari', 'Pembeli'),
(11, 'vikri', 'vikri@gmail.com', 'vikri', '086565467', 'pekalongan', 'Pembeli'),
(12, 'thoriq@gmail.com', 'thoriq@gmail.com', 'thoriq', '08887645653', 'Pemalang', 'Pembeli'),
(13, 'Torik', 'torik@gmail.com', 'torik123', '083806694246', 'Ds.Rowosari', 'Pembeli');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `harga`, `stok`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(6, 4, 'Sepatu Adidas', '200000', '10', 'Sepatu Pria Adidas\r\nWarna Putih\r\nSize 42', '1729149319_905c0ddb679db2a7c4cc.jpg', '2023-05-19 14:34:37', '2024-10-17 07:15:35'),
(8, 4, 'Nike Air Jordan', '500000', '1', 'Nike Air Jordan\r\nWarna Putih Kuning\r\nSize 40', '1729168738_3b42904f9e7cefb158f1.jpg', '2023-05-19 14:36:07', '2024-10-17 12:38:58'),
(9, 5, 'Nike Air Zoom Pegassus', '700000', '10', 'Nike Air Zoom Pegassus\r\nWarna Putih Pink\r\nSize 37', '1729168861_57483484622a88cacda5.jpeg', '2024-06-28 15:26:21', '2024-10-18 04:41:09'),
(10, 4, 'Boss TTNM EVO', '2500000', '2', 'BOSS TTNM EVO\r\nWarna Coklat\r\nSize 39', '1729256565_120a98254b99c50edcfb.jpg', '2024-06-28 15:27:32', '2024-10-18 13:02:45');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkmasuk`
--

INSERT INTO `produkmasuk` (`kode`, `idprodukmasuk`, `idproduk`, `jumlah`, `harga`, `total`, `grandtotal`, `tanggal`, `supplier`) VALUES
('030723114812', 0, 6, '5', '200000', '25000', '25000', '2023-07-03', 'Thrift Bandung');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `idpengguna`, `provinsi`, `kota`, `kodepos`, `metodepengiriman`, `kurir`, `layanan`, `nohp`, `alamat`, `total`, `ongkir`, `grandtotal`, `waktu`, `status`, `buktipembayaran`, `noresi`) VALUES
(1, 8, '33,Sumatera Selatan', '327,Palembang', '30118', 'Kurir', 'jne', '10000,CTC(JNE City Courier)', '0859120512', 'Jl. Perintis Kode Global Palembang', '270000', '10000', '280000', '2024-06-28 22:29:31', 'Selesai', '1719588586_66f457facf4d0e3adee2.jpg', ''),
(2, 9, '10,Jawa Tengah', '348,Pekalongan', '51112', 'Kurir', 'jne', '37000,REG(Layanan Reguler)', '084334343434', 'Peruma grogolan baru', '180000', '37000', '217000', '2024-10-17 10:37:29', 'Selesai', '1729136482_550f05a7964ebd658998.jpg', ''),
(3, 9, '10,Jawa Tengah', '349,Pekalongan', '51112', 'Kurir', 'tiki', '33000,REG(Reguler Service)', '084334343434', 'Peruma grogolan baru', '60000', '33000', '93000', '2024-10-17 11:29:45', 'Barang Sedang di Kirim', '1729140317_0e4e54603986e0307a71.jpg', '12345678');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksidetail`
--

INSERT INTO `transaksidetail` (`idtransaksidetail`, `idtransaksi`, `idproduk`, `jumlah`, `harga`, `subtotal`, `statusulasan`) VALUES
(1, 1, 9, '2', '90000', '180000', 'Sudah'),
(2, 1, 8, '1', '90000', '90000', ''),
(3, 2, 8, '2', '90000', '180000', 'Sudah'),
(4, 3, 10, '1', '60000', '60000', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`idulasan`, `idtransaksi`, `idproduk`, `idpengguna`, `bintang`, `ulasan`, `tampilannama`, `foto`, `waktu`) VALUES
(1, 1, '9', '8', '5', 'Keren banget minn', 'Tampilkan Nama', '1719588714_f05ae83a9cc80fb494c9.jpg', '2024-06-28 22:31:54'),
(2, 2, '8', '9', '5', 'apikkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 'Tampilkan Nama', '1729136776_3fa00de43131167c8532.jpg', '2024-10-17 10:46:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idpengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  MODIFY `idtransaksidetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `idulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
