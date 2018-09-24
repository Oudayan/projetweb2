<?php
/**
 * @file    Categories.php
 * @author  Guilherme Tosin, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Categorie
 * @details Cette classe définit les attributs d'un type de categorie de jeu
 */

    class Categories {
        //Atributs
        private $categorie_id;
        private $categorie;

        // Constructeur
        public function __construct($categorie_id = 0, $categorie = "")
        {
            $this->setCategorieId($categorie_id);
            $this->setCategorie($categorie);
        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [numeric] $categorie_id, l'id de la categorie
         * @return      []
         */
        public function setCategorieId($categorie_id) {
            if (is_numeric($categorie_id) && trim($categorie_id) != "") {
                $this->categorie_id = $categorie_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [string] $categorie, le nom de la categorie
         * @return      []
         */
        public function setCategorie($categorie) {
            if (is_string($categorie) && trim($categorie) != "") {
                $this->categorie = $categorie;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie
         * @param       [numeric] $categorie_id, l'id de la Categorie
         * @return      [numeric]
         */
        public function getCategorieId() {
            return $this->categorie_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie
         * @param       [string] $categorie,  le nom de la categorie
         * @return      [string]
         */
        public function getCategorie() {
            return $this->categorie;
        }

    }
