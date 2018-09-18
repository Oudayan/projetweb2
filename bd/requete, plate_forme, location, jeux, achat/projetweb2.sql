-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 17 Septembre 2018 à 03:26
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
  `membre_id` int(11) NOT NULL,
  `date_achat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `achat`
--

INSERT INTO `achat` (`achat_id`, `membre_id`, `date_achat`) VALUES
(1, 1, '2018-09-16 04:13:54'),
(2, 2, '2018-09-12 04:13:54'),
(3, 3, '2018-09-15 11:24:30'),
(4, 4, '2018-09-15 11:24:30'),
(5, 5, '2018-09-15 11:24:30'),
(6, 6, '2018-09-15 11:24:30'),
(7, 7, '2018-09-15 11:24:30'),
(8, 8, '2018-09-15 11:24:30'),
(9, 9, '2018-09-15 11:24:30'),
(10, 10, '2018-09-15 11:24:30');

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE `appartenir` (
  `jeux_id` int(11) NOT NULL,
  `categorie_jeux_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `assigner_destinaitaire`
--

CREATE TABLE `assigner_destinaitaire` (
  `membre_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `associer`
--

CREATE TABLE `associer` (
  `membre_id` int(11) NOT NULL,
  `type_paiement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Structure de la table `commentraire_jeux`
--

CREATE TABLE `commentraire_jeux` (
  `commentaire_jeux_id` int(11) NOT NULL,
  `jeux_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `evaluation` decimal(1,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ce entiter on peux choisir deux type\r\n1. le utilisateur';

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
(1, 1, 1, 1, 1, 'Super Mario U 2', 7.5, '2018-09-16 04:13:54', 'Nintendo', 0),
(2, 2, 2, 2, 2, 'Shadow of the Colossus', 49.5, '2018-09-16 04:13:54', 'Sony', 1),
(3, 3, 3, 3, 3, 'Sonic The Hedgehog', 39.99, '2018-09-14 11:24:30', 'SEGA', 0),
(4, 4, 4, 4, 4, 'Megaman', 24, '2018-09-12 04:12:20', 'CAPCOM', 0),
(5, 3, 5, 5, 5, 'Mario Kart Double Dash', 31, '2018-09-10 12:44:33', 'Nintendo', 0),
(6, 7, 6, 6, 6, 'Donkey Kong Country', 24, '2018-09-15 10:02:50', 'Nintendo', 0),
(7, 4, 3, 7, 7, 'Shift 2 Unleashed', 32.99, '2018-09-10 06:24:30', 'EA', 0),
(8, 6, 4, 8, 8, 'Halo Reach', 44.5, '2018-09-11 07:12:20', 'Bungie', 0),
(9, 8, 5, 9, 9, 'The Secret of Monkey Island', 16, '2018-09-12 08:44:33', 'SEGA', 1),
(10, 2, 6, 10, 10, 'Assassins Creed BrotherHood', 35, '2018-09-13 09:02:50', 'UBISOFT', 0);

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

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `membre_id` int(11) NOT NULL,
  `type_utilisateur_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mot_de_passe` varchar(32) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `courriel` varchar(96) NOT NULL,
  `membre_valide` tinyint(1) NOT NULL,
  `membre_actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`membre_id`, `type_utilisateur_id`, `nom`, `prenom`, `mot_de_passe`, `adresse`, `telephone`, `courriel`, `membre_valide`, `membre_actif`) VALUES
(1, 3, 'Hod', 'David', 'pacman_2018', '5922 St.Hubert', '514-3697777', 'david.hod@gmail.com', 1, 1),
(2, 2, 'Guzman', 'Marcelo', '4651marcelo', '4651 Clark', '514-9630091', 'killpuechess@hotmail.com', 1, 1),
(3, 2, 'Tosin', 'Guilherme', 'mr.sirois', '711 Rue de Chevillon', '514-2328888', 'guiherme.tosin@gmail.com', 1, 1),
(4, 1, 'Peterson', 'Oscar', 'twoofthefew', '1786 Boulevard Manseau', '514-0201111', 'peterson.oscar@gmail.com', 1, 1),
(5, 1, 'Leclerc', 'Noémie', 'bagsGroove', '10220 Rue Laverdure', '514-2313333', 'noemie.leclerc@gmail.com', 1, 1),
(6, 1, 'Leger', 'Simon', 'stablemates', '7599 Avenue de L\'Épée', '514-4156666', 'simon.leger@gmail.com', 1, 1),
(7, 1, 'Demers', 'Claudia', 'time_for_rien', '1075 Rue de Bullion', '514-1234444', 'claudia.demers@hotmail.com', 1, 1),
(8, 1, 'Archer', 'Bob', 'pinkpanther', '4650 Avenue King-Edward', '514-8875564', 'bob.archer@gmail.com', 1, 1),
(9, 1, 'Rossi', 'Nicolas', 'earlyModem', '5683 Pare', '514-4542211', 'rossi.nicolas@hotmail.com', 1, 1),
(10, 1, 'Melson', 'Julien', 'lazy_melody', '5930 rue Théverin', '514-2251516', 'melson.julien@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `msg_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `msg_date` datetime NOT NULL,
  `msg_actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='messagerie interne pour communication entre des utilisateur';

-- --------------------------------------------------------

--
-- Structure de la table `photo_jeux`
--

CREATE TABLE `photo_jeux` (
  `photo_jeux_id` int(11) NOT NULL,
  `jeux_id` int(11) NOT NULL,
  `chemin_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='peut etre une photo pour plusieur jeux meme nom';

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
(1, 'Play Station 4'),
(2, 'Xbox One'),
(3, 'Nintendo Wii U'),
(4, 'Windows'),
(5, 'Play Station 3'),
(6, 'Xbox 360'),
(7, 'Nintendo Switch'),
(8, 'Play Sation Vita');

-- --------------------------------------------------------

--
-- Structure de la table `type_paiement`
--

CREATE TABLE `type_paiement` (
  `type_paiement_id` int(11) NOT NULL,
  `type_paiement` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='paypal\r\ncomptant\r\ncheque';

--
-- Contenu de la table `type_paiement`
--

INSERT INTO `type_paiement` (`type_paiement_id`, `type_paiement`) VALUES
(1, 'Comptant'),
(2, 'Chèque'),
(3, 'Paypal');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `type_utilisateur_id` int(11) NOT NULL,
  `type_utilisateur` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`type_utilisateur_id`, `type_utilisateur`) VALUES
(1, 'Membre'),
(2, 'Admin'),
(3, 'Super Admin');

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
-- Index pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`jeux_id`,`categorie_jeux_id`),
  ADD KEY `FK_Appartenir2` (`categorie_jeux_id`);

--
-- Index pour la table `assigner_destinaitaire`
--
ALTER TABLE `assigner_destinaitaire`
  ADD PRIMARY KEY (`membre_id`,`msg_id`),
  ADD KEY `FK_assigner_destinaitaire2` (`msg_id`);

--
-- Index pour la table `associer`
--
ALTER TABLE `associer`
  ADD PRIMARY KEY (`membre_id`,`type_paiement_id`),
  ADD KEY `FK_Associer2` (`type_paiement_id`);

--
-- Index pour la table `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
  ADD PRIMARY KEY (`categorie_jeux_id`);

--
-- Index pour la table `commentraire_jeux`
--
ALTER TABLE `commentraire_jeux`
  ADD PRIMARY KEY (`commentaire_jeux_id`),
  ADD KEY `FK_Composer` (`membre_id`),
  ADD KEY `FK_Concerner` (`jeux_id`);

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
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `FK_Louer` (`membre_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`membre_id`),
  ADD KEY `FK_Etre` (`type_utilisateur_id`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `FK_assigner_emmeteur` (`membre_id`);

--
-- Index pour la table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  ADD PRIMARY KEY (`photo_jeux_id`),
  ADD KEY `FK_Posseder` (`jeux_id`);

--
-- Index pour la table `plate_forme`
--
ALTER TABLE `plate_forme`
  ADD PRIMARY KEY (`plate_forme_id`);

--
-- Index pour la table `type_paiement`
--
ALTER TABLE `type_paiement`
  ADD PRIMARY KEY (`type_paiement_id`);

--
-- Index pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`type_utilisateur_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `achat`
--
ALTER TABLE `achat`
  MODIFY `achat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
  MODIFY `categorie_jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `commentraire_jeux`
--
ALTER TABLE `commentraire_jeux`
  MODIFY `commentaire_jeux_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `membre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  MODIFY `photo_jeux_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `plate_forme`
--
ALTER TABLE `plate_forme`
  MODIFY `plate_forme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `type_paiement`
--
ALTER TABLE `type_paiement`
  MODIFY `type_paiement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `type_utilisateur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `FK_Faire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `FK_Appartenir` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`),
  ADD CONSTRAINT `FK_Appartenir2` FOREIGN KEY (`categorie_jeux_id`) REFERENCES `categorie_jeux` (`categorie_jeux_id`);

--
-- Contraintes pour la table `assigner_destinaitaire`
--
ALTER TABLE `assigner_destinaitaire`
  ADD CONSTRAINT `FK_assigner_destinaitaire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_assigner_destinaitaire2` FOREIGN KEY (`msg_id`) REFERENCES `messagerie` (`msg_id`);

--
-- Contraintes pour la table `associer`
--
ALTER TABLE `associer`
  ADD CONSTRAINT `FK_Associer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_Associer2` FOREIGN KEY (`type_paiement_id`) REFERENCES `type_paiement` (`type_paiement_id`);

--
-- Contraintes pour la table `commentraire_jeux`
--
ALTER TABLE `commentraire_jeux`
  ADD CONSTRAINT `FK_Composer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_Concerner` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `FK_Avoir` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_Classer` FOREIGN KEY (`plate_forme_id`) REFERENCES `plate_forme` (`plate_forme_id`),
  ADD CONSTRAINT `FK_Etre_Acheter` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`achat_id`),
  ADD CONSTRAINT `FK_Etre_Louer` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_Louer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `FK_Etre` FOREIGN KEY (`type_utilisateur_id`) REFERENCES `type_utilisateur` (`type_utilisateur_id`);

--
-- Contraintes pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD CONSTRAINT `FK_assigner_emmeteur` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Contraintes pour la table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  ADD CONSTRAINT `FK_Posseder` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
