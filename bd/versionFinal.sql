/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2018/9/18 19:54:54                           */
/*==============================================================*/


drop table if exists achat;

drop table if exists categorie;

drop table if exists categorie_jeux;

drop table if exists destinataire;

drop table if exists commentaire_jeux;

drop table if exists jeux;

drop table if exists location;

drop table if exists membre;

drop table if exists messagerie;

drop table if exists photo_jeux;

drop table if exists plateforme;

drop table if exists type_paiement;

drop table if exists type_utilisateur;

/*==============================================================*/
/* Table: achat                                                 */
/*==============================================================*/
create table `achat`
(
   `achat_id`             int not null auto_increment,
   `type_paiement_id`     int not null,
   `membre_id`            int not null,
   `jeux_id`              int not null,
   `date_achat`           datetime not null,
   `transaction_id`       varchar(255),
   primary key (achat_id)
);

/*==============================================================*/
/* Table: categorie                                             */
/*==============================================================*/
create table `categorie`
(
   `categorie_id`    int not null auto_increment,
   `categorie`             varchar(255),
   primary key (categorie_id)
);

/*==============================================================*/
/* Table: categorie_jeux                                        */
/*==============================================================*/
create table `categorie_jeux`
(
   `jeux_id`         int not null,
   `categorie_id`    int not null,
   primary key (jeux_id, categorie_id)
);

/*==============================================================*/
/* Table: destinataire                                          */
/*==============================================================*/
create table `destinataire`
(
   `membre_id`            int not null,
   `msg_id`               int not null,
   primary key (membre_id, msg_id)
);

/*==============================================================*/
/* Table: commentaire_jeux                                      */
/*==============================================================*/
create table commentaire_jeux
(
   `commentaire_jeux_id`  int not null auto_increment,
   `jeux_id`              int not null,
   `membre_id`            int not null,
   `commentaire`          text not null,
   `evaluation`           decimal(6,5),
   `date_commentaire`     datetime not null,
   primary key (commentaire_jeux_id)
);

/*==============================================================*/
/* Table: jeux                                                  */
/*==============================================================*/
create table jeux
(
   `jeux_id`              int not null auto_increment,
   `plateforme_id`        int not null,
   `membre_id`            int not null,
   `titre`                varchar(255) not null,
   `prix`                 decimal(15,2) not null,
   `date_ajout`           datetime not null,
   `concepteur`           varchar(255) not null,
   `location`             bool not null,
   `jeux_valide`          bool not null,
   `jeux_actif`           bool not null,
   `jeux_banni`           bool not null,
   `description`          text not null,
   `evaluation_globale`    decimal(6,5),
   primary key (jeux_id)
);

/*==============================================================*/
/* Table: location                                              */
/*==============================================================*/
create table location
(
   `location_id`          int not null auto_increment,
   `type_paiement_id`     int not null,
   `membre_id`            int not null,
   `jeux_id`              int not null,
   `date_debut`           datetime not null,
   `date_retour`          datetime not null,
   `transaction_id`       varchar(255),
   primary key (location_id)
);

/*==============================================================*/
/* Table: membre                                                */
/*==============================================================*/
create table membre
(
   `membre_id`            int not null auto_increment,
   `type_utilisateur_id`  int not null,
   `nom`                  varchar(255) not null,
   `prenom`               varchar(255) not null,
   `mot_de_passe`         varchar(32) not null,
   `adresse`              varchar(128) not null,
   `telephone`            varchar(32) not null,
   `courriel`             varchar(96) not null,
   `membre_valide` tinyint(1) NOT NULL DEFAULT '0',
   `membre_actif` tinyint(1) NOT NULL DEFAULT '1',
   primary key (membre_id)
);

/*==============================================================*/
/* Table: messagerie                                            */
/*==============================================================*/
create table messagerie
(
   `msg_id`               int not null auto_increment,
   `membre_id`            int not null,
   `sujet`                varchar(255) not null,
   `message`              text not null,
   `msg_date`             datetime not null,
   `msg_actif`            bool not null,
   primary key (msg_id)
);

/*==============================================================*/
/* Table: photo_jeux                                            */
/*==============================================================*/
create table photo_jeux
(
   `photo_jeux_id`        int not null auto_increment,
   `jeux_id`              int not null,
   `chemin_photo`         varchar(255) not null,
   primary key (photo_jeux_id)
);

