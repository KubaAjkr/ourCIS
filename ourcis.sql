-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 28. pro 2017, 22:48
-- Verze serveru: 10.1.28-MariaDB
-- Verze PHP: 7.1.11

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
  `contract_id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lft` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `rgt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `item`
--

INSERT INTO `item` (`id`, `root_id`, `parent_id`, `type_id`, `user_id`, `contract_id`, `title`, `lft`, `lvl`, `rgt`) VALUES
(1, 1, NULL, 30, 1, 1, 'KR5500Tk', 1, 0, 8),
(2, 1, 1, 30, 1, 1, 'Podvozek', 2, 1, 5),
(3, 1, 2, 30, 1, 1, 'Housenice', 3, 2, 4),
(4, 1, 1, 30, 1, 1, 'Spodní stavba', 6, 1, 7);

-- --------------------------------------------------------

--
-- Struktura tabulky `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(381) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `type`
--

INSERT INTO `type` (`id`, `name`, `code`) VALUES
(5, 'Test', 'TEST'),
(7, 'Test', 'TEST'),
(9, 'Test', 'TEST'),
(10, 'Test', 'TEST'),
(11, 'Test', 'TEST'),
(13, 'Test', 'TEST'),
(14, 'Test', 'TEST'),
(16, 'Test', 'TEST'),
(18, 'Test', 'TEST'),
(19, 'Test', 'TEST'),
(20, 'Test', 'TEST'),
(21, 'Test', 'TEST'),
(22, 'Test', 'TEST'),
(23, 'Test', 'TEST'),
(24, 'Test', 'TEST'),
(25, 'Test', 'TEST'),
(27, 'Test', 'TEST'),
(28, 'Test', 'TEST'),
(29, 'Test', 'TEST'),
(30, 'Test', 'TEST'),
(31, 'Test', 'TEST'),
(32, 'Test', 'TEST');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pro tabulku `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
