-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                10.1.35-MariaDB - mariadb.org binary distribution
-- Sunucu İşletim Sistemi:       Win32
-- HeidiSQL Sürüm:               10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- paykasa için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `paykasa` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `paykasa`;

-- tablo yapısı dökülüyor paykasa.astropaysatis
CREATE TABLE IF NOT EXISTS `astropaysatis` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Dolar` double NOT NULL DEFAULT '0',
  `Fiyati` double NOT NULL DEFAULT '0',
  `OlmasiGereken` double NOT NULL DEFAULT '0',
  `Kar` double NOT NULL DEFAULT '0',
  `Satis` int(11) NOT NULL DEFAULT '0',
  `Astropay` double NOT NULL DEFAULT '0',
  `Basilmis` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti
-- tablo yapısı dökülüyor paykasa.jetonsatisi
CREATE TABLE IF NOT EXISTS `jetonsatisi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Jeton1` double NOT NULL DEFAULT '0',
  `Fiyati` double NOT NULL DEFAULT '0',
  `OlmasiGereken` double NOT NULL DEFAULT '0',
  `Kar` double NOT NULL DEFAULT '0',
  `Satis` int(11) NOT NULL DEFAULT '0',
  `Jeton2` double NOT NULL DEFAULT '0',
  `Basilmis` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- Veri çıktısı seçilmemişti
-- tablo yapısı dökülüyor paykasa.kasalar
CREATE TABLE IF NOT EXISTS `kasalar` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KasaAdi` varchar(50) DEFAULT NULL,
  `BasilmamisKod` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- Veri çıktısı seçilmemişti
-- tablo yapısı dökülüyor paykasa.kurlar
CREATE TABLE IF NOT EXISTS `kurlar` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KurAdi` varchar(50) DEFAULT NULL,
  `KurFiyat` double DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- Veri çıktısı seçilmemişti
-- tablo yapısı dökülüyor paykasa.paykasasatis
CREATE TABLE IF NOT EXISTS `paykasasatis` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Paykasa1` double NOT NULL DEFAULT '0',
  `Fiyati` double NOT NULL DEFAULT '0',
  `OlmasiGereken` double NOT NULL DEFAULT '0',
  `Kar` double NOT NULL DEFAULT '0',
  `Satis` int(11) NOT NULL DEFAULT '0',
  `Paykasa2` double NOT NULL DEFAULT '0',
  `Basilmis` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- Veri çıktısı seçilmemişti
-- tablo yapısı dökülüyor paykasa.paykwik
CREATE TABLE IF NOT EXISTS `paykwik` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Cashixir1` double NOT NULL DEFAULT '0',
  `Fiyati` double NOT NULL DEFAULT '0',
  `OlmasiGereken` double NOT NULL DEFAULT '0',
  `Kar` double NOT NULL DEFAULT '0',
  `Satis` int(11) NOT NULL DEFAULT '0',
  `Cashixir2` double NOT NULL DEFAULT '0',
  `Basilmis` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- Veri çıktısı seçilmemişti
-- tablo yapısı dökülüyor paykasa.rapor
CREATE TABLE IF NOT EXISTS `rapor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KasaID` int(11) NOT NULL DEFAULT '0',
  `SatisKuru` double NOT NULL DEFAULT '0',
  `Kar` double NOT NULL DEFAULT '0',
  `Satilan` double NOT NULL DEFAULT '0',
  `KasadakiKod` double NOT NULL DEFAULT '0',
  `PaneldekiKod` double NOT NULL DEFAULT '0',
  `tarih` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- Veri çıktısı seçilmemişti
-- tablo yapısı dökülüyor paykasa.urunler
CREATE TABLE IF NOT EXISTS `urunler` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KasaID` int(11) NOT NULL DEFAULT '0',
  `Miktar` int(11) NOT NULL DEFAULT '0',
  `Paykasa` varchar(50) NOT NULL,
  `Banka` varchar(50) NOT NULL,
  `Satildimi` bit(1) NOT NULL DEFAULT b'0',
  `tarih` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=849 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- Veri çıktısı seçilmemişti
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
