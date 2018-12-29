-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 29. pro 2018, 18:28
-- Verze serveru: 10.1.36-MariaDB
-- Verze PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `ourcis`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `root_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lft` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `grouper` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `grouper` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `type`
--

INSERT INTO `type` (`id`, `name`, `code`, `grouper`, `description`) VALUES
(1, '', 'ELDK', '', ''),
(2, '', 'ELDP', '', ''),
(3, 'Ovladač, Přijímač, Anténa', 'ELDV', '', ''),
(4, 'Frekvenční měniče a nezbytné doplňky (Pojistky, Brzdný odpor, Be', 'ELFM', '', ''),
(5, 'Elektroprim - Koutník', 'ELIC', '', ''),
(6, 'Napájecí kabel, Kabely VN, Silové kabely NN, Snímačové kabely, K', 'ELKA', '', ''),
(7, 'Kompletní klimatizační zařízení elektrické rozvody, Strojovny, P', 'ELKL', '', ''),
(8, 'Samostatné kondenzátory nebo kompletní kompenzační rozvaděč s re', 'ELKO', '', ''),
(9, 'Prvky kamerového systému (Kamery, Kvadrátory, Monitory, Dekodéry', 'ELKS', '', ''),
(10, 'Příslušenství pro montáž kabelů (háky, Ucpávky, Vývodky, Rošty, ', 'ELKT', '', ''),
(11, 'Specifikace samostatně kupovaných motorů (nejsou součástí nějaké', 'ELMO', '', ''),
(12, '', 'ELMT', '', ''),
(13, '', 'ELND', '', ''),
(14, 'Kompletní samostatně stojící rozvaděče, Nástenní rozvodní skříně', 'ELNN', '', ''),
(15, 'Reflektory pro osvětlení pracovního prostoru, technologických čá', 'ELOS', '', ''),
(16, 'Ostatní specifické dodávky, Vytápění svodek', 'ELOZ', '', ''),
(17, '', 'ELPM', '', ''),
(18, 'Stavební část rozvodny včetně pomocných systémů, nespecifikovaný', 'ELRO', '', ''),
(19, 'Dodávka SW a HW, Dodávka návodů, Dodávky licencí, HW (PLC, HMI, ', 'ELRS', '', ''),
(20, '', 'ELSE', '', ''),
(21, '', 'ELSI', '', ''),
(22, 'Snímače fyzikálních veličin a analogovým, binárním nebo komunika', 'ELSN', '', ''),
(23, '', 'ELSP', '', ''),
(24, 'Výkonový transformátor VN / NN pro technologii a pro osvětlení, ', 'ELTR', '', ''),
(25, 'Kompletní rozvaděče VN včetně silových prvků, Ochran, Řízení, Ko', 'ELVN', '', ''),
(26, 'Bezpečnostní tlačítkové vypínače, Lankové vypínače, Údržbové vyp', 'ELVY', '', ''),
(27, '', 'ELZP', '', ''),
(28, '', 'ELZR', '', ''),
(29, 'Rozvaděč se staničními akumulátory, nebo diesel-generátor (malá ', 'ELZZ', '', ''),
(30, 'Samostatně uvažované kolejnice, Válcované profily v běžných metr', 'OKHM', '', ''),
(31, 'Ocelové prvky, které se nepodaří zařadit jinam, používání výjime', 'OKOS', '', ''),
(32, 'Pororošty', 'OKRO', '', ''),
(33, 'Podle ČSN 73 2601 výrobní skupina A, Aa, Ba, Podle ČSN EN 1090-2', 'OKS1', '', ''),
(34, 'Podle ČSN 73 2601 výrobní skupina B, Podle ČSN EN 1090-2 třída p', 'OKS2', '', ''),
(35, 'Podle ČSN 73 2601 výrobní skupina C, Podle ČSN EN 1090-2 třída p', 'OKS3', '', ''),
(36, 'Gumy, Napínání pasu, Těsnění', 'OSDP', '', ''),
(37, '', 'OSNA', '', ''),
(38, '', 'OSOB', '', ''),
(39, 'Výstražní a informační tabulky, Štítek stroje, Štítky el. zaříze', 'OSTS', '', ''),
(40, '', 'OSZB', '', ''),
(41, '', 'OSZO', '', ''),
(42, '', 'OSZS', '', ''),
(43, 'Betonové základy, Základy pro střední díly dopravníků, Betonová ', 'SABE', '', ''),
(44, 'Kolejnice, Připojovací části kolejnic', 'SAKD', '', ''),
(45, 'Tenkostěnné', 'SAOP', '', ''),
(46, '', 'SAOS', '', ''),
(47, '', 'SAZA', '', ''),
(48, 'Samostatné brzdy, dodávané kompletně od dodavatele. Součást brzd', 'STBR', '', ''),
(49, 'Sestava bubnu včetně pogumování či keramické obšívky', 'STBU', '', ''),
(50, 'Hydraulické válce bez čepů a spojovacího materiálu', 'STHV', '', ''),
(51, 'Ložiska a ložiskové domky', 'STLO', '', ''),
(52, 'Komplet', 'STMA', '', ''),
(53, 'Pera, Normalizované čepy, Vysokopevnostní šrouby, Jemné závity', 'STNO', '', ''),
(54, 'Čepy, Uložení pro ložiska, Kluzná ložiska, Pouzdra, Velkorozměro', 'STO1', '', ''),
(55, 'Čepy, Uložení pro ložiska, Kluzná ložiska, Pouzdra, Vodící lišty', 'STO2', '', ''),
(56, 'Zbytek kde nezáleží na přesnosti, Obyč. obrábené plochy, Drážka,', 'STO3', '', ''),
(57, '', 'STOD', '', ''),
(58, '', 'STOS', '', ''),
(59, 'Celá sestava pohonu (převodovka, brzda, spojka, motor a rám), Př', 'STPO', '', ''),
(60, 'Převodovky + Reakční ramena, Příruby a jiné součásti převodovek ', 'STPR', '', ''),
(61, 'Šrouby, Matice, Podložky, Prakticky celé obsahové centrum', 'STSM', '', ''),
(62, 'Samostatné spojky dodávané kompletně od dodavatele', 'STSP', '', ''),
(63, 'Stěrače kompletně dodávané dodavatelem', 'STST', '', ''),
(64, 'Nakupované válečky a menší převáděcí bubny', 'STVA', '', ''),
(65, '', 'STVY', '', ''),
(66, '', 'SUDR', '', ''),
(67, '', 'SUHY', '', ''),
(68, '', 'SUKA', '', ''),
(69, 'SHZ - Stabilní hasící zařízení, MHS - Mobilní hasící zařízení, E', 'SUOS', '', ''),
(70, '', 'SUPD', '', ''),
(71, 'Centrální mazací systém', 'SUSM', '', ''),
(72, 'Koreček, Řetěz, Článek řetězu, Sestava zubu', 'SUTO', '', ''),
(73, '', 'PRDP', '', ''),
(74, '', 'PRMZ', '', ''),
(75, '', 'PRNP', '', ''),
(76, '', 'PRNT', '', ''),
(77, 'PLC včetně montáže, Oživení, Odzkoušení, Opravy dokumentace, Ele', 'PROI', '', ''),
(78, '', 'PRSR', '', ''),
(79, 'Cestovné, Právní poradenství interní', 'RENO', '', ''),
(80, 'Právní poradenství externí, Překlady', 'REEX', '', ''),
(81, '', 'OPTN', '', ''),
(82, '', '-', '', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `role`, `password`) VALUES
(1, 'jakub.krasa@gmail.com', 'krasa', 'ROLE_USER', '$2y$13$VFJLB6JUfP7sHyZgTeI/4.Y9D6y1HXj0IPEl48TOEM72AChLQCrsG');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F1B251E79066886` (`root_id`),
  ADD KEY `IDX_1F1B251E727ACA70` (`parent_id`),
  ADD KEY `IDX_1F1B251EC54C8C93` (`type_id`),
  ADD KEY `IDX_1F1B251EA76ED395` (`user_id`);

--
-- Klíče pro tabulku `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT pro tabulku `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251E727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1F1B251E79066886` FOREIGN KEY (`root_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1F1B251EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_1F1B251EC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
