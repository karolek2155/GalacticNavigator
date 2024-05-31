-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 30, 2024 at 03:25 PM
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
-- Struktura tabeli dla tabeli `handel`
--

CREATE TABLE `handel` (
  `id` int(11) NOT NULL,
  `zasob` varchar(255) NOT NULL,
  `akcja` enum('kupno','sprzedaz') NOT NULL,
  `ilosc` int(11) NOT NULL,
  `data_transakcji` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `handel`
--

INSERT INTO `handel` (`id`, `zasob`, `akcja`, `ilosc`, `data_transakcji`) VALUES
(1, 'Tytan', 'kupno', 10, '2024-05-29 17:47:09'),
(2, 'Hel', 'sprzedaz', 20, '2024-05-29 17:47:09'),
(3, 'Metale rzadkie', 'kupno', 50, '2024-05-29 17:47:09'),
(4, 'Energia słoneczna', 'sprzedaz', 100, '2024-05-29 17:47:09');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kolonie`
--

CREATE TABLE `kolonie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kolonie`
--

INSERT INTO `kolonie` (`id`, `nazwa`) VALUES
(1, 'Kolonia 1'),
(2, 'Kolonia 2'),
(3, 'Kolonia 3'),
(4, 'Kolonia 4'),
(5, 'Kolonia 5'),
(6, 'Kolonia 6');

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

--
-- Dumping data for table `kontakty_cywilizacyjne`
--

INSERT INTO `kontakty_cywilizacyjne` (`id`, `cywilizacja`, `kultura`, `technologia`, `polityka`, `interakcje`, `planeta`) VALUES
(1, 'Cywilizacja Alfa', 'Racjonalna', 'Zaawansowana', 'Neutralna', 'Handel, wymiana naukowa', 'Planeta Alfa'),
(2, 'Alianci Galaktyczni', 'Dyplomatyczna', 'Zaawansowana', 'Sojusz', 'Dyplomacja, Handel', 'Stolica Galaktyki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `magazyn`
--

CREATE TABLE `magazyn` (
  `id` int(11) NOT NULL,
  `produkt` varchar(255) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `magazyn`
--

INSERT INTO `magazyn` (`id`, `produkt`, `ilosc`, `data_dodania`) VALUES
(1, 'Buty', 10, '2024-05-29 17:47:09'),
(2, 'Miecz', 5, '2024-05-29 17:47:09'),
(3, 'Kombinezon kosmiczny', 20, '2024-05-29 17:47:09'),
(4, 'Kosmiczny statek transportowy', 5, '2024-05-29 17:47:09'),
(5, 'Komputery kwantowe', 10, '2024-05-29 17:47:09'),
(6, 'Materiały do budowy kolonii', 1000, '2024-05-29 17:47:09');

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
  `data_zakonczenia` date DEFAULT NULL,
  `grafika` varchar(20) DEFAULT NULL,
  `nazwa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `misje`
--

INSERT INTO `misje` (`id`, `cel`, `zaloga`, `zasoby`, `data_startu`, `data_zakonczenia`, `grafika`, `nazwa`) VALUES
(8, 'Zbadanie planety X', '5 astronautów', 'Kombinezony kosmiczne, Żywność, Sprzęt badawczy', '2024-06-01', '2024-12-01', 'planeta1.jpg', NULL),
(9, 'Kolonizacja planety Y', '100 osadników', 'Zasoby życiowe, Materiały budowlane', '2024-09-01', '2025-12-01', 'planeta2.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `naukowcy`
--

CREATE TABLE `naukowcy` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `specjalizacja` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `naukowcy`
--

INSERT INTO `naukowcy` (`id`, `imie`, `nazwisko`, `specjalizacja`) VALUES
(1, 'Jan', 'Kowalski', 'Astrobiolog'),
(2, 'Anna', 'Nowak', 'Inżynier kosmiczny'),
(3, 'Adam', 'Wiśniewski', 'Ekonomiczny'),
(4, 'Ewa', 'Lis', 'Biolog molekularny'),
(5, 'Piotr', 'Szymański', 'Inżynier mechaniczny'),
(6, 'Magdalena', 'Krawczyk', 'Ekonomistka kosmiczna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postepy`
--

CREATE TABLE `postepy` (
  `id` int(11) NOT NULL,
  `projekt_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkcja`
--

CREATE TABLE `produkcja` (
  `id` int(11) NOT NULL,
  `produkt` varchar(255) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkcja`
--

INSERT INTO `produkcja` (`id`, `produkt`, `ilosc`, `data_dodania`) VALUES
(2, 'Materiały budowlane', 100, '2024-05-29 17:47:09'),
(3, 'Energia słoneczna', 50, '2024-05-29 17:47:09'),
(4, 'Żywność hodowlana', 500, '2024-05-29 17:47:09'),
(5, 'Leki', 200, '2024-05-29 17:47:09');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty_badawcze`
--

CREATE TABLE `projekty_badawcze` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `cel` text NOT NULL,
  `zasoby_potrzebne` text NOT NULL,
  `harmonogram` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projekty_badawcze`
--

INSERT INTO `projekty_badawcze` (`id`, `nazwa`, `cel`, `zasoby_potrzebne`, `harmonogram`) VALUES
(1, 'Badanie życia pozaziemskiego', 'Zbieranie próbek z planet', 'Statek kosmiczny, Drony badawcze', '6 miesięcy'),
(2, 'Mapowanie galaktyki', 'Przeanalizowanie struktury i składu galaktyk', 'Teleskopy kosmiczne, Superkomputery', '1 rok');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przypisania`
--

CREATE TABLE `przypisania` (
  `id` int(11) NOT NULL,
  `projekt_id` int(11) NOT NULL,
  `naukowiec_id` int(11) NOT NULL,
  `zasob` varchar(255) NOT NULL,
  `ilosc` int(11) NOT NULL
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
(1, 'Woda', 100),
(2, 'Jedzenie', 100),
(3, 'Tytan', 50),
(4, 'Hel', 50),
(5, 'Metale rzadkie', 70),
(6, 'Energia słoneczna', 200),
(7, 'Tlen', 150),
(8, 'Materiały budowlane', 300);

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
(1, 5, '2024-05-29 17:56:34', 30, 40),
(2, 4, '2024-05-29 17:56:42', 50, 30),
(3, 4, '2024-05-29 17:56:58', 30, 50),
(4, 5, '2024-05-29 17:57:08', 40, 70);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `handel`
--
ALTER TABLE `handel`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kolonie`
--
ALTER TABLE `kolonie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazwa` (`nazwa`);

--
-- Indeksy dla tabeli `kontakty_cywilizacyjne`
--
ALTER TABLE `kontakty_cywilizacyjne`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `magazyn`
--
ALTER TABLE `magazyn`
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
-- Indeksy dla tabeli `postepy`
--
ALTER TABLE `postepy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projekt_id` (`projekt_id`);

--
-- Indeksy dla tabeli `produkcja`
--
ALTER TABLE `produkcja`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `projekty_badawcze`
--
ALTER TABLE `projekty_badawcze`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `przypisania`
--
ALTER TABLE `przypisania`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT for table `handel`
--
ALTER TABLE `handel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kolonie`
--
ALTER TABLE `kolonie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kontakty_cywilizacyjne`
--
ALTER TABLE `kontakty_cywilizacyjne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `magazyn`
--
ALTER TABLE `magazyn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `misje`
--
ALTER TABLE `misje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `naukowcy`
--
ALTER TABLE `naukowcy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `postepy`
--
ALTER TABLE `postepy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produkcja`
--
ALTER TABLE `produkcja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projekty_badawcze`
--
ALTER TABLE `projekty_badawcze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `przypisania`
--
ALTER TABLE `przypisania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wyniki_misji`
--
ALTER TABLE `wyniki_misji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zasoby`
--
ALTER TABLE `zasoby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zmiany_zasobow`
--
ALTER TABLE `zmiany_zasobow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `postepy`
--
ALTER TABLE `postepy`
  ADD CONSTRAINT `postepy_ibfk_1` FOREIGN KEY (`projekt_id`) REFERENCES `projekty_badawcze` (`id`);

--
-- Constraints for table `przypisania`
--
ALTER TABLE `przypisania`
  ADD CONSTRAINT `przypisania_ibfk_1` FOREIGN KEY (`projekt_id`) REFERENCES `projekty_badawcze` (`id`),
  ADD CONSTRAINT `przypisania_ibfk_2` FOREIGN KEY (`naukowiec_id`) REFERENCES `naukowcy` (`id`);

--
-- Constraints for table `wyniki_misji`
--
ALTER TABLE `wyniki_misji`
  ADD CONSTRAINT `fk_misja_id` FOREIGN KEY (`misja_id`) REFERENCES `misje` (`id`),
  ADD CONSTRAINT `wyniki_misji_ibfk_1` FOREIGN KEY (`misja_id`) REFERENCES `misje` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
