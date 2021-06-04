-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for puslapdik
DROP DATABASE IF EXISTS `puslapdik`;
CREATE DATABASE IF NOT EXISTS `puslapdik` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `puslapdik`;

-- Dumping structure for table puslapdik.dokumen_lpj
DROP TABLE IF EXISTS `dokumen_lpj`;
CREATE TABLE IF NOT EXISTS `dokumen_lpj` (
  `dokumen_id` varchar(128) NOT NULL,
  `dokumen_spp` varchar(256) DEFAULT NULL,
  `dokumen_spm` varchar(256) DEFAULT NULL,
  `dokumen_sp2d` varchar(256) DEFAULT NULL,
  `dokumen_sk` varchar(256) DEFAULT NULL,
  `dokumen_kuitansi` varchar(256) DEFAULT NULL,
  `dokumen_laporan` varchar(256) DEFAULT NULL,
  `dokumen_biodata` varchar(256) DEFAULT NULL,
  `dokumen_daftarhadir` varchar(256) DEFAULT NULL,
  `dokumen_atk` varchar(256) DEFAULT NULL,
  `dokumen_buktipengeluaran` varchar(256) DEFAULT NULL,
  `dokumen_buktipembelian` varchar(256) DEFAULT NULL,
  `dokumen_pengadaan` varchar(256) DEFAULT NULL,
  `dokumen_karwas` varchar(256) DEFAULT NULL,
  `dokumen_lelang` varchar(256) DEFAULT NULL,
  `dokumen_setorpajak` varchar(256) DEFAULT NULL,
  `dokumen_setorpengembalian` varchar(256) DEFAULT NULL,
  `created_date` varchar(256) DEFAULT NULL,
  `show_item` int(1) DEFAULT 1,
  `deleted_date` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`dokumen_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table puslapdik.dokumen_lpj: ~4 rows (approximately)
/*!40000 ALTER TABLE `dokumen_lpj` DISABLE KEYS */;
INSERT INTO `dokumen_lpj` (`dokumen_id`, `dokumen_spp`, `dokumen_spm`, `dokumen_sp2d`, `dokumen_sk`, `dokumen_kuitansi`, `dokumen_laporan`, `dokumen_biodata`, `dokumen_daftarhadir`, `dokumen_atk`, `dokumen_buktipengeluaran`, `dokumen_buktipembelian`, `dokumen_pengadaan`, `dokumen_karwas`, `dokumen_lelang`, `dokumen_setorpajak`, `dokumen_setorpengembalian`, `created_date`, `show_item`, `deleted_date`) VALUES
	('PRJ-0001', '5ac5b8bad9b75e9dbe6f6a041648085c.pdf', 'a5eee9146610f41616d54c014889fb74.pdf', 'a17f4c330e81ea6963ac9c462fcc9a87.pdf', '330de9c0ea5ebd3354c5ecae64b1a274.pdf', '0f2102d021715fa63975777ab0ff49c7.pdf', '352c59a87f4491ff05bff0bc73fef9c3.pdf', '08026ab19f4c1d48d841ec2385b8cf6c.pdf', '1413a59328ac0cfb03e55c36b8e37116.pdf', 'ca2284111fb876150b9941824d5881ec.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07-03-2021 00:39:51', 3, '07-03-2021 18:39:51'),
	('PRJ-0010', 'c7fd11a5d1debb8231e3d19442081830.pdf', '9f476960daa51b8be8182c12a286f098.pdf', '3d3662ffcb24a3c74bf9aec7ad364e3d.pdf', '4aa1ed06960d9da226a5f77b4d994e16.pdf', 'd7edea2cfcbb07b3c4d57cc63d666abe.pdf', '2df730415d5a9922f598c83e7d00ec81.pdf', 'd7ad49eea57c4629734cf823640a5cff.pdf', '6ae907ca78828759b5a8dc1de3ea5caa.pdf', '2abfcfc38a94c4d9688a5f8107dff19d.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07-03-2021 15:08:49', 3, '07-03-2021 18:39:51'),
	('PRJ-0011', '18cfe0ce13d672c2c603af4779e4957d.pdf', 'cc1480207b7227f75fc6242c74f45a44.pdf', 'c201c227151804fe6bb75cbd3b172a66.pdf', '5b038dd80c5abaa4f26ea314ce3ca781.pdf', '96bbabbfdbfd89e298faaad47cd7a1ca.pdf', '91ef490950360711b96fd8638119fd53.pdf', '89415984ca023525d08a69a003796e78.pdf', '723a2d8b8a8c8466b56b2f5e9fd42c7e.pdf', '39df3b61c50df899b3710913af52b5ee.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07-03-2021 19:26:27', 3, '07-03-2021 13:26:47'),
	('PRJ-0012', '7059f26b5d237041c8605b70dae43ed5.pdf', 'bc70e13e54b9e3d740f1d8f3652f8736.pdf', 'e4668d5dccbd6450e33b340f4c38eb5f.pdf', '754d8e3b2202676811edc558f362db42.pdf', 'fb30cb97397797adc09062217811df73.pdf', 'e968d7fd7c95533280e9240a74afed3d.pdf', '0e9fa487aa3973d49ea76743d84748c9.pdf', '90ed6440a298d614a9b59e4ea0daaf46.pdf', 'fef862d33a19ffa818f06e3e32072374.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07-03-2021 19:28:52', 3, '07-03-2021 19:29:28');
/*!40000 ALTER TABLE `dokumen_lpj` ENABLE KEYS */;

-- Dumping structure for table puslapdik.login
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '0',
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `is_active` int(1) NOT NULL DEFAULT 0,
  `date_created` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table puslapdik.login: ~2 rows (approximately)
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
	(3, 'Wisnu Aditya', 'simo.haya46@gmail.com', 'default.jpg', '$2y$10$l/qvo2REMKhD4S/7f/DJt.R9cflDyAI6qLC3DJf2a30sWvkNDQseq', 1, 1, 1614738980),
	(4, 'Irsyad', 'irsyad@gmail.com', 'irsyad.jpg', '$2y$10$3G3Zm7XJrTqW/kT01jgYG.nOr1XOI9DyLLP36N7hK4qtc.gY3piRm', 2, 1, 1614739445);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

-- Dumping structure for table puslapdik.lpj
DROP TABLE IF EXISTS `lpj`;
CREATE TABLE IF NOT EXISTS `lpj` (
  `lpj_id` int(11) NOT NULL AUTO_INCREMENT,
  `lpj_nomorsppspm` varchar(128) DEFAULT NULL,
  `lpj_tgl` varchar(128) DEFAULT NULL,
  `lpj_nilaispm` varchar(128) DEFAULT NULL,
  `lpj_uraian` varchar(256) DEFAULT NULL,
  `lpj_nomorsp2d` varchar(128) DEFAULT NULL,
  `lpj_tglsp2d` varchar(128) DEFAULT NULL,
  `lpj_nilaisp2d` varchar(128) DEFAULT NULL,
  `dokumen_id` varchar(128) DEFAULT NULL,
  `created_date` varchar(128) DEFAULT NULL,
  `created_by` varchar(128) DEFAULT NULL,
  `show_item` int(1) DEFAULT 1,
  `deleted_date` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`lpj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table puslapdik.lpj: ~4 rows (approximately)
/*!40000 ALTER TABLE `lpj` DISABLE KEYS */;
INSERT INTO `lpj` (`lpj_id`, `lpj_nomorsppspm`, `lpj_tgl`, `lpj_nilaispm`, `lpj_uraian`, `lpj_nomorsp2d`, `lpj_tglsp2d`, `lpj_nilaisp2d`, `dokumen_id`, `created_date`, `created_by`, `show_item`, `deleted_date`) VALUES
	(9, '12344-09', '03/18/2021', '125.000.000', 'Kegiatan Sosialisasi e-Pajak', '123445-10', '03/25/2021', '125.000.000', 'PRJ-0001', '07-03-2021 00:39:51', 'Wisnu Aditya', 3, '07-03-2021 18:39:51'),
	(10, '123445-21', '03/23/2021', '69.850.000', 'Honor Tim Teknis Pokja PIP tahun 2021', '123445', '03/26/2021', '69.850.000', 'PRJ-0010', '07-03-2021 15:08:49', 'Wisnu Aditya', 3, '07-03-2021 18:39:51'),
	(11, '12333', '03/24/2021', '125.340.000', 'Sosialisasi e-Faktur Pajak', '12333-21', '03/31/2021', '125.340.000', 'PRJ-0011', '07-03-2021 19:26:27', 'Wisnu Aditya', 3, '07-03-2021 13:26:47'),
	(12, '1222', '03/06/2021', '35.000.000', 'Webinar Zoom', '1222-22', '03/12/2021', '35.000.000', 'PRJ-0012', '07-03-2021 19:28:52', 'Wisnu Aditya', 3, '07-03-2021 19:29:28');
/*!40000 ALTER TABLE `lpj` ENABLE KEYS */;

-- Dumping structure for table puslapdik.user_access_menu
DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE IF NOT EXISTS `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table puslapdik.user_access_menu: ~11 rows (approximately)
/*!40000 ALTER TABLE `user_access_menu` DISABLE KEYS */;
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 2),
	(5, 1, 3),
	(6, 1, 4),
	(7, 2, 4),
	(8, 1, 5),
	(9, 1, 6),
	(10, 1, 7),
	(11, 1, 8),
	(12, 1, 9),
	(13, 1, 10);
/*!40000 ALTER TABLE `user_access_menu` ENABLE KEYS */;

-- Dumping structure for table puslapdik.user_menu
DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE IF NOT EXISTS `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table puslapdik.user_menu: ~8 rows (approximately)
/*!40000 ALTER TABLE `user_menu` DISABLE KEYS */;
INSERT INTO `user_menu` (`id`, `menu`) VALUES
	(1, 'Admin'),
	(2, 'User'),
	(3, 'Menu'),
	(4, 'SPP'),
	(5, 'Pengadaan Barang Jasa'),
	(6, 'Perjalanan Dinas'),
	(7, 'Honor Kegiatan'),
	(8, 'Honor Bulanan'),
	(9, 'UP'),
	(10, 'TUP');
/*!40000 ALTER TABLE `user_menu` ENABLE KEYS */;

-- Dumping structure for table puslapdik.user_role
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL DEFAULT '0',
  `is_download` int(1) NOT NULL,
  `is_upload` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table puslapdik.user_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`id`, `role`, `is_download`, `is_upload`) VALUES
	(1, 'Admin', 1, 1),
	(2, 'Member', 0, 1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;

-- Dumping structure for table puslapdik.user_sub_menu
DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE IF NOT EXISTS `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(128) NOT NULL DEFAULT '0',
  `url` varchar(128) NOT NULL DEFAULT '0',
  `icon` varchar(128) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table puslapdik.user_sub_menu: ~18 rows (approximately)
/*!40000 ALTER TABLE `user_sub_menu` DISABLE KEYS */;
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
	(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
	(2, 2, 'My Profile', 'user', 'fa fa-fw fa-user', 1),
	(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
	(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-calendar-minus', 1),
	(5, 3, 'Sub Menu Management', 'menu/submenu', 'fas fa-fw fa-calendar-minus', 1),
	(9, 4, 'LS Bendahara', 'menu/v_lsbendahara', 'fas fa-fw fa-book', 1),
	(10, 4, 'LS Pihak Ketiga', 'menu/v_lstiga', 'fas fa-fw fa-book', 1),
	(11, 4, 'Gaji', 'menu/v_gaji', 'fas fa-fw fa-book', 1),
	(12, 4, 'Uang Makan', 'menu/v_uangmakan', 'fas fa-fw fa-book', 1),
	(13, 4, 'UP', 'menu/v_up', 'fas fa-fw fa-book', 1),
	(14, 5, 'Dibawah 50 juta', 'menu/v_bawah50', 'fas fa-fw fa-file-contract', 1),
	(15, 5, '50 s.d 200 juta', 'menu/v_200', 'fas fa-fw fa-file-contract', 1),
	(16, 5, 'Diatas 200 juta', 'menu/v_atas200', 'fas fa-fw fa-file-contract', 1),
	(17, 6, 'Perjalanan Dinas', 'menu/v_perjadin', 'fas fa-fw fa-book', 1),
	(18, 7, 'Honor Kegiatan', 'menu/v_honkeg', 'fas fa-fw fa-book', 1),
	(19, 8, 'Honor Bulanan', 'menu/v_honbul', 'fas fa-fw fa-book', 1),
	(20, 9, 'UP', 'menu/up', 'fas fa-fw fa-book', 1),
	(21, 10, 'TUP', 'menu/tup', 'fas fa-fw fa-book', 1);
/*!40000 ALTER TABLE `user_sub_menu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
