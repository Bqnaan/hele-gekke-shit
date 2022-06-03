-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 02:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serieusexamen`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(11) NOT NULL,
  `reservering_id` int(11) NOT NULL,
  `menuitem_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `geserveerd` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `reservering_id`, `menuitem_id`, `aantal`, `geserveerd`) VALUES
(5, 8, 7, 2, NULL),
(6, 8, 12, 4, NULL),
(7, 8, 9, 4, NULL),
(8, 8, 6, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Hoi', 'Hoi@hallo.nl', '291083');

-- --------------------------------------------------------

--
-- Table structure for table `gerechtcategorien`
--

CREATE TABLE `gerechtcategorien` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `categorie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gerechtcategorien`
--

INSERT INTO `gerechtcategorien` (`id`, `code`, `categorie`) VALUES
(1, '1', 'Voorgerechten'),
(2, '2', 'Hoofdgerechten'),
(3, '3', 'Nagerechten'),
(4, '4', 'Dranken');

-- --------------------------------------------------------

--
-- Table structure for table `gerechtsoorten`
--

CREATE TABLE `gerechtsoorten` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `gerechtcategorie_id` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gerechtsoorten`
--

INSERT INTO `gerechtsoorten` (`id`, `code`, `naam`, `gerechtcategorie_id`) VALUES
(2, 'kvg', 'Koude voorgerechten', 1),
(4, 'wvg', 'Warme voorgerechten', 1),
(5, 'khg', 'Koude hoofdgerechten', 2),
(6, 'whg', 'Warme hoofdgerechten', 2),
(7, 'nag', 'Nagerechten', 3),
(8, 'frd', 'Frisdranken', 4),
(9, 'bie', 'Bieren', 4);

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL,
  `code` varchar(4) NOT NULL,
  `beschrijving` varchar(30) NOT NULL,
  `gerechtsoort_id` int(11) NOT NULL,
  `prijs` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`id`, `code`, `beschrijving`, `gerechtsoort_id`, `prijs`) VALUES
(1, 'hei', 'Heineken', 9, '4.20'),
(2, 'wat', 'Spa Rood', 8, '6.43'),
(5, 'zal', 'Gebakken Zalm', 6, '2.10'),
(6, 'car', 'Carpaccio', 2, '3.98'),
(7, 'kso', 'Kippensoep', 4, '2.49'),
(9, 'vij', 'Vanille ijs', 7, '3.39'),
(12, 'fri', 'Fristi', 8, '2.10');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `tafel` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `people` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `datum_toegevoegd` timestamp NOT NULL DEFAULT current_timestamp(),
  `kinderen` int(11) NOT NULL DEFAULT 0,
  `allergieen` text NOT NULL,
  `opmerkingen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `tafel`, `customer_id`, `people`, `date`, `status`, `datum_toegevoegd`, `kinderen`, `allergieen`, `opmerkingen`) VALUES
(8, 4, 2, 4, '2022-06-21 23:08:55', 1, '2022-06-02 21:09:35', 0, '', ''),
(9, 0, 1, 2, '2022-06-15 14:10:00', 1, '2022-06-03 09:06:35', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gerechtcategorien`
--
ALTER TABLE `gerechtcategorien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `gerechtcategorie_id` (`gerechtcategorie_id`);

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `gerechtsoort.id` (`gerechtsoort_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gerechtcategorien`
--
ALTER TABLE `gerechtcategorien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
