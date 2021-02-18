-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 fév. 2021 à 20:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `analytics_api`
--

-- --------------------------------------------------------

--
-- Structure de la table `code_action`
--

DROP TABLE IF EXISTS `code_action`;
CREATE TABLE IF NOT EXISTS `code_action` (
  `id_code_action` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_code_action`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `code_action`
--

INSERT INTO `code_action` (`id_code_action`, `libelle`) VALUES
(1, 'Affiche'),
(2, 'Ajout'),
(3, 'Suppression'),
(4, 'Modification'),
(5, 'click'),
(6, 'Consultation'),
(7, 'QuitterEcran'),
(8, 'QuitterSeance'),
(9, 'ArretSeance'),
(10, 'RetourEcran'),
(11, 'QuitterAppli'),
(12, 'MenuOuvre'),
(13, 'MenuFerme'),
(14, 'DemandeInfo');

-- --------------------------------------------------------

--
-- Structure de la table `code_ecran`
--

DROP TABLE IF EXISTS `code_ecran`;
CREATE TABLE IF NOT EXISTS `code_ecran` (
  `id_code_ecran` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_code_ecran`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `code_ecran`
--

INSERT INTO `code_ecran` (`id_code_ecran`, `libelle`) VALUES
(1, 'Accueil'),
(2, 'About'),
(3, 'Memo'),
(4, 'Categorie'),
(5, 'Contact'),
(6, 'Formules'),
(7, 'Landing'),
(8, 'Login'),
(9, 'Paiement'),
(10, 'Presentation'),
(11, 'Profile'),
(12, 'QCM'),
(13, 'Anxiete'),
(14, 'Dependance'),
(15, 'Sommeil'),
(16, 'Stress'),
(17, 'Questionnaire'),
(18, 'Seance'),
(19, 'Seances'),
(20, 'Posture'),
(21, 'Signup'),
(22, 'Sophrologue'),
(23, 'Stat'),
(24, 'AgendaSeance');

-- --------------------------------------------------------

--
-- Structure de la table `pageana`
--

DROP TABLE IF EXISTS `pageana`;
CREATE TABLE IF NOT EXISTS `pageana` (
  `id_pageana` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(55) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `code_ecran` int(11) NOT NULL,
  `code_action` int(11) NOT NULL,
  `libelle_action` varchar(255) DEFAULT NULL,
  `date_enreg` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pageana`),
  KEY `code_ecran` (`code_ecran`),
  KEY `code_action` (`code_action`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pageana`
--

INSERT INTO `pageana` (`id_pageana`, `ip`, `id_utilisateur`, `url`, `code_ecran`, `code_action`, `libelle_action`, `date_enreg`) VALUES
(18, '7 ', 7, '7', 1, 1, '7', '11/ 2/ 2021'),
(17, '7 ', 7, '7', 1, 1, '7', '11/ 2/ 2021'),
(28, '8 ', 8, '8', 1, 1, '8', '17/ 2/ 2021');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `nom`, `password`) VALUES
(39, '88aaaaaaaaa', '88'),
(38, '88z', '88'),
(37, '88', '88'),
(36, '555', 'jojo'),
(35, 'jojo', 'jojo'),
(34, 'jojo', 'jojo'),
(33, 'jojo', 'jojo'),
(32, 'jojo', 'jojo'),
(31, '7', '7'),
(40, '44', '44'),
(41, '44aa', '44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
