-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 10 Mar 2021, 16:26:46
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `myalbum`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `albums`
--

CREATE TABLE `albums` (
  `AlbumID` int(5) NOT NULL,
  `AlbumHead` varchar(50) NOT NULL,
  `AlbumContent` text NOT NULL,
  `AlbumImage` varchar(50) NOT NULL,
  `AlbumDateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

CREATE TABLE `members` (
  `MemberID` int(3) NOT NULL,
  `FirstName` varchar(33) NOT NULL,
  `LastName` varchar(33) NOT NULL,
  `Title` varchar(33) NOT NULL,
  `ImagePath` varchar(50) DEFAULT NULL,
  `Email` varchar(33) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `members`
--

INSERT INTO `members` (`MemberID`, `FirstName`, `LastName`, `Title`, `ImagePath`, `Email`, `Password`) VALUES
(1, 'Thomas', 'Edison', 'Engineer', 'thomas_edison.png', 'thomas@edison.bom', '1234'),
(2, 'Nikola', 'Tesla', 'Engineer', 'nikola_tesla.png', 'nikola@tesla.bom', '1234'),
(3, 'Albert', 'Einstein', 'Physicist', 'albert_einstein.png', 'albert@einstein.bom', '1234'),
(4, 'Alan', 'Turing', 'Programmer', 'alan_turing.png', 'alan@turing.bom', '1234');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`AlbumID`);

--
-- Tablo için indeksler `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`MemberID`) USING BTREE;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `albums`
--
ALTER TABLE `albums`
  MODIFY `AlbumID` int(5) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `members`
--
ALTER TABLE `members`
  MODIFY `MemberID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
