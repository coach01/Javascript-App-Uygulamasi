-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Şub 2021, 18:54:50
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
-- Veritabanı: `test`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(3) NOT NULL,
  `FirstName` varchar(33) NOT NULL,
  `LastName` varchar(33) NOT NULL,
  `Title` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `employees`
--

INSERT INTO `employees` (`EmployeeID`, `FirstName`, `LastName`, `Title`) VALUES
(1, 'Nancy', 'Davolio', 'Sales Representative'),
(2, 'Andrew', 'Fuller', 'Vice President, Sales'),
(3, 'Janet', 'Leverling', 'Sales Representative'),
(4, 'Margaret', 'Peacock', 'Sales Representative'),
(5, 'Steven', 'Buchanan', 'Sales Manager'),
(6, 'Michael', 'Suyama', 'Sales Representative'),
(7, 'Robert', 'King', 'Sales Representative'),
(8, 'Laura', 'Callahan', 'Inside Sales Coordinator'),
(9, 'Anne', 'Dodsworth', 'Sales Representative');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
