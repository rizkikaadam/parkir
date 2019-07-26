/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.1.21-MariaDB : Database - db_parkir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_parkir` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_parkir`;

/*Table structure for table `tbl_transaksi` */

DROP TABLE IF EXISTS `tbl_transaksi`;

CREATE TABLE `tbl_transaksi` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `plat_nomor` varchar(20) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `tipe` varchar(3) DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `parkir_lot` varchar(4) DEFAULT NULL,
  `jumlah_bayar` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_transaksi` */

insert  into `tbl_transaksi`(`id`,`plat_nomor`,`warna`,`tipe`,`tanggal_masuk`,`tanggal_keluar`,`parkir_lot`,`jumlah_bayar`) values 
(15,'D 1993 PE','Hitam','MPV','2019-07-26 11:24:42',NULL,'A15',NULL),
(16,' B 123 34','Hitam','SUV','2019-07-26 11:25:04',NULL,'A16',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
