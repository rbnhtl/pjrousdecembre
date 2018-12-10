-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 10 Décembre 2018 à 16:16
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
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
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

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`id_departement`, `libelle`) VALUES
('1', 'Carriere Juridique'),
('2', 'GEA'),
('3', 'INFOCOM'),
('4', 'Informatique'),
('5', 'QLIO');

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

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`ine`, `id_groupe`, `nom`, `prenom`) VALUES
('0016857875672', '2', 'Pope', 'Grady'),
('0207396557111', '3', 'Herman', 'Farrah'),
('0295175089449', '4', 'Wall', 'Nissim'),
('0319842535510', '4', 'Ruiz', 'Devin'),
('0338160630482', '1', 'Stephens', 'Lareina'),
('0438516765438', '3', 'Lynch', 'Dale'),
('0519203612851', '3', 'Roth', 'Quynn'),
('0567192625298', '2', 'Huffman', 'Bertha'),
('0711805701706', '2', 'Coleman', 'Steel'),
('0914952597883', '1', 'Ramos', 'Amber'),
('1193266947504', '2', 'Wong', 'Chanda'),
('1472745775247', '4', 'Garner', 'Ursula'),
('1507800546908', '2', 'Woods', 'Rana'),
('1528192801363', '1', 'Harris', 'Francis'),
('1690696755461', '3', 'Massey', 'Anne'),
('1766225519842', '3', 'Beck', 'Sylvia'),
('1967054723775', '1', 'Wiggins', 'Buffy'),
('2099155534397', '4', 'Hansen', 'Clarke'),
('2226215493808', '2', 'Byrd', 'Wanda'),
('2239508478395', '2', 'Chen', 'Elaine'),
('2313659244696', '1', 'Suarez', 'Graiden'),
('2334466875153', '3', 'Finch', 'Zahir'),
('2425472190844', '1', 'Woodward', 'Zachary'),
('2431806105772', '4', 'Wright', 'Yoshio'),
('2605076430630', '3', 'Maynard', 'Zenaida'),
('2664084894948', '4', 'Rasmussen', 'Patricia'),
('2859598563543', '3', 'Meyers', 'Christopher'),
('2929233865619', '4', 'Rosa', 'Otto'),
('2962942624248', '1', 'Lowe', 'Jaquelyn'),
('3056521636723', '3', 'Buchanan', 'Helen'),
('3058414796202', '3', 'Casey', 'Brielle'),
('3287844137946', '3', 'Reeves', 'Kenneth'),
('3339255757007', '3', 'Zimmerman', 'Ingrid'),
('3342802094364', '4', 'Howard', 'Laura'),
('3420748652869', '1', 'Savage', 'Dominique'),
('3449386731554', '1', 'Murray', 'Felix'),
('3513382745027', '2', 'Everett', 'Faith'),
('3645276653239', '4', 'Pacheco', 'Francesca'),
('3788968500359', '2', 'Yang', 'Jasper'),
('3904461026186', '2', 'Mcfadden', 'Galena'),
('3962747970875', '2', 'Beck', 'Vera'),
('3992428596035', '1', 'Ryan', 'Armand'),
('4110769306604', '1', 'Cote', 'Alvin'),
('4390244954361', '4', 'Rojas', 'Philip'),
('4615340246033', '3', 'Small', 'Martina'),
('4683135487199', '1', 'Pace', 'Naida'),
('4776424649339', '2', 'Pugh', 'Thaddeus'),
('4777667386299', '4', 'Mcleod', 'Jamal'),
('4805386300058', '4', 'Holland', 'Linda'),
('4829482705865', '3', 'Shannon', 'Rooney'),
('4896468017356', '3', 'Berry', 'Amir'),
('5050009273120', '3', 'Holloway', 'Ferris'),
('5150446778126', '4', 'Conley', 'Ashton'),
('5253908292885', '3', 'Avery', 'Gemma'),
('5398299796366', '3', 'Hampton', 'Jasper'),
('5419832205985', '2', 'Blair', 'Geraldine'),
('5476788313878', '2', 'Cortez', 'Stone'),
('5491549071610', '4', 'Ayers', 'Quinlan'),
('5543119985825', '3', 'Villarreal', 'Cyrus'),
('5625126708961', '4', 'Bailey', 'Tanya'),
('5625588482654', '3', 'Galloway', 'Avram'),
('5685174897850', '1', 'Jones', 'Octavius'),
('5795198479819', '1', 'Palmer', 'Dacey'),
('5795406515958', '4', 'Martinez', 'Otto'),
('6059177080783', '3', 'Puckett', 'Eaton'),
('6164205887468', '1', 'Cooper', 'Prescott'),
('6294794766622', '4', 'Dudley', 'Chandler'),
('6418760841397', '2', 'Caldwell', 'Dieter'),
('6445020679816', '4', 'Curry', 'Colleen'),
('6586622869893', '4', 'Mccullough', 'Kieran'),
('6744973014906', '3', 'Hart', 'Phyllis'),
('6862246890216', '4', 'Simmons', 'Gail'),
('7104638192318', '1', 'Dickson', 'Hiroko'),
('7134314479215', '1', 'Chase', 'Maggy'),
('7195204438873', '1', 'Browning', 'Leila'),
('7441052201037', '2', 'Tillman', 'Yolanda'),
('7684840312413', '2', 'Jacobs', 'Noah'),
('7709259373694', '1', 'Hanson', 'Gillian'),
('7848412734581', '2', 'Nolan', 'Erasmus'),
('7850635600032', '3', 'Solis', 'Idola'),
('7970371747941', '4', 'Wiley', 'Lydia'),
('7978420732359', '3', 'Donovan', 'Jack'),
('8135928133533', '3', 'Hewitt', 'Kameko'),
('8214974559338', '3', 'Gutierrez', 'Herrod'),
('8257061194751', '1', 'Oneal', 'Jamal'),
('8311496888796', '4', 'Lamb', 'Jolie'),
('8321611747803', '4', 'Wood', 'Jane'),
('8386769933992', '2', 'Stuart', 'Kai'),
('8535391320118', '1', 'Rice', 'Gwendolyn'),
('8611755690140', '3', 'Mcclain', 'Whitney'),
('8673753992251', '2', 'Galloway', 'Kellie'),
('9151485463271', '1', 'York', 'Lois'),
('9166463569365', '1', 'Avila', 'Cooper'),
('9318260184140', '1', 'French', 'Dennis'),
('9468769121181', '3', 'Woodard', 'Rigel'),
('9561047169021', '3', 'Banks', 'Kuame'),
('9601329136580', '3', 'Emerson', 'Eagan'),
('9625119425258', '4', 'Logan', 'Addison'),
('9702639770222', '4', 'Combs', 'Ivan'),
('9889350920716', '4', 'Moran', 'Lars');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` decimal(10,0) NOT NULL,
  `id_departement` decimal(10,0) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `id_departement`, `libelle`) VALUES
('11', '1', 'DUT-1A-Carrières juridiques'),
('12', '1', 'DUT-2A-Carrières juridiques'),
('21', '2', 'DUT-1A-Information Communication'),
('22', '2', 'DUT-2A-Information Communication'),
('23', '2', 'LPRO-Chargé de communication'),
('31', '3', 'DUT-1A-GEA'),
('32', '3', 'DU-Finance, Droit & Gestion'),
('33', '3', 'DUT-2A-GEA-GMO'),
('34', '3', 'DUT-2A-GEA-GMO-ALT'),
('35', '3', 'DUT-2A-GEA:GCF'),
('36', '3', 'DUT-2A-GEA:GRH'),
('37', '3', 'L3-Gestion:Compta-Ctrl-Pro'),
('38', '3', 'LPRO-Banque-Client-Pro'),
('39', '3', 'LPRO-Conseil élevage'),
('41', '4', 'DUT-1A-Informatique'),
('42', '4', 'DUT-2A-Informatique'),
('43', '4', 'L3-MIASHS:MIAGE-RDZ-ALT'),
('44', '4', 'LPRO - Multimédia'),
('51', '5', 'DUT-1A-QLIO'),
('52', '5', 'DUT-2A-QLIO'),
('53', '5', 'LPRO - Animateur qualité'),
('54', '5', 'LPRO - Pilotage Logistique');

-- --------------------------------------------------------

--
-- Structure de la table `groupe_etudiant`
--

CREATE TABLE `groupe_etudiant` (
  `id_groupe` decimal(10,0) NOT NULL,
  `id_filiere` decimal(10,0) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe_etudiant`
--

INSERT INTO `groupe_etudiant` (`id_groupe`, `id_filiere`, `libelle`) VALUES
('1', '11', 'CJ1ATD01'),
('2', '21', 'IC1ATD01'),
('3', '31', 'GEA1ATD01'),
('4', '41', 'INFO1ATD01');

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
-- Index pour la table `absence`
--
ALTER TABLE `absence`
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
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
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
