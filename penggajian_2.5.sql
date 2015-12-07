-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Nov 2015 pada 16.14
-- Versi Server: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `IDAdmin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`IDAdmin`, `username`, `password`, `level`, `nama`, `email`) VALUES
(1, 'iwan', 'superadmin', 0, 'Super Admin1', 'iwantjokrosaputro@yahoo.com '),
(15, 'adminsurabaya@lap', 'admin1', 1, 'elly', 'elly@gmail.com'),
(16, 'adminsurabaya@kantor', 'admin2', 2, 'tuty', 'tuty@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `IDAkun` int(11) NOT NULL,
  `namaAkun` varchar(50) NOT NULL,
  `sifat` char(1) NOT NULL,
  `kelompok` varchar(20) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`IDAkun`, `namaAkun`, `sifat`, `kelompok`, `created`) VALUES
(1, 'Kas Admin Lapangan', 'D', 'Asset', '2015-11-21'),
(2, 'Kas Admin Kantor', 'D', 'Asset', '2015-11-21'),
(3, 'Kas Bank', 'D', 'Asset', '2015-11-21'),
(4, 'Barang', 'D', 'Asset', '2015-11-21'),
(5, 'Biaya Gaji SPG', 'K', 'Biaya', '2015-11-21'),
(6, 'Biaya Lain-lain', 'K', 'Biaya', '2015-11-21'),
(7, 'Biaya SPG', 'K', 'Biaya', '2015-11-21'),
(8, 'Biaya Komisi SPG', 'K', 'Biaya', '2015-11-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_cabang`
--

