-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 21, 2015 at 07:59 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `penggajian`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admin`
-- 

CREATE TABLE `admin` (
  `IDAdmin` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY  (`IDAdmin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `admin`
-- 

INSERT INTO `admin` VALUES (1, 'iwan', 'superadmin', 0, 'Super Admin1', 'iwantjokrosaputro@yahoo.com ');
INSERT INTO `admin` VALUES (15, 'adminsurabaya@lap', 'admin1', 1, 'elly', 'elly@gmail.com');
INSERT INTO `admin` VALUES (16, 'adminsurabaya@kantor', 'admin2', 2, 'tuty', 'tuty@gmail.com');

-- --------------------------------------------------------

-- 
-- Table structure for table `barang`
-- 

CREATE TABLE `barang` (
  `IDBarang` int(11) NOT NULL auto_increment,
  `namaBarang` varchar(200) NOT NULL,
  PRIMARY KEY  (`IDBarang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `barang`
-- 

INSERT INTO `barang` VALUES (1, 'Babylon 30ml');
INSERT INTO `barang` VALUES (2, 'Babylon 430ml');
INSERT INTO `barang` VALUES (3, 'Minyak Gosok 5 ml');

-- --------------------------------------------------------

-- 
-- Table structure for table `bayar_gaji`
-- 

CREATE TABLE `bayar_gaji` (
  `IDBayarGaji` int(11) NOT NULL auto_increment,
  `jumlah` int(11) NOT NULL,
  `IDPenjualan` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL,
  PRIMARY KEY  (`IDBayarGaji`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `bayar_gaji`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `cabang`
-- 

CREATE TABLE `cabang` (
  `IDCabang` int(11) NOT NULL auto_increment,
  `IDAdmin` int(11) NOT NULL,
  `IDAdmin_kantor` int(11) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `saldo` double NOT NULL,
  PRIMARY KEY  (`IDCabang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `cabang`
-- 

INSERT INTO `cabang` VALUES (10, 15, 16, 'Jawa-Timur', 'surabaya', -6189500);

-- --------------------------------------------------------

-- 
-- Table structure for table `cabang_barang`
-- 

CREATE TABLE `cabang_barang` (
  `IDCabang` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY  (`IDCabang`,`IDBarang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `cabang_barang`
-- 

INSERT INTO `cabang_barang` VALUES (10, 1, 1097);
INSERT INTO `cabang_barang` VALUES (10, 2, -1974);
INSERT INTO `cabang_barang` VALUES (10, 3, 12);

-- --------------------------------------------------------

-- 
-- Table structure for table `detail_pengeluaran`
-- 

CREATE TABLE `detail_pengeluaran` (
  `IDPengeluaran` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `total_pengeluaran` int(11) NOT NULL,
  `keterangan_lanjut` text NOT NULL,
  PRIMARY KEY  (`IDPengeluaran`,`keterangan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `detail_pengeluaran`
-- 

INSERT INTO `detail_pengeluaran` VALUES (1, 'Bensin', 100000, '');
INSERT INTO `detail_pengeluaran` VALUES (1, 'Makan', 250000, '');
INSERT INTO `detail_pengeluaran` VALUES (2, 'Bensin', 100000, '');
INSERT INTO `detail_pengeluaran` VALUES (3, 'Bensin', 100000, '');
INSERT INTO `detail_pengeluaran` VALUES (3, 'Parkir', 20000, '');
INSERT INTO `detail_pengeluaran` VALUES (5, 'lain-lain', 100000, 'asdasda');
INSERT INTO `detail_pengeluaran` VALUES (5, 'Bensin', 100000, '');
INSERT INTO `detail_pengeluaran` VALUES (6, 'lain-lain', 250000, 'ont');
INSERT INTO `detail_pengeluaran` VALUES (6, 'Makan', 100000, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `detail_penggajian`
-- 

CREATE TABLE `detail_penggajian` (
  `IDPenggajian` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_gaji` int(11) NOT NULL,
  PRIMARY KEY  (`IDPenggajian`,`IDSales`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `detail_penggajian`
-- 

INSERT INTO `detail_penggajian` VALUES (1, 1, '2015-11-10', 39000);
INSERT INTO `detail_penggajian` VALUES (1, 2, '2015-11-10', 36000);
INSERT INTO `detail_penggajian` VALUES (1, 8, '2015-11-10', 18000);
INSERT INTO `detail_penggajian` VALUES (2, 6, '2015-11-07', 540000);
INSERT INTO `detail_penggajian` VALUES (2, 12, '2015-11-07', 540000);
INSERT INTO `detail_penggajian` VALUES (2, 13, '2015-11-07', 540000);
INSERT INTO `detail_penggajian` VALUES (2, 4, '2015-11-07', 450000);
INSERT INTO `detail_penggajian` VALUES (2, 8, '2015-11-07', 450000);
INSERT INTO `detail_penggajian` VALUES (2, 5, '2015-11-07', 450000);
INSERT INTO `detail_penggajian` VALUES (2, 2, '2015-11-07', 450000);
INSERT INTO `detail_penggajian` VALUES (2, 3, '2015-11-07', 450000);
INSERT INTO `detail_penggajian` VALUES (2, 1, '2015-11-07', 360000);
INSERT INTO `detail_penggajian` VALUES (2, 14, '2015-11-07', 270000);
INSERT INTO `detail_penggajian` VALUES (3, 12, '2015-11-14', 540000);
INSERT INTO `detail_penggajian` VALUES (3, 4, '2015-11-14', 540000);
INSERT INTO `detail_penggajian` VALUES (3, 6, '2015-11-14', 540000);
INSERT INTO `detail_penggajian` VALUES (3, 1, '2015-11-14', 450000);
INSERT INTO `detail_penggajian` VALUES (3, 8, '2015-11-14', 450000);
INSERT INTO `detail_penggajian` VALUES (3, 3, '2015-11-14', 450000);
INSERT INTO `detail_penggajian` VALUES (3, 5, '2015-11-14', 450000);
INSERT INTO `detail_penggajian` VALUES (3, 13, '2015-11-14', 450000);
INSERT INTO `detail_penggajian` VALUES (3, 14, '2015-11-14', 450000);
INSERT INTO `detail_penggajian` VALUES (3, 2, '2015-11-14', 360000);
INSERT INTO `detail_penggajian` VALUES (4, 1, '2015-11-18', 810000);
INSERT INTO `detail_penggajian` VALUES (5, 1, '2015-11-18', 344500);
INSERT INTO `detail_penggajian` VALUES (6, 2, '2015-11-02', 100000);

-- --------------------------------------------------------

-- 
-- Table structure for table `historygaji`
-- 

CREATE TABLE `historygaji` (
  `IDHistoryGaji` int(11) NOT NULL auto_increment,
  `IDSales` int(11) NOT NULL,
  `Nominal` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`IDHistoryGaji`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=238 ;

-- 
-- Dumping data for table `historygaji`
-- 

INSERT INTO `historygaji` VALUES (1, 1, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (2, 13, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (3, 2, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (4, 12, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (5, 7, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (6, 8, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (7, 4, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (8, 5, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (9, 14, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (10, 6, 90000, '2015-11-07', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (11, 1, 90000, '2015-11-09', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (12, 14, 90000, '2015-11-09', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (13, 4, 90000, '2015-11-09', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (14, 7, 90000, '2015-11-09', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (15, 12, 90000, '2015-11-09', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (16, 6, 90000, '2015-11-09', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (17, 8, 90000, '1970-01-01', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (18, 3, 90000, '1970-01-01', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (19, 14, 90000, '1970-01-01', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (20, 6, 90000, '1970-01-01', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (21, 13, 90000, '1970-01-01', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (22, 12, 90000, '1970-01-01', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (23, 7, 90000, '1970-01-01', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (24, 1, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (25, 13, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (26, 2, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (27, 12, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (28, 8, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (29, 3, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (30, 4, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (31, 5, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (32, 6, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (33, 14, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (34, 7, 90000, '2015-11-03', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (35, 13, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (36, 2, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (37, 12, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (38, 7, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (39, 8, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (40, 3, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (41, 4, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (42, 5, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (43, 14, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (44, 6, 90000, '2015-11-04', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (45, 8, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (46, 3, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (47, 4, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (48, 5, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (49, 6, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (50, 1, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (51, 13, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (52, 2, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (53, 12, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (54, 7, 90000, '2015-11-05', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (55, 3, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (56, 4, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (57, 5, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (58, 6, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (59, 1, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (60, 13, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (61, 2, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (62, 12, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (63, 7, 90000, '2015-11-06', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (64, 6, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (65, 12, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (66, 7, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (67, 8, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (68, 3, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (69, 4, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (70, 5, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (71, 14, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (72, 13, 90000, '2015-11-10', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (73, 7, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (74, 2, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (75, 1, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (76, 13, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (77, 14, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (78, 3, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (79, 5, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (80, 6, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (81, 12, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (82, 4, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (83, 8, 90000, '2015-11-11', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (84, 8, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (85, 3, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (86, 4, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (87, 5, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (88, 18, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (89, 6, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (90, 1, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (91, 15, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (92, 2, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (93, 7, 90000, '2015-10-31', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (94, 13, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (95, 5, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (96, 3, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (97, 4, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (98, 8, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (99, 1, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (100, 2, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (101, 7, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (102, 6, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (103, 12, 90000, '2015-11-12', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (104, 8, 90000, '2015-11-02', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (105, 3, 90000, '2015-11-02', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (106, 14, 90000, '2015-11-02', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (107, 6, 90000, '2015-11-02', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (108, 13, 90000, '2015-11-02', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (109, 12, 90000, '2015-11-02', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (110, 7, 90000, '2015-11-02', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (111, 13, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (112, 2, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (113, 12, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (114, 7, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (115, 8, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (116, 3, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (117, 5, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (118, 18, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (119, 6, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (120, 4, 90000, '2015-10-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (121, 1, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (122, 13, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (123, 2, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (124, 12, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (125, 15, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (126, 7, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (127, 8, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (128, 4, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (129, 5, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (130, 18, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (131, 6, 90000, '2015-10-29', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (132, 8, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (133, 3, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (134, 4, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (135, 18, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (136, 6, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (137, 5, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (138, 1, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (139, 13, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (140, 2, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (141, 12, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (142, 15, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (143, 7, 90000, '2015-10-28', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (144, 1, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (145, 6, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (146, 2, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (147, 12, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (148, 7, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (149, 8, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (150, 3, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (151, 4, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (152, 5, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (153, 14, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (154, 13, 90000, '2015-11-13', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (155, 8, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (156, 3, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (157, 4, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (158, 5, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (159, 14, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (160, 13, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (161, 7, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (162, 2, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (163, 1, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (164, 6, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (165, 12, 90000, '2015-11-14', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (166, 1, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (167, 2, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (168, 3, 90000, '2015-11-30', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (169, 6, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (170, 7, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (171, 8, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (172, 3, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (173, 4, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (174, 5, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (175, 14, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (176, 13, 90000, '2015-11-16', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (177, 8, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (178, 4, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (179, 3, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (180, 5, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (181, 18, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (182, 6, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (183, 1, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (184, 13, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (185, 2, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (186, 7, 90000, '2015-10-27', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (187, 1, 90000, '2015-10-26', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (188, 13, 90000, '2015-10-26', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (189, 7, 90000, '2015-10-26', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (190, 3, 90000, '2015-10-26', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (191, 4, 90000, '2015-10-26', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (192, 5, 90000, '2015-10-26', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (193, 18, 90000, '2015-10-26', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (194, 6, 90000, '2015-10-26', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (195, 1, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (196, 6, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (197, 2, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (198, 7, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (199, 8, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (200, 3, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (201, 4, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (202, 5, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (203, 14, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (204, 13, 90000, '2015-11-17', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (205, 8, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (206, 3, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (207, 4, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (208, 5, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (209, 18, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (210, 6, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (211, 1, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (212, 13, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (213, 2, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (214, 12, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (215, 15, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (216, 7, 90000, '2015-10-24', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (217, 8, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (218, 3, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (219, 4, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (220, 5, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (221, 18, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (222, 6, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (223, 1, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (224, 13, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (225, 15, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (226, 12, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (227, 7, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (228, 2, 90000, '2015-10-23', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (229, 8, 90000, '2015-11-18', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (230, 4, 90000, '2015-11-18', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (231, 3, 90000, '2015-11-18', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (232, 5, 90000, '2015-11-18', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (233, 7, 90000, '2015-11-18', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (234, 2, 90000, '2015-11-18', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (235, 6, 90000, '2015-11-18', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (236, 1, 90000, '2015-11-18', 'Gaji diperoleh');
INSERT INTO `historygaji` VALUES (237, 12, 90000, '2015-11-18', 'Gaji diperoleh');

-- --------------------------------------------------------

-- 
-- Table structure for table `historykomisi`
-- 

CREATE TABLE `historykomisi` (
  `IDHistoryKomisi` int(11) NOT NULL auto_increment,
  `IDSales` int(11) NOT NULL,
  `Nominal` int(11) NOT NULL,
  `Tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`IDHistoryKomisi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=293 ;

-- 
-- Dumping data for table `historykomisi`
-- 

INSERT INTO `historykomisi` VALUES (1, 1, 6000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (2, 1, 15000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (3, 13, 12000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (4, 13, 6000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (5, 2, 36000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (6, 12, 7500, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (7, 12, 0, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (8, 7, 30000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (9, 8, 18000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (10, 4, 18000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (11, 5, 14000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (12, 14, 18000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (13, 6, 30000, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (14, 12, 0, '2015-11-07 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (15, 1, 18000, '2015-11-09 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (16, 14, 18000, '2015-11-09 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (17, 4, 18000, '2015-11-09 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (18, 7, 30000, '2015-11-09 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (19, 12, 12000, '2015-11-09 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (20, 6, 30000, '2015-11-09 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (21, 12, 2500, '2015-11-09 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (22, 8, 18000, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (23, 3, 18000, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (24, 14, 6500, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (25, 14, 6000, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (26, 6, 30000, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (27, 13, 12000, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (28, 13, 6000, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (29, 12, 18000, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (30, 7, 30000, '1970-01-01 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (31, 1, 30000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (32, 13, 12000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (33, 2, 30000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (34, 12, 12000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (35, 8, 18000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (36, 3, 18000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (37, 4, 18000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (38, 5, 18000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (39, 6, 18000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (40, 14, 18000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (41, 7, 30000, '2015-11-03 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (42, 13, 18000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (43, 2, 30000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (44, 12, 12000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (45, 12, 6000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (46, 7, 30000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (47, 8, 18000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (48, 3, 12000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (49, 4, 18000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (50, 3, 5000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (51, 5, 18000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (52, 14, 6000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (53, 6, 18000, '2015-11-04 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (54, 8, 18000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (55, 3, 18000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (56, 4, 18000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (57, 5, 18000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (58, 6, 18000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (59, 1, 26000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (60, 13, 6000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (61, 13, 5000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (62, 2, 30000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (63, 12, 12000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (64, 7, 30000, '2015-11-05 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (65, 3, 19000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (66, 4, 18000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (67, 4, 5000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (68, 5, 18000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (69, 6, 18000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (70, 1, 25000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (71, 13, 18000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (72, 13, 6000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (73, 2, 30000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (74, 12, 18000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (75, 7, 36000, '2015-11-06 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (76, 6, 30000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (77, 12, 10000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (78, 7, 30000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (79, 8, 12000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (80, 3, 6000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (81, 4, 12000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (82, 5, 6000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (83, 14, 12000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (84, 13, 6000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (85, 13, 5000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (86, 13, 6000, '2015-11-10 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (87, 7, 30000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (88, 2, 30000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (89, 1, 24000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (90, 13, 18000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (91, 14, 18000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (92, 3, 18000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (93, 5, 18000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (94, 6, 30000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (95, 12, 18000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (96, 4, 12000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (97, 8, 12000, '2015-11-11 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (98, 8, 12000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (99, 3, 12000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (100, 4, 12000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (101, 5, 12000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (102, 18, 12000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (103, 6, 18000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (104, 1, 24000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (105, 15, 18000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (106, 2, 18000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (107, 2, 5000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (108, 7, 18000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (109, 7, 15000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (110, 18, 6000, '2015-10-31 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (111, 13, 18000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (112, 5, 12000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (113, 3, 12000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (114, 4, 18000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (115, 8, 18000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (116, 1, 12000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (117, 2, 30000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (118, 7, 30000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (119, 6, 24000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (120, 12, 12000, '2015-11-12 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (121, 8, 18000, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (122, 3, 18000, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (123, 14, 6500, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (124, 14, 6000, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (125, 6, 30000, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (126, 13, 12000, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (127, 13, 6000, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (128, 12, 18000, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (129, 7, 30000, '2015-11-02 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (130, 13, 12000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (131, 13, 5000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (132, 2, 18000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (133, 12, 12000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (134, 12, 6000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (135, 7, 24000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (136, 7, 5000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (137, 7, 0, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (138, 8, 18000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (139, 3, 6000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (140, 3, 5000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (141, 5, 12000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (142, 18, 12000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (143, 6, 18000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (144, 4, 18000, '2015-10-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (145, 1, 18000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (146, 13, 12000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (147, 13, 5000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (148, 2, 12000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (149, 2, 0, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (150, 12, 12000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (151, 12, 4000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (152, 15, 18000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (153, 15, 0, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (154, 7, 24000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (155, 8, 18000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (156, 4, 18000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (157, 5, 18000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (158, 18, 18000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (159, 6, 18000, '2015-10-29 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (160, 8, 18000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (161, 3, 18000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (162, 4, 18000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (163, 18, 18000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (164, 6, 18000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (165, 5, 18000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (166, 1, 14500, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (167, 13, 12000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (168, 13, 6000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (169, 2, 24000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (170, 12, 18000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (171, 15, 14000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (172, 7, 24000, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (173, 7, 0, '2015-10-28 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (174, 1, 24000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (175, 6, 24000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (176, 2, 30000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (177, 12, 18000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (178, 7, 30000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (179, 8, 5000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (180, 3, 12000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (181, 4, 12000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (182, 4, 5000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (183, 8, 12000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (184, 5, 18000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (185, 14, 18000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (186, 13, 12000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (187, 13, 6000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (188, 3, 5000, '2015-11-13 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (189, 8, 12000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (190, 3, 18000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (191, 4, 12000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (192, 5, 18000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (193, 14, 12000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (194, 13, 18000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (195, 13, 6000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (196, 7, 36000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (197, 2, 30000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (198, 1, 18500, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (199, 6, 18000, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (200, 12, 15500, '2015-11-14 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (201, 1, 6000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (202, 2, 10560000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (203, 3, 60000, '2015-11-30 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (204, 2, 6000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (205, 1, 18000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (206, 6, 30000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (207, 2, 30000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (208, 7, 18000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (209, 8, 18000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (210, 3, 18000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (211, 4, 18000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (212, 5, 12000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (213, 14, 18000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (214, 13, 18000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (215, 13, 6000, '2015-11-16 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (216, 8, 18000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (217, 4, 18000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (218, 3, 12000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (219, 5, 12000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (220, 18, 18000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (221, 6, 18000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (222, 1, 18000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (223, 13, 18000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (224, 2, 18000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (225, 7, 24000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (226, 7, 1500, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (227, 13, 10000, '2015-10-27 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (228, 1, 24000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (229, 13, 18000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (230, 13, 1000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (231, 7, 24000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (232, 7, 4000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (233, 3, 18000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (234, 4, 18000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (235, 5, 18000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (236, 18, 18000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (237, 6, 12000, '2015-10-26 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (238, 1, 18000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (239, 6, 30000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (240, 2, 36000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (241, 7, 30000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (242, 8, 18000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (243, 3, 12000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (244, 4, 18000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (245, 5, 12000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (246, 14, 18000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (247, 13, 18000, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (248, 14, 3500, '2015-11-17 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (249, 8, 24000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (250, 3, 12000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (251, 4, 18000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (252, 3, 5000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (253, 5, 18000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (254, 18, 18000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (255, 18, 5000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (256, 6, 18000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (257, 1, 18500, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (258, 1, 1500, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (259, 13, 19500, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (260, 2, 18000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (261, 2, 5000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (262, 12, 24000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (263, 15, 18000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (264, 7, 18000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (265, 7, 2000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (266, 7, 5000, '2015-10-24 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (267, 8, 12000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (268, 3, 12000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (269, 4, 18000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (270, 5, 12000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (271, 18, 18000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (272, 6, 18000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (273, 1, 24000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (274, 1, 500, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (275, 13, 12000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (276, 13, 6000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (277, 15, 12000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (278, 12, 18000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (279, 7, 24000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (280, 7, 6000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (281, 2, 24000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (282, 15, 6000, '2015-10-23 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (283, 8, 12000, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (284, 4, 12000, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (285, 3, 12000, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (286, 5, 12000, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (287, 4, 500, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (288, 7, 36000, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (289, 2, 30000, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (290, 6, 18000, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (291, 1, 18000, '2015-11-18 00:00:00', 'Komisi diperoleh');
INSERT INTO `historykomisi` VALUES (292, 12, 12000, '2015-11-18 00:00:00', 'Komisi diperoleh');

-- --------------------------------------------------------

-- 
-- Table structure for table `jual`
-- 

CREATE TABLE `jual` (
  `IDPenjualan` int(11) NOT NULL,
  `IDTeamLeader` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `IDLokasi` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `hargaJual` double NOT NULL,
  PRIMARY KEY  (`IDPenjualan`,`IDTeamLeader`,`IDSales`,`IDBarang`,`IDLokasi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jual`
-- 

INSERT INTO `jual` VALUES (1, 16, 1, 1, 242, 12, 96000);
INSERT INTO `jual` VALUES (1, 16, 1, 2, 242, 3, 315000);
INSERT INTO `jual` VALUES (1, 16, 13, 1, 984, 24, 192000);
INSERT INTO `jual` VALUES (1, 16, 13, 3, 984, 12, 72000);
INSERT INTO `jual` VALUES (1, 16, 2, 1, 985, 72, 576000);
INSERT INTO `jual` VALUES (1, 16, 12, 1, 69, 15, 123000);
INSERT INTO `jual` VALUES (1, 16, 12, 2, 69, 1, 105000);
INSERT INTO `jual` VALUES (1, 16, 7, 1, 69, 60, 480000);
INSERT INTO `jual` VALUES (1, 10, 8, 1, 987, 36, 288000);
INSERT INTO `jual` VALUES (1, 10, 4, 1, 58, 36, 288000);
INSERT INTO `jual` VALUES (1, 10, 5, 1, 139, 28, 228000);
INSERT INTO `jual` VALUES (1, 10, 14, 1, 215, 36, 288000);
INSERT INTO `jual` VALUES (1, 10, 6, 1, 215, 60, 480000);
INSERT INTO `jual` VALUES (1, 16, 12, 3, 69, 7, 42000);
INSERT INTO `jual` VALUES (2, 16, 1, 1, 12, 36, 288000);
INSERT INTO `jual` VALUES (2, 10, 14, 1, 990, 36, 288000);
INSERT INTO `jual` VALUES (2, 10, 4, 1, 11, 36, 288000);
INSERT INTO `jual` VALUES (2, 16, 7, 1, 17, 60, 480000);
INSERT INTO `jual` VALUES (2, 16, 12, 1, 250, 24, 192000);
INSERT INTO `jual` VALUES (2, 16, 6, 1, 19, 60, 480000);
INSERT INTO `jual` VALUES (2, 16, 12, 3, 250, 5, 30000);
INSERT INTO `jual` VALUES (3, 10, 8, 1, 991, 36, 288000);
INSERT INTO `jual` VALUES (3, 10, 3, 1, 991, 36, 288000);
INSERT INTO `jual` VALUES (3, 10, 14, 1, 991, 13, 105000);
INSERT INTO `jual` VALUES (3, 10, 14, 3, 991, 12, 72000);
INSERT INTO `jual` VALUES (3, 10, 6, 1, 991, 60, 480000);
INSERT INTO `jual` VALUES (3, 16, 13, 1, 991, 24, 192000);
INSERT INTO `jual` VALUES (3, 16, 13, 3, 991, 12, 72000);
INSERT INTO `jual` VALUES (3, 16, 12, 1, 142, 36, 288000);
INSERT INTO `jual` VALUES (3, 16, 7, 1, 43, 60, 480000);
INSERT INTO `jual` VALUES (4, 16, 1, 1, 988, 60, 480000);
INSERT INTO `jual` VALUES (4, 16, 13, 1, 250, 24, 192000);
INSERT INTO `jual` VALUES (4, 16, 2, 1, 250, 60, 480000);
INSERT INTO `jual` VALUES (4, 16, 12, 1, 234, 24, 192000);
INSERT INTO `jual` VALUES (4, 10, 8, 1, 180, 36, 288000);
INSERT INTO `jual` VALUES (4, 10, 3, 1, 994, 36, 288000);
INSERT INTO `jual` VALUES (4, 10, 4, 1, 56, 36, 288000);
INSERT INTO `jual` VALUES (4, 10, 5, 1, 995, 36, 288000);
INSERT INTO `jual` VALUES (4, 10, 6, 1, 996, 36, 288000);
INSERT INTO `jual` VALUES (4, 10, 14, 1, 996, 36, 288000);
INSERT INTO `jual` VALUES (4, 16, 7, 1, 993, 60, 480000);
INSERT INTO `jual` VALUES (5, 16, 13, 1, 42, 36, 288000);
INSERT INTO `jual` VALUES (5, 16, 2, 1, 997, 60, 480000);
INSERT INTO `jual` VALUES (5, 16, 12, 1, 133, 24, 192000);
INSERT INTO `jual` VALUES (5, 16, 12, 3, 133, 12, 72000);
INSERT INTO `jual` VALUES (5, 16, 7, 1, 998, 60, 480000);
INSERT INTO `jual` VALUES (5, 10, 8, 1, 164, 36, 288000);
INSERT INTO `jual` VALUES (5, 10, 3, 1, 164, 24, 192000);
INSERT INTO `jual` VALUES (5, 10, 4, 1, 989, 36, 288000);
INSERT INTO `jual` VALUES (5, 10, 3, 2, 164, 1, 105000);
INSERT INTO `jual` VALUES (5, 10, 5, 1, 61, 36, 288000);
INSERT INTO `jual` VALUES (5, 10, 14, 1, 126, 12, 96000);
INSERT INTO `jual` VALUES (5, 10, 6, 1, 126, 36, 288000);
INSERT INTO `jual` VALUES (6, 10, 8, 1, 23, 36, 288000);
INSERT INTO `jual` VALUES (6, 10, 3, 1, 23, 36, 288000);
INSERT INTO `jual` VALUES (6, 10, 4, 1, 23, 36, 288000);
INSERT INTO `jual` VALUES (6, 10, 5, 1, 996, 36, 288000);
INSERT INTO `jual` VALUES (6, 10, 6, 1, 996, 36, 288000);
INSERT INTO `jual` VALUES (6, 16, 1, 1, 999, 52, 420000);
INSERT INTO `jual` VALUES (6, 16, 13, 1, 242, 12, 96000);
INSERT INTO `jual` VALUES (6, 16, 13, 2, 242, 1, 105000);
INSERT INTO `jual` VALUES (6, 16, 2, 1, 241, 60, 480000);
INSERT INTO `jual` VALUES (6, 16, 12, 1, 69, 24, 192000);
INSERT INTO `jual` VALUES (6, 16, 7, 1, 238, 60, 480000);
INSERT INTO `jual` VALUES (7, 10, 3, 1, 1000, 38, 306000);
INSERT INTO `jual` VALUES (7, 10, 4, 1, 1000, 36, 288000);
INSERT INTO `jual` VALUES (7, 10, 4, 2, 1000, 1, 105000);
INSERT INTO `jual` VALUES (7, 10, 5, 1, 996, 36, 288000);
INSERT INTO `jual` VALUES (7, 10, 6, 1, 996, 36, 288000);
INSERT INTO `jual` VALUES (7, 16, 1, 1, 70, 50, 402000);
INSERT INTO `jual` VALUES (7, 16, 13, 1, 70, 36, 288000);
INSERT INTO `jual` VALUES (7, 16, 13, 3, 70, 12, 72000);
INSERT INTO `jual` VALUES (7, 16, 2, 1, 1001, 60, 480000);
INSERT INTO `jual` VALUES (7, 16, 12, 1, 1003, 36, 288000);
INSERT INTO `jual` VALUES (7, 16, 7, 1, 1004, 72, 576000);
INSERT INTO `jual` VALUES (8, 16, 6, 1, 1005, 60, 480000);
INSERT INTO `jual` VALUES (8, 16, 12, 2, 1006, 2, 210000);
INSERT INTO `jual` VALUES (8, 16, 7, 1, 1007, 60, 480000);
INSERT INTO `jual` VALUES (8, 10, 8, 1, 186, 24, 192000);
INSERT INTO `jual` VALUES (8, 10, 3, 1, 91, 12, 96000);
INSERT INTO `jual` VALUES (8, 10, 4, 1, 117, 24, 192000);
INSERT INTO `jual` VALUES (8, 10, 5, 1, 108, 12, 96000);
INSERT INTO `jual` VALUES (8, 10, 14, 1, 13, 24, 192000);
INSERT INTO `jual` VALUES (8, 10, 13, 1, 13, 12, 96000);
INSERT INTO `jual` VALUES (8, 10, 13, 2, 13, 1, 105000);
INSERT INTO `jual` VALUES (8, 10, 13, 3, 13, 12, 72000);
INSERT INTO `jual` VALUES (9, 16, 7, 1, 1009, 60, 480000);
INSERT INTO `jual` VALUES (9, 16, 2, 1, 1009, 60, 480000);
INSERT INTO `jual` VALUES (9, 16, 1, 1, 1009, 48, 384000);
INSERT INTO `jual` VALUES (9, 10, 13, 1, 1011, 36, 288000);
INSERT INTO `jual` VALUES (9, 10, 14, 1, 1011, 36, 288000);
INSERT INTO `jual` VALUES (9, 10, 3, 1, 144, 36, 288000);
INSERT INTO `jual` VALUES (9, 10, 5, 1, 167, 36, 288000);
INSERT INTO `jual` VALUES (9, 16, 6, 1, 19, 60, 480000);
INSERT INTO `jual` VALUES (9, 16, 12, 1, 220, 36, 288000);
INSERT INTO `jual` VALUES (9, 10, 4, 1, 1012, 24, 192000);
INSERT INTO `jual` VALUES (9, 10, 8, 1, 1012, 24, 192000);
INSERT INTO `jual` VALUES (10, 17, 8, 1, 1013, 24, 192000);
INSERT INTO `jual` VALUES (10, 17, 3, 1, 1015, 24, 192000);
INSERT INTO `jual` VALUES (10, 17, 4, 1, 1013, 24, 192000);
INSERT INTO `jual` VALUES (10, 17, 5, 1, 1010, 24, 192000);
INSERT INTO `jual` VALUES (10, 17, 18, 1, 1016, 24, 192000);
INSERT INTO `jual` VALUES (10, 17, 6, 1, 1016, 36, 288000);
INSERT INTO `jual` VALUES (10, 10, 1, 1, 60, 48, 384000);
INSERT INTO `jual` VALUES (10, 10, 15, 1, 60, 36, 288000);
INSERT INTO `jual` VALUES (10, 10, 2, 1, 1017, 36, 288000);
INSERT INTO `jual` VALUES (10, 10, 2, 2, 1017, 1, 105000);
INSERT INTO `jual` VALUES (10, 10, 7, 1, 1018, 36, 288000);
INSERT INTO `jual` VALUES (10, 10, 7, 2, 1018, 3, 315000);
INSERT INTO `jual` VALUES (10, 17, 18, 3, 1016, 12, 72000);
INSERT INTO `jual` VALUES (11, 10, 13, 1, 32, 36, 288000);
INSERT INTO `jual` VALUES (11, 10, 5, 1, 1024, 24, 192000);
INSERT INTO `jual` VALUES (11, 10, 3, 1, 30, 24, 192000);
INSERT INTO `jual` VALUES (11, 10, 4, 1, 82, 36, 288000);
INSERT INTO `jual` VALUES (11, 10, 8, 1, 176, 36, 288000);
INSERT INTO `jual` VALUES (11, 16, 1, 1, 1009, 24, 192000);
INSERT INTO `jual` VALUES (11, 16, 2, 1, 1009, 60, 480000);
INSERT INTO `jual` VALUES (11, 16, 7, 1, 220, 60, 480000);
INSERT INTO `jual` VALUES (11, 16, 6, 1, 1025, 48, 384000);
INSERT INTO `jual` VALUES (11, 16, 12, 1, 1025, 24, 192000);
INSERT INTO `jual` VALUES (12, 10, 8, 1, 992, 36, 288000);
INSERT INTO `jual` VALUES (12, 10, 3, 1, 992, 36, 288000);
INSERT INTO `jual` VALUES (12, 10, 14, 1, 992, 13, 105000);
INSERT INTO `jual` VALUES (12, 10, 14, 3, 992, 12, 72000);
INSERT INTO `jual` VALUES (12, 10, 6, 1, 992, 60, 480000);
INSERT INTO `jual` VALUES (12, 16, 13, 1, 1026, 24, 192000);
INSERT INTO `jual` VALUES (12, 16, 13, 3, 1026, 12, 72000);
INSERT INTO `jual` VALUES (12, 16, 12, 1, 1027, 36, 288000);
INSERT INTO `jual` VALUES (12, 16, 7, 1, 142, 60, 480000);
INSERT INTO `jual` VALUES (13, 10, 13, 1, 1021, 24, 192000);
INSERT INTO `jual` VALUES (13, 10, 13, 2, 1021, 1, 105000);
INSERT INTO `jual` VALUES (13, 10, 2, 1, 1028, 36, 288000);
INSERT INTO `jual` VALUES (13, 10, 12, 1, 1022, 24, 192000);
INSERT INTO `jual` VALUES (13, 10, 12, 3, 1022, 12, 72000);
INSERT INTO `jual` VALUES (13, 10, 7, 1, 1023, 48, 384000);
INSERT INTO `jual` VALUES (13, 10, 7, 2, 1023, 1, 105000);
INSERT INTO `jual` VALUES (13, 10, 7, 3, 1023, 1, 6000);
INSERT INTO `jual` VALUES (13, 17, 8, 1, 1019, 36, 288000);
INSERT INTO `jual` VALUES (13, 17, 3, 1, 1020, 12, 96000);
INSERT INTO `jual` VALUES (13, 17, 3, 2, 1020, 1, 105000);
INSERT INTO `jual` VALUES (13, 17, 5, 1, 1020, 24, 192000);
INSERT INTO `jual` VALUES (13, 17, 18, 1, 93, 24, 192000);
INSERT INTO `jual` VALUES (13, 17, 6, 1, 93, 36, 288000);
INSERT INTO `jual` VALUES (13, 17, 4, 1, 1019, 36, 288000);
INSERT INTO `jual` VALUES (14, 10, 1, 1, 222, 36, 288000);
INSERT INTO `jual` VALUES (14, 10, 13, 1, 222, 24, 192000);
INSERT INTO `jual` VALUES (14, 10, 13, 2, 222, 1, 105000);
INSERT INTO `jual` VALUES (14, 10, 2, 1, 7, 24, 192000);
INSERT INTO `jual` VALUES (14, 10, 2, 3, 7, 6, 36000);
INSERT INTO `jual` VALUES (14, 10, 12, 1, 1029, 24, 192000);
INSERT INTO `jual` VALUES (14, 10, 12, 3, 1029, 8, 48000);
INSERT INTO `jual` VALUES (14, 10, 15, 1, 28, 36, 288000);
INSERT INTO `jual` VALUES (14, 10, 15, 3, 28, 3, 18000);
INSERT INTO `jual` VALUES (14, 10, 7, 1, 1030, 48, 384000);
INSERT INTO `jual` VALUES (14, 17, 8, 1, 1002, 36, 288000);
INSERT INTO `jual` VALUES (14, 17, 4, 1, 70, 36, 288000);
INSERT INTO `jual` VALUES (14, 17, 5, 1, 1031, 36, 288000);
INSERT INTO `jual` VALUES (14, 17, 18, 1, 50, 36, 288000);
INSERT INTO `jual` VALUES (14, 17, 6, 1, 1007, 36, 288000);
INSERT INTO `jual` VALUES (15, 17, 8, 1, 235, 36, 288000);
INSERT INTO `jual` VALUES (15, 17, 3, 1, 236, 36, 288000);
INSERT INTO `jual` VALUES (15, 17, 4, 1, 182, 36, 288000);
INSERT INTO `jual` VALUES (15, 17, 18, 1, 133, 36, 288000);
INSERT INTO `jual` VALUES (15, 17, 6, 1, 134, 36, 288000);
INSERT INTO `jual` VALUES (15, 17, 5, 1, 18, 36, 288000);
INSERT INTO `jual` VALUES (15, 10, 1, 1, 44, 29, 237000);
INSERT INTO `jual` VALUES (15, 10, 13, 1, 6, 24, 192000);
INSERT INTO `jual` VALUES (15, 10, 13, 3, 6, 12, 72000);
INSERT INTO `jual` VALUES (15, 10, 2, 1, 129, 48, 384000);
INSERT INTO `jual` VALUES (15, 10, 12, 1, 985, 36, 288000);
INSERT INTO `jual` VALUES (15, 10, 15, 1, 985, 28, 228000);
INSERT INTO `jual` VALUES (15, 10, 7, 1, 1032, 48, 384000);
INSERT INTO `jual` VALUES (15, 10, 7, 3, 1032, 2, 12000);
INSERT INTO `jual` VALUES (16, 16, 1, 1, 99, 48, 384000);
INSERT INTO `jual` VALUES (16, 16, 6, 1, 74, 48, 384000);
INSERT INTO `jual` VALUES (16, 16, 2, 1, 97, 60, 480000);
INSERT INTO `jual` VALUES (16, 16, 12, 1, 97, 36, 288000);
INSERT INTO `jual` VALUES (16, 16, 7, 1, 99, 60, 480000);
INSERT INTO `jual` VALUES (16, 10, 8, 2, 210, 1, 105000);
INSERT INTO `jual` VALUES (16, 10, 3, 1, 52, 24, 192000);
INSERT INTO `jual` VALUES (16, 10, 4, 1, 1030, 24, 192000);
INSERT INTO `jual` VALUES (16, 10, 4, 2, 1030, 1, 105000);
INSERT INTO `jual` VALUES (16, 10, 8, 1, 210, 24, 192000);
INSERT INTO `jual` VALUES (16, 10, 5, 1, 210, 36, 288000);
INSERT INTO `jual` VALUES (16, 10, 14, 1, 1034, 36, 288000);
INSERT INTO `jual` VALUES (16, 10, 13, 1, 102, 24, 192000);
INSERT INTO `jual` VALUES (16, 10, 13, 3, 102, 12, 72000);
INSERT INTO `jual` VALUES (16, 10, 3, 2, 52, 1, 105000);
INSERT INTO `jual` VALUES (17, 10, 8, 1, 28, 24, 192000);
INSERT INTO `jual` VALUES (17, 10, 3, 1, 135, 36, 288000);
INSERT INTO `jual` VALUES (17, 10, 4, 1, 135, 24, 192000);
INSERT INTO `jual` VALUES (17, 10, 5, 1, 1036, 36, 288000);
INSERT INTO `jual` VALUES (17, 10, 14, 1, 1035, 24, 192000);
INSERT INTO `jual` VALUES (17, 10, 13, 1, 1037, 36, 288000);
INSERT INTO `jual` VALUES (17, 10, 13, 3, 1037, 12, 72000);
INSERT INTO `jual` VALUES (17, 16, 7, 1, 1038, 72, 576000);
INSERT INTO `jual` VALUES (17, 16, 2, 1, 1039, 60, 480000);
INSERT INTO `jual` VALUES (17, 16, 1, 1, 74, 37, 297000);
INSERT INTO `jual` VALUES (17, 16, 6, 1, 91, 36, 288000);
INSERT INTO `jual` VALUES (17, 16, 12, 1, 1039, 31, 255000);
INSERT INTO `jual` VALUES (18, 10, 1, 1, 188, 12, 12121);
INSERT INTO `jual` VALUES (19, 10, 2, 2, 157, 2112, 123123123);
INSERT INTO `jual` VALUES (20, 10, 3, 2, 157, 12, 121221);
INSERT INTO `jual` VALUES (21, 10, 2, 1, 188, 12, 12121212);
INSERT INTO `jual` VALUES (22, 16, 1, 1, 131, 36, 288000);
INSERT INTO `jual` VALUES (22, 16, 6, 1, 131, 60, 480000);
INSERT INTO `jual` VALUES (22, 16, 2, 1, 1041, 60, 480000);
INSERT INTO `jual` VALUES (22, 16, 7, 1, 132, 36, 288000);
INSERT INTO `jual` VALUES (22, 10, 8, 1, 1041, 36, 288000);
INSERT INTO `jual` VALUES (22, 10, 3, 1, 84, 36, 288000);
INSERT INTO `jual` VALUES (22, 10, 4, 1, 65, 36, 288000);
INSERT INTO `jual` VALUES (22, 10, 5, 1, 64, 24, 192000);
INSERT INTO `jual` VALUES (22, 10, 14, 1, 160, 36, 288000);
INSERT INTO `jual` VALUES (22, 10, 13, 1, 121, 36, 288000);
INSERT INTO `jual` VALUES (22, 10, 13, 3, 121, 12, 72000);
INSERT INTO `jual` VALUES (23, 17, 8, 1, 1042, 36, 288000);
INSERT INTO `jual` VALUES (23, 17, 4, 1, 1043, 36, 288000);
INSERT INTO `jual` VALUES (23, 17, 3, 1, 175, 24, 192000);
INSERT INTO `jual` VALUES (23, 17, 5, 1, 216, 24, 192000);
INSERT INTO `jual` VALUES (23, 17, 18, 1, 199, 36, 288000);
INSERT INTO `jual` VALUES (23, 17, 6, 1, 180, 36, 288000);
INSERT INTO `jual` VALUES (23, 10, 1, 1, 8, 36, 288000);
INSERT INTO `jual` VALUES (23, 10, 13, 1, 22, 36, 288000);
INSERT INTO `jual` VALUES (23, 10, 2, 1, 175, 36, 288000);
INSERT INTO `jual` VALUES (23, 10, 7, 1, 199, 48, 384000);
INSERT INTO `jual` VALUES (23, 10, 7, 3, 199, 3, 18000);
INSERT INTO `jual` VALUES (23, 10, 13, 2, 22, 2, 12000);
INSERT INTO `jual` VALUES (24, 10, 1, 1, 1044, 48, 384000);
INSERT INTO `jual` VALUES (24, 10, 13, 1, 1046, 36, 288000);
INSERT INTO `jual` VALUES (24, 10, 13, 3, 1046, 2, 12000);
INSERT INTO `jual` VALUES (24, 10, 7, 1, 1047, 48, 384000);
INSERT INTO `jual` VALUES (24, 10, 7, 3, 1048, 8, 48000);
INSERT INTO `jual` VALUES (24, 17, 3, 1, 1049, 36, 288000);
INSERT INTO `jual` VALUES (24, 17, 4, 1, 1050, 36, 288000);
INSERT INTO `jual` VALUES (24, 17, 5, 1, 1051, 36, 288000);
INSERT INTO `jual` VALUES (24, 17, 18, 1, 1052, 36, 288000);
INSERT INTO `jual` VALUES (24, 17, 6, 1, 1053, 24, 192000);
INSERT INTO `jual` VALUES (25, 16, 1, 1, 131, 36, 288000);
INSERT INTO `jual` VALUES (25, 16, 6, 1, 132, 60, 480000);
INSERT INTO `jual` VALUES (25, 16, 2, 1, 131, 72, 576);
INSERT INTO `jual` VALUES (25, 16, 7, 1, 1055, 60, 480000);
INSERT INTO `jual` VALUES (25, 10, 8, 1, 174, 36, 288000);
INSERT INTO `jual` VALUES (25, 10, 3, 1, 1019, 24, 192000);
INSERT INTO `jual` VALUES (25, 10, 4, 1, 175, 36, 288000);
INSERT INTO `jual` VALUES (25, 10, 5, 1, 104, 24, 192000);
INSERT INTO `jual` VALUES (25, 10, 14, 1, 1054, 36, 288000);
INSERT INTO `jual` VALUES (25, 10, 13, 1, 1054, 36, 288000);
INSERT INTO `jual` VALUES (25, 10, 14, 3, 1054, 7, 42000);
INSERT INTO `jual` VALUES (26, 17, 8, 1, 22, 48, 384000);
INSERT INTO `jual` VALUES (26, 17, 3, 1, 175, 24, 192000);
INSERT INTO `jual` VALUES (26, 17, 4, 1, 175, 36, 288000);
INSERT INTO `jual` VALUES (26, 17, 3, 2, 175, 1, 105000);
INSERT INTO `jual` VALUES (26, 17, 5, 1, 175, 36, 288000);
INSERT INTO `jual` VALUES (26, 17, 18, 1, 22, 36, 288000);
INSERT INTO `jual` VALUES (26, 17, 18, 3, 22, 10, 60000);
INSERT INTO `jual` VALUES (26, 17, 6, 1, 22, 36, 288000);
INSERT INTO `jual` VALUES (26, 10, 1, 1, 1056, 37, 297000);
INSERT INTO `jual` VALUES (26, 10, 1, 3, 1056, 3, 18000);
INSERT INTO `jual` VALUES (26, 10, 13, 1, 214, 39, 315000);
INSERT INTO `jual` VALUES (26, 10, 2, 1, 109, 36, 288000);
INSERT INTO `jual` VALUES (26, 10, 2, 2, 109, 1, 105000);
INSERT INTO `jual` VALUES (26, 10, 12, 1, 113, 48, 384000);
INSERT INTO `jual` VALUES (26, 10, 15, 1, 74, 36, 288000);
INSERT INTO `jual` VALUES (26, 10, 7, 1, 37, 36, 288000);
INSERT INTO `jual` VALUES (26, 10, 7, 3, 37, 4, 24000);
INSERT INTO `jual` VALUES (26, 10, 7, 2, 37, 1, 105000);
INSERT INTO `jual` VALUES (27, 17, 8, 1, 2, 24, 192000);
INSERT INTO `jual` VALUES (27, 17, 3, 1, 4, 24, 192000);
INSERT INTO `jual` VALUES (27, 17, 4, 1, 2, 36, 288000);
INSERT INTO `jual` VALUES (27, 17, 5, 1, 1057, 24, 192000);
INSERT INTO `jual` VALUES (27, 17, 18, 1, 83, 36, 288000);
INSERT INTO `jual` VALUES (27, 17, 6, 1, 136, 36, 288000);
INSERT INTO `jual` VALUES (27, 10, 1, 1, 250, 48, 384000);
INSERT INTO `jual` VALUES (27, 10, 1, 3, 250, 1, 6000);
INSERT INTO `jual` VALUES (27, 10, 13, 1, 234, 24, 192000);
INSERT INTO `jual` VALUES (27, 10, 13, 3, 234, 12, 72000);
INSERT INTO `jual` VALUES (27, 10, 15, 1, 234, 24, 192000);
INSERT INTO `jual` VALUES (27, 10, 12, 1, 19, 36, 288000);
INSERT INTO `jual` VALUES (27, 10, 7, 1, 149, 48, 360000);
INSERT INTO `jual` VALUES (27, 10, 7, 3, 149, 12, 72000);
INSERT INTO `jual` VALUES (27, 10, 2, 1, 19, 48, 384000);
INSERT INTO `jual` VALUES (27, 10, 15, 3, 234, 12, 72000);
INSERT INTO `jual` VALUES (28, 10, 8, 1, 1019, 24, 192000);
INSERT INTO `jual` VALUES (28, 10, 4, 1, 22, 24, 192000);
INSERT INTO `jual` VALUES (28, 10, 3, 1, 1020, 24, 192000);
INSERT INTO `jual` VALUES (28, 10, 5, 1, 161, 24, 192000);
INSERT INTO `jual` VALUES (28, 10, 4, 3, 22, 1, 6000);
INSERT INTO `jual` VALUES (28, 16, 7, 1, 1055, 72, 576000);
INSERT INTO `jual` VALUES (28, 16, 2, 1, 1058, 60, 480000);
INSERT INTO `jual` VALUES (28, 16, 6, 1, 1038, 36, 288000);
INSERT INTO `jual` VALUES (28, 16, 1, 1, 1012, 36, 288000);
INSERT INTO `jual` VALUES (28, 16, 12, 1, 222, 24, 192000);

-- --------------------------------------------------------

-- 
-- Table structure for table `komisi`
-- 

CREATE TABLE `komisi` (
  `IDSales` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `komisi` int(11) NOT NULL,
  PRIMARY KEY  (`IDSales`,`IDBarang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `komisi`
-- 

INSERT INTO `komisi` VALUES (1, 1, 500);
INSERT INTO `komisi` VALUES (1, 2, 5000);
INSERT INTO `komisi` VALUES (2, 1, 500);
INSERT INTO `komisi` VALUES (2, 2, 5000);
INSERT INTO `komisi` VALUES (3, 1, 500);
INSERT INTO `komisi` VALUES (3, 2, 5000);
INSERT INTO `komisi` VALUES (4, 1, 500);
INSERT INTO `komisi` VALUES (4, 2, 5000);
INSERT INTO `komisi` VALUES (5, 1, 500);
INSERT INTO `komisi` VALUES (5, 2, 5000);
INSERT INTO `komisi` VALUES (6, 1, 500);
INSERT INTO `komisi` VALUES (6, 2, 5000);
INSERT INTO `komisi` VALUES (7, 1, 500);
INSERT INTO `komisi` VALUES (7, 2, 5000);
INSERT INTO `komisi` VALUES (8, 1, 500);
INSERT INTO `komisi` VALUES (8, 2, 5000);
INSERT INTO `komisi` VALUES (9, 1, 500);
INSERT INTO `komisi` VALUES (9, 2, 0);
INSERT INTO `komisi` VALUES (10, 1, 500);
INSERT INTO `komisi` VALUES (10, 2, 0);
INSERT INTO `komisi` VALUES (11, 1, 500);
INSERT INTO `komisi` VALUES (11, 2, 0);
INSERT INTO `komisi` VALUES (1, 3, 500);
INSERT INTO `komisi` VALUES (11, 3, 500);
INSERT INTO `komisi` VALUES (12, 1, 500);
INSERT INTO `komisi` VALUES (12, 2, 5000);
INSERT INTO `komisi` VALUES (12, 3, 500);
INSERT INTO `komisi` VALUES (13, 1, 500);
INSERT INTO `komisi` VALUES (13, 2, 5000);
INSERT INTO `komisi` VALUES (13, 3, 500);
INSERT INTO `komisi` VALUES (14, 1, 500);
INSERT INTO `komisi` VALUES (14, 2, 5000);
INSERT INTO `komisi` VALUES (14, 3, 500);
INSERT INTO `komisi` VALUES (15, 1, 500);
INSERT INTO `komisi` VALUES (15, 2, 5000);
INSERT INTO `komisi` VALUES (15, 3, 500);
INSERT INTO `komisi` VALUES (16, 1, 0);
INSERT INTO `komisi` VALUES (16, 2, 0);
INSERT INTO `komisi` VALUES (16, 3, 0);
INSERT INTO `komisi` VALUES (17, 1, 0);
INSERT INTO `komisi` VALUES (17, 2, 0);
INSERT INTO `komisi` VALUES (17, 3, 0);
INSERT INTO `komisi` VALUES (18, 1, 500);
INSERT INTO `komisi` VALUES (18, 2, 5000);
INSERT INTO `komisi` VALUES (18, 3, 500);
INSERT INTO `komisi` VALUES (2, 3, 500);
INSERT INTO `komisi` VALUES (3, 3, 500);
INSERT INTO `komisi` VALUES (4, 3, 500);
INSERT INTO `komisi` VALUES (5, 3, 500);
INSERT INTO `komisi` VALUES (6, 3, 500);
INSERT INTO `komisi` VALUES (7, 3, 500);
INSERT INTO `komisi` VALUES (8, 3, 500);
INSERT INTO `komisi` VALUES (9, 3, 500);
INSERT INTO `komisi` VALUES (10, 3, 500);

-- --------------------------------------------------------

-- 
-- Table structure for table `laporan_pengeluaran`
-- 

CREATE TABLE `laporan_pengeluaran` (
  `IDPengeluaran` int(11) NOT NULL auto_increment,
  `IDCabang` int(11) NOT NULL,
  `totalPengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`IDPengeluaran`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `laporan_pengeluaran`
-- 

INSERT INTO `laporan_pengeluaran` VALUES (1, 10, 350000, '2015-11-14');
INSERT INTO `laporan_pengeluaran` VALUES (2, 10, 0, '2015-11-14');
INSERT INTO `laporan_pengeluaran` VALUES (3, 11, 120000, '2015-11-14');
INSERT INTO `laporan_pengeluaran` VALUES (4, 10, 0, '2015-11-01');
INSERT INTO `laporan_pengeluaran` VALUES (5, 10, 200000, '2015-11-01');
INSERT INTO `laporan_pengeluaran` VALUES (6, 10, 350000, '2015-11-01');

-- --------------------------------------------------------

-- 
-- Table structure for table `laporan_penggajian`
-- 

CREATE TABLE `laporan_penggajian` (
  `IDPenggajian` int(11) NOT NULL auto_increment,
  `IDCabang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `totalPenggajian` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`IDPenggajian`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `laporan_penggajian`
-- 

INSERT INTO `laporan_penggajian` VALUES (1, 10, '2015-11-10', 93000, 'komisi');
INSERT INTO `laporan_penggajian` VALUES (2, 10, '2015-11-17', 4500000, 'gaji');
INSERT INTO `laporan_penggajian` VALUES (3, 10, '2015-11-17', 4680000, 'gaji');
INSERT INTO `laporan_penggajian` VALUES (4, 10, '2015-11-18', 810000, 'gaji');
INSERT INTO `laporan_penggajian` VALUES (5, 10, '2015-11-18', 344500, 'komisi');
INSERT INTO `laporan_penggajian` VALUES (6, 10, '2015-11-21', 100000, 'gaji');

-- --------------------------------------------------------

-- 
-- Table structure for table `laporan_penjualan`
-- 

CREATE TABLE `laporan_penjualan` (
  `IDPenjualan` int(11) NOT NULL auto_increment,
  `IDCabang` int(11) NOT NULL,
  `totalPenjualan` int(11) NOT NULL,
  `totalKomisi` int(11) NOT NULL,
  `saldoTerakhir` double NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `status_kas` int(11) NOT NULL default '0',
  PRIMARY KEY  (`IDPenjualan`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `laporan_penjualan`
-- 

INSERT INTO `laporan_penjualan` VALUES (1, 10, 3573000, 210500, 3492000, '2015-11-07', 'Meme & Rangga tidak masuk', 1);
INSERT INTO `laporan_penjualan` VALUES (2, 10, 2046000, 128500, 5238000, '2015-11-09', 'Meme,Vivi,Lia,Selvia,Rangga,Melani Hari Ini Tidak Masuk.', 1);
INSERT INTO `laporan_penjualan` VALUES (4, 10, 3552000, 222000, 0, '2015-11-03', 'Rangga Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (5, 10, 3057000, 191000, 0, '2015-11-04', '', 0);
INSERT INTO `laporan_penjualan` VALUES (6, 10, 3213000, 199000, 0, '2015-11-05', 'Rangga,Arini Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (7, 10, 3381000, 211000, 0, '2015-11-06', 'RANGGA & Arini Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (8, 10, 2211000, 135000, 0, '2015-11-10', 'Rangga Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (9, 10, 3648000, 228000, 0, '2015-11-11', '', 0);
INSERT INTO `laporan_penjualan` VALUES (10, 10, 2988000, 182000, 0, '2015-10-31', 'Melani & Deny Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (11, 10, 2976000, 186000, 0, '2015-11-12', 'Arini & Dimas ( Dimas tidak masuk di ganti Bpk Indra )', 0);
INSERT INTO `laporan_penjualan` VALUES (12, 10, 2265000, 144500, 0, '2015-11-02', 'Rangga,Lia,Eva,Selvia Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (13, 10, 2793000, 171000, 0, '2015-10-30', 'Eva,Rangga Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (14, 10, 3183000, 195000, 0, '2015-10-29', 'Meme Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (15, 10, 3525000, 220500, 0, '2015-10-28', '', 0);
INSERT INTO `laporan_penjualan` VALUES (16, 10, 3747000, 231000, 0, '2015-11-13', '', 0);
INSERT INTO `laporan_penjualan` VALUES (17, 10, 3408000, 214000, 0, '2015-11-14', '', 0);
INSERT INTO `laporan_penjualan` VALUES (22, 10, 3240000, 204000, 0, '2015-11-16', 'Denny Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (23, 10, 2814000, 185500, 0, '2015-10-27', 'Denny & Rangga Tidak Masuk, ( Pengeluaran bensin  90.000 )', 0);
INSERT INTO `laporan_penjualan` VALUES (24, 10, 2460000, 155000, 0, '2015-10-26', 'Vivi,Lia,Deni,Rangga Tidak Masuk ( Bensin Novan 80.000,Bensin Dimas 80.000)', 0);
INSERT INTO `laporan_penjualan` VALUES (25, 10, 2826576, 213500, 0, '2015-11-17', 'Deny Tidak Masuk', 0);
INSERT INTO `laporan_penjualan` VALUES (26, 10, 4005000, 247500, 0, '2015-10-24', 'Bensin Dimas 75000 & Bensin Novan 75000', 0);
INSERT INTO `laporan_penjualan` VALUES (27, 10, 3462000, 222500, 0, '2015-10-23', 'Bensin Novan 85.000,Parkir 7500', 0);
INSERT INTO `laporan_penjualan` VALUES (28, 10, 2598000, 162500, 0, '2015-11-18', 'Arini & Melani Tidak Masuk ( Bensin Dimas 130.000 & Bensin Hadi 130.000 )', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `lokasi`
-- 

CREATE TABLE `lokasi` (
  `IDLokasi` int(11) NOT NULL auto_increment,
  `Kabupaten` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `IDCabang` int(11) NOT NULL,
  PRIMARY KEY  (`IDLokasi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1059 ;

-- 
-- Dumping data for table `lokasi`
-- 

INSERT INTO `lokasi` VALUES (1, '', '', 'Pasar Benowo', '', 10);
INSERT INTO `lokasi` VALUES (2, '', '', 'Kandangan', '', 10);
INSERT INTO `lokasi` VALUES (3, '', '', 'Sememi', '', 10);
INSERT INTO `lokasi` VALUES (4, '', 'new kecamatan', 'Banjar Sugihan', '', 10);
INSERT INTO `lokasi` VALUES (5, '', '', 'Manukan', '', 10);
INSERT INTO `lokasi` VALUES (6, '', '', 'Gunung Anyar', '', 10);
INSERT INTO `lokasi` VALUES (7, '', '', 'Kedungdoro', '', 10);
INSERT INTO `lokasi` VALUES (8, '', '', 'Gubeng', '', 10);
INSERT INTO `lokasi` VALUES (9, '', '', 'Pandugo', '', 10);
INSERT INTO `lokasi` VALUES (10, '', '', 'Kendal Sari', '', 10);
INSERT INTO `lokasi` VALUES (11, '', '', 'Kalidami', '', 10);
INSERT INTO `lokasi` VALUES (12, '', '', 'Jojoran', '', 10);
INSERT INTO `lokasi` VALUES (13, '', '', 'Menur', '', 10);
INSERT INTO `lokasi` VALUES (14, '', '', 'Putat', '', 10);
INSERT INTO `lokasi` VALUES (15, '', '', 'Prada Kali""Kendal', '', 10);
INSERT INTO `lokasi` VALUES (16, '', '', 'Kawal', '', 10);
INSERT INTO `lokasi` VALUES (17, '', '', 'Kebraon', '', 10);
INSERT INTO `lokasi` VALUES (18, '', '', 'Gunung Sari', '', 10);
INSERT INTO `lokasi` VALUES (19, '', '', 'Wiyung', '', 10);
INSERT INTO `lokasi` VALUES (20, '', '', 'Menganti', '', 10);
INSERT INTO `lokasi` VALUES (21, '', '', 'Dukuh Bulak Banteng', '', 10);
INSERT INTO `lokasi` VALUES (22, '', '', 'Wonokusumo', '', 10);
INSERT INTO `lokasi` VALUES (23, '', '', 'Tenggumung Mulya', '', 10);
INSERT INTO `lokasi` VALUES (24, '', '', 'Baru', '', 10);
INSERT INTO `lokasi` VALUES (25, '', '', 'Lakarsantri', '', 10);
INSERT INTO `lokasi` VALUES (26, '', '', 'Pasar Menganti', '', 10);
INSERT INTO `lokasi` VALUES (27, '', '', 'Sambi Kerep', '', 10);
INSERT INTO `lokasi` VALUES (28, '', '', 'Krukah', '', 10);
INSERT INTO `lokasi` VALUES (29, '', '', 'Bratang Binangun', '', 10);
INSERT INTO `lokasi` VALUES (30, '', '', 'Pesapean', '', 10);
INSERT INTO `lokasi` VALUES (31, '', '', 'Perak Timur', '', 10);
INSERT INTO `lokasi` VALUES (32, '', '', 'Kebalen', '', 10);
INSERT INTO `lokasi` VALUES (33, '', '', 'Manyar Sambongan', '', 10);
INSERT INTO `lokasi` VALUES (34, '', '', 'Mleto', '', 10);
INSERT INTO `lokasi` VALUES (35, '', '', 'Gebang Lor', '', 10);
INSERT INTO `lokasi` VALUES (36, '', '', 'Gebang Putih', '', 10);
INSERT INTO `lokasi` VALUES (37, '', '', 'Girilaya', '', 10);
INSERT INTO `lokasi` VALUES (38, '', '', 'Simo', '', 10);
INSERT INTO `lokasi` VALUES (39, '', '', 'Kupang Krajan', '', 10);
INSERT INTO `lokasi` VALUES (40, '', '', 'Pasar Kembang', '', 10);
INSERT INTO `lokasi` VALUES (41, '', '', 'Kalimas Baru', '', 10);
INSERT INTO `lokasi` VALUES (42, '', '', 'Petemon', '', 10);
INSERT INTO `lokasi` VALUES (43, '', '', 'Tidar', '', 10);
INSERT INTO `lokasi` VALUES (44, '', '', 'Keputih', '', 10);
INSERT INTO `lokasi` VALUES (45, '', '', 'Menur Pumpungan', '', 10);
INSERT INTO `lokasi` VALUES (46, '', '', 'Pacar Keling', '', 10);
INSERT INTO `lokasi` VALUES (47, '', '', 'Bronggalan', '', 10);
INSERT INTO `lokasi` VALUES (48, '', '', 'Karang Menjangan', '', 10);
INSERT INTO `lokasi` VALUES (49, '', '', 'Jl.Mojo(Dharmahusada)', '', 10);
INSERT INTO `lokasi` VALUES (50, '', '', 'Wonocolo', '', 10);
INSERT INTO `lokasi` VALUES (51, '', '', 'Margerejo', '', 10);
INSERT INTO `lokasi` VALUES (52, '', '', 'Pulo Wonokromo', '', 10);
INSERT INTO `lokasi` VALUES (53, '', '', 'Bendul Merisi', '', 10);
INSERT INTO `lokasi` VALUES (54, '', '', 'Kendang Sari', '', 10);
INSERT INTO `lokasi` VALUES (55, '', '', 'Bulak Rukem Timur', '', 10);
INSERT INTO `lokasi` VALUES (56, '', '', 'Bulak Cupat', '', 10);
INSERT INTO `lokasi` VALUES (57, '', '', 'Kapas Madya', '', 10);
INSERT INTO `lokasi` VALUES (58, '', '', 'Kapas Lor Kulon', '', 10);
INSERT INTO `lokasi` VALUES (59, '', '', 'Pengampon', '', 10);
INSERT INTO `lokasi` VALUES (60, '', '', 'Kapasan', '', 10);
INSERT INTO `lokasi` VALUES (61, '', '', 'Sidodadi', '', 10);
INSERT INTO `lokasi` VALUES (62, '', '', 'Margorukun', '', 10);
INSERT INTO `lokasi` VALUES (63, '', '', 'Sumber Mulya', '', 10);
INSERT INTO `lokasi` VALUES (64, '', '', 'Asem Rowo', '', 10);
INSERT INTO `lokasi` VALUES (65, '', '', 'Dupak Rukun', '', 10);
INSERT INTO `lokasi` VALUES (66, '', '', 'Medokan Ayu', '', 10);
INSERT INTO `lokasi` VALUES (67, '', '', 'Gunung Anyar', '', 10);
INSERT INTO `lokasi` VALUES (68, '', '', 'Pondok Candra', '', 10);
INSERT INTO `lokasi` VALUES (69, '', '', 'Rungkut', '', 10);
INSERT INTO `lokasi` VALUES (70, '', '', 'Kutisari', '', 10);
INSERT INTO `lokasi` VALUES (71, '', '', 'Tembok Gede', '', 10);
INSERT INTO `lokasi` VALUES (72, '', '', 'Pasar Tembok', '', 10);
INSERT INTO `lokasi` VALUES (73, '', '', 'Kranggan', '', 10);
INSERT INTO `lokasi` VALUES (74, '', '', 'Banyu Urip', '', 10);
INSERT INTO `lokasi` VALUES (75, '', '', 'Kupang Gunung', '', 10);
INSERT INTO `lokasi` VALUES (76, '', '', 'Tembok Sayuran', '', 10);
INSERT INTO `lokasi` VALUES (77, '', '', 'Teluk Nibung', '', 10);
INSERT INTO `lokasi` VALUES (78, '', '', 'Teluk Betung', '', 10);
INSERT INTO `lokasi` VALUES (79, '', '', 'Kalimas Barat', '', 10);
INSERT INTO `lokasi` VALUES (80, '', '', 'Putat Gede', '', 10);
INSERT INTO `lokasi` VALUES (81, '', '', 'Babakan', '', 10);
INSERT INTO `lokasi` VALUES (82, '', '', 'Kapas Krampung', '', 10);
INSERT INTO `lokasi` VALUES (83, '', '', 'Balong Sari', '', 10);
INSERT INTO `lokasi` VALUES (84, '', '', 'Tambak Sari', '', 10);
INSERT INTO `lokasi` VALUES (85, '', '', 'Bulak Cupat', '', 10);
INSERT INTO `lokasi` VALUES (86, '', '', 'Kalilom lor indah', '', 10);
INSERT INTO `lokasi` VALUES (87, '', '', 'Nambangan', '', 10);
INSERT INTO `lokasi` VALUES (88, '', '', 'Rungkut Kali', '', 10);
INSERT INTO `lokasi` VALUES (89, '', '', 'Kutisari', '', 10);
INSERT INTO `lokasi` VALUES (90, '', '', 'Kendang Sari', '', 10);
INSERT INTO `lokasi` VALUES (91, '', '', 'Nginden', '', 10);
INSERT INTO `lokasi` VALUES (92, '', '', 'Semampir Tengah', '', 10);
INSERT INTO `lokasi` VALUES (93, '', '', 'Gembong', '', 10);
INSERT INTO `lokasi` VALUES (94, '', '', 'Pecindilan', '', 10);
INSERT INTO `lokasi` VALUES (95, '', '', 'Semampir Utara', '', 10);
INSERT INTO `lokasi` VALUES (96, '', '', 'Semampir Selatan', '', 10);
INSERT INTO `lokasi` VALUES (97, '', '', 'Dukuh Kupang', '', 10);
INSERT INTO `lokasi` VALUES (99, '', '', 'Pakis', '', 10);
INSERT INTO `lokasi` VALUES (100, '', '', 'Kembang Kuning', '', 10);
INSERT INTO `lokasi` VALUES (101, '', '', 'Kebangsren', '', 10);
INSERT INTO `lokasi` VALUES (102, '', '', 'Dinoyo', '', 10);
INSERT INTO `lokasi` VALUES (103, '', '', 'Joyoboyo', '', 10);
INSERT INTO `lokasi` VALUES (104, '', '', 'Pogot', '', 10);
INSERT INTO `lokasi` VALUES (105, '', '', 'Rangkah', '', 10);
INSERT INTO `lokasi` VALUES (106, '', '', 'Karang Tembok', '', 10);
INSERT INTO `lokasi` VALUES (107, '', '', 'Jati Purwo', '', 10);
INSERT INTO `lokasi` VALUES (108, '', '', 'Pandegiling', '', 10);
INSERT INTO `lokasi` VALUES (109, '', '', 'Kedondong', '', 10);
INSERT INTO `lokasi` VALUES (110, '', '', 'Kedungturi', '', 10);
INSERT INTO `lokasi` VALUES (111, '', '', 'Kranggan', '', 10);
INSERT INTO `lokasi` VALUES (112, '', '', 'Kampung Malang', '', 10);
INSERT INTO `lokasi` VALUES (113, '', '', 'Wonorejo', '', 10);
INSERT INTO `lokasi` VALUES (114, '', '', 'Kedung Baruk', '', 10);
INSERT INTO `lokasi` VALUES (115, '', '', 'Kedung Tarukan', '', 10);
INSERT INTO `lokasi` VALUES (116, '', '', 'Kedung Asem', '', 10);
INSERT INTO `lokasi` VALUES (117, '', '', 'Mojoklangru""Lor', '', 10);
INSERT INTO `lokasi` VALUES (118, '', '', 'Setro Baru', '', 10);
INSERT INTO `lokasi` VALUES (119, '', '', 'Nginden Jaya', '', 10);
INSERT INTO `lokasi` VALUES (120, '', '', 'Nginden Kota', '', 10);
INSERT INTO `lokasi` VALUES (121, '', '', 'Gubeng Masjid', '', 10);
INSERT INTO `lokasi` VALUES (122, '', '', 'Kebraon', '', 10);
INSERT INTO `lokasi` VALUES (123, '', '', 'Kedurus', '', 10);
INSERT INTO `lokasi` VALUES (124, '', '', 'Mastrip', '', 10);
INSERT INTO `lokasi` VALUES (125, '', '', 'Karang Pilang', '', 10);
INSERT INTO `lokasi` VALUES (126, '', '', 'Sidotopo""Wetan', '', 10);
INSERT INTO `lokasi` VALUES (127, '', '', 'Randu', '', 10);
INSERT INTO `lokasi` VALUES (128, '', '', 'Kedung Mangu', '', 10);
INSERT INTO `lokasi` VALUES (129, '', '', 'Mulyorejo', '', 10);
INSERT INTO `lokasi` VALUES (130, '', '', 'Mojoklangru', '', 10);
INSERT INTO `lokasi` VALUES (131, '', '', 'Kalianak', '', 10);
INSERT INTO `lokasi` VALUES (132, '', '', 'Tambak Asri', '', 10);
INSERT INTO `lokasi` VALUES (133, '', '', 'Simo Pomahan""Baru', '', 10);
INSERT INTO `lokasi` VALUES (134, '', '', 'Simo Rejosari', '', 10);
INSERT INTO `lokasi` VALUES (135, '', '', 'Ngagel', '', 10);
INSERT INTO `lokasi` VALUES (136, '', '', 'Bibis Tama', '', 10);
INSERT INTO `lokasi` VALUES (137, '', '', 'Margerejo', '', 10);
INSERT INTO `lokasi` VALUES (138, '', '', 'Kapasari Pedukuan', '', 10);
INSERT INTO `lokasi` VALUES (139, '', '', 'Tambak Adi', '', 10);
INSERT INTO `lokasi` VALUES (140, '', '', 'Kapas Krampung', '', 10);
INSERT INTO `lokasi` VALUES (141, '', '', 'Sidotopo Lor', '', 10);
INSERT INTO `lokasi` VALUES (142, '', '', 'Demak', '', 10);
INSERT INTO `lokasi` VALUES (143, '', '', 'Jetis Wetan', '', 10);
INSERT INTO `lokasi` VALUES (144, '', '', 'Tambak Mayor', '', 10);
INSERT INTO `lokasi` VALUES (145, '', '', 'Simorejosari""', '', 10);
INSERT INTO `lokasi` VALUES (146, '', '', 'Tanjung Sari', '', 10);
INSERT INTO `lokasi` VALUES (147, '', '', 'Kerto Menanggal', '', 10);
INSERT INTO `lokasi` VALUES (148, '', '', 'Pulosari', '', 10);
INSERT INTO `lokasi` VALUES (149, '', '', 'Karangan', '', 10);
INSERT INTO `lokasi` VALUES (150, '', '', 'Pulo wonokromo', '', 10);
INSERT INTO `lokasi` VALUES (151, '', '', 'Karang Rejo', '', 10);
INSERT INTO `lokasi` VALUES (152, '', '', 'Dupak Timur', '', 10);
INSERT INTO `lokasi` VALUES (153, '', '', 'Pakis Tirtosari', '', 10);
INSERT INTO `lokasi` VALUES (154, '', '', 'Dupak Rukun', '', 10);
INSERT INTO `lokasi` VALUES (155, '', '', 'Dupak Jaya', '', 10);
INSERT INTO `lokasi` VALUES (156, '', '', 'Asem Jaya', '', 10);
INSERT INTO `lokasi` VALUES (157, '', '', 'Asem Bagus', '', 10);
INSERT INTO `lokasi` VALUES (158, '', '', 'Asem Mulya', '', 10);
INSERT INTO `lokasi` VALUES (159, '', '', 'Simo Kalangan', '', 10);
INSERT INTO `lokasi` VALUES (160, '', '', 'Gubeng Glingsingan', '', 10);
INSERT INTO `lokasi` VALUES (161, '', '', 'Sidorame', '', 10);
INSERT INTO `lokasi` VALUES (162, '', '', 'Perak Timur', '', 10);
INSERT INTO `lokasi` VALUES (163, '', '', 'Petukangan', '', 10);
INSERT INTO `lokasi` VALUES (164, '', '', 'Ampel', '', 10);
INSERT INTO `lokasi` VALUES (165, '', '', 'Pandegiling', '', 10);
INSERT INTO `lokasi` VALUES (166, '', '', 'Kupang Segunting', '', 10);
INSERT INTO `lokasi` VALUES (167, '', '', 'Tambak Mayor', '', 10);
INSERT INTO `lokasi` VALUES (168, '', '', 'Kali Judan', '', 10);
INSERT INTO `lokasi` VALUES (169, '', '', 'Rungkut Kidul', '', 10);
INSERT INTO `lokasi` VALUES (170, '', '', 'Pasar Pahing', '', 10);
INSERT INTO `lokasi` VALUES (171, '', '', 'Rungkut Menanggal', '', 10);
INSERT INTO `lokasi` VALUES (172, '', '', 'Wadung Asri', '', 10);
INSERT INTO `lokasi` VALUES (173, '', '', 'Pakis Argosari', '', 10);
INSERT INTO `lokasi` VALUES (174, '', '', 'Tenggumung', '', 10);
INSERT INTO `lokasi` VALUES (175, '', '', 'Bulak Banteng', '', 10);
INSERT INTO `lokasi` VALUES (176, '', '', 'Jagiran', '', 10);
INSERT INTO `lokasi` VALUES (177, '', '', 'Donokerto', '', 10);
INSERT INTO `lokasi` VALUES (178, '', '', 'Kapasari', '', 10);
INSERT INTO `lokasi` VALUES (179, '', '', 'Kapas Madya', '', 10);
INSERT INTO `lokasi` VALUES (180, '', '', 'Kenjeran', '', 10);
INSERT INTO `lokasi` VALUES (181, '', '', 'Rembang', '', 10);
INSERT INTO `lokasi` VALUES (182, '', '', 'Jogoloyo', '', 10);
INSERT INTO `lokasi` VALUES (183, '', '', 'Bratang Gede', '', 10);
INSERT INTO `lokasi` VALUES (184, '', '', 'JL.Jakarta', '', 10);
INSERT INTO `lokasi` VALUES (185, '', '', 'Johar Baru', '', 10);
INSERT INTO `lokasi` VALUES (186, '', '', 'Klampis', '', 10);
INSERT INTO `lokasi` VALUES (187, '', '', 'Gubeng Masjid', '', 10);
INSERT INTO `lokasi` VALUES (188, '', '', 'Ambengan', '', 10);
INSERT INTO `lokasi` VALUES (189, '', '', 'Ngaglik', '', 10);
INSERT INTO `lokasi` VALUES (190, '', '', 'Sidotopo Sekolahan', '', 10);
INSERT INTO `lokasi` VALUES (191, '', '', 'Greges', '', 10);
INSERT INTO `lokasi` VALUES (192, '', '', 'Tembaan', '', 10);
INSERT INTO `lokasi` VALUES (193, '', '', 'Maspati', '', 10);
INSERT INTO `lokasi` VALUES (194, '', '', 'Plampungan', '', 10);
INSERT INTO `lokasi` VALUES (195, '', '', 'Jl.Semarang', '', 10);
INSERT INTO `lokasi` VALUES (196, '', '', 'Jl.Sampoerna', '', 10);
INSERT INTO `lokasi` VALUES (197, '', '', 'Kedung Cowek', '', 10);
INSERT INTO `lokasi` VALUES (198, '', '', 'Merr', '', 10);
INSERT INTO `lokasi` VALUES (199, '', '', 'Lebak', '', 10);
INSERT INTO `lokasi` VALUES (200, '', '', 'Gadukan', '', 10);
INSERT INTO `lokasi` VALUES (201, '', '', 'Pasar Soponyono', '', 10);
INSERT INTO `lokasi` VALUES (202, '', '', 'Sutorejo', '', 10);
INSERT INTO `lokasi` VALUES (203, '', '', 'Rajawali', '', 10);
INSERT INTO `lokasi` VALUES (204, '', '', 'Lasem', '', 10);
INSERT INTO `lokasi` VALUES (205, '', '', 'Krembangan Bhakti', '', 10);
INSERT INTO `lokasi` VALUES (206, '', '', 'Krembangan Mulya', '', 10);
INSERT INTO `lokasi` VALUES (207, '', '', 'Surabayan', '', 10);
INSERT INTO `lokasi` VALUES (208, '', '', 'Tegalsari', '', 10);
INSERT INTO `lokasi` VALUES (209, '', '', 'Kali Kepiting', '', 10);
INSERT INTO `lokasi` VALUES (210, '', '', 'Manyar', '', 10);
INSERT INTO `lokasi` VALUES (211, '', '', 'Wonocolo', '', 10);
INSERT INTO `lokasi` VALUES (212, '', '', 'Pajuan Kuda', '', 10);
INSERT INTO `lokasi` VALUES (213, '', '', 'Blauran', '', 10);
INSERT INTO `lokasi` VALUES (214, '', '', 'Pandegiling', '', 10);
INSERT INTO `lokasi` VALUES (215, '', '', 'Kedinding', '', 10);
INSERT INTO `lokasi` VALUES (216, '', '', 'Tanah Merah', '', 10);
INSERT INTO `lokasi` VALUES (217, '', '', 'Ambengan', '', 10);
INSERT INTO `lokasi` VALUES (218, '', '', 'Babatan', '', 10);
INSERT INTO `lokasi` VALUES (219, '', '', 'Bogangin', '', 10);
INSERT INTO `lokasi` VALUES (220, '', '', 'Lidah', '', 10);
INSERT INTO `lokasi` VALUES (221, '', '', 'Kanginan', '', 10);
INSERT INTO `lokasi` VALUES (222, '', '', 'Indrapura', '', 10);
INSERT INTO `lokasi` VALUES (223, '', '', 'Donowati', '', 10);
INSERT INTO `lokasi` VALUES (224, '', '', 'Gadel', '', 10);
INSERT INTO `lokasi` VALUES (225, '', '', 'Sikatan', '', 10);
INSERT INTO `lokasi` VALUES (226, '', '', 'Bratang', '', 10);
INSERT INTO `lokasi` VALUES (227, '', '', 'Pasar Gresikaan', '', 10);
INSERT INTO `lokasi` VALUES (228, '', '', 'Ploso', '', 10);
INSERT INTO `lokasi` VALUES (229, '', '', 'Bogen', '', 10);
INSERT INTO `lokasi` VALUES (230, '', '', 'Tambak Segaran', '', 10);
INSERT INTO `lokasi` VALUES (231, '', '', 'Suropati', '', 10);
INSERT INTO `lokasi` VALUES (232, '', '', 'Ngesong', '', 10);
INSERT INTO `lokasi` VALUES (233, '', '', 'Pasar Turi', '', 10);
INSERT INTO `lokasi` VALUES (234, '', '', 'Pagesangan', '', 10);
INSERT INTO `lokasi` VALUES (235, '', '', 'Karah', '', 10);
INSERT INTO `lokasi` VALUES (236, '', '', 'Jambangan', '', 10);
INSERT INTO `lokasi` VALUES (237, '', '', 'Pasar jarak', '', 10);
INSERT INTO `lokasi` VALUES (238, '', '', 'Kebonsari', '', 10);
INSERT INTO `lokasi` VALUES (239, '', '', 'Bogosari', '', 10);
INSERT INTO `lokasi` VALUES (240, '', '', 'Bambe', '', 10);
INSERT INTO `lokasi` VALUES (241, '', '', 'Sedati', '', 10);
INSERT INTO `lokasi` VALUES (242, '', '', 'Gedangan', '', 10);
INSERT INTO `lokasi` VALUES (243, '', '', 'Taman', '', 10);
INSERT INTO `lokasi` VALUES (244, '', '', 'Sukodono', '', 10);
INSERT INTO `lokasi` VALUES (245, '', '', 'Jedong', '', 10);
INSERT INTO `lokasi` VALUES (246, '', '', 'Wage', '', 10);
INSERT INTO `lokasi` VALUES (247, '', '', 'Brigjend Katamso', '', 10);
INSERT INTO `lokasi` VALUES (248, '', '', 'Wedoro', '', 10);
INSERT INTO `lokasi` VALUES (249, '', '', 'Deltasari', '', 10);
INSERT INTO `lokasi` VALUES (250, '', '', 'Sepanjang', '', 10);
INSERT INTO `lokasi` VALUES (978, '', '', 'Putat Jaya', '', 10);
INSERT INTO `lokasi` VALUES (979, '', '', 'mojokerto', '', 10);
INSERT INTO `lokasi` VALUES (982, 'tabeta', 'no', 'kimi', 'nani', 10);
INSERT INTO `lokasi` VALUES (983, 'batata', 'batata', 'batata', 'batata', 10);
INSERT INTO `lokasi` VALUES (984, 'sidoarjo', '', 'waru', '', 10);
INSERT INTO `lokasi` VALUES (985, '', '', 'tropodo', '', 10);
INSERT INTO `lokasi` VALUES (986, '', '', 'Rungkut Kidul', '', 10);
INSERT INTO `lokasi` VALUES (987, '', '', 'Granting', '', 10);
INSERT INTO `lokasi` VALUES (988, '', '', 'Ngelom', '', 10);
INSERT INTO `lokasi` VALUES (989, '', '', 'Tambak Wedi', '', 10);
INSERT INTO `lokasi` VALUES (990, '', '', 'Srikana', '', 10);
INSERT INTO `lokasi` VALUES (991, '', '', 'Pulo Tegal', '', 10);
INSERT INTO `lokasi` VALUES (992, '', '', 'Semolowaru', '', 10);
INSERT INTO `lokasi` VALUES (993, '', '', 'Pasar Loak', '', 10);
INSERT INTO `lokasi` VALUES (994, '', '', 'Bulak setro', '', 10);
INSERT INTO `lokasi` VALUES (995, '', '', 'Kedung Cowek', '', 10);
INSERT INTO `lokasi` VALUES (996, '', '', 'Tambak Wedi', '', 10);
INSERT INTO `lokasi` VALUES (997, '', '', 'Simo Jawar', '', 10);
INSERT INTO `lokasi` VALUES (998, '', '', 'Suko Manunggal', '', 10);
INSERT INTO `lokasi` VALUES (999, '', '', 'Betro', '', 10);
INSERT INTO `lokasi` VALUES (1000, '', '', 'Tenggumung', '', 10);
INSERT INTO `lokasi` VALUES (1001, '', '', 'Jemur Sari', '', 10);
INSERT INTO `lokasi` VALUES (1002, '', '', 'Jemur', '', 10);
INSERT INTO `lokasi` VALUES (1003, '', '', 'Kali Rungkut', '', 10);
INSERT INTO `lokasi` VALUES (1004, '', '', 'Tenggilis', '', 10);
INSERT INTO `lokasi` VALUES (1005, '', '', 'Pondok Jati', '', 10);
INSERT INTO `lokasi` VALUES (1006, '', '', 'Pasar Sepanjang', '', 10);
INSERT INTO `lokasi` VALUES (1007, '', '', 'Bungurasih', '', 10);
INSERT INTO `lokasi` VALUES (1008, '', '', 'Taman', '', 10);
INSERT INTO `lokasi` VALUES (1009, '', '', 'HR. Muhammad', '', 10);
INSERT INTO `lokasi` VALUES (1010, '', '', 'Sidowayah', 'Sidoarjo', 10);
INSERT INTO `lokasi` VALUES (1011, '', '', 'Kremil', '', 10);
INSERT INTO `lokasi` VALUES (1012, '', '', 'Perak', '', 10);
INSERT INTO `lokasi` VALUES (1013, '', '', 'Lemah Putro', 'Sidoarjo', 10);
INSERT INTO `lokasi` VALUES (1014, '', '', 'Taman Pinang', 'Sidoarjo', 10);
INSERT INTO `lokasi` VALUES (1015, '', '', 'larangan', 'Sidoarjo', 10);
INSERT INTO `lokasi` VALUES (1016, '', '', 'JL.Pahlawan', 'Sidoarjo', 10);
INSERT INTO `lokasi` VALUES (1017, '', '', 'Baliwerti', '', 10);
INSERT INTO `lokasi` VALUES (1018, '', '', 'Bubutan', '', 10);
INSERT INTO `lokasi` VALUES (1019, '', '', 'Wonosasri', '', 10);
INSERT INTO `lokasi` VALUES (1020, '', '', 'Sidotopo', '', 10);
INSERT INTO `lokasi` VALUES (1021, '', '', 'Manukan Lor', '', 10);
INSERT INTO `lokasi` VALUES (1022, '', '', 'Lempung Tama', '', 10);
INSERT INTO `lokasi` VALUES (1023, '', '', 'Lempung Indah', '', 10);
INSERT INTO `lokasi` VALUES (1024, '', '', 'Tambak Gringsingan', '', 10);
INSERT INTO `lokasi` VALUES (1025, '', '', 'Kupang Jaya', '', 10);
INSERT INTO `lokasi` VALUES (1026, '', '', 'Pulo Tegal', '', 10);
INSERT INTO `lokasi` VALUES (1027, '', '', 'Karang Rejo', '', 10);
INSERT INTO `lokasi` VALUES (1028, '', '', 'Manukan Mukti', '', 10);
INSERT INTO `lokasi` VALUES (1029, '', '', 'Genteng', '', 10);
INSERT INTO `lokasi` VALUES (1030, '', '', 'Jagir', '', 10);
INSERT INTO `lokasi` VALUES (1031, '', '', 'Dukuh Menanggal', '', 10);
INSERT INTO `lokasi` VALUES (1032, '', '', 'Mulyosari', '', 10);
INSERT INTO `lokasi` VALUES (1033, '', '', 'Kupang', '', 10);
INSERT INTO `lokasi` VALUES (1034, '', '', 'Darmo kali', '', 10);
INSERT INTO `lokasi` VALUES (1035, '', '', 'Kali Bokor', '', 10);
INSERT INTO `lokasi` VALUES (1036, '', '', 'Bagong', '', 10);
INSERT INTO `lokasi` VALUES (1037, '', '', 'Wonokromo', '', 10);
INSERT INTO `lokasi` VALUES (1038, '', '', 'Pulosari', '', 10);
INSERT INTO `lokasi` VALUES (1039, '', '', 'Jarak', '', 10);
INSERT INTO `lokasi` VALUES (1040, '', '', 'Krembangan', '', 10);
INSERT INTO `lokasi` VALUES (1041, '', '', 'Mundu', '', 10);
INSERT INTO `lokasi` VALUES (1042, '', '', 'Simokerto', '', 10);
INSERT INTO `lokasi` VALUES (1043, '', '', 'Donorejo', '', 10);
INSERT INTO `lokasi` VALUES (1044, 'Sidoarjo', '', 'Sidoarjo', '', 10);
INSERT INTO `lokasi` VALUES (1045, 'Sidoarjo', '', 'GOR Sidoarjo', '', 10);
INSERT INTO `lokasi` VALUES (1046, 'Sidoarjo', '', 'Alun2 Sidoarjo', '', 10);
INSERT INTO `lokasi` VALUES (1047, 'Sidoarjo', '', 'Tanggulangin', '', 10);
INSERT INTO `lokasi` VALUES (1048, 'Sidoarjo', '', 'Pasar Porong', '', 10);
INSERT INTO `lokasi` VALUES (1049, '', '', 'Pasar Krempyeng', '', 10);
INSERT INTO `lokasi` VALUES (1050, '', '', 'Sidorukun', '', 10);
INSERT INTO `lokasi` VALUES (1051, '', '', 'Kebomas', '', 10);
INSERT INTO `lokasi` VALUES (1052, '', '', 'DR.Soetomo', '', 10);
INSERT INTO `lokasi` VALUES (1053, '', '', 'Veteran', '', 10);
INSERT INTO `lokasi` VALUES (1054, '', '', 'Kapas Baru', '', 10);
INSERT INTO `lokasi` VALUES (1055, '', '', 'Mayjen', '', 10);
INSERT INTO `lokasi` VALUES (1056, '', '', 'Tempel', '', 10);
INSERT INTO `lokasi` VALUES (1057, '', '', 'Benowo', '', 10);
INSERT INTO `lokasi` VALUES (1058, '', '', 'Kertajaya', '', 10);

-- --------------------------------------------------------

-- 
-- Table structure for table `pengeluaran`
-- 

CREATE TABLE `pengeluaran` (
  `IDPengeluaran` int(11) NOT NULL auto_increment,
  `jumlah` double NOT NULL,
  `keterangan` text NOT NULL,
  `IDPenjualan` int(11) NOT NULL,
  PRIMARY KEY  (`IDPengeluaran`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- 
-- Dumping data for table `pengeluaran`
-- 

INSERT INTO `pengeluaran` VALUES (1, 81000, 'Bensin', 1);
INSERT INTO `pengeluaran` VALUES (2, 150000, 'Bensin', 2);
INSERT INTO `pengeluaran` VALUES (3, 150000, 'Bensin', 2);
INSERT INTO `pengeluaran` VALUES (4, 160000, 'Bensin', 3);
INSERT INTO `pengeluaran` VALUES (5, 150000, 'Bensin', 3);
INSERT INTO `pengeluaran` VALUES (6, 3000, 'Parkir', 3);
INSERT INTO `pengeluaran` VALUES (7, 145000, 'Bensin', 5);
INSERT INTO `pengeluaran` VALUES (8, 145000, 'Bensin', 6);
INSERT INTO `pengeluaran` VALUES (9, 140000, 'Bensin', 7);
INSERT INTO `pengeluaran` VALUES (10, 3000, 'Parkir', 7);
INSERT INTO `pengeluaran` VALUES (11, 145000, 'Bensin', 9);
INSERT INTO `pengeluaran` VALUES (12, 145000, 'Bensin', 9);
INSERT INTO `pengeluaran` VALUES (13, 80000, 'Bensin', 10);
INSERT INTO `pengeluaran` VALUES (14, 80000, 'Bensin', 10);
INSERT INTO `pengeluaran` VALUES (15, 9000, 'Parkir', 10);
INSERT INTO `pengeluaran` VALUES (16, 60000, 'Bensin', 11);
INSERT INTO `pengeluaran` VALUES (17, 150000, 'Bensin', 12);
INSERT INTO `pengeluaran` VALUES (18, 3000, 'Parkir', 12);
INSERT INTO `pengeluaran` VALUES (19, 75000, 'Bensin', 13);
INSERT INTO `pengeluaran` VALUES (20, 75000, 'Bensin', 13);
INSERT INTO `pengeluaran` VALUES (21, 75000, 'Bensin', 14);
INSERT INTO `pengeluaran` VALUES (22, 6000, 'Parkir', 14);
INSERT INTO `pengeluaran` VALUES (23, 102000, 'Bensin', 15);
INSERT INTO `pengeluaran` VALUES (24, 102000, 'Bensin', 15);
INSERT INTO `pengeluaran` VALUES (25, 122000, 'Bensin', 16);
INSERT INTO `pengeluaran` VALUES (26, 122000, 'Bensin', 16);

-- --------------------------------------------------------

-- 
-- Table structure for table `sales`
-- 

CREATE TABLE `sales` (
  `IDSales` int(11) NOT NULL auto_increment,
  `nama` varchar(60) NOT NULL,
  `noTelp` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `gaji` double NOT NULL,
  `tempatLahir` varchar(50) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `totalGaji` int(11) NOT NULL,
  `totalKomisi` int(11) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `IDCabang` int(11) NOT NULL,
  PRIMARY KEY  (`IDSales`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `sales`
-- 

INSERT INTO `sales` VALUES (1, 'Eva', '000000000', '732LjvJnCcmQsales.jpg', 90000, '-', '1990-01-01', 90000, 18000, 'SPG', 10);
INSERT INTO `sales` VALUES (2, 'Lia', '000000000', 'awF97HTNYjkAsales.jpg', 90000, '-', '1990-01-01', 800000, 11044000, 'SPG', 10);
INSERT INTO `sales` VALUES (3, 'Meme', '00000000000', 'kSL3wYouMsFAsales.jpg', 90000, '-', '1990-01-01', 1080000, 381000, 'SPG', 10);
INSERT INTO `sales` VALUES (4, 'Putri', '00000000000', 'rQGlN7a4nTdosales.jpg', 90000, '-', '1990-01-01', 990000, 370500, 'SPG', 10);
INSERT INTO `sales` VALUES (5, 'Selvia', '00000000000', 'P8a4W9z7LB26sales.jpg', 90000, '-', '1990-01-01', 990000, 314000, 'SPG', 10);
INSERT INTO `sales` VALUES (6, 'Selvie', '00000000000', 'pfy8pCMnKUIjsales.jpg', 90000, '-', '1990-01-01', 1080000, 534000, 'SPG', 10);
INSERT INTO `sales` VALUES (7, 'Sofie', '00000000000', 'qzYZMnWsf6MVsales.jpg', 90000, '-', '1990-01-01', 2160000, 704500, 'SPG', 10);
INSERT INTO `sales` VALUES (8, 'Vivi', '00000000000', 'xo0vytcOHkSqsales.jpg', 90000, '-', '1990-01-01', 990000, 329000, 'SPG', 10);
INSERT INTO `sales` VALUES (13, 'Melani', '00', 'qISpVNfcXU7rsales.jpg', 90000, '', '1990-01-01', 900000, 392500, 'SPG', 10);
INSERT INTO `sales` VALUES (10, 'Dimas', '00000000000', 'gEPIx2K6mekLsales.jpg', 0, '-', '1990-01-01', 0, 0, 'Team Leader', 10);
INSERT INTO `sales` VALUES (12, 'Denny', '00', 'xnqcFnuULDUmsales.jpg', 90000, '', '1990-01-01', 630000, 297500, 'SPG', 10);
INSERT INTO `sales` VALUES (14, 'Ariany', '00', '75dztGwQUQKasales.jpg', 90000, '', '1990-01-01', 360000, 184500, 'SPG', 10);
INSERT INTO `sales` VALUES (15, 'Rangga', '00', 'oivB1FHVLStXsales.jpg', 90000, '', '1990-01-01', 450000, 86000, 'SPG', 10);
INSERT INTO `sales` VALUES (16, 'Hadi', '00', 'nypcoYjOqjxxsales.jpg', 90000, '', '1990-01-01', 0, 0, 'Team Leader', 10);
INSERT INTO `sales` VALUES (17, 'Novan', '', 'cWAulgmhRc3Xsales.jpg', 90000, '', '1990-01-01', 0, 0, 'Team Leader', 10);
INSERT INTO `sales` VALUES (18, 'Indah', '', 'VKRaiYwStSI5sales.jpg', 90000, '', '1990-01-01', 720000, 143000, 'SPG', 10);
