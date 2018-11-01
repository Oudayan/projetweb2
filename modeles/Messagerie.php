<?php
/**
 * @file    Messagerie.php
 * @author  Jansy Lopez, Oudayan Dutta
 * @version 1.0
 * @date    Septembre 2018
 * @brief   Définit la classe Messagerie
 * @details Cette classe définit les attributs d'un message
 */

    class Messagerie {

        //Atributs
        private $msg_id;
        private $membre_id;
        private $sujet;
        private $message;
        private $attachement;
        private $msg_date;
        private $msg_envoye;
        private $msg_lu;
        private $msg_actif;

        // Constructeur
        public function __construct($msg_id = "", $membre_id = "", $sujet = "", $message = "", $attachement = "", $msg_date = "", $msg_envoye = 0, $msg_lu = 0, $msg_actif = 1) {
            $this->setMsgId($msg_id);
            $this->setMembreId($membre_id);
            $this->setSujet($sujet);
            $this->setMessage($message);
            $this->setAttachement($attachement);
            $this->setMsgDate($msg_date);
            $this->setMsgEnvoye($msg_envoye);
            $this->setMsgLu($msg_lu);
            $this->setMsgActif($msg_actif);
        }

        //SETTERS

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [numeric] $msg_id, L'id du message
         * @return      [object]
         */
        public function setMsgId($msg_id) {
            if (is_numeric($msg_id) && trim($msg_id) != "") {
                $this->msg_id = $msg_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [numeric] $membre_id, L'id du membre qui envoi le message
         * @return      [object]
         */
        public function setMembreId($membre_id) {
            if (is_numeric($membre_id) && trim($membre_id) != "") {
                $this->membre_id = $membre_id;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $sujet, Le sujet du message
         * @return      [object]
         */
        public function setSujet($sujet) {
            if (is_string($sujet) && trim($sujet) != "") {
                $this->sujet = $sujet;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $message, Le corps du message
         * @return      [object]
         */
        public function setMessage($message) {
            if (is_string($message) && trim($message) != "") {
                $this->message = $message;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $attachement, Le chemin de l'attachement
         * @return      [object]
         */
        public function setAttachement($attachement) {
            if (is_string($attachement) && trim($attachement) != "") {
                $this->attachement = $attachement;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $msg_date, La date du message
         * @return      [object]
         */
        public function setMsgDate($msg_date) {
            if (is_string($msg_date) && trim($msg_date) != "") {
                $this->msg_date = $msg_date;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $msg_envoye, Indique si le message est envoyé ou pas
         * @return      [object]
         */
        public function setMsgEnvoye($msg_envoye) {
            if (is_numeric($msg_envoye) && trim($msg_envoye) != "") {
                $this->msg_envoye = $msg_envoye;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $msg_lu, Indique si le message est lu ou pas
         * @return      [object]
         */
        public function setMsgLu($msg_lu) {
            if (is_numeric($msg_lu) && trim($msg_lu) != "") {
                $this->msg_lu = $msg_lu;
            }
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $msg_actif, Indique si le message est actif ou effacé
         * @return      [object]
         */
        public function setMsgActif($msg_actif) {
            if (is_numeric($msg_actif) && trim($msg_actif) != "") {
                $this->msg_actif = $msg_actif;
            }
        }

        // GETTERS

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Messagerie
         * @param       [numeric] $msg_id, L'id du message
         * @return      [object]
         */
        public function getMsgId() {
            return $this->msg_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [numeric] $membre_id, L'id du membre qui envoi le message
         * @return      [object]
         */
        public function getMembreId() {
            return $this->membre_id;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $sujet, Le sujet du message
         * @return      [object]
         */
        public function getSujet() {
            return $this->sujet;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $message, Le corps du message
         * @return      [object]
         */
        public function getMessage() {
            return $this->message;
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $attachement, Le chemin de l'attachement
         * @return      [object]
         */
        public function getAttachement() {
            return $this->attachement;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $msg_date, La date du message
         * @return      [object]
         */
        public function getMsgDate() {
            return $this->msg_date;
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $msg_envoye, Indique si le message est envoyé ou pas
         * @return      [object]
         */
        public function getMsgEnvoye() {
            return $this->msg_envoye;
        }

        /**
         * @brief       Permet de définir en écriture l'attribut de la classe Messagerie
         * @param       [string] $msg_lu, Indique si le message est lu ou pas
         * @return      [object]
         */
        public function getMsgLu() {
            return $this->msg_lu;
        }

        /**
         * @brief       Permet de définir en lecture l'attribut de la classe Membres
         * @param       [string] $msg_actif, Indique si le message est actif ou effacé
         * @return      [object]
         */
        public function getMsgActif() {
            return $this->msg_actif;
        }

    }

?>