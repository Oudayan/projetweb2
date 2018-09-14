/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2018/9/14 17:42:37                           */
/* Nom de bd:      projet utf-8 */

/*==============================================================*/


drop table if exists achat;

drop table if exists appartenir;

drop table if exists assigner_destinaitaire;

drop table if exists associer;

drop table if exists categorie_jeux;

drop table if exists commentaire_jeux;

drop table if exists jeux;

drop table if exists location;

drop table if exists membre;

drop table if exists messagerie;

drop table if exists photo_jeux;

drop table if exists plate_forme;

drop table if exists type_paiement;

drop table if exists type_utilisateur;

/*==============================================================*/
/* Table: achat                                                 */
/*==============================================================*/
create table achat
(
   achat_id             int not null,
   membre_id            int not null,
   date_achat           datetime not null,
   primary key (achat_id)
);

/*==============================================================*/
/* Table: appartenir                                            */
/*==============================================================*/
create table appartenir
(
   jeux_id              int not null,
   categorie_jeux_id    int not null,
   primary key (jeux_id, categorie_jeux_id)
);

/*==============================================================*/
/* Table: assigner_destinaitaire                                */
/*==============================================================*/
create table assigner_destinaitaire
(
   membre_id            int not null,
   msg_id               int not null,
   primary key (membre_id, msg_id)
);

/*==============================================================*/
/* Table: associer                                              */
/*==============================================================*/
create table associer
(
   membre_id            int not null,
   type_paiement_id     int not null,
   primary key (membre_id, type_paiement_id)
);

/*==============================================================*/
/* Table: categorie_jeux                                        */
/*==============================================================*/
create table categorie_jeux
(
   categorie_jeux_id    int not null,
   nom                  varchar(255),
   primary key (categorie_jeux_id)
);

alter table categorie_jeux comment 'le jeux est quel categorie

action
sex
                                   -&';

/*==============================================================*/
/* Table: commentaire_jeux                                      */
/*==============================================================*/
create table commentaire_jeux
(
   commentaire_jeux_id  int not null,
   jeux_id              int not null,
   membre_id            int not null,
   commentaire          text not null,
   evaluation           decimal,
   primary key (commentaire_jeux_id)
);

alter table commentaire_jeux comment 'ce entiter on peux choisir deux type
1. le utilisateur';

/*==============================================================*/
/* Table: jeux                                                  */
/*==============================================================*/
create table jeux
(
   jeux_id              int not null,
   plate_forme_id       int not null,
   membre_id            int not null,
   location_id          int,
   achat_id             int,
   nom                  varchar(255) not null,
   prix                 decimal(3,2) not null,
   date_ajout           datetime not null,
   concepteur           varchar(255) not null,
   location             bool not null,
   primary key (jeux_id)
);

/*==============================================================*/
/* Table: location                                              */
/*==============================================================*/
create table location
(
   location_id          int not null,
   membre_id            int,
   date_debut           datetime not null,
   date_retour          datetime not null,
   primary key (location_id)
);

alter table location comment 'pas sure il faut confirmer avec des camarades';

/*==============================================================*/
/* Table: membre                                                */
/*==============================================================*/
create table membre
(
   membre_id            int not null,
   type_utilisateur_id  int not null,
   nom                  varchar(255) not null,
   prenom               varchar(255) not null,
   mot_de_passe         varchar(32) not null,
   adresse              varchar(128) not null,
   telephone            varchar(32) not null,
   courriel             varchar(96) not null,
   membre_valide        bool not null,
   membre_actif         bool not null,
   primary key (membre_id)
);

/*==============================================================*/
/* Table: messagerie                                            */
/*==============================================================*/
create table messagerie
(
   msg_id               int not null,
   membre_id            int not null,
   sujet                varchar(255) not null,
   message              text not null,
   msg_date             datetime not null,
   msg_actif            bool not null,
   primary key (msg_id)
);

alter table messagerie comment 'messagerie interne pour communication entre des utilisateur';

/*==============================================================*/
/* Table: photo_jeux                                            */
/*==============================================================*/
create table photo_jeux
(
   photo_jeux_id        int not null,
   jeux_id              int not null,
   chemin_photo         varchar(255) not null,
   primary key (photo_jeux_id)
);

alter table photo_jeux comment 'peut etre une photo pour plusieur jeux meme nom';

/*==============================================================*/
/* Table: plate_forme                                           */
/*==============================================================*/
create table plate_forme
(
   plate_forme_id       int not null,
   plate_forme          varchar(255) not null,
   primary key (plate_forme_id)
);

alter table plate_forme comment 'Determiner le jeux fonctionner dans quel plateau
windo';

/*==============================================================*/
/* Table: type_paiement                                         */
/*==============================================================*/
create table type_paiement
(
   type_paiement_id     int not null,
   type_paiement        varchar(32),
   primary key (type_paiement_id)
);

alter table type_paiement comment 'paypal
comptant
cheque';

/*==============================================================*/
/* Table: type_utilisateur                                      */
/*==============================================================*/
create table type_utilisateur
(
   type_utilisateur_id  int not null,
   type_utilisateur     varchar(32) not null,
   primary key (type_utilisateur_id)
);

alter table achat add constraint FK_faire foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table appartenir add constraint FK_appartenir foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

alter table appartenir add constraint FK_appartenir2 foreign key (categorie_jeux_id)
      references categorie_jeux (categorie_jeux_id) on delete restrict on update restrict;

alter table assigner_destinaitaire add constraint FK_assigner_destinaitaire foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table assigner_destinaitaire add constraint FK_assigner_destinaitaire2 foreign key (msg_id)
      references messagerie (msg_id) on delete restrict on update restrict;

alter table associer add constraint FK_associer foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table associer add constraint FK_associer2 foreign key (type_paiement_id)
      references type_paiement (type_paiement_id) on delete restrict on update restrict;

alter table commentaire_jeux add constraint FK_composer foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table commentaire_jeux add constraint FK_concerner foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

alter table jeux add constraint FK_avoir foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table jeux add constraint FK_classer foreign key (plate_forme_id)
      references plate_forme (plate_forme_id) on delete restrict on update restrict;

alter table jeux add constraint FK_etre_acheter foreign key (achat_id)
      references achat (achat_id) on delete restrict on update restrict;

alter table jeux add constraint FK_etre_louer foreign key (location_id)
      references location (location_id) on delete restrict on update restrict;

alter table location add constraint FK_louer foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table membre add constraint FK_etre foreign key (type_utilisateur_id)
      references type_utilisateur (type_utilisateur_id) on delete restrict on update restrict;

alter table messagerie add constraint FK_assigner_emmeteur foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table photo_jeux add constraint FK_posseder foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

