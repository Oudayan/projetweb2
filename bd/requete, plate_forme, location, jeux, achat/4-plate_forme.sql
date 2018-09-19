-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 17 Septembre 2018 à 03:28
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
-- Structure de la table `plate_forme`
--

CREATE TABLE `plate_forme` (
  `plate_forme_id` int(11) NOT NULL,
  `plate_forme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Determiner le jeux fonctionner dans quel plateau\r\nwindo';

--
-- Contenu de la table `plate_forme`
--

INSERT INTO `plate_forme` (`plate_forme_id`, `plate_forme`) VALUES
(1, 'Playstation 4'),
(2, 'Xbox One'),
(3, 'Nintendo Wii U'),
(4, 'Windows'),
(5, 'Playstation 3'),
(6, 'Xbox 360'),
(7, 'Nintendo Switch'),
(8, 'Playstation Vita');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `plate_forme`
--
ALTER TABLE `plate_forme`
  ADD PRIMARY KEY (`plate_forme_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `plate_forme`
--
ALTER TABLE `plate_forme`
  MODIFY `plate_forme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
