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
   `date_achat`           datetime not null,
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
   `evaluation`           decimal(2,1),
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
   primary key (jeux_id)
);

/*==============================================================*/
/* Table: location                                              */
/*==============================================================*/
create table location
(
   `location_id`          int not null auto_increment,
   `type_paiement_id`     int not null,
   `membre_id`            int,
   `date_debut`           datetime not null,
   `date_retour`          datetime not null,
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
   `membre_valide`        bool not null,
   `membre_actif`         bool not null,
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

INSERT INTO `jeux` (`jeux_id`, `plateforme_id`, `membre_id`, `titre`, `prix`, `date_ajout`, `concepteur`, `location`, `jeux_valide`, `jeux_actif`) VALUES
(1, 1, 1, 'Super Mario U 2', 7.5, '2018-09-16 04:13:54', 'Nintendo', 1, 1, 1),
(2, 2, 2, 'Shadow of the Colossus', 49.5, '2018-09-16 04:13:54', 'Sony', 0, 1, 1),
(3, 3, 3, 'Sonic The Hedgehog', 39.99, '2018-09-14 11:24:30', 'SEGA', 0, 1, 1),
(4, 4, 4, 'Megaman', 24, '2018-09-12 04:12:20', 'CAPCOM', 0, 1, 1),
(5, 3, 5, 'Mario Kart Double Dash', 31, '2018-09-10 12:44:33', 'Nintendo', 0, 1, 1),
(6, 7, 6, 'Donkey Kong Country', 24, '2018-09-15 10:02:50', 'Nintendo', 0, 1, 1),
(7, 4, 3, 'Shift 2 Unleashed', 32.99, '2018-09-10 06:24:30', 'EA', 0, 1, 1),
(8, 6, 4, 'Halo Reach', 44.5, '2018-09-11 07:12:20', 'Bungie', 0, 1, 1),
(9, 8, 5, 'The Secret of Monkey Island', 16, '2018-09-12 08:44:33', 'SEGA', 1, 1, 1),
(10, 2, 6, 'Assassins Creed BrotherHood', 35, '2018-09-13 09:02:50', 'UBISOFT', 0, 1, 1);


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
(11, 'Jeu de tir à la première personne');


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


--
-- Contenu de la table `photo_jeux`
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
