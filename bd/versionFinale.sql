-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 08, 2018 at 09:45 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `GameXchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `achat`
--

CREATE TABLE `achat` (
    `achat_id` int(11) NOT NULL,
    `type_paiement_id` int(11) NOT NULL,
    `membre_id` int(11) NOT NULL,
    `jeux_id` int(11) NOT NULL,
    `date_achat` datetime NOT NULL,
    `prix_achat` decimal(15,2) NOT NULL,
    `transaction_id` varchar(255) DEFAULT NULL,
    `membre_plus` tinyint(1) NOT NULL,
    `achat_actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `achat`
--

INSERT INTO `achat` (`achat_id`, `type_paiement_id`, `membre_id`, `jeux_id`, `date_achat`, `prix_achat`, `transaction_id`, `membre_plus`, `achat_actif`) VALUES
(1, 3, 1, 2, '2018-09-16 04:13:54', '49.50', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
    `categorie_id` int(11) NOT NULL,
    `categorie` varchar(255) DEFAULT NULL,
    `categorie_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie`, `categorie_active`) VALUES
(1, 'Action', 1),
(2, 'Combat', 1),
(3, 'Aventure', 1),
(4, 'Sports', 1),
(5, 'Course', 1),
(6, 'Simulation', 1),
(7, 'Stratégie', 1),
(8, 'Plate-forme', 1),
(9, 'Labyrinthe', 1),
(10, 'Musique', 1),
(11, 'FPS', 1),
(12, 'RPG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorie_jeux`
--

CREATE TABLE `categorie_jeux` (
    `jeux_id` int(11) NOT NULL,
    `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie_jeux`
--

INSERT INTO `categorie_jeux` (`jeux_id`, `categorie_id`) VALUES
(2, 1),
(4, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(1, 3),
(2, 3),
(3, 3),
(8, 3),
(10, 3),
(3, 5),
(5, 5),
(7, 5),
(10, 6),
(1, 8),
(3, 8),
(4, 8),
(6, 8),
(6, 10),
(8, 11);

-- --------------------------------------------------------

--
-- Table structure for table `destinataire`
--

CREATE TABLE `destinataire` (
    `membre_id` int(11) NOT NULL,
    `msg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `echange`
--

CREATE TABLE `echange` (
    `echange_id` int(11) NOT NULL,
    `jeu_propose` int(11) NOT NULL,
    `prix_propose` decimal(15,2) DEFAULT NULL,
    `jeu_echange` int(11) NOT NULL,
    `prix_echange` decimal(15,2) DEFAULT NULL,
    `date_echange` datetime NOT NULL,
    `contre_offre` int(11) DEFAULT NULL,
    `echange_recu` tinyint(1) NOT NULL DEFAULT '0',
    `echange_accepte` tinyint(1) DEFAULT NULL,
    `echange_actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
    `evaluation_id` int(11) NOT NULL,
    `jeton` varchar(255) NOT NULL,
    `jeux_id` int(11) NOT NULL,
    `membre_id` int(11) NOT NULL,
    `achat_id` int(11) DEFAULT NULL,
    `location_id` int(11) DEFAULT NULL,
    `commentaire_jeu` text,
    `commentaire_membre` text,
    `evaluation_jeu` decimal(6,5) DEFAULT NULL,
    `evaluation_membre` decimal(6,5) DEFAULT NULL,
    `date_evaluation` datetime DEFAULT NULL,
    `evaluation_jeu_active` tinyint(1) NOT NULL DEFAULT '1',
    `evaluation_membre_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `jeton`, `jeux_id`, `membre_id`, `achat_id`, `location_id`, `commentaire_jeu`, `commentaire_membre`, `evaluation_jeu`, `evaluation_membre`, `date_evaluation`, `evaluation_jeu_active`, `evaluation_membre_active`) VALUES
(1, 'f9bhsY32jd0n58Djs3bail7m4', 1, 3, NULL, 1, 'Nec nec curabitur. Donec dictum, lorem tristique, dui at a sit. Pulvinar integer pellentesque nunc in, sed ipsum ipsum velit. Pede purus quam porta, nunc a in cum massa donec. Ipsum adipiscing leo orci risus molestiae.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce venenatis et quam ut mattis. Ut eleifend bibendum magna, eu volutpat metus lacinia vel. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam gravida diam eu dictum interdum. Aliquam erat enim.', '4.50000', '4.00000', '2018-09-10 04:30:54', 1, 1),
(2, 'os8eHb3ya6b4g0ng9qxafzv4i', 3, 6, NULL, 2, 'Habitant id sollicitudin eu luctus, ut sem posuere imperdiet, a commodo vel proin tempus urna. Proin amet litora condimentum. Odio leo nunc eveniet arcu dolor pretium. Turpis et, proin blandit nonummy et, semper viverra lectus. Sollicitudin arcu.', 'Maecenas ut facilisis ligula. Sed quis laoreet metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas enim lorem, faucibus vitae ultrices sit amet, tincidunt.', '4.00000', '4.50000', '2018-09-13 04:30:54', 1, 1),
(3, '4G01gQlsE5r3ya6bwXta8Zv2k', 5, 1, NULL, 3, 'Magna tincidunt volutpat dictum mollis, phasellus lacus nam nec quis. Quis molestiae tincidunt rutrum ut qui tristique. Integer praesent sit lectus, felis est, praesent aliquam eget mattis, dolores nam non vestibulum pede. Ipsum lacus elementum eveniet, lacinia magna. Leo sed velit, justo consequat ultricies.', 'Sed ac pulvinar ante, sit amet tristique elit. Sed pellentesque lacus sed sem scelerisque, id fringilla odio rutrum. Nullam fermentum feugiat sollicitudin. Donec ut lacus et mauris eleifend imperdiet nec vel erat. Ut ultricies lorem.', '3.50000', '5.00000', '2018-09-12 04:15:54', 1, 1),
(4, 'R9yw2jd0n58djS3ta1hUql7mp', 7, 9, NULL, 4, 'Mauris eu rutrum. Erat imperdiet mus vestibulum, risus vel sollicitudin. Potenti adipiscing mattis, risus ante orci vehicula, ante vestibulum ac feugiat aenean urna, quam veritatis, curabitur vestibulum sollicitudin. Odio nibh volutpat maiores penatibus nam. Sit suspendisse ipsum elit nunc mauris, mauris lectus rerum et mauris nulla, scelerisque odio.', 'Nulla molestie nulla arcu, a dapibus lorem pulvinar ac. Phasellus libero ligula, finibus quis pulvinar a, tincidunt quis ligula. Etiam id tortor ac nunc elementum pretium. Quisque fringilla eros vel laoreet congue. Aliquam facilisis quis nibh lacinia aliquet. Sed quis.', '4.00000', '4.00000', '2018-09-15 11:35:23', 1, 1),
(5, 'v8djs3bf9BH1sy2jd0n4iL7mK', 2, 5, 1, NULL, 'Fusce tellus ac. Dolor quisque justo in per. Et vitae, elit tellus, amet integer vel, integer ut nunc in venenatis. Sed in sit ultrices et aenean lorem, curabitur dictum diam tincidunt id, hac vestibulum, cras lectus, et adipiscing in. Aenean mi sit libero, ut viverra cum sodales sed orci non, maecenas nisl.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut.', '4.50000', '3.50000', '2018-09-17 10:15:21', 1, 1),
(6, '2j1qy38DC0n5f9BhsI3bAml7v', 9, 2, NULL, 5, 'Elit tellus ultricies ut et. Lectus libero vehicula elit mauris eros, sed luctus. Ac nisl aliquam eu volutpat nulla amet, mi conubia eget mattis quam vestibulum, commodo sed pharetra metus, a natoque, pellentesque arcu fusce. Ut vel cras nunc tempus. Tincidunt et aenean, vulputate eros magna felis, placerat ut odio massa proin fringilla ipsum, pede dictum amet at.', 'Sed varius dui nisl, eu efficitur ipsum feugiat sed. Nulla sed dui risus. Fusce euismod diam vel mi consectetur, sit amet lacinia quam auctor. Cras tincidunt consequat tellus ac feugiat. Curabitur rhoncus.', '3.50000', '3.50000', '2018-09-12 09:23:30', 0, 1),
(7, 'M6f9WhqyV21d0n58dJS3bxUl7', 1, 8, NULL, 6, 'Proin natoque sed a, sapien nunc, in mauris placerat nibh tortor nec, a risus proin mi aliquam cursus. Varius vestibulum pellentesque et wisi, libero est eleifend sem, quasi fermentum risus eros morbi ligula. Non tellus lorem augue. Tincidunt ornare. Reprehenderit eget, vulputate eget.', 'Maecenas tempor mauris et sem laoreet, ac fringilla velit accumsan. Nam quis tortor quis lorem dapibus porttitor a at odio. Integer elementum tincidunt cursus. Donec auctor sed quam sit amet ultricies. Vestibulum suscipit dolor nec pulvinar.', '4.00000', '5.00000', '2018-09-12 11:27:10', 1, 1),
(8, 'j0N6xk8diLm4s3baf9lhFy2vu', 3, 7, NULL, 7, 'Non quisque sollicitudin lacinia tempor, torquent ipsum velit, maecenas et mollis vel, vitae sit sollicitudin porta mi libero. Felis felis ut nec. Lectus morbi sodales vestibulum habitasse consectetuer odio, curabitur in urna integer quis duis urna. Nulla curabitur vivamus faucibus dui. Praesent vestibulum voluptate justo nunc magna, fermentum consectetuer at.', 'Aenean et nibh rutrum, ullamcorper tellus in, posuere urna. Nam aliquet nisl vitae sem gravida sodales. Vestibulum iaculis orci quam, in commodo felis eleifend id. Proin ac elit ultrices ex hendrerit bibendum. Sed lobortis ultricies turpis at ultricies. Cras et leo vel ante gravida aliquam.', '5.00000', '5.00000', '2018-09-13 01:15:20', 1, 1),
(9, 'd0nV8Zjf9bcSy3Ail7m4s3ba6', 5, 10, NULL, 8, 'In donec dignissim, nullam amet sed nunc. Purus ac libero libero ligula euismod, eu id, ut cum neque porttitor malesuada. Magna tempor justo. Nulla sollicitudin quam placerat cras, ligula sit, molestie sit id arcu litora cras, et lectus vestibulum, suscipit risus amet dui neque luctus. Eget non, sodales pellentesque et, exercitation urna wisi fusce volutpat in, odio felis leo leo quia ut, tincidunt nullam. Eget tellus sed dolor dictum.', 'Integer laoreet ornare lacus eu consequat. Maecenas facilisis tortor neque, lacinia lobortis lacus aliquam nec. Nulla nibh ligula, commodo id velit sit amet, varius tincidunt metus. Pellentesque ut urna condimentum, placerat ligula et, pharetra nibh. Nunc eu vehicula ipsum.', '3.50000', '1.00000', '2018-09-13 12:50:32', 1, 1),
(10, 'vf9bT2y3xP0n5BdjRb6ail7Jp', 7, 7, NULL, 9, 'At pede a dolor pretium quisque. Eget vivamus ac, ante dolorem vitae vitae, sit tortor condimentum gravida massa ultrices libero. Diam suspendisse enim ut nonummy, dui justo metus ultricies consectetuer ipsum massa, scelerisque curae vestibulum elit metus at magna. Massa pretium lorem, a luctus non tempus volutpat turpis. Leo nunc sem orci cum pretium, faucibus gravida tortor voluptatem ac gravida tincidunt, tortor non sit. Penatibus sed orci eu conubia.', 'Sed auctor lobortis est, id convallis turpis condimentum quis. Sed consequat, sem eget scelerisque ullamcorper, dolor elit pretium lectus, eget blandit urna neque nec felis. Nunc convallis dui nec vehicula sodales. Maecenas mi enim, vestibulum.', '4.00000', '4.50000', '2018-09-17 08:44:32', 1, 1),
(11, '0n5Dx3bAy8dWf9b2jl74Mhsz3', 5, 5, NULL, 10, 'Laoreet egestas morbi in ornare interdum. Dui laoreet sapien fermentum quos arcu sed, convallis convallis lobortis. Vel sed eget mauris, iaculis parturient. Ultricies libero a. Diam et pede, assumenda reiciendis metus libero velit.', 'Morbi ut ante enim. Praesent fringilla feugiat placerat. Donec imperdiet, nisl vel consequat ultricies, arcu neque congue sem, eget varius urna ligula ut massa. Nam sit amet erat hendrerit, lacinia ante sit amet, porttitor lorem. Integer imperdiet et sem nec.', '0.50000', '1.00000', '2018-09-14 11:22:52', 1, 1),
(12, 'yJjRfs9tm2j3baD0nT8sI7Qx2', 9, 1, NULL, 11, 'Lectus ante. Ante eget turpis nulla, leo lorem sed id. Consectetuer porttitor sed unde laoreet consectetuer, tempus interdum mauris eu, in tempus aliquam quis mus ea. Euismod vestibulum dignissim vel, tellus purus. Consectetuer aliquet commodo vestibulum netus nunc rutrum.', 'Nam eu gravida ipsum. Vestibulum erat leo, efficitur a magna nec, lacinia pharetra nibh. Sed eget laoreet nibh, eget porttitor ipsum. Aenean id dui id dolor commodo fringilla. Mauris nulla lorem, suscipit eget.', '4.50000', '4.50000', '2018-09-15 04:22:15', 1, 1),
(13, '1fw30dOn58dEf9bH6ysaZtm4L', 3, 2, NULL, 12, 'Molestie suscipit, tortor lacus, hendrerit in dui massa congue. Ut justo sit vel vestibulum at, lacinia ut, etiam nam qui nec viverra laboriosam, nonummy in ultrices, porttitor pede vel erat nam non. A convallis. In ac est amet praesent quis, est in. Porta euismod, ut nulla in risus, vel volutpat placerat, dapibus hendrerit quis.', 'Nam at nisi sit amet massa sagittis vestibulum sit amet eget augue. Pellentesque eget velit eu nunc iaculis sollicitudin eget eu elit. Praesent blandit ligula vitae tempor ultricies. Aliquam euismod, felis in tristique aliquet, nulla leo sagittis.', '4.00000', '3.00000', '2018-09-15 09:24:32', 1, 1),
(14, 'h08s9b7jSxtC5iy3f2jQl7p4a', 1, 5, NULL, 13, 'Natoque enim mollis enim ut donec morbi, sociis ante, risus vel eros proin malesuada, hendrerit mauris libero nisl turpis arcu iaculis. Do diam, dignissim erat neque dui, est elit risus lorem dolor consectetuer. Convallis vehicula sodales semper tempor sit. Et dictum sed nulla suspendisse, metus sollicitudin. Ac proin vitae curabitur. Viverra eget est a et, wisi aliquet interdum, vel neque luctus lectus sit condimentum.', 'Duis magna lacus, posuere nec nisi at, malesuada hendrerit augue. Nunc ac eros accumsan, varius dolor vitae, sodales erat. Donec pellentesque molestie elit, quis ultricies erat rhoncus a. Sed commodo.', '4.50000', '4.00000', '2018-09-17 07:22:21', 1, 1),
(15, '0bw2jdil7M6un5ef9bhfy3gjc', 5, 7, NULL, 14, 'At fermentum cum. Purus curabitur, neque eget vel, consectetuer magna suspendisse, quis ac mattis. Et magna maecenas eros, mus ligula condimentum sem lorem dui. Amet tellus id quam, tortor metus amet cras nulla nonummy. Metus luctus feugiat, sit semper fusce porttitor tempus minim imperdiet, amet neque amet feugiat, auctor placerat, et luctus blandit aliquam elit. Libero amet, mauris nunc suspendisse.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tellus ligula, tincidunt nec dolor gravida, interdum hendrerit metus. Ut semper nibh lectus, vitae commodo neque placerat a. Maecenas at mauris.', '2.50000', '4.50000', '2018-09-19 09:23:12', 1, 1),
(16, 'X2rh0N57Jsf3cYd1b9pl3m4iZ', 1, 3, NULL, 15, 'Dolor quam malesuada, nulla ultricies tristique scelerisque turpis viverra lectus, fermentum nam. Proin vestibulum. Facilisi tristique id aenean. Vestibulum commodo neque nulla gravida nulla, facilisis parturient pellentesque erat curabitur arcu mattis. Dui et, mauris tellus aenean pede nibh ornare.', 'Nunc fermentum eget nunc quis volutpat. Aliquam placerat auctor tempus. Pellentesque arcu lectus, vehicula at pulvinar et, laoreet eu ante. Aliquam sodales ante eu lobortis gravida. Phasellus id laoreet mauris. Mauris suscipit laoreet justo vel eleifend. Nulla ac.', '3.00000', '3.00000', '2018-09-17 09:44:30', 1, 1),
(17, 'gQ32Es3bf9uhI0n5dTjl7m5Cw', 5, 6, NULL, 16, 'Vestibulum ipsum, ut quam tortor arcu justo in pede, ut dolor, sed eleifend, vestibulum eu a. Nulla vel leo sem, justo rutrum nunc consectetuer ut enim. Ut odio, vitae malesuada pede, ac eget pharetra turpis interdum, mauris ut. Suscipit a in. Imperdiet amet dui suscipit luctus, nunc etiam vitae sapien arcu blandit, suspendisse enim aliquam ridiculus id rutrum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pharetra ut tortor id fringilla. Praesent a mattis risus, ut laoreet velit. Nunc dapibus imperdiet velit, sed hendrerit eros dictum ut. Fusce efficitur feugiat blandit.', '4.50000', '5.00000', '2018-09-19 02:24:33', 1, 1),
(18, 'sl1b4h8Tw4j9bil3mf2je0nv8', 7, 4, NULL, 17, 'Itaque lectus. Fusce sit orci nulla gravida mauris leo. Tristique sapien, justo nascetur augue nullam. Tellus mattis culpa eu magna leo, aliquet etiam duis ornare vestibulum, orci et elit nunc nulla ultrices, velit justo vel et ipsum ultricies vivamus, sit fermentum ligula magna. Non a mi ut eros imperdiet. Est tempus in erat.', 'Ut efficitur sodales egestas. Etiam non ipsum quis lorem mollis iaculis. Vivamus id nibh at lacus gravida aliquam nec ut nibh. Sed blandit massa et eros aliquet, eget ultrices leo ornare. Vestibulum egestas, sem eget rutrum tincidunt, dolor ex semper eros, sit.', '3.50000', '4.50000', '2018-09-18 10:06:24', 1, 1),
(19, 'HNy5e7pl2jD02b8kF93iYs3cq', 9, 1, NULL, 18, 'Eu mattis ligula ut, interdum pede felis, tellus curabitur laoreet. Aliquam nulla elit in tellus justo, quam habitasse sollicitudin wisi donec, vestibulum tristique ipsum varius amet urna arcu, cras nec eos adipiscing orci amet. Wisi rhoncus. Augue vehicula. Risus pellentesque, eget fugiat vestibulum ut, nascetur vivamus fuga tellus curae sodales aenean.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim orci pretium porta volutpat. Etiam at lorem nec nisl pellentesque rutrum vel quis nisi. Aliquam risus mauris, convallis ac vulputate ac, commodo a erat. Nunc at leo sit amet ligula ultrices porta. Nullam non urna accumsan.', '4.00000', '5.00000', '2018-09-20 11:16:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jeux`
--

CREATE TABLE `jeux` (
    `jeux_id` int(11) NOT NULL,
    `membre_id` int(11) NOT NULL,
    `plateforme_id` int(11) NOT NULL,
    `titre` varchar(255) NOT NULL,
    `no_serie` varchar(255) DEFAULT NULL,
    `concepteur` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `prix` decimal(15,2) NOT NULL,
    `date_ajout` datetime NOT NULL,
    `evaluation_globale` decimal(6,5) DEFAULT NULL,
    `location` tinyint(1) NOT NULL,
    `vendu` tinyint(1) NOT NULL DEFAULT '0',
    `jeux_valide` tinyint(1) NOT NULL DEFAULT '0',
    `jeux_actif` tinyint(1) NOT NULL DEFAULT '1',
    `jeux_banni` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jeux`
--

INSERT INTO `jeux` (`jeux_id`, `membre_id`, `plateforme_id`, `titre`, `no_serie`, `concepteur`, `description`, `prix`, `date_ajout`, `evaluation_globale`, `location`, `vendu`, `jeux_valide`, `jeux_actif`, `jeux_banni`) VALUES
(1, 1, 1, 'Super Mario U 2', NULL, 'Nintendo', 'Curabitur sit amet convallis felis. Mauris ac massa justo. Aliquam ex nisl, viverra vitae nulla eu, vulputate rhoncus dui. Nullam a massa ligula. Suspendisse sollicitudin iaculis lacus, et interdum justo maximus a. Phasellus ullamcorper aliquet dolor, eget mattis mauris ornare a. Nam condimentum purus dolor, pellentesque hendrerit tortor pellentesque sit amet. Sed faucibus lectus magna, non iaculis lorem sodales id.', '3.50', '2018-09-10 04:13:54', '4.00000', 1, 0, 1, 1, 0),
(2, 2, 2, 'Shadow of the Colossus', NULL, 'Sony', 'Mauris vehicula sapien ac nulla pharetra, sit amet commodo erat feugiat. Phasellus varius massa mauris, ut volutpat ipsum viverra eget. Nunc ut orci blandit, semper nunc id, lacinia odio. Phasellus cursus metus gravida ex consequat tristique. In hac habitasse platea.', '49.50', '2018-09-10 04:15:54', '4.50000', 0, 1, 1, 0, 0),
(3, 3, 3, 'Sonic The Hedgehog', NULL, 'SEGA', 'Nullam consectetur tempor nibh, sit amet mollis augue suscipit vel. Nullam vestibulum mi sed lectus pharetra condimentum. Quisque varius, augue in scelerisque iaculis, lectus urna facilisis urna, non feugiat est nunc fringilla diam. Fusce vel turpis semper, euismod eros et, fermentum diam. Donec sed nulla in ipsum pulvinar rutrum id.', '4.99', '2018-09-11 11:24:30', '4.33333', 1, 0, 1, 1, 0),
(4, 4, 4, 'Megaman', NULL, 'CAPCOM', 'Mauris pharetra egestas sem, eget euismod enim euismod nec. Ut leo augue, bibendum sed metus et, faucibus pretium nulla. Morbi auctor risus ex, vulputate tristique orci volutpat non. Aliquam dapibus.', '24.75', '2018-09-12 04:12:20', '-1.00000', 0, 0, 1, 1, 0),
(5, 5, 3, 'Mario Kart Double Dash', NULL, 'Nintendo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porttitor nisi. Ut placerat sapien et consequat aliquam. Duis tincidunt fermentum diam, a porta dui tristique id. Curabitur tristique massa hendrerit nulla mattis, ut facilisis.', '3.33', '2018-09-13 12:44:33', '2.90000', 1, 0, 1, 1, 0),
(6, 6, 7, 'Donkey Kong Country', NULL, 'Nintendo', 'Praesent euismod, nibh id consequat porta, lorem nunc tempus mi, quis accumsan justo odio egestas risus. Vivamus ullamcorper euismod porttitor. Aenean tellus ligula, ultrices sit amet enim vel, eleifend iaculis.', '22.95', '2018-09-14 10:02:50', '-1.00000', 0, 0, 1, 1, 0),
(7, 7, 4, 'Shift 2 Unleashed', NULL, 'EA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque aliquam ornare. Quisque faucibus auctor nulla, euismod commodo quam posuere quis. Phasellus tempus justo lorem, eget gravida est convallis ac. Nulla consectetur facilisis lacus vel rutrum. Nulla pharetra dapibus ex. Proin orci.', '2.50', '2018-09-15 06:24:30', '3.83333', 1, 0, 1, 1, 0),
(8, 8, 6, 'Halo Reach', NULL, 'Bungie', 'Cras aliquam erat massa, in ultricies purus elementum sit amet. Nulla nec imperdiet est, sit amet pellentesque magna. Suspendisse neque urna, ornare vel massa posuere, dapibus mollis ipsum. Nulla facilisi. Interdum et malesuada fames ac ante ipsum primis in.', '44.50', '2018-09-16 07:12:20', '-1.00000', 0, 0, 1, 1, 0),
(9, 9, 8, 'The Secret of Monkey Island', NULL, 'SEGA', 'Nullam malesuada orci et urna tristique, a efficitur tellus lacinia. Suspendisse potenti. Nulla luctus enim turpis, eu cursus erat malesuada eu. Quisque tempor, urna et fringilla congue, enim elit dignissim ligula, vel ultricies elit leo at ligula. Fusce tincidunt dui ac varius cursus. Praesent sollicitudin ligula sapien. Nullam nec tincidunt quam.', '6.00', '2018-09-17 08:44:33', '4.00000', 1, 0, 1, 1, 0),
(10, 10, 2, 'Assassins Creed BrotherHood', NULL, 'UBISOFT', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac quam id nisl porttitor rutrum a vitae odio. Etiam ac massa viverra, finibus mi vel, pellentesque nunc. Pellentesque efficitur purus mi, in lobortis magna consequat ut. Orci varius natoque penatibus et magnis.', '35.00', '2018-09-17 09:02:50', '-1.00000', 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jeux_non_dispos`
--

CREATE TABLE `jeux_non_dispos` (
    `jeux_non_dispo_id` int(11) NOT NULL,
    `jeux_id` int(11) NOT NULL,
    `date_debut` datetime NOT NULL,
    `date_fin` datetime NOT NULL,
    `non_dispo_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jeux_non_dispos`
--

INSERT INTO `jeux_non_dispos` (`jeux_non_dispo_id`, `jeux_id`, `date_debut`, `date_fin`, `non_dispo_active`) VALUES
(1, 9, '2018-12-17 00:00:00', '2019-01-06 00:00:00', 1),
(2, 1, '2018-12-08 00:00:00', '2018-12-16 00:00:00', 1),
(3, 7, '2019-02-01 00:00:00', '2019-02-10 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
    `location_id` int(11) NOT NULL,
    `type_paiement_id` int(11) NOT NULL,
    `membre_id` int(11) NOT NULL,
    `jeux_id` int(11) NOT NULL,
    `date_location` datetime NOT NULL,
    `date_debut` datetime NOT NULL,
    `date_retour` datetime NOT NULL,
    `prix_location` decimal(15,2) NOT NULL,
    `transaction_id` varchar(255) DEFAULT NULL,
    `membre_plus` tinyint(1) NOT NULL,
    `location_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `type_paiement_id`, `membre_id`, `jeux_id`, `date_location`, `date_debut`, `date_retour`, `prix_location`, `transaction_id`, `membre_plus`, `location_active`) VALUES
(1, 3, 3, 1, '2018-08-01 09:14:29', '2018-08-10 00:00:00', '2018-08-16 00:00:00', '24.50', NULL, 1, 1),
(2, 2, 6, 3, '2018-08-02 08:49:12', '2018-08-04 00:00:00', '2018-08-10 00:00:00', '34.93', 'Cheque', 0, 1),
(3, 1, 1, 5, '2018-08-03 19:55:27', '2018-08-11 00:00:00', '2018-08-20 00:00:00', '33.30', 'Comptant', 0, 1),
(4, 3, 9, 7, '2018-08-04 20:26:49', '2018-08-08 00:00:00', '2018-08-30 00:00:00', '57.50', NULL, 0, 1),
(5, 3, 2, 9, '2018-08-15 01:14:11', '2018-08-21 00:00:00', '2018-09-03 00:00:00', '84.00', NULL, 0, 1),
(6, 1, 8, 1, '2018-08-20 23:12:08', '2018-08-23 00:00:00', '2018-09-08 00:00:00', '59.50', 'Comptant', 0, 1),
(7, 3, 7, 3, '2018-08-26 14:42:31', '2018-08-27 00:00:00', '2018-09-09 00:00:00', '69.86', NULL, 1, 1),
(8, 2, 10, 5, '2018-09-01 14:09:29', '2018-09-05 00:00:00', '2018-09-09 00:00:00', '16.65', 'Cheque', 0, 1),
(9, 1, 7, 7, '2018-09-05 09:29:14', '2018-09-08 00:00:00', '2018-09-13 00:00:00', '15.00', 'Comptant', 1, 1),
(10, 1, 10, 5, '2018-09-13 07:05:54', '2018-09-25 00:00:00', '2018-10-01 00:00:00', '23.31', 'Comptant', 0, 1),
(11, 3, 1, 9, '2018-09-13 20:48:52', '2018-09-19 00:00:00', '2018-09-21 00:00:00', '18.00', NULL, 0, 1),
(12, 1, 2, 3, '2018-09-29 12:43:28', '2018-10-08 00:00:00', '2018-10-15 00:00:00', '39.92', 'Comptant', 0, 1),
(13, 2, 5, 1, '2018-10-01 14:29:09', '2018-10-11 00:00:00', '2018-10-25 00:00:00', '52.50', 'Cheque', 0, 1),
(14, 3, 7, 5, '2018-10-01 22:09:02', '2018-10-06 00:00:00', '2018-10-17 00:00:00', '39.96', NULL, 1, 1),
(15, 3, 3, 1, '2018-10-08 19:58:01', '2018-11-12 00:00:00', '2018-11-16 00:00:00', '17.50', NULL, 1, 1),
(16, 1, 6, 5, '2018-10-09 17:53:17', '2018-10-22 00:00:00', '2018-11-15 00:00:00', '83.25', 'Comptant', 0, 1),
(17, 3, 4, 7, '2018-10-11 18:06:38', '2018-10-20 00:00:00', '2018-10-24 00:00:00', '12.50', NULL, 0, 1),
(18, 1, 1, 9, '2018-10-20 19:14:23', '2018-10-24 00:00:00', '2018-11-01 00:00:00', '48.00', 'Comptant', 0, 1),
(19, 1, 7, 7, '2018-11-26 23:04:37', '2018-12-05 00:00:00', '2018-12-13 00:00:00', '22.50', 'Comptant', 1, 1),
(20, 1, 11, 5, '2018-12-19 11:14:56', '2018-12-25 00:00:00', '2019-01-01 00:00:00', '26.64', 'Comptant', 0, 1),
(21, 3, 3, 1, '2019-01-02 16:48:39', '2019-01-10 00:00:00', '2019-01-16 00:00:00', '24.50', NULL, 1, 1),
(22, 2, 6, 3, '2019-01-03 08:42:25', '2019-01-06 00:00:00', '2019-01-10 00:00:00', '24.95', 'Cheque', 0, 1),
(23, 1, 1, 5, '2019-01-05 16:10:46', '2019-01-12 00:00:00', '2019-01-20 00:00:00', '29.97', 'Comptant', 0, 1),
(24, 3, 9, 7, '2019-01-07 19:20:40', '2019-01-13 00:00:00', '2019-01-30 00:00:00', '45.00', NULL, 0, 1),
(25, 3, 2, 9, '2019-01-12 20:53:32', '2019-01-31 00:00:00', '2019-02-04 00:00:00', '30.00', NULL, 0, 1),
(26, 1, 8, 1, '2019-01-21 09:29:14', '2019-01-23 00:00:00', '2019-02-06 00:00:00', '52.50', 'Comptant', 0, 1),
(27, 3, 7, 3, '2019-01-27 06:02:39', '2019-01-31 00:00:00', '2019-02-06 00:00:00', '34.93', NULL, 1, 1),
(28, 2, 10, 5, '2019-01-30 21:13:03', '2019-02-02 00:00:00', '2019-02-09 00:00:00', '26.64', 'Cheque', 0, 1),
(29, 1, 7, 3, '2019-02-05 22:01:48', '2019-02-11 00:00:00', '2019-02-13 00:00:00', '14.97', 'Comptant', 1, 1),
(30, 1, 12, 5, '2019-02-12 00:24:05', '2019-02-25 00:00:00', '2019-03-01 00:00:00', '16.65', 'Comptant', 0, 1),
(31, 3, 1, 9, '2019-02-13 15:17:23', '2019-02-14 00:00:00', '2019-02-20 00:00:00', '42.00', NULL, 0, 1),
(32, 1, 2, 3, '2019-03-03 13:46:59', '2019-03-08 00:00:00', '2019-03-16 00:00:00', '44.91', 'Comptant', 0, 1),
(33, 2, 5, 1, '2019-03-06 05:45:06', '2019-03-11 00:00:00', '2019-03-24 00:00:00', '49.00', 'Cheque', 0, 1),
(34, 3, 7, 5, '2019-03-07 18:40:08', '2019-03-10 00:00:00', '2019-03-20 00:00:00', '36.63', NULL, 1, 1),
(35, 3, 3, 1, '2019-03-09 19:53:22', '2019-03-16 00:00:00', '2019-04-16 00:00:00', '108.50', NULL, 1, 1),
(36, 1, 6, 5, '2019-03-31 22:31:51', '2019-04-05 00:00:00', '2019-04-18 00:00:00', '46.62', 'Comptant', 0, 1),
(37, 3, 4, 7, '2019-04-05 18:12:41', '2019-04-10 00:00:00', '2019-04-23 00:00:00', '35.00', NULL, 0, 1),
(38, 1, 1, 9, '2019-04-10 15:27:53', '2019-04-12 00:00:00', '2019-04-17 00:00:00', '36.00', 'Comptant', 0, 1),
(39, 1, 7, 7, '2019-05-05 11:44:20', '2019-05-25 00:00:00', '2019-06-13 00:00:00', '47.50', 'Comptant', 1, 1),
(40, 1, 13, 5, '2019-05-22 19:39:04', '2019-05-25 00:00:00', '2019-06-01 00:00:00', '26.64', 'Comptant', 0, 1),
(41, 1, 7, 9, '2019-05-29 23:18:37', '2019-06-06 00:00:00', '2019-06-13 00:00:00', '48.00', 'Comptant', 1, 1),
(42, 1, 14, 5, '2019-06-06 22:13:12', '2019-06-25 00:00:00', '2019-07-01 00:00:00', '23.31', 'Comptant', 0, 1),
(43, 3, 1, 9, '2019-06-12 02:51:23', '2019-06-19 00:00:00', '2019-06-21 00:00:00', '18.00', NULL, 0, 1),
(44, 1, 2, 3, '2019-06-27 16:58:04', '2019-07-08 00:00:00', '2019-07-15 00:00:00', '39.92', 'Comptant', 0, 1),
(45, 2, 5, 1, '2019-06-28 11:26:25', '2019-07-05 00:00:00', '2019-07-25 00:00:00', '73.50', 'Cheque', 0, 1),
(46, 3, 7, 5, '2019-07-30 08:30:27', '2019-07-08 00:00:00', '2019-07-17 00:00:00', '33.30', NULL, 1, 1),
(47, 3, 3, 1, '2019-07-04 10:41:07', '2019-08-10 00:00:00', '2019-08-16 00:00:00', '24.50', NULL, 1, 1),
(48, 1, 6, 5, '2019-07-04 15:06:24', '2019-08-05 00:00:00', '2019-08-15 00:00:00', '36.63', 'Comptant', 0, 1),
(49, 3, 4, 7, '2019-07-09 03:17:39', '2019-07-10 00:00:00', '2019-07-24 00:00:00', '37.50', NULL, 0, 1),
(50, 1, 1, 9, '2019-07-17 21:03:20', '2019-07-21 00:00:00', '2019-08-02 00:00:00', '84.00', 'Comptant', 0, 1),
(51, 1, 7, 7, '2019-07-23 21:40:16', '2019-07-29 00:00:00', '2019-08-13 00:00:00', '40.00', 'Comptant', 1, 1),
(52, 1, 10, 5, '2019-08-01 17:23:10', '2019-08-25 00:00:00', '2019-09-01 00:00:00', '26.64', 'Comptant', 0, 1),
(53, 3, 3, 1, '2019-08-02 23:08:23', '2019-08-20 00:00:00', '2019-08-22 00:00:00', '10.50', NULL, 1, 1),
(54, 2, 6, 3, '2019-08-03 17:13:51', '2019-08-04 00:00:00', '2019-08-10 00:00:00', '34.93', 'Cheque', 0, 1),
(55, 1, 1, 5, '2019-08-08 08:33:30', '2019-09-11 00:00:00', '2019-09-20 00:00:00', '33.30', 'Comptant', 0, 1),
(56, 3, 9, 7, '2019-08-08 23:19:43', '2019-08-17 00:00:00', '2019-08-30 00:00:00', '35.00', NULL, 0, 1),
(57, 3, 2, 9, '2019-08-19 09:28:25', '2019-08-26 00:00:00', '2019-09-04 00:00:00', '60.00', NULL, 0, 1),
(58, 1, 8, 1, '2019-08-22 21:36:35', '2019-08-23 00:00:00', '2019-09-09 00:00:00', '63.00', 'Comptant', 0, 1),
(59, 3, 7, 3, '2019-08-26 20:51:19', '2019-08-27 00:00:00', '2019-09-02 00:00:00', '34.93', NULL, 1, 1),
(60, 2, 10, 5, '2019-09-01 09:16:29', '2019-09-24 00:00:00', '2019-09-29 00:00:00', '19.98', 'Cheque', 0, 1),
(61, 1, 7, 3, '2019-09-05 22:36:24', '2019-09-06 00:00:00', '2019-09-15 00:00:00', '49.90', 'Comptant', 1, 1),
(62, 1, 11, 5, '2019-09-09 01:41:50', '2019-09-25 00:00:00', '2019-10-01 00:00:00', '23.31', 'Comptant', 0, 1),
(63, 3, 1, 9, '2019-09-12 00:37:41', '2019-09-15 00:00:00', '2019-09-21 00:00:00', '42.00', NULL, 0, 1),
(64, 1, 2, 3, '2019-09-30 17:38:38', '2019-10-08 00:00:00', '2019-10-15 00:00:00', '39.92', 'Comptant', 0, 1),
(65, 2, 5, 1, '2019-10-02 21:36:51', '2019-10-12 00:00:00', '2019-10-25 00:00:00', '49.00', 'Cheque', 0, 1),
(66, 3, 7, 5, '2019-10-02 22:13:26', '2019-10-03 00:00:00', '2019-10-17 00:00:00', '49.95', NULL, 1, 1),
(67, 3, 3, 1, '2019-10-03 19:59:53', '2019-11-10 00:00:00', '2019-11-16 00:00:00', '24.50', NULL, 1, 1),
(68, 1, 6, 5, '2019-10-04 20:35:47', '2019-11-05 00:00:00', '2019-11-16 00:00:00', '39.96', 'Comptant', 0, 1),
(69, 3, 4, 7, '2019-10-09 22:17:43', '2019-10-10 00:00:00', '2019-10-30 00:00:00', '52.50', NULL, 0, 1),
(70, 1, 1, 9, '2019-10-15 21:43:22', '2019-10-29 00:00:00', '2019-11-04 00:00:00', '42.00', 'Comptant', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
    `membre_id` int(11) NOT NULL,
    `courriel` varchar(96) NOT NULL,
    `mot_de_passe` varchar(32) NOT NULL,
    `type_utilisateur_id` int(11) NOT NULL,
    `date_membre_plus` datetime DEFAULT NULL,
    `image_profil` varchar(255) DEFAULT NULL,
    `nom` varchar(255) NOT NULL,
    `prenom` varchar(255) NOT NULL,
    `adresse` varchar(255) NOT NULL,
    `ville` varchar(255) NOT NULL,
    `province` varchar(255) NOT NULL,
    `pays` varchar(255) NOT NULL,
    `code_postal` varchar(255) NOT NULL,
    `telephone` varchar(32) NOT NULL,
    `no_paypal` varchar(255) DEFAULT NULL,
    `date_ajout` datetime NOT NULL,
    `evaluation_globale` decimal(6,5) DEFAULT NULL,
    `consentement_gardien` varchar(255) DEFAULT NULL,
    `age_majeur` tinyint(1) NOT NULL DEFAULT '1',
    `alerte_email` tinyint(1) NOT NULL DEFAULT '0',
    `newsletter` tinyint(1) NOT NULL DEFAULT '0',
    `membre_valide` tinyint(1) NOT NULL DEFAULT '0',
    `membre_actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`membre_id`, `courriel`, `mot_de_passe`, `type_utilisateur_id`, `date_membre_plus`, `image_profil`, `nom`, `prenom`, `adresse`, `ville`, `province`, `pays`, `code_postal`, `telephone`, `no_paypal`, `date_ajout`, `evaluation_globale`, `consentement_gardien`, `age_majeur`, `alerte_email`, `newsletter`, `membre_valide`, `membre_actif`) VALUES
(1, 'david.hod@gmail.com', 'd0a7d5ff7842e45089930b6089469adf', 1, NULL, NULL, 'Hod', 'David', '5922 St.Hubert', 'Montréal', 'Québec', 'Canada', 'H2S 2L7', '514-369-7777', NULL, '2018-08-10 14:41:27', '3.50000', NULL, 1, 0, 1, 1, 1),
(2, 'nicolas.rossi@hotmail.com', '065a3e4d0f816184287cc6db33509b98', 1, NULL, NULL, 'Rossi', 'Nicolas', '5025 Pare', 'Montréal', 'Québec', 'Canada', 'H4P 1P4', '514-454-2211', NULL, '2018-09-19 16:23:55', '2.83333', NULL, 1, 0, 1, 1, 0),
(3, 'noemie.leclerc@gmail.com', 'd427a299e4ffbac157d1b50a83f1a469', 2, '2019-09-03 00:00:00', NULL, 'Leclerc', 'Noémie', '10220 Rue Laverdure', 'Montréal', 'Québec', 'Canada', 'H3L 2L3', '514-231-3333', NULL, '2018-09-03 21:48:19', '3.25000', NULL, 1, 0, 1, 1, 1),
(4, 'peterson.oscar@gmail.com', '48307be22350697559a91596a00b5403', 1, NULL, NULL, 'Peterson', 'Oscar', '25 Avenue Manseau', 'Outremont', 'Québec', 'Canada', 'H2V 4R1', '514-720-1111', NULL, '2018-08-10 23:11:40', '-1.00000', NULL, 1, 0, 1, 1, 1),
(5, 'guiherme.tosin@gmail.com', '99e02dea859a007c259e5a25ff0f97ec', 3, NULL, NULL, 'Tosin', 'Guilherme', '711 Rue de Chevillon', 'Laval', 'Québec', 'Canada', 'H7N 6J1', '450-232-8888', NULL, '2018-08-19 19:23:52', '4.75000', NULL, 1, 1, 1, 1, 1),
(6, 'simon.leger@gmail.com', '68fada2756879191d9059638ffb5da89', 1, NULL, NULL, 'Leger', 'Simon', '7599 Avenue de L\'Épée', 'Montréal', 'Québec', 'Canada', 'H3N 2E4', '514-415-6666', NULL, '2018-09-09 09:13:21', '-1.00000', NULL, 1, 0, 1, 1, 1),
(7, 'claudia.demers@hotmail.com', 'f0862146d615d1c11a2381f9a7331283', 2, '2019-09-10 00:00:00', NULL, 'Demers', 'Claudia', '1075 Rue de Bullion', 'Montréal', 'Québec', 'Canada', 'H2X 0A1', '514-523-4444', NULL, '2018-09-10 22:51:25', '4.50000', NULL, 1, 0, 1, 1, 1),
(8, 'bob.archer@gmail.com', '9a0af0f0359bae4386ed96493545106d', 1, NULL, NULL, 'Archer', 'Bob', '4650 Avenue King-Edward', 'Montréal', 'Québec', 'Canada', 'H4B 2H7', '514-887-5564', NULL, '2018-09-16 23:33:09', '-1.00000', NULL, 1, 0, 1, 1, 1),
(9, 'killpuechess@hotmail.com', '4bd43ff51c9a387b374229d43b2b3385', 3, NULL, NULL, 'Guzman', 'Marcelo', '4651 Clark', 'Montréal', 'Québec', 'Canada', 'H2T 2T3', '514-963-0091', NULL, '2018-08-17 18:09:30', '4.83333', NULL, 1, 0, 1, 1, 1),
(10, 'julien.melson@gmail.com', 'c672f9e314954b8306ddc16510219788', 1, NULL, NULL, 'Melson', 'Julien', '4295 Chambord', 'Montréal', 'Québec', 'Canada', 'H2J 3M3', '514-225-1516', NULL, '2018-09-22 19:54:08', '-1.00000', NULL, 1, 0, 1, 1, 1),
(11, 'oudayan@gmail.com', '2995a539c763bded7dedaf6330e7cfde', 4, NULL, NULL, 'Dutta', 'Oudayan', '204 rue de l\'Hôpital', 'Montréal', 'Québec', 'Canada', 'H2Y 1V8', '514-281-2599', NULL, '2018-08-08 21:32:15', '-1.00000', NULL, 1, 0, 1, 1, 1),
(12, 'chuck.norris@gmail.com', '62b9cb8a2ad52f072e5941014cc4c78e', 1, NULL, NULL, 'Norris', 'Chuck', '1754 Cedar Ave', 'Montréal', 'Québec', 'Canada', 'H3G 1A3', '514-458-6666', NULL, '2018-10-03 19:51:20', '-1.00000', NULL, 1, 0, 1, 1, 1),
(13, 'ted.tester@gmail.com', '1910af644a40fe357da7f816ef634373', 1, NULL, NULL, 'Tester', 'Ted', '1151 Rue Soulanges', 'Montréal', 'Québec', 'Canada', 'H3K 2L7', '450-398-7654', NULL, '2018-10-10 09:01:45', '-1.00000', NULL, 1, 0, 1, 1, 1),
(14, 'bruce.lee@gmail.com', 'c68b0e2ee5c2559e285a4868c6bfd758', 2, '2018-11-25 00:00:00', NULL, 'Lee', 'Bruce', '922 Rue Workman', 'Montréal', 'Québec', 'Canada', 'H3J 2P3', '514-321-4425', NULL, '2018-10-25 18:13:16', '-1.00000', NULL, 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messagerie`
--

CREATE TABLE `messagerie` (
    `msg_id` int(11) NOT NULL,
    `membre_id` int(11) NOT NULL,
    `sujet` varchar(255) NOT NULL,
    `message` text NOT NULL,
    `attachement` text,
    `msg_date` datetime NOT NULL,
    `msg_envoye` tinyint(1) NOT NULL DEFAULT '0',
    `msg_lu` tinyint(1) NOT NULL DEFAULT '0',
    `msg_actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photo_jeux`
--

CREATE TABLE `photo_jeux` (
    `photo_jeux_id` int(11) NOT NULL,
    `jeux_id` int(11) NOT NULL,
    `chemin_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo_jeux`
--

INSERT INTO `photo_jeux` (`photo_jeux_id`, `jeux_id`, `chemin_photo`) VALUES
(1, 1, 'images/Jeux/1/01.jpg'),
(2, 2, 'images/Jeux/2/02.jpg'),
(3, 3, 'images/Jeux/3/03.jpg'),
(4, 4, 'images/Jeux/4/thumb01.jpg'),
(5, 5, 'images/Jeux/5/thumb02.jpg'),
(6, 6, 'images/Jeux/6/thumb03.jpg'),
(7, 7, 'images/Jeux/7/thumb04.jpg'),
(8, 8, 'images/Jeux/8/thumb05.jpg'),
(9, 9, 'images/Jeux/9/thumb06.jpg'),
(10, 10, 'images/Jeux/10/thumb07.jpg'),
(11, 3, 'images/Jeux/3/sonic.jpg'),
(12, 3, 'images/Jeux/3/sonic1.jpg'),
(13, 3, 'images/Jeux/3/sonic4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `plateforme`
--

CREATE TABLE `plateforme` (
    `plateforme_id` int(11) NOT NULL,
    `plateforme` varchar(255) NOT NULL,
    `plateforme_icone` varchar(255) DEFAULT NULL,
    `plateforme_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plateforme`
--

INSERT INTO `plateforme` (`plateforme_id`, `plateforme`, `plateforme_icone`, `plateforme_active`) VALUES
(1, 'Playstation 4', '<i title=\"Playstation\" class=\"fab fa-playstation\"></i>', 1),
(2, 'Xbox One', '<i title=\"Xbox\" class=\"fab fa-xbox\"></i>', 1),
(3, 'Nintendo Wii U', '<i title=\"Nintendo\" class=\"fab fa-nintendo-switch\"></i>', 1),
(4, 'Windows', '<i title=\"Windows\" class=\"fab fa-windows\"></i>', 1),
(5, 'Playstation 3', '<i title=\"Playstation\" class=\"fab fa-playstation\"></i>', 1),
(6, 'Xbox 360', '<i title=\"Xbox\" class=\"fab fa-xbox\"></i>', 1),
(7, 'Nintendo Switch', '<i title=\"Nintendo\" class=\"fab fa-nintendo-switch\"></i>', 1),
(8, 'Playstation Vita', '<i title=\"Playstation\" class=\"fab fa-playstation\"></i>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type_paiement`
--

CREATE TABLE `type_paiement` (
    `type_paiement_id` int(11) NOT NULL,
    `type_paiement` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_paiement`
--

INSERT INTO `type_paiement` (`type_paiement_id`, `type_paiement`) VALUES
(1, 'Comptant'),
(2, 'Chèque'),
(3, 'Paypal');

-- --------------------------------------------------------

--
-- Table structure for table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
    `type_utilisateur_id` int(11) NOT NULL,
    `type_utilisateur` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`type_utilisateur_id`, `type_utilisateur`) VALUES
(1, 'Membre'),
(2, 'Membre Plus'),
(3, 'Admin'),
(4, 'Super Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achat`
--
ALTER TABLE `achat`
    ADD PRIMARY KEY (`achat_id`),
    ADD KEY `FK_assosier_achat` (`type_paiement_id`),
    ADD KEY `FK_assosier_jeux` (`jeux_id`),
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
-- Indexes for table `destinataire`
--
ALTER TABLE `destinataire`
    ADD PRIMARY KEY (`membre_id`,`msg_id`),
    ADD KEY `FK_destinataire2` (`msg_id`);

--
-- Indexes for table `echange`
--
ALTER TABLE `echange`
    ADD PRIMARY KEY (`echange_id`),
    ADD KEY `FK_proposer` (`jeu_propose`),
    ADD KEY `FK_echange` (`jeu_echange`),
    ADD KEY `FK_contre_offre` (`contre_offre`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
    ADD PRIMARY KEY (`evaluation_id`),
    ADD UNIQUE KEY `jeton` (`jeton`),
    ADD KEY `FK_composer` (`membre_id`),
    ADD KEY `FK_concerner` (`jeux_id`),
    ADD KEY `FK_evaluer1` (`achat_id`),
    ADD KEY `FK_evaluer2` (`location_id`);

--
-- Indexes for table `jeux`
--
ALTER TABLE `jeux`
    ADD PRIMARY KEY (`jeux_id`),
    ADD KEY `FK_avoir` (`membre_id`),
    ADD KEY `FK_classer` (`plateforme_id`);

--
-- Indexes for table `jeux_non_dispos`
--
ALTER TABLE `jeux_non_dispos`
    ADD PRIMARY KEY (`jeux_non_dispo_id`),
    ADD KEY `FK_bloquer` (`jeux_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
    ADD PRIMARY KEY (`location_id`),
    ADD KEY `FK_associer_louer` (`type_paiement_id`),
    ADD KEY `FK_assosier_jeux2` (`jeux_id`),
    ADD KEY `FK_louer` (`membre_id`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
    ADD PRIMARY KEY (`membre_id`),
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achat`
--
ALTER TABLE `achat`
    MODIFY `achat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
    MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `echange`
--
ALTER TABLE `echange`
    MODIFY `echange_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
    MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jeux`
--
ALTER TABLE `jeux`
    MODIFY `jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jeux_non_dispos`
--
ALTER TABLE `jeux_non_dispos`
    MODIFY `jeux_non_dispo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
    MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
    MODIFY `membre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messagerie`
--
ALTER TABLE `messagerie`
    MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_jeux`
--
ALTER TABLE `photo_jeux`
    MODIFY `photo_jeux_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `plateforme`
--
ALTER TABLE `plateforme`
    MODIFY `plateforme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `type_paiement`
--
ALTER TABLE `type_paiement`
    MODIFY `type_paiement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
    MODIFY `type_utilisateur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achat`
--
ALTER TABLE `achat`
    ADD CONSTRAINT `FK_assosier_achat` FOREIGN KEY (`type_paiement_id`) REFERENCES `type_paiement` (`type_paiement_id`),
    ADD CONSTRAINT `FK_assosier_jeux` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`),
    ADD CONSTRAINT `FK_faire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Constraints for table `categorie_jeux`
--
ALTER TABLE `categorie_jeux`
    ADD CONSTRAINT `FK_categorie_jeux` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`),
    ADD CONSTRAINT `FK_categorie_jeux2` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`categorie_id`);

--
-- Constraints for table `destinataire`
--
ALTER TABLE `destinataire`
    ADD CONSTRAINT `FK_destinataire` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
    ADD CONSTRAINT `FK_destinataire2` FOREIGN KEY (`msg_id`) REFERENCES `messagerie` (`msg_id`);

--
-- Constraints for table `echange`
--
ALTER TABLE `echange`
    ADD CONSTRAINT `FK_contre_offre` FOREIGN KEY (`contre_offre`) REFERENCES `echange` (`echange_id`),
    ADD CONSTRAINT `FK_echange` FOREIGN KEY (`jeu_echange`) REFERENCES `jeux` (`jeux_id`),
    ADD CONSTRAINT `FK_proposer` FOREIGN KEY (`jeu_propose`) REFERENCES `jeux` (`jeux_id`);

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
    ADD CONSTRAINT `FK_composer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
    ADD CONSTRAINT `FK_concerner` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`),
    ADD CONSTRAINT `FK_evaluer1` FOREIGN KEY (`achat_id`) REFERENCES `achat` (`achat_id`),
    ADD CONSTRAINT `FK_evaluer2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Constraints for table `jeux`
--
ALTER TABLE `jeux`
    ADD CONSTRAINT `FK_avoir` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`),
    ADD CONSTRAINT `FK_classer` FOREIGN KEY (`plateforme_id`) REFERENCES `plateforme` (`plateforme_id`);

--
-- Constraints for table `jeux_non_dispos`
--
ALTER TABLE `jeux_non_dispos`
    ADD CONSTRAINT `FK_bloquer` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
    ADD CONSTRAINT `FK_associer_louer` FOREIGN KEY (`type_paiement_id`) REFERENCES `type_paiement` (`type_paiement_id`),
    ADD CONSTRAINT `FK_assosier_jeux2` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`),
    ADD CONSTRAINT `FK_louer` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Constraints for table `membre`
--
ALTER TABLE `membre`
    ADD CONSTRAINT `FK_etre` FOREIGN KEY (`type_utilisateur_id`) REFERENCES `type_utilisateur` (`type_utilisateur_id`);

--
-- Constraints for table `messagerie`
--
ALTER TABLE `messagerie`
    ADD CONSTRAINT `FK_assigner_emmeteur` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`membre_id`);

--
-- Constraints for table `photo_jeux`
--
ALTER TABLE `photo_jeux`
    ADD CONSTRAINT `FK_posseder` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`jeux_id`);
