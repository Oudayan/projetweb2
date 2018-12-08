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
        private $prix_achat;
        private $transaction_id;
        private $achat_actif;

        // Constructeur
        public function __construct($achat_id = 0, $type_paiement_id= 0, $membre_id = 0, $jeux_id = 0, $date_achat = "", $prix_achat = 0, $transaction_id = "", $achat_actif = 1) {
            $this->setAchatId($achat_id);
            $this->setTypePaiementId($type_paiement_id); 
            $this->setMembreId($membre_id);
            $this->setJeuxId($jeux_id);
            $this->setDateAchat($date_achat);
            $this->setPrixAchat($prix_achat);
            $this->setTransactionId($transaction_id);
            $this->setAchatActif($achat_actif);
        }

        //SETTERS

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Achat
         * @param       [numeric] $achat_id, Setter pour l'id de l'achat du jeu
         * @return      [object]
         */
        public function setAchatId($achat_id) {
            if (is_numeric($achat_id) && trim($achat_id) != "") {
                $this->achat_id = $achat_id;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Achat
         * @param       [string] $type_paiement_id, Setter pour l'id du type de paiement utilisé pour l'achat
         * @return      [object]
         */
        public function setTypePaiementId($type_paiement_id) {
            if (is_numeric($type_paiement_id) && trim($type_paiement_id) != "") {
                $this->type_paiement_id = $type_paiement_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Achat
         * @param       [numeric] $membre_id, Setter pour l'id de l'acheteur du jeu
         * @return      [object]
         */
        public function setMembreId($membre_id) {
            if (is_numeric($membre_id) && trim($membre_id) != "") {
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Achat
         * @param       [numeric] $jeux_id, Setter pour l'id du jeu vendu
         * @return      [object]
         */
        public function setJeuxId($jeux_id) {
            if (is_numeric($jeux_id) && trim($jeux_id) != "") {
                $this->jeux_id = $jeux_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Achat
         * @param       [string] $date_achat, Setter pour la date de l'achat du jeu
         * @return      [object]
         */
        public function setDateAchat($date_achat) {
            if (is_string($date_achat) && trim($date_achat) != "") {
                $this->date_achat = $date_achat;
            }
        }
        
           /**
         * @brief       Permet de définir en écriture l'attribut de la classe Achat
         * @param       [numeric] $prix_achat, Setter pour le prix d'achat du jeu
         * @return      [object]
         */
        public function setPrixAchat($prix_achat) {
            if (is_numeric($prix_achat) && trim($prix_achat) != "") {
                $this->prix_achat = $prix_achat;
            }
        }
        
        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Achat
         * @param       [string] $transaction_id, Setter pour l'id de la transaction reçu de Paypal
         * @return      [object]
         */
        public function setTransactionId($transaction_id) {
            if (is_string($transaction_id) && trim($transaction_id) != "") {
                $this->transaction_id = $transaction_id;
            }
        }

         /**
         * @brief       Permet de définir en écriture l'attribut de la classe Achat
         * @param       [numeric] $achat_actif, Setter pour indiquer si l'achat est actif ou annnulé
         * @return      [object]
         */
        public function setAchatActif($achat_actif) {
            if (is_numeric($achat_actif) && trim($achat_actif) != "") {
                $this->achat_actif = $achat_actif;
            }
        }


        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Achat
         * @param       [numeric] $achat_id, Getter pour l'id de l'achat du jeu
         * @return      [object]
         */
        public function getAchatId() {
            return $this->achat_id;
        }

          /**
         * @brief       Permet de définir en lecture l'attribut de la classe Achat
         * @param       [numeric] type_paiement_id, Getter pour l'id du type de paiement utilisé pour l'achat
         * @return      [object]
         */
        public function getTypePaiementId() {
            return $this->type_paiement_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Achat
         * @param       [string] $membre_id, Getter pour l'id de l'acheteur du jeu
         * @return      [object]
         */
        public function getMembreId() {
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Achat
         * @param       [numeric] $jeux_id, Getter pour l'id du jeu vendu
         * @return      [object]
         */
        public function getJeuxId() {
            return $this->jeux_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Achat
         * @param       [string] $date_achat, Getter pour la date de l'achat du jeu
         * @return      [object]
         */
        public function getDateAchat() {
            return $this->date_achat;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Achat
         * @param       [string] $prix_achat, Getter pour la prix de l'achat du jeu
         * @return      [object]
         */
        public function getPrixAchat() {
            return $this->prix_achat;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Achat
         * @param       [string] $transaction_id, Getter pour l'id de la transaction reçu de Paypal
         * @return      [object]
         */
        public function getTransactionId() {
            return $this->transaction_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Achat
         * @param       [numeric] $achat_actif, Getter pour indiquer si l'achat est actif ou annnulé
         * @return      [object]
         */
        public function getAchatActif() {
            return $this->achat_actif;
        }

    }