CREATE TABLE `akun_cabang` (
  `IDAkun` int(11) NOT NULL,
  `IDCabang` int(11) NOT NULL,
  `nilai_akun` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `akun_cabang`
--

INSERT INTO `akun_cabang` (`IDAkun`, `IDCabang`, `nilai_akun`) VALUES
(1, 10, 0),
(2, 10, 76500),
(3, 10, 10000),
(4, 10, -783000),
(5, 10, 0),
(6, 10, 0),
(7, 10, 55000),
(8, 10, 308500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `IDBarang` int(11) NOT NULL,
  `namaBarang` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`IDBarang`, `namaBarang`) VALUES
(1, 'Babylon 30ml'),
(2, 'Babylon 430ml'),
(3, 'Minyak Gosok 5 ml');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayar_gaji`
--

CREATE TABLE `bayar_gaji` (
  `IDBayarGaji` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `IDPenjualan` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `IDCabang` int(11) NOT NULL,
  `IDAdmin` int(11) NOT NULL,
  `IDAdmin_kantor` int(11) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `saldo` double NOT NULL,
  `last_updated` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`IDCabang`, `IDAdmin`, `IDAdmin_kantor`, `provinsi`, `kabupaten`, `saldo`, `last_updated`) VALUES
(10, 15, 16, 'Jawa-Timur', 'surabaya', 76500, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang_barang`
--

CREATE TABLE `cabang_barang` (
  `IDCabang` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cabang_barang`
--

INSERT INTO `cabang_barang` (`IDCabang`, `IDBarang`, `jumlah`) VALUES
(10, 1, -876),
(10, 2, -2488),
(10, 3, -193);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengeluaran`
--

CREATE TABLE `detail_pengeluaran` (
  `IDPengeluaran` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `total_pengeluaran` int(11) NOT NULL,
  `keterangan_lanjut` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `detail_pengeluaran`
--

INSERT INTO `detail_pengeluaran` (`IDPengeluaran`, `keterangan`, `total_pengeluaran`, `keterangan_lanjut`) VALUES
(1, 'Bensin', 20000, ''),
(1, 'Makan', 30000, ''),
(1, 'Parkir', 5000, ''),
(2, 'Bensin', 50000, ''),
(3, 'Bensin', 50000, ''),
(4, 'Bensin', 50000, ''),
(5, 'Bensin', 50000, ''),
(6, 'Bensin', 50000, ''),
(7, 'Bensin', 50000, ''),
(7, 'Parkir', 5000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penggajian`
--

CREATE TABLE `detail_penggajian` (
  `IDPenggajian` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_gaji` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `detail_penggajian`
--

INSERT INTO `detail_penggajian` (`IDPenggajian`, `IDSales`, `tanggal`, `total_gaji`) VALUES
(1, 1, '2015-11-27', 90000),
(1, 3, '2015-11-27', 100000),
(2, 1, '2015-11-01', 38000),
(2, 2, '2015-11-27', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_satuan`
--

CREATE TABLE `harga_satuan` (
  `IDSatuan` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `harga_konversi` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `harga_satuan`
--

INSERT INTO `harga_satuan` (`IDSatuan`, `IDBarang`, `harga_konversi`) VALUES
(3, 1, 960000),
(2, 1, 96000),
(1, 1, 9000),
(3, 2, 5000000),
(2, 2, 500000),
(1, 2, 50000),
(1, 3, 10000),
(2, 3, 100000),
(3, 3, 1000000),
(1, 10, 9000),
(2, 10, 96000),
(3, 10, 960000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `historygaji`
--

CREATE TABLE `historygaji` (
  `IDHistoryGaji` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL,
  `Nominal` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `historygaji`
--

INSERT INTO `historygaji` (`IDHistoryGaji`, `IDSales`, `Nominal`, `Tanggal`, `keterangan`) VALUES
(1, 2, 90000, '2015-11-27', 'Gaji diperoleh'),
(2, 1, 90000, '2015-11-27', 'Gaji diperoleh'),
(3, 7, 90000, '2015-11-27', 'Gaji diperoleh'),
(4, 3, 90000, '2015-11-28', 'Gaji diperoleh'),
(5, 6, 90000, '2015-11-28', 'Gaji diperoleh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `historykomisi`
--

CREATE TABLE `historykomisi` (
  `IDHistoryKomisi` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL,
  `Nominal` int(11) NOT NULL,
  `Tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `historykomisi`
--

INSERT INTO `historykomisi` (`IDHistoryKomisi`, `IDSales`, `Nominal`, `Tanggal`, `keterangan`) VALUES
(1, 2, 12500, '2015-11-27 00:00:00', 'Komisi diperoleh'),
(2, 1, 8500, '2015-11-27 00:00:00', 'Komisi diperoleh'),
(3, 7, 9000, '2015-11-27 00:00:00', 'Komisi diperoleh'),
(4, 3, 7500, '2015-11-28 00:00:00', 'Komisi diperoleh'),
(5, 6, 9500, '2015-11-28 00:00:00', 'Komisi diperoleh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jual`
--

CREATE TABLE `jual` (
  `IDPenjualan` int(11) NOT NULL,
  `IDTeamLeader` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `IDLokasi` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `hargaJual` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jual`
--

INSERT INTO `jual` (`IDPenjualan`, `IDTeamLeader`, `IDSales`, `IDBarang`, `IDLokasi`, `jumlah`, `hargaJual`) VALUES
(1, 10, 2, 1, 188, 25, 201000),
(1, 10, 1, 1, 157, 17, 141000),
(1, 10, 7, 1, 64, 18, 150000),
(2, 16, 3, 1, 1046, 15, 123000),
(2, 10, 6, 1, 164, 20, 168000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `IDJurnal` int(11) NOT NULL,
  `IDCabang` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `sifat` char(1) NOT NULL,
  `nilai_jurnal` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`IDJurnal`, `IDCabang`, `tanggal`, `sifat`, `nilai_jurnal`, `keterangan`) VALUES
(1, 10, '2015-11-26 21:19:36', 'D', 492000, 'Penjualan Barang'),
(2, 10, '2015-11-26 21:20:11', 'D', 291000, 'Penjualan Barang'),
(3, 10, '2015-11-26 21:20:59', 'K', 492000, 'Setor Penjualan'),
(4, 10, '2015-11-26 21:20:59', 'D', 492000, 'Terima Setoran Penjualan'),
(5, 10, '2015-11-26 21:21:11', 'K', 291000, 'Setor Penjualan'),
(6, 10, '2015-11-26 21:21:11', 'D', 291000, 'Terima Setoran Penjualan'),
(7, 10, '2015-11-26 21:22:45', 'K', 20000, 'Biaya Bensin'),
(8, 10, '2015-11-26 21:22:45', 'K', 30000, 'Biaya Makan'),
(9, 10, '2015-11-26 21:22:46', 'K', 5000, 'Biaya Parkir'),
(10, 10, '2015-11-26 21:23:11', 'K', 90000, 'Bayar Gaji SPG'),
(11, 10, '2015-11-26 21:23:11', 'K', 100000, 'Bayar Gaji SPG'),
(12, 10, '2015-11-26 21:24:21', 'K', 38000, 'Bayar Gaji SPG'),
(13, 10, '2015-11-26 21:24:21', 'K', 50000, 'Bayar Gaji SPG'),
(14, 10, '2015-11-26 22:18:02', 'K', 50000, 'Biaya Bensin'),
(15, 10, '2015-11-26 22:18:02', 'K', 5000, 'Biaya Parkir'),
(16, 10, '2015-11-26 22:18:54', 'K', 308500, 'Bayar Komisi SPG'),
(17, 10, '2015-11-26 23:05:27', 'K', 6500, 'Setor Kas Bank'),
(18, 10, '2015-11-26 23:05:27', 'D', 6500, 'Terima Setoran Bank'),
(19, 10, '2015-11-26 23:05:29', 'K', 6500, 'Setor Kas Bank'),
(20, 10, '2015-11-26 23:05:29', 'D', 6500, 'Terima Setoran Bank'),
(21, 10, '2015-11-26 23:05:30', 'K', 6500, 'Setor Kas Bank'),
(22, 10, '2015-11-26 23:05:30', 'D', 6500, 'Terima Setoran Bank'),
(23, 10, '2015-11-26 23:05:30', 'K', 6500, 'Setor Kas Bank'),
(24, 10, '2015-11-26 23:05:30', 'D', 6500, 'Terima Setoran Bank'),
(25, 10, '2015-11-26 23:11:05', 'K', 500, 'Setor Kas Bank'),
(26, 10, '2015-11-26 23:11:05', 'D', 500, 'Terima Setoran Bank'),
(27, 10, '2015-11-28 20:00:48', 'K', 10000, 'Setor Kas Bank'),
(28, 10, '2015-11-28 20:00:48', 'D', 10000, 'Terima Setoran Bank'),
(29, 10, '2015-11-28 20:07:13', 'K', 10000, 'Setor Kas Bank'),
(30, 10, '2015-11-28 20:07:13', 'D', 10000, 'Terima Setoran Bank'),
(31, 10, '2015-11-28 20:31:56', 'K', 10000, 'Setor Kas Bank'),
(32, 10, '2015-11-28 20:31:56', 'D', 10000, 'Terima Setoran Bank'),
(33, 10, '2015-11-28 21:36:05', 'K', 6500, 'Tarik Kas Bank'),
(34, 10, '2015-11-28 21:36:05', 'D', 6500, 'Terima Penarikan Kas Bank'),
(35, 10, '2015-11-28 21:38:54', 'K', 10000, 'Tarik Kas Bank'),
(36, 10, '2015-11-28 21:38:54', 'D', 10000, 'Terima Penarikan Kas Bank'),
(37, 10, '2015-11-28 21:42:15', 'K', 10000, 'Tarik Kas Bank'),
(38, 10, '2015-11-28 21:42:15', 'D', 10000, 'Terima Penarikan Kas Bank'),
(39, 10, '2015-11-28 21:49:43', 'K', 10000, 'Tarik Kas Bank'),
(40, 10, '2015-11-28 21:49:43', 'D', 10000, 'Terima Penarikan Kas Bank'),
(41, 10, '2015-11-28 21:52:40', 'K', 5000, 'Tarik Kas Bank'),
(42, 10, '2015-11-28 21:52:40', 'D', 5000, 'Terima Penarikan Kas Bank'),
(43, 10, '2015-11-28 21:57:08', 'K', 5000, 'Tarik Kas Bank'),
(44, 10, '2015-11-28 21:57:08', 'D', 5000, 'Terima Penarikan Kas Bank');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_akun`
--

CREATE TABLE `jurnal_akun` (
  `IDJurnal` int(11) NOT NULL,
  `IDAkun` int(11) NOT NULL,
  `sifat` char(1) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jurnal_akun`
--

INSERT INTO `jurnal_akun` (`IDJurnal`, `IDAkun`, `sifat`, `nilai`) VALUES
(1, 1, 'D', 492000),
(1, 4, 'K', 492000),
(2, 1, 'D', 291000),
(2, 4, 'K', 291000),
(3, 1, 'K', 492000),
(3, 2, 'D', 492000),
(4, 1, 'K', 492000),
(4, 2, 'D', 492000),
(5, 1, 'K', 291000),
(5, 2, 'D', 291000),
(6, 1, 'K', 291000),
(6, 2, 'D', 291000),
(7, 7, 'D', 20000),
(7, 2, 'K', 20000),
(8, 2, 'K', 30000),
(8, 7, 'D', 30000),
(9, 2, 'K', 5000),
(9, 7, 'D', 5000),
(10, 2, 'K', 90000),
(10, 5, 'D', 90000),
(11, 2, 'K', 100000),
(11, 5, 'D', 100000),
(12, 2, 'K', 38000),
(12, 5, 'D', 38000),
(13, 2, 'K', 50000),
(13, 5, 'D', 50000),
(14, 7, 'D', 50000),
(14, 2, 'K', 50000),
(15, 2, 'K', 5000),
(15, 7, 'D', 5000),
(16, 2, 'K', 308500),
(16, 8, 'D', 308500),
(17, 2, 'K', 6500),
(17, 3, 'D', 6500),
(19, 2, 'K', 6500),
(19, 3, 'D', 6500),
(21, 2, 'K', 6500),
(21, 3, 'D', 6500),
(23, 2, 'K', 6500),
(23, 3, 'D', 6500),
(25, 2, 'K', 500),
(25, 3, 'D', 500),
(26, 2, 'K', 500),
(26, 3, 'D', 500),
(27, 2, 'K', 10000),
(27, 3, 'D', 10000),
(28, 2, 'K', 10000),
(28, 3, 'D', 10000),
(29, 2, 'K', 10000),
(29, 3, 'D', 10000),
(30, 2, 'K', 10000),
(30, 3, 'D', 10000),
(31, 2, 'K', 10000),
(31, 3, 'D', 10000),
(32, 2, 'K', 10000),
(32, 3, 'D', 10000),
(33, 2, 'D', 6500),
(33, 3, 'K', 6500),
(34, 2, 'D', 6500),
(34, 3, 'K', 6500),
(35, 2, 'D', 10000),
(35, 3, 'K', 10000),
(36, 2, 'D', 10000),
(36, 3, 'K', 10000),
(37, 2, 'D', 10000),
(37, 3, 'K', 10000),
(38, 2, 'D', 10000),
(38, 3, 'K', 10000),
(39, 2, 'D', 10000),
(39, 3, 'K', 10000),
(40, 2, 'D', 10000),
(40, 3, 'K', 10000),
(41, 2, 'D', 5000),
(41, 3, 'K', 5000),
(42, 2, 'D', 5000),
(42, 3, 'K', 5000),
(43, 2, 'D', 5000),
(43, 3, 'K', 5000),
(44, 2, 'D', 5000),
(44, 3, 'K', 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran`
--

CREATE TABLE `kehadiran` (
  `IDKehadiran` int(11) NOT NULL,
  `IDSales` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kehadiran`
--

INSERT INTO `kehadiran` (`IDKehadiran`, `IDSales`, `tanggal`, `status`) VALUES
(1, 1, '2015-11-25 00:00:00', 'A'),
(2, 2, '2015-11-25 00:00:00', 'H'),
(3, 3, '2015-11-25 00:00:00', 'H'),
(4, 4, '2015-11-25 00:00:00', 'A'),
(5, 5, '2015-11-25 00:00:00', 'A'),
(6, 6, '2015-11-25 00:00:00', 'A'),
(7, 7, '2015-11-25 00:00:00', 'A'),
(8, 8, '2015-11-25 00:00:00', 'A'),
(9, 13, '2015-11-25 00:00:00', 'A'),
(10, 12, '2015-11-25 00:00:00', 'A'),
(11, 14, '2015-11-25 00:00:00', 'A'),
(12, 15, '2015-11-25 00:00:00', 'A'),
(13, 18, '2015-11-25 00:00:00', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komisi`
--

CREATE TABLE `komisi` (
  `IDSales` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `komisi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `komisi`
--

INSERT INTO `komisi` (`IDSales`, `IDBarang`, `komisi`) VALUES
(1, 1, 500),
(1, 2, 5000),
(2, 1, 500),
(2, 2, 5000),
(3, 1, 500),
(3, 2, 5000),
(4, 1, 500),
(4, 2, 5000),
(5, 1, 500),
(5, 2, 5000),
(6, 1, 500),
(6, 2, 5000),
(7, 1, 500),
(7, 2, 5000),
(8, 1, 500),
(8, 2, 5000),
(9, 1, 500),
(9, 2, 0),
(10, 1, 500),
(10, 2, 0),
(11, 1, 500),
(11, 2, 0),
(1, 3, 500),
(11, 3, 500),
(12, 1, 500),
(12, 2, 5000),
(12, 3, 500),
(13, 1, 500),
(13, 2, 5000),
(13, 3, 500),
(14, 1, 500),
(14, 2, 5000),
(14, 3, 500),
(15, 1, 500),
(15, 2, 5000),
(15, 3, 500),
(16, 1, 0),
(16, 2, 0),
(16, 3, 0),
(17, 1, 0),
(17, 2, 0),
(17, 3, 0),
(18, 1, 500),
(18, 2, 5000),
(18, 3, 500),
(2, 3, 500),
(3, 3, 500),
(4, 3, 500),
(5, 3, 500),
(6, 3, 500),
(7, 3, 500),
(8, 3, 500),
(9, 3, 500),
(10, 3, 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_pengeluaran`
--

CREATE TABLE `laporan_pengeluaran` (
  `IDPengeluaran` int(11) NOT NULL,
  `IDCabang` int(11) NOT NULL,
  `totalPengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `laporan_pengeluaran`
--

INSERT INTO `laporan_pengeluaran` (`IDPengeluaran`, `IDCabang`, `totalPengeluaran`, `tanggal`) VALUES
(1, 10, 55000, '2015-11-26'),
(2, 10, 50000, '2015-11-26'),
(3, 10, 50000, '2015-11-26'),
(4, 10, 50000, '2015-11-26'),
(5, 10, 50000, '2015-11-26'),
(6, 10, 50000, '2015-11-26'),
(7, 10, 55000, '2015-11-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_penggajian`
--

CREATE TABLE `laporan_penggajian` (
  `IDPenggajian` int(11) NOT NULL,
  `IDCabang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `totalPenggajian` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `laporan_penggajian`
--

INSERT INTO `laporan_penggajian` (`IDPenggajian`, `IDCabang`, `tanggal`, `totalPenggajian`, `keterangan`) VALUES
(1, 10, '2015-11-26', 190000, 'gaji'),
(2, 10, '2015-11-26', 88000, 'gaji'),
(3, 10, '2015-11-26', 0, 'komisi'),
(4, 10, '2015-11-26', 0, 'komisi'),
(5, 10, '2015-11-26', 0, 'komisi'),
(6, 10, '2015-11-26', 0, 'komisi'),
(7, 10, '2015-11-26', 0, 'komisi'),
(8, 10, '2015-11-26', 0, 'komisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_penjualan`
--

CREATE TABLE `laporan_penjualan` (
  `IDPenjualan` int(11) NOT NULL,
  `IDCabang` int(11) NOT NULL,
  `totalPenjualan` int(11) NOT NULL,
  `totalKomisi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `status_kas` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `laporan_penjualan`
--

INSERT INTO `laporan_penjualan` (`IDPenjualan`, `IDCabang`, `totalPenjualan`, `totalKomisi`, `tanggal`, `keterangan`, `status_kas`) VALUES
(1, 10, 492000, 30000, '2015-11-27', '', 1),
(2, 10, 291000, 17000, '2015-11-28', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `IDLokasi` int(11) NOT NULL,
  `Kabupaten` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `IDCabang` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`IDLokasi`, `Kabupaten`, `kecamatan`, `desa`, `wilayah`, `IDCabang`) VALUES
(1, '', '', 'Pasar Benowo', '', 10),
(2, '', '', 'Kandangan', '', 10),
(3, '', '', 'Sememi', '', 10),
(4, '', 'new kecamatan', 'Banjar Sugihan', '', 10),
(5, '', '', 'Manukan', '', 10),
(6, '', '', 'Gunung Anyar', '', 10),
(7, '', '', 'Kedungdoro', '', 10),
(8, '', '', 'Gubeng', '', 10),
(9, '', '', 'Pandugo', '', 10),
(10, '', '', 'Kendal Sari', '', 10),
(11, '', '', 'Kalidami', '', 10),
(12, '', '', 'Jojoran', '', 10),
(13, '', '', 'Menur', '', 10),
(14, '', '', 'Putat', '', 10),
(15, '', '', 'Prada Kali""Kendal', '', 10),
(16, '', '', 'Kawal', '', 10),
(17, '', '', 'Kebraon', '', 10),
(18, '', '', 'Gunung Sari', '', 10),
(19, '', '', 'Wiyung', '', 10),
(20, '', '', 'Menganti', '', 10),
(21, '', '', 'Dukuh Bulak Banteng', '', 10),
(22, '', '', 'Wonokusumo', '', 10),
(23, '', '', 'Tenggumung Mulya', '', 10),
(24, '', '', 'Baru', '', 10),
(25, '', '', 'Lakarsantri', '', 10),
(26, '', '', 'Pasar Menganti', '', 10),
(27, '', '', 'Sambi Kerep', '', 10),
(28, '', '', 'Krukah', '', 10),
(29, '', '', 'Bratang Binangun', '', 10),
(30, '', '', 'Pesapean', '', 10),
(31, '', '', 'Perak Timur', '', 10),
(32, '', '', 'Kebalen', '', 10),
(33, '', '', 'Manyar Sambongan', '', 10),
(34, '', '', 'Mleto', '', 10),
(35, '', '', 'Gebang Lor', '', 10),
(36, '', '', 'Gebang Putih', '', 10),
(37, '', '', 'Girilaya', '', 10),
(38, '', '', 'Simo', '', 10),
(39, '', '', 'Kupang Krajan', '', 10),
(40, '', '', 'Pasar Kembang', '', 10),
(41, '', '', 'Kalimas Baru', '', 10),
(42, '', '', 'Petemon', '', 10),
(43, '', '', 'Tidar', '', 10),
(44, '', '', 'Keputih', '', 10),
(45, '', '', 'Menur Pumpungan', '', 10),
(46, '', '', 'Pacar Keling', '', 10),
(47, '', '', 'Bronggalan', '', 10),
(48, '', '', 'Karang Menjangan', '', 10),
(49, '', '', 'Jl.Mojo(Dharmahusada)', '', 10),
(50, '', '', 'Wonocolo', '', 10),
(51, '', '', 'Margerejo', '', 10),
(52, '', '', 'Pulo Wonokromo', '', 10),
(53, '', '', 'Bendul Merisi', '', 10),
(54, '', '', 'Kendang Sari', '', 10),
(55, '', '', 'Bulak Rukem Timur', '', 10),
(56, '', '', 'Bulak Cupat', '', 10),
(57, '', '', 'Kapas Madya', '', 10),
(58, '', '', 'Kapas Lor Kulon', '', 10),
(59, '', '', 'Pengampon', '', 10),
(60, '', '', 'Kapasan', '', 10),
(61, '', '', 'Sidodadi', '', 10),
(62, '', '', 'Margorukun', '', 10),
(63, '', '', 'Sumber Mulya', '', 10),
(64, '', '', 'Asem Rowo', '', 10),
(65, '', '', 'Dupak Rukun', '', 10),
(66, '', '', 'Medokan Ayu', '', 10),
(67, '', '', 'Gunung Anyar', '', 10),
(68, '', '', 'Pondok Candra', '', 10),
(69, '', '', 'Rungkut', '', 10),
(70, '', '', 'Kutisari', '', 10),
(71, '', '', 'Tembok Gede', '', 10),
(72, '', '', 'Pasar Tembok', '', 10),
(73, '', '', 'Kranggan', '', 10),
(74, '', '', 'Banyu Urip', '', 10),
(75, '', '', 'Kupang Gunung', '', 10),
(76, '', '', 'Tembok Sayuran', '', 10),
(77, '', '', 'Teluk Nibung', '', 10),
(78, '', '', 'Teluk Betung', '', 10),
(79, '', '', 'Kalimas Barat', '', 10),
(80, '', '', 'Putat Gede', '', 10),
(81, '', '', 'Babakan', '', 10),
(82, '', '', 'Kapas Krampung', '', 10),
(83, '', '', 'Balong Sari', '', 10),
(84, '', '', 'Tambak Sari', '', 10),
(85, '', '', 'Bulak Cupat', '', 10),
(86, '', '', 'Kalilom lor indah', '', 10),
(87, '', '', 'Nambangan', '', 10),
(88, '', '', 'Rungkut Kali', '', 10),
(89, '', '', 'Kutisari', '', 10),
(90, '', '', 'Kendang Sari', '', 10),
(91, '', '', 'Nginden', '', 10),
(92, '', '', 'Semampir Tengah', '', 10),
(93, '', '', 'Gembong', '', 10),
(94, '', '', 'Pecindilan', '', 10),
(95, '', '', 'Semampir Utara', '', 10),
(96, '', '', 'Semampir Selatan', '', 10),
(97, '', '', 'Dukuh Kupang', '', 10),
(99, '', '', 'Pakis', '', 10),
(100, '', '', 'Kembang Kuning', '', 10),
(101, '', '', 'Kebangsren', '', 10),
(102, '', '', 'Dinoyo', '', 10),
(103, '', '', 'Joyoboyo', '', 10),
(104, '', '', 'Pogot', '', 10),
(105, '', '', 'Rangkah', '', 10),
(106, '', '', 'Karang Tembok', '', 10),
(107, '', '', 'Jati Purwo', '', 10),
(108, '', '', 'Pandegiling', '', 10),
(109, '', '', 'Kedondong', '', 10),
(110, '', '', 'Kedungturi', '', 10),
(111, '', '', 'Kranggan', '', 10),
(112, '', '', 'Kampung Malang', '', 10),
(113, '', '', 'Wonorejo', '', 10),
(114, '', '', 'Kedung Baruk', '', 10),
(115, '', '', 'Kedung Tarukan', '', 10),
(116, '', '', 'Kedung Asem', '', 10),
(117, '', '', 'Mojoklangru""Lor', '', 10),
(118, '', '', 'Setro Baru', '', 10),
(119, '', '', 'Nginden Jaya', '', 10),
(120, '', '', 'Nginden Kota', '', 10),
(121, '', '', 'Gubeng Masjid', '', 10),
(122, '', '', 'Kebraon', '', 10),
(123, '', '', 'Kedurus', '', 10),
(124, '', '', 'Mastrip', '', 10),
(125, '', '', 'Karang Pilang', '', 10),
(126, '', '', 'Sidotopo""Wetan', '', 10),
(127, '', '', 'Randu', '', 10),
(128, '', '', 'Kedung Mangu', '', 10),
(129, '', '', 'Mulyorejo', '', 10),
(130, '', '', 'Mojoklangru', '', 10),
(131, '', '', 'Kalianak', '', 10),
(132, '', '', 'Tambak Asri', '', 10),
(133, '', '', 'Simo Pomahan""Baru', '', 10),
(134, '', '', 'Simo Rejosari', '', 10),
(135, '', '', 'Ngagel', '', 10),
(136, '', '', 'Bibis Tama', '', 10),
(137, '', '', 'Margerejo', '', 10),
(138, '', '', 'Kapasari Pedukuan', '', 10),
(139, '', '', 'Tambak Adi', '', 10),
(140, '', '', 'Kapas Krampung', '', 10),
(141, '', '', 'Sidotopo Lor', '', 10),
(142, '', '', 'Demak', '', 10),
(143, '', '', 'Jetis Wetan', '', 10),
(144, '', '', 'Tambak Mayor', '', 10),
(145, '', '', 'Simorejosari""', '', 10),
(146, '', '', 'Tanjung Sari', '', 10),
(147, '', '', 'Kerto Menanggal', '', 10),
(148, '', '', 'Pulosari', '', 10),
(149, '', '', 'Karangan', '', 10),
(150, '', '', 'Pulo wonokromo', '', 10),
(151, '', '', 'Karang Rejo', '', 10),
(152, '', '', 'Dupak Timur', '', 10),
(153, '', '', 'Pakis Tirtosari', '', 10),
(154, '', '', 'Dupak Rukun', '', 10),
(155, '', '', 'Dupak Jaya', '', 10),
(156, '', '', 'Asem Jaya', '', 10),
(157, '', '', 'Asem Bagus', '', 10),
(158, '', '', 'Asem Mulya', '', 10),
(159, '', '', 'Simo Kalangan', '', 10),
(160, '', '', 'Gubeng Glingsingan', '', 10),
(161, '', '', 'Sidorame', '', 10),
(162, '', '', 'Perak Timur', '', 10),
(163, '', '', 'Petukangan', '', 10),
(164, '', '', 'Ampel', '', 10),
(165, '', '', 'Pandegiling', '', 10),
(166, '', '', 'Kupang Segunting', '', 10),
(167, '', '', 'Tambak Mayor', '', 10),
(168, '', '', 'Kali Judan', '', 10),
(169, '', '', 'Rungkut Kidul', '', 10),
(170, '', '', 'Pasar Pahing', '', 10),
(171, '', '', 'Rungkut Menanggal', '', 10),
(172, '', '', 'Wadung Asri', '', 10),
(173, '', '', 'Pakis Argosari', '', 10),
(174, '', '', 'Tenggumung', '', 10),
(175, '', '', 'Bulak Banteng', '', 10),
(176, '', '', 'Jagiran', '', 10),
(177, '', '', 'Donokerto', '', 10),
(178, '', '', 'Kapasari', '', 10),
(179, '', '', 'Kapas Madya', '', 10),
(180, '', '', 'Kenjeran', '', 10),
(181, '', '', 'Rembang', '', 10),
(182, '', '', 'Jogoloyo', '', 10),
(183, '', '', 'Bratang Gede', '', 10),
(184, '', '', 'JL.Jakarta', '', 10),
(185, '', '', 'Johar Baru', '', 10),
(186, '', '', 'Klampis', '', 10),
(187, '', '', 'Gubeng Masjid', '', 10),
(188, '', '', 'Ambengan', '', 10),
(189, '', '', 'Ngaglik', '', 10),
(190, '', '', 'Sidotopo Sekolahan', '', 10),
(191, '', '', 'Greges', '', 10),
(192, '', '', 'Tembaan', '', 10),
(193, '', '', 'Maspati', '', 10),
(194, '', '', 'Plampungan', '', 10),
(195, '', '', 'Jl.Semarang', '', 10),
(196, '', '', 'Jl.Sampoerna', '', 10),
(197, '', '', 'Kedung Cowek', '', 10),
(198, '', '', 'Merr', '', 10),
(199, '', '', 'Lebak', '', 10),
(200, '', '', 'Gadukan', '', 10),
(201, '', '', 'Pasar Soponyono', '', 10),
(202, '', '', 'Sutorejo', '', 10),
(203, '', '', 'Rajawali', '', 10),
(204, '', '', 'Lasem', '', 10),
(205, '', '', 'Krembangan Bhakti', '', 10),
(206, '', '', 'Krembangan Mulya', '', 10),
(207, '', '', 'Surabayan', '', 10),
(208, '', '', 'Tegalsari', '', 10),
(209, '', '', 'Kali Kepiting', '', 10),
(210, '', '', 'Manyar', '', 10),
(211, '', '', 'Wonocolo', '', 10),
(212, '', '', 'Pajuan Kuda', '', 10),
(213, '', '', 'Blauran', '', 10),
(214, '', '', 'Pandegiling', '', 10),
(215, '', '', 'Kedinding', '', 10),
(216, '', '', 'Tanah Merah', '', 10),
(217, '', '', 'Ambengan', '', 10),
(218, '', '', 'Babatan', '', 10),
(219, '', '', 'Bogangin', '', 10),
(220, '', '', 'Lidah', '', 10),
(221, '', '', 'Kanginan', '', 10),
(222, '', '', 'Indrapura', '', 10),
(223, '', '', 'Donowati', '', 10),
(224, '', '', 'Gadel', '', 10),
(225, '', '', 'Sikatan', '', 10),
(226, '', '', 'Bratang', '', 10),
(227, '', '', 'Pasar Gresikaan', '', 10),
(228, '', '', 'Ploso', '', 10),
(229, '', '', 'Bogen', '', 10),
(230, '', '', 'Tambak Segaran', '', 10),
(231, '', '', 'Suropati', '', 10),
(232, '', '', 'Ngesong', '', 10),
(233, '', '', 'Pasar Turi', '', 10),
(234, '', '', 'Pagesangan', '', 10),
(235, '', '', 'Karah', '', 10),
(236, '', '', 'Jambangan', '', 10),
(237, '', '', 'Pasar jarak', '', 10),
(238, '', '', 'Kebonsari', '', 10),
(239, '', '', 'Bogosari', '', 10),
(240, '', '', 'Bambe', '', 10),
(241, '', '', 'Sedati', '', 10),
(242, '', '', 'Gedangan', '', 10),
(243, '', '', 'Taman', '', 10),
(244, '', '', 'Sukodono', '', 10),
(245, '', '', 'Jedong', '', 10),
(246, '', '', 'Wage', '', 10),
(247, '', '', 'Brigjend Katamso', '', 10),
(248, '', '', 'Wedoro', '', 10),
(249, '', '', 'Deltasari', '', 10),
(250, '', '', 'Sepanjang', '', 10),
(978, '', '', 'Putat Jaya', '', 10),
(979, '', '', 'mojokerto', '', 10),
(982, 'tabeta', 'no', 'kimi', 'nani', 10),
(983, 'batata', 'batata', 'batata', 'batata', 10),
(984, 'sidoarjo', '', 'waru', '', 10),
(985, '', '', 'tropodo', '', 10),
(986, '', '', 'Rungkut Kidul', '', 10),
(987, '', '', 'Granting', '', 10),
(988, '', '', 'Ngelom', '', 10),
(989, '', '', 'Tambak Wedi', '', 10),
(990, '', '', 'Srikana', '', 10),
(991, '', '', 'Pulo Tegal', '', 10),
(992, '', '', 'Semolowaru', '', 10),
(993, '', '', 'Pasar Loak', '', 10),
(994, '', '', 'Bulak setro', '', 10),
(995, '', '', 'Kedung Cowek', '', 10),
(996, '', '', 'Tambak Wedi', '', 10),
(997, '', '', 'Simo Jawar', '', 10),
(998, '', '', 'Suko Manunggal', '', 10),
(999, '', '', 'Betro', '', 10),
(1000, '', '', 'Tenggumung', '', 10),
(1001, '', '', 'Jemur Sari', '', 10),
(1002, '', '', 'Jemur', '', 10),
(1003, '', '', 'Kali Rungkut', '', 10),
(1004, '', '', 'Tenggilis', '', 10),
(1005, '', '', 'Pondok Jati', '', 10),
(1006, '', '', 'Pasar Sepanjang', '', 10),
(1007, '', '', 'Bungurasih', '', 10),
(1008, '', '', 'Taman', '', 10),
(1009, '', '', 'HR. Muhammad', '', 10),
(1010, '', '', 'Sidowayah', 'Sidoarjo', 10),
(1011, '', '', 'Kremil', '', 10),
(1012, '', '', 'Perak', '', 10),
(1013, '', '', 'Lemah Putro', 'Sidoarjo', 10),
(1014, '', '', 'Taman Pinang', 'Sidoarjo', 10),
(1015, '', '', 'larangan', 'Sidoarjo', 10),
(1016, '', '', 'JL.Pahlawan', 'Sidoarjo', 10),
(1017, '', '', 'Baliwerti', '', 10),
(1018, '', '', 'Bubutan', '', 10),
(1019, '', '', 'Wonosasri', '', 10),
(1020, '', '', 'Sidotopo', '', 10),
(1021, '', '', 'Manukan Lor', '', 10),
(1022, '', '', 'Lempung Tama', '', 10),
(1023, '', '', 'Lempung Indah', '', 10),
(1024, '', '', 'Tambak Gringsingan', '', 10),
(1025, '', '', 'Kupang Jaya', '', 10),
(1026, '', '', 'Pulo Tegal', '', 10),
(1027, '', '', 'Karang Rejo', '', 10),
(1028, '', '', 'Manukan Mukti', '', 10),
(1029, '', '', 'Genteng', '', 10),
(1030, '', '', 'Jagir', '', 10),
(1031, '', '', 'Dukuh Menanggal', '', 10),
(1032, '', '', 'Mulyosari', '', 10),
(1033, '', '', 'Kupang', '', 10),
(1034, '', '', 'Darmo kali', '', 10),
(1035, '', '', 'Kali Bokor', '', 10),
(1036, '', '', 'Bagong', '', 10),
(1037, '', '', 'Wonokromo', '', 10),
(1038, '', '', 'Pulosari', '', 10),
(1039, '', '', 'Jarak', '', 10),
(1040, '', '', 'Krembangan', '', 10),
(1041, '', '', 'Mundu', '', 10),
(1042, '', '', 'Simokerto', '', 10),
(1043, '', '', 'Donorejo', '', 10),
(1044, 'Sidoarjo', '', 'Sidoarjo', '', 10),
(1045, 'Sidoarjo', '', 'GOR Sidoarjo', '', 10),
(1046, 'Sidoarjo', '', 'Alun2 Sidoarjo', '', 10),
(1047, 'Sidoarjo', '', 'Tanggulangin', '', 10),
(1048, 'Sidoarjo', '', 'Pasar Porong', '', 10),
(1049, '', '', 'Pasar Krempyeng', '', 10),
(1050, '', '', 'Sidorukun', '', 10),
(1051, '', '', 'Kebomas', '', 10),
(1052, '', '', 'DR.Soetomo', '', 10),
(1053, '', '', 'Veteran', '', 10),
(1054, '', '', 'Kapas Baru', '', 10),
(1055, '', '', 'Mayjen', '', 10),
(1056, '', '', 'Tempel', '', 10),
(1057, '', '', 'Benowo', '', 10),
(1058, '', '', 'Kertajaya', '', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `IDSales` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `noTelp` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `gaji` double NOT NULL,
  `tempatLahir` varchar(50) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `totalGaji` int(11) NOT NULL,
  `totalKomisi` int(11) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `IDCabang` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`IDSales`, `nama`, `noTelp`, `foto`, `gaji`, `tempatLahir`, `tanggalLahir`, `totalGaji`, `totalKomisi`, `pangkat`, `IDCabang`) VALUES
(1, 'Eva', '000000000', '732LjvJnCcmQsales.jpg', 90000, '-', '1990-01-01', 962000, 608500, 'SPG', 10),
(2, 'Lia', '000000000', 'awF97HTNYjkAsales.jpg', 90000, '-', '1990-01-01', 1040000, 8012500, 'SPG', 10),
(3, 'Meme', '00000000000', 'kSL3wYouMsFAsales.jpg', 90000, '-', '1990-01-01', 1700000, 79500, 'SPG', 10),
(4, 'Putri', '00000000000', 'rQGlN7a4nTdosales.jpg', 90000, '-', '1990-01-01', 1260000, 358000, 'SPG', 10),
(5, 'Selvia', '00000000000', 'P8a4W9z7LB26sales.jpg', 90000, '-', '1990-01-01', 1350000, 58000, 'SPG', 10),
(6, 'Selvie', '00000000000', 'pfy8pCMnKUIjsales.jpg', 90000, '-', '1990-01-01', 1530000, 577500, 'SPG', 10),
(7, 'Sofie', '00000000000', 'qzYZMnWsf6MVsales.jpg', 90000, '-', '1990-01-01', 2430000, 738500, 'SPG', 10),
(8, 'Vivi', '00000000000', 'xo0vytcOHkSqsales.jpg', 90000, '-', '1990-01-01', 1260000, 856000, 'SPG', 10),
(13, 'Melani', '00', 'qISpVNfcXU7rsales.jpg', 90000, '', '1990-01-01', 990000, 1007500, 'SPG', 10),
(10, 'Dimas', '00000000000', 'gEPIx2K6mekLsales.jpg', 0, '-', '1990-01-01', 0, 0, 'Team Leader', 10),
(12, 'Denny', '00', 'xnqcFnuULDUmsales.jpg', 90000, '', '1990-01-01', 630000, 297500, 'SPG', 10),
(14, 'Ariany', '00', '75dztGwQUQKasales.jpg', 90000, '', '1990-01-01', 540000, 210500, 'SPG', 10),
(15, 'Rangga', '00', 'oivB1FHVLStXsales.jpg', 90000, '', '1990-01-01', 540000, 701000, 'SPG', 10),
(16, 'Hadi', '00', 'nypcoYjOqjxxsales.jpg', 90000, '', '1990-01-01', 0, 0, 'Team Leader', 10),
(17, 'Novan', '', 'cWAulgmhRc3Xsales.jpg', 90000, '', '1990-01-01', 0, 0, 'Team Leader', 10),
(18, 'Indah', '', 'VKRaiYwStSI5sales.jpg', 90000, '', '1990-01-01', 990000, 310500, 'SPG', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `IDSatuan` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`IDSatuan`, `nama`) VALUES
(1, 'Pcs'),
(2, 'Lusin'),
(3, 'Karton');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_unit`
--

CREATE TABLE `satuan_unit` (
  `IDBarang` int(11) NOT NULL,
  `IDSatuan1` int(11) NOT NULL,
  `IDSatuan2` int(11) NOT NULL,
  `total_konversi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `satuan_unit`
--

INSERT INTO `satuan_unit` (`IDBarang`, `IDSatuan1`, `IDSatuan2`, `total_konversi`) VALUES
(1, 2, 1, 12),
(2, 2, 1, 12),
(3, 2, 1, 12),
(1, 3, 2, 30),
(2, 3, 2, 30),
(3, 3, 2, 30),
(6, 1, 2, 12),
(7, 1, 2, 12),
(8, 1, 2, 12),
(9, 1, 2, 12),
(10, 1, 2, 12),
(10, 3, 2, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setoran_bank`
--

CREATE TABLE `setoran_bank` (
  `IDSetoran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` text NOT NULL,
  `IDCabang` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `setoran_bank`
--

INSERT INTO `setoran_bank` (`IDSetoran`, `tanggal`, `jumlah`, `keterangan`, `IDCabang`) VALUES
(1, '0000-00-00', 6500, 'adsasd', 10),
(2, '0000-00-00', 6500, 'adsasd', 10),
(3, '0000-00-00', 6500, 'adsasd', 10),
(4, '0000-00-00', 6500, 'adsasd', 10),
(5, '0000-00-00', 6500, 'adsasd', 10),
(6, '0000-00-00', 500, '', 10),
(7, '0000-00-00', 10000, '', 10),
(8, '0000-00-00', 10000, '', 10),
(9, '2015-11-28', 10000, '', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarik_kas_bank`
--

CREATE TABLE `tarik_kas_bank` (
  `IDTarikKas` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `IDCabang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tarik_kas_bank`
--

INSERT INTO `tarik_kas_bank` (`IDTarikKas`, `tanggal`, `jumlah`, `keterangan`, `IDCabang`) VALUES
(1, '2015-11-21', 6500, '', 10),
(2, '2015-11-29', 10000, '', 10),
(3, '2015-11-28', 10000, '', 10),
(4, '2015-11-29', 10000, '', 10),
(5, '2015-11-29', 5000, 'asd', 10),
(6, '2015-11-28', 5000, 'asd', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `IDTransaksi` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `sifat` char(1) NOT NULL,
  `level` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`IDTransaksi`, `keterangan`, `sifat`, `level`, `created`) VALUES
(1, 'Penjualan Barang', 'D', 1, '2015-11-21'),
(2, 'Biaya Bensin', 'K', 2, '2015-11-21'),
(3, 'Biaya Makan', 'K', 2, '2015-11-21'),
(4, 'Biaya Tol', 'K', 2, '2015-11-21'),
(5, 'Biaya Parkir', 'K', 2, '2015-11-21'),
(6, 'Biaya Lain-Lain', 'K', 2, '2015-11-21'),
(7, 'Bayar Gaji SPG', 'K', 2, '2015-11-21'),
(8, 'Bayar Komisi SPG', 'K', 2, '2015-11-21'),
(9, 'Setor Penjualan', 'K', 1, '2015-11-21'),
(10, 'Setor Kas Bank', 'K', 2, '2015-11-21'),
(13, 'Tarik Kas Bank', 'K', 0, '2015-11-28'),
(11, 'Terima Setoran Penjualan', 'D', 2, '2015-11-22'),
(12, 'Terima Setoran Bank', 'D', 0, '2015-11-22'),
(14, 'Terima Penarikan Kas Bank', 'D', 2, '2015-11-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_akun`
--

CREATE TABLE `transaksi_akun` (
  `IDTransaksi` int(11) NOT NULL,
  `IDAkun` int(11) NOT NULL,
  `sifat` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi_akun`
--

INSERT INTO `transaksi_akun` (`IDTransaksi`, `IDAkun`, `sifat`) VALUES
(1, 1, 'D'),
(1, 4, 'K'),
(2, 7, 'D'),
(2, 2, 'K'),
(3, 2, 'K'),
(3, 7, 'D'),
(4, 2, 'K'),
(4, 7, 'D'),
(5, 2, 'K'),
(5, 7, 'D'),
(6, 2, 'K'),
(6, 6, 'D'),
(7, 2, 'K'),
(7, 5, 'D'),
(8, 2, 'K'),
(8, 8, 'D'),
(9, 1, 'K'),
(9, 2, 'D'),
(10, 2, 'K'),
(10, 3, 'D'),
(11, 1, 'K'),
(11, 2, 'D'),
(12, 2, 'K'),
(12, 3, 'D'),
(13, 2, 'D'),
(13, 3, 'K'),
(14, 2, 'D'),
(14, 3, 'K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDAdmin`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`IDAkun`);

--
-- Indexes for table `akun_cabang`
--
ALTER TABLE `akun_cabang`
  ADD PRIMARY KEY (`IDAkun`,`IDCabang`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`IDBarang`);

--
-- Indexes for table `bayar_gaji`
--
ALTER TABLE `bayar_gaji`
  ADD PRIMARY KEY (`IDBayarGaji`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`IDCabang`);

--
-- Indexes for table `cabang_barang`
--
ALTER TABLE `cabang_barang`
  ADD PRIMARY KEY (`IDCabang`,`IDBarang`);

--
-- Indexes for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD PRIMARY KEY (`IDPengeluaran`,`keterangan`);

--
-- Indexes for table `detail_penggajian`
--
ALTER TABLE `detail_penggajian`
  ADD PRIMARY KEY (`IDPenggajian`,`IDSales`);

--
-- Indexes for table `harga_satuan`
--
ALTER TABLE `harga_satuan`
  ADD PRIMARY KEY (`IDSatuan`,`IDBarang`);

--
-- Indexes for table `historygaji`
--
ALTER TABLE `historygaji`
  ADD PRIMARY KEY (`IDHistoryGaji`);

--
-- Indexes for table `historykomisi`
--
ALTER TABLE `historykomisi`
  ADD PRIMARY KEY (`IDHistoryKomisi`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`IDPenjualan`,`IDTeamLeader`,`IDSales`,`IDBarang`,`IDLokasi`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`IDJurnal`);

--
-- Indexes for table `jurnal_akun`
--
ALTER TABLE `jurnal_akun`
  ADD PRIMARY KEY (`IDJurnal`,`IDAkun`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`IDKehadiran`);

--
-- Indexes for table `komisi`
--
ALTER TABLE `komisi`
  ADD PRIMARY KEY (`IDSales`,`IDBarang`);

--
-- Indexes for table `laporan_pengeluaran`
--
ALTER TABLE `laporan_pengeluaran`
  ADD PRIMARY KEY (`IDPengeluaran`);

--
-- Indexes for table `laporan_penggajian`
--
ALTER TABLE `laporan_penggajian`
  ADD PRIMARY KEY (`IDPenggajian`);

--
-- Indexes for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  ADD PRIMARY KEY (`IDPenjualan`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`IDLokasi`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`IDSales`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`IDSatuan`);

--
-- Indexes for table `satuan_unit`
--
ALTER TABLE `satuan_unit`
  ADD PRIMARY KEY (`IDBarang`,`IDSatuan1`,`IDSatuan2`);

--
-- Indexes for table `setoran_bank`
--
ALTER TABLE `setoran_bank`
  ADD PRIMARY KEY (`IDSetoran`);

--
-- Indexes for table `tarik_kas_bank`
--
ALTER TABLE `tarik_kas_bank`
  ADD PRIMARY KEY (`IDTarikKas`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`IDTransaksi`);

--
-- Indexes for table `transaksi_akun`
--
ALTER TABLE `transaksi_akun`
  ADD PRIMARY KEY (`IDTransaksi`,`IDAkun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `IDAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `IDAkun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `IDBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bayar_gaji`
--
ALTER TABLE `bayar_gaji`
  MODIFY `IDBayarGaji` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `IDCabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `historygaji`
--
ALTER TABLE `historygaji`
  MODIFY `IDHistoryGaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `historykomisi`
--
ALTER TABLE `historykomisi`
  MODIFY `IDHistoryKomisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `IDJurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `IDKehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `laporan_pengeluaran`
--
ALTER TABLE `laporan_pengeluaran`
  MODIFY `IDPengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `laporan_penggajian`
--
ALTER TABLE `laporan_penggajian`
  MODIFY `IDPenggajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  MODIFY `IDPenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `IDLokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1059;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `IDSales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `IDSatuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `setoran_bank`
--
ALTER TABLE `setoran_bank`
  MODIFY `IDSetoran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tarik_kas_bank`
--
ALTER TABLE `tarik_kas_bank`
  MODIFY `IDTarikKas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `IDTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
