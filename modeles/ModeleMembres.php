<?php
/**
 * @file      ModeleMembres.php
 * @author    Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version   1.0.0
 * @date      Septembre 2018
 * @brief     Définit la classe ModeleMembres
 * 
 * @details   Cette classe définit les attributs qu'on a besion pour tout ce qui corcerne aux membres inscrits sur le site
 */


    class ModeleMembres extends BaseDAO
    {
        /**
         * @brief   Méthode pour aller chercher le nom d'une table
         * @details Cette méthode va chercher le nom de d'une table dans la BD
         * @return  [string]
         */

        public function lireNomTable()
        {
            return "membre";
        }

        /**
         *  @brief   Méthode pour aller chercher un membre
         * @details Méthode que permets aller chercher l'information de un membre en utilisant son id
         * @param   [numeric] $membre_id
         * @return  [array]
         */

        public function obtenirParId($membre_id)
        {
            $resultat = $this->lire($membre_id); 
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Membres');
            $unMembre = $resultat->fetch();
            return $unMembre;
        }


        /**
         * @brief   Méthode pour aller chercher un membre
         * @details Méthode que permets aller chercher l'information de un membre en utilisant son courriel
         * @param   [string] $courriel
         * @return  [array] 
         */

        public function obtenirParCourriel($courriel)
        {
            $resultat = $this->lire($courriel); 
            $resultat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Membres');
            $unMembre = $resultat->fetch();
            return $unMembre;
        }

        /**
         * @brief   Méthode pour obtenir tous les memebres dans la BD
         * @details Méthode qui obtiens tous les informations enregistrées dans la BD de tous les membres
         * @return  [array]
         */

        public function obtenirTous()
        {
            $resultat = $this->lireTous();
            $desMembres = $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Membres");
            return $desMembres;
        }


        /**
         * @brief   Méthode pour enregistrer un nouveau membre dans la bd
         * @details Recueillir les informations insérées et les enregistrer dans la BD
         * @param   [numeric] $membre_id
         * @param   [numeric] $type_utilisateur_id
         * @param   [string] $nom
         * @param   [string] $prenom
         * @param   [string] $mot_de_passe
         * @param   [string] $adresse
         * @param   [string] $telephone
         * @param   [string] $courriel 
         * @return  [aucun]
         */

        public function sauvegarde(Membres $unMembre)
        {
            $sql = "INSERT INTO" . $this->lireNomTable() . "(membre_id, type_utilisateur_id, nom, prenom, mot_de_passe, adresse, telephone, courriel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $donnees = array($unMembre->lireMembreId(), $unMembre->lireTypeUtilisateur(), $unMembre->lireNom(), $unMembre->lirePrenom(), $unMembre->lireMotDePasse(),
            $unMembre->lireAdresse(), $unMembre->lireTelephone(), $unMembre->lireCourriel());
            return $this->requete($sql, $donnees);
        }

        /**
         * @brief   Méthode pour valider un membre inscrit dans la bd
         * @details Méthode modifie la valeur par défaut dans la bd de chaque nouveau membre
         * @param   [string] $courriel
         * @return  [aucun]
         */

        public function validerMembre(Membres $membre){
            $sql = "UPDATE " . $this->lireNomTable() . " SET membre_valide = 1  WHERE courriel = ?";
            $donnees = array($membre->lireCourriel());
            return $this->requete($sql, $donnees);
        }

    }