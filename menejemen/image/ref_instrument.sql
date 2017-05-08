-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2017 at 09:24 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `penyewaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `ref_instrument`
--

CREATE TABLE IF NOT EXISTS `ref_instrument` (
  `instrument_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `instrument_name` varchar(50) NOT NULL,
  `instrument_brand` varchar(20) NOT NULL,
  `instrument_quantity` int(5) NOT NULL,
  `instrument_fee` float NOT NULL,
  `instrument_description` text NOT NULL,
  `instrument_length` varchar(15) NOT NULL,
  `instrument_weight` varchar(10) NOT NULL,
  `instrument_picture` varchar(20) NOT NULL,
  PRIMARY KEY (`instrument_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `ref_instrument`
--

INSERT INTO `ref_instrument` (`instrument_id`, `instrument_name`, `instrument_brand`,
 `instrument_quantity`, `instrument_fee`, `instrument_description`, `instrument_length`,
  `instrument_weight`, `instrument_picture`,`intrument_quantity_temp`) VALUES
(15, 'Anthropometer', 'Holtain Limited, Har', 2, 250000, '    ', '-', '-', 'IMG_1664.JPG','0'),
(16, 'Spreadhing Caliper / Caliper Rentang', 'GPM, Swiss', 1, 100000, '    ', '60 dan 30 ', '-', 'IMG_1679.JPG','0'),
(17, 'Spreading Caliper Lengkung', 'GPM, Swiss', 1, 50000, ' Ketelitian 1,5  ', '50 cm', '-', 'E-FIX.JPG','0'),
(18, 'Spreading Caliper Lengkung', 'GPM, Swiss', 1, 50000, ' Ketelitian 1  ', '50 cm', '-', 'F-FIX.JPG','0'),
(19, 'Dynamo Meter Set', 'TTM, Tokyo', 1, 150000, ' 2 tangan ', '-', '100 kg', 'H-FIX.JPG','0'),
(20, 'Dynamo Meter Set', 'TTM, Tokyo', 1, 150000, ' 1 tangan ', '-', '50 kg', 'IMG_1712.JPG','0'),
(21, 'Dynamo Meter Set', 'TTM, Tokyo', 1, 150000, '  ', '-', '-', 'J-FIX.JPG','0'),
(22, 'A.OTT Compensating Polar Plammeter', 'Kempten Bayern', 1, 50000, '  ', '21 mm', '-', 'K-FIX.JPG','0'),
(23, 'Lange Skinfold Caliper', 'Cambridge Scientific', 2, 100000, '  ', '60 mm', '-', 'L-FIX.JPG','0'),
(24, 'Skinfold Caliper ', 'Holtain', 3, 150000, '  ', '0,2 mm', '-', 'M-FIX.JPG','0'),
(25, 'Sliding Caliper', 'Holtain', 2, 100000, '  ', '14 cm', '-', 'N-FIX.JPG','0'),
(26, 'Sliding Caliper / Vernier Caliper', 'Mitutoyo, Japan', 1, 100000, '  ', '300 mm', '-', 'O-FIX.JPG','0'),
(27, 'Sliding Caliper', 'GPM, Swiss', 1, 200000, '  ', '22 mm', '-', 'P-FIX.JPG','0'),
(28, 'Sliding Caliper', 'GPM, Swiss', 1, 50000, '  ', '2 mm', '-', 'Q-FIX.JPG','0'),
(29, 'Sliding Caliper', 'GPM, Swiss', 1, 50000, '  ', '180 cm', '-', 'R-FIX.JPG','0'),
(30, 'Pita Meter', 'Lutkin', 4, 50000, '  ', '2 m', '-', 'S-FIX.JPG','0'),
(31, 'Orchidometer', 'Holtain', 2, 100000, '  ', '-', '-', 'T-FIX.JPG','0'),
(32, 'Biotrop', 'Twinlite, Eschma Eng', 1, 50000, '', '-', '-', 'U-FIX.JPG','0'),
(33, 'Skala Warna Kulit 36 macam', 'Hautfarben, Tafel', 1, 200000, '   ', '-', '-', 'V-FIX.JPG','0'),
(34, 'Skala Warna Kulit 24 macam', 'Hautfarben, Tafel', 1, 200000, ' ', '-', '-', 'W-FIX.JPG','0'),
(35, 'Skala Rambut 30 macam', '-', 1, 200000, ' ', '-', '-', 'X-FIX.JPG','0'),
(36, 'Timbangan Berat Badan', 'ADE', 2, 100000, 'Kapasitas 150 kg, Dimensi 320 x 435 x 70 mm', '-', '-', 'Z-FIX.JPG','0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
