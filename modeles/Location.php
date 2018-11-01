<?php

/**
 * @file    Location.php
 * @author  Chunliang He, Oudayan Dutta
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Location.
 * @details Cette classe définit les attributs privés d'une location avec toutes les méthodes publiques "getters" et "setters" pour écrire et get les attributs
 */

    class Location {

        // Attributs
        private $location_id;
        private $type_paiement_id;
        private $membre_id;
        private $jeux_id;
        private $date_location;
        private $date_debut;
        private $date_retour;
        private $transaction_id;
        private $location_active;

        // Constructeur
        public function __construct($location_id = 0, $type_paiement_id = 0, $membre_id = 0, $jeux_id = 0, $date_location = "", $date_debut = "", $date_retour = "", $transaction_id = "", $location_active = 1) {
            $this->setLocationId($location_id);
            $this->setTypePaiementId($type_paiement_id);
            $this->setMembreId($membre_id);
            $this->setJeuxId($jeux_id);
            $this->setDateLocation($date_location);
            $this->setDateDebut($date_debut);
            $this->setDateRetour($date_retour);
            $this->setTransactionId($transaction_id);
            $this->setLocationActive($location_active);
        }

        // "SETTERS"

        /**
         * @brief      Permet de définir en ecriture l'attribut de la classe Location
         * @param      [numeric]  $location_id, Setter pour l'id de la location du jeu
         * @return     [object]
         */
        public function setLocationId($location_id) {
            if (is_numeric($location_id) && trim($location_id) != "") {
                $this->location_id = $location_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Location
         * @param       [numeric] $type_paiement_id, Setter pour l'id du type du paiement utilisé pour la location
         * @return      [object]
         */
        public function setTypePaiementId($type_paiement_id) {
            if (is_numeric($type_paiement_id) && trim($type_paiement_id) != "") {
                $this->type_paiement_id = $type_paiement_id;
            }
        }

        /**
         * @brief      Permet de définir en ecriture l'attribut de la classe Location
         * @param      [string]  $membre_id, Setter pour l'id du membre qui loue le jeu
         * @return     [object]
         */
        public function setMembreId($membre_id) {
            if (is_numeric($membre_id) && trim($membre_id) != "") {
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief      Permet de définir en ecriture l'attribut de la classe Location
         * @param      [numeric]  $jeux_id, Setter pour l'id du jeux loué
         * @return     [object]
         */
        public function setJeuxId($jeux_id) {
            if (is_numeric($jeux_id) && trim($jeux_id) != "") {
                $this->jeux_id = $jeux_id;
            }
        }

        /**
         * @brief      Permet de définir en ecriture l'attribut de la classe Location
         * @param      [string]  $date_location, Setter pour la date de début de la location du jeu
         * @return     [object]
         */
        public function setDateLocation($date_location) {
            if (is_string($date_location) && trim($date_location) != "") {
                $this->date_location = $date_location;
            }
        }

        /**
         * @brief      Permet de définir en ecriture l'attribut de la classe Location
         * @param      [string]  $date_debut, Setter pour la date de début de la location du jeu
         * @return     [object]
         */
        public function setDateDebut($date_debut) {
            if (is_string($date_debut) && trim($date_debut) != "") {
                $this->date_debut = $date_debut;
            }
        }

        /**
         * @brief      Permet de définir en ecriture l'attribut de la classe Location
         * @param      [string]  $date_retour, Setter pour la date de fin de la location du jeu
         * @return     [object]
         */
        public function setDateRetour($date_retour) {
            if (is_string($date_retour) && trim($date_retour) != "") {
                $this->date_retour = $date_retour;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Location
         * @param       [string] $transaction_id, Setter pour l'id de la transaction reçu de Paypal
         * @return      [object]
         */
        public function setTransactionId($transaction_id) {
            if (is_string($transaction_id) && trim($transaction_id) != "") {
                $this->transaction_id = $transaction_id;
            }
        }

        /**
         * @brief      Permet de définir en ecriture l'attribut de la classe Location
         * @param      [numeric]  $location_active, Setter pour indiquer si la location est active ou annnulée
         * @return     [object]
         */
        public function setLocationActive($location_active) {
            if (is_numeric($location_active) && trim($location_active) != "") {
                $this->location_active = $location_active;
            }
        }


        // "GETTERS"-----------------------------------------------------------------------

        /**
         * @brief      Permet de définir en lecture l'attribut de la classe Location
         * @param      [numeric]  $location_id, Getter pour l'id de la location d'un jeu
         * @return     [object]
         */
        public function getLocationId() {
            return $this->location_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Location
         * @param       [numeric] $type_paiement_id, Getter pour l'id du type du paiement utilisé pour la location
         * @return      [object]
         */
        public function getTypePaiementId() {
            return $this->type_paiement_id;
        }

        /**
         * @brief      Permet de définir en lecture l'attribut de la classe Location
         * @param      [string]  $membre_id, Getter pour l'id du membre qui loue le jeu
         * @return     [object]
         */
        public function getMembreId() {
            return $this->membre_id;
        }

        /**
         * @brief      Permet de définir en lecture l'attribut de la classe Location
         * @param      [numeric]  $jeux_id, Getter pour l'id du jeux loué
         * @return     [object]
         */
        public function getJeuxId() {
            return $this->jeux_id;
        }

        /**
         * @brief      Permet de définir en lecture l'attribut de la classe Location
         * @param      [string]  $date_location, Getter pour la date de début de la location du jeu
         * @return     [object]
         */
        public function getDateLocation() {
            return $this->date_location;
        }

        /**
         * @brief      Permet de définir en lecture l'attribut de la classe Location
         * @param      [string]  $date_location, Getter pour la date de début de la location du jeu
         * @return     [object]
         */
        public function getDateDebut() {
            return $this->date_debut;
        }


        /**
         * @brief      Permet de définir en lecture l'attribut de la classe Location
         * @param      [string]  $date_retour, Getter pour la date de fin de la location du jeu
         * @return     [object]
         */
        public function getDateRetour() {
            return $this->date_retour;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Location
         * @param       [string] $transaction_id, Getter pour l'id de la transaction reçu de Paypal 
         * @return      [object]
         */
        public function getTransactionId() {
            return $this->transaction_id;
        }

        /**
         * @brief      Permet de définir en lecture l'attribut de la classe Location
         * @param      [numeric]  $location_active, Getter pour indiquer si la location est active ou annnulée
         * @return     [object]
         */
        public function getLocationActive() {
            return $this->location_active;
        }

    }

?>