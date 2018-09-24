<?php
/**
 * @file    CategorieJeux.php
 * @author  Guilherme Tosin, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Categorie de jeux
 * @details Cette classe définit les attributs d'un type de categorie de jeu
 */

    class CategorieJeux{
        //Atributs
        private $jeux_id;
        private $categorie_id;

        // Constructeur

        public function __construct($jeux_id = 0,$categorie_id = 0)
        {
            $this->setCategorie($jeux_id); 
            $this->setCategorieId($categorie_id);
            
        }

        //SETTERS

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie de jeux
         *
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
         *
         * @param       [numeric] $categorie_id , l'id du type de categorie de jeu
         * @return      [object]
         */
        public function setCategorieId($categorie_id){
            if (is_numeric($categorie_id) && trim($categorie_id) != ""){
                $this->categorie_id = $categorie_id;
            }
        }

       
        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie de jeux
         *
         * @param       [numeric] $categorie_id ,  l'id de le type de categorie de jeu
         * @return      [object]
         */

        public function getJeuxId(){
            return $this->jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie de jeux
         *
         * @param       [numeric] $categorie ,  l'id d'une Categorie de jeu
         * @return      [object]
         */

        public function getCategorieId(){
            return $this->categorie_id;
        }

        

    }
