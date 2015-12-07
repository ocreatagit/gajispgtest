-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 27, 2015 at 04:06 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `penggajian`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `lokasi`
-- 

CREATE TABLE `lokasi` (
  `IDLokasi` int(11) NOT NULL auto_increment,
  `Provinsi` varchar(50) NOT NULL,
  `Kabupaten` varchar(50) NOT NULL,
  `Kecamatan` varchar(50) NOT NULL,
  `Desa` varchar(50) NOT NULL,
  PRIMARY KEY  (`IDLokasi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `lokasi`
-- 

INSERT INTO `lokasi` VALUES (1, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (2, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (3, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (4, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (5, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (6, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (7, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (8, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (9, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (10, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (11, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (12, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (13, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (14, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (15, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (16, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (17, 'asd', '', '', '');
INSERT INTO `lokasi` VALUES (18, 'asd', '', '', '');
