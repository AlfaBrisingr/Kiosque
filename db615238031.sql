-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 25 Février 2016 à 09:37
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db576425814`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `code_user` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(40) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`code_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`code_user`, `login`, `password`) VALUES
(1, 'valerie', '04fe694a19f79586abf93d86faee3146e841311a'),
(2, 'anne', '04fe694a19f79586abf93d86faee3146e841311a'),
(3, 'jeunePublic', '120525d1a28d39f78ef479b07011de199c5c2e92'),
(4, 'collegelycee', '120525d1a28d39f78ef479b07011de199c5c2e92');

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

CREATE TABLE IF NOT EXISTS `choix` (
  `idInscription` int(11) NOT NULL,
  `idSpectacle` int(11) NOT NULL,
  `prioriteChoix` int(11) NOT NULL,
  PRIMARY KEY (`idInscription`,`idSpectacle`),
  KEY `fk_choix_spectacle` (`idSpectacle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `choix`
--

INSERT INTO `choix` (`idInscription`, `idSpectacle`, `prioriteChoix`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

CREATE TABLE IF NOT EXISTS `ecole` (
  `idEcole` int(11) NOT NULL AUTO_INCREMENT,
  `typeEcole` int(11) NOT NULL,
  `nomEcole` varchar(50) NOT NULL,
  `adresseEcole` varchar(50) NOT NULL,
  `adresse2Ecole` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `cpEcole` int(11) NOT NULL,
  `villeEcole` varchar(50) NOT NULL,
  `mail_dir` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idEcole`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `ecole`
--

INSERT INTO `ecole` (`idEcole`, `typeEcole`, `nomEcole`, `adresseEcole`, `adresse2Ecole`, `cpEcole`, `villeEcole`, `mail_dir`) VALUES
(9, 2, 'Bonocampo', '23 rue des Enfants', '1', 53960, 'BONCHAMP', 'bonocampo@bonocampo.org'),
(10, 4, 'Rochefeuille', 'Route d''Ambrières', '1', 53100, 'MAYENNE', 'lycee@rochefeuille.net'),
(11, 4, 'Lavoisier', '281 Rue du Pommier', '1', 53100, 'MAYENNE', 'ce.0530016e@ac-nantes.fr'),
(12, 3, 'Jules Ferry', '8 Rue Jules Renard', '1', 53100, 'MAYENNE', 'ce.0530078x@ac-nantes.fr'),
(13, 3, 'Victor Hugo', '9 Rue de Châtenay', '1', 53110, 'LASSAY LES CHATEAUX', 'ce.0530803k@ac-nantes.fr'),
(14, 4, 'Don Bosco', '18 Bd Anatole', '1', 53100, 'MAYENNE', 'ensemble.scolaire@donbosco.fr'),
(15, 3, 'Don Bosco', '18 Bd Anatole', '1', 53100, 'MAYENNE', 'ensemble.scolaire@donbosco.fr'),
(16, 4, 'Léonard de Vinci', '129 Boulevard de l''Europe', '1', 53100, 'MAYENNE', 'ce.0530079y@ac-nantes.fr'),
(18, 3, 'Sévigné', '24 Rue du Cardinal Suhard', '1', 53100, 'MAYENNE', 'ce.0530826k@ac-nantes.fr'),
(19, 3, 'MFR Pré en Pail', 'La Chauvinière', '1', 53140, 'PRé EN PAIL', 'mfr.pre-en-pail@mfr.asso.fr'),
(20, 4, 'MFR Pré en Pail', 'La Chauvinière', '1', 53140, 'PRé EN PAIL', 'mfr.pre-en-pail@mfr.asso.fr'),
(21, 4, 'Immaculée-Conception', '15 rue Crossardière', '1', 53000, 'LAVAL', 'lycees@immac.fr'),
(22, 3, 'René Cassin', '27 Place Thiers', '1', 53500, 'ERNéE', 'ce.0530077w@ac-nantes.fr'),
(23, 4, 'Orion', '2 rue de la Libération', '1', 53600, 'EVRON', 'evron@cneap.fr');


-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE IF NOT EXISTS `enseignant` (
  `idEns` int(11) NOT NULL AUTO_INCREMENT,
  `civEns` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nomEns` varchar(50) NOT NULL,
  `prenomEns` varchar(50) DEFAULT NULL,
  `mailEns` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telEns` text CHARACTER SET latin1 NOT NULL,
  `idEcole` int(11) NOT NULL,
  `TypeEnseignant` int(11) NOT NULL,
  PRIMARY KEY (`idEns`),
  KEY `fkEnseignantEcole` (`idEcole`),
  KEY `fk_type_enseignant` (`TypeEnseignant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`idEns`, `civEns`, `nomEns`, `prenomEns`, `mailEns`, `telEns`, `idEcole`, `TypeEnseignant`) VALUES
(8, 'Madame', 'MARTIN', 'Oceane', 'bonocampo@bonocampo.org', '0123456789', 9, 1),
(9, 'Monsieur', 'JEAN', 'Jack', 'bonocampo@bonocampo.org', '0123456789', 9, 2),
(10, 'Monsieur', 'PAVY', 'Patrick', 'lycee@rochefeuille.net', '0243041173', 10, 1),
(11, 'Monsieur', 'GAMESS', ' ', 'ce.0530016e@ac-nantes.fr', '0243048633', 11, 1),
(12, 'Monsieur', 'DUPPEY', ' ', 'ce.0530078x@ac-nantes.fr', '0243301930', 12, 1),
(13, 'Monsieur', 'HONOREZ', ' ', 'ce.0530803k@ac-nantes.fr', '0243047356', 13, 1),
(14, 'Monsieur', 'LHUISSIER', ' ', 'ensemble.scolaire@donbosco.fr', '0243304747', 14, 1),
(15, 'Monsieur', 'LHUISSIER', '', 'ensemble.scolaire@donbosco.fr', '0243304747', 15, 1),
(16, 'Monsieur', 'CORNETTE', ' alain', 'ce.0530079y@ac-nantes.fr', '0243042098', 16, 1),
(18, 'Monsieur', 'JACQUEMIN', '', 'ce.0530826k@ac-nantes.fr', '0243041114', 18, 1),
(19, 'Monsieur', 'DIRECTEUR', '', 'mfr.pre-en-pail@mfr.asso.fr', '0243038777', 19, 1),
(20, 'Madame', 'DIRECTEUR', '', 'mfr.pre-en-pail@mfr.asso.fr', '0243038777', 20, 1),
(21, 'Monsieur', 'FILLON', 'Louis-marie', 'lycees@immac.fr', '0243592324', 21, 1),
(22, 'Monsieur', 'LEMAILE', '', 'ce.0530077w@ac-nantes.fr', '0243051262', 22, 1),
(23, 'Monsieur', 'DIRECTEUR', '', 'evron@cneap.fr', '0243016230', 23, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
  `idInscription` int(11) NOT NULL AUTO_INCREMENT,
  `validationInscription` tinyint(1) NOT NULL,
  `idEns` int(11) NOT NULL,
  `dateInscription` datetime NOT NULL,
  `diversInscription` text CHARACTER SET latin1,
  `impoInscription` text CHARACTER SET latin1,
  `nbEnfantsInscription` int(11) NOT NULL,
  `nbAdultesInscription` int(11) NOT NULL,
  `classe` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idInscription`),
  KEY `fk_inscriptionEnseignant` (`idEns`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`idInscription`, `validationInscription`, `idEns`, `dateInscription`, `diversInscription`, `impoInscription`, `nbEnfantsInscription`, `nbAdultesInscription`, `classe`) VALUES
(1, 1, 9, '2016-02-11 12:04:20', '', '<strong><em>Vide</em></strong>', 12, 2, 'CE1, CE2');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `nomLieu` varchar(50) CHARACTER SET latin1 NOT NULL,
  `adrLieu` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cpLieu` int(5) NOT NULL,
  `villeLieu` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idLieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `lieu`
--

INSERT INTO `lieu` (`idLieu`, `nomLieu`, `adrLieu`, `cpLieu`, `villeLieu`) VALUES
(1, 'Salle Polyvalente', 'rue Volney', 53100, 'MAYENNE'),
(2, 'Théâtre municipal', 'Place Juhel', 53100, 'MAYENNE'),
(3, 'Hall des expositions', 'Rue Volney', 53100, 'MAYENNE'),
(4, 'Musée du Château de Mayenne', 'Place Juhel', 53100, 'MAYENNE'),
(5, 'ARON - Salle des fêtes', 'Rue des loisirs', 53440, 'ARON'),
(6, 'BELGEARD - Salle des fêtes', 'Rue du Muguet', 53440, 'BELGEARD');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE IF NOT EXISTS `planning` (
  `idSeance` int(11) NOT NULL,
  `idInscription` int(11) NOT NULL,
  PRIMARY KEY (`idSeance`,`idInscription`),
  KEY `fk_planning_inscription` (`idInscription`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `planning`
--

INSERT INTO `planning` (`idSeance`, `idInscription`) VALUES
(22, 1);

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

CREATE TABLE IF NOT EXISTS `saison` (
  `idSaison` int(11) NOT NULL AUTO_INCREMENT,
  `nomSaison` varchar(40) CHARACTER SET latin1 NOT NULL,
  `courante` tinyint(1) NOT NULL,
  PRIMARY KEY (`idSaison`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `saison`
--

INSERT INTO `saison` (`idSaison`, `nomSaison`, `courante`) VALUES
(1, '2015/2016', 1),
(2, '2016/2017', 0),
(3, '2017/2018', 0),
(4, '2018/2019', 0),
(5, '2019/2020', 0),
(6, '2020/2021', 0),
(7, '2021/2022', 0),
(8, '2022/2023', 0),
(9, '2023/2024', 0),
(10, '2024/2025', 0),
(11, '2025/2026', 0),
(12, '2026/2027', 0),
(13, '2027/2028', 0);

-- --------------------------------------------------------

--
-- Structure de la table `saison_spectacle`
--

CREATE TABLE IF NOT EXISTS `saison_spectacle` (
  `idSaison` int(11) NOT NULL,
  `idSpectacle` int(11) NOT NULL,
  PRIMARY KEY (`idSaison`,`idSpectacle`),
  KEY `fk_spectacle_saison_spectacle` (`idSpectacle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `saison_spectacle`
--

INSERT INTO `saison_spectacle` (`idSaison`, `idSpectacle`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE IF NOT EXISTS `seance` (
  `idSeance` int(11) NOT NULL AUTO_INCREMENT,
  `idSpectacle` int(11) NOT NULL,
  `date_heure` datetime NOT NULL,
  `idLieu` int(11) NOT NULL,
  PRIMARY KEY (`idSeance`),
  KEY `fk_seance_spectacle` (`idSpectacle`),
  KEY `fk_seance_lieu` (`idLieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `seance`
--

INSERT INTO `seance` (`idSeance`, `idSpectacle`, `date_heure`, `idLieu`) VALUES
(3, 5, '2016-05-17 14:00:00', 1),
(4, 5, '2016-05-18 10:00:00', 1),
(5, 5, '2016-05-18 14:00:00', 1),
(6, 5, '2016-05-19 10:00:00', 1),
(7, 5, '2016-05-19 14:00:00', 1),
(11, 1, '2016-02-02 00:00:00', 1),
(17, 1, '2016-02-02 00:00:00', 1),
(18, 2, '2016-02-02 00:00:00', 1),
(19, 2, '2016-04-02 00:00:00', 1),
(20, 3, '2016-02-05 00:00:00', 1),
(21, 3, '2016-03-02 00:00:00', 1),
(22, 4, '2016-07-02 00:00:00', 1),
(23, 4, '2016-04-06 00:00:00', 1),
(24, 6, '2016-07-20 00:00:00', 1),
(25, 6, '2016-08-12 00:00:00', 1),
(26, 7, '2016-12-02 00:00:00', 1),
(27, 7, '2016-11-02 00:00:00', 1),
(29, 8, '2016-01-28 15:00:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `spectacle`
--

CREATE TABLE IF NOT EXISTS `spectacle` (
  `idSpectacle` int(11) NOT NULL AUTO_INCREMENT,
  `nomSpectacle` varchar(80) NOT NULL,
  `nbPlaceSpectacle` int(11) NOT NULL,
  `typeClasse` varchar(40) NOT NULL,
  `typeSpectacle` int(11) NOT NULL,
  PRIMARY KEY (`idSpectacle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `spectacle`
--

INSERT INTO `spectacle` (`idSpectacle`, `nomSpectacle`, `nbPlaceSpectacle`, `typeClasse`, `typeSpectacle`) VALUES
(1, 'Le Parapluie Noir', 250, 'PS/MS', 1),
(2, 'Gretel et Hansel', 100, 'PS/MS', 1),
(3, 'Enchantés', 400, 'CP/CE1', 1),
(4, 'Abeille et Bourdon', 300, 'CE/CM', 1),
(5, 'Jongle', 200, 'PS/MS', 1),
(6, 'Le monde sous les flaques', 80, 'CE2/CM', 1),
(7, 'L''hiver, 4 chiens mordent mes et mes mains', 35, 'CM2', 1),
(8, 'L''ange de la Mort', 250, 'Term', 2),
(9, 'Le Parapluie Rouge', 250, 'Seconde', 2);

-- --------------------------------------------------------

--
-- Structure de la table `type_enseignant`
--

CREATE TABLE IF NOT EXISTS `type_enseignant` (
  `idType` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(32) NOT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_enseignant`
--

INSERT INTO `type_enseignant` (`idType`, `Libelle`) VALUES
(1, 'directeur'),
(2, 'enseignant'),
(3, 'Assistante Maternelle');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `choix`
--
ALTER TABLE `choix`
ADD CONSTRAINT `fk_choix_inscription` FOREIGN KEY (`idInscription`) REFERENCES `inscription` (`idInscription`),
ADD CONSTRAINT `fk_choix_spectacle` FOREIGN KEY (`idSpectacle`) REFERENCES `spectacle` (`idSpectacle`);

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
ADD CONSTRAINT `fkEnseignantEcole` FOREIGN KEY (`idEcole`) REFERENCES `ecole` (`idEcole`),
ADD CONSTRAINT `fk_type_enseignant` FOREIGN KEY (`TypeEnseignant`) REFERENCES `type_enseignant` (`idType`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
ADD CONSTRAINT `fk_inscriptionEnseignant` FOREIGN KEY (`idEns`) REFERENCES `enseignant` (`idEns`);

--
-- Contraintes pour la table `planning`
--
ALTER TABLE `planning`
ADD CONSTRAINT `fk_planning_inscription` FOREIGN KEY (`idInscription`) REFERENCES `inscription` (`idInscription`),
ADD CONSTRAINT `fk_planning_seance` FOREIGN KEY (`idSeance`) REFERENCES `seance` (`idSeance`);

--
-- Contraintes pour la table `saison_spectacle`
--
ALTER TABLE `saison_spectacle`
ADD CONSTRAINT `fk_saison_saison_spectacle` FOREIGN KEY (`idSaison`) REFERENCES `saison` (`idSaison`),
ADD CONSTRAINT `fk_spectacle_saison_spectacle` FOREIGN KEY (`idSpectacle`) REFERENCES `spectacle` (`idSpectacle`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
ADD CONSTRAINT `fk_seance_lieu` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`),
ADD CONSTRAINT `fk_seance_spectacle` FOREIGN KEY (`idSpectacle`) REFERENCES `spectacle` (`idSpectacle`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
