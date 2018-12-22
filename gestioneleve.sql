-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2018 at 05:14 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestioneleve`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

CREATE TABLE `absence` (
  `id` int(11) NOT NULL,
  `etudiant` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anime`
--

CREATE TABLE `anime` (
  `prof` int(11) NOT NULL,
  `cours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appartient`
--

CREATE TABLE `appartient` (
  `groupe` int(11) NOT NULL,
  `etudiant` varchar(13) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `matiere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id`, `libelle`) VALUES
(11, 'Carriere Juridique'),
(12, 'GEA'),
(13, 'INFOCOM'),
(14, 'Informatique'),
(15, 'QLIO');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `ine` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departement` int(11) DEFAULT NULL,
  `administratif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id`, `libelle`, `departement`, `administratif`) VALUES
(1, 'DUT-1A-Carrières juridiques', NULL, NULL),
(2, 'DUT-2A-Carrières juridiques', NULL, NULL),
(3, 'DUT-1A-GEA', NULL, NULL),
(4, 'DU-Finance, Droit & Gestion', NULL, NULL),
(5, 'DUT-2A-GEA-GMO', NULL, NULL),
(6, 'DUT-2A-GEA-GMO-ALT', NULL, NULL),
(7, 'DUT-2A-GEA:GCF', NULL, NULL),
(8, 'DUT-2A-GEA:GRH', NULL, NULL),
(9, 'L3-Gestion:Compta-Ctrl-Pro', NULL, NULL),
(10, 'LPRO-Banque-Client-Pro', NULL, NULL),
(11, 'LPRO-Conseil élevage', NULL, NULL),
(12, 'DUT-1A-Information Communication', NULL, NULL),
(13, 'DUT-2A-Information Communication', NULL, NULL),
(14, 'LPRO-Chargé de communication', NULL, NULL),
(15, 'DUT-1A-Informatique', NULL, NULL),
(16, 'DUT-2A-Informatique', NULL, NULL),
(17, 'L3-MIASHS:MIAGE-RDZ-ALT', NULL, NULL),
(18, 'LPRO - Multimédia', NULL, NULL),
(19, 'DUT-1A-QLIO', NULL, NULL),
(20, 'DUT-2A-QLIO', NULL, NULL),
(21, 'LPRO - Animateur qualité', NULL, NULL),
(22, 'LPRO - Pilotage Logistique', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filiere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id`, `libelle`, `filiere`) VALUES
(231, 'CJ1CM01', 1),
(232, 'CJ1TD01', 1),
(233, 'CJ2CM01', 2),
(234, 'CJ2ADMTD01', 2),
(235, 'CJ2JURTD01', 2),
(236, 'CJ2TD01', 2),
(237, 'CJ2NOTTD01', 2),
(238, 'IC1CM01', 12),
(239, 'IC1TD01', 12),
(240, 'IC1TP01', 12),
(241, 'IC1TP02', 12),
(242, 'IC2CM01', 13),
(243, 'IC2TD01', 13),
(244, 'IC2TP01', 13),
(245, 'IC2TP02', 13),
(246, 'CCRCALANG1', 14),
(247, 'CCRCALANG2', 14),
(248, 'CCRCALBULA', 14),
(249, 'CCRCFIANG1', 14),
(250, 'CCRCFIANG2', 14),
(251, 'CCRCFIBULA', 14),
(252, 'CCRCCMAEG', 14),
(253, 'CCRCCMAIC', 14),
(254, 'CCRCCMFI', 14),
(255, 'CCRCANGTD1', 14),
(256, 'CCRCANGTD2', 14),
(257, 'CCRCBULATS', 14),
(258, 'CCRCCM01', 14),
(259, 'CCRCCOMMER', 14),
(260, 'CCRCCOMMU', 14),
(261, 'CCRCTD01', 14),
(262, 'ANGCM01', 4),
(263, 'ANGTD01', 4),
(264, 'DUTD01', 4),
(265, 'DUTD02', 4),
(266, 'GEA1CM01', 3),
(267, 'GEA1ALLD04', 3),
(268, 'GEA1ESP01', 3),
(269, 'GEA1ESP02', 3),
(270, 'GEA1ESP03', 3),
(271, 'GEA1TD01', 3),
(272, 'GEA1TD02', 3),
(273, 'GEA1TD03', 3),
(274, 'GEA1ALLE01', 3),
(275, 'GMOCM01', 5),
(276, 'GMOTD01', 5),
(277, 'GMOTD02', 5),
(278, 'GMOALLEM01', 5),
(279, 'GMOESPAG01', 5),
(280, 'GMOESPAG02', 5),
(281, 'GMOALTTD01', 6),
(282, 'GCFCM01', 7),
(283, 'GCFTD01', 7),
(284, 'GCFTD02', 7),
(285, 'GCFALLEM01', 7),
(286, 'GCFESPAG01', 7),
(287, 'GRHCM01', 8),
(288, 'GRHTD01', 8),
(289, 'GRHALLEM01', 8),
(290, 'GRHESPAG01', 8),
(291, 'L3GARCM01', 9),
(292, 'L3GARTD01', 9),
(293, 'L3GARTD02', 9),
(294, 'BANQUE01', 10),
(295, 'LMCECM01', 11),
(296, 'LMCETD01', 11),
(297, 'LMCETD02', 11),
(298, 'INFO1CM01', 15),
(299, 'INFO1TD01', 15),
(300, 'INFO1TD02', 15),
(301, 'INFO1TD03', 15),
(302, 'INFO2CM01', 16),
(303, 'INFO2TD01', 16),
(304, 'INFO2TD02', 16),
(305, 'MIAGECM01', 17),
(306, 'MIAGETD01', 17),
(307, 'MIAGETP01', 17),
(308, 'MMS01', 18),
(309, 'QLIO1CM01', 19),
(310, 'QLIO1TD01', 19),
(311, 'QLIO1TP01', 19),
(312, 'QLIO1TP02', 19),
(313, 'QLIO2CM01', 20),
(314, 'QLIO2CMQA', 20),
(315, 'QLIO2CMLO', 20),
(316, 'QLIO2CMRF', 20),
(317, 'QLIO2TD01', 20),
(318, 'QLIO2TDQA', 20),
(319, 'QLIO2TDLO', 20),
(320, 'QLIO2TDRF', 20),
(321, 'QLIO2TP01', 20),
(322, 'QLIO2TP02', 20),
(323, 'QLIO2TP301', 20),
(324, 'QLIO2TP302', 20),
(325, 'QLIO2TP303', 20),
(326, 'QLIO2TPA02', 20),
(327, 'QLIO2TPQA', 20),
(328, 'Q2TPATEL2', 20),
(329, 'QLIO2TPLA', 20),
(330, 'QLIO2TPLB', 20),
(331, 'TPB03', 20),
(332, 'QLIO2TPIP', 20),
(333, 'TPC02', 20),
(334, 'TPD01', 20),
(335, 'TPD02', 20),
(336, 'LRUBTD01', 21),
(337, 'LRUBTD02', 21),
(338, 'AQAPPRENTI', 21),
(339, 'AQINITIAUX', 21),
(340, 'PILALCALTP', 22),
(341, 'PILALCM01', 22),
(342, 'PILALTD01', 22),
(343, 'GESTPROD01', 22),
(344, 'GESTPROD02', 22),
(345, 'PILALTP01', 22);

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occupe`
--

CREATE TABLE `occupe` (
  `salle` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `cours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participe`
--

CREATE TABLE `participe` (
  `groupe` int(11) NOT NULL,
  `cours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remplit`
--

CREATE TABLE `remplit` (
  `personnel` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `num` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_765AE0C9717E22E3` (`etudiant`),
  ADD KEY `IDX_765AE0C9FDCA8C9C` (`cours`);