/*==============================================================*/
/* Table: plateforme                                            */
/*==============================================================*/
create table plateforme
(
   `plateforme_id`       int not null auto_increment,
   `plateforme`          varchar(255) not null,
   primary key (plateforme_id)
);

/*==============================================================*/
/* Table: type_paiement                                         */
/*==============================================================*/
create table type_paiement
(
   `type_paiement_id`     int not null auto_increment,
   `type_paiement`        varchar(32),
   primary key (type_paiement_id)
);

/*==============================================================*/
/* Table: type_utilisateur                                      */
/*==============================================================*/
create table type_utilisateur
(
   `type_utilisateur_id`  int not null auto_increment,
   `type_utilisateur`     varchar(32) not null,
   primary key (type_utilisateur_id)
);

alter table achat add constraint FK_assosier_achat foreign key (type_paiement_id)
      references type_paiement (type_paiement_id) on delete restrict on update restrict;

alter table achat add constraint FK_assosier_jeux foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

alter table achat add constraint FK_faire foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table categorie_jeux add constraint FK_categorie_jeux foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

alter table categorie_jeux add constraint FK_categorie_jeux2 foreign key (categorie_id)
      references categorie (categorie_id) on delete restrict on update restrict;

alter table destinataire add constraint FK_destinataire foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table destinataire add constraint FK_destinataire2 foreign key (msg_id)
      references messagerie (msg_id) on delete restrict on update restrict;

alter table commentaire_jeux add constraint FK_composer foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table commentaire_jeux add constraint FK_concerner foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

alter table jeux add constraint FK_avoir foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table jeux add constraint FK_classer foreign key (plateforme_id)
      references plateforme (plateforme_id) on delete restrict on update restrict;

alter table location add constraint FK_associer_louer foreign key (type_paiement_id)
      references type_paiement (type_paiement_id) on delete restrict on update restrict;

alter table location add constraint FK_assosier_jeux2 foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

alter table location add constraint FK_louer foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table membre add constraint FK_etre foreign key (type_utilisateur_id)
      references type_utilisateur (type_utilisateur_id) on delete restrict on update restrict;

alter table messagerie add constraint FK_assigner_emmeteur foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table photo_jeux add constraint FK_posseder foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;





-- INSERTIONS --

--
-- Contenu de la table `type_utilisateur`
--

INSERT INTO type_utilisateur VALUES
(1, "Membre"),
(2, "Admin"),
(3, "Super Admin");


--
-- Contenu de la table `membre`
--

INSERT INTO membre VALUES 
(1, 3, "Hod", "David", "pacman_2018", "5922 St.Hubert", "514-3697777", "david.hod@gmail.com", 1, 1),
(2, 2, "Guzman", "Marcelo", "4651marcelo", "4651 Clark", "514-9630091", "killpuechess@hotmail.com", 1, 1),
(3, 2, "Tosin", "Guilherme", "mr.sirois", "711 Rue de Chevillon", "514-2328888", "guiherme.tosin@gmail.com", 1, 1),
(4, 1, "Peterson", "Oscar", "twoofthefew", "1786 Boulevard Manseau", "514-0201111", "peterson.oscar@gmail.com", 1, 1),
(5, 1, "Leclerc", "Noémie", "bagsGroove", "10220 Rue Laverdure","514-2313333", "noemie.leclerc@gmail.com", 1, 1),
(6, 1, "Leger", "Simon", "stablemates", "7599 Avenue de L'Épée", "514-4156666", "simon.leger@gmail.com", 1, 1),
(7, 1, "Demers", "Claudia", "time_for_rien", "1075 Rue de Bullion", "514-1234444", "claudia.demers@hotmail.com", 1, 1),
(8, 1, "Archer", "Bob", "pinkpanther", "4650 Avenue King-Edward", "514-8875564", "bob.archer@gmail.com", 1, 1),
(9, 1, "Rossi",  "Nicolas", "earlyModem", "5683 Pare", "514-4542211", "rossi.nicolas@hotmail.com", 1, 1),
(10, 1, "Melson", "Julien", "lazy_melody", "5930 rue Théverin", "514-2251516", "melson.julien@gmail.com", 1, 1);


--
-- Contenu de la table `type_paiement`
--

INSERT INTO type_paiement VALUES 
(1, "Comptant"),
(2, "Chèque"),
(3, "Paypal");


--
-- Contenu de la table `plateforme`
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



--
-- Contenu de la table `jeux`
--

