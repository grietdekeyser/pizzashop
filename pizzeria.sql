-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Gegenereerd op: 08 mei 2019 om 16:10
-- Serverversie: 10.1.38-MariaDB
-- PHP-versie: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellijnen`
--

CREATE TABLE `bestellijnen` (
  `bestellijnid` int(10) NOT NULL,
  `bestelid` int(10) NOT NULL,
  `productid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestellijnen`
--

INSERT INTO `bestellijnen` (`bestellijnid`, `bestelid`, `productid`) VALUES
(11, 8, 1),
(12, 8, 3),
(13, 8, 3),
(14, 9, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelid` int(10) NOT NULL,
  `klantid` int(10) NOT NULL,
  `datumtijd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prijs` decimal(10,2) NOT NULL,
  `korting` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`bestelid`, `klantid`, `datumtijd`, `prijs`, `korting`) VALUES
(8, 9, '2019-05-08 10:58:58', '24.50', '0.00'),
(9, 8, '2019-05-08 12:20:03', '6.75', '0.75');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gastenboek`
--

CREATE TABLE `gastenboek` (
  `id` int(10) NOT NULL,
  `klantid` int(10) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `bericht` varchar(150) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gastenboek`
--

INSERT INTO `gastenboek` (`id`, `klantid`, `naam`, `bericht`, `datum`) VALUES
(3, 8, 'Griet', 'Lekkere pizza\'s', '2019-05-08 12:46:23'),
(4, 8, '', 'Vlotte levering', '2019-05-08 12:46:23'),
(5, 9, '', 'Lekker gegeten', '2019-05-08 12:58:13'),
(13, 8, 'Griet', 'Smaakt naar meer! Pizza quattro formaggi is een aanrader.', '2019-05-08 14:00:24');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantid` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `familienaam` varchar(50) NOT NULL,
  `voornaam` varchar(30) NOT NULL,
  `straat` varchar(100) NOT NULL,
  `huisnummer` varchar(10) NOT NULL,
  `bus` varchar(10) NOT NULL,
  `postcode` int(4) NOT NULL,
  `woonplaats` varchar(50) NOT NULL,
  `telefoon` varchar(20) NOT NULL,
  `opmerking` varchar(150) NOT NULL,
  `registratiedatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantid`, `email`, `wachtwoord`, `familienaam`, `voornaam`, `straat`, `huisnummer`, `bus`, `postcode`, `woonplaats`, `telefoon`, `opmerking`, `registratiedatum`) VALUES
(8, 'griet.dekeyser@vdabcampus.be', '$2y$10$RYtXqITbS/7ng7eCKbGoBer8hDKMnr40QDrZqmd.we.6gkLXDrZLe', 'De keyser', 'Griet', 'Friedrich Froebelstraat', '10', '', 9050, 'Ledeberg', '0123456', 'Test', '2018-05-07 10:45:08'),
(9, 'test@test', '$2y$10$Cf25QuTGnoSbkpqn9elG8etfqI10B.OqfdPHOt3Akc6SG0w3OMuQm', 'Testje', 'Stef', 'Markt', '1', '', 9000, 'Gent', '123456', '', '2019-05-08 10:48:03');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leveringsgebied`
--

CREATE TABLE `leveringsgebied` (
  `postcodeid` int(10) NOT NULL,
  `postcode` int(5) NOT NULL,
  `gemeente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `leveringsgebied`
--

INSERT INTO `leveringsgebied` (`postcodeid`, `postcode`, `gemeente`) VALUES
(3, 9000, 'Gent'),
(4, 9050, 'Gentbrugge, Ledeberg'),
(5, 9040, 'Sint-Amandsberg'),
(6, 9032, 'Wondelgem');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `productid` int(10) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `samenstelling` varchar(150) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `beschikbaar` tinyint(1) NOT NULL,
  `afbeelding` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`productid`, `naam`, `samenstelling`, `prijs`, `beschikbaar`, `afbeelding`) VALUES
(1, 'Pizza margharita', 'tomatensaus, tomaat, mozarella', '7.50', 1, 'margharita.jpg'),
(2, 'Pizza chef', 'tomatensaus, tomaat, ricotta, gegrilde aubergine, mozzarella', '10.00', 1, 'chef.jpg'),
(3, 'Pizza quattro stagioni', 'tomatensaus, ham, paprika, champignons,  artisjok, mozzarella', '8.50', 1, 'stagioni.jpg'),
(4, 'Pizza quattro formaggi', 'tomatensaus, mozzarella, gorgonzola, pecorino, taleggio', '9.00', 1, 'formaggi.jpg');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  ADD PRIMARY KEY (`bestellijnid`) USING BTREE,
  ADD KEY `bestelid` (`bestelid`) USING BTREE,
  ADD KEY `productid` (`productid`) USING BTREE;

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelid`),
  ADD KEY `klantid` (`klantid`) USING BTREE;

--
-- Indexen voor tabel `gastenboek`
--
ALTER TABLE `gastenboek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klantid` (`klantid`) USING BTREE;

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantid`),
  ADD UNIQUE KEY `Unique` (`email`);

--
-- Indexen voor tabel `leveringsgebied`
--
ALTER TABLE `leveringsgebied`
  ADD PRIMARY KEY (`postcodeid`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`productid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  MODIFY `bestellijnid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `gastenboek`
--
ALTER TABLE `gastenboek`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `leveringsgebied`
--
ALTER TABLE `leveringsgebied`
  MODIFY `postcodeid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `productid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  ADD CONSTRAINT `fk_bestelid` FOREIGN KEY (`bestelid`) REFERENCES `bestellingen` (`bestelid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productid` FOREIGN KEY (`productid`) REFERENCES `producten` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `fk_klantid` FOREIGN KEY (`klantid`) REFERENCES `klanten` (`klantid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `gastenboek`
--
ALTER TABLE `gastenboek`
  ADD CONSTRAINT `fk_gastenboek` FOREIGN KEY (`klantid`) REFERENCES `klanten` (`klantid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
