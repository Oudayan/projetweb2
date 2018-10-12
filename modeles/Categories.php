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
        private $categorie_active;

        // Constructeur
        public function __construct($categorie_id = 0, $categorie = "", $categorie_active = 1)
        {
            $this->setCategorieId($categorie_id);
            $this->setCategorie($categorie);
            $this->setCategorieActive($categorie_active);
        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [numeric] $categorie_id, l'id de la categorie
         * @return      [object]
         */
        public function setCategorieId($categorie_id) {
            if (is_numeric($categorie_id) && trim($categorie_id) != "") {
                $this->categorie_id = $categorie_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [string] $categorie, le nom de la categorie
         * @return      [object]
         */
        public function setCategorie($categorie) {
            if (is_string($categorie) && trim($categorie) != "") {
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
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie
         * @param       [numeric] $categorie_id, l'id de la Categorie
         * @return      [object]
         */
        public function getCategorieId() {
            return $this->categorie_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Categorie
         * @param       [string] $categorie,  le nom de la categorie
         * @return      [object]
         */
        public function getCategorie() {
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
