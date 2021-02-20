/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.2.3-MariaDB-log : Database - ajidb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ajidb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ajidb`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`nama_admin`,`username`,`password`) values 
(1,'Admin','admin','21232f297a57a5a743894a0e4a801fc3');

/*Table structure for table `file` */

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `file` */

insert  into `file`(`id_file`,`nama_file`,`file`) values 
(6,'Surat Pernyataan','surat-pernyataan.pdf'),
(7,'Pengumuman Penerimaan','pengumuman-penerimaan.pdf'),
(8,'Formulir Ujian','formulir-ujian.pdf');

/*Table structure for table `hitung` */

DROP TABLE IF EXISTS `hitung`;

CREATE TABLE `hitung` (
  `id_hitung` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `vektor_s` float NOT NULL,
  `vektor_v` float NOT NULL,
  PRIMARY KEY (`id_hitung`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `hitung` */

insert  into `hitung`(`id_hitung`,`id_user`,`id_lowongan`,`vektor_s`,`vektor_v`) values 
(13,14,11,72.596,0.31034),
(14,15,11,82.3573,0.340984),
(15,16,11,85.8078,0.356402),
(16,17,11,0,0),
(17,18,13,7,1),
(18,18,11,0,0),
(19,18,14,0,0),
(20,14,14,0,0),
(21,21,11,0,0),
(22,21,13,0,0),
(23,21,15,4.9194,0.487484),
(24,22,15,5.172,0.512516);

/*Table structure for table `lowongan` */

DROP TABLE IF EXISTS `lowongan`;

CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL AUTO_INCREMENT,
  `lowongan` varchar(50) NOT NULL,
  `kuota` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `pengumuman` int(11) NOT NULL,
  PRIMARY KEY (`id_lowongan`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `lowongan` */

insert  into `lowongan`(`id_lowongan`,`lowongan`,`kuota`,`status`,`pengumuman`) values 
(11,'Lowongan Programmer PHP',1,1,1),
(14,'Marketing',3,1,0),
(15,'QC',4,1,1);

/*Table structure for table `lowongan_rinci` */

DROP TABLE IF EXISTS `lowongan_rinci`;

CREATE TABLE `lowongan_rinci` (
  `id_lowongan_rinci` int(11) NOT NULL AUTO_INCREMENT,
  `id_lowongan` int(11) DEFAULT NULL,
  `id_kriteria` varchar(11) DEFAULT NULL,
  `status_nilai` tinyint(4) DEFAULT NULL,
  `status_upload` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_lowongan_rinci`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `lowongan_rinci` */

insert  into `lowongan_rinci`(`id_lowongan_rinci`,`id_lowongan`,`id_kriteria`,`status_nilai`,`status_upload`) values 
(2,11,'6',0,0),
(3,11,'7',0,0),
(4,11,'8',0,0),
(5,11,'9',0,0);

/*Table structure for table `pelamar` */

DROP TABLE IF EXISTS `pelamar`;

