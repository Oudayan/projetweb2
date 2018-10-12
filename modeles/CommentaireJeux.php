<?php
/**
 * @file    CommentaireJeux.php
 * @author  Guilherme Tosin, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Commentaire de jeux
 * @details Cette classe définit les attributs d'un type de commentaire de jeu
 */

    class CommentaireJeux {
        //Atributs
        private $commentaire_jeux_id;
        private $jeux_id;
        private $membre_id;
        private $jeton;
        private $commentaire;
        private $evaluation;
        private $date_commentaire;

        // Constructeur
        public function __construct($commentaire_jeux_id = 0, $jeux_id = 0, $membre_id = 0, $jeton = "", $commentaire= "", $evaluation = 0, $date_commentaire = "")
        {
            $this->setCommentaireJeuxId($commentaire_jeux_id); 
            $this->setJeuxId($jeux_id);
            $this->setMembreId($membre_id);
            $this->setJeton($jeton);
            $this->setCommentaire($commentaire);
            $this->setEvaluation($evaluation);
            $this->setDateCommentaire($date_commentaire);
        }

        //SETTERS

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Commentaire de jeux
         * @param       [numeric] $membre_id ,  l'id d'une Categorie de jeu
         * @return      [object]
         */
        public function setCommentaireJeuxId($commentaire_jeux_id){
            if (is_numeric($commentaire_jeux_id) && trim($commentaire_jeux_id) != ""){
                $this->commentaire_jeux_id = $commentaire_jeux_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Commentaire de jeux
         * @param       [numeric] $jeux_id , l'id du jeu du commentaire
         * @return      [object]
         */
        public function setJeuxId($jeux_id){
            if (is_numeric($jeux_id) && trim($jeux_id) != ""){
                $this->jeux_id = $jeux_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Commentaire de jeux
         * @param       [numeric] $membre_id ,  l'id du membre qui a fait le commentaire de jeu
         * @return      [object]
         */
        public function setMembreId($membre_id){
            if (is_numeric($membre_id) && trim($membre_id) != ""){
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Commentaire de jeux
         * @param       [string] $jeton , jeton unique du commentaire de jeu
         * @return      [object]
         */
        public function setJeton($jeton){
            if (is_string($jeton) && trim($jeton) != ""){
                $this->jeton = $jeton;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [string] $commentaire ,  le commentaire d'un jeu
         * @return      [object]
         */
        public function setCommentaire($commentaire){
            if (is_string($commentaire) && trim($commentaire) != ""){
                $this->commentaire = $$commentaire;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [numeric] $evaluation ,  l'evaluation d'un jeu
         * @return      [object]
         */
        public function setEvaluation($evaluation){
            if (is_numeric($evaluation) && trim($evaluation) != ""){
                $this->evaluation = $evaluation;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [numeric] $date_commentaire ,  la date d'ajout d'un commentaire
         * @return      [object]
         */
        public function setDateCommentaire($date_commentaire){
            if (is_string($date_commentaire) && trim($date_commentaire) != ""){
                $this->date_commentaire = $date_commentaire;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [numeric] $commentaire_jeux_id ,  l'id du commentaire de jeu
         * @return      [object]
         */
        public function getCommentaireJeuxId(){
            return $this->commentaire_jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [numeric] $jeux_id ,  l'id du jeu du commentaire
         * @return      [object]
         */
        public function getJeuxId(){
            return $this->jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [string] $membre_id ,  l'id de membre qui fait une commentaire
         * @return      [object]
         */
        public function getMembreId(){
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [string] $jeton ,  le jeton unique d'un commentaire de jeu
         * @return      [object]
         */
        public function getJeton(){
            return $this->jeton;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [string] $commentaire ,  le commentaire
         * @return      [object]
         */
        public function getCommentaire(){
            return $this->commentaire;
        }

         /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [string] $evaluation ,  le evaluation d'un commentaire
         * @return      [object]
         */
        public function getEvaluation(){
            return $this->evaluation;
        }

         /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [string] $date_commentaire ,  la date d'ajout dún commentarie
         * @return      [object]
         */
        public function getDateCommentaire(){
            return $this->date_commentaire;
        }

    }
