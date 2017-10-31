-- phpMyAdmin SQL Dump
-- version 3.3.6
-- http://www.phpmyadmin.net
--
-- Host: mysql09j02.db.internal
-- Erstellungszeit: 05. Februar 2011 um 20:14
-- Server Version: 5.1.51
-- PHP-Version: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `lynersc_engelberg`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `RES_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER` varchar(40) COLLATE latin1_german1_ci NOT NULL DEFAULT '',
  `BEGIN` bigint(20) DEFAULT NULL,
  `END` bigint(20) DEFAULT NULL,
  `BEMERKUNGEN` varchar(255) COLLATE latin1_german1_ci DEFAULT '',
  PRIMARY KEY (`RES_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=226 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_paris`
--

CREATE TABLE IF NOT EXISTS `users` (
  `NAME` varchar(40) COLLATE latin1_german1_ci NOT NULL DEFAULT '',
  `EMAIL` varchar(40) COLLATE latin1_german1_ci DEFAULT NULL,
  `PHONE` varchar(20) COLLATE latin1_german1_ci DEFAULT NULL,
  `PWD` varchar(30) COLLATE latin1_german1_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`NAME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
