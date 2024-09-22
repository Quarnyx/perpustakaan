/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : 127.0.0.1:3306
 Source Schema         : perpustakaan

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 22/09/2024 23:34:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anggota
-- ----------------------------
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nis` bigint NOT NULL,
  `nama_anggota` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_telp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('aktif','nonaktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'nonaktif',
  `foto` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'foto_default.png',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggota
-- ----------------------------
INSERT INTO `anggota` VALUES (8, 5211, 'M Fakim Fikara Salim', '085225796739', 'mfakimfikarasalim@gmail.com', 'Kendal', '2002-06-11', 'Laki-laki', 'aktif', 'Screenshot 2024-06-04 063432.png', '202cb962ac59075b964b07152d234b70');
INSERT INTO `anggota` VALUES (10, 8643, 'Asyifa Amelia Fatma', '083838816885', 'asyifaamelia1@gmail.com', 'Kendal', '2002-03-20', 'Perempuan', 'aktif', 'Screenshot 2024-05-24 160822.png', '3afa0d81296a4f17d477ec823261b1ec');
INSERT INTO `anggota` VALUES (11, 7682, 'Makhfud Indra Pratama', '081393147330', 'indramakhfud@gmail.com', 'Kendal', '2002-05-14', 'Laki-laki', 'aktif', 'Screenshot 2024-05-24 161239.png', '3afa0d81296a4f17d477ec823261b1ec');
INSERT INTO `anggota` VALUES (12, 1422, 'Aurora Nadea Mafaza', '081931941551', 'auroranadeamafaza@gmail.com', 'Kendal', '2003-06-25', 'Perempuan', 'aktif', 'DSC03319.JPG', '3afa0d81296a4f17d477ec823261b1ec');

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode_buku` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `halaman` int NOT NULL,
  `nama_buku` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stok` int NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dimensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `penerbit_id` bigint NOT NULL,
  `penulis_id` bigint NOT NULL,
  `supplier_id` bigint NOT NULL,
  `tahun` bigint NOT NULL,
  `kategori_id` bigint NOT NULL,
  `petugas_id` bigint NOT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_masuk` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `buku_penerbit_index`(`penerbit_id` ASC, `penulis_id` ASC, `supplier_id` ASC, `kategori_id` ASC, `petugas_id` ASC) USING BTREE,
  INDEX `fk_buku_kategori_1`(`kategori_id` ASC) USING BTREE,
  INDEX `fk_buku_penulis_1`(`penulis_id` ASC) USING BTREE,
  INDEX `fk_buku_petugas_1`(`petugas_id` ASC) USING BTREE,
  INDEX `fk_buku_supplier_1`(`supplier_id` ASC) USING BTREE,
  CONSTRAINT `fk_buku_kategori_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_buku_penerbit_1` FOREIGN KEY (`penerbit_id`) REFERENCES `penerbit` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_buku_penulis_1` FOREIGN KEY (`penulis_id`) REFERENCES `penulis` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_buku_petugas_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_buku_supplier_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buku
-- ----------------------------
INSERT INTO `buku` VALUES (23, 'BB-4750', 166, 'Microsoft Office 365, Aplikasi Perkantoran Online untuk Bisnis', 15, 'WhatsApp Image 2024-05-26 at 12.04.07_3001551a.jpg', 'R001', '16cm x 23cm', 11, 12, 6, 2013, 6, 1, '', NULL);
INSERT INTO `buku` VALUES (24, 'BB-9777', 209, 'Jago Ngonten di Instagram, Tiktok, dan Youtube', 35, 'WhatsApp Image 2024-05-26 at 12.04.27_c61e2669.jpg', 'R012', '14cm x 20cm', 10, 5, 6, 2024, 14, 1, '', NULL);
INSERT INTO `buku` VALUES (26, 'BB-1503', 408, 'Nathan & Laura', 20, 'WhatsApp Image 2024-05-26 at 12.04.22_ee3675f7.jpg', 'R008', '14cm x 20cm', 12, 8, 8, 2017, 8, 1, '', NULL);
INSERT INTO `buku` VALUES (27, 'BB-5627', 182, 'Pengantar Manajemen ( 3 IN 1 ) Untuk Mahasiswa dan Umum', 9, 'WhatsApp Image 2024-05-26 at 12.04.09_cec80bf9.jpg', 'R012', '16cm x 23cm', 13, 14, 9, 2022, 14, 1, '', NULL);
INSERT INTO `buku` VALUES (28, 'BB-2219', 222, 'Pemrograman Web Seri PHP', 8, 'WhatsApp Image 2024-05-26 at 12.04.18_21cab44b.jpg', 'R011', '15cm x 21cm', 14, 13, 6, 2020, 12, 1, '', NULL);
INSERT INTO `buku` VALUES (29, 'BB-8114', 260, 'Buku Sakti HTML, CSS, & JAVASCRIPT ', 10, 'WhatsApp Image 2024-05-26 at 12.04.20_161c0170.jpg', 'R011', '15cm x 21cm', 14, 10, 6, 2019, 12, 1, '', NULL);
INSERT INTO `buku` VALUES (30, 'BB-6160', 177, 'Strategi Efektif Internet Marketing', 13, 'WhatsApp Image 2024-05-26 at 12.04.26_14f2c84c.jpg', 'R012', '15cm x 22cm', 15, 9, 6, 2022, 14, 1, '', NULL);
INSERT INTO `buku` VALUES (31, 'BB-6524', 240, 'Pengantar Kewirausahaan', 13, 'WhatsApp Image 2024-05-26 at 12.04.11_a0cb1608.jpg', 'R012', '16cm x 23cm', 16, 15, 6, 2022, 14, 1, '', NULL);
INSERT INTO `buku` VALUES (32, 'BB-4529', 152, 'Mahir Segala Macam Jenis Desain dengan Canva', 24, 'WhatsApp Image 2024-05-26 at 12.04.22_6e5ba82f.jpg', 'R010', '15cm x 21cm', 15, 9, 6, 2023, 10, 1, '', NULL);
INSERT INTO `buku` VALUES (33, 'BB-8966', 228, 'Belajar Desain 3D dengan SketchUp', 16, 'WhatsApp Image 2024-05-26 at 12.04.25_a984cef2.jpg', 'R010', '15cm x 21cm', 10, 6, 8, 2023, 10, 1, '', NULL);
INSERT INTO `buku` VALUES (34, 'BB-1461', 152, 'Pengantar Akuntansi', 17, 'WhatsApp Image 2024-05-26 at 12.04.21_ec37cac8.jpg', 'R007', '15cm x 21cm', 10, 11, 6, 2023, 7, 1, '', NULL);
INSERT INTO `buku` VALUES (35, 'BB-2454', 212, 'Belajar Desain Grafis untuk Pemula', 29, 'WhatsApp Image 2024-05-26 at 12.04.13_a68eb3cc.jpg', 'R010', '15cm x 21cm', 10, 12, 6, 2023, 10, 1, '', NULL);
INSERT INTO `buku` VALUES (41, 'BB-4031', 21, 'Jejak Cinta Yang Tersembunyi', 110, 'Avery TRAVEL.png', 'R008', '22', 11, 7, 8, 2122, 8, 1, '8998898101409', NULL);
INSERT INTO `buku` VALUES (42, 'BB-8098', 500, 'Investasi 5 Juta', 20, '', 'R012', '50cm x 50cm', 11, 7, 8, 2025, 14, 1, '8992745140955', NULL);
INSERT INTO `buku` VALUES (43, 'BB-1061', 121, 'PERATURAN DESA', 22, 'Avery TRAVEL (1).png', 'R011', '5 cm x 5 cm', 11, 7, 6, 12121, 12, 1, '8992745120407', '2024-09-22');

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode_kategori` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_kategori` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (6, 'R001', 'Komputer');
INSERT INTO `kategori` VALUES (7, 'R007', 'Pendidikan');
INSERT INTO `kategori` VALUES (8, 'R008', 'Novel');
INSERT INTO `kategori` VALUES (9, 'R009', 'Komik');
INSERT INTO `kategori` VALUES (10, 'R010', 'Design Grafis');
INSERT INTO `kategori` VALUES (12, 'R011', 'Pemrograman');
INSERT INTO `kategori` VALUES (14, 'R012', 'Umum');

-- ----------------------------
-- Table structure for peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `kode_pinjam` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `anggota_id` bigint NOT NULL,
  `petugas_id` bigint NOT NULL,
  `buku_id` bigint NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `peminjaman_id_index`(`anggota_id` ASC, `petugas_id` ASC, `buku_id` ASC) USING BTREE,
  INDEX `fk_peminjaman_buku_1`(`buku_id` ASC) USING BTREE,
  INDEX `fk_peminjaman_petugas_1`(`petugas_id` ASC) USING BTREE,
  CONSTRAINT `fk_peminjaman_anggota_1` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_peminjaman_buku_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_peminjaman_petugas_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of peminjaman
-- ----------------------------
INSERT INTO `peminjaman` VALUES (43, '2024-05-01', '2024-05-08', 'fsfsfs', 8, 1, 23, 'kembali');
INSERT INTO `peminjaman` VALUES (45, '2024-05-26', '2024-06-02', 'PJ868', 11, 1, 24, 'kembali');
INSERT INTO `peminjaman` VALUES (47, '2024-05-26', '2024-06-02', 'PJ465', 11, 1, 24, 'kembali');
INSERT INTO `peminjaman` VALUES (50, '2024-06-05', '2024-06-12', 'PJ324', 10, 1, 29, 'kembali');
INSERT INTO `peminjaman` VALUES (51, '2024-06-06', '2024-06-13', 'PJ747', 8, 1, 24, 'kembali');
INSERT INTO `peminjaman` VALUES (52, '2024-06-06', '2024-06-13', 'PJ670', 10, 1, 24, 'kembali');
INSERT INTO `peminjaman` VALUES (54, '2024-06-06', '2024-06-13', 'PJ587', 10, 1, 24, 'kembali');
INSERT INTO `peminjaman` VALUES (57, '2024-09-22', '2024-09-29', 'PJ180', 8, 1, 41, 'kembali');
INSERT INTO `peminjaman` VALUES (58, '2024-09-22', '2024-09-29', 'PJ976', 8, 1, 41, 'pinjam');

-- ----------------------------
-- Table structure for penerbit
-- ----------------------------
DROP TABLE IF EXISTS `penerbit`;
CREATE TABLE `penerbit`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode_penerbit` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_penerbit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penerbit
-- ----------------------------
INSERT INTO `penerbit` VALUES (9, 'PNB001', 'Gramedia');
INSERT INTO `penerbit` VALUES (10, 'PNB010', 'Anak Hebat Indonesia');
INSERT INTO `penerbit` VALUES (11, 'PNB011', 'Wahana Komputer');
INSERT INTO `penerbit` VALUES (12, 'PNB012', 'Best Media');
INSERT INTO `penerbit` VALUES (13, 'PNB013', 'Media Tera');
INSERT INTO `penerbit` VALUES (14, 'PNB014', 'Start Up');
INSERT INTO `penerbit` VALUES (15, 'PNB015', 'PT Elex Media Komputindo');
INSERT INTO `penerbit` VALUES (16, 'PNB016', 'Pustaka Baru Press');

