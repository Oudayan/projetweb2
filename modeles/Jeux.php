<?php
/**
 * @file    Jeux.php
 * @author  Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Jeux
 * @details Cette classe définit les attributs d'un membre
 */

    class Jeux{
        //Atributs
        private $jeux_id;
        private $plateforme_id;
        private $membre_id;
        private $prenom;
        private $mot_de_passe;
        private $adresse;
        private $telephone;
        private $courriel;
        private $membre_valide;
        private $membre_actif;

        // Constructeur

        public function __construct($jeux_id = 0, $plateforme_id = 1, $membre_id = "", $prenom = "", $mot_de_passe = "", $adresse = "", $telephone = "", $courriel = "", $membre_valide = false, $membre_actif = true)
        {
           $this->setJeuxId($jeux_id);
           $this->setPlateformeId($plateforme_id);
           $this->setMembreId($membre_id);
           $this->setPrenom($prenom);
           $this->setMotDePasse($mot_de_passe);
           $this->setAdresse($adresse);
           $this->setTelephone($telephone);
           $this->setCourriel($courriel);
           $this->setMembreValide($membre_valide);
           $this->setMembreActif($membre_actif);
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
         * @param       [string] $prenom , le prénom d'un membre
         * @return      [object]
         */
        public function setPrenom($prenom){
            if(is_string($prenom) && trim($prenom) !=""){
                $this->prenom = $prenom;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [string] $mot_de_passe , le mot de passe d'un membre
         * @return      [object]
         */
        public function setMotDePasse($mot_de_passe){
            if(is_string($mot_de_passe) && trim($mot_de_passe) != ""){
                $this->mot_de_passe = $mot_de_passe;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [string] $adresse, l'adresse d'un membre
         * @return      [object]
         */
        public function setAdresse($adresse){
            if(is_string($adresse) && trim($adresse) != ""){
                $this->adresse = $adresse;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [string] $telephone, le numéro de téléphone d'un utilisateur
         * @return      [object]
         */
        public function setTelephone($telephone){
            if(is_string($telephone) && trim($telephone) != ""){
                $this->telephone = $telephone;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [mixed] $courriel, le courriel d'un membre
         * @return      [object]
         */

        public function setCourriel($courriel){
            if(is_string($courriel) && trim($courriel) != ""){
                $this->courriel = $courriel;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [bool] $membre_valide, indique si un membre est ou pas valide
         * @return      [object]
         */

        public function setMembreValide($membre_valide){
            if(is_bool($membre_valide)){
                $this->membre_valide = $membre_valide;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         * 
         * @param       [bool] $membre_actif, indique si un membre est ou pas actif
         * @return      [object]
         */

        public function setMembreActif($membre_actif){
            if(is_bool($membre_actif)){
                $this->membre_actif = $membre_actif;
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
         * @param       [string] $membre_id, le nom d'un membre
         * @return      [object]
         */

        public function getMembreId(){
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $prenom, le prénom d'un membre
         * @return      [object]
         */

        public function getPrenom(){
            return $this->prenom;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $mot_de_passe, le mot de passe d'un memebre
         * @return      [object]
         */

        public function getMotDePasse(){
            return $this->mot_de_passe;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $adresse, l'adresse' d'un memebre
         * @return      [object]
         */

        public function getAdresse(){
            return $this->adresse;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $telephone, le téléphone d'un memebre
         * @return      [object]
         */

        public function getTelephone(){
            return $this->telephone;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $courriel, le courriel d'un membre
         * @return      [object]
         */

        public function getCourriel(){
            return $this->courriel;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [bool] $membre_valide, le membre est ou pas valide
         * @return      [object]
         */

        public function getMembreValide(){
            return $this->membre_valide;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [bool] $membre_actif, le membre est ou pas acatif
         * @return      [object]
         */

        public function getMembreActif(){
            return $this->membre_actif;
        }
    }