CREATE TABLE `pelamar` (
  `id_lamaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `id_nilai_kriteria` varchar(25) NOT NULL,
  `id_file` varchar(11) NOT NULL,
  PRIMARY KEY (`id_lamaran`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pelamar` */

insert  into `pelamar`(`id_lamaran`,`id_user`,`id_lowongan`,`id_nilai_kriteria`,`id_file`) values 
(1,18,11,'1','1'),
(2,14,11,'1','1');

/*Table structure for table `tbl_kriteria` */

DROP TABLE IF EXISTS `tbl_kriteria`;

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(25) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kriteria` */

insert  into `tbl_kriteria`(`id_kriteria`,`nama_kriteria`,`bobot`) values 
(1,'Jenjang Pendidikan',25),
(2,'Pengalaman Kerja Yang Dimiliki',20),
(3,'Kemampuan Seputar Pekerjaan Yang Dilamar',30),
(4,'Usia Pelamar',10),
(5,'Kemampuan bahasa Asing yang Dikuasai',15),
(6,'menguasai framework php codeigniter',30),
(7,'menguasai konsep OOP',20),
(8,'menguasai SQLServer',20),
(9,'menguasai konsep API',20);

/*Table structure for table `tbl_nilai_detail` */

DROP TABLE IF EXISTS `tbl_nilai_detail`;

CREATE TABLE `tbl_nilai_detail` (
  `id_nilai_real` int(25) NOT NULL,
  `id_nilai_kri` varchar(25) DEFAULT NULL,
  `tgl_penilaian` date DEFAULT NULL,
  `id_admin` varchar(25) DEFAULT NULL,
  `id_lamaran` varchar(25) DEFAULT NULL,
  `totalNilai` int(12) DEFAULT NULL,
  `status` enum('Diperiksa') DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `approved` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_nilai_real`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_nilai_detail` */

/*Table structure for table `tbl_nilai_kriteria` */

DROP TABLE IF EXISTS `tbl_nilai_kriteria`;

CREATE TABLE `tbl_nilai_kriteria` (
  `id_nilai_kriteria` int(25) NOT NULL AUTO_INCREMENT,
  `id_kriteria` varchar(12) DEFAULT NULL,
  `tgl_penilaian` date DEFAULT NULL,
  `id_admin` varchar(25) DEFAULT NULL,
  `totalNilai` int(12) DEFAULT NULL,
  `status` enum('Diperiksa') DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `approved` int(12) DEFAULT NULL,
  `id_lamaran` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_nilai_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_nilai_kriteria` */

insert  into `tbl_nilai_kriteria`(`id_nilai_kriteria`,`id_kriteria`,`tgl_penilaian`,`id_admin`,`totalNilai`,`status`,`catatan`,`approved`,`id_lamaran`) values 
(1,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(2,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(3,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(4,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(5,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(6,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(7,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(8,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(9,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(10,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(11,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(12,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(13,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(14,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(15,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(16,'4',NULL,NULL,80,NULL,NULL,NULL,1),
(17,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(18,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(19,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(20,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(21,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(22,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(23,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(24,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(25,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(26,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(27,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(28,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(29,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(30,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(31,'3',NULL,NULL,80,NULL,NULL,NULL,1),
(32,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(33,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(34,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(35,'3',NULL,NULL,80,NULL,NULL,NULL,1),
(36,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(37,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(38,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(39,'3',NULL,NULL,80,NULL,NULL,NULL,1),
(40,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(41,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(42,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(43,'3',NULL,NULL,80,NULL,NULL,NULL,1),
(44,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(45,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(46,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(47,'3',NULL,NULL,80,NULL,NULL,NULL,1),
(48,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(49,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(50,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(51,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(52,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(53,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(54,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(55,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(56,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(57,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(58,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(59,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(60,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(61,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(62,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(63,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(64,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(65,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(66,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(67,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(68,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(69,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(70,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(71,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(72,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(73,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(74,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(75,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(76,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(77,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(78,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(79,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(80,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(81,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(82,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(83,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(84,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(85,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(86,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(87,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(88,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(89,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(90,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(91,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(92,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(93,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(94,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(95,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(96,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(97,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(98,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(99,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(100,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(101,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(102,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(103,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(104,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(105,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(106,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(107,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(108,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(109,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(110,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(111,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(112,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(113,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(114,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(115,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(116,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(117,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(118,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(119,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(120,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(121,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(122,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(123,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(124,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(125,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(126,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(127,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(128,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(129,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(130,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(131,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(132,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(133,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(134,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(135,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(136,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(137,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(138,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(139,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(140,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(141,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(142,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(143,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(144,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(145,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(146,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(147,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(148,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(149,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(150,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(151,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(152,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(153,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(154,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(155,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(156,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(157,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(158,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(159,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(160,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(161,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(162,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(163,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(164,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(165,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(166,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(167,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(168,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(169,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(170,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(171,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(172,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(173,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(174,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(175,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(176,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(177,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(178,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(179,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(180,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(181,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(182,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(183,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(184,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(185,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(186,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(187,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(188,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(189,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(190,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(191,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(192,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(193,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(194,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(195,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(196,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(197,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(198,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(199,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(200,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(201,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(202,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(203,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(204,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(205,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(206,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(207,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(208,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(209,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(210,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(211,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(212,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(213,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(214,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(215,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(216,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(217,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(218,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(219,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(220,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(221,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(222,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(223,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(224,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(225,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(226,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(227,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(228,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(229,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(230,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(231,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(232,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(233,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(234,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(235,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(236,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(237,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(238,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(239,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(240,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(241,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(242,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(243,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(244,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(245,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(246,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(247,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(248,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(249,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(250,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(251,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(252,'1',NULL,NULL,50,NULL,NULL,NULL,1),
(253,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(254,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(255,'4',NULL,NULL,50,NULL,NULL,NULL,1),
(256,'1',NULL,NULL,70,NULL,NULL,NULL,1),
(257,'2',NULL,NULL,50,NULL,NULL,NULL,1),
(258,'3',NULL,NULL,90,NULL,NULL,NULL,1),
(259,'4',NULL,NULL,70,NULL,NULL,NULL,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pendidikan` varchar(30) NOT NULL,
  `file_cv` varchar(50) NOT NULL,
  `foto` varchar(150) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id_user`,`nama_lengkap`,`username`,`password`,`alamat`,`tempat_lahir`,`tanggal_lahir`,`no_hp`,`email`,`pendidikan`,`file_cv`,`foto`) values 
(14,'Rawa Tech','rawa1','4c05c01e16e46d81b318cce00fef3eab','jalan jalan sekitar indonesia','Indonesia','1990-10-27','081263728192','techrawa@gmail.com','S1 Teknik Informatika','cv_14_Rawa Tech.pdf','foto_14_Rawa Tech.png'),
(15,'Juggernaut','jugg','cf3a6f91a31f6b0d7b397dad7143e1e4','jalan ga jauh dari rumah pokoknya','Indonesia','1990-05-05','081235353535','juggernaut@gmail.com','S1 Sistem Informasi','cv_15_Juggernaut.pdf','foto_15_Juggernaut.png'),
(16,'Rawatech tapi Juggernaut','rawa2','c23e68318188483766f92f69d6d62268','dibelakang mesjid insyaAllah ringan langkah ','Indonesia','1990-01-01','081345456461','rawanaut@gmail.com','S1 Manajemen Informatika','cv_16_Rawatech tapi Juggernaut.pdf','foto_16_Rawatech tapi Juggernaut.jpg'),
(17,'irfan','aku','89ccfac87d8d06db06bf3211cb2d69ed','ciamskad','wiihd','1997-10-12','0908979','irfanagustianmuldani@gmail.com','S1 iuu','cv_17_irfan.docx','foto_17_irfan.jpg'),
(18,'ret','aji','8d045450ae16dc81213a75b725ee2760','kjqjpoejpppppppppppppppp','wiihd','1995-12-12','0908979','aji@jhk.com','S1 kokok','cv_18_ret.docx','foto_18_ret.jpg'),
(19,'aji','','d41d8cd98f00b204e9800998ecf8427e','','','0000-00-00','','','','',''),
(20,'','','d41d8cd98f00b204e9800998ecf8427e','','','0000-00-00','','','','',''),
(21,'febri','febri','4689c75fd0935ff5818d62fd2083ed98','hghgwuggdiw','uyui','1997-01-01','67897676876','febri@gmail.com','D3 iuiuo','','foto_21_febri.png'),
(22,'egi','egi','202cb962ac59075b964b07152d234b70','curug','tangerang','1998-01-06','08572929288','egi@gmail.com','D3 sistem informasi','cv_22_egi.JPG',''),
(23,'','','d41d8cd98f00b204e9800998ecf8427e','','','0000-00-00','','','','','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
