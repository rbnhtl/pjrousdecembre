-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2019 at 10:09 PM
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
  `etudiant` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cours` int(11) NOT NULL
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
  `matiere` int(11) DEFAULT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `departement` int(11) DEFAULT NULL,
  `administratif` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `filiere` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `salle` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
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
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
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
  `num` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`etudiant`,`cours`),
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
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
