/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2018/9/15 12:52:10                           */
/*==============================================================*/


drop table if exists Appartenir;

drop table if exists Associer;

drop table if exists achat;

drop table if exists "assigner destinaitaire";

drop table if exists categorie_jeux;

drop table if exists commentraire_jeux;

drop table if exists jeux;

drop table if exists location;

drop table if exists membre;

drop table if exists messagerie;

drop table if exists photo_jeux;

drop table if exists plate_forme;

drop table if exists type_paiement;

drop table if exists type_utilisateur;

/*==============================================================*/
/* Table: Appartenir                                            */
/*==============================================================*/
create table Appartenir
(
   jeux_id              int not null,
   categorie_jeux_id    int not null,
   primary key (jeux_id, categorie_jeux_id)
);

/*==============================================================*/
/* Table: Associer                                              */
/*==============================================================*/
create table Associer
(
   membre_id            int not null,
   type_paiement_id     int not null,
   primary key (membre_id, type_paiement_id)
);

/*==============================================================*/
/* Table: achat                                                 */
/*==============================================================*/
create table achat
(
   achat_id             int not null auto_increment,
   membre_id            int not null,
   date_achat           datetime not null,
   primary key (achat_id)
);

/*==============================================================*/
/* Table: "assigner destinaitaire"                              */
/*==============================================================*/
create table "assigner destinaitaire"
(
   membre_id            int not null,
   msg_id               int not null,
   primary key (membre_id, msg_id)
);

/*==============================================================*/
/* Table: categorie_jeux                                        */
/*==============================================================*/
create table categorie_jeux
(
   categorie_jeux_id    int not null auto_increment,
   nom                  varchar(255),
   primary key (categorie_jeux_id)
);

alter table categorie_jeux comment 'le jeux est quel categorie

action
sex
                                   -&';

/*==============================================================*/
/* Table: commentraire_jeux                                     */
/*==============================================================*/
create table commentraire_jeux
(
   commentaire_jeux_id  int not null auto_increment,
   jeux_id              int not null,
   membre_id            int not null,
   commentaire          text not null,
   evaluation           decimal(1,1),
   primary key (commentaire_jeux_id)
);

alter table commentraire_jeux comment 'ce entiter on peux choisir deux type
1. le utilisateur';

/*==============================================================*/
/* Table: jeux                                                  */
/*==============================================================*/
create table jeux
(
   jeux_id              int not null auto_increment,
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
   location_id          int not null auto_increment,
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
   membre_id            int not null auto_increment,
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
   msg_id               int not null auto_increment,
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
   photo_jeux_id        int not null auto_increment,
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
   plate_forme_id       int not null auto_increment,
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
   type_paiement_id     int not null auto_increment,
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
   type_utilisateur_id  int not null auto_increment,
   type_utilisateur     varchar(32) not null,
   primary key (type_utilisateur_id)
);

alter table Appartenir add constraint FK_Appartenir foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

alter table Appartenir add constraint FK_Appartenir2 foreign key (categorie_jeux_id)
      references categorie_jeux (categorie_jeux_id) on delete restrict on update restrict;

alter table Associer add constraint FK_Associer foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table Associer add constraint FK_Associer2 foreign key (type_paiement_id)
      references type_paiement (type_paiement_id) on delete restrict on update restrict;

alter table achat add constraint FK_Faire foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table "assigner destinaitaire" add constraint "FK_assigner destinaitaire" foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table "assigner destinaitaire" add constraint "FK_assigner destinaitaire2" foreign key (msg_id)
      references messagerie (msg_id) on delete restrict on update restrict;

alter table commentraire_jeux add constraint FK_Composer foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table commentraire_jeux add constraint FK_Concerner foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

alter table jeux add constraint FK_Avoir foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table jeux add constraint FK_Classer foreign key (plate_forme_id)
      references plate_forme (plate_forme_id) on delete restrict on update restrict;

alter table jeux add constraint "FK_Etre Acheter" foreign key (achat_id)
      references achat (achat_id) on delete restrict on update restrict;

alter table jeux add constraint "FK_Etre Louer" foreign key (location_id)
      references location (location_id) on delete restrict on update restrict;

alter table location add constraint FK_Louer foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table membre add constraint FK_Etre foreign key (type_utilisateur_id)
      references type_utilisateur (type_utilisateur_id) on delete restrict on update restrict;

alter table messagerie add constraint "FK_assigner emmeteur" foreign key (membre_id)
      references membre (membre_id) on delete restrict on update restrict;

alter table photo_jeux add constraint FK_Posseder foreign key (jeux_id)
      references jeux (jeux_id) on delete restrict on update restrict;

