-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 21 Novembre 2018 à 12:59
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestioneleve`
--

-- --------------------------------------------------------

--
-- Structure de la table `abscence`
--

CREATE TABLE `abscence` (
  `id_absence` decimal(10,0) NOT NULL,
  `ine` varchar(13) NOT NULL,
  `id_cours` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `administratif`
--

CREATE TABLE `administratif` (
  `id_administratif` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

CREATE TABLE `anime` (
  `id_professeur` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id_cours` decimal(10,0) NOT NULL,
  `id_matiere` decimal(10,0) NOT NULL,
  `numero_salle` varchar(30) NOT NULL,
  `id_groupe` decimal(10,0) NOT NULL,
  `horaire_debut` date DEFAULT NULL,
  `horaire_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id_departement` decimal(10,0) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `ine` varchar(13) NOT NULL,
  `id_groupe` decimal(10,0) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` decimal(10,0) NOT NULL,
  `id_departement` decimal(10,0) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_etudiant`
--

CREATE TABLE `groupe_etudiant` (
  `id_groupe` decimal(10,0) NOT NULL,
  `id_filiere` decimal(10,0) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` decimal(10,0) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `numeropersonnel` varchar(15) NOT NULL,
  `mdp` varchar(40) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_professeur` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `numero` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abscence`
--
ALTER TABLE `abscence`
  ADD PRIMARY KEY (`id_absence`),
  ADD KEY `abscence_cours_fk` (`id_cours`),
  ADD KEY `abscence_etudiant_fk` (`ine`);

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_administrateur`);

--
-- Index pour la table `administratif`
--
ALTER TABLE `administratif`
  ADD PRIMARY KEY (`id_administratif`);

--
-- Index pour la table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id_professeur`,`id_cours`),
  ADD KEY `id_professeur` (`id_professeur`,`id_cours`),
  ADD KEY `id_professeur_2` (`id_professeur`),
  ADD KEY `id_cours` (`id_cours`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`),
  ADD KEY `cours_groupe_etudiant_fk` (`id_groupe`),
  ADD KEY `cours_matiere_fk` (`id_matiere`),
  ADD KEY `cours_salle_fk` (`numero_salle`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`ine`),
  ADD KEY `etudiant_groupe_etudiant_fk` (`id_groupe`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`),
  ADD KEY `filiere_departement_fk` (`id_departement`);

--
-- Index pour la table `groupe_etudiant`
--
ALTER TABLE `groupe_etudiant`
  ADD PRIMARY KEY (`id_groupe`),
  ADD KEY `groupe_etudiant_filiere_fk` (`id_filiere`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`numeropersonnel`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id_professeur`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`numero`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `abscence`
--
ALTER TABLE `abscence`
  ADD CONSTRAINT `abscence_cours_fk` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `abscence_etudiant_fk` FOREIGN KEY (`ine`) REFERENCES `etudiant` (`ine`);

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `fk_Administrateur-personnel` FOREIGN KEY (`id_administrateur`) REFERENCES `personnel` (`numeropersonnel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `administratif`
--
ALTER TABLE `administratif`
  ADD CONSTRAINT `fk_administratif-personnel` FOREIGN KEY (`id_administratif`) REFERENCES `personnel` (`numeropersonnel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_groupe_etudiant_fk` FOREIGN KEY (`id_groupe`) REFERENCES `groupe_etudiant` (`id_groupe`),
  ADD CONSTRAINT `cours_matiere_fk` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `cours_salle_fk` FOREIGN KEY (`numero_salle`) REFERENCES `salle` (`numero`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_groupe_etudiant_fk` FOREIGN KEY (`id_groupe`) REFERENCES `groupe_etudiant` (`id_groupe`);

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_departement_fk` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`);

--
-- Contraintes pour la table `groupe_etudiant`
--
ALTER TABLE `groupe_etudiant`
  ADD CONSTRAINT `groupe_etudiant_filiere_fk` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `fk_prof-personnel` FOREIGN KEY (`id_professeur`) REFERENCES `personnel` (`numeropersonnel`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
