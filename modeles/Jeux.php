<?php
/**
 * @file    Jeux.php
 * @author  Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Jeux
 * @details Cette classe définit les attributs d'un jeu
 */

    class Jeux{
        //Atributs
        private $jeux_id;
        private $plateforme_id;
        private $membre_id;
        private $titre;
        private $prix;
        private $date_ajout;
        private $concepteur;
        private $location;
        private $jeux_valide;
        private $jeux_actif;
        private $description;

        // Constructeur

        public function __construct($jeux_id = 0, $plateforme_id = 1, $membre_id = "", $titre = "", $prix = "", $date_ajout = "", $concepteur = "", $location = "", $jeux_valide = false, $jeux_actif = true, $description = "")
        {
           $this->setJeuxId($jeux_id);
           $this->setPlateformeId($plateforme_id);
           $this->setMembreId($membre_id);
           $this->setTitre($titre);
           $this->setPrix($prix);
           $this->setDateAjout($date_ajout);
           $this->setConcepteur($concepteur);
           $this->setLocation($location);
           $this->setJeuxValide($jeux_valide);
           $this->setJeuxActif($jeux_actif);
           $this->setDescription($description);
        }

        //SETTERS
        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         *
         * @param       [numeric] $jeux_id ,  l'id d'un jeu
         * @return      [object]
         */
        public function setJeuxId($jeux_id){
            if (is_numeric($jeux_id) && trim($jeux_id) != ""){
                $this->jeux_id = $jeux_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         *
         * @param       [numeric] $plateforme_id , l'id du type de plateforme
         * @return      [object]
         */
        public function setPlateformeId($plateforme_id){
            if (is_numeric($plateforme_id) && trim($plateforme_id) != ""){
                $this->plateforme_id = $plateforme_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         *
         * @param       [string] $membre_id , le nom d'un membre
         * @return      [object]
         */
        public function setMembreId($membre_id){
            if(is_string($membre_id) && trim($membre_id) !=""){
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         *
         * @param       [string] $titre , le titre d'un jeu
         * @return      [object]
         */
        public function setTitre($titre){
            if(is_string($titre) && trim($titre) !=""){
                $this->titre = $titre;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [string] $prix , le prix d'un jeu
         * @return      [object]
         */
        public function setPrix($prix){
            if(is_string($prix) && trim($prix) != ""){
                $this->prix = $prix;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [string] $date_ajout, l'DateAjout d'un membre
         * @return      [object]
         */
        public function setDateAjout($date_ajout){
            if(is_string($date_ajout) && trim($date_ajout) != ""){
                $this->dateAjout = $date_ajout;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [string] $concepteur, le numéro de téléphone d'un utilisateur
         * @return      [object]
         */
        public function setConcepteur($concepteur){
            if(is_string($concepteur) && trim($concepteur) != ""){
                $this->concepteur = $concepteur;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [mixed] $location, le Location d'un jeu
         * @return      [object]
         */

        public function setLocation($location){
            if(is_string($location) && trim($location) != ""){
                $this->location = $location;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [bool] $jeux_valide, indique si un jeu est ou pas valide
         * @return      [object]
         */

        public function setJeuxValide($jeux_valide){
            if(is_bool($jeux_valide)){
                $this->jeux_valide = $jeux_valide;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [bool] $jeux_actif, indique si un jeu est ou pas actif
         * @return      [object]
         */

        public function setJeuxActif($jeux_actif){
            if(is_bool($jeux_actif)){
                $this->jeux_actif = $jeux_actif;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [bool] $jeux_actif, la description de chaque jeu
         * @return      [object]
         */

        public function setDescription($description){
            if(is_string($description) && trim($description) != ""){
                $this->description = $description;
            }
        }


        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [numeric] $jeux_id ,  l'id d'un jeux
         * @return      [object]
         */

        public function getJeuxId(){
            return $this->jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [numeric] $plateforme_id ,  l'id de le type de plateforme
         * @return      [object]
         */

        public function getPlateformeId(){
            return $this->plateforme_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $membre_id, l'id d'un membre
         * @return      [object]
         */

        public function getMembreId(){
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $titre, le titre d'un jeu
         * @return      [object]
         */

        public function getTitre(){
            return $this->titre;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $prix, le prix d'un jeu
         * @return      [object]
         */

        public function getPrix(){
            return $this->prix;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $date_ajout, l'DateAjout' d'un jeu
         * @return      [object]
         */

        public function getDateAjout(){
            return $this->date_ajout;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $concepteur, le concepteur d'un jeux
         * @return      [object]
         */

        public function getConcepteur(){
            return $this->concepteur;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $location, le Location d'un jeu
         * @return      [object]
         */

        public function getLocation(){
            return $this->location;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [bool] $jeux_valide, le jeu est ou pas valide
         * @return      [object]
         */

        public function getJeuxValide(){
            return $this->jeux_valide;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [bool] $jeux_actif, le jeu est ou pas acatif
         * @return      [object]
         */

        public function getJeuxActif(){
            return $this->jeux_actif;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $description, le description d'un jeu
         * @return      [object]
         */

        public function getDescription(){
            return $this->description;
        }


    }
