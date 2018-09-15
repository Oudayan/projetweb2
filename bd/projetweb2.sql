-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2018 at 05:32 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetweb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `achat`
--

CREATE TABLE `achat` (
  `achat_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `date_achat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appartenir`
--

CREATE TABLE `appartenir` (
  `jeux_id` int(11) NOT NULL,
  `categorie_jeux_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assigner_destinaitaire`
--

CREATE TABLE `assigner_destinaitaire` (
  `membre_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `associer`
--

CREATE TABLE `associer` (
  `membre_id` int(11) NOT NULL,
  `type_paiement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categorie_jeux`
--

CREATE TABLE `categorie_jeux` (
  `categorie_jeux_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='le jeux est quel categorie\r\n\r\naction\r\nsex\r\n                                   -&';

-- --------------------------------------------------------

--
-- Table structure for table `commentraire_jeux`
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
-- Table structure for table `jeux`
--

CREATE TABLE `jeux` (
  `jeux_id` int(11) NOT NULL,
  `plate_forme_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `achat_id` int(11) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` decimal(3,2) NOT NULL,
  `date_ajout` datetime NOT NULL,
  `concepteur` varchar(255) NOT NULL,
  `location` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `membre_id` int(11) DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_retour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='pas sure il faut confirmer avec des camarades';

-- --------------------------------------------------------

--
-- Table structure for table `membre`
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

-- --------------------------------------------------------

--
-- Table structure for table `messagerie`
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
-- Table structure for table `photo_jeux`
--

CREATE TABLE `photo_jeux` (
  `photo_jeux_id` int(11) NOT NULL,
  `jeux_id` int(11) NOT NULL,
  `chemin_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='peut etre une photo pour plusieur jeux meme nom';

-- --------------------------------------------------------

--
-- Table structure for table `plate_forme`
--

CREATE TABLE `plate_forme` (
  `plate_forme_id` int(11) NOT NULL,
  `plate_forme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Determiner le jeux fonctionner dans quel plateau\r\nwindo';

-- --------------------------------------------------------

--
-- Table structure for table `type_paiement`
--

CREATE TABLE `type_paiement` (
  `type_paiement_id` int(11) NOT NULL,
  `type_paiement` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='paypal\r\ncomptant\r\ncheque';

-- --------------------------------------------------------

--
-- Table structure for table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `type_utilisateur_id` int(11) NOT NULL,
  `type_utilisateur` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`achat_id`),
  ADD KEY `FK_Faire` (`membre_id`);

--
-- Indexes for table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`jeux_id`,`categorie_jeux_id`),
  ADD KEY `FK_Appartenir2` (`categorie_jeux_id`);

--
-- Indexes for table `assigner_destinaitaire`
--
ALTER TABLE `assigner_destinaitaire`
  ADD PRIMARY KEY (`membre_id`,`msg_id`),
  ADD KEY `FK_assigner_destinaitaire2` (`msg_id`);

--
-- Indexes for table `associer`
--
ALTER TABLE `associer`
  ADD PRIMARY KEY (`membre_id`,`type_paiement_id`),
  ADD KEY `FK_Associer2` (`type_paiement_id`);

--
-- Indexes for table `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
  ADD PRIMARY KEY (`categorie_jeux_id`);

--
-- Indexes for table `commentraire_jeux`
--
ALTER TABLE `commentraire_jeux`
  ADD PRIMARY KEY (`commentaire_jeux_id`),
  ADD KEY `FK_Composer` (`membre_id`),
  ADD KEY `FK_Concerner` (`jeux_id`);

--
-- Indexes for table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`jeux_id`),
  ADD KEY `FK_Avoir` (`membre_id`),
  ADD KEY `FK_Classer` (`plate_forme_id`),
  ADD KEY `FK_Etre_Acheter` (`achat_id`),
  ADD KEY `FK_Etre_Louer` (`location_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `FK_Louer` (`membre_id`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`membre_id`),
  ADD KEY `FK_Etre` (`type_utilisateur_id`);

--
-- Indexes for table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `FK_assigner_emmeteur` (`membre_id`);

--
-- Indexes for table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  ADD PRIMARY KEY (`photo_jeux_id`),
  ADD KEY `FK_Posseder` (`jeux_id`);

--
-- Indexes for table `plate_forme`
--
ALTER TABLE `plate_forme`
  ADD PRIMARY KEY (`plate_forme_id`);

--
-- Indexes for table `type_paiement`
--
ALTER TABLE `type_paiement`
  ADD PRIMARY KEY (`type_paiement_id`);

--
-- Indexes for table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`type_utilisateur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achat`
--
ALTER TABLE `achat`
  MODIFY `achat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
  MODIFY `categorie_jeux_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commentraire_jeux`
--
ALTER TABLE `commentraire_jeux`
  MODIFY `commentaire_jeux_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `jeux_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `membre_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  MODIFY `photo_jeux_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plate_forme`
--
ALTER TABLE `plate_forme`
  MODIFY `plate_forme_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type_paiement`
--
ALTER TABLE `type_paiement`
  MODIFY `type_paiement_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `type_utilisateur_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `FK_Faire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Constraints for table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `FK_Appartenir` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`),
  ADD CONSTRAINT `FK_Appartenir2` FOREIGN KEY (`categorie_jeux_id`) REFERENCES `categorie_jeux` (`categorie_jeux_id`);

--
-- Constraints for table `assigner_destinaitaire`
--
ALTER TABLE `assigner_destinaitaire`
  ADD CONSTRAINT `FK_assigner_destinaitaire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_assigner_destinaitaire2` FOREIGN KEY (`msg_id`) REFERENCES `messagerie` (`msg_id`);

--
-- Constraints for table `associer`
--
ALTER TABLE `associer`
  ADD CONSTRAINT `FK_Associer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_Associer2` FOREIGN KEY (`type_paiement_id`) REFERENCES `type_paiement` (`type_paiement_id`);

--
-- Constraints for table `commentraire_jeux`
--
ALTER TABLE `commentraire_jeux`
  ADD CONSTRAINT `FK_Composer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_Concerner` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);

--
-- Constraints for table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `FK_Avoir` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_Classer` FOREIGN KEY (`plate_forme_id`) REFERENCES `plate_forme` (`plate_forme_id`),
  ADD CONSTRAINT `FK_Etre_Acheter` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`achat_id`),
  ADD CONSTRAINT `FK_Etre_Louer` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_Louer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Constraints for table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `FK_Etre` FOREIGN KEY (`type_utilisateur_id`) REFERENCES `type_utilisateur` (`type_utilisateur_id`);

--
-- Constraints for table `messagerie`
--
ALTER TABLE `messagerie`
  ADD CONSTRAINT `FK_assigner_emmeteur` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Constraints for table `photo_jeux`
--
ALTER TABLE `photo_jeux`
  ADD CONSTRAINT `FK_Posseder` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
