<?php
/**
 * @file    achat.php
 * @author  Jansy Lopez
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe achat
 * @details Cette classe définit pour les achat
 */

    class Achat {
        //Atributs
        private $achat_id;
        private $type_paiement_id;
        private $membre_id;
        private $jeux_id;
        private $date_achat;
        private $transaction_id;

        // Constructeur
        public function __construct($achat_id = 0, $type_paiement_id= 0, $membre_id = 0, $jeux_id = 0, $date_achat = "", $transaction_id = "")
        {
            $this->setAchatId($achat_id);
            $this->setTypePaiementId($type_paiement_id); 
            $this->setMembreId($membre_id);
            $this->setJeuxId($jeux_id);
            $this->setDateAchat($date_achat);
            $this->setTransactionAchat($transaction_id);
        }

        //SETTERS

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe achat_id
         * @param       [numeric] $membre_id ,  l'id d'une Categorie de jeu
         * @return      [object]
         */
        public function setAchatId($achat_id){
            if (is_numeric($achat_id) && trim($achat_id) != ""){
                $this->commentaire_jeux_id = $achat_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe achat
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
         * @param       [string] $type_paiement_id ,  le id de un paiement
         * @return      [object]
         */
        public function setTypePaiementId($type_paiement_id){
            if (is_string($type_paiement_id) && trim($type_paiement_id) != ""){
                $this->type_paiement_id = $type_paiement_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [numeric] $date_achat ,  la date d'un achat
         * @return      [object]
         */
        public function setDateAchat($date_achat){
            if (is_string($date_achat) && trim($date_achat) != ""){
                $this->date_achat = $date_achat;
            }
        }
        
        
        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Categorie
         * @param       [string] $transaction_id ,  le id d'un transaction
         * @return      [object]
         */
        public function setTransactionAchat($transaction_id){
            if (is_string($transaction_id) && trim($transaction_id) != ""){
                $this->transaction_id = $transaction_id;
            }
        }
        

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe achat
         * @param       [numeric] $achat_id ,  l'id d un achat efectue
         * @return      [object]
         */
        public function getAchatId(){
            return $this->achat_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe achat
         * @param       [numeric] $jeux_id ,  l'id d'une jeux achete
         * @return      [object]
         */
        public function getJeuxId(){
            return $this->jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe achat
         * @param       [string] $membre_id ,  l'id de membre qui fait une achat
         * @return      [object]
         */
        public function getMembreId(){
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe achat
         * @param       [string] $transaction_id ,  la transaction de un achat 
         * @return      [object]
         */
        public function getTransactionId(){
            return $this->transaction_id;
        }
        
        
          /**
         * @brief       Permet de définir en lecture l'attribut de la classe achat
         * @param       [numeric] type_paiement_id ,  le type de paiement efectue 
         * @return      [object]
         */
        public function getTypePaiementId(){
            return $this->type_paiement_id;
        }

      
         /**
         * @brief       Permet de définir en lecture l'attribut de la classe achat
         * @param       [string] $date_achat ,  la date d'ajout dún achat
         * @return      [object]
         */
        public function getDateAchat(){
            return $this->date_achat;
        }

    }