-- ----------------------------
-- Table structure for pengembalian
-- ----------------------------
DROP TABLE IF EXISTS `pengembalian`;
CREATE TABLE `pengembalian`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `peminjaman_id` bigint NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `denda` int NOT NULL,
  `petugas_id` bigint NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pengembalian_index`(`peminjaman_id` ASC, `petugas_id` ASC) USING BTREE,
  INDEX `fk_pengembalian_petugas_1`(`petugas_id` ASC) USING BTREE,
  CONSTRAINT `fk_pengembalian_peminjaman_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_pengembalian_petugas_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengembalian
-- ----------------------------
INSERT INTO `pengembalian` VALUES (15, 43, '2024-05-22', 7000, 1);
INSERT INTO `pengembalian` VALUES (16, 45, '2024-05-26', 0, 1);
INSERT INTO `pengembalian` VALUES (17, 50, '2024-06-06', 0, 1);
INSERT INTO `pengembalian` VALUES (18, 52, '2024-06-06', 0, 1);
INSERT INTO `pengembalian` VALUES (19, 51, '2024-07-29', 23000, 1);
INSERT INTO `pengembalian` VALUES (20, 54, '2024-07-29', 23000, 1);
INSERT INTO `pengembalian` VALUES (21, 47, '2024-07-29', 28500, 1);
INSERT INTO `pengembalian` VALUES (22, 57, '2024-09-22', 0, 1);

