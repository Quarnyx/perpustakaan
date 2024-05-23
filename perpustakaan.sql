-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 03:25 PM
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
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint(20) NOT NULL,
  `nis` bigint(20) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'nonaktif',
  `foto` char(255) NOT NULL DEFAULT 'foto_default.png',
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nis`, `nama_anggota`, `no_telp`, `email`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `status`, `foto`, `password`) VALUES
(8, 2011, 'Anugrah Sandy Sulman Pratama', '085225796739', 'anugrahsandysulmanpratama@gmail.com', 'Batam', '2024-08-01', 'Laki-laki', 'aktif', 'me.jpg', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint(20) NOT NULL,
  `kode_buku` varchar(7) NOT NULL,
  `halaman` int(11) NOT NULL,
  `nama_buku` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `rak` varchar(255) NOT NULL,
  `dimensi` varchar(255) NOT NULL,
  `penerbit_id` bigint(20) NOT NULL,
  `penulis_id` bigint(20) NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `tahun` bigint(20) NOT NULL,
  `kategori_id` bigint(20) NOT NULL,
  `petugas_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `kode_buku`, `halaman`, `nama_buku`, `stok`, `cover`, `rak`, `dimensi`, `penerbit_id`, `penulis_id`, `supplier_id`, `tahun`, `kategori_id`, `petugas_id`) VALUES
(23, 'BB-4750', 1, 'Tanpa Judul', 2, 'Demokrasi dan Kedaruratan Memahami Filsafat Politik Giorgio Agamben.PNG', 'R007', '50cm x 50cm', 11, 5, 8, 2000, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) NOT NULL,
  `kode_kategori` varchar(7) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kode_kategori`, `nama_kategori`) VALUES
(6, 'R001', 'Komputer'),
(7, 'R007', 'Pendidikan'),
(8, 'R008', 'Novel'),
(9, 'R009', 'Komik'),
(10, 'R010', 'horror');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `kode_pinjam` varchar(7) NOT NULL,
  `anggota_id` bigint(20) NOT NULL,
  `petugas_id` bigint(20) NOT NULL,
  `buku_id` bigint(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `tanggal_pinjam`, `tanggal_kembali`, `kode_pinjam`, `anggota_id`, `petugas_id`, `buku_id`, `status`) VALUES
(43, '2024-05-01', '2024-05-08', 'fsfsfs', 8, 1, 23, 'kembali');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` bigint(20) NOT NULL,
  `kode_penerbit` varchar(7) NOT NULL,
  `nama_penerbit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `kode_penerbit`, `nama_penerbit`) VALUES
(9, 'PNB001', 'Gramedia'),
(10, 'PNB010', 'Yudhistira'),
(11, 'PNB011', 'Kompas'),
(12, 'PNB012', 'Mizan');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint(20) NOT NULL,
  `peminjaman_id` bigint(20) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `denda` int(11) NOT NULL,
  `petugas_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `peminjaman_id`, `tanggal_pengembalian`, `denda`, `petugas_id`) VALUES
