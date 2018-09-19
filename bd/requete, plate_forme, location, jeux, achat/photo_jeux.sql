-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 18 Septembre 2018 à 00:19
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
-- Structure de la table `photo_jeux`
--

CREATE TABLE `photo_jeux` (
  `photo_jeux_id` int(11) NOT NULL,
  `jeux_id` int(11) NOT NULL,
  `chemin_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='peut etre une photo pour plusieur jeux meme nom';

--
-- Contenu de la table `photo_jeux`
--

INSERT INTO `photo_jeux` (`photo_jeux_id`, `jeux_id`, `chemin_photo`) VALUES
(1, 1, 'images/01'),
(2, 2, '02.jpg'),
(3, 3, '03.jpg'),
(4, 4, 'thumb01.jpg'),
(5, 5, 'thumb02.jpg'),
(6, 6, 'thumb03.jpg'),
(7, 7, 'thumb04.jpg'),
(8, 8, 'thumb05.jpg'),
(9, 9, 'thumb06.jpg'),
(10, 10, 'thumb07.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  ADD PRIMARY KEY (`photo_jeux_id`),
  ADD KEY `FK_Posseder` (`jeux_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  MODIFY `photo_jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  ADD CONSTRAINT `FK_Posseder` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
