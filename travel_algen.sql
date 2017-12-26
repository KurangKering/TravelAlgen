-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5169
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for travel_algen
CREATE DATABASE IF NOT EXISTS `travel_algen` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `travel_algen`;

-- Dumping structure for table travel_algen.bobot
CREATE TABLE IF NOT EXISTS `bobot` (
  `awal` varchar(5) DEFAULT NULL,
  `tujuan` varchar(5) DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  UNIQUE KEY `awal_tujuan` (`awal`,`tujuan`),
  KEY `FK_bobot_titik_2` (`tujuan`),
  CONSTRAINT `FK_bobot_titik` FOREIGN KEY (`awal`) REFERENCES `titik` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bobot_titik_2` FOREIGN KEY (`tujuan`) REFERENCES `titik` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table travel_algen.bobot: ~0 rows (approximately)
/*!40000 ALTER TABLE `bobot` DISABLE KEYS */;
/*!40000 ALTER TABLE `bobot` ENABLE KEYS */;

-- Dumping structure for table travel_algen.services_requests
CREATE TABLE IF NOT EXISTS `services_requests` (
  `sr_id` int(11) NOT NULL AUTO_INCREMENT,
  `sr_address` varchar(255) NOT NULL COMMENT 'address',
  `sr_lat` decimal(10,8) NOT NULL COMMENT 'sr_lat',
  `sr_lng` decimal(11,8) NOT NULL COMMENT 'sr_lng',
  `sr_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`sr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='requests_adresses';

-- Dumping data for table travel_algen.services_requests: 1 rows
/*!40000 ALTER TABLE `services_requests` DISABLE KEYS */;
REPLACE INTO `services_requests` (`sr_id`, `sr_address`, `sr_lat`, `sr_lng`, `sr_created`) VALUES
	(1, 'aaaa', 0.00000000, 0.00000000, 1513060082);
/*!40000 ALTER TABLE `services_requests` ENABLE KEYS */;

-- Dumping structure for table travel_algen.titik
CREATE TABLE IF NOT EXISTS `titik` (
  `kode` varchar(5) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table travel_algen.titik: ~8 rows (approximately)
/*!40000 ALTER TABLE `titik` DISABLE KEYS */;
REPLACE INTO `titik` (`kode`, `nama`, `lng`, `lat`, `date_created`) VALUES
	('END', 'Kota Duri', 101.21305400, 1.25940400, NULL),
	('JaDe', 'Jalan Delima', 101.40526890, 0.47159490, '2017-12-26 09:17:47'),
	('JaKa', 'Jalan Kamboja', 101.41306670, 0.46670280, '2017-12-26 09:17:55'),
	('JaKoD', 'Jalan Kompleks Damai Langgeng', 101.41573870, 0.45291450, '2017-12-26 09:18:18'),
	('JaMaS', 'Jalan Marsan Sejahtera', 101.40934740, 0.46111150, '2017-12-26 09:18:02'),
	('JaRaS', 'Jalan Rajawali Sakti Ujung', 101.39662310, 0.48611270, '2017-12-26 09:18:09'),
	('JaTaK', 'Jalan Taman Karya', 101.37741180, 0.45213060, '2017-12-26 09:17:28'),
	('JaTuK', 'Jalan Tuah Karya', 101.36961270, 0.46074040, '2017-12-26 09:17:36'),
	('START', 'Jalan Cipta Karya', 101.39003490, 0.44439160, NULL);
/*!40000 ALTER TABLE `titik` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