--
-- Indexes for table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`prof`,`cours`),
  ADD KEY `IDX_130459425BBA70BB` (`prof`),
  ADD KEY `IDX_13045942FDCA8C9C` (`cours`);

--
-- Indexes for table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`groupe`,`etudiant`),
  ADD KEY `IDX_4201BAA74B98C21` (`groupe`),
  ADD KEY `IDX_4201BAA7717E22E3` (`etudiant`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FDCA8C9C9014574A` (`matiere`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`ine`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2ED05D9EC1765B63` (`departement`),
  ADD KEY `IDX_2ED05D9E145F75AA` (`administratif`);

--
-- Indexes for table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B98C212ED05D9E` (`filiere`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupe`
--
ALTER TABLE `occupe`
  ADD PRIMARY KEY (`salle`,`cours`),
  ADD KEY `IDX_FFBC0FC64E977E5C` (`salle`),
  ADD KEY `IDX_FFBC0FC6FDCA8C9C` (`cours`);

--
-- Indexes for table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`groupe`,`cours`),
  ADD KEY `IDX_9FFA8D44B98C21` (`groupe`),
  ADD KEY `IDX_9FFA8D4FDCA8C9C` (`cours`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remplit`
--
ALTER TABLE `remplit`
  ADD PRIMARY KEY (`personnel`,`role`),
  ADD KEY `IDX_16A5C47AA6BCF3DE` (`personnel`),
  ADD KEY `IDX_16A5C47A57698A6A` (`role`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absence`
--
ALTER TABLE `absence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;
--
-- AUTO_INCREMENT for table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `FK_765AE0C9717E22E3` FOREIGN KEY (`etudiant`) REFERENCES `etudiant` (`ine`),
  ADD CONSTRAINT `FK_765AE0C9FDCA8C9C` FOREIGN KEY (`cours`) REFERENCES `cours` (`id`);

--
-- Constraints for table `anime`
--
ALTER TABLE `anime`
  ADD CONSTRAINT `FK_130459425BBA70BB` FOREIGN KEY (`prof`) REFERENCES `personnel` (`id`),
  ADD CONSTRAINT `FK_13045942FDCA8C9C` FOREIGN KEY (`cours`) REFERENCES `cours` (`id`);

--
-- Constraints for table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `FK_4201BAA74B98C21` FOREIGN KEY (`groupe`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_4201BAA7717E22E3` FOREIGN KEY (`etudiant`) REFERENCES `etudiant` (`ine`);

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_FDCA8C9C9014574A` FOREIGN KEY (`matiere`) REFERENCES `matiere` (`id`);

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `FK_2ED05D9E145F75AA` FOREIGN KEY (`administratif`) REFERENCES `personnel` (`id`),
  ADD CONSTRAINT `FK_2ED05D9EC1765B63` FOREIGN KEY (`departement`) REFERENCES `departement` (`id`);

--
-- Constraints for table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `FK_4B98C212ED05D9E` FOREIGN KEY (`filiere`) REFERENCES `filiere` (`id`);

--
-- Constraints for table `occupe`
--
ALTER TABLE `occupe`
  ADD CONSTRAINT `FK_FFBC0FC64E977E5C` FOREIGN KEY (`salle`) REFERENCES `salle` (`num`),
  ADD CONSTRAINT `FK_FFBC0FC6FDCA8C9C` FOREIGN KEY (`cours`) REFERENCES `cours` (`id`);

--
-- Constraints for table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `FK_9FFA8D44B98C21` FOREIGN KEY (`groupe`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_9FFA8D4FDCA8C9C` FOREIGN KEY (`cours`) REFERENCES `cours` (`id`);

--
-- Constraints for table `remplit`
--
ALTER TABLE `remplit`
  ADD CONSTRAINT `FK_16A5C47A57698A6A` FOREIGN KEY (`role`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `FK_16A5C47AA6BCF3DE` FOREIGN KEY (`personnel`) REFERENCES `personnel` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
