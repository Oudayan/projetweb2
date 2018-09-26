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
        private $commentaire;
        private $evaluation;


        // Constructeur
        public function __construct($commentaire_jeux_id = 0,$jeux_id = 0, $membre_id = 0, $commentaire= "", $evaluation = "")
        {
            $this->setCommentaireJeuxId($commentaire_jeux_id); 
            $this->setJeuxId($jeux_id);
            $this->setMembreId($membre_id);
            $this->setCommentaire($commentaire);
            $this->setEvaluation($evaluation);
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
         * @param       [numeric] $jeux_id , l'id du type de Commentaire de jeu
         * @return      [object]
         */
        public function setJeuxId($jeux_id){
            if (is_numeric($jeux_id) && trim($jeux_id) != ""){
                $this->jeux_id = $jeux_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [numeric] $membre_id ,  l'id d'une Categorie
         * @return      [object]
         */
        public function setMembreId($membre_id){
            if (is_string($membre_id) && trim($membre_id) != ""){
                $this->membre_id = $membre_id;
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
            if (is_string($evaluation) && trim($evaluation) != ""){
                $this->evaluation = $evaluation;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [numeric] $commentaire_jeux_id ,  l'id du commentaire  de jeu
         * @return      [object]
         */
        public function getCommentaireJeuxId(){
            return $this->commentaire_jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Commentaire de jeux
         * @param       [numeric] $membre_id ,  l'id d'une Commentaire de jeu
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

    }
