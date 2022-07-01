/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_perencanaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_perencanaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_perencanaan`;

/*Table structure for table `bagian` */

DROP TABLE IF EXISTS `bagian`;

CREATE TABLE `bagian` (
  `kode_bagian` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bagian` varchar(50) DEFAULT NULL,
  `status_bagian` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`kode_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bagian` */

insert  into `bagian`(`kode_bagian`,`nama_bagian`,`status_bagian`) values 
(1,'Kepegawaian',1),
(2,'Penunjang Medis',1),
(3,'Pelayanan',1);

/*Table structure for table `item_usulan` */

DROP TABLE IF EXISTS `item_usulan`;

CREATE TABLE `item_usulan` (
  `kode_item` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jenis_usulan` varchar(30) DEFAULT NULL,
  `nama_item` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `item_usulan` */

/*Table structure for table `jenis_usulan` */

DROP TABLE IF EXISTS `jenis_usulan`;

CREATE TABLE `jenis_usulan` (
  `kode` varchar(30) NOT NULL,
  `kode_induk` varchar(30) DEFAULT NULL,
  `jenis_usulan` varchar(100) DEFAULT NULL,
  `status_usulan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `jenis_usulan` */

insert  into `jenis_usulan`(`kode`,`kode_induk`,`jenis_usulan`,`status_usulan`) values 
('01','01','Belanja Pegawai',1),
('02','02','Belanja Barang Dan Jasa',1),
('02.1','02','Belanja Barang',1),
('02.1.1','02.1','Belanja Bahan Bakar Dan Pelumas',1),
('02.1.2','02.1','Belanja bahan Isi tabung pemadam kebakaran',1),
('02.1.3','02.1','Belanja Bahan - Isi Tabung gas',1),
('02.1.3.1','02.1.3','Belanja Gas medis',1),
('02.1.3.2','02.1.3','Belanja Pengisian Tabung Gas Elpiji',1),
('02.1.4','02.1','Belanja Bahan Lainnya',1),
('02.1.4.1','02.1.4','Belanja Bahan Alat Ruang Rawat',1),
('02.1.4.2','02.1.4','Belanja Barang Penunjang Layanan Kesehatan habis Pakai',1),
('02.1.5','02.1','Belanja Penggantian Suku Cadang alat kedokteran',1),
('02.1.6','02.1','Belanja ATK',1),
('02.2','02','Belanja Jasa',1),
('02.3','02','Belanja pemeliharaan',1),
('02.4','02','Belanja Perjalanan  Dinas',1),
('03','03','Belanja Modal',1),
('03.1','03','Belanja Tanah',1),
('03.2','03','Belanja Modal Peralatan dan mesin',1),
('03.3','03','Belanja Modal Gedung Dan bangunana',1);

/*Table structure for table `periode_usulan` */

DROP TABLE IF EXISTS `periode_usulan`;

CREATE TABLE `periode_usulan` (
  `kode_periode` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_usulan` enum('Usulan Pertama','Usulan Perubahan') DEFAULT NULL,
  `sub_periode` int(11) DEFAULT NULL,
  `tahun_anggaran` int(4) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `tglbuka` date DEFAULT NULL,
  `tgltutup` date DEFAULT NULL,
  `statusperiode` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`kode_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `periode_usulan` */

insert  into `periode_usulan`(`kode_periode`,`kategori_usulan`,`sub_periode`,`tahun_anggaran`,`deskripsi`,`tglbuka`,`tgltutup`,`statusperiode`) values 
(1,'Usulan Pertama',0,2023,'Usulan Untuk Anggaran tahun 2023','2022-06-29','2022-08-30',1);

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `idx` int(11) NOT NULL,
  `nama_instansi` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `alamat` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `notelp` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `fax` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `facebook` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `twitter` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `instagram` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `youtube` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `sekilas` text CHARACTER SET latin1 DEFAULT NULL,
  `moto` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `visi` text CHARACTER SET latin1 DEFAULT NULL,
  `misi` text CHARACTER SET latin1 DEFAULT NULL,
  `tujuan` text CHARACTER SET latin1 DEFAULT NULL,
  `tentang` text CHARACTER SET latin1 DEFAULT NULL,
  `sasaran` text CHARACTER SET latin1 DEFAULT NULL,
  `indikator_sasaran` text CHARACTER SET latin1 DEFAULT NULL,
  `logo` text CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `profile` */

insert  into `profile`(`idx`,`nama_instansi`,`alamat`,`notelp`,`fax`,`email`,`facebook`,`twitter`,`instagram`,`youtube`,`sekilas`,`moto`,`visi`,`misi`,`tujuan`,`tentang`,`sasaran`,`indikator_sasaran`,`logo`) values 
(1,'RSUD Kota Padang Panjang',' Jl. Tabek Gadang Kel.Ganting ','0811 6667118','0811 6667118',' rsud.pp@padangpanjang.go.id ','-','-','-','-','','-','','','','','','','logo.png');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(30) DEFAULT NULL,
  `userpass` char(32) DEFAULT NULL,
  `userbagian` int(11) DEFAULT NULL,
  `usernamalengkap` varchar(50) DEFAULT NULL,
  `administrator` tinyint(1) DEFAULT 0,
  `photo` text DEFAULT NULL,
  `userstatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`username`,`userpass`,`userbagian`,`usernamalengkap`,`administrator`,`photo`,`userstatus`) values 
('admin','827ccb0eea8a706c4c34a16891f84e7b',1,'Administrator',1,NULL,1),
('kepeg','827ccb0eea8a706c4c34a16891f84e7b',1,'Kabid Kepegawaian',0,NULL,1),
('pelayanan','827ccb0eea8a706c4c34a16891f84e7b',2,'Kabid Pelayanan',0,NULL,1),
('penunjang','827ccb0eea8a706c4c34a16891f84e7b',3,'Kabid Penunjang',0,NULL,1);

/*Table structure for table `usulan` */

DROP TABLE IF EXISTS `usulan`;

CREATE TABLE `usulan` (
  `kode_usulan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bagian` int(11) DEFAULT NULL,
  `kode_periode` int(11) DEFAULT NULL,
  `kode_item` int(11) DEFAULT NULL,
  `tglinput` date DEFAULT NULL,
  PRIMARY KEY (`kode_usulan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `usulan` */

/*Table structure for table `usulan_detail` */

DROP TABLE IF EXISTS `usulan_detail`;

CREATE TABLE `usulan_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_kode_usulan` int(11) DEFAULT NULL,
  `detail_kode_item` int(11) DEFAULT NULL,
  `detail_jumlah` int(11) DEFAULT NULL,
  `detail_harga` bigint(20) DEFAULT NULL,
  `detail_satuan` varchar(30) DEFAULT NULL,
  `detail_subtotal` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `usulan_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
