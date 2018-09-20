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
-- Structure de la table `achat`
--

CREATE TABLE `achat` (
  `achat_id` int(11) NOT NULL,
  `type_paiement_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `date_achat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `achat`
--

INSERT INTO `achat` (`achat_id`, `type_paiement_id`, `membre_id`, `date_achat`) VALUES
(1, 2, 1, '2018-09-16 04:13:54'),
(2, 3, 2, '2018-09-12 04:13:54'),
(3, 1, 3, '2018-09-15 11:24:30'),
(4, 2, 4, '2018-09-15 11:24:30'),
(5, 3, 5, '2018-09-15 11:24:30'),
(6, 1, 6, '2018-09-15 11:24:30'),
(7, 2, 7, '2018-09-15 11:24:30'),
(8, 3, 8,'2018-09-15 11:24:30'),
(9, 1, 9, '2018-09-15 11:24:30'),
(10, 2, 10, '2018-09-15 11:24:30');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`achat_id`),
  ADD KEY `FK_Faire` (`membre_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `achat`
--
ALTER TABLE `achat`
  MODIFY `achat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `FK_Faire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