(15, 43, '2024-05-22', 7000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id` bigint(20) NOT NULL,
  `kode_penulis` varchar(7) NOT NULL,
  `nama_penulis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id`, `kode_penulis`, `nama_penulis`) VALUES
(5, 'PNL001', 'Madcoms'),
(6, 'PNL006', 'Ralp Epperson'),
(7, 'PNL007', 'Tere Liye');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'nonaktif',
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `username`, `password`, `level`, `status`, `foto`) VALUES
(1, 'Quarnyx', 'admin', '0192023a7bbd73250516f069df18b500', 'Petugas', 'aktif', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `profil_aplikasi`
--

CREATE TABLE `profil_aplikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pimpinan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `website` varchar(255) NOT NULL,
  `logo` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_aplikasi`
--

INSERT INTO `profil_aplikasi` (`id`, `nama_pimpinan`, `alamat`, `telepon`, `website`, `logo`) VALUES
(1, 'Eustasia Christine Martati, S.Pd., M.Pd.', 'Jl. Sri Agung No. 57. Cepiring, Kendal', '085643180493', 'https://smanegeri1cepiring.sch.id/', 'logosman.png');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) NOT NULL,
  `kode_supplier` varchar(7) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `kode_supplier`, `nama_supplier`) VALUES
(6, 'SUP001', 'Toko'),
(8, 'SUP007', 'ABC');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_buku`
-- (See below for the actual view)
--
CREATE TABLE `v_buku` (
`id` bigint(20)
,`kode_buku` varchar(7)
,`halaman` int(11)
,`nama_buku` varchar(100)
,`stok` int(11)
,`cover` varchar(255)
,`rak` varchar(255)
,`dimensi` varchar(255)
,`penerbit_id` bigint(20)
,`penulis_id` bigint(20)
,`supplier_id` bigint(20)
,`tahun` bigint(20)
,`kategori_id` bigint(20)
,`petugas_id` bigint(20)
,`nama_petugas` varchar(100)
,`nama_supplier` varchar(100)
,`nama_penulis` varchar(255)
,`nama_penerbit` varchar(100)
,`nama_kategori` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_buku_full`
-- (See below for the actual view)
--
CREATE TABLE `v_buku_full` (
`id` bigint(20)
,`kode_buku` varchar(7)
,`nama_buku` varchar(100)
,`nama_penulis` varchar(255)
,`nama_penerbit` varchar(100)
,`nama_kategori` varchar(40)
,`nama_supplier` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_denda`
-- (See below for the actual view)
--
CREATE TABLE `v_denda` (
`id` bigint(20)
,`peminjaman_id` bigint(20)
,`tanggal_pengembalian` date
,`denda` int(11)
,`petugas_id` bigint(20)
,`buku_id` bigint(20)
,`nama_anggota` varchar(100)
,`nama_petugas` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengembalian`
-- (See below for the actual view)
--
CREATE TABLE `v_pengembalian` (
`kode_pinjam` varchar(7)
,`id` bigint(20)
,`peminjaman_id` bigint(20)
,`tanggal_pengembalian` date
,`denda` int(11)
,`petugas_id` bigint(20)
,`nama_petugas` varchar(100)
,`nama_buku` varchar(100)
,`nama_anggota` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pinjambuku`
-- (See below for the actual view)
--
CREATE TABLE `v_pinjambuku` (
`id` bigint(20)
,`tanggal_pinjam` date
,`tanggal_kembali` date
,`kode_pinjam` varchar(7)
,`anggota_id` bigint(20)
,`petugas_id` bigint(20)
,`buku_id` bigint(20)
,`status` varchar(20)
,`nama_buku` varchar(100)
,`nama_anggota` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `v_buku`
--
DROP TABLE IF EXISTS `v_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_buku`  AS SELECT `buku`.`id` AS `id`, `buku`.`kode_buku` AS `kode_buku`, `buku`.`halaman` AS `halaman`, `buku`.`nama_buku` AS `nama_buku`, `buku`.`stok` AS `stok`, `buku`.`cover` AS `cover`, `buku`.`rak` AS `rak`, `buku`.`dimensi` AS `dimensi`, `buku`.`penerbit_id` AS `penerbit_id`, `buku`.`penulis_id` AS `penulis_id`, `buku`.`supplier_id` AS `supplier_id`, `buku`.`tahun` AS `tahun`, `buku`.`kategori_id` AS `kategori_id`, `buku`.`petugas_id` AS `petugas_id`, `petugas`.`nama_petugas` AS `nama_petugas`, `supplier`.`nama_supplier` AS `nama_supplier`, `penulis`.`nama_penulis` AS `nama_penulis`, `penerbit`.`nama_penerbit` AS `nama_penerbit`, `kategori`.`nama_kategori` AS `nama_kategori` FROM (((((`buku` join `petugas` on(`buku`.`petugas_id` = `petugas`.`id`)) join `supplier` on(`buku`.`supplier_id` = `supplier`.`id`)) join `penulis` on(`buku`.`penulis_id` = `penulis`.`id`)) join `penerbit` on(`buku`.`penerbit_id` = `penerbit`.`id`)) join `kategori` on(`buku`.`kategori_id` = `kategori`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_buku_full`
--
DROP TABLE IF EXISTS `v_buku_full`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_buku_full`  AS SELECT `buku`.`id` AS `id`, `buku`.`kode_buku` AS `kode_buku`, `buku`.`nama_buku` AS `nama_buku`, `penulis`.`nama_penulis` AS `nama_penulis`, `penerbit`.`nama_penerbit` AS `nama_penerbit`, `kategori`.`nama_kategori` AS `nama_kategori`, `supplier`.`nama_supplier` AS `nama_supplier` FROM ((((`buku` join `kategori` on(`buku`.`kategori_id` = `kategori`.`id`)) join `penerbit` on(`buku`.`penerbit_id` = `penerbit`.`id`)) join `penulis` on(`buku`.`penulis_id` = `penulis`.`id`)) join `supplier` on(`buku`.`supplier_id` = `supplier`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_denda`
--
DROP TABLE IF EXISTS `v_denda`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_denda`  AS SELECT `pengembalian`.`id` AS `id`, `pengembalian`.`peminjaman_id` AS `peminjaman_id`, `pengembalian`.`tanggal_pengembalian` AS `tanggal_pengembalian`, `pengembalian`.`denda` AS `denda`, `pengembalian`.`petugas_id` AS `petugas_id`, `peminjaman`.`buku_id` AS `buku_id`, `anggota`.`nama_anggota` AS `nama_anggota`, `petugas`.`nama_petugas` AS `nama_petugas` FROM ((((`pengembalian` join `peminjaman` on(`pengembalian`.`peminjaman_id` = `peminjaman`.`id`)) join `petugas` on(`pengembalian`.`petugas_id` = `petugas`.`id` and `peminjaman`.`petugas_id` = `petugas`.`id`)) join `anggota` on(`peminjaman`.`anggota_id` = `anggota`.`id`)) join `buku` on(`buku`.`petugas_id` = `petugas`.`id` and `peminjaman`.`buku_id` = `buku`.`id`)) WHERE `pengembalian`.`denda` > 0 ;

-- --------------------------------------------------------

--
-- Structure for view `v_pengembalian`
--
DROP TABLE IF EXISTS `v_pengembalian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengembalian`  AS SELECT `peminjaman`.`kode_pinjam` AS `kode_pinjam`, `pengembalian`.`id` AS `id`, `pengembalian`.`peminjaman_id` AS `peminjaman_id`, `pengembalian`.`tanggal_pengembalian` AS `tanggal_pengembalian`, `pengembalian`.`denda` AS `denda`, `pengembalian`.`petugas_id` AS `petugas_id`, `petugas`.`nama_petugas` AS `nama_petugas`, `buku`.`nama_buku` AS `nama_buku`, `anggota`.`nama_anggota` AS `nama_anggota` FROM ((((`pengembalian` join `peminjaman` on(`pengembalian`.`peminjaman_id` = `peminjaman`.`id`)) join `petugas` on(`pengembalian`.`petugas_id` = `petugas`.`id` and `peminjaman`.`petugas_id` = `petugas`.`id`)) join `buku` on(`buku`.`petugas_id` = `petugas`.`id` and `peminjaman`.`buku_id` = `buku`.`id`)) join `anggota` on(`peminjaman`.`anggota_id` = `anggota`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pinjambuku`
--
DROP TABLE IF EXISTS `v_pinjambuku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pinjambuku`  AS SELECT `peminjaman`.`id` AS `id`, `peminjaman`.`tanggal_pinjam` AS `tanggal_pinjam`, `peminjaman`.`tanggal_kembali` AS `tanggal_kembali`, `peminjaman`.`kode_pinjam` AS `kode_pinjam`, `peminjaman`.`anggota_id` AS `anggota_id`, `peminjaman`.`petugas_id` AS `petugas_id`, `peminjaman`.`buku_id` AS `buku_id`, `peminjaman`.`status` AS `status`, `buku`.`nama_buku` AS `nama_buku`, `anggota`.`nama_anggota` AS `nama_anggota` FROM ((`peminjaman` join `buku` on(`peminjaman`.`buku_id` = `buku`.`id`)) join `anggota` on(`peminjaman`.`anggota_id` = `anggota`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_penerbit_index` (`penerbit_id`,`penulis_id`,`supplier_id`,`kategori_id`,`petugas_id`),
  ADD KEY `fk_buku_kategori_1` (`kategori_id`),
  ADD KEY `fk_buku_penulis_1` (`penulis_id`),
  ADD KEY `fk_buku_petugas_1` (`petugas_id`),
  ADD KEY `fk_buku_supplier_1` (`supplier_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_id_index` (`anggota_id`,`petugas_id`,`buku_id`),
  ADD KEY `fk_peminjaman_buku_1` (`buku_id`),
  ADD KEY `fk_peminjaman_petugas_1` (`petugas_id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_index` (`peminjaman_id`,`petugas_id`),
  ADD KEY `fk_pengembalian_petugas_1` (`petugas_id`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_aplikasi`
--
ALTER TABLE `profil_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `profil_aplikasi`
--
ALTER TABLE `profil_aplikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_buku_kategori_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_buku_penerbit_1` FOREIGN KEY (`penerbit_id`) REFERENCES `penerbit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_buku_penulis_1` FOREIGN KEY (`penulis_id`) REFERENCES `penulis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_buku_petugas_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_buku_supplier_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman_anggota_1` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`),
  ADD CONSTRAINT `fk_peminjaman_buku_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`),
  ADD CONSTRAINT `fk_peminjaman_petugas_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `fk_pengembalian_peminjaman_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`),
  ADD CONSTRAINT `fk_pengembalian_petugas_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
