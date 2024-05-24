-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 24, 2024 at 05:45 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galacticnavigator`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakty_cywilizacyjne`
--

CREATE TABLE `kontakty_cywilizacyjne` (
  `id` int(11) NOT NULL,
  `misja_id` int(11) DEFAULT NULL,
  `cywilizacja` varchar(255) DEFAULT NULL,
  `kultura` text DEFAULT NULL,
  `technologia` text DEFAULT NULL,
  `polityka` text DEFAULT NULL,
  `interakcje` text DEFAULT NULL,
  `planeta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kontakty_cywilizacyjne`
--
ALTER TABLE `kontakty_cywilizacyjne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `misja_id` (`misja_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontakty_cywilizacyjne`
--
ALTER TABLE `kontakty_cywilizacyjne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kontakty_cywilizacyjne`
--
ALTER TABLE `kontakty_cywilizacyjne`
  ADD CONSTRAINT `kontakty_cywilizacyjne_ibfk_1` FOREIGN KEY (`misja_id`) REFERENCES `misje` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
