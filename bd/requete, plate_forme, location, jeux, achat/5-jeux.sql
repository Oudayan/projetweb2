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
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `jeux_id` int(11) NOT NULL,
  `plate_forme_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `achat_id` int(11) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `date_ajout` datetime NOT NULL,
  `concepteur` varchar(255) NOT NULL,
  `location` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jeux`
--

INSERT INTO `jeux` (`jeux_id`, `plate_forme_id`, `membre_id`, `location_id`, `achat_id`, `nom`, `prix`, `date_ajout`, `concepteur`, `location`) VALUES
(1, 1, 1, null, null, 'Super Mario U 2', 7.5, '2018-09-16 04:13:54', 'Nintendo', 0),
(2, 2, 2, null, null, 'Shadow of the Colossus', 49.5, '2018-09-16 04:13:54', 'Sony', 1),
(3, 3, 3, null, null, 'Sonic The Hedgehog', 39.99, '2018-09-14 11:24:30', 'SEGA', 0),
(4, 4, 4, null, null, 'Megaman', 24, '2018-09-12 04:12:20', 'CAPCOM', 0),
(5, 3, 5, null, null, 'Mario Kart Double Dash', 31, '2018-09-10 12:44:33', 'Nintendo', 0),
(6, 7, 6, null, null, 'Donkey Kong Country', 24, '2018-09-15 10:02:50', 'Nintendo', 0),
(7, 4, 3, null, null, 'Shift 2 Unleashed', 32.99, '2018-09-10 06:24:30', 'EA', 0),
(8, 6, 4, null, null, 'Halo Reach', 44.5, '2018-09-11 07:12:20', 'Bungie', 0),
(9, 8, 5, null, null, 'The Secret of Monkey Island', 16, '2018-09-12 08:44:33', 'SEGA', 1),
(10, 2, 6, null, null, 'Assassins Creed BrotherHood', 35, '2018-09-13 09:02:50', 'UBISOFT', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`jeux_id`),
  ADD KEY `FK_Avoir` (`membre_id`),
  ADD KEY `FK_Classer` (`plate_forme_id`),
  ADD KEY `FK_Etre_Acheter` (`achat_id`),
  ADD KEY `FK_Etre_Louer` (`location_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `FK_Avoir` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_Classer` FOREIGN KEY (`plate_forme_id`) REFERENCES `plate_forme` (`plate_forme_id`),
  ADD CONSTRAINT `FK_Etre_Acheter` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`achat_id`),
  ADD CONSTRAINT `FK_Etre_Louer` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