-- ----------------------------
-- Table structure for penulis
-- ----------------------------
DROP TABLE IF EXISTS `penulis`;
CREATE TABLE `penulis`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode_penulis` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_penulis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penulis
-- ----------------------------
INSERT INTO `penulis` VALUES (5, 'PNL001', 'Aruni');
INSERT INTO `penulis` VALUES (6, 'PNL006', 'Risky Budiman');
INSERT INTO `penulis` VALUES (7, 'PNL007', 'Tere Liye');
INSERT INTO `penulis` VALUES (8, 'PNL008', 'Aqilah TisalSabila');
INSERT INTO `penulis` VALUES (9, 'PNL009', 'Arista Prasetyo Adi');
INSERT INTO `penulis` VALUES (10, 'PNL010', 'Adam Saputra');
INSERT INTO `penulis` VALUES (11, 'PNL011', 'Cindy Nathalia');
INSERT INTO `penulis` VALUES (12, 'PNL012', 'Herdina Primasanti');
INSERT INTO `penulis` VALUES (13, 'PNL013', 'Rizki Hidayatullah');
INSERT INTO `penulis` VALUES (14, 'PNL014', 'Andi Feriyanto');
INSERT INTO `penulis` VALUES (15, 'PNL015', 'Bahri');
INSERT INTO `penulis` VALUES (16, 'PNL016', 'Hernita Putri');

-- ----------------------------
-- Table structure for petugas
-- ----------------------------
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama_petugas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'nonaktif',
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of petugas
-- ----------------------------
INSERT INTO `petugas` VALUES (1, 'Adrian', 'admin', '0192023a7bbd73250516f069df18b500', 'Petugas', 'aktif', 'Desain tanpa judul (5).png');
INSERT INTO `petugas` VALUES (23, 'Drs Muchlisin', 'muchlisin', '4acb4bc224acbbe3c2bfdcaa39a4324e', 'Petugas', 'aktif', 'Screenshot 2024-05-24 155811.png');

-- ----------------------------
-- Table structure for profil_aplikasi
-- ----------------------------
DROP TABLE IF EXISTS `profil_aplikasi`;
CREATE TABLE `profil_aplikasi`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_pimpinan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telepon` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `logo` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profil_aplikasi
-- ----------------------------
INSERT INTO `profil_aplikasi` VALUES (1, 'Eustasia Christine Martati, S.Pd., M.Pd.', 'Jl. Sri Agung No. 57. Cepiring, Kendal', '085643180493', 'https://smanegeri1cepiring.sch.id/', 'logosman.png');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode_supplier` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (6, 'SUP001', 'GRAMEDIA');
INSERT INTO `supplier` VALUES (8, 'SUP007', 'PERPUSTAKAAN DAERAH');
INSERT INTO `supplier` VALUES (9, 'SUP009', 'AIRLANGGA');

-- ----------------------------
-- View structure for v_buku
-- ----------------------------
DROP VIEW IF EXISTS `v_buku`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_buku` AS select `buku`.`id` AS `id`,`buku`.`kode_buku` AS `kode_buku`,`buku`.`halaman` AS `halaman`,`buku`.`nama_buku` AS `nama_buku`,`buku`.`stok` AS `stok`,`buku`.`cover` AS `cover`,`buku`.`rak` AS `rak`,`buku`.`dimensi` AS `dimensi`,`buku`.`penerbit_id` AS `penerbit_id`,`buku`.`penulis_id` AS `penulis_id`,`buku`.`supplier_id` AS `supplier_id`,`buku`.`tahun` AS `tahun`,`buku`.`kategori_id` AS `kategori_id`,`buku`.`petugas_id` AS `petugas_id`,`petugas`.`nama_petugas` AS `nama_petugas`,`supplier`.`nama_supplier` AS `nama_supplier`,`penulis`.`nama_penulis` AS `nama_penulis`,`penerbit`.`nama_penerbit` AS `nama_penerbit`,`kategori`.`nama_kategori` AS `nama_kategori`,`buku`.`barcode` AS `barcode`,`buku`.`tanggal_masuk` AS `tanggal_masuk` from (((((`buku` join `petugas` on((`buku`.`petugas_id` = `petugas`.`id`))) join `supplier` on((`buku`.`supplier_id` = `supplier`.`id`))) join `penulis` on((`buku`.`penulis_id` = `penulis`.`id`))) join `penerbit` on((`buku`.`penerbit_id` = `penerbit`.`id`))) join `kategori` on((`buku`.`kategori_id` = `kategori`.`id`)));

