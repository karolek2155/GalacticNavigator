-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 26, 2024 at 08:47 PM
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
  `cywilizacja` varchar(255) DEFAULT NULL,
  `kultura` text DEFAULT NULL,
  `technologia` text DEFAULT NULL,
  `polityka` text DEFAULT NULL,
  `interakcje` text DEFAULT NULL,
  `planeta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `misje`
--

CREATE TABLE `misje` (
  `id` int(11) NOT NULL,
  `cel` varchar(255) DEFAULT NULL,
  `zaloga` text DEFAULT NULL,
  `zasoby` text DEFAULT NULL,
  `data_startu` date DEFAULT NULL,
  `data_zakonczenia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `misje`
--

INSERT INTO `misje` (`id`, `cel`, `zaloga`, `zasoby`, `data_startu`, `data_zakonczenia`) VALUES
(1, '', '', '', '0000-00-00', '0000-00-00'),
(2, '', '', '', '0000-00-00', '0000-00-00'),
(3, '', '', '', '0000-00-00', '0000-00-00'),
(4, '', '', '', '0000-00-00', '0000-00-00'),
(5, '5', '5', '5', '2024-05-04', '2024-05-10'),
(6, '5', '5', '5', '2024-05-04', '2024-05-10'),
(7, 'Mars', '1', 'woda, puszki', '2008-09-04', '2021-12-03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `naukowcy`
--

CREATE TABLE `naukowcy` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) DEFAULT NULL,
  `nazwisko` varchar(255) DEFAULT NULL,
  `specjalizacja` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postepy_projektow`
--

CREATE TABLE `postepy_projektow` (
  `id` int(11) NOT NULL,
  `projekt_id` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `zuzyte_zasoby` text DEFAULT NULL,
  `wyniki` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty`
--

CREATE TABLE `projekty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `cele` text DEFAULT NULL,
  `zasoby` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty_naukowcy`
--

CREATE TABLE `projekty_naukowcy` (
  `projekt_id` int(11) DEFAULT NULL,
  `naukowiec_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyniki_misji`
--

CREATE TABLE `wyniki_misji` (
  `id` int(11) NOT NULL,
  `misja_id` int(11) DEFAULT NULL,
  `odkrycia` text DEFAULT NULL,
  `zuzyte_zasoby` text DEFAULT NULL,
  `nazwa` text DEFAULT NULL,
  `data_zakonczenia` date DEFAULT NULL,
  `zdobyte_zasoby` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wyniki_misji`
--

INSERT INTO `wyniki_misji` (`id`, `misja_id`, `odkrycia`, `zuzyte_zasoby`, `nazwa`, `data_zakonczenia`, `zdobyte_zasoby`) VALUES
(1, NULL, 'zloza zelaza', 'woda, jedzenia', 'Mars', '2111-03-09', 'mineraly');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zasoby`
--

CREATE TABLE `zasoby` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zasoby`
--

INSERT INTO `zasoby` (`id`, `nazwa`, `ilosc`) VALUES
(3, 'Puszki', 4),
(4, 'Paliwo', 5),
(7, 'woda', 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zmiany_zasobow`
--

CREATE TABLE `zmiany_zasobow` (
  `id` int(11) NOT NULL,
  `id_zasobu` int(11) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `stara_ilosc` int(11) DEFAULT NULL,
  `nowa_ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zmiany_zasobow`
--

INSERT INTO `zmiany_zasobow` (`id`, `id_zasobu`, `data`, `stara_ilosc`, `nowa_ilosc`) VALUES
(1, 3, '2024-05-26 18:37:24', 3, 4),
(2, 4, '2024-05-26 18:37:28', 4, 5);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kontakty_cywilizacyjne`
--
ALTER TABLE `kontakty_cywilizacyjne`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `misje`
--
ALTER TABLE `misje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `naukowcy`
--
ALTER TABLE `naukowcy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `postepy_projektow`
--
ALTER TABLE `postepy_projektow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projekt_id` (`projekt_id`);

--
-- Indeksy dla tabeli `projekty`
--
ALTER TABLE `projekty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `projekty_naukowcy`
--
ALTER TABLE `projekty_naukowcy`
  ADD KEY `projekt_id` (`projekt_id`),
  ADD KEY `naukowiec_id` (`naukowiec_id`);

--
-- Indeksy dla tabeli `wyniki_misji`
--
ALTER TABLE `wyniki_misji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `misja_id` (`misja_id`);

--
-- Indeksy dla tabeli `zasoby`
--
ALTER TABLE `zasoby`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zmiany_zasobow`
--
ALTER TABLE `zmiany_zasobow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontakty_cywilizacyjne`
--
ALTER TABLE `kontakty_cywilizacyjne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `misje`
--
ALTER TABLE `misje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `naukowcy`
--
ALTER TABLE `naukowcy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postepy_projektow`
--
ALTER TABLE `postepy_projektow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projekty`
--
ALTER TABLE `projekty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wyniki_misji`
--
ALTER TABLE `wyniki_misji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zasoby`
--
ALTER TABLE `zasoby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `zmiany_zasobow`
--
ALTER TABLE `zmiany_zasobow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `postepy_projektow`
--
ALTER TABLE `postepy_projektow`
  ADD CONSTRAINT `postepy_projektow_ibfk_1` FOREIGN KEY (`projekt_id`) REFERENCES `projekty` (`id`);

--
-- Constraints for table `projekty_naukowcy`
--
ALTER TABLE `projekty_naukowcy`
  ADD CONSTRAINT `projekty_naukowcy_ibfk_1` FOREIGN KEY (`projekt_id`) REFERENCES `projekty` (`id`),
  ADD CONSTRAINT `projekty_naukowcy_ibfk_2` FOREIGN KEY (`naukowiec_id`) REFERENCES `naukowcy` (`id`);

--
-- Constraints for table `wyniki_misji`
--
ALTER TABLE `wyniki_misji`
  ADD CONSTRAINT `wyniki_misji_ibfk_1` FOREIGN KEY (`misja_id`) REFERENCES `misje` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
