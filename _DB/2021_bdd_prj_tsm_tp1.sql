-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 11 avr. 2021 à 15:40
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `2021_bdd_prj_tsm_tp1`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `operation` enum('inc','dec') COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `id_product`, `id_user`, `operation`, `value`, `created_at`) VALUES
(23, 17, 11, 'dec', 1, 1617718693),
(24, 40, 11, 'inc', 4, 1617718709),
(25, 16, 11, 'inc', 1, 1617718765),
(26, 40, 11, 'dec', 4, 1617718813);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `stock` int(11) NOT NULL,
  `stock_mini` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `reference`, `supplier`, `category_id`, `description`, `stock`, `stock_mini`, `status`, `created_at`) VALUES
(3, 'Module logique RS PRO, 8 entrées, 4 sorties, Numérique, relais', 'G8DDT10BRS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(4, 'Module logique RS PRO, 8 entrées, 4 sorties, Numérique, relais', 'G7DDT10RS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(5, 'Module logique RS PRO, 8 entrées, 4 sorties, Numérique, relais', 'G8DDT10RS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(6, 'Module logique RS PRO, 8 entrées, 4 sorties, Numérique, relais', 'G7DDT10BRS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(7, 'Module d\'interface RS PRO 1 entrée 1 sortie, Protocole RS485 (D-), Protocole RS485 (D+), Protocole RS485 (deux fils)', 'G8XDTR4RS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(8, 'Module E/S RS PRO, 8 entrées, 4 sorties, Numérique, relais', 'G8DDT10ERS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(9, 'Module E/S RS PRO, 8 entrées, 4 sorties, Numérique, relais', 'G7DDT10ERS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(10, 'Module mémoire RS PRO', 'GFDNN3MRS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(11, 'Module d\'interface RS PRO 1 entrée 1 sortie, Protocole RS485 (D-), Protocole RS485 (D+), Protocole RS485 (deux fils)', 'G7XDTR4RS', 'RS PRO', 1, '', 5, 1, 1, 1615681435),
(12, 'Module logique Schneider Electric, série Zelio Logic, 16 entrées, 10 sorties, Relais', 'SR3B261BD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(13, 'Module logique Schneider Electric, série Zelio Logic, 8 entrées, 4 sorties, Transistor', 'SR2B122BD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(14, 'Module logique Schneider Electric, série Zelio Logic, 12 entrées, 8 sorties, Relais', 'SR2B201BD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(15, 'Module logique Schneider Electric, série Zelio Logic, 12 entrées, 8 sorties, Relais', 'SR2B201FU', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(16, 'Unité centrale Siemens, série S7-1200, 14 (entrées numériques, 2 switchs comme entrées analogiques) entrées, 10', '6ES7214-1AG40-0XB0', 'Siemens', 1, '', 6, 1, 1, 1615681435),
(17, 'Unité centrale Siemens, série S7-300, 28 (24 numériques, 4 analogiques) entrées, 18 (16 numériques, 2 analogiques)', '6ES7314-6CH04-0AB0', 'Siemens', 1, '', 4, 1, 1, 1615681435),
(18, 'Module logique Crouzet, série Millenium 3, 16 entrées, 10 sorties, Relais', '88970161', 'Crouzet', 1, '', 5, 1, 1, 1615681435),
(19, 'Module logique Schneider Electric, série Zelio Logic, 8 entrées, 4 sorties, Relais', 'SR2B121JD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(20, 'Module logique Schneider Electric, série Twido, 24 entrées, 16 sorties, Relais, transistor', 'TWDLCAE40DRF', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(21, 'Module logique Schneider Electric, série Zelio Logic, 8 entrées, 4 sorties, Relais', 'SR2B121BD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(22, 'Module logique Schneider Electric, série Zelio Logic, 16 entrées, 10 sorties, Relais', 'SR3B261FU', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(23, 'Module logique Schneider Electric, série Zelio Logic, 16 entrées, 10 sorties, Relais', 'SR3B261B', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(24, 'Module logique Schneider Electric, série TSX 37 05, 16 entrées, 12 sorties, Relais', 'TSX3705028DR1', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(25, 'Module logique Schneider Electric, série Zelio Logic, 8 entrées, 4 sorties, Relais', 'SR2B121FU', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(26, 'Unité centrale Schneider Electric, série Modicon M221, 24 entrées, 16 sorties, Numérique', 'TM221CE40R', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(27, 'Module logique Schneider Electric, série Zelio Logic, 6 entrées, 4 sorties, Relais', 'SR3B101BD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(28, 'Unité centrale Schneider Electric, série Modicon M221, Numérique', 'TM221CE24R', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(29, 'Unité centrale Schneider Electric, série Zelio Logic 2, 8 (jusqu\'à → 8 numériques, jusqu\'à →', 'SR2PACKBD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(30, 'Module logique Schneider Electric, série Zelio Logic, 6 entrées, 4 sorties, Relais', 'SR2A101BD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(31, 'Module logique Schneider Electric, série Zelio Logic, 8 entrées, 4 sorties, Relais', 'SR2B121B', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(32, 'Unité centrale Schneider Electric, série Zelio Logic 2, 16 (numériques) entrées, 10 (relais) sorties, Relais', 'SR3PACK2FU', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(33, 'Module logique Schneider Electric, série Zelio Logic, 16 entrées, 10 sorties, Transistor', 'SR3B262BD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(34, 'Module logique Crouzet, série Millenium 3, 16 entrées, 10 sorties, Transistor', '88970162', 'Crouzet', 1, '', 5, 1, 1, 1615681435),
(35, 'Module E/S Siemens, série LOGO!, 8 entrées, 8 sorties, Relais', '6ED1055-1NB10-0BA2', 'Siemens', 1, '', 5, 1, 1, 1615681435),
(36, 'Unité centrale Schneider Electric, série Zelio Logic 2, 16 (jusqu\'à → 16 numériques, jusqu\'à →', 'SR3PACK2BD', 'Schneider Electric', 1, '', 5, 1, 1, 1615681435),
(39, 'Capteur inductif RS PRO', '11422-050', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(40, 'Transducteur linéaire RS PRO', 'IPL-0100-103-3ST', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(41, 'Capteur inductif RS PRO', '11422-089', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(42, 'Capteur inductif RS PRO', '13422-011', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(43, 'Codeur absolu RS PRO, axe Creux Ø 12mm, SSI-Gray, 13 bits, Gray', 'WDGA 58E141312SIAG01CC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(44, 'Transducteur linéaire RS PRO', 'IPL-0500-203-3ST', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(45, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 2 500 imp/tr, HTL Inversé, 360 ppr', 'WDG 58H12360ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(46, 'Transducteur linéaire RS PRO', 'IPL-0050-103-3ST', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(47, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 5 000 imp/tr, HTL Inversé, 3600 ppr', 'WDG 58H123600ABNR24SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(48, 'Codeur absolu RS PRO, axe Creux Ø 12mm, SSI-Gray, 13 bits, Gray, 8192 ppr', 'WDGA 58E141213SIAG01CC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(49, 'Transducteur linéaire RS PRO', 'IPL-0200-103-3ST', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(50, 'Codeur incrémental RS PRO, axe Sortant Ø 10mm, 2 500 imp/tr, HTL Inversé, 256 ppr', 'WDG 58B256ABNR30K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(51, 'Codeur incrémental RS PRO, axe Sortant Ø 10mm, 50 imp/tr, HTL Inversé, 50 ppr', 'WDG 58B50ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(52, 'Capteur inductif RS PRO', '11091-054', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(53, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 2 500 imp/tr, HTL Inversé, 1024 ppr', 'WDG 58H121024ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(54, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 2 500 imp/tr, HTL Inversé, 2048 ppr', 'WDG 58H122048ABNR30K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(55, 'Codeur absolu RS PRO, axe Creux Ø 12mm, SSI-Gray, 13 bits, Gray', 'WDGA 58E121312SIAG01CC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(56, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 5 000 imp/tr, HTL Inversé, 4096 ppr', 'WDG 58A4096ABNR24K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(57, 'Codeur incrémental RS PRO, axe Sortant Ø 10mm, 2 500 imp/tr, HTL Inversé, 200 ppr', 'WDG 58B200ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(58, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 5 000 imp/tr, HTL Inversé, 4096 ppr', 'WDG 58H124096ABNR24K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(59, 'Codeur absolu RS PRO, axe Sortant Ø 10mm, 18 bits, 262144 ppr', 'WDGA 58B101218COAB00CB5H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(60, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 2 500 imp/tr, HTL Inversé, 360 ppr', 'WDG 58A360ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(61, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 2 500 imp/tr, HTL Inversé, 50 ppr', 'WDG 58H1250ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(62, 'Codeur incrémental RS PRO, axe Sortant Ø 10mm, 2 500 imp/tr, HTL Inversé, 1024 ppr', 'WDG 58B1024ABNR30K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(63, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 2 500 imp/tr, HTL Inversé, 1024 ppr', 'WDG 58A1024ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(64, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 2 500 imp/tr, HTL Inversé, 1024 ppr', 'WDG 58H121024ABNR30K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(65, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 2 500 imp/tr, HTL Inversé, 360 ppr', 'WDG 58A360ABNR30K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(66, 'Codeur incrémental RS PRO, axe Sortant Ø 10mm, 2 500 imp/tr, HTL Inversé, 2048 ppr', 'WDG 58B2048ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(67, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 2 500 imp/tr, HTL Inversé, 1024 ppr', 'WDG 58A1024ABNR30K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(68, 'Codeur incrémental RS PRO, axe Méplat Ø 6mm, HTL Inversé, 360 ppr', '58A-06-360-ABN-R30-L3', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(69, 'Codeur incrémental RS PRO, axe Méplat Ø 6mm, TTL, 360 ppr', '40K-360-ABN-R05-L3', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(70, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 5 000 imp/tr, HTL Inversé, 5000 ppr', 'WDG 58H125000ABNR24K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(71, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 2 500 imp/tr, HTL Inversé, 200 ppr', 'WDG 58A200ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(72, 'Codeur incrémental RS PRO Ø 10mm, HTL Inversé, 5000 ppr', '58B-10-5000-ABN-R24-S5R-SEN', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(73, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 5 000 imp/tr, HTL Inversé, 5000 ppr', 'WDG 58A5000ABNR24SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(74, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 2 500 imp/tr, HTL Inversé, 500 ppr', 'WDG 58H12500ABNR30K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(75, 'Codeur incrémental RS PRO Ø 10mm, HTL Inversé, 3600 ppr', '58B-10-3600-ABN-R24-S5R-SEN', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(76, 'Codeur incrémental RS PRO Ø 10mm, HTL Inversé, 1024 ppr', '58B-10-1024-ABN-R30-S5R-SEN', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(77, 'Codeur incrémental RS PRO, axe Creux Ø 6mm, HTL, 500 ppr', '40E-06-500-ABN-H24-L3', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(78, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 2 500 imp/tr, HTL Inversé, 2048 ppr', 'WDG 58A2048ABNR30K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(79, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, HTL Inversé, 1024 ppr', '58H-12-1024-ABN-R30-L3', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(80, 'Codeur incrémental RS PRO, axe Méplat Ø 6mm, HTL, 512 ppr', '30A-512-ABN-N30-L7', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(81, 'Codeur incrémental RS PRO, axe Méplat Ø 6mm, HTL, 1024 ppr', '30A-1024-ABN-N30-L7', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(82, 'Codeur incrémental RS PRO, axe Sortant Ø 6mm, 2 500 imp/tr, HTL Inversé, 500 ppr', 'WDG 58A500ABNR30SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(83, 'Codeur incrémental RS PRO, axe Creux Ø 12mm, 5 000 imp/tr, HTL Inversé, 5000 ppr', 'WDG 58H125000ABNR24SC8H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(84, 'Codeur incrémental RS PRO, axe Sortant Ø 10mm, 5 000 imp/tr, HTL Inversé, 4096 ppr', 'WDG 58B4096ABNR24K3H73', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(85, 'Codeur incrémental RS PRO Ø 10mm, HTL Inversé, 500 ppr', '58B-10-500-ABN-R24-S5-SEN', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(86, 'Codeur incrémental RS PRO, axe Méplat Ø 8mm, HTL, 360 ppr', '50B-360-ABN-H24-L2-ABU', 'RS PRO', 2, '', 10, 2, 1, 1615681435),
(87, 'Motoréducteurs V c.a. RS PRO, 65 x 65 x 77 mm, 9,5 W 240 V', 'MTR8cGBV', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(88, 'Motoréducteurs V c.a. RS PRO, 65 x 65 x 64 mm, 5,8 W 240 V', 'MTR7aGBV', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(89, 'Motoréducteurs V c.a. RS PRO, Ø 42 x 21 mm, 0,42 W 240 V', 'MT0-ACW', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(90, 'Motoréducteurs V c.a. RS PRO, 1, 70 x 70 x 49,5 mm, 3,1 W 230 V', 'MTR4aGB8', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(91, 'Motoréducteurs V c.a. RS PRO, 1, (Ø) 51,5 x 21,5 mm, 3,1 W 240 V', 'MTR4a', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(92, 'Motoréducteurs V c.a. RS PRO, 1, 70 x 70 x 49,5 mm, 3,6 W 230 V', 'MTR4bGB8', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(93, 'Moteur AC RS PRO IE1, 2, 123 x 188 x 172 mm, 0,18 kW 400 V, montage Montage sur pied', 'AERV1T02R2507MT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(94, 'Moteur AC RS PRO IE3, 4, 349,5 x 561 mm (Ø), 15 kW 400 V, montage Montage à bride', 'AEQV3T0400207LT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(95, 'Moteur AC RS PRO IE3, 2, 226 x 28,5 x 284 mm, 4 kW 400 V, montage Montage sur pied', 'AERV3T025R507LT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(96, 'Moteur AC RS PRO IE1, 4, 138 x 214,5 x 194 mm, 0,25 kW 400 V, montage Montage sur pied', 'AERV1T04R3307MT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(97, 'Moteur AC RS PRO IE1, 2, 138 x 214,5 x 194 mm, 0,55 kW 400 V, montage Montage à bride', 'AEQV1T02R7507MT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(98, 'Moteur AC RS PRO IE3, 4, 199,5 x 299,5 mm (Ø), 1,5 kW 400 V, montage Montage à bride', 'AEQV3T0400027MT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(99, 'Moteur AC RS PRO IE3, 2, 199.5 (Ø) x 243,5 mm, 1,1 kW 400 V, montage Montage à bride', 'AEQV3T021R507MT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(100, 'Moteur AC RS PRO IE3, 4, 299 x 401 mm (Ø), 7,5 kW 400 V, montage Montage à bride', 'AEQV3T0400107LT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(101, 'Moteur AC RS PRO IE1, 4, 138 x 214,5 x 194 mm, 0,37 kW 400 V, montage Montage sur pied', 'AERV1T04R5007MT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(102, 'Moteur AC RS PRO IE3, 4, 199.5 (Ø) x 243,5 mm, 0,75 kW 400 V, montage Montage à bride', 'AEQV3T0400017MT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(103, 'Moteur AC RS PRO IE3, 2, 299 (Ø) x 379 mm, 7,5 kW 400 V, montage Montage à bride', 'AEQV3T0200107LT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(104, 'Moteur AC RS PRO IE3, 2, 199.5 (Ø) x 243,5 mm, 0,75 kW 400 V, montage Montage à bride', 'AEQV3T0200017MT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(105, 'Moteur AC RS PRO IE3, 4, 299 (Ø) x 379 mm, 5,5 kW 400 V, montage Montage à bride', 'AEQV3T047R507LT01', 'RS PRO', 3, '', 8, 2, 1, 1615681435),
(106, 'Motoréducteurs V c.a. Mellor Electric, 62 x 50 x 73 mm, 24 W 230 V', 'UB1001', 'Mellor Electric', 3, '', 8, 2, 1, 1615681435),
(107, 'Moteur AC Panasonic, 4, 135 x 90 x 90 mm, 90 W 230 V', 'M91Z90G4GGA', 'Panasonic', 3, '', 8, 2, 1, 1615681435),
(108, 'Motoréducteurs V c.a. Crouzet, 41,65 x 55,5 x 65,9 mm, 3 W 230 V', '82334760', 'Crouzet', 3, '', 8, 2, 1, 1615681435),
(109, 'Motoréducteurs V c.a. Crouzet, 41,65 x 55,5 x 65,9 mm, 3 W 230 V', '82334759', 'Crouzet', 3, '', 8, 2, 1, 1615681435);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `password_token`, `lastname`, `firstname`, `email`, `role`, `status`, `created_at`) VALUES
(11, '360', '7413a1637a24014d2b7d753d4ed4af3fc2a1225b', '', 'THOMAS', 'Michael', 'michael.convergence@gmail.com', 3, 1, 1613333912),
(34, 'mit', 'faf0c8235614652735a56cbd00457c3995e6d35a', NULL, 'El Ouadah', 'Yanis', 'info@osborne.fr', 2, 0, 1613425652);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_history_product` (`id_product`),
  ADD KEY `idx_history_user` (`id_user`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_category` (`category_id`) USING BTREE;

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
