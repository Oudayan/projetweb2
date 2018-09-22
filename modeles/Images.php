<?php
/**
 * @file    Images.php
 * @author  Chunliang He, Guilherme Tosin, Jansy López, Marcelo Guzmán
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Jeux
 * @details Cette classe définit les attributs d'un jeu
 */

    class Images{
        //Atributs
        private $photo_jeux_id;
//        private $jeux_id;
        private $chemin_photo;

        // Constructeur

        public function __construct($photo_jeux_id = 0, $jeux_id = 0, $chemin_photo = "")
        {
//           $this->setJeuxId($jeux_id);
           $this->setPhotoJeuxId($photo_jeux_id);
           $this->setCheminPhoto($chemin_photo);

        }

        //SETTERS
        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         *
         * @param       [numeric] $jeux_id ,  l'id d'un jeu
         * @return      [object]
         */
//        public function setJeuxId($jeux_id){
//            if (is_numeric($jeux_id) && trim($jeux_id) != ""){
//                $this->jeux_id = $jeux_id;
//            }
//        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         *
         * @param       [numeric] $plateforme_id , l'id du type de plateforme
         * @return      [object]
         */
        public function setPhotoJeuxId($photo_jeux_id){
            if (is_numeric($photo_jeux_id) && trim($photo_jeux_id) != ""){
                $this->photo_jeux_id = $photo_jeux_id;
            }
        }


        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Jeux
         *
         * @param       [string] $titre , le titre d'un jeu
         * @return      [object]
         */
        public function setCheminPhoto($chemin_photo){
            if(is_string($chemin_photo) && trim($chemin_photo) !=""){
                $this->chemin_photo = $chemin_photo;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [numeric] $jeux_id ,  l'id d'un jeux
         * @return      [object]
         */
//
//        public function getJeuxId(){
//            return $this->jeux_id;
//        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [numeric] $plateforme_id ,  l'id de le type de plateforme
         * @return      [object]
         */

        public function getPhotoJeuxId(){
            return $this->photo_jeux_id;
        }


        public function getCheminPhoto(){
            return $this->chemin_photo;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Jeux
         *
         * @param       [string] $prix, le prix d'un jeu
         * @return      [object]
         */

    }
