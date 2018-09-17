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
         * @brief   Fonction pour aller chercher le nom d'une table
         * @details Cette fonction va chercher le nom de d'une table dans la BD
         * @return  [string]
         */

        public function lireNomTable()
        {
            return "membre";
        }

        /**
         * @brief   Fonction pour aller chercher un membre
         * @details Fonction que permets aller chercher l'information de un membre en utilisant son courriel
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
         * @brief   Fonction pour obtenir tous les memebres dans la BD
         * @details Fonction qui obtiens tous les informations enregistrées dans la BD de tous les membres
         * @return  [array]
         */

        public function obtenirTous()
        {
            $resultat = $this->lireTous();
            $desMembres = $resultat->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Membres");
            return $desMembres;
        }


        /**
         * @brief   Fonction pour enregistrer un nouveau membre dans la bd
         * @details Recueillir les informations insérées et les enregistrer dans la BD
         * @
         */
    }