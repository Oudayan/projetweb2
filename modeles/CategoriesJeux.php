<?php
/**
 * @file    CategoriesJeux.php
 * @author  Guilherme Tosin, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Categorie de jeux
 * @details Cette classe définit les attributs d'un type de categorie de jeu
 */

    class CategoriesJeux {
        //Atributs
        private $jeux_id;
        private $categorie_id;
        private $categorie;
        private $categorie_active;

        // Constructeur
        public function __construct($jeux_id = 0,$categorie_id = 0, $categorie = "", $categorie_active = 1)
        {
            $this->setJeuxId($jeux_id); 
            $this->setCategorieId($categorie_id);
            $this->setCategorie($categorie);
            $this->setCategorieActive($categorie_active);
        }

        //SETTERS

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie de jeux
         * @param       [numeric] $categorie ,  l'id d'une Categorie de jeu
         * @return      [object]
         */
        public function setJeuxId($jeux_id){
            if (is_numeric($jeux_id) && trim($jeux_id) != ""){
                $this->jeux_id = $jeux_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie de jeux
         * @param       [numeric] $categorie_id , l'id du type de categorie de jeu
         * @return      [object]
         */
        public function setCategorieId($categorie_id){
            if (is_numeric($categorie_id) && trim($categorie_id) != ""){
                $this->categorie_id = $categorie_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [numeric] $categorie ,  l'id d'une Categorie
         * @return      [object]
         */
        public function setCategorie($categorie){
            if (is_string($categorie) && trim($categorie) != ""){
                $this->categorie = $categorie;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [numeric] $categorie_active, categorie active ou non
         * @return      [object]
         */
        public function setCategorieActive($categorie_active) {
            if (is_numeric($categorie_active) && trim($categorie_active) != "") {
                $this->categorie_active = $categorie_active;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie de jeux
         * @param       [numeric] $categorie_id ,  l'id de le type de categorie de jeu
         * @return      [object]
         */
        public function getJeuxId(){
            return $this->jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie de jeux
         * @param       [numeric] $categorie ,  l'id d'une Categorie de jeu
         * @return      [object]
         */
        public function getCategorieId(){
            return $this->categorie_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie
         * @param       [string] $categorie ,  le nom de la categorie
         * @return      [object]
         */
        public function getCategorie(){
            return $this->categorie;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie
         * @param       [numeric] $categorie_active,  le nom de la categorie
         * @return      [object]
         */
        public function getCategorieActive() {
            return $this->categorie_active;
        }

    }
