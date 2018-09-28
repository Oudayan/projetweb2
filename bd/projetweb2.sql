-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-09-28 12:03:49
-- 服务器版本： 5.7.21-log
-- PHP Version: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- 表的结构 `achat`
--

CREATE TABLE `achat` (
  `achat_id` int(11) NOT NULL,
  `type_paiement_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `date_achat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `achat`
--

INSERT INTO `achat` (`achat_id`, `type_paiement_id`, `membre_id`, `date_achat`) VALUES
(1, 2, 1, '2018-09-16 04:13:54'),
(2, 3, 2, '2018-09-12 04:13:54'),
(3, 1, 3, '2018-09-15 11:24:30'),
(4, 2, 4, '2018-09-15 11:24:30'),
(5, 3, 5, '2018-09-15 11:24:30'),
(6, 1, 6, '2018-09-15 11:24:30'),
(7, 2, 7, '2018-09-15 11:24:30'),
(8, 3, 8, '2018-09-15 11:24:30'),
(9, 1, 9, '2018-09-15 11:24:30'),
(10, 2, 10, '2018-09-15 11:24:30');

-- --------------------------------------------------------

--
-- 表的结构 `categorie`
--

CREATE TABLE `categorie` (
  `categorie_id` int(11) NOT NULL,
  `categorie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie`) VALUES
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
-- 表的结构 `categorie_jeux`
--

CREATE TABLE `categorie_jeux` (
  `jeux_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `commentaire_jeux`
--

CREATE TABLE `commentaire_jeux` (
  `commentaire_jeux_id` int(11) NOT NULL,
  `jeux_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `evaluation` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `destinataire`
--

CREATE TABLE `destinataire` (
  `membre_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `jeux`
--

CREATE TABLE `jeux` (
  `jeux_id` int(11) NOT NULL,
  `plateforme_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `date_ajout` datetime NOT NULL,
  `concepteur` varchar(255) NOT NULL,
  `location` tinyint(1) NOT NULL,
  `jeux_valide` tinyint(1) NOT NULL,
  `jeux_actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jeux`
--

INSERT INTO `jeux` (`jeux_id`, `plateforme_id`, `membre_id`, `titre`, `prix`, `date_ajout`, `concepteur`, `location`, `jeux_valide`, `jeux_actif`) VALUES
(1, 1, 1, 'Super Mario U 2', '7.50', '2018-09-16 04:13:54', 'Nintendo', 1, 1, 1),
(2, 2, 2, 'Shadow of the Colossus', '49.50', '2018-09-16 04:13:54', 'Sony', 0, 1, 1),
(3, 3, 3, 'Sonic The Hedgehog', '39.99', '2018-09-14 11:24:30', 'SEGA', 0, 1, 1),
(4, 4, 4, 'Megaman', '24.00', '2018-09-12 04:12:20', 'CAPCOM', 0, 1, 1),
(5, 3, 5, 'Mario Kart Double Dash', '31.00', '2018-09-10 12:44:33', 'Nintendo', 0, 1, 1),
(6, 7, 6, 'Donkey Kong Country', '24.00', '2018-09-15 10:02:50', 'Nintendo', 0, 1, 1),
(7, 4, 3, 'Shift 2 Unleashed', '32.99', '2018-09-10 06:24:30', 'EA', 0, 1, 1),
(8, 6, 4, 'Halo Reach', '44.50', '2018-09-11 07:12:20', 'Bungie', 0, 1, 1),
(9, 8, 5, 'The Secret of Monkey Island', '16.00', '2018-09-12 08:44:33', 'SEGA', 1, 1, 1),
(10, 2, 6, 'Assassins Creed BrotherHood', '35.00', '2018-09-13 09:02:50', 'UBISOFT', 0, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `type_paiement_id` int(11) NOT NULL,
  `membre_id` int(11) DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_retour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `location`
--

INSERT INTO `location` (`location_id`, `type_paiement_id`, `membre_id`, `date_debut`, `date_retour`) VALUES
(1, 2, 1, '2018-09-10 09:15:54', '2018-09-16 04:13:54'),
(2, 3, 2, '2018-09-09 10:15:20', '2018-09-14 06:08:11'),
(3, 1, 3, '2018-09-11 12:09:24', '2018-09-13 08:17:21'),
(4, 2, 4, '2018-09-15 11:24:30', '2018-09-18 11:24:30'),
(5, 3, 5, '2018-09-15 11:24:30', '2018-09-18 11:24:30'),
(6, 1, 6, '2018-09-15 11:24:30', '2018-09-18 11:24:30'),
(7, 2, 7, '2018-09-15 11:24:30', '2018-09-18 11:24:30'),
(8, 3, 8, '2018-09-15 11:24:30', '2018-09-19 11:24:30'),
(9, 1, 9, '2018-09-15 11:24:30', '2018-09-19 11:24:30'),
(10, 2, 10, '2018-09-15 11:24:30', '2018-09-19 11:24:30');

-- --------------------------------------------------------

--
-- 表的结构 `membre`
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
  `membre_valide` tinyint(1) NOT NULL DEFAULT '0',
  `membre_actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `membre`
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
(10, 1, 'Melson', 'Julien', 'lazy_melody', '5930 rue Théverin', '514-2251516', 'melson.julien@gmail.com', 1, 1),
(11, 1, '11', '11', '11', '11', '11', 'setNom@hh.com', 0, 1),
(12, 1, ' Guilherme ', 'Tosin', '123', '7, le palais laval', '514 888 888', 'guillherme@hotmail.com', 0, 1),
(13, 1, '11', '11', '1111', '11', '11', 'dd@hotmail.com', 0, 1),
(14, 1, '11', '11', '11', '11', '11', '111@hotmail.com', 0, 1),
(16, 1, '11', '11', '6512bd43d9caa6e02c990b0a82652dca', '11', '11', '11@11.com', 0, 1),
(21, 1, '11', '11', '6512bd43d9caa6e02c990b0a82652dca', '11', '11', '11@111.com', 0, 1),
(22, 1, '11', '11', '6512bd43d9caa6e02c990b0a82652dca', '11', '11', '11@hotmail.com', 0, 1),
(23, 1, 'he', 'chunliang', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'dd', '11', '22@hotmail.com', 0, 1),
(26, 1, '11', '11', '6512bd43d9caa6e02c990b0a82652dca', '11', '11', '11@ff.com', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `messagerie`
--

CREATE TABLE `messagerie` (
  `msg_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `msg_date` datetime NOT NULL,
  `msg_actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `photo_jeux`
--

CREATE TABLE `photo_jeux` (
  `photo_jeux_id` int(11) NOT NULL,
  `jeux_id` int(11) NOT NULL,
  `chemin_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `photo_jeux`
--

INSERT INTO `photo_jeux` (`photo_jeux_id`, `jeux_id`, `chemin_photo`) VALUES
(1, 1, 'images/01.jpg'),
(2, 2, 'images/02.jpg'),
(3, 3, 'images/03.jpg'),
(4, 4, 'images/thumb01.jpg'),
(5, 5, 'images/thumb02.jpg'),
(6, 6, 'images/thumb03.jpg'),
(7, 7, 'images/thumb04.jpg'),
(8, 8, 'images/thumb05.jpg'),
(9, 9, 'images/thumb06.jpg'),
(10, 10, 'images/thumb07.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `plateforme`
--

CREATE TABLE `plateforme` (
  `plateforme_id` int(11) NOT NULL,
  `plateforme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `plateforme`
--

INSERT INTO `plateforme` (`plateforme_id`, `plateforme`) VALUES
(1, 'Playstation 4'),
(2, 'Xbox One'),
(3, 'Nintendo Wii U'),
(4, 'Windows'),
(5, 'Playstation 3'),
(6, 'Xbox 360'),
(7, 'Nintendo Switch'),
(8, 'Playstation Vita');

-- --------------------------------------------------------

--
-- 表的结构 `type_paiement`
--

CREATE TABLE `type_paiement` (
  `type_paiement_id` int(11) NOT NULL,
  `type_paiement` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `type_paiement`
--

INSERT INTO `type_paiement` (`type_paiement_id`, `type_paiement`) VALUES
(1, 'Comptant'),
(2, 'Chèque'),
(3, 'Paypal');

-- --------------------------------------------------------

--
-- 表的结构 `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `type_utilisateur_id` int(11) NOT NULL,
  `type_utilisateur` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`type_utilisateur_id`, `type_utilisateur`) VALUES
(1, 'Membre'),
(2, 'Admin'),
(3, 'Super Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`achat_id`),
  ADD KEY `FK_assosier_achat` (`type_paiement_id`),
  ADD KEY `FK_faire` (`membre_id`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Indexes for table `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
  ADD PRIMARY KEY (`jeux_id`,`categorie_id`),
  ADD KEY `FK_categorie_jeux2` (`categorie_id`);

--
-- Indexes for table `commentaire_jeux`
--
ALTER TABLE `commentaire_jeux`
  ADD PRIMARY KEY (`commentaire_jeux_id`),
  ADD KEY `FK_composer` (`membre_id`),
  ADD KEY `FK_concerner` (`jeux_id`);

--
-- Indexes for table `destinataire`
--
ALTER TABLE `destinataire`
  ADD PRIMARY KEY (`membre_id`,`msg_id`),
  ADD KEY `FK_destinataire2` (`msg_id`);

--
-- Indexes for table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`jeux_id`),
  ADD KEY `FK_avoir` (`membre_id`),
  ADD KEY `FK_classer` (`plateforme_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `FK_associer_louer` (`type_paiement_id`),
  ADD KEY `FK_louer` (`membre_id`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`membre_id`),
  ADD UNIQUE KEY `courriel` (`courriel`),
  ADD KEY `FK_etre` (`type_utilisateur_id`);

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
  ADD KEY `FK_posseder` (`jeux_id`);

--
-- Indexes for table `plateforme`
--
ALTER TABLE `plateforme`
  ADD PRIMARY KEY (`plateforme_id`);

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
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `achat`
--
ALTER TABLE `achat`
  MODIFY `achat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `categorie`
--
ALTER TABLE `categorie`
  MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用表AUTO_INCREMENT `commentaire_jeux`
--
ALTER TABLE `commentaire_jeux`
  MODIFY `commentaire_jeux_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `jeux`
--
ALTER TABLE `jeux`
  MODIFY `jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `membre`
--
ALTER TABLE `membre`
  MODIFY `membre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `photo_jeux`
--
ALTER TABLE `photo_jeux`
  MODIFY `photo_jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `plateforme`
--
ALTER TABLE `plateforme`
  MODIFY `plateforme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `type_paiement`
--
ALTER TABLE `type_paiement`
  MODIFY `type_paiement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `type_utilisateur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 限制导出的表
--

--
-- 限制表 `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `FK_assosier_achat` FOREIGN KEY (`type_paiement_id`) REFERENCES `type_paiement` (`type_paiement_id`),
  ADD CONSTRAINT `FK_faire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- 限制表 `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
  ADD CONSTRAINT `FK_categorie_jeux` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`),
  ADD CONSTRAINT `FK_categorie_jeux2` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`categorie_id`);

--
-- 限制表 `commentaire_jeux`
--
ALTER TABLE `commentaire_jeux`
  ADD CONSTRAINT `FK_composer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_concerner` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);

--
-- 限制表 `destinataire`
--
ALTER TABLE `destinataire`
  ADD CONSTRAINT `FK_destinataire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_destinataire2` FOREIGN KEY (`msg_id`) REFERENCES `messagerie` (`msg_id`);

--
-- 限制表 `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `FK_avoir` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
  ADD CONSTRAINT `FK_classer` FOREIGN KEY (`plateforme_id`) REFERENCES `plateforme` (`plateforme_id`);

--
-- 限制表 `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_associer_louer` FOREIGN KEY (`type_paiement_id`) REFERENCES `type_paiement` (`type_paiement_id`),
  ADD CONSTRAINT `FK_louer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- 限制表 `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `FK_etre` FOREIGN KEY (`type_utilisateur_id`) REFERENCES `type_utilisateur` (`type_utilisateur_id`);

--
-- 限制表 `messagerie`
--
ALTER TABLE `messagerie`
  ADD CONSTRAINT `FK_assigner_emmeteur` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- 限制表 `photo_jeux`
--
ALTER TABLE `photo_jeux`
  ADD CONSTRAINT `FK_posseder` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
