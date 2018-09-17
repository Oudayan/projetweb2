-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 17 Septembre 2018 à 03:27
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb2`
--

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `membre_id` int(11) DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_retour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='pas sure il faut confirmer avec des camarades';

--
-- Contenu de la table `location`
--

INSERT INTO `location` (`location_id`, `membre_id`, `date_debut`, `date_retour`) VALUES
(1, 1, '2018-09-10 09:15:54', '2018-09-16 04:13:54'),
(2, 2, '2018-09-09 10:15:20', '2018-09-14 06:08:11'),
(3, 3, '2018-09-11 12:09:24', '2018-09-13 08:17:21'),
(4, 4, '2018-09-15 11:24:30', '2018-09-18 11:24:30'),
(5, 5, '2018-09-15 11:24:30', '2018-09-18 11:24:30'),
(6, 6, '2018-09-15 11:24:30', '2018-09-18 11:24:30'),
(7, 7, '2018-09-15 11:24:30', '2018-09-18 11:24:30'),
(8, 8, '2018-09-15 11:24:30', '2018-09-19 11:24:30'),
(9, 9, '2018-09-15 11:24:30', '2018-09-19 11:24:30'),
(10, 10, '2018-09-15 11:24:30', '2018-09-19 11:24:30');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `FK_Louer` (`membre_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_Louer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
