<?php
/**
 * @file    Categories.php
 * @author  Guilherme Tosin, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Categorie
 * @details Cette classe définit les attributs d'un type de categorie de jeu
 */

    class Categories{
        //Atributs
        private $categorie_id;
        private $categorie;
        

        // Constructeur

        public function __construct($categorie_id = 0, $categorie = 0)
        {
           $this->setCategorieId($categorie_id);
           $this->setCategorie($categorie);
           
           
        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         *
         * @param       [numeric] $categorie_id , l'id du type de categorie
         * @return      [object]
         */
        public function setCategorieId($categorie_id){
            if (is_numeric($categorie_id) && trim($categorie_id) != ""){
                $this->categorie_id = $categorie_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         *
         * @param       [numeric] $categorie ,  l'id d'une Categorie
         * @return      [object]
         */
        public function setCategorie($categorie){
            if (is_numeric($categorie) && trim($categorie) != ""){
                $this->categorie = $categorie;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie
         *
         * @param       [numeric] $categorie ,  l'id d'une Categorie
         * @return      [object]
         */

        public function getCategorieId(){
            return $this->categorie_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie
         *
         * @param       [numeric] $categorie_id ,  l'id de le type de categorie
         * @return      [object]
         */

        public function getCategorie(){
            return $this->categorie;
        }

    }
