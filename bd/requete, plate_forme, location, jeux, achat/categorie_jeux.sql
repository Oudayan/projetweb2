-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 17 Septembre 2018 à 03:37
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
-- Structure de la table `categorie_jeux`
--

CREATE TABLE `categorie_jeux` (
  `categorie_jeux_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='le jeux est quel categorie\r\n\r\naction\r\nsex\r\n                                   -&';

--
-- Contenu de la table `categorie_jeux`
--

INSERT INTO `categorie_jeux` (`categorie_jeux_id`, `nom`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Fighting'),
(4, 'Survival'),
(5, 'Fiction'),
(6, 'Platform'),
(7, 'Shooter'),
(8, 'Simulation'),
(9, 'Horror'),
(10, 'Sports'),
(11, 'Strategy'),
(12, 'Misc'),
(13, 'Puzzle'),
(14, 'Racing'),
(15, 'Role-playing'),
(16, 'Music'),
(17, 'Misc'),
(18, 'Arcade'),
(19, 'Educational'),
(20, 'Maze'),
(21, 'Sexual'),
(22, 'Platform');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
  ADD PRIMARY KEY (`categorie_jeux_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
  MODIFY `categorie_jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
