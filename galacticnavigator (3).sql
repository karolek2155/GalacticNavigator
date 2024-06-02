-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 02, 2024 at 03:59 PM
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
-- Struktura tabeli dla tabeli `dyplomacja`
--

CREATE TABLE `dyplomacja` (
  `cywilizacja` text NOT NULL,
  `akcja_dyplomatyczna` text NOT NULL,
  `szczegoly_akcji` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dyplomacja`
--

INSERT INTO `dyplomacja` (`cywilizacja`, `akcja_dyplomatyczna`, `szczegoly_akcji`) VALUES
('1', 'alliance', '1'),
('1', 'alliance', '1'),
('1', 'alliance', '1'),
('Zvornianie', 'sojusz', 'Zvornianie zaproponowali sojusz z naszą cywilizacją, oferując wspólną obronę oraz wymianę kulturalną i naukową.'),
('Xylophar', 'traktat handlowy', ' Xylopharowie zgodzili się na podpisanie traktatu handlowego, umożliwiającego wymianę surowców i technologii między naszymi cywilizacjami'),
('Solareanin', 'delkaracja wojny', 'Solareaninowie ogłosili wojnę naszej cywilizacji, motywując to próbą przejęcia kontroli nad jednym z naszych zasobów naturalnych.'),
('Harmonii', 'sojusz', 'Harmonijczycy zaproponowali układ pokojowy, w którym zobowiązują się do zachowania neutralności i współpracy w celu ochrony środowiska naturalnego.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `handel`
--

CREATE TABLE `handel` (
  `id` int(11) NOT NULL,
  `zasoby_id` int(11) NOT NULL,
  `akcja` enum('kupno','sprzedaz') NOT NULL,
  `ilosc` int(11) NOT NULL,
  `data_transakcji` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `handel`
--

INSERT INTO `handel` (`id`, `zasoby_id`, `akcja`, `ilosc`, `data_transakcji`) VALUES
(5, 1, 'kupno', 50, '2024-05-31 10:00:00'),
(6, 2, 'sprzedaz', 30, '2024-05-30 08:30:00'),
(7, 3, 'kupno', 20, '2024-05-29 13:45:00'),
(8, 4, 'sprzedaz', 10, '2024-05-28 07:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kolonie`
--

CREATE TABLE `kolonie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `sektor` varchar(45) NOT NULL,
  `zasoby_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kolonie`
--

INSERT INTO `kolonie` (`id`, `nazwa`, `sektor`, `zasoby_id`) VALUES
(1, 'Gwiezdne Imperium Eridani', 'Beta Sektor', 1),
(2, 'Nowa Terra Nova', 'Gamma Sektor', 2),
(3, 'Kolonialna Federacja Auriga', 'Delta Sektor', 3),
(4, 'Pionierska Osada Andromeda', 'Alfa Sektor', 5),
(5, 'Złota Galaktyczna Kraina', 'Theta Sektor', 5),
(6, 'Kosmiczna Republika Centaurus', 'Omega Sektor', 6),
(7, 'Sfera Eksploracji Cassiopeia', 'Zeta Sektor', 7),
(8, 'Płomień Feniksa', 'Epsilon Sektor', 8),
(9, 'Droga Mleczna Alliance', 'Iota Sektor', 4),
(10, 'Przestrzeń Pionierska Proxima', 'Ksi Sektor', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakty_cywilizacyjne`
--

CREATE TABLE `kontakty_cywilizacyjne` (
  `id` int(11) NOT NULL,
  `cywilizacja` varchar(255) DEFAULT NULL,
  `kultura` text DEFAULT NULL,
  `technologia` text DEFAULT NULL,
  `nastawienie` int(11) DEFAULT NULL,
  `interakcje` text DEFAULT NULL,
  `planeta` text NOT NULL,
  `grafika` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontakty_cywilizacyjne`
--

INSERT INTO `kontakty_cywilizacyjne` (`id`, `cywilizacja`, `kultura`, `technologia`, `nastawienie`, `interakcje`, `planeta`, `grafika`) VALUES
(3, 'Zvornianie', 'Zvornianie są znani ze swojej wysokiej wartości sztuki i muzyki. Mają bogatą tradycję kulinarną.', ' Zvornianie mają zaawansowane technologie medyczne i energetyczne.', 8, 'Pokojowe, wymiana kulturalna', 'Zvornia Prime, planeta o zróżnicowanej florze i faunie.', 'alien2.jpg'),
(4, 'Xylophar', 'Xylopharowie to cywilizacja handlowców, którzy cenią sobie wolność i niezależność.', 'Posiadają zaawansowane technologie transportowe i telekomunikacyjne.', 5, 'Neutralne, handel', 'Xylophara IV, pokryta lasami i bogata w surowce naturalne.', 'alien1.jpg'),
(5, 'Solareanin', 'Solareaninowie są militarystyczną cywilizacją, której głównym celem jest ekspansja terytorialna.', 'Posiadają zaawansowane technologie wojskowe i budowlane.', 2, ' Agresywne, zdominowanie', 'Solareania, świat o dużej ilości surowców naturalnych, ale także surowe warunki klimatyczne.', 'alien3.jpg'),
(6, 'Harmonii', 'Harmonijczycy są znani z harmonii społecznej i ekologicznej. Ich życie oparte jest na równowadze z naturą.', 'Zaawansowane technologie ekologiczne i medyczne.', 9, 'Pokojowe, wymiana technologiczna', 'Harmonia Prime, planeta o bogatej florze i faunie, z wysokim poziomem ochrony środowiska.', 'alien4.jpg');

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
(8, 'Zbadanie planety X', '5 astronautów', 'Kombinezony kosmiczne, Żywność, Sprzęt badawczy', '2024-06-01', '2024-12-01', 'planeta1.jpg', 'Odyseja alfa'),
(9, 'Kolonizacja planety Y', '100 osadników', 'Zasoby życiowe, Materiały budowlane', '2024-09-01', '2025-12-01', 'planeta2.jpg', 'Nowy dom'),
(10, 'Badanie kosmicznych minerałów', '4 astronautów, 3 geologów', '400 jednostek paliwa, 250 jednostek żywności, 150 jednostek tlenu, 50 jednostek narzędzi badawczych', '2024-06-07', '2033-06-08', 'planet3.jpg', 'Kosmiczne poszukiwania'),
(11, 'Poszukiwanie nowych źródeł energii', '6 astronautów, 2 inżynierów', ' 600 jednostek paliwa, 350 jednostek żywności, 250 jednostek tlenu, 100 jednostek sprzętu technicznego', '2024-06-20', '2029-05-11', 'planet4.jpg', 'Energia Przyszłości'),
(12, 'Badanie anomalii grawitacyjnych', '5 astronautów, 3 fizyków', ' 450 jednostek paliwa, 300 jednostek żywności, 200 jednostek tlenu, 75 jednostek sprzętu badawczego', '2024-06-15', '2137-04-02', 'planet6.jpg', 'Grawitacyjne Zagadki'),
(13, 'Badanie anomalii grawitacyjnych', '5 astronautów, 3 fizyków', ' 450 jednostek paliwa, 300 jednostek żywności, 200 jednostek tlenu, 75 jednostek sprzętu badawczego', '2024-06-15', '2137-04-02', 'planet6', 'Grawitacyjne Zagadki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `monitorowanie`
--

CREATE TABLE `monitorowanie` (
  `id` int(11) NOT NULL,
  `projekt_id` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `postep` text NOT NULL,
  `wyniki` text NOT NULL,
  `postep_nowy` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monitorowanie`
--

INSERT INTO `monitorowanie` (`id`, `projekt_id`, `data`, `postep`, `wyniki`, `postep_nowy`) VALUES
(3, 1, '2024-05-01', 'Analiza danych z sond kosmicznych', 'Odkrycie nowych planet', 20.50),
(4, 1, '2024-06-01', 'Przygotowanie nowych technologii obserwacyjnych', 'Mapa galaktyki', 45.70),
(5, 1, '2024-07-01', 'Badanie składu chemicznego gwiazd', 'Wnioski z badań', 65.30),
(6, 1, '2024-08-01', 'Analiza statystyczna danych', 'Raport końcowy', 90.20),
(7, 1, '2024-09-01', 'Publikacja wyników badań', 'Publikacje naukowe', 100.00),
(8, 2, '2024-05-01', 'Analiza danych z misji kosmicznych', 'Odkrycie pierwszych śladów życia', 10.20),
(9, 2, '2024-06-01', 'Próby hodowlane mikroorganizmów w warunkach kosmicznych', 'Wstępne wyniki', 30.80),
(10, 2, '2024-07-01', 'Badania nad adaptacją do warunków przestrzeni kosmicznej', 'Testy na modelach organizmów', 55.60),
(11, 2, '2024-08-01', 'Analiza materiałów z próbek planetarnych', 'Raport pośredni', 70.30),
(12, 2, '2024-09-01', 'Badania nad wykorzystaniem mikrograwitacji w rolnictwie', 'Przygotowanie publikacji', 85.90),
(13, 2, '2024-10-01', 'Publikacja wyników badań', 'Artykuły naukowe', 100.00);

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
(1, 'Badanie życia pozaziemskiego', 'Zbieranie próbek z planet', 'Statek kosmiczny, Drony badawcze', '7 miesięcy'),
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

--
-- Dumping data for table `przypisania`
--

INSERT INTO `przypisania` (`id`, `projekt_id`, `naukowiec_id`, `zasob`, `ilosc`) VALUES
(1, 1, 1, 'Tlen', 6),
(2, 1, 1, 'Woda', 7),
(3, 2, 4, 'Jedzenie', 10),
(4, 1, 6, 'Materiały budowlane', 56);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyniki_misji`
--

CREATE TABLE `wyniki_misji` (
  `id` int(11) NOT NULL,
  `odkrycia` text DEFAULT NULL,
  `zuzyte_zasoby` text DEFAULT NULL,
  `nazwa` text DEFAULT NULL,
  `data_zakonczenia` date DEFAULT NULL,
  `zdobyte_zasoby` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wyniki_misji`
--

INSERT INTO `wyniki_misji` (`id`, `odkrycia`, `zuzyte_zasoby`, `nazwa`, `data_zakonczenia`, `zdobyte_zasoby`) VALUES
(1, 'naleziono nową planetę klasy M, nadającą się do kolonizacji. Odkryto też ślady prostych form życia.', '500 jednostek paliwa 300 jednostek żywności 200 jednostek tlenu', 'Planeta Solaris', '2024-05-17', '100 jednostek rzadkich minerałów 50 jednostek'),
(2, 'Zidentyfikowano duże złoża platyny i irydu na asteroidy w pasie asteroidów.', '400 jednostek paliwa 250 jednostek żywności 150 jednostek tlenu 50 jednostek narzędzi badawczych', 'Asteroidowa Ekspedycja', '2024-05-25', '200 jednostek platyny 150 jednostek irydu'),
(3, 'Znaleziono nowe, wydajne źródło energii na planecie gazowej.', '600 jednostek paliwa 350 jednostek żywności 250 jednostek tlenu 100 jednostek sprzętu technicznego', 'Energetyczny Skok', '2024-04-05', '500 jednostek nowego źródła energii'),
(4, ' Nawiązano kontakt z pokojową cywilizacją, wymieniono technologie i zasoby.', '500 jednostek paliwa 300 jednostek żywności 200 jednostek tlenu 50 jednostek materiałów dyplomatycznych', 'Sojusz Gwiezdny', '2024-06-01', '200 jednostek zaawansowanej technologii 100 j'),
(5, 'Zbadano anomalię grawitacyjną, odkryto nowy rodzaj energii ciemnej.', '450 jednostek paliwa 300 jednostek żywności 200 jednostek tlenu 75 jednostek sprzętu badawczego', 'Ciemna Materia', '2024-05-17', '50 jednostek energii ciemnej 100 jednostek da');

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
(1, 'Woda', 150),
(2, 'Jedzenie', 90),
(3, 'Tytan', 43),
(4, 'Hel', 70),
(5, 'Metale rzadkie', 70),
(6, 'Energia słoneczna', 180),
(7, 'Tlen', 160),
(8, 'Materiały budowlane', 244);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zmiany_postepu`
--

CREATE TABLE `zmiany_postepu` (
  `id` int(11) NOT NULL,
  `id_monitorowania` int(11) NOT NULL,
  `stary_postep` text NOT NULL,
  `nowy_postep` text NOT NULL,
  `stare_wyniki` text NOT NULL,
  `nowe_wyniki` text NOT NULL,
  `data_zmiany` timestamp NOT NULL DEFAULT current_timestamp(),
  `projekt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zmiany_postepu`
--

INSERT INTO `zmiany_postepu` (`id`, `id_monitorowania`, `stary_postep`, `nowy_postep`, `stare_wyniki`, `nowe_wyniki`, `data_zmiany`, `projekt_id`) VALUES
(16, 8, '0', '10.2', 'Brak danych', 'Odkrycie pierwszych śladów życia', '2024-04-30 22:00:00', 1),
(17, 9, '10.2', '30.8', 'Odkrycie pierwszych śladów życia', 'Wstępne wyniki', '2024-05-31 22:00:00', 1),
(18, 10, '30.8', '55.6', 'Wstępne wyniki', 'Testy na modelach organizmów', '2024-06-30 22:00:00', 1),
(19, 11, '55.6', '70.3', 'Testy na modelach organizmów', 'Raport pośredni', '2024-07-31 22:00:00', 1),
(20, 12, '70.3', '85.9', 'Raport pośredni', 'Przygotowanie publikacji', '2024-08-31 22:00:00', 1),
(21, 13, '85.9', '100.0', 'Przygotowanie publikacji', 'Artykuły naukowe', '2024-09-30 22:00:00', 1),
(22, 3, '0', '20.5', 'Brak danych', 'Odkrycie nowych planet', '2024-04-30 22:00:00', 2),
(23, 4, '20.5', '45.7', 'Odkrycie nowych planet', 'Mapa galaktyki', '2024-05-31 22:00:00', 2),
(24, 5, '45.7', '65.3', 'Mapa galaktyki', 'Wnioski z badań', '2024-06-30 22:00:00', 2),
(25, 6, '65.3', '90.2', 'Wnioski z badań', 'Raport końcowy', '2024-07-31 22:00:00', 2),
(26, 7, '90.2', '100.0', 'Raport końcowy', 'Publikacje naukowe', '2024-08-31 22:00:00', 2);

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
(4, 5, '2024-05-29 17:57:08', 40, 70),
(5, 7, '2024-05-31 14:39:14', 150, 180),
(6, 6, '2024-05-31 14:39:22', 200, 170),
(7, 1, '2024-05-31 14:39:29', 94, 129),
(8, 6, '2024-05-31 14:46:00', 170, 180),
(9, 4, '2024-05-31 14:46:13', 50, 70),
(10, 7, '2024-05-31 15:10:21', 180, 160),
(11, 1, '2024-05-31 15:10:34', 129, 150);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `handel`
--
ALTER TABLE `handel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_zasoby_handel` (`zasoby_id`);

--
-- Indeksy dla tabeli `kolonie`
--
ALTER TABLE `kolonie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazwa` (`nazwa`),
  ADD KEY `fk_zasoby_id` (`zasoby_id`);

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
-- Indeksy dla tabeli `monitorowanie`
--
ALTER TABLE `monitorowanie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projekt_id` (`projekt_id`);

--
-- Indeksy dla tabeli `naukowcy`
--
ALTER TABLE `naukowcy`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zasoby`
--
ALTER TABLE `zasoby`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zmiany_postepu`
--
ALTER TABLE `zmiany_postepu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_monitorowania` (`id_monitorowania`),
  ADD KEY `projekt_id` (`projekt_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kolonie`
--
ALTER TABLE `kolonie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `kontakty_cywilizacyjne`
--
ALTER TABLE `kontakty_cywilizacyjne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `magazyn`
--
ALTER TABLE `magazyn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `misje`
--
ALTER TABLE `misje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `monitorowanie`
--
ALTER TABLE `monitorowanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `naukowcy`
--
ALTER TABLE `naukowcy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wyniki_misji`
--
ALTER TABLE `wyniki_misji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zasoby`
--
ALTER TABLE `zasoby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zmiany_postepu`
--
ALTER TABLE `zmiany_postepu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `zmiany_zasobow`
--
ALTER TABLE `zmiany_zasobow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `handel`
--
ALTER TABLE `handel`
  ADD CONSTRAINT `fk_zasoby_handel` FOREIGN KEY (`zasoby_id`) REFERENCES `zasoby` (`id`);

--
-- Constraints for table `kolonie`
--
ALTER TABLE `kolonie`
  ADD CONSTRAINT `fk_zasoby_id` FOREIGN KEY (`zasoby_id`) REFERENCES `zasoby` (`id`);

--
-- Constraints for table `monitorowanie`
--
ALTER TABLE `monitorowanie`
  ADD CONSTRAINT `monitorowanie_ibfk_1` FOREIGN KEY (`projekt_id`) REFERENCES `projekty_badawcze` (`id`);

--
-- Constraints for table `przypisania`
--
ALTER TABLE `przypisania`
  ADD CONSTRAINT `przypisania_ibfk_1` FOREIGN KEY (`projekt_id`) REFERENCES `projekty_badawcze` (`id`),
  ADD CONSTRAINT `przypisania_ibfk_2` FOREIGN KEY (`naukowiec_id`) REFERENCES `naukowcy` (`id`);

--
-- Constraints for table `zmiany_postepu`
--
ALTER TABLE `zmiany_postepu`
  ADD CONSTRAINT `zmiany_postepu_ibfk_1` FOREIGN KEY (`id_monitorowania`) REFERENCES `monitorowanie` (`id`),
  ADD CONSTRAINT `zmiany_postepu_ibfk_2` FOREIGN KEY (`projekt_id`) REFERENCES `projekty_badawcze` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
