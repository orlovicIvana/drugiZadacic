-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2021 at 09:07 AM
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
-- Database: `praksa`
--

-- --------------------------------------------------------

--
-- Table structure for table `grupe`
--

CREATE TABLE `grupe` (
  `ID` int(11) NOT NULL,
  `Naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grupe`
--

INSERT INTO `grupe` (`ID`, `Naziv`) VALUES
(1, 'PHP'),
(2, 'JavaScript'),
(3, 'C++'),
(4, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `mentori`
--

CREATE TABLE `mentori` (
  `ID` int(11) NOT NULL,
  `Ime` varchar(50) NOT NULL,
  `Prezime` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `idGrupe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mentori`
--

INSERT INTO `mentori` (`ID`, `Ime`, `Prezime`, `Email`, `idGrupe`) VALUES
(1, 'Bosko', 'Stupar', 'bosko.stupar@yahoo.com', 1),
(2, 'Aleksandra', 'Ceranic', 'aleksandra.ceranic@yahoo.com', 2),
(3, 'Nikola', 'Nikolic', 'nikola.nikolic@yahoo.com', 3),
(4, 'Milan', 'Milanovic', 'milan.m@yahoo.com', 4);

-- --------------------------------------------------------

--
-- Table structure for table `praktikanti`
--

CREATE TABLE `praktikanti` (
  `ID` int(11) NOT NULL,
  `Ime` varchar(50) NOT NULL,
  `Prezime` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `idGrupe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikanti`
--

INSERT INTO `praktikanti` (`ID`, `Ime`, `Prezime`, `Email`, `idGrupe`) VALUES
(1, 'Ivana', 'Orlovic', 'ivana.orlovic@yahoo.com', 1),
(2, 'Dalibor', 'Marinkovic', 'dalibor.marinkovic@yahoo.com', 1),
(3, 'Stefan', 'Meza', 'stefan.meza@yahoo.com', 2),
(5, 'Milos', 'Ciric', 'milos.ciric@yahoo.com', 2),
(6, 'Petar', 'Antic', 'petar.antic@yahoo.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grupe`
--
ALTER TABLE `grupe`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mentori`
--
ALTER TABLE `mentori`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_grupe2` (`idGrupe`);

--
-- Indexes for table `praktikanti`
--
ALTER TABLE `praktikanti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_grupe1` (`idGrupe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grupe`
--
ALTER TABLE `grupe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mentori`
--
ALTER TABLE `mentori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `praktikanti`
--
ALTER TABLE `praktikanti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mentori`
--
ALTER TABLE `mentori`
  ADD CONSTRAINT `FK_grupe2` FOREIGN KEY (`idGrupe`) REFERENCES `grupe` (`ID`);

--
-- Constraints for table `praktikanti`
--
ALTER TABLE `praktikanti`
  ADD CONSTRAINT `FK_grupe1` FOREIGN KEY (`idGrupe`) REFERENCES `grupe` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