-- ----------------------------
-- View structure for v_buku_full
-- ----------------------------
DROP VIEW IF EXISTS `v_buku_full`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_buku_full` AS select `buku`.`id` AS `id`,`buku`.`kode_buku` AS `kode_buku`,`buku`.`nama_buku` AS `nama_buku`,`penulis`.`nama_penulis` AS `nama_penulis`,`penerbit`.`nama_penerbit` AS `nama_penerbit`,`kategori`.`nama_kategori` AS `nama_kategori`,`supplier`.`nama_supplier` AS `nama_supplier` from ((((`buku` join `kategori` on((`buku`.`kategori_id` = `kategori`.`id`))) join `penerbit` on((`buku`.`penerbit_id` = `penerbit`.`id`))) join `penulis` on((`buku`.`penulis_id` = `penulis`.`id`))) join `supplier` on((`buku`.`supplier_id` = `supplier`.`id`)));

-- ----------------------------
-- View structure for v_bukukeluar
-- ----------------------------
DROP VIEW IF EXISTS `v_bukukeluar`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_bukukeluar` AS select `peminjaman`.`tanggal_pinjam` AS `tanggal_pinjam`,`buku`.`kode_buku` AS `kode_buku`,`buku`.`nama_buku` AS `nama_buku`,`penerbit`.`nama_penerbit` AS `nama_penerbit`,`penulis`.`nama_penulis` AS `nama_penulis`,`supplier`.`nama_supplier` AS `nama_supplier` from ((((`peminjaman` join `buku` on((`peminjaman`.`buku_id` = `buku`.`id`))) join `penerbit` on((`buku`.`penerbit_id` = `penerbit`.`id`))) join `penulis` on((`buku`.`penulis_id` = `penulis`.`id`))) join `supplier` on((`buku`.`supplier_id` = `supplier`.`id`)));

