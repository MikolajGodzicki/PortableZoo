-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 28, 2023 at 01:27 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portablezoo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kolory`
--

CREATE TABLE `kolory` (
  `ID_Koloru` int(11) NOT NULL,
  `Kolor` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `leki`
--

CREATE TABLE `leki` (
  `ID_Leku` int(11) NOT NULL,
  `Nazwa` varchar(256) NOT NULL,
  `Cena` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wizyty`
--

CREATE TABLE `wizyty` (
  `ID_Wizyty` int(11) NOT NULL,
  `ID_Zwierzaka` int(11) NOT NULL,
  `Kiedy` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wlasciciele`
--

CREATE TABLE `wlasciciele` (
  `ID_Wlasciciela` int(11) NOT NULL,
  `Nazwisko` varchar(256) NOT NULL,
  `Imie` varchar(256) NOT NULL,
  `Ulica` varchar(256) NOT NULL,
  `Miasto` varchar(256) NOT NULL,
  `Poczta` varchar(256) NOT NULL,
  `Telefon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wykonane_zabiegi`
--

CREATE TABLE `wykonane_zabiegi` (
  `ID_Operacji` int(11) NOT NULL,
  `ID_Zabiegu` int(11) NOT NULL,
  `ID_Wizyty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wykorzystane_leki`
--

CREATE TABLE `wykorzystane_leki` (
  `ID_Operacji` int(11) NOT NULL,
  `ID_Leku` int(11) NOT NULL,
  `ID_Wizyty` int(11) NOT NULL,
  `Ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zabiegi`
--

CREATE TABLE `zabiegi` (
  `ID_Uslugi` int(11) NOT NULL,
  `Nazwa` varchar(256) NOT NULL,
  `Cena` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zwierzeta`
--

CREATE TABLE `zwierzeta` (
  `ID_Zwierza` int(11) NOT NULL,
  `Rodzaj_zwierza` varchar(256) NOT NULL,
  `Imie` varchar(256) NOT NULL,
  `Data_urodzin` date NOT NULL,
  `ID_Koloru` int(11) NOT NULL,
  `ID_Wlasciciela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kolory`
--
ALTER TABLE `kolory`
  ADD PRIMARY KEY (`ID_Koloru`);

--
-- Indeksy dla tabeli `leki`
--
ALTER TABLE `leki`
  ADD PRIMARY KEY (`ID_Leku`);

--
-- Indeksy dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  ADD PRIMARY KEY (`ID_Wizyty`),
  ADD KEY `ID_Zwierzaka` (`ID_Zwierzaka`);

--
-- Indeksy dla tabeli `wlasciciele`
--
ALTER TABLE `wlasciciele`
  ADD PRIMARY KEY (`ID_Wlasciciela`);

--
-- Indeksy dla tabeli `wykonane_zabiegi`
--
ALTER TABLE `wykonane_zabiegi`
  ADD PRIMARY KEY (`ID_Operacji`),
  ADD KEY `ID_Zabiegu` (`ID_Zabiegu`),
  ADD KEY `ID_Wizyty` (`ID_Wizyty`);

--
-- Indeksy dla tabeli `wykorzystane_leki`
--
ALTER TABLE `wykorzystane_leki`
  ADD PRIMARY KEY (`ID_Operacji`),
  ADD KEY `ID_Leku` (`ID_Leku`),
  ADD KEY `ID_Wizyty` (`ID_Wizyty`);

--
-- Indeksy dla tabeli `zabiegi`
--
ALTER TABLE `zabiegi`
  ADD PRIMARY KEY (`ID_Uslugi`);

--
-- Indeksy dla tabeli `zwierzeta`
--
ALTER TABLE `zwierzeta`
  ADD PRIMARY KEY (`ID_Zwierza`),
  ADD KEY `ID_Koloru` (`ID_Koloru`),
  ADD KEY `ID_Wlasciciela` (`ID_Wlasciciela`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kolory`
--
ALTER TABLE `kolory`
  MODIFY `ID_Koloru` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leki`
--
ALTER TABLE `leki`
  MODIFY `ID_Leku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wizyty`
--
ALTER TABLE `wizyty`
  MODIFY `ID_Wizyty` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wlasciciele`
--
ALTER TABLE `wlasciciele`
  MODIFY `ID_Wlasciciela` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wykonane_zabiegi`
--
ALTER TABLE `wykonane_zabiegi`
  MODIFY `ID_Operacji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wykorzystane_leki`
--
ALTER TABLE `wykorzystane_leki`
  MODIFY `ID_Operacji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zabiegi`
--
ALTER TABLE `zabiegi`
  MODIFY `ID_Uslugi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zwierzeta`
--
ALTER TABLE `zwierzeta`
  MODIFY `ID_Zwierza` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wizyty`
--
ALTER TABLE `wizyty`
  ADD CONSTRAINT `wizyty_ibfk_1` FOREIGN KEY (`ID_Zwierzaka`) REFERENCES `zwierzeta` (`ID_Zwierza`);

--
-- Constraints for table `wykonane_zabiegi`
--
ALTER TABLE `wykonane_zabiegi`
  ADD CONSTRAINT `wykonane_zabiegi_ibfk_1` FOREIGN KEY (`ID_Zabiegu`) REFERENCES `zabiegi` (`ID_Uslugi`),
  ADD CONSTRAINT `wykonane_zabiegi_ibfk_2` FOREIGN KEY (`ID_Wizyty`) REFERENCES `wizyty` (`ID_Wizyty`);

--
-- Constraints for table `wykorzystane_leki`
--
ALTER TABLE `wykorzystane_leki`
  ADD CONSTRAINT `wykorzystane_leki_ibfk_1` FOREIGN KEY (`ID_Leku`) REFERENCES `leki` (`ID_Leku`),
  ADD CONSTRAINT `wykorzystane_leki_ibfk_2` FOREIGN KEY (`ID_Wizyty`) REFERENCES `wizyty` (`ID_Wizyty`);

--
-- Constraints for table `zwierzeta`
--
ALTER TABLE `zwierzeta`
  ADD CONSTRAINT `zwierzeta_ibfk_1` FOREIGN KEY (`ID_Koloru`) REFERENCES `kolory` (`ID_Koloru`),
  ADD CONSTRAINT `zwierzeta_ibfk_2` FOREIGN KEY (`ID_Wlasciciela`) REFERENCES `wlasciciele` (`ID_Wlasciciela`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
