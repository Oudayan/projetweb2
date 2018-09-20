<?php
/**
 * @file    Membres.php
 * @author  Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Membres
 * @details Cette classe définit les attributs d'un membre
 */

    class Membres{
        //Atributs
        private $membre_id;
        private $type_utilisateur_id;
        private $nom;
        private $prenom;
        private $mot_de_passe;
        private $adresse;
        private $telephone;
        private $courriel;
        private $membre_valide;
        private $membre_actif;

        // Constructeur

        public function __construct($membre_id = 0, $type_utilisateur_id = 1, $nom = "", $prenom = "", $mot_de_passe = "", $adresse = "", $telephone = "", $courriel = "", $membre_valide = 0, $membre_actif = true)
        {
           $this->ecrireMembreId($membre_id);
           $this->ecrireTypeUtilisateur($type_utilisateur_id);
           $this->ecrireNom($nom);
           $this->ecrirePrenom($prenom);
           $this->ecrireMotDePasse($mot_de_passe);
           $this->ecrireAdresse($adresse);
           $this->ecrireTelephone($telephone);
           $this->ecrireCourriel($courriel);
           $this->ecrireMembreValide($membre_valide);
           $this->ecrireMembreActif($membre_actif);
        }

        //SETTERS
        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         *
         * @param       [numeric] $membre_id ,  l'id d'un membre
         * @return      [object]
         */
        public function ecrireMembreId($membre_id){
            if (is_numeric($membre_id) && trim($membre_id) != ""){
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         *
         * @param       [numeric] $type_utilisateur_id , l'id du type d'utilisateur
         * @return      [object]
         */
        public function ecrireTypeUtilisateur($type_utilisateur_id){
            if (is_numeric($type_utilisateur_id) && trim($type_utilisateur_id) != ""){
                $this->type_utilisateur_id = $type_utilisateur_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         *
         * @param       [string] $nom , le nom d'un membre
         * @return      [object]
         */
        public function ecrireNom($nom){
            if(is_string($nom) && trim($nom) !=""){
                $this->nom = $nom;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         *
         * @param       [string] $prenom , le prénom d'un membre
         * @return      [object]
         */
        public function ecrirePrenom($prenom){
            if(is_string($prenom) && trim($prenom) !=""){
                $this->prenom = $prenom;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * 
         * @param       [string] $mot_de_passe , le mot de passe d'un membre
         * @return      [object]
         */
        public function ecrireMotDePasse($mot_de_passe){
            if(is_string($mot_de_passe) && trim($mot_de_passe) != ""){
                $this->mot_de_passe = $mot_de_passe;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * 
         * @param       [string] $adresse, l'adresse d'un membre
         * @return      [object]
         */
        public function ecrireAdresse($adresse){
            if(is_string($adresse) && trim($adresse) != ""){
                $this->adresse = $adresse;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * 
         * @param       [string] $telephone, le numéro de téléphone d'un utilisateur
         * @return      [object]
         */
        public function ecrireTelephone($telephone){
            if(is_string($telephone) && trim($telephone) != ""){
                $this->telephone = $telephone;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * 
         * @param       [mixed] $courriel, le courriel d'un membre
         * @return      [object]
         */

        public function ecrireCourriel($courriel){
            if(is_string($courriel) && trim($courriel) != ""){
                $this->courriel = $courriel;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * 
         * @param       [bool] $membre_valide, indique si un membre est ou pas valide
         * @return      [object]
         */

        public function ecrireMembreValide($membre_valide){
            if(is_bool($membre_valide)){
                $this->membre_valide = $membre_valide;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Membres
         * 
         * @param       [bool] $membre_actif, indique si un membre est ou pas actif
         * @return      [object]
         */

        public function ecrireMembreActif($membre_actif){
            if(is_bool($membre_actif)){
                $this->membre_actif = $membre_actif;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [numeric] $membre_id ,  l'id d'un membre
         * @return      [object]
         */

        public function lireMembreId(){
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [numeric] $type_utilisateur_id ,  l'id de le type de utilisateur
         * @return      [object]
         */

        public function lireTypeUtilisateur(){
            return $this->type_utilisateur_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [string] $nom, le nom d'un membre
         * @return      [object]
         */

        public function lireNom(){
            return $this->nom;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [string] $prenom, le prénom d'un membre
         * @return      [object]
         */

        public function lirePrenom(){
            return $this->prenom;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [string] $mot_de_passe, le mot de passe d'un memebre
         * @return      [object]
         */

        public function lireMotDePasse(){
            return $this->mot_de_passe;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [string] $adresse, l'adresse' d'un memebre
         * @return      [object]
         */

        public function lireAdresse(){
            return $this->adresse;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [string] $telephone, le téléphone d'un memebre
         * @return      [object]
         */

        public function lireTelephone(){
            return $this->telephone;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [string] $courriel, le courriel d'un membre
         * @return      [object]
         */

        public function lireCourriel(){
            return $this->courriel;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [bool] $membre_valide, le membre est ou pas valide
         * @return      [object]
         */

        public function lireMembreValide(){
            return $this->membre_valide;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         *
         * @param       [bool] $membre_actif, le membre est ou pas acatif
         * @return      [object]
         */

        public function lireMembreActif(){
            return $this->membre_actif;
        }
    }