-- ----------------------------
-- View structure for v_denda
-- ----------------------------
DROP VIEW IF EXISTS `v_denda`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_denda` AS select `pengembalian`.`id` AS `id`,`pengembalian`.`peminjaman_id` AS `peminjaman_id`,`pengembalian`.`tanggal_pengembalian` AS `tanggal_pengembalian`,`pengembalian`.`denda` AS `denda`,`pengembalian`.`petugas_id` AS `petugas_id`,`peminjaman`.`buku_id` AS `buku_id`,`anggota`.`nama_anggota` AS `nama_anggota`,`petugas`.`nama_petugas` AS `nama_petugas` from ((((`pengembalian` join `peminjaman` on((`pengembalian`.`peminjaman_id` = `peminjaman`.`id`))) join `petugas` on(((`pengembalian`.`petugas_id` = `petugas`.`id`) and (`peminjaman`.`petugas_id` = `petugas`.`id`)))) join `anggota` on((`peminjaman`.`anggota_id` = `anggota`.`id`))) join `buku` on(((`buku`.`petugas_id` = `petugas`.`id`) and (`peminjaman`.`buku_id` = `buku`.`id`)))) where (`pengembalian`.`denda` > 0);

-- ----------------------------
-- View structure for v_pengembalian
-- ----------------------------
DROP VIEW IF EXISTS `v_pengembalian`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_pengembalian` AS select `peminjaman`.`kode_pinjam` AS `kode_pinjam`,`pengembalian`.`id` AS `id`,`pengembalian`.`peminjaman_id` AS `peminjaman_id`,`pengembalian`.`tanggal_pengembalian` AS `tanggal_pengembalian`,`pengembalian`.`denda` AS `denda`,`pengembalian`.`petugas_id` AS `petugas_id`,`petugas`.`nama_petugas` AS `nama_petugas`,`buku`.`nama_buku` AS `nama_buku`,`anggota`.`nama_anggota` AS `nama_anggota`,`peminjaman`.`buku_id` AS `buku_id` from ((((`pengembalian` join `peminjaman` on((`pengembalian`.`peminjaman_id` = `peminjaman`.`id`))) join `petugas` on(((`pengembalian`.`petugas_id` = `petugas`.`id`) and (`peminjaman`.`petugas_id` = `petugas`.`id`)))) join `buku` on(((`buku`.`petugas_id` = `petugas`.`id`) and (`peminjaman`.`buku_id` = `buku`.`id`)))) join `anggota` on((`peminjaman`.`anggota_id` = `anggota`.`id`)));

-- ----------------------------
-- View structure for v_pinjambuku
-- ----------------------------
DROP VIEW IF EXISTS `v_pinjambuku`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_pinjambuku` AS select `peminjaman`.`id` AS `id`,`peminjaman`.`tanggal_pinjam` AS `tanggal_pinjam`,`peminjaman`.`tanggal_kembali` AS `tanggal_kembali`,`peminjaman`.`kode_pinjam` AS `kode_pinjam`,`peminjaman`.`anggota_id` AS `anggota_id`,`peminjaman`.`petugas_id` AS `petugas_id`,`peminjaman`.`buku_id` AS `buku_id`,`peminjaman`.`status` AS `status`,`buku`.`nama_buku` AS `nama_buku`,`anggota`.`nama_anggota` AS `nama_anggota` from ((`peminjaman` join `buku` on((`peminjaman`.`buku_id` = `buku`.`id`))) join `anggota` on((`peminjaman`.`anggota_id` = `anggota`.`id`)));

SET FOREIGN_KEY_CHECKS = 1;