INSERT INTO `jeux` (`jeux_id`, `plateforme_id`, `membre_id`, `titre`, `prix`, `date_ajout`, `concepteur`, `location`, `jeux_valide`, `jeux_actif`, `jeux_banni`, `description`,`evaluation_globale`) VALUES
(1, 1, 1, 'Super Mario U 2', 7.5, '2018-09-10 04:13:54', 'Nintendo', 1, 1, 1, 0, 'Curabitur sit amet convallis felis. Mauris ac massa justo. Aliquam ex nisl, viverra vitae nulla eu, vulputate rhoncus dui. Nullam a massa ligula. Suspendisse sollicitudin iaculis lacus, et interdum justo maximus a. Phasellus ullamcorper aliquet dolor, eget mattis mauris ornare a. Nam condimentum purus dolor, pellentesque hendrerit tortor pellentesque sit amet. Sed faucibus lectus magna, non iaculis lorem sodales id.', 4.02345),
(2, 2, 2, 'Shadow of the Colossus', 49.5, '2018-09-10 04:15:54', 'Sony', 0, 1, 1, 0, 'Mauris vehicula sapien ac nulla pharetra, sit amet commodo erat feugiat. Phasellus varius massa mauris, ut volutpat ipsum viverra eget. Nunc ut orci blandit, semper nunc id, lacinia odio. Phasellus cursus metus gravida ex consequat tristique. In hac habitasse platea.',  4.00125),
(3, 3, 3, 'Sonic The Hedgehog', 39.99, '2018-09-11 11:24:30', 'SEGA', 0, 1, 1, 0,'Nullam consectetur tempor nibh, sit amet mollis augue suscipit vel. Nullam vestibulum mi sed lectus pharetra condimentum. Quisque varius, augue in scelerisque iaculis, lectus urna facilisis urna, non feugiat est nunc fringilla diam. Fusce vel turpis semper, euismod eros et, fermentum diam. Donec sed nulla in ipsum pulvinar rutrum id.',4.21547),
(4, 4, 4, 'Megaman', 24, '2018-09-12 04:12:20', 'CAPCOM', 0, 1, 1, 0, 'Mauris pharetra egestas sem, eget euismod enim euismod nec. Ut leo augue, bibendum sed metus et, faucibus pretium nulla. Morbi auctor risus ex, vulputate tristique orci volutpat non. Aliquam dapibus.', 3.54788),
(5, 3, 5, 'Mario Kart Double Dash', 31, '2018-09-13 12:44:33', 'Nintendo', 0, 1, 1, 0,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porttitor nisi. Ut placerat sapien et consequat aliquam. Duis tincidunt fermentum diam, a porta dui tristique id. Curabitur tristique massa hendrerit nulla mattis, ut facilisis.', 4.01452),
(6, 7, 6, 'Donkey Kong Country', 24, '2018-09-14 10:02:50', 'Nintendo', 0, 1, 1, 0,'Praesent euismod, nibh id consequat porta, lorem nunc tempus mi, quis accumsan justo odio egestas risus. Vivamus ullamcorper euismod porttitor. Aenean tellus ligula, ultrices sit amet enim vel, eleifend iaculis.', 4.01452),
(7, 4, 3, 'Shift 2 Unleashed', 32.99, '2018-09-15 06:24:30', 'EA', 0, 1, 1, 0,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque aliquam ornare. Quisque faucibus auctor nulla, euismod commodo quam posuere quis. Phasellus tempus justo lorem, eget gravida est convallis ac. Nulla consectetur facilisis lacus vel rutrum. Nulla pharetra dapibus ex. Proin orci.', 4.03024),
(8, 6, 4, 'Halo Reach', 44.5, '2018-09-16 07:12:20', 'Bungie', 0, 1, 1, 0,'Cras aliquam erat massa, in ultricies purus elementum sit amet. Nulla nec imperdiet est, sit amet pellentesque magna. Suspendisse neque urna, ornare vel massa posuere, dapibus mollis ipsum. Nulla facilisi. Interdum et malesuada fames ac ante ipsum primis in.', 4.32144),
(9, 8, 5, 'The Secret of Monkey Island', 16, '2018-09-17 08:44:33', 'SEGA', 1, 1, 1, 0,'Nullam malesuada orci et urna tristique, a efficitur tellus lacinia. Suspendisse potenti. Nulla luctus enim turpis, eu cursus erat malesuada eu. Quisque tempor, urna et fringilla congue, enim elit dignissim ligula, vel ultricies elit leo at ligula. Fusce tincidunt dui ac varius cursus. Praesent sollicitudin ligula sapien. Nullam nec tincidunt quam.', 3.02565),
(10, 2, 6, 'Assassins Creed BrotherHood', 35, '2018-09-17 09:02:50', 'UBISOFT', 0, 1, 1, 0,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac quam id nisl porttitor rutrum a vitae odio. Etiam ac massa viverra, finibus mi vel, pellentesque nunc. Pellentesque efficitur purus mi, in lobortis magna consequat ut. Orci varius natoque penatibus et magnis.', 4.25568);


--
-- Contenu de la table `commentaire_jeux`
--
INSERT INTO `commentaire_jeux` (`commentaire_jeux_id`, `jeux_id`, `membre_id`, `commentaire`, `evaluation`, `date_commentaire`) VALUES
(1, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce venenatis et quam ut mattis. Ut eleifend bibendum magna, eu volutpat metus lacinia vel. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam gravida diam eu dictum interdum. Aliquam erat enim.', 4.02345, '2018-09-10 04:30:54'),
(2, 1, 6, 'Maecenas ut facilisis ligula. Sed quis laoreet metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas enim lorem, faucibus vitae ultrices sit amet, tincidunt.', 4.14588, '2018-09-13 04:30:54'),
(3, 2, 1, 'Sed ac pulvinar ante, sit amet tristique elit. Sed pellentesque lacus sed sem scelerisque, id fringilla odio rutrum. Nullam fermentum feugiat sollicitudin. Donec ut lacus et mauris eleifend imperdiet nec vel erat. Ut ultricies lorem.', 4.00125, '2018-09-12 04:15:54'),
(4, 2, 9, 'Nulla molestie nulla arcu, a dapibus lorem pulvinar ac. Phasellus libero ligula, finibus quis pulvinar a, tincidunt quis ligula. Etiam id tortor ac nunc elementum pretium. Quisque fringilla eros vel laoreet congue. Aliquam facilisis quis nibh lacinia aliquet. Sed quis.', 4.21547,'2018-09-15 11:35:23'),
(5, 2, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut.', 4.56235, '2018-09-17 10:15:21'),
(6, 3, 2, 'Sed varius dui nisl, eu efficitur ipsum feugiat sed. Nulla sed dui risus. Fusce euismod diam vel mi consectetur, sit amet lacinia quam auctor. Cras tincidunt consequat tellus ac feugiat. Curabitur rhoncus.', 3.98457, '2018-09-12 09:23:30'),
(7, 3, 8, 'Maecenas tempor mauris et sem laoreet, ac fringilla velit accumsan. Nam quis tortor quis lorem dapibus porttitor a at odio. Integer elementum tincidunt cursus. Donec auctor sed quam sit amet ultricies. Vestibulum suscipit dolor nec pulvinar.', 4.25568, '2018-09-12 11:27:10'),
(8, 4, 7, 'Aenean et nibh rutrum, ullamcorper tellus in, posuere urna. Nam aliquet nisl vitae sem gravida sodales. Vestibulum iaculis orci quam, in commodo felis eleifend id. Proin ac elit ultrices ex hendrerit bibendum. Sed lobortis ultricies turpis at ultricies. Cras et leo vel ante gravida aliquam.', 4.65984, '2018-09-13 01:15:20'),
(9, 5, 10, 'Integer laoreet ornare lacus eu consequat. Maecenas facilisis tortor neque, lacinia lobortis lacus aliquam nec. Nulla nibh ligula, commodo id velit sit amet, varius tincidunt metus. Pellentesque ut urna condimentum, placerat ligula et, pharetra nibh. Nunc eu vehicula ipsum.', 3.54788, '2018-09-13 12:50:32'),
(10, 5, 7, 'Sed auctor lobortis est, id convallis turpis condimentum quis. Sed consequat, sem eget scelerisque ullamcorper, dolor elit pretium lectus, eget blandit urna neque nec felis. Nunc convallis dui nec vehicula sodales. Maecenas mi enim, vestibulum.', 4.01452, '2018-09-17 08:44:32'),
(11, 6, 5, 'Morbi ut ante enim. Praesent fringilla feugiat placerat. Donec imperdiet, nisl vel consequat ultricies, arcu neque congue sem, eget varius urna ligula ut massa. Nam sit amet erat hendrerit, lacinia ante sit amet, porttitor lorem. Integer imperdiet et sem nec.', 3.57841, '2018-09-14 11:22:52'),
(12, 6, 1, 'Nam eu gravida ipsum. Vestibulum erat leo, efficitur a magna nec, lacinia pharetra nibh. Sed eget laoreet nibh, eget porttitor ipsum. Aenean id dui id dolor commodo fringilla. Mauris nulla lorem, suscipit eget.', 4.01452, '2018-09-15 04:22:15'),
(13, 7, 2, 'Nam at nisi sit amet massa sagittis vestibulum sit amet eget augue. Pellentesque eget velit eu nunc iaculis sollicitudin eget eu elit. Praesent blandit ligula vitae tempor ultricies. Aliquam euismod, felis in tristique aliquet, nulla leo sagittis.', 4.00125, '2018-09-15 09:24:32'),
(14, 8, 5, 'Duis magna lacus, posuere nec nisi at, malesuada hendrerit augue. Nunc ac eros accumsan, varius dolor vitae, sodales erat. Donec pellentesque molestie elit, quis ultricies erat rhoncus a. Sed commodo.', 4.10215, '2018-09-17 07:22:21'),
(15, 8, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tellus ligula, tincidunt nec dolor gravida, interdum hendrerit metus. Ut semper nibh lectus, vitae commodo neque placerat a. Maecenas at mauris.', 4.03024, '2018-09-19 09:23:12'),
(16, 9, 3, 'Nunc fermentum eget nunc quis volutpat. Aliquam placerat auctor tempus. Pellentesque arcu lectus, vehicula at pulvinar et, laoreet eu ante. Aliquam sodales ante eu lobortis gravida. Phasellus id laoreet mauris. Mauris suscipit laoreet justo vel eleifend. Nulla ac.', 3.02565, '2018-09-17 09:44:30'),
(17, 9, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pharetra ut tortor id fringilla. Praesent a mattis risus, ut laoreet velit. Nunc dapibus imperdiet velit, sed hendrerit eros dictum ut. Fusce efficitur feugiat blandit.', 4.32144, '2018-09-19 02:24:33'),
(18, 10, 4, 'Ut efficitur sodales egestas. Etiam non ipsum quis lorem mollis iaculis. Vivamus id nibh at lacus gravida aliquam nec ut nibh. Sed blandit massa et eros aliquet, eget ultrices leo ornare. Vestibulum egestas, sem eget rutrum tincidunt, dolor ex semper eros, sit.', 4.10123, '2018-09-18 10:06:24'),
(19, 10, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim orci pretium porta volutpat. Etiam at lorem nec nisl pellentesque rutrum vel quis nisi. Aliquam risus mauris, convallis ac vulputate ac, commodo a erat. Nunc at leo sit amet ligula ultrices porta. Nullam non urna accumsan.', 4.03325, '2018-09-20 11:16:15');


--
-- Contenu de la table `achat`
--

INSERT INTO `achat` (`achat_id`, `type_paiement_id`, `membre_id`, `jeux_id`, `date_achat`, `transaction_id`) VALUES
(1, 2, 1, 2, '2018-09-16 04:13:54', NULL);


--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie`) VALUES
(1, 'Action'),
(2, 'Combat'),
(3, 'Aventure'),
(4, 'Sports'),
(5, 'Course'),
(6, 'Simulation'),
(7, 'Stratégie'),
(8, 'Plate-forme'),
(9, 'Labyrinthe'),
(10, 'Musique'),
(11, 'FPS'),
(12, 'RPG');


--
-- Contenu de la table `categorie_jeux`
--
INSERT INTO `categorie_jeux` (`jeux_id`, `categorie_id`) VALUES
(1, 3),
(1, 8),
(2, 1),
(2, 3),
(3, 8), 
(3, 5),
(3, 3),
(4, 1),
(4, 8),
(5, 5),
(6, 8),
(6, 10),
(7, 1),
(7, 5),
(8, 11),
(8, 1),
(8, 3),
(9, 1),
(10, 1),
(10, 3),
(10, 6);


--
-- Contenu de la table `location`
--

INSERT INTO `location` (`location_id`, `type_paiement_id`, `membre_id`, `jeux_id`, `date_debut`, `date_retour`, `transaction_id`) VALUES
(1, 2, 1, 1, '2018-09-10 09:15:54', '2018-09-16 04:13:54', NULL);


--
-- Contenu de la table `photo_jeux`
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
