<?php
/**
 * @file    Plateformes.php
 * @author  Guilherme Tosin, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Jeux
 * @details Cette classe définit les attributs d'un jeu
 */

    class Plateformes{
        //Atributs
        private $plateforme_id;
        private $plateforme;
        

        // Constructeur

        public function __construct($plateforme_id = 0, $plateforme = "")
        {
           $this->setPlateformeId($plateforme_id);
           $this->setPlateforme($plateforme);

        }

        //SETTERS

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
         * @param       [numeric] $plateforme ,  l'id d'un jeu
         * @return      [object]
         */
        public function setPlateforme($plateforme){
            if (is_string($plateforme) && trim($plateforme) != ""){
                $this->plateforme = $plateforme;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [numeric] $plateforme ,  l'id d'un jeux
         * @return      [object]
         */

        public function getPlateformeId(){
            return $this->plateforme_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [numeric] $plateforme_id ,  l'id de le type de plateforme
         * @return      [object]
         */

        public function getPlateforme(){
            return $this->plateforme;
        }

    }
