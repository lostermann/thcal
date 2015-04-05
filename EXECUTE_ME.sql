-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: dd28008.kasserver.com
-- Erstellungszeit: 05. Apr 2015 um 19:01
-- Server Version: 5.5.40-nmm1-log
-- PHP-Version: 5.3.28-nmm2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `d01bc4ae`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `thcal`
--

CREATE TABLE IF NOT EXISTS `thcal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `veranstaltung` text NOT NULL,
  `loc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `showtime` time NOT NULL,
  `get_in_band` time NOT NULL,
  `get_in_local_crew` time NOT NULL,
  `rider` text NOT NULL,
  `sound` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `light` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `th` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bemerkung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agentur` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tech_kontakt` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `backline_th` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bl_rentals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `micro_rentals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `xtra_rentals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `xtra_personal` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1076 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `thcal_notes`
--

CREATE TABLE IF NOT EXISTS `thcal_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` text NOT NULL,
  `note` text NOT NULL,
  `veranst_link` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `thcal_todos`
--

CREATE TABLE IF NOT EXISTS `thcal_todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` text NOT NULL,
  `kommentar` text NOT NULL,
  `status` text NOT NULL,
  `bearbeiter` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
