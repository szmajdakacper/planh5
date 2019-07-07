-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Cze 2019, 14:52
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `planh5`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aufenthalt`
--

CREATE TABLE `aufenthalt` (
  `nrzim` varchar(3) NOT NULL,
  `anreise` date NOT NULL,
  `abreise` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bw`
--

CREATE TABLE `bw` (
  `nrzim` varchar(3) NOT NULL,
  `bw_wechsel` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ht`
--

CREATE TABLE `ht` (
  `nrzim` varchar(3) NOT NULL,
  `ht_wechsel` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zimmern`
--

CREATE TABLE `zimmern` (
  `nrzim` varchar(3) NOT NULL,
  `station` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `zimmern`
--

INSERT INTO `zimmern` (`nrzim`, `station`) VALUES
('001', 1),
('002', 1),
('003', 1),
('006', 1),
('007', 1),
('008', 1),
('070', 1),
('071', 1),
('072', 1),
('073', 1),
('074', 1),
('076', 1),
('077', 1),
('078', 1),
('079', 1),
('080', 1),
('101', 2),
('102', 2),
('103', 2),
('104', 2),
('106', 2),
('107', 2),
('108', 2),
('109', 2),
('110', 2),
('111', 2),
('112', 2),
('113', 2),
('114', 2),
('115', 2),
('116', 2),
('117', 2),
('118', 2),
('119', 3),
('120', 3),
('121', 3),
('122', 3),
('123', 3),
('124', 3),
('125', 3),
('126', 3),
('127', 3),
('128', 3),
('129', 2),
('130', 2),
('131', 2),
('201', 4),
('202', 4),
('203', 4),
('204', 4),
('205', 4),
('206', 4),
('207', 4),
('208', 4),
('209', 4),
('210', 4),
('211', 4),
('212', 4),
('213', 4),
('214', 4),
('215', 4),
('216', 4),
('217', 4),
('218', 4),
('219', 3),
('220', 3),
('221', 3),
('222', 3),
('223', 3),
('224', 3),
('225', 3),
('226', 3),
('227', 3),
('228', 3),
('229', 4),
('230', 4),
('231', 4),
('251', 5),
('252', 5),
('253', 5),
('254', 5),
('255', 5),
('256', 5),
('257', 5),
('258', 5),
('259', 5),
('260', 5),
('261', 5),
('262', 5),
('263', 5),
('264', 5),
('265', 5),
('266', 5),
('267', 5),
('270', 5),
('271', 5),
('272', 5),
('273', 5),
('274', 5),
('277', 5),
('278', 1),
('279', 1),
('280', 1),
('301', 6),
('302', 6),
('303', 6),
('304', 6),
('305', 6),
('306', 6),
('307', 6),
('308', 6),
('309', 6),
('310', 6),
('311', 6),
('312', 6),
('313', 6),
('314', 6),
('315', 6),
('316', 6),
('151', 7),
('152', 7),
('153', 7),
('154', 7),
('155', 7),
('156', 7),
('157', 7),
('158', 7),
('159', 7),
('160', 7),
('161', 7),
('162', 7),
('163', 7),
('164', 7),
('165', 7);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indeksy dla tabeli `zimmern`
--
ALTER TABLE `zimmern`
  ADD PRIMARY KEY (`nrzim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
