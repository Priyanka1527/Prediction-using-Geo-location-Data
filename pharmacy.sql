-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2018 at 05:29 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slimapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `id` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `Zip` int(5) NOT NULL,
  `Latitude` decimal(10,8) NOT NULL,
  `Longitude` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `Name`, `Address`, `City`, `State`, `Zip`, `Latitude`, `Longitude`) VALUES
(3, 'CVS Pharmacy', '2300 IOWA Street', 'Lawrence', 'KS', 66046, '40.78486200', '-96.65455400'),
(4, 'WALGREENS\r\n', '3696 SW TOPEKA BLVD\r\n', 'TOPEKA\r\n', 'KS\r\n', 66611, '39.00142300', '-95.68695000'),
(5, 'KMART PHARMACY   \r\n', '1740 SW WANAMAKER ROAD\r\n', 'TOPEKA\r\n', 'KS\r\n', 66604, '39.03504000', '-95.75870000'),
(6, 'CONTINENTAL PHARMACY LLC\r\n', '821 SW 6TH AVE\r\n', 'TOPEKA\r\n', 'KS\r\n', 66603, '39.05433000', '-95.68453000'),
(7, 'STORMONT-VAIL RETAIL PHARMACY\r\n', '2252 SW 10TH AVE.\r\n', 'TOPEKA\r\n', 'KS\r\n', 66604, '39.05167000', '-95.70534000'),
(8, 'DILLON PHARMACY\r\n', '2010 SE 29TH ST\r\n', 'TOPEKA\r\n', 'KS\r\n', 66605, '39.01638400', '-95.65065000'),
(9, 'WAL-MART PHARMACY       \r\n', '1501 S.W. WANAMAKER ROAD\r\n', 'TOPEKA\r\n', 'KS\r\n', 66604, '39.03955000', '-95.76459000'),
(10, 'KING PHARMACY\r\n', '4033 SW 10TH AVE\r\n', 'TOPEKA\r\n', 'KS\r\n', 66604, '39.05121000', '-95.72700000'),
(11, 'HY-VEE PHARMACY      \r\n', '12122 STATE LINE RD\r\n', 'LEAWOOD\r\n', 'KS\r\n', 66209, '38.90775300', '-94.60801000'),
(12, 'JAYHAWK PHARMACY AND PATIENT SUPPLY\r\n', '2860 SW MISSION WOODS DR\r\n', 'TOPEKA\r\n', 'KS\r\n', 66614, '39.01505300', '-95.77866000'),
(13, 'PRICE CHOPPER PHARMACY\r\n', '3700 W 95TH ST\r\n', 'LEAWOOD\r\n', 'KS\r\n', 66206, '38.95792000', '-94.62881500'),
(14, 'AUBURN PHARMACY\r\n', '13351 MISSION RD\r\n', 'LEAWOOD\r\n', 'KS\r\n', 66209, '38.88534500', '-94.62800000'),
(15, 'CVS PHARMACY\r\n', '5001 WEST 135 ST\r\n', 'LEAWOOD\r\n', 'KS\r\n', 66224, '38.88323000', '-94.64518000'),
(16, 'SAMS PHARMACY       \r\n', '1401 SW WANAMAKER ROAD\r\n', 'TOPEKA\r\n', 'KS\r\n', 66604, '39.04160300', '-95.76462600'),
(17, 'CVS PHARMACY\r\n', '2835 SW WANAMAKER RD\r\n', 'TOPEKA\r\n', 'KS\r\n', 66614, '39.01550300', '-95.76434000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
