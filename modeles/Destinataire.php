<?php
/**
 * @file    Destinataire.php
 * @author  Jansy Lopez
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Destinataire
 * @details Cette classe définit les attributs de le destinataire
 */

    class Destinataire{
        //Atributs
        private $membre_id;
        private $msg_id;
        

        // Constructeur

        public function __construct($membre_id = null, $msg_id = "")
        {
           $this->setMembre_Id($membre_id);
           $this->setMsg_Id($msg_id);
           

        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Destinataire
         *
         * @param       [numeric] $membre_id , l'id du type de msg_id
         * @return      [object]
         */
        public function setMembre_Id($membre_id){
            if (is_numeric($membre_id) && trim($membre_id) != ""){
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Destinataire
         *
         * @param       [numeric] $msg_id ,  identifie une message
         * @return      [object]
         */
        public function setMsg_Id($msg_id){
            if (is_numeric($msg_id) && trim($msg_id) != ""){
                $this->msg_id = $msg_id;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Destinataire
         *
         * @param       [numeric] $plateforme ,  l'id d'un jeux
         * @return      [object]
         */

        public function getMembre_Id(){
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Destinataire
         *
         * @param       [numeric] $membre_id ,  l'id de le type de message
         * @return      [object]
         */

        public function getMsg_Id(){
            return $this->msg_id;
        }

    }